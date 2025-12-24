<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\BooksModel;
use App\Models\coursesModel;
use App\Models\salesDetailsModel;
use App\Models\salesModel;
use Bryceandy\Laravel_Pesapal\Facades\Pesapal;
use Bryceandy\Laravel_Pesapal\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request as FacadeRequest;
use Illuminate\Support\Facades\Route;


class cartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);

        // Subtotal: Sum of (Original Price * Qty)
        $original_subtotal = array_sum(array_map(fn($item) => $item['original_price'] * $item['quantity'], $cart));

        // Total: Sum of (Final Price * Qty)
        $total = array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], $cart));

        // Total Savings
        $savings = $original_subtotal - $total;

        return view('client.cart', compact('cart', 'total', 'original_subtotal', 'savings'));
    }

    public function add(Request $request)
    {
        $cart = session()->get('cart', []);
        $id = $request->id;
        $type = $request->type;
        $cartKey = $type . '_' . $id;

        if (isset($cart[$cartKey])) {
            $cart[$cartKey]['quantity']++;
        } else {
            $item = ($type == 'book') ? BooksModel::find($id) : coursesModel::find($id);

            $originalPrice = $item->pricing;
            $discountValue = $item->discount ?? 0;
            $finalPrice = $originalPrice * ((100 - $discountValue) / 100);

            $cart[$cartKey] = [
                "id" => $id,
                "name" => $type == 'book' ? $item->book_name : $item->course_name,
                "quantity" => 1,
                "original_price" => $originalPrice, // Store original
                "discount" => $discountValue,       // Store discount
                "price" => $finalPrice,             // Store final price
                "image" => $type == 'book' ? $item->image : $item->cover_image,
                "type" => $type,
                "meta" => $type == 'book' ? $item->author : $item->course_duration . ' ' . $item->duration_unit
            ];
        }

        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Item added to cart!');
    }

    public function update(Request $request)
    {
        if ($request->id && $request->quantity) {
            $cart = session()->get('cart');
            $cart[$request->id]["quantity"] = $request->quantity;
            session()->put('cart', $cart);
        }
    }

    public function remove(Request $request)
    {
        if ($request->id) {
            $cart = session()->get('cart');
            if (isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
        }
        return redirect()->back();
    }

    public function checkout()
    {
        // 1. Check login
        if (!session()->has('user_logged_in') || !session('user_logged_in')) {
            return redirect()->to('/login')->with('info', 'Please login to complete your purchase.');
        }

        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->back()->with('error', 'Your cart is empty.');
        }

        $total = array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], $cart));
        $transactionId = 'TXN_' . time() . '_' . session('user_id');

        $user = [
            'user_id' => session('user_id'),
            'user_name' => session('user_name'),
            'user_email' => session('user_email'),
            'user_phone' => session('user_phone')
        ];

        // 2. Logic for FREE items
        if ($total <= 0) {
            return $this->processFreeSale($cart, $user, $transactionId);
        }

        // 3. Paid items via Bryceandy Pesapal
        $order = [
            'amount' => $total,
            'currency' => 'KES', // or 'TZS', 'UGX', 'USD' - set your default
            'description' => 'Wellness Purchase: ' . count($cart) . ' items',
            'type' => 'MERCHANT',
            'first_name' => session('user_name'),
            'last_name' => 'Customer',
            'email' => session('user_email'),
            'phone_number' => session('user_phone') ?? '0700000000',
            'reference' => $transactionId,
        ];

        // Store cart and user data in session for callback/verification later
        session()->put('checkout_cart', $cart);
        session()->put('checkout_user', $user);
        session()->save(); // Force save session

        // Return the view with auto-submitting form (DON'T use redirect)
        return view('client.checkout.redirect_to_payment', compact('order'));
    }
    // public function checkout()
    // {
    //     // 1. Check if user is logged in
    //     if (!session()->has('user_logged_in') || !session('user_logged_in')) {
    //         return redirect()->to('/login')->with('info', 'Please login to complete your purchase.');
    //     }


    //     $cart = session()->get('cart', []);
    //     if (empty($cart)) {
    //         return redirect()->back()->with('error', 'Your cart is empty.');
    //     }

    //     $user =
    //         [
    //             'user_id' => session('user_id'),
    //             'user_name' => session('user_name'),
    //             'user_email' => session('user_email'),
    //             'user_type' => session('user_type'),
    //             'user_phone' => session('user_phone')
    //         ];
    //     $total = array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], $cart));
    //     $transactionId = 'TXN_' . time() . '_' . session('user_id');

    //     // 2. Logic for FREE items (Total = 0)
    //     if ($total <= 0) {
    //         return $this->processFreeSale($cart, $user, $transactionId);
    //     }

    //     // 3. Logic for PAID items (Total > 0) via PesaPal
    //     $details = [
    //         'amount' => $total,
    //         'description' => 'Wellness Purchase: ' . count($cart) . ' items',
    //         'type' => 'MERCHANT',
    //         'first_name' => session('user_name'), // Adjust based on your User model
    //         'last_name' => '',
    //         'email' => session('user_email'),
    //         'phone_number' => session('user_phone') ?? '0000000000', // Ensure this field exists or provide default
    //         'reference' => $transactionId,
    //         'height' => '400px',
    //         'currency' => 'KES', // or USD depending on your PesaPal config
    //         'callback_url' => url('/pesapal-ipn-listener'),
    //     ];
    //     // dd(env('PESAPAL_CALLBACK_ROUTE'));

    //     return Pesapal::makePayment($details);
    // }

    // /**
    //  * Handle the database insertion for Free ($0) checkouts
    //  */
    private function processFreeSale($cart, $user, $transactionId)
    {
        DB::beginTransaction();
        try {
            $sale = salesModel::create([
                'number_of_items' => count($cart),
                'user_id' => $user['user_id'],
                'payment_method' => 'free_access',
                'receipt_number' => 'REC-' . strtoupper(uniqid()),
                'transaction_reference' => $transactionId,
                'total_price' => 0,
                'status_payment' => 'Completed',
                'delivery_method' => 'digital',
                'delivery_status' => 'delivered',
                'status' => 0
            ]);

            foreach ($cart as $item) {
                salesDetailsModel::create([
                    'sale_id' => $sale->id,
                    'item_id' => $item['id'],
                    'item_type' => $item['type'],
                    'quantity' => $item['quantity'],
                    'price' => 0,
                    'status' => 0
                ]);
            }

            DB::commit();
            session()->forget('cart');
            return redirect()->to('/')->with('success', 'Items added to your library for free!');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::info($e);
            return redirect()->back()->with('error', 'Something went wrong processing the order.');
        }
    }
    public function paymentSuccess(Request $request)
    {

        $transaction = Pesapal::getTransactionDetails(
            request('pesapal_merchant_reference'), request('pesapal_transaction_tracking_id'));

        Log::info('transaction status from pesapal', $transaction);
        if($transaction['status']!='FAILED'){
            $payment = Payment::whereReference(request('pesapal_merchant_reference'))->first();
            $payment_id=$payment->id;
            $tracking_id=$payment->tracking_id;

            $cart = session()->get('cart', []);


            // Check if cart is empty (session might have expired)
            if (empty($cart)) {
                return redirect()->to('/')->with('error', 'Your session expired. Please contact support with Ref: ' .$tracking_id);
            }
            $user = [
                'user_id'    => session('user_id'),
                'user_name'  => session('user_name'),
                'user_email' => session('user_email'),
                'user_phone' => session('user_phone')
            ];

            // Calculate total price from cart
            $total_price = array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], $cart));
            $payment_method = "Pesapal";

            // Call the processing function and return its redirect
            return $this->processPremiumSale($cart, $user, $tracking_id, $total_price, $payment_method,$payment_id);
        }

        return redirect()->to('/cart')->with('error', 'Payment failed or was cancelled.');
    }
    private function processPremiumSale($cart, $user, $transactionId, $price, $payment_method,$payment_id)
    {
        DB::beginTransaction();
        try {
            $sale = salesModel::create([
                'number_of_items'       => count($cart),
                'user_id'               => $user['user_id'], // Accessed as array key
                'payment_method'        => $payment_method,
                'receipt_number'        => 'REC-' . strtoupper(uniqid()),
                'transaction_reference' => $transactionId,
                'total_price'           => $price,
                'status_payment'        => 'Completed',
                'delivery_method'       => 'online',
                'delivery_status'       => 'delivered',
                'payment_id'            => $payment_id,
                'status'                => 0
            ]);

            foreach ($cart as $item) {
                salesDetailsModel::create([
                    'sale_id'   => $sale->id,
                    'item_id'   => $item['id'],
                    'item_type' => $item['type'],
                    'quantity'  => $item['quantity'],
                    'price'     => $item['price'],
                    'status'    => 0
                ]);
            }

            DB::commit();

            // Clean up
            session()->forget('cart');

            return redirect()->to('/')->with('success', 'Purchase successful! Your items are now available.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("Payment Success Error: " . $e->getMessage());
            return redirect()->to('/cart')->with('error', 'Database error. Please contact support with Ref: ' . $transactionId);
        }
    }

}

<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\salesDetailsModel;
use App\Models\salesModel;
use App\Models\userDetailsModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class salesController extends Controller
{
    public function index()
    {
        $data['sales'] = salesModel::select('users_details.full_name as buyer_name', 'users_details.email_address as email_address', 'sales.*')->join('users_details', 'users_details.id', 'sales.user_id')->get();
        return view('admin.sales.index', compact('data'));
    }
    public function saleDetails(Request $request, $id)
    {

        $data['sales_details'] = salesDetailsModel::where('sale_id', $id)
            ->with(['book', 'course']) // Eager load both
            ->get()
            ->map(function ($detail) {
                // Dynamically assign the name based on the type
                if ($detail->item_type === 'book') {
                    $detail->display_name = $detail->book->title ?? 'Unknown Book';
                } elseif ($detail->item_type === 'course') {
                    $detail->display_name = $detail->course->course_name ?? 'Unknown Course';
                } else {
                    $detail->display_name = "Item #{$detail->item_id}";
                }
                return $detail;
            });
        $data['user_sales'] = userDetailsModel::join('sales', 'users_details.id', '=', 'sales.user_id')
            ->select(
                'users_details.email_address',
                'users_details.full_name',
                'users_details.phone_number',
                'sales.total_price as total_sales',
                'sales.transaction_reference',
                'sales.number_of_items',
                'sales.delivery_method',


            )->where('sales.id',$id)
            // ->groupBy('users_details.id', 'users_details.full_name')
            ->first();
        return view('admin.sales.sales_details', compact('data'));
    }
}

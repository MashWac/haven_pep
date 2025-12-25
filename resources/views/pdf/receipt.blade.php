<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Receipt - {{ $order->receipt_number }}</title>
    <style>
        body { font-family: 'Helvetica', sans-serif; color: #333; line-height: 1.5; }
        .header { text-align: center; margin-bottom: 30px; border-bottom: 2px solid #f4f4f4; padding-bottom: 20px; }
        .info-table { width: 100%; margin-bottom: 30px; }
        .items-table { width: 100%; border-collapse: collapse; margin-bottom: 30px; }
        .items-table th { background: #f8f8f8; text-align: left; padding: 10px; border-bottom: 2px solid #eee; }
        .items-table td { padding: 10px; border-bottom: 1px solid #eee; }
        .total-section { text-align: right; margin-top: 20px; }
        .footer { text-align: center; font-size: 12px; color: #999; margin-top: 50px; }
        .brand { color: #da71d7; font-size: 24px; font-weight: bold; }
    </style>
</head>
<body>
    <div class="header">
        <div class="brand">WELLNESS HAVEN</div>
        <p>Official Purchase Receipt</p>
    </div>

    <table class="info-table">
        <tr>
            <td>
                <strong>Billed To:</strong><br>
                {{ session('user_name') }}<br>
                {{ session('user_email') }}
            </td>
            <td style="text-align: right;">
                <strong>Receipt No:</strong> {{ $order->receipt_number }}<br>
                <strong>Date:</strong> {{ $order->created_at->format('F d, Y') }}<br>
                <strong>Payment:</strong> {{ $order->payment_method }}
            </td>
        </tr>
    </table>

    <table class="items-table">
        <thead>
            <tr>
                <th>Item Name</th>
                <th>Item Type</th>
                <th style="text-align: center;">Qty</th>
                <th style="text-align: right;">Unit Price</th>
                <th style="text-align: right;">Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order_details as $item)
            <tr>
                <td>{{$item->display_name?? 'Product ID: '.$item->item_id }}</td>
                <td>{{$item->item_type}}</td>
                <td style="text-align: center;">{{ $item->quantity }}</td>
                <td style="text-align: right;">KES{{ number_format($item->price, 2) }}</td>
                <td style="text-align: right;">KES{{ number_format($item->price * $item->quantity, 2) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="total-section">
        <p><strong>Subtotal:</strong> ${{ number_format($order->total_price, 2) }}</p>
        <p style="font-size: 18px; color: #da71d7;"><strong>Total Paid: ${{ number_format($order->total_price, 2) }}</strong></p>
    </div>

    <div class="footer">
        <p>Thank you for choosing Wellness Haven for your journey.</p>
        <p>This is a computer-generated receipt and requires no signature.</p>
    </div>
</body>
</html>
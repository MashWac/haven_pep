<!DOCTYPE html>
<html>
<head>
    <title>Redirecting to Payment...</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">

</head>
<body>
    <div style="text-align: center; padding: 50px;">
        <h3>Redirecting to payment gateway...</h3>
        <p>Please wait...</p>
    </div>

    <form id="payment-form" method="POST" action="{{ route('payment.store') }}">
        @csrf
        @foreach($order as $key => $value)
            <input type="hidden" name="{{ $key }}" value="{{ $value }}">
        @endforeach
    </form>

    <script>
        document.getElementById('payment-form').submit();
    </script>
</body>
</html>
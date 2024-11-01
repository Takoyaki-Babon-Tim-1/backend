<!DOCTYPE html>
<html>
<head>
    <title>Payment Notification</title>
</head>
<body>
    <p>Hello Admin,</p>
    <p>A new payment has been completed.</p>
    <p><strong>Order ID:</strong> {{ $order_id }}</p>
    <p><strong>Total Price:</strong> Rp. {{ number_format($totalPrice, 0, ',', '.') }}</p>
    <p><strong>Customer:</strong> {{ $user->name }} ({{ $user->email }})</p>
    <p>Best regards, <br>Your Company</p>
</body>
</html>

<!DOCTYPE html>
<html>
<head>
    <title>Order Confirmation</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background: #4F46E5; color: white; padding: 20px; text-align: center; }
        .order-details { background: #f9fafb; padding: 15px; border-radius: 5px; margin: 20px 0; }
        .total { font-size: 18px; font-weight: bold; text-align: right; margin-top: 10px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Thank you for your order!</h1>
        </div>
        
        <p>Hi {{ auth()->user()->name }},</p>
        <p>We have received your order and are processing it now.</p>

        <div class="order-details">
            <h3>Order Summary</h3>
            <p><strong>Order Number:</strong> {{ $order->order_number }}</p>
            <p><strong>Date:</strong> {{ $order->created_at->format('M d, Y') }}</p>
        </div>

        <h3>Items Ordered:</h3>
        <table width="100%" style="border-collapse: collapse;">
            <thead>
                <tr style="border-bottom: 2px solid #eee; text-align: left;">
                    <th style="padding: 10px;">Product</th>
                    <th style="padding: 10px;">Qty</th>
                    <th style="padding: 10px;">Price</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->items as $item)
                <tr style="border-bottom: 1px solid #eee;">
                    <td style="padding: 10px;">{{ $item->product->name }}</td>
                    <td style="padding: 10px;">{{ $item->quantity }}</td>
                    <td style="padding: 10px;">${{ number_format($item->price, 2) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="total">
            Total: ${{ number_format($order->grand_total, 2) }}
        </div>

        <p>You can view your order status in your <a href="{{ route('dashboard') }}">dashboard</a>.</p>
        
        <p>Thanks,<br>TechNode Team</p>
    </div>
</body>
</html>
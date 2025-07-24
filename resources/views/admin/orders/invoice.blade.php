<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Invoice #{{ $order->id }}</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background: #f4f4f4; }
        h2 { text-align: center; }
    </style>
</head>
<body>
    <h2>Invoice #{{ $order->id }}</h2>
    <p><strong>Date:</strong> {{ $order->created_at->format('d M Y') }}</p>
    <p><strong>Customer:</strong> {{ $order->user->name ?? 'Guest' }}</p>
    <p><strong>Email:</strong> {{ $order->user->email ?? '-' }}</p>

    <table>
        <thead>
            <tr>
                <th>Medicine</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->items as $item)
            <tr>
                <td>{{ $item->medicine->name }}</td>
                <td>{{ $item->price }}</td>
                <td>{{ $item->quantity }}</td>
                <td>{{ $item->price * $item->quantity }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <h3 style="text-align:right; margin-top:20px;">Grand Total: {{ $order->total_amount }}</h3>
</body>
</html>

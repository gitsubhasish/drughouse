<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Invoice #{{ $order->id }}</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; color: #333; }
        .container { width: 100%; }
        .card { border: 1px solid #ddd; padding: 20px; }
        .card-header { font-size: 18px; margin-bottom: 15px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        table, th, td { border: 1px solid #ddd; }
        th, td { padding: 8px; text-align: left; }
        .right { text-align: right; }
        .center { text-align: center; }
    </style>
</head>
<body>
<div class="container">
  <div class="card">
    <div class="card-header">
        <strong>Invoice #{{ $order->id }}</strong>
        <span style="float:right"><strong>Status:</strong> {{ $order->status }}</span>
        <div><strong>{{ $order->created_at->format('d/m/Y') }}</strong></div>
    </div>
    <div class="card-body">
        <div style="display:flex; justify-content:space-between;">
            <div>
                <h4>From:</h4>
                <div><strong>{{ config('app.name') }}</strong></div>
                <div>Demo Address, City</div>
                <div>Email: admin@demo.com</div>
                <div>Phone: +91 9999999999</div>
            </div>
            <div>
                <h4>To:</h4>
                <div><strong>{{ $order->customer_name }}</strong></div>
                <div>{{ $order->address }}</div>
                <div>Email: {{ $order->customer_email }}</div>
                <div>Phone: {{ $order->customer_phone }}</div>
            </div>
        </div>

        <h4>Items</h4>
        <table>
            <thead>
                <tr>
                    <th class="center">#</th>
                    <th>Item</th>
                    <th class="right">Unit Cost</th>
                    <th class="center">Qty</th>
                    <th class="right">Total</th>
                </tr>
            </thead>
            <tbody>
                @php $total_price = 0; @endphp
                @foreach($order->items as $index => $item)
                @php $total_price+=$item->price*$item->quantity; @endphp
                <tr>
                    <td class="center">{{ $index + 1 }}</td>
                    <td>{{ $item->medicine->name }}</td>
                    <td class="right">${{ $item->price }}</td>
                    <td class="center">{{ $item->quantity }}</td>
                    <td class="right">${{ $item->price * $item->quantity }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <table>
            <tr>
                <td><strong>Total</strong></td>
                <td class="right"><strong>${{ $total_price }}</strong></td>
            </tr>
        </table>
    </div>
  </div>
</div>
</body>
</html>

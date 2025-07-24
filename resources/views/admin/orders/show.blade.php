@extends('layouts.admin')

@section('main-content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Order #{{ $order->id }}</h1>

    <div class="card mb-3">
        <div class="card-body">
            <h5>User Information</h5>
            <p><strong>Name:</strong> {{ $order->user->name ?? 'Guest' }}</p>
            <p><strong>Email:</strong> {{ $order->user->email ?? '-' }}</p>
        </div>
    </div>

    <div class="card mb-3">
        <div class="card-body">
            <h5>Order Items</h5>
            <table class="table table-bordered">
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
            <h5 class="text-right">Grand Total: <strong>{{ $order->total_amount }}</strong></h5>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <h5>Change Status</h5>
            <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST" class="form-inline">
                @csrf
                <select name="status" class="form-control mr-2">
                    <option value="pending" {{ $order->status=='pending' ? 'selected' : '' }}>Pending</option>
                    <option value="processing" {{ $order->status=='processing' ? 'selected' : '' }}>Processing</option>
                    <option value="completed" {{ $order->status=='completed' ? 'selected' : '' }}>Completed</option>
                    <option value="cancelled" {{ $order->status=='cancelled' ? 'selected' : '' }}>Cancelled</option>
                </select>
                <button type="submit" class="btn btn-primary">Update Status</button>
            </form>
        </div>
    </div>
</div>
@endsection

@extends('layouts.admin')

@section('main-content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Orders</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="GET" class="form-inline mb-3">
        <select name="status" class="form-control mr-2">
            <option value="">All Status</option>
            <option value="pending" {{ request('status')=='pending' ? 'selected' : '' }}>Pending</option>
            <option value="processing" {{ request('status')=='processing' ? 'selected' : '' }}>Processing</option>
            <option value="completed" {{ request('status')=='completed' ? 'selected' : '' }}>Completed</option>
            <option value="cancelled" {{ request('status')=='cancelled' ? 'selected' : '' }}>Cancelled</option>
        </select>
        <button type="submit" class="btn btn-primary">Filter</button>
    </form>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>User</th>
                <th>Total</th>
                <th>Status</th>
                <th>Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($orders as $order)
            <tr>
                <td>{{ $order->id }}</td>
                <td>{{ $order->user->name ?? 'Guest' }}</td>
                <td>{{ $order->total_amount }}</td>
                <td>
                    @if($order->status == 'pending')
                        <span class="badge badge-warning">Pending</span>
                    @elseif($order->status == 'processing')
                        <span class="badge badge-info">Processing</span>
                    @elseif($order->status == 'completed')
                        <span class="badge badge-success">Completed</span>
                    @else
                        <span class="badge badge-danger">Cancelled</span>
                    @endif
                </td>
                <td>{{ $order->created_at->format('d M Y') }}</td>
                <td>
                    <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-sm btn-primary">View</a>
                    <a href="{{ route('admin.orders.invoice', $order->id) }}" class="btn btn-sm btn-secondary">Invoice</a>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center text-muted">No data found</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    {{ $orders->links() }}
</div>
@endsection

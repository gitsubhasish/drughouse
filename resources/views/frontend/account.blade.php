@extends('layouts.frontend')

@section('content')
<div class="container py-5">
    <h2 class="mb-4">My Account</h2>

    {{-- Flash Messages --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="row">
        {{-- Orders --}}
        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-header">My Orders</div>
                <div class="card-body">
                    @if($orders->count())
                        <ul class="list-group">
                            @foreach($orders as $order)
                                <li class="list-group-item">
                                    Order #{{ $order->id }} - {{ $order->status }}<br>
                                    <small>{{ $order->created_at->format('d M Y') }}</small>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p>No orders found.</p>
                    @endif
                </div>
            </div>
        </div>

        {{-- Address --}}
        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-header">Save Address</div>
                <div class="card-body">
                    <form action="{{ route('account.address') }}" method="POST">
                        @csrf
                        <div class="mb-2">
                            <label>Address</label>
                            <input type="text" name="address" value="{{ old('address', $user->address) }}" class="form-control" required>
                        </div>
                        <div class="mb-2">
                            <label>City</label>
                            <input type="text" name="city" value="{{ old('city', $user->city) }}" class="form-control" required>
                        </div>
                        <div class="mb-2">
                            <label>State</label>
                            <input type="text" name="state" value="{{ old('state', $user->state) }}" class="form-control" required>
                        </div>
                        <div class="mb-2">
                            <label>Zip</label>
                            <input type="text" name="zip" value="{{ old('zip', $user->zip) }}" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary mt-2">Save Address</button>
                    </form>
                </div>
            </div>
        </div>

        {{-- Password Reset --}}
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Reset Password</div>
                <div class="card-body">
                    <form action="{{ route('account.reset') }}" method="POST">
                        @csrf
                        <p>Click the button below to receive a password reset link to your email: <strong>{{ $user->email }}</strong></p>
                        <button type="submit" class="btn btn-warning">Send Password Reset Email</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

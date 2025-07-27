@extends('layouts.frontend')

@section('content')
<div class="site-section">
    <div class="container">
        <h2>Checkout</h2>

        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('checkout.place') }}" method="POST">
            @csrf
            <div class="form-group">
                <label>Name</label>
                <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
            </div>
            <div class="form-group">
                <label>Phone</label>
                <input type="text" name="phone" class="form-control" value="{{ old('phone') }}" required>
            </div>
            <div class="form-group">
                <label>Shipping Address</label>
                <textarea name="address" class="form-control" required></textarea>
            </div>
            <div class="form-group">
                <label>Pincode</label>
                <input type="text" name="pincode" class="form-control" value="{{ old('pincode') }}" required>
            </div>

            <h4>Order Summary</h4>
            <ul>
                @foreach($cart as $item)
                    <li>{{ $item['name'] }} (x{{ $item['quantity'] }}) - ${{ $item['price'] * $item['quantity'] }}</li>
                @endforeach
            </ul>
            <h5>Total: ${{ $total }}</h5>

            <button type="submit" class="btn btn-primary">Place Order</button>
        </form>
    </div>
</div>
@endsection

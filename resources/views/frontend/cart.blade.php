@extends('layouts.frontend')

@section('content')
<div class="bg-light py-3">
    <div class="container">
        <div class="row">
            <div class="col-md-12 mb-0">
                <a href="{{ route('shop') }}">Store</a> <span class="mx-2 mb-0">/</span>
                <strong class="text-black">Cart</strong>
            </div>
        </div>
    </div>
</div>

<div class="site-section">
    <div class="container">
        @if(count($cart) > 0)
        <div class="row mb-5">
            <div class="col-md-12">
                <div class="site-blocks-table">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                                <th>Remove</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($cart as $id => $item)
                            <tr>
                                <td>
                                    <img src="{{ asset('storage/' . $item['image']) }}" alt="{{ $item['name'] }}" width="70">
                                </td>
                                <td>{{ $item['name'] }}</td>
                                <td>${{ number_format($item['price'], 2) }}</td>
                                <td>
                                    <form action="{{ route('cart.update', $id) }}" method="POST" class="d-flex">
                                        @csrf
                                        <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1"
                                            class="form-control w-50 mr-2">
                                        <button type="submit" class="btn btn-sm btn-primary">Update</button>
                                    </form>
                                </td>
                                <td>${{ number_format($item['price'] * $item['quantity'], 2) }}</td>
                                <td>
                                    <a href="{{ route('cart.remove', $id) }}" class="btn btn-sm btn-danger"
                                        onclick="return confirm('Remove this item?')">X</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <a href="{{ route('shop') }}" class="btn btn-outline-primary btn-md btn-block">Continue Shopping</a>
            </div>
            <div class="col-md-6 text-right">
                <h3>Total: ${{ number_format($total, 2) }}</h3>
                <a href="{{ route('checkout') }}" class="btn btn-primary btn-md btn-block">Proceed To Checkout</a>
            </div>
        </div>
        @else
        <div class="text-center">
            @if(session('order_id'))
                <div class="mt-3">
                    <a href="{{ route('invoice.download', session('order_id')) }}" class="btn btn-primary">
                        Download Invoice
                    </a>
                </div>
            @endif
            <h4>Your cart is empty!</h4>
            <a href="{{ route('shop') }}" class="btn btn-primary mt-3">Go to Store</a>
        </div>
        @endif
    </div>
</div>



@endsection

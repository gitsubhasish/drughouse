@extends('layouts.frontend')

@section('content')
<div class="bg-light py-3">
    <div class="container">
        <div class="row">
            <div class="col-md-12 mb-0">
                <a href="{{ route('shop') }}">Store</a> <span class="mx-2 mb-0">/</span>
                <strong class="text-black">{{ $medicine->name }}</strong>
            </div>
        </div>
    </div>
</div>

<div class="site-section">
    <div class="container">
        <div class="row">
            {{-- Left Side Images --}}
            <div class="col-md-6">
                <div class="mb-4">
                    @php
                        $firstImage = $medicine->images->first();
                    @endphp
                    <img id="mainImage" src="{{ $firstImage ? asset('storage/' . $firstImage->image) : asset('images/no-image.jpg') }}" class="img-fluid" alt="{{ $medicine->name }}">
                </div>
                
                {{-- Thumbnails --}}
                <div class="d-flex">
                    @foreach($medicine->images as $image)
                        <img src="{{ asset('storage/' . $image->image) }}" 
                             class="img-thumbnail mr-2 thumb-image" 
                             style="width:70px; height:70px; cursor:pointer;"
                             onclick="document.getElementById('mainImage').src=this.src">
                    @endforeach
                </div>
            </div>

            {{-- Right Side Details --}}
            <div class="col-md-6">
                <h2 class="text-black">{{ $medicine->name }}</h2>
                <p>{{ $medicine->description }}</p>

                <p class="price">
                    @if($medicine->mrp && $medicine->mrp > $medicine->price)
                        <del>${{ $medicine->mrp }}</del> &mdash;
                    @endif
                    ${{ $medicine->price }}
                </p>

                <p><strong>Category:</strong> {{ $medicine->category->name ?? 'N/A' }}</p>
                <p><strong>Manufacturer:</strong> {{ $medicine->manufacturer->name ?? 'N/A' }}</p>
                <p><strong>Unit:</strong> {{ $medicine->unit->name ?? 'N/A' }}</p>
                <p><strong>Stock:</strong> {{ $medicine->total_stock }}</p>
                <p><strong>Expiry Date:</strong> {{ $medicine->expiry_date }}</p>
                <p><strong>Batch No:</strong> {{ $medicine->batch_no }}</p>

                {{-- Add to Cart Form --}}
                <form action="{{ route('cart.add', $medicine->id) }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="quantity" class="text-black">Quantity:</label>
                        <input type="number" name="quantity" id="quantity" value="1" min="1" max="{{ $medicine->total_stock }}" class="form-control w-25">
                    </div>
                    <button type="submit" class="buy-now btn btn-sm btn-primary">Add To Cart</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

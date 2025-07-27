@extends('layouts.frontend')

@section('content')
<div class="py-5">
    <div class="container">
        <div class="row">
            <form method="GET" action="{{ route('shop') }}">
            <div class="row">
                <div class="col-lg-3">
                <select name="manufacturer" class="form-control">
                    <option value="">All Manufacturers</option>
                    @foreach($manufacturers as $manufacturer)
                    <option value="{{ $manufacturer->id }}" {{ request('manufacturer') == $manufacturer->id ? 'selected' : '' }}>
                        {{ $manufacturer->name }}
                    </option>
                    @endforeach
                </select>
                </div>

                <div class="col-lg-3">
                    <div class="row mb-3">
                        <div class="col-lg-12">
                            <div id="slider-range" class="border-primary"></div>
                            <input type="text" id="amount" class="form-control border-0 pl-0 bg-white" disabled />
                            {{-- Hidden inputs for form submission --}}
                            <input type="hidden" name="min_price" id="min_price" value="{{ request('min_price', 0) }}">
                            <input type="hidden" name="max_price" id="max_price" value="{{ request('max_price', 500) }}">
                        </div>
                    </div>
                </div>

                <div class="col-lg-3">
                <select name="sort" class="form-control">
                    <option value="">Sort By</option>
                    <option value="name_asc" {{ request('sort') == 'name_asc' ? 'selected' : '' }}>Name A-Z</option>
                    <option value="name_desc" {{ request('sort') == 'name_desc' ? 'selected' : '' }}>Name Z-A</option>
                    <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Price Low to High</option>
                    <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Price High to Low</option>
                </select>
                </div>
                <div class="px-3">
                    <button type="submit" class="btn btn-primary">Apply Filters</button>
                    <a href="{{ route('shop') }}" class="btn btn-secondary">Reset</a>
                </div>
            </div>
        </form>
        </div>
    </div>
</div>




  <div class="site-section bg-light">
  <div class="container">
    <div class="row">
      @forelse($medicines as $medicine)
        <div class="col-sm-6 col-lg-4 text-center item mb-4 item-v2">
          @if($medicine->is_featured)
            <span class="onsale">Sale</span>
          @endif
            @php
                $firstImage = $medicine->images->first();
            @endphp

            <a href="{{ route('product.show', $medicine->id) }}">
                @if($firstImage)
                    <img src="{{ asset('storage/' . $firstImage->image) }}" alt="{{ $medicine->name }}">
                @else
                    <img src="{{ asset('images/no-image.jpg') }}" alt="No Image">
                @endif
            </a>
          <h3 class="text-dark"><a href="{{ route('product.show', $medicine->id) }}">{{ $medicine->name }}</a></h3>
          <p class="price">
            @if($medicine->mrp && $medicine->mrp > $medicine->price)
              <del>${{ $medicine->mrp }}</del> &mdash;
            @endif
            ${{ $medicine->price }}
          </p>
        </div>
      @empty
        <div class="col-12 text-center">
          <p>No products found.</p>
        </div>
      @endforelse
    </div>

    {{-- Pagination --}}
    <div class="row mt-5">
      <div class="col-md-12 text-center">
        <div class="site-block-27  d-inline-block">
          {{ $medicines->appends(request()->query())->links() }}
        </div>
      </div>
    </div>
  </div>
</div>


@endsection
@extends('layouts.admin')

@section('main-content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Edit Medicine</h1>

    <form action="{{ route('admin.medicines.update', $medicine->id) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')

        <div class="form-group">
            <label>Name</label>
            <input type="text" name="name" class="form-control" value="{{ $medicine->name }}" required>
        </div>

        <div class="form-group">
            <label>Description</label>
            <textarea name="description" class="form-control">{{ $medicine->description }}</textarea>
        </div>

        <div class="form-group">
            <label>Price</label>
            <input type="number" name="price" step="0.01" class="form-control" value="{{ $medicine->price }}" required>
        </div>

        <div class="form-group">
            <label>Batch No</label>
            <input type="text" name="batch_no" value="{{ $medicine->batch_no }}" class="form-control">
        </div>

        <div class="form-group">
            <label>MRP</label>
            <input type="number" step="0.01" name="mrp" value="{{ $medicine->mrp }}" class="form-control">
        </div>

        <div class="form-group">
            <label>Unit</label>
            <select name="unit_id" class="form-control" required>
                @foreach($units as $unit)
                    <option value="{{ $unit->id }}" {{ isset($medicine) && $medicine->unit_id == $unit->id ? 'selected' : '' }}>
                        {{ $unit->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>Expiry Date</label>
            <input type="date" name="expiry_date" class="form-control" value="{{ $medicine->expiry_date }}" required>
        </div>

        <div class="form-group">
            <label>Total Stock</label>
            <input type="number" name="total_stock" class="form-control" value="{{ $medicine->total_stock }}" required>
        </div>

        <div class="form-group">
            <label>Featured</label>
            <select name="is_featured" class="form-control">
                <option value="0" {{ !$medicine->is_featured ? 'selected' : '' }}>No</option>
                <option value="1" {{ $medicine->is_featured ? 'selected' : '' }}>Yes</option>
            </select>
        </div>

        <div class="form-group">
            <label>Category</label>
            <select name="category_id" class="form-control" required>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ $medicine->category_id == $cat->id ? 'selected' : '' }}>
                        {{ $cat->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>Manufacturer</label>
            <select name="manufacturer_id" class="form-control" required>
                @foreach($manufacturers as $man)
                    <option value="{{ $man->id }}" {{ $medicine->manufacturer_id == $man->id ? 'selected' : '' }}>
                        {{ $man->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>Existing Images</label><br>
            @foreach($medicine->images as $img)
                <img src="{{ asset('storage/'.$img->image) }}" width="60" class="mr-2 mb-2">
            @endforeach
        </div>

        <div class="form-group">
            <label>Add More Images</label>
            <input type="file" name="images[]" class="form-control" multiple>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection

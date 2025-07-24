@extends('layouts.admin')

@section('main-content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Add Medicine</h1>

    <form action="{{ route('admin.medicines.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label>Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Description</label>
            <textarea name="description" class="form-control"></textarea>
        </div>

        <div class="form-group">
            <label>Price</label>
            <input type="number" name="price" step="0.01" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Batch No</label>
            <input type="text" name="batch_no" class="form-control">
        </div>

        <div class="form-group">
            <label>MRP</label>
            <input type="number" step="0.01" name="mrp" class="form-control">
        </div>

        <div class="form-group">
            <label>Unit</label>
            <select name="unit_id" class="form-control" required>
                @foreach($units as $unit)
                    <option value="{{ $unit->id }}">
                        {{ $unit->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>Expiry Date</label>
            <input type="date" name="expiry_date" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Total Stock</label>
            <input type="number" name="total_stock" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Featured</label>
            <select name="is_featured" class="form-control">
                <option value="0">No</option>
                <option value="1">Yes</option>
            </select>
        </div>

        <div class="form-group">
            <label>Category</label>
            <select name="category_id" class="form-control" required>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>Manufacturer</label>
            <select name="manufacturer_id" class="form-control" required>
                @foreach($manufacturers as $man)
                    <option value="{{ $man->id }}">{{ $man->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>Medicine Images (Multiple)</label>
            <input type="file" name="images[]" class="form-control" multiple>
        </div>

        <button type="submit" class="btn btn-primary">Save</button>
    </form>
</div>
@endsection

@extends('layouts.admin')

@section('main-content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Medicines</h1>

    {{-- Success Message --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Filter Section --}}
    <form method="GET" class="form-inline mb-3">
        <input type="text" name="search" class="form-control mr-2" placeholder="Search Name" value="{{ request('search') }}">

        <select name="category_id" class="form-control mr-2">
            <option value="">All Categories</option>
            @foreach($categories as $cat)
                <option value="{{ $cat->id }}" {{ request('category_id') == $cat->id ? 'selected' : '' }}>
                    {{ $cat->name }}
                </option>
            @endforeach
        </select>

        <select name="manufacturer_id" class="form-control mr-2">
            <option value="">All Manufacturers</option>
            @foreach($manufacturers as $man)
                <option value="{{ $man->id }}" {{ request('manufacturer_id') == $man->id ? 'selected' : '' }}>
                    {{ $man->name }}
                </option>
            @endforeach
        </select>

        <select name="is_featured" class="form-control mr-2">
            <option value="">Featured?</option>
            <option value="1" {{ request('is_featured') === '1' ? 'selected' : '' }}>Yes</option>
            <option value="0" {{ request('is_featured') === '0' ? 'selected' : '' }}>No</option>
        </select>

        <button type="submit" class="btn btn-primary">Filter</button>
    </form>

    <div class="d-flex justify-content-between mb-3">
        <a href="{{ route('admin.medicines.create') }}" class="btn btn-success">Add Medicine</a>

        {{-- Excel Import Form --}}
        <form action="{{ route('admin.medicines.import') }}" method="POST" enctype="multipart/form-data" class="form-inline">
            @csrf
            <input type="file" name="file" class="form-control mr-2" required>
            <button type="submit" class="btn btn-info">Import Excel</button>
        </form>
        
    </div>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Category</th>
                <th>Manufacturer</th>
                <th>Price</th>
                <th>Batch No</th>
                <th>MRP</th>
                <th>Stock</th>
                <th>Featured</th>
                <th>Expiry</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($medicines as $medicine)
            <tr>
                <td>{{ $medicine->id }}</td>
                <td>{{ $medicine->name }}</td>
                <td>{{ $medicine->category->name ?? '' }}</td>
                <td>{{ $medicine->manufacturer->name ?? '' }}</td>
                <td>{{ $medicine->price }}</td>
                <td>{{ $medicine->batch_no }}</td>
                <td>{{ $medicine->mrp }}</td>
                <td>{{ $medicine->total_stock }}</td>
                <td>
                    @if($medicine->is_featured)
                        <span class="badge badge-success">Yes</span>
                    @else
                        <span class="badge badge-secondary">No</span>
                    @endif
                </td>
                <td>{{ $medicine->expiry_date }}</td>
                <td>
                    <a href="{{ route('admin.medicines.edit', $medicine->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('admin.medicines.destroy', $medicine->id) }}" method="POST" style="display:inline-block">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this medicine?')">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="8" class="text-center text-muted">No data found</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    {{ $medicines->links() }}
</div>
@endsection

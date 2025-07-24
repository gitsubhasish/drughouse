@extends('layouts.admin')

@section('main-content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Manufacturers</h1>
    <a href="{{ route('admin.manufacturers.create') }}" class="btn btn-primary mb-3">Add Manufacturer</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Image</th>
                <th>Name</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($manufacturers as $manufacturer)
            <tr>
                <td>{{ $manufacturer->id }}</td>
                <td>
                    @if($manufacturer->image)
                        <img src="{{ asset('storage/'.$manufacturer->image) }}" width="50">
                    @endif
                </td>
                <td>{{ $manufacturer->name }}</td>
                <td>{{ $manufacturer->description }}</td>
                <td>
                    <a href="{{ route('admin.manufacturers.edit', $manufacturer->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('admin.manufacturers.destroy', $manufacturer->id) }}" method="POST" style="display:inline-block">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Delete this manufacturer?')">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center text-muted">No data found</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    {{ $manufacturers->links() }}
</div>
@endsection

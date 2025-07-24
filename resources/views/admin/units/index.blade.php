@extends('layouts.admin')

@section('main-content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Units</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('admin.units.create') }}" class="btn btn-primary mb-3">Add New Unit</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($units as $unit)
            <tr>
                <td>{{ $unit->id }}</td>
                <td>{{ $unit->name }}</td>
                <td>
                    <a href="{{ route('admin.units.edit', $unit->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('admin.units.destroy', $unit->id) }}" method="POST" style="display:inline-block">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Delete this unit?')">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="3" class="text-center text-muted">No data found</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    {{ $units->links() }}
</div>
@endsection

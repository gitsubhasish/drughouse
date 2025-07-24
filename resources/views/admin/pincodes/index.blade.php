@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Pincodes</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('admin.pincodes.create') }}" class="btn btn-primary mb-3">Add New Pincode</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Pincode</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($pincodes as $pincode)
            <tr>
                <td>{{ $pincode->id }}</td>
                <td>{{ $pincode->pincode }}</td>
                <td>
                    <a href="{{ route('admin.pincodes.edit', $pincode->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('admin.pincodes.destroy', $pincode->id) }}" method="POST" style="display:inline-block">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Delete this pincode?')">Delete</button>
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

    {{ $pincodes->links() }}
</div>
@endsection

@extends('layouts.admin')

@section('main-content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Add New Unit</h1>

    <form action="{{ route('admin.units.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label>Unit Name</label>
            <input type="text" name="name" class="form-control" required>
            @error('name')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
        <a href="{{ route('admin.units.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection

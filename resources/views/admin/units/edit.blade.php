@extends('layouts.admin')

@section('main-content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Edit Unit</h1>

    <form action="{{ route('admin.units.update', $unit->id) }}" method="POST">
        @csrf @method('PUT')
        <div class="form-group">
            <label>Unit Name</label>
            <input type="text" name="name" class="form-control" value="{{ $unit->name }}" required>
            @error('name')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('admin.units.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection

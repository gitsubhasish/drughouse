@extends('layouts.admin')

@section('main-content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Add New Pincode</h1>

    <form action="{{ route('admin.pincodes.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label>Pincode</label>
            <input type="text" name="pincode" class="form-control" required>
            @error('pincode')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
        <a href="{{ route('admin.pincodes.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection

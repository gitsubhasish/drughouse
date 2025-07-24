@extends('layouts.admin')

@section('main-content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Edit Pincode</h1>

    <form action="{{ route('admin.pincodes.update', $pincode->id) }}" method="POST">
        @csrf @method('PUT')
        <div class="form-group">
            <label>Pincode</label>
            <input type="text" name="pincode" class="form-control" value="{{ $pincode->pincode }}" required>
            @error('pincode')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('admin.pincodes.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection

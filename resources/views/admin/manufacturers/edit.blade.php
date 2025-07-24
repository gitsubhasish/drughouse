@extends('layouts.admin')

@section('main-content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Edit Manufacturer</h1>

    <form action="{{ route('admin.manufacturers.update', $manufacturer->id) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')
        <div class="form-group">
            <label>Name</label>
            <input type="text" name="name" value="{{ $manufacturer->name }}" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Description</label>
            <textarea name="description" class="form-control">{{ $manufacturer->description }}</textarea>
        </div>
        <div class="form-group">
            <label>Image</label><br>
            @if($manufacturer->image)
                <img src="{{ asset('storage/'.$manufacturer->image) }}" width="50" class="mb-2">
            @endif
            <input type="file" name="image" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection

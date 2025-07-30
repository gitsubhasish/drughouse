@extends('layouts.frontend')

@section('content')
<div class="site-section">
  <div class="container">
    <h2>Register</h2>
    <form method="POST" action="{{ route('frontend.register.submit') }}">
      @csrf
      <input type="hidden" name="redirect_to" value="{{ $redirectTo }}">

      <div class="form-group">
        <label>First Name</label>
        <input type="text" name="first_name" required class="form-control" value="{{ old('first_name') }}">
      </div>

      <div class="form-group">
        <label>Last Name</label>
        <input type="text" name="last_name" required class="form-control" value="{{ old('last_name') }}">
      </div>

      <div class="form-group">
        <label>Email</label>
        <input type="email" name="email" required class="form-control" value="{{ old('email') }}">
      </div>

      <div class="form-group">
        <label>Phone</label>
        <input type="text" name="phone" required class="form-control" value="{{ old('phone') }}">
      </div>

      <div class="form-group">
        <label>Password</label>
        <input type="password" name="password" required class="form-control">
      </div>

      <div class="form-group">
        <label>Confirm Password</label>
        <input type="password" name="password_confirmation" required class="form-control">
      </div>

      <button type="submit" class="btn btn-primary mt-2">Register</button>

      <p class="mt-3">Already have an account?
        <a href="{{ route('frontend-login', ['redirect_to' => $redirectTo]) }}">Login here</a>
      </p>
    </form>
  </div>
</div>
@endsection

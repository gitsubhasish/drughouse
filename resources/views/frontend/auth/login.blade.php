@extends('layouts.frontend')

@section('content')
<div class="site-section">
  <div class="container">
    <h2>Login</h2>
    <form method="POST" action="{{ route('frontend.login.submit') }}">
      @csrf
      <input type="hidden" name="redirect_to" value="{{ $redirectTo }}">

      <div class="form-group">
        <label>Email</label>
        <input type="email" name="email" required class="form-control" value="{{ old('email') }}">
      </div>

      <div class="form-group">
        <label>Password</label>
        <input type="password" name="password" required class="form-control">
      </div>

      <button type="submit" class="btn btn-primary mt-2">Login</button>

      <p class="mt-3">Don't have an account?
        <a href="{{ route('frontend.register', ['redirect_to' => $redirectTo]) }}">Register here</a>
      </p>
    </form>
  </div>
</div>
@endsection

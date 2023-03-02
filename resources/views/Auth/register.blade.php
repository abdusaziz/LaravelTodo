@extends('layouts.app')
@section('contents')
<div class="col-md-4 offset-md-4">
    <div class="card form-holder">
<div class="card-body">
 {{-- @if(Session::has('error'))
    {{ Session::get('error') }}
  @endif --}}
  @if(Session::has('error'))
    {{ Session::get('error') }}
@endif
    <h1>Register</h1>
    <form action="{{ route('register') }}" method="post">
      @csrf
      <div class="form-group">
        <label>Username</label>
        <input type="text" name="name" class="form-control" placeholder="Username" value="{{ old('name') }}"/>
        @error("username")
          {{ $message }}
        @enderror
      </div>
      <div class="form-group">
        <label>Email</label>
        <input type="email" name="email" class="form-control" placeholder="Email" value="{{ old('email') }}"/>
        @error("email")
          {{ $message }}
        @enderror
      </div>
      <div class="form-group">
        <label>Password</label>
        <input type="password" name="password" class="form-control" placeholder="Password"/>
        @error("password")
          {{ $message }}
        @enderror
      </div>
      <div class="form-group">
        <label>Confirm Password</label>
        <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm Password"/>
        @error("password_confirmation")
        {{ $message }}
      @enderror
      </div>
      <div class="row">
        <div class="col-8 text-left">
          <a href="#" class="btn btn-link">Forgot Password</a>
        </div>
        <div class="col-4 text-right">
          <input type="submit" class="btn btn-primary" value=" Login " />
        </div>
      </div>
    </form>
      </div>
    </div>
  </div>
@endsection
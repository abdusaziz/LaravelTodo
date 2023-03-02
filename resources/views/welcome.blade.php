@extends('layouts.app')
@section('contents')
<div class="jumbotron mt-5">
  @if(Session::has('success'))
    {{ Session::get('success') }}
@endif
    <h1 class="display-4">Hello, {{ Auth::user()->name ?? 'World!' }}</h1>
    <p class="lead">This is a simple Todo App.</p>
    <hr class="my-4">
    <p>You may use it to make todo list & every todo list have seperate task list.</p>
    <p class="lead">
      <a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a>
    </p>
  </div>
@endsection
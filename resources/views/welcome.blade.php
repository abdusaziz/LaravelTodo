@extends('layouts.app')
@section('content')
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
    <div class="h-100 p-5 text-white bg-dark rounded-3 shadow">
        <h1 class="display-4">Hello, {{ Auth::user()->name ?? 'Guest!' }}</h1>
        <p>{{ __('You are logged in!') }} You may use it to make todo list & every todo list have seperate task list.</p>
        <a href="{{ route('todo.index') }}" class="btn btn-outline-light" type="button">Todo Page</a>
    </div>
@endsection

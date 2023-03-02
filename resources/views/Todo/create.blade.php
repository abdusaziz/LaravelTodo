@extends('layouts.app')
@section('contents')
<a href="{{ route("todo.index") }}" class="btn btn-success">&larr; Home</a>
    <!-- form card login -->
    <div class="row">
        <div class="col-md-6 pt-5 offset-md-3">
            <div class="card card-outline-secondary">
                <div class="card-header">
                    <h3 class="mb-0">New Product</h3>
                </div>
                <div class="card-body">
                    <form autocomplete="off" class="form" id="formLogin" action="{{ route("todo.store") }}" method="POST" role="form">
                        @csrf

                        <div class="form-group">
                            <label for="uname1">Name</label>
                            <input class="form-control" id="name" name="name" required="" type="text" value="{{ old("name") }}">
                            @error("name")
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>price</label>
                            <input class="form-control" id="price" required="" name="price" type="number"  value="{{ old("price") }}">
                            @error("price")
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <input class="form-control" id="description" name="description" type="text" value="{{ old("description") }}">
                            @error("description")
                                {{ $message }}
                            @enderror
                        </div>
                        <button class="btn btn-success btn-lg float-right" type="submit">Submit</button>
                    </form>
                </div>
                <!--/card-block-->
            </div><!-- /form card login -->
        </div>
    </div>
@endsection
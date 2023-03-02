@extends('layouts.app')

@section('contents')
<div class="col-md-4 offset-md-4">
    <div class="card form-holder">
        <div class="card-body">
            <h1>Login</h1>
            @if (Session::has('error'))
                <span>
                    {{ Session::get('error') }}
                </span>
            @endif
            <form action="" method="post" autocomplete="off">
                @csrf
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" name="email" class="form-control" placeholder="Email"
                        value="{{ old('email') }}" />
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Password" value=""
                        role="presentation" autocomplete="none" />
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
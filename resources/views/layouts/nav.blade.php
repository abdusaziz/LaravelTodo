@if (Request::is('login') || Request::is('register'))

@else
<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
    <div class="container">
        <a class="navbar-brand" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto nav-pills">
                @auth
                <li class="nav-item">                    
                    <a class="nav-link {{ request()->is('/')?'active':'' }}" href="{{ route('home') }}">Home</a>
                </li>
                <li class="nav-item">                    
                    <a class="nav-link {{ request()->is('todo*')?'active':'' }}" href="{{ route('todo.index') }}">Todo</a>
                </li>
                @endauth
            </ul>
            <div class="form-inline my-2 my-lg-0">
                @if (Route::has('login'))
                    @auth
                    <span class="mr-2">User: {{ Auth::user()->name }} </span>

                    <a class="btn btn-success" href="{{ route('logout') }}">Logout</a>
                    @else
                    <a class="btn btn-primary mr-2" href="{{ route('login') }}">Login</a>
                    <a class="btn btn-success" href="{{ route('register') }}">Register</a>
                    @endauth
                
                    @endif
            </div>
        </div>
    </div>

</nav>
@endif


<head>
    <link rel='stylesheet' href="{{asset('css/nav.css')}}">
</head>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow">
    <div class="container">

        <a class="navbar-brand fw-bold" href="{{route('home')}}">
            Cilantro
        </a>

        <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbar">

            <ul class="navbar-nav me-auto">

                <li class="nav-item">
                    @if(Route::currentRouteName() == 'home')
                        <a class="nav-link  active" href="{{route('home')}}">Home</a>
                    @else
                        <a class="nav-link " href="{{route('home')}}">Home</a>
                    @endif
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#">Products</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#">Categories</a>
                </li>

                <li class="nav-item">
                    @if(Route::currentRouteName() == 'contact')
                        <a class="nav-link  active" href="{{route('contact')}}">Contact</a>
                    @else
                        <a class="nav-link" href="{{route('contact')}}">Contact</a>
                    @endif
                </li>

            </ul>

            <form class="d-flex me-3">
                <input class="form-control" placeholder="Search products...">
            </form>
            <form action="{{ route('cart.index') }}" method="GET" class="d-inline">
                    @csrf
                    <button class="btn btn-outline-light me-2">
                        Cart
                    </button>
            </form>
            
            
            @auth
                <div class="user-menu">
                    <span class="user-name">
                        👋 {{ Auth::user()->name }}
                    </span>

                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-outline-warning btn-sm">
                            Logout
                        </button>
                    </form>
                </div>
            @else
            <a href="{{ route('login') }}" class="btn btn-warning">
                Login
            </a>
            <a href="{{ route('register') }}" class="btn btn-warning" style="margin-left:5px">
                Register
            </a>
            @endauth

        </div>

    </div>
</nav>
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
    <a class="navbar-brand brand" href="{{ url('/') }}">
        {{ $title ?? 'My Carnivlora' }}
    </a>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#nav">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="nav">
        <ul class="navbar-nav ml-auto">

            @guest
                <li class="nav-item mr-2 d-flex align-items-center">
                    <a class="btn btn-primary btn-sm" href="{{ route('login') }}">Login</a>
                </li>
            @else
                <li class="nav-item dropdown mr-2">
                    <a class="nav-link dropdown-toggle btn btn-success btn-sm text-white" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Hello, {{ auth()->user()->name }}
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                        @if(auth()->user()->role === 'admin') <!-- Check if user role is 'admin' -->
                            <a class="dropdown-item" href="{{ route('admin') }}">Admin Panel</a> <!-- Admin Panel link -->
                        @endif
                        <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Logout
                        </a>
                        <form id="logout-form" method="POST" action="{{ route('logout') }}" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
            @endguest

            <li class="nav-item"><a class="nav-link" href="{{ url('/') }}">Home</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ url('/store') }}">Store</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ url('/guide') }}">Guide</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ url('/blog') }}">Blog</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ url('/about') }}">About Us</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ url('/profile') }}">Profile</a></li>
        </ul>
    </div>
</nav>

<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
    <a class="navbar-brand brand" href="{{ url('/') }}">
        {{ $title ?? 'My Carnivlora' }}
    </a>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#nav">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="nav">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item"><a class="nav-link" href="{{ url('/') }}">Home</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ url('/store') }}">Store</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ url('/guide') }}">Guide</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ url('/about') }}">About Us</a></li>
        </ul>
    </div>
</nav>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - @yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="d-flex">
        <!-- Sidebar -->
        <nav class="bg-light p-3" style="width: 250px; height: 100vh;">
            <h4>Admin Panel</h4>
            <ul class="nav flex-column mt-3">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('users.index') }}">Users</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('categories.index') }}">Categories</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('plants.index') }}">Plants</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('sales.index') }}">Sales</a>
                </li>
                <li class="nav-item mr-2">
                <a class="btn btn-primary btn-sm" href="{{ route('home') }}">Homepage</a>
                </li>
                
                <!-- Add more links for other tables -->
            </ul>
        </nav>

        <!-- Main Content -->
        <main class="grow p-4">
            <h2 class="mb-4">@yield('title')</h2>

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @yield('content')
        </main>
    </div>
</body>
</html>

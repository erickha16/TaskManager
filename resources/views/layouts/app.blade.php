<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <title>@yield('title')</title>
</head>
<body>
    @if(Auth::check())
    <nav>
        <ul>
            <li><a href="{{ route('welcome') }}">Home</a></li>
            <li>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit">Logout</button>
                </form>
            </li>
        </ul>
    </nav>
    @endif
    @if(Auth::check())
        <h1>Welcome, {{ Auth::user()->name }}!</h1>
    @endif
        
    @yield('content')
    @yield('scripts')
</body>
</html>
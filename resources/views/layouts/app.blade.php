<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
</head>
<body>
    <nav>
        <ul>
            <li><a href="{{ route('welcome') }}">Home</a></li>
            @if(Auth::check())
            <li>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit">Logout</button>
                </form>
            </li>
            @endif
        </ul>
    </nav>
    @if(Auth::check())
        <h1>Welcome, {{ Auth::user()->name }}!</h1>
        @else
        <h1>Please <a href="{{ route('login') }}">Log in</a></h1>
    @endif
        
    @yield('content')
    @yield('scripts')
</body>
</html>
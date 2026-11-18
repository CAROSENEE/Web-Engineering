<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Student Result Portal')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
<header class="topbar"><a class="brand" href="{{ route('students.index') }}">Result<span>Portal</span></a><nav aria-label="Main navigation">
    @auth <a href="{{ route('students.index') }}">Students</a><span class="user">{{ auth()->user()->name }}</span><form method="POST" action="{{ route('logout') }}">@csrf<button class="link-button">Sign out</button></form>
    @else <a href="{{ route('login') }}">Sign in</a> @endauth
</nav></header>
<main class="container">
    @if(session('success')) <div class="flash" role="status">{{ session('success') }}</div> @endif
    @yield('content')
</main>
<footer class="footer">Student Result Portal · Web Engineering Lab</footer>
</body>
</html>

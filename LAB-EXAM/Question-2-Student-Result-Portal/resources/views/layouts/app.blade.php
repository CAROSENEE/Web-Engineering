<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Student Result Portal')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/pagination.css') }}">
</head>
<body>
<header class="topbar"><a class="brand" href="{{ route('students.index') }}"><span class="brand-mark">R</span><span class="brand-copy">Campus<span>Results</span><small>STUDENT INFORMATION SYSTEM</small></span></a><nav aria-label="Main navigation">
    @auth <a class="nav-active" href="{{ route('students.index') }}">Dashboard</a><a href="{{ route('students.index') }}#student-directory">Students</a><a href="{{ route('students.index') }}#recent-results">Results</a><span class="nav-divider"></span><span class="user-avatar">{{ \Illuminate\Support\Str::upper(\Illuminate\Support\Str::substr(auth()->user()->name, 0, 1)) }}</span><span class="user">{{ auth()->user()->name }}</span><form method="POST" action="{{ route('logout') }}">@csrf<button class="link-button">Sign out</button></form>
    @else <a href="{{ route('login') }}">Sign in</a> @endauth
</nav></header>
<main class="container">
    @if(session('success')) <div class="flash" role="status">{{ session('success') }}</div> @endif
    @yield('content')
</main>
<footer class="footer">Student Result Portal · Web Engineering Lab</footer>
</body>
</html>

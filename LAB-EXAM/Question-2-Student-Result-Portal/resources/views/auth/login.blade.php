@extends('layouts.app')
@section('title', 'Sign in · Result Portal')
@section('content')
<section class="auth-card"><p class="eyebrow">Secure access</p><h1>Sign in</h1><p class="muted">Use your portal account to manage students and results.</p>
    <form method="POST" action="{{ route('login.store') }}">@csrf
        <label for="email">Email</label><input id="email" name="email" type="email" value="{{ old('email') }}" required autofocus autocomplete="username">@error('email')<p class="error">{{ $message }}</p>@enderror
        <label for="password">Password</label><input id="password" name="password" type="password" required autocomplete="current-password">@error('password')<p class="error">{{ $message }}</p>@enderror
        <label class="check"><input type="checkbox" name="remember"> Remember me</label><button class="button primary full">Sign in</button>
    </form><p class="muted small">Create a portal account with <code>php artisan portal:user</code>.</p>
</section>
@endsection

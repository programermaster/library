<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Bostadsväljare - Admin Dashboard</title>

    <link href="https://fonts.googleapis.com/css?family=Poppins:400,500,700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
</head>
<body>
<form class="loginForm" method="POST" action="{{ route('login') }}">
    <h2>Login Into Admin Dashboard</h2>
    <div class="headingDivider"></div>
    @csrf
    <label class="loginLabel" for="email">Email</label>
    <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="email">
    <label class="loginLabel" for="password">Password</label>
    <input id="password" type="password" name="password" required autocomplete="current-password">

    <div class="inputGroup">
        <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
        <label for="remember">
            {{ __('Remember Me') }}
        </label>
    </div>

    <button class="formSubmit" type="submit">
        {{ __('Login') }}
    </button>

    @if (Route::has('password.request'))
        <a class="formLink" href="{{ route('password.request') }}">
            {{ __('Forgot Your Password?') }}
        </a>
    @endif
</form>
</body>
</html>

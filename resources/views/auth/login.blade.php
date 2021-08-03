@extends('layouts.app')

@section('content')
    <h1>{{ __('Login') }}</h1>
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <label for="email">{{ __('e-mail:') }}</label>
        <input id="email" type="email" class="@error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
        @error('email')
            <strong>{{ $message }}</strong>
        @enderror
        <label for="password">{{ __('Password') }}</label>
        <input id="password" type="password" class="@error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
        @error('password')
            <strong>{{ $message }}</strong>
        @enderror
        <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
        <label for="remember">
            {{ __('Remember Me') }}
        </label>
        <input type="submit" value="{{ __('Login') }}">
{{--        @if (Route::has('password.request'))
            <a class="btn btn-link" href="{{ route('password.request') }}">
                {{ __('Forgot Your Password?') }}
            </a>
        @endif--}}
    </form>
@endsection
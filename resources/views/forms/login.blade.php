<form action="{{ route('login') }}" method="post">
    @csrf
    <input type="email" name="email" autocomplete="email">
    <input type="password" name="password">
    <input type="submit" value="{{ __('Login') }}">
</form>
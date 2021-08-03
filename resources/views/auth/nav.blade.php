@guest
    <li><a href="{{ route('login') }}">{{ __('Login') }}</a></li>
    @if (Route::has('register'))
        <li><a href="{{ route('register') }}">{{ __('Register') }}</a></li>
    @endif
@else
    <li><a href="{{ route('user.cart') }}">{{ __('Cart') }} (<b>{{ Auth::user()->items()->count() }}</b>)</a></li>
    @admin
        <li><a href="{{ route('admin.page') }}">{{ __('Admin page') }}</a></li>
    @endadmin
    <li>
        <a href="{{ route('user.profile') }}">
            <img src="/storage/images/users/{{ Auth::user()->image_name ? Auth::user()->image_name : 'placeholder.png' }}" width="36" style="vertical-align: middle">
            {{ __('Me') }} ({{ Auth::user()->name }})
        </a>
    </li>
    <li>
        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </li>
@endguest
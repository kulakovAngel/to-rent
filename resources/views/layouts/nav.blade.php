<nav>
    <a href="{{ route('home') }}">
        {{ config('app.name') }}
    </a>
    <ul>
        <li><a href="{{ route('home') }}">{{ __('Home')}}</a></li>
        <li>
            <a href="{{ route('store') }}">{{ __('Fitness equipment')}}</a>
            <ul>
                @foreach(config('nav.categories') as $slug => $nav_item)
                    <li><a href="{{ route('store') . '/' . $slug }}">{{ $nav_item }}</a></li>
                @endforeach
            </ul>
        </li>
        <li><a href="{{ route('about') }}">{{ __('About')}}</a></li>
        @include('auth.nav')
    </ul>
</nav>
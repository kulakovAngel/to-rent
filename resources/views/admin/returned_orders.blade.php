<section>
    <h2>{{ __('Returned (achived) orders:') }}</h2>
    @if (count($items))
        <ul>
            @foreach ($items as $item)
                @foreach ($item->usersReturned as $user)
                    <li>
                        <img src="/storage/images/{{ $item->image_name ? $item->image_name : 'placeholder.png' }}" width="50">
                        {{ $item->title }}
                        
                        {{ $user->orders->ordered_at }}
                    </li>
                @endforeach
            @endforeach
        </ul>
    @else
        <b>{{ __('No returned (achived) orders yet.') }}</b>
    @endif
</section>
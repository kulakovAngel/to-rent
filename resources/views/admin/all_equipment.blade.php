<section>
    <h2>{{ __('All fitness equipment') }}</h2>
    @foreach ($items as $item)
        <li>
            <img src="storage/images/{{ $item->image_name }}" width="50">
            <b>{{ $item->title }}</b> ordered by
            @if(count($item->users))
                @foreach ($item->users as $user)
                    <b>{{ $user->name }}@if (!$loop->last), @endif</b>
                @endforeach
            @else
                <b>nobody...</b>
            @endif
            (Left: {{ $item->rest }})
        </li>
    @endforeach
</section>
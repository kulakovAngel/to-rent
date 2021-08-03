<section>
    <h2>{{ __('Raw orders:') }}</h2>
    @if (count($users_with_orders))
        <ul>
            @foreach ($users_with_orders as $user)
                <li>
                    <h3>{{ $user->name }}:</h3>
                    <ul>
                        @foreach ($user->items as $item)
                            @if (!$item->orders->is_confirmed)
                                <li>
                                    <img src="/storage/images/{{ $item->image_name ? $item->image_name : 'placeholder.png' }}" width="50">
                                    {{ $item->title }}
                                    {{ $item->orders->is_confirmed ? 'confirmed' : 'pending' }}
                                    <form action="{{ route('admin.confirme_order') }}" method="post">
                                        @csrf
                                        @method('put')
                                        <input type="hidden" name="item_id" value="{{ $item->id }}">
                                        <input type="hidden" name="user_id" value="{{ $user->id }}">
                                        <input type="submit" value="{{ __('Confirme') }}">
                                    </form>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </li>
            @endforeach
        </ul>
    @else
        <b>{{ __('No raw orders now.') }}</b>
    @endif
</section>
<section>
    <h2>{{ __('Debtors:') }}</h2>
    @if (count($debtors))
        <ul>
            @foreach ($debtors as $user)
                <li>
                    <h3>{{ $user->name }}:</h3>
                    <ul>
                        @foreach ($user->items as $item)
                            @if ($item->orders->must_return_at <= \Carbon\Carbon::now())
                                <li>
                                    <img src="/storage/images/{{ $item->image_name ? $item->image_name : 'placeholder.png' }}" width="50">
                                    {{ $item->title }}
                                    {{ $item->orders->is_confirmed ? 'confirmed' : 'pending' }}
                                    <span style="color: {{ \Carbon\Carbon::create($item->orders->must_return_at) < \Carbon\Carbon::now()->subDay() ? 'red' : 'green' }}">
                                        {{ $item->orders->must_return_at }}
                                    </span>
                                    <form action="{{ route('admin.return_order') }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <input type="hidden" name="item_id" value="{{ $item->id }}">
                                        <input type="hidden" name="user_id" value="{{ $user->id }}">
                                        <input type="submit" value="{{ __('Returned') }}">
                                    </form>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </li>
            @endforeach
        </ul>
    @else
        <b>{{ __('No debtors now.') }}</b>
    @endif
</section>
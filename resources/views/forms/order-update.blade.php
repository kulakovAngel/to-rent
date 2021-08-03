@if(!$item->orders->is_confirmed)
    <form action="{{ route('order.cancel') }}" method="post">
      @csrf
      @method('delete')
      <input type="hidden" name="item_id" value="{{ $item->id }}">
      <input type="submit" value="{{ __('Cancell') }}">
    </form>
    
    <form action="{{ route('order.update') }}" method="post">
        @csrf
        @method('put')
        <input type="hidden" name="id" value="{{ $item->id }}">
        <input
            type="number"
            name="quantity"
            value="{{ Auth::user()->items()->find($item->id)->orders->quantity }}"
            min=1
            max={{ Auth::user()->items()->find($item->id)->orders->quantity + $item->rest }}
        >
        <input
            type="date"
            name="date"
            value="{{ \Carbon\Carbon::create($item->orders->must_return_at)->toDateString() }}"
            min="{{ \Carbon\Carbon::now()->addDays(config('consts.order_date_min_inc', '1'))->toDateString() }}"
            max="{{ \Carbon\Carbon::now()->addDays(config('consts.order_date_max_inc', '30'))->toDateString() }}" required
        >
        <input type="submit" value="{{ __('Change') }}">
    </form>
@endif
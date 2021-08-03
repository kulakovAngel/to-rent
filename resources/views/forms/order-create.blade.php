@php
    if (Auth::user())
        $is_ordered = Auth::user()->items()->find($item->id);
    else
        $is_ordered = null;
@endphp
<form action="{{ route('order.create') }}" method="post">
    @csrf
    <input type="hidden" name="id" value="{{ $item->id }}">
    <input
        type="date"
        name="date"
        value="{{ $is_ordered ? \Carbon\Carbon::create($is_ordered->orders->must_return_at)->toDateString() : \Carbon\Carbon::now()->addDays(config('consts.order_date_min_inc', '1'))->toDateString() }}"
        min="{{ \Carbon\Carbon::now()->addDays(config('consts.order_date_min_inc', '1'))->toDateString() }}"
        max="{{ \Carbon\Carbon::now()->addDays(config('consts.order_date_max_inc', '30'))->toDateString() }}" required
    >
    <input
        type="submit"
        value="{{ __($is_ordered ? 'Already in cart' : 'Order this')}}"
        {{(!$item->rest || $is_ordered) ? 'disabled' : ''}}
    >
</form>
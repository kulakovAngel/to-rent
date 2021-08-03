<h1>Your order from "{{ config('app.name') }}"</h1>
<h2>Order details:</h2>
<ul>
    <li><img src="{{ $order['img'] }}" width="100">{{ $order['item']->title }}</li>
    <li>Price: {{ $order['item']->price }}BYN/day * {{ $order['days'] }} days = {{ $order['item']->price * $order['days'] }}BYN</li>
    <li>From {{ $order['from'] }} to date: {{ $order['to'] }}</li>
</ul>
{{ $order['user']->name }}, You must <b>pick up the order today.</b>
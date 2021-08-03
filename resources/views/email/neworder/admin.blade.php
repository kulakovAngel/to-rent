<h1>Dear Admin, new order from "{{ config('app.name') }}"</h1>
<h2>Order details:</h2>
<ul>
    <li><img src="{{ $order['img'] }}" width="100">{{ $order['item']->title }}</li>
    <li>Price: {{ $order['item']->price }}BYN/day * {{ $order['days'] }} days = {{ $order['item']->price * $order['days'] }}BYN</li>
    <li>From {{ $order['from'] }} to date: {{ $order['to'] }}</li>
    <li>Customer: {{ $order['user']->name }}, {{ $order['user']->email }}, {{ $order['user']->phone }}</li>
</ul>
{{ $order['admin']->name }}, wait for customer!
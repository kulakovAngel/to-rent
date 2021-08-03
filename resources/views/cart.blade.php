@extends('layouts.app')

@section('content')
    <h1>{{ __('Cart') }}</h1>
    @if(count($items))
        <ul>
            @foreach ($items as $item)
                <li>
                    <div>
                        <img src="/storage/images/{{ $item->image_name ? $item->image_name : 'placeholder.png' }}" width="50">
                    </div>
                    <div>{{ $item->title }}</div>
                    <div>{{ __('Status') }}: {!! $item->orders->is_confirmed ? '<b style="color: green">confirmed</b>' : '<b style="color: red">pending</b>' !!}</div>
                    @include('forms.order-update')
                </li>
            @endforeach
        </ul>
    @else
        <b>{{ __('You haven\'t any ordered equipment yet.') }}</b>
    @endif
@endsection
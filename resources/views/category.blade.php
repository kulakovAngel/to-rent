@extends('layouts.app')

@section('content')
    <h1>{{ $category->title }}</h1>
    @if(count($items))
        <ul>
            @foreach ($items as $item)
                <li>
                    <a href="{{ route('store') . '/' . $category->slug . '/' . $item->slug }}">
                        <img src="/storage/images/{{ $item->image_name ? $item->image_name : 'placeholder.png' }}" width="50">
                        {{ $item->title }} (Left: {{ $item->rest }}) {{ $item->price }}BYN
                    </a>
                    @include('forms.order-create')
                </li>
            @endforeach
        </ul>
    @else
        <b>{{ __('Category is empty.') }}</b>
    @endif
@endsection
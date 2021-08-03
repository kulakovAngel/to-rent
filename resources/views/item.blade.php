@extends('layouts.app')

@section('content')
    <h1>{{ $item->title }}</h1>
    <img src="/storage/images/{{ $item->image_name ? $item->image_name : 'placeholder.png' }}" width="50">
    {{ $item->title }}
    (Left: {{ $item->rest }})
    {{ $item->price }}BYN
    <p style="border: 1px solid">
        {{ $item->description }}
    </p>
    @include('forms.order-create')
@endsection
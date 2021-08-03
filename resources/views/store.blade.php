@extends('layouts.app')

@section('content')
    <h1>Fitness equipment</h1>
    
    <h2>Categories</h2>
    @if(count($categories))
        <ul>
            @foreach ($categories as $category)
                <li>
                    <a href="{{ route('store') . '/' . $category->slug }}">
                        <img src="/storage/images/categories/{{ $category->image_name ? $category->image_name : 'placeholder.png' }}" width="100">
                        {{ $category->title }}
                    </a>
                </li>
            @endforeach
        </ul>
    @else
        There are no categories...
    @endif
    
    <h2>Fitness equipment items</h2>
    @if(count($items))
        <ul>
            @foreach ($items as $item)
                <li>
                    <a href="{{ route('store') . '/' . $item->category->slug . '/' . $item->slug }}">
                        <img src="/storage/images/{{ $item->image_name ? $item->image_name : 'placeholder.png' }}" width="50">
                        {{ $item->title }} (Left: {{ $item->rest }}) {{ $item->price }}BYN
                    </a>
                    @include('forms.order-create')
                </li>
            @endforeach
        </ul>
    @else
        There are no Fitness equipment yet...
    @endif
@endsection
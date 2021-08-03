@extends('layouts.app')

@section('content')
    <h1>{{ $user->name }}</h1>
    <a href="{{ route('user.cart') }}">{{ __('to cart') }}</a>
    @admin
        <a href="{{ route('admin.page') }}">{{ __('to admin page') }}</a>
    @endadmin
    
    <div>
        <img src="/storage/images/users/{{ $user->image_name ? $user->image_name : 'placeholder.png' }}" width="100">
        <form action="{{ route('user.update') }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('put')
            <input type="file" name="image">
            <input type="text" name="name" value="{{ $user->name }}">
            <input type="text" name="email" value="{{ $user->email }}">
            <input type="tel" name="phone" value="{{ $user->phone }}">
            <input type="submit" name="submit" value="{{ __('Change profile data') }}">
        </form>
        {{ __('Role: ') }} {{ $user->role }}
    </div>
@endsection
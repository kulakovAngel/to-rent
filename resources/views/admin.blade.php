@extends('layouts.app')

@section('content')
    <h1>{{ __('Admin page') }}</h1>
    <section>
        <h2>{{ __('Add fitness equipment') }}</h2>
        <form action="{{ route('items.create') }}" method="post" enctype="multipart/form-data">
            @csrf
            <select name="category_id" required>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->title }}</option>
                @endforeach
            </select>
            <input type="text" name="title" placeholder="Title" c>
            <textarea name="description" placeholder="Description"></textarea>
            <input type="text" name="total_amount" placeholder="Total amount" required>
            <input type="number" name="price" placeholder="Price" required>
            <input type="file" name="image">
            <input type="submit">
        </form>
    </section> 
    @include('admin.returned_orders')
    @include('admin.debtors')
    @include('admin.raw_orders')
    @include('admin.all_equipment')
@endsection

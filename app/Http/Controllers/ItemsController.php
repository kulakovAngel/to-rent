<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ItemsController extends Controller {
    public function __construct() {
        $this->middleware('auth')->except('getAll');
    }

    public function getAll() {
        return view('store', [
            'items' => \App\Item::all(),
        ]);
    }
    
    public function getOne(\App\Category $category, \App\Item $item) {
        return view('item', [
            'item' => $item,
        ]);
    }
    
    public function create(Request $request) {
        $this->validate($request, [
            'category_id' => 'required',
            'title' => 'required|unique:items|max:255|min:4',
            'description' => 'max:255|min:4',
            'total_amount' => 'required|numeric',
            'image' => 'image|mimes:jpeg,png|max:1024',
            'price' => 'required|numeric',
        ]);
        
        $img_title = null;
        if ($request->image) {
            $img_title = "{$request->title}.{$request->image->extension()}";
            $path = $request->image->storeAs('public/images', $img_title);
        }
        
        \App\Item::insert([
            'category_id' => $request->category_id,
            'title' => $request->title,
            'description' => $request->description,
            'image_name' => $img_title,
            'total_amount' => $request->total_amount,
            'price' => $request->price,
        ]);
        return redirect()->route('admin.page')->with(['message'=>'Успешно добавлено!', 'type'=>'success']);
    }
}

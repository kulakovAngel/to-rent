<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoriesController extends Controller {
    public function index(\App\Category $category) {
//        dd($category);
        return view('category', [
            'items' => $category->items->all(),
            'category' => $category,
        ]);
    }
}
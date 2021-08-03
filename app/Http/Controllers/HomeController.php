<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller {
    public function index() {
        return view('welcome');
    }

    public function store() {
        return view('store', [
            'items' => \App\Item::all(),
            'categories' => \App\Category::all(),
        ]);
    }
    
    public function about() {
        return view('about');
    }
}

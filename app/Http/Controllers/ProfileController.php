<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller {
    public function __construct() {
        $this->middleware('auth');
    }

    public function index(Request $request) {
        return view('profile', [
            'user' => $request->user(), //Auth::user()
        ]);
    }
    
    public function renderCart(Request $request) {
        return view('cart', [
            'items' => $request->user()->items()->get(),
        ]);
    }
    
    public function update(Request $request) {
        $this->validate($request, [
            'name' => 'required|string|max:255|min:3',
            'image' => 'image|mimes:jpeg,png|max:1024',
            'email' => 'required|string|email|max:255|unique:users,email,' . $request->user()->id,
            'phone' => 'nullable|string|max:55|unique:users,phone,' . $request->user()->id,
        ]);
        
//        $validate = \Validator::make($request->all(), [
//            'email' => ['required', \Illuminate\Validation\Rule::unique('users')->ignore($request->user()->id),],
//        ]);
//        if ($validate->fails()) return back()->withErrors($validate);
        
        $img_title = $request->user()->image_name;
        
        if ($request->image) {
            $img_title = "{$request->user()->email}.{$request->image->extension()}";
            $path = $request->image->storeAs('public/images/users', $img_title);
        }
        $request->user()->update([
            'name' => $request->name,
            'image_name' => $img_title,
            'email' => $request->email,
            'phone' => $request->phone,
        ]);
        
        return back()->with(['message'=>'Профиль изменен', 'type'=>'success']);
    }
}
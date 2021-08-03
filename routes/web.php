<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('/to-rent', 'HomeController@store')->name('store');
Route::get('/to-rent/{category:slug}', 'CategoriesController@index')->name('categories');
Route::get('/to-rent/{category:slug}/{item:slug}', 'ItemsController@getOne')->name('getOneItem');
Route::get('/about', 'HomeController@about')->name('about');

Route::name('user.')
    ->prefix('/me')
    ->middleware('auth')
    ->group(function() {
        Route::get('/', 'ProfileController@index')->name('profile');
        Route::get('/cart', 'ProfileController@renderCart')->name('cart');
        Route::put('/', 'ProfileController@update')->name('update');
});

Route::name('admin.')
    ->middleware('App\Http\Middleware\CheckRoleIsAdmin')
    ->prefix('/admin')
    ->group(function() {
        Route::get('/', function() {
            return view('admin', [
                'items' => \App\Item::all(),
                'categories' => \App\Category::all(),
                'users_with_orders' => \App\User::whereHas('items', function($query) {
                    $query->where('is_confirmed', 'false');
                })->get(),
                'debtors' => \App\User::whereHas('items', function($query) {
                    $query->where('must_return_at', '<=', \Carbon\Carbon::now());
                })->get(),
            ]);
        })->name('page');
        Route::put('/confirme_order', 'OrdersController@confirme')->name('confirme_order');
        Route::delete('/return_order', 'OrdersController@returned')->name('return_order');
});

Route::name('items.')
    ->prefix('/items')
    ->group(function() {
        Route::post('/', 'ItemsController@create')->name('create');
});

Route::name('order.')
    ->prefix('/orders')
    ->group(function() {
        Route::middleware('throttle:1500,1440')->post('/', 'OrdersController@create')->name('create');
        Route::delete('/', 'OrdersController@cancel')->name('cancel');
        Route::put('/', 'OrdersController@update')->name('update');
});

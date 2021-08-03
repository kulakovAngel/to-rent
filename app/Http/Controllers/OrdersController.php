<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class OrdersController extends Controller {
    public function __construct() {
        $this->middleware('auth');
    }
    
    public function create(Request $request) {
        $this->validate($request, [
            'date' => 'required|date',
        ]);
        
        $item = \App\Item::find($request->id);
        if ($item->rest) {
            $item->users()->attach($request->user(), [ //$request->user()->id
                'ordered_at' => Carbon::now(),
                'must_return_at' => Carbon::create($request->date),
            ]);
//            return (new \App\Mail\NewOrder([
//                'item' => $item,
//                'user'=> $request->user(),
//            ]))->render();
            
            Mail::to($request->user())->send(new \App\Mail\NewOrder([
                'item' => $item,
                'user' => $request->user(),
            ]));
            
            Mail::to(\App\User::where('role', 'admin')->get())->send(new \App\Mail\NewOrderToAdmin([
                'item' => $item,
                'user' => $request->user(),
                'admin' => \App\User::where('role', 'admin')->first(),
            ]));
            
            return redirect()->route('store')->with(['message'=>'Успешно забронировано!', 'type'=>'success']);
        }
        
        
        
//        Mail::to($request->user())->queue(new OrderShipped($order));//https://laravel.com/docs/7.x/queues
        return redirect()
            ->route('store')
            ->with([
                'message'=>'Нельзя забронировать, так как нет в наличии!!',
                'type'=>'error'
            ]);
    }
    
    public function confirme(Request $request) {
        $user = \App\User::find($request->user_id);
        $user->items()->updateExistingPivot($request->item_id, [
            'is_confirmed' => true,
        ]);
        return back()->with(['message'=>'Заказ подтвержден', 'type'=>'info']);
    }
    
    public function cancel(Request $request) {
        $request->user()->items()->detach($request->item_id);
        return back()->with(['message'=>'Заказ отменен', 'type'=>'success']);
    }
    
    public function update(Request $request) {
        $this->validate($request, [
            'date' => 'required|date',
            'quantity' => 'required|numeric|min:1|max:' . ($request->user()->items()->find($request->id)->orders->quantity + $request->user()->items()->find($request->id)->rest),
        ]);
        
        $request->user()->items()->updateExistingPivot($request->id, [
            'must_return_at' => $request->date,
            'quantity' => $request->quantity,
        ]);
        
        return back()->with(['message'=>'Данные обновлены', 'type'=>'success']);
    }
    
    public function returned(Request $request) {
        $user = \App\User::find($request->user_id);
        
        $user->items()->updateExistingPivot($request->item_id, [
            'is_returned' => true,
        ]);
        
        return back()->with(['message'=>'Заказ возвращен', 'type'=>'success']);
//        dd($request->item_id, $request->user_id);
    }
    
}

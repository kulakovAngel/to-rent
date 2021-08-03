<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model {
    private function allUsers() {
        return $this
            ->belongsToMany('App\User')
            ->as('orders')
            ->withPivot(
                'id',
                'ordered_at',
                'must_return_at',
                'is_confirmed',
                'quantity'
            );
    }
    
    public function category() {
        return $this->belongsTo('App\Category');
    }
    
    public function users() {
        return $this
            ->allUsers()
            ->wherePivot('is_returned', false);
    }
    
    public function usersReturned() {
        return $this
            ->allUsers()
            ->wherePivot('is_returned', true);
    }
    
    public function getRestAttribute() {
        $total_quantity = 0;
        foreach ($this->users()->get() as $user) {
            if (isset($user)) {
                $total_quantity += $user->orders->quantity;
            }
        }
        return $this->total_amount - $total_quantity;
    }
}
<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewOrder extends Mailable {
    use Queueable, SerializesModels;

    public $order;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($order) {
        $this->order = $order;
        $this->order['from'] = $order['user']->items()->find($order['item']->id)->orders->ordered_at;
        $this->order['to'] = $order['user']->items()->find($order['item']->id)->orders->must_return_at;
        $this->order['days'] = \Carbon\Carbon::create($this->order['from'])->diffInDays($this->order['to']);
        $this->order['img'] = config('app.url') . '/storage/images/' . ($order['item']->image_name ? $order['item']->image_name : 'placeholder.png');
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build() {
        return $this
            ->view('email.neworder.customer');
    }
}

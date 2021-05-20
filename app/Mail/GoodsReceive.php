<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class GoodsReceive extends Mailable
{
    public $goods;
    public $newGoods;
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($goods, $newGoods)
    {
        $this->goods = $goods;
        $this->newGoods = $newGoods;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $string = base64_encode(random_bytes(10));
        return $this->from($string . '@btsa.co.id', 'Support System BTSA')
            ->subject('Ada paket/dokumen datang untukmu, ' . $this->goods->name . '!')
            ->markdown('emails.goodsReceive');
    }
}

<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\company_details;

class GoodsReceive extends Mailable
{
    public $goods;
    public $newGoods;
    public $company;
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($goods, $newGoods, $company)
    {
        $this->goods = $goods;
        $this->newGoods = $newGoods;
        $this->company = $company;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $company = company_details::where('id', 1)->first();

        $string = base64_encode(random_bytes(10));
        return $this->from($string . '@' . $company->site, 'Support System ' . $company->company_name)
            ->subject('Ada paket/dokumen datang untukmu, ' . $this->goods->name . '!')
            ->markdown('emails.goodsReceive');
    }
}

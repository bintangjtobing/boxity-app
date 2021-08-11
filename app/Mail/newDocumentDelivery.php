<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class newDocumentDelivery extends Mailable
{
    public $ddrGet;
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($ddrGet)
    {
        $this->ddrGet = $ddrGet;
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
            ->subject('[Document#' . $this->ddrGet->ddr_number . '] Important: New document delivery has appeared!')
            ->markdown('emails.newDocument');
    }
}

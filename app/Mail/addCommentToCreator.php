<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class addCommentToCreator extends Mailable
{
    public $userfind;
    public $issuefind;
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($userfind, $issuefind)
    {
        $this->userfind = $userfind;
        $this->issuefind = $issuefind;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $string = base64_encode(random_bytes(10));
        return $this->from($string . '@btsa.co.id', 'Comment on Issue Report BTSA Logistics.')
            ->subject('[Re: Ticket#' . $this->userfind->issueId . '] Reply: New comment on your issues.')
            ->markdown('emails.addCommentByCreator');
    }
}

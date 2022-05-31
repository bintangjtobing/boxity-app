<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\company_details;

class addCommentToCreator extends Mailable
{
    public $userfind;
    public $issuefind;
    public $company;
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($userfind, $issuefind, $company)
    {
        $this->userfind = $userfind;
        $this->issuefind = $issuefind;
        $this->company = $company;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $company = company_details::first();

        $string = base64_encode(random_bytes(10));
        return $this->from($string . '@' . $company->site, 'Comment on Issue Report ' . $company->company_name)
            ->subject('[Re: Ticket#' . $this->userfind->issueId . '] Reply: New comment on your issues.')
            ->markdown('emails.addCommentByCreator');
    }
}

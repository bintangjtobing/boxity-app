<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\company_details;
use App\withdraw;


class confirmRequestToRequester extends Mailable
{
    public $getHistory;
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($getHistory)
    {
        $this->getHistory = $getHistory;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $company = company_details::first();
        $getHistory = withdraw::with('requester', 'banks')->orderBy('created_at', 'desc')->first();

        $string = base64_encode(random_bytes(10));
        return $this->from($string . '@' . config('mail.client_site'), 'Withdraw Management ' . config('mail.client_name'))
            ->subject('[BCI-BLWID-000' . $getHistory->id . '] Your withdraw request have been received!')
            ->markdown('emails.confirmRequestWDToRequester');
    }
}

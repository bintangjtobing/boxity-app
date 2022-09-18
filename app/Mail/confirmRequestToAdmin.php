<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\company_details;
use App\withdraw;

class confirmRequestToAdmin extends Mailable
{
    public $getHistory;
    public $admin;
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($getHistory, $admin)
    {
        $this->getHistory = $getHistory;
        $this->admin = $admin;
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
            ->subject('[BCI-BLWID-000' . $getHistory->id . '] New withdraw request from ' . $getHistory->requester->name . ' has been made!')
            ->markdown('emails.confirmRequestWDToAdmin');
    }
}

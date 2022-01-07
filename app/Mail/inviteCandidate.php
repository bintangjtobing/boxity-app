<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\company_details;

class inviteCandidate extends Mailable
{
    public $candidate;
    public $company;
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($candidate, $company)
    {
        $this->candidate = $candidate;
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
        return $this->from('hr@' . $company->site, $company->company_name . ' Human Resources System')
            ->subject('We wanna like to invite you to interview!')
            ->markdown('emails.confirmInviteToCandidate');
    }
}

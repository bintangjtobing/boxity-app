<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\company_details;

class addUser extends Mailable
{
    public $user;
    public $company;
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $company)
    {
        $this->user = $user;
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
        return $this->from($string . '@' . $company->site, $company->companyName . ' Support System')
            ->subject('You have been successfully added to system!')
            ->markdown('emails.addUser');
    }
}

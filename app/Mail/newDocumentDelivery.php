<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\company_details;

class newDocumentDelivery extends Mailable
{
    public $ddrGet;
    public $company;
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($ddrGet, $company)
    {
        $this->ddrGet = $ddrGet;
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
            ->subject('[Document#' . $this->ddrGet->ddr_number . '] Important: New document delivery has appeared!')
            ->markdown('emails.newDocument');
    }
}

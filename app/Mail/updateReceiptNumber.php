<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\company_details;

class updateReceiptNumber extends Mailable
{
    public $ItemDelivering;
    public $documentRelated;
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($ItemDelivering, $documentRelated)
    {
        $this->ItemDelivering = $ItemDelivering;
        $this->documentRelated = $documentRelated;
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
        return $this->from($string . '@' . $company->site, 'Support System ' . $company->company_name)
            ->subject('[Document#' . $this->ItemDelivering->ddrId . '] Important: Your receipt number has been appeared!')
            ->markdown('emails.updateReceiptNumber');
    }
}

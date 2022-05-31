<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\company_details;

class closedIssue extends Mailable
{
    public $issues;
    public $company;
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($issues, $company)
    {
        $this->issues = $issues;
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
        return $this->from($string . '@' . $company->site, 'Issue Report ' . $company->company_name)
            ->subject('[Ticket#' . $this->issues->id . '] Finished: Your Issue Report has been done.')
            ->markdown('emails.closedIssue');
    }
}

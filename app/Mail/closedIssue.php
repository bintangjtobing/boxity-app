<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class closedIssue extends Mailable
{
    public $issues;
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($issues)
    {
        $this->issues = $issues;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $string = base64_encode(random_bytes(10));
        return $this->from($string . '@btsa.co.id', 'Issue Report BTSA Logistics.')
            ->subject('[Ticket#' . $this->issues->id . '] Finished: Your Issue Report has been done.')
            ->markdown('emails.closedIssue');
    }
}

<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class makeNewContentToCreator extends Mailable
{
    public $blogs;
    public $creator;

    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($blogs, $creator)
    {
        $this->blogs = $blogs;
        $this->creator = $creator;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $string = base64_encode(random_bytes(10));
        return $this->from($string . '@' . config('mail.client_site'), 'Content Report ')
            ->subject('Congratulations! Your content is awaiting to approved by administrator/moderator of ' . config('mail.client_name'))
            ->markdown('emails.newContentToCreator');
    }
}

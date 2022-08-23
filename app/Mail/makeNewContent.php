<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class makeNewContent extends Mailable
{
    public $blogs;
    public $admin;

    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($blogs, $admin)
    {
        $this->blogs = $blogs;
        $this->admin = $admin;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $string = base64_encode(random_bytes(10));
        return $this->from($string . '@' . config('mail.client_site'), 'Content Report')
            ->subject('[Content#00' . $this->blogs->id . '] Important: New content have been made to our system.')
            ->markdown('emails.newContent');
    }
}

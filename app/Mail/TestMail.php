<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class TestMail extends Mailable
{
    use Queueable, SerializesModels;

    public $messageContent;

    /**
     * Create a new message instance.
     *
     * @param  string  $messageContent
     * @return void
     */
    public function __construct($messageContent)
    {
        // dd("hello");
        $this->messageContent = $messageContent;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Test Email')
                    ->view('backend.messagemaill.EmailMessage')
                    ->with(['messageContent' => $this->messageContent]);
    }
}

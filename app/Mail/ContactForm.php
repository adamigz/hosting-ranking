<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactForm extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {   
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from($this->data['email'], settings()->title)
                    ->view('mails.contact')
                    ->with([
                        'email' => $this->data['email'],
                        'title' => $this->data['title'],
                        'content' => $this->data['content'],
                        'send_at' => date('Y-m-d H:i:s')
                    ]);
    }
}

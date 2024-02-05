<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Cache;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ContactMail extends Mailable
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
        $this->data = (object)$data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $name = clean(@$this->data->name);
        return $this
            ->subject('Message From '.$name)
            ->from(@$this->data->email, $name)
            ->view('emails.contact');
    }
}

<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Registration_success extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name)
    {
        $this->to('rabiul0420@gmail.com', 'Rabiul Islam');
        $this->replyTo('rabiul.ruet04@gmail.com', 'swadhin');
        $this->subject('Test Subject');
        $this->name = $name;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.ragistration_successfull',(['name'=>$this->name]));
    }
}

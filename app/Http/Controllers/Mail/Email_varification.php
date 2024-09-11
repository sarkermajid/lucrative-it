<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Email_varification extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user,$admin_mail,$company_name)
    {
        $this->to($admin_mail,$company_name);
        $this->replyTo($user->email, $user->name);
        $this->subject($user->name);
        $this->alldata = $user;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.email_confirmation',(['alldata'=>$this->alldata]));
    }
}

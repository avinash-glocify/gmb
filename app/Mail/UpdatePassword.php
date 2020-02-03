<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UpdatePassword extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $password;

    public function __construct($user, $pass)
    {
        $this->user     = $user;
        $this->password = $pass;
    }

    public function build()
    {
        return $this->view('mails.user_password_update');
    }
}

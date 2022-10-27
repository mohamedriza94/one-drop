<?php

namespace App\Mail\hospital;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class forgotPasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    public $hospitalCode;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($hospitalCode)
    {
        $this->hospitalCode = $hospitalCode;
    }
  
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Forgot Password')->view('hospital.auth.verifyMail');
    }
}

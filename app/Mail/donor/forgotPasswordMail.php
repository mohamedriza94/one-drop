<?php

namespace App\Mail\donor;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class forgotPasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    public $donorCode;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($donorCode)
    {
        $this->donorCode = $donorCode;
    }
  
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Forgot Password')->view('donor.auth.verifyMail');
    }
}

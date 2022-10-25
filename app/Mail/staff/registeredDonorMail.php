<?php

namespace App\Mail\staff;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class registeredDonorMail extends Mailable
{
    use Queueable, SerializesModels;

    public $donorEmail;
    public $donorPassword;

    public function __construct($donorEmail,$donorPassword)
    {
        $this->donorEmail = $donorEmail;
        $this->donorPassword = $donorPassword;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Donor Credentials')->view('admin.dashboard.staffControls.registeredDonorCredentialsMail');
    }
}

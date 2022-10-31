<?php

namespace App\Mail\hospital;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class registeredHospitalDonorMail extends Mailable
{
    use Queueable, SerializesModels;

    public $hospitalDonorEmail;
    public $hospitalDonorPassword;

    public function __construct($hospitalDonorEmail,$hospitalDonorPassword)
    {
        $this->hospitalDonorEmail = $hospitalDonorEmail;
        $this->hospitalDonorPassword = $hospitalDonorPassword;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Donor Credentials')->view('hospital.dashboard.registeredDonorCredentialsMail');
    }
}

<?php

namespace App\Mail\hospital;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class donationNotificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $todayDate;
    public $hospitalName;

    public function __construct($todayDate,$hospitalName)
    {
        $this->todayDate = $todayDate;
        $this->hospitalName = $hospitalName;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Blood Donation')->view('hospital.dashboard.donationMail');
    }
}

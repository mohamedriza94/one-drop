<?php

namespace App\Mail\admin;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class donationNotificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $todayDate;

    public function __construct($todayDate)
    {
        $this->todayDate = $todayDate;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Blood Donation')->view('admin.dashboard.staffControls.donationMail');
    }
}

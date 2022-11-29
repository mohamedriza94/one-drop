<?php

namespace App\Mail\Staff;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class declinedDonorEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $donorRequestDeclineId; 

    public function __construct($donorRequestDeclineId)
    {
        $this->donorRequestDeclineId = $donorRequestDeclineId;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Donor Request Declination')->view('admin.dashboard.staffControls.declineDonorRequestMail');
    }
}

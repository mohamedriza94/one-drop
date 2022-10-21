<?php

namespace App\Mail\staff;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class appointmentMail extends Mailable
{
    use Queueable, SerializesModels;

    public $appointmentMailNo;
    public $appointmentMailDate;
    public $appointmentMailTime;
    public $appointmentMailVenue;

    public function __construct($appointmentMailNo,$appointmentMailDate,$appointmentMailTime,$appointmentMailVenue)
    {
        $this->appointmentMailNo = $appointmentMailNo;
        $this->appointmentMailDate = $appointmentMailDate;
        $this->appointmentMailTime = $appointmentMailTime;
        $this->appointmentMailVenue = $appointmentMailVenue;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Appointment Details')->view('admin.dashboard.staffControls.appointmentDetailsMail');
    }
}

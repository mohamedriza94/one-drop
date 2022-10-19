<?php

namespace App\Mail\visitor;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class bloodRequest extends Mailable
{
    use Queueable, SerializesModels;

    public $mailRequestNo;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($mailRequestNo)
    {
        $this->mailRequestNo = $mailRequestNo;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('BLOOD REQUEST TRACKING INFO')->view('visitor.dashboard.requestTrackingInfoMail');
    }
}

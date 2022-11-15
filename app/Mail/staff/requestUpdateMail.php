<?php

namespace App\Mail\staff;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class requestUpdateMail extends Mailable
{
    use Queueable, SerializesModels;

    public $requestUpdateMessage;

    public function __construct($requestUpdateMessage)
    {
        $this->requestUpdateMessage = $requestUpdateMessage;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Blood Request Update')->view('admin.dashboard.staffControls.requestUpdateMail');
    }
}

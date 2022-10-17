<?php

namespace App\Mail\admin;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class otherMessage extends Mailable
{
    use Queueable, SerializesModels;

    public $otherSubject;
    public $otherMessage;
    public $mailSender;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($otherSubject, $otherMessage, $mailSender)
    {
        $this->otherSubject = $otherSubject;
        $this->otherMessage = $otherMessage;
        $this->mailSender = $mailSender;
    }
  
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Message')->view('admin.dashboard.mailToOther');
    }
}

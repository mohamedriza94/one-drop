<?php

namespace App\Mail\admin;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class sendStaffPassword extends Mailable
{
    use Queueable, SerializesModels;

    public $staffEmail;
    public $staffPassword;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($staffEmail, $staffPassword)
    {
        $this->staffEmail = $staffEmail;
        $this->staffPassword = $staffPassword;
    }
  
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('STAFF LOGIN CREDENTIALS')->view('admin.dashboard.staffPasswordMail');
    }
}

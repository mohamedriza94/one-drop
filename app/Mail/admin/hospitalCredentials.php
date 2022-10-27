<?php

namespace App\Mail\admin;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class hospitalCredentials extends Mailable
{
    use Queueable, SerializesModels;

    public $hospitalNo;
    public $hospitalPassword;

    public function __construct($hospitalNo,$hospitalPassword)
    {
        $this->hospitalNo = $hospitalNo;
        $this->hospitalPassword = $hospitalPassword;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Hospital Login Credentials')->view('admin.dashboard.hospitalCredentialsMail');
    }
}

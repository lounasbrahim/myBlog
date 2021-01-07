<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NewMail extends Mailable{

use Queueable, SerializesModels;

public $user;

public function __construct($user){

$this->user = $user;

}

public function build(){

return $this->subject('This is Testing Mail')
->view('email.test');
}
}

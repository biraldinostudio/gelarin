<?php

namespace App\Mail\Member\Application;
use Mail;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
//use File;
//use Storage;
class ApplicationMail extends Mailable
{
    use Queueable, SerializesModels;
	
	public $data;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data=[])
    {
        $this->data = $data;		
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
		return $this->from($this->data['from'])
			->subject($this->data['subject'])
			->attach($this->data['file'])			
			->view('emails.application.apply')
			->with('data',$this->data);

    }
}

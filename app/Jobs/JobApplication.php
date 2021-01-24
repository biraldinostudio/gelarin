<?php

namespace App\Jobs;
//use App\Models\Application;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Mail\Member\Application\ApplicationMail;
use Mail;
class JobApplication implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
	protected $data;	
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data=[])
    {
        $this->data = $data;		
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
		Mail::to($this->data['email'])->send(new ApplicationMail($this->data));
    }
}

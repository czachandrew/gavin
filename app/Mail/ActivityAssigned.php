<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Activity;

class ActivityAssigned extends Mailable
{
    use Queueable, SerializesModels;

    //public $user; 

   //public $creator; 

    public $activity; 


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct( Activity $activity)
    {
         
        $this->activity = $activity;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject($this->activity->creator->name . " has assigned you an activity")->markdown('emails.activities.assigned');
    }
}

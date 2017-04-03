<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Activity; 
use App\User; 
use App\Mail\ActivityBreakdown; 


class ActiveActivities extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'communicate:activeactivities';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Pull pending activities for all users and send an email update';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //get all of the users with activities 
        $users = User::with('assigned_activities','created_activities')->get();
        //loop through each one and send an email of their open activities 
        foreach($users as $user){
            \Mail::to($user->email)->send(new ActivityBreakdown($user));
        }
        //
        //that's it! 
    }
}

<?php

namespace App\Console\Commands;



use Illuminate\Console\Command;
use App\Bid;
use App\User;
use App\Client;
use App\Gigs;
use App\Mail\ReminderMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class EmailUpdate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send email to client every minute';

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
         $user = User::where('user_type', 'Client')->get();
         foreach($user as $u) {
         $id = $u->id;
          $gig = Gigs::where('user_id', $id)->get();
          
        foreach ($gig as $g ){
            $bid = Bid::where('g_id', $g->gig_id)->get();
            
           // Log::info($bid);
           foreach($bid as $b)
           if($b->status== 1 && $b->g_id==$g->gig_id && $g->is_complete==0) {
                Mail::send('pemail', ['user' => $u], function ($message) use ($u)
                {
                  $message->from('info@studentgigs', 'StudentGigs Support');
                  $message->to($u->email, $u->name);
                  $message->subject('Payment Reminder');
               });
             }
        }

            
  
            //      
         }
            
            
            // Log::info($gig);
            // Log::info($bid);
        // Mail::to("arondasamuel123@gmail.com")->send(new ReminderMail());
        // return $users;
         
    }
}

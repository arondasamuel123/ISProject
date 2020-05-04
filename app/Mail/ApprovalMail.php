<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Freelancer;


class ApprovalMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
       
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {     
        //  $user = Auth::user();
        // $id = $user->id;
        // $freelancer = $freelancer = Freelancer::where('user_id', $id)->first();
        return $this->view('email');
        
        
    }
}

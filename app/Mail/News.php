<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class News extends Mailable
{
    use Queueable, SerializesModels;

    public $details;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($details)
    {
        //
        $this->details = $details;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $users = \Illuminate\Support\Facades\Auth::user();
        //$users = User::auth()->user()->first();
       // dd($users);

//        foreach ($users as $user){
            return $this
                ->from('raridoy4@gmail.com')
                ->to($users->email)
                ->subject('Your news updated')
                ->view('emails.demo-mail');
//        }

    }
}

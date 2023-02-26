<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TodoReminder extends Mailable
{
    use Queueable, SerializesModels;
    public $user;
    public $task;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $task)
    {
        $this->user = $user;
        $this->task = $task;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Task due date reminder '. $this->user->name)
                    ->view('emails.reminder');
    }
}

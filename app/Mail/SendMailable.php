<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\User;
use App\Ticket;
use App\Jobs\SendEmailJob;

class SendMailable extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $ticket;
    public $userQueue;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, Ticket $ticket, User $userQueue)
    {
        $this->user = $user;
        $this->ticket = $ticket;
        $this->userQueue = $userQueue;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.create')
         ->from('no-reply@telecentro.net.ar')
         ->subject('Ticket Creado!');
    }
}

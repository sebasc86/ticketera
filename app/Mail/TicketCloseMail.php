<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\User;
use App\Ticket;

class TicketCloseMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $ticket;
    public $userAuth;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, Ticket $ticket, User $userAuth)
    {   
        $this->user = $user;
        $this->ticket = $ticket;
        $this->userAuth = $userAuth;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {   
        return $this->view('emails.closes')
         ->from('no-reply@telecentro.net.ar')
         ->subject('Ticket Cerrado!');
    }
}

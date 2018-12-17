<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\User;
use App\Ticket;

class TicketAfter72hs extends Mailable
{
    use Queueable, SerializesModels;
    
    public $ticket;
    public $user;
    public $userQueue;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Ticket $ticket, User $user, User $userQueue)
    {
        $this->ticket = $ticket;
        $this->user = $user;
        $this->userQueue = $userQueue; 
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.ticketAfter')
         ->from('no-reply@telecentro.net.ar')
         ->subject('Ticket Pendiente sin gestionar!');
    }
}

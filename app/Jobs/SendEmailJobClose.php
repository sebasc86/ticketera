<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;
use App\Mail\TicketCloseMail;
use App\Sector;
use App\User;
use App\Ticket;


class SendEmailJobClose implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $user;
    public $ticket;
    public $userAuth;

    /**
     * Create a new job instance.
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
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if($this->user->deleted_at != null) {
            $sector= Sector::find($this->user->sector_id);

            Mail::to($sector->email_boss)
            ->cc($this->userAuth->email)
            ->queue(new TicketCloseMail($this->user, $this->ticket, $this->userAuth));
        }

        Mail::to($this->user->email)
        ->cc($this->userAuth->email)
        ->queue(new TicketCloseMail($this->user, $this->ticket, $this->userAuth));
    }
}

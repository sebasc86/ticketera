<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Ticket;
use App\Sector;
use App\User;
use Carbon\Carbon;
use App\File;
use Illuminate\Support\Facades\Auth;
use App\Mail\TicketMail;


class sendClaim extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:sendClaim';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'ENVIA MENSAJE A JEFES DE PROVEEDORES';

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
        $ticketsOpen = Ticket::where('status', Ticket::OPEN_STATUS)->get();

        foreach ($ticketsOpen as $key => $tickets) {
            $dateCreate = $tickets->created_at;
            $datenow = Carbon::now();
            $diffHours = $datenow->diffInHours($dateCreate);
            

            if($diffHours > 72) {
                // Mail::send('welcome', [], function($message) { $message->to('sebascoscia@gmail.com')->subject('Testing email'); });
                Mail::to('sebascoscia@gmail.com')
				->send(new TicketMail());
            }
        }
  

         $this->info('Los mensajes de felicitación de cumpleaños han sido enviados correctamente!');

    }
}

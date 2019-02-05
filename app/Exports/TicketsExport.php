<?php

namespace App\Exports;

use App\Ticket;
use App\User;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Database\Query\Builder;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;



class TicketsExport implements FromQuery, WithMapping, WithHeadings, WithBatchInserts, WithChunkReading
{
    use Exportable;
    /**
    * @return Collection
    */


    public function query()
    {
        $sector_id = request()->session()->get('sector_id');

        $ticketsAll = Ticket::query()->where('queue', $sector_id);

            return $ticketsAll;
        
    }


    public function map($ticket): array
    {

        //para buscar el usuario que cerro el ticket
        if(isset($ticket->close_user_id)){
            $userClose = $ticket->close_user_id;
            $userClose = User::find($userClose);
        		$userCloseName = $userClose->name;
        } else {
					$userCloseName = null;
				}
        

        return [
            $ticket->status = ($ticket->status === 0) ? "Cerrado" : "Abierto",
            $ticket->number,
            $ticket->client,
            $ticket->user_id = $ticket->user->name,
            $ticket->close_user_id = $userCloseName,
            $ticket->created_at,
        ];
    }

    public function headings() : array
    {
        return [
            'Estado',
            'Numero',
            'Cliente',
            'Usuario Creador', 
            'Usuario de Cierre', 
            'Ticket Creado', 
        ];

		}
		
		public function batchSize(): int
    {
        return 750;
    }
		public function chunkSize(): int
    {
        return 750;
    }



}

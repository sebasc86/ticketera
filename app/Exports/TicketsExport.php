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


class TicketsExport implements FromQuery, WithMapping, WithHeadings
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


    public function map($row): array
    {

        //para buscar el usuario que cerro el ticket
        $userClose = $row->close_user_id;
        $userClose = User::find($userClose);
        $userCloseName = $userClose->name;

        return [
            $row->status = ($row->status === 0) ? "Cerrado" : "Abierto",
            $row->sector = $row->user->sector->name,
            $row->number,
            $row->client,
            $row->user_id = $row->user->name,
            $row->close_user_id = $userCloseName,
            $row->created_at,
        ];
    }

    public function headings() : array
    {
        return [
            'Estado',
            'Sector',
            'Numero',
            'Cliente',
            'Usuario Creador', 
            'Usuario de Cierre', 
            'Ticket Creado', 
        ];

    }



}

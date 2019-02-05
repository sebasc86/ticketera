<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\TicketsExport;


class TicketsExportController extends Controller
{

    public function __construct()
    {
				$this->middleware('auth');
				$this->middleware('admin');
    }


    public function export()
    {
        // return Excel::download(new TicketsExport(), 'tickets.xlsx');
        $date = date('Ymd-hms');


        return (new TicketsExport())->download($date . '_tickets_sector.xlsx');
        // (new InvoicesExport)->download('invoices.csv', \Maatwebsite\Excel\Excel::CSV);
    }
}

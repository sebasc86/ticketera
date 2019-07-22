<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Ticket;
use App\User;
use App\Comment;
use App\File;



class deleteTicketController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('sectorAdmin');
        $this->middleware('admin');
    }

    public function index(Request $request)
    {

        $user = Auth::user();
        if($user->isAdmin === 1) {
            $ticket = $request->ticket;
            $ticketN = Ticket::where('number', $ticket)->first();

            $comments = $ticketN->comment;
            if($comments != null) {
                foreach ($comments as $key => $comment) {
                    $fileComments = File::where('comment_id', $comment->id)->get();
                    foreach ($fileComments as $key => $fileComment) {
                        $fileNameComment = $fileComment->filename;
                        Storage::delete('public/uploads/files/'.$fileNameComment);
                    }

                }
            }

            $files = File::where('ticket_id', $ticketN->id)->get();

            if($files != null) {
                foreach ($files as $key => $file) {
                    $fileName = $file->filename;
                    Storage::delete('public/uploads/files/'.$fileName);
                }

            }



            $ticketN->status = 0;
            $ticketN->save();
            $ticketN->delete();
        }

        return response()->json(['success'=>'1']);
    }

}

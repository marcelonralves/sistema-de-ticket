<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\TicketMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function login()
    {

    }

    public function postLogin()
    {

    }

    public function showTickets()
    {
        $tickets = Ticket::where('support_id', NULL)->orderByDesc('id')->get();

        return view('admin.tickets', compact('tickets'));
    }

    public function showMyTickets()
    {
        $tickets = Ticket::where('support_id', Auth::id())->orderByDesc('id')->get();

        return view('admin.my-tickets', compact('tickets'));
    }

    public function supportAcceptTicket(Request $request, int $id)
    {
        $request->merge(['id' => $id]);

        $this->validate($request, [
            'id' => 'required|exists:tickets,id'
        ]);

        $ticket = Ticket::find($request->id);
        $ticket->support_id = 2;
        $ticket->save();

        return redirect("admin/ticket/{$id}/edit");
    }

    public function seeTicket(Request $request, int $id)
    {
        $request->merge(['id' => $id]);

        $this->validate($request, [
            'id' => 'required|exists:tickets,id'
        ]);

        $ticketMessages = TicketMessage::where('ticket_id', $id)->orderByDesc('id')->get();

        return view('admin.ticket-detail', compact('ticketMessages'));
    }

    public function postResponseTicket(Request $request, int $id)
    {
        $request->merge(['id' => $id]);

        $this->validate($request, [
            'id' => 'required|exists:tickets,id',
            'content' => 'required'
        ]);

        $ticketInsertMessage = new TicketMessage;
        $ticketInsertMessage->content = $request->input('content');
        $ticketInsertMessage->ticket_id = $request->input('id');
        $ticketInsertMessage->user_id = 1;
        // status do ticket
        $ticketInsertMessage->save();

        return redirect('/admin/meus-tickets')->with('status', 'Mensagem enviada com sucesso!');
    }
}

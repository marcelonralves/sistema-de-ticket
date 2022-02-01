<?php

namespace App\Http\Controllers;

use App\Http\Requests\TicketRequest;
use App\Models\Ticket;
use App\Models\TicketCategory;
use App\Models\TicketMessage;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class TicketController extends Controller
{

    public function test()
    {
        return view('test');
    }
    public function login()
    {
        return view('form-auth');
    }

    public function register()
    {
        return view('form-auth');
    }

    public function postLogin(Request $request)
    {
        $credentials = $this->validate($request, [
            'email' => 'required|email|exists:users,email',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->email)->first();

        if(!Hash::check($request->password, $user->password)) {
            return back()->withErrors(['password' => 'A senha que você digitou não confere']);
        }

        Auth::attempt($credentials);

        return redirect('criar-ticket');
    }

    public function postRegister(Request $request)
    {
        $credentials = $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required'
        ]);

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);

        $user->save();

        Auth::attempt($credentials);

        return redirect('criar-ticket');
    }

    public function showFormTicket()
    {
        $categories = TicketCategory::where('active', 1)->orderBy('category')->get();

        return view('create-ticket', compact('categories'));
    }

    public function postTicket(TicketRequest $request)
    {
        $newTicket = new Ticket;
        $newTicket->title = $request->input('title');
        $newTicket->priority = $request->input('priority');
        $newTicket->category_id = $request->input('category_id');
        $newTicket->customer_id = Auth::id();

        $newTicket->save();

        $messageTicket = new TicketMessage;
        $messageTicket->ticket_id = $newTicket->id;
        $messageTicket->content = $request->input('content');
        $messageTicket->user_id = Auth::id();
        $messageTicket->save();

        return back()->with('status', 'Ticket enviado com sucesso!');
    }
}

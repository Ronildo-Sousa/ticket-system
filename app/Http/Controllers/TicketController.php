<?php

namespace App\Http\Controllers;

use App\Enums\user\Roles;
use App\Http\Requests\TicketRequest;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Label;
use App\Models\Priority;
use App\Models\Ticket;
use App\Models\User;
use App\Notifications\TicketCreated;

class TicketController extends Controller
{
    public function dashboard()
    {
        $tickets = auth()->user()->tickets;

        if (auth()->user()->role_id !== Roles::Regular->value) {
            $tickets = Ticket::fromNotRegularUsers();
        }

        $amount = Ticket::getAmount($tickets);

        return view('dashboard', [
            'totalTickets' => $amount['total'],
            'openTickets' => $amount['open'],
            'closedTickets' => $amount['closed']
        ]);
    }

    public function details(Ticket $ticket)
    {
        $comments = Comment::query()
            ->where('ticket_id', $ticket->id)->paginate(6);

        return view('components.tickets.details', compact(['ticket', 'comments']));
    }

    public function index()
    {
        $tickets = auth()->user()->tickets->sortDesc();

        if (auth()->user()->role_id !== Roles::Regular->value) {
            $tickets = Ticket::fromNotRegularUsers();
        }

        return view('components.tickets.index', compact('tickets'));
    }

    public function create()
    {
        return view('components.tickets.create', [
            'priorities' => Priority::all(),
            'labels' => Category::all(),
            'categories' => Label::all(),
        ]);
    }

    public function store(TicketRequest $request)
    {
        $ticket =  Ticket::query()
            ->create([
                'title' => $request->validated('title'),
                'description' => $request->validated('description'),
                'priority_id' => $request->validated('priority_id'),
                'user_id' => auth()->id()
            ]);

        $ticket->categories()->attach($request->validated('categories'));
        $ticket->labels()->attach($request->validated('labels'));

        User::admin()->each(fn ($user) => $user->notify(new TicketCreated($ticket)));

        return to_route('tickets.index');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(TicketRequest $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}

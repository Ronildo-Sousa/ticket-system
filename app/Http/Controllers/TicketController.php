<?php

namespace App\Http\Controllers;

use App\Http\Requests\TicketRequest;
use App\Models\Category;
use App\Models\Label;
use App\Models\Priority;
use App\Models\Ticket;

class TicketController extends Controller
{
    public function index()
    {
        return Ticket::all();
    }

    public function create()
    {
        $priorities = Priority::all();
        $categories = Category::all();
        $labels = Label::all();
        return view('components.tickets.create', compact([
            'priorities',
            'labels',
            'categories',
        ]));
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
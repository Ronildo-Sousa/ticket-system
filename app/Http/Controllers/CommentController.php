<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Models\Comment;

class CommentController extends Controller
{
    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(CommentRequest $request)
    {
        Comment::query()
            ->create([
                'ticket_id' => $request->validated('ticket_id'),
                'body' => $request->validated('body'),
                'user_id' => auth()->id()
            ]);
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(CommentRequest $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}

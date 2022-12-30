<?php

namespace App\Http\Controllers;

use App\Http\Requests\LabelRequest;
use App\Models\Label;

class LabelController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Label::class, 'label');
    }

    public function index()
    {
        $labels = Label::query()->orderBy('created_at', 'DESC')->get();

        return view('components.labels.index', compact('labels'));
    }

    public function create()
    {
        return view('components.labels.create');
    }


    public function store(LabelRequest $request)
    {
        Label::query()
            ->create($request->validated());

        return to_route('labels.index');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(LabelRequest $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}

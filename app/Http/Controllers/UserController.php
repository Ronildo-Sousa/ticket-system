<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\Role;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        return view('components.user.index', [
            'users' => User::query()->get()
        ]);
    }

    public function create()
    {
        return view('components.user.create', [
            'roles' => Role::all()
        ]);
    }

    public function store(UserRequest $request)
    {
        User::query()
            ->create($request->validated());

        return to_route('users.index');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(UserRequest $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}

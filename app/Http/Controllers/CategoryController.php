<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Category::class, 'category');
    }

    public function index()
    {
        $categories = Category::all();
        return view('components.categories.index', compact('categories'));
    }


    public function create()
    {
        return view('components.categories.create');
    }


    public function store(CategoryRequest $request)
    {
        Category::query()
            ->create($request->validated());

        return to_route('categories.index');
    }

    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }


    public function update(CategoryRequest $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}

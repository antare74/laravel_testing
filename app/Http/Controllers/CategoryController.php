<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseFormatter;
use App\Models\Categories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Categories::with([])->orderBy('name', 'asc')->get();
        return view('pages.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('pages.categories.create', [
            'categories' => Categories::all(),
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:categories|max:255',
        ]);

        if ($validator->fails()) {
            return ResponseFormatter::error([
                'errors' => $validator->errors()
            ],'Validation Error', 422);
        }

        Categories::create($request->all());

        return redirect()->route('categories.index')->with('success', 'Category created successfully.');
    }

    public function show($id)
    {
        return view('pages.categories.show', [
            'category' => Categories::find($id),
        ]);
    }

    public function edit(Categories $category)
    {
        return view('pages.categories.edit', [
            'category' => $category,
        ]);
    }

    public function update(Request $request, Categories $category)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'max:255|unique:categories,name,'.$category->id,
        ]);

        if ($validator->fails()) {
            return ResponseFormatter::error([
                'errors' => $validator->errors()
            ],'Validation Error', 422);
        }

        $category->update($request->all());

        return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
    }

    public function destroy(Categories $category)
    {
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Category deleted successfully.');
    }
}

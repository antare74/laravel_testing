<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Categories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Categories::with([])->orderBy('name', 'asc')->get();
        return ResponseFormatter::success([
            'categories' => $categories
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

        $category = Categories::create($request->all());

        return ResponseFormatter::success([
            'category' => $category
        ]);
    }

    public function show(Categories $category)
    {
        return ResponseFormatter::success([
            'category' => $category
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
        return ResponseFormatter::success([
            'category' => $category
        ]);
    }

    public function destroy(Categories $category)
    {
        $category->delete();
        return ResponseFormatter::success([
            'category' => null
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseFormatter;
use App\Models\Categories;
use App\Models\ProductCategories;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function index()
    {
        $products = Products::with(['categories'])
            ->orderBy('name', 'asc')
            ->get();
        return view('pages.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Categories::all();
        return view('pages.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'category_id' => 'required|exists:categories,id',
        ]);

        if ($validator->fails()) {
            return ResponseFormatter::error([
                'errors' => $validator->errors()
            ],'Validation Error', 422);
        }

        DB::beginTransaction();
        try {
            $product = Products::create($request->all());
            $product->categories()->attach($request->category_id);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return ResponseFormatter::error([
                'errors' => $e->getMessage()
            ],'Error', 422);
        }

        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    public function show(Products $product)
    {
        return view('pages.products.show', compact('product'));
    }

    public function edit(Products $product)
    {
        $categories = Categories::all();
        return view('pages.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Products $product)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'category_id' => 'required|exists:categories,id',
        ]);

        if ($validator->fails()) {
            return ResponseFormatter::error([
                'errors' => $validator->errors()
            ],'Validation Error', 422);
        }

        DB::beginTransaction();
        try {
            $product->update($request->all());
            $product->categories()->sync($request->category_id);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return ResponseFormatter::error([
                'errors' => $e->getMessage()
            ],'Error', 422);
        }

        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }

    public function destroy(Products $product)
    {
        DB::beginTransaction();
        try {
            $product->categories()->detach();
            $product->delete();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return ResponseFormatter::error([
                'errors' => $e->getMessage()
            ],'Error', 422);
        }

        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }
}

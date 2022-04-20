<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Categories;
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
        return ResponseFormatter::success([
            'products' => $products
        ]);
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
        return ResponseFormatter::success([
            'product' => $product
        ]);
    }

    public function show(Products $product)
    {
        return ResponseFormatter::success([
            'product' => $product
        ]);
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
        return ResponseFormatter::success([
            'product' => $product
        ]);
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
        return ResponseFormatter::success([
            'product' => null
        ]);
    }
}

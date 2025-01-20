<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // Listar todos os produtos
    public function index()
    {
        return Product::all();
    }

    // Mostrar um produto específico
    public function show(Product $product)
    {
        return $product;
    }

    // Criar um novo produto
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
        ]);

        return Product::create($request->all());
    }

    // Atualizar um produto
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'sometimes|string|max:255',
            'description' => 'nullable|string',
            'price' => 'sometimes|numeric|min:0',
            'stock' => 'sometimes|integer|min:0',
        ]);

        $product->update($request->all());
        return $product;
    }

    // Excluir um produto
    public function destroy(Product $product)
    {
        $product->delete();
        return response()->noContent();
    }
}

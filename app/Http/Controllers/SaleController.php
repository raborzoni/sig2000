<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Sale;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    // Processar uma venda
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        // Despachar o job para processar a venda
        ProcessSale::dispatch($request->product_id, $request->quantity);

        return response()->json(['message' => 'Venda em processamento'], 202);

        $product = Product::findOrFail($request->product_id);

        if ($product->stock < $request->quantity) {
            return response()->json(['error' => 'Estoque insuficiente'], 400);
        }

        $totalPrice = $product->price * $request->quantity;

        // Criar a venda
        $sale = Sale::create([
            'product_id' => $product->id,
            'quantity' => $request->quantity,
            'total_price' => $totalPrice,
        ]);

        // Atualizar o estoque do produto
        $product->decrement('stock', $request->quantity);

        return response()->json($sale, 201);
    }
}

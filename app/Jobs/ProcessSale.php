<?php

namespace App\Jobs;

use App\Models\Product;
use App\Models\Sale;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessSale implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $productId;
    protected $quantity;

    public function __construct($productId, $quantity)
    {
        $this->productId = $productId;
        $this->quantity = $quantity;
    }

    public function handle()
    {
        $product = Product::findOrFail($this->productId);

        if ($product->stock < $this->quantity) {
            throw new \Exception('Estoque insuficiente');
        }

        $totalPrice = $product->price * $this->quantity;

        // Criar a venda
        Sale::create([
            'product_id' => $product->id,
            'quantity' => $this->quantity,
            'total_price' => $totalPrice,
        ]);

        // Atualizar o estoque do produto
        $product->decrement('stock', $this->quantity);
    }
}

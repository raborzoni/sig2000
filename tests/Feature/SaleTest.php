<?php

namespace Tests\Feature;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SaleTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_process_sale()
    {
        $product = Product::factory()->create(['stock' => 10]);

        $data = [
            'product_id' => $product->id,
            'quantity' => 2,
        ];

        $response = $this->postJson('/api/sales', $data);

        $response->assertStatus(202)
            ->assertJson(['message' => 'Venda em processamento']);
    }

    public function test_cannot_process_sale_with_insufficient_stock()
    {
        $product = Product::factory()->create(['stock' => 1]);

        $data = [
            'product_id' => $product->id,
            'quantity' => 2,
        ];

        $response = $this->postJson('/api/sales', $data);

        $response->assertStatus(400)
            ->assertJson(['error' => 'Estoque insuficiente']);
    }
}

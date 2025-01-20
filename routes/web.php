<?php

use Illuminate\Support\Facades\Route;
use App\Jobs\ProcessPodcast;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\ItemController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test-queue', function () {
    ProcessPodcast::dispatch();
    return 'Job despachado para a fila!';
});

//CRUD básico
Route::apiResource('items', ItemController::class);

// Route::apiResource('products', ProductController::class);

// Route::post('sales', [SaleController::class, 'store']);
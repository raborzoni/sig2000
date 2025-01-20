<?php

use Illuminate\Support\Facades\Route;
use App\Jobs\ProcessPodcast;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SaleController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test-queue', function () {
    ProcessPodcast::dispatch();
    return 'Job despachado para a fila!';
});

Route::apiResource('products', ProductController::class);

Route::post('sales', [SaleController::class, 'store']);
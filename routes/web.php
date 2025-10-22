<?php

use App\Http\Controllers\InventoryStockController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('inventory-stocks', InventoryStockController::class);

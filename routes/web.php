<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PurchaseorderController;

Route::get('/', function () {
    return view('welcome');
});
Route::resource('purchaseorders', PurchaseorderController::class);
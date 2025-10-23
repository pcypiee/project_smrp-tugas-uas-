<?php

use App\Http\Controllers\ItemMaterialController;
use Illuminate\Support\Facades\Route;

// Item Materials Routes
Route::resource('item-materials', ItemMaterialController::class);

// Atau jika ingin dengan middleware auth:
Route::middleware(['auth'])->group(function () {
    Route::resource('item-materials', ItemMaterialController::class);
});
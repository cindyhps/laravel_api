<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\InventoryItemController;
use App\Http\Controllers\PhotoController;


Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::apiResource('vehicles', VehicleController::class);
Route::apiResource('inventory-items', InventoryItemController::class);
Route::post('upload-photo', [PhotoController::class, 'upload']);
Route::get('photos/{filename}', [PhotoController::class, 'show']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



/*Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');*/



<?php

use App\Http\Controllers\PinController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/pins',[PinController::class,'getAllPins']);
Route::post('/create_pin',[PinController::class,'create']);
Route::post('/update_status/{pin}',[PinController::class,'updateStatus']);
Route::post('/update_name/{pin}',[PinController::class,'updateName']);

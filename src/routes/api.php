<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BoardController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/boards', [BoardController::class, 'index'])
    ->name('board.index');
Route::post('/boards', [BoardController::class, 'store'])
    ->name('board.store');
Route::get('/boards/{id}', [BoardController::class, 'show'])
    ->name('board.show');
Route::put('/boards/{id}', [BoardController::class, 'update'])
    ->name('board.update');
Route::delete('/boards/{id}', [BoardController::class, 'destroy'])
    ->name('board.destroy');

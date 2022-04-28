<?php

use App\Http\Controllers\LevelsController;
use App\Http\Controllers\DevelopersController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::prefix('developers')->group(function() {
    Route::get('/', [DevelopersController::class, 'getAll'])->name('developers.getAll');
    Route::get('/{id}', [DevelopersController::class, 'get'])->name('developers.get');
    Route::post('/', [DevelopersController::class, 'create'])->name('developers.create');
    Route::patch('/{id}', [DevelopersController::class, 'update'])->name('developers.update');
    Route::delete('/{id}', [DevelopersController::class, 'delete'])->name('developers.delete');
});

Route::prefix('levels')->group(function() {
    Route::get('/', [LevelsController::class, 'getAll'])->name('level.getAll');
    Route::get('/{id}', [LevelsController::class, 'get'])->name('level.get');
    Route::post('/', [LevelsController::class, 'create'])->name('level.create');
    Route::patch('/{id}', [LevelsController::class, 'update'])->name('level.update');
    Route::delete('/{id}', [LevelsController::class, 'delete'])->name('level.delete');
});

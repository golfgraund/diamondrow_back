<?php

use App\Http\Controllers\API\PuzzleController;
use App\Http\Controllers\API\PuzzleCodeController;
use App\Http\Controllers\Web\MediaController;
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
Route::get('/puzzle/{slug}', [PuzzleController::class, 'show'])
    ->name('api.puzzle.show');

Route::post('/puzzle/create', [PuzzleController::class, 'create'])
    ->name('api.puzzle.create');

Route::post('/puzzle/update', [PuzzleController::class, 'update'])
    ->name('api.puzzle.update');

Route::post('/puzzle-codes/verify', [PuzzleCodeController::class, 'verify'])
    ->name('api.puzzle-code.verify');

//Решение конфликта с корсами
Route::prefix('medias')->group(function () {
    Route::get('/pdf/{path}', [MediaController::class, 'showPdfFile'])
        ->where('path', '.*')
        ->name('api.medias.pdf');

    Route::get('/excel/{file}', [MediaController::class, 'showExcelFile'])
        ->where('file', '.*')
        ->name('api.medias.excel');
});

//Route::get('/customer/verify', [CustomerController::class, 'verify'])
//    ->name('api.customer.verify');

//Route::post('/customer/create', [CustomerController::class, 'create'])
//    ->name('api.customer.create');

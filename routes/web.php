<?php

use App\Http\Controllers\Web\PuzzleController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/constructor/{slug}', [PuzzleController::class, 'show'])
    ->name('web.puzzle.show');

Route::get('/storage/uploads/files/puzzles/pdf/{slug}.pdf', [PuzzleController::class, 'show'])
    ->name('web.puzzle.pdf');

<?php

use App\Http\Controllers\Admin\ExportPageController;
use App\Http\Controllers\Admin\PuzzleCodeController;
use Illuminate\Support\Facades\Route;

// Register Twill routes here eg.
Route::group([], function () {
    Route::module('puzzleCode');
    Route::module('customers');
});

Route::get('/exportPage', [ExportPageController::class, 'index'])
    ->name('exportPage');
Route::post('/exportPage/code', [ExportPageController::class, 'exportCodes'])
    ->name('exportPage.code');
Route::post('/exportPage/customer', [ExportPageController::class, 'exportCustomers'])
    ->name('exportPage.customer');
Route::get('/exportPage/{code}', [ExportPageController::class, 'show'])
    ->name('exportPage.show');

Route::post('/puzzleCode/bulkExportPDF', [PuzzleCodeController::class, 'bulkExportPDF'])
    ->name('puzzleCodes.bulkExportPDF');
Route::post('/puzzleCode/bulkExportXLS', [PuzzleCodeController::class, 'bulkExportXLS'])
    ->name('puzzleCodes.bulkExportXLS');

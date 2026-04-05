<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

use App\Http\Controllers\DivisionAuditExportController;

Route::get('/export/{record}', [DivisionAuditExportController::class, 'export'])
    ->name('export');
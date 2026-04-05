<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

use App\Http\Controllers\api\LocationController;
use App\Http\Controllers\api\DepartmentController;
use App\Http\Controllers\api\ReasonController;

use App\Http\Controllers\api\DivisonAuditController;

Route::apiResource('audits', DivisonAuditController::class);
Route::get('audits-summary', [DivisonAuditController::class, 'summary']);

Route::apiResource('reasons', ReasonController::class);
Route::get('departments/{id}/reasons', [ReasonController::class, 'byDepartment']);

Route::apiResource('departments', DepartmentController::class);
Route::get('locations/{id}/departments', [DepartmentController::class, 'byLocation']);

Route::apiResource('locations', LocationController::class);
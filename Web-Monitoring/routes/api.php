<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IssueController;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
// Rute ini otomatis akan menjadi: /api/report-bug
Route::middleware('api.key')->post('/report-bug', [IssueController::class, 'apiStore']);
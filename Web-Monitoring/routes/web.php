<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\IssueController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/issues', function () {
    return view('Issues');
});
Route::get('/projects', function () {
    return view('Projects');
});
Route::get('/team', function () {
    return view('Team');
});
Route::get('/settings', function () {
    return view('Settings');
});
Route::get('/notification', function () {
    return view('Notification');
});
Route::get('/report-bug', function () {
    return view('Report_Bug');
});
Route::get('/profile', function () {
    return view('Profile');
});
Route::get('/activity-history', function () {
    return view('Activity_History');
});
Route::get('/edit-team', function () {
    return view('Edit_Team');
});
Route::get('/project-view', function () {
    return view('Project_View');
});

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::middleware(['auth'])->group(function () {
    Route::get('/', function () { return view('dashboard'); })->name('dashboard'); 
    Route::get('/profile', function () { return view('profile'); });
    Route::post('/profile/update', [AuthController::class, 'updateProfile'])->name('profile.update');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/issues', [IssueController::class, 'index'])->name('issues.index');
Route::get('/issues/{id}', [IssueController::class, 'show'])->name('issues.show');
});


// Endpoint: http://localhost:8000/api/report-bug
Route::post('/report-bug', [IssueController::class, 'apiStore']);
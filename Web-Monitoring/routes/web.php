<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('dashboard');
});
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


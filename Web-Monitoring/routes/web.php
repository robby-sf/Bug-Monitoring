<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\IssueController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingsController;

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

    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', function () { return view('profile'); });
    Route::post('/profile/update', [AuthController::class, 'updateProfile'])->name('profile.update');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/issues', [IssueController::class, 'index'])->name('issues.index');
    Route::get('/issues/{id}', [IssueController::class, 'show'])->name('issues.show');
    Route::patch('/issues/{id}/assign', [IssueController::class, 'assign'])->name('issues.assign');
    Route::patch('/issues/{id}/resolve', [IssueController::class, 'resolve'])->name('issues.resolve');
    Route::get('/report-bug', [IssueController::class, 'create'])->name('issues.create');
    Route::post('/report-bug', [IssueController::class, 'store'])->name('issues.store');
    Route::get('/activity', [ActivityController::class, 'index'])->name('activity.index');
    Route::get('/team', [TeamController::class, 'index'])->name('team.index');
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile/avatar', [ProfileController::class, 'removeAvatar'])->name('profile.remove_avatar');
    Route::get('/settings', [SettingsController::class, 'index'])->name('settings.index');
    Route::post('/settings/api-keys', [SettingsController::class, 'generateApiKey'])->name('settings.api.generate');
    Route::put('/settings/api-keys/{id}/regenerate', [SettingsController::class, 'regenerateApiKey'])->name('settings.api.regenerate');
    Route::delete('/settings/api-keys/{id}/revoke', [SettingsController::class, 'revokeApiKey'])->name('settings.api.revoke');
    Route::post('/notifications/read-all', function () {auth()->user()->unreadNotifications->markAsRead();return back();})->name('notifications.readAll');
});

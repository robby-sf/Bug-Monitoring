<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\IssueController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingsController;

Route::middleware('guest')->group(function () {
    Route::controller(AuthController::class)->group(function () {
        Route::get('/login', 'showLogin')->name('login');
        Route::post('/login', 'login');
        Route::get('/register', 'showRegister')->name('register');
        Route::post('/register', 'register');
    });
});

Route::middleware(['auth'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::controller(ProfileController::class)->group(function () {
        Route::get('/profile', 'index')->name('profile.index');
        Route::put('/profile/update', 'update')->name('profile.update');
        Route::delete('/profile/avatar', 'removeAvatar')->name('profile.remove_avatar');
    });

    Route::controller(IssueController::class)->group(function () {
        Route::get('/issues', 'index')->name('issues.index');
        Route::get('/issues/{id}', 'show')->name('issues.show');
        Route::patch('/issues/{id}/assign', 'assign')->name('issues.assign');
        Route::patch('/issues/{id}/resolve', 'resolve')->name('issues.resolve');
        Route::get('/report-bug', 'create')->name('issues.create');
        Route::post('/report-bug', 'store')->name('issues.store');
    });

    Route::controller(SettingsController::class)->group(function () {
        Route::get('/settings', 'index')->name('settings.index');
        Route::post('/settings/api-keys', 'generateApiKey')->name('settings.api.generate');
        Route::put('/settings/api-keys/{id}/regenerate', 'regenerateApiKey')->name('settings.api.regenerate');
        Route::delete('/settings/api-keys/{id}/revoke', 'revokeApiKey')->name('settings.api.revoke');
    });

    Route::get('/team', [TeamController::class, 'index'])->name('team.index');
    Route::get('/activity', [ActivityController::class, 'index'])->name('activity.index');

    Route::post('/notifications/read-all', function () {
        auth()->user()->unreadNotifications->markAsRead();
        return back();
    })->name('notifications.readAll');

    Route::get('/projects', function () { return view('Projects'); });
    Route::get('/project-view', function () { return view('Project_View'); });
    Route::get('/edit-team', function () { return view('Edit_Team'); });
    Route::get('/notification', function () { return view('Notification'); });
    Route::get('/activity-history', function () { return view('Activity_History'); });
});
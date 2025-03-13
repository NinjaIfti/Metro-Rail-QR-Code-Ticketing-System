<?php

use App\Http\Controllers\CommuterController;
use App\Http\Controllers\TrainMasterController;
use App\Http\Controllers\AdminController;

Route::middleware(['auth', 'role:commuter'])->group(function () {
    Route::get('/dashboard', [CommuterController::class, 'dashboard']);
    Route::get('/buy-ticket', [CommuterController::class, 'buyTicket']);
    Route::get('/schedule', [CommuterController::class, 'viewSchedule']);
});

Route::middleware(['auth', 'role:train_master'])->group(function () {
    Route::get('/train-master/dashboard', [TrainMasterController::class, 'dashboard']);
    Route::get('/schedule/edit', [TrainMasterController::class, 'editSchedule']);
    Route::post('/announcement', [TrainMasterController::class, 'postAnnouncement']);
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard']);
    Route::get('/users', [AdminController::class, 'manageUsers']);
});

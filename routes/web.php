<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;

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

// Public routes
Route::view('/', 'welcome');
Route::view('buy-ticket', 'layouts.tickets')->name('buy-tickets');
Route::view('FAQ', 'layouts.faq')->name('FAQ');
Route::view('SCHEDULE', 'layouts.schedule')->name('SCHEDULE');
Route::view('Login', 'layouts.login')->name('Login');
Route::view('Register', 'layouts.signUp')->name('Register');
Route::view('CONTACT', 'layouts.contact')->name('CONTACT');
Route::view('logout', 'layouts.logout')->name('logout');
// Protected routes
Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

// Admin routes
Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    // User management
    Route::get('/users', [AdminController::class, 'users'])->name('admin.users');
    Route::get('/users/create', [AdminController::class, 'createUser'])->name('admin.users.create');
    Route::post('/users', [AdminController::class, 'storeUser'])->name('admin.users.store');
    Route::put('/users/{id}', [AdminController::class, 'updateUser'])->name('admin.users.update');
    Route::delete('/users/{id}', [AdminController::class, 'deleteUser'])->name('admin.users.delete');
    Route::get('/users/{id}/edit', [AdminController::class, 'editUser'])->name('admin.users.edit');
    Route::get('/users/{id}', [AdminController::class, 'showUserDetails']);
    Route::delete('/users/{id}', [AdminController::class, 'deleteUser'])->name('admin.users.delete');


    // Announcements
    Route::get('/announcements', [AdminController::class, 'announcements'])->name('admin.announcements');
    Route::get('/announcements/create', [AdminController::class, 'createAnnouncement'])->name('admin.announcements.create');
    Route::post('/announcements', [AdminController::class, 'storeAnnouncement'])->name('admin.announcements.store');
    Route::get('/announcements/{id}/edit', [AdminController::class, 'editAnnouncement'])->name('admin.announcements.edit');
    Route::put('/announcements/{id}', [AdminController::class, 'updateAnnouncement'])->name('admin.announcements.update');
    Route::delete('/announcements/{id}', [AdminController::class, 'deleteAnnouncement'])->name('admin.announcements.delete');

    // Train management
    Route::get('/trains', [AdminController::class, 'trains'])->name('admin.trains');
    Route::get('/trains/create', [AdminController::class, 'createTrain'])->name('admin.trains.create');
    Route::post('/trains', [AdminController::class, 'storeTrain'])->name('admin.trains.store');
    Route::get('/trains/{id}/edit', [AdminController::class, 'editTrain'])->name('admin.trains.edit');
    Route::put('/trains/{id}', [AdminController::class, 'updateTrain'])->name('admin.trains.update');
    Route::delete('/trains/{id}', [AdminController::class, 'deleteTrain'])->name('admin.trains.delete');
    Route::get('/trains/{id}/details', [AdminController::class, 'showTrainDetails'])->name('admin.trains.details');
   // Schedule management
   Route::get('/schedules', [AdminController::class, 'schedules'])->name('admin.schedules');
   Route::post('/schedules', [AdminController::class, 'storeSchedule'])->name('admin.schedules.store');
   Route::get('/schedules/{id}', [AdminController::class, 'getSchedule'])->name('admin.schedules.get');
   Route::get('/schedules/{id}/details', [AdminController::class, 'showScheduleDetails'])->name('admin.schedules.details');
   Route::put('/schedules/{id}', [AdminController::class, 'updateSchedule'])->name('admin.schedules.update');
   Route::delete('/schedules/{id}', [AdminController::class, 'deleteSchedule'])->name('admin.schedules.delete');

    // Ticket management
    Route::get('/tickets', [AdminController::class, 'tickets'])->name('admin.tickets');
    Route::get('/tickets/{id}', [AdminController::class, 'showTicket'])->name('admin.tickets.show');
    Route::delete('/tickets/{id}', [AdminController::class, 'deleteTicket'])->name('admin.tickets.delete');

    // Reports
    Route::get('/reports', [AdminController::class, 'reports'])->name('admin.reports');
    Route::get('/reports/generate', [AdminController::class, 'generateReport'])->name('admin.reports.generate');

    // Settings
    Route::get('/settings', [AdminController::class, 'settings'])->name('admin.settings');
    Route::post('/settings', [AdminController::class, 'updateSettings'])->name('admin.settings.update');



});

// Train Master routes
Route::prefix('train-master')->middleware(['auth', 'role:train_master'])->name('train_master.')->group(function () {
    // Dashboard
    Route::get('/dashboard', [App\Http\Controllers\TrainMasterController::class, 'dashboard'])->name('dashboard');

    // Announcements - reusing similar routes as admin but with train master controller
    Route::get('/announcements', [App\Http\Controllers\TrainMasterController::class, 'announcements'])->name('announcements');
    Route::get('/announcements/create', [App\Http\Controllers\TrainMasterController::class, 'createAnnouncement'])->name('announcements.create');
    Route::post('/announcements', [App\Http\Controllers\TrainMasterController::class, 'storeAnnouncement'])->name('announcements.store');
    Route::get('/announcements/{id}/edit', [App\Http\Controllers\TrainMasterController::class, 'editAnnouncement'])->name('announcements.edit');
    Route::put('/announcements/{id}', [App\Http\Controllers\TrainMasterController::class, 'updateAnnouncement'])->name('announcements.update');
    Route::delete('/announcements/{id}', [App\Http\Controllers\TrainMasterController::class, 'deleteAnnouncement'])->name('announcements.delete');

    // Schedule management - reusing similar routes as admin but with train master controller
    Route::get('/schedules', [App\Http\Controllers\TrainMasterController::class, 'schedules'])->name('schedules');
    Route::post('/schedules', [App\Http\Controllers\TrainMasterController::class, 'storeSchedule'])->name('schedules.store');
    Route::get('/schedules/{id}', [App\Http\Controllers\TrainMasterController::class, 'getSchedule'])->name('schedules.get');
    Route::get('/schedules/{id}/details', [App\Http\Controllers\TrainMasterController::class, 'showScheduleDetails'])->name('schedules.details');
    Route::put('/schedules/{id}', [App\Http\Controllers\TrainMasterController::class, 'updateSchedule'])->name('schedules.update');
    Route::delete('/schedules/{id}', [App\Http\Controllers\TrainMasterController::class, 'deleteSchedule'])->name('schedules.delete');
});

// Include Laravel's auth routes
require __DIR__.'/auth.php';

Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Public announcements route
Route::get('/announcements', function() {
    $announcements = \App\Models\Announcement::with('user')
                    ->active()
                    ->orderBy('priority', 'desc')
                    ->orderBy('published_at', 'desc')
                    ->paginate(10);
    return view('layouts.announcements', compact('announcements'));
})->name('announcements');
// temporary train master
Route::get('/create-train-master', [AuthController::class, 'createDefaultTrainMaster']);

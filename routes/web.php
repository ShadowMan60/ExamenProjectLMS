<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

Route::get('/', function () {
    return view('welcome');
});

// Other guest routes
Route::post('/start', [\App\Http\Controllers\GuestController::class, 'store'])->name('guest.start');
Route::get('/selectquiz', fn() => view('selectquiz'))->name('selectquiz');

// Admin login routes
Route::get('/adminacces', function () {
    return view('adminacces');
})->name('admin.login.form');

Route::post('/admin/login', [AdminController::class, 'login'])->name('admin.login');

Route::get('/admin/editquiz', [AdminController::class, 'editquiz'])->name('admin.editquiz');

// Route to add the admin user (be sure to remove or protect this in production)
Route::get('/addadminuser', [AdminController::class, 'addAdminUser']);

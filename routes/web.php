<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/start', [\App\Http\Controllers\GuestController::class, 'store'])->name('guest.start');
Route::get('/selectquiz', fn() => view('selectquiz'))->name('selectquiz');

Route::get('/adminacces', function () {
    return view('adminacces');
})->name('admin.access');

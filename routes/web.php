<?php

use App\Http\Controllers\AttendanceController;
use Filament\Facades\Filament;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect("/admin/login");
});

// Route::get('/attendance', function () {
//     return view('pages.attendance');
// });

Route::get('/attendance', function () {
    return view('pages.attendance');
});

Route::get('/succes', function () {
    return view('pages.succes');
});

Route::get('/eror-location', function () {
    return view('pages.error-location');
});

Route::get('/eror-attendance', function () {
    return view('pages.error-attendance');
});

// route untuk absen
Route::get('/dummy', [AttendanceController::class, 'create'])->name('attendance.create');
Route::post('/dummy', [AttendanceController::class, 'store'])->name('attendance.store');
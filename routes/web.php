<?php

use Filament\Facades\Filament;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect("/admin/login");
});

Route::get('/attendance', function () {
    return view('pages.attendance');
});

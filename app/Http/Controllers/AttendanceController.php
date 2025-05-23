<?php

namespace App\Http\Controllers;

use App\Http\Requests\AttendanceRequest;
use App\Models\Attendance;
use Filament\Facades\Filament;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function create()
    {
        $attendance = Attendance::all();
        return view('pages.attendance', compact('attendance'));
    }

    public function user()
    {
        $user = Filament::auth()->user();
        return view('pages.attendance', compact('user'));
    }
}

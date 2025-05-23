<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Attendance;
use Illuminate\Http\Request;
use Filament\Facades\Filament;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\AttendanceRequest;

class AttendanceController extends Controller
{
    public function create()
    {
        $attendance = Attendance::all();
        return view('pages.attendance', compact('attendance'));
    }

    public function attendance(AttendanceRequest $request)
    {
        $data = $request->validated();
        $user = Filament::auth()->user();

        DB::beginTransaction();

        try {
            $attendance = new Attendance($data);
            $attendance->user_id = $user->id;
            $attendance->latitude = $data['latitude'];
            $attendance->longitude = $data['longitude'];
            $attendance->foto = $data['foto'];
            $attendance->desc = $data['desc'];
            $attendance->status_id = $data['status_id'];
            $attendance->save();
            
            DB::commit();


        } catch (Exception $e) {
            return response()->json([
                    'message' => 'Terjadi Kesalahan',
                    'massage' => $e->getMessage(),
                ], 500);
        }
    }
}

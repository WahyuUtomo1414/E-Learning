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
            $attendance->status_id = 1;

            // Cek apakah user sudah absen hari ini
            // $attendance = Attendance::where('user_id', $request->user_id)
            //     ->whereDate('create_at', now()->toDateString())
            //     ->first();

            // if (!$attendance) {
            //     return redirect('/admin/attendances')->back()->with('error', 'Anda sudah melakukan absen masuk hari ini!');
            // }

            // // Cek apakah absen terlambat atau tidak
            // $schoolStartTime = $user->school_id->school_start_time ?? '07:00:00';
            // $currentTime = now()->format('H:i:s');

            // if ($currentTime > $schoolStartTime) {
            //     $attendance->status_id = 5;
            // }

            $attendance->save();
            DB::commit();

        return response()->redirectTo('/succes')->with('success', 'Absensi Berhasil Dilakukan');

        } catch (Exception $e) {
            return response()->redirectTo('/eror-attendance')
                ->with('error', 'Absensi Gagal Dilakukan: ' . $e->getMessage());
        }
    }
}

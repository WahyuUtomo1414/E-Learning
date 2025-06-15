<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Attendance;
use Illuminate\Http\Request;
use Filament\Facades\Filament;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\AttendanceRequest;

class AttendanceController extends Controller
{
    public function create()
    {
        $attendance = Attendance::all();
        return view('pages.dummy', compact('attendance'));
    }

    public function store(AttendanceRequest $request)
    {
        try {
            $validated = $request->validated();
            // $attendance = Attendance::create([
            //     'user_id' => Filament::auth()->user(),
            //     'latitude' => $request->latitude,
            //     'longitude' => $request->longitude,
            //     'desc' => $request->desc,
            //     'status_id' => $request->status_id
            // ]);
            $validated['foto'] = $this->processImage($validated['foto']);

            $attendance = new Attendance();
            $attendance->fill($validated);
            $attendance->save();

            // Cek apakah user sudah absen hari ini
            // $attendance = Attendance::where('user_id', $request->user_id)
            //     ->whereDate('created_at', now()->toDateString())
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

            return redirect('/success')->with('success', 'Absensi berhasil!');

        } catch (Exception $e) {
            return response()->redirectTo('/eror-attendance')
                ->with('error', 'Absensi Gagal Dilakukan: ' . $e->getMessage());
        }
    }

    private function processImage($base64Image)
    {
        $imageParts = explode(";base64,", $base64Image);
        if (count($imageParts) === 2) {
            $base64Image = $imageParts[1]; 
        }

        $imageData = base64_decode($base64Image);
        if ($imageData === false) {
            return back()->with('error', 'Gagal mengkonversi gambar.');
        }

        $imageName = uniqid() . '.png';
        Storage::disk('absensi')->put($imageName, $imageData);

        return "absensi_images/{$imageName}";
    }
}

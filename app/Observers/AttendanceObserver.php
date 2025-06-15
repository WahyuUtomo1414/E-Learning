<?php

namespace App\Observers;

use Exception;
use App\Models\Attendance;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\AttendanceRequest;
use Filament\Facades\Filament;

class AttendanceObserver
{
    /**
     * Handle the Attendance "created" event.
     */
    public function creating(Attendance $attendance): void
    {
        $user = Filament::auth()->user();

        if (request()->has('foto')) {
            $imageData = request()->input('foto');

            // Validasi format base64
            if (preg_match('/^data:image\/(\w+);base64,/', $imageData, $type)) {
                $image = substr($imageData, strpos($imageData, ',') + 1);
                $image = base64_decode($image);

                if ($image === false) {
                    throw new Exception('Base64 decoding error.');
                }

                $imageExtension = strtolower($type[1]); // jpg/png
                $imageName = 'absen_' . $user->id . '_' . time() . '.' . $imageExtension;

                // Simpan gambar ke storage
                Storage::disk('public')->put("absensi/{$imageName}", $image);

                // Simpan nama file ke kolom 'foto'
                $attendance->foto = $imageName;
            } else {
                throw new Exception('Invalid image format.');
            }
        } else {
            throw new Exception('Foto tidak ditemukan.');
        }

        $attendance->user_id = $user->id;
    }

    public function created(Attendance $attendance): void
    {
        //
    }

    /**
     * Handle the Attendance "updated" event.
     */
    public function updated(Attendance $attendance): void
    {
        //
    }

    /**
     * Handle the Attendance "deleted" event.
     */
    public function deleted(Attendance $attendance): void
    {
        //
    }

    /**
     * Handle the Attendance "restored" event.
     */
    public function restored(Attendance $attendance): void
    {
        //
    }

    /**
     * Handle the Attendance "force deleted" event.
     */
    public function forceDeleted(Attendance $attendance): void
    {
        //
    }
}

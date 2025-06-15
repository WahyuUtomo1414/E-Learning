<?php

namespace App\Observers;

use Exception;
use App\Models\Attendance;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\AttendanceRequest;

class AttendanceObserver
{
    /**
     * Handle the Attendance "created" event.
     */
    public function creating(AttendanceRequest $request, Attendance $attendance): void
    {
        // Proses gambar base64
        if ($request->has('foto')) {
            $imageData = $request->input('foto');

            // Validasi: cek apakah format base64 valid
            if (preg_match('/^data:image\/(\w+);base64,/', $imageData, $type)) {
                $image = substr($imageData, strpos($imageData, ',') + 1);
                $image = base64_decode($image);

                if ($image === false) {
                    throw new Exception('Base64 decoding error.');
                }

                $imageExtension = strtolower($type[1]); // jpg, png, gif, etc.
                $imageName = 'absen_' . $user->id . '_' . time() . '.' . $imageExtension;

                // Simpan ke storage/app/public/absensi/
                Storage::disk('public')->put("absensi/{$imageName}", $image);
            } else {
                throw new Exception('Invalid image format.');
            }
        } else {
            throw new Exception('Foto tidak ditemukan.');
        }
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

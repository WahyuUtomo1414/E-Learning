<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="images/2.png" type="image/png" sizes="16x16">
    @vite('resources/css/app.css')
    <title>Dummy</title>
</head>
<body class="bg-gray-200">

    @php
        use Filament\Facades\Filament;
        $user = Filament::auth()->user();
    @endphp
    
    <div class="max-w-[420px] h-[800px] shadow-lg border-2 border-gray-200 rounded-lg bg-white mx-auto">
        <div class="px-6 h-[210px] bg-gradient-to-r from-sky-900 to-sky-700 text-white flex flex-col justify-between border-b-8 border-amber-500 py-7">
            <!-- Logo dan Nama Sekolah -->
            <div class="flex items-center">
                <div class="flex items-center gap-2">
                    <img src="{{ asset('images/2.png') }}" alt="Logo Sekolah" class="w-8 h-8 object-contain" />
                    <div class="text-sm font-semibold">SMK PATRIOT NUSANTARA</div>
                </div>
            </div>

            <!-- Profil -->
            <div class="flex items-center gap-4">
                <img src="{{ Storage::disk('avatars')->url($user->avatar_url) }}" class="w-14 h-14 rounded-full object-cover border-2 border-white" alt="User" />
                <div>
                    <div class="font-semibold text-md">{{ $user->name }}</div>
                    <div class="text-sm text-blue-200">Filsafat Komputer 12 - A</div>
                </div>
            </div>
        </div>

        <div class="relative bg-gradient-to-br from-white to-gray-100 text-black max-w-[380px] h-auto mx-auto -mt-6 p-4 rounded-2xl shadow-lg hover:shadow-xl border border-gray-200 justify-items-center">
            <img src="{{ asset('images/iconabsen.png') }}" class="w-10 h-10 object-cover border border-gray-100" alt="icon absen" />
            <h1 class="text-xl font-semibold text-center">Absensi Siswa</h1>
            <h2 class="text-lg text-center">
                {{ \Carbon\Carbon::now()->locale('id')->translatedFormat('l, d F Y') }}
            </h2>
        </div>   
    </div>
</body>
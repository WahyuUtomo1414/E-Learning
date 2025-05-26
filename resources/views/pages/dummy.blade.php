<x-layouts.base :title="'Dummy'">
    <div class="max-w-[430px] sm:max-w-[400px] h-[800px] shadow-lg bg-white mx-auto font-inter">
        
        <!-- Header -->
        <div class="px-6 h-auto rounded-b-3xl bg-gradient-to-bl from-sky-900 to-sky-700 text-white flex flex-col justify-between border-b-12 border-yellow-500 py-7">
            <!-- Logo dan Nama Sekolah -->
            <div class="flex justify-center pb-2">
                <div class="flex items-center gap-2">
                    <img src="{{ asset('images/2.png') }}" alt="Logo Sekolah" class="w-6 h-6 object-contain" />
                    <div class="text-xs font-semibold">SMK PATRIOT NUSANTARA</div>
                </div>
            </div>

            <!-- Profil -->
            <div class="flex items-center gap-4 py-2">
                <img src="{{ Storage::disk('avatars')->url($user->avatar_url) }}" class="w-14 h-14 rounded-full object-cover border-3 border-white" alt="User" />
                <div>
                    <div class="font-semibold text-md">{{ $user->name }}</div>
                    <div class="text-sm text-gray-200">Filsafat Komputer 12 - A</div>
                </div>
            </div>
        </div>

        <!-- Card DateTime -->
        <div class="relative bg-gradient-to-br from-white to-gray-100 text-black max-w-[380px] h-auto mx-auto -mt-6 p-4 rounded-2xl shadow-lg hover:shadow-xl border border-gray-200 justify-items-center">
            <img src="{{ asset('images/iconabsen.png') }}" class="w-10 h-10 object-cover border border-gray-100" alt="icon absen" />
            <h1 class="text-xl font-semibold text-center">Absensi Siswa</h1>
            <h2 class="text-lg text-center">
                {{ \Carbon\Carbon::now()->locale('id')->translatedFormat('l, d F Y') }}
            </h2>
        </div>   
    </div>
</x-layouts.base>
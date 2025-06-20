<x-layouts.base :title="'succes'">
    <div class="max-w-[420px] min-h-screen flex flex-col justify-center shadow-lg bg-gradient-to-bl from-white to-sky-100 mx-auto p-6">
        
        <div>
            {{-- Gambar Ilustrasi--}}
            <div class="w-[250px] sm:w-[300px] mx-auto mb-8"> 
                <img src="{{ asset('images/succes2.png') }}" alt="Ilustrasi absensi berhasil" class="w-full object-cover">
            </div>

            {{--Tulisan Massage --}}
            <div class="text-center font-inter mx-2 sm:mx-4"> 
                <h1 class="text-2xl font-semibold py-2 text-sky-800" style="text-shadow: 1px 1px 3px #b3c6ff;">Absensi Berhasil</h1>
                <p class="text-sm px-2 mt-2">
                    Selamat pagi <span class="font-semibold font-inter">{{ $user->name }}</span>, data kehadiran kamu telah dicatat. Silakan lanjutkan aktivitas pembelajaran.
                </p>
                {{-- Opsional: Tambah waktu absensi --}}
                <p class="text-xs text-gray-600 mt-1">
                    Dicatat pada: {{ now()->setTimezone('Asia/Jakarta')->format('d M Y, H:i') }} WIB
                </p>
            </div>

            {{-- Tombol kembali --}}
            <div class="mt-10 text-center"> 
                <a href="/admin/attendances"
                    class="inline-block bg-sky-900 text-white px-10 py-3 rounded-lg hover:bg-sky-800 transition-all duration-200 text-lg font-semibold font-inter shadow-md hover:shadow-lg">
                    Kembali
                </a>
            </div>
        </div>

    </div>
</x-layouts.base>
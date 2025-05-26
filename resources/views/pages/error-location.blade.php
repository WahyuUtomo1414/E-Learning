<x-layouts.base :title="'Lokasi-Eror'">
    <div class="max-w-[420px] min-h-screen flex flex-col justify-center shadow-lg bg-gradient-to-bl from-white to-sky-100 mx-auto p-6">
        
        <div>
            {{-- Gambar Ilustrasi--}}
            <div class="w-[250px] sm:w-[300px] mx-auto mb-8"> 
                <img src="{{ asset('images/location.png') }}" alt="Ilustrasi absensi berhasil" class="w-full object-cover">
            </div>

            {{--Tulisan Massage --}}
            <div class="text-center font-inter mx-2 sm:mx-4"> 
                <h1 class="text-2xl font-semibold py-2 text-sky-800" style="text-shadow: 1px 1px 2px #ffcccc;">
                    Lokasi Tidak Sesuai
                </h1>
                <p class="text-sm px-2 mt-2">
                    Maaf, <span class="font-semibold">{{ $user->name }}</span>. Absensi gagal karena lokasi anda di luar sekolah.
                </p>
                <p class="text-xs text-gray-600 mt-3">
                    Pastikan anda berada di area sekolah. Jika masih bermasalah, hubungi <span class="font-semibold">[Admin / Wali Kelas].</span>
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
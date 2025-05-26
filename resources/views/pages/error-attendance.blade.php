<x-layouts.base :title="'Absensi-Eror'">
    <div class="max-w-[420px] min-h-screen flex flex-col justify-center shadow-lg bg-gradient-to-bl from-white to-sky-100 mx-auto p-6">
        
        <div>
            {{-- Gambar Ilustrasi--}}
            <div class="w-[250px] sm:w-[300px] mx-auto mb-8"> 
                <img src="{{ asset('images/error.png') }}" alt="Ilustrasi absensi berhasil" class="w-full object-cover">
            </div>

            {{--Tulisan Massage --}}
            <div class="text-center font-inter mx-2 sm:mx-4"> 
                <h1 class="text-2xl font-semibold py-2 text-sky-800" style="text-shadow: 1px 1px 2px #ffcccc;">
                    Absensi Gagal
                </h1>
                <p class="text-sm px-2 mt-2">
                    Maaf, <span class="font-semibold">{{ $user->name }}</span>. Absensi anda gagal, silakan hubungi <span class="font-semibold">Admin / Wali Kelas.</span>
                </p>
                <p class="text-xs text-gray-600 mt-3">
                    Pastikan jaringan internet stabil dan berada di area sekolah.
                </p>
            </div>



        </div>
    </div>    
</x-layouts.base>
<x-layouts.base :title="'Absensi-Eror'">
    <div class="max-w-[420px] min-h-screen flex flex-col justify-center shadow-lg bg-gradient-to-bl from-white to-sky-100 mx-auto p-6">
        
        <div>
            {{-- Gambar Ilustrasi--}}
            <div class="w-[250px] sm:w-[300px] mx-auto mb-8"> 
                <img src="{{ asset('images/error.png') }}" alt="Ilustrasi absensi berhasil" class="w-full object-cover">
            </div>


        </div>
    </div>    
</x-layouts.base>
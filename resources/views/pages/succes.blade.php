<x-layouts.base :title="'succes'">
    <div class="max-w-[420px] shadow-lg bg-white mx-auto">
        <div class="py-12"></div>
        <div class="w-[300px] mx-auto flex justify-center pt-12">
            <img src="{{ asset('images/succes.png') }}" alt="succes" class="w-full object-cover">
        </div>

        <div class="text-center font-monospace mt-4 mx-4">
            <h1 class="text-xl font-semibold py-2 text-blue-800" style="text-shadow: 1px 1px 3px #b3c6ff;">Attendance Succes</h1>
            <h3 class="text-sm px-2">Selamat pagi, <span class="font-semibold">{{ $user->name }}</span> Data kehadiran Kamu telah dicatat. Silakan lanjutkan aktivitas pembelajaran.</h3>
        </div>

        <a href="/admin/attendances">
            <div class="flex justify-center items-center py-10 shadow-lg font-sans">
                <button class="bg-sky-900 text-white p-2 py-2 rounded-lg hover:bg-sky-800 transition-all duration-200 text-[18px] font-semibold w-[340px]">
                    Kembali
                </button>
            </div>
        </a>
    </div>
</x-layouts.base>
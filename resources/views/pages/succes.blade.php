<x-layouts.base :title="'succes'">
    <div class="max-w-[420px] h-[800px] shadow-lg bg-white mx-auto">
        <div class="py-12"></div>
        <div class="w-[300px] mx-auto flex justify-center pt-12">
            <img src="{{ asset('images/succes.png') }}" alt="succes" class="w-full object-cover">
        </div>

        <div class="text-center font-monospace mt-4 mx-4">
            <h1 class="text-xl font-semibold py-2 text-blue-800" style="text-shadow: 1px 1px 3px #b3c6ff;">Attendance Succes</h1>
            <h3 class="text-sm px-2">Selamat pagi, <span class="font-semibold">{{ $user->name }}</span> Data kehadiran Kamu telah dicatat. Silakan lanjutkan aktivitas pembelajaran.</h3>
        </div>
    </div>
</x-layouts.base>
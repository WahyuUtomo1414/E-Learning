<x-layouts.base :title="'Dummy'">

    <div class="max-w-[430px] sm:max-w-[400px] h-auto shadow-lg bg-white mx-auto font-inter">
        
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
                    <div class="font-semibold text-sm">{{ $user->name }} • <span class="font-light text-gray-200">19210852</span></div>
                    <!-- <div class="font-semibold text-sm">19210852</div> -->
                    <div class="text-sm text-gray-200">Filsafat Komputer 12 - A</div>
                </div>
            </div>
        </div>

        <!-- Card DateTime -->
        <div class="relative bg-gradient-to-bl from-white to-blue-100 text-black max-w-[calc(100%-2rem)] sm:max-w-[360px] h-auto mx-auto -mt-8 p-5 sm:p-6 rounded-2xl shadow-lg border-gray-200
            flex flex-col items-center justify-center text-center gap-1 ring-1 ring-sky-700">
                    
            <svg fill="#194885" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 610.398 610.398" xml:space="preserve" stroke="#194885"
                class="w-10 h-10 sm:w-12 sm:h-12 mb-1" {{-- Kelas dari img tag diterapkan di sini --}}
                role="img" {{-- Tambahan untuk aksesibilitas --}}
                aria-labelledby="svgTitleIconAbsen">
                <title id="svgTitleIconAbsen">Ikon Absen</title> {{-- Pengganti alt text untuk aksesibilitas --}}
                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                <g id="SVGRepo_iconCarrier"> <g> <g>
                    <path d="M159.567,0h-15.329c-1.956,0-3.811,0.411-5.608,0.995c-8.979,2.912-15.616,12.498-15.616,23.997v10.552v27.009v14.052 c0,2.611,0.435,5.078,1.066,7.44c2.702,10.146,10.653,17.552,20.158,17.552h15.329c11.724,0,21.224-11.188,21.224-24.992V62.553 V35.544V24.992C180.791,11.188,171.291,0,159.567,0z"></path>
                    <path d="M461.288,0h-15.329c-11.724,0-21.224,11.188-21.224,24.992v10.552v27.009v14.052c0,13.804,9.5,24.992,21.224,24.992 h15.329c11.724,0,21.224-11.188,21.224-24.992V62.553V35.544V24.992C482.507,11.188,473.007,0,461.288,0z"></path>
                    <path d="M539.586,62.553h-37.954v14.052c0,24.327-18.102,44.117-40.349,44.117h-15.329c-22.247,0-40.349-19.79-40.349-44.117 V62.553H199.916v14.052c0,24.327-18.102,44.117-40.349,44.117h-15.329c-22.248,0-40.349-19.79-40.349-44.117V62.553H70.818 c-21.066,0-38.15,16.017-38.15,35.764v476.318c0,19.784,17.083,35.764,38.15,35.764h468.763c21.085,0,38.149-15.984,38.149-35.764 V98.322C577.735,78.575,560.671,62.553,539.586,62.553z M527.757,557.9l-446.502-0.172V173.717h446.502V557.9z"></path>
                    <path d="M353.017,266.258h117.428c10.193,0,18.437-10.179,18.437-22.759s-8.248-22.759-18.437-22.759H353.017 c-10.193,0-18.437,10.179-18.437,22.759C334.58,256.074,342.823,266.258,353.017,266.258z"></path>
                    <path d="M353.017,348.467h117.428c10.193,0,18.437-10.179,18.437-22.759c0-12.579-8.248-22.758-18.437-22.758H353.017 c-10.193,0-18.437,10.179-18.437,22.758C334.58,338.288,342.823,348.467,353.017,348.467z"></path>
                    <path d="M353.017,430.676h117.428c10.193,0,18.437-10.18,18.437-22.759s-8.248-22.759-18.437-22.759H353.017 c-10.193,0-18.437,10.18-18.437,22.759S342.823,430.676,353.017,430.676z"></path>
                    <path d="M353.017,512.89h117.428c10.193,0,18.437-10.18,18.437-22.759c0-12.58-8.248-22.759-18.437-22.759H353.017 c-10.193,0-18.437,10.179-18.437,22.759C334.58,502.71,342.823,512.89,353.017,512.89z"></path>
                    <path d="M145.032,266.258H262.46c10.193,0,18.436-10.179,18.436-22.759s-8.248-22.759-18.436-22.759H145.032 c-10.194,0-18.437,10.179-18.437,22.759C126.596,256.074,134.838,266.258,145.032,266.258z"></path>
                    <path d="M145.032,348.467H262.46c10.193,0,18.436-10.179,18.436-22.759c0-12.579-8.248-22.758-18.436-22.758H145.032 c-10.194,0-18.437,10.179-18.437,22.758C126.596,338.288,134.838,348.467,145.032,348.467z"></path>
                    <path d="M145.032,430.676H262.46c10.193,0,18.436-10.18,18.436-22.759s-8.248-22.759-18.436-22.759H145.032 c-10.194,0-18.437,10.18-18.437,22.759S134.838,430.676,145.032,430.676z"></path>
                    <path d="M145.032,512.89H262.46c10.193,0,18.436-10.18,18.436-22.759c0-12.58-8.248-22.759-18.436-22.759H145.032 c-10.194,0-18.437,10.179-18.437,22.759C126.596,502.71,134.838,512.89,145.032,512.89z"></path>
                </g> </g> </g>
            </svg>
                
            <h1 class="text-lg sm:text-xl font-semibold text-sky-800"> {{-- Warna disesuaikan --}}
                Absensi Siswa
            </h1>
            
            <p class="text-sm sm:text-base text-gray-600"> {{-- Tag diubah & warna disesuaikan --}}
                {{ \Carbon\Carbon::now()->locale('id')->translatedFormat('l, d F Y') }}
            </p>

            {{-- Di sini kita akan menambahkan konten yang lebih menarik --}}
            <div id="dynamic-attendance-content" class="mt-3 w-full">
                {{-- Konten dinamis akan masuk di sini --}}
            </div>
        </div>

        <form action="{{ route('attendance') }}" method="POST" enctype="multipart/form-data">
        @csrf
            {{-- hidden input Lokasi --}}
            <!-- Input Data User -->
            <input type="hidden" name="user_id" value="{{ $user->id }}">
            @error('user_id')
            <div class="text-red-500 text-sm">{{ $message }}</div>
            @enderror

            <!-- Input Data Lokasi -->
            <input type="hidden" name="latitude" id="latitude" value="{{ old('latitude') }}">
            @error('latitude')
            <div class="text-red-500 text-sm">{{ $message }}</div>
            @enderror
        
            <input type="hidden" name="longitude" id="longitude" value="{{ old('longitude') }}">
            @error('longitude')
            <div class="text-red-500 text-sm">{{ $message }}</div>
            @enderror

            <!-- Input Data Foto -->
            <input type="hidden" name="foto" id="fotoInput" value="{{ old('foto') }}">
            @error('foto')
            <div class="text-red-500 text-sm">{{ $message }}</div>
            @enderror

            <!-- Card Verifikasi Lokasi -->
            <div class="mx-auto my-4 p-6 flex flex-col items-center text-center">

            {{-- Ikon Lokasi --}}
            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
                class="w-14 h-14 sm:w-16 sm:h-16 text-sky-800"
                role="img" aria-labelledby="svgTitleIconLokasi">
                <title id="svgTitleIconLokasi">Ikon Lokasi</title>
                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                <g id="SVGRepo_iconCarrier">
                <path d="M12 21C15.5 17.4 19 14.1764 19 10.2C19 6.22355 15.866 3 12 3C8.13401 3 5 6.22355 5 10.2C5 14.1764 8.5 17.4 12 21Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                <path d="M12 12C13.1046 12 14 11.1046 14 10C14 8.89543 13.1046 8 12 8C10.8954 8 10 8.89543 10 10C10 11.1046 10.8954 12 12 12Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                </g>
            </svg>

            {{-- Judul dan Deskripsi --}}
            <div class="flex flex-col gap-1 w-full px-2 py-3">
                <h1 class="text-lg sm:text-xl font-semibold text-sky-800">Verifikasi Lokasi Anda</h1>
                <p class="text-xs sm:text-sm text-slate-600">
                Kami perlu memastikan Anda berada di area sekolah. Mohon aktifkan GPS Anda.
                </p>
            </div>

            {{-- Tombol Aksi & Indikator Loading --}}
            <div class="w-full max-w-[280px]">
                {{-- Tombol untuk mendapatkan lokasi --}}
                <button type="button" id="getLocation"
                    class="w-full bg-sky-800 text-white px-6 py-2.5 rounded-lg 
                    hover:bg-sky-700 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:ring-offset-2
                    transition-all duration-300 ease-in-out text-sm font-semibold shadow-md hover:shadow-lg
                    flex items-center justify-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                    <path fill-rule="evenodd" d="M9.69 18.933l.003.001C9.89 19.02 10 19 10 19s.11.02.308-.066l.002-.001zm.612-1.426a.75.75 0 01-.308-.066L10 17.433l-.304.002a.75.75 0 01-.308.066l.002.001a.752.752 0 01-.308.066l-.003-.001a18.71 18.71 0 01-4.965-2.165l-.002-.001a18.709 18.709 0 01-4.21-11.123l.001-.002c0-3.517 2.748-6.437 6.437-6.437l.002.001h4.054l.002-.001c3.689 0 6.437 2.92 6.437 6.437l.001.002a18.71 18.71 0 01-4.21 11.123l-.002.001a18.71 18.71 0 01-4.965 2.165zM10 15c2.049 0 4.137-.963 5.566-2.748a.75.75 0 011.061 1.063A11.2 11.2 0 0110 16.5a11.2 11.2 0 01-6.627-3.185.75.75 0 111.06-1.063A9.7 9.7 0 0010 15zm0-3.75a.75.75 0 01.75.75v.008c0 .414-.336.75-.75.75s-.75-.336-.75-.75v-.008a.75.75 0 01.75-.75z" clip-rule="evenodd" />
                </svg>
                <span id="getLocationButtonText">Dapatkan Lokasi</span>
                <svg id="loadingSpinner" class="animate-spin -ml-1 mr-3 h-5 w-5 text-white hidden" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                </button>
                <div id="notification" class="hidden mt-2 p-2 rounded text-white text-sm"></div>
            </div>
            </div>

            <!-- form kamera -->
            <div class="w-full max-w-md h-auto mx-auto my-2">
            <div class="p-6 flex flex-col items-center gap-4">
                <label for="camera" class="block text-xl font-semibold text-sky-800 text-center">
                Ambil Foto Kehadiran
                </label>
                
                {{-- Video Element untuk Kamera --}}
                <div class="w-full max-w-[280px] sm:max-w-[320px] aspect-[9/16] bg-black rounded-lg overflow-hidden shadow-md mx-auto">
                <video id="video" class="w-full h-full object-cover" autoplay playsinline muted></video>
                </div>
                
                <button type="button" id="capture" class="mt-4 w-full max-w-xs bg-sky-800 text-white px-6 py-3 rounded-lg 
                        hover:bg-sky-700 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:ring-offset-2
                        transition-all duration-300 ease-in-out text-base font-semibold shadow-md hover:shadow-lg
                        flex items-center justify-center gap-2">
                    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5">
                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                    <g id="SVGRepo_iconCarrier"> 
                        <path d="M12 16C13.6569 16 15 14.6569 15 13C15 11.3431 13.6569 10 12 10C10.3431 10 9 11.3431 9 13C9 14.6569 10.3431 16 12 16Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> 
                        <path d="M3 16.8V9.2C3 8.0799 3 7.51984 3.21799 7.09202C3.40973 6.71569 3.71569 6.40973 4.09202 6.21799C4.51984 6 5.0799 6 6.2 6H7.25464C7.37758 6 7.43905 6 7.49576 5.9935C7.79166 5.95961 8.05705 5.79559 8.21969 5.54609C8.25086 5.49827 8.27836 5.44328 8.33333 5.33333C8.44329 5.11342 8.49827 5.00346 8.56062 4.90782C8.8859 4.40882 9.41668 4.08078 10.0085 4.01299C10.1219 4 10.2448 4 10.4907 4H13.5093C13.7552 4 13.8781 4 13.9915 4.01299C14.5833 4.08078 15.1141 4.40882 15.4394 4.90782C15.5017 5.00345 15.5567 5.11345 15.6667 5.33333C15.7216 5.44329 15.7491 5.49827 15.7803 5.54609C15.943 5.79559 16.2083 5.95961 16.5042 5.9935C16.561 6 16.6224 6 16.7454 6H17.8C18.9201 6 19.4802 6 19.908 6.21799C20.2843 6.40973 20.5903 6.71569 20.782 7.09202C21 7.51984 21 8.0799 21 9.2V16.8C21 17.9201 21 18.4802 20.782 18.908C20.5903 19.2843 20.2843 19.5903 19.908 19.782C19.4802 20 18.9201 20 17.8 20H6.2C5.0799 20 4.51984 20 4.09202 19.782C3.71569 19.5903 3.40973 19.2843 3.21799 18.908C3 18.4802 3 17.9201 3 16.8Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> 
                    </g>
                    </svg>
                Ambil Foto
                </button>

                <!-- Canvas untuk menyimpan gambar -->
                <canvas id="canvas" class="hidden"></canvas>
                <img  
                id="photo" 
                class="mt-4 hidden w-full max-w-xs border-2 border-sky-300 rounded-lg shadow-md" 
                alt="Hasil Foto">

                {{-- Notifikasi Error Akses Kamera --}}
                <div id="cameraErrorNotification" class="hidden mt-4 p-3 w-full max-w-xs bg-red-100 text-red-700 text-sm rounded-md text-center">
                Gagal mengakses kamera. Pastikan Anda telah memberikan izin.
                </div>
            </div>
            </div>

            {{-- Keterangan Text Area --}}
            <div class="w-full px-4 mt-4 flex flex-col justify-center items-center">
                {{-- Judul Keterangan --}}
                <label for="desc" class="block text-xl font-semibold text-sky-800 text-center py-2 w-full">
                Keterangan (Opsional)
                </label>
                <textarea 
                name="desc" 
                id="desc" 
                rows="3" 
                class="block p-2.5 w-full text-sm text-slate-900 bg-slate-50 rounded-lg border border-slate-700 focus:ring-sky-700 focus:border-sky-500 placeholder-slate-400"
                placeholder="Misalnya: Izin terlambat karena...">{{ old('desc') }}</textarea>
            </div>

            {{-- Tombol Submit Form (Contoh) --}}
            <div class="flex justify-center items-center my-6">
                <button 
                    type="submit" 
                    class="w-[300px] max-w-xs bg-sky-800 text-white px-6 py-3 rounded-lg 
                                    hover:bg-sky-700 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:ring-offset-2
                                    transition-all duration-300 ease-in-out text-base font-semibold shadow-md hover:shadow-lg">
                    Kirim Absensi
                </button>
            </div>
            <div class="py-2"></div>   
        </form>
    </div>
    <script>
    document.getElementById('getLocation').addEventListener('click', function() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                let lat = position.coords.latitude;
                let lon = position.coords.longitude;

                // Update nilai latitude dan longitude pada form
                document.getElementById('latitude').value = lat;
                document.getElementById('longitude').value = lon;

                // Tampilkan pesan sukses
                let notif = document.getElementById('notification');
                notif.innerText = `✅Data Lokasi berhasil diambil`;
                notif.classList.remove('hidden', 'bg-red-500');
                notif.classList.add('bg-amber-500');

            }, function(error) {
                let notif = document.getElementById('notification');
                notif.innerText = `❎ Mohon nyalakan lokasi Anda`;
                notif.classList.remove('hidden', 'bg-green-500');
                notif.classList.add('bg-red-500'); // Ubah warna menjadi merah
            });
        } else {
            let notif = document.getElementById('notification');
            notif.innerText = '❎ Geolokasi tidak didukung oleh browser Anda.';
            notif.classList.remove('hidden', 'bg-green-500');
            notif.classList.add('bg-red-500'); // Ubah warna menjadi merah
        }
    });

    // Mendapatkan akses kamera device
    const video = document.getElementById('video');
    const canvas = document.getElementById('canvas');
    const photo = document.getElementById('photo');
    const captureButton = document.getElementById('capture');
    const constraints = {
        video: {
            facingMode: "environment" // Menggunakan kamera belakang
        }
    };

    // Memulai kamera
    navigator.mediaDevices.getUserMedia(constraints)
        .then(function(stream) {
            video.srcObject = stream;
        })
        .catch(function(error) {
            console.error("Error accessing the camera:", error);
        });

    // Fungsi untuk mengambil foto dari video dan menampilkannya
    captureButton.addEventListener('click', function() {
        // Menyusun gambar di canvas
        canvas.width = video.videoWidth;
        canvas.height = video.videoHeight;
        const ctx = canvas.getContext('2d');
        ctx.drawImage(video, 0, 0, canvas.width, canvas.height);

        // Menampilkan gambar di tag <img>
        const dataURL = canvas.toDataURL('image/png');
        photo.src = dataURL;
        photo.classList.remove('hidden');
        canvas.classList.add('hidden');

        // Menyimpan data URL ke input foto
        document.getElementById('fotoInput').value = dataURL;
    });
    </script>
</x-layouts.base>
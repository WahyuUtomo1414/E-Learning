<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="images/2.png" type="image/png" sizes="16x16">
    @vite('resources/css/app.css')
    <title>Attendance</title>
</head>
<body class="bg-gray-200">

    <!-- Card Data User -->
    <div class="max-w-[420px] h-auto shadow-lg border-2 border-gray-200 rounded-lg bg-white mx-auto">
        <div class="px-6 h-[250px] bg-gradient-to-r from-sky-900 to-sky-700 rounded-b-3xl text-white flex flex-col justify-between border-b-8 border-amber-500 py-7">
            <!-- Logo dan Nama Sekolah -->
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <img src="{{ asset('images/2.png') }}" alt="Logo Sekolah" class="w-8 h-8 object-contain" />
                    <div class="text-sm font-semibold">SMK PATRIOT NUSANTARA</div>
                </div>
            </div>

            <!-- Selamat Pagi dan Profil -->
            <div class="flex items-center justify-between pt-2">
                <div class="font-poppins">
                    <h1 class="text-[18px]">Selamat Pagi☀️</h1>
                    <h2 class="py-1 font-bold text-xl">{{ $user->name }}</h2>
                    <h2 class="text-[18px]">Filsafat Komputer 12 - A</h2>
                </div>
                <img src="{{ Storage::disk('avatars')->url($user->avatar_url) }}" class="w-20 h-20 rounded-full object-cover border-3 border-amber-500" alt="User Images" />
            </div>
        </div>

        <div class="relative bg-gradient-to-br from-white to-gray-100 text-black max-w-[380px] h-auto mx-auto -mt-6 p-4 rounded-2xl shadow-lg hover:shadow-xl border border-gray-200 justify-items-center">
            <img src="{{ asset('images/iconabsen.png') }}" class="w-10 h-10 object-cover border border-gray-100" alt="icon absen" />
            <h1 class="text-xl font-semibold text-center">Absensi Siswa</h1>
            <h2 class="text-lg text-center">
                {{ \Carbon\Carbon::now()->locale('id')->translatedFormat('l, d F Y') }}
            </h2>
        </div>   

        <!-- handle eror -->
        @if(session('error'))
            <div class="bg-red-500 text-white p-2 rounded-md text-center mb-4 py-4">
                {{ session('error') }}
            </div>
        @endif

        <!-- Form Absen Masuk -->
        <form action="" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="relative bg-gradient-to-br from-white to-gray-100 text-black max-w-[380px] h-auto mx-auto my-6 rounded-2xl shadow border border-gray-200 justify-items-center">
                <img src="{{ asset('images/iconloc.png') }}" class="w-12 h-12 object-cover border border-gray-100 mt-2" alt="icon absen" />
                <h1 class="text-xl font-semibold py-2">Ambil Lokasi Anda</h1>
                <!-- Tombol untuk Dapatkan Lokasi -->
                <div class="flex justify-center items-center py-4">
                    <button type="button" id="getLocation" class="bg-emerald-800 text-white p-2 py-2 rounded-lg hover:bg-emerald-700 transition-all duration-200 text-[14px]">
                        Dapatkan Lokasi
                    </button>
                </div>
                <div id="notification" class="hidden mt-2 p-2 mb-2 bg-red-500 text-white rounded"></div>
            </div>
        
            <!-- Input Data Lokasi dan Foto di buat Hidden -->
            <!-- Input Data User -->
            <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
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
            <input type="hidden" name="foto" id="fotoInput" value="{{ old('fotoInput') }}">
            @error('fotoInput')
                <div class="text-red-500 text-sm">{{ $message }}</div>
            @enderror

            <!-- Input Data Waktu Absen -->
            <input type="hidden" name="waktu_absen" id="waktu_absen" value="{{ \Carbon\Carbon::now()->locale('id') }}">
            @error('waktu_absen')
                <div class="text-red-500 text-sm">{{ $message }}</div>
            @enderror
        
            <!-- Form Foto -->
            <div class="relative bg-gradient-to-br from-white to-gray-100 text-black max-w-[380px] h-auto mx-auto my-6 rounded-2xl shadow border border-gray-200 justify-items-center">
                <div class="p-4">
                    <label for="camera" class="block mb-2 text-xl font-semibold text-gray-900 text-center">
                        Ambil Foto
                    </label>
                    
                    <!-- Video Element untuk Menampilkan Kamera -->
                    <video id="video" class="w-full border border-gray-300 rounded-lg" autoplay></video>
                    
                    <!-- Tombol untuk Ambil Foto -->
                    <div class="flex justify-center items-center">
                        <button type="button" id="capture" class="mt-4 bg-emerald-800 text-white p-2 py-2 rounded-lg hover:bg-emerald-700 transition-all duration-200 text-[14px]">
                            Ambil Foto
                        </button>
                    </div>
                
                    <!-- Tempat Menampilkan Hasil Foto -->
                    <canvas id="canvas" class="hidden"></canvas>
                    <img 
                        id="photo" 
                        class="mt-4 hidden w-full border border-gray-300 rounded-lg" 
                        alt="Captured Image">
                </div>
            </div>
        
            <!-- Keterangan Text Area -->
            <div class="p-4">
                <label for="desc" class="block mb-2 text-xl font-semibold text-gray-900 text-center">Keterangan</label>
                <textarea 
                    name="desc" 
                    id="desc" 
                    rows="4" 
                    class="block p-2.5 w-full text-sm bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500" 
                    placeholder="Tuliskan detail kebtuhanmu...">
                    {{ old('desc')}}
                </textarea>
            </div>
        
            <!-- Button Absen Masuk -->
            <div class="flex justify-center items-center py-4">
                <button type="submit" class="bg-emerald-800 text-white p-2 py-2 rounded-lg hover:bg-emerald-700 transition-all duration-200 text-[14px]">
                    Absen Masuk
                </button>
            </div>
        </form>        
    </div>
</body>
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
</html>
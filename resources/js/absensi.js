document.getElementById("getLocation").addEventListener("click", function () {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(
            function (position) {
                let lat = position.coords.latitude;
                let lon = position.coords.longitude;

                // Update nilai latitude dan longitude pada form
                document.getElementById("latitude").value = lat;
                document.getElementById("longitude").value = lon;

                // Tampilkan pesan sukses
                let notif = document.getElementById("notification");
                notif.innerText = `✅Data Lokasi berhasil diambil`;
                notif.classList.remove("hidden", "bg-red-500");
                notif.classList.add("bg-amber-500");
            },
            function (error) {
                let notif = document.getElementById("notification");
                notif.innerText = `❎ Mohon nyalakan lokasi Anda`;
                notif.classList.remove("hidden", "bg-green-500");
                notif.classList.add("bg-red-500"); // Ubah warna menjadi merah
            }
        );
    } else {
        let notif = document.getElementById("notification");
        notif.innerText = "❎ Geolokasi tidak didukung oleh browser Anda.";
        notif.classList.remove("hidden", "bg-green-500");
        notif.classList.add("bg-red-500"); // Ubah warna menjadi merah
    }
});

// Mendapatkan akses kamera device
const video = document.getElementById("video");
const canvas = document.getElementById("canvas");
const photo = document.getElementById("photo");
const captureButton = document.getElementById("capture");
const constraints = {
    video: {
        facingMode: "environment", // Menggunakan kamera belakang
    },
};

// Memulai kamera
navigator.mediaDevices
    .getUserMedia(constraints)
    .then(function (stream) {
        video.srcObject = stream;
    })
    .catch(function (error) {
        console.error("Error accessing the camera:", error);
    });

// Fungsi untuk mengambil foto dari video dan menampilkannya
captureButton.addEventListener("click", function () {
    // Menyusun gambar di canvas
    canvas.width = video.videoWidth;
    canvas.height = video.videoHeight;
    const ctx = canvas.getContext("2d");
    ctx.drawImage(video, 0, 0, canvas.width, canvas.height);

    // Menampilkan gambar di tag <img>
    const dataURL = canvas.toDataURL("image/png");
    photo.src = dataURL;
    photo.classList.remove("hidden");
    canvas.classList.add("hidden");

    // Menyimpan data URL ke input foto
    document.getElementById("fotoInput").value = dataURL;
});

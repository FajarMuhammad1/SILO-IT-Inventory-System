@extends('layouts.app')

@section('content')
<div class="container text-center">
    <h3 class="mb-3">Scan Barcode Barang</h3>

    <div class="position-relative d-inline-block">
        <video id="camera" autoplay playsinline width="600" height="400" style="border:2px solid #ccc; border-radius:10px;"></video>
        <canvas id="overlay" width="600" height="400"
            style="position:absolute; top:0; left:0; pointer-events:none;"></canvas>
    </div>

    <div class="mt-3" id="result" class="text-center"></div>
</div>

<audio id="beep-sound" src="https://www.soundjay.com/button/beep-07.wav" preload="auto"></audio>

<script src="https://cdnjs.cloudflare.com/ajax/libs/quagga/0.12.1/quagga.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', async () => {
    const video = document.getElementById('camera');
    const overlay = document.getElementById('overlay');
    const ctx = overlay.getContext('2d');
    const beep = document.getElementById('beep-sound');
    const result = document.getElementById('result');

    // ✅ 1. Pastikan kamera jalan dulu
    try {
        const stream = await navigator.mediaDevices.getUserMedia({
            video: { facingMode: 'user', width: 600, height: 400 }
        });
        video.srcObject = stream;
        await new Promise(r => video.onloadedmetadata = r);
        console.log('✅ Kamera aktif');
    } catch (err) {
        alert('❌ Kamera gagal diakses: ' + err.message);
        return;
    }

    // ✅ 2. Mulai Quagga setelah video benar-benar tampil
    Quagga.init({
        inputStream: {
            name: "Live",
            type: "LiveStream",
            target: video,
            constraints: {
                facingMode: "user", // kamera depan laptop
                width: 600,
                height: 400
            }
        },
        decoder: {
            readers: ["code_128_reader"] // barcode garis
        },
        locate: true
    }, (err) => {
        if (err) {
            console.error(err);
            alert("Gagal memulai scanner: " + err.message);
            return;
        }
        Quagga.start();
        console.log("📷 Quagga dimulai");
    });

    // ✅ 3. Gambar garis hijau saat deteksi
    Quagga.onProcessed((data) => {
        ctx.clearRect(0, 0, overlay.width, overlay.height);
        if (data && data.boxes) {
            data.boxes.filter(b => b !== data.box).forEach(box => {
                ctx.beginPath();
                ctx.strokeStyle = "lime";
                ctx.lineWidth = 2;
                ctx.moveTo(box[0][0], box[0][1]);
                for (let i = 1; i < box.length; i++) {
                    ctx.lineTo(box[i][0], box[i][1]);
                }
                ctx.closePath();
                ctx.stroke();
            });
        }
    });

    // ✅ 4. Saat barcode terbaca
    Quagga.onDetected((resultData) => {
        const code = resultData.codeResult.code;
        console.log('📦 Barcode:', code);
        beep.play();

        result.innerHTML = `<div class="alert alert-info">Membaca barcode <b>${code}</b>...</div>`;

        fetch("{{ route('inventories.checkBarcode') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            body: JSON.stringify({ barcode: code })
        })
        .then(res => res.json())
        .then(data => {
            if (data.found) {
                result.innerHTML = `
                    <div class="alert alert-success text-start">
                        <strong>Barang Ditemukan!</strong><br>
                        <b>Nama:</b> ${data.inventory.nama_barang}<br>
                        <b>Kategori:</b> ${data.inventory.kategori}<br>
                        <b>Tipe:</b> ${data.inventory.tipe_barang}<br>
                        <b>Jumlah:</b> ${data.inventory.jumlah}<br>
                        <b>Kode Unik:</b> ${data.inventory.barcode}<br>
                        <b>Status:</b> ${data.match ? '✅ Sesuai dengan Barcode' : '❌ Tidak Sesuai'}
                    </div>`;
            } else {
                result.innerHTML = `<div class="alert alert-danger">❌ Barcode ${code} tidak ditemukan.</div>`;
            }
        })
        .catch(err => {
            console.error(err);
            result.innerHTML = `<div class="alert alert-warning">Gagal memeriksa barcode: ${err.message}</div>`;
        });

        // Hentikan sementara agar tidak baca berulang
        Quagga.pause();
        setTimeout(() => Quagga.start(), 4000);
    });
});
</script>
@endsection

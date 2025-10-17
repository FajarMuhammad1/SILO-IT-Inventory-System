@extends('layouts.sbadmin')

@section('content')
<style>

      /* Tema gelap untuk halaman scan */
  body {
    background-color: #1e1e2f;
    color: white;
  }
      /* Responsif scanner */
  @media (max-width: 600px) {
    #reader { width: 90%; }
  }
</style>
<div class="container">
    <h1 class="h3 mb-4 text-gray-800">Scan Barcode</h1>

    <!-- Pilihan kamera -->
    <select id="cameraSelector" class="form-select mt-3" style="width:200px; margin:auto;"></select>

    <!-- Tempat scanner -->
    <div id="reader" style="width: 400px; margin: auto; border: 3px solid #4e73df; border-radius: 10px;"></div>
    <p id="scanResult" class="text-center mt-3 text-muted">Arahkan kamera ke barcode...</p>

    <!-- Form hidden untuk submit ke Laravel -->
    <form id="barcodeForm" action="{{ route('inventories.scanSubmit') }}" method="POST">
        @csrf
        <input type="hidden" name="barcode" id="barcodeInput">
    </form>

    <!-- Pesan error jika barcode tidak ditemukan -->
    @if(session('error'))
        <div class="alert alert-danger mt-3 text-center">
            {{ session('error') }}
        </div>
    @endif
</div>




<!-- CDN html5-qrcode -->
<script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const html5QrCode = new Html5Qrcode("reader");
    let sudahScan = false;

    const qrConfig = { fps: 10, qrbox: 250 };

    // ✅ Fungsi ketika scan berhasil
    function onScanSuccess(decodedText) {
        if (sudahScan) return;
        sudahScan = true;

        document.getElementById('beep').play();
        document.getElementById('reader').style.borderColor = "green";
        setTimeout(() => document.getElementById('reader').style.borderColor = "#4e73df", 1000);

        document.getElementById('scanResult').innerHTML =
            `✅ Barcode terbaca: <strong>${decodedText}</strong><br>Memeriksa data...`;

        document.getElementById('barcodeInput').value = decodedText;
        document.getElementById('barcodeForm').submit();

        html5QrCode.stop().catch(err => console.error(err));
    }

    // ⚠️ Fungsi ketika gagal membaca barcode
    function onScanError(errorMessage) {
        document.getElementById('scanResult').innerText = "📷 Gagal membaca barcode, coba stabilkan kamera...";
    }

    // 🔹 Jalankan kamera
    Html5Qrcode.getCameras().then(devices => {
        const cameraSelector = document.getElementById('cameraSelector');
        if (devices && devices.length) {
            devices.forEach((device, index) => {
                const option = document.createElement('option');
                option.value = device.id;
                option.text = device.label || `Camera ${index + 1}`;
                cameraSelector.appendChild(option);
            });

            let cameraId = devices[0].id;
            html5QrCode.start(cameraId, qrConfig, onScanSuccess, onScanError);

            cameraSelector.addEventListener('change', function() {
                html5QrCode.stop().then(() => {
                    html5QrCode.start(this.value, qrConfig, onScanSuccess, onScanError);
                });
            });
        } else {
            alert("Kamera tidak ditemukan!");
        }
    }).catch(err => alert("Gagal mengakses kamera: " + err));
});
</script>



@endsection

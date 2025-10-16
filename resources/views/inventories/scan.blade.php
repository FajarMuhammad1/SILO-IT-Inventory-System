@extends('layouts.sbadmin')

@section('content')
<div class="container">
    <h1 class="h3 mb-4 text-gray-800">Scan Barcode</h1>

    <!-- Tempat scanner -->
    <div id="reader" style="width:500px; margin:auto;"></div>

    <!-- Form hidden untuk submit ke Laravel -->
    <form id="barcodeForm" action="{{ route('inventories.scanSubmit') }}" method="POST">
        @csrf
        <input type="hidden" name="barcode" id="barcodeInput">
    </form>

    <!-- Hasil scan akan muncul di sini -->
    <p class="mt-3 text-center" id="scanResult">Hasil scan akan muncul di sini...</p>

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

    const qrConfig = {
        fps: 10,
        qrbox: 250
    };

    function onScanSuccess(decodedText) {
        document.getElementById('scanResult').innerHTML = `✅ Barcode terbaca: <strong>${decodedText}</strong>`;
        document.getElementById('barcodeInput').value = decodedText;
        document.getElementById('barcodeForm').submit();
        html5QrCode.stop();
    }

    function onScanFailure(error) {
        // biarkan kosong agar tidak spam log
    }

    // 🔹 gunakan kamera depan (karena laptop tidak punya kamera belakang)
    Html5Qrcode.getCameras().then(devices => {
        if (devices && devices.length) {
            let cameraId = devices[0].id; // ambil kamera pertama
            html5QrCode.start(
                cameraId,
                qrConfig,
                onScanSuccess,
                onScanFailure
            );
        } else {
            alert("Kamera tidak ditemukan!");
        }
    }).catch(err => alert("Gagal mengakses kamera: " + err));
});
</script>
@endsection

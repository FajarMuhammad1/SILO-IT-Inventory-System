@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h4 class="mb-3"><i class="fas fa-barcode me-2"></i> Scan Barcode</h4>

    {{-- Pesan sukses / error --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="row gy-3">
        <!-- Manual / Keyboard scanner input -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Masukan Barcode (keyboard scanner atau ketik manual)</div>
                <div class="card-body">
                    <form id="scanForm" method="POST" action="{{ route('inventories.scanSubmit') }}">
                        @csrf
                        <div class="mb-2">
                            <label for="barcode" class="form-label">Barcode</label>
                            <input type="text" id="barcode" name="barcode"
                                   class="form-control" autocomplete="off"
                                   placeholder="Contoh: INV-ABC12345" required>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">Cari</button>
                            <button type="button" id="clearInput" class="btn btn-outline-secondary">Bersihkan</button>
                        </div>

                        @error('barcode')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </form>

                    <small class="text-muted d-block mt-2">
                        Jika memakai barcode scanner fisik, arahkan kursor ke field di atas lalu scan — form akan otomatis berisi nilai scanner.
                    </small>
                </div>
            </div>
        </div>

        <!-- Camera scanner (BarcodeDetector API) -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Scan Menggunakan Kamera (browser modern)</div>
                <div class="card-body">
                    <div id="camera-area" class="text-center">
                        <video id="video" playsinline style="width:100%;max-height:360px;border-radius:6px;background:#000;"></video>
                        <canvas id="canvas" style="display:none;"></canvas>

                        <div class="mt-2 d-flex justify-content-center gap-2">
                            <button id="startCamera" class="btn btn-success">Mulai Kamera</button>
                            <button id="stopCamera" class="btn btn-danger" disabled>Stop</button>
                            <button id="oneShot" class="btn btn-secondary">Scan Sekali</button>
                        </div>

                        <div class="mt-3">
                            <div id="detectResult" class="fw-semibold"></div>
                        </div>

                        <small class="text-muted d-block mt-2">
                            Catatan: fitur kamera membutuhkan browser yang mendukung <code>BarcodeDetector</code> atau halaman disajikan lewat HTTPS (localhost OK).
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

{{-- ✅ Script dipindahkan ke section "scripts" --}}
@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    // Fokus input supaya keyboard scanner langsung menempel
    const barcodeInput = document.getElementById('barcode');
    barcodeInput.focus();

    // Tombol clear input
    document.getElementById('clearInput').addEventListener('click', () => {
        barcodeInput.value = '';
        barcodeInput.focus();
    });

    // Auto-submit jika scanner kirim Enter
    barcodeInput.addEventListener('keydown', function (e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            document.getElementById('scanForm').submit();
        }
    });

    // ======================
    // CAMERA SCANNER LOGIC
    // ======================
    const video = document.getElementById('video');
    const canvas = document.getElementById('canvas');
    const startBtn = document.getElementById('startCamera');
    const stopBtn = document.getElementById('stopCamera');
    const oneShotBtn = document.getElementById('oneShot');
    const detectResult = document.getElementById('detectResult');

    let stream = null;
    let detector = null;
    let scanning = false;
    let rafId = null;

    // Cek dukungan BarcodeDetector
    async function isBarcodeDetectorSupported() {
        if ('BarcodeDetector' in window) {
            try {
                const formats = await BarcodeDetector.getSupportedFormats();
                return formats && formats.length > 0;
            } catch {
                return false;
            }
        }
        return false;
    }

    async function startCamera() {
        try {
            stream = await navigator.mediaDevices.getUserMedia({ video: { facingMode: 'environment' }, audio: false });
            video.srcObject = stream;
            await video.play();
            startBtn.disabled = true;
            stopBtn.disabled = false;
            scanning = true;

            if (await isBarcodeDetectorSupported()) {
                detector = new BarcodeDetector({
                    formats: ['code_128', 'code_39', 'ean_13', 'qr_code', 'codabar', 'data_matrix']
                });
                tick();
            } else {
                detectResult.innerText = 'Browser tidak mendukung BarcodeDetector. Gunakan input manual.';
            }
        } catch (err) {
            console.error(err);
            alert('Gagal mengakses kamera: ' + err.message);
        }
    }

    function stopCameraFunc() {
        scanning = false;
        startBtn.disabled = false;
        stopBtn.disabled = true;
        if (stream) {
            stream.getTracks().forEach(t => t.stop());
            stream = null;
        }
        if (rafId) {
            cancelAnimationFrame(rafId);
            rafId = null;
        }
    }

    async function tick() {
        if (!scanning || !detector) return;
        try {
            const detections = await detector.detect(video);
            if (detections && detections.length) {
                const code = detections[0].rawValue || detections[0].value;
                handleDetectedBarcode(code);
            }
        } catch (err) {
            console.error('detect error', err);
        }
        rafId = requestAnimationFrame(tick);
    }

    function handleDetectedBarcode(code) {
        if (!code) return;
        detectResult.innerHTML = `<span class="text-success">Terdeteksi: </span><strong>${code}</strong>`;
        barcodeInput.value = code;
        setTimeout(() => document.getElementById('scanForm').submit(), 400);
    }

    oneShotBtn.addEventListener('click', async function () {
        if (!stream) return alert('Kamera belum berjalan.');
        if (!('BarcodeDetector' in window)) return alert('Browser tidak mendukung BarcodeDetector.');
        try {
            canvas.width = video.videoWidth;
            canvas.height = video.videoHeight;
            const ctx = canvas.getContext('2d');
            ctx.drawImage(video, 0, 0, canvas.width, canvas.height);
            const bitmap = await createImageBitmap(canvas);
            const det = new BarcodeDetector({ formats: ['code_128', 'code_39', 'ean_13', 'qr_code', 'codabar', 'data_matrix'] });
            const results = await det.detect(bitmap);
            if (results.length) {
                handleDetectedBarcode(results[0].rawValue || results[0].value);
            } else {
                detectResult.innerHTML = `<span class="text-danger">Tidak terdeteksi. Coba lagi.</span>`;
            }
        } catch (err) {
            console.error(err);
            alert('Error saat scan: ' + err.message);
        }
    });

    startBtn.addEventListener('click', startCamera);
    stopBtn.addEventListener('click', stopCameraFunc);

    // Stop kamera ketika keluar halaman
    window.addEventListener('beforeunload', () => {
        if (stream) stream.getTracks().forEach(t => t.stop());
    });
});
</script>
@endsection

<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;
use Milon\Barcode\Facades\DNS1DFacade as DNS1D;

class InventoryController extends Controller
{
    /** Tampilkan semua data inventory */
    public function index()
    {
        $inventories = Inventory::latest()->paginate(10);
        return view('inventories.index', compact('inventories'));
    }

    /** Tampilkan detail barang */
    public function show($id)
    {
        $inventory = Inventory::findOrFail($id);
        $barcode = DNS1D::getBarcodeHTML($inventory->barcode, 'C128', 2, 60);

        ActivityLog::create([
            'user_id' => Auth::id(),
            'activity' => 'Melihat detail barang: ' . $inventory->nama_barang,
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
        ]);

        return view('inventories.show', compact('inventory', 'barcode'));
    }

    public function downloadBarcode($id)
{
    $inventory = Inventory::findOrFail($id);
    $barcodeFile = public_path('barcodes/' . $inventory->barcode . '.png');

    if (file_exists($barcodeFile)) {
        return response()->download($barcodeFile, $inventory->barcode . '.png');
    }

    return redirect()->back()->with('error', 'File barcode tidak ditemukan.');
}


    /** Form tambah data baru */
    public function create()
    {
        return view('inventories.create');
    }

    /** Simpan data baru ke database + generate barcode image */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_barang' => 'required|string|max:255',
            'kategori' => 'required|string|max:255',
            'merk' => 'nullable|string|max:255',
            'serial_number' => 'nullable|string|max:255',
            'tipe_barang' => 'required|string',
            'jumlah' => 'required|integer|min:1',
            'tanggal_masuk' => 'required|date',
            'po_number' => 'nullable|string|max:255',
            'lokasi' => 'nullable|string|max:255',
            'status' => 'required|in:ok,rusak,hilang,dipakai,baru',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $request->file('gambar')->store('inventories', 'public');
        }

        // Buat kode unik barcode
        $barcodeCode = 'INV-' . strtoupper(Str::random(8));
        $validated['barcode'] = $barcodeCode;

        // Simpan data ke DB
        $inventory = Inventory::create($validated);

        // --- 🔹 Simpan barcode ke folder public/barcodes ---
        // --- 🔹 Simpan barcode ke folder public/barcodes ---
$barcodeDir = public_path('barcodes');
if (!file_exists($barcodeDir)) {
    mkdir($barcodeDir, 0777, true);
}

// Generate barcode PNG base64
$barcodePng = DNS1D::getBarcodePNG($barcodeCode, 'C128', 3, 100);

// Ubah base64 jadi gambar GD
$barcodeImage = imagecreatefromstring(base64_decode($barcodePng));

// Dapatkan ukuran barcode asli
$width = imagesx($barcodeImage);
$height = imagesy($barcodeImage);

// Tambahkan padding putih di sekeliling barcode (20px di setiap sisi)
$padding = 20;
$newWidth = $width + ($padding * 2);
$newHeight = $height + ($padding * 2);

// Buat canvas putih baru
$canvas = imagecreatetruecolor($newWidth, $newHeight);
$white = imagecolorallocate($canvas, 255, 255, 255);
imagefill($canvas, 0, 0, $white);

// Tempelkan barcode ke tengah canvas
imagecopy($canvas, $barcodeImage, $padding, $padding, 0, 0, $width, $height);

// Simpan ke file .png
$barcodePath = $barcodeDir . '/' . $barcodeCode . '.png';
imagepng($canvas, $barcodePath);

// Bersihkan dari memori
imagedestroy($canvas);
imagedestroy($barcodeImage);
// --------------------------------------------------


        ActivityLog::create([
            'user_id' => Auth::id(),
            'activity' => 'Menambahkan barang: ' . $validated['nama_barang'],
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        return redirect()->route('inventories.show', $inventory->id)
                         ->with('success', 'Barang berhasil ditambahkan dan barcode disimpan!');
    }

    /** Form edit barang */
    public function edit($id)
    {
        $inventory = Inventory::findOrFail($id);
        return view('inventories.edit', compact('inventory'));
    }

    /** Update data barang */
    public function update(Request $request, $id)
    {
        $inventory = Inventory::findOrFail($id);

        $validated = $request->validate([
            'nama_barang' => 'required|string|max:255',
            'kategori' => 'required|string|max:255',
            'merk' => 'nullable|string|max:255',
            'serial_number' => 'nullable|string|max:255',
            'tipe_barang' => 'required|string',
            'jumlah' => 'required|integer|min:1',
            'tanggal_masuk' => 'required|date',
            'po_number' => 'nullable|string|max:255',
            'lokasi' => 'nullable|string|max:255',
            'status' => 'required|in:ok,rusak,hilang,dipakai,baru',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            if ($inventory->gambar && Storage::disk('public')->exists($inventory->gambar)) {
                Storage::disk('public')->delete($inventory->gambar);
            }
            $validated['gambar'] = $request->file('gambar')->store('inventories', 'public');
        }

        // Pastikan barcode tetap ada
        if (empty($inventory->barcode)) {
            $validated['barcode'] = 'INV-' . strtoupper(Str::random(8));
        }

        $inventory->update($validated);

        ActivityLog::create([
            'user_id' => Auth::id(),
            'activity' => 'Memperbarui barang: ' . $validated['nama_barang'],
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        return redirect()->route('inventories.index')
                         ->with('success', 'Data barang berhasil diperbarui!');
    }

    /** Hapus barang */
    public function destroy(Request $request, $id)
    {
        $inventory = Inventory::findOrFail($id);

        if ($inventory->gambar && Storage::disk('public')->exists($inventory->gambar)) {
            Storage::disk('public')->delete($inventory->gambar);
        }

        $barcodePath = public_path('barcodes/' . $inventory->barcode . '.png');
        if (file_exists($barcodePath)) {
            unlink($barcodePath);
        }

        $inventory->delete();

        ActivityLog::create([
            'user_id' => Auth::id(),
            'activity' => 'Menghapus barang: ' . $inventory->nama_barang,
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        return redirect()->route('inventories.index')
                         ->with('success', 'Data barang berhasil dihapus!');
    }

    /** Halaman scan barcode */
    public function scan()
    {
        return view('inventories.scan');
    }

    public function checkBarcode(Request $request)
    {
        $barcode = $request->input('barcode');
        $inventory = Inventory::where('barcode', $barcode)->first();

        if ($inventory) {
            return response()->json([
                'found' => true,
                'match' => $inventory->barcode === $barcode,
                'inventory' => $inventory,
            ]);
        }

        return response()->json(['found' => false]);
    }

    /** Proses hasil scan barcode */
    public function scanSubmit(Request $request)
    {
        $barcode = $request->input('barcode');

        $inventory = Inventory::where('barcode', $barcode)->first();

        if ($inventory) {
            ActivityLog::create([
                'user_id' => Auth::id(),
                'activity' => 'Scan barcode: ' . $barcode,
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
            ]);

            return redirect()->route('inventories.show', $inventory->id)
                             ->with('success', "Barang dengan barcode {$barcode} ditemukan!");
        } else {
            return back()->with('error', "Barcode {$barcode} tidak ditemukan di database.");
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;

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

        // Catat aktivitas melihat detail barang
        ActivityLog::create([
            'user_id' => Auth::id(),
            'activity' => 'Melihat detail barang: ' . $inventory->nama_barang,
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
        ]);

        return view('inventories.show', compact('inventory'));
    }

    /** Form tambah data baru */
    public function create()
    {
        return view('inventories.create');
    }

    /** Simpan data baru ke database */
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

        $validated['barcode'] = 'INV-' . strtoupper(Str::random(8));
        $inventory = Inventory::create($validated);

        ActivityLog::create([
            'user_id' => Auth::id(),
            'activity' => 'Menambahkan barang: ' . $validated['nama_barang'],
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        return redirect()->route('inventories.index')
                         ->with('success', 'Data barang berhasil ditambahkan!');
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

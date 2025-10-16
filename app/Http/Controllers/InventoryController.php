<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class InventoryController extends Controller
{
    /** 
     * Tampilkan semua data inventory.
     */
    public function index()
    {
        $inventories = Inventory::latest()->paginate(10);
        return view('inventories.index', compact('inventories'));
    }

    /** 
     * Form tambah data baru.
     */
    public function create()
    {
        return view('inventories.create');
    }

    /** 
     * Simpan data baru ke database.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_barang' => 'required|string|max:255',
            'kategori' => 'required|string|max:255',
            'merk' => 'nullable|string|max:255',
            'serial_number' => 'nullable|string|max:255',
            'tipe_barang' => 'required|string',
            'jumlah' => 'required|integer',
            'tanggal_masuk' => 'required|date',
            'po_number' => 'nullable|string|max:255',
            'lokasi' => 'nullable|string|max:255',
            'status' => 'nullable|string|max:50',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Upload gambar (jika ada)
        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $request->file('gambar')->store('inventories', 'public');
        }

        // Generate barcode otomatis jika belum ada
        $validated['barcode'] = 'INV-' . strtoupper(Str::random(8));

        Inventory::create($validated);

        return redirect()->route('inventories.index')->with('success', 'Data barang berhasil ditambahkan!');
    }

     public function scan()
    {
        return view('inventories.scan'); // scan.blade.php
    }
    public function scanSubmit(Request $request)
{
    $request->validate([
        'barcode' => 'required|string'
    ]);

    $barcode = $request->barcode;

    $inventory = Inventory::where('barcode', $barcode)->first();

    if ($inventory) {
        // Jika barang ditemukan, redirect ke halaman detail
        return redirect()->route('inventories.show', $inventory->id);
    } else {
        // Jika tidak ditemukan, kembali ke halaman scan dengan pesan error
        return redirect()->route('inventories.scan')
                         ->with('error', 'Barang dengan barcode ' . $barcode . ' tidak ditemukan!');
    }
}

    public function showByBarcode($barcode)
{
    $inventory = Inventory::where('barcode', $barcode)->firstOrFail();
    return view('inventories.show', compact('inventory'));
}


     public function show($id)
    {
        $inventory = Inventory::findOrFail($id);
        return view('inventories.show', compact('inventory'));
    }

    /** 
     * Form edit data barang.
     */
    public function edit($id)
    {
        $inventory = Inventory::findOrFail($id);
        return view('inventories.edit', compact('inventory'));
    }

    /** 
     * Update data barang.
     */
    public function update(Request $request, $id)
    {
        $inventory = Inventory::findOrFail($id);

        $validated = $request->validate([
            'nama_barang' => 'required|string|max:255',
            'kategori' => 'required|string|max:255',
            'merk' => 'nullable|string|max:255',
            'serial_number' => 'nullable|string|max:255',
            'tipe_barang' => 'required|string',
            'jumlah' => 'required|integer',
            'tanggal_masuk' => 'required|date',
            'po_number' => 'nullable|string|max:255',
            'lokasi' => 'nullable|string|max:255',
            'status' => 'nullable|string|max:50',
            'barcode' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Update gambar jika ada file baru
        if ($request->hasFile('gambar')) {
            if ($inventory->gambar && Storage::disk('public')->exists($inventory->gambar)) {
                Storage::disk('public')->delete($inventory->gambar);
            }
            $validated['gambar'] = $request->file('gambar')->store('inventories', 'public');
        }

        $inventory->update($validated);

        return redirect()->route('inventories.index')->with('success', 'Data barang berhasil diperbarui!');
    }

    /** 
     * Hapus data barang.
     */
    public function destroy($id)
{
    $inventory = Inventory::findOrFail($id);

    // Hapus file gambar di storage jika ada
    if ($inventory->gambar && Storage::disk('public')->exists($inventory->gambar)) {
        Storage::disk('public')->delete($inventory->gambar);
    }

    // Hapus data dari database
    $inventory->delete();

    // Redirect ke halaman index dengan pesan sukses
    return redirect()->route('inventories.index')->with('success', 'Data barang berhasil dihapus!');
}


}

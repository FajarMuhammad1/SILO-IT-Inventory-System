<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SuratJalan;
use App\Models\PpiRequest;
use Illuminate\Support\Facades\Storage;

class SuratJalanController extends Controller
{
    /**
     * Tampilkan daftar Surat Jalan
     */
    public function index()
    {
        $suratJalan = SuratJalan::with('ppiRequest')->latest()->get();
        return view('suratjalan.index', compact('suratJalan'));
    }

    /**
     * Form tambah Surat Jalan
     */
public function create()
{
    $ppiRequests = PpiRequest::all();
   return view('suratjalan.create', compact('ppiRequests'));

}

    /**
     * Simpan data Surat Jalan baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'no_sj' => 'required|unique:surat_jalan,no_sj',
            'no_ppi' => 'nullable|exists:ppi_requests,no_ppi',
            'kategori' => 'nullable|string|max:255',
            'merk' => 'nullable|string|max:255',
            'model' => 'nullable|string|max:255',
            'spesifikasi' => 'nullable|string',
            'serial_number' => 'nullable|string|max:255',
            'qty' => 'nullable|integer|min:1',
            'file' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        $filePath = null;
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('surat_jalan_files', 'public');
        }

        SuratJalan::create([
            'no_sj' => $request->no_sj,
            'no_ppi' => $request->no_ppi,
            'no_po' => $request->no_po,
            'kategori' => $request->kategori,
            'merk' => $request->merk,
            'model' => $request->model,
            'spesifikasi' => $request->spesifikasi,
            'serial_number' => $request->serial_number,
            'qty' => $request->qty,
            'keterangan' => $request->keterangan,
            'file' => $filePath,
            'jenis_surat_jalan' => $request->jenis_surat_jalan,
            'tanggal_input' => $request->tanggal_input,
            'kode_asset' => $request->kode_asset,
            'bast' => $request->bast,
        ]);

        return redirect()->route('suratjalan.index')->with('success', 'Data Surat Jalan berhasil disimpan!');
    }

    /**
     * Edit data
     */
    public function edit($id)
    {
        $suratJalan = SuratJalan::findOrFail($id);
        $ppi = PpiRequest::all();
        return view('suratjalan.edit', compact('suratJalan', 'ppi'));
    }

    /**
     * Update data Surat Jalan
     */
    public function update(Request $request, $id)
    {
        $suratJalan = SuratJalan::findOrFail($id);

        $request->validate([
            'no_sj' => 'required|unique:surat_jalan,no_sj,' . $id . ',id_sj',
            'file' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        $filePath = $suratJalan->file;
        if ($request->hasFile('file')) {
            if ($filePath && Storage::disk('public')->exists($filePath)) {
                Storage::disk('public')->delete($filePath);
            }
            $filePath = $request->file('file')->store('surat_jalan_files', 'public');
        }

        $suratJalan->update([
            'no_sj' => $request->no_sj,
            'no_ppi' => $request->no_ppi,
            'no_po' => $request->no_po,
            'kategori' => $request->kategori,
            'merk' => $request->merk,
            'model' => $request->model,
            'spesifikasi' => $request->spesifikasi,
            'serial_number' => $request->serial_number,
            'qty' => $request->qty,
            'keterangan' => $request->keterangan,
            'file' => $filePath,
            'jenis_surat_jalan' => $request->jenis_surat_jalan,
            'tanggal_input' => $request->tanggal_input,
            'kode_asset' => $request->kode_asset,
            'bast' => $request->bast,
        ]);

        return redirect()->route('suratjalan.index')->with('success', 'Data Surat Jalan berhasil diperbarui!');
    }

    /**
     * Hapus data
     */
    public function destroy($id)
    {
        $suratJalan = SuratJalan::findOrFail($id);

        if ($suratJalan->file && Storage::disk('public')->exists($suratJalan->file)) {
            Storage::disk('public')->delete($suratJalan->file);
        }

        $suratJalan->delete();

        return redirect()->route('suratjalan.index')->with('success', 'Data Surat Jalan berhasil dihapus!');
    }
}

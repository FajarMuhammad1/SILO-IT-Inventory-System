<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PpiRequest;
use App\Models\Departement;
use Illuminate\Support\Facades\Storage;

class PPIRequestController extends Controller
{
    public function index()
    {
        $ppiRequests = PPIRequest::with('departement')->latest()->get();
        return view('ppi.index', compact('ppiRequests'));
    }

    public function create()
    {
        $departements = Departement::all();
        return view('ppi.create', compact('departements'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'tanggal' => 'required|date',
            'no_ppi' => 'required|unique:ppi_requests,no_ppi',
            'pemohon' => 'required|string|max:150',
            'departement_id' => 'nullable|exists:departements,id',
            'perangkat' => 'required|string|max:150',
            'ba_kerusakan' => 'required|in:Ada,Permintaan Baru',
            'status' => 'required|in:Open,Reject,Closed',
            'keterangan' => 'nullable|string',
            'file_ppi' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
        ]);

        if ($request->hasFile('file_ppi')) {
            $validated['file_ppi'] = $request->file('file_ppi')->store('ppi_files', 'public');
        }

        PPIRequest::create($validated);

        return redirect()->route('ppi.index')->with('success', 'PPI Request berhasil ditambahkan.');
    }

    public function show($id)
    {
        $ppi = PPIRequest::with('departement')->findOrFail($id);
        return view('ppi.show', compact('ppi'));
    }

    public function edit($id)
    {
        $ppi = PPIRequest::findOrFail($id);
        $departements = Departement::all();
        return view('ppi.edit', compact('ppi', 'departements'));
    }

    public function update(Request $request, $id)
    {
        $ppi = PPIRequest::findOrFail($id);

        $validated = $request->validate([
            'tanggal' => 'required|date',
            'no_ppi' => 'required|unique:ppi_requests,no_ppi,' . $id,
            'pemohon' => 'required|string|max:150',
            'departement_id' => 'nullable|exists:departements,id',
            'perangkat' => 'required|string|max:150',
            'ba_kerusakan' => 'required|in:Ada,Permintaan Baru',
            'status' => 'required|in:Open,Reject,Closed',
            'keterangan' => 'nullable|string',
            'file_ppi' => 'nullable|file|mimes:pdf,doc,docx,jpg,png|max:2048',
        ]);

        if ($request->hasFile('file_ppi')) {
            // Hapus file lama
            if ($ppi->file_ppi && Storage::disk('public')->exists($ppi->file_ppi)) {
                Storage::disk('public')->delete($ppi->file_ppi);
            }
            $validated['file_ppi'] = $request->file('file_ppi')->store('ppi_files', 'public');
        }

        $ppi->update($validated);
        return redirect()->route('ppi.index')->with('success', 'Data PPI berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $ppi = PPIRequest::findOrFail($id);
        if ($ppi->file_ppi && Storage::disk('public')->exists($ppi->file_ppi)) {
            Storage::disk('public')->delete($ppi->file_ppi);
        }
        $ppi->delete();

        return redirect()->route('ppi.index')->with('success', 'Data PPI berhasil dihapus.');
    }
}

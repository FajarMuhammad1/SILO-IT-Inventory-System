<?php

namespace App\Http\Controllers;

use App\Models\Departement;
use Illuminate\Http\Request;

class DepartementController extends Controller
{
    public function index()
    {
        $departements = Departement::latest()->get();
        return view('departements.index', compact('departements'));
    }

    public function create()
    {
        return view('departements.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_departement' => 'required|string|max:150',
            'jabatan' => 'nullable|string|max:150',
            'perusahaan' => 'nullable|string|max:150',
        ]);

        Departement::create($validated);

        return redirect()->route('departements.index')->with('success', 'Departemen berhasil ditambahkan.');
    }

    public function show(Departement $departement)
    {
        return view('departements.show', compact('departement'));
    }

    public function edit(Departement $departement)
    {
        return view('departements.edit', compact('departement'));
    }

    public function update(Request $request, Departement $departement)
    {
        $validated = $request->validate([
            'nama_departement' => 'required|string|max:150',
            'jabatan' => 'nullable|string|max:150',
            'perusahaan' => 'nullable|string|max:150',
        ]);

        $departement->update($validated);

        return redirect()->route('departements.index')->with('success', 'Departemen berhasil diperbarui.');
    }

    public function destroy(Departement $departement)
    {
        $departement->delete();
        return redirect()->route('departements.index')->with('success', 'Departemen berhasil dihapus.');
    }
}

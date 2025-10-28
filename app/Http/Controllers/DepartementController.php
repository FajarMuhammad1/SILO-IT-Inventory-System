<?php

namespace App\Http\Controllers;

use App\Models\Departement;
use Illuminate\Http\Request;

class DepartementController extends Controller
{
    // Menampilkan daftar semua departemen
    public function index()
    {
        $departements = Departement::all();
        return view('departements.index', compact('departements'));
    }

    // Menampilkan detail satu departemen
  public function show($id)
{
    $departement = Departement::findOrFail($id);
    return view('departements.show', compact('departement'));
}

}

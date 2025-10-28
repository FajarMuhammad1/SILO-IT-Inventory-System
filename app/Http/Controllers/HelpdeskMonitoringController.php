<?php

namespace App\Http\Controllers;

use App\Models\HelpdeskMonitoring;
use App\Models\Departement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HelpdeskMonitoringController extends Controller
{
    /**
     * Tampilkan semua data Helpdesk Monitoring
     */
    public function index()
    {
        // Pastikan user login
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        if (Auth::user()->role === 'admin') {
            // Admin bisa melihat semua laporan
            $helpdesks = HelpdeskMonitoring::with(['user', 'departement'])
                ->latest()
                ->paginate(10);
        } else {
            // Staff hanya melihat laporan miliknya
            $helpdesks = HelpdeskMonitoring::where('user_id', Auth::id())
                ->with(['user', 'departement'])
                ->latest()
                ->paginate(10);
        }

        return view('helpdesk.index', compact('helpdesks'));
    }

    /**
     * Tampilkan form tambah laporan baru
     */
    public function create()
    {
        $departements = Departement::all();
        return view('helpdesk.create', compact('departements'));
    }

    /**
     * Simpan data laporan baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date|before_or_equal:today',
            'departement_id' => 'required|exists:departements,id',
            'deskripsi' => 'required|string|max:500',
        ]);

        HelpdeskMonitoring::create([
            'tanggal' => $request->tanggal,
            'user_id' => Auth::id(),
            'departement_id' => $request->departement_id,
            'deskripsi' => $request->deskripsi,
            'status' => 'open',
            'pic' => null,
        ]);

        return redirect()->route('helpdesk.index')->with('success', 'Laporan berhasil dibuat.');
    }

    /**
     * Edit laporan
     */
    public function edit($id)
    {
        $helpdesk = HelpdeskMonitoring::findOrFail($id);
        $departements = Departement::all();

        // Batasi akses: hanya admin atau pemilik laporan
        if (Auth::user()->role !== 'admin' && $helpdesk->user_id !== Auth::id()) {
            abort(403, 'Anda tidak berhak mengedit laporan ini.');
        }

        return view('helpdesk.edit', compact('helpdesk', 'departements'));
    }

    /**
     * Update laporan
     */
    public function update(Request $request, $id)
    {
        $helpdesk = HelpdeskMonitoring::findOrFail($id);

        // Batasi akses
        if (Auth::user()->role !== 'admin' && $helpdesk->user_id !== Auth::id()) {
            abort(403, 'Anda tidak berhak mengubah data ini.');
        }

        $request->validate([
            'status' => 'required|in:open,progress,done',
            'pic' => 'nullable|string|max:255',
            'deskripsi' => 'required|string|max:500',
        ]);

        $helpdesk->update([
            'status' => $request->status,
            'pic' => $request->pic,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()->route('helpdesk.index')->with('success', 'Data berhasil diperbarui.');
    }

    /**
     * Hapus laporan
     */
    public function destroy($id)
    {
        $helpdesk = HelpdeskMonitoring::findOrFail($id);

        // Batasi akses
        if (Auth::user()->role !== 'admin' && $helpdesk->user_id !== Auth::id()) {
            abort(403, 'Anda tidak berhak menghapus laporan ini.');
        }

        $helpdesk->delete();

        return redirect()->route('helpdesk.index')->with('success', 'Data berhasil dihapus.');
    }
}

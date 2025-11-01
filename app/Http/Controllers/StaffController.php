<?php

namespace App\Http\Controllers;

use App\Models\HelpdeskMonitoring;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StaffController extends Controller
{
    public function dashboard()
    {
        return view('staff.dashboard'); // halaman sementara
    }

    public function helpdeskIndex()
    {
        // Hanya tiket yang PIC = user login
        $helpdesks = HelpdeskMonitoring::where('pic', Auth::user()->name)
                                        ->latest()
                                        ->paginate(10);

        return view('staff.helpdesk', compact('helpdesks'));
    }

    public function helpdeskUpdate(Request $request, $id)
    {
        $ticket = HelpdeskMonitoring::findOrFail($id);

        // Batasi hanya PIC bisa update
        if ($ticket->pic != Auth::user()->name) {
            abort(403, 'Anda tidak berhak mengubah tiket ini.');
        }

        $request->validate([
            'status' => 'required|in:open,progress,done',
            'deskripsi' => 'nullable|string|max:500',
        ]);

        $ticket->update([
            'status' => $request->status,
            'deskripsi' => $request->deskripsi ?? $ticket->deskripsi,
        ]);

        return redirect()->route('staff.helpdesk.index')->with('success', 'Tiket berhasil diperbarui.');
    }
}

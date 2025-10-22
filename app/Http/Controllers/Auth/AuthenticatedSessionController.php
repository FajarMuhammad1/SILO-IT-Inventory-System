<?php

namespace App\Http\Controllers\Auth;

use App\Models\ActivityLog;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    public function create(): View
    {
        return view('auth.login');
    }

    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();
        $request->session()->regenerate();

        // Catat login
        ActivityLog::create([
            'user_id' => Auth::id(),
            'activity' => 'login',
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        return redirect()->intended(route('dashboard', absolute: false));
    }
    public function destroy(Request $request): RedirectResponse
{
    // Simpan dulu user ID sebelum logout
    $userId = Auth::id();

    // Catat aktivitas logout (hanya kalau user masih terautentikasi)
    if ($userId) {
        ActivityLog::create([
            'user_id' => $userId,
            'activity' => 'logout',
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);
    }

    // Lakukan logout setelah log disimpan
    Auth::guard('web')->logout();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/');
}


 
}

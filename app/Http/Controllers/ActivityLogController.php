<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use Illuminate\Http\Request;

class ActivityLogController extends Controller
{
    public function index(Request $request)
    {
        $query = ActivityLog::with('user')->latest();

        // Jika user melakukan pencarian
        if ($request->has('search')) {
            $search = $request->search;
            $query->where('activity', 'like', "%{$search}%")
                  ->orWhereHas('user', function($q) use ($search) {
                      $q->where('name', 'like', "%{$search}%");
                  });
        }

        // Pagination (10 per halaman)
        $activityLogs = $query->paginate(10);

        // Kirim ke view
        return view('activity.index', compact('activityLogs'));
    }
}

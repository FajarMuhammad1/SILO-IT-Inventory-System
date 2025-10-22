@extends('layouts.app')

@section('content')
<div class="container-fluid px-4">
    <h4 class="mb-4 text-primary fw-bold">
        <i class="fas fa-list me-2"></i> Activity Log
    </h4>

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <form action="{{ route('activity-logs.index') }}" method="GET" class="mb-3 d-flex gap-2">
                <input type="text" name="search" class="form-control" placeholder="Cari aktivitas atau user..." value="{{ request('search') }}">
                <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i></button>
            </form>

            <div class="table-responsive">
                <table class="table table-bordered table-striped align-middle">
                    <thead class="table-primary text-center">
                        <tr>
                            <th>No</th>
                            <th>User</th>
                            <th>Aktivitas</th>
                            <th>IP Address</th>
                            <th>User Agent</th>
                            <th>Waktu</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($activityLogs as $log)
                            <tr>
                                <td class="text-center">{{ $loop->iteration + ($activityLogs->currentPage() - 1) * $activityLogs->perPage() }}</td>
                                <td>{{ $log->user->name ?? 'Tidak Diketahui' }}</td>
                                <td>{{ $log->activity }}</td>
                                <td>{{ $log->ip_address }}</td>
                                <td>{{ Str::limit($log->user_agent, 40) }}</td>
                                <td>{{ $log->created_at->format('d M Y H:i') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted py-3">Belum ada aktivitas tercatat.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-center mt-3">
                {{ $activityLogs->links() }}
            </div>
        </div>
    </div>
</div>

{{-- === Styling tambahan untuk pagination & tabel === --}}
<style>
    /* Hilangkan ikon SVG besar dari pagination */
    .pagination svg {
        display: none !important;
    }

    /* Ratakan dan rapikan pagination */
    .pagination {
        justify-content: center;
        margin-top: 15px;
    }

    /* Gaya tombol pagination */
    .pagination .page-link {
        border-radius: 8px;
        margin: 0 2px;
        color: #4e73df;
        font-weight: 500;
    }

    .pagination .page-item.active .page-link {
        background-color: #4e73df;
        border-color: #4e73df;
        color: #fff;
    }

    /* Hover efek */
    .pagination .page-link:hover {
        background-color: #e9ecef;
    }

    /* Font tabel */
    table {
        font-size: 0.95rem;
    }
</style>
@endsection

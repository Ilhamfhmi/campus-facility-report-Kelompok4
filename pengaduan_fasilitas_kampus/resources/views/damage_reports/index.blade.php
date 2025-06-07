@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Daftar Laporan Kerusakan</h2>

    {{-- Notifikasi --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @elseif(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    {{-- Pencarian --}}
    <input type="text" id="searchInput" class="form-control mb-3" placeholder="Cari laporan...">

    {{-- Tombol aksi --}}
    <div class="mb-3">
        <a href="{{ route('damage_reports.create') }}" class="btn btn-primary">+ Tambah Laporan</a>
        <a href="{{ route('damage_reports.progress') }}" class="btn btn-secondary">Progress</a>
    </div>

    {{-- Tabel laporan --}}
    <table class="table table-bordered table-hover" id="progressTable">
        <thead class="table-light">
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Lokasi</th>
                <th>Deskripsi</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($damageReports as $index => $report)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $report->created_at->format('d-m-Y H:i') }}</td>
                    <td>{{ $report->location }}</td>
                    <td>{{ $report->description }}</td>
                    <td>
                        @php
                            $badgeColor = match($report->status) {
                                'Ditinjau' => 'info',
                                'Sedang Diproses' => 'warning',
                                'Selesai' => 'success',
                                'Tidak Dapat Diproses' => 'danger',
                                default => 'secondary'
                            };
                        @endphp
                        <span class="badge bg-{{ $badgeColor }}">{{ $report->status }}</span>
                    </td>
                    <td>
                        @php
                            $canEditOrDelete = now()->diffInMinutes($report->created_at) <= 5;
                        @endphp

                        @if($canEditOrDelete)
                            <a href="{{ route('damage_reports.edit', $report->id) }}" class="btn btn-sm btn-warning">Edit</a>

                            <form action="{{ route('damage_reports.destroy', $report->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus laporan ini?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger">Hapus</button>
                            </form>
                        @else
                            <span class="text-muted">Edit/Hapus ditutup</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center text-muted">Belum ada laporan kerusakan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

{{-- Script filter pencarian --}}
<script>
    document.getElementById("searchInput").addEventListener("keyup", function () {
        let filter = this.value.toLowerCase();
        let rows = document.querySelectorAll("#progressTable tbody tr");

        rows.forEach(row => {
            let text = row.textContent.toLowerCase();
            row.style.display = text.includes(filter) ? "" : "none";
        });
    });
</script>
@endsection

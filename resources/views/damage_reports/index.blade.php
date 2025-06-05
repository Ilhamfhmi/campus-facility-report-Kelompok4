@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Daftar Laporan Kerusakan</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @elseif(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <input type="text" id="searchInput" class="form-control mb-3" placeholder="Cari laporan...">

    <a href="{{ route('damage_reports.create') }}" class="btn btn-primary mb-3">+ Tambah Laporan</a>
        <a href="{{ route('damage_reports.progress') }}" class="btn btn-primary mb-3">progress</a>
    <table class="table table-bordered" id="progressTable">
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Lokasi</th> <!-- Tambahan -->
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
                    <td>{{ $report->status }}</td>
                    <td>
                        @php
                            $canEditOrDelete = now()->diffInMinutes($report->created_at) <= 5;
                        @endphp

                        @if($canEditOrDelete)
                            <a href="{{ route('damage_reports.edit', $report->id) }}" class="btn btn-warning btn-sm">Edit</a>

                            <form action="{{ route('damage_reports.destroy', $report->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus laporan ini?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                        @else
                            <span class="text-muted">Edit/Hapus ditutup</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">Belum ada laporan kerusakan.</td> <!-- Sesuaikan colspan -->
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<script>
    // Search filter
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

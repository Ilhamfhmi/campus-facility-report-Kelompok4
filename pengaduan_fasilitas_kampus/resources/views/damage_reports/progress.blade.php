@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="h3 mb-4 text-gray-800">Progress Laporan Kerusakan</h1>

    <div class="card p-4">
        <h5>Data Laporan</h5>
        <div class="table-responsive">
            <table class="table table-bordered table-striped" id="reportTable">
                <thead>
                    <tr>
                        <th>NO</th>
                        <th>Tanggal</th>
                        <th>Deskripsi</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($damageReports as $index => $report)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $report->created_at->format('d-m-Y H:i') }}</td>
                            <td>{{ $report->description }}</td>
                            <td>{{ $report->status ?? 'Menunggu' }}</td>
                            <td>
                                @php
                                    $canEdit = now()->diffInMinutes($report->created_at) < 5;
                                @endphp

                                @if ($canEdit)
                                    <a href="{{ route('damage_reports.edit', $report->id) }}" class="btn btn-warning btn-sm">Edit</a>

                                    <form action="{{ route('damage_reports.destroy', $report->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin mau hapus?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm">Hapus</button>
                                    </form>
                                @else
                                    <span class="text-muted">Tidak bisa edit</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function () {
        $('#reportTable').DataTable();
    });
</script>
@endpush

@push('styles')
<link href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" rel="stylesheet" />
@endpush
@endsection
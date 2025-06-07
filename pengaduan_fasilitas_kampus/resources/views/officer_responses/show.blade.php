@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Detail Tanggapan Petugas</h2>

    <div class="card">
        <div class="card-header">
            Detail Tanggapan #{{ $officerResponse->id }}
        </div>
        <div class="card-body">
            <p><strong>Laporan Kerusakan ID:</strong> {{ $officerResponse->damageReport->id ?? 'Tidak Ditemukan' }}</p>
            <p><strong>Lokasi Laporan:</strong> {{ $officerResponse->damageReport->location ?? 'Tidak Ditemukan' }}</p>
            <p><strong>Deskripsi Laporan:</strong> {{ $officerResponse->damageReport->description ?? 'Tidak Ditemukan' }}</p>
            <p><strong>Isi Tanggapan:</strong> {{ $officerResponse->response_content }}</p>
            <p><strong>Nama Petugas:</strong> {{ $officerResponse->officer_name }}</p>
            <p><strong>Status Laporan Update:</strong>
                <span class="badge {{
                    ($officerResponse->status_update == 'Pending' || $officerResponse->damageReport->status == 'Pending') ? 'bg-secondary' :
                    (($officerResponse->status_update == 'Ditinjau' || $officerResponse->damageReport->status == 'Ditinjau') ? 'bg-info' :
                    (($officerResponse->status_update == 'Diproses' || $officerResponse->damageReport->status == 'Diproses') ? 'bg-warning' :
                    (($officerResponse->status_update == 'Selesai' || $officerResponse->damageReport->status == 'Selesai') ? 'bg-success' : 'bg-primary')))
                }}">
                    {{ $officerResponse->status_update ?? $officerResponse->damageReport->status ?? 'N/A' }}
                </span>
            </p>
            <p><strong>Tanggal Tanggapan:</strong> {{ $officerResponse->created_at->format('d-m-Y H:i') }}</p>
            <p><strong>Terakhir Diperbarui:</strong> {{ $officerResponse->updated_at->format('d-m-Y H:i') }}</p>
        </div>
        <div class="card-footer">
            <a href="{{ route('officer_responses.edit', $officerResponse->id) }}" class="btn btn-warning">Edit</a>
            <a href="{{ route('officer_responses.index') }}" class="btn btn-secondary">Kembali ke Daftar</a>
        </div>
    </div>
</div>
@endsection
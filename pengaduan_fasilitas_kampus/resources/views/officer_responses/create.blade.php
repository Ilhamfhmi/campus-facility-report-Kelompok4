@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Tambah Tanggapan Petugas Baru</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('officer_responses.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="damage_report_id" class="form-label">Pilih Laporan Kerusakan:</label>
            <select class="form-control" id="damage_report_id" name="damage_report_id" required>
                <option value="">-- Pilih Laporan --</option>
                @foreach($damageReports as $report)
                    <option value="{{ $report->id }}">{{ $report->location }} - {{ Str::limit($report->description, 50) }} (Status: {{ $report->status }})</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="response_content" class="form-label">Isi Tanggapan:</label>
            <textarea class="form-control" id="response_content" name="response_content" rows="5" required>{{ old('response_content') }}</textarea>
        </div>
        <div class="mb-3">
            <label for="officer_name" class="form-label">Nama Petugas:</label>
            <input type="text" class="form-control" id="officer_name" name="officer_name" value="{{ old('officer_name', Auth::user()->name ?? '') }}" required>
        </div>
        <div class="mb-3">
            <label for="status_update" class="form-label">Update Status Laporan (Opsional):</label>
            <select class="form-control" id="status_update" name="status_update">
                <option value="">Tidak ada perubahan status</option>
                <option value="Pending">Pending</option>
                <option value="Ditinjau">Ditinjau</option>
                <option value="Diproses">Diproses</option>
                <option value="Selesai">Selesai</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Simpan Tanggapan</button>
        <a href="{{ route('officer_responses.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
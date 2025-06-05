@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Buat Laporan Kerusakan</h2>

    <form action="{{ route('damage_reports.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="location" class="form-label">Lokasi Kerusakan</label>
            <input type="text" class="form-control" id="location" name="location" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Deskripsi Kerusakan</label>
            <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
        </div>

        <div class="mb-3">
            <label for="evidence_photo" class="form-label">Bukti Foto</label>
            <input type="file" class="form-control" id="evidence_photo" name="evidence_photo" accept="image/*">
        </div>

        <button type="submit" class="btn btn-success">Kirim Laporan</button>
    </form>
</div>
@endsection

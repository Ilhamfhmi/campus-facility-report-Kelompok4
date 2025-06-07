@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Laporan Kerusakan</h2>

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('damage_reports.update', $damageReport->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="location" class="form-label">Tempat / Lokasi</label>
            <input type="text" name="location" id="location" class="form-control" value="{{ old('location', $damageReport->location) }}" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Deskripsi Kerusakan</label>
            <textarea name="description" id="description" rows="4" class="form-control" required>{{ old('description', $damageReport->description) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="photo_proof" class="form-label">Foto Bukti (Opsional)</label><br>
            @if ($damageReport->photo_proof)
                <img src="{{ asset('storage/' . $damageReport->photo_proof) }}" alt="Bukti" width="200" class="mb-2">
            @endif
            <input type="file" name="photo_proof" id="photo_proof" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Perbarui Laporan</button>
        <a href="{{ route('damage_reports.progress') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
@extends('layouts.app')

@section('content')

<div class="row mb-4">
  <div class="col">
    <div class="card bg-primary text-white shadow">
      <div class="card-body p-4">
        <h4>Hallo selamat Datangg {{ auth()->user()->name }}</h4>
      </div>
    </div>
  </div>
</div>

<div class="row g-4 mb-4">
  {{-- Statistik Pengaduan --}}
  <div class="col-lg-3 col-md-6">
    <div class="card text-white bg-primary shadow-sm">
      <div class="card-body">
        <h5 class="card-title">{{ $totalPengaduan ?? 0 }}</h5>
        <p class="card-text mb-0">Total Pengaduan</p>
      </div>
    </div>
  </div>
  <div class="col-lg-3 col-md-6">
    <div class="card text-white bg-warning shadow-sm">
      <div class="card-body">
        <h5 class="card-title">{{ $sedangDiproses ?? 0 }}</h5>
        <p class="card-text mb-0">Pengaduan Ditinjau</p>
      </div>
    </div>
  </div>
  <div class="col-lg-3 col-md-6">
    <div class="card text-white bg-success shadow-sm">
      <div class="card-body">
        <h5 class="card-title">{{ $selesai ?? 0 }}</h5>
        <p class="card-text mb-0">Pengaduan Dikerjakan</p>
      </div>
    </div>
  </div>
  <div class="col-lg-3 col-md-6">
    <div class="card text-white bg-danger shadow-sm">
      <div class="card-body">
        <h5 class="card-title">{{ $tidakDiproses ?? 0 }}</h5>
        <p class="card-text mb-0">Pengaduan Ditolak</p>
      </div>
    </div>
  </div>
</div>

<div class="row g-4">
  {{-- Daftar Pengaduan Terbaru --}}
  <div class="col-lg-7">
    <div class="card shadow-sm h-100">
      <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0 fw-semibold">Pengaduan Terbaru</h5>
        <a href="/admin/pengaduan" class="btn btn-sm btn-warning">Semua Pengaduan</a>
      </div>
      <div class="card-body p-3">
        <div class="table-responsive">
          <table class="table table-hover align-middle">
            <thead class="table-light">
              <tr>
                <th>No</th>
                <th>Judul</th>
                <th>Status</th>
                <th>Pengirim</th>
              </tr>
            </thead>
            <tbody>
              @forelse ($pengaduans ?? [] as $pengaduan)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $pengaduan->judul_pengaduan }}</td>
                  <td>
                    @php
                      $badgeColor = match($pengaduan->status) {
                        'Sedang Diproses' => 'warning',
                        'Selesai' => 'success',
                        'Tidak Dapat Diproses' => 'danger',
                        default => 'secondary'
                      };
                    @endphp
                    <span class="badge bg-{{ $badgeColor }}">{{ $pengaduan->status }}</span>
                  </td>
                  <td>{{ $pengaduan->user->name ?? 'User tidak ditemukan' }}</td>
                </tr>
              @empty
                <tr>
                  <td colspan="4" class="text-center text-muted">Tidak ada pengaduan.</td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  {{-- Daftar Komentar Terbaru --}}
  <div class="col-lg-5">
    <div class="card shadow-sm h-100">
      <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0 fw-semibold">Komentar Terbaru</h5>
        <a href="/admin/komentar" class="btn btn-sm btn-warning">Semua</a>
      </div>
      <div class="card-body p-3">
        <div class="table-responsive">
          <table class="table table-hover align-middle">
            <thead class="table-light">
              <tr>
                <th>No</th>
                <th>Komentar</th>
                <th>Oleh</th>
              </tr>
            </thead>
            <tbody>
              @forelse ($comments ?? [] as $comment)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ \Illuminate\Support\Str::limit($comment->body, 50) }}</td>
                  <td>{{ $comment->user->name ?? 'User tidak ditemukan' }}</td>
                </tr>
              @empty
                <tr>
                  <td colspan="3" class="text-center text-muted">Belum ada komentar.</td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection

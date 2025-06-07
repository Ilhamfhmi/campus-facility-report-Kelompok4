@extends('layouts.app') {{-- Sesuaikan dengan layout utama Anda --}}

@section('content')
<div class="container">
    <h2>Daftar Tanggapan Petugas</h2>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <a href="{{ route('officer_responses.create') }}" class="btn btn-primary mb-3">Tambah Tanggapan Baru</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Laporan Kerusakan</th>
                <th>Isi Tanggapan</th>
                <th>Petugas</th>
                <th>Status Laporan</th>
                <th>Tanggal</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($officerResponses as $response)
                <tr>
                    <td>{{ $response->id }}</td>
                    <td>
                        <a href="{{ route('damage_reports.show', $response->damageReport->id ?? '#') }}">
                            {{ $response->damageReport->description ?? 'Laporan Tidak Ditemukan' }}
                        </a>
                    </td>
                    <td>{{ $response->response_content }}</td>
                    <td>{{ $response->officer_name }}</td>
                    <td>
                        <span class="badge {{
                            ($response->status_update == 'Pending' || $response->damageReport->status == 'Pending') ? 'bg-secondary' :
                            (($response->status_update == 'Ditinjau' || $response->damageReport->status == 'Ditinjau') ? 'bg-info' :
                            (($response->status_update == 'Sedang Diproses' || $response->damageReport->status == 'Diproses') ? 'bg-warning' :
                            (($response->status_update == 'Selesai' || $response->damageReport->status == 'Selesai') ? 'bg-success' : 'bg-primary')))
                        }}">
                            {{ $response->status_update ?? $response->damageReport->status ?? 'N/A' }}
                        </span>
                    </td>
                    <td>{{ $response->created_at->format('d-m-Y H:i') }}</td>
                    <td>
                        <a href="{{ route('officer_responses.show', $response->id) }}" class="btn btn-sm btn-info">Detail</a>
                        <a href="{{ route('officer_responses.edit', $response->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('officer_responses.destroy', $response->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus tanggapan ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">Tidak ada tanggapan petugas yang tersedia.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
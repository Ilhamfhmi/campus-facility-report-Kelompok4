@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold"><i class="bi bi-geo-alt-fill me-2 text-primary"></i>Daftar Lokasi Kampus</h2>
        <a href="{{ route('campus_locations.create') }}" class="btn btn-primary shadow-sm">
            <i class="bi bi-plus-circle me-1"></i> Tambah Lokasi
        </a>
    </div>

    {{-- Notifikasi sukses --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle me-1"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
        </div>
    @endif

    {{-- Tabel lokasi kampus --}}
    @if($locations->count())
        <div class="table-responsive shadow-sm rounded bg-white p-3">
            <table class="table table-hover align-middle">
                <thead class="table-primary">
                    <tr>
                        <th scope="col">Gedung</th>
                        <th scope="col">Lantai</th>
                        <th scope="col">Ruangan</th>
                        <th scope="col" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($locations as $location)
                        <tr>
                            <td>
                                <strong>{{ $location->building_name }}</strong>
                            </td>
                            <td>
                                <span class="badge bg-info text-dark">
                                    {{ $location->floor ?? 'N/A' }}
                                </span>
                            </td>
                            <td>
                                <span class="badge bg-secondary">
                                    {{ $location->room_number ?? 'N/A' }}
                                </span>
                            </td>
                            <td class="text-center">
                                <a href="{{ route('campus_locations.show', $location->id) }}" class="btn btn-sm btn-outline-info me-1">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('campus_locations.edit', $location->id) }}" class="btn btn-sm btn-outline-warning me-1">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('campus_locations.destroy', $location->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus lokasi ini secara permanen?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Paginasi --}}
        <div class="mt-4 d-flex justify-content-center">
            {{ $locations->links() }}
        </div>
    @else
        <div class="alert alert-warning text-center shadow-sm">
            <i class="bi bi-info-circle me-1"></i> Belum ada lokasi kampus yang ditambahkan.
        </div>
    @endif
</div>
@endsection

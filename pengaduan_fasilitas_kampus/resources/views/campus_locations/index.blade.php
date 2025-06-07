@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Daftar Lokasi Kampus</h2>

    {{-- Notifikasi --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @elseif(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    {{-- Pencarian --}}
    <input type="text" id="searchInput" class="form-control mb-3" placeholder="Cari lokasi kampus...">

    {{-- Tombol aksi --}}
    <div class="mb-3">
        <a href="{{ route('campus_locations.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle me-1"></i> Tambah Lokasi
        </a>
    </div>

    {{-- Tabel lokasi --}}
    @if($locations->count())
        <table class="table table-bordered table-hover" id="locationTable">
            <thead class="table-light">
                <tr>
                    <th>No</th>
                    <th>Gedung</th>
                    <th>Lantai</th>
                    <th>Ruangan</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($locations as $index => $location)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $location->building_name }}</td>
                        <td>{{ $location->floor ?? 'N/A' }}</td>
                        <td>{{ $location->room_number ?? 'N/A' }}</td>
                        <td class="text-center">
                            <a href="{{ route('campus_locations.show', $location->id) }}" class="btn btn-sm btn-outline-info me-1" title="Lihat">
                                <i class="bi bi-eye"></i>
                            </a>
                            <a href="{{ route('campus_locations.edit', $location->id) }}" class="btn btn-sm btn-outline-warning me-1" title="Edit">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('campus_locations.destroy', $location->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus lokasi ini secara permanen?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger" title="Hapus">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{-- Paginasi --}}
        <div class="mt-4 d-flex justify-content-center">
            {{ $locations->links() }}
        </div>
    @else
        <div class="alert alert-warning text-center">
            <i class="bi bi-info-circle me-1"></i> Belum ada lokasi kampus yang ditambahkan.
        </div>
    @endif
</div>

{{-- Script filter pencarian --}}
<script>
    document.getElementById("searchInput").addEventListener("keyup", function () {
        let filter = this.value.toLowerCase();
        let rows = document.querySelectorAll("#locationTable tbody tr");

        rows.forEach(row => {
            let text = row.textContent.toLowerCase();
            row.style.display = text.includes(filter) ? "" : "none";
        });
    });
</script>
@endsection

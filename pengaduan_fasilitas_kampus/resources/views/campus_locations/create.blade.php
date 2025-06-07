@extends('layouts.app')

@section('content')
<main id="main">
    <section id="add-location" class="about mt-5">
        <div class="container mt-5">

            <div class="section-title text-center mb-4" data-aos="fade-up">
                <h2>Lokasi Kampus</h2>
                <p>Tambah Lokasi Baru</p>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card shadow" data-aos="fade-up" data-aos-delay="200">
                        <div class="card-header text-white" style="background-color: #01036f;">
                            <h5 class="mb-0"><i class="bx bx-map me-2"></i> Formulir Lokasi Kampus</h5>
                        </div>
                        <div class="card-body">

                            {{-- Tampilkan error validasi global --}}
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <strong>Terjadi kesalahan!</strong> Mohon periksa kembali input Anda.
                                </div>
                            @endif

                            <form action="{{ route('campus_locations.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="mb-3">
                                    <label for="building_name" class="form-label">Nama Gedung <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('building_name') is-invalid @enderror" id="building_name" name="building_name" value="{{ old('building_name') }}" required>
                                    @error('building_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="floor" class="form-label">Lantai</label>
                                        <input type="text" class="form-control @error('floor') is-invalid @enderror" id="floor" name="floor" value="{{ old('floor') }}">
                                        @error('floor')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="room_number" class="form-label">Nomor Ruangan</label>
                                        <input type="text" class="form-control @error('room_number') is-invalid @enderror" id="room_number" name="room_number" value="{{ old('room_number') }}">
                                        @error('room_number')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="description" class="form-label">Deskripsi Lokasi</label>
                                    <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3">{{ old('description') }}</textarea>
                                    @error('description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="location_image" class="form-label">Foto Lokasi</label>
                                    <input type="file" class="form-control @error('location_image') is-invalid @enderror" id="location_image" name="location_image">
                                    @error('location_image')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary me-2"><i class="bx bx-save"></i> Submit</button>
                                    <a href="{{ route('campus_locations.index') }}" class="btn btn-secondary"><i class="bx bx-x-circle"></i> Cancel</a>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
</main>
@endsection

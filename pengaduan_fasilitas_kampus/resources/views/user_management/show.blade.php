@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Detail User</h2>

    <div class="card shadow-sm p-3">
        <h4>{{ $user->name }}</h4>
        <p><strong>Email:</strong> {{ $user->email }}</p>
        <p><strong>Role:</strong> <span class="badge bg-info text-dark text-capitalize">{{ $user->role }}</span></p>
        <p><strong>Dibuat pada:</strong> {{ $user->created_at->format('d-m-Y H:i') }}</p>
        <p><strong>Terakhir diperbarui:</strong> {{ $user->updated_at->format('d-m-Y H:i') }}</p>

        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning me-2">Edit</a>
        <a href="{{ route('users.index') }}" class="btn btn-secondary">Kembali</a>
    </div>
</div>
@endsection

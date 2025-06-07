@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center align-items-center" style="min-height: 90vh;">
    <div class="col-md-6 col-lg-5">
        @if(session('error') || session('success'))
            @php
                $type = session('error') ? 'error' : 'success';
                $message = session($type);
                $alertClass = $type === 'error' ? 'alert-danger' : 'alert-success';
                $id = $type . 'Message';
            @endphp

            <div id="{{ $id }}" class="alert {{ $alertClass }} alert-dismissible fade show" role="alert">
                {{ $message }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>

            <script>
                setTimeout(() => {
                    const alertBox = document.getElementById('{{ $id }}');
                    if (alertBox) alertBox.classList.remove('show');
                }, 5000);
            </script>
        @endif

        <div class="card shadow-sm">
            <div class="card-body p-4">
                <h3 class="text-center mb-4">Register (Non SSO)</h3>
                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="name" class="form-label">Nama</label>
                        <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus
                            class="form-control @error('name') is-invalid @enderror">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input id="username" type="username" name="username" value="{{ old('username') }}" required
                            class="form-control @error('username') is-invalid @enderror">
                        @error('username')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input id="password" type="password" name="password" required
                            class="form-control @error('password') is-invalid @enderror">
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                        <input id="password_confirmation" type="password" name="password_confirmation" required
                            class="form-control">
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">
                            Register
                        </button>
                    </div>
                </form>

                {{-- Link ke login --}}
                <div class="text-center mt-3">
                    <span>Sudah punya akun? <a href="{{ route('login') }}">Login di sini</a></span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Campus Location Details</h1>

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-8">
                    <h5 class="card-title">{{ $campusLocation->building_name }}</h5>
                    <p class="card-text">
                        <strong>Floor:</strong> {{ $campusLocation->floor ?? '-' }}<br>
                        <strong>Room Number:</strong> {{ $campusLocation->room_number ?? '-' }}<br>
                        <strong>Description:</strong> {{ $campusLocation->description ?? '-' }}
                    </p>
                </div>
                @if($campusLocation->location_image)
                <div class="col-md-4">
                    <img src="{{ asset('storage/' . $campusLocation->location_image) }}" alt="Location Image" class="img-fluid rounded">
                </div>
                @endif
            </div>
        </div>
    </div>

    <div class="mt-3">
        <a href="{{ route('campus_locations.edit', $campusLocation->id) }}" class="btn btn-primary">Edit</a>
        <a href="{{ route('campus_locations.index') }}" class="btn btn-secondary">Back to List</a>
    </div>
</div>
@endsection
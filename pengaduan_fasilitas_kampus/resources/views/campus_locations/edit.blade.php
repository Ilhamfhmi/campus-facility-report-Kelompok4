@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Campus Location</h1>

    <form action="{{ route('campus_locations.update', $campusLocation->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="building_name" class="form-label">Building Name*</label>
            <input type="text" class="form-control" id="building_name" name="building_name" value="{{ $campusLocation->building_name }}" required>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="floor" class="form-label">Floor</label>
                <input type="text" class="form-control" id="floor" name="floor" value="{{ $campusLocation->floor }}">
            </div>
            <div class="col-md-6">
                <label for="room_number" class="form-label">Room Number</label>
                <input type="text" class="form-control" id="room_number" name="room_number" value="{{ $campusLocation->room_number }}">
            </div>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description" rows="3">{{ $campusLocation->description }}</textarea>
        </div>

        <div class="mb-3">
            <label for="location_image" class="form-label">Location Image</label>
            <input type="file" class="form-control" id="location_image" name="location_image">
            
            @if($campusLocation->location_image)
            <div class="mt-2">
                <p>Current Image:</p>
                <img src="{{ asset('storage/' . $campusLocation->location_image) }}" alt="Current Image" style="max-height: 150px;">
                <div class="form-check mt-2">
                    <input class="form-check-input" type="checkbox" id="remove_image" name="remove_image">
                    <label class="form-check-label" for="remove_image">
                        Remove current image
                    </label>
                </div>
            </div>
            @endif
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('campus_locations.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
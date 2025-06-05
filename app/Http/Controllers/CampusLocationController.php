<?php

namespace App\Http\Controllers;

use App\Models\CampusLocation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CampusLocationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $locations = CampusLocation::latest()->paginate(10);
        return view('campus_locations.index', compact('locations')); 
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('campus_locations.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'building_name' => 'required|string|max:255',
            'floor' => 'nullable|string|max:50',
            'room_number' => 'nullable|string|max:50',
            'description' => 'nullable|string',
            'location_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('location_image')) {
            $imagePath = $request->file('location_image')->store('location_images', 'public');
            $validated['location_image'] = $imagePath;
        }

        CampusLocation::create($validated);

        return redirect()->route('campus_locations.index')
                         ->with('success', 'Campus location created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(CampusLocation $campusLocation)
    {
        return view('campus_locations.show', compact('campusLocation')); // path sudah diperbaiki
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CampusLocation $campusLocation)
    {
        return view('campus_locations.edit', compact('campusLocation')); // path sudah diperbaiki
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CampusLocation $campusLocation)
    {
        $validated = $request->validate([
            'building_name' => 'required|string|max:255',
            'floor' => 'nullable|string|max:50',
            'room_number' => 'nullable|string|max:50',
            'description' => 'nullable|string',
            'location_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('location_image')) {
            // Delete old image if exists
            if ($campusLocation->location_image) {
                Storage::disk('public')->delete($campusLocation->location_image);
            }
            
            $imagePath = $request->file('location_image')->store('location_images', 'public');
            $validated['location_image'] = $imagePath;
        }

        $campusLocation->update($validated);

        return redirect()->route('campus_locations.index')
                         ->with('success', 'Campus location updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CampusLocation $campusLocation)
    {
        // Delete image if exists
        if ($campusLocation->location_image) {
            Storage::disk('public')->delete($campusLocation->location_image);
        }

        $campusLocation->delete();

        return redirect()->route('campus_locations.index')
                         ->with('success', 'Campus location deleted successfully.');
    }
}

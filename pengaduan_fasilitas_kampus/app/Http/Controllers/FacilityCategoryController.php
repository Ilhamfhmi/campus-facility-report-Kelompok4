<?php

namespace App\Http\Controllers;

use App\Models\FacilityCategory;
use Illuminate\Http\Request;

class FacilityCategoryController extends Controller
{
    public function index()
    {
        $categories = FacilityCategory::all();
        return view('facility_categories.index', compact('categories'));
    }

    public function create()
    {
        return view('facility_categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|boolean',
        ]);

        FacilityCategory::create($request->all());
        return redirect()->route('facility_categories.index')->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $category = FacilityCategory::findOrFail($id);
        return view('facility_categories.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|boolean',
        ]);

        $category = FacilityCategory::findOrFail($id);
        $category->update($request->all());

        return redirect()->route('facility_categories.index')->with('success', 'Kategori berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $category = FacilityCategory::findOrFail($id);
        $category->delete();

        return redirect()->route('facility_categories.index')->with('success', 'Kategori berhasil dihapus.');
    }
}

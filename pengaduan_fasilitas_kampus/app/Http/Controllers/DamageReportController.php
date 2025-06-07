<?php

namespace App\Http\Controllers;

use App\Models\DamageReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class DamageReportController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user->role === 'admin') {
            // Admin bisa lihat semua laporan
            $damageReports = DamageReport::orderBy('created_at', 'desc')->get();
        } elseif ($user->role === 'mahasiswa') {
            // Mahasiswa hanya lihat laporannya sendiri
            $damageReports = DamageReport::where('user_id', $user->id)->orderBy('created_at', 'desc')->get();
        } else {
            // Petugas atau lainnya tidak boleh lihat laporan
            abort(403, 'Anda tidak diizinkan mengakses halaman ini.');
        }

        return view('damage_reports.index', compact('damageReports'));
    }


    public function create()
    {
        return view('damage_reports.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'location' => 'required|string',
            'description' => 'required|string',
            'photo_proof' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $path = null;
        if ($request->hasFile('photo_proof')) {
            $path = $request->file('photo_proof')->store('damage_reports', 'public');
        }

        DamageReport::create([
            'user_id' => auth()->id(),
            'location' => $request->location,
            'description' => $request->description,
            'photo_proof' => $path,
            'status' => 'Pending', // default status
        ]);

        return redirect()->route('damage_reports.index')->with('success', 'Damage report submitted successfully!');
    }

    public function edit(DamageReport $damageReport)
    {
        if ($damageReport->user_id !== Auth::id()) {
            abort(403);
        }

        if (now()->diffInMinutes($damageReport->created_at) > 5) {
            return redirect()->back()->with('error', 'Editing is only allowed within 5 minutes after submission.');
        }

        return view('damage_reports.edit', compact('damageReport'));
    }

    public function update(Request $request, DamageReport $damageReport)
    {
        if ($damageReport->user_id !== Auth::id()) {
            abort(403);
        }

        if (now()->diffInMinutes($damageReport->created_at) > 5) {
            return redirect()->back()->with('error', 'Update is only allowed within 5 minutes after submission.');
        }

        $request->validate([
            'location' => 'required|string',
            'description' => 'required|string',
            'photo_proof' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->only(['location', 'description']);

        if ($request->hasFile('photo_proof')) {
            if ($damageReport->photo_proof) {
                Storage::disk('public')->delete($damageReport->photo_proof);
            }

            $data['photo_proof'] = $request->file('photo_proof')->store('damage_reports', 'public');
        }

        $damageReport->update($data);

        return redirect()->route('damage_reports.progress')->with('success', 'Damage report updated successfully!');
    }

    public function destroy(DamageReport $damageReport)
    {
        if ($damageReport->user_id !== Auth::id()) {
            abort(403);
        }

        if (now()->diffInMinutes($damageReport->created_at) > 5) {
            return redirect()->back()->with('error', 'Deletion is only allowed within 5 minutes after submission.');
        }

        if ($damageReport->photo_proof) {
            Storage::disk('public')->delete($damageReport->photo_proof);
        }

        $damageReport->delete();

        return redirect()->route('damage_reports.progress')->with('success', 'Damage report deleted successfully!');
    }

    public function progress()
    {
        $user = auth()->user();

        if ($user->role === 'admin') {
            $damageReports = DamageReport::orderBy('created_at', 'desc')->get();
        } elseif ($user->role === 'mahasiswa') {
            $damageReports = DamageReport::where('user_id', $user->id)->orderBy('created_at', 'desc')->get();
        } else {
            abort(403, 'Anda tidak diizinkan mengakses halaman ini.');
        }

        return view('damage_reports.progress', compact('damageReports'));
    }

    public function show(DamageReport $damageReport)
    {
        abort(404);
    }

}
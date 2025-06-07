<?php

namespace App\Http\Controllers;

use App\Models\OfficerResponse;
use App\Models\DamageReport; // Penting untuk relasi
use Illuminate\Http\Request;
use App\Http\Resources\OfficerResponseResource; // Untuk respons API

class OfficerResponseController extends Controller
{
    /**
     * Display a listing of the resource (for Blade View).
     */
    public function index()
    {
        // Mengambil semua OfficerResponse dengan relasi DamageReport
        $officerResponses = OfficerResponse::with('damageReport')->orderBy('created_at', 'desc')->get();
        return view('officer_responses.index', compact('officerResponses'));
    }

    /**
     * Show the form for creating a new resource (for Blade View).
     */
    public function create()
    {
        // Mendapatkan semua laporan kerusakan untuk dipilih oleh petugas
        $damageReports = DamageReport::all();
        return view('officer_responses.create', compact('damageReports'));
    }

    /**
     * Store a newly created resource in storage (for Blade View).
     */
    public function store(Request $request)
    {
        $request->validate([
            'damage_report_id' => 'required|exists:damage_reports,id',
            'response_content' => 'required|string',
            'officer_name' => 'required|string',
            'status_update' => 'nullable|string',
        ]);

        $officerResponse = OfficerResponse::create($request->all());

        // Opsional: Update status laporan kerusakan jika 'status_update' diberikan
        if ($request->has('status_update') && $request->status_update != '') {
            $damageReport = DamageReport::find($request->damage_report_id);
            if ($damageReport) {
                $damageReport->status = $request->status_update;
                $damageReport->save();
            }
        }

        return redirect()->route('officer_responses.index')
                         ->with('success', 'Tanggapan petugas berhasil ditambahkan!');
    }

    /**
     * Display the specified resource (for Blade View).
     */
    public function show(OfficerResponse $officerResponse)
    {
        // Menampilkan detail tanggapan petugas
        return view('officer_responses.show', compact('officerResponse'));
    }

    /**
     * Show the form for editing the specified resource (for Blade View).
     */
    public function edit(OfficerResponse $officerResponse)
    {
        // Mendapatkan semua laporan kerusakan untuk dropdown
        $damageReports = DamageReport::all();
        return view('officer_responses.edit', compact('officerResponse', 'damageReports'));
    }

    /**
     * Update the specified resource in storage (for Blade View).
     */
    public function update(Request $request, OfficerResponse $officerResponse)
    {
        $request->validate([
            'damage_report_id' => 'required|exists:damage_reports,id',
            'response_content' => 'required|string',
            'officer_name' => 'required|string',
            'status_update' => 'nullable|string',
        ]);

        $officerResponse->update($request->all());

        // Opsional: Update status laporan kerusakan jika 'status_update' diberikan
        if ($request->has('status_update') && $request->status_update != '') {
            $damageReport = DamageReport::find($request->damage_report_id);
            if ($damageReport) {
                $damageReport->status = $request->status_update;
                $damageReport->save();
            }
        }

        return redirect()->route('officer_responses.index')
                         ->with('success', 'Tanggapan petugas berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage (for Blade View).
     */
    public function destroy(OfficerResponse $officerResponse)
    {
        $officerResponse->delete();
        return redirect()->route('officer_responses.index')
                         ->with('success', 'Tanggapan petugas berhasil dihapus!');
    }

    // --- API Methods (opsional, jika Anda juga ingin endpoint API) ---
    // Biasanya ini di Controller terpisah atau di routes/api.php dengan prefix

    /**
     * API: Get all officer responses.
     */
    public function apiIndex()
    {
        $responses = OfficerResponse::with('damageReport')->get();
        return new OfficerResponseResource(true, 'List Tanggapan Petugas', $responses);
    }

    /**
     * API: Store a new officer response.
     */
    public function apiStore(Request $request)
    {
        $request->validate([
            'damage_report_id' => 'required|exists:damage_reports,id',
            'response_content' => 'required|string',
            'officer_name' => 'required|string',
            'status_update' => 'nullable|string',
        ]);

        $officerResponse = OfficerResponse::create($request->all());

        // Opsional: Update status laporan kerusakan jika 'status_update' diberikan
        if ($request->has('status_update') && $request->status_update != '') {
            $damageReport = DamageReport::find($request->damage_report_id);
            if ($damageReport) {
                $damageReport->status = $request->status_update;
                $damageReport->save();
            }
        }
        return new OfficerResponseResource(true, 'Tanggapan petugas berhasil ditambahkan', $officerResponse);
    }

    /**
     * API: Show a specific officer response.
     */
    public function apiShow(OfficerResponse $officerResponse)
    {
        return new OfficerResponseResource(true, 'Detail Tanggapan Petugas', $officerResponse->load('damageReport'));
    }

    /**
     * API: Update a specific officer response.
     */
    public function apiUpdate(Request $request, OfficerResponse $officerResponse)
    {
        $request->validate([
            'damage_report_id' => 'required|exists:damage_reports,id',
            'response_content' => 'required|string',
            'officer_name' => 'required|string',
            'status_update' => 'nullable|string',
        ]);

        $officerResponse->update($request->all());

        // Opsional: Update status laporan kerusakan jika 'status_update' diberikan
        if ($request->has('status_update') && $request->status_update != '') {
            $damageReport = DamageReport::find($request->damage_report_id);
            if ($damageReport) {
                $damageReport->status = $request->status_update;
                $damageReport->save();
            }
        }
        return new OfficerResponseResource(true, 'Tanggapan petugas berhasil diperbarui', $officerResponse);
    }

    /**
     * API: Delete a specific officer response.
     */
    public function apiDestroy(OfficerResponse $officerResponse)
    {
        $officerResponse->delete();
        return new OfficerResponseResource(true, 'Tanggapan petugas berhasil dihapus', null);
    }
}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DamageReport;
use App\Models\OfficerResponse;

class DashboardController extends Controller
{
    public function index()
    {
        $totalPengaduan = DamageReport::count();
        $ditinjau = DamageReport::where('status', 'Ditinjau')->count();
        $diproses = DamageReport::whereIn('status', ['Sedang Diproses', 'Diproses'])->count();
        $selesai = DamageReport::where('status', 'Selesai')->count();

        $pengaduans = DamageReport::with('user')->latest()->take(5)->get();
        $comments = OfficerResponse::latest()->take(5)->get(); // ✅ Ambil komentar petugas

        return view('dashboard', compact(
            'totalPengaduan',
            'ditinjau',
            'diproses',
            'selesai',
            'pengaduans',
            'comments'
        ));
    }
}

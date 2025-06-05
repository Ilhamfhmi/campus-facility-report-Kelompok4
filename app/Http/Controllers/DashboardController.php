<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DamageReport;
use App\Models\Comment;

class DashboardController extends Controller
{
    public function index()
    {
        // Hitung jumlah total pengaduan dan masing-masing status
        $totalPengaduan = DamageReport::count();
        $sedangDiproses = DamageReport::where('status', 'Sedang Diproses')->count();
        $selesai = DamageReport::where('status', 'Selesai')->count();
        $tidakDiproses = DamageReport::where('status', 'Tidak Dapat Diproses')->count();

        // Ambil 5 pengaduan terbaru dengan relasi user
        $pengaduans = DamageReport::with('user')->latest()->take(5)->get();

        // Tampilkan view dashboard dengan data yang telah dikompilasi
        return view('dashboard', compact(
            'totalPengaduan',
            'sedangDiproses',
            'selesai',
            'tidakDiproses',
            'pengaduans'
        ));
    }
}
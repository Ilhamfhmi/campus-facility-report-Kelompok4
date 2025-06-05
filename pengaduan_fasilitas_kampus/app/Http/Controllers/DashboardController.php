<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DamageReport;
use App\Models\Comment;

class DashboardController extends Controller
{
    public function index()
    {
        $totalPengaduan = DamageReport::count();
        $sedangDiproses = DamageReport::where('status', 'Sedang Diproses')->count();
        $selesai = DamageReport::where('status', 'Selesai')->count();
        $tidakDiproses = DamageReport::where('status', 'Tidak Dapat Diproses')->count();

        $pengaduans = DamageReport::with('user')->latest()->take(5)->get();
        $comments = Comment::with('user')->latest()->take(5)->get();

        return view('dashboard', compact(
            'totalPengaduan',
            'sedangDiproses',
            'selesai',
            'tidakDiproses',
            'pengaduans',
            'comments'
        ));
    }
}


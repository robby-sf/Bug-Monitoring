<?php

// app/Http/Controllers/DashboardController.php
namespace App\Http\Controllers;

use App\Models\Issue;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index( Request $request)
    {
        // Menghitung statistik berdasarkan status/severity di tabel issues
        $totalIssues = Issue::count(); 
        $openIssues = Issue::where('status', 'open')->count();
        $resolvedIssues = Issue::where('status', 'resolved')->count(); // Diubah dari 'fixed' menjadi 'resolved'
        

        $inProgressIssues = Issue::where('status', 'in-progress')->count();

        $range = $request->input('range', '7days');
        
        $chartDates = [];
        $chartData = [];

        // 2. LOGIKA RENTANG WAKTU
        if (in_array($range, ['7days', '1month'])) {
            // Jika 7 Hari atau 1 Bulan -> Tampilkan per HARI
            $days = $range === '7days' ? 7 : 30;
            
            for ($i = $days - 1; $i >= 0; $i--) {
                $date = Carbon::now()->subDays($i);
                $chartDates[] = $date->format('d M'); // Format: 01 Nov
                $chartData[] = \App\Models\Issue::whereDate('created_at', $date->format('Y-m-d'))->count();
            }
        } else {
            // Jika 3 Bulan, 6 Bulan, YTD, atau 1 Tahun -> Tampilkan per BULAN
            $months = 12; // Default 1 year
            if ($range === '3months') $months = 3;
            elseif ($range === '6months') $months = 6;
            elseif ($range === 'ytd') $months = Carbon::now()->month; // Dari Januari sampai bulan ini
            
            for ($i = $months - 1; $i >= 0; $i--) {
                $date = Carbon::now()->startOfMonth()->subMonths($i);
                $chartDates[] = $date->format('M Y'); // Format: Nov 2025
                $chartData[] = \App\Models\Issue::whereYear('created_at', $date->year)
                                                ->whereMonth('created_at', $date->month)
                                                ->count();
            }
        }

        $recentIssues = Issue::latest()->take(5)->get();

        $recentActivities = \App\Models\IssueActivity::with(['user', 'issue'])->latest()->take(5)->get();

        return view('dashboard', compact(
            'totalIssues', 
            'openIssues', 
            'resolvedIssues', 
            'inProgressIssues',
            'recentIssues',
            'recentActivities',
            'chartDates', 
            'chartData'
        ));
    }
}
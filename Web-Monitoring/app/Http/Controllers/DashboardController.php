<?php

// app/Http/Controllers/DashboardController.php
namespace App\Http\Controllers;

use App\Models\Bug;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Menghitung statistik berdasarkan status di database
        $totalIssues = Bug::count(); // Total semua bug
        $openIssues = Bug::where('status', 'open')->count();
        $resolvedIssues = Bug::where('status', 'fixed')->count();
        $criticalIssues = Bug::where('message', 'LIKE', '%critical%')->count(); // Contoh filter sederhana

        // Mengambil 5 aktivitas terbaru
        $recentIssues = Bug::latest()->take(5)->get();

        return view('dashboard', compact(
            'totalIssues', 
            'openIssues', 
            'resolvedIssues', 
            'criticalIssues', 
            'recentIssues'
        ));
    }
}
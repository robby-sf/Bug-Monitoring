<?php

namespace App\Http\Controllers;

use App\Models\ObjekBaru;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $pengajuans = ObjekBaru::where('nik', Auth::user()->nik)
                                ->orderBy('created_at', 'desc')
                                ->get();

        return view('dashboard', compact('pengajuans'));
    }
}
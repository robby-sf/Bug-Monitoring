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
        // $salahitung = 1/0;

        return view('dashboard', compact('pengajuans'));
    }

    public function testDb() {
        return \DB::table('users')->where('username_salah', 'admin')->get();
    }
}
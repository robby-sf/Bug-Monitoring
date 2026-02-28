<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    public function index()
    {
        // Ambil data user, hitung statistik bug mereka, dan ambil 5 bug aktif mereka
        $team = User::withCount([
            'issues as assigned_count', // Total semua bug yang ditugaskan
            'issues as resolved_count' => function ($query) {
                $query->where('status', 'resolved'); // Total bug selesai
            },
            'issues as in_progress_count' => function ($query) {
                $query->whereIn('status', ['open', 'in-progress']); // Total bug yang masih dikerjakan
            }
        ])->with(['issues' => function ($query) {
            // Ambil maksimal 5 tiket yang SEDANG dikerjakan untuk ditampilkan di Modal
            $query->whereIn('status', ['open', 'in-progress'])->latest()->take(5);
        }])->paginate(10); // Batasi maksimal 10 anggota per halaman

        return view('team', compact('team'));
    }
}
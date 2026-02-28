<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\IssueActivity;

class ActivityController extends Controller
{
    public function index(Request $request)
    {
        // Panggil data activity beserta relasinya (siapa usernya, dan tiket apa)
        $query = IssueActivity::with(['user', 'issue']);

        // Logika Filter berdasarkan Jenis Aksi (Action)
        if ($request->has('action_type') && $request->action_type != 'All') {
            $query->where('action', strtolower($request->action_type));
        }

        // Urutkan dari yang terbaru, dan beri pagination (misal 15 per halaman)
        $activities = $query->latest()->paginate(15)->appends($request->query());

        return view('activity', compact('activities'));
    }
}
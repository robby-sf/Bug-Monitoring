<?php

namespace App\Http\Controllers;

use App\Models\Issue;
use Illuminate\Http\Request;

class IssueController extends Controller
{
    /**
     * Menampilkan daftar issue dengan fitur filter sederhana.
     */
    public function index(Request $request)
    {
        // 1. Inisialisasi Query dengan Eager Loading User
        $query = Issue::with('user');

        // 2. Logika Filter (Opsional, agar dropdown di UI kamu berfungsi)
        if ($request->has('status') && $request->status != 'All') {
            $query->where('status', $request->status);
        }

        if ($request->has('severity') && $request->severity != 'All') {
            $query->where('severity', $request->severity);
        }

        // 3. Ambil data dengan urutan terbaru
        $issues = $query->orderBy('created_at', 'desc')->get();

        /** * PENTING: Sesuaikan nama view! 
         * Jika filenya 'resources/views/issues.blade.php', maka tulis 'issues'.
         * Jika filenya 'resources/views/issues/index.blade.php', maka 'issues.index'.
         */
        return view('issues', compact('issues'));
    }

    /**
     * Menampilkan detail satu issue.
     */
    public function show($id)
    {
        // Menggunakan firstOrFail agar jika ID salah langsung muncul 404, bukan error coding.
        $issue = Issue::with('user')->where('issue_id', $id)->firstOrFail();

        return view('issues.show', compact('issue'));
    }

    public function apiStore(Request $request)
{
    // 1. Validasi data yang masuk dari API
    $validator = \Validator::make($request->all(), [
        'title' => 'required|string',
        'description' => 'required|string',
        'severity' => 'required|in:Critical,High,Medium,Low',
        'category' => 'required|string',
    ]);

    if ($validator->fails()) {
        return response()->json(['error' => $validator->errors()], 422);
    }

    // 2. Simpan ke database
    $issue = \App\Models\Issue::create([
        'issue_id' => 'BUG-' . strtoupper(\Str::random(5)), // Generate ID otomatis
        'title' => $request->title,
        'description' => $request->description,
        'severity' => $request->severity,
        'category' => $request->category,
        'status' => 'open',
        'user_id' => 1, // Otomatis assign ke admin pertama saat testing
    ]);

    return response()->json([
        'message' => 'Bug report received successfully!',
        'issue' => $issue
    ], 201);
}
}
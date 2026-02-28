<?php

namespace App\Http\Controllers;

use App\Models\Issue;
use Illuminate\Http\Request;
use App\Models\User;


class IssueController extends Controller
{
    public function index(Request $request)
    {
        $query = \App\Models\Issue::with('user');

        // Logika Filter Status & Severity
        if ($request->has('status') && $request->status != 'All') {
            $query->where('status', $request->status);
        }
        if ($request->has('severity') && $request->severity != 'All') {
            $query->where('severity', $request->severity);
        }

        // --- LOGIKA SEARCH (Jangan sampai hilang ya!) ---
        if ($request->has('search') && $request->search != '') {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('issue_id', 'like', '%' . $searchTerm . '%')
                  ->orWhere('title', 'like', '%' . $searchTerm . '%')
                  ->orWhere('category', 'like', '%' . $searchTerm . '%');
            });
        }

        $issues = $query->orderByRaw("FIELD(status, 'open', 'in-progress', 'resolved')")
                        ->latest()
                        ->paginate(10)
                        ->withQueryString();

        return view('issues', compact('issues'));
    }

    public function show($id)
    {
        
        $issue = Issue::with('user')->where('issue_id', $id)->firstOrFail();

        $admins = User::whereIn('role', ['admin', 'developer'])->get();

        return view('issues.show', compact('issue', 'admins'));
    }

    public function apiStore(Request $request)
    {
        // 1. Simpan langsung ke tabel issues beserta data canggihnya
        $issue = \App\Models\Issue::create([
            'issue_id'          => 'BUG-' . strtoupper(\Illuminate\Support\Str::random(5)),
            'title'             => $request->title,
            'description'       => $request->description,
            'technical_details' => $request->technical_details,
            'severity'          => $request->severity,
            'category'          => $request->category,
            'status'            => 'open',
            'user_id'           => null, // Unassigned
            // --- TANGKAP DATA OTOMATIS DARI SISTEM ---
            'url'               => $request->url,
            'environment'       => $request->environment,
            'payload'           => $request->payload,
            'stack_trace'       => $request->stack_trace,
        ]);

        \App\Models\IssueActivity::create([
            'issue_id'    => $issue->id,
            'user_id'     => null, // Null karena ini dari sistem otomatis
            'action'      => 'created',
            'description' => 'System automatically created the issue and set status to open'
        ]);

        return response()->json([
            'message' => 'Bug report received successfully!',
            'issue' => $issue
        ], 201);
    }

    public function assign(Request $request, $id)
    {
        // 1. Validasi untuk memastikan user_id yang dikirim benar-benar ada di tabel users
        $request->validate([
            'user_id' => 'required|exists:users,id'
        ]);

        // 2. Cari issue berdasarkan issue_id (misal: BUG-XXXX)
        $issue = \App\Models\Issue::where('issue_id', $id)->firstOrFail();

        $assignedUser = \App\Models\User::find($request->user_id);
        
        $assignedUser->notify(new \App\Notifications\BugAssigned($issue));

        // 3. Update kolom user_id (dan ubah statusnya jadi 'in progress' kalau mau)
        $issue->update([
            'user_id' => $request->user_id,
            // UBAH BARIS INI: dari 'open' menjadi 'in-progress'
            'status'  => 'in-progress' 
        ]);
        

        \App\Models\IssueActivity::create([
            'issue_id'    => $issue->id,
            'user_id'     => auth()->id(), // Mengambil ID admin yang sedang meng-klik tombol
            'action'      => 'assigned',
            'description' => 'assigned issue to ' . $assignedUser->first_name . ' ' . $assignedUser->last_name
        ]);

        // 4. Kembalikan ke halaman yang sama
        return redirect()->back()->with('success', 'Issue berhasil di-assign!');
    }

    public function resolve($id)
    {
        // 1. Cari issue-nya
        $issue = \App\Models\Issue::where('issue_id', $id)->firstOrFail();

        // 2. Cegah jika statusnya memang sudah resolved
        if (strtolower($issue->status) === 'resolved') {
            return redirect()->back()->with('error', 'Issue sudah dalam status resolved!');
        }

        // 3. Update statusnya
        $issue->update([
            'status' => 'resolved'
        ]);

        // 4. CATAT KE BUKU SEJARAH (Activity Log)
        \App\Models\IssueActivity::create([
            'issue_id'    => $issue->id,
            'user_id'     => auth()->id(), // Mencatat admin/developer yang mengklik
            'action'      => 'resolved',
            'description' => 'marked issue as resolved'
        ]);

        return redirect()->back()->with('success', 'Issue berhasil diselesaikan!');
    }

    public function store(Request $request)
    {
        // 1. Validasi
        $request->validate([
            'title'             => 'required|string|max:255',
            'category'          => 'required|string',
            'severity'          => 'required|string',
            'description'       => 'required|string',
            'technical_details' => 'nullable|string',
            // --- VALIDASI TAMBAHAN ---
            'url'               => 'nullable|url',
            'environment'       => 'nullable|string',
            'payload'           => 'nullable|array', // Pastikan berupa array/JSON
            'stack_trace'       => 'nullable|string',
        ]);

        // 2. Simpan ke Database
        $issue = \App\Models\Issue::create([
            'issue_id'          => 'BUG-' . strtoupper(\Illuminate\Support\Str::random(5)),
            'title'             => $request->title,
            'category'          => $request->category,
            'severity'          => $request->severity,
            'description'       => $request->description,
            'technical_details' => $request->technical_details,
            'status'            => 'open',
            'user_id'           => null,
            // --- DATA TAMBAHAN ---
            'url'               => $request->url,
            'environment'       => $request->environment,
            'payload'           => $request->payload,
            'stack_trace'       => $request->stack_trace,
        ]);

        // ... (Kode Activity Log dan Redirect biarkan sama seperti sebelumnya) ...
        \App\Models\IssueActivity::create([
            'issue_id'    => $issue->id,
            'user_id'     => auth()->id() ?? null,
            'action'      => 'created',
            'description' => 'Reported a new bug'
        ]);

        return redirect()->route('dashboard')->with('success', 'Bug berhasil dilaporkan!');
    }
}
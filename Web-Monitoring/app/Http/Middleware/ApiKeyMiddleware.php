<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\ProjectApiKey; // WAJIB ADA: Agar satpam bisa ngecek ke database
use Symfony\Component\HttpFoundation\Response;

class ApiKeyMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // 1. Ambil kunci rahasia yang dikirim oleh Dummy Web dari header
        $apiKey = $request->header('X-API-KEY');

        // 2. Kalau gak ada kunci sama sekali -> Tolak
        if (!$apiKey) {
            return response()->json([
                'status' => 'error',
                'message' => 'Akses Ditolak! API Key tidak ditemukan di Header.'
            ], 401);
        }

        // 3. UPGRADE: Cek apakah kunci tersebut terdaftar di DATABASE kita
        $project = ProjectApiKey::where('api_key', $apiKey)->first();

        // 4. Kalau kuncinya gak ada di tabel (atau sudah kamu Revoke/Hapus) -> Tolak
        if (!$project) {
            return response()->json([
                'status' => 'error',
                'message' => 'Akses Ditolak! API Key tidak valid atau sudah dinonaktifkan.'
            ], 401);
        }

        // 5. BONUS: Titipkan nama project ke dalam request agar IssueController
        // tahu bug ini datangnya dari E-Sumpah, Web Dummy 2, atau yang lain.
        $request->merge(['source_project' => $project->project_name]);

        // 6. Kunci Valid! Silakan masuk ke IssueController!
        return $next($request);
    }
}
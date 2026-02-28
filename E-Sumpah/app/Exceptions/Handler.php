<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Facades\Http;
use Throwable;

// --- IMPORT KELAS ERROR UNTUK AUTO-CATEGORIZE ---
use Illuminate\Database\QueryException;
use PDOException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Client\ConnectionException;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            
            // Abaikan error 404 (Not Found) agar database BugHunter tidak penuh
            if ($e instanceof \Symfony\Component\HttpKernel\Exception\NotFoundHttpException) {
                return;
            }

            try {
                // 1. MESIN AUTO-CATEGORIZE 🤖
                $kategoriOtomatis = match(true) {
                    $e instanceof QueryException, 
                    $e instanceof PDOException => 'Database',

                    $e instanceof AuthenticationException, 
                    $e instanceof AuthorizationException => 'Security',

                    $e instanceof ConnectionException => 'Network',

                    str_contains(strtolower($e->getMessage()), 'memory size'),
                    str_contains(strtolower($e->getMessage()), 'timeout') => 'Performance',

                    // Jika error terjadi saat merender tampilan Blade
                    $e instanceof \Illuminate\View\ViewException => 'Frontend',

                    default => 'Backend',
                };

                // 2. MESIN AUTO-SEVERITY 🔥 (Tingkat keparahan dinamis)
                $tingkatKeparahan = match(true) {
                    $kategoriOtomatis === 'Security' => 'Critical',
                    $kategoriOtomatis === 'Database' => 'High',
                    $kategoriOtomatis === 'Performance' => 'High',
                    default => 'Medium', // Frontend & Backend biasa dianggap Medium
                };

                // 3. Sedot data dari error
                $judulError = $e->getMessage() ?: 'Fatal Error: Terjadi kesalahan sistem';
                
                // 4. Susun Deskripsi
                $deskripsi = "Error ditemukan pada file:\n" . $e->getFile() . "\nDi baris ke: " . $e->getLine();

                // 5. Tembak ke API BugHunter (Pintu VIP)
                $response = Http::withHeaders([
                    'Accept' => 'application/json',
                    
                    // MENGAMBIL KUNCI DARI .ENV SECARA AMAN!
                    'X-API-KEY' => env('BUGHUNTER_API_KEY', 'bh_live_fTxmzp6wps6S0c1FynFt9S0sizMvB4i6')
                    
                ])->post('http://project-magang.test/api/report-bug', [
                    // --- DATA STANDAR ---
                    'title'             => substr($judulError, 0, 200),
                    'description'       => $deskripsi,
                    'technical_details' => "Exception Class: " . get_class($e),
                    'severity'          => $tingkatKeparahan, 
                    'category'          => $kategoriOtomatis,
                    
                    // --- DATA "HACKER" (PAYLOAD & LINGKUNGAN USER) ---
                    'url'               => request()->fullUrl(), 
                    'environment'       => request()->header('User-Agent') ?? 'Unknown OS/Browser', 
                    'payload'           => request()->all(), 
                    'stack_trace'       => $e->getTraceAsString(), 
                ]);

                if ($response->failed()) {
                    logger('BugHunter Menolak Laporan! Alasan: ' . $response->body());
                }

            } catch (Throwable $apiError) {
                logger('Gagal mengirim log ke BugHunter: ' . $apiError->getMessage());
            }
        });
    }
}
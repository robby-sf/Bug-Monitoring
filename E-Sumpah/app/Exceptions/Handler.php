<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Facades\Http; // Tambahkan ini untuk kirim data via API
use Throwable;

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

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            // Logika untuk mengirim error ke Web Monitoring
            try {
                Http::post('http://localhost:8001/api/logs', [
                    'project_name' => 'e-Sumpah Dummy',
                    'message'      => $e->getMessage(),
                    'file'         => $e->getFile(),
                    'line'         => $e->getLine(),
                    'url'          => request()->fullUrl(),
                ]);
            } catch (Throwable $apiError) {
                // Jika web monitoring mati, jangan sampai bikin web dummy ini ikut mati total
                logger('Gagal mengirim log ke monitoring: ' . $apiError->getMessage());
            }
        });
    }
}
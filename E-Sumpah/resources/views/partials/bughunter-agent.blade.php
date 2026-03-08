<script>
    // URL API BugHunter
    const BUGHUNTER_API = 'http://127.0.0.1:8001/api/report-bug';
    
    // Ambil kunci langsung dari .env e-Sumpah biar dinamis!
    const API_KEY = '{{ env('BUGHUNTER_API_KEY', 'bh_live_eIBTXlwtIgWZXPdfUrG3AXJlWwpMf8Rf') }}';

    function kirimLaporanFrontend(judul, detail, kategori, severity) {
        fetch(BUGHUNTER_API, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-API-KEY': 'bh_live_eIBTXlwtIgWZXPdfUrG3AXJlWwpMf8Rf'
            },
            body: JSON.stringify({
                title: judul,
                description: detail,
                technical_details: 'Tertangkap otomatis oleh Frontend Agent (Browser User)',
                category: kategori,
                severity: severity,
                url: window.location.href, 
                environment: navigator.userAgent 
            })
        }).catch(err => console.log('Agen gagal melapor:', err));
    }

    // 1. NANGKAP ERROR JAVASCRIPT & TOMBOL RUSAK
    window.onerror = function(message, source, lineno, colno, error) {
        const detail = `File: ${source}\nBaris: ${lineno}:${colno}\nError: ${message}`;
        kirimLaporanFrontend('UI Crash: ' + message, detail, 'Frontend', 'High');
        return false; 
    };

    // 2. NANGKAP PROMISE YANG GAGAL (Contoh: fetch API gagal, gambar gagal load)
    window.addEventListener('unhandledrejection', function(event) {
        kirimLaporanFrontend('Silent Error di Background', event.reason, 'Frontend', 'Medium');
    });

    // 3. NANGKAP LOADING LAMA (Performance)
    window.addEventListener('load', function() {
        setTimeout(() => {
            let loadTime = window.performance.timing.domContentLoadedEventEnd - window.performance.timing.navigationStart;
            if (loadTime > 3000) { 
                kirimLaporanFrontend(
                    'Web e-Sumpah Lemot!', 
                    `Halaman ini butuh waktu ${loadTime / 1000} detik untuk loading.`, 
                    'Performance', 
                    'Low'
                );
            }
        }, 0);
    });
</script>
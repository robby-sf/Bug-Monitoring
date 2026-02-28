<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>e-Pelayanan</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        dark: '#2c313a', // Warna sidebar
                        primary: '#1d8cf8', // Warna biru tombol
                        active: '#2780e3', // Warna menu aktif
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gray-100 text-gray-800 antialiased">

    <div class="flex h-screen overflow-hidden">
        
        <aside class="w-64 bg-[#343a40] text-white shrink-0 flex flex-col transition-all duration-300">
            <div class="h-14 flex items-center px-4 bg-[#2c313a] border-b border-gray-600">
                <div class="flex items-center gap-2 font-bold text-lg">
                    <div class="w-8 h-8 bg-gray-400 rounded-full flex items-center justify-center text-xs text-black">A</div>
                    <span>e-Pelayanan</span>
                </div>
            </div>

            <nav class="flex-1 overflow-y-auto py-4">
                <ul class="space-y-1">
                    <li>
                        <a href="#" class="flex items-center gap-3 px-4 py-3 bg-[#007bff] text-white border-l-4 border-white shadow-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd" />
                            </svg>
                            <span class="text-sm font-medium">Pelayanan</span>
                        </a>
                    </li>

                    <li>
                        <a href="#" class="flex items-center justify-between px-4 py-3 text-gray-400 hover:text-white hover:bg-gray-700 transition">
                            <div class="flex items-center gap-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 border border-gray-400 rounded-sm p-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                </svg>
                                <span class="text-sm font-medium">Alat Bantu</span>
                            </div>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                            </svg>
                        </a>
                    </li>

                    <li>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                            @csrf
                        </form>
                        <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" 
                        class="flex items-center gap-3 px-4 py-3 text-gray-400 hover:text-white hover:bg-gray-700 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                            </svg>
                            <span class="text-sm font-medium">Keluar</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </aside>

        <div class="flex-1 flex flex-col h-screen overflow-hidden">
            
            <header class="h-14 bg-white shadow-sm flex items-center justify-between px-4 z-10">
                <div class="flex items-center gap-4">
                    <button class="text-gray-500 hover:text-gray-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                    <span class="text-gray-500 text-sm font-medium">
                        {{ Auth::check() ? Auth::user()->name : 'Guest' }}
                </div>

                <div class="flex items-center">
                    <button class="text-gray-500 hover:text-gray-700 relative">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z" />
                        </svg>
                        </button>
                </div>
            </header>

            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-[#f4f6f9] p-6 relative flex flex-col">
                
                <div class="flex-1">
                    @yield('content')
                </div>

                <footer class="mt-10 py-4 flex justify-between items-center text-xs text-gray-500 border-t border-gray-200">
                    <div>
                        <span class="font-bold">Hak Cipta © 2021 BAPENDA.</span> Kota Semarang.
                    </div>
                    <div>
                        e-Sumpah v 1.0.0
                    </div>
                </footer>
            </main>
        </div>
    </div>

    <script>
        // Script ini akan otomatis mendeteksi setiap ada error Javascript di halaman web ini
        window.addEventListener('error', function(event) {
            
            fetch("http://NAMADOMAIN-BUGHUNTER-KAMU.test/api/report-bug", { // <-- WAJIB: Ganti dengan URL domain Laragon BugHunter-mu
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "Accept": "application/json",
                    "X-API-KEY": "rahasia-12345" // <-- WAJIB: Sesuaikan dengan API Key yang kamu buat di DB BugHunter
                },
                body: JSON.stringify({
                    title: "Auto-Report: " + event.message,
                    description: `Error terjadi di file ${event.filename} pada baris ${event.lineno}. URL: ${window.location.href}`,
                    severity: "High",
                    category: "Frontend"
                })
            })
            .then(response => console.log("System: Bug berhasil dikirim ke BugHunter!"))
            .catch(error => console.error("System: Gagal lapor bug."));
        });
    </script>
</body>
</html>
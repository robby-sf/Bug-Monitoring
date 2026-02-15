<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - e-Pelayanan PBB</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-[#eaeff2] flex flex-col items-center justify-center min-h-screen text-gray-700">

    <div class="text-center mb-8">
        <h1 class="text-3xl text-gray-700 mb-1">Pelayanan PBB Online</h1>
        <p class="text-xl text-gray-600 font-light">(e-sumpah 2024)</p>
    </div>

    <div class="w-full max-w-sm">
        <div class="bg-white p-8 rounded shadow-sm border border-gray-100">
            <p class="text-center text-sm text-gray-500 mb-6">Silahkan Login terlebih dahulu</p>

            <form action="{{ route('login.store') }}" method="POST">
                @csrf
                <div class="relative mb-4">
                    <input type="text" name="nik" placeholder="N I K" required
                        class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition placeholder-gray-400 tracking-wider">
                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none text-gray-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="currentColor" viewBox="0 0 16 16">
                            <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4Zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2Zm13 2.383-4.708 2.825L15 11.105V5.383Zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741ZM1 11.105l4.708-2.897L1 5.383v5.722Z"/>
                        </svg>
                    </div>
                </div>

                <div class="relative mb-4">
                    <input type="password" name="password" placeholder="Password" required
                        class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition placeholder-gray-400">
                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none text-gray-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="currentColor" viewBox="0 0 16 16">
                            <path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2zm3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2z"/>
                        </svg>
                    </div>
                </div>

                <button type="submit" class="bg-[#007bff] hover:bg-blue-600 text-white text-sm py-2 px-6 rounded shadow-sm transition">
                    Login
                </button>
            </form>
        </div>

        <div class="mt-4 text-sm space-y-1">
            <a href="{{ route('register') }}" class="block text-gray-600 hover:text-gray-800">Daftar baru</a>
            <a href="#" class="block text-gray-600 hover:text-gray-800">Lupa password?</a>
        </div>
    </div>

</body>
</html>
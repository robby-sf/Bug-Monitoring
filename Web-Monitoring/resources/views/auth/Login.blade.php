<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - BugHunter Monitoring</title>
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-dark-bg text-gray-400 font-sans antialiased flex items-center justify-center min-h-screen p-6 selection:bg-blue-500/30">

    <div class="fixed top-0 left-0 w-full h-full overflow-hidden -z-10 pointer-events-none">
        <div class="absolute top-[-10%] left-[-10%] w-[40%] h-[40%] bg-blue-600/10 blur-[120px] rounded-full"></div>
        <div class="absolute bottom-[-10%] right-[-10%] w-[40%] h-[40%] bg-indigo-600/10 blur-[120px] rounded-full"></div>
    </div>

    <div class="w-full max-w-110 animate-in fade-in zoom-in duration-500">
        <div class="flex flex-col items-center mb-10">
            <div class="w-16 h-16 bg-blue-600 rounded-2xl flex items-center justify-center text-white shadow-[0_0_30px_rgba(37,99,235,0.3)] mb-4">
                <i class="fas fa-bug-slash text-3xl"></i>
            </div>
            <h1 class="text-white font-black text-3xl tracking-tighter">BugHunter</h1>
            <p class="text-gray-500 text-sm mt-1 font-medium tracking-wide uppercase">Workspace Authentication</p>
        </div>

        <div class="bg-dark-card/60 backdrop-blur-xl border border-white/5 rounded-[2.5rem] p-10 shadow-[0_20px_50px_rgba(0,0,0,0.4)]">
            
            @if($errors->any())
                <div class="mb-6 p-4 bg-red-500/10 border border-red-500/20 rounded-2xl animate-in slide-in-from-top-2">
                    <p class="text-[11px] text-red-500 font-bold uppercase tracking-tight flex items-center gap-2">
                        <i class="fas fa-triangle-exclamation"></i>
                        {{ $errors->first() }}
                    </p>
                </div>
            @endif

            @if(session('success'))
                <div class="mb-6 p-4 bg-green-500/10 border border-green-500/20 rounded-2xl">
                    <p class="text-[11px] text-green-500 font-bold uppercase tracking-tight flex items-center gap-2">
                        <i class="fas fa-circle-check"></i>
                        {{ session('success') }}
                    </p>
                </div>
            @endif

            <form action="{{ route('login') }}" method="POST" class="space-y-6">
                @csrf
                
                <div class="space-y-2">
                    <label class="block text-xs font-black text-gray-500 uppercase tracking-widest ml-1">Email Address</label>
                    <div class="relative group">
                        <i class="fas fa-envelope absolute left-4 top-1/2 -translate-y-1/2 text-gray-600 group-focus-within:text-blue-500 transition-colors"></i>
                        <input type="email" name="email" placeholder="name@company.com" required value="{{ old('email') }}"
                            class="w-full bg-dark-bg/50 border border-white/5 text-white pl-12 pr-4 py-4 rounded-2xl focus:outline-none focus:border-blue-500/50 focus:ring-4 focus:ring-blue-500/10 transition-all placeholder:text-gray-700">
                    </div>
                </div>

                <div class="space-y-2">
                    <div class="flex justify-between items-center ml-1">
                        <label class="block text-xs font-black text-gray-500 uppercase tracking-widest">Password</label>
                        <a href="#" class="text-[10px] text-blue-500 font-bold hover:underline uppercase tracking-tight">Forgot?</a>
                    </div>

                    <div class="space-y-2">
                        <div class="relative group">
                            <i class="fas fa-lock absolute left-4 top-1/2 -translate-y-1/2 text-gray-600 group-focus-within:text-blue-500 transition-colors"></i>
                            <input type="password" id="password" name="password" placeholder="••••••••" required
                                class="w-full bg-dark-bg/50 border border-white/5 text-white pl-12 pr-4 py-3.5 rounded-2xl focus:outline-none focus:border-blue-500/50 focus:ring-4 focus:ring-blue-500/10 transition-all placeholder:text-gray-700 text-sm">
                            <button type="button" onclick="togglePassword('password', 'eye-icon')" class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-600 hover:text-blue-500 focus:outline-none transition-colors">
                                <i id="eye-icon" class="fas fa-eye"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <label class="flex items-center gap-3 cursor-pointer group w-fit ml-1">
                    <div class="relative flex items-center">
                        <input type="checkbox" name="remember" class="peer h-5 w-5 cursor-pointer appearance-none rounded-md border border-white/10 bg-dark-bg transition-all checked:bg-blue-600" />
                        <i class="fas fa-check absolute scale-0 peer-checked:scale-100 text-[10px] text-white left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 transition-transform"></i>
                    </div>
                    <span class="text-xs text-gray-500 group-hover:text-gray-300 transition-colors">Remember this device</span>
                </label>

                <button type="submit" 
                    class="w-full py-4 bg-blue-600 hover:bg-blue-500 text-white font-bold rounded-2xl transition-all shadow-lg shadow-blue-900/30 active:scale-[0.98] flex items-center justify-center gap-3 group">
                    <span>Sign In to Workspace</span>
                    <i class="fas fa-arrow-right text-xs group-hover:translate-x-1 transition-transform"></i>
                </button>
            </form>

            <div class="mt-10 pt-8 border-t border-white/5 text-center">
                <p class="text-xs text-gray-600">Don't have an account? <a href="{{ route('register') }}" class="text-blue-500 font-bold hover:underline">Create Account</a></p>
            </div>
        </div>

        <p class="text-center text-[10px] text-gray-700 mt-8 uppercase tracking-[0.3em] font-bold">
            &copy; 2026 BugHunter Inc • All Rights Reserved
        </p>
    </div>

    <script>
        function togglePassword(inputId, iconId) {
            const passwordInput = document.getElementById(inputId);
            const eyeIcon = document.getElementById(iconId);

            if (passwordInput.type === "password") {
                // Ubah ke teks agar terlihat
                passwordInput.type = "text";
                // Ubah ikon menjadi mata tertutup
                eyeIcon.classList.remove("fa-eye");
                eyeIcon.classList.add("fa-eye-slash");
            } else {
                // Ubah kembali ke password
                passwordInput.type = "password";
                // Ubah ikon kembali ke mata terbuka
                eyeIcon.classList.remove("fa-eye-slash");
                eyeIcon.classList.add("fa-eye");
            }
        }
    </script>

</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account - BugHunter</title>
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-dark-bg text-gray-400 font-sans antialiased flex items-center justify-center min-h-screen p-6 selection:bg-blue-500/30">

    <div class="fixed top-0 left-0 w-full h-full overflow-hidden -z-10 pointer-events-none">
        <div class="absolute top-[-10%] right-[-10%] w-[40%] h-[40%] bg-blue-600/10 blur-[120px] rounded-full"></div>
        <div class="absolute bottom-[-10%] left-[-10%] w-[40%] h-[40%] bg-indigo-600/10 blur-[120px] rounded-full"></div>
    </div>

    <div class="w-full max-w-125 animate-in fade-in slide-in-from-bottom-4 duration-500">
        <div class="text-center mb-8">
            <h1 class="text-white font-black text-4xl tracking-tighter">Join the Hunt.</h1>
            <p class="text-gray-500 text-sm mt-2 font-medium">Create your admin account to start monitoring.</p>
        </div>

        <div class="bg-dark-card/60 backdrop-blur-xl border border-white/5 rounded-[2.5rem] p-10 shadow-[0_20px_50px_rgba(0,0,0,0.4)]">
            <form action="/register" method="POST" class="space-y-5">
                @csrf
                
                <div class="grid grid-cols-2 gap-4">
                    <div class="space-y-2">
                        <label class="block text-[10px] font-black text-gray-500 uppercase tracking-widest ml-1">First Name</label>
                        <input type="text" name="first_name" placeholder="Brian" required
                            class="w-full bg-dark-bg/50 border border-white/5 text-white px-4 py-3.5 rounded-2xl focus:outline-none focus:border-blue-500/50 focus:ring-4 focus:ring-blue-500/10 transition-all placeholder:text-gray-700 text-sm">
                    </div>
                    <div class="space-y-2">
                        <label class="block text-[10px] font-black text-gray-500 uppercase tracking-widest ml-1">Last Name</label>
                        <input type="text" placeholder="Kobe" name="last_name" required
                            class="w-full bg-dark-bg/50 border border-white/5 text-white px-4 py-3.5 rounded-2xl focus:outline-none focus:border-blue-500/50 focus:ring-4 focus:ring-blue-500/10 transition-all placeholder:text-gray-700 text-sm">
                    </div>
                </div>

                <div class="space-y-2">
                    <label class="block text-[10px] font-black text-gray-500 uppercase tracking-widest ml-1">Work Email</label>
                    <div class="relative group">
                        <i class="fas fa-envelope absolute left-4 top-1/2 -translate-y-1/2 text-gray-600 group-focus-within:text-blue-500 transition-colors"></i>
                        <input type="email" name="email" placeholder="robby@company.com" required
                            class="w-full bg-dark-bg/50 border border-white/5 text-white pl-12 pr-4 py-3.5 rounded-2xl focus:outline-none focus:border-blue-500/50 focus:ring-4 focus:ring-blue-500/10 transition-all placeholder:text-gray-700 text-sm">
                    </div>
                </div>

                <div class="space-y-2">
                    <label class="block text-[10px] font-black text-gray-500 uppercase tracking-widest ml-1">Password</label>
                    <div class="relative group">
                        <i class="fas fa-lock absolute left-4 top-1/2 -translate-y-1/2 text-gray-600 group-focus-within:text-blue-500 transition-colors"></i>
                        <input type="password" id="password" name="password" placeholder="Min. 8 characters" required
                            class="w-full bg-dark-bg/50 border border-white/5 text-white pl-12 pr-4 py-3.5 rounded-2xl focus:outline-none focus:border-blue-500/50 focus:ring-4 focus:ring-blue-500/10 transition-all placeholder:text-gray-700 text-sm">
                        <button type="button" onclick="togglePassword('password', 'eye-icon')" class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-600 hover:text-blue-500 focus:outline-none transition-colors">
                            <i id="eye-icon" class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>

                <div class="space-y-2">
                    <label class="block text-[10px] font-black text-gray-500 uppercase tracking-widest ml-1">Confirm Password</label>
                    <div class="relative group">
                        <i class="fas fa-lock absolute left-4 top-1/2 -translate-y-1/2 text-gray-600 group-focus-within:text-blue-500 transition-colors"></i>
                        <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Min. 8 characters" required
                            class="w-full bg-dark-bg/50 border border-white/5 text-white pl-12 pr-4 py-3.5 rounded-2xl focus:outline-none focus:border-blue-500/50 focus:ring-4 focus:ring-blue-500/10 transition-all placeholder:text-gray-700 text-sm">
                        <button type="button" onclick="togglePassword('password_confirmation', 'eye-icon-confirmation')" class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-600 hover:text-blue-500 focus:outline-none transition-colors">
                            <i id="eye-icon-confirmation" class="fas fa-eye"></i>
                        </button>
                    </div>
                    @error('password')
                        <span class="text-[16px] text-red-500 ml-1 mt-1">{{ $message }}</span>
                    @enderror
                </div>

<div class="space-y-2">
    <label class="block text-[10px] font-black text-gray-500 uppercase tracking-widest ml-1">Phone Number</label>
    <div class="relative flex items-center group">
        <i class="fas fa-phone absolute left-4 text-gray-600 group-focus-within:text-blue-500 transition-colors z-10"></i>
        
        <span class="absolute left-11 text-sm font-bold text-gray-500 border-r border-white/10 pr-3">
            +62
        </span>

        <input type="tel" 
               name="phone_number" 
               id="phone_number"
               placeholder="8123456789" 
               pattern="[0-9]{9,13}"
               required
               class="w-full bg-dark-bg/50 border border-white/5 text-white pl-24 pr-4 py-3.5 rounded-2xl focus:outline-none focus:border-blue-500/50 focus:ring-4 focus:ring-blue-500/10 transition-all placeholder:text-gray-700 text-sm">
    </div>
    <p class="text-[9px] text-gray-600 ml-1 italic">*Masukkan nomor tanpa angka 0 di depan</p>
</div>

                <div class="p-4 bg-blue-600/5 rounded-2xl border border-blue-500/10">
                    <label class="flex items-start gap-3 cursor-pointer group">
                        <div class="relative flex items-center mt-1">
                            <input type="checkbox" required class="peer h-4 w-4 cursor-pointer appearance-none rounded-md border border-white/10 bg-dark-bg transition-all checked:bg-blue-600" />
                            <i class="fas fa-check absolute scale-0 peer-checked:scale-100 text-[8px] text-white left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 transition-transform"></i>
                        </div>
                        <span class="text-[11px] text-gray-500 leading-relaxed">
                            I agree to the <a href="#" class="text-blue-500 hover:underline">Terms of Service</a> and confirm that I am authorized to monitor these projects.
                        </span>
                    </label>
                </div>

                <button type="submit" 
                    class="w-full py-4 bg-blue-600 hover:bg-blue-500 text-white font-bold rounded-2xl transition-all shadow-lg shadow-blue-900/30 active:scale-[0.98] flex items-center justify-center gap-3 mt-4 group">
                    <span>Create Admin Account</span>
                    <i class="fas fa-chevron-right text-[10px] group-hover:translate-x-1 transition-transform"></i>
                </button>
            </form>

            <div class="mt-8 pt-6 border-t border-white/5 text-center">
                <p class="text-xs text-gray-600">Already have a workspace? <a href="/login" class="text-blue-500 font-bold hover:underline">Log In</a></p>
            </div>
        </div>
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
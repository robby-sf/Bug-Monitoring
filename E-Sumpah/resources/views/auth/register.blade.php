<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - e-Pelayanan PBB</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        /* Transisi halus untuk perubahan warna teks validasi */
        .validation-item { transition: all 0.2s ease-in-out; }
    </style>
</head>
<body class="bg-[#eaeff2] flex flex-col items-center justify-center min-h-screen text-gray-700 py-10">

    <div class="text-center mb-8">
        <h1 class="text-3xl text-gray-700 mb-1">Pelayanan PBB Online</h1>
        <p class="text-xl text-gray-600 font-light">(e-sumpah 2024)</p>
    </div>

    <div class="w-full max-w-sm">
        <div class="bg-white p-6 rounded shadow-sm border border-gray-100">
            <p class="text-center text-sm text-gray-500 mb-6">Daftar Pemakai baru</p>

            <form action="{{ route('register.store') }}" method="POST" class="space-y-3">
                @csrf <div class="relative">
                    <input type="text" name="nik" placeholder="N I K" required
                        class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:border-blue-500 transition placeholder-gray-400">
                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none text-gray-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="currentColor" viewBox="0 0 16 16">
                            <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3Zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z"/>
                        </svg>
                    </div>
                </div>

                <div class="relative">
                    <input type="text" name="name" placeholder="Nama Wajib Pajak" required
                        class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:border-blue-500 transition placeholder-gray-400">
                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none text-gray-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="currentColor" viewBox="0 0 16 16">
                            <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3Zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z"/>
                        </svg>
                    </div>
                </div>

                <div class="relative">
                    <input type="text" name="phone" placeholder="No HP / No WA" required
                        class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:border-blue-500 transition placeholder-gray-400">
                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none text-gray-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="currentColor" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M1.885.511a1.745 1.745 0 0 1 2.61.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511Z"/>
                        </svg>
                    </div>
                </div>

                <div class="relative">
                    <input type="password" name="password" id="password" placeholder="Password" required
                        class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:border-blue-500 transition placeholder-gray-400">
                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none text-gray-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="currentColor" viewBox="0 0 16 16">
                            <path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2zm3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2z"/>
                        </svg>
                    </div>
                </div>

                <div class="relative">
                    <input type="password" name="password_confirmation" id="confirm_password" placeholder="Ulangi Password" required
                        class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:border-blue-500 transition placeholder-gray-400">
                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none text-gray-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="currentColor" viewBox="0 0 16 16">
                            <path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2zm3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2z"/>
                        </svg>
                    </div>
                </div>

                <div class="text-[11px] space-y-0.5 pt-1 font-medium">
                    <p id="rule-length" class="text-red-500 validation-item">X Minimum 8 huruf</p>
                    <p id="rule-lower" class="text-red-500 validation-item">X Minimun 1 huruf kecil</p>
                    <p id="rule-upper" class="text-red-500 validation-item">X Minimun 1 huruf besar</p>
                    <p id="rule-number" class="text-red-500 validation-item">X Minimun 1 huruf angka</p>
                    <p id="rule-special" class="text-red-500 validation-item">X Minimun 1 huruf spesial karakter</p>
                    <p id="rule-match" class="text-red-500 validation-item hidden">X Password harus sama</p>
                </div>

                <div class="flex items-center justify-between mt-4 pt-2">
                    <label class="flex items-center space-x-2 cursor-pointer">
                        <input type="checkbox" required class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                        <span class="text-sm text-gray-700 font-bold">Saya setuju</span>
                    </label>

                    <button type="submit" id="btn-daftar" class="bg-[#5ea4f3] hover:bg-blue-600 text-white text-sm py-2 px-6 rounded shadow-sm transition disabled:opacity-50 disabled:cursor-not-allowed">
                        Daftar
                    </button>
                </div>

            </form>
        </div>

        <div class="mt-4 text-sm text-center">
            <a href="{{ route('login') }}" class="text-gray-600 hover:text-gray-800">Log in</a>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // 1. Ambil Elemen Input
            const passwordInput = document.getElementById('password');
            const confirmInput = document.getElementById('confirm_password');
            const btnDaftar = document.getElementById('btn-daftar');

            // 2. Ambil Elemen Pesan Validasi
            const rules = {
                length: document.getElementById('rule-length'),
                lower: document.getElementById('rule-lower'),
                upper: document.getElementById('rule-upper'),
                number: document.getElementById('rule-number'),
                special: document.getElementById('rule-special'),
                match: document.getElementById('rule-match')
            };

            // 3. Fungsi Update Tampilan (Merah X -> Hijau Ceklis)
            function updateRuleStatus(element, isValid, text) {
                if (isValid) {
                    element.classList.remove('text-red-500');
                    element.classList.add('text-green-600');
                    element.innerHTML = `✓ ${text}`;
                } else {
                    element.classList.remove('text-green-600');
                    element.classList.add('text-red-500');
                    element.innerHTML = `X ${text}`;
                }
                return isValid;
            }

            // 4. Fungsi Utama Pengecekan
            function validatePassword() {
                const val = passwordInput.value;
                const confirmVal = confirmInput.value;

                // Cek masing-masing aturan regex
                const isLength = updateRuleStatus(rules.length, val.length >= 8, "Minimum 8 huruf");
                const isLower = updateRuleStatus(rules.lower, /[a-z]/.test(val), "Minimum 1 huruf kecil");
                const isUpper = updateRuleStatus(rules.upper, /[A-Z]/.test(val), "Minimum 1 huruf besar");
                const isNumber = updateRuleStatus(rules.number, /[0-9]/.test(val), "Minimum 1 huruf angka");
                const isSpecial = updateRuleStatus(rules.special, /[^A-Za-z0-9]/.test(val), "Minimum 1 huruf spesial karakter");

                // Cek Konfirmasi Password
                let isMatch = false;
                if (confirmVal.length > 0) {
                    rules.match.classList.remove('hidden');
                    isMatch = updateRuleStatus(rules.match, val === confirmVal, "Password sama");
                } else {
                    rules.match.classList.add('hidden');
                }

                // Aktifkan/Nonaktifkan tombol Daftar
                const allValid = isLength && isLower && isUpper && isNumber && isSpecial && isMatch;
                btnDaftar.disabled = !allValid;
            }

            // 5. Pasang Event Listener (Real-time saat mengetik)
            passwordInput.addEventListener('input', validatePassword);
            confirmInput.addEventListener('input', validatePassword);
        });
    </script>

</body>
</html>
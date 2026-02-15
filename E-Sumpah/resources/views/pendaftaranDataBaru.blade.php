@extends('layouts.app')

@section('content')
<div class="bg-white border border-gray-200 rounded shadow-sm min-h-[600px] relative pb-24 transition-all duration-500">
    
    <div class="flex justify-between items-center px-4 py-3 bg-[#6c757d] text-white rounded-t">
        <h2 class="font-medium text-sm">Pendaftaran Data Baru</h2>
        <a href="{{ url('/dashboard') }}" class="bg-[#007bff] hover:bg-blue-600 text-white w-8 h-8 rounded flex items-center justify-center shadow-sm transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
        </a>
    </div>

    <div class="flex flex-col md:flex-row w-full overflow-hidden bg-gray-200 border-b border-gray-300">
        @foreach ([
            1 => 'Persiapan', 
            2 => 'Identitas Wajib Pajak PBB', 
            3 => 'Letak Objek Pajak PBB',
            4 => 'Informasi Bangunan PBB',
            5 => 'Pernyataan'
        ] as $index => $label)
            <div id="step-header-{{ $index }}" 
                 class="relative flex-1 p-4 border-r border-white transition-all duration-300 {{ $index == 1 ? 'bg-[#17a2b8] text-white' : 'bg-[#e9ecef] text-gray-400' }}">
                
                <div class="flex items-center gap-3 {{ $index > 1 ? 'md:pl-4' : '' }}">
                    <span id="step-num-{{ $index }}" 
                          class="text-5xl font-bold leading-none {{ $index == 1 ? 'opacity-80' : 'text-gray-300' }}">
                        {{ $index }}
                    </span>
                    <span class="text-xs font-semibold uppercase leading-tight">{{ $label }}</span>
                </div>
                
                <div id="step-arrow-{{ $index }}" 
                     class="absolute -bottom-2 left-10 w-4 h-4 bg-[#17a2b8] rotate-45 z-10 hidden md:block {{ $index == 1 ? '' : 'hidden' }}"></div>
            </div>
        @endforeach
    </div>

    <form action="{{ route('pendaftaran.store') }}" method="POST" enctype="multipart/form-data" class="p-6">
        @csrf

        <div id="step-content-1" class="space-y-4">
            <h3 class="text-lg font-bold text-gray-800">Persiapan</h3>
            <div class="bg-[#17a2b8] text-white text-sm py-2 px-4 rounded-sm text-center font-medium shadow-sm">
                Yang harus disiapkan sebelum melanjutkan proses
            </div>
            <div class="px-4">
                <ol class="list-decimal space-y-2 text-sm text-gray-700 pl-5 marker:font-bold">
                    <li><span class="pl-2">Foto KTP</span></li>
                    <li><span class="pl-2">Foto SPPT PBB tetangga terdekat</span></li>
                    <li><span class="pl-2">Foto seluruh halaman sertifikat / Surat Tanah Lainnya</span></li>
                    <li><span class="pl-2">Foto IMB / Surat Pernyataan Luas Bangunan Bermaterai</span></li>
                    <li><span class="pl-2">Foto tanah / bangunan</span></li>
                    <li><span class="pl-2">Pernyataan kebenaran data</span></li>
                </ol>
            </div>
        </div>

        <div id="step-content-2" class="hidden">
            <h3 class="text-lg font-bold text-gray-800 mb-6">Identitas Wajib Pajak PBB</h3>
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-x-12 gap-y-4">
                <div class="space-y-4">
                    <div class="flex flex-col sm:flex-row sm:items-center">
                        <label class="w-full sm:w-1/3 text-xs font-bold text-gray-800 mb-1 sm:mb-0">No KTP</label>
                        <input type="text" name="nik" placeholder="Masukan NIK" class="w-full sm:w-2/3 border border-gray-300 rounded px-3 py-2 text-xs focus:ring-1 focus:ring-blue-500 outline-none">
                    </div>
                    <div class="flex flex-col sm:flex-row sm:items-center">
                        <label class="w-full sm:w-1/3 text-xs font-bold text-gray-800 mb-1 sm:mb-0">Pekerjaan</label>
                        <select name="pekerjaan" class="w-full sm:w-2/3 border border-gray-300 rounded px-3 py-2 text-xs outline-none bg-white">
                            <option value="">Pilih Pekerjaan</option>
                            <option value="pns">PNS</option>
                            <option value="swasta">Swasta</option>
                            <option value="wiraswasta">Wiraswasta</option>
                        </select>
                    </div>
                    <div class="flex flex-col sm:flex-row sm:items-center">
                        <label class="w-full sm:w-1/3 text-xs font-bold text-gray-800 mb-1 sm:mb-0">NPWP</label>
                        <input type="text" name="npwp" placeholder="Masukan NPWP" class="w-full sm:w-2/3 border border-gray-300 rounded px-3 py-2 text-xs focus:ring-1 focus:ring-blue-500 outline-none">
                    </div>
                    <div class="flex flex-col sm:flex-row sm:items-center">
                        <label class="w-full sm:w-1/3 text-xs font-bold text-gray-800 mb-1 sm:mb-0">Jalan WP</label>
                        <input type="text" name="jalan_wp" placeholder="Nama Jalan" class="w-full sm:w-2/3 border border-gray-300 rounded px-3 py-2 text-xs focus:ring-1 focus:ring-blue-500 outline-none">
                    </div>
                    <div class="flex flex-col sm:flex-row sm:items-center">
                        <label class="w-full sm:w-1/3 text-xs font-bold text-gray-800 mb-1 sm:mb-0">RT / RW WP</label>
                        <div class="w-full sm:w-2/3 flex gap-2">
                            <input type="text" name="rt_wp" placeholder="RT" class="w-1/2 border border-gray-300 rounded px-3 py-2 text-xs outline-none">
                            <input type="text" name="rw_wp" placeholder="RW" class="w-1/2 border border-gray-300 rounded px-3 py-2 text-xs outline-none">
                        </div>
                    </div>
                    <div class="flex flex-col sm:flex-row sm:items-center">
                        <label class="w-full sm:w-1/3 text-xs font-bold text-gray-800 mb-1 sm:mb-0">Kota</label>
                        <input type="text" name="kota" placeholder="Kota / Kabupaten" class="w-full sm:w-2/3 border border-gray-300 rounded px-3 py-2 text-xs focus:ring-1 focus:ring-blue-500 outline-none">
                    </div>
                    <div class="flex flex-col sm:flex-row items-start">
                        <label class="w-full sm:w-1/3 text-xs font-bold text-gray-800 mt-2">Unggah Foto KTP</label>
                        <div class="w-full sm:w-2/3">
                            <label class="flex flex-col justify-center items-center w-full h-32 bg-gray-50 rounded-lg border-2 border-dashed border-gray-300 cursor-pointer hover:bg-gray-100 transition">
                                <div class="text-center px-4">
                                    <p class="mb-1 text-xs text-gray-500 font-medium">Tarik kesini atau klik</p>
                                    <p class="text-[10px] text-gray-400">ukuran max 2 MB (png, jpg)</p>
                                </div>
                                <input type="file" name="file_foto_ktp" class="hidden" accept="image/*" />
                            </label>
                        </div>
                    </div>
                </div>

                <div class="space-y-4">
                    <div class="flex flex-col sm:flex-row sm:items-center">
                        <label class="w-full sm:w-1/3 text-xs font-bold text-gray-800 mb-1 sm:mb-0">Status WP</label>
                        <select name="status_wp" class="w-full sm:w-2/3 border border-gray-300 rounded px-3 py-2 text-xs outline-none bg-white">
                            <option value="">Pilih Status</option>
                            <option value="pemilik">Pemilik</option>
                            <option value="penyewa">Penyewa</option>
                        </select>
                    </div>
                    <div class="flex flex-col sm:flex-row sm:items-center">
                        <label class="w-full sm:w-1/3 text-xs font-bold text-gray-800 mb-1 sm:mb-0">Nama</label>
                        <input type="text" name="nama" placeholder="Nama Lengkap" class="w-full sm:w-2/3 border border-gray-300 rounded px-3 py-2 text-xs outline-none">
                    </div>
                    <div class="flex flex-col sm:flex-row sm:items-center">
                        <label class="w-full sm:w-1/3 text-xs font-bold text-gray-800 mb-1 sm:mb-0">No. Telp</label>
                        <input type="text" name="no_telp" placeholder="08xxxxxxxxxx" class="w-full sm:w-2/3 border border-gray-300 rounded px-3 py-2 text-xs outline-none">
                    </div>
                    <div class="flex flex-col sm:flex-row sm:items-center">
                        <label class="w-full sm:w-1/3 text-xs font-bold text-gray-800 mb-1 sm:mb-0">Blok / Kav / No</label>
                        <input type="text" name="blok" placeholder="Blok/Kav" class="w-full sm:w-2/3 border border-gray-300 rounded px-3 py-2 text-xs outline-none">
                    </div>
                    <div class="flex flex-col sm:flex-row sm:items-center">
                        <label class="w-full sm:w-1/3 text-xs font-bold text-gray-800 mb-1 sm:mb-0">Kelurahan</label>
                        <input type="text" name="kelurahan" placeholder="Kelurahan" class="w-full sm:w-2/3 border border-gray-300 rounded px-3 py-2 text-xs outline-none">
                    </div>
                    <div class="flex flex-col sm:flex-row sm:items-center">
                        <label class="w-full sm:w-1/3 text-xs font-bold text-gray-800 mb-1 sm:mb-0">Kode Pos</label>
                        <input type="text" name="kode_pos" placeholder="Kode Pos" class="w-full sm:w-2/3 border border-gray-300 rounded px-3 py-2 text-xs outline-none">
                    </div>
                </div>
            </div>
        </div>

        <div id="step-content-3" class="hidden">
            <h3 class="text-lg font-bold text-gray-800 mb-6">Letak Objek Pajak PBB</h3>
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-x-12 gap-y-4">
                <div class="flex flex-col sm:flex-row sm:items-center">
                    <label class="w-full sm:w-1/3 text-xs font-bold text-gray-800 mb-1 sm:mb-0">NOP PBB Tetangga</label>
                    <input type="text" name="nop_pbb_tetangga" placeholder="NOP PBB Tetangga" class="w-full sm:w-2/3 border border-gray-300 rounded px-3 py-2 text-xs outline-none">
                </div>
                <div class="hidden lg:block"></div>
                
                <div class="flex flex-col sm:flex-row sm:items-center">
                    <label class="w-full sm:w-1/3 text-xs font-bold text-gray-800 mb-1 sm:mb-0">Kecamatan OP</label>
                    <input type="text" name="kecamatan_op" placeholder="Kecamatan Objek Pajak" class="w-full sm:w-2/3 border border-gray-300 rounded px-3 py-2 text-xs outline-none">
                </div>
                <div class="flex flex-col sm:flex-row sm:items-center">
                    <label class="w-full sm:w-1/3 text-xs font-bold text-gray-800 mb-1 sm:mb-0">Kelurahan OP</label>
                    <input type="text" name="kelurahan_op" placeholder="Kelurahan Objek Pajak" class="w-full sm:w-2/3 border border-gray-300 rounded px-3 py-2 text-xs outline-none">
                </div>
                
                <div class="flex flex-col sm:flex-row sm:items-center">
                    <label class="w-full sm:w-1/3 text-xs font-bold text-gray-800 mb-1 sm:mb-0">Status Tanah</label>
                    <select name="status_tanah" id="status_tanah" class="w-full sm:w-2/3 border border-gray-300 rounded px-3 py-2 text-xs outline-none bg-white border-blue-400 font-bold text-blue-700">
                        <option value="TANAH + BANGUNAN">TANAH + BANGUNAN</option>
                        <option value="TANAH KOSONG">TANAH KOSONG</option>
                    </select>
                </div>
                <div class="lg:col-span-2 space-y-4 pt-4">
                    <div class="flex flex-col sm:flex-row items-start">
                        <label class="w-full sm:w-[16.6%] text-xs font-bold text-gray-800">Unggah SPPT Tetangga</label>
                        <div class="w-full sm:w-2/3">
                            <label class="flex flex-col justify-center items-center w-full h-32 bg-gray-50 rounded-lg border-2 border-dashed border-gray-300 cursor-pointer hover:bg-gray-100 transition">
                                <div class="text-center px-4">
                                    <p class="mb-1 text-xs text-gray-500 font-medium">Tarik kesini atau klik</p>
                                    <p class="text-[10px] text-gray-400">ukuran max 2 MB (png, jpg)</p>
                                </div>
                                <input type="file" name="file_foto_sppt_tetangga" class="hidden" accept="image/*" />
                            </label>
                        </div>
                    </div>
                    <div class="flex flex-col sm:flex-row items-start">
                        <label class="w-full sm:w-[16.6%] text-xs font-bold text-gray-800">Unggah Sertifikat</label>
                        <div class="w-full sm:w-2/3">
                            <label class="flex flex-col justify-center items-center w-full h-32 bg-gray-50 rounded-lg border-2 border-dashed border-gray-300 cursor-pointer hover:bg-gray-100 transition">
                                <div class="text-center px-4">
                                    <p class="mb-1 text-xs text-gray-500 font-medium">Tarik kesini atau klik</p>
                                    <p class="text-[10px] text-gray-400">ukuran max 2 MB (png, jpg)</p>
                                </div>
                                <input type="file" name="file_foto_sertifikat" class="hidden" accept="image/*" />
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="step-content-4" class="hidden transition-opacity duration-300">
            <h3 id="step-4-title" class="text-lg font-bold text-gray-800 mb-6">Informasi Bangunan PBB</h3>

            <div id="form-tipe-bangunan" class="grid grid-cols-1 lg:grid-cols-2 gap-x-12 gap-y-4">
                <div class="space-y-4">
                    <div class="flex flex-col sm:flex-row sm:items-center">
                        <label class="w-full sm:w-1/3 text-xs font-bold text-gray-800 mb-1 sm:mb-0">No. Bangunan</label>
                        <input type="number" name="no_bangunan" value="1" class="w-full sm:w-2/3 border border-gray-300 rounded px-3 py-2 text-xs outline-none">
                    </div>
                    <div class="flex flex-col sm:flex-row sm:items-center">
                        <label class="w-full sm:w-1/3 text-xs font-bold text-gray-800 mb-1 sm:mb-0">Luas & Jml Lantai</label>
                        <div class="w-full sm:w-2/3 flex gap-2">
                            <input type="number" name="luas_bangunan" placeholder="Luas" class="w-2/3 border border-gray-300 rounded px-3 py-2 text-xs">
                            <input type="number" name="jml_lantai" value="1" class="w-1/3 border border-gray-300 rounded px-3 py-2 text-xs">
                        </div>
                    </div>
                    <div class="flex flex-col sm:flex-row sm:items-center">
                        <label class="w-full sm:w-1/3 text-xs font-bold text-gray-800 mb-1 sm:mb-0">Tahun Dibangun</label>
                        <input type="number" name="thn_bangun" placeholder="YYYY" class="w-full sm:w-2/3 border border-gray-300 rounded px-3 py-2 text-xs outline-none">
                    </div>
                    <div class="flex flex-col sm:flex-row items-start">
                        <label class="w-full sm:w-1/3 text-xs font-bold text-gray-800 mt-2">Foto Bangunan</label>
                        <div class="w-full sm:w-2/3">
                            <label class="flex flex-col justify-center items-center w-full h-32 bg-gray-50 rounded-lg border-2 border-dashed border-gray-300 cursor-pointer hover:bg-gray-100 transition">
                                <div class="text-center px-4">
                                    <p class="mb-1 text-xs text-gray-500 font-medium">Tarik kesini atau klik</p>
                                    <p class="text-[10px] text-gray-400">ukuran max 2 MB (png, jpg)</p>
                                </div>
                                <input type="file" name="file_foto_bangunan" class="hidden" accept="image/*" />
                            </label>
                        </div>
                    </div>
                </div>
                <div class="space-y-4">
                    <div class="flex flex-col sm:flex-row sm:items-center">
                        <label class="w-full sm:w-1/3 text-xs font-bold text-gray-800 mb-1 sm:mb-0">Konstruksi</label>
                        <select name="konstruksi" class="w-full sm:w-2/3 border border-gray-300 rounded px-3 py-2 text-xs outline-none bg-white">
                            <option value="beton">Beton</option>
                            <option value="baja">Baja</option>
                            <option value="kayu">Kayu</option>
                        </select>
                    </div>
                    <div class="flex flex-col sm:flex-row sm:items-center">
                        <label class="w-full sm:w-1/3 text-xs font-bold text-gray-800 mb-1 sm:mb-0">Atap</label>
                        <select name="atap" class="w-full sm:w-2/3 border border-gray-300 rounded px-3 py-2 text-xs outline-none bg-white">
                            <option value="genteng">Genteng</option>
                            <option value="asbes">Asbes</option>
                        </select>
                    </div>
                    <div class="flex flex-col sm:flex-row items-start">
                        <label class="w-full sm:w-1/3 text-xs font-bold text-gray-800 mt-2">Foto IMB</label>
                        <div class="w-full sm:w-2/3">
                            <label class="flex flex-col justify-center items-center w-full h-32 bg-gray-50 rounded-lg border-2 border-dashed border-gray-300 cursor-pointer hover:bg-gray-100 transition">
                                <div class="text-center px-4">
                                    <p class="mb-1 text-xs text-gray-500 font-medium">Tarik kesini atau klik</p>
                                    <p class="text-[10px] text-gray-400">ukuran max 2 MB (png, jpg)</p>
                                </div>
                                <input type="file" name="file_foto_imb" class="hidden" accept="image/*" />
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <div id="form-tipe-tanah-kosong" class="hidden space-y-6">
                <div class="bg-blue-50 border-l-4 border-blue-500 p-4">
                    <p class="text-xs text-blue-700">Anda memilih <strong>Tanah Kosong</strong>. Silakan unggah foto kondisi tanah terbaru untuk verifikasi.</p>
                </div>
                <div class="flex flex-col sm:flex-row items-center gap-4">
                    <label class="w-full sm:w-1/4 text-xs font-bold text-gray-800">Unggah Foto Tanah</label>
                        <div class="w-full sm:w-2/3">
                            <label class="flex flex-col justify-center items-center w-full h-32 bg-gray-50 rounded-lg border-2 border-dashed border-gray-300 cursor-pointer hover:bg-gray-100 transition">
                                <div class="text-center px-4">
                                    <p class="mb-1 text-xs text-gray-500 font-medium">Tarik kesini atau klik</p>
                                    <p class="text-[10px] text-gray-400">ukuran max 2 MB (png, jpg)</p>
                                </div>
                                <input type="file" name="file_foto_tanah_kosong" class="hidden" accept="image/*" />
                            </label>
                        </div>
                </div>
            </div>
        </div>

        <div id="step-content-5" class="hidden">
            <h3 class="text-lg font-bold text-gray-800 mb-6">Pernyataan Kebenaran Data</h3>
            <div class="bg-[#f8f9fa] border border-gray-200 rounded p-6">
                <h4 class="text-xs font-bold text-gray-500 uppercase mb-3">PERNYATAAN</h4>
                <p class="text-xs sm:text-sm text-gray-800 font-bold mb-1 uppercase">SAYA MENYATAKAN BAHWA DATA YANG SAYA ENTRI ADALAH BENAR</p>
                <p class="text-xs sm:text-sm text-gray-700 leading-relaxed mb-6 text-justify">
                    Apabila dikemudian hari ditemukan bahwa data/dokumen yang saya sampaikan tidak benar dan/atau ada pemalsuan, maka keputusan ini batal berdasarkan hukum dan saya bersedia dikenakan sanksi sesuai perundang-undangan yang berlaku.
                </p>
                <div class="space-y-3">
                    <div class="flex items-center">
                        <input id="setuju" name="pernyataan_kebenaran" type="radio" value="setuju" class="w-4 h-4 text-blue-600 border-gray-300 cursor-pointer" required>
                        <label for="setuju" class="ml-2 block text-sm text-gray-700 cursor-pointer">Setuju</label>
                    </div>
                    <div class="flex items-center">
                        <input id="tidak" name="pernyataan_kebenaran" type="radio" value="tidak" class="w-4 h-4 text-blue-600 border-gray-300 cursor-pointer">
                        <label for="tidak" class="ml-2 block text-sm text-gray-700 cursor-pointer">Tidak</label>
                    </div>
                </div>
            </div>
        </div>

        <div class="absolute bottom-0 left-0 w-full p-4 border-t border-gray-100 bg-white rounded-b flex justify-between items-center">
            <div>
                <button type="button" id="btn-prev" class="hidden bg-[#343a40] hover:bg-gray-700 text-white text-xs px-6 py-2 rounded shadow flex items-center gap-2 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" /></svg>
                    Kembali
                </button>
            </div>
            <div class="flex gap-2">
                <button type="button" id="btn-next" class="bg-[#343a40] hover:bg-gray-700 text-white text-xs px-6 py-2 rounded shadow flex items-center gap-2 transition">
                    Lanjut
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
                </button>
                <button type="submit" id="btn-submit" class="hidden bg-green-600 hover:bg-green-700 text-white text-xs px-6 py-2 rounded shadow flex items-center gap-2 transition">
                    Simpan Data
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                </button>
            </div>
        </div>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        let currentStep = 1;
        const totalSteps = 5;

        const btnPrev = document.getElementById('btn-prev');
        const btnNext = document.getElementById('btn-next');
        const btnSubmit = document.getElementById('btn-submit');
        const formBangunan = document.getElementById('form-tipe-bangunan');
        const formTanahKosong = document.getElementById('form-tipe-tanah-kosong');
        const titleStep4 = document.getElementById('step-4-title');
        const selectStatusTanah = document.getElementById('status_tanah');

        function updateUI() {
            // 1. Show/Hide Content & Stepper Header
            for (let i = 1; i <= totalSteps; i++) {
                const content = document.getElementById('step-content-' + i);
                const header = document.getElementById('step-header-' + i);
                const num = document.getElementById('step-num-' + i);
                const arrow = document.getElementById('step-arrow-' + i);

                if (content) content.classList.toggle('hidden', i !== currentStep);
                
                if (header && num && arrow) {
                    if (i === currentStep) {
                        header.className = "relative flex-1 p-4 border-r border-white transition-all duration-300 bg-[#17a2b8] text-white";
                        num.className = "text-5xl font-bold leading-none opacity-80";
                        arrow.classList.remove('hidden');
                    } else {
                        header.className = "relative flex-1 p-4 border-r border-white transition-all duration-300 bg-[#e9ecef] text-gray-400";
                        num.className = "text-5xl font-bold leading-none text-gray-300";
                        arrow.classList.add('hidden');
                    }
                }
            }

            // 2. Step 4 Dynamic Logic
            if (currentStep === 4) {
                const status = selectStatusTanah.value;
                if (status === 'TANAH KOSONG') {
                    formBangunan.classList.add('hidden');
                    formTanahKosong.classList.remove('hidden');
                    titleStep4.innerText = "Informasi Bangunan PBB (Tanah Kosong)";
                } else {
                    formBangunan.classList.remove('hidden');
                    formTanahKosong.classList.add('hidden');
                    titleStep4.innerText = "Informasi Bangunan PBB";
                }
            }

            // 3. Navigation Visibility
            btnPrev.classList.toggle('hidden', currentStep === 1);
            btnNext.classList.toggle('hidden', currentStep === totalSteps);
            btnSubmit.classList.toggle('hidden', currentStep !== totalSteps);
        }

        btnNext.addEventListener('click', () => {
            if (currentStep < totalSteps) {
                currentStep++;
                updateUI();
                window.scrollTo(0, 0); // Scroll ke atas otomatis
            }
        });

        btnPrev.addEventListener('click', () => {
            if (currentStep > 1) {
                currentStep--;
                updateUI();
                window.scrollTo(0, 0);
            }
        });

        updateUI();
    });
</script>
@endsection
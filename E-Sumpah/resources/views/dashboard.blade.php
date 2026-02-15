@extends('layouts.app')

@section('content')
<div class="bg-white border border-gray-200 rounded shadow-sm">
    
    <div class="flex justify-between items-center px-4 py-3 border-b border-gray-200 bg-gray-50">
        <h2 class="text-gray-700 font-medium text-sm">Detail Pengajuan Pelayanan</h2>
        
        <div class="relative">
            <button 
                id="btn-dropdown-trigger"
                class="bg-[#007bff] hover:bg-blue-600 text-white w-8 h-8 rounded flex items-center justify-center shadow-sm transition focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 pointer-events-none" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
            </button>

            <div 
                id="dropdown-menu"
                class="hidden absolute right-0 mt-2 w-64 bg-white rounded shadow-xl border border-gray-100 z-50 origin-top-right">
                
                <div class="py-1">
                    <a href="{{ url('/pendaftaran-data-baru') }}" class="block px-4 py-3 text-sm text-gray-700 hover:bg-gray-100 uppercase transition">
                        Pendaftaran Data Baru
                    </a>
                    <a href="#" class="block px-4 py-3 text-sm text-gray-700 hover:bg-gray-100 uppercase transition">
                        Mutasi Subjek Pajak
                    </a>
                    <a href="#" class="block px-4 py-3 text-sm text-gray-700 hover:bg-gray-100 uppercase transition">
                        Pembetulan SPPT/SKP/STP
                    </a>
                    <a href="#" class="block px-4 py-3 text-sm text-gray-700 hover:bg-gray-100 uppercase transition">
                        Salinan SPPT/SKP
                    </a>
                    <a href="#" class="block px-4 py-3 text-sm text-gray-700 hover:bg-gray-100 uppercase transition">
                        SK NJOP ( BPHTB )
                    </a>
                    <a href="#" class="block px-4 py-3 text-sm text-gray-700 hover:bg-gray-100 uppercase transition">
                        Pemecahan
                    </a>
                    <a href="#" class="block px-4 py-3 text-sm text-gray-700 hover:bg-gray-100 uppercase transition border-t border-gray-100">
                        Penggabungan
                    </a>
                </div>
            </div>
        </div>
        </div>

    <div class="p-4">
        
        <div class="flex justify-end mb-4">
            <div class="flex items-center gap-2">
                <label for="search" class="text-xs text-gray-600 font-medium">Cari Data</label>
                <input type="text" id="search" class="border border-gray-300 rounded px-2 py-1 text-sm focus:outline-none focus:ring-1 focus:ring-blue-500 w-48">
            </div>
        </div>

        <div class="overflow-x-auto border border-gray-200 rounded-sm mb-4">
            <table class="w-full text-left text-xs text-gray-700">
                <thead class="bg-white border-b border-gray-200 font-bold text-gray-800">
                    <tr>
                        <th class="px-3 py-2 border-r border-gray-200 relative group cursor-pointer hover:bg-gray-50">
                            No Pelayanan
                            <span class="absolute right-1 top-1/2 -translate-y-1/2 opacity-30 group-hover:opacity-100">↕</span>
                        </th>
                        <th class="px-3 py-2 border-r border-gray-200 relative group cursor-pointer hover:bg-gray-50">
                            Tanggal
                            <span class="absolute right-1 top-1/2 -translate-y-1/2 opacity-30 group-hover:opacity-100">↕</span>
                        </th>
                        <th class="px-3 py-2 border-r border-gray-200 relative group cursor-pointer hover:bg-gray-50">
                            NOP
                            <span class="absolute right-1 top-1/2 -translate-y-1/2 opacity-30 group-hover:opacity-100">↕</span>
                        </th>
                        <th class="px-3 py-2 border-r border-gray-200 relative group cursor-pointer hover:bg-gray-50">
                            Nama WP
                            <span class="absolute right-1 top-1/2 -translate-y-1/2 opacity-30 group-hover:opacity-100">↕</span>
                        </th>
                        <th class="px-3 py-2 border-r border-gray-200 relative group cursor-pointer hover:bg-gray-50">
                            Jns Pelayanan
                            <span class="absolute right-1 top-1/2 -translate-y-1/2 opacity-30 group-hover:opacity-100">↕</span>
                        </th>
                        <th class="px-3 py-2 border-r border-gray-200 relative group cursor-pointer hover:bg-gray-50">
                            Status Pendaftaran
                            <span class="absolute right-1 top-1/2 -translate-y-1/2 opacity-30 group-hover:opacity-100">↕</span>
                        </th>
                        <th class="px-3 py-2 relative group cursor-pointer hover:bg-gray-50">
                            Status Bapenda
                            <span class="absolute right-1 top-1/2 -translate-y-1/2 opacity-30 group-hover:opacity-100">↕</span>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pengajuans as $data)
                        <tr class="hover:bg-gray-50 border-b border-gray-100 transition duration-150">
                            <td class="px-3 py-2 border-r border-gray-200 font-medium text-blue-600">
                                {{ $data->no_pelayanan }}
                            </td>
                            <td class="px-3 py-2 border-r border-gray-200 text-gray-600">
                                {{ $data->created_at->format('d/m/Y') }}
                            </td>
                            <td class="px-3 py-2 border-r border-gray-200">
                                {{ $data->nop_tetangga ?? '-' }}
                            </td>
                            <td class="px-3 py-2 border-r border-gray-200 uppercase font-semibold">
                                {{ $data->nama_wp }}
                            </td>
                            <td class="px-3 py-2 border-r border-gray-200 text-[10px] font-bold text-gray-500">
                                PENDAFTARAN DATA BARU
                            </td>
                            <td class="px-3 py-2 border-r border-gray-200 text-center">
                                <span class="px-2 py-0.5 rounded bg-green-100 text-green-700 text-[9px] font-bold uppercase shadow-sm">
                                    SELESAI
                                </span>
                            </td>
                            <td class="px-3 py-2 text-center">
                                @if($data->status_verifikasi == 'menunggu')
                                    <span class="px-2 py-0.5 rounded bg-yellow-100 text-yellow-700 text-[9px] font-bold uppercase border border-yellow-200">
                                        MENUNGGU VERIFIKASI
                                    </span>
                                @elseif($data->status_verifikasi == 'disetujui')
                                    <span class="px-2 py-0.5 rounded bg-blue-100 text-blue-700 text-[9px] font-bold uppercase border border-blue-200">
                                        DISETUJUI
                                    </span>
                                @else
                                    <span class="px-2 py-0.5 rounded bg-red-100 text-red-700 text-[9px] font-bold uppercase border border-red-200">
                                        DITOLAK
                                    </span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-4 py-12 text-center text-gray-400 bg-white">
                                <div class="flex flex-col items-center justify-center space-y-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 opacity-20" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                    <p class="text-xs italic font-medium">Belum ada data pendaftaran objek pajak baru.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="flex justify-end gap-1 mb-6">
            <button class="px-3 py-1 text-xs border border-gray-300 rounded bg-white text-gray-400 cursor-not-allowed" disabled>Sebelum</button>
            <button class="px-3 py-1 text-xs border border-gray-300 rounded bg-white text-gray-400 cursor-not-allowed" disabled>Lanjut</button>
        </div>

        <div class="bg-[#f9f9f9] border border-gray-200 p-4 rounded-sm">
            <h3 class="text-sm font-medium text-gray-700 mb-2">Keterangan</h3>
            <div class="h-10"></div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const btn = document.getElementById('btn-dropdown-trigger');
        const menu = document.getElementById('dropdown-menu');

        if (btn && menu) {
            btn.addEventListener('click', function (e) {
                e.stopPropagation(); 
                menu.classList.toggle('hidden');
            });

            document.addEventListener('click', function (e) {
                if (!btn.contains(e.target) && !menu.contains(e.target)) {
                    menu.classList.add('hidden');
                }
            });
        }
    });
</script>
@endsection
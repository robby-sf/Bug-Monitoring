@extends('layout')

@section('content')
    <div class="mb-10 flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div class="flex items-center gap-5">
            <div class="w-16 h-16 bg-blue-600/10 rounded-2xl flex items-center justify-center text-3xl border border-blue-500/20 shadow-lg shadow-blue-500/10">
                🎨
            </div>
            <div>
                <div class="flex items-center gap-3">
                    <h2 class="text-3xl font-extrabold text-white tracking-tight">Frontend Project</h2>
                    <span class="px-3 py-1 bg-green-500/10 text-green-500 text-[10px] font-bold rounded-full border border-green-500/20 tracking-widest uppercase">Healthy</span>
                </div>
                <p class="text-gray-500 mt-1 font-medium italic text-sm">Git Branch: <span class="text-blue-400 font-mono">production-v2.1</span></p>
            </div>
        </div>
        <div class="flex gap-3">
            <button class="px-5 py-2.5 bg-dark-card border border-dark-border text-gray-400 hover:text-white rounded-xl transition flex items-center gap-2 text-sm font-bold shadow-sm">
                <i class="fas fa-sync-alt"></i> Force Sync
            </button>
            <button class="px-5 py-2.5 bg-blue-600 hover:bg-blue-500 text-white rounded-xl transition font-bold shadow-lg shadow-blue-900/20 active:scale-95 text-sm">
                Settings
            </button>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
        <div class="bg-dark-card border border-dark-border p-6 rounded-3xl group">
            <p class="text-gray-500 text-xs font-bold uppercase tracking-widest">Active Bugs</p>
            <div class="flex items-end gap-3 mt-2">
                <h3 class="text-4xl font-black text-white italic">24</h3>
                <span class="text-red-500 text-xs font-bold mb-1 group-hover:animate-pulse">+3 since yesterday</span>
            </div>
        </div>
        <div class="bg-dark-card border border-dark-border p-6 rounded-3xl group">
            <p class="text-gray-500 text-xs font-bold uppercase tracking-widest">Uptime Rate</p>
            <div class="flex items-end gap-3 mt-2">
                <h3 class="text-4xl font-black text-white italic">99.8%</h3>
                <span class="text-green-500 text-xs font-bold mb-1">Excellent</span>
            </div>
        </div>
        <div class="bg-dark-card border border-dark-border p-6 rounded-3xl group">
            <p class="text-gray-500 text-xs font-bold uppercase tracking-widest">Avg. Fix Time</p>
            <div class="flex items-end gap-3 mt-2">
                <h3 class="text-4xl font-black text-white italic">4.2h</h3>
                <span class="text-blue-500 text-xs font-bold mb-1">-20% improvement</span>
            </div>
        </div>
    </div>

    <div class="bg-dark-card border border-dark-border rounded-3xl overflow-hidden shadow-2xl">
        <div class="p-8 border-b border-dark-border bg-white/[0.01] flex justify-between items-center">
            <h4 class="text-white font-extrabold text-lg italic">Active Project Issues</h4>
            <div class="flex gap-2">
                <button class="w-8 h-8 rounded-lg bg-dark-bg border border-dark-border flex items-center justify-center text-gray-500 hover:text-white transition cursor-pointer">
                    <i class="fas fa-filter text-xs"></i>
                </button>
            </div>
        </div>
        
        <div class="divide-y divide-dark-border">
            <div class="p-6 flex items-center justify-between hover:bg-white/[0.02] transition group">
                <div class="flex items-center gap-6">
                    <div class="w-12 h-12 rounded-2xl bg-red-500/10 text-red-500 flex items-center justify-center border border-red-500/20 group-hover:scale-110 transition shadow-inner">
                        <i class="fas fa-bug"></i>
                    </div>
                    <div>
                        <div class="flex items-center gap-3">
                            <h5 class="text-white font-bold text-base">Login button unresponsive on iOS Safari</h5>
                            <span class="px-2 py-0.5 bg-red-600 text-white text-[9px] font-black rounded shadow-lg shadow-red-600/20 tracking-tighter uppercase italic">Critical</span>
                        </div>
                        <p class="text-xs text-gray-500 mt-1 italic leading-relaxed">Affecting user checkout on mobile devices. Reproducible in Safari 17.x</p>
                    </div>
                </div>
                <div class="flex items-center gap-8">
                    <div class="text-right hidden md:block">
                        <p class="text-[10px] text-gray-600 font-black uppercase tracking-widest mb-1">Assigned To</p>
                        <div class="flex items-center justify-end gap-2">
                            <span class="text-xs text-white font-bold">Sarah Chen</span>
                            <div class="w-6 h-6 rounded-full bg-blue-600 flex items-center justify-center text-[8px] font-bold text-white">SC</div>
                        </div>
                    </div>
                    <button class="p-3 bg-white/5 rounded-xl text-gray-400 hover:text-blue-500 transition border border-white/5">
                        <i class="fas fa-arrow-right"></i>
                    </button>
                </div>
            </div>

            </div>

        <div class="p-4 text-center bg-white/[0.01]">
            <a href="/issues" class="text-[10px] text-gray-600 hover:text-white font-black uppercase tracking-[0.2em] transition">View All Project Activity</a>
        </div>
    </div>
@endsection
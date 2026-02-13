@extends('layout')

@section('content')
    <div class="mb-8">
        <h2 class="text-3xl font-extrabold text-white tracking-tight">Dashboard</h2>
        <p class="text-gray-500 mt-1 font-medium">Welcome back! Here's your issue overview.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-dark-card border border-dark-border p-6 rounded-2xl shadow-sm">
            <div class="flex justify-between items-start mb-4">
                <div>
                    <p class="text-gray-400 text-sm font-medium">Total Issues</p>
                    <h3 class="text-3xl font-bold text-white mt-1">156</h3>
                </div>
                <div class="p-2 bg-gray-800 rounded-lg text-gray-400">
                    <i class="fas fa-bug"></i>
                </div>
            </div>
            <span class="text-xs font-bold text-red-500"><i class="fas fa-arrow-down mr-1"></i> 12% decrease</span>
        </div>

        <div class="bg-dark-card border border-dark-border p-6 rounded-2xl shadow-sm">
            <div class="flex justify-between items-start mb-4">
                <div>
                    <p class="text-gray-400 text-sm font-medium">Open Issues</p>
                    <h3 class="text-3xl font-bold text-white mt-1">32</h3>
                </div>
                <div class="p-2 bg-yellow-500/10 rounded-lg text-yellow-500">
                    <i class="fas fa-exclamation-triangle"></i>
                </div>
            </div>
            <span class="text-xs font-bold text-green-500"><i class="fas fa-arrow-up mr-1"></i> 5% increase</span>
        </div>

        <div class="bg-dark-card border border-dark-border p-6 rounded-2xl shadow-sm">
            <div class="flex justify-between items-start mb-4">
                <div>
                    <p class="text-gray-400 text-sm font-medium">Critical</p>
                    <h3 class="text-3xl font-bold text-white mt-1">5</h3>
                </div>
                <div class="p-2 bg-red-500/10 rounded-lg text-red-500">
                    <i class="fas fa-bolt"></i>
                </div>
            </div>
            <span class="text-xs font-bold text-red-500"><i class="fas fa-minus mr-1"></i> No change</span>
        </div>

        <div class="bg-dark-card border border-dark-border p-6 rounded-2xl shadow-sm">
            <div class="flex justify-between items-start mb-4">
                <div>
                    <p class="text-gray-400 text-sm font-medium">Resolved</p>
                    <h3 class="text-3xl font-bold text-white mt-1">8</h3>
                </div>
                <div class="p-2 bg-green-500/10 rounded-lg text-green-500">
                    <i class="fas fa-check-circle"></i>
                </div>
            </div>
            <span class="text-xs font-bold text-green-500"><i class="fas fa-arrow-up mr-1"></i> 33% increase</span>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-8">
        <div class="lg:col-span-2 bg-dark-card border border-dark-border rounded-2xl p-6">
            <div class="flex justify-between items-center mb-6">
                <h4 class="text-white font-bold text-lg">Issues Trend</h4>
                <div class="flex gap-2 text-xs text-gray-400">
                    <span class="flex items-center gap-1"><span class="w-2 h-2 bg-blue-500 rounded-full"></span> This Week</span>
                </div>
            </div>
            <div class="h-64 flex flex-col items-center justify-center border border-dashed border-gray-800 rounded-xl">
                <i class="fas fa-chart-line text-4xl text-gray-700 mb-2"></i>
                <p class="text-gray-600 italic text-sm">Chart will be rendered here using Chart.js</p>
            </div>
        </div>
        
        <div class="bg-dark-card border border-dark-border rounded-2xl p-6">
            <h4 class="text-white font-bold text-lg mb-6">Recent Activity</h4>
            <div class="space-y-6">
                <div class="relative pl-6 border-l border-gray-800">
                    <div class="absolute w-3 h-3 bg-blue-500 rounded-full -left-[6.5px] top-1 shadow-[0_0_10px_rgba(59,130,246,0.5)]"></div>
                    <p class="text-sm text-white font-medium">Issue #402 Created</p>
                    <p class="text-xs text-gray-500 mt-1">10 minutes ago by Sarah Chen</p>
                </div>
                <div class="relative pl-6 border-l border-gray-800">
                    <div class="absolute w-3 h-3 bg-green-500 rounded-full -left-[6.5px] top-1"></div>
                    <p class="text-sm text-white font-medium">Critical Bug Resolved</p>
                    <p class="text-xs text-gray-500 mt-1">2 hours ago by Mike Davis</p>
                </div>
                <div class="relative pl-6 border-l border-gray-800">
                    <div class="absolute w-3 h-3 bg-yellow-500 rounded-full -left-[6.5px] top-1"></div>
                    <p class="text-sm text-white font-medium">Status Updated to Review</p>
                    <p class="text-xs text-gray-500 mt-1">5 hours ago by Admin</p>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-dark-card border border-dark-border rounded-2xl overflow-hidden shadow-xl">
        <div class="p-6 border-b border-dark-border flex justify-between items-center bg-white/5">
            <h4 class="text-white font-bold">Recent Issues</h4>
            <button class="text-accent-blue text-sm hover:underline">View all</button>
        </div>
        <div class="divide-y divide-dark-border">
            <div class="p-4 flex items-center justify-between hover:bg-white/[0.02] transition group">
                <div class="flex items-center gap-4">
                    <div class="w-10 h-10 flex items-center justify-center bg-red-500/10 rounded-xl text-red-500 group-hover:scale-110 transition">
                        <i class="fas fa-bug"></i>
                    </div>
                    <div>
                        <div class="flex items-center gap-3">
                            <p class="text-white font-semibold text-sm">Auth system timeout in production</p>
                            <span class="px-2 py-0.5 bg-red-500 text-white text-[10px] font-bold rounded shadow-lg shadow-red-500/20">CRITICAL</span>
                        </div>
                        <p class="text-xs text-gray-500 mt-1">Affecting all login attempts on the main gateway.</p>
                    </div>
                </div>
                <div class="text-right">
                    <p class="text-xs text-white font-medium">Assigned: Sarah Chen</p>
                    <span class="inline-block px-3 py-1 bg-purple-500/10 text-purple-400 text-[11px] font-medium rounded-full mt-1 border border-purple-500/20">In Progress</span>
                </div>
            </div>
            <div class="p-4 flex items-center justify-between hover:bg-white/[0.02] transition group">
                <div class="flex items-center gap-4">
                    <div class="w-10 h-10 flex items-center justify-center bg-blue-500/10 rounded-xl text-blue-500 group-hover:scale-110 transition">
                        <i class="fas fa-database"></i>
                    </div>
                    <div>
                        <div class="flex items-center gap-3">
                            <p class="text-white font-semibold text-sm">Slow query on user dashboard</p>
                            <span class="px-2 py-0.5 bg-yellow-500 text-black text-[10px] font-bold rounded">HIGH</span>
                        </div>
                        <p class="text-xs text-gray-500 mt-1">SQL optimization needed for transaction logs.</p>
                    </div>
                </div>
                <div class="text-right">
                    <p class="text-xs text-white font-medium">Assigned: Alex Johnson</p>
                    <span class="inline-block px-3 py-1 bg-blue-500/10 text-blue-400 text-[11px] font-medium rounded-full mt-1 border border-blue-500/20">Open</span>
                </div>
            </div>
        </div>
    </div>
@endsection
@extends('layout')

@section('content')
    <div class="mb-8">
        <h2 class="text-3xl font-extrabold text-white tracking-tight">Dashboard</h2>
        <p class="text-gray-500 mt-1 font-medium">Welcome back! Here's your real-time issue overview.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-dark-card border border-dark-border p-6 rounded-2xl shadow-sm">
            <div class="flex justify-between items-start mb-4">
                <div>
                    <p class="text-gray-400 text-sm font-medium">Total Issues</p>
                    <h3 class="text-3xl font-bold text-white mt-1">{{ $totalIssues }}</h3>
                </div>
                <div class="p-2 bg-gray-800 rounded-lg text-gray-400">
                    <i class="fas fa-bug"></i>
                </div>
            </div>
            <span class="text-xs font-bold text-blue-500">Live data from system</span>
        </div>

        <div class="bg-dark-card border border-dark-border p-6 rounded-2xl shadow-sm">
            <div class="flex justify-between items-start mb-4">
                <div>
                    <p class="text-gray-400 text-sm font-medium">Open Issues</p>
                    <h3 class="text-3xl font-bold text-white mt-1">{{ $openIssues }}</h3>
                </div>
                <div class="p-2 bg-yellow-500/10 rounded-lg text-yellow-500">
                    <i class="fas fa-exclamation-triangle"></i>
                </div>
            </div>
            <span class="text-xs font-bold text-yellow-500">Awaiting fix</span>
        </div>

        <div class="bg-dark-card border border-dark-border p-6 rounded-2xl shadow-sm">
            <div class="flex justify-between items-start mb-4">
                <div>
                    <p class="text-gray-400 text-sm font-medium">Critical</p>
                    <h3 class="text-3xl font-bold text-white mt-1 text-red-500">{{ $criticalIssues }}</h3>
                </div>
                <div class="p-2 bg-red-500/10 rounded-lg text-red-500">
                    <i class="fas fa-bolt"></i>
                </div>
            </div>
            <span class="text-xs font-bold text-red-500">Requires immediate action</span>
        </div>

        <div class="bg-dark-card border border-dark-border p-6 rounded-2xl shadow-sm">
            <div class="flex justify-between items-start mb-4">
                <div>
                    <p class="text-gray-400 text-sm font-medium">Resolved</p>
                    <h3 class="text-3xl font-bold text-white mt-1 text-green-500">{{ $resolvedIssues }}</h3>
                </div>
                <div class="p-2 bg-green-500/10 rounded-lg text-green-500">
                    <i class="fas fa-check-circle"></i>
                </div>
            </div>
            <span class="text-xs font-bold text-green-500">Successfully fixed</span>
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
                <p class="text-gray-600 italic text-sm">Monitoring {{ $totalIssues }} system events</p>
            </div>
        </div>
        
        <div class="bg-dark-card border border-dark-border rounded-2xl p-6 shadow-sm">
            <div class="flex justify-between items-center mb-8">
                <div class="flex items-center gap-2">
                    <i class="fas fa-bolt text-blue-500"></i>
                    <h4 class="text-white font-bold text-lg">Recent Activity</h4>
                </div>
            </div>

            <div class="space-y-6">
                @foreach($recentIssues->take(4) as $activity)
                <div class="relative pl-6 border-l border-white/5">
                    <div class="absolute w-3 h-3 {{ $activity->status == 'open' ? 'bg-blue-500 shadow-[0_0_10px_rgba(59,130,246,0.5)]' : 'bg-green-500 shadow-[0_0_10px_rgba(34,197,94,0.3)]' }} rounded-full -left-[6.5px] top-1"></div>
                    <p class="text-sm text-white font-medium">New Report from {{ $activity->project_name }}</p>
                    <p class="text-xs text-gray-500 mt-1 uppercase font-semibold tracking-tighter">{{ $activity->created_at->diffForHumans() }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="bg-dark-card border border-dark-border rounded-2xl overflow-hidden shadow-xl">
        <div class="p-6 border-b border-dark-border flex justify-between items-center bg-white/5">
            <h4 class="text-white font-bold">Recent Issues (Live Data)</h4>
            <a href="#" class="text-blue-500 text-sm hover:underline">View all reports</a>
        </div>
        <div class="divide-y divide-dark-border">
            @forelse($recentIssues as $issue)
            <div class="p-4 flex items-center justify-between hover:bg-white/[0.02] transition group">
                <div class="flex items-center gap-4">
                    <div class="w-10 h-10 flex items-center justify-center {{ $issue->status == 'open' ? 'bg-red-500/10 text-red-500' : 'bg-green-500/10 text-green-500' }} rounded-xl group-hover:scale-110 transition">
                        <i class="fas {{ $issue->status == 'open' ? 'fa-bug' : 'fa-check-circle' }}"></i>
                    </div>
                    <div>
                        <div class="flex items-center gap-3">
                            <p class="text-white font-semibold text-sm">{{ Str::limit($issue->message, 60) }}</p>
                            <span class="px-2 py-0.5 bg-blue-600 text-white text-[10px] font-bold rounded uppercase">
                                {{ $issue->project_name }}
                            </span>
                        </div>
                        <p class="text-xs text-gray-400 mt-1">
                            <span class="text-gray-600">File:</span> {{ $issue->file }} 
                            <span class="text-gray-600 ml-2">Line:</span> {{ $issue->line }}
                        </p>
                    </div>
                </div>
                <div class="text-right">
                    <p class="text-xs text-white font-medium">{{ $issue->created_at->diffForHumans() }}</p>
                    <span class="inline-block px-3 py-1 {{ $issue->status == 'open' ? 'bg-yellow-500/10 text-yellow-500 border-yellow-500/20' : 'bg-green-500/10 text-green-400 border-green-500/20' }} text-[11px] font-medium rounded-full mt-1 border">
                        {{ strtoupper($issue->status) }}
                    </span>
                </div>
            </div>
            @empty
            <div class="p-8 text-center text-gray-500">
                <i class="fas fa-ghost text-4xl mb-3 block"></i>
                No issues found. Everything is running smoothly!
            </div>
            @endforelse
        </div>
    </div>
@endsection
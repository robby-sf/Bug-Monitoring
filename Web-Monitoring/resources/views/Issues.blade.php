@extends('layout')

@section('content')
    <div class="mb-8">
        <h2 class="text-3xl font-extrabold text-white tracking-tight">Issues</h2>
        <p class="text-gray-500 mt-1 font-medium">Manage and track all reported system bugs.</p>
    </div>

    <div class="bg-dark-card border border-dark-border p-4 rounded-2xl mb-8 flex flex-wrap gap-4 items-center justify-between">
        <div class="flex gap-4 items-center">
            <select class="bg-dark-bg border border-dark-border text-gray-400 text-sm rounded-xl px-4 py-2 focus:ring-2 focus:ring-accent-blue outline-none">
                <option>Status: All</option>
                <option>Open</option>
                <option>In Progress</option>
                <option>Resolved</option>
            </select>
            <select class="bg-dark-bg border border-dark-border text-gray-400 text-sm rounded-xl px-4 py-2 focus:ring-2 focus:ring-accent-blue outline-none">
                <option>Severity: All</option>
                <option>Critical</option>
                <option>High</option>
                <option>Medium</option>
            </select>
        </div>
        <div class="text-gray-500 text-sm font-medium">
            Showing <span class="text-white">{{ $issues->count() }} issues</span>
        </div>
    </div>

    <div class="space-y-4">
        @foreach($issues as $issue)
            @php
                // Logika penentuan warna berdasarkan severity
                $severityColor = [
                    'Critical' => 'bg-red-500 text-white shadow-red-500/20 hover:border-red-500/50',
                    'High'     => 'bg-yellow-500 text-black shadow-yellow-500/20 hover:border-yellow-500/50',
                    'Medium'   => 'bg-gray-700 text-gray-400 hover:border-blue-500/50',
                    'Low'      => 'bg-green-700 text-green-200 hover:border-green-500/50'
                ][$issue->severity] ?? 'bg-gray-700';

                // Logika icon berdasarkan kategori
                $iconClass = $issue->category == 'Backend' ? 'fa-bolt' : ($issue->category == 'Frontend' ? 'fa-bug' : 'fa-check-double');
                $iconBg = [
                    'Critical' => 'bg-red-500/10 text-red-500',
                    'High'     => 'bg-yellow-500/10 text-yellow-500',
                    'Medium'   => 'bg-blue-500/10 text-blue-500',
                    'Low'      => 'bg-green-500/10 text-green-500'
                ][$issue->severity];
            @endphp

            <div class="bg-dark-card border border-dark-border p-6 rounded-2xl transition group relative overflow-hidden {{ $issue->status == 'resolved' ? 'opacity-80 hover:opacity-100' : '' }} {{ explode(' ', $severityColor)[count(explode(' ', $severityColor))-1] }}">
                <div class="flex justify-between items-start gap-4">
                    <div class="flex gap-4">
                        <div class="w-12 h-12 shrink-0 flex items-center justify-center {{ $iconBg }} rounded-2xl group-hover:scale-110 transition">
                            <i class="fas {{ $iconClass }} text-xl"></i>
                        </div>
                        
                        <div>
                            <div class="flex items-center gap-3 flex-wrap">
                                <a href="{{ route('issues.show', $issue->issue_id) }}">
                                    <h4 class="text-white font-bold text-lg hover:text-blue-400 transition {{ $issue->status == 'resolved' ? 'line-through text-gray-500' : '' }}">
                                        {{ $issue->title }}
                                    </h4>
                                </a>

                                <span class="px-2 py-0.5 {{ explode(' hover:', $severityColor)[0] }} text-[10px] font-black rounded uppercase tracking-wider shadow-lg">
                                    {{ $issue->severity }}
                                </span>

                                <span class="px-3 py-1 bg-blue-500/10 text-blue-400 text-xs font-medium rounded-full border border-blue-500/20">
                                    {{ $issue->status }}
                                </span>
                            </div>

                            <p class="text-gray-400 mt-2 text-sm leading-relaxed">
                                {{ Str::limit($issue->description, 120) }}
                            </p>

                            <div class="flex items-center gap-6 mt-4">
                                <div class="flex items-center gap-2 text-gray-500 text-xs">
                                    <i class="fas fa-folder text-accent-blue"></i>
                                    <span>{{ $issue->category }}</span>
                                </div>
                                <div class="flex items-center gap-2 text-gray-500 text-xs">
                                    <i class="fas fa-comment"></i>
                                    <span>0 comments</span> </div>
                                <div class="flex items-center gap-2 text-gray-500 text-xs">
                                    <i class="fas fa-clock"></i>
                                    <span>{{ $issue->created_at->diffForHumans() }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex -space-x-2">
                        <div class="w-8 h-8 rounded-full border-2 border-dark-card bg-accent-blue flex items-center justify-center text-[10px] font-bold text-white shadow-lg" 
                             title="{{ $issue->user->first_name }} {{ $issue->user->last_name }}">
                             {{ strtoupper(substr($issue->user->first_name, 0, 1) . substr($issue->user->last_name, 0, 1)) }}
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
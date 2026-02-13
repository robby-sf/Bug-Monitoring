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
            Showing <span class="text-white">6 issues</span>
        </div>
    </div>

    <div class="space-y-4">
        
        <div class="bg-dark-card border border-dark-border p-6 rounded-2xl hover:border-red-500/50 transition group relative overflow-hidden">
            <div class="flex justify-between items-start gap-4">
                <div class="flex gap-4">
                    <div class="w-12 h-12 flex-shrink-0 flex items-center justify-center bg-red-500/10 rounded-2xl text-red-500 group-hover:scale-110 transition">
                        <i class="fas fa-bolt text-xl"></i>
                    </div>
                    <div>
                        <div class="flex items-center gap-3 flex-wrap">
                            <h4 class="text-white font-bold text-lg">Database connection timeout</h4>
                            <span class="px-2 py-0.5 bg-red-500 text-white text-[10px] font-black rounded uppercase tracking-wider shadow-lg shadow-red-500/20">Critical</span>
                            <span class="px-3 py-1 bg-blue-500/10 text-blue-400 text-xs font-medium rounded-full border border-blue-500/20">open</span>
                        </div>
                        <p class="text-gray-400 mt-2 text-sm leading-relaxed">Connection pool exhausted during peak hours. Affecting API response times globally.</p>
                        <div class="flex items-center gap-6 mt-4">
                            <div class="flex items-center gap-2 text-gray-500 text-xs">
                                <i class="fas fa-folder text-accent-blue"></i>
                                <span>Backend</span>
                            </div>
                            <div class="flex items-center gap-2 text-gray-500 text-xs">
                                <i class="fas fa-comment"></i>
                                <span>12 comments</span>
                            </div>
                            <div class="flex items-center gap-2 text-gray-500 text-xs">
                                <i class="fas fa-clock"></i>
                                <span>About 2 years ago</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex -space-x-2">
                    <div class="w-8 h-8 rounded-full border-2 border-dark-card bg-accent-blue flex items-center justify-center text-[10px] font-bold text-white shadow-lg" title="Alex Johnson">AJ</div>
                </div>
            </div>
        </div>

        <div class="bg-dark-card border border-dark-border p-6 rounded-2xl hover:border-yellow-500/50 transition group">
            <div class="flex justify-between items-start gap-4">
                <div class="flex gap-4">
                    <div class="w-12 h-12 flex-shrink-0 flex items-center justify-center bg-yellow-500/10 rounded-2xl text-yellow-500 group-hover:scale-110 transition">
                        <i class="fas fa-bug text-xl"></i>
                    </div>
                    <div>
                        <div class="flex items-center gap-3 flex-wrap">
                            <h4 class="text-white font-bold text-lg">Login button not responding on mobile</h4>
                            <span class="px-2 py-0.5 bg-yellow-500 text-black text-[10px] font-black rounded uppercase tracking-wider">High</span>
                            <span class="px-3 py-1 bg-purple-500/10 text-purple-400 text-xs font-medium rounded-full border border-purple-500/20">in-progress</span>
                        </div>
                        <p class="text-gray-400 mt-2 text-sm leading-relaxed">Users report that the login button is unresponsive on iOS devices using Safari.</p>
                        <div class="flex items-center gap-6 mt-4">
                            <div class="flex items-center gap-2 text-gray-500 text-xs">
                                <i class="fas fa-folder text-accent-blue"></i>
                                <span>Frontend</span>
                            </div>
                            <div class="flex items-center gap-2 text-gray-500 text-xs">
                                <i class="fas fa-comment"></i>
                                <span>5 comments</span>
                            </div>
                            <div class="flex items-center gap-2 text-gray-500 text-xs">
                                <i class="fas fa-clock"></i>
                                <span>About 2 years ago</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex -space-x-2">
                    <div class="w-8 h-8 rounded-full border-2 border-dark-card bg-purple-500 flex items-center justify-center text-[10px] font-bold text-white shadow-lg" title="Sarah Chen">SC</div>
                </div>
            </div>
        </div>

        <div class="bg-dark-card border border-dark-border p-6 rounded-2xl hover:border-green-500/50 transition group opacity-80 hover:opacity-100">
            <div class="flex justify-between items-start gap-4">
                <div class="flex gap-4">
                    <div class="w-12 h-12 flex-shrink-0 flex items-center justify-center bg-green-500/10 rounded-2xl text-green-500">
                        <i class="fas fa-check-double text-xl"></i>
                    </div>
                    <div>
                        <div class="flex items-center gap-3 flex-wrap">
                            <h4 class="text-white font-bold text-lg line-through text-gray-500">CSS animation stuttering</h4>
                            <span class="px-2 py-0.5 bg-gray-700 text-gray-400 text-[10px] font-black rounded uppercase tracking-wider">Medium</span>
                            <span class="px-3 py-1 bg-green-500/10 text-green-400 text-xs font-medium rounded-full border border-green-500/20">resolved</span>
                        </div>
                        <p class="text-gray-500 mt-2 text-sm leading-relaxed">Dropdown menu animation is not smooth on older devices.</p>
                        <div class="flex items-center gap-6 mt-4">
                            <div class="flex items-center gap-2 text-gray-600 text-xs">
                                <i class="fas fa-folder"></i>
                                <span>Frontend</span>
                            </div>
                            <div class="flex items-center gap-2 text-gray-600 text-xs">
                                <i class="fas fa-clock"></i>
                                <span>Resolved 1 week ago</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex -space-x-2">
                    <div class="w-8 h-8 rounded-full border-2 border-dark-card bg-green-500 flex items-center justify-center text-[10px] font-bold text-white shadow-lg">ER</div>
                </div>
            </div>
        </div>

    </div>
@endsection
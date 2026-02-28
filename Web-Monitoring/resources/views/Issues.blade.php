@extends('layout')

@section('content')
    <div class="mb-8">
        <h2 class="text-3xl font-extrabold text-white tracking-tight">Issues</h2>
        <p class="text-gray-500 mt-1 font-medium">Manage and track all reported system bugs.</p>
    </div>

    <div class="bg-dark-card border border-dark-border p-4 rounded-2xl mb-8 flex flex-wrap gap-4 items-center justify-between">
    <form action="{{ route('issues.index') }}" method="GET" class="flex flex-wrap gap-4 items-center z-20">
            
            <div x-data="{
                open: false,
                selected: '{{ request('status', 'All') }}',
                options: {
                    'All': 'Status: All',
                    'open': 'Open',
                    'in-progress': 'In Progress',
                    'resolved': 'Resolved'
                },
                update(val) {
                    this.selected = val;
                    this.$refs.hiddenInputStatus.value = val;
                    this.$refs.hiddenInputStatus.form.submit();
                }
            }" class="relative">
                <input type="hidden" name="status" x-ref="hiddenInputStatus" :value="selected">
                
                <button type="button" @click="open = !open" @click.away="open = false" 
                        class="flex items-center justify-between gap-3 bg-[#1a1a1a] border border-white/10 text-zinc-300 text-sm rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-indigo-500/50 outline-none transition-all cursor-pointer hover:bg-[#252525] shadow-inner min-w-35">
                    <span x-text="options[selected]" class="font-medium"></span>
                    <i class="fas fa-chevron-down text-[10px] text-zinc-500 transition-transform duration-200" :class="open ? 'rotate-180' : ''"></i>
                </button>

                <div x-show="open" style="display: none;"
                     x-transition.opacity.duration.100ms
                     class="absolute left-0 mt-2 w-full min-w-35 bg-[#1a1a1a] border border-white/10 rounded-xl shadow-2xl overflow-hidden z-50 py-1.5">
                     <template x-for="(label, value) in options" :key="value">
                         <button type="button" @click="update(value)"
                                 class="w-full text-left px-4 py-2 text-sm transition-colors flex items-center justify-between"
                                 :class="selected === value ? 'text-white bg-indigo-500/20 font-bold' : 'text-zinc-400 hover:bg-white/5 hover:text-white'">
                             <span x-text="label"></span>
                             <i x-show="selected === value" class="fas fa-check text-indigo-400 text-[10px]"></i>
                         </button>
                     </template>
                </div>
            </div>

            <div x-data="{
                open: false,
                selected: '{{ request('severity', 'All') }}',
                options: {
                    'All': 'Severity: All',
                    'Critical': 'Critical',
                    'High': 'High',
                    'Medium': 'Medium',
                    'Low': 'Low'
                },
                update(val) {
                    this.selected = val;
                    this.$refs.hiddenInputSeverity.value = val;
                    this.$refs.hiddenInputSeverity.form.submit();
                }
            }" class="relative">
                <input type="hidden" name="severity" x-ref="hiddenInputSeverity" :value="selected">
                
                <button type="button" @click="open = !open" @click.away="open = false" 
                        class="flex items-center justify-between gap-3 bg-[#1a1a1a] border border-white/10 text-zinc-300 text-sm rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-indigo-500/50 outline-none transition-all cursor-pointer hover:bg-[#252525] shadow-inner min-w-35">
                    <span x-text="options[selected]" class="font-medium"></span>
                    <i class="fas fa-chevron-down text-[10px] text-zinc-500 transition-transform duration-200" :class="open ? 'rotate-180' : ''"></i>
                </button>

                <div x-show="open" style="display: none;"
                     x-transition.opacity.duration.100ms
                     class="absolute left-0 mt-2 w-full min-w-35 bg-[#1a1a1a] border border-white/10 rounded-xl shadow-2xl overflow-hidden z-50 py-1.5">
                     <template x-for="(label, value) in options" :key="value">
                         <button type="button" @click="update(value)"
                                 class="w-full text-left px-4 py-2 text-sm transition-colors flex items-center justify-between"
                                 :class="selected === value ? 'text-white bg-indigo-500/20 font-bold' : 'text-zinc-400 hover:bg-white/5 hover:text-white'">
                             <span x-text="label"></span>
                             <i x-show="selected === value" class="fas fa-check text-indigo-400 text-[10px]"></i>
                         </button>
                     </template>
                </div>
            </div>

            @if((request('status') && request('status') != 'All') || (request('severity') && request('severity') != 'All'))
                <a href="{{ route('issues.index') }}" class="flex items-center gap-2 text-xs font-bold text-red-400 hover:text-red-300 bg-red-500/10 hover:bg-red-500/20 border border-red-500/20 px-3 py-2.5 rounded-xl transition-all">
                    <i class="fas fa-times"></i> Clear Filters
                </a>
            @endif

        </form>
        <div class="text-zinc-500 text-sm font-medium bg-[#1a1a1a] px-4 py-2 rounded-xl border border-white/5">
            Showing 
            <span class=" bg-indigo-500/20 text-indigo-400 px-2 py-0.5 rounded-md mx-1">{{ $issues->firstItem() ?? 0 }}</span> 
            to 
            <span class=" bg-indigo-500/20 text-indigo-400 px-2 py-0.5 rounded-md mx-1">{{ $issues->lastItem() ?? 0 }}</span> 
            of 
            <span class="text-white font-bold ml-1">{{ $issues->total() }}</span> issues
        </div>
    </div>

    <div class="space-y-4">
        @forelse($issues as $issue)
            @php
                // Logika penentuan warna berdasarkan severity
                $severityColor = [
                    'Critical' => 'bg-red-500 text-white shadow-red-500/20 hover:border-red-500/50',
                    'High'     => 'bg-yellow-500 text-black shadow-yellow-500/20 hover:border-yellow-500/50',
                    'Medium'   => 'bg-gray-700 text-gray-400 hover:border-blue-500/50',
                    'Low'      => 'bg-green-700 text-green-200 hover:border-green-500/50'
                ][$issue->severity] ?? 'bg-gray-700';

                // Logika icon berdasarkan kategori
                $iconClass = match(strtolower($issue->category)) {
                    'frontend'    => 'fa-desktop',
                    'backend'     => 'fa-server',
                    'database'    => 'fa-database',
                    'security'    => 'fa-shield-alt',
                    'performance' => 'fa-tachometer-alt',
                    'network'     => 'fa-network-wired',
                    default       => 'fa-bug', // Untuk General atau lainnya
                };
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
                                    <i class="fas fa-clock"></i>
                                    <span>{{ $issue->created_at->diffForHumans() }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex -space-x-2">
                        <div class="flex -space-x-2">
                            @if($issue->user)
                                <div class="w-8 h-8 rounded-full border-2 border-dark-card bg-accent-blue flex items-center justify-center text-[10px] font-bold text-white shadow-lg" 
                                    title="{{ $issue->user->first_name }} {{ $issue->user->last_name }}">
                                    {{ strtoupper(substr($issue->user->first_name, 0, 1) . substr($issue->user->last_name, 0, 1)) }}
                                </div>
                            @else
                                <div class="w-8 h-8 rounded-full border-2 border-dark-card bg-gray-700 flex items-center justify-center text-[10px] font-bold text-gray-400 shadow-lg" 
                                    title="Not Assigned">
                                    <i class="fas fa-user-slash"></i>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="bg-[#0f0f0f] border border-white/10 p-16 rounded-2xl text-center shadow-sm flex flex-col items-center justify-center">
                <div class="w-24 h-24 bg-[#1a1a1a] rounded-full flex items-center justify-center mb-6 border border-white/5 shadow-inner">
                    <i class="fas fa-search-minus text-4xl text-zinc-600"></i>
                </div>
                
                <h3 class="text-xl font-bold text-white mb-2">No Issues Found</h3>
                <p class="text-zinc-500 text-sm max-w-sm mx-auto leading-relaxed">
                    We couldn't find any bugs matching your current filters. Try changing the status or severity above.
                </p>
                
                @if((request('status') && request('status') != 'All') || (request('severity') && request('severity') != 'All'))
                    <a href="{{ route('issues.index') }}" class="mt-8 inline-flex items-center gap-2 px-5 py-2.5 bg-indigo-500 hover:bg-indigo-600 text-white text-sm font-semibold rounded-xl transition-all shadow-lg shadow-indigo-500/20 active:scale-95">
                        <i class="fas fa-undo"></i> Reset Filters
                    </a>
                @endif
            </div>
        @endforelse
        </div> <div class="mt-8 mb-4">
        {{ $issues->links('components.pagination') }}
        </div>
    </div>
@endsection
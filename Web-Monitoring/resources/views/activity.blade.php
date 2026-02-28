@extends('layout')

@section('content')
    <div class="mb-8">
        <h2 class="text-3xl font-extrabold text-white tracking-tight">System Activity</h2>
        <p class="text-gray-500 mt-1 font-medium">Track all team actions, bug reports, and status updates.</p>
    </div>

    <div class="bg-[#0f0f0f] border border-white/10 p-5 rounded-2xl mb-8 flex flex-wrap gap-4 items-center justify-between shadow-sm">
        <form action="{{ route('activity.index') }}" method="GET" class="flex flex-wrap gap-4 items-center z-20">
            
            <div x-data="{
                open: false,
                selected: '{{ request('action_type', 'All') }}',
                options: {
                    'All': 'All Activities',
                    'created': 'Bug Created',
                    'assigned': 'Assigned',
                    'resolved': 'Resolved',
                    'in-progress': 'In Progress'
                },
                update(val) {
                    this.selected = val;
                    this.$refs.hiddenInputAction.value = val;
                    this.$refs.hiddenInputAction.form.submit();
                }
            }" class="relative">
                <input type="hidden" name="action_type" x-ref="hiddenInputAction" :value="selected">
                
                <button type="button" @click="open = !open" @click.away="open = false" 
                        class="flex items-center justify-between gap-3 bg-[#1a1a1a] border border-white/10 text-zinc-300 text-sm rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-indigo-500/50 outline-none transition-all cursor-pointer hover:bg-[#252525] shadow-inner min-w-45">
                    <span x-text="options[selected] || 'Filter Activity'" class="font-medium"></span>
                    <i class="fas fa-chevron-down text-[10px] text-zinc-500 transition-transform duration-200" :class="open ? 'rotate-180' : ''"></i>
                </button>

                <div x-show="open" style="display: none;"
                     x-transition.opacity.duration.100ms
                     class="absolute left-0 mt-2 w-full min-w-45 bg-[#1a1a1a] border border-white/10 rounded-xl shadow-2xl overflow-hidden z-50 py-1.5">
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

            @if(request('action_type') && request('action_type') != 'All')
                <a href="{{ route('activity.index') }}" class="flex items-center gap-2 text-xs font-bold text-red-400 hover:text-red-300 bg-red-500/10 hover:bg-red-500/20 border border-red-500/20 px-3 py-2.5 rounded-xl transition-all">
                    <i class="fas fa-times"></i> Clear Filter
                </a>
            @endif
        </form>

        <div class="text-zinc-500 text-sm font-medium bg-[#1a1a1a] px-4 py-2 rounded-xl border border-white/5 shadow-inner">
            Showing <span class="text-white font-bold ml-1">{{ $activities->firstItem() ?? 0 }} - {{ $activities->lastItem() ?? 0 }}</span> of <span class="text-white font-bold">{{ $activities->total() }}</span> logs
        </div>
    </div>

    <div class="bg-[#0f0f0f] border border-white/10 rounded-3xl p-8 shadow-xl">
        <div class="space-y-8 border-l-2 border-white/5 ml-4 pl-8 relative">
            @forelse($activities as $activity)
                @php
                    $actionType = strtolower($activity->action);
                    
                    // Logika Warna Titik & Ikon
                    $actionConfig = match($actionType) {
                        'created'  => ['color' => 'bg-yellow-500', 'shadow' => 'shadow-[0_0_15px_rgba(234,179,8,0.4)]', 'icon' => 'fa-plus'],
                        'assigned' => ['color' => 'bg-blue-500', 'shadow' => 'shadow-[0_0_15px_rgba(59,130,246,0.4)]', 'icon' => 'fa-user-check'],
                        'resolved' => ['color' => 'bg-green-500', 'shadow' => 'shadow-[0_0_15px_rgba(34,197,94,0.4)]', 'icon' => 'fa-check-double'],
                        'in-progress' => ['color' => 'bg-indigo-500', 'shadow' => 'shadow-[0_0_15px_rgba(99,102,241,0.4)]', 'icon' => 'fa-tools'],
                        default    => ['color' => 'bg-gray-500', 'shadow' => 'shadow-[0_0_15px_rgba(107,114,128,0.4)]', 'icon' => 'fa-history']
                    };

                    $actorName = $activity->user ? $activity->user->first_name . ' ' . $activity->user->last_name : 'System API';
                @endphp

                <div class="relative group">
                    <div class="absolute w-5 h-5 {{ $actionConfig['color'] }} {{ $actionConfig['shadow'] }} rounded-full -left-10.75 top-1 flex items-center justify-center border-[3px] border-[#0f0f0f] z-10 transition-transform group-hover:scale-125"></div>
                    
                    <div class="bg-[#1a1a1a] border border-white/5 p-5 rounded-2xl hover:bg-[#252525] transition-all flex flex-col md:flex-row md:items-center justify-between gap-4">
                        <div>
                            <p class="text-[15px] text-zinc-300 leading-relaxed">
                                <span class="text-white font-bold">{{ $actorName }}</span> 
                                {{ str_replace($actorName, '', $activity->description) }}
                                
                                @if($activity->issue)
                                    <a href="{{ route('issues.show', $activity->issue->issue_id) }}" class="text-indigo-400 hover:text-indigo-300 font-bold transition ml-1 bg-indigo-500/10 px-2 py-0.5 rounded-md">
                                        #{{ $activity->issue->issue_id }}
                                    </a>
                                @endif
                            </p>
                            <div class="flex items-center gap-4 mt-2">
                                <p class="text-xs text-zinc-500 font-medium flex items-center gap-1.5">
                                    <i class="far fa-clock"></i> {{ $activity->created_at->format('d M Y, H:i A') }}
                                </p>
                                <span class="text-[10px] {{ str_replace('bg-', 'text-', $actionConfig['color']) }} font-bold uppercase tracking-wider border border-white/5 px-2 py-0.5 rounded bg-white/5">
                                    {{ $actionType }}
                                </span>
                            </div>
                        </div>

                        <div class="hidden md:flex w-10 h-10 rounded-xl bg-white/5 items-center justify-center {{ str_replace('bg-', 'text-', $actionConfig['color']) }} border border-white/5">
                            <i class="fas {{ $actionConfig['icon'] }}"></i>
                        </div>
                    </div>
                </div>
            @empty
                <div class="bg-[#1a1a1a] border border-white/5 p-12 rounded-2xl text-center flex flex-col items-center justify-center -ml-4">
                    <div class="w-20 h-20 bg-[#0f0f0f] rounded-full flex items-center justify-center mb-5 border border-white/5 shadow-inner">
                        <i class="fas fa-history text-3xl text-zinc-600"></i>
                    </div>
                    <h3 class="text-lg font-bold text-white mb-2">No Activities Found</h3>
                    <p class="text-zinc-500 text-sm max-w-sm mx-auto leading-relaxed">
                        We couldn't find any system logs matching your current filter.
                    </p>
                </div>
            @endforelse
        </div>

        <div class="mt-10 border-t border-white/5 pt-6">
            {{ $activities->links('components.pagination') }}
        </div>
    </div>
@endsection
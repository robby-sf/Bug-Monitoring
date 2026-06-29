@extends('layout')

@section('content')
    <div class="max-w-7xl mx-auto py-8 px-4" x-data="{ 
        tab: 'description', 
        isAssignModalOpen: false, 
        searchSearch: '', 
        isResolveModalOpen: false,
        copyToClipboard(elementId) {
            let text = document.getElementById(elementId).innerText;
            let tempInput = document.createElement('textarea');
            tempInput.value = text;
            document.body.appendChild(tempInput);
            tempInput.select();
            document.execCommand('copy');
            document.body.removeChild(tempInput);
            alert('Copied to clipboard!');
        }
    }">
    <div class="max-w-7xl mx-auto py-8 px-4" x-data="{ tab: 'description', isAssignModalOpen: false, searchSearch: '', isResolveModalOpen: false }">
        <a href="/issues" class="flex items-center gap-2 text-blue-500 hover:text-blue-400 mb-8 text-sm font-medium transition group">
            <i class="fas fa-arrow-left text-xs transition-transform group-hover:-translate-x-1"></i> Back to Issues
        </a>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <div class="lg:col-span-2 space-y-6">
                <div class="bg-[#0f0f0f] border border-white/10 rounded-xl overflow-hidden shadow-sm">
                    <div class="p-8 pb-0">
                        <div class="flex justify-between items-start mb-6">
                            <h1 class="text-2xl font-semibold text-white tracking-tight leading-tight">{{ $issue->title }}</h1>
                            @php
                                $severityClass = match(strtolower($issue->severity)) {
                                    'critical' => 'bg-red-500/10 text-red-500 border-red-500/20',
                                    'high'     => 'bg-orange-500/10 text-orange-500 border-orange-500/20',
                                    'medium'   => 'bg-blue-500/10 text-blue-500 border-blue-500/20',
                                    'low'      => 'bg-green-500/10 text-green-500 border-green-500/20',
                                    default    => 'bg-gray-500/10 text-gray-500 border-gray-500/20',
                                };
                            @endphp
                            
                            <span class="px-2 py-0.5 text-[10px] font-bold rounded border uppercase {{ $severityClass }}">
                                {{ $issue->severity }}
                            </span>
                        </div>
                        
                        <div class="flex gap-3 mb-8">
                            <span class="px-3 py-1 bg-purple-500/10 text-purple-400 text-xs rounded-full border border-purple-500/20 uppercase font-semibold">
                                {{ $issue->status }}
                            </span>
                            <span class="px-3 py-1 bg-blue-500/10 text-blue-400 text-xs font-mono rounded-full border border-blue-500/20">
                                #{{ $issue->issue_id }}
                            </span>
                        </div>

                        <div class="flex border-b border-white/10">
                            <button @click="tab = 'description'" 
                                :class="tab === 'description' ? 'text-white border-b-2 border-blue-500' : 'text-zinc-500 hover:text-zinc-300'"
                                class="px-6 py-4 text-sm font-medium transition-all focus:outline-none">Description</button>
                            <button @click="tab = 'environment'" 
                                :class="tab === 'environment' ? 'text-white border-b-2 border-blue-500' : 'text-zinc-500 hover:text-zinc-300'"
                                class="px-6 py-4 text-sm font-medium transition-all focus:outline-none flex items-center gap-2">
                                <i class="fas text-[10px]"></i> Environment</button>
                            <button @click="tab = 'technical'" 
                                :class="tab === 'technical' ? 'text-white border-b-2 border-blue-500' : 'text-zinc-500 hover:text-zinc-300'"
                                class="px-6 py-4 text-sm font-medium transition-all focus:outline-none">Technical Details</button>
                            
                        </div>
                    </div>

                    <div class="p-8 min-h-87.5">
                        <div x-show="tab === 'description'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 transform translate-y-2">
                            <p class="text-zinc-400 leading-relaxed text-base whitespace-pre-line">
                                {{ $issue->description }}
                            </p>
                        </div>

                        <div x-show="tab === 'environment'" x-transition:enter="transition ease-out duration-200" class="space-y-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="bg-[#1a1a1a] p-4 rounded-xl border border-white/5">
                                    <p class="text-[10px] text-zinc-500 uppercase font-bold mb-1 tracking-widest">URL Endpoint</p>
                                    <p class="text-blue-400 text-sm truncate font-mono">{{ $issue->url ?? 'Manual Entry' }}</p>
                                </div>
                                <div class="bg-[#1a1a1a] p-4 rounded-xl border border-white/5">
                                    <p class="text-[10px] text-zinc-500 uppercase font-bold mb-1 tracking-widest">User Environment</p>
                                    <p class="text-zinc-300 text-sm truncate">{{ $issue->environment ?? 'Unknown' }}</p>
                                </div>
                            </div>

                            <div class="bg-[#0a0a0a] rounded-xl border border-white/10 overflow-hidden">
                                <div class="flex justify-between items-center bg-white/5 px-4 py-2 border-b border-white/10">
                                    <span class="text-[11px] font-bold text-zinc-400 uppercase tracking-widest"><i class="fas fa-code mr-2"></i> Request Payload</span>
                                    <button @click="copyToClipboard('payload-box')" class="text-zinc-500 hover:text-white text-xs transition-colors"><i class="far fa-copy mr-1"></i> Copy</button>
                                </div>
                                <pre id="payload-box" class="p-6 font-mono text-sm text-green-400/90 leading-relaxed overflow-x-auto">@if($issue->payload){{ json_encode($issue->payload, JSON_PRETTY_PRINT) }}@else// No data.@endif</pre>
                            </div>
                        </div>

                        <div x-show="tab === 'technical'" x-transition:enter="transition ease-out duration-200">
                            <div class="bg-[#050505] rounded-xl border border-white/10 overflow-hidden shadow-2xl">
                                <div class="flex justify-between items-center bg-[#1a1a1a] px-4 py-3 border-b border-white/5">
                                    <div class="flex gap-1.5">
                                        <div class="w-3 h-3 rounded-full bg-red-500/50"></div>
                                        <div class="w-3 h-3 rounded-full bg-yellow-500/50"></div>
                                        <div class="w-3 h-3 rounded-full bg-green-500/50"></div>
                                    </div>
                                    <button @click="copyToClipboard('stack-trace-box')" class="text-zinc-500 hover:text-white text-xs transition-colors"><i class="far fa-copy mr-1"></i> Copy Log</button>
                                </div>
                                <pre id="stack-trace-box" class="p-6 font-mono text-[12px] text-zinc-400 leading-relaxed overflow-x-auto max-h-125 scrollbar-thin scrollbar-thumb-zinc-800 italic">{{ $issue->stack_trace ?? 'No trace available.' }}</pre>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="space-y-4">
                
                <div class="bg-[#0f0f0f] border border-white/10 rounded-xl p-6 shadow-sm">
                    <h3 class="text-white text-sm font-medium mb-5">Assignee</h3>
                    
                    @if(Auth::user()->role === 'admin')
                    @if($issue->user)
                        <div class="flex items-center gap-4 mb-6">
                            <div class="w-12 h-12 rounded-full bg-[#4f67d6] flex items-center justify-center text-white font-medium text-lg shadow-inner">
                                {{ strtoupper(substr($issue->user->first_name, 0, 1) . substr($issue->user->last_name, 0, 1)) }}
                            </div>
                            <div>
                                <p class="text-white text-base font-normal">{{ $issue->user->first_name }} {{ $issue->user->last_name }}</p>
                                <p class="text-zinc-500 text-xs">{{ ucfirst($issue->user->role) }}</p>
                            </div>
                        </div>
                        <button @click="isAssignModalOpen = true" type="button" class="relative z-10 w-full py-2.5 bg-[#1a1a1a] hover:bg-[#252525] text-zinc-200 text-sm font-medium rounded-md border border-white/5 transition-colors cursor-pointer active:scale-[0.98]">
                            Change Assignee
                        </button>
                    @else
                        <div class="flex items-center gap-4 mb-6">
                            <div class="w-12 h-12 rounded-full border border-dashed border-zinc-700 bg-black/20 flex items-center justify-center text-zinc-600 font-medium shadow-inner">
                                <i class="fas fa-user-slash"></i>
                            </div>
                            <div>
                                <p class="text-zinc-400 text-base font-normal italic">Not Assigned</p>
                                <p class="text-zinc-600 text-xs">Waiting for action</p>
                            </div>
                        </div>
                        <button @click="isAssignModalOpen = true" type="button" class="relative z-10 w-full py-2.5 bg-blue-600 hover:bg-blue-500 text-white text-sm font-medium rounded-md border border-blue-500/50 transition-colors cursor-pointer active:scale-[0.98]">
                            Assign to Developer
                        </button>
                    @endif
                    @else
                    {{-- Non-admin: hanya tampilkan info assignee tanpa tombol --}}
                    @if($issue->user)
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-full bg-[#4f67d6] flex items-center justify-center text-white font-medium text-lg shadow-inner">
                                {{ strtoupper(substr($issue->user->first_name, 0, 1) . substr($issue->user->last_name, 0, 1)) }}
                            </div>
                            <div>
                                <p class="text-white text-base font-normal">{{ $issue->user->first_name }} {{ $issue->user->last_name }}</p>
                                <p class="text-zinc-500 text-xs">{{ ucfirst($issue->user->role) }}</p>
                            </div>
                        </div>
                    @else
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-full border border-dashed border-zinc-700 bg-black/20 flex items-center justify-center text-zinc-600 font-medium shadow-inner">
                                <i class="fas fa-user-slash"></i>
                            </div>
                            <div>
                                <p class="text-zinc-400 text-base font-normal italic">Not Assigned</p>
                                <p class="text-zinc-600 text-xs">Waiting for action</p>
                            </div>
                        </div>
                    @endif
                    @endif
                </div>

                <div class="bg-[#0f0f0f] border border-white/10 rounded-xl p-6 shadow-sm">
                    <h3 class="text-white text-sm font-medium mb-5 flex items-center gap-2">
                        <i class="far fa-clock text-zinc-500 text-xs"></i> Timeline
                    </h3>
                    <div class="space-y-5">
                        <div class="flex flex-col">
                            <span class="text-zinc-500 text-[10px] uppercase tracking-wider mb-1">Created</span>
                            <span class="text-zinc-200 text-sm tracking-tighter">{{ $issue->created_at->format('d M Y, H:i') }}</span>
                        </div>
                        <div class="flex flex-col">
                            <span class="text-zinc-500 text-[10px] uppercase tracking-wider mb-1">Last Updated</span>
                            <span class="text-zinc-200 text-sm tracking-tighter">{{ $issue->updated_at->format('d M Y, H:i') }}</span>
                        </div>
                    </div>
                </div>

                <div class="bg-[#0f0f0f] border border-white/10 rounded-xl p-6 shadow-sm">
                    <h3 class="text-white text-sm font-medium mb-5 flex items-center gap-2">
                        <i class="far fa-comment-alt text-zinc-500 text-xs"></i> Activity Log
                    </h3>
                    
                    <div class="space-y-4 h-33.75 overflow-y-auto pr-2 scrollbar-thin scrollbar-thumb-zinc-700 scrollbar-track-transparent">
                        
                        @forelse($issue->activities as $activity)
                            <div class="border-b border-white/5 pb-3">
                                <p class="text-zinc-200 text-sm">
                                    {{ $activity->description }}
                                </p>
                                <p class="text-zinc-500 text-[10px] mt-1">
                                    by <span class="text-blue-400">{{ $activity->user ? $activity->user->first_name . ' ' . $activity->user->last_name : 'System' }}</span>
                                    <span class="mx-1">•</span>
                                    {{ $activity->created_at->diffForHumans() }}
                                </p>
                            </div>
                        @empty
                            <div class="flex items-center justify-center h-full pb-4">
                                <p class="text-zinc-500 text-sm italic">No activity recorded yet.</p>
                            </div>
                        @endforelse
                        
                    </div>
                </div>

                @if(in_array(Auth::user()->role, ['admin', 'developer']))
                @if(strtolower($issue->status) !== 'resolved')
                    <button type="button" @click="isResolveModalOpen = true" class="mt-2 relative z-10 w-full py-4 bg-indigo-600/10 hover:bg-indigo-600 text-white font-semibold text-sm rounded-md transition-all flex items-center justify-center gap-2 border border-indigo-600/20 active:scale-[0.98] cursor-pointer group">
                        <i class="fas fa-check-circle text-xs text-indigo-400 group-hover:text-white transition-colors"></i> 
                        <span>Mark as Resolved</span>
                    </button>
                @else
                    <div class="mt-2 w-full py-4 bg-green-500/10 text-green-500 font-semibold text-sm rounded-md flex items-center justify-center gap-2 border border-green-500/20">
                        <i class="fas fa-check-double text-xs"></i> 
                        <span>Issue Resolved</span>
                    </div>
                @endif
                @else
                {{-- Staff: hanya tampilkan status resolved badge jika sudah resolved --}}
                @if(strtolower($issue->status) === 'resolved')
                    <div class="mt-2 w-full py-4 bg-green-500/10 text-green-500 font-semibold text-sm rounded-md flex items-center justify-center gap-2 border border-green-500/20">
                        <i class="fas fa-check-double text-xs"></i> 
                        <span>Issue Resolved</span>
                    </div>
                @endif
                @endif
            </div>
        </div>

        <div x-show="isAssignModalOpen" style="display: none;" class="fixed inset-0 z-50 flex items-center justify-center bg-black/60 backdrop-blur-sm p-4"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0">
            
            <div @click.away="isAssignModalOpen = false" class="bg-[#0f0f0f] border border-white/10 rounded-2xl w-full max-w-md shadow-2xl flex flex-col overflow-hidden"
                x-transition:enter="transition ease-out duration-300 transform"
                x-transition:enter-start="opacity-0 scale-95 translate-y-4"
                x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                x-transition:leave="transition ease-in duration-200 transform"
                x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                x-transition:leave-end="opacity-0 scale-95 translate-y-4">
                
                <div class="flex items-center justify-between p-5 border-b border-white/10">
                    <h3 class="text-white font-semibold text-lg">Assign Issue</h3>
                    <button @click="isAssignModalOpen = false" class="text-zinc-500 hover:text-white transition-colors focus:outline-none">
                        <i class="fas fa-times text-lg"></i>
                    </button>
                </div>

                <div class="p-4 border-b border-white/5 bg-[#141414]">
                    <div class="relative">
                        <i class="fas fa-search absolute left-3.5 top-3.5 text-zinc-500 text-sm"></i>
                        <input type="text" x-model="searchSearch" placeholder="Search team members..." 
                            class="w-full bg-[#1a1a1a] border border-white/10 rounded-xl py-2.5 pl-10 pr-4 text-white text-sm focus:border-blue-500 focus:ring-1 focus:ring-blue-500 outline-none transition-all placeholder:text-zinc-600">
                    </div>
                </div>

                <div class="p-2 overflow-y-auto max-h-87.5 custom-scrollbar">
                    <p class="text-zinc-600 text-xs font-semibold uppercase tracking-wider px-3 py-2 mb-1">Suggested Assignees</p>
                    
                    @forelse($admins as $admin)
                        <div x-show="'{{ strtolower($admin->first_name . ' ' . $admin->last_name . ' ' . $admin->role) }}'.includes(searchSearch.toLowerCase())" 
                            class="flex items-center justify-between p-3 rounded-xl hover:bg-[#1a1a1a] cursor-pointer transition-colors group">
                            
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-full bg-indigo-600 flex items-center justify-center text-white font-medium text-sm shadow-inner group-hover:scale-105 transition-transform">
                                    {{ strtoupper(substr($admin->first_name, 0, 1) . substr($admin->last_name, 0, 1)) }}
                                </div>
                                
                                <div>
                                    <p class="text-zinc-200 text-sm font-medium">{{ $admin->first_name }} {{ $admin->last_name }}</p>
                                    <p class="text-zinc-500 text-xs">{{ ucfirst($admin->role) }}</p>
                                </div>
                            </div>
                            
                            <form action="{{ route('issues.assign', $issue->issue_id) }}" method="POST" class="m-0 p-0">
                                @csrf
                                @method('PATCH')
                                
                                <input type="hidden" name="user_id" value="{{ $admin->id }}">
                                
                                <button type="submit" class="opacity-0 group-hover:opacity-100 text-blue-500 hover:text-blue-400 text-sm font-medium transition-opacity cursor-pointer">
                                    Assign
                                </button>
                            </form>
                        </div>
                    @empty
                        <div class="text-center py-8">
                            <i class="fas fa-users-slash text-zinc-600 text-2xl mb-2 block"></i>
                            <p class="text-zinc-500 text-sm">Belum ada anggota tim.</p>
                        </div>
                    @endforelse
                    <div x-show="searchSearch !== ''" class="text-center py-8 mt-4 border-t border-white/5">
                        <p class="text-zinc-500 text-xs italic">User Not Found.</p>
                    </div>
                </div>
            </div>
        </div>

        <div x-show="isResolveModalOpen" style="display: none;" class="fixed inset-0 z-50 flex items-center justify-center bg-black/60 backdrop-blur-sm p-4"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0">
            
            <div @click.away="isResolveModalOpen = false" class="bg-[#0f0f0f] border border-white/10 rounded-3xl w-full max-w-sm shadow-2xl flex flex-col overflow-hidden text-center p-8"
                 x-transition:enter="transition ease-out duration-300 transform"
                 x-transition:enter-start="opacity-0 scale-95 translate-y-4"
                 x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-200 transform"
                 x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                 x-transition:leave-end="opacity-0 scale-95 translate-y-4">
                
                <div class="w-16 h-16 rounded-full bg-indigo-500/10 border border-indigo-500/20 text-indigo-500 flex items-center justify-center mx-auto mb-5 shadow-inner">
                    <i class="fas fa-check-double text-3xl"></i>
                </div>
                
                <h3 class="text-white font-bold text-xl mb-2">Resolve Issue?</h3>
                <p class="text-zinc-400 text-sm mb-8 leading-relaxed">
                    Apakah kamu yakin bug ini sudah selesai diperbaiki? Status issue akan diubah dan dicatat di Activity Log.
                </p>

                <div class="flex gap-3">
                    <button type="button" @click="isResolveModalOpen = false" class="flex-1 py-3 bg-[#1a1a1a] hover:bg-[#252525] text-zinc-300 text-sm font-semibold rounded-xl border border-white/5 transition-colors cursor-pointer">
                        Batal
                    </button>
                    
                    <form action="{{ route('issues.resolve', $issue->issue_id) }}" method="POST" class="flex-1 m-0 p-0">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="w-full py-3 bg-indigo-600 hover:bg-indigo-500 text-white text-sm font-semibold rounded-xl border border-indigo-500/50 transition-all shadow-lg shadow-indigo-500/20 active:scale-95 cursor-pointer">
                            Ya, Selesaikan
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
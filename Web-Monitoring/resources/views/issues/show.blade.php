@extends('layout')

@section('content')
<div class="max-w-7xl mx-auto py-8 px-4" x-data="{ tab: 'description' }">
    <a href="/issues" class="flex items-center gap-2 text-blue-500 hover:text-blue-400 mb-8 text-sm font-medium transition group">
        <i class="fas fa-arrow-left text-xs transition-transform group-hover:-translate-x-1"></i> Back to Issues
    </a>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-[#0f0f0f] border border-white/10 rounded-xl overflow-hidden shadow-sm">
                <div class="p-8 pb-0">
                    <div class="flex justify-between items-start mb-6">
                        <h1 class="text-2xl font-semibold text-white tracking-tight leading-tight">{{ $issue->title }}</h1>
                        <span class="px-2 py-0.5 bg-yellow-500/10 text-yellow-500 text-[10px] font-bold rounded border border-yellow-500/20 uppercase">
                            {{ $issue->severity }}
                        </span>
                    </div>
                    
                    <div class="flex gap-3 mb-8">
                        <span class="px-3 py-1 bg-purple-500/10 text-purple-400 text-xs rounded-full border border-purple-500/20">
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
                        
                        <button @click="tab = 'technical'" 
                            :class="tab === 'technical' ? 'text-white border-b-2 border-blue-500' : 'text-zinc-500 hover:text-zinc-300'"
                            class="px-6 py-4 text-sm font-medium transition-all focus:outline-none">Technical Details</button>
                        
                        <button @click="tab = 'discussion'" 
                            :class="tab === 'discussion' ? 'text-white border-b-2 border-blue-500' : 'text-zinc-500 hover:text-zinc-300'"
                            class="px-6 py-4 text-sm font-medium transition-all focus:outline-none">Discussion</button>
                    </div>
                </div>

                <div class="p-8 min-h-[350px]">
                    <div x-show="tab === 'description'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 transform translate-y-2">
                        <p class="text-zinc-400 leading-relaxed text-base">
                            {{ $issue->description }}
                        </p>
                    </div>

                    <div x-show="tab === 'technical'" x-transition:enter="transition ease-out duration-200">
                        <div class="bg-black/30 p-5 rounded-lg border border-white/5 font-mono text-sm text-blue-300/80 whitespace-pre-line leading-relaxed">
                            {{ $issue->technical_details ?? 'No technical specifications provided for this issue.' }}
                        </div>
                    </div>

                    <div x-show="tab === 'discussion'" x-transition:enter="transition ease-out duration-200" class="flex flex-col items-center justify-center py-12">
                        <i class="fas fa-comments text-zinc-700 text-2xl mb-3"></i>
                        <p class="text-zinc-500 text-sm font-medium">No discussions yet</p>
                        <p class="text-zinc-600 text-xs mt-1">Be the first to comment on this issue.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="space-y-4">
            
            <div class="bg-[#0f0f0f] border border-white/10 rounded-xl p-6 shadow-sm">
                <h3 class="text-white text-sm font-medium mb-5">Assignee</h3>
                <div class="flex items-center gap-4 mb-6">
                    <div class="w-12 h-12 rounded-full bg-[#4f67d6] flex items-center justify-center text-white font-medium text-lg shadow-inner">
                        {{ strtoupper(substr($issue->user->first_name, 0, 1) . substr($issue->user->last_name, 0, 1)) }}
                    </div>
                    <div>
                        <p class="text-white text-base font-normal">{{ $issue->user->first_name }} {{ $issue->user->last_name }}</p>
                        <p class="text-zinc-500 text-xs">{{ ucfirst($issue->user->role) }}</p>
                    </div>
                </div>
                <button type="button" class="relative z-10 w-full py-2.5 bg-[#1a1a1a] hover:bg-[#252525] text-zinc-200 text-sm font-medium rounded-md border border-white/5 transition-colors cursor-pointer active:scale-[0.98]">
                    Change Assignee
                </button>
            </div>

            <div class="bg-[#0f0f0f] border border-white/10 rounded-xl p-6 shadow-sm">
                <h3 class="text-white text-sm font-medium mb-5 flex items-center gap-2">
                    <i class="far fa-clock text-zinc-500 text-xs"></i> Timeline
                </h3>
                <div class="space-y-5">
                    <div class="flex flex-col">
                        <span class="text-zinc-500 text-[10px] uppercase tracking-wider mb-1">Created</span>
                        <span class="text-zinc-200 text-sm font-mono tracking-tighter">{{ $issue->created_at->format('Y-m-d\TH:i:s\Z') }}</span>
                    </div>
                    <div class="flex flex-col">
                        <span class="text-zinc-500 text-[10px] uppercase tracking-wider mb-1">Last Updated</span>
                        <span class="text-zinc-200 text-sm font-mono tracking-tighter">{{ $issue->updated_at->format('Y-m-d\TH:i:s\Z') }}</span>
                    </div>
                </div>
            </div>

            <div class="bg-[#0f0f0f] border border-white/10 rounded-xl p-6 shadow-sm">
                <h3 class="text-white text-sm font-medium mb-5 flex items-center gap-2">
                    <i class="far fa-comment-alt text-zinc-500 text-xs"></i> Activity
                </h3>
                <div class="space-y-4">
                     <div class="border-b border-white/5 pb-3">
                         <p class="text-zinc-200 text-sm">created issue</p>
                         <p class="text-zinc-500 text-[10px]">by Sarah Chen</p>
                     </div>
                     <div class="border-b border-white/5 pb-3">
                         <p class="text-zinc-200 text-sm">changed status to in-progress</p>
                         <p class="text-zinc-500 text-[10px]">by Mike Davis</p>
                     </div>
                     <div class="pb-1">
                         <p class="text-zinc-200 text-sm">assigned to Sarah Chen</p>
                         <p class="text-zinc-500 text-[10px]">by Admin</p>
                     </div>
                </div>
            </div>

            <button type="button" class="relative z-10 w-full py-4 mt-2 bg-indigo-600/10 hover:bg-indigo-600 text-white font-semibold text-sm rounded-md transition-all flex items-center justify-center gap-2 border border-indigo-600/20 active:scale-[0.98] cursor-pointer group">
                <i class="fas fa-exclamation-triangle text-xs text-indigo-400 group-hover:text-white transition-colors"></i> 
                <span>Mark as Resolved</span>
            </button>
        </div>
    </div>
</div>
@endsection
@extends('layout')

@section('content')
    <div class="mb-8">
        <h2 class="text-3xl font-extrabold text-white tracking-tight">Team Members</h2>
        <p class="text-gray-500 mt-1 font-medium">Manage team workload, permissions, and track performance.</p>
    </div>

    <div class="bg-[#0f0f0f] border border-white/10 rounded-2xl overflow-hidden shadow-xl">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-[#1a1a1a] border-b border-white/5">
                        <th class="p-6 text-zinc-400 font-bold uppercase text-[11px] tracking-wider">Team Member</th>
                        <th class="p-6 text-zinc-400 font-bold uppercase text-[11px] tracking-wider">Role</th>
                        <th class="p-6 text-zinc-400 font-bold uppercase text-[11px] tracking-wider text-center">Active Bugs</th>
                        <th class="p-6 text-zinc-400 font-bold uppercase text-[11px] tracking-wider text-center">Resolved</th>
                        <th class="p-6 text-zinc-400 font-bold uppercase text-[11px] tracking-wider text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5">
                    @forelse($team as $member)
                        @php
                            // Bikin Inisial Nama (Misal: Sarah Chen -> SC)
                            $initials = strtoupper(substr($member->first_name, 0, 1) . substr($member->last_name, 0, 1));
                            
                            // Bikin warna Avatar acak tapi tetap sama untuk orang yang sama
                            $colors = ['bg-blue-600', 'bg-indigo-600', 'bg-purple-600', 'bg-teal-600', 'bg-orange-600', 'bg-rose-600'];
                            $avatarColor = $colors[$member->id % count($colors)];
                        @endphp

                        <tr x-data="{ showModal: false }" class="hover:bg-white/2 transition group">
                            <td class="p-6">
                                <div class="flex items-center gap-4">
                                    <div class="w-10 h-10 rounded-full {{ $avatarColor }} flex items-center justify-center text-white font-bold text-xs shadow-lg ring-2 ring-white/10">
                                        {{ $initials }}
                                    </div>
                                    <div>
                                        <span class="text-white font-semibold block">{{ $member->first_name }} {{ $member->last_name }}</span>
                                        <span class="text-zinc-500 text-xs">{{ $member->email }}</span>
                                    </div>
                                </div>
                            </td>
                            <td class="p-6 text-zinc-400 text-sm">
                                <span class="bg-white/5 border border-white/10 px-3 py-1 rounded-md text-xs font-medium">
                                    {{ ucfirst($member->role ?? 'Member') }}
                                </span>
                            </td>
                            <td class="p-6 text-center">
                                <span class="text-yellow-500 font-bold bg-yellow-500/10 px-3 py-1 rounded-full text-xs">
                                    {{ $member->in_progress_count }} Active
                                </span>
                            </td>
                            <td class="p-6 text-center">
                                <span class="text-green-500 font-bold bg-green-500/10 px-3 py-1 rounded-full text-xs">
                                    {{ $member->resolved_count }} Solved
                                </span>
                            </td>
                            <td class="p-6 text-right relative">
                                <button @click="showModal = true" class="text-indigo-400 hover:text-indigo-300 bg-indigo-500/10 hover:bg-indigo-500/20 px-4 py-2 rounded-xl text-xs font-bold transition">
                                    View Workload
                                </button>

                                <div x-show="showModal" style="display: none;" class="fixed inset-0 z-50 flex items-center justify-center overflow-y-auto overflow-x-hidden">
                                    <div x-show="showModal" 
                                         x-transition:enter="ease-out duration-300" 
                                         x-transition:enter-start="opacity-0" 
                                         x-transition:enter-end="opacity-100" 
                                         x-transition:leave="ease-in duration-200" 
                                         x-transition:leave-start="opacity-100" 
                                         x-transition:leave-end="opacity-0" 
                                         @click="showModal = false"
                                         class="fixed inset-0 bg-black/60 backdrop-blur-sm"></div>

                                    <div x-show="showModal"
                                         x-transition:enter="ease-out duration-300"
                                         x-transition:enter-start="opacity-0 translate-y-8 scale-95"
                                         x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                                         x-transition:leave="ease-in duration-200"
                                         x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                                         x-transition:leave-end="opacity-0 translate-y-8 scale-95"
                                         class="relative w-full max-w-lg bg-[#0f0f0f] border border-white/10 rounded-3xl shadow-2xl z-10 text-left overflow-hidden m-4">
                                        
                                        <div class="p-6 border-b border-white/5 flex justify-between items-start bg-[#1a1a1a]">
                                            <div class="flex items-center gap-4">
                                                <div class="w-14 h-14 rounded-full {{ $avatarColor }} flex items-center justify-center text-white font-bold text-lg ring-4 ring-black/20">
                                                    {{ $initials }}
                                                </div>
                                                <div>
                                                    <h3 class="text-xl font-bold text-white">{{ $member->first_name }} {{ $member->last_name }}</h3>
                                                    <p class="text-indigo-400 text-xs font-semibold uppercase tracking-wider">{{ ucfirst($member->role ?? 'Member') }}</p>
                                                </div>
                                            </div>
                                            <button @click="showModal = false" class="text-zinc-500 hover:text-white transition w-8 h-8 flex items-center justify-center bg-white/5 rounded-full hover:bg-white/10">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </div>

                                        <div class="grid grid-cols-3 divide-x divide-white/5 border-b border-white/5 bg-[#121212]">
                                            <div class="p-4 text-center">
                                                <p class="text-[10px] text-zinc-500 uppercase tracking-widest font-bold mb-1">Total Assigned</p>
                                                <p class="text-2xl font-black text-white">{{ $member->assigned_count }}</p>
                                            </div>
                                            <div class="p-4 text-center">
                                                <p class="text-[10px] text-zinc-500 uppercase tracking-widest font-bold mb-1">In Progress</p>
                                                <p class="text-2xl font-black text-yellow-500">{{ $member->in_progress_count }}</p>
                                            </div>
                                            <div class="p-4 text-center">
                                                <p class="text-[10px] text-zinc-500 uppercase tracking-widest font-bold mb-1">Resolved</p>
                                                <p class="text-2xl font-black text-green-500">{{ $member->resolved_count }}</p>
                                            </div>
                                        </div>

                                        <div class="p-6">
                                            <h4 class="text-sm font-bold text-white mb-4 flex items-center gap-2">
                                                <i class="fas fa-laptop-code text-indigo-500"></i> Currently Working On
                                            </h4>
                                            
                                            <div class="space-y-3">
                                                @forelse($member->issues as $issue)
                                                    <a href="{{ route('issues.show', $issue->issue_id) }}" class="block p-4 bg-[#1a1a1a] hover:bg-[#252525] border border-white/5 rounded-xl transition group/card">
                                                        <div class="flex justify-between items-start mb-2">
                                                            <p class="text-white text-sm font-semibold group-hover/card:text-indigo-400 transition">{{ Str::limit($issue->title, 40) }}</p>
                                                            <span class="text-[9px] px-2 py-0.5 rounded uppercase font-bold tracking-wider {{ $issue->status == 'open' ? 'bg-blue-500/10 text-blue-400' : 'bg-yellow-500/10 text-yellow-500' }}">
                                                                {{ $issue->status }}
                                                            </span>
                                                        </div>
                                                        <div class="flex gap-3 text-[11px] text-zinc-500 font-medium">
                                                            <span><i class="fas fa-hashtag text-zinc-600"></i> {{ $issue->issue_id }}</span>
                                                            <span>&bull;</span>
                                                            <span><i class="fas fa-folder text-zinc-600"></i> {{ $issue->category }}</span>
                                                        </div>
                                                    </a>
                                                @empty
                                                    <div class="text-center py-6 bg-white/2 rounded-xl border border-white/5 border-dashed">
                                                        <i class="fas fa-mug-hot text-2xl text-zinc-600 mb-2"></i>
                                                        <p class="text-sm text-zinc-400 font-medium">No active tasks. Free as a bird!</p>
                                                    </div>
                                                @endforelse
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                                </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="p-12 text-center text-zinc-500">
                                <div class="w-16 h-16 bg-[#1a1a1a] rounded-full flex items-center justify-center mx-auto mb-4 border border-white/5 shadow-inner">
                                    <i class="fas fa-users-slash text-2xl"></i>
                                </div>
                                <p class="text-sm font-medium">No team members found.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if($team->hasPages())
            <div class="p-4 border-t border-white/5 bg-[#1a1a1a]">
                {{ $team->links('components.pagination') }}
            </div>
        @endif
    </div>
@endsection
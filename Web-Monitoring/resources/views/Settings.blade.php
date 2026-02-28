@extends('layout')

@section('content')
    <div class="mb-8">
        <h2 class="text-3xl font-extrabold text-white tracking-tight">API Settings</h2>
        <p class="text-zinc-500 mt-1 font-medium">Manage Access Keys for your monitored projects.</p>
    </div>

    @if(session('success'))
        <div class="max-w-4xl mb-6 bg-green-500/10 border border-green-500/20 text-green-400 px-6 py-4 rounded-xl flex items-center gap-3 shadow-sm">
            <i class="fas fa-check-circle text-lg"></i>
            <span class="font-medium text-sm">{{ session('success') }}</span>
        </div>
    @endif

    <div x-data="{ showModal: false }" class="max-w-4xl space-y-8">
        
        <div class="bg-[#0f0f0f] border border-white/10 rounded-3xl p-8 sm:p-10 shadow-sm border-l-4 border-l-rose-500">
            
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8 gap-4">
                <div>
                    <h4 class="text-white font-bold text-xl flex items-center gap-3">
                        <i class="fas fa-key text-rose-500"></i> Project API Keys
                    </h4>
                    <p class="text-sm text-zinc-500 mt-1.5 max-w-lg leading-relaxed">
                        Generate separate keys for each website you want to monitor. Keep these keys secret!
                    </p>
                </div>
                <button type="button" @click="showModal = true" class="px-5 py-3 bg-rose-500/10 hover:bg-rose-500/20 border border-rose-500/20 text-rose-400 text-sm font-bold rounded-xl transition active:scale-95 flex items-center gap-2 shrink-0 shadow-inner">
                    <i class="fas fa-plus text-xs"></i> Generate New Key
                </button>
            </div>
            
            <div class="space-y-5">
                @forelse($apiKeys ?? [] as $key)
                    <div class="flex flex-col md:flex-row gap-5 p-6 bg-[#1a1a1a] border border-white/5 rounded-2xl hover:bg-[#252525] transition-colors shadow-inner group">
                        
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center gap-3 mb-3">
                                <span class="text-white font-bold text-base truncate group-hover:text-rose-400 transition">{{ $key->project_name }}</span>
                                <span class="px-2.5 py-0.5 bg-green-500/10 text-green-400 text-[10px] font-bold uppercase rounded border border-green-500/20 tracking-wider flex items-center gap-1.5 shrink-0">
                                    <span class="relative flex h-1.5 w-1.5">
                                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                                        <span class="relative inline-flex rounded-full h-1.5 w-1.5 bg-green-500"></span>
                                    </span>
                                    Active
                                </span>
                            </div>
                            <div class="flex items-center gap-3">
                                <input type="text" value="{{ $key->api_key }}" readonly id="apiKey-{{ $key->id }}" class="text-zinc-400 bg-[#0f0f0f] px-4 py-2.5 rounded-lg text-sm font-mono border border-white/5 flex-1 focus:outline-none selection:bg-rose-500/30 shadow-inner">
                                
                            <button onclick="let input = document.getElementById('apiKey-{{ $key->id }}'); input.select(); document.execCommand('copy'); alert('API Key Copied to Clipboard!');" class="text-zinc-400 hover:text-white transition p-3 bg-[#0f0f0f] rounded-lg hover:bg-white/5 border border-white/5 shadow-inner" title="Copy to clipboard">
                                <i class="far fa-copy text-sm"></i>
                            </button>
                            </div>
                        </div>

                        <div class="flex md:flex-col justify-end gap-3 border-t md:border-t-0 md:border-l border-white/5 pt-5 md:pt-0 md:pl-6">
                            <form action="{{ route('settings.api.regenerate', $key->id) }}" method="POST" onsubmit="return confirm('WARNING! The current API key will stop working immediately. Applications using this key must be updated. Proceed?');">
                                @csrf @method('PUT')
                                <button type="submit" class="w-full text-xs text-zinc-400 hover:text-white font-bold transition flex items-center justify-center md:justify-start gap-2.5 px-4 py-2 hover:bg-white/5 rounded-lg">
                                    <i class="fas fa-sync-alt w-4 text-center"></i> Regenerate
                                </button>
                            </form>
                            <form action="{{ route('settings.api.revoke', $key->id) }}" method="POST" onsubmit="return confirm('Are you absolutely sure you want to revoke and DELETE this API key? This action is irreversible!');">
                                @csrf @method('DELETE')
                                <button type="submit" class="w-full text-xs text-red-500 hover:text-red-400 font-bold transition flex items-center justify-center md:justify-start gap-2.5 px-4 py-2 hover:bg-red-500/5 rounded-lg">
                                    <i class="fas fa-trash-alt w-4 text-center"></i> Revoke Key
                                </button>
                            </form>
                        </div>
                    </div>
                @empty
                    <div class="text-center p-12 border-2 border-white/5 border-dashed rounded-2xl bg-[#1a1a1a]">
                        <div class="w-20 h-20 bg-[#0f0f0f] rounded-full flex items-center justify-center mx-auto mb-5 border border-white/5 shadow-inner">
                            <i class="fas fa-key text-3xl text-zinc-600"></i>
                        </div>
                        <h3 class="text-lg font-bold text-white mb-2">No API Keys Found</h3>
                        <p class="text-sm text-zinc-400 font-medium max-w-sm mx-auto leading-relaxed">
                            You haven't generated any Access Keys yet. Click the "Generate New Key" button to start monitoring your projects.
                        </p>
                    </div>
                @endforelse
            </div>
        </div>

        <div x-show="showModal" style="display: none;" class="fixed inset-0 z-50 flex items-center justify-center">
            <div x-show="showModal" 
                 x-transition.opacity.duration.300ms 
                 @click="showModal = false" 
                 class="fixed inset-0 bg-black/70 backdrop-blur-sm"></div>
            
            <div x-show="showModal" 
                 x-transition:enter="ease-out duration-300"
                 x-transition:enter-start="opacity-0 translate-y-8 scale-95"
                 x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                 x-transition:leave="ease-in duration-200"
                 x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                 x-transition:leave-end="opacity-0 translate-y-8 scale-95"
                 class="relative w-full max-w-md bg-[#0f0f0f] border border-white/10 rounded-3xl shadow-2xl z-10 m-4 overflow-hidden">
                
                <div class="p-6 border-b border-white/5 bg-[#1a1a1a]">
                    <h3 class="text-xl font-bold text-white flex items-center gap-3">
                        <i class="fas fa-plus-circle text-rose-500"></i> Generate New Key
                    </h3>
                </div>

                <form action="{{ route('settings.api.generate') }}" method="POST">
                    @csrf
                    <div class="p-8 space-y-6">
                        <p class="text-sm text-zinc-400 leading-relaxed">
                            Enter a recognizable name for the project or website you want to monitor (e.g., "Main E-Commerce Site"). We will generate a unique key for it.
                        </p>
                        <div>
                            <label class="block text-xs font-bold text-zinc-400 mb-2 uppercase tracking-wider">Project Name</label>
                            <input type="text" name="project_name" required placeholder="e.g., Customer Portal App" 
                                class="w-full bg-[#1a1a1a] border border-white/10 text-white px-4 py-3.5 rounded-xl focus:ring-2 focus:ring-rose-500 outline-none transition placeholder:text-zinc-600 shadow-inner text-sm">
                        </div>
                    </div>

                    <div class="p-6 border-t border-white/5 bg-[#1a1a1a] flex justify-end gap-3">
                        <button type="button" @click="showModal = false" class="px-6 py-3.5 text-sm font-bold text-zinc-400 hover:text-white transition rounded-xl hover:bg-white/5">
                            Cancel
                        </button>
                        <button type="submit" class="px-7 py-3.5 bg-rose-600 hover:bg-rose-500 text-white text-sm font-bold rounded-xl transition shadow-lg shadow-rose-500/20 active:scale-95 flex items-center gap-2">
                            <i class="fas fa-check"></i> Generate
                        </button>
                    </div>
                </form>
            </div>
        </div>
        
    </div>
@endsection
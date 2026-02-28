@extends('layout')

@section('content')
    <div class="mb-8">
        <h2 class="text-3xl font-extrabold text-white tracking-tight">Report New Bug</h2>
        <p class="text-gray-500 mt-1 font-medium">Please provide detailed information to help our developers fix the issue faster.</p>
    </div>

    <div class="max-w-3xl">
        <form action="{{ route('issues.store') }}" method="POST" class="bg-dark-card border border-dark-border rounded-3xl overflow-hidden shadow-2xl">
            @csrf
            
            <div class="p-8 space-y-6">
                <div>
                    <label class="block text-sm font-bold text-gray-400 mb-2 uppercase tracking-wide">Issue Title</label>
                    <input type="text" name="title" required placeholder="e.g., Checkout button not working on iOS" 
                        class="w-full bg-[#1a1a1a] border border-white/10 text-white px-4 py-3.5 rounded-xl focus:ring-2 focus:ring-indigo-500 outline-none transition placeholder:text-zinc-600 shadow-inner">
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div x-data="{ open: false, selected: 'Frontend' }" class="relative">
                        <label class="block text-sm font-bold text-gray-400 mb-2 uppercase tracking-wide">Category</label>
                        
                        <input type="hidden" name="category" :value="selected">
                        
                        <button type="button" @click="open = !open" @click.away="open = false"
                            class="w-full bg-[#1a1a1a] border border-white/10 text-white px-4 py-3.5 rounded-xl flex justify-between items-center focus:ring-2 focus:ring-indigo-500 transition shadow-inner">
                            <span x-text="selected"></span>
                            <i class="fas fa-chevron-down text-xs transition-transform" :class="open ? 'rotate-180' : ''"></i>
                        </button>
                        
                        <div x-show="open" style="display: none;"
                            x-transition.opacity.duration.100ms
                            class="absolute z-50 w-full mt-2 bg-[#1a1a1a] border border-white/10 rounded-xl shadow-2xl overflow-hidden py-1">
                            <template x-for="item in ['Frontend', 'Backend', 'Database', 'Security', 'Performance', 'Network']" :key="item">
                                <div @click="selected = item; open = false" 
                                    class="px-4 py-2.5 text-sm transition-colors cursor-pointer flex items-center justify-between"
                                    :class="selected === item ? 'bg-indigo-500/20 text-indigo-400 font-bold' : 'text-zinc-400 hover:bg-white/5 hover:text-white'">
                                    <span x-text="item"></span>
                                    <i x-show="selected === item" class="fas fa-check text-[10px]"></i>
                                </div>
                            </template>
                        </div>
                    </div>

                    <div x-data="{ open: false, selected: 'Critical', color: 'text-red-500' }" class="relative">
                        <label class="block text-sm font-bold text-gray-400 mb-2 uppercase tracking-wide">Severity Level</label>
                        
                        <input type="hidden" name="severity" :value="selected">

                        <button type="button" @click="open = !open" @click.away="open = false"
                            class="w-full bg-[#1a1a1a] border border-white/10 px-4 py-3.5 rounded-xl flex justify-between items-center focus:ring-2 focus:ring-indigo-500 transition shadow-inner">
                            <span :class="color" class="font-bold tracking-wider uppercase text-xs" x-text="selected"></span>
                            <i class="fas fa-chevron-down text-xs text-zinc-500 transition-transform" :class="open ? 'rotate-180' : ''"></i>
                        </button>
                        
                        <div x-show="open" style="display: none;"
                            x-transition.opacity.duration.100ms
                            class="absolute z-50 w-full mt-2 bg-[#1a1a1a] border border-white/10 rounded-xl shadow-2xl overflow-hidden py-1">
                            <div @click="selected = 'Critical'; color = 'text-red-500'; open = false" class="px-4 py-2.5 text-xs text-red-500 font-bold hover:bg-white/5 cursor-pointer uppercase tracking-wider">Critical</div>
                            <div @click="selected = 'High'; color = 'text-yellow-500'; open = false" class="px-4 py-2.5  text-yellow-500 font-bold hover:bg-white/5 cursor-pointer uppercase tracking-wider text-xs">High</div>
                            <div @click="selected = 'Medium'; color = 'text-blue-500'; open = false" class="px-4 py-2.5 text-blue-500 font-bold hover:bg-white/5 cursor-pointer uppercase tracking-wider text-xs">Medium</div>
                            <div @click="selected = 'Low'; color = 'text-green-500'; open = false" class="px-4 py-2.5 text-green-500 font-bold hover:bg-white/5 cursor-pointer uppercase tracking-wider text-xs">Low</div>
                        </div>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-400 mb-2 uppercase tracking-wide">Description</label>
                    <textarea name="description" required rows="4" placeholder="Explain what happened and what you expected to see..." 
                        class="w-full bg-[#1a1a1a] border border-white/10 text-white px-4 py-3.5 rounded-xl focus:ring-2 focus:ring-indigo-500 outline-none transition placeholder:text-zinc-600 shadow-inner"></textarea>
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-400 mb-2 uppercase tracking-wide">Technical Details <span class="text-zinc-600 font-normal lowercase tracking-normal">(Optional)</span></label>
                    <textarea name="technical_details" rows="3" placeholder="Stack trace, file location, or specific error codes..." 
                        class="w-full bg-[#1a1a1a] border border-white/10 text-zinc-300 px-4 py-3.5 rounded-xl focus:ring-2 focus:ring-indigo-500 outline-none transition font-mono text-sm placeholder:text-zinc-600 shadow-inner"></textarea>
                </div>
            </div>

            <div class="p-8 bg-[#1a1a1a]/50 border-t border-white/5 flex gap-4">
                <button type="submit" class="flex-1 py-4 bg-indigo-600 hover:bg-indigo-500 text-white font-bold rounded-2xl transition shadow-lg shadow-indigo-500/20 active:scale-95 flex justify-center items-center gap-2">
                    <i class="fas fa-paper-plane"></i> Submit Bug Report
                </button>
                <a href="{{ route('dashboard') }}" class="px-8 py-4 bg-[#252525] hover:bg-[#303030] text-zinc-300 font-bold rounded-2xl transition text-center border border-white/5 active:scale-95">
                    Cancel
                </a>
            </div>
            
        </form>
    </div>
@endsection
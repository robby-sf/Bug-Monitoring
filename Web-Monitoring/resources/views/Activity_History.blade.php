@extends('layout')

@section('content')
    <div class="mb-10 flex justify-between items-end">
        <div>
            <h2 class="text-3xl font-extrabold text-white tracking-tight">Activity History</h2>
            <p class="text-gray-500 mt-1 font-medium">Tracking every move, update, and fix across your workspace.</p>
        </div>
        <div class="flex gap-3">
            <button class="px-5 py-2.5 bg-dark-card border border-dark-border text-gray-400 hover:text-white rounded-xl transition flex items-center gap-2 text-sm font-bold">
                <i class="fas fa-download"></i> Export Log
            </button>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8">
        <div class="md:col-span-2 relative group">
            <i class="fas fa-search absolute left-4 top-1/2 -translate-y-1/2 text-gray-600 group-focus-within:text-blue-500 transition"></i>
            <input type="text" placeholder="Search activities..." 
                class="w-full bg-dark-card border border-dark-border text-white pl-12 pr-4 py-3 rounded-2xl focus:ring-2 focus:ring-blue-500 outline-none transition placeholder:text-gray-700">
        </div>

        <div x-data="{ open: false, selected: 'All Types' }" class="relative">
            <button type="button" @click="open = !open" @click.away="open = false"
                class="w-full bg-dark-card border border-dark-border text-gray-400 px-4 py-3 rounded-2xl flex justify-between items-center focus:ring-2 focus:ring-blue-500 transition shadow-sm">
                <span x-text="selected" :class="selected !== 'All Types' ? 'text-white' : ''"></span>
                <i class="fas fa-chevron-down text-xs transition-transform duration-300" :class="open ? 'rotate-180' : ''"></i>
            </button>
            
            <div x-show="open" x-transition:enter="transition ease-out duration-200" 
                x-transition:enter-start="opacity-0 scale-95" 
                x-transition:enter-end="opacity-100 scale-100"
                class="absolute z-50 w-full mt-2 bg-dark-card/90 backdrop-blur-xl border border-white/10 rounded-2xl shadow-2xl overflow-hidden shadow-blue-500/10">
                <template x-for="item in ['All Types', 'Issue Updates', 'Project Changes', 'Team Management']">
                    <div @click="selected = item; open = false" 
                        class="px-4 py-3 text-sm text-gray-400 hover:bg-blue-600 hover:text-white cursor-pointer transition-colors"
                        :class="selected === item ? 'bg-blue-600/20 text-blue-400 font-bold' : ''">
                        <span x-text="item"></span>
                    </div>
                </template>
            </div>
        </div>

        <div x-data="{ open: false, selected: 'Newest First' }" class="relative">
            <button type="button" @click="open = !open" @click.away="open = false"
                class="w-full bg-dark-card border border-dark-border text-gray-400 px-4 py-3 rounded-2xl flex justify-between items-center focus:ring-2 focus:ring-blue-500 transition shadow-sm">
                <span x-text="selected" class="text-white"></span>
                <i class="fas fa-chevron-down text-xs transition-transform duration-300" :class="open ? 'rotate-180' : ''"></i>
            </button>
            
            <div x-show="open" x-transition:enter="transition ease-out duration-200" 
                class="absolute z-50 w-full mt-2 bg-dark-card/90 backdrop-blur-xl border border-white/10 rounded-2xl shadow-2xl overflow-hidden shadow-blue-500/10">
                <template x-for="order in ['Newest First', 'Oldest First']">
                    <div @click="selected = order; open = false" 
                        class="px-4 py-3 text-sm text-gray-400 hover:bg-blue-600 hover:text-white cursor-pointer transition-colors"
                        :class="selected === order ? 'bg-blue-600/20 text-blue-400 font-bold' : ''">
                        <span x-text="order"></span>
                    </div>
                </template>
            </div>
        </div>
    </div>

    <div class="relative">
        <div class="absolute left-27px top-0 bottom-0 w-px bg-linear-to-b from-blue-500/50 via-gray-800 to-transparent"></div>

        <div class="space-y-12">
            <div class="relative">
                <h3 class="text-xs font-black text-gray-600 uppercase tracking-[0.2em] mb-8 pl-14">Today</h3>
                
                <div class="space-y-8">
                    <div class="relative pl-14 group">
                        <div class="absolute left-0 w-14 h-14 flex items-center justify-center">
                            <div class="w-4 h-4 bg-blue-500 rounded-full border-4 border-dark-bg z-10 shadow-[0_0_15px_rgba(59,130,246,0.5)]"></div>
                        </div>
                        <div class="bg-dark-card border border-dark-border p-6 rounded-3xl group-hover:border-blue-500/30 transition-all duration-300">
                            <div class="flex justify-between items-start mb-2">
                                <p class="text-white font-bold">Issue #402 Created</p>
                                <span class="text-[10px] text-gray-600 font-black">10:30 AM</span>
                            </div>
                            <p class="text-sm text-gray-500 leading-relaxed">Sarah Chen created a new ticket: <span class="text-blue-400 italic">"Login button unresponsive on iOS Safari"</span> in Project Frontend.</p>
                            <div class="mt-4 flex items-center gap-2">
                                <div class="w-6 h-6 rounded-full bg-blue-600 flex items-center justify-center text-[8px] font-bold text-white">SC</div>
                                <span class="text-[11px] text-gray-600">Sarah Chen • Frontend Lead</span>
                            </div>
                        </div>
                    </div>

                    <div class="relative pl-14 group">
                        <div class="absolute left-0 w-14 h-14 flex items-center justify-center">
                            <div class="w-4 h-4 bg-green-500 rounded-full border-4 border-dark-bg z-10 shadow-[0_0_15px_rgba(34,197,94,0.3)]"></div>
                        </div>
                        <div class="bg-dark-card border border-dark-border p-6 rounded-3xl group-hover:border-green-500/30 transition">
                            <div class="flex justify-between items-start mb-2">
                                <p class="text-white font-bold">Critical Bug Resolved</p>
                                <span class="text-[10px] text-gray-600 font-black">08:15 AM</span>
                            </div>
                            <p class="text-sm text-gray-500 leading-relaxed">Mike Davis marked <span class="text-green-500 font-semibold">#388 Database Timeout</span> as resolved after implementing connection pooling.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="relative">
                <h3 class="text-xs font-black text-gray-600 uppercase tracking-[0.2em] mb-8 pl-14">Yesterday</h3>
                
                <div class="relative pl-14 group">
                    <div class="absolute left-0 w-14 h-14 flex items-center justify-center">
                        <div class="w-4 h-4 bg-purple-500 rounded-full border-4 border-dark-bg z-10"></div>
                    </div>
                    <div class="bg-dark-card border border-dark-border p-6 rounded-3xl group-hover:border-purple-500/30 transition">
                        <div class="flex justify-between items-start mb-2">
                            <p class="text-white font-bold">New Team Member Joined</p>
                            <span class="text-[10px] text-gray-600 font-black">04:20 PM</span>
                        </div>
                        <p class="text-sm text-gray-500 italic">"Lisa Zhang has been added to the workspace as QA Engineer by Admin."</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-12 text-center">
        <button class="px-8 py-3 bg-gray-800 hover:bg-gray-700 text-gray-400 hover:text-white font-bold text-xs rounded-2xl transition uppercase tracking-widest">
            Load Older Activities
        </button>
    </div>
@endsection
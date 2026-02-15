@extends('layout')

@section('content')
    <div class="mb-8">
        <div class="flex items-center gap-4 mb-2">
            <a href="/team" class="text-gray-500 hover:text-white transition">
                <i class="fas fa-arrow-left"></i>
            </a>
            <h2 class="text-3xl font-extrabold text-white tracking-tight">Edit Member</h2>
        </div>
        <p class="text-gray-500 font-medium pl-8">Update permissions and profile details for Sarah Chen.</p>
    </div>

    <div class="max-w-3xl">
        <form action="#" method="POST" class="bg-dark-card border border-dark-border rounded-3xl overflow-hidden shadow-2xl">
            @csrf
            <div class="p-8 space-y-8">
                
                <div class="flex items-center gap-6 p-6 bg-white/2 rounded-2xl border border-white/5">
                    <div class="w-20 h-20 rounded-full bg-blue-600 flex items-center justify-center text-white text-2xl font-bold shadow-lg shadow-blue-600/20">
                        SC
                    </div>
                    <div>
                        <h4 class="text-xl text-white font-bold">Sarah Chen</h4>
                        <p class="text-sm text-gray-500 uppercase tracking-widest font-semibold mt-1">Member since Nov 2025</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-bold text-gray-400 mb-2 uppercase tracking-wide">Full Name</label>
                        <input type="text" value="Sarah Chen" 
                            class="w-full bg-dark-bg border border-dark-border text-white px-4 py-3.5 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none transition">
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-400 mb-2 uppercase tracking-wide">Email Address</label>
                        <input type="email" value="sarah@bughunter.dev" 
                            class="w-full bg-dark-bg border border-dark-border text-white px-4 py-3.5 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none transition">
                    </div>

                    <div x-data="{ open: false, selected: 'Frontend Lead' }" class="relative">
                        <label class="block text-sm font-bold text-gray-400 mb-2 uppercase tracking-wide">Role</label>
                        <button type="button" @click="open = !open" @click.away="open = false"
                            class="w-full bg-dark-bg border border-dark-border text-white px-4 py-3.5 rounded-xl flex justify-between items-center focus:ring-2 focus:ring-blue-500 transition">
                            <span x-text="selected"></span>
                            <i class="fas fa-chevron-down text-xs transition-transform" :class="open ? 'rotate-180' : ''"></i>
                        </button>
                        <div x-show="open" x-transition 
                            class="absolute z-50 w-full mt-2 bg-dark-card/90 backdrop-blur-xl border border-white/10 rounded-2xl shadow-2xl overflow-hidden">
                            <template x-for="role in ['Frontend Lead', 'Backend Engineer', 'Full Stack', 'QA Engineer', 'DevOps']">
                                <div @click="selected = role; open = false" 
                                    class="px-4 py-3 text-sm text-gray-300 hover:bg-blue-600 hover:text-white cursor-pointer transition-colors"
                                    :class="selected === role ? 'bg-blue-600/20 text-blue-400' : ''">
                                    <span x-text="role"></span>
                                </div>
                            </template>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-400 mb-2 uppercase tracking-wide">Access Level</label>
                        <select class="w-full bg-dark-bg border border-dark-border text-white px-4 py-3.5 rounded-xl outline-none focus:ring-2 focus:ring-blue-500 transition">
                            <option>Admin</option>
                            <option selected>Editor</option>
                            <option>Viewer</option>
                        </select>
                    </div>
                </div>

                <div class="flex items-center justify-between p-4 bg-white/2 rounded-xl border border-white/5">
                    <div>
                        <p class="text-white font-bold text-sm">Account Status</p>
                        <p class="text-xs text-gray-500 mt-1">If deactivated, the user will lose all access immediately.</p>
                    </div>
                    <div x-data="{ active: true }" 
                        @click="active = !active"
                        class="w-12 h-6 flex items-center bg-gray-700 rounded-full p-1 cursor-pointer transition-colors duration-300"
                        :class="active ? 'bg-green-500' : 'bg-gray-700'">
                        <div class="bg-white w-4 h-4 rounded-full shadow-md transform transition-transform duration-300"
                             :class="active ? 'translate-x-6' : ''"></div>
                    </div>
                </div>
            </div>

            <div class="p-8 bg-white/2 border-t border-dark-border flex gap-4">
                <button type="submit" class="flex-1 py-4 bg-blue-600 hover:bg-blue-500 text-white font-bold rounded-2xl transition shadow-lg shadow-blue-500/20 active:scale-95">
                    Save Changes
                </button>
                <a href="/team" class="px-8 py-4 bg-gray-800 hover:bg-gray-700 text-gray-400 font-bold rounded-2xl transition text-center">
                    Cancel
                </a>
            </div>
        </form>

        <div class="mt-8 p-6 border border-red-500/20 bg-red-500/5 rounded-3xl flex items-center justify-between">
            <div>
                <h5 class="text-red-500 font-bold">Remove from Team</h5>
                <p class="text-xs text-gray-500 mt-1">This action is permanent and cannot be undone.</p>
            </div>
            <button class="px-6 py-2.5 bg-red-600/10 hover:bg-red-600 text-red-500 hover:text-white text-sm font-bold rounded-xl transition border border-red-500/20">
                Remove Member
            </button>
        </div>
    </div>
@endsection
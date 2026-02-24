@extends('layout')

@section('content')
    <div class="mb-8">
        <h2 class="text-3xl font-extrabold text-white tracking-tight">My Profile</h2>
        <p class="text-gray-500 mt-1 font-medium">Manage your personal information and security settings.</p>
    </div>

    <div class="max-w-4xl grid grid-cols-1 md:grid-cols-[200px_1fr] gap-8">
        <nav class="space-y-2">
            <a href="#general" class="flex items-center gap-3 p-3 text-blue-500 bg-blue-500/10 rounded-xl font-bold transition">
                <i class="fas fa-user text-sm"></i> General
            </a>
            <a href="#security" class="flex items-center gap-3 p-3 text-gray-400 hover:bg-white/5 hover:text-white rounded-xl transition">
                <i class="fas fa-lock text-sm"></i> Security
            </a>
            <a href="#api-keys" class="flex items-center gap-3 p-3 text-gray-400 hover:bg-white/5 hover:text-white rounded-xl transition">
                <i class="fas fa-key text-sm"></i> API Access
            </a>
            <a href="#integrations" class="flex items-center gap-3 p-3 text-gray-400 hover:bg-white/5 hover:text-white rounded-xl transition">
                <i class="fas fa-puzzle-piece text-sm"></i> Integrations
            </a>
        </nav>

        <div class="space-y-8">
            <div id="general" class="bg-dark-card border border-dark-border rounded-2xl p-8 shadow-sm">
                <h4 class="text-white font-bold text-lg mb-6 flex items-center gap-2">
                    <i class="fas fa-user-gear text-blue-500"></i> General Information
                </h4>
                <div class="space-y-6">
                    <div class="flex items-center gap-6">
                        <div class="w-24 h-24 rounded-full bg-gradient-to-br from-blue-600 to-indigo-700 flex items-center justify-center text-white text-3xl font-bold shadow-lg shadow-blue-900/20 flex-shrink-0">
                            R
                        </div>
                        <div>
                            <p class="text-gray-400 text-sm mb-2">Update your profile picture</p>
                            <div class="flex gap-3">
                                <button class="px-5 py-2.5 bg-blue-600 hover:bg-blue-500 text-white text-sm font-bold rounded-xl transition active:scale-95">
                                    Upload New Photo
                                </button>
                                <button class="px-5 py-2.5 bg-gray-800 hover:bg-gray-700 text-gray-400 text-sm font-bold rounded-xl transition">
                                    Remove
                                </button>
                            </div>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-400 mb-2">Full Name</label>
                        <input type="text" value="Robby Developer" 
                            class="w-full bg-dark-bg border border-dark-border text-white px-4 py-3 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none transition">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-400 mb-2">Email Address</label>
                        <input type="email" value="robby@bughunter.dev" disabled
                            class="w-full bg-dark-bg border border-dark-border text-gray-500 px-4 py-3 rounded-xl cursor-not-allowed">
                        <p class="text-xs text-gray-600 mt-1">Contact support to change your email.</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-400 mb-2">Role</label>
                        <input type="text" value="Administrator" disabled
                            class="w-full bg-dark-bg border border-dark-border text-gray-500 px-4 py-3 rounded-xl cursor-not-allowed">
                    </div>

                    <div class="pt-2">
                        <button class="px-6 py-3 bg-blue-600 hover:bg-blue-500 text-white font-bold rounded-xl transition shadow-lg shadow-blue-500/20 active:scale-95">
                            Save General Changes
                        </button>
                    </div>
                </div>
            </div>

            <div id="security" class="bg-dark-card border border-dark-border rounded-2xl p-8 shadow-sm">
                <h4 class="text-white font-bold text-lg mb-6 flex items-center gap-2">
                    <i class="fas fa-shield-alt text-blue-500"></i> Security
                </h4>
                <div class="space-y-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-400 mb-2">Current Password</label>
                        <input type="password" placeholder="Enter your current password" 
                            class="w-full bg-dark-bg border border-dark-border text-white px-4 py-3 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none transition placeholder:text-gray-700">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-400 mb-2">New Password</label>
                        <input type="password" placeholder="Enter a new password" 
                            class="w-full bg-dark-bg border border-dark-border text-white px-4 py-3 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none transition placeholder:text-gray-700">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-400 mb-2">Confirm New Password</label>
                        <input type="password" placeholder="Confirm your new password" 
                            class="w-full bg-dark-bg border border-dark-border text-white px-4 py-3 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none transition placeholder:text-gray-700">
                    </div>
                    <div class="pt-2">
                        <button class="px-6 py-3 bg-blue-600 hover:bg-blue-500 text-white font-bold rounded-xl transition shadow-lg shadow-blue-500/20 active:scale-95">
                            Update Password
                        </button>
                    </div>
                </div>
            </div>

            <div id="api-keys" class="bg-dark-card border border-dark-border rounded-2xl p-8 shadow-sm border-l-4 border-l-red-500/30">
                <div class="flex justify-between items-center mb-6">
                    <h4 class="text-white font-bold text-lg flex items-center gap-2">
                        <i class="fas fa-key text-blue-500"></i> API Keys
                    </h4>
                </div>
                <div class="space-y-4">
                    <div class="flex gap-2">
                        <div class="flex-1 bg-dark-bg border border-dark-border text-gray-400 px-4 py-3 rounded-xl font-mono text-sm flex items-center justify-between">
                            <span>sk_live_51Aa7 ... Q8Q</span>
                            <button class="text-blue-500 hover:text-blue-400 text-xs font-bold uppercase tracking-tighter">Regenerate</button>
                        </div>
                    </div>
                    <button class="w-full py-3 bg-gray-800 hover:bg-gray-700 text-white font-bold rounded-xl transition">
                        <i class="fas fa-plus mr-2 text-xs"></i> Create New API Key
                    </button>
                </div>
            </div>

            <div id="integrations" class="bg-dark-card border border-dark-border rounded-2xl p-8 shadow-sm">
                <h4 class="text-white font-bold text-lg mb-6 flex items-center gap-2">
                    <i class="fas fa-puzzle-piece text-blue-500"></i> Integrations
                </h4>
                <div class="space-y-4">
                    <div class="flex items-center justify-between p-4 bg-dark-bg border border-dark-border rounded-xl">
                        <div class="flex items-center gap-4">
                            <i class="fab fa-github text-xl text-white"></i>
                            <div>
                                <p class="text-white font-medium">GitHub</p>
                                <p class="text-xs text-gray-500">Connect to track issues on your repositories.</p>
                            </div>
                        </div>
                        <button class="px-4 py-2 bg-blue-600 hover:bg-blue-500 text-white text-sm font-bold rounded-lg transition">Connect</button>
                    </div>
                    <div class="flex items-center justify-between p-4 bg-dark-bg border border-dark-border rounded-xl">
                        <div class="flex items-center gap-4">
                            <i class="fab fa-slack text-xl text-white"></i>
                            <div>
                                <p class="text-white font-medium">Slack</p>
                                <p class="text-xs text-gray-500">Get real-time notifications in your Slack channels.</p>
                            </div>
                        </div>
                        <button class="px-4 py-2 bg-blue-600 hover:bg-blue-500 text-white text-sm font-bold rounded-lg transition">Connect</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
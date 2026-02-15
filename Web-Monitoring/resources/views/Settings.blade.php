@extends('layout')

@section('content')
    <div class="mb-8">
        <h2 class="text-3xl font-extrabold text-white tracking-tight">Settings</h2>
        <p class="text-gray-500 mt-1 font-medium">Manage your account and system settings.</p>
    </div>

    <div class="max-w-4xl space-y-8">
        
        <div class="bg-dark-card border border-dark-border rounded-2xl p-8 shadow-sm">
            <h4 class="text-white font-bold text-lg mb-6 flex items-center gap-2">
                <i class="fas fa-user-gear text-accent-blue"></i> General Settings
            </h4>
            <div class="space-y-6">
                <div>
                    <label class="block text-sm font-medium text-gray-400 mb-2">Organization Name</label>
                    <input type="text" value="BugHunter" 
                        class="w-full bg-dark-bg border border-dark-border text-white px-4 py-3 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none transition">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-400 mb-2">Admin Email</label>
                    <input type="email" value="admin@bughunter.dev" 
                        class="w-full bg-dark-bg border border-dark-border text-white px-4 py-3 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none transition">
                </div>
                <div class="pt-2">
                    <button class="px-6 py-3 bg-blue-600 hover:bg-blue-500 text-white font-bold rounded-xl transition shadow-lg shadow-blue-500/20">
                        Save Changes
                    </button>
                </div>
            </div>
        </div>

        <div class="bg-dark-card border border-dark-border rounded-2xl p-8 shadow-sm">
            <h4 class="text-white font-bold text-lg mb-6 flex items-center gap-2">
                <i class="fas fa-bell text-accent-blue"></i> Notifications
            </h4>
            <div class="space-y-4">
                <label class="flex items-center gap-4 p-4 hover:bg-white/5 rounded-xl cursor-pointer transition">
                    <input type="checkbox" checked class="w-5 h-5 accent-blue-600">
                    <div>
                        <p class="text-white font-medium">Email notifications for critical issues</p>
                        <p class="text-xs text-gray-500 mt-0.5">Receive immediate alerts for priority bugs.</p>
                    </div>
                </label>
                <label class="flex items-center gap-4 p-4 hover:bg-white/5 rounded-xl cursor-pointer transition">
                    <input type="checkbox" checked class="w-5 h-5 accent-blue-600">
                    <div>
                        <p class="text-white font-medium">Daily digest of new issues</p>
                        <p class="text-xs text-gray-500 mt-0.5">A summary of activity sent every morning.</p>
                    </div>
                </label>
                <label class="flex items-center gap-4 p-4 hover:bg-white/5 rounded-xl cursor-pointer transition">
                    <input type="checkbox" class="w-5 h-5 accent-blue-600">
                    <div>
                        <p class="text-white font-medium">Slack notifications</p>
                        <p class="text-xs text-gray-500 mt-0.5">Connect and send alerts to your workspace.</p>
                    </div>
                </label>
            </div>
        </div>

        <div class="bg-dark-card border border-dark-border rounded-2xl p-8 shadow-sm border-l-4 border-l-red-500/30">
            <div class="flex justify-between items-center mb-6">
                <h4 class="text-white font-bold text-lg flex items-center gap-2">
                    <i class="fas fa-key text-accent-blue"></i> API Keys
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

    </div>
@endsection
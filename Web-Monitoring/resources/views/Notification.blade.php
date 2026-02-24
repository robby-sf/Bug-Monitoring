@extends('layout')

@section('content')
    <div class="mb-8 flex justify-between items-end">
        <div>
            <h2 class="text-3xl font-extrabold text-white tracking-tight">All Notifications</h2>
            <p class="text-gray-500 mt-1 font-medium">Keep track of every activity in your workspace.</p>
        </div>
        <button class="text-sm font-bold text-accent-blue hover:underline bg-accent-blue/10 px-4 py-2 rounded-xl transition">
            Mark all as read
        </button>
    </div>

    <div class="bg-dark-card border border-dark-border rounded-2xl overflow-hidden shadow-xl">
        <div class="divide-y divide-dark-border">
            
            <div class="p-6 flex gap-6 hover:bg-white/[0.02] transition bg-blue-500/[0.02] border-l-4 border-l-red-500">
                <div class="w-12 h-12 rounded-2xl bg-red-500/10 text-red-500 flex items-center justify-center flex-shrink-0 shadow-lg">
                    <i class="fas fa-bolt text-lg"></i>
                </div>
                <div class="flex-1">
                    <div class="flex justify-between items-start">
                        <div>
                            <h4 class="text-white font-bold text-sm">Critical System Alert</h4>
                            <p class="text-gray-400 text-sm mt-1 leading-relaxed">
                                Database connection timeout detected on <span class="text-red-400 font-mono italic">Production_Gateway_01</span>. 
                                High latency reported by 85% of users.
                            </p>
                        </div>
                        <span class="text-[10px] font-bold text-gray-600 uppercase">2 mins ago</span>
                    </div>
                    <div class="mt-4 flex gap-3">
                        <a href="/issues" class="px-4 py-1.5 bg-red-500/20 text-red-400 text-xs font-bold rounded-lg hover:bg-red-500/30 transition">Investigate</a>
                        <button class="px-4 py-1.5 bg-gray-800 text-gray-400 text-xs font-bold rounded-lg hover:text-white transition">Dismiss</button>
                    </div>
                </div>
            </div>

            <div class="p-6 flex gap-6 hover:bg-white/[0.02] transition">
                <div class="w-12 h-12 rounded-2xl bg-accent-blue/10 text-accent-blue flex items-center justify-center flex-shrink-0 font-bold shadow-lg text-sm">
                    SC
                </div>
                <div class="flex-1">
                    <div class="flex justify-between items-start">
                        <div>
                            <h4 class="text-white font-bold text-sm">Comment on Ticket #402</h4>
                            <p class="text-gray-400 text-sm mt-1">
                                <span class="text-white font-semibold">Sarah Chen</span> mentioned you: "Robby, can you check the API logs for this issue? I think it's a CORS policy error."
                            </p>
                        </div>
                        <span class="text-[10px] font-bold text-gray-600 uppercase">45 mins ago</span>
                    </div>
                    <div class="mt-4">
                        <a href="/issues" class="text-accent-blue text-xs font-bold hover:underline">Reply to Comment</a>
                    </div>
                </div>
            </div>

            <div class="p-6 flex gap-6 hover:bg-white/[0.02] transition">
                <div class="w-12 h-12 rounded-2xl bg-green-500/10 text-green-500 flex items-center justify-center flex-shrink-0 shadow-lg">
                    <i class="fas fa-folder-plus text-lg"></i>
                </div>
                <div class="flex-1">
                    <div class="flex justify-between items-start">
                        <div>
                            <h4 class="text-white font-bold text-sm">New Project Created</h4>
                            <p class="text-gray-400 text-sm mt-1">
                                A new project <span class="text-green-400 font-semibold">"Infrastructure"</span> has been added to your workspace by Admin.
                            </p>
                        </div>
                        <span class="text-[10px] font-bold text-gray-600 uppercase">2 hours ago</span>
                    </div>
                </div>
            </div>

        </div>

        <div class="p-4 bg-white/[0.01] border-t border-dark-border text-center">
            <button class="text-xs text-gray-500 font-bold hover:text-white transition uppercase tracking-widest">
                Load Older Notifications
            </button>
        </div>
    </div>
@endsection
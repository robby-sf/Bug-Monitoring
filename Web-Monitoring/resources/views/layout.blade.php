<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BugHunter - Monitoring System</title>
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-dark-bg text-gray-400 font-sans antialiased">

    <div class="flex h-screen overflow-hidden">
        <aside class="w-72 bg-dark-card border-r border-dark-border flex flex-col shadow-2xl">
            <div class="p-8">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-accent-blue rounded-xl flex items-center justify-center text-white shadow-[0_0_15px_rgba(59,130,246,0.5)]">
                        <i class="fas fa-bug-slash text-xl"></i>
                    </div>
                    <div>
                        <h1 class="text-white font-bold text-xl tracking-tight">BugHunter</h1>
                        <p class="text-[10px] text-gray-500 uppercase tracking-widest font-semibold">Workspace v1.0</p>
                    </div>
                </div>
            </div>
            
            <nav class="flex-1 px-4 space-y-1">
                <a href="/" class="flex items-center gap-4 px-4 py-3 rounded-xl transition-all group {{ Request::is('/') ? 'text-white bg-blue-600/10 border-l-4 border-blue-600' : 'text-gray-400 hover:bg-white/5 hover:text-white' }}">
                    <i class="fas fa-th-large {{ Request::is('/') ? 'text-blue-500' : 'group-hover:text-blue-500' }}"></i>
                    <span class="font-medium">Dashboard</span>
                </a>

                <a href="/issues" class="flex items-center gap-4 px-4 py-3 rounded-xl transition-all group {{ Request::is('issues') ? 'text-white bg-blue-600/10 border-l-4 border-blue-600' : 'text-gray-400 hover:bg-white/5 hover:text-white' }}">
                    <i class="fas fa-circle-exclamation {{ Request::is('issues') ? 'text-red-500' : 'group-hover:text-red-500' }}"></i>
                    <span class="font-medium">Issues</span>
                </a>

                <a href="/projects" class="flex items-center gap-4 px-4 py-3 rounded-xl transition-all group {{ Request::is('projects') ? 'text-white bg-blue-600/10 border-l-4 border-blue-600' : 'text-gray-400 hover:bg-white/5 hover:text-white' }}">
                    <i class="fas fa-layer-group {{ Request::is('projects') ? 'text-blue-500' : 'group-hover:text-blue-500' }}"></i>
                    <span class="font-medium">Projects</span>
                </a>

                <a href="/team" class="flex items-center gap-4 px-4 py-3 rounded-xl transition-all group {{ Request::is('team') ? 'text-white bg-blue-600/10 border-l-4 border-blue-600' : 'text-gray-400 hover:bg-white/5 hover:text-white' }}">
                    <i class="fas fa-user-group {{ Request::is('team') ? 'text-blue-500' : 'group-hover:text-blue-500' }}"></i>
                    <span class="font-medium">Team Members</span>
                </a>

                <a href="/settings" class="flex items-center gap-4 px-4 py-3 rounded-xl transition-all group {{ Request::is('settings') ? 'text-white bg-blue-600/10 border-l-4 border-blue-600' : 'text-gray-400 hover:bg-white/5 hover:text-white' }}">
                    <i class="fas fa-gear {{ Request::is('settings') ? 'text-blue-500' : 'group-hover:text-blue-500' }}"></i>
                    <span class="font-medium">Settings</span>
                </a>
            </nav>

            <div class="p-4 border-t border-dark-border">
                <a href="/profile" class="flex items-center gap-3 p-2 hover:bg-white/5 rounded-xl transition">
                    <div class="w-9 h-9 bg-gray-800 rounded-full border border-gray-700"></div>
                    <div class="flex-1 overflow-hidden">
                        <p class="text-sm text-white font-medium truncate">Robby Developer</p>
                        <p class="text-xs text-gray-500 truncate">Administrator</p>
                    </div>
                    <i class="fas fa-right-from-bracket text-gray-600 hover:text-red-400"></i>
                </a>
            </div>
        </aside>

        <div class="flex-1 flex flex-col min-w-0">
            <header class="h-20 bg-dark-bg/50 backdrop-blur-md border-b border-dark-border flex items-center justify-between px-10 sticky top-0 z-10">
                <div class="relative w-96 group">
                    <i class="fas fa-search absolute left-4 top-1/2 -translate-y-1/2 text-gray-500 group-focus-within:text-accent-blue transition"></i>
                    <input type="text" placeholder="Search for bug tickets, projects..." 
                        class="w-full bg-dark-card border border-dark-border rounded-xl py-2.5 pl-12 pr-4 text-sm focus:outline-none focus:border-accent-blue focus:ring-1 focus:ring-accent-blue/30 transition shadow-inner">
                </div>
                <div class="flex items-center gap-5">
                    <div class="relative group">
                        <button class="w-10 h-10 flex items-center justify-center rounded-xl bg-dark-card border border-dark-border text-gray-400 hover:text-white transition relative">
                            <i class="far fa-bell text-lg"></i>
                            <span class="absolute top-2 right-2 w-2.5 h-2.5 bg-red-500 border-2 border-dark-card rounded-full"></span>
                        </button>

                        <div class="absolute right-0 mt-3 w-80 bg-dark-card border border-dark-border rounded-2xl shadow-2xl z-50 overflow-hidden hidden group-hover:block transition-all duration-300">
                            <div class="p-4 border-b border-dark-border flex justify-between items-center bg-white/2">
                                <h5 class="text-white font-bold text-sm">Notifications</h5>
                                <button class="text-[10px] text-accent-blue font-bold uppercase hover:underline">Mark all as read</button>
                            </div>

                            <div class="max-h-80 overflow-y-auto divide-y divide-dark-border">
                                <a href="/issues" class="p-4 flex gap-4 hover:bg-white/3 transition">
                                    <div class="w-10 h-10 rounded-xl bg-red-500/10 text-red-500 flex items-center justify-center shrink-0 shadow-inner">
                                        <i class="fas fa-bolt text-xs"></i>
                                    </div>
                                    <div>
                                        <p class="text-xs text-white leading-relaxed">
                                            <span class="font-bold text-red-400">Critical:</span> Database timeout on main gateway.
                                        </p>
                                        <p class="text-[10px] text-gray-500 mt-1">2m ago</p>
                                    </div>
                                </a>

                                <a href="/team" class="p-4 flex gap-4 hover:bg-white/3 transition">
                                    <div class="w-10 h-10 rounded-xl bg-accent-blue/10 text-accent-blue flex items-center justify-center shrink-0 font-bold text-[10px] shadow-inner">
                                        SC
                                    </div>
                                    <div>
                                        <p class="text-xs text-white leading-relaxed">
                                            <span class="font-bold">Sarah Chen</span> commented on your ticket.
                                        </p>
                                        <p class="text-[10px] text-gray-500 mt-1">45m ago</p>
                                    </div>
                                </a>
                            </div>

                            <a href="/notification" class="block p-3.5 text-center text-[11px] text-gray-500 hover:text-white transition font-bold border-t border-dark-border bg-white/1">
                                View All Notifications
                            </a>
                        </div>
                    </div>
                    <a href="/report-bug" class="bg-accent-blue hover:bg-blue-600 text-white px-5 py-2.5 rounded-xl text-sm font-bold shadow-lg shadow-blue-900/20 transition active:scale-95 flex items-center">
                        <i class="fas fa-plus mr-2"></i> Report Bug
                    </a>
                </div>
            </header>

            <main class="flex-1 overflow-y-auto bg-dark-bg p-10">
                @yield('content')
            </main>
        </div>
    </div>

</body>
</html>
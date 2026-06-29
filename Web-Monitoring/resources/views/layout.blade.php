<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BugHunter Workspace</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
<style>
        [x-cloak] { display: none !important; }
    </style>
    
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

                <a href="/team" class="flex items-center gap-4 px-4 py-3 rounded-xl transition-all group {{ Request::is('team') ? 'text-white bg-blue-600/10 border-l-4 border-blue-600' : 'text-gray-400 hover:bg-white/5 hover:text-white' }}">
                    <i class="fas fa-user-group {{ Request::is('team') ? 'text-blue-500' : 'group-hover:text-blue-500' }}"></i>
                    <span class="font-medium">Team Members</span>
                </a>

                @if(Auth::user()->role === 'admin')
                <a href="/settings" class="flex items-center gap-4 px-4 py-3 rounded-xl transition-all group {{ Request::is('settings') ? 'text-white bg-blue-600/10 border-l-4 border-blue-600' : 'text-gray-400 hover:bg-white/5 hover:text-white' }}">
                    <i class="fas fa-gear {{ Request::is('settings') ? 'text-blue-500' : 'group-hover:text-blue-500' }}"></i>
                    <span class="font-medium">Settings</span>
                </a>
                @endif
            </nav>

            <div class="p-4 border-t border-dark-border">
                <a href="/profile" class="flex items-center gap-3 p-2 hover:bg-white/5 rounded-xl transition">
                    <div class="w-9 h-9 bg-gray-800 rounded-full border border-gray-700 overflow-hidden">
                        @if(Auth::user()->avatar)
                            <img src="{{ Storage::url(Auth::user()->avatar) }}" alt="Profile" class="w-full h-full object-cover">
                        @else
                            <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->first_name) }}&background=0D8ABC&color=fff" alt="Profile">
                        @endif
                    </div>

                    <div class="flex-1 overflow-hidden">
                        <p class="text-sm text-white font-medium truncate">
                            {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}
                        </p>
                        <p class="text-xs text-gray-500 truncate">
                            {{ ucfirst(Auth::user()->role) }}
                        </p>
                    </div>

                    <form action="/logout" method="POST" id="logout-form">
                        @csrf
                        <button type="submit" class="text-gray-600 hover:text-red-400">
                            <i class="fas fa-right-from-bracket"></i>
                        </button>
                    </form>
                </a>
            </div>
        </aside>

        <div class="flex-1 flex flex-col min-w-0">
            <header class="h-20 bg-dark-bg/50 backdrop-blur-md border-b border-dark-border flex items-center justify-between px-10 sticky top-0 z-10">
                <form action="{{ route('issues.index') }}" method="GET" class="relative w-96 group">
                    <i class="fas fa-search absolute left-4 top-1/2 -translate-y-1/2 text-gray-500 group-focus-within:text-accent-blue transition"></i>
                    
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by bug ID, title, or category..." 
                        class="w-full bg-[#1a1a1a] border border-white/10 rounded-xl py-2.5 pl-12 pr-4 text-sm text-white focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500/50 transition shadow-inner placeholder-zinc-500 hover:bg-[#252525]">
                </form>
                <div class="flex items-center gap-5">
                    <div x-data="{ open: false }" class="relative">
                        <button @click="open = !open" @click.away="open = false" 
                            class="w-10 h-10 flex items-center justify-center rounded-xl bg-dark-card border border-dark-border text-gray-400 hover:text-white transition relative focus:outline-none">
                            <i class="far fa-bell text-lg"></i>
                            
                            @if(isset($unreadNotifications) && $unreadNotifications->count() > 0)
                                <span class="absolute top-2 right-2 flex h-2.5 w-2.5">
                                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
                                    <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-red-500 border-2 border-dark-card"></span>
                                </span>
                            @endif
                        </button>

                        <div x-show="open" 
                            x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 scale-95"
                            x-transition:enter-end="opacity-100 scale-100"
                            style="display: none;" 
                            class="absolute right-0 mt-3 w-80 bg-dark-card border border-dark-border rounded-2xl shadow-2xl z-50 overflow-hidden">
                            
                            <div class="p-4 border-b border-dark-border flex justify-between items-center bg-white/2">
                                <h5 class="text-white font-bold text-sm">Notifications</h5>
                                @if(isset($unreadNotifications) && $unreadNotifications->count() > 0)
                                    <form action="{{ route('notifications.readAll') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="text-[10px] text-accent-blue font-bold uppercase hover:underline">Mark all as read</button>
                                    </form>
                                @endif
                            </div>

                            <div class="max-h-80 overflow-y-auto divide-y divide-dark-border">
                                @forelse($unreadNotifications ?? [] as $notification)
                                    <a href="{{ $notification->data['url'] }}" class="p-4 flex gap-4 hover:bg-white/3 transition">
                                        <div class="w-10 h-10 rounded-xl bg-accent-blue/10 text-accent-blue flex items-center justify-center shrink-0 shadow-inner">
                                            <i class="fas fa-envelope-open-text text-xs"></i>
                                        </div>
                                        <div>
                                            <p class="text-xs text-white leading-relaxed">
                                                {{ $notification->data['message'] }}
                                            </p>
                                            <p class="text-[10px] text-gray-500 mt-1">{{ $notification->created_at->diffForHumans() }}</p>
                                        </div>
                                    </a>
                                @empty
                                    <div class="p-8 text-center">
                                        <i class="fas fa-bell-slash text-zinc-700 text-xl mb-2 block"></i>
                                        <p class="text-xs text-gray-500">No new notifications</p>
                                    </div>
                                @endforelse
                            </div>

                            <a href="/notification" class="block p-3.5 text-center text-[11px] text-gray-500 hover:text-white transition font-bold border-t border-dark-border bg-white/1">
                                View All Notifications
                            </a>
                        </div>
                    </div>
                    @if(in_array(Auth::user()->role, ['admin', 'developer']))
                    <a href="/report-bug" class="bg-accent-blue hover:bg-blue-600 text-white px-5 py-2.5 rounded-xl text-sm font-bold shadow-lg shadow-blue-900/20 transition active:scale-95 flex items-center">
                        <i class="fas fa-plus mr-2"></i> Report Bug
                    </a>
                    @endif
                </div>
            </header>

            <main class="flex-1 overflow-y-auto bg-dark-bg p-10">
                @yield('content')
            </main>
        </div>
    </div>

</body>
</html>
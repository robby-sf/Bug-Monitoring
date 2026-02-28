@extends('layout')

@section('content')
    <div class="mb-8">
        <h2 class="text-3xl font-extrabold text-white tracking-tight">Dashboard</h2>
        <p class="text-gray-500 mt-1 font-medium">Welcome back! Here's your real-time issue overview.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-dark-card border border-dark-border p-6 rounded-2xl shadow-sm">
            <div class="flex justify-between items-start mb-4">
                <div>
                    <p class="text-gray-400 text-sm font-medium">Total Issues</p>
                    <h3 class="text-3xl font-bold text-white mt-1">{{ $totalIssues }}</h3>
                </div>
                <div class="p-2 bg-gray-800 rounded-lg text-gray-400">
                    <i class="fas fa-bug"></i>
                </div>
            </div>
            <span class="text-xs font-bold text-blue-500">Live data from system</span>
        </div>

        <div class="bg-dark-card border border-dark-border p-6 rounded-2xl shadow-sm">
            <div class="flex justify-between items-start mb-4">
                <div>
                    <p class="text-gray-400 text-sm font-medium">Open Issues</p>
                    <h3 class="text-3xl font-bold text-white mt-1">{{ $openIssues }}</h3>
                </div>
                <div class="p-2 bg-yellow-500/10 rounded-lg text-yellow-500">
                    <i class="fas fa-exclamation-triangle"></i>
                </div>
            </div>
            <span class="text-xs font-bold text-yellow-500">Awaiting fix</span>
        </div>

        <div class="bg-dark-card border border-dark-border p-6 rounded-2xl shadow-sm">
            <div class="flex justify-between items-start mb-4">
                <div>
                    <p class="text-gray-400 text-sm font-medium">In Progress</p>
                    <h3 class="text-3xl font-bold mt-1 text-indigo-500">{{ $inProgressIssues }}</h3>
                </div>
                <div class="p-2 bg-indigo-500/10 rounded-lg text-indigo-500">
                    <i class="fas fa-tools text-xl"></i>
                </div>
            </div>
            <span class="text-xs font-bold text-indigo-500">Currently being fixed</span>
        </div>

        <div class="bg-dark-card border border-dark-border p-6 rounded-2xl shadow-sm">
            <div class="flex justify-between items-start mb-4">
                <div>
                    <p class="text-gray-400 text-sm font-medium">Resolved</p>
                    <h3 class="text-3xl font-bold  mt-1 text-green-500">{{ $resolvedIssues }}</h3>
                </div>
                <div class="p-2 bg-green-500/10 rounded-lg text-green-500">
                    <i class="fas fa-check-circle"></i>
                </div>
            </div>
            <span class="text-xs font-bold text-green-500">Successfully fixed</span>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-8">
        
        <div class="lg:col-span-2 bg-[#0f0f0f] border border-white/10 rounded-2xl p-6 shadow-sm">
            
            <div class="flex justify-between items-center mb-6">
                <div class="flex items-center gap-3">
                    <h4 class="text-white font-bold text-lg">Issues Trend</h4>
                    <span class="px-2 py-0.5 bg-indigo-500/10 text-indigo-400 border border-indigo-500/20 rounded text-[10px] font-bold uppercase tracking-wide">
                        Analytics
                    </span>
                </div>
                
                <form action="{{ route('dashboard') }}" method="GET" class="relative" x-data="{
                    open: false,
                    selected: '{{ request('range', '7days') }}',
                    options: {
                        '7days': 'Last 7 Days',
                        '1month': 'Last 1 Month',
                        '3months': 'Last 3 Months',
                        '6months': 'Last 6 Months',
                        'ytd': 'Year to Date',
                        '1year': 'Last 1 Year'
                    },
                    update(val) {
                        this.selected = val;
                        this.$refs.hiddenInput.value = val;
                        this.$refs.form.submit();
                    }
                }" x-ref="form">
                    
                    <input type="hidden" name="range" x-ref="hiddenInput" :value="selected">

                    <button type="button" @click="open = !open" @click.away="open = false" 
                            class="flex items-center justify-between gap-3 bg-[#1a1a1a] border border-white/10 text-zinc-300 text-xs rounded-lg px-3 py-1.5 focus:ring-2 focus:ring-indigo-500/50 outline-none transition-all cursor-pointer hover:bg-[#252525] shadow-inner w-36">
                        <span x-text="options[selected]" class="font-medium"></span>
                        <i class="fas fa-chevron-down text-[10px] text-zinc-500 transition-transform duration-200" :class="open ? 'rotate-180' : ''"></i>
                    </button>

                    <div x-show="open" style="display: none;"
                         x-transition:enter="transition ease-out duration-100"
                         x-transition:enter-start="transform opacity-0 scale-95"
                         x-transition:enter-end="transform opacity-100 scale-100"
                         x-transition:leave="transition ease-in duration-75"
                         x-transition:leave-start="transform opacity-100 scale-100"
                         x-transition:leave-end="transform opacity-0 scale-95"
                         class="absolute right-0 mt-2 w-40 bg-[#1a1a1a] border border-white/10 rounded-xl shadow-2xl overflow-hidden z-50 py-1.5">

                         <template x-for="(label, value) in options" :key="value">
                             <button type="button"
                                     @click="update(value)"
                                     class="w-full text-left px-4 py-2 text-xs transition-colors flex items-center justify-between"
                                     :class="selected === value ? 'text-white bg-indigo-500/20 font-bold' : 'text-zinc-400 hover:bg-white/5 hover:text-white'">
                                 <span x-text="label"></span>
                                 <i x-show="selected === value" class="fas fa-check text-indigo-400 text-[10px]"></i>
                             </button>
                         </template>
                    </div>
                </form>
            </div>
            
            <div class="h-64 w-full relative">
                <canvas id="issuesTrendChart"></canvas>
            </div>

        </div>
        
        <div class="bg-[#0f0f0f] border border-white/10 rounded-2xl p-6 shadow-sm flex flex-col h-full">
            <div class="flex justify-between items-center mb-8">
                <div class="flex items-center gap-2">
                    <i class="fas fa-bolt text-indigo-500"></i>
                    <h4 class="text-white font-bold text-lg">Recent Activity</h4>
                </div>
                <a href="/activity" class="text-xs text-indigo-400 hover:text-indigo-300 font-bold transition flex items-center gap-1">
                    View All <i class="fas fa-arrow-right text-[8px]"></i>
                </a>
            </div>

            <div class="space-y-6 flex-1">
                @forelse($recentActivities as $activity)
                    @php
                        // Logika warna titik nyala berdasarkan jenis aksi
                        $actionColor = match(strtolower($activity->action)) {
                            'created'  => 'bg-yellow-500 shadow-[0_0_10px_rgba(234,179,8,0.5)]', // Kuning
                            'assigned' => 'bg-blue-500 shadow-[0_0_10px_rgba(59,130,246,0.5)]', // Biru
                            'resolved' => 'bg-green-500 shadow-[0_0_10px_rgba(34,197,94,0.5)]', // Hijau
                            default    => 'bg-gray-500 shadow-[0_0_10px_rgba(107,114,128,0.5)]'
                        };

                        // Nama orang yang melakukan aksi (Jika null/dari API, maka tulis 'System')
                        $actorName = $activity->user ? $activity->user->first_name : 'System';
                    @endphp

                    <div class="relative pl-6 border-l border-white/5 group">
                        <div class="absolute w-3 h-3 {{ $actionColor }} rounded-full -left-[6.5px] top-1"></div>
                        
                        <p class="text-sm text-zinc-300 leading-relaxed">
                            <span class="text-white font-bold">{{ $actorName }}</span> 
                            {{ $activity->description }} 
                            <a href="{{ route('issues.show', $activity->issue->issue_id) }}" class="text-indigo-400 hover:text-indigo-300 font-bold transition ml-1">
                                #{{ $activity->issue->issue_id }}
                            </a>
                        </p>
                        
                        <p class="text-xs text-zinc-500 mt-1 uppercase font-semibold tracking-tighter">
                            {{ $activity->created_at->diffForHumans() }}
                        </p>
                    </div>
                @empty
                    <div class="text-center text-zinc-500 py-4">
                        <i class="fas fa-history text-2xl mb-2 opacity-50"></i>
                        <p class="text-sm">No activity recorded yet.</p>
                    </div>
                @endforelse
            </div>
        </div>
        
    </div>

    <div class="bg-[#0f0f0f] border border-white/10 rounded-2xl overflow-hidden shadow-xl mt-8">
        <div class="p-6 border-b border-white/5 flex justify-between items-center bg-[#1a1a1a]">
            <h4 class="text-white font-bold flex items-center gap-2">
                <i class="fas fa-list-ul text-indigo-500"></i> Recent Issues (Live Data)
            </h4>
            <a href="{{ route('issues.index') }}" class="text-indigo-400 text-sm font-medium hover:text-indigo-300 transition flex items-center gap-1">
                View all reports <i class="fas fa-arrow-right text-[10px]"></i>
            </a>
        </div>
        
        <div class="divide-y divide-white/5 bg-[#0f0f0f]">
            @forelse($recentIssues as $issue)
                @php
                    // Logika Icon Kategori yang sudah kita pakai sebelumnya
                    $iconClass = match(strtolower($issue->category)) {
                        'frontend'    => 'fa-desktop',
                        'backend'     => 'fa-server',
                        'database'    => 'fa-database',
                        'security'    => 'fa-shield-alt',
                        'performance' => 'fa-tachometer-alt',
                        'network'     => 'fa-network-wired',
                        default       => 'fa-bug',
                    };

                    // Warna Severity
                    $severityColors = [
                        'Critical' => 'bg-red-500/10 text-red-500 border-red-500/20',
                        'High'     => 'bg-yellow-500/10 text-yellow-500 border-yellow-500/20',
                        'Medium'   => 'bg-blue-500/10 text-blue-500 border-blue-500/20',
                        'Low'      => 'bg-green-500/10 text-green-500 border-green-500/20'
                    ][$issue->severity] ?? 'bg-gray-500/10 text-gray-500 border-gray-500/20';

                    // Warna Status
                    $statusColor = match(strtolower($issue->status)) {
                        'open'        => 'text-blue-400',
                        'in-progress' => 'text-yellow-400',
                        'resolved'    => 'text-green-400',
                        default       => 'text-gray-400',
                    };
                @endphp

                <div class="p-5 flex items-center justify-between hover:bg-white/2 transition group">
                    <div class="flex items-center gap-4">
                        <div class="w-10 h-10 flex items-center justify-center bg-[#1a1a1a] border border-white/5 text-zinc-400 rounded-xl group-hover:scale-110 group-hover:text-white transition">
                            <i class="fas {{ $iconClass }}"></i>
                        </div>
                        
                        <div>
                            <div class="flex items-center gap-3 mb-1">
                                <a href="{{ route('issues.show', $issue->issue_id) }}" class="text-white font-semibold text-sm hover:text-indigo-400 transition {{ $issue->status == 'resolved' ? 'line-through text-zinc-500' : '' }}">
                                    {{ Str::limit($issue->title, 60) }}
                                </a>
                                
                                <span class="px-2 py-0.5 {{ $severityColors }} text-[10px] font-bold rounded border uppercase tracking-wider">
                                    {{ $issue->severity }}
                                </span>
                            </div>
                            
                            <div class="flex items-center gap-3 text-xs text-zinc-500">
                                <span class="text-zinc-400 font-mono bg-white/5 px-1.5 rounded">{{ $issue->issue_id }}</span>
                                <span>&bull;</span>
                                <span><i class="fas fa-folder text-zinc-600 mr-1"></i> {{ $issue->category }}</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="text-right">
                        <p class="text-xs text-zinc-400 font-medium mb-1.5">{{ $issue->created_at->diffForHumans() }}</p>
                        <span class="inline-block px-3 py-1 bg-[#1a1a1a] border border-white/5 {{ $statusColor }} text-[10px] font-bold rounded-full uppercase tracking-wider">
                            {{ str_replace('-', ' ', $issue->status) }}
                        </span>
                    </div>
                </div>
            @empty
                <div class="p-10 text-center text-zinc-500">
                    <div class="w-16 h-16 bg-[#1a1a1a] rounded-full flex items-center justify-center mx-auto mb-4 border border-white/5">
                        <i class="fas fa-check-double text-2xl text-green-500/50"></i>
                    </div>
                    <p class="text-sm font-medium">No recent issues found. Everything is running smoothly!</p>
                </div>
            @endforelse
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('issuesTrendChart').getContext('2d');

            // Ambil data dari PHP (Controller) dan jadikan format JavaScript
            const labels = {!! json_encode($chartDates) !!};
            const dataPoints = {!! json_encode($chartData) !!};

            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Bug Dilaporkan',
                        data: dataPoints,
                        borderColor: '#6366f1', // Warna garis ungu Indigo
                        backgroundColor: 'rgba(99, 102, 241, 0.1)', // Warna latar transparan
                        borderWidth: 3,
                        pointBackgroundColor: '#1a1a1a', // Titik dengan background gelap
                        pointBorderColor: '#6366f1',
                        pointBorderWidth: 2,
                        pointRadius: 4,
                        pointHoverRadius: 6,
                        fill: true, // Membuat efek gradasi di bawah garis
                        tension: 0.4 // Membuat garisnya melengkung halus (smooth curve)
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false }, // Sembunyikan label legend agar bersih
                        tooltip: {
                            backgroundColor: '#1a1a1a',
                            titleColor: '#fff',
                            bodyColor: '#a1a1aa',
                            borderColor: 'rgba(255,255,255,0.1)',
                            borderWidth: 1,
                            padding: 10,
                            displayColors: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 1, // Agar angkanya bulat (1, 2, 3), tidak desimal
                                color: '#71717a'
                            },
                            grid: {
                                color: 'rgba(255, 255, 255, 0.05)', // Garis panduan tipis transparan
                                drawBorder: false,
                            }
                        },
                        x: {
                            ticks: {
                                color: '#71717a'
                            },
                            grid: {
                                display: false, // Hilangkan garis panduan vertikal agar bersih
                                drawBorder: false,
                            }
                        }
                    }
                }
            });
        });
    </script>
@endsection
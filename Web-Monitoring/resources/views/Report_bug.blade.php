@extends('layout')

@section('content')
    <div class="mb-8">
        <h2 class="text-3xl font-extrabold text-white tracking-tight">Report New Bug</h2>
        <p class="text-gray-500 mt-1 font-medium">Please provide detailed information to help our developers fix the issue faster.</p>
    </div>

    <div class="max-w-3xl">
        <form action="#" method="POST" class="bg-dark-card border border-dark-border rounded-3xl overflow-hidden shadow-2xl">
            @csrf
            <div class="p-8 space-y-6">
                <div>
                    <label class="block text-sm font-bold text-gray-400 mb-2 uppercase tracking-wide">Issue Title</label>
                    <input type="text" placeholder="e.g., Checkout button not working on iOS" 
                        class="w-full bg-dark-bg border border-dark-border text-white px-4 py-3.5 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none transition placeholder:text-gray-700">
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div x-data="{ open: false, selected: 'Frontend' }" class="relative">
                        <label class="block text-sm font-bold text-gray-400 mb-2 uppercase tracking-wide">Project</label>
                        <button type="button" @click="open = !open" @click.away="open = false"
                            class="w-full bg-dark-bg border border-dark-border text-white px-4 py-3.5 rounded-xl flex justify-between items-center focus:ring-2 focus:ring-blue-500 transition">
                            <span x-text="selected"></span>
                            <i class="fas fa-chevron-down text-xs transition-transform" :class="open ? 'rotate-180' : ''"></i>
                        </button>
                        
                        <div x-show="open" x-transition 
                            class="absolute z-50 w-full mt-2 bg-dark-card/90 backdrop-blur-xl border border-white/10 rounded-2xl shadow-2xl overflow-hidden">
                            <template x-for="item in ['Frontend', 'Backend', 'Infrastructure']">
                                <div @click="selected = item; open = false" 
                                    class="px-4 py-3 text-sm text-gray-300 hover:bg-blue-600 hover:text-white cursor-pointer transition-colors"
                                    :class="selected === item ? 'bg-blue-600/20 text-blue-400' : ''">
                                    <span x-text="item"></span>
                                </div>
                            </template>
                        </div>
                    </div>

                    <div x-data="{ open: false, selected: 'Critical', color: 'text-red-500' }" class="relative">
                        <label class="block text-sm font-bold text-gray-400 mb-2 uppercase tracking-wide">Severity Level</label>
                        <button type="button" @click="open = !open" @click.away="open = false"
                            class="w-full bg-dark-bg border border-dark-border px-4 py-3.5 rounded-xl flex justify-between items-center focus:ring-2 focus:ring-blue-500 transition">
                            <span :class="color" class="font-bold" x-text="selected"></span>
                            <i class="fas fa-chevron-down text-xs text-gray-500 transition-transform" :class="open ? 'rotate-180' : ''"></i>
                        </button>
                        
                        <div x-show="open" x-transition 
                            class="absolute z-50 w-full mt-2 bg-dark-card/90 backdrop-blur-xl border border-white/10 rounded-2xl shadow-2xl overflow-hidden">
                            <div @click="selected = 'Critical'; color = 'text-red-500'; open = false" class="px-4 py-3 text-sm text-red-500 font-bold hover:bg-red-500/10 cursor-pointer">Critical</div>
                            <div @click="selected = 'High'; color = 'text-yellow-500'; open = false" class="px-4 py-3 text-sm text-yellow-500 font-bold hover:bg-yellow-500/10 cursor-pointer">High</div>
                            <div @click="selected = 'Medium'; color = 'text-blue-500'; open = false" class="px-4 py-3 text-sm text-blue-500 font-bold hover:bg-blue-500/10 cursor-pointer">Medium</div>
                            <div @click="selected = 'Low'; color = 'text-gray-400'; open = false" class="px-4 py-3 text-sm text-gray-400 font-bold hover:bg-gray-400/10 cursor-pointer">Low</div>
                        </div>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-400 mb-2 uppercase tracking-wide">Description</label>
                    <textarea rows="4" placeholder="Explain what happened and what you expected to see..." 
                        class="w-full bg-dark-bg border border-dark-border text-white px-4 py-3.5 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none transition placeholder:text-gray-700"></textarea>
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-400 mb-2 uppercase tracking-wide">Steps to Reproduce</label>
                    <textarea rows="3" placeholder="1. Go to settings&#10;2. Click on change password&#10;3. Error 500 appears" 
                        class="w-full bg-dark-bg border border-dark-border text-white px-4 py-3.5 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none transition font-mono text-sm placeholder:text-gray-700"></textarea>
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-400 mb-2 uppercase tracking-wide">Attachments (Screenshots/Logs)</label>
                    <div class="border-2 border-dashed border-dark-border rounded-2xl p-8 flex flex-col items-center justify-center hover:border-blue-500/50 transition cursor-pointer bg-white/1">
                        <i class="fas fa-cloud-upload-alt text-3xl text-gray-600 mb-3"></i>
                        <p class="text-sm text-gray-500">Click or drag and drop files to upload</p>
                        <p class="text-[10px] text-gray-600 mt-1 uppercase">PNG, JPG, PDF up to 5MB</p>
                    </div>
                </div>
            </div>

            <div class="p-8 bg-white/2 border-t border-dark-border flex gap-4">
                <button type="submit" class="flex-1 py-4 bg-blue-600 hover:bg-blue-500 text-white font-bold rounded-2xl transition shadow-lg shadow-blue-500/20 active:scale-95">
                    Submit Bug Report
                </button>
                <a href="/" class="px-8 py-4 bg-gray-800 hover:bg-gray-700 text-gray-400 font-bold rounded-2xl transition text-center">
                    Cancel
                </a>
            </div>
        </form>
    </div>
@endsection
@extends('layout')

@section('content')
    <div class="mb-10">
        <h2 class="text-3xl font-extrabold text-white tracking-tight">Projects</h2>
        <p class="text-gray-500 mt-1 font-medium">Manage your projects and their settings.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        
        <div class="bg-dark-card border border-dark-border p-8 rounded-2xl hover:border-blue-500/50 transition group shadow-lg">
            <div class="mb-6">
                <div class="w-16 h-16 flex items-center justify-center bg-gray-800 rounded-2xl text-3xl group-hover:scale-110 transition duration-300">
                    🎨
                </div>
            </div>
            <h4 class="text-white font-bold text-xl mb-2">Frontend</h4>
            <p class="text-gray-500 text-sm mb-8 leading-relaxed">Project management for frontend development, including UI/UX components and client-side logic.</p>
            <a href="/project-view" class="w-full py-3 flex items-center justify-center bg-blue-600 hover:bg-blue-500 text-white font-bold rounded-xl transition duration-200 shadow-lg shadow-blue-500/30">
                Manage Project
            </a>
        </div>

        <div class="bg-dark-card border border-dark-border p-8 rounded-2xl hover:border-blue-500/50 transition group shadow-lg">
            <div class="mb-6">
                <div class="w-16 h-16 flex items-center justify-center bg-gray-800 rounded-2xl text-3xl group-hover:scale-110 transition duration-300">
                    ⚙️
                </div>
            </div>
            <h4 class="text-white font-bold text-xl mb-2">Backend</h4>
            <p class="text-gray-500 text-sm mb-8 leading-relaxed">Project management for backend services, API development, and server-side architecture.</p>
            <a href="/project-view" class="w-full py-3 flex items-center justify-center bg-blue-600 hover:bg-blue-500 text-white font-bold rounded-xl transition duration-200 shadow-lg shadow-blue-500/30">
                Manage Project
            </a>
        </div>

        <div class="bg-dark-card border border-dark-border p-8 rounded-2xl hover:border-blue-500/50 transition group shadow-lg">
            <div class="mb-6">
                <div class="w-16 h-16 flex items-center justify-center bg-gray-800 rounded-2xl text-3xl group-hover:scale-110 transition duration-300">
                    🏗️
                </div>
            </div>
            <h4 class="text-white font-bold text-xl mb-2">Infrastructure</h4>
            <p class="text-gray-500 text-sm mb-8 leading-relaxed">Project management for infrastructure, DevOps pipelines, and cloud resource configuration.</p>
            <a href="/project-view" class="w-full py-3 flex items-center justify-center bg-blue-600 hover:bg-blue-500 text-white font-bold rounded-xl transition duration-200 shadow-lg shadow-blue-500/30">
                Manage Project
            </a>
        </div>

    </div>
@endsection
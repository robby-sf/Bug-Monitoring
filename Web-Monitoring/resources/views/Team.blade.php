@extends('layout')

@section('content')
    <div class="mb-8">
        <h2 class="text-3xl font-extrabold text-white tracking-tight">Team</h2>
        <p class="text-gray-500 mt-1 font-medium">Manage team members and permissions.</p>
    </div>

    <div class="bg-dark-card border border-dark-border rounded-2xl overflow-hidden shadow-xl">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-white/5 border-b border-dark-border">
                        <th class="p-6 text-gray-400 font-bold uppercase text-[11px] tracking-wider">Name</th>
                        <th class="p-6 text-gray-400 font-bold uppercase text-[11px] tracking-wider">Role</th>
                        <th class="p-6 text-gray-400 font-bold uppercase text-[11px] tracking-wider">Email</th>
                        <th class="p-6 text-gray-400 font-bold uppercase text-[11px] tracking-wider text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-dark-border">
                    <tr class="hover:bg-white/2 transition group">
                        <td class="p-6">
                            <div class="flex items-center gap-4">
                                <div class="w-10 h-10 rounded-full bg-blue-600 flex items-center justify-center text-white font-bold text-xs shadow-lg shadow-blue-600/20">
                                    SC
                                </div>
                                <span class="text-white font-semibold">Sarah Chen</span>
                            </div>
                        </td>
                        <td class="p-6 text-gray-400 text-sm">Frontend Lead</td>
                        <td class="p-6 text-gray-500 text-sm italic">sarah@bughunter.dev</td>
                        <td class="p-6 text-right">
                            <a href="/edit-team" class="text-accent-blue hover:text-blue-400 text-sm font-medium transition">Edit</a>
                        </td>
                    </tr>

                    <tr class="hover:bg-white/0.02 transition group">
                        <td class="p-6">
                            <div class="flex items-center gap-4">
                                <div class="w-10 h-10 rounded-full bg-indigo-600 flex items-center justify-center text-white font-bold text-xs">
                                    AJ
                                </div>
                                <span class="text-white font-semibold">Alex Johnson</span>
                            </div>
                        </td>
                        <td class="p-6 text-gray-400 text-sm">Backend Engineer</td>
                        <td class="p-6 text-gray-500 text-sm italic">alex@bughunter.dev</td>
                        <td class="p-6 text-right">
                            <a href="/edit-team" class="text-accent-blue hover:text-blue-400 text-sm font-medium transition">Edit</a>
                        </td>
                    </tr>

                    <tr class="hover:bg-white/2 transition group">
                        <td class="p-6">
                            <div class="flex items-center gap-4">
                                <div class="w-10 h-10 rounded-full bg-purple-600 flex items-center justify-center text-white font-bold text-xs">
                                    MD
                                </div>
                                <span class="text-white font-semibold">Mike Davis</span>
                            </div>
                        </td>
                        <td class="p-6 text-gray-400 text-sm">Full Stack Developer</td>
                        <td class="p-6 text-gray-500 text-sm italic">mike@bughunter.dev</td>
                        <td class="p-6 text-right">
                            <a href="/edit-team" class="text-accent-blue hover:text-blue-400 text-sm font-medium transition">Edit</a>
                        </td>
                    </tr>

                    <tr class="hover:bg-white/2 transition group">
                        <td class="p-6">
                            <div class="flex items-center gap-4">
                                <div class="w-10 h-10 rounded-full bg-orange-600 flex items-center justify-center text-white font-bold text-xs">
                                    ER
                                </div>
                                <span class="text-white font-semibold">Emily Rodriguez</span>
                            </div>
                        </td>
                        <td class="p-6 text-gray-400 text-sm">DevOps Engineer</td>
                        <td class="p-6 text-gray-500 text-sm italic">emily@bughunter.dev</td>
                        <td class="p-6 text-right">
                            <a href="/edit-team" class="text-accent-blue hover:text-blue-400 text-sm font-medium transition">Edit</a>
                        </td>
                    </tr>

                    <tr class="hover:bg-white/2 transition group">
                        <td class="p-6">
                            <div class="flex items-center gap-4">
                                <div class="w-10 h-10 rounded-full bg-red-600 flex items-center justify-center text-white font-bold text-xs">
                                    TW
                                </div>
                                <span class="text-white font-semibold">Tom Wilson</span>
                            </div>
                        </td>
                        <td class="p-6 text-gray-400 text-sm">Security Specialist</td>
                        <td class="p-6 text-gray-500 text-sm italic">tom@bughunter.dev</td>
                        <td class="p-6 text-right">
                            <a href="/edit-team" class="text-accent-blue hover:text-blue-400 text-sm font-medium transition">Edit</a>
                        </td>
                    </tr>

                    <tr class="hover:bg-white/2 transition group">
                        <td class="p-6">
                            <div class="flex items-center gap-4">
                                <div class="w-10 h-10 rounded-full bg-teal-600 flex items-center justify-center text-white font-bold text-xs">
                                    LZ
                                </div>
                                <span class="text-white font-semibold">Lisa Zhang</span>
                            </div>
                        </td>
                        <td class="p-6 text-gray-400 text-sm">QA Engineer</td>
                        <td class="p-6 text-gray-500 text-sm italic">lisa@bughunter.dev</td>
                        <td class="p-6 text-right">
                            <a href="/edit-team" class="text-accent-blue hover:text-blue-400 text-sm font-medium transition">Edit</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
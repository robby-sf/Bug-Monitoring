@extends('layout')

@section('content')
    @php /** @var \App\Models\User $user */ $user = Auth::user(); @endphp

    <div class="max-w-3xl mx-auto">
        <div class="mb-8">
            <h2 class="text-3xl font-extrabold text-white tracking-tight">My Profile</h2>
            <p class="text-gray-500 mt-1 font-medium">Manage your personal information.</p>
        </div>

        @if(session('success'))
            <div class="mb-8 bg-green-500/10 border border-green-500/20 text-green-400 px-6 py-4 rounded-xl flex items-center gap-3 shadow-sm">
                <i class="fas fa-check-circle text-lg"></i>
                <span class="font-medium text-sm">{{ session('success') }}</span>
            </div>
        @endif

        <div class="bg-[#0f0f0f] border border-white/10 rounded-3xl p-8 sm:p-10 shadow-xl">
            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                @csrf
                @method('PUT')

                <div class="flex flex-col sm:flex-row items-center gap-8 pb-8 border-b border-white/5">
                    <div class="relative group cursor-pointer w-28 h-28 shrink-0">
                        <input type="file" name="avatar" id="avatarInput" accept="image/*" class="hidden" onchange="previewImage(this)">
                        
                        @if($user->avatar)
                            <img id="avatarPreview" src="{{ Storage::url($user->avatar) }}" alt="Profile" class="w-full h-full object-cover rounded-full border-4 border-[#1a1a1a] shadow-lg">
                        @else
                            <div id="avatarPreviewAlt" class="w-full h-full rounded-full bg-indigo-600 flex items-center justify-center text-white text-4xl font-bold border-4 border-[#1a1a1a] shadow-lg">
                                {{ strtoupper(substr($user->first_name, 0, 1) . substr($user->last_name, 0, 1)) }}
                            </div>
                            <img id="avatarPreview" class="hidden w-full h-full object-cover rounded-full border-4 border-[#1a1a1a] shadow-lg">
                        @endif

                        <label for="avatarInput" class="absolute inset-0 bg-black/60 rounded-full flex flex-col items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity cursor-pointer">
                            <i class="fas fa-camera text-white text-xl"></i>
                            <span class="text-xs text-white font-bold mt-1">Upload</span>
                        </label>
                    </div>
                    
                    <div class="text-center sm:text-left">
                        <h4 class="text-white font-bold text-lg mb-1">Profile Picture</h4>
                        <p class="text-zinc-500 text-sm mb-4">PNG, JPG or GIF. Maximum size of 2MB.</p>
                        <div class="flex justify-center sm:justify-start gap-3">
                            <label for="avatarInput" class="px-5 py-2.5 bg-[#1a1a1a] hover:bg-[#252525] border border-white/10 text-white text-sm font-bold rounded-xl transition cursor-pointer shadow-inner active:scale-95">
                                Choose File
                            </label>
                            @if($user->avatar)
                                <button type="button" onclick="document.getElementById('removeAvatarForm').submit()" class="px-5 py-2.5 bg-red-500/10 hover:bg-red-500/20 text-red-400 border border-red-500/20 text-sm font-bold rounded-xl transition active:scale-95">
                                    Remove
                                </button>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-xs font-bold text-zinc-400 mb-2 uppercase tracking-wide">First Name</label>
                        <input type="text" name="first_name" value="{{ $user->first_name }}" required
                            class="w-full bg-[#1a1a1a] border border-white/10 text-white px-4 py-3.5 rounded-xl focus:ring-2 focus:ring-indigo-500 outline-none transition shadow-inner">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-zinc-400 mb-2 uppercase tracking-wide">Last Name</label>
                        <input type="text" name="last_name" value="{{ $user->last_name }}" required
                            class="w-full bg-[#1a1a1a] border border-white/10 text-white px-4 py-3.5 rounded-xl focus:ring-2 focus:ring-indigo-500 outline-none transition shadow-inner">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-zinc-400 mb-2 uppercase tracking-wide">Phone Number <span class="text-zinc-600 font-normal lowercase tracking-normal">(Optional)</span></label>
                    <input type="text" name="phone_number" value="{{ $user->phone_number }}" placeholder="e.g. +62 812 3456 7890"
                        class="w-full bg-[#1a1a1a] border border-white/10 text-white px-4 py-3.5 rounded-xl focus:ring-2 focus:ring-indigo-500 outline-none transition shadow-inner">
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-4 border-t border-white/5">
                    <div>
                        <label class="block text-xs font-bold text-zinc-400 mb-2 uppercase tracking-wide">Email Address</label>
                        <input type="email" value="{{ $user->email }}" disabled
                            class="w-full bg-[#121212] border border-white/5 text-zinc-500 px-4 py-3.5 rounded-xl cursor-not-allowed opacity-70">
                        <p class="text-[11px] text-zinc-500 mt-2"><i class="fas fa-lock mr-1 text-zinc-600"></i> Contact admin to change email.</p>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-zinc-400 mb-2 uppercase tracking-wide">System Role</label>
                        <input type="text" value="{{ ucfirst($user->role) }}" disabled
                            class="w-full bg-[#121212] border border-white/5 text-indigo-400 font-bold px-4 py-3.5 rounded-xl cursor-not-allowed opacity-70">
                    </div>
                </div>

                <div class="pt-6 flex items-center justify-end border-t border-white/5">
                    <button type="submit" class="w-full sm:w-auto px-8 py-4 bg-indigo-600 hover:bg-indigo-500 text-white text-sm font-bold rounded-xl transition shadow-lg shadow-indigo-500/20 active:scale-95 flex items-center justify-center gap-2">
                        <i class="fas fa-save"></i> Save Changes
                    </button>
                </div>
            </form>

            @if($user->avatar)
                <form id="removeAvatarForm" action="{{ route('profile.remove_avatar') }}" method="POST" class="hidden">
                    @csrf
                    @method('DELETE')
                </form>
            @endif
        </div>
    </div>

    <script>
        function previewImage(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('avatarPreview').src = e.target.result;
                    document.getElementById('avatarPreview').classList.remove('hidden');
                    
                    var altAvatar = document.getElementById('avatarPreviewAlt');
                    if(altAvatar) altAvatar.classList.add('hidden');
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection
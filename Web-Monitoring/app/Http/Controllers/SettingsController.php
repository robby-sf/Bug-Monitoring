<?php

namespace App\Http\Controllers;

use App\Models\ProjectApiKey;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SettingsController extends Controller
{
    // 1. Tampilkan halaman Settings beserta daftar API Key
    public function index()
    {
        $apiKeys = ProjectApiKey::latest()->get();
        return view('settings', compact('apiKeys'));
    }

    // 2. Buat Project & API Key baru
    public function generateApiKey(Request $request)
    {
        $request->validate(['project_name' => 'required|string|max:255']);

        ProjectApiKey::create([
            'project_name' => $request->project_name,
            'api_key'      => 'bh_live_' . Str::random(32), // Format rahasia kita
        ]);

        return back()->with('success', "API Key for '{$request->project_name}' generated!");
    }

    // 3. Regenerate (Bikin ulang) API Key yang bocor
    public function regenerateApiKey($id)
    {
        $project = ProjectApiKey::findOrFail($id);
        $project->update([
            'api_key' => 'bh_live_' . Str::random(32)
        ]);

        return back()->with('success', "API Key for '{$project->project_name}' has been regenerated.");
    }

    // 4. Revoke (Hapus) API Key
    public function revokeApiKey($id)
    {
        $project = ProjectApiKey::findOrFail($id);
        $project->delete();

        return back()->with('success', "API Key revoked and deleted.");
    }
}
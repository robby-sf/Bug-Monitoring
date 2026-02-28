<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bug;

class BugReceiverController extends Controller
{
    public function receive(Request $request)
    {
        Bug::create([
            'project_name' => $request->project_name, 
            'message'      => $request->message,
            'file'         => $request->file,
            'line'         => $request->line,
            'url'          => $request->url,
            'status'       => $request->status ?? 'open',
        ]);

        return response()->json(['status' => 'Log Berhasil Diterima!'], 201);
    }
}  
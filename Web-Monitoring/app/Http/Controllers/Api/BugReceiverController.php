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
            'app_name' => $request->app_name,
            'message'  => $request->message,
            'file'     => $request->file,
            'line'     => $request->line,
        ]);

        return response()->json(['status' => 'Log Berhasil Diterima!'], 200);
    }
}
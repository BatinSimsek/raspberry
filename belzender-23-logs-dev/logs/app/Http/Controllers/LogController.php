<?php

namespace App\Http\Controllers;

use App\Models\Log;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class LogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $logs = Log::all();

        if ($request->wantsJson()) {
            return response()->json(['logs' => $logs], 200);
        }

        return view('logs.index', ['logs' => $logs]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id, Request $request)
    {
        Log::destroy($id);

        if ($request->wantsJson()) {
            return response()->json(['message' => 'Log deleted successfully'], 200);
        }

        return redirect('logs')->with('flash_message', 'Log deleted!');
    }
    
    /**
     * Store a newly created resource in storage.
     */
    public function trigger()
    {
        $log = Log::create([
            'description' => 'Er wordt aangebeld!'
        ]);

        return response()->json($log);
    }
}

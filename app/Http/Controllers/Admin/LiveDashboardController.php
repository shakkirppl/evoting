<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Candidate;

class LiveDashboardController extends Controller
{
    //
     /**
     * Show Live Dashboard Page
     */
    public function index()
    {
        return view('admin.live-dashboard');
    }

    /**
     * Return live vote data (AJAX)
     */
    public function liveResults()
    {
        $results = Candidate::withCount('votes')->get();

        return response()->json($results);
    }
}

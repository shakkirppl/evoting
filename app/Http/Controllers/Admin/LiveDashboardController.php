<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Candidate;
use App\Models\Vote;
class LiveDashboardController extends Controller
{
     public function index()
    {
        return view('admin.live-dashboard');
    }

    /**
     * Chart + Table Data
     */
    public function liveResults()
    {
        $results = Candidate::withCount('votes')->get();

        return response()->json($results);
    }

    /**
     * View voters of selected candidate
     */
    public function candidateVoters($id)
    {
        $votes = Vote::with(['user','candidate'])
            ->where('candidate_id',$id)
            ->latest()
            ->get();

        return response()->json($votes);
    }
}

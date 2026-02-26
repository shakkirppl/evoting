<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Vote;
use App\Models\Candidate;
use App\Http\Requests\VoteRequest;
class VoteController extends Controller
{
    //
     /**
     * Show voting page
     */
    public function index()
    {
        $user = auth()->user();

        // Prevent revote
        if ($user->has_voted) {
            return redirect()->route('thankyou');
        }

        $candidates = Candidate::all();

        return view('vote.index',compact('candidates'));
    }

    /**
     * Store vote securely
     */
    public function store(VoteRequest $request)
    {
        $user = auth()->user();

        if ($user->has_voted) {
            return back()->with('error','Already voted');
        }

        DB::transaction(function() use ($request,$user){

            Vote::create([
                'user_id'=>$user->id,
                'candidate_id'=>$request->candidate_id
            ]);

            // lock voter
            $user->update([
                'has_voted'=>true
            ]);
        });

        return redirect()->route('thankyou');
    }
}

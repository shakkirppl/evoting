<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Vote;
use App\Models\Candidate;
use App\Http\Requests\VoteRequest;
use App\Models\Election;
class VoteController extends Controller
{
    //
     /**
     * Show voting page
     */
    public function index()
    {

         $candidates = Candidate::all();

    $userVote = auth()->check()
        ? \App\Models\Vote::where('user_id',auth()->id())->first()
        : null;

    return view('welcome',compact('candidates','userVote'));
    }

    /**
     * Store vote securely
     */
   public function vote($candidateId)
    {
        $user = auth()->user();

        if (!$user) {
            return redirect()->route('login');
        }
 /*
    |--------------------------------------------------------------------------
    | Election Status Check
    |--------------------------------------------------------------------------
    */
    $election = Election::first();

    if (!$election || !$election->is_active) {
        return back()->with('error','Election Stopped.');
    }
        // Already voted check
        if (Vote::where('user_id', $user->id)->exists()) {
            return back()->with('error','You already voted.');
        }

        DB::transaction(function () use ($user,$candidateId) {

            Vote::create([
                'user_id'=>$user->id,
                'candidate_id'=>$candidateId
            ]);

        });

        return back()->with('success','Vote submitted successfully.');
    }
}

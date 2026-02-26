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
        // $user = auth()->user();

        // // Prevent revote
        // if ($user->has_voted) {
        //     return redirect()->route('thankyou');
        // }

        // $candidates = Candidate::all();

        // return view('vote.index',compact('candidates'));

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

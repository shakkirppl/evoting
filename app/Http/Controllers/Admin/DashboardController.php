<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Candidate;
class DashboardController extends Controller
{
    //
    public function index()
    {
        $results = Candidate::withCount('votes')->get();

        return view('admin.dashboard',compact('results'));
    }
}

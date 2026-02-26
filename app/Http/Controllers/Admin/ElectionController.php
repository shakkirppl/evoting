<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Election;

class ElectionController extends Controller
{
    //
     public function toggle()
    {
        $election = Election::first();

        if(!$election){
            $election = Election::create([
                'is_active'=>true
            ]);
        }else{
            $election->is_active = !$election->is_active;
            $election->save();
        }

        return back()->with('success','Election Status Updated');
    }
}

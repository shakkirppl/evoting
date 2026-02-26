<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Candidate;
class CandidateController extends Controller
{
     /**
     * Display all candidates
     */
    public function index()
    {
        // Fetch latest candidates (Soft deleted excluded automatically)
       $candidates = Candidate::withCount('votes')->get();
    return view('admin.candidates.index', compact('candidates'));

       
    }

    /**
     * Show create candidate form
     */
    public function create()
    {
        return view('admin.candidates.create');
    }

    /**
     * Store new candidate
     */
    public function store(Request $request)
    {
        // ✅ SECURITY VALIDATION
        $data = $request->validate([
            'name'=>'required|unique:candidates,name|max:100',
            'party'=>'required|max:100',
            'image'=>'nullable|image|mimes:jpg,png,jpeg|max:2048'
        ]);

        // Image Upload
        if($request->hasFile('image')){
            $data['image']=$request->file('image')->store('candidates','public');
        }

        Candidate::create($data);

        return redirect()->route('admin.candidates.index')
        ->with('success','Candidate Added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $candidate = Candidate::findOrFail($id);
        return view('admin.candidates.create',compact('candidate'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $candidate = Candidate::findOrFail($id);

        $data=$request->validate([
            'name'=>"required|unique:candidates,name,$id",
            'party'=>'required',
            'image'=>'nullable|image'
        ]);

        if($request->hasFile('image')){
            if($candidate->image){
                Storage::disk('public')->delete($candidate->image);
            }
            $data['image']=$request->file('image')->store('candidates','public');
        }

        $candidate->update($data);

        return redirect()->route('admin.candidates.index')
        ->with('success','Updated');
    }

     /**
     * Soft delete candidate
     */
    public function destroy($id)
    {
        // Find candidate safely
        $candidate = Candidate::findOrFail($id);

        // Soft delete (deleted_at filled)
        $candidate->delete();

        return back()->with('success', 'Candidate Deleted Successfully');
    }
}

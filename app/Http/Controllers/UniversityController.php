<?php

namespace App\Http\Controllers;

use App\University;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UniversityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //56. Index function
        if (Auth::check()) {
            $universities = University::all();
            return view('universities.index', ['universities'=>$universities]);
        } else {
            return redirect('');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //52. Create function. make sure that user is authenticated...
        if (Auth::check()) {
            return view('universities.create');
        } else {
            return redirect('');
        }
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        //52. ...writing the store function
        //  make sure user is logged in (i.e. only admin can add new universities)

        if (Auth::check()) {
            $universityCreate = University::create([
                'name' => $request->input('name'),
                'abbr' => $request->input('abbr'),
            ]);
    
            if($universityCreate) {
                return 'Success';
            }
    
            return back()->withInput();
        } else {
            return redirect('');
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\University  $university
     * @return \Illuminate\Http\Response
     */
    public function show(University $university)
    {
        //
        return redirect('');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\University  $university
     * @return \Illuminate\Http\Response
     */
    public function edit(University $university)
    {
        //90. Added edit function
        if (Auth::check()) {
            return view('universities.edit', ['university'=>$university]);
        }

        return redirect('');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\University  $university
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, University $university)
    {
        //91. Added update function
        if (Auth::check()) {
            $universityUpdate = University::where('id', $university->id)->update([
                'name'=> $request->input('name'),
                'abbr'=> $request->input('abbr'),
            ]);

            if ($universityUpdate) {
                return 'University updated successfully.';
            }

            return 'university could not be updated.';
    
        }

        return redirect('');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\University  $university
     * @return \Illuminate\Http\Response
     */
    public function destroy(University $university)
    {
        //
    }
}

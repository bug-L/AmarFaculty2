<?php

namespace App\Http\Controllers;

use App\DepartmentUniversity;
use App\University;
use App\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;    

class DepartmentUniversityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        if (Auth::check()) {
            $universities = University::all();
            
            return view('department_university.index', ['universities'=>$universities]);
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
        //
        if (Auth::check()) {
            $universities = University::all();
            $departments = Department::all();
            
            return view('department_university.create', ['universities'=>$universities,
                                                        'departments'=>$departments]);
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
        if (Auth::check()) {

            $university_id = $request->input('university_id');
            $department_id = $request->input('department_id');

            $university = University::find($university_id);
            $department = Department::find($department_id);
            
            
            if ($university !== null && $department !== null) {

                if ($university->departments()->where('department_id', $department->id)->exists() === false) {
                    $university->departments()->attach($department);
                    return 'Success.';  

                }

                    
                
                
                return 'relationship exists you fool.';
                
            }
            
            return 'Something does not exist you fool.';
        }
        return redirect('');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\DepartmentUniversity  $departmentUniversity
     * @return \Illuminate\Http\Response
     */
    public function show(DepartmentUniversity $departmentUniversity)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\DepartmentUniversity  $departmentUniversity
     * @return \Illuminate\Http\Response
     */
    public function edit(DepartmentUniversity $departmentUniversity)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\DepartmentUniversity  $departmentUniversity
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DepartmentUniversity $departmentUniversity)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\DepartmentUniversity  $departmentUniversity
     * @return \Illuminate\Http\Response
     */
    public function destroy(DepartmentUniversity $departmentUniversity)
    {
        //
    }
}

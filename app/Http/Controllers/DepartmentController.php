<?php

namespace App\Http\Controllers;

use App\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //58. Index function
        if (Auth::check()) {
            $departments = Department::all();
            return view('departments.index', ['departments'=>$departments]);
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
        //54. Create function for departments
        if (Auth::check()) {
            return view('departments.create');
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
        //55. writing the store function
        //  make sure user is logged in (i.e. only admin can add new universities)

        if (Auth::check()) {
            $departmentCreate = Department::create([
                'name' => $request->input('name'),
            ]);
    
            if($departmentCreate) {
                return 'Success';
            }
    
            return redirect()->back()->withInput();
        } else {
            return redirect('');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function show(Department $department)
    {
        return redirect('');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function edit(Department $department)
    {
        //92. Added edit function
        if (Auth::check()) {
            return view('departments.edit', ['department'=>$department]);
        }
        return redirect('');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Department $department)
    {
        //93. Added update function
        if (Auth::check()) {
            $departmentUpdate = Department::where('id', $department->id)->update([
                'name'=> $request->input('name'),
            ]);

            if ($departmentUpdate) {
                return 'Department updated successfully.';
            }

            return 'Department could not be updated.';
    
        }

        return redirect('');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function destroy(Department $department)
    {
        //
    }
}

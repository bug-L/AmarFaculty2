<?php

namespace App\Http\Middleware;

use Closure;
use App\University;
use App\Department;

class CheckProfessor
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        /* 
        75. errors:
            1. University must exist.
            2. Department must exist.
            3. Name must be in English and less than 60 characters long.
            X. LATER: University must have department.
        */
        
        $name = $request->input('name');
        $university_id = $request->input('university_id');
        $department_id = $request->input('department_id');
        
        //107. added initials check
        $initials = $request->input('initials');
        
        $error = '';

        //$prof_id = $request->input('professor_id');
        
        //Check if university exists:
        if (University::where('id', '=', $university_id)->exists()) {
            
            //Check if department exists:
            //128. Commented updated if statement to make sure university has the department. old: if (Department::where('id', '=', $department_id)->exists()) {
            //      128 Code Begin:
            $university = University::find($university_id);
            
            if ($university->departments->contains($department_id)) {
            //      128 Code End.

                //Check if name is in English:
                if ( preg_match('/[^A-Za-z.\' ]/', $name)) {
                    //name is not in english
                    $error = 'Name must be typed using English characters only.<br>';
                }

                if ( preg_match('/[^A-Za-z0-9.\' ]/', $initials)) {
                    //INITIALS dont contain valid chars
                    $error .= 'Initials must contain numbers and English characters only.<br>';
                }

                if (strlen($name) < 5) {
                    $error .= 'Name must be at least 5 characters.<br>';
                }

                if (strlen($initials) > 0 && strlen($initials) < 3) {
                    $error .= 'Initials must be at least 3 characters.<br>';
                }

                if (strlen($initials > 5)) {
                    $error .= 'Initials must be less than 5 characters.<br>';
                }

                if (strlen($name) > 60) {
                    $error .= 'Name cannot exceed 60 characters.<br>';
                }

                //if nameErr = '', proceed the request
                if ($error === '') {
                    return $next($request);
                }

                //Name contains error
                return redirect()->back()->withErrors(['error'=>$error])->withInput();
                
            }

            //Department does not exist
            $error = 'Please select a department for this faculty.<br>';
            return redirect()->back()->withInput()->withErrors(['error'=>$error]);
                
        }

        //University does not exist.
        $error = 'Please select a university for this faculty.<br>';
        return redirect()->back()->withInput()->withErrors(['error'=>$error]);
    }

}

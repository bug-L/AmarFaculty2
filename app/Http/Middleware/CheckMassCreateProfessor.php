<?php

namespace App\Http\Middleware;

use Closure;
use App\University;
use App\Department;

class CheckMassCreateProfessor
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
        . 85. errors:
            1. University must exist.
            2. Department must exist.
            3. Name must be in English and less than 60, more than 5 characters long.
        */
        //
        
        $university_id = $request->input('university_id');
        $department_id = $request->input('department_id');

        //check if university and department are set
        if (University::where('id', '=', $university_id)->exists()) {

            //132. commented earlier if statement and replaced with relation exist checker
            //EARLIER IF STATEMENT: if (Department::where('id', '=', $department_id)->exists()) {

            $university = University::find($university_id);
            
            //NEW IF STATEMENT:
            if ($university->departments->contains($department_id)) {
            //132 end.
            
                //keep count how many are invalid, as well as how many lines are input.            
                $totalFail = $count = 0;
                $namesFailed = $errorList = '';
    
                //check each line 
                foreach(preg_split("/((\r?\n)|(\r\n?))/", $request->input('names')) as $line){
                    
                    $name = trim($line);
                    
                    $count += 1;
                        
                    //Check if name is in English:
                    if ( preg_match('/[^A-Za-z.\' ]/', $name)) {  //  \' -- includes single quote
                        //name is not in english
                        $errorList .= '<b>Not in English:</b> ' . $name . '<br>';
                    }

                    if (strlen($name) < 5) {
                        $errorList .= '<b>Under 5 characters:</b> ' . $name . '<br>';
                    }

                    if (strlen($name) > 60) {
                        $errorList .= '<b>Exceeded 60 characters:</b> ' . $name . '<br>';
                    }

                    //allow a maximum of 200 lines
                    if ($count === 200) {
                        $errorList .= '<b>Only put 200 names at a time.</b><br>';
                        return redirect()->back()->withErrors(['error'=>$errorList])->withInput();
                    }
            
                }

                //if nameErr = '', proceed the request
                if ($errorList === '') {
                    return $next($request);
                }

                //Name contains error
                return redirect()->back()->withErrors(['error'=>$errorList])->withInput();

            }

            $errorList = 'Select a department.<br>';
            //Department doesn't exist
            return redirect()->back()->withErrors(['error'=>$errorList])->withInput();

        }

        //University doesn't exist
        $errorList = 'Select a university.<br>';
        return redirect()->back()->withErrors(['error'=>$errorList])->withInput();
        
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use App\University; //part of 134

class CheckProfessorSearch
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

        //29. if query length is more than one, do not process.
        //30. make sure the input is in english. both 29 and 30 in if statement

        //67. errors:   
        //      Search term > 3 characters
        //      search term < 50 characters
        //      Search is in english
        //      Error messages are sent back to view
        //      University must exist

        //134. Now user inputs university ID. Ensure university exists:
        $university_id = $request->input('university_id');
        if (University::where('id', '=', $university_id)->exists()) {

            $strError = '';

            if (strlen($request->input('q'))  < 3) {
                $strError .= 'Name must be more than 3 characters.<br>';
            } 
            if (strlen($request->input('q'))  > 50) {
                $strError .= 'Name must be less than 50 characters.<br>';
            } 
            //105. Now search accepts numbers
            if (preg_match('/[^A-Za-z0-9 ]/', $request->input('q'))) {
                $strError .= 'Name/initials must be typed using English characters and numbers.<br>';
            }

            if (strlen($strError) > 1) {
                return redirect('')->withErrors(['error'=>$strError]);
            }
            return $next($request);
        }
        //university does not exist
        return redirect('')->withErrors(['error'=>'Please select a university.']);
        
        

        //INCLUDE NUMBERS: if (!preg_match('/[^A-Za-z0-9]/', $string)) // '/[^a-z\d]/i' should also work.
{
  // string contains only english letters & digits
}
        
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use App\Professor;

class CheckReview
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
        /* 68. errors:
        
            1. Professor must exist, otherwise redirect to welcome page.
            2. 3 < Course COde length < 20 and english characters and numbers only
            3. 0 < Rating < 6
            4. Take again 0 or 1
            5. Attendance 0 or 1
            6. Description < 400
        */
        
        $error = '';
        $profErr = $codeErr = $ratingErr = $takeErr = $attErr = $desErr = '';

        //$prof_id = $request->input('professor_id');
        
        //Check if professor exists:
        if (Professor::where('id', '=', $request->input('professor_id'))->exists()) {
            
            $code = $request->input('code');
            //Check course code:
            if (strlen($code) < 3 || strlen($code) > 10 || preg_match('/[^A-Za-z0-9.]/', $code)) {
                $codeErr = 'Enter a valid course code without spaces. Example: ACC216, ECON311, CS255';    
                $error .= $codeErr . '<br>';
            }

            //check rating:
            $rating = $request->input('rating');
            if ($rating < 1 || $rating > 5) {
                $ratingErr = 'Rate this professor. (1 = Poor, 5 = Excellent)';
                $error .= $ratingErr . '<br>';
            }
 
            //check take again:
            $takeAgain = $request->input('take-again');
            if ($takeAgain !== '0' && $takeAgain !== '1') {
                $takeErr = 'Will you take this professor again if you could?';
                $error .= $takeErr . '<br>';
            }
            
            //check attendance
            $attendance = $request->input('att');
            if ($attendance !== '0' && $attendance !== '1') {
                $attErr = 'Was attendance mandatory or optional for the course?';
                $error .= $attErr . '<br>';
            }
             
            //check description
            $description = $request->input('description');
            if (strlen($description) > 400) {
                $desErr = 'Description must not exceed 400 characters. Keep it short and to the point.';
                $error .= $desErr . '<br>';
            }

            //check if any errors are set
            if ($codeErr == '' && $ratingErr == '' && $takeErr == '' && $attErr == '' && $desErr == '') {
                return $next($request);
            }
            
            //Error is set.
            return redirect()->back()->withInput()->withErrors(['error'=>$error]);
            /*
            return redirect()->back()->withInput()->withErrors([
                                                        'error'=>$error,
                                                        'ratingErr'=>$ratingErr,
                                                        'takeErr'=>$takeErr,
                                                        'attErr'=>$attErr,
                                                        'desErr'=>$desErr
            ]);
            */

        }

        //69. Professor doesn't exist. redirect back to welcome page.
        return redirect('');
       
    }
}

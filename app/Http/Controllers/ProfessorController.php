<?php

namespace App\Http\Controllers;

use App\Professor;
//33. import department and university
use App\University;
use App\Department;
use App\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;    //31. import

class ProfessorController extends Controller
{
    //76. Create constructor
    public function __construct()
    {
        //77. add middleware to store function
        $this->middleware('checkprof')->only('store', 'update');
        $this->middleware('searchprof')->only('search');
        $this->middleware('checkmcprof')->only('masscreate');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //17. defined index function for professor
        
        if (Auth::check()){     //32. only logged in users can see professors' index page
            //65. Paginated professors.
            $professors = Professor::orderBy('name')->paginate(150);
            return view('professors.index', ['professors'=>$professors]);
        } 
            
        return redirect('');
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        //Attach dept to uni:
        /*
        if (Auth::check()) {
            $deptIds = [66,67,68,51,69,70,71,40,6,72,39,73,74,75,76,77,78,23,79,14,48,12,80,81];
            University::find('5')->departments()->attach($deptIds);
            return 'succes';
        }
        
        */

        //126. New Create function with hasMany relations in mind between uni and dept:
        $uni_dept = array();

        $universities = University::all();

        foreach ($universities as $university) {
            $university_departments = array();
            foreach($university->departments->sortBy('name') as $department) {
                $university_departments[] = array(
                    'department_id' => $department['id'],
                    'department_name' => $department['name'],
                );
            }
            $uni_dept[] = array(
                'university_id' => $university['id'],
                'university_name' => $university['name'],
                'departments' => $university_departments,
            );
        }

        return view('professors.create', ['uni_dept'=>$uni_dept]);
        //END 126

        /*127. Commented out old Create code:
        //34. get all universities and departments to pass to our view.
        $universities = University::all();

        //122. Sort By Name:
        $departments = Department::all()->sortBy('name');
        return view('professors.create', ['universities'=>$universities,
                                            'departments'=>$departments]);
        */                   
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //79. Properly store name using first letter uppercase and  removal of extra spaces:
        $name = preg_replace('/\s+/', ' ', $request->input('name'));
        
        //Convert name into array where there are spaces
        $arrName = explode(' ', $name);

        //this string will contain properly formatted name:
        $formattedName = '';

        //Format each section of the name.
        foreach ($arrName as $partOfName) {
            $partOfName = ucfirst(strtolower($partOfName));
            $formattedName .= $partOfName . ' ';
        }

        $profCreate = Professor::create([
            'name' => trim($formattedName),      //74. store without extra spaces
            //108. Added initials
            'initials' => trim($request->input('initials')),
            'university_id' => $request->input('university_id'),
            'department_id' => $request->input('department_id'),
            'approved' => '0',  //44. added approved field to table and here.
        ]);

        if($profCreate) {
            return redirect()->route('professors.show', ['professor'=>$profCreate]);
        }

        return redirect()->back()->withInput()->withErrors(['error'=>'Could not create new professor. Try again later.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Professor  $professor
     * @return \Illuminate\Http\Response
     */
    public function show(Professor $professor)
    {
        
        //19. show function done
        $professor = Professor::find($professor->id);

        //24. 
        //get reviews for this professor (add approved later)->where('approved', 0)
        
        //63. Modified Code to show only approved reviews...:
        //      OLD CODE: $reviews = $professor->reviews()->get();  
        $reviews = Review::where([
                        ['professor_id', $professor->id],
                        //96. a) commented out approved until website is well established ['approved', '1']
                                ])->get();
        
        //25. if there are reviews then pass additional variables to show.blade view 
        //such as avg rating and take again pct
        if($reviews->count() > 0) {
            $total_rating = 0;  //total rating score will be divided by total count of reviews
            $take_again = 0;    //count for how many students would take him again
            $mandatory = 0;     //122. Send mandatory pct too    

            foreach($reviews as $review){
                $total_rating += $review['rating'];
                if($review['take_again']  == 1) {
                    $take_again += 1;
                }
                if($review['attendance']  == 1) {   //122. continued
                    $mandatory += 1;
                }
            }

            //calculate average rating for the professor
            $avg = number_format($total_rating / $reviews->count(), 1, '.', '');

            //calculate pct of students that would take this prof again
            //  2 Decimal places: $take_again_pct = number_format($take_again / $review->count() * 100, 2, '.', '');
            $take_again_pct = round(($take_again / $reviews->count()) * 100);
            $mandatory_pct = round(($mandatory / $reviews->count()) * 100);     //122. continued

            //63. ...Continued... paginated reviews to send:
            //$paginated_reviews = Review::where('professor_id', $professor->id)->where('approved', '1')->paginate(15); //UGLY
            $paginated_reviews = Review::where([
                                        ['professor_id', $professor->id],
                                        //96. b) Commented out approved. ['approved', '1']
                                            ])->orderBy('id', 'desc')->paginate(10);
            
            return view('professors.show', ['professor'=>$professor,
                                            'avg'=>$avg,
                                            'paginated_reviews'=>$paginated_reviews,
                                            'take_again_pct'=>$take_again_pct,
                                            'mandatory_pct'=>$mandatory_pct,    //122. continued
                                            'approved_count'=>$reviews->count()]);

        }

        //no reviews posted, so just send professor
        return view('professors.show', ['professor'=>$professor]);
        
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Professor  $professor
     * @return \Illuminate\Http\Response
     */
    public function edit(Professor $professor)
    {
        //86. Added edit function
        if (Auth::check()) {

            $universities = University::all();
            $departments = Department::all();
            
            return view('professors.edit', ['universities'=>$universities,
                                            'departments'=>$departments,
                                            'professor'=>$professor]);
        }
        return redirect('');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Professor  $professor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Professor $professor)
    {

        //87. added update function
        if (Auth::check()) {
            $professorUpdate = Professor::where('id', $professor->id)->update([
                'name'=> $request->input('name'),
                //124. Added initials to update function
                'initials'=> $request->input('initials'),
                'university_id'=> $request->input('university_id'),
                'department_id'=> $request->input('department_id'),
            ]);

            if ($professorUpdate) {
                return 'Professor updated successfully.';
            }

            return redirect()->back()->withInput()->withErrors(['error'=>'Professor could not be updated!']);
    
        }

        return redirect('');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Professor  $professor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Professor $professor)
    {
        //61. Delete function
        if (Auth::check()) {
            //results will tell if professor and reviews are  deleted.
            $strResults = '';
            $professorToDelete = Professor::find($professor->id);
            if($professorToDelete->delete()) {
                $strResults .= 'Professor deleted. ';

                //62. Delete associated reviews
                $reviewsToDelete = Review::where('professor_id', $professor->id)->get();
                
                $deletedReviewsCount = 0;   //number of reviews that are deleted

                //delete all reviews associated to professor
                foreach($reviewsToDelete as $review) {
                    if ($review->delete()) {
                        $deletedReviewsCount += 1;
                    }
                }

                $strResults .= $deletedReviewsCount . ' associated reviews deleted.';
                return $strResults;

            }
            return 'Could not delete professor!';
        }

        return redirect('');

    }

    /**
     * 27. Searching a professor from the home page.
     */
    public function search(Request $request)
    {
        // $q stands for query
        $q = $request->input('q');
        //133a. Included university id
        $university_id = $request->input('university_id');
        //133a END
        $professors = Professor::where('university_id', $university_id) //133b. Added university id
                                ->where('name', 'like', '%'.$q.'%')
                                ->orWhere('university_id', $university_id)
                                ->where('initials', $q) //104. Added orWhere
                                ->get();
        $universities = University::all();

        //121. FlashInput Request Before Returning To Search Page so u can see old('q')
        session()->flashInput($request->input());
        
        return view('professors.search', [  'professors'=>$professors,
                                            'universities'=>$universities]);
    }

    //49. Copied most of the code for approve method from reviewController approve method
    //      takes you to admin approval page 
    public function approve()
    {
        if (Auth::check()) {
           
            $professors = Professor::where('approved', '0')
                                    ->orderBy('id', 'desc')
                                    ->paginate(100);
            return view('professors.approve', ['professors'=>$professors,
                                            'index'=>'0']); //index keeps track of each unapproved review
        } else {
            return redirect('');
        }
    }
    //
     //50. ***NOTE THIS FUNCTION WILL NOT WORK PROPERLY IF THE CHECKBOXES ARE NOT ALL CHECKED.
     //     This function will mark new professors as approved or deleted.
     //     copied from ReviewController's massUpdate function
     public function massUpdate(Request $request) {

        //make sure user is logged in
        if (Auth::check()){

            //This form element's value contains whether to approve or delete the unapproved professor
            $approveOrDelete = $request->input('professor-update');
            //All new professor IDs
            $professorIDs = $request->input('professor-id');
            
            //These variables will hold counts of successes and failures.
            $approved = $deleted = $apprFail = $delFail = 0;
            //These variables will hold the ID's of failed operations as string.
            $apprFailIDs = $delFailIds = '';
            //This variable will count each professorID variable to retrieve professorID
            $counter = 0;

            foreach ($approveOrDelete as $newProfessor) {
                //Professor ID:
                $professorID = $professorIDs[$counter];
                //increment counter to have next professor ID in the next loop
                $counter++;

                if ($newProfessor == 'approve') {
                    //Perform  approval.
                    $approveProfessor = Professor::where('id', $professorID)->update([
                        'approved'=>'1',
                    ]);

                    if ($approveProfessor) {
                        $approved += 1;
                    } else {
                        $apprFail += 1;
                        $apprFailIDs .= $professorID . ', ';
                    }
                } elseif ($newProfessor == 'delete') {
                    //Perform  delete.
                    $deleteProfessor = Professor::find( $professorID );

                    if ($deleteProfessor->delete()) {
                        $deleted += 1;
                    } else {
                        $delFail += 1;
                        $delFailIds .= $professorID . ', ';
                    }
                } else {
                    //neither approve nor delete, must be a hacker.
                    return 'Whoa there!';
                }
            }

            return 'Approved ' . $approved . ' professors.<br>' . 
                    'Deleted ' . $deleted . ' professors.<br>' . 
                    'Failed Approvals: ' . $apprFail . '<br>' .
                    'Failed Deletes: ' . $delFail . '<br>' .
                    'Failed Approval Professor IDs: ' . $apprFailIDs . '<br>' .
                    'Failed Delete Professor IDs: ' . $delFailIds . '<br>';



        } else {    //user is not logged in
            return redirect('');
        }
    }

    //82. addeed masscreation function to take to view
    public function masscreation() {
        
        //130. New function with uni-dept relationship 
        if (Auth::check()) {
            $uni_dept = array();

            $universities = University::all();
    
            foreach ($universities as $university) {
                $university_departments = array();
                foreach($university->departments->sortBy('name') as $department) {
                    $university_departments[] = array(
                        'department_id' => $department['id'],
                        'department_name' => $department['name'],
                    );
                }
                $uni_dept[] = array(
                    'university_id' => $university['id'],
                    'university_name' => $university['name'],
                    'departments' => $university_departments,
                );
            }

            return view('professors.masscreation', ['uni_dept'=>$uni_dept]);
        }

        return redirect('');
        
        //130 End

       
        /*129. Commented out old function
        if (Auth::check()) {
            $departments = Department::all();
            $universities = University::all();
            return view('professors.masscreation', [
                                    'departments'=>$departments,
                                    'universities'=>$universities
            ]);
        }
        return redirect('');

        */
    }

    //83. added masscreate function to process masscreation
    public function masscreate(Request $request){
        if (Auth::check()) {
            
            $totalCreate = $totalFail = 0;
            $namesCreate = $namesFailed = '';

            //for each line, create a new professor:
            foreach(preg_split("/((\r?\n)|(\r\n?))/", $request->input('names')) as $line){
                $name = trim($line);
                
                
                $profCreate = Professor::create([
                    'name' => ($name),      //74. store without extra spaces
                    'university_id' => $request->input('university_id'),
                    'department_id' => $request->input('department_id'),
                    'approved' => '1',  //44. added approved field to table and here.
                ]);
        
                if($profCreate) {
                    $totalCreate += 1;
                    $namesCreate .= $name . ', ';
                } else {
                    $totalFail += 1;
                    $namesFailed .= $name . ', ';
                }
            }

            return '<b>Created</b> ' . $totalCreate . ' professors.<br>' . 
                    '<b>Failed</b> ' . $totalFail . ' jobs.<br>' . 
                    '<b>Created prof names:</b> ' . $namesCreate . '<br>' . 
                    '<b>Failed names:</b> ' . $namesFailed . '<br>';
        }
        return redirect('');
    }

    //102. added addInitials function
    public function addInitials()
    {

        /* 103. Commented it out
        $initials = array("SjI", "JBR", "Nzu", "HRK", "NMR", "NDZ", "SBC", "SEQ", " MMS4", "TSR", "ZAM", "SRI", "FDR", "MFQ", "FSH", "NWR", "SK3", "UMQ", "FA2", );
        $prof_id = 257;

        $counter = 0;

        foreach ($initials as $initial) {
            
            if ($prof_id == 462) {
                $prof_id = 463;
            }
            if ($prof_id == 464) {
                $prof_id = 466;
            }
            if ($prof_id == 469) {
                $prof_id = 471;
            }

            $professorUpdate = Professor::where('id', $prof_id)->update(['initials'=> $initial]);
            if ($professorUpdate) {
                $counter++;
            }


            $prof_id++;
        }
        return $counter;
        */
        return redirect('');
    }

    //120a. added sort function 
    public function sort()
    {
        $professors = Professor::withCount('reviews')->orderBy('reviews_count', 'desc')->paginate(50);
        return view('professors.sort', ['professors'=>$professors]);
    }


}

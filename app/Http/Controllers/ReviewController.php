<?php

namespace App\Http\Controllers;

use App\Review;
//21. imported professor
use App\Professor;
use Illuminate\Http\Request; //117a. Commented out this part
use Illuminate\Support\Facades\Auth;    //36. import
//use Request;        //117b. Using request to get IP while storing reviews
use DB;
class ReviewController extends Controller
{
    //72. Create constructor
    public function __construct()
    {
        //73. add middleware to store function
        $this->middleware('checkreview')->only('store');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //57. defined index function for professor
        
        if (Auth::check()){
            //66. Paginated reviews.
            $reviews = Review::orderBy('id', 'desc')->paginate(50);

         
            //123. Additional Review Information:
            $review_count = Review::count();
            $five_count = Review::where('rating', '5')->count();
            $four_count = Review::where('rating', '4')->count();
            $three_count = Review::where('rating', '3')->count();
            $two_count = Review::where('rating', '2')->count();
            $one_count = Review::where('rating', '1')->count();

            //135. distinct ip count 4-8-20
            $unique_count = Review::distinct('user_ip')->count('user_ip');

            return view('reviews.index', ['reviews'=>$reviews,
                                        'review_count'=>$review_count,
                                        'five_count'=>$five_count,
                                        'four_count'=>$four_count,
                                        'three_count'=>$three_count,
                                        'two_count'=>$two_count,
                                        'one_count'=>$one_count,
                                        'unique_count'=>$unique_count]
                                        );
        } else {
            return redirect('');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    //20. defining create method 
    public function create($professor_id) //added prof id as variable
    {
        $professor = Professor::find($professor_id);
        return view('reviews.create', ['professor'=>$professor]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //23. writing the store function

        //119a. added ip to store

        //136. check if review exists to prevent duplicates:
        $user_ip = $request->ip();
        $course_code = strtoupper($request->input('code'));
        $professor_id = $request->input('professor_id');

        if (Review::where('user_ip', $user_ip)->where('course_code', $course_code)->where('professor_id', $professor_id)->exists()) {
            $professor = Professor::find($professor_id);
            $request->session()->flash('alert-success', 'Review posted successfully!');
            return redirect()->route('professors.show', ['professor'=>$professor]);
        }

        //end 136.

        $reviewCreate = Review::create([
            'course_code' => strtoupper($request->input('code')),
            'rating' => $request->input('rating'),
            'take_again' => $request->input('take-again'),
            'attendance' => $request->input('att'),
            'description' => $request->input('description'),
            'professor_id' => $request->input('professor_id'),
            'approved' => '0',
            'offensive' => '0',     //116. added offensive 
            'user_ip' => $request->ip(),             //119b.
        ]);

        if($reviewCreate) {

            $professor = Professor::find($request->input('professor_id'));
            $request->session()->flash('alert-success', 'Review posted successfully!');
            return redirect()->route('professors.show', ['professor'=>$professor,]);
           
        }

        return redirect()->back()->withInput()->withErrors(['error'=>'An unknown error occured. Please try again later.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function show(Review $review)
    {
        if (Auth::check()){
            //59. show function done
            $review = Review::find($review->id);
            //$professor = Professor::find($review->professor_id);
            $professor = Professor::where('id', $review->professor_id)->get();
            return view('reviews.show', ['review'=>$review,
                                        'professor'=>$professor]);

        } else {
            return redirect('');
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function edit(Review $review)
    {
        //88. Added edit function
        if (Auth::check()) {

            return view('reviews.edit', ['review'=>$review]);
        }
        return redirect('');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Review $review)
    {
        //
        //89. added update function
        if (Auth::check()) {

            //125. Added offensive option
            $offensive = '0';
            if (!empty($request->input('offensive'))) {
                $offensive = '1';
            }
            $reviewUpdate = Review::where('id', $review->id)->update([
                'course_code'=> $request->input('code'),
                'description'=> $request->input('description'),
                'offensive'=> $offensive
            ]);

            if ($reviewUpdate) {
                return 'Review updated successfully.';
            }

            return redirect()->back()->withInput()->withErrors(['error'=>'Review could not be updated!']);
    
        }

        return redirect('');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function destroy(Review $review)
    {
        //60. Delete function:
        if (Auth::check()) {
            $reviewToDelete = Review::find($review->id);
            if ($reviewToDelete->delete()) {
                return 'Review deleted.';
            } 
            return 'Could not delete the review.';
        }
        return redirect('');

    }

    //37. If user is logged in, he can approve reviews. Else redirected to front page.
    public function approve() {
        if (Auth::check()) {
           
            $reviews = Review::where('approved', '0')
                                    ->orderBy('created_at', 'desc')
                                    ->paginate(15);
            return view('reviews.approve', ['reviews'=>$reviews,
                                            'index'=>'0']); //index keeps track of each unapproved review
        } else {
            return redirect('');
        }
    }

    //38. This function will update all selected reviews as approved.
    public function massUpdate(Request $request) {

        //make sure user is logged in
        if (Auth::check()){

            /* 39. First MassUpdate Function that worked only for approvals. Now commented out below:
            $reviewIDsToApprove = $request->input('review-update');

            //count successes, failures and which review IDs failed
            $success = 0;
            $failure = 0;
            $failureIDs = '';

            foreach ($reviewIDsToApprove as $reviewID) {
                $updateReview = Review::where('id', $reviewID)->update([
                                        'approved'=>'1',
                ]);
                
                if ($updateReview) {
                    $success += 1;
                } else {
                    $failure += 1;
                    $failureIDs .= $reviewID . ', ';
                }
                
            }

            return 'Success: ' . $success . '. Failed: ' . $failure . '. Failed IDs: ' . $failureIDs;
            */
            
            //40. ***NOTE THIS FUNCTION WILL NOT WORK IF THE CHECKBOXES ARE NOT ALL CHECKED on reviews.approve view.
            //      Second function [check 39]. This allows approvals and deletion of reviews,
            //      counts how many were approved, deleted, failed to approve and failed to delete,
            //      and the IDs of failed operations. returns these counts and ids.:

            //This form element's value contains whether to approve or delete the unapproved review
            $approveOrDelete = $request->input('review-update');
            //All new review IDs
            $reviewIDs = $request->input('review-id');
            
            //114. check if marked offensive 
            //All offensive 
            $offensive = $request->input('offensive');
                    
            
            //These variables will hold counts of successes and failures.
            $approved = $deleted = $apprFail = $delFail = 0;
            //These variables will hold the ID's of failed operations as string.
            $apprFailIDs = $delFailIds = '';
            //This variable will count each reviewID variable to retrieve reviewID
            $counter = 0;

            foreach ($approveOrDelete as $newReview) {
                //Review ID:
                $reviewID = $reviewIDs[$counter];
                //increment counter to have next review ID in the next loop

                
                if ($newReview == 'approve') {

                    if (!empty($offensive[$counter])) {
                        //Perform  approval, mark review as offensive.
                        $approveReview = Review::where('id', $reviewID)->update([
                            'approved'=>'1',
                            'offensive'=>'1',
                        ]);
                    } else {
                        //Perform  approval.
                        $approveReview = Review::where('id', $reviewID)->update([
                            'approved'=>'1',
                        ]);
                    }   

                    if ($approveReview) {
                        $approved += 1;
                    } else {
                        $apprFail += 1;
                        $apprFailIDs .= $reviewID . ', ';
                    }
                } elseif ($newReview == 'delete') {
                    //Perform  delete.
                    $deleteReview = Review::find( $reviewID );

                    if ($deleteReview->delete()) {
                        $deleted += 1;
                    } else {
                        $delFail += 1;
                        $delFailIds .= $reviewID . ', ';
                    }
                } else {
                    //neither approve nor delete, must be a hacker.
                    return 'Whoa there!';
                }

                $counter++;
            }

            return 'Approved ' . $approved . ' reviews.<br>' . 
                    'Deleted ' . $deleted . ' reviews.<br>' . 
                    'Failed Approvals: ' . $apprFail . '<br>' .
                    'Failed Deletes: ' . $delFail . '<br>' .
                    'Failed Approval Review IDs: ' . $apprFailIDs . '<br>' .
                    'Failed Delete Review IDs: ' . $delFailIds . '<br>';



        } else {    //user is not logged in
            return redirect('');
        }
    }

}

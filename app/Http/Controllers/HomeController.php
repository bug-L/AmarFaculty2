<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Review;
use Auth;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    //display all queries
    public function queries()
    {
        if (Auth::check()) { 

            $queries = DB::table('queries')->orderBy('id', 'desc')
                            ->paginate(100);
            return view('admin.queries', [ 'queries'=>$queries]);
        }
    }
}

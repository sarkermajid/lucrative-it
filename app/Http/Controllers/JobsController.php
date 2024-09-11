<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;
use PDF;
use App\Models\Registration;
use App\Models\Jobs;
use App\Models\JobsCategory;
use Validator;
use Str;
use View;


class JobsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function job_list($id)
    {
        $jobs = Jobs::where('category_id',$id)->get();
        $category = JobsCategory::where('id',$id)->value('title');
        return view('jobs.job_list',['jobs'=>$jobs,'category'=>$category]);
    }

    public function job_detail($id)
    {
        $job = Jobs::find($id);
        return view('jobs.job_detail',['job'=>$job]);
    }

    public function test3()
    {
        echo 'ik';

    }


}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use Session;
use Auth;
use App\Models\Committee;
use Storage;


class AjaxController extends Controller
{
    //

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }


    public function division_district(Request $request)
    {
        $division_id = $request->division_id;
        $districts = DB::table('districts')->where('division_id',$division_id)->pluck('bn_name','id');
        echo view('ajax.division_district',['districts'=>$districts]);


    }

    public function district_upzilla(Request $request)
    {
        $district_id = $request->district_id;
        $upzilla = DB::table('upazilas')->where('district_id',$district_id)->pluck('bn_name','id');
        echo view('ajax.district_upzilla',['upzilla'=>$upzilla]);
    }














}

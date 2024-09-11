<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Models\SliderCategory;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use Session;
use Auth;
use Carbon\Carbon;

class SliderCategoryController extends Controller
{
    //

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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $slider_category = SliderCategory::get();
        return view('admin.slider_category.list',['slider_category'=>$slider_category]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.slider_category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
            $allData=$request->all();
            if ($request->hasFile('image')){
                $allData['image']=$request->file('image')->store('images');
            }
            SliderCategory::create($allData);
            Session::flash('message', 'Record added successfully');

           return redirect()->action('Admin\SliderCategoryController@index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user=SliderCategory::select('slider_category.*','role.name as role_title')
                   ->join('role', 'role.id', '=', 'slider_category.role_id')
                   ->find($id);
        return view('admin.slider_category.show',['user'=>$user]);
    }




    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $slider_category=SliderCategory::find($id);
        return view('admin.slider_category.edit',['slider_category'=>$slider_category]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user=SliderCategory::find($id);
        $user->title=$request->title;
        $user->image=$request->image;


        $user->push();
        Session::flash('message', 'Record uddated successfully');
        return redirect()->action('Admin\SliderCategoryController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        SliderCategory::destroy($id); // 1 way
        Session::flash('message', 'Record deleted successfully');
        return redirect()->action('Admin\SliderCategoryController@index');
    }





}

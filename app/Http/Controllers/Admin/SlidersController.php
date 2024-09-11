<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Models\Sliders;
use App\Models\SliderCategory;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use Session;
use Auth;
use Carbon\Carbon;

class SlidersController extends Controller
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
        $sliders = Sliders::get();
        return view('admin.sliders.list',['sliders'=>$sliders]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('admin.sliders.create');
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
            if ($request->file('image')){
                $file=$request->file('image');
                $fileName = md5(uniqid(rand(), true)).'.'.strtolower(pathinfo($file->getClientOriginalName(),PATHINFO_EXTENSION)) ;
                $destinationPath = 'images/' ;
                $file->move($destinationPath,$fileName);
                $allData['image'] = $destinationPath.$fileName;
            }
            Sliders::create($allData);
            Session::flash('message', 'Record added successfully');

           // return back();

           return redirect()->action('Admin\SlidersController@index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user=Sliders::select('sliders.*','role.name as role_title')
                   ->join('role', 'role.id', '=', 'sliders.role_id')
                   ->find($id);
        return view('admin.sliders.show',['user'=>$user]);
    }




    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $sliders=Sliders::find($id);
        $category = SliderCategory::pluck('title','id');
        return view('admin.sliders.edit',['sliders'=>$sliders,'category'=>$category]);
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
        $slider=Sliders::find($id);
        $slider->title=$request->title;
        $slider->short_description=$request->short_description;
        $slider->image=$request->image;
        $slider->status=$request->status;

        if ($request->file('image')){
            $file=$request->file('image');
            $fileName = md5(uniqid(rand(), true)).'.'.strtolower(pathinfo($file->getClientOriginalName(),PATHINFO_EXTENSION));
            $destinationPath = 'images/' ;
            $file->move($destinationPath,$fileName);
            $image = $destinationPath.$fileName;
            $slider->image=$image;
        }


        $slider->push();
        Session::flash('message', 'Record uddated successfully');

        return back();
        //return redirect()->action('Admin\SlidersController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Sliders::destroy($id); // 1 way
        Session::flash('message', 'Record deleted successfully');
        return redirect()->action('Admin\SlidersController@index');
    }





}

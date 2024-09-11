<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Models\Services;
use App\Models\SliderCategory;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use Session;
use Auth;
use Carbon\Carbon;

class ServicesController extends Controller
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
        $services = Services::get();
        return view('admin.services.list',['services'=>$services]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('admin.services.create');
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
            Services::create($allData);
            Session::flash('message', 'Record added successfully');

           // return back();

           return redirect()->route('services.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user=Services::select('sliders.*','role.name as role_title')
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
        $services=Services::find($id);
        return view('admin.services.edit',['services'=>$services]);
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
        $services =  Services::find($id);
        $services->title=$request->title;
        $services->short_description=$request->short_description;
        $services->icon_class=$request->icon_class;
        $services->update();
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
        Services::destroy($id); // 1 way
        Session::flash('message', 'Record deleted successfully');
        return redirect()->route('services.index');
    }





}

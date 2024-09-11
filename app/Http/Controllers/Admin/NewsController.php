<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Models\News;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use Session;
use Auth;
use Carbon\Carbon;

class NewsController extends Controller
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
        $news = News::get();
        return view('admin.news.list',['news'=>$news]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.news.create');
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

            $allData['features'] = serialize($request->feature);



            News::create($allData);
            Session::flash('message', 'Record added successfully');

            //return back();

            return redirect()->action('Admin\NewsController@index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user=News::select('news.*','role.name as role_title')
                   ->join('role', 'role.id', '=', 'news.role_id')
                   ->find($id);
        return view('admin.news.show',['user'=>$user]);
    }




    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $news = News::find($id);

        return view('admin.news.edit',['news'=>$news]);
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


        $user=News::find($id);
        $user->title=$request->title;
        $user->short_description=$request->short_description;
        $user->description=$request->description;
        $user->image=$request->image;
        $user->status=$request->status;

        if ($request->file('image')){
            $file=$request->file('image');
            $fileName = md5(uniqid(rand(), true)).'.'.strtolower(pathinfo($file->getClientOriginalName(),PATHINFO_EXTENSION)) ;
            $destinationPath = 'images/' ;
            $file->move($destinationPath,$fileName);
            $image = $destinationPath.$fileName;
            $user->image=$image;
        }



        $user->push();
        Session::flash('message', 'Record uddated successfully');

        //return back();

        return redirect()->action('Admin\NewsController@index');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        News::destroy($id); // 1 way
        Session::flash('message', 'Record deleted successfully');
        return redirect()->action('Admin\NewsController@index');
    }





}

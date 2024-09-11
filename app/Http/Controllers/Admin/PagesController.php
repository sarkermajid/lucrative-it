
<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Models\Pages;
use App\Models\Menu;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use Session;
use Auth;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Dompdf\FrameDecorator\Page;

class PagesController extends Controller
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
        $pages = Pages::get();
        return view('admin.pages.list',['pages'=>$pages]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $templates = DB::table('templates')->pluck('title','page_name');
        $parent =  Menu::pluck('title','id');
        return view('admin.pages.create',(['templates'=>$templates,'parent'=>$parent]));
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
            $allData['slug'] = Str::slug($request->title, '-');
            $allData['extra'] = serialize($request->extra);

            $pages = Pages::create($allData);

            $menuData['title'] = $pages->title;
            $menuData['link'] = $pages->slug;
            $menuData['status'] = ($request->is_menu=='yes')?'Active':'InActive';
            $menuData['parent_id'] = $request->parent_id;
            Menu::create($menuData);

            Session::flash('message', 'Record added successfully');
             //return back();
           return redirect()->action('Admin\PagesController@index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user=Pages::select('pages.*','role.name as role_title')
                   ->join('role', 'role.id', '=', 'pages.role_id')
                   ->find($id);
        return view('admin.pages.show',['user'=>$user]);
    }




    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pages=Pages::find($id);
        $menu = Menu::where('link',$pages->slug)->first();
        $parent =  Menu::pluck('title','id') ;
        $templates = DB::table('templates')->pluck('title','page_name');
        return view('admin.pages.edit',['pages'=>$pages,'templates'=>$templates,'parent'=>$parent,'menu'=>$menu]);
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
        $page =Pages::find($id);

        $menuData = array(
            'link' => Str::slug($request->title, '-'),
            'status' => ($request->is_menu=='yes')?'Active':'InActive',
            'parent_id' => $request->parent_id,
        );

        Menu::where('link',$page->slug)->update($menuData);

        $page->title=$request->title;
        $page->short_description=$request->short_description;
        $page->description=$request->description;
        $page->template=$request->template;
        $page->extra1=$request->extra1;
        $page->image=$request->image;
        $page->extra_file=$request->extra_file;
        $page->venue_image=$request->venue_image;
        $page->slug = Str::slug($request->title, '-');
        $page->extra = serialize($request->extra);

        $pages = $page->push();



        Session::flash('message', 'Record uddated successfully');

        return back();

       // return redirect()->action('Admin\PagesController@index');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Pages::destroy($id); // 1 way
        Session::flash('message', 'Record deleted successfully');
        return redirect()->action('Admin\PagesController@index');
    }





}

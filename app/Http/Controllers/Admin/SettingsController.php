<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Models\Settings;
use App\Models\Message;
use App\Models\Pages;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use Session;
use Auth;
use Carbon\Carbon;

class SettingsController extends Controller
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
        $settings_label = Settings::where('type','label')->get();

        return view('admin.settings.list',['settings_label'=>$settings_label]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $type =  DB::table('sponsor_type')->pluck('title','id');
        return view('admin.settings.create',(['type'=>$type]));
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

            if ($request->hasFile('logo')){
                $allData['logo']=$request->file('logo')->store('images');
            }

            Settings::create($allData);
            Session::flash('message', 'Record added successfully');

            return redirect()->action('Admin\SettingsController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $settings=Settings::select('settings.*','role.name as role_title')
                   ->join('role', 'role.id', '=', 'settings.role_id')
                   ->find($id);
        return view('admin.settings.show',['user'=>$settings]);
    }




    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $setting = Settings::find($id);

        return view('admin.settings.edit',['setting'=>$setting]);
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
        $settings=Settings::find($id);
        $settings->value=$request->value;

        $settings->push();
        Session::flash('message', 'Record uddated successfully');

        return redirect()->action('Admin\SettingsController@index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Settings::destroy($id); // 1 way
        Session::flash('message', 'Record deleted successfully');
        return redirect()->action('Admin\SettingsController@index');
    }

    public function system_settings()
    {

        return view('admin.settings.system_settings');
    }

    public function system_settings_update(Request $request)
    {
        foreach($request->data as $k=>$value){
            if (DB::table('settings')->where('key',$k)->exists()){
                DB::table('settings')->where('key',$k)->update(['value'=>$value]);
            }else{
                DB::table('settings')->insert(['key' => $k, 'value' => $value]);
            }
        }

        return redirect('admin/system-settings?tab='.$request->tab);

        //return view('admin.settings.system_settings');
    }
}

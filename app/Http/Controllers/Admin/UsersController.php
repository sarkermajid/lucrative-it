<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Moreinfo;
use App\Models\User as ModelsUser;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Session;
use Auth;
use Carbon\Carbon;

class UsersController extends Controller
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
        if (! Gate::allows('User List')) {
            return abort(404);
        }
        $users = User::select('users.*')
                   ->where('type','Admin')
                    ->orderBy('id', 'desc')
                    ->get();

        return view('admin.users.list',['users'=>$users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::get()->pluck('name', 'name');
        return view('admin.users.create',(['roles'=>$roles]));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (User::where('email',$request->email)->exists()){
            session()->flash('error','* User Already Exist');
            return redirect()->action('Admin\UsersController@create')->withInput();
        }

        else{
            $allData=$request->all();
            $allData['password']=bcrypt($request->password);

            $allData['type']='Admin';

            if ($request->file('image')){
                $file=$request->file('image');
                $fileName = md5(uniqid(rand(), true)).'.'.strtolower(pathinfo($file->getClientOriginalName(),PATHINFO_EXTENSION)) ;
                $destinationPath = 'images/' ;
                $file->move($destinationPath,$fileName);
                $allData['image'] = $destinationPath.$fileName;
            }

            //$request->password

            $user=User::create($allData);

            $roles = $request->input('roles') ? $request->input('roles') : [];
            $user->assignRole($roles);


            Session::flash('message', 'Record added successfully');

            //return back();

            return redirect()->action('Admin\UsersController@index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user=User::find($id);
        return view('admin.users.show',['user'=>$user]);
    }




    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user=User::find($id);
        $roles = Role::get()->pluck('name', 'name');
        return view('admin.users.edit',['user'=>$user,'roles'=>$roles]);
    }


    public function profile_edit($id)
    {
        $user=User::find($id);
        return view('admin.users.profile_edit',['user'=>$user]);
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
        $user=User::find($id);
        $user->name=$request->name;
        $user->email=$request->email;
        $user->phone=$request->phone;
        if ($request->file('image')){  exit;
            $file=$request->file('image');
            $fileName = md5(uniqid(rand(), true)).'.'.strtolower(pathinfo($file->getClientOriginalName(),PATHINFO_EXTENSION)) ;
            $destinationPath = 'images/' ;
            $file->move($destinationPath,$fileName);
            $user->image = $destinationPath.$fileName;
        }
        $user->status=$request->status;

        $user->push();

        $roles = $request->input('roles') ? $request->input('roles') : [];
        $user->syncRoles($roles);

        Session::flash('message', 'Record uddated successfully');

        return back();
        /*if(isset($request->profile)){
            return redirect()->action('Admin\UsersController@show',['id'=>$id]);
        }else{
            return redirect()->action('Admin\UsersController@index');
        }*/

    }

    public function profile_update(Request $request)
    {

        if($request->email != Auth::user()->email){
            if (User::where('email',$request->email)->exists()){
                session()->flash('error','* User Already Exist');
                Session::flash('message', 'This Email Already Exist');
                return redirect()->back()->withInput();
            }
        }

        $id = Auth::id();
        $user=User::find($id);
        $user->name=$request->name;
        $user->email=$request->email;
        $user->phone=$request->phone;
        if ($request->file('image')){
            $file=$request->file('image');
            $fileName = md5(uniqid(rand(), true)).'.'.strtolower(pathinfo($file->getClientOriginalName(),PATHINFO_EXTENSION)) ;
            $destinationPath = 'images/' ;
            $file->move($destinationPath,$fileName);
            $user->image = $destinationPath.$fileName;
        }
        if ($request->password) {
            $user->password = bcrypt($request->password);
        }

        $user->push();
        Session::flash('message', 'Profile uddated successfully');

        return back();
       // return redirect()->to('admin/profile/'.$id);


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::destroy($id); // 1 way
        Session::flash('message', 'Record deleted successfully');
        return redirect()->action('Admin\UsersController@index');
    }

    public function password_change($id)
    {
        return view('users.password_change');
    }

    public function password_update(Request $request)
    {
        if ($request->password != $request->confirm_password){
            Session::flash('message', 'Password Not Match');
            return redirect( 'password/change');
        }

        DB::table('users')
            ->where('id', $request->id)
            ->update(['password' => bcrypt($request->password)]);

        Session::flash('message', 'Password Changed Successfully');
        return redirect('users/'.$request->id);
    }

    public function users_more_info($id)
    {
        if((!Moreinfo::where('users_id',$id)->exists())){
            Moreinfo::insert(['users_id'=>$id,'salary'=>null,'team_id'=>null]);
        }
        $more_info = Moreinfo::where('users_id',$id)->first();

        $more_info->purpose = DB::table('salary')->where(['users_id'=>$id,'salary'=>$more_info->salary])->value('purpose');

        return view('users.users_more_info',['more_info'=>$more_info]);
    }

    public function users_more_info_update(Request $request)
    {
        $id = $request->id;
        $users_id = $request->users_id;
        $moreinfo = Moreinfo::find($id);

        if($moreinfo->salary != $request->salary){
            $purpose = ($moreinfo->salary)?$request->purpose:'Initial Salary';
            DB::table('salary')
                ->insert([
                    'users_id' => $users_id,
                    'salary' => $request->salary,
                    'purpose' => $purpose
                ]);
        }
        $destinationPath = 'moreinfo/'.$users_id.'/' ;
        if(!File::exists($destinationPath)) {
            File::makeDirectory($destinationPath, $mode = 0777, true, true);
        }

        if ($request->file('national_id')){
            if (File::exists(public_path().'/'.$moreinfo->national_id)){
                File::delete(public_path().'/'.$moreinfo->national_id);
            }
            $file=$request->file('national_id');
            $fileName =$file->getClientOriginalName();

            $file->move($destinationPath,$fileName);
            $moreinfo->national_id = $destinationPath.$fileName;
        }

        if ($request->file('graduate_certificate')){
            if (File::exists(public_path().'/'.$moreinfo->graduate_certificate)){
                File::delete(public_path().'/'.$moreinfo->graduate_certificate);
            }
            $file=$request->file('graduate_certificate');
            $fileName = $file->getClientOriginalName();

            $file->move($destinationPath,$fileName);
            $moreinfo->graduate_certificate = $destinationPath.$fileName;
        }

        if ($request->file('cv')){
            if (File::exists(public_path().'/'.$moreinfo->cv)){
                File::delete(public_path().'/'.$moreinfo->cv);
            }
            $file=$request->file('cv');
            $fileName = $file->getClientOriginalName();

            $file->move($destinationPath,$fileName);
            $moreinfo->cv = $destinationPath.$fileName;
        }

        if ($request->file('others1')){
            if (File::exists(public_path().'/'.$moreinfo->others1)){
                File::delete(public_path().'/'.$moreinfo->others1);
            }
            $file=$request->file('others1');
            $fileName = $file->getClientOriginalName();

            $file->move($destinationPath,$fileName);
            $moreinfo->others1 = $destinationPath.$fileName;
        }

        if ($request->file('others2')){
            if (File::exists(public_path().'/'.$moreinfo->others2)){
                File::delete(public_path().'/'.$moreinfo->others2);
            }
            $file=$request->file('others2');
            $fileName = $file->getClientOriginalName();

            $file->move($destinationPath,$fileName);
            $moreinfo->others2 = $destinationPath.$fileName;
        }


        DB::table('users_info')
            ->where('id', $id)
            ->update(['national_id' => $moreinfo->national_id,
                      'graduate_certificate' => $moreinfo->graduate_certificate,
                      'cv' => $moreinfo->cv,
                      'others1' => $moreinfo->others1,
                      'others2' => $moreinfo->others2,
                      'team_id' => $request->team_id,
                      'salary' => $request->salary,
                      'joining_date' => $request->joining_date,
                      'expire_date' => $request->expire_date,
                      'address' => $request->address,
                      'confirmation_date' => $request->confirmation_date
            ]);

        Session::flash('message', 'Record Updated Successfully');
        return redirect('more-info/'.$users_id);
    }



}

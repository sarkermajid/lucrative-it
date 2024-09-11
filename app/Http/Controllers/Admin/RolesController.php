<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\Admin\StoreRolesRequest;
use App\Http\Requests\Admin\UpdateRolesRequest;
use Illuminate\Support\Facades\DB;
use Session;

class RolesController extends Controller
{
    /**
     * Display a listing of Role.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $roles = Role::all();

        return view('admin.roles.list', (['roles'=>$roles]));
    }

    /**
     * Show the form for creating new Role.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        //$permissions = Permission::get()->pluck('name', 'name');

        $permissions = Permission::where('parent_id',0)->get();

        foreach($permissions as $row){
            $row->child = Permission::where('parent_id',$row->id)->get();
        }


        return view('admin.roles.create', compact('permissions'));
    }

    /**
     * Store a newly created Role in storage.
     *
     * @param  \App\Http\Requests\StoreRolesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRolesRequest $request)
    {

        $role = Role::create($request->except('permission'));
        $permissions = $request->input('permission') ? $request->input('permission') : [];
        $role->givePermissionTo($permissions);
        Session::flash('message', 'Record created successfully');
        return back();
        //return redirect()->route('admin.roles.list');
    }


    /**
     * Show the form for editing Role.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        //$permissions = Permission::get()->pluck('name', 'name');

        $role = Role::findOrFail($id);

        $role_permissions = DB::table('role_has_permissions')->select('permission_id')->where('role_id',$id)->get();



        $exist_permission = array();
        foreach($role_permissions as $i) {
            $exist_permission[] = $i->permission_id;
        }

     //   $exist_permission = array(2,3,15,13);



        $permissions = Permission::where('parent_id',0)->get();

        foreach($permissions as $row){
            $row->child = Permission::where('parent_id',$row->id)->get();
        }

        return view('admin.roles.edit', (['permissions'=>$permissions,'role'=>$role,'exist_permission'=>$exist_permission]));
    }

    /**
     * Update Role in storage.
     *
     * @param  \App\Http\Requests\UpdateRolesRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRolesRequest $request, $id)
    {
        $role = Role::findOrFail($id);
        $role->update($request->except('permission'));
        $permissions = $request->input('permission') ? $request->input('permission') : [];
        $role->syncPermissions($permissions);
        Session::flash('message', 'Record uddated successfully');
        return back();
        //return redirect()->route('roles.index');
    }


    /**
     * Remove Role from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $role = Role::findOrFail($id);
        $role->delete();

        return redirect()->route('roles.index');
    }

    /**
     * Delete all selected Role at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if ($request->input('ids')) {
            $entries = Role::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

}

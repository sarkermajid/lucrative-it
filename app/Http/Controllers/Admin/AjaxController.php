<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\User;
use App\Webaccount;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use Session;
use Auth;



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
        $this->middleware('auth');
    }



    public function notifications(Request $request)
    {

        echo view('ajax.notifications');
    }

    public function extra_fields(Request $request)
    {
        $template = $request->template;
        $id = $request->id;

        if($request->edit){
            $extra_field = DB::table('pages')->where('template',$template)->where('id',$id)->value('extra');
            $extra_file = DB::table('pages')->where('template',$template)->where('id',$id)->value('extra_file');
            $venue_image = DB::table('pages')->where('template',$template)->where('id',$id)->value('venue_image');
            $extra1 = DB::table('pages')->where('template',$template)->where('id',$id)->value('extra1');
            $extra_field = unserialize($extra_field);
            if($template=='home') {
                echo view('admin.ajax.extra_field.home',(['extra_field'=>$extra_field,'extra_file'=>$extra_file,'venue_image'=>$venue_image,'extra1'=>$extra1]));
            }elseif($template=='invitation') {
                echo view('admin.ajax.extra_field.invitation',(['extra_field'=>$extra_field]));
            }elseif($template=='live_events') {
                echo view('admin.ajax.extra_field.live_events',(['extra_field'=>$extra_field]));
            }

        }else{
            if($template=='home') {
                echo view('admin.ajax.extra_field.home',['extra_file'=>'','venue_image'=>'']);
            }elseif($template=='invitation') {
                echo view('admin.ajax.extra_field.invitation');
            }elseif($template=='live_events') {
                echo view('admin.ajax.extra_field.live_events');
            }
        }

    }

    public function message_submit(Request $request)
    {
        $ticket_id = $request->ticket_id;
        $ticket = DB::table('tickets')->where('id',$ticket_id)->first();

        $user_role = DB::table('model_has_roles')->where('model_id',Auth::id())->value('role_id');
        $role_assign = DB::table('role_assign')->where('id',1)->first();

        if($user_role==$role_assign->client_role_id){
            $receiver_id = $ticket->assign_id;
        }else{
            $receiver_id = $ticket->creator_id;
        }


        DB::table('messages')
            ->insert(['message'=>$request->message,'sender_id'=>Auth::id(),'receiver_id'=>$receiver_id,'ticket_id'=>$ticket_id,'admin_approved'=>$ticket->is_approved]);

        $message_show = DB::table('messages')
            ->select('messages.*','users.name','users.name','users.profile_image','users.designation')
            ->join('users','users.id','messages.sender_id')
            ->where('ticket_id', $ticket_id)
            ->OrderBy('id','desc')
            ->take(10)->get();

        echo view('ajax.conversation',(['message_show'=>$message_show->reverse(),'user_role'=>$user_role,'role_assign'=>$role_assign]));

    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function file_submit(Request $request)
    {

        $ticket_id =  $request->ticket_id;

        $file = $_FILES['image'];
        $allowedExtensions = ["gif", "jpeg", "jpg", "png", "svg","doc","docx","pdf","pptx","ppt","zip","txt","rar","ppsx", "csv", "xlsx"];
        $fileExtension = explode(".", $file["name"]);
        $ym = date('Ym');
        $folder = "messages/$ym/".$ticket_id.'/';
        if (!(file_exists($folder))) {
            mkdir($folder,0777, true);
        }
        $extension = end($fileExtension);

        $newfilename = preg_replace("/[^a-zA-Z0-9.]/", "", $file["name"]);
        $types = ['image/gif', 'image/png', 'image/x-png', 'image/pjpeg', 'image/jpg', 'image/jpeg','image/svg+xml'];
        if( in_array(strtolower($extension), $allowedExtensions) && !$file["error"] > 0)
        {

            $message = DB::table('messages')->where('ticket_id',$ticket_id)->first();
            $user_role = DB::table('model_has_roles')->where('model_id',Auth::id())->value('role_id');
            $role_assign = DB::table('role_assign')->where('id',1)->first();
            if($user_role==$role_assign->client_role_id){
                $receiver_id = $message->receiver_id;
            }else{
                $receiver_id = $message->sender_id;
            }


            if(move_uploaded_file($file["tmp_name"], $folder.$newfilename)){

                DB::table('messages')
                    ->insert(['message'=>$folder.$newfilename,'sender_id'=>Auth::id(),'receiver_id'=>$receiver_id,'ticket_id'=>$ticket_id,'admin_approved'=>'Yes','type'=>'File']);

                $message_show = DB::table('messages')
                                ->select('messages.*','users.name','users.name','users.profile_image','users.designation')
                                ->join('users','users.id','messages.sender_id')
                                ->where('ticket_id', $ticket_id)
                                ->OrderBy('id','desc')
                                ->take(10)->get();

                echo  view('ajax.conversation',(['message_show'=>$message_show->reverse(),'user_role'=>$user_role,'role_assign'=>$role_assign]));

               // echo json_encode(['html' => 'File Upload successfull.','success'=>'success','conversation'=>$conversation]);
            }else{
               // header('Content-Type: application/json');
               // echo json_encode(['html' => 'This file format not allowed, Please choose another','success'=>'fail']);
                echo 'error';
            }
        }else{
            echo 'error';
           // header('Content-Type: application/json');
           // echo json_encode(['html' => 'This file format not allowed, Please select "gif", "jpeg", "jpg", "png", "svg","doc","docx","pdf","pptx","ppt","zip","txt","rar","ppsx", "csv" or "xlsx" file','success'=>'fail']);
        }
    }

    public function bazar_detail(Request $request)
    {
        $bazars = Bazars::find($request->id);
        $bazar_detail = DB::table('bazar_detail')
                              ->select('bazar_detail.*','bazar_unit.unit_name as unit')
                              ->join('bazar_unit','bazar_unit.id','bazar_detail.unit_id')
                              ->where('bazar_id',$request->id)
                              ->get();
        echo view('ajax.bazar_detail',['bazars'=>$bazars,'bazar_detail'=>$bazar_detail]);
    }



}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;
use PDF;
use App\Models\PhysicalInfo;
use App\Models\EducationalInfo;
use App\Models\Payments;
use App\Models\UsersCourseFee;
use App\Models\Training;
use App\User;
use Validator;
use Str;
use Auth;


class ProfileController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }



    public function myprofile()
    {
        $add['division'] = DB::table('divisions')->where('id',Auth::user()->division_id)->value('bn_name');
        $add['district'] = DB::table('districts')->where('id',Auth::user()->district_id)->value('bn_name');
        $add['upazila'] = DB::table('upazilas')->where('id',Auth::user()->upzilla_id)->value('bn_name');
        return view('profile/myprofile',['add'=>$add]);
    }

    public function myprofile_edit()
    {
        $divisions = DB::table('divisions')->pluck('bn_name','id');
        $districts = DB::table('districts')->where('division_id',Auth::user()->division_id)->pluck('bn_name','id');
        $upazilas = DB::table('upazilas')->where('district_id',Auth::user()->district_id)->pluck('bn_name','id');
        
        return view('profile/myprofile_edit',['divisions'=>$divisions,'districts'=>$districts,'upazilas'=>$upazilas]);
    }

    public function myprofile_update(Request $request)
    {
        $user=User::find(Auth::id());
        $user->title=$request->title;
        $user->name=$request->name;
        $user->phone=$request->phone;
        $user->father_name=$request->father_name;
        $user->mother_name=$request->mother_name;
        $user->spouse_name=$request->spouse_name;
        $user->nationality=$request->nationality;
        $user->national_id_card=$request->national_id_card;
        $user->dob=$request->dob;
        $user->birth_place=$request->birth_place;
        $user->nominee=$request->nominee;

        $user->gender=$request->gender;
        $user->maharram=$request->maharram;
        $user->maharram_relation=$request->maharram_relation;
        $user->maharram_mobile_no=$request->maharram_mobile_no;
        $user->present_address=$request->present_address;
        $user->division_id=$request->division_id;
        $user->district_id=$request->district_id;
        $user->upzilla_id=$request->upzilla_id;
        $user->per_post_office=$request->per_post_office;
        $user->per_villlege=$request->per_villlege;
        $user->proffession=$request->proffession;
        $user->institute=$request->institute;
        $user->educational_institute=$request->educational_institute;
        $user->passing_year=$request->passing_year;

        if ($request->hasFile('image')){
            $user->image =$request->file('image')->store('images');
        }

        if ($request->hasFile('national_id_photo')){
            $user->national_id_photo = $request->file('national_id_photo')->store('images');
        }

        $user->save();
        return redirect('myprofile');
    }


    public function contact_info()
    {
        $contact_info = User::where('id',Auth::id())->first();
        return view('profile/contact_info',['contact_info'=>$contact_info]);
    }

    public function contact_info_edit()
    {
        $contact_info = User::where('id',Auth::id())->first();
        return view('profile/contact_info_edit',['contact_info'=>$contact_info]);
    }

    public function physical_info_insert(Request $request)
    {
        $allData=$request->all();
        $allData['hajji_id'] = Auth::id();

        PhysicalInfo::create($allData);

        return redirect('physical-info');
    }

    public function contact_info_update(Request $request)
    {
        $physical_info = User::where('id',Auth::id())->first();
        $physical_info->phone=$request->phone;
        $physical_info->home_phone=$request->home_phone;
        $physical_info->email=$request->email;
        $physical_info->reference=$request->reference;

        $physical_info->save();
        return redirect('contact-info');
    }

    public function educational_info()
    {
        $educational_info = EducationalInfo::where('user_id',Auth::id())->first();



        return view('profile/educational_info',['educational_info'=>$educational_info]);
    }

    public function educational_info_insert(Request $request)
    {
        $allData=$request->all();
        $allData['user_id'] = Auth::id();

        EducationalInfo::create($allData);

        return redirect('educational-info');
    }

    public function educational_info_edit()
    {
        $educational_info = EducationalInfo::where('user_id',Auth::id())->first();
        return view('profile/educational_info_edit',['educational_info'=>$educational_info]);
    }

    public function educational_info_update(Request $request)
    {
        $user=EducationalInfo::where('user_id',Auth::id())->first();
        $user->institute_name=$request->institute_name;
        $user->officer_contact_number=$request->officer_contact_number;
        $user->address=$request->address;
        $user->class_year=$request->class_year;
        $user->branch_name=$request->branch_name;
        $user->course_title=$request->course_title;


        $user->save();
        return redirect('educational-info');
    }


    public function payments()
    {
        $payments = UsersCourseFee::where('user_id',Auth::id())->get();
        foreach($payments as $payment){
            $payment->total_amount = Payments::where('user_course_id',$payment->id)->sum('amount');
        }

        return view('profile/payments',['payments'=>$payments]);
    }

    public function payment_detail($id)
    {
        $payments = UsersCourseFee::where('user_id',Auth::id())->where('course_id',$id)->first();
        $payments_detail = Payments::where('user_course_id',$payments->id)->where('status','Active')->get();
        return view('profile/payment_detail',['payments'=>$payments,'payments_detail'=>$payments_detail]);
    }





    public function payment_add(Request $request)
    {
        $courses = Training::pluck('title','id');
        return view('profile/payment_add',['courses'=>$courses]);
    }

    public function payment_insert(Request $request)
    {
        $user_id = Auth::id();
        $course_id = $request->course_id;

        if (UsersCourseFee::where(['user_id'=>$user_id,'course_id'=>$course_id])->exists()) {
            $user_course_id = UsersCourseFee::where(['user_id'=>$user_id,'course_id'=>$course_id])->value('id');
        }else{
            $ucfdata['user_id'] = Auth::id();
            $ucfdata['course_id'] = $request->course_id;
            $ucfdata['course_fee'] = Training::where('id',$course_id)->value('course_fee');
            $user_course = UsersCourseFee::create($ucfdata);
            $user_course_id = $user_course->id;
        }

        $paymentdata['user_course_id'] = $user_course_id;
        $paymentdata['amount'] =  $request->amount;
        $paymentdata['type'] =  'Bkash';
        $paymentdata['trabsaction_id'] =  $request->trabsaction_id;
        Payments::create($paymentdata);

        return redirect('payments');
    }
















}

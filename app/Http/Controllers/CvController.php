<?php

namespace App\Http\Controllers;

use App\Mail\ReportSent;
use App\Mail\SellerContacted;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\CvBasicInfo;
use App\Models\CvExpInfo;
use App\Models\CvAcaInfo;
use App\Models\CvTrInfo;
use App\Models\CvPqInfo;
use App\Models\CvLanInfo;
use App\Models\CvRefInfo;
use PDF;


class CvController  extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
	

	public function resume_view(Request $request)
		{
            $user_id = Auth::id();
            $basic_info = CvBasicInfo::where('user_id',$user_id )->first();
            $aca_info = CvAcaInfo::where('user_id',Auth::id() )->get();
            $tr_info = CvTrInfo::where('user_id',Auth::id() )->get();
            $pq_info = CvPqInfo::where('user_id',Auth::id() )->get();
            $ref_infos = CvRefInfo::where('user_id',Auth::id())->get();
            $lan_infos = CvLanInfo::where('user_id',Auth::id())->get();
            $exp_infos = CvExpInfo::where('user_id',Auth::id())->get();
		    return view('resume.resume_view',['basic_info'=>$basic_info,'aca_info'=>$aca_info,'tr_info'=>$tr_info,'pq_info'=>$pq_info,'ref_infos'=>$ref_infos,'lan_infos'=>$lan_infos,'exp_infos'=>$exp_infos]);
		}

	
	public function resume_view_step1(Request $request)
		{
		    $user_id = Auth::id();
            $basic_info = CvBasicInfo::where('user_id',$user_id )->first();
            $divisions = DB::table('divisions')->pluck('bn_name','id');
            $districts = DB::table('districts')->where('division_id',Auth::user()->division_id)->pluck('bn_name','id');
            $upazilas = DB::table('upazilas')->where('district_id',Auth::user()->district_id)->pluck('bn_name','id');
			return view('resume.resume_view_step1',['basic_info'=>$basic_info,'divisions'=>$divisions,'districts'=>$districts,'upazilas'=>$upazilas]);
		}
		
	public function personal_form_edit_submit(Request $request)
		{
            $basic_info=CvBasicInfo::find($request->id);
            $basic_info->first_name=$request->first_name;
            $basic_info->last_name=$request->last_name;
            $basic_info->father_name=$request->father_name;
            $basic_info->mother_name=$request->mother_name;
            $basic_info->dob=$request->dob;
            $basic_info->gender=$request->gender;
            $basic_info->religion=$request->religion;
            $basic_info->mstatus=$request->mstatus;
            $basic_info->nationality=$request->nationality;
            $basic_info->national_id=$request->national_id;
            $basic_info->passport_no=$request->passport_no;
            $basic_info->passport_issue_date=$request->passport_issue_date;
            $basic_info->phone_h=$request->phone_h;
            $basic_info->phone_off=$request->phone_off;
            $basic_info->email2=$request->email2;
            $basic_info->save();
            echo 'success';
		}


    public function address_form_edit_submit(Request $request)
    {
        $basic_info=CvBasicInfo::find($request->id);
        $basic_info->present_add = $request->present_add;
        $basic_info->permanent_add = $request->permanent_add;
        $basic_info->save();
        echo 'success';
    }



    public function cai_form_edit_submit(Request $request)
    {
        $basic_info=CvBasicInfo::find($request->id);
        $basic_info->objective=$request->objective;
        $basic_info->present_salary=$request->present_salary;
        $basic_info->expected_salary=$request->expected_salary;
        $basic_info->job_level=$request->job_level;
        $basic_info->job_nature=$request->job_nature;

        $basic_info->save();
        echo 'success';
    }



		    /*start resume step 2*/
	public function resume_view_step2(Request $request)
    {
        $aca_info = CvAcaInfo::where('user_id',Auth::id() )->get();

        $tr_info = CvTrInfo::where('user_id',Auth::id() )->get();
        $pq_info = CvPqInfo::where('user_id',Auth::id() )->get();
        return view('resume.resume_view_step2',['aca_info'=>$aca_info,'tr_info'=>$tr_info,'pq_info'=>$pq_info]);
    }

    public function aca_edit_submit(Request $request)
    {
        if($request->id){
            $exp_info=CvAcaInfo::find($request->id);
        }else{
            $exp_info = new CvAcaInfo;
        }

        $exp_info->education_level = $request->education_level;
        $exp_info->concentration = $request->concentration;
        $exp_info->board = $request->board;
        $exp_info->instute_name = $request->instute_name;
        $exp_info->duration = $request->duration;
        $exp_info->passing_year = $request->passing_year;
        $exp_info->duration = $request->duration;
        $exp_info->achievement = $request->achievement;
        $exp_info->result = $request->result;
        $exp_info->user_id = Auth::id();
        $exp_info->save();
        echo 'success';
    }

    public function aca_delete(Request $request)
    {
        $id = $request->id;
        CvAcaInfo::where('id',$id)->delete();
        echo 'success';
    }

    public function tr_edit_submit(Request $request)
    {
        if($request->id){
            $exp_info=CvTrInfo::find($request->id);
        }else{
            $exp_info = new CvTrInfo;
        }

        $exp_info->training_title = $request->training_title;
        $exp_info->country = $request->country;
        $exp_info->topics_covered = $request->topics_covered;
        $exp_info->training_year = $request->training_year;
        $exp_info->institute = $request->institute;
        $exp_info->duration = $request->duration;
        $exp_info->location = $request->location;
        $exp_info->user_id = Auth::id();
        $exp_info->save();
        echo 'success';
    }

    public function tr_delete(Request $request)
    {
        $id = $request->id;
        CvTrInfo::where('id',$id)->delete();
        echo 'success';
    }

    public function pq_edit_submit(Request $request)
    {
        if($request->id){
            $exp_info=CvPqInfo::find($request->id);
        }else{
            $exp_info = new CvPqInfo;
        }

        $exp_info->certification = $request->certification;
        $exp_info->location = $request->location;
        $exp_info->institute = $request->institute;
        $exp_info->start_date = $request->start_date;
        $exp_info->end_date = $request->end_date;
        $exp_info->user_id = Auth::id();
        $exp_info->save();
        echo 'success';
    }

    public function pq_delete(Request $request)
    {
        $id = $request->id;
        CvPqInfo::where('id',$id)->delete();
        echo 'success';
    }


    /*end resume step 2*/

	

    public function resume_view_step3(Request $request)
    {
        $exp_infos = CvExpInfo::where('user_id',Auth::id())->get();
        return view('resume.resume_view_step3',['exp_infos'=>$exp_infos]);
    }

    public function exp_form(Request $request)
    {
        echo view('resume.exp_form');
    }

    public function cv_form(Request $request)
    {
        $type = $request->type;
        echo view('resume.form/'.$type);
    }

    public function exp_edit_submit(Request $request)
    {
        if($request->id){
            $exp_info=CvExpInfo::find($request->id);
        }else{
            $exp_info = new CvExpInfo;
        }


        $exp_info->company_name = $request->company_name;
        $exp_info->responsibilities = $request->responsibilities;
        $exp_info->company_business = $request->company_business;
        $exp_info->company_location = $request->company_location;
        $exp_info->designation = $request->designation;
        $exp_info->department = $request->department;
        $exp_info->start_date = $request->start_date;
        $exp_info->end_date = $request->end_date;
        $exp_info->experiences_area = $request->experiences_area;
        $exp_info->currently_working = $request->currently_working;
        $exp_info->user_id = Auth::id();
        $exp_info->save();
        echo 'success';

    }

	public function employment_delete(Request $request)
    {
        $id = $request->id;
        CvExpInfo::where('id',$id)->delete();
        echo 'success';
    }
		
		
                           /* start resume step 4*/
		
	public function resume_view_step4(Request $request)
    {
        $ref_infos = CvRefInfo::where('user_id',Auth::id())->get();
        $lan_infos = CvLanInfo::where('user_id',Auth::id())->get();
        return view('resume.resume_view_step4',['lan_infos'=>$lan_infos,'ref_infos'=>$ref_infos]);
    }



    public function lan_edit_submit(Request $request)
    {
        if($request->id){
            $lan_info=CvLanInfo::find($request->id);
        }else{
            $lan_info = new CvLanInfo;
        }

        $lan_info->language = $request->language;
        $lan_info->reading = $request->reading;
        $lan_info->writing = $request->writing;
        $lan_info->speaking = $request->speaking;
        $lan_info->user_id = Auth::id();
        $lan_info->save();
        echo 'success';
    }

    public function lan_delete(Request $request)
    {
        $id = $request->id;
        CvLanInfo::where('id',$id)->delete();
        echo 'success';
    }

    public function ref_edit_submit(Request $request)
    {
        if($request->id){
            $ref_info = CvRefInfo::find($request->id);
        }else{
            $ref_info = new CvRefInfo;
        }

        $ref_info->name = $request->name;
        $ref_info->organization = $request->organization;
        $ref_info->designation = $request->designation;
        $ref_info->phone_off = $request->phone_off;
        $ref_info->mobile = $request->mobile;
        $ref_info->phone_res = $request->phone_res;
        $ref_info->email = $request->email;
        $ref_info->address = $request->address;
        $ref_info->relation = $request->relation;
        $ref_info->user_id = Auth::id();
        $ref_info->save();
        echo 'success';
    }

    public function ref_delete(Request $request)
    {
        $id = $request->id;
        CvRefInfo::where('id',$id)->delete();
        echo 'success';
    }


    
    public function resume_view_step5(Request $request)
		{
            $user_id = Auth::id();
            $basic_info = CvBasicInfo::where('user_id',$user_id )->first();
		    return view('resume.resume_view_step5',['basic_info'=>$basic_info]);
		}	
		

	public function resume_view_step5_edit_submit(Request $request)
		{

            $cv_basic_info = CvBasicInfo::find($request->id);

            $file = $request->file('photograph');

            if($file){
                /*$fileName = $file->getClientOriginalName();
                $fileName = date('ymdHis').$fileName;
                $s3 = Storage::disk('s3');
                $s3->put($fileName, file_get_contents($file));*/

                $cv_basic_info->photograph = time().'.'.$file->getClientOriginalExtension();

                $destinationPath = public_path('/images');

                $file->move($destinationPath, $cv_basic_info->photograph);

                $cv_basic_info->push();

                return back();
            }




		}
		
	
		




		public function cv_pdf()
        {
            $user_id = Auth::id();
            $basic_info = CvBasicInfo::where('user_id',$user_id )->first();
            $aca_info = CvAcaInfo::where('user_id',Auth::id() )->get();
            $tr_info = CvTrInfo::where('user_id',Auth::id() )->get();
            $pq_info = CvPqInfo::where('user_id',Auth::id() )->get();
            $ref_infos = CvRefInfo::where('user_id',Auth::id())->get();
            $lan_infos = CvLanInfo::where('user_id',Auth::id())->get();
            $exp_infos = CvExpInfo::where('user_id',Auth::id())->get();

            $pdf = PDF::loadView('pdf.cv',['basic_info'=>$basic_info,'aca_info'=>$aca_info,'tr_info'=>$tr_info,'pq_info'=>$pq_info,'ref_infos'=>$ref_infos,'lan_infos'=>$lan_infos,'exp_infos'=>$exp_infos]);
            return $pdf->download('cv.pdf');
		}

}

<?php

namespace App\Http\Controllers\Jobboard;
use App\Http\Controllers\Controller;


use App\Mail\ReportSent;
use App\Mail\SellerContacted;
use Illuminate\Support\Facades\File;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;




class ResumeController  extends Controller
{

    public function __construct()
    {
        //$this->middleware('auth');
    }
	
	
	public function seeker_edit_profile(Request $request)
		{		
			$id = $this->user->id;						
			$data['seeker_detail']  = DB::table('jb_seekers_basic_info')->where('id', $id)->first();
			view()->share('seeker_detail', $data['seeker_detail']);
			
			$data['gender'] = DB::table('gender')->get();
		    view()->share('gender',$data['gender']);
						
			return view('jobboard.jobseekers.seeker_edit_profile');
		}
	
	public function seeker_edit_profile_submit(Request $request)
		{		
			$first_name =  $request->input('first_name');
			$last_name =  $request->input('last_name');
			$gender_id =  $request->input('gender_id');
			$mobile =  $request->input('mobile');
			$email =  $request->input('email');

	
		   $id = $this->user->id;
		
		    DB::table('jb_seekers_basic_info')
              ->where('id', $id)
              ->update(['first_name' => $first_name,
			            'last_name' => $last_name,
						'gender_id' => $gender_id,
						'mobile' => $mobile,
						'email' => $email,
		
			  ]);
		
			
			return redirect('seeker-edit-profile');
		}
		
		
		
    public function seeker_password_change($id=null)
		{		
						
			return view('jobboard.jobseekers.seeker_password_change');
		}
		
     public function seeker_password_change_submit(Request $request)
		{		
		   $old_password = $request->input('old_password');
		   $new_password = $request->input('new_password');
	
		   $id = $this->user->id;
		
		    DB::table('jb_seekers_basic_info')
            ->where('id', $id)
            ->update(['password' => $new_password]);
			
			return redirect('seeker-edit-profile');
		}
	
	
	
	
	
	
	
    

	
	public function resume_view(Request $request)
		{		
		   exit;

		    $seekers_user_id = $this->user->id;
	      
		   $resume = DB::table('jb_seekers_basic_info')->where('user_id',$seekers_user_id )->first();
		
		   $resume->academic = DB::table('jb_seekers_academic_summery')->where('user_id',$seekers_user_id)->get();
		   $resume->professional = DB::table('jb_seekers_professional_summery')->where('user_id',$seekers_user_id )->get();
		   
		   
		   view()->share('resume', $resume); 

			
			return view('jobboard.jobseekers.resume_view');
		}
		
	public function my_account(Request $request)
		{		
		   $seekers_user_id = Auth::id();

		   $resume = DB::table('jb_seekers_basic_info')->where('user_id',$seekers_user_id )->count();

		   if(!$resume){
               DB::table('jb_seekers_basic_info')->insert(['user_id' => $seekers_user_id,]);
           }


           $resume = DB::table('jb_seekers_basic_info')->where('user_id',$seekers_user_id )->first();

		   $resume->academic = DB::table('jb_seekers_academic_summery')->where('user_id',$seekers_user_id )->get();
		   $resume->professional = DB::table('jb_seekers_professional_summery')->where('user_id',$seekers_user_id )->get();
		   
		   
		   view()->share('resume', $resume); 

			// View
			return view('jobboard.jobseekers.my_account');
		}	
		
		
	
	public function resume_view_step1(Request $request)
		{	   

		    exit;
		    $seekers_user_id = $this->user->id;
		    $resume = DB::table('jb_seekers_basic_info')->where('user_id',$seekers_user_id )->first();         		
			$resume->academic = DB::table('jb_seekers_academic_summery')->where('user_id',$seekers_user_id )->get();			 		    
			view()->share('resume', $resume);
			return view('jobboard.jobseekers.resume_view_step1');
		}
		
	public function personal_form_edit_submit(Request $request)
		{	   
			$id =  $request->input('id');
			$alldata =  $request->all();

			$update = DB::table('jb_seekers_basic_info')
				->where('id', $id)
				->update($alldata);
		 
		  
		        echo $update;
		  		  		    
		}


		
	
		
		
		
		
		
		
		
		
		
	public function resume_view_step2(Request $request)
		{	   
		    $seekers_user_id = $this->user->id;	
		    $resume = DB::table('jb_seekers_basic_info')->where('user_id',$seekers_user_id )->first();		   
			$resume->academic = DB::table('jb_seekers_academic_summery')->where('user_id',Auth::id())->get();
			$resume->training = DB::table('jb_seekers_training_summery')->where('user_id',$resume->id )->get();
			$resume->professional = DB::table('jb_seekers_professional_summery')->where('user_id',$resume->id )->get();
			
			view()->share('resume', $resume);

			return view('jobboard.jobseekers.resume_view_step2');
		}
		
	public function resume_view_step2_post(Request $request)
		{	   
			$alldata =  $request->all();
			$alldata['user_id'] = Auth::id(); 
		    DB::table('jb_seekers_academic_summery')->insert($alldata);	
			return redirect('resume-view-step2');
		}
		
	public function resume_view_step2_edit(Request $request)
		{	   		
			$alldata =  $request->all();
			DB::table('jb_seekers_academic_summery')
				->where('id', $alldata['id'])
				->update($alldata);						
			
		}
		
    public function resume_view_step2_delete($id)
		{	   		
			DB::table('jb_seekers_academic_summery')->where('id', '=', $id)->delete();
			return redirect('resume-view-step2');
		}
		
		
		
    public function resume_view_step2_academic_delete(Request $request)
		{	   
			$id = $_POST['id'];
		 
		    DB::table('jb_seekers_academic_summery')->where('id',$id)->delete();
		  
		  echo 'success';
		  		  		    
		}
		
		


	
    public function resume_view_step3(Request $request)
		{	   
		   $seekers_user_id = $this->user->id;	   
		
		   $resume = DB::table('jb_seekers_basic_info')->where('user_id',$seekers_user_id )->first();
		   $resume->employment = DB::table('jb_seekers_employment_summery')->where('user_id',$resume->id )->get();
		   
		   
			view()->share('resume', $resume);
			
			$tab = 'employment';
		    view()->share('tab', $tab);
		
			// View
			return view('jobboard.jobseekers.resume_view_step3');
		}	
		
		
		
	public function resume_view_step3_employment_edit_submit(Request $request)
		{	   
			$id =  $request->input('id');
			$employment_id = $request->input('employment_id');
			$company_name = $request->input('company_name');
			$responsibilities = $request->get('responsibilities');
			$company_business = $request->input('company_business');
			$company_location = $request->input('company_location');
			$designation = $request->input('designation');
			$department = $request->input('department');
			$start_date = $request->input('start_date');
			$end_date = $request->input('end_date');
			$Experiences_area = $request->input('Experiences_area');
		
	
			
			if($employment_id){
			
				DB::table('jb_seekers_employment_summery')
				->where('id', $employment_id)
				->update([
			                  'company_name' => $company_name,
							  'responsibilities' => $responsibilities,
							  'company_business' => $company_business,
							  'company_location' => $company_location,
							  'designation' => $designation,
							  'department' => $department,
							  'start_date' => $start_date,
							  'end_date' => $end_date,
							  'Experiences_area' => $Experiences_area,
							  'user_id' => $id,
					]);			 			  
					echo 'success';
			}else{
				
				DB::table('jb_seekers_employment_summery')->insert([
					           'company_name' => $company_name,
							  'responsibilities' => $responsibilities,
							  'company_business' => $company_business,
							  'company_location' => $company_location,
							  'designation' => $designation,
							  'department' => $department,
							  'start_date' => $start_date,
							  'end_date' => $end_date,
							  'Experiences_area' => $Experiences_area,
							  'user_id' => $id,
					]);			 			  
					echo 'success';
				
			}	
		  		  		    
		}

	public function resume_view_step3_employment_delete(Request $request)
		{	   
			$id = $_POST['id'];
		 
		    DB::table('jb_seekers_employment_summery')->where('id',$id)->delete();
		  
		    echo 'success';
		  		  		    
		}	
		
		

		
	public function resume_view_step4(Request $request)
		{	   
		   $seekers_user_id = $this->user->id;	   
		
		   $resume = DB::table('jb_seekers_basic_info')->where('user_id',$seekers_user_id )->first();
		   $resume->language = DB::table('jb_seekers_language_summery')->where('user_id',$resume->id )->get();
		   $resume->reference = DB::table('jb_seekers_reference_summery')->where('user_id',$resume->id )->get();
		   view()->share('resume', $resume);
			
			$tab = 'other';
		    view()->share('tab', $tab);
		
		
			return view('jobboard.jobseekers.resume_view_step4');
		}
		
	public function resume_view_step4_specification_edit_submit(Request $request)
		{	   
			$id =  $request->input('id');
			$skills = $request->input('skills');
			$skills_description =  $request->get('skills_description');
			$skills_activities =  $request->get('skills_activities');


	
			DB::table('jb_seekers_basic_info')
				->where('id', $id)
				->update(['skills' => $skills,
						  'skills_description' => $skills_description,
						  'skills_activities' => $skills_activities	
				]);		 		  
		    echo 'success';  		    
		}

	public function resume_view_step4_language_edit_submit(Request $request)
		{	   
			$id =  $request->input('id');
			$language_id = $request->input('language_id');
			$language = $request->input('language');
			$reading = $request->input('reading');
			$writing = $request->input('writing');
			$speaking = $request->input('speaking');
		
	
			
			if($language_id){
			
				DB::table('jb_seekers_language_summery')
				->where('id', $language_id)
				->update([
							  'language' => $language,
							  'reading' => $reading,
							  'writing' => $writing,
							  'speaking' => $speaking,
							  'user_id' => $id,
					]);			 			  
					echo 'success';
			}else{
				
				DB::table('jb_seekers_language_summery')->insert([
							
							  'language' => $language,
							  'reading' => $reading,
							  'writing' => $writing,
							  'speaking' => $speaking,
							  'user_id' => $id,
					]);			 			  
					echo 'success';
				
			}	
		  		  		    
		}

	public function resume_view_step4_language_delete(Request $request)
		{	   
			$id = $_POST['id'];
		 
		    DB::table('jb_seekers_language_summery')->where('id',$id)->delete();
		  
		    echo 'success';
		  		  		    
		}

	public function resume_view_step4_reference_edit_submit(Request $request)
		{	   
			$id =  $request->input('id');
			$reference_id = $request->input('reference_id');
			$name =  $request->input('name');
			$organization =  $request->input('organization');
			$designation =  $request->input('designation');
			$phone_off =  $request->input('phone_off');
			$mobile =  $request->input('mobile');
			$phone_res =  $request->input('phone_res');
			$email =  $request->input('email');
			$address =  $request->get('address');
			
			
	
			
			if($reference_id){
			
				DB::table('jb_seekers_reference_summery')
				->where('id', $reference_id)
				->update([
		                      'name' => $name,
							  'organization' => $organization,
							  'designation' => $designation,
							  'phone_off' => $phone_off,
							  'mobile' => $mobile,
							  'phone_res' => $phone_res,
							  'email' => $email,
							  'address' => $address,
							  'user_id' => $id,
					]);			 			  
					echo 'success';
			}else{
				
				DB::table('jb_seekers_reference_summery')->insert([
						
							  'name' => $name,
							  'organization' => $organization,
							  'designation' => $designation,
							  'phone_off' => $phone_off,
							  'mobile' => $mobile,
							  'phone_res' => $phone_res,
							  'email' => $email,
							  'address' => $address,
							  'user_id' => $id,
					]);			 			  
					echo 'success';
				
			}	
		  		  		    
		}

	public function resume_view_step4_reference_delete(Request $request)
		{	   
			$id = $_POST['id'];

		    DB::table('jb_seekers_reference_summery')->where('id',$id)->delete();
		  
		    echo 'success';
		  		  		    
		}

	
	public function resume_others_skill(Request $request)
		{	   
		   $seekers_user_id = $this->user->id;	   
		
		   $resume = DB::table('jb_seekers_basic_info')->where('user_id',$seekers_user_id )->first();
		   $resume->language = DB::table('jb_seekers_language_summery')->where('user_id',$resume->id )->get();
		   $resume->reference = DB::table('jb_seekers_reference_summery')->where('user_id',$resume->id )->get();
		   view()->share('resume', $resume);			
			
			
			return view('jobboard.jobseekers.resume_others_skill');
		}
	
	public function resume_hobbies(Request $request)
		{	   
		   $seekers_user_id = $this->user->id;	   
		
		   $resume = DB::table('jb_seekers_basic_info')->where('user_id',$seekers_user_id )->first();
		   $resume->language = DB::table('jb_seekers_language_summery')->where('user_id',$resume->id )->get();
		   $resume->reference = DB::table('jb_seekers_reference_summery')->where('user_id',$resume->id )->get();
		   view()->share('resume', $resume);			
			
			$tab = 'other';
		    view()->share('tab', $tab);				
			return view('jobboard.jobseekers.resume_hobbies');
		}

	public function resume_reference(Request $request)
		{	   
		   $seekers_user_id = $this->user->id;	   
		
		   $resume = DB::table('jb_seekers_basic_info')->where('user_id',$seekers_user_id )->first();
		   $resume->language = DB::table('jb_seekers_language_summery')->where('user_id',$resume->id )->get();
		   $resume->reference = DB::table('jb_seekers_reference_summery')->where('user_id',$resume->id )->get();
		   view()->share('resume', $resume);									
		   return view('jobboard.jobseekers.resume_reference');
		}	
    
    public function resume_view_step5(Request $request)
		{	   
		   $seekers_user_id = $this->user->id;	   
		
		   $resume = DB::table('jb_seekers_basic_info')->where('user_id',$seekers_user_id )->first();
		   view()->share('resume', $resume);

			return view('jobboard.jobseekers.resume_view_step5');
		}	
		
	
	
	
		
		
	public function resume_view_step5_edit_submit(Request $request)
		{
            		
			if ($request->file('picture')) {
				
				$file = $request->file('picture');
				$destination_path = 'uploads/resume/';
				$full_destination_path = public_path() . '/' . $destination_path;
										
				$filename_gen = uniqid('img_');
				
				if (!File::exists($full_destination_path)) {
					File::makeDirectory($full_destination_path, 0755, true);
				}
				$extension = $file->getClientOriginalExtension();
				$new_filename = strtolower($filename_gen . '.' . $extension);
				$file->move($full_destination_path,$new_filename);						
			}

            $id =  $request->input('id');
			$images =  $destination_path.$new_filename;
			
			DB::table('jb_seekers_basic_info')
				->where('id', $id)
				->update(['photograph' => $images,						  
				]);
            return redirect('resume-view-step5'); 
		}
		
	
		
		
	public function resume_upload(Request $request)
		{	   
		    $seekers_user_id = $this->user->id;		   
		
		    $resume = DB::table('jb_seekers_basic_info')->where('user_id',$seekers_user_id )->first();
			view()->share('resume', $resume);
			
			return view('jobboard.jobseekers.resume_upload');
		  		  		    
		}

    public function resume_upload_submit(Request $request)
		{	   
		    if ($request->file('picture')) {
				
				$file = $request->file('picture');
				$destination_path = 'uploads/resume/';
				$full_destination_path = public_path() . '/' . $destination_path;
										
				$filename_gen = uniqid('cv_');
				
				if (!File::exists($full_destination_path)) {
					File::makeDirectory($full_destination_path, 0755, true);
				}
				$extension = $file->getClientOriginalExtension();
				$new_filename = strtolower($filename_gen . '.' . $extension);
				$file->move($full_destination_path,$new_filename);
			}

            $id =  $request->input('id');
			$images =  $destination_path.$new_filename;
			
			DB::table('jb_seekers_basic_info')
				->where('id', $id)
				->update(['cv' => $images,						  
				]);
				
			return redirect('resume-upload')->with(['success' => 1, 'message' => $this->msg['resume']['success']]);	
            //return redirect('resume-upload'); 
		  		  		    
		}		
		
	
	public function resume_email()
		{	   
		
		  	 return view('jobboard.jobseekers.resume_email');	  		    
		}
	
	public function resume_email_submit()
		{	   
		
		  	 return view('jobboard.jobseekers.resume_email');	  		    
		}
		
	public function application_job(Request $request)
		{	   
		     $employer_id = $this->user->id;


			 $data['application_job_list']  = DB::table('jb_application_job')
			                        ->select('jb_application_job.*','jb_employers_basic_info.company_name','jb_employers_job_post.job_title')
			                        ->join('jb_employers_job_post', 'jb_employers_job_post.id', '=', 'jb_application_job.jb_employers_job_post_id')
									->leftjoin('jb_employers_basic_info', 'jb_employers_basic_info.user_id', '=', 'jb_application_job.user_id_employer')
									->where('jb_application_job.user_id_employer',$employer_id)
									->get();

            view()->share('application_job_list', $data['application_job_list']);
		  	 return view('jobboard.jobseekers.application_job');	  		    
		}


    public function application_job_employee(Request $request)
    {
        $employer_id = $this->user->id;


        $data['application_job_list']  = DB::table('jb_application_job')
            ->select('jb_application_job.*','jb_employers_job_post.job_title')
            ->join('jb_employers_job_post', 'jb_employers_job_post.id', '=', 'jb_application_job.jb_employers_job_post_id')
            ->leftjoin('jb_seekers_basic_info', 'jb_seekers_basic_info.user_id', '=', 'jb_application_job.user_id_seeker')
            ->where('jb_application_job.user_id_seeker',$employer_id)
            ->get();

        view()->share('application_job_list', $data['application_job_list']);
        return view('jobboard.jobseekers.application_job');
    }





		
	public function candidate_resume($id,Request $request)
		{		
	   
		
		   $resume = DB::table('jb_seekers_basic_info')->where('id',$id )->first();
		   $resume->academic = DB::table('jb_seekers_academic_summery')->where('user_id',$resume->id )->get();
		   $resume->professional = DB::table('jb_seekers_professional_summery')->where('user_id',$resume->id )->get();
		   view()->share('resume', $resume);
           $data['cr'] = 'cr';		   

			// View
			return view('jobboard.jobseekers.resume_view',$data);
		}

	
    

    
		
	
	
	

   

	

	
	


	

	
	

}

<?php
/**
 * LaraClassified - Geo Classified Ads CMS
 * Copyright (c) BedigitCom. All Rights Reserved
 *
 * Website: http://www.bedigit.com
 *
 * LICENSE
 * -------
 * This software is furnished under a license and may be used and copied
 * only in accordance with the terms of such license and with the inclusion
 * of the above copyright notice. If you Purchased from Codecanyon,
 * Please read the full License from here - http://codecanyon.net/licenses/standard
 */

namespace App\Http\Controllers\jobboard;
use App\Http\Controllers\FrontController;


use App\Http\Controllers\FrontJobboardController;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Select;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Larapen\Helpers\Localization\Helpers\Country as CountryLocalizationHelper;
use App\Larapen\Helpers\Localization\Country as CountryLocalization;
use Auth;



class EmployerController  extends FrontController
{

    public function __construct()
    {
        parent::__construct();

		$countries = CountryLocalizationHelper::transAll(CountryLocalization::getCountries(), $this->lang->get('abbr'));
        view()->share('countries', $countries);

        // Messages
        $this->msg['message']['success'] = "Your message has send successfully to :seller_name.";
        $this->msg['report']['success'] = "Your report has send successfully to us. Thank you!";
        $this->msg['mail']['error'] = "The sending messages is not enabled. Please check the SMTP settings in the admin.";
        $this->msg['notification']['expiration'] = "Warning! This ad has expired. The product or service is not more available (may be)";
    }
	
	public function employer_edit_profile(Request $request)
		{		

			$employers_user_id = Auth::id();
			$data['employer_detail']  = DB::table('jb_employers_basic_info')->where('user_id', $employers_user_id)->first();
			view()->share('employer_detail', $data['employer_detail']);
			$data['organization_type'] = DB::table('jb_organization_type')->get();
		    view()->share('organization_type',$data['organization_type']);
			return view('jobboard.employers.employer_edit_profile');
		}
	
	public function employer_edit_profile_submit(Request $request)
		{		
			$company_name =  $request->input('company_name');
			$contact_person =  $request->input('contact_person');
			$contact_person_dgn =  $request->input('contact_person_dgn');
			$contact_person_email =  $request->input('email');
			$business_description =  $request->input('business_description');
			$company_address =  $request->input('company_address');
			$organization_type_id =  $request->input('organization_type_id');
			
			$company_logo = $request->file('company_logo');
			if($company_logo){
				$destinationPath = 'uploads/company_logo';
				$company_logo = $company_logo->move($destinationPath,$company_logo->getClientOriginalName());
			}else{
				$company_logo = $request->input('balnk_logo');;
			}

            $id = $this->user->id;

            $employers_basic_info = DB::table('jb_employers_basic_info')->where('user_id', $id)->first();

            if($employers_basic_info){
                DB::table('jb_employers_basic_info')
                    ->where('user_id', $id)
                    ->update([
                        'company_name' => $company_name,
                        'contact_person' => $contact_person,
                        'contact_person_dgn' => $contact_person_dgn,
                        'contact_person_email' => $contact_person_email,
                        'business_description' => $business_description,
                        'company_address' => $company_address,
                        'organization_type_id' => $organization_type_id,
                        'company_logo' => $company_logo,
                    ]);
            }else{

                DB::table('jb_employers_basic_info')->insert([
                    'company_name' => $company_name,
                    'contact_person' => $contact_person,
                    'contact_person_dgn' => $contact_person_dgn,
                    'contact_person_email' => $contact_person_email,
                    'business_description' => $business_description,
                    'company_address' => $company_address,
                    'organization_type_id' => $organization_type_id,
                    'company_logo' => $company_logo,
                    'user_id' =>$id,
                ]);

            }
	

		

		
			
			return redirect('employer-edit-profile');
		}
		
		
		
    public function employer_password_change($id=null)
		{

			$data['jb_categories']  = DB::table('jb_categories')->get();
			view()->share('jb_categories', $data['jb_categories']);

			return view('jobboard.employers.employer_password_change');
		}
		
     public function employer_password_change_submit(Request $request)
		{		
		   $old_password = $request->input('old_password');
		   $new_password = $request->input('new_password');
	
		   $id = $request->session()->get('employers_user_id');
		
		    DB::table('jb_employers_basic_info')
            ->where('id', $id)
            ->update(['password' => $new_password]);
			
			return redirect('employer-edit-profile');
		}
	
    public function my_account_employer($id=null)
		{

			return view('jobboard.employers.my_account_employer');
		}	
		
		
	
	public function post_new_job($id=null)
		{
			$data['jb_categories']  = DB::table('jb_categories')->get();
			view()->share('jb_categories', $data['jb_categories']);


			
			return view('jobboard.employers.post_new_job');
		}


    public function post_edit_job($id=null)
    {

        $data['jb_categories']  = DB::table('jb_categories')->get();
        view()->share('jb_categories', $data['jb_categories']);

        $data['job']  = DB::table('jb_employers_job_post')->where('id', $id)->first();
        view()->share('job', $data['job']);

        return view('jobboard.employers.post_new_job');
    }


	

		

		
	public function post_new_job_edit_submit(Request $request)
		{	   
			$id =  $request->input('id');
			$job_title = $request->input('job_title');
			$job_type = $request->input('job_type');
			
			

			$category_id =  $request->input('category_id');
			$job_description =  $request->input('job_description');
			$job_role =  $request->input('job_role');
			$role_type =  $request->input('role_type');
			$educational_requirements =  $request->input('educational_requirements');
			$experince_requirements =  $request->input('experince_requirements');
			$relevant_requirements =  $request->input('relevant_requirements');
			$salary =  $request->input('salary');
			$job_location =  $request->input('job_location');
			$job_source =  $request->input('job_source');
			$application_deadlines =  $request->input('application_deadlines');
			$feachered = $request->input('feachered');
			$employers_user_id = Auth::id();


		
 
			
			if($id){
			
				DB::table('jb_employers_job_post')
				->where('id', $id)
				->update([
							  'job_title' => $job_title,
							  'job_type' => $job_type,
							  'category_id' => $category_id,
							  'job_description' => $job_description,
							  'job_role' => $job_role,
							  'role_type' => $role_type,
							  'educational_requirements' => $educational_requirements,
							  'experince_requirements' => $experince_requirements,
							  'relevant_requirements' => $relevant_requirements,
							  'salary' => $salary,
							  'job_location' => $job_location,
							  'job_source' => $job_source,
							  'application_deadlines' => $application_deadlines,
							  'feachered' => $feachered,
							  'user_id' => $employers_user_id,
					]);			 			  
				
			}else{   
				
				DB::table('jb_employers_job_post')->insert([
							  'job_title' => $job_title,
							  'job_type' => $job_type,
							  'category_id' => $category_id,
							  'job_description' => $job_description,
							  'job_role' => $job_role,
							  'role_type' => $role_type,
							  'educational_requirements' => $educational_requirements,
							  'experince_requirements' => $experince_requirements,
							  'relevant_requirements' => $relevant_requirements,
							  'salary' => $salary,
							  'job_location' => $job_location,
							  'job_source' => $job_source,
							  'application_deadlines' => $application_deadlines,
							  'feachered' => $feachered,
							  'user_id' => $employers_user_id,
					]);			 			  
				
				
			}	
		  	return redirect('employer-job-list');	  		    
		}
		
	public function employer_job_delete($id)
		{		
			
			DB::table('jb_employers_job_post')->where('id',$id)->delete();
			
			return redirect('employer-job-list');
		}
		
		

		
	

    public function employer_job_list_category($category_id,$skilled_id=null)
		{		
			
			$data['organization_type'] = DB::table('jb_organization_type')->get();
		    view()->share('organization_type',$data['organization_type']);
			if($skilled_id){
				$data['job_list']  = DB::table('jb_employers_job_post')
			                        ->select('jb_employers_job_post.*','jb_employers_basic_info.company_name')
			                        ->join('jb_employers_basic_info', 'jb_employers_basic_info.id', '=', 'jb_employers_job_post.user_id')
			                        ->where('jb_employers_job_post.category_id',$category_id)
									->where('jb_employers_job_post.job_type',3)
									->get();
			}else{
				$data['job_list']  = DB::table('jb_employers_job_post')
			                        ->select('jb_employers_job_post.*','jb_employers_basic_info.company_name')
			                        ->join('jb_employers_basic_info', 'jb_employers_basic_info.id', '=', 'jb_employers_job_post.user_id')
			                        ->where('jb_employers_job_post.category_id',$category_id)
									->get();
			}
			
			$data['jb_categories'] = DB::table('jb_categories')->get();
		    view()->share('jb_categories',$data['jb_categories']);
			
									
            view()->share('job_list', $data['job_list']);
			
			return view('jobboard.employers.employer_job_list_search');
		}
		
		public function employer_job_list_company($company_id)
		{
			$data['organization_type'] = DB::table('jb_organization_type')->get();
		    view()->share('organization_type',$data['organization_type']);
		
				$data['job_list']  = DB::table('jb_employers_job_post')
			                        ->select('jb_employers_job_post.*','jb_employers_basic_info.company_name')
			                        ->join('jb_employers_basic_info', 'jb_employers_basic_info.id', '=', 'jb_employers_job_post.user_id')
			                        ->where('jb_employers_basic_info.id',$company_id)
									->get();
			
			
			$data['jb_categories'] = DB::table('jb_categories')->get();
		    view()->share('jb_categories',$data['jb_categories']);

            view()->share('job_list', $data['job_list']);
			
			return view('jobboard.employers.employer_job_list_search');
		}
		
	
		
		
	public function employer_job_list(Request $request)
		{		
			

			
			$employers_user_id = $this->user->id;

			
			$data['job_list']  = DB::table('jb_employers_job_post')
			                       ->select('jb_employers_job_post.*','jb_employers_basic_info.company_name')
			                       ->leftjoin('jb_employers_basic_info', 'jb_employers_basic_info.user_id', '=', 'jb_employers_job_post.user_id')
								   ->where('jb_employers_job_post.user_id',$employers_user_id)
								   
			                       ->get();
			
            view()->share('job_list', $data['job_list']);
			$data['organization_type'] = DB::table('jb_organization_type')->get();
		    view()->share('organization_type',$data['organization_type']);
			
			
			return view('jobboard.employers.employer_job_list');
		}
		
	public function employer_job_application_list(Request $request)
		{		
			

			$employers_user_id = $this->user->id;	
            
			$data['job_application_list']  = DB::table('jb_application_job')
			                        ->select('jb_application_job.*','jb_employers_job_post.job_title','jb_seekers_basic_info.first_name','jb_seekers_basic_info.last_name','jb_seekers_basic_info.cv','jb_employers_job_post.id as job_id')
			                        ->join('jb_employers_job_post', 'jb_employers_job_post.id', '=', 'jb_application_job.jb_employers_job_post_id')
									->join('jb_seekers_basic_info', 'jb_seekers_basic_info.user_id', '=', 'jb_application_job.user_id_seeker')
									->where('jb_application_job.user_id_employer',$employers_user_id)
									->get();
            view()->share('job_application_list', $data['job_application_list']);
			
			
			$data['organization_type'] = DB::table('jb_organization_type')->get();
		    view()->share('organization_type',$data['organization_type']);
			
			
			return view('jobboard.employers.employer_job_application_list');
		}	
		
		
    public function employer_job_list_search(Request $request)
		{

		    $job_title = Input::get('job_title');
		    $organization_type_id = Input::get('organization_type_id');
			
			$data['job_list']  = DB::table('jb_employers_job_post')
			                       ->select('jb_employers_job_post.*','jb_employers_basic_info.company_name')
			                       ->leftjoin('jb_employers_basic_info', 'jb_employers_basic_info.id', '=', 'jb_employers_job_post.user_id')
								   ->leftjoin('jb_organization_type', 'jb_organization_type.id', '=', 'jb_employers_basic_info.organization_type_id')
								   ->where('jb_employers_job_post.job_title', 'like', '%'.$job_title.'%')
								   ->get();            
			
			view()->share('job_list', $data['job_list']);
			$data['organization_type'] = DB::table('jb_organization_type')->get();
		    view()->share('organization_type',$data['organization_type']);
			
			$data['jb_categories'] = DB::table('jb_categories')->get();
		    view()->share('jb_categories',$data['jb_categories']);
			
			$data['job_title'] = $job_title;
			$data['organization_type_id'] = $organization_type_id;
			$data['organization_type_id'] = $organization_type_id;
			
			return view('jobboard.employers.employer_job_list_search',$data);
		}
		
    public function candidate_interview($id,Request $request)
		{		

			
			$data['id'] = $id;
			$employers_user_id = $this->user->id;	
            
			$data['job_application_list']  = DB::table('jb_application_job')
			                        ->select('jb_application_job.*','jb_employers_job_post.job_title','jb_seekers_basic_info.first_name','jb_seekers_basic_info.last_name','jb_employers_job_post.id as job_id')
			                        ->join('jb_employers_job_post', 'jb_employers_job_post.id', '=', 'jb_application_job.jb_employers_job_post_id')
									->join('jb_seekers_basic_info', 'jb_seekers_basic_info.user_id', '=', 'jb_application_job.user_id_seeker')
									->where('jb_application_job.user_id_employer',$employers_user_id)
									->get();
            view()->share('job_application_list', $data['job_application_list']);
			
			
			$data['organization_type'] = DB::table('jb_organization_type')->get();
		    view()->share('organization_type',$data['organization_type']);
			
			
			return view('jobboard.employers.candidate_interview',$data);
		}
   	
		
    public function candidate_interview_submit(Request $request)
		{	   
			$id =  $request->input('id');
			$interview_date = $request->input('interview_date');
			$interview_time =  $request->input('interview_time');
			$short_message =  $request->input('short_message');
			
		
		    $interview_date = date('Y-m-d H:i:s', strtotime("$interview_date $interview_time"));
                                                      
		
            $seekers_info  = DB::table('jb_application_job')
			                        ->select('jb_seekers_basic_info.email')			                        
									->join('jb_seekers_basic_info', 'jb_seekers_basic_info.user_id', '=', 'jb_application_job.user_id_seeker')
									->where('jb_application_job.id',$id)
									->first();
									
									
			$seekeremail = $seekers_info->email;
	
			
				DB::table('jb_application_job')
				->where('id', $id)
				->update([
					  'interview_date' => $interview_date,
					  'short_message' => $short_message,
					  'interview_call' => 'Yes'
					]);			 			  
				
		
		  	return redirect('candidate-interview-submit-success');	  		    
		}
		
	public function candidate_interview_submit_success()
    {        
		return view('jobboard.employers.candidate_interview_submit_success');
    }	
		


	

	
	


	

	
	

}

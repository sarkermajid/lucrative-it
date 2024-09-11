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


use App\Larapen\Helpers\Arr;
use App\Larapen\Models\Category;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Select;
use App\Larapen\Models\Pack;
use Larapen\TextToImage\Facades\TextToImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Larapen\Helpers\Localization\Helpers\Country as CountryLocalizationHelper;
use App\Larapen\Helpers\Localization\Country as CountryLocalization;
use App\Larapen\Models\BizCategory;
use App\Larapen\Models\Location;
use Auth;


class JobboardController  extends FrontController
{
    public $msg = [];


    public $expire_time = 24;


    public function __construct()
    {
        parent::__construct();

		// Check Country URL for SEO
		$countries = CountryLocalizationHelper::transAll(CountryLocalization::getCountries(), $this->lang->get('abbr'));
        view()->share('countries', $countries);

        // Messages
        $this->msg['message']['success'] = "Your message has send successfully to :seller_name.";
        $this->msg['report']['success'] = "Your report has send successfully to us. Thank you!";
        $this->msg['mail']['error'] = "The sending messages is not enabled. Please check the SMTP settings in the admin.";
        $this->msg['notification']['expiration'] = "Warning! This ad has expired. The product or service is not more available (may be)";
    }

	public function index()
    {

        //$request->session()->set('employers_username',$request->input('username'));

		$data['organization_type'] = DB::table('jb_organization_type')->get();
		view()->share('organization_type',$data['organization_type']);

		$data['jb_categories'] = DB::table('jb_categories')->get();
		view()->share('jb_categories',$data['jb_categories']);


		$data['jb_feacher'] = DB::table('jb_employers_job_post')
		                        ->select('jb_employers_job_post.id','jb_employers_job_post.job_title','jb_employers_basic_info.company_name','jb_employers_basic_info.company_logo')
		                        ->join('jb_employers_basic_info', 'jb_employers_basic_info.user_id', '=', 'jb_employers_job_post.user_id')
		                        ->where('feachered',1)
                                ->orderBy('id','desc')
		                        ->get();



		$data['jb_govt'] = DB::table('jb_employers_job_post')
		                        ->where('job_type',1)
                                ->orderBy('id','desc')
		                        ->get();

		$data['jb_graduate'] = DB::table('jb_employers_job_post')
		                        ->select('jb_employers_job_post.id','jb_employers_job_post.job_title','jb_employers_basic_info.company_name','jb_employers_basic_info.company_logo')
		                        ->join('jb_employers_basic_info', 'jb_employers_basic_info.user_id', '=', 'jb_employers_job_post.user_id')
		                        ->where('job_type',2)
                                ->orderBy('id','desc')
		                        ->get();


        return view('jobboard.index',$data);
    }






	public function category($id)
    {
			 // CATEGORIES COLLECTION
        $cats = Category::where('translation_lang', $this->lang->get('abbr'))->orderBy('lft')->get();

        if (!is_null($cats)) {
            $cats = collect($cats)->keyBy('translation_of');
        }
        view()->share('cats', $cats);
        $this->cats = $cats;


		$bizdirectory_list = DB::table('jb_jobs')->where('jb_jobs.category_id', $id)
            ->join('biz_locations', 'biz_locations.id', '=', 'jb_jobs.location_id')
            ->select('jb_jobs.*', 'biz_locations.name as location','biz_locations.parent_id')
            ->get();
		view()->share('bizdirectory_list', $bizdirectory_list);

		$bizcategory_list = DB::table('biz_categories')->get();
		view()->share('bizcategory_list', $bizcategory_list);
        // View
        return view('jobboard.directory_post');
    }

	public function jb_user(Request $request)
    {
			 // CATEGORIES COLLECTION
        $cats = Category::where('translation_lang', $this->lang->get('abbr'))->orderBy('lft')->get();

        if (!is_null($cats)) {
            $cats = collect($cats)->keyBy('translation_of');
        }
        view()->share('cats', $cats);
        $this->cats = $cats;

		$id = $request->session()->get('user_id');



		$bizdirectory_list = DB::table('jb_jobs')->where('jb_jobs.user_id', $id)
            ->join('biz_locations', 'biz_locations.id', '=', 'jb_jobs.location_id')
            ->select('jb_jobs.*', 'biz_locations.name as location','biz_locations.parent_id')
            ->get();
		view()->share('bizdirectory_list', $bizdirectory_list);

		$bizcategory_list = DB::table('biz_categories')->get();
		view()->share('bizcategory_list', $bizcategory_list);
        // View
        return view('jobboard.jb_user');
    }





	public function create()
    {
        $categories = BizCategory::where('translation_lang', config('app.locale'))->orderBy('lft')->get();
        if (is_null($categories)) {
            return [];
        }

		view()->share('categories', $categories);

        $locations = Location::where('translation_lang', config('app.locale'))->orderBy('lft')->get();
        if (is_null($locations)) {
            return [];
        }

		view()->share('locations', $locations);

		$bizdirectory_list = DB::table('jb_jobs')->where('jb_jobs.category_id', Input::get('c'))
            ->join('biz_locations', 'biz_locations.id', '=', 'jb_jobs.location_id')
			->join('biz_categories', 'biz_categories.id', '=', 'jb_jobs.category_id')
			->where('biz_locations.name', 'like', '%' . Input::get('location') . '%')
            ->select('jb_jobs.*', 'biz_locations.name as location','biz_locations.parent_id')
            ->get();
		view()->share('bizdirectory_list', $bizdirectory_list);

		$bizcategory_list = DB::table('biz_categories')->get();
		view()->share('bizcategory_list', $bizcategory_list);
        // View
        return view('jobboard.create');
    }




	public function edit($id)
    {

        $categories = BizCategory::where('translation_lang', config('app.locale'))->orderBy('lft')->get();
        if (is_null($categories)) {
            return [];
        }

		view()->share('categories', $categories);

        $locations = Location::where('translation_lang', config('app.locale'))->orderBy('lft')->get();
        if (is_null($locations)) {
            return [];
        }

		view()->share('locations', $locations);

		$jb_jobs = DB::table('jb_jobs')->where('id', $id)->first();
		view()->share('jb_jobs', $jb_jobs);

        return view('jobboard.edit');
    }

	public function edit_submit(Request $request)
    {



	      $country_code = strtolower($this->country->get('code'));
        // UPLOAD FILES : PICTURES
        if ($request->file('pictures')) {
            $destination_path = 'uploads/pictures/';
            $prefix_filename = $country_code . '/';
            $full_destination_path = public_path() . '/' . $destination_path . $prefix_filename;

            // Proccess file request
            $files = $request->file('pictures');
            $count_files = count($files);


            if ($count_files > 0) {
                // Generate filename
                $filename_gen = uniqid('img_');
				$images = array();
                foreach ($files as $key => $file) {
                    // Check empty fields
                    if (is_null($file) or count($file) <= 0) {
                        continue;
                    }
                    try {
                        // Create destination path if not exists
                        if (!File::exists($full_destination_path)) {
                            File::makeDirectory($full_destination_path, 0755, true);
                        }
                        // Get file extention
                        $extension = $file->getClientOriginalExtension();
                        // Build the new filename
                        $file_number = ($count_files > 1) ? '_' . $key : '';
                        $new_filename = strtolower($filename_gen . $file_number . '.' . $extension);

						if($file->move($full_destination_path,$new_filename)){
							$images[] = $destination_path . $prefix_filename.$new_filename;
						}

                    } catch (\Exception $e) {
                        flash()->error($e->getMessage());
                    }
                }

            }
			if($request->input('old_pictures')){
				$images =  serialize(array_merge($images,$request->input('old_pictures')));
				} else {
					$images =  serialize($images);
				}
        } else{

			  if($request->input('old_pictures')){
	                  $images =  serialize($request->input('old_pictures'));
					 } else {
						$images =  "";
					 }

		}





	    $id =  $request->input('biz_id');
		$company_name =  $request->input('company_name');
	    $category_id =  $request->get('category_id');
		$description =  $request->get('description');
		$keywords =  $request->input('keywords');
		$address =  $request->input('address');
		$location_id =  $request->get('location_id');
		$phone =  $request->input('phone');
		$fax =  $request->input('fax');
		$email =  $request->input('email');
		$website =  $request->input('website');
		$openning_days = serialize($_POST['openning_days']);
		$open_time =  date("H:i", strtotime($request->input('open_time')));
		$close_time = date("H:i", strtotime($request->input('close_time')));


        DB::table('jb_jobs')
            ->where('id', $id)
            ->update(['company_name' => $company_name,
			          'category_id' => $category_id,
					  'description' => $description,
					  'keywords' => $keywords,
					  'address' => $address,
					  'location_id' => $location_id,
					  'phone' => $phone,
					  'fax' => $fax,
					  'email' => $email,
					  'website' => $website,
					  'openning_days' => $openning_days,
					  'open_time' => $open_time,
					  'close_time' => $close_time,
					  'images' => $images
			]);

        return redirect('jb_user');
    }

	public function directoryEntry(Request $request)
    {
	    if(!($request->session()->get('is_logged_in'))){
			$email =  $request->input('email');
			$password = rand(10,1000000);
			$subject = "Login Information";
			$message = "
			<table>
			<tr>
			<th>User</th>
			<td>".$email."</td>
			</tr>
			<tr>
			<th>Password</th>
			<td>".$password."</td>
			</tr>
			</table>	
			";
			// Always set content-type when sending HTML email
			$headers = "MIME-Version: 1.0" . "\r\n";
			$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

			// More headers
			$headers .= 'From: <webmaster@example.com>' . "\r\n";
			$headers .= 'Cc: myboss@example.com' . "\r\n";

			//mail($email,$subject,$message,$headers);
			$id = DB::table('jb_seekers_basic_info')->insertGetId(['user_email' => $email,
												 'user_pass' => $password

			  ]);
		} else {
			$id = $request->session()->get('user_id');
		}

		//$images = $_POST['userfile'];

		//print_r($abc);exit;





	/* 	if(Input::hasFile('userfile'))
        {

            $image = Input::file('userfile');
            //$filename  = time() . '.' . $image->getClientOriginalExtension();

           // $path = public_path('uploads/' . $filename);

			$image->move('uploads',$image->getClientOriginalName());


           } */

		  $country_code = strtolower($this->country->get('code'));
        // UPLOAD FILES : PICTURES
        if ($request->file('pictures')) {
            $destination_path = 'uploads/pictures/';
            $prefix_filename = $country_code . '/';
            $full_destination_path = public_path() . '/' . $destination_path . $prefix_filename;

            // Proccess file request
            $files = $request->file('pictures');
            $count_files = count($files);




            if ($count_files > 0) {
                // Generate filename
                $filename_gen = uniqid('img_');
				$images = array();
                foreach ($files as $key => $file) {
                    // Check empty fields
                    if (is_null($file) or count($file) <= 0) {
                        continue;
                    }

                    try {
                        // Create destination path if not exists
                        if (!File::exists($full_destination_path)) {
                            File::makeDirectory($full_destination_path, 0755, true);
                        }

                        // Get file extention
                        $extension = $file->getClientOriginalExtension();



                        // Build the new filename
                        $file_number = ($count_files > 1) ? '_' . $key : '';
                        $new_filename = strtolower($filename_gen . $file_number . '.' . $extension);




						if($file->move($full_destination_path,$new_filename)){
							$images[] = $destination_path . $prefix_filename.$new_filename;
						}




                    } catch (\Exception $e) {
                        flash()->error($e->getMessage());
                    }
                }
            }
        }




		$openning_days = serialize($_POST['openning_days']);




		$company_name =  $request->input('company_name');
		$category_id =  $request->input('category_id');
		$description =  $request->get('description');
		$keywords =  $request->input('keywords');
		$address =  $request->input('address');
		$location_id =  $request->get('location_id');
		$phone =  $request->input('phone');
		$fax =  $request->input('fax');
		$email =  $request->input('email');
		$website =  $request->input('website');
		$openning_days = serialize($_POST['openning_days']);
		$open_time =  date("H:i", strtotime($request->input('open_time')));
		$close_time = date("H:i", strtotime($request->input('close_time')));

		DB::table('jb_jobs')->insert(['company_name' => $company_name,
											'category_id' => $category_id,
											'description' => $description,
										    'keywords' => $keywords,
										    'address' => $address,
										    'location_id' => $location_id,
										    'phone' => $phone,
										    'fax' => $fax,
										    'email' => $email,
										    'website' => $website,
											'openning_days' => $openning_days,
											'open_time' => $open_time,
											'close_time' => $close_time,
											'images' => serialize($images),
											'user_id' => $id
		  ]);
		return redirect('jobboard');
    }



	public function jobseekers()
    {
		return view('jobboard.jobseekers.jobseekers_form');
    }


	public function jobseekers_submit(Request $request)
    {
		$first_name =  $request->input('first_name');
		$last_name =  $request->input('last_name');
		$gender_id =  $request->get('gender_id');
		$mobile =  $request->input('mobile');
		$email =  $request->input('email');
		$password =  $request->input('password');

		DB::table('jb_seekers_basic_info')->insert(['first_name' => $first_name,
											'last_name' => $last_name,
											'gender_id' => $gender_id,
										    'mobile' => $mobile,
										    'email' => $email,
										    'password' => $password
		  ]);
		return redirect('job-seekers-submit-success');
    }

	public function jobseekers_submit_success()
    {
		return view('jobboard.jobseekers.jobseekers_submit_success');
    }


	public function sendmail(Request $request)
    {
		     $mailer
			 ->to($request->input('email'))
			 ->send(new \App\Mail\MyMail($request->input('title')));
    }





	public function online_job_apply($id, Request $request)
	{


		$data['job_detail']  = DB::table('jb_employers_job_post')
								 ->select('jb_employers_job_post.*','jb_categories.name','jb_employers_basic_info.company_name','jb_employers_basic_info.company_name')
								 ->leftJoin('jb_categories', 'jb_categories.id', '=', 'jb_employers_job_post.category_id')
								 ->leftJoin('jb_employers_basic_info', 'jb_employers_basic_info.user_id', '=', 'jb_employers_job_post.user_id')
								 ->where('jb_employers_job_post.id',$id)
								 ->first();
		view()->share('job_detail', $data['job_detail']);

		return view('jobboard.online_job_apply',$data);
	}

	public function online_job_apply_submit(Request $request)
	{

	   $salary = $request->input('salary');
	   $user_id_seeker = $request->input('user_id_seeker');
	   $user_id_employer = $request->input('user_id_employer');
	   $jb_employers_job_post_id = $request->input('jb_employers_job_post_id');


	   $data['job_detail']  = DB::table('jb_employers_job_post')
								 ->select('jb_employers_job_post.*','jb_categories.name','jb_employers_basic_info.company_name','jb_employers_basic_info.company_name')
								 ->leftJoin('jb_categories', 'jb_categories.id', '=', 'jb_employers_job_post.category_id')
								 ->leftJoin('jb_employers_basic_info', 'jb_employers_basic_info.user_id', '=', 'jb_employers_job_post.user_id')
								 ->where('jb_employers_job_post.id',$jb_employers_job_post_id)
								 ->first();
		view()->share('job_detail', $data['job_detail']);



	   DB::table('jb_application_job')->insert(['salary' => $salary,
											'user_id_seeker' => $user_id_seeker,
											'jb_employers_job_post_id' => $jb_employers_job_post_id,
                                            'user_id_employer' => $user_id_employer
		  ]);
		return view('jobboard.online_job_success',$data);

	}




	public function jobseekers_login()
    {
		return view('jobboard.jobseekers.jobseekers_login');
    }

	public function jobseekers_login_submit(Request $request)
    {
	    $email = $request->input('email');
		$password = $request->input('password');


		$user_exists = DB::table('jb_seekers_basic_info')
		   ->where('email', $email)
           ->where('password', $password)
           ->first();
        if(count($user_exists)>0){
			$request->session()->set('seekers_email',$user_exists->email);
			$request->session()->set('seekers_password',$request->input('password'));
			$request->session()->set('seekers_is_logged_in',true);
			$request->session()->set('jb_is_logged_in',true);
			$request->session()->set('seekers_user_id',$user_exists->id);
			if ($request->has('job_id')) {
					return redirect('online-job-apply/'.$request->input('job_id'));
				}else{
				  return redirect('my-account-seeker');
				}
		} else {

			return redirect('job-seekers-login');
		}
    }

	public function jobseekers_login_submit_modal(Request $request)
    {
	    $email = $request->input('email');
		$password = $request->input('password');
		$user_exists = DB::table('jb_seekers_basic_info')
		   ->where('email', $email)
           ->where('password', $password)
           ->first();
        if(count($user_exists)>0){
			$request->session()->set('seekers_email',$user_exists->email);
			$request->session()->set('seekers_password',$request->input('password'));
			$request->session()->set('seekers_is_logged_in',true);
			$request->session()->set('jb_is_logged_in',true);
			$request->session()->set('seekers_user_id',$user_exists->id);
			return redirect('my-account-employer');
		} else {
			return redirect('job-seekers-login');
		}
    }

	public function seekers_logout(Request $request)
    {
			$request->session()->flush();


			return redirect('jobboard');
    }



	public function employers()
    {
		$data['categories']  = DB::table('jb_categories')->get();
        view()->share('categories', $data['categories']);
		$data['organization_type'] = DB::table('jb_organization_type')->get();
		view()->share('organization_type',$data['organization_type']);
		return view('jobboard.employers.employers_form');
    }

	public function check_seeker_username(Request $request)
    {
	    $username = $request->input('username');

	   $user_exists = DB::table('jb_seekers_basic_info')
		   ->where('username', $username)
           ->first();

		  if(count($user_exists)){
			  echo 'false';
		  }else{
			  echo true;
		  }
    }

	public function check_employer_username(Request $request)
    {
	    $username = $request->input('username');

	   $user_exists = DB::table('jb_employers_basic_info')
		   ->where('username', $username)
           ->first();

		  if(count($user_exists)){
			  echo 'false';
		  }else{
			  echo true;
		  }
    }





	public function employers_submit(Request $request)
    {
		$company_name =  $request->input('company_name');
		$email =  $request->input('email');
		$contact_person =  $request->input('contact_person');
		$contact_person_dgn =  $request->input('contact_person_dgn');
		$business_description =  $request->input('business_description');
		$company_address =  $request->input('company_address');
		$organization_type_id =  $request->input('organization_type_id');
		$password =  $request->input('password');

			 // UPLOAD FILES : PICTURES
        if ($request->file('company_logo')) {
            $destination_path = 'uploads/company_logo/';

			$filename_gen = uniqid('img_');
            $full_destination_path = public_path() . '/' . $destination_path;

            // Proccess file request
            $file = $request->file('company_logo');
			if (!File::exists($full_destination_path)) {
                            File::makeDirectory($full_destination_path, 0755, true);
                        }
			$extension = $file->getClientOriginalExtension();
			$new_filename = strtolower($filename_gen . '.' . $extension);
			$file->move($full_destination_path,$new_filename);

		$company_logo =	$destination_path . $new_filename;


        } else {
			$company_logo = '';
		}

		DB::table('jb_employers_basic_info')->insert([
		                                    'company_name' => $company_name,
											'email' => $email,
											'company_logo' => $company_logo,
											'contact_person' => $contact_person,
											'contact_person_dgn' => $contact_person_dgn,
											'business_description' => $business_description,
											'company_address' => $company_address,
		                                    'organization_type_id' => $organization_type_id,
										    'password' => $password,
											'categories' => serialize($request->input('categories'))
		  ]);
		return redirect('employers-submit-success');
    }


	public function employers_submit_success()
    {
		$data['categories']  = DB::table('jb_categories')->get();
        view()->share('categories', $data['categories']);
		$data['organization_type'] = DB::table('jb_organization_type')->get();
		view()->share('organization_type',$data['organization_type']);
		return view('jobboard.employers.employers_submit_success');
    }


	public function employers_login()
    {
		return view('jobboard.employers.employers_login');
    }

	public function employers_login_submit(Request $request)
    {
	    $email = $request->input('email');
		$password = $request->input('password');


		$user_exists = DB::table('jb_employers_basic_info')
		   ->where('email', $email)
           ->where('password', $password)
           ->first();


        if(count($user_exists)>0){
			//$request->session()->set('employers_email',$request->input('email'));
			$request->session()->set('employers_username',$request->input('username'));
			$request->session()->set('employers_password',$request->input('password'));
			$request->session()->set('employers_is_logged_in',true);
			$request->session()->set('jb_is_logged_in',true);
			$request->session()->set('employers_user_id',$user_exists->id);
			return redirect('my-account-employer');
		} else {
			return redirect('employers-login');
		}
    }

	public function employers_logout(Request $request)
    {
			$request->session()->forget('seekers_is_logged_in');
			return redirect('jobboard');
    }


	public function job_detail($id,Request $request)
		{

            if(Auth::check()){
				$employer_id = Auth::id();
				$data['apply_job']  = DB::table('jb_application_job')
			                         ->where('user_id_seeker',$employer_id)
									 ->where('jb_employers_job_post_id',$id)
									 ->first();
			        }
			    $data['job_detail']  = DB::table('jb_employers_job_post')
			                         ->select('jb_employers_job_post.*','jb_categories.name','jb_employers_basic_info.company_name','jb_employers_basic_info.company_address','jb_employers_basic_info.company_logo','jb_employers_basic_info.id as company_id')
			                         ->leftJoin('jb_categories', 'jb_categories.id', '=', 'jb_employers_job_post.category_id')
									 ->leftJoin('jb_employers_basic_info', 'jb_employers_basic_info.user_id', '=', 'jb_employers_job_post.user_id')
			                         ->where('jb_employers_job_post.id',$id)
									 ->first();




                view()->share('job_detail', $data['job_detail']);

				$category_id = $data['job_detail']->category_id;

				$data['related_job']  = DB::table('jb_employers_job_post')
			                        ->select('jb_employers_job_post.*','jb_employers_basic_info.company_name','jb_employers_basic_info.company_logo')
			                        ->join('jb_employers_basic_info', 'jb_employers_basic_info.id', '=', 'jb_employers_job_post.user_id')
			                        ->where('jb_employers_job_post.category_id',$category_id)
									->get();

				$data['category_id'] =  $category_id;


			    $data['jb_feacher'] = DB::table('jb_employers_job_post')
		                        ->where('feachered',1)
		                        ->get();

			    return view('jobboard.job_detail',$data);
		}

	public function job_list()
		{

			$data['job_list']  = DB::table('jb_employers_job_post')
			                       ->select('jb_employers_job_post.*','jb_employers_basic_info.company_name')
			                       ->join('jb_employers_basic_info', 'jb_employers_basic_info.id', '=', 'jb_employers_job_post.user_id')
								   ->join('jb_organization_type', 'jb_organization_type.id', '=', 'jb_employers_basic_info.organization_type_id')
								   ->get();

			view()->share('job_list', $data['job_list']);

			$data['organization_type'] = DB::table('jb_organization_type')->get();
		    view()->share('organization_type',$data['organization_type']);

			$data['jb_categories'] = DB::table('jb_categories')->get();
		    view()->share('jb_categories',$data['jb_categories']);

			return view('jobboard.employers.employer_job_list_search',$data);
		}








	public function detail($id)
    {

		$data = array();
		$bizdirectory_detail = DB::table('jb_jobs')->where('jb_jobs.id', $id)
            ->join('biz_locations', 'biz_locations.id', '=', 'jb_jobs.location_id')
            ->select('jb_jobs.*', 'biz_locations.name as location','biz_locations.parent_id')
            ->first();
		view()->share('bizdirectory_detail', $bizdirectory_detail);

		 $category_id = $bizdirectory_detail->category_id;

		$carouselr = DB::table('jb_jobs')->where('category_id', $category_id)->get();
		$data['carousel'] = $carouselr;

        // View
        return view('jobboard.detail',$data);
    }

	public function select_account(Request $request, $id)
    {
		if($id==2){
            session('jb_type','employer');
		    return redirect('my-account-employer');
        }else{
		    session('jb_type','job_seeker');
            return redirect('my-account-seeker');
		}

        // View

    }







	public function showLoginForm()
    {
		return view('jobboard.login');
    }

	public function login(Request $request)
    {
	    $email = $request->input('email');
		$password = $request->input('password');
		$user_exists = DB::table('jb_seekers_basic_info')
		   ->where('user_email', $email)
           ->where('user_pass', $password)
           ->first();
        if(count($user_exists)>0){
			$request->session()->set('email',$request->input('email'));
			$request->session()->set('password',$request->input('password'));
			$request->session()->set('is_logged_in',true);
			$request->session()->set('user_id',$user_exists->id);
			return redirect('jobboard');
		} else {
			return redirect('jobboard-login');
		}
    }

	public function logout(Request $request)
    {
			$request->session()->flush();
			return redirect('jobboard');
    }

    public function change_password()
    {
		return view('jobboard.change_password');
    }

	public function change_password_submit(Request $request)
    {
		$old_password = $request->input('old_password');
		$new_password = $request->input('new_password');

		$email = $request->session()->get('email');

		DB::table('users_diretory')
            ->where('user_email', $email)
            ->update(['user_pass' => $new_password]);

		return redirect('jobboard');

    }


	private function getFeaturedAds()
	{
		$limit = 20;
		$carousel = null;

		// Get all packs
		$packs = Pack::where('translation_lang', 'en')->get();
		if (!empty($packs)) {
			$packIdTab = [];
			foreach ($packs as $pack) {
				if ($pack->price > 0) {
					$packIdTab[] = $pack->id;
				}
			}

			// Get featured ads
			$reviewedAdSql = '';
			if (config('settings.ads_review_activation')) {
				$reviewedAdSql = ' AND a.reviewed = 1';
			}
			$sql = 'SELECT DISTINCT a.*, p.pack_id as p_pack_id' . '
					FROM ' . DB::getTablePrefix() . 'ads as a
                    LEFT JOIN ' . DB::getTablePrefix() . 'payments as p ON p.ad_id=a.id AND p.pack_id IN (:packs)
                    WHERE a.country_code = :country_code AND a.active=1 AND a.archived!=1 AND a.deleted_at IS NULL ' . $reviewedAdSql . '
                    ORDER BY p.pack_id DESC, a.created_at DESC
                    LIMIT 0,' . (int)$limit;
			$bindings = [
				'packs' 		=> implode(',', $packIdTab),
				'country_code' 	=> $this->country->get('code')
			];
			$ads = DB::select(DB::raw($sql), $bindings);

			if (!empty($ads)) {
				shuffle($ads);
				$carousel = [
					'title' => t('Home - Featured Ads'),
					'link' 	=> lurl(trans('routes.v-search', ['countryCode' => $this->country->get('icode')])),
					'ads' 	=> $ads,
				];
				$carousel = Arr::toObject($carousel);
			}
		}

		return $carousel;
	}



}

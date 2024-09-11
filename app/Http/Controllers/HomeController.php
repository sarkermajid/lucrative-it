<?php

namespace App\Http\Controllers;

use App\Models\Buses;
use App\Models\BusRoutes;
use App\Models\BusStops;
use App\Models\BusStopsPhone;
use App\Models\BusTrips;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;
use PDF;
use App\Models\Registration;
use App\Models\Trainers;
use App\Models\Training;
use App\Models\ProductsType;
use App\Models\Products;
use App\Models\Video;
use App\User;
use App\Mail\Contact_success;
use App\Models\JobsCategory;
use Illuminate\Support\Facades\Mail;
use Validator;
use App\Mail\Email_varification;
use App\Models\ClientReview;
use App\Models\Portfolio;
use App\Models\PortfolioType;
use App\Models\Services;
use App\Models\Sliders;
use Str;
use View;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sliders = Sliders::where('status','active')->orderBy('id','asc')->get();
        $services = Services::where('status','active')->orderBy('id','asc')->get();
        $portfolios = Portfolio::where('status','active')->orderBy('id','desc')->get();
        $portfolioTypes = PortfolioType::where('status','active')->get();
        $clientReviews = ClientReview::all();

        return view('home',([
            'sliders'=>$sliders,
            'services'=>$services,
            'portfolios' => $portfolios,
            'portfolioTypes' => $portfolioTypes,
            'clientReviews' => $clientReviews
        ]));

    }

    public function services()
    {

        $sliders = Sliders::where('status','active')->orderBy('id','asc')->get();
        $services = Services::where('status','active')->orderBy('id','asc')->get();


        return view('services',(['sliders'=>$sliders,'services'=>$services]));

    }

    public function contact()
    {

        return view('contact');

    }


    public function about()
    {
        return view('about');
    }

    public function bus_list(Request $request)
    {

        $routes = BusRoutes::where('bus_stops','LIKE',"%{$request->boarding_point}%")->where('bus_stops','LIKE',"%{$request->dropping_point}%")->get();
        $route_ids = '';
        foreach ($routes as $route){
            $boarding_point_pos = array_search($request->boarding_point,json_decode($route->bus_stops));
            $dropping_point_pos = array_search($request->dropping_point,json_decode($route->bus_stops));
            if($boarding_point_pos<$dropping_point_pos){
                $route_ids .= $route->id.',';
            }
        }
        $route_ids =rtrim($route_ids,',');
        if($request->bus_type){
            $bus_trips = BusTrips::join('bus_trip_time', 'bus_trips.id', '=', 'bus_trip_time.bus_trip_id')->whereIn('bus_routes_id', [$route_ids])->where('bus_type_id',$request->bus_type)->get();
        }else{
            $bus_trips = BusTrips::join('bus_trip_time', 'bus_trips.id', '=', 'bus_trip_time.bus_trip_id')->whereIn('bus_routes_id', [$route_ids])->get();
        }

        foreach ($bus_trips as $bus_trip){
            $bus_trip->boarding_point_phone = BusStopsPhone::where('bus_stop_id',$request->boarding_point)->where('bus_id',$bus_trip->bus_id)->value('phone');
            $bus_stops = json_decode($bus_trip->bus_routes->bus_stops);
            for($i=0;$i<count($bus_stops);$i++){
                $bus_trip->bus_stops .=  BusStops::where('id',$bus_stops[$i])->value('title').' - ';
            }
        }

        $boarding_point = BusStops::where('id',$_GET['boarding_point'])->value('title');
        $dropping_point = BusStops::where('id',$_GET['dropping_point'])->value('title');
        $sliders = DB::table('slider')->where(['status'=>'Active','category_id'=>1])->orderBy('id','desc')->get();
        $news = News::where(['status'=>'Active'])->orderBy('id','desc')->limit(3)->get();
        $type =  DB::table('bus_type')->pluck('title','id');

        return view('bus_list',(['sliders'=>$sliders,'news'=>$news,'type'=>$type,'bus_trips'=>$bus_trips,'boarding_point'=>$boarding_point,'dropping_point'=>$dropping_point]));
    }



    public function sitemap()
    {
        return view('sitemap');
    }






    public function contact_us_send(Request $request)
    {
        $allData=$request->all();

        $admin_mail = DB::table('settings')->where('key','site_email')->value('value');
        $company_name = DB::table('settings')->where('key','site_title')->value('value');

        Mail::to($request->email)->send(new Contact_success($allData,$admin_mail,$company_name));
        echo 'success';
    }

    public function news_detail($id)
    {
        $news_detail = DB::table('news')->where('id',$id)->first();
        return view('news_detail',(['news_detail'=>$news_detail]));
    }

    public function bus_detail($id)
    {

        $single_bus = Buses::where('id', $id)->first();
        $bus_trips = BusTrips::where('bus_id', $id)->get();

        $bus_comments = DB::table('bus_comments')->where('bus_id', $id)->get();


        foreach ($bus_trips as $bus_trip){
            $bus_stops = json_decode($bus_trip->bus_routes->bus_stops);
            for($i=0;$i<count($bus_stops);$i++){
                $phone = BusStopsPhone::where('bus_stop_id',$bus_stops[$i])->where('bus_id',$id)->value('phone');
                $bus_trip->bus_stops .=  BusStops::where('id',$bus_stops[$i])->value('title').(($phone)?'('.$phone.')':'').' - ';
            }
        }
        $type =  DB::table('bus_type')->pluck('title','id');
        $news = News::where(['status'=>'Active'])->orderBy('id','desc')->limit(3)->get();
        return view('bus_detail', compact('bus_trips','type','news','single_bus', 'bus_comments'));
    }

    public function service_detail($id)
    {
        $service_detail = DB::table('services')->where('id',$id)->first();
        return view('service_detail',(['service_detail'=>$service_detail]));
    }





                          /* all page template*/
    public function pages(Request $request,$slug)
    {
        $page_id = DB::table('pages')->where('slug',$slug)->value('id');

        if(!$page_id){
            abort('404');
        }

        $page = DB::table('pages')->where('id',$page_id)->first();


        if($page->template=='trainers'){
           $trainers = Trainers::where('status','Active')->get();
            View::share('trainers', $trainers);
        }

        if($page->template=='training'){
            $training = Training::where('status','Active')->get();
            View::share('training', $training);
        }

        if($page->template=='video'){
            $video = Video::where('status','Active')->get();
            View::share('video', $video);
        }

        return view($page->template,(['page'=>$page]));
    }




    public function registration(Request $request){
        $registration = $request->session()->get('registration');
        return view('auth.register',['registration'=>$registration]);
    }


    public function registration_submit(Request $request)
    {
        $registration_data = $request->all();



        $validator = Validator::make($request->all(), [
            'email' => ['required','unique:users,email'],
        ]);

        if ($validator->fails()){
            session()->flash('message',$validator->errors()->first());
            return redirect('register')->withInput();
        }

        if ($request->hasFile('personal_file')){
            $registration_data['personal_file']=$request->file('personal_file')->store('files');
        }

        if(empty($request->session()->get('registration'))){
            $registration = new User();
            $registration->fill($registration_data);
            $request->session()->put('registration', $registration);
        }else{
            $registration = $request->session()->get('registration');
            $registration->fill($registration_data);
            $request->session()->put('registration', $registration);
        }

        return redirect('registration-second');
    }


    public function registration_second(Request $request)
    {
        return view('auth.registration_second');
    }



    public function registration_final_submit(Request $request)
    {
        $validator = Validator::make($request->all(), [

            'password' => 'required|string|min:6|confirmed',
        ]);

        if ($validator->fails()){
            session()->flash('message',$validator->errors()->first());
            return back()->withInput();
        }

                    $registration = $request->session()->get('registration');


                    $user = User::create([
                        'name' => $registration->name,
                        'phone' => $registration->phone,
                        'email' => $registration->email,
                        'password' => bcrypt($request->password),
                        'status' => 'Pending',
                        'national_id_card' => $request->national_id_card,
                    ]);

                    $admin_mail = DB::table('settings')->where('key','site_email')->value('value');
                    $company_name = DB::table('settings')->where('key','site_title')->value('value');

                    Mail::to($registration->email)->send(new Email_varification($user,$admin_mail,$company_name));

                    $request->session()->forget('registration');

                    return redirect('registration-success');




    }


    public function bus_comment(Request $request){
        DB::table('bus_comments')->insert(['bus_id' => $request->bus_id, 'user_id' => '6', 'comment' => $request->message]);
        return back();

    }

    public function dashboard()
    {
        return view('admin.dashboard');
    }












}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;
use PDF;
use App\Models\Registration;

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
        return view('home');
    }

    public function registration()
    {
        $ip = \Request::ip();
        $ip_data = json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=$ip"));
        $countryCode = $ip_data->geoplugin_countryCode;
        $countryCode = ($countryCode)?$countryCode:'BD';
        $countriy_single = json_decode(file_get_contents("https://restcountries.eu/rest/v2/alpha/$countryCode"));

        $country_demonym = $countriy_single->demonym;

        $countriy_list = json_decode(file_get_contents('https://restcountries.eu/rest/v2/all'));

        return view('registration',['country_demonym'=>$country_demonym,'country_demonym'=>$country_demonym,'countriy_list'=>$countriy_list]);
    }

    public function registration_submit(Request $request)
    {

        $allData=$request->all();
        if ($request->hasFile('personal_file')){
            $allData['personal_file']=$request->file('personal_file')->store('files');
        }
        Registration::create($allData);

        return redirect('registration-success');
    }

    public function registration_success(Request $request)
    {

        Session::flash('message', 'Record added successfully');

        return view('registration_success');
    }




}

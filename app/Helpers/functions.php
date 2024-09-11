<?php

use Carbon\Carbon;

                   /*attendace condition by bg color*/
function bg_color($starting_time,$check_in_time,$attend)
    {

        if($attend=="No"){
            return 'bg-red';
        }else{
            if( strtotime($starting_time)>=strtotime($check_in_time) )
            {
                return 'bg-green';
            }
            else
            {
                return 'bg-orange';
            }
        }

    }

       /*Hosting and domain  condition by bg color*/

function bg_color_web_account($expire_date,$status,$package)
{


    $now = Carbon::now();
    $end = Carbon::parse($expire_date);
    $length =  $end->diffInDays($now);



    $duration = ($package=='Monthly')?30:360;

    $yellow_range = ceil((8.3*$duration)/100);
    $orange_range = ceil((4.15*$duration)/100);

    //return $length.$yellow_range.$orange_range;


    if($status=='InActive'){
        return 'bg-gray';
    }
    elseif (($length <= $orange_range) && ($length >= 0) && $now<$end )
    {
        return 'bg-orange';
    }
    elseif (($length <= $yellow_range) && ($length >= $orange_range) && $now<$end)
    {
        return 'bg-yellow';
    }
    elseif( $now>$end )
    {
        return 'bg-red';
    }

}

function bg_color_utility($date,$status){

    $now = Carbon::now();
    $end = Carbon::parse($date);
    $days =  $end->diffInDays($now);
    if($status=='Yes'){
        return '';
    }elseif($now>$end ) {
        return 'bg-red';
    }elseif($days<3 and $days>=0){
        return 'bg-orange';
    }



}
                /*encription and decription*/

function my_simple_crypt( $string, $action = 'e' ) {
    // you may change these values to your own
    $secret_key = 'my_simple_secret_key';
    $secret_iv = 'my_simple_secret_iv';

    $output = false;
    $encrypt_method = "AES-256-CBC";
    $key = hash( 'sha256', $secret_key );
    $iv = substr( hash( 'sha256', $secret_iv ), 0, 16 );

    if( $action == 'e' ) {
        $output = base64_encode( openssl_encrypt( $string, $encrypt_method, $key, 0, $iv ) );
    }
    else if( $action == 'd' ){
        $output = openssl_decrypt( base64_decode( $string ), $encrypt_method, $key, 0, $iv );
    }

    return rtrim($output,'=');
}


function month_convert($month){
    return ($month=='01')?'Junaury':(($month=='02')?'Feabruary':(($month=='03')?'March':(($month=='04')?'April':(($month=='05')?'May':(($month=='06')?'June':(($month=='07')?'July':(($month=='08')?'August':(($month=='09')?'September':(($month=='10')?'Octobor':(($month=='11')?'November':'December'))))))))));
}

function settings($key, $settings) {
    foreach ($settings as  $val) {
        if ($key == $val->key) {
            return $val->value;
        }
    }
    return null;
}


<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Hosting;
use App\Models\AssignServices;



class Hostings extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($id,$content,$pdf=null)
    {
       $this->id = $id;
       $this->content = $content;
       $this->pdf = $pdf;
       $this->client_mail = $this->client_mail();
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if($this->pdf){
            return $this->view('mail.mail_template',['template'=>$this->template()])->to($this->client_mail)->attach($this->pdf);
        }else{
            return $this->view('mail.mail_template',['template'=>$this->template()])->to($this->client_mail);
        }

    }

    public function template() {

        $asd = explode('[',$this->content);
        $text = '';
        for($i=0;$i<count($asd);$i++){
            if($i==0){
                $text .= $asd[$i];
            }else{
                $fc =  explode(']',$asd[$i]);

                $text .= $this->the_shortcode($fc[0]).' '.$fc[1];
            }
        }

        return $text;
    }

    function the_shortcode($field){
       $hosting = Hosting::select('hostings.*','users.name as client_name')
                           ->join('users','users.id','hostings.users_id')
                           ->find($this->id);
       return $hosting->$field;
    }

    function client_mail(){
        $hosting = Hosting::select('users.email as client_mail')
            ->join('users','users.id','hostings.users_id')
            ->find($this->id);
        return $hosting->client_mail;
    }
}

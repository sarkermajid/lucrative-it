<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Domain;
use App\Models\AssignServices;



class Domains extends Mailable
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
        $domain = Domain::select('domains.*','users.name as client_name')
            ->join('users','users.id','domains.users_id')
            ->find($this->id);
        return $domain->$field;
    }

    function client_mail(){
        $domain = Domain::select('users.email as client_mail')
            ->join('users','users.id','domains.users_id')
            ->find($this->id);
        return $domain->client_mail;
    }
}

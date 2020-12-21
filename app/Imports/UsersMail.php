<?php

namespace App\Imports;

use App\Registered;
use App\Mails;
use App\Events;
use App\Checkin;
use Session;
use Mail;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UsersMail implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        // dd($rows);
        foreach ($rows as $row) 
        {
            $registered = new Registered;
            $registered->rg_pj_id            =       Session::get('id_project');
            $registered->rg_event_id         =       $row['event'];
            $registered->rg_name             =       $row['name'];
            $registered->rg_lastname         =       $row['lastname'];
            $registered->rg_email            =       $row['email'];
            $registered->rg_cc_email         =       $row['cc_email'];
            $registered->rg_phone            =       $row['phone'];
            $registered->rg_company          =       $row['company'];
            $registered->rg_address          =       $row['address'];
            $registered->rg_country          =       $row['country'];
            $registered->rg_job_title        =       $row['jobtitle'];
            $registered->rg_dietary          =       $row['dietary'];
            $registered->rg_type_id          =       1;
            $registered->rg_type_personal    =       $row['typepersonal'];
            $registered->rg_cc_status        =       $row['cc_status'];
            $registered->save();

            $event_ids = explode(',',$row['event']);
        
            $registerd = Registered::where('rg_id',$registered->rg_id)->first();
            foreach($event_ids as $key => $event_id){
                


                $mails = Mails::where('tbm_pj_id',Session::get('id_project'))->first();
                $events = Events::where('ev_id',$event_id)->first();

                $checkin = new Checkin();
                $checkin->chi_rg_id = $registered->rg_id;
                $checkin->chi_pj_id = Session::get('id_project');
                $checkin->chi_ev_id = $events->ev_id;
                $checkin->save();


                $data = array(
                    'mails' =>  $mails,
                    'events' =>  $events,
                    'registerd' => $registerd,
                );
                
                if($registerd->rg_cc_status == 1){
                    Mail::send('backoffice.mail.mail', $data, function($message) use ($data) {
                        $message->to($data['registerd']->rg_email, $data['registerd']->rg_name.' '.$data['registerd']->rg_lastname)->subject('PropertyGuru E-ticket for  '.$data['events']->ev_name);
                        $message->from(env('MAIL_USERNAME'),'PropertyGuru');
                    });
                 }else if($registerd->rg_cc_status == 2){
                    Mail::send('backoffice.mail.mail', $data, function($message) use ($data) {
                        $message->to($data['registerd']->rg_cc_email, $data['registerd']->rg_name.' '.$data['registerd']->rg_lastname)->subject('PropertyGuru E-ticket for  '.$data['events']->ev_name);
                        $message->from(env('MAIL_USERNAME'),'PropertyGuru');
                    });
                 }else{
                    Mail::send('backoffice.mail.mail', $data, function($message) use ($data) {
                        $message->to($data['registerd']->rg_email, $data['registerd']->rg_name.' '.$data['registerd']->rg_lastname)->subject('PropertyGuru E-ticket for  '.$data['events']->ev_name);
                        $message->cc($data['registerd']->rg_cc_email, $name = null);
                        $message->from(env('MAIL_USERNAME'),'PropertyGuru');
                    });
                    
                 }
            }
        }
    }
}
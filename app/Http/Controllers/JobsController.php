<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Request;
use Illuminate\Support\Facades\Input;
use Session;
use Auth;
use App\Models\User;
use App\Models\Job;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class JobsController extends Controller
{   

    public function jobs()
    {
        $jobs = Job::where('status','publish')->orderBy('id','DESC')->get();       
        $currentDate = date('F j, Y');
        return response()->json([
            'jobs' => $jobs,
            'currentDate' => $currentDate
        ]);
    }

    public function SaveApplyJob(Request $request)
    {
        $inputs = Request::all();      
        
        $siteName = getcong('siteName');
        $siteEmail = getcong('siteEmail');
        $data = array(
            'First_Name'=>$inputs['firstName'],
            'Last_Name'=>$inputs['lastName'],
            'Phone'=>$inputs['phoneNumber'],
            'Email'=>$inputs['email'],
            'communicate_via_text_message'=>$inputs['CommunicateWithMessage'],
            'position_in_interested'=>$inputs['ApplyForPosition'],                                
            'siteName'=>$siteName,
            'siteEmail'=>$siteEmail
        );
        
        Mail::send('emails.Admin_Current_Open_Positions_Application_for_Care_Providers', $data, function ($message) use ($data) {
            $message->subject('Care Provider Candidate Just Applied for Position');
            $message->from('admin@nannyparentconnection.com');
            $message->bcc('sudhirkundal007@gmail.com');         
            $message->to($data['siteEmail']);
        });

        return response()->json([
            'success' => 'Applied Job..'
        ]);
       
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Request;
use Illuminate\Support\Facades\Input;
use Session;
use Auth;
use App\Models\User;
use App\Models\Job;
use Illuminate\Support\Facades\Validator;

class JobsController extends Controller
{
    protected $guard = 'admin';

    public function jobsList()
    {
        $jobs = Job::orderBy('id','DESC')->paginate(30);
        return view('admin.jobs.jobs-list',compact('jobs'));        
    }

    public function addJob()
    {
        return view('admin.jobs.add-job');
    }

    public function saveJob(Request $request)
    {
        $data =  Request::except(array('_token'));        
        $inputs = Request::all();
        $rule=array(
            'job_title' => 'required', 
            'jobLocatin' => 'required',
            'IdealStartDate' => 'required',
            'jobSchedule' => 'required',
            'children' => 'required',
            'compensation' => 'required',
            'jobExperience' => 'required',
            'AboutFamily' => 'required',
            'jobDescription' => 'required',
            'Qualification_Requirement' => 'required'                  		        	        
           );
           
        $validator = \Validator::make($data,$rule);
        
        if ($validator->fails())
        {
            return redirect()->back()->withInput()->withErrors($validator->messages());
        }

        $count = Job::where('jobTitle',$inputs['job_title'])->where('job_id','#'.$inputs['job_id'])->count();
        if($count>0):
            return redirect()->back()->withErrors($inputs['job_title'].' already exit.');
        endif;

        $job = new Job;
        $job->jobTitle = $inputs['job_title'];
        $job->job_id = '#'.$inputs['job_id'];
        $job->jobSlug = Str::slug($inputs['job_title']);
        $job->jobLocatin = $inputs['jobLocatin'];
        $job->IdealStartDate = $inputs['IdealStartDate'];
        $job->jobSchedule = $inputs['jobSchedule'];
        $job->children = $inputs['children'];
        $job->compensation = $inputs['compensation'];
        $job->jobExperience = $inputs['jobExperience'];
        $job->legally_authorized_state = $inputs['legally_authorized_state'];
        $job->AboutFamily = $inputs['AboutFamily'];
        $job->jobDescription = $inputs['jobDescription'];
        $job->Qualification_Requirement = $inputs['Qualification_Requirement'];
        $job->status = $inputs['status'];
        $job->save();
        return redirect()->back()->with('success', 'Save successfully.');
    }

    public function editJobs($slug)
    {
        $checkJob = Job::where('jobSlug',$slug)->count();
        if($checkJob>0):
            $job = Job::where('jobSlug',$slug)->first();           
            return view('admin.jobs.edit-job',compact('job'));
        else: 
            return redirect('/superadmin/jobs')->withErrors('Job not found!');
        endif;
    }

    public function updateJobs(Request $request)
    {
        $data =  Request::except(array('_token'));        
        $inputs = Request::all();       
        $job = Job::where('id',decrypt($inputs['id']))->first();

        $check_job_id = Job::where('job_id',$inputs['job_id'])->count();
        if($check_job_id>0 && $job->job_id!=$inputs['job_id']):
            return redirect()->back()->withErrors($inputs['job_id'].' already exit.');
        endif;

        $count = Job::where('jobTitle',$inputs['job_title'])->where('job_id',$inputs['job_id'])->count();        
        if($count>0 && $job->post_title!=$inputs['job_title'] && $job->job_id!=$inputs['job_id']):
            return redirect()->back()->withErrors($inputs['job_title'].' already exit.');
        endif;
        $job->jobTitle = $inputs['job_title'];
        $job->job_id = $inputs['job_id'];
        $job->jobSlug = Str::slug($inputs['job_title']);
        $job->jobLocatin = $inputs['jobLocatin'];
        $job->IdealStartDate = $inputs['IdealStartDate'];
        $job->jobSchedule = $inputs['jobSchedule'];
        $job->children = $inputs['children'];
        $job->compensation = $inputs['compensation'];
        $job->jobExperience = $inputs['jobExperience'];
        $job->legally_authorized_state = $inputs['legally_authorized_state'];
        $job->AboutFamily = $inputs['AboutFamily'];
        $job->jobDescription = $inputs['jobDescription'];
        $job->Qualification_Requirement = $inputs['Qualification_Requirement'];
        $job->status = $inputs['status'];
        $job->save();
        return redirect()->back()->with('success', 'Save successfully.');
    }

    public function updatejobstatus(Request $request)
    {
        $inputs = Request::all();
        $job = Job::where('id',decrypt($inputs['jobID']))->update([
            'status'=>$inputs['statusVa']
        ]);
        return response()->json([
            'statusUpdated' => 'Status Change'
        ]); 
    }

    public function jobDelete($id)
    {
        Job::where('id', $id)->delete();
        return redirect('/superadmin/jobs')->with('success', 'Delete successfully.');
    }

}

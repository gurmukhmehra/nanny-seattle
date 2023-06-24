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
use App\Models\SEO;
use Illuminate\Support\Facades\Validator;

class SEOController extends Controller
{
    public function seoList()
    {
        $SEO_list = SEO::orderBy('id','ASC')->paginate(30);
        return view('admin.SEO.Seo-list',compact('SEO_list'));
    }

    public function addseo()
    {
        return view('admin.SEO.add-seo');
    }

    public function SaveSeo(Request $request)
    {
        $data =  Request::except(array('_token'));        
        $inputs = Request::all();
        $rule=array(
            'select_page' => 'required', 
            'seo_Title' => 'required'                		        	        
           );
           
        $validator = \Validator::make($data,$rule);        
        if ($validator->fails())
        {
            return redirect()->back()->withInput()->withErrors($validator->messages());
        }

        $count = SEO::where('page_Name',$inputs['select_page'])->count();
        if($count>0):
            return redirect()->back()->withErrors($inputs['select_page'].' already exit.');
        endif;

        $saveData = new SEO;
        $saveData->page_Name = $inputs['select_page'];
        $saveData->seo_Title = $inputs['seo_Title'];
        $saveData->meta_description = $inputs['meta_description'];
        $saveData->meta_tags = $inputs['hidden-tags'];
        $saveData->save();
        return redirect()->back()->with('success', 'Save successfully.');
    }

    public function Editseo($id)
    {
        $seoDetail = SEO::FindOrFail($id);
        return view('admin.SEO.edit-seo',compact('seoDetail'));
    }

    public function UpdateSeo(Request $request)
    {
        $data =  Request::except(array('_token'));        
        $inputs = Request::all();       
        $rule=array( 
            'seo_Title' => 'required'                		        	        
        );
           
        $validator = \Validator::make($data,$rule);        
        if ($validator->fails())
        {
            return redirect()->back()->withInput()->withErrors($validator->messages());
        }        
        $seoUpdate = SEO::FindOrFail(decrypt($inputs['seo_id'])); 
        if(!empty($seoUpdate->meta_tags)):
            $tags = $inputs['hidden-tags'].','.$seoUpdate->meta_tags;
        else:
            $tags = $inputs['hidden-tags'];
        endif;    
        $seoUpdate->seo_Title = $inputs['seo_Title'];
        $seoUpdate->meta_description = $inputs['meta_description'];
        $seoUpdate->meta_tags = $tags;
        $seoUpdate->save();
        return redirect()->back()->with('success', 'Update successfully.');
    }

}

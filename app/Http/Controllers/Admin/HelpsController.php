<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Request;
use Illuminate\Support\Facades\Input;
use Session;
use Auth;
use App\Models\User;
use App\Models\Help;
use App\Models\HelpsCategories;
use Illuminate\Support\Facades\Validator;

class HelpsController extends Controller
{
   public function helps()
   {
        // $wpAllHelpsPosts = json_decode(file_get_contents('http://nannyparentconnection.com/wp-json/wp/v2/get-helps-posts'), true);
        // foreach($wpAllHelpsPosts as $key => $HelpsPosts):
        //         $checkHelpsPosts = Help::where('id',$HelpsPosts['ID'])->count();                
        //         if($checkHelpsPosts>0):
        //         else:
        //             $saveHelpsPosts = new Help;
        //             $saveHelpsPosts->id = $HelpsPosts['ID'];
        //             $saveHelpsPosts->post_author = $HelpsPosts['post_author'];
        //             $saveHelpsPosts->post_title = $HelpsPosts['post_title'];            
        //             $saveHelpsPosts->post_name = $HelpsPosts['post_name'];
        //             $saveHelpsPosts->post_content = $HelpsPosts['post_content'];
        //             $saveHelpsPosts->post_status = $HelpsPosts['post_status'];
        //             $saveHelpsPosts->created_at = $HelpsPosts['post_date'];
        //             $saveHelpsPosts->updated_at = $HelpsPosts['post_date_gmt'];
        //             $saveHelpsPosts->save();
        //         endif;
        // endforeach;

        // return response()->json([
        //     'dataimport' => 'Data import successfully.'
        // ]);
        // die();
        $helps_list = Help::whereNotNull('help_category')->orderby('id','DESC')->paginate(30);             
        return view('admin.helps-list',compact('helps_list'));
   }

   public function viewHelp($slug)
   {
      $checkSlug = Help::where('post_name',$slug)->count();      
      if($checkSlug>0):
         $helpDetail = Help::where('post_name',$slug)->first(); 
         $helpCats = HelpsCategories::orderby('id','DESC')->get();                
         return view('admin.edit-help',compact('helpDetail','helpCats'));
      else:
         return redirect('/superadmin/helps');
      endif;
   }

   public function updateHelp(Request $request)
   {
      $data =  Request::except(array('_token'));        
      $inputs = Request::all();
      $help = Help::where('id',decrypt($inputs['id']))->first();  
      
      $help->post_title = $inputs['post_title'];            
      $help->post_name = Str::slug($inputs['post_title']);
      $help->post_content = $inputs['post_content'];
      $help->help_category = $inputs['help_category'];
      $help->save();
      return redirect()->back()->with('success', 'Update successfully.');
   }

   public function categories()
   {
      $helps_Cats_list = HelpsCategories::orderby('id','DESC')->paginate(30);
      return view('admin.helps-categories-list',compact('helps_Cats_list'));
   }

   public function addCategories()
   {
      return view('admin.helps-categories-add');
   }

   public function SaveCategories(Request $request)
   {
      $data =  Request::except(array('_token'));        
      $inputs = Request::all();
      $rule=array(
         'category_title' => 'required'                 		        	        
        );        
      $validator = \Validator::make($data,$rule);
      if ($validator->fails())
      {
         return redirect()->back()->withInput()->withErrors($validator->messages());
      }

      $count = HelpsCategories::where('category_title',$inputs['category_title'])->count();
      if($count>0):
         return redirect()->back()->withErrors($inputs['category_title'].' already exit.');
      endif;

      $job = new HelpsCategories;
      $job->category_title = $inputs['category_title'];
      $job->category_slug = Str::slug($inputs['category_title']);
      $job->category_status = 'publish';
      $job->save();
      return redirect()->back()->with('success', 'Save successfully.');
   }

   public function HelpAdd()
   {
      $helpCats = HelpsCategories::orderby('id','DESC')->get();
      return view('admin.helps-add',compact('helpCats'));
   }

   public function SaveHelpAdd(Request $request)
   {
      $data =  Request::except(array('_token'));        
      $inputs = Request::all();
      $rule=array(
         'post_title' => 'required',
         'post_content' => 'required'                    		        	        
        );        
      $validator = \Validator::make($data,$rule);
      if ($validator->fails())
      {
         return redirect()->back()->withInput()->withErrors($validator->messages());
      }

      $count = Help::where('post_title',$inputs['post_title'])->count();
      if($count>0):
         return redirect()->back()->withErrors($inputs['post_title'].' already exit.');
      endif;

      $saveHelpsPosts = new Help;
      $saveHelpsPosts->post_author = Auth::user()->id;
      $saveHelpsPosts->post_title = $inputs['post_title'];            
      $saveHelpsPosts->post_name = Str::slug($inputs['post_title']);
      $saveHelpsPosts->post_content = $inputs['post_content'];
      $saveHelpsPosts->help_category = $inputs['help_category'];
      $saveHelpsPosts->post_status = 'publish';
      $saveHelpsPosts->save();
      return redirect()->back()->with('success', 'Save successfully.');
   }

}

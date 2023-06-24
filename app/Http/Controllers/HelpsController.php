<?php

namespace App\Http\Controllers;

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
    public function helpFind(Request $request)
    {
        $inputs = Request::all();
        $GetHeplsList = Help::where('post_title','LIKE','%'.$inputs['helpContent'].'%')                           
                    ->orWhere('post_content','LIKE','%'.$inputs['helpContent'].'%')
                    ->orderBy('id','DESC')                           
                    ->get(); 
        if(count($GetHeplsList)>0):
            return response()->json([
                'GetHeplsList' => $GetHeplsList
            ]); 
        else:
            return response()->json([
                'dataNotfound' => 'not found'
            ]);
        endif;  
    }

    public function helpsList()
    {        
        $HelpsCategoriesList =  HelpsCategories::with('helpListBycategories')->orderBy('id','ASC')->get();
        $helpsCatListArray = array();
        foreach($HelpsCategoriesList as $key=> $val):
            $helpsCatListArray[$key]['catName'] = $val->category_title;
            $helpsCatListArray[$key]['helpLink'] = $val->helpListBycategories;        
        endforeach;
        return response()->json([
            'AllHelpsLink' =>$helpsCatListArray
        ]);       
    }

}

<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Request;
use Illuminate\Support\Facades\Input;
use Session;
use Auth;
use App\Models\User;
use App\Models\SEO;
use Illuminate\Support\Facades\Validator;

class SiteSEOController extends Controller
{
    public function GetSEOPage()
    {        
        $page_seo_data = SEO::orderBy('id','ASC')->get();
        return response()->json([
            'page_seo_data' => $page_seo_data
        ]);
    }
}

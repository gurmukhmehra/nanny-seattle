<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use File;
use Session;
use Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Generalsetting;
use Request;
use Illuminate\Support\Facades\Input;
use Intervention\Image\Facades\Image;
use App\Models\Membership;
use Illuminate\Support\Str;
use Exception;
use Laravel\Cashier\Cashier;
use \Stripe\Stripe;
use App\Models\PaymentGateway;


class PaymentGatewayController extends Controller
{
    protected $guard = 'admin';

    public function membershipSetting()
    {
        $setting = PaymentGateway::where('gatewayeName','stripe')->first();
        return view('admin.memberships.settings',compact('setting'));
    }

    public function stripeSetting()
    {
        $setting = PaymentGateway::where('gatewayeName','stripe')->first();
        return view('admin.paymentGateway.stripeSetting',compact('setting'));
    }  
    
    public function UpdteStripeSetting(Request $request)
    {
        $data =  Request::except(array('_token'));        
        $inputs = Request::all();
        $rule=array(
            'StripeSecretkey' => 'required', 
            'StripePublishablekey' => 'required',
            'test_endpoint_secret' => 'required', 
            'live_StripeSecretkey' => 'required',
            'live_StripePublishablekey' => 'required', 
            'live_endpoint_secret' => 'required'                    		        	        
           );
        
        $validator = \Validator::make($data,$rule); 
        if ($validator->fails())
        {
            return redirect()->back()->withErrors($validator->messages());
        } 

        $count = PaymentGateway::where('gatewayeName','stripe')->count();
        if($count>0):
           $setting = PaymentGateway::findOrFail(1);
        else:
            $setting = new PaymentGateway;
        endif;

        $setting->gatewayeName = 'stripe';
        $setting->payment_mode = $inputs['payment_mode'];
        $setting->StripeSecretkey = $inputs['StripeSecretkey'];
        $setting->StripePublishablekey = $inputs['StripePublishablekey'];
        $setting->test_endpoint_secret = $inputs['test_endpoint_secret'];
        $setting->live_StripeSecretkey = $inputs['live_StripeSecretkey'];
        $setting->live_StripePublishablekey = $inputs['live_StripePublishablekey'];
        $setting->live_endpoint_secret = $inputs['live_endpoint_secret'];
        $setting->save();
        return redirect()->back()->with('success', 'Save successfully.');
    }  
    
    
}

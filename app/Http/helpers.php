<?php
use App\Models\Generalsetting;
use App\Models\PaymentGateway;

if (! function_exists('getcong')) {
    function getcong($key)
    {    	 
        $settings = Generalsetting::findOrFail('1'); 
        return $settings->$key;
    }
}

if (! function_exists('stripeDetail')) {
    function stripeDetail($key)
    {    	 
        $StripeSetting = PaymentGateway::where('gatewayeName','stripe')->first(); 
        return $StripeSetting->$key;
    }
}
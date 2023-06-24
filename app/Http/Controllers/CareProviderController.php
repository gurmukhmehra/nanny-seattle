<?php

namespace App\Http\Controllers;

use App\Models\Membership;
use Illuminate\Http\Response;
use File;
use Session;
use Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Request;
use Illuminate\Support\Facades\Hash;
use \Stripe\Stripe;
use Exception;
use Redirect;
use Intervention\Image\Facades\Image;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Facades\JWTFactory;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Tymon\JWTAuth\JWTManager as JWT;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Illuminate\Support\Str;
use App\Models\subscribersPlans;
use App\Models\MemberFriends;
use App\Models\UserBio;
use App\Models\CareProviderBio;

class CareProviderController extends Controller
{
    public function careProviderBioSave(Request $request)
    {
        $inputs = Request::all();       
        $validator = Validator::make($inputs, [
            'live_in' => 'required',            
            'TypeOfCareLooking' => 'required',
            'LookingForCareOpportunities' => 'required',
            'minRange' => 'required',
            'maxRange' => 'required',
            'providerChildExperience' => 'required',
            'providerTotalExperience' => 'required',
            'providerCareOneTime' => 'required',
            'aboutMe' => 'required',
            'providerTransportSchoolActivities' => 'required'
        ]);             

        if($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }        
        $checkBio = UserBio::where('userID',Auth::user()->id)->count();
        if($checkBio>0)
        {
            if(empty(Auth::user()->memberType)):
                User::where('id',Auth::user()->id)->update(['memberType'=>'care_provider_member']);
            endif;            
            $userbio = UserBio::where('userID',Auth::user()->id)->first();
            if(empty($userbio->userType)):
                $userbio->userType = 'care_provider_member';
            endif;
            $userbio->live_in = $inputs['live_in'];
            $userbio->TypeOfCareLooking = serialize($inputs['TypeOfCareLooking']);
            $userbio->CareOpportunities = serialize($inputs['LookingForCareOpportunities']);
            $userbio->providerChildExperience = serialize($inputs['providerChildExperience']);
            $userbio->providerExperience = $inputs['providerTotalExperience'];
            $userbio->minRange = $inputs['minRange'];
            $userbio->maxRange = $inputs['maxRange'];
            $userbio->providerCareOneTime = $inputs['providerCareOneTime'];
            $userbio->aboutMyfamily = $inputs['aboutMe'];
            if(!empty($inputs['providerSpecialNeeds'])):
                $userbio->ChildSpecialNeeds = $inputs['providerSpecialNeeds'];
            endif;

            if(!empty($inputs['SpecialNeedsExtra']) || isset($inputs['SpecialNeedsExtra'])):
                $userbio->SpecialNeedsExtra = $inputs['SpecialNeedsExtra'];
            endif;

            if(!empty($inputs['providerKonwLanguage'])):
                $userbio->providerSpeaksLanguages = $inputs['providerKonwLanguage'];
            endif;
            $userbio->parentsNeedsLanguages = serialize($inputs['providerNeedsLanguages']);
            $userbio->providerDrives = $inputs['providerTransportSchoolActivities'];

            if(!empty($inputs['CareProviderVehicleTransport'])):
                $userbio->providerTransportSchoolActivities = serialize($inputs['CareProviderVehicleTransport']); 
            else:
                $userbio->providerTransportSchoolActivities='';          
            endif;            
            $userbio->save();

            $TypeOfCareLooking = unserialize($userbio->TypeOfCareLooking);
            $CareOpportunities = unserialize($userbio->CareOpportunities);
            $CareChildExperience = unserialize($userbio->providerChildExperience);
            $providerNeedsLanguages = unserialize($userbio->providerNeedsLanguages);
            if(!empty($userbio->providerTransportSchoolActivities)):
                $providerVehcle = unserialize($userbio->providerTransportSchoolActivities);
                $providerTransportVehcle = implode(', ' ,$providerVehcle);
            else :
                $providerVehcle = "";
                $providerTransportVehcle = "";
            endif;
        } else { 
            if(empty(Auth::user()->memberType)):
                User::where('id',Auth::user()->id)->update(['memberType'=>'care_provider_member']);
            endif;
            $userbio = New UserBio;
            $userbio->userID = Auth::user()->id;
            $userbio->live_in = $inputs['live_in'];            
            $userbio->userType = Auth::user()->memberType;
            $userbio->TypeOfCareLooking = serialize($inputs['TypeOfCareLooking']);
            $userbio->CareOpportunities = serialize($inputs['LookingForCareOpportunities']);
            $userbio->providerChildExperience = serialize($inputs['providerChildExperience']);
            $userbio->providerExperience = $inputs['providerTotalExperience'];
            $userbio->minRange = $inputs['minRange'];
            $userbio->maxRange = $inputs['maxRange'];
            $userbio->providerCareOneTime = $inputs['providerCareOneTime'];
            $userbio->aboutMyfamily = $inputs['aboutMe'];
            if(!empty($inputs['providerSpecialNeeds'])):
                $userbio->ChildSpecialNeeds = $inputs['providerSpecialNeeds'];
            endif;
            if(!empty($inputs['providerKonwLanguage'])):
                $userbio->providerSpeaksLanguages = $inputs['providerKonwLanguage'];
            endif;
            if(!empty($inputs['SpecialNeedsExtra']) || isset($inputs['SpecialNeedsExtra'])):
                $userbio->SpecialNeedsExtra = $inputs['SpecialNeedsExtra'];
            endif;
            if(!empty($inputs['providerNeedsLanguages'])):
                $userbio->parentsNeedsLanguages = serialize($inputs['providerNeedsLanguages']);
            endif;

            $userbio->providerDrives = $inputs['providerTransportSchoolActivities'];

            if(!empty($inputs['CareProviderVehicleTransport'])):
                $userbio->providerTransportSchoolActivities = serialize($inputs['CareProviderVehicleTransport']);
            else:
                $userbio->providerTransportSchoolActivities = '';           
            endif;
            $userbio->save();

            $TypeOfCareLooking = unserialize($userbio->TypeOfCareLooking);
            $CareOpportunities = unserialize($userbio->LookingForCareOpportunities);
            $CareChildExperience = unserialize($userbio->providerChildExperience);
            $providerNeedsLanguages = unserialize($userbio->parentsNeedsLanguages);
            if(!empty($userbio->providerTransportSchoolActivities)):
                $providerVehcle = unserialize($userbio->providerTransportSchoolActivities);
                $providerTransportVehcle = implode(', ' ,$providerVehcle);
            else :
                $providerVehcle ="";
                $providerTransportVehcle ="";
            endif;
        }
        return response()->json([
            'bioSave' => 'Save successfully',
            'userBio' => $userbio,
            'checkboxTypeOfCareLooking' => $TypeOfCareLooking,
            'checkboxCareOpportunities' => $CareOpportunities,
            'checkboxProviderChildExp' => $CareChildExperience,
            'providerSelectLanguages' => $providerNeedsLanguages,
            'providerVehcle' => $providerVehcle,
            'providerTransportVehcle' => $providerTransportVehcle
        ]);
    }

    public function careProivderBioDetail()
    {
        $CheckBiodetail = UserBio::where('userID',Auth::user()->id)->count();
        if($CheckBiodetail>0) :
            $userBiodetail = UserBio::where('userID',Auth::user()->id)->first();
            $TypeOfCareLooking = unserialize($userBiodetail->TypeOfCareLooking);
            $CareOpportunities = unserialize($userBiodetail->CareOpportunities);
            $CareChildExperience = unserialize($userBiodetail->providerChildExperience);
            $CareAvailability = unserialize($userBiodetail->availability);
            $CareAvailabilityChecks = unserialize($userBiodetail->availability);
            
            $careLooking = implode(', ' ,$TypeOfCareLooking);
            $careOpportunitie = implode(', ' ,$CareOpportunities);
            if(!empty($CareChildExperience)):
                $careChildExp = implode(', ' ,$CareChildExperience);
            else:
                $careChildExp = '';
            endif;
            if(!empty($CareAvailability)):
                $ailability = implode(', ' ,$CareAvailability); 
            else :
                $ailability = '';
            endif;
            $providerNeedsLanguages = unserialize($userBiodetail->parentsNeedsLanguages);
            if(!empty($providerNeedsLanguages)):
                $providerSpeekLanguage = implode(', ',$providerNeedsLanguages); 
            else:
                $providerSpeekLanguage = '';
            endif;
            
                       
            if(!empty($userBiodetail->providerTransportSchoolActivities)):
                $providerVehcle = unserialize($userBiodetail->providerTransportSchoolActivities);
                $providerTransPort = implode(', ',$providerVehcle);
            else:
                $providerVehcle = '';
                $providerTransPort = '';
            endif;
        else:
            $userBiodetail = '';
            $TypeOfCareLooking = '';
            $CareOpportunities = '';
            $CareChildExperience = '';
            $careLooking = '';
            $careOpportunitie = '';
            $careChildExp = '';
            $CareAvailabilityChecks = '';
            $ailability = '';
            $providerNeedsLanguages = '';
            $providerSpeekLanguage = '';
            $providerVehcle = '';
            $providerTransPort = '';
        endif; 
              
        return response()->json([
            'userBio' => $userBiodetail,
            'checkboxTypeOfCareLooking' => $TypeOfCareLooking,
            'checkboxCareOpportunities' => $CareOpportunities,
            'checkboxProviderChildExp' => $CareChildExperience,
            'careLooking' => $careLooking,
            'careOpportunitie' => $careOpportunitie,
            'careChildExp' => $careChildExp,
            'AvailabilityChecks' =>$CareAvailabilityChecks,
            'careAvailability' =>$ailability,
            'providerSelectLanguages' => $providerNeedsLanguages,
            'SpeekLanguage' => $providerSpeekLanguage,            
            'providerVehcle' => $providerVehcle,
            'providerTransPorts' => $providerTransPort
        ]);
    }

    public function careProviderAvailability(Request $request)
    {
        $inputs = Request::all();
        $validator = Validator::make($inputs, [            
            'availability' => 'required'
        ]);             

        if($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        $checkAvailability = UserBio::where('userID',Auth::user()->id)->count();
        if($checkAvailability>0)
        {
            $availability = UserBio::where('userID',Auth::user()->id)->first();
            $availability->availability = serialize($inputs['availability']);
            $availability->save();
            $Availability = unserialize($availability->availability);
            $ailability = implode(', ' ,$Availability); 
        } else {
            $availability = new UserBio;
            $availability->userID = Auth::user()->id;
            $availability->availability = serialize($inputs['availability']);
            $availability->save();
            $Availability = unserialize($availability->availability);
            $ailability = implode(', ' ,$Availability); 
        }
        return response()->json([
            'AvailabilitySave' => 'Save successfully',
            'checkboxAvailability' => $Availability,
            'careAvailability' =>$ailability
        ]);
    }

    public function careProivderAvailability()
    {
        $CheckCareProvider = UserBio::where('userID',Auth::user()->id)->count();
        if($CheckCareProvider>0):
            $careProvider = UserBio::where('userID',Auth::user()->id)->first();       
            $Availability = unserialize($careProvider->availability);
            
            if(!empty($careProvider->availability)):
                $ailability = implode(', ' ,$Availability);
            else :
                $ailability = '';
            endif;            
        else:
            $ailability = '';
            $Availability = '';
        endif;
        return response()->json([
            'checkboxAvailability' => $Availability,
            'careAvailability' =>$ailability
        ]);       
    }

    public function subscriberSave(Request $request)
    {
        $inputs = Request::all();
        $validator = Validator::make($inputs, [            
            'yourName' => 'required',
            'mobileNumber' => 'required'
        ]);             

        if($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }

        return response()->json([
            'subscriberSuccessMsg' => 'Thank you for subscribing.'
        ]);
    }
    

}

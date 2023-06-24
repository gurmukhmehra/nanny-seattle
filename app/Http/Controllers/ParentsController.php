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

class ParentsController extends Controller
{ 
    public function parentBioSave(Request $request)
    {        
        $inputs = Request::all();        
        $validator = Validator::make($inputs, [
            'live_in' => 'required',
            'CareLooking' => 'required',
            'CareOpportunities' => 'required',
            'minRange' => 'required',
            'maxRange' => 'required',
            'aboutMyfamily' => 'required',
            'numnerOfchild' => 'required',
            'childAge' => 'required',
            'providerExperience' => 'required',
            'ChildSpecialNeeds' => 'required',
            'providerSpeaksLanguages' => 'required',
            'providerDrives' => 'required'        
        ]);             

        if($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
       
        $checkBio = UserBio::where('userID',Auth::user()->id)->count();
        if($checkBio>0)
        {
            if(empty(Auth::user()->memberType)):
                User::where('id',Auth::user()->id)->update(['memberType'=>'family_parent_member']);
            endif;     
            $userbio = UserBio::where('userID',Auth::user()->id)->first();
            if(empty($userbio->userType)):
                $userbio->userType = 'family_parent_member';
            endif;
            $userbio->live_in = $inputs['live_in'];
            $userbio->TypeOfCareLooking = serialize($inputs['CareLooking']);
            $userbio->CareOpportunities = serialize($inputs['CareOpportunities']);
            $userbio->minRange = $inputs['minRange'];
            $userbio->maxRange = $inputs['maxRange'];
            $userbio->aboutMyfamily = $inputs['aboutMyfamily'];
            $userbio->numnerOfchild = $inputs['numnerOfchild'];
            $userbio->childAge = $inputs['childAge'];
            $userbio->providerExperience = $inputs['providerExperience'];
            $userbio->ChildSpecialNeeds = $inputs['ChildSpecialNeeds'];
            if(!empty($inputs['SpecialNeedsExtra']) || isset($inputs['SpecialNeedsExtra'])):
                $userbio->SpecialNeedsExtra = $inputs['SpecialNeedsExtra'];
            else:
                $userbio->SpecialNeedsExtra = "";
            endif;
            $userbio->providerSpeaksLanguages = $inputs['providerSpeaksLanguages'];
            $userbio->parentsNeedsLanguages = serialize($inputs['parentsNeedsLanguages']);
            $userbio->providerDrives = $inputs['providerDrives'];
            $userbio->parentsVehicle = $inputs['parentsVehicle'];
            $userbio->save();
            $TypeOfCareLooking = unserialize($userbio->TypeOfCareLooking);
            $CareOpportunities = unserialize($userbio->CareOpportunities);
            $parentSelectLangu = unserialize($userbio->parentsNeedsLanguages);
        } else { 
            if(empty(Auth::user()->memberType)):
                User::where('id',Auth::user()->id)->update(['memberType'=>'family_parent_member']);
            endif;           
            $userbio =  new UserBio;
            $userbio->userID = Auth::user()->id;
            $userbio->userType = Auth::user()->memberType;
            $userbio->live_in = $inputs['live_in'];
            $userbio->TypeOfCareLooking = serialize($inputs['CareLooking']);
            $userbio->CareOpportunities = serialize($inputs['CareOpportunities']);
            $userbio->minRange = $inputs['minRange'];
            $userbio->maxRange = $inputs['maxRange'];
            $userbio->aboutMyfamily = $inputs['aboutMyfamily'];
            $userbio->numnerOfchild = $inputs['numnerOfchild'];
            $userbio->childAge = $inputs['childAge'];
            $userbio->providerExperience = $inputs['providerExperience'];
            $userbio->ChildSpecialNeeds = $inputs['ChildSpecialNeeds'];
            if(!empty($inputs['SpecialNeedsExtra']) || isset($inputs['SpecialNeedsExtra'])):
                $userbio->SpecialNeedsExtra = $inputs['SpecialNeedsExtra'];
            endif;
            $userbio->providerSpeaksLanguages = $inputs['providerSpeaksLanguages'];
            $userbio->parentsNeedsLanguages = serialize($inputs['parentsNeedsLanguages']);
            $userbio->providerDrives = $inputs['providerDrives'];
            if(!empty($inputs['parentsVehicle'])):
                $userbio->parentsVehicle = $inputs['parentsVehicle'];
            endif;
            $userbio->save();
            $TypeOfCareLooking = unserialize($userbio->TypeOfCareLooking);
            $CareOpportunities = unserialize($userbio->CareOpportunities);
            $parentSelectLangu = unserialize($userbio->parentsNeedsLanguages);
            
        }
        return response()->json([
            'bioSave' => 'Save successfully',
            'userBio' => $userbio,
            'checkboxTypeOfCareLooking' => $TypeOfCareLooking,
            'checkboxCareOpportunities' => $CareOpportunities,
            'parentSelectLanguages' => $parentSelectLangu
        ]);
    }

    public function parentBioDetail()
    {
        $CheckUserBiodetail = UserBio::where('userID',Auth::user()->id)->count();
        if($CheckUserBiodetail>0):
            $userBiodetail = UserBio::where('userID',Auth::user()->id)->first();       
            $TypeOfCareLooking = unserialize($userBiodetail->TypeOfCareLooking);
            $CareOpportunities = unserialize($userBiodetail->CareOpportunities); 
            if(!empty($userBiodetail->availability)) :
                $Availability = unserialize($userBiodetail->availability);
                $parentAvailabilitys = implode(', ' ,$Availability);
            else:
                $parentAvailabilitys = '';
            endif;             
            if($userBiodetail->providerSpeaksLanguages=="Yes"):                
                $parentSelectLangu = unserialize($userBiodetail->parentsNeedsLanguages);
                $parentSpeekLangu = implode(', ', $parentSelectLangu);
            else:
                $parentSelectLangu='';
                $parentSpeekLangu = '';
            endif;
            $parentCareLooking = implode(', ' ,$TypeOfCareLooking);
            $parentCareOpportunitie = implode(', ' ,$CareOpportunities);           
        else:
            $userBiodetail = '';
            $TypeOfCareLooking = '';
            $CareOpportunities = '';
            $parentSelectLangu = '';
            $parentSpeekLangu = '';
            $parentCareLooking = '';
            $parentCareOpportunitie = '';
            $parentAvailabilitys ='';
        endif;
        return response()->json([
            'userBio' => $userBiodetail,
            'checkboxTypeOfCareLooking' => $TypeOfCareLooking,
            'checkboxCareOpportunities' => $CareOpportunities,
            'parentTypeOfCareLooking' => $parentCareLooking,
            'parentCareOpportunities' => $parentCareOpportunitie,
            'parentSelectLanguages' => $parentSelectLangu,
            'parentSpeaksLanguages' => $parentSpeekLangu,
            'parentAvailability' => $parentAvailabilitys
        ]);
    }

    public function parentAvailability(Request $request)
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

    public function getfamilyparentAvailability()
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

}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use File;
use Session;
use Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Generalsetting;
use Request;
use Illuminate\Support\Facades\Input;
use Intervention\Image\Facades\Image;
use App\Models\Membership;
use App\Models\Job;
use App\Models\Group;
use App\Models\subscribersPlans;
use App\Models\SubscriptionsTransactions;
use App\Models\UserBio;

class IndexController extends Controller
{
    protected $guard = 'admin';  

    public function login()
    {
        if (Auth::check()):
            $role = auth()->user()->role;
            if($role=='admin'):
                return redirect('superadmin/dashboard');
            else :
                return redirect('/');
            endif;
        else :
            return view('admin.login');
        endif;
    }

    public function Adminlogin(Request $request)
    {
        $data =  Request::except(array('_token')) ;        
        $inputs = Request::all();
        $rule=array(
            'email' => 'required', 
            'password' => 'required'                      		        	        
           );
        
        $validator = \Validator::make($data,$rule); 
        if ($validator->fails())
        {
            return redirect()->back()->withErrors($validator->messages());
        } 

        if (Auth::attempt(['email' => $inputs['email'], 'password' => $inputs['password']])) 
        {   
            return redirect('superadmin/dashboard');
        } elseif (Auth::attempt(['username' => $inputs['email'], 'password' => $inputs['password']])) 
        {   
            return redirect('superadmin/dashboard');
        }
         else {
            return redirect('/superadmin')->withErrors('invalid detail. Please try again.');
        }
    }

    public function signOut() {
        Auth::logout();
        return redirect('/');
    }

    public function dashboard()
    {
        if (Auth::check()):
            $role = auth()->user()->role;
            if($role=='admin'):
                $memberShips = Membership::count();
                $users = User::count();
                $activeJobs = Job::where('status','publish')->count();
                $draftJobs = Job::where('status','draft')->count();
                return view('admin.dashboard',compact('memberShips','users','activeJobs','draftJobs'));
            else :
                return redirect('/');
            endif;
        else :
            return view('admin.login');
        endif;
                
    }

    public function generalSetting()
    {
        $setting = Generalsetting::first();        
        return view('admin.general-setting',compact('setting'));
    }

    public function SaveSetting(Request $request)
    {
        $data =  Request::except(array('_token')) ;        
        $inputs = Request::all(); 
                   
        $rule=array(
            'siteName' => 'required', 
            'siteEmail' => 'required',
            'siteLogo' => 'mimes:jpg,jpeg,png',
            'siteFavicon' => 'mimes:jpg,jpeg,png'                     		        	        
           );
        
        $validator = \Validator::make($data,$rule); 
        if ($validator->fails())
        {
            return redirect()->back()->withErrors($validator->messages());
        } 
        $count = Generalsetting::count();
        if($count>0):
           $setting = Generalsetting::findOrFail(1);
        else:
            $setting = new Generalsetting;
        endif;
        $setting->siteName = $inputs['siteName'];
        $setting->siteEmail = $inputs['siteEmail'];
        $setting->siteNumber = $inputs['siteNumber'];
        $setting->siteCopyright = $inputs['siteCopyright'];
        $setting->facebookLink = $inputs['facebookLink'];
        $setting->twitterLink = $inputs['twitterLink'];
        $setting->youtubeLink = $inputs['youtubeLink'];
        $setting->instagramLink = $inputs['instagramLink'];
        
        if(!empty($inputs['siteLogo'])):  
            if(!empty($setting->siteLogo)) {
                if(File::exists(public_path('uploads/'.$setting->siteLogo))):
                    File::delete(public_path('uploads/'.$setting->siteLogo));
                endif;
            }          
            $file= $inputs['siteLogo'];
            $filename= $file->getClientOriginalName();
            $file-> move(public_path('uploads/'), $filename);
            $setting->siteLogo = $filename;
        endif;
        if(!empty($inputs['siteFavicon'])): 
            if(!empty($setting->siteFavicon)) {
                if(File::exists(public_path('uploads/'.$setting->siteFavicon))):
                    File::delete(public_path('uploads/'.$setting->siteFavicon));
                endif;
            }            
            $file= $inputs['siteFavicon'];
            $filename= rand().'-fav-'.$file->getClientOriginalName();
            $file-> move(public_path('uploads/'), $filename);
            $setting->siteFavicon = $filename;
        endif; 

        $setting->save();
        return redirect()->back()->with('success', 'Save successfully.');
    }

    public function profile()
    {
        return view('admin.profile');
    }

    public function updateProfile(Request $request)
    {
        $data =  Request::except(array('_token')) ;        
        $inputs = Request::all(); 
                   
        $rule=array(
            'name' => 'required', 
            'email' => 'required|email|unique:users,email,'.Auth::user()->id                   		        	        
           );
        
        $validator = \Validator::make($data,$rule); 
        if ($validator->fails())
        {
            return redirect()->back()->withErrors($validator->messages());
        } 

        $user = User::findOrFail(Auth::user()->id);
        $user->name = $inputs['name'];
        $user->email = $inputs['email'];
        $user->mobile = $inputs['mobileNumber'];
        if(!empty($inputs['profileImage'])): 
            if(!empty(Auth::user()->profileImage)) {
                if(File::exists(public_path('uploads/profileImage/'.Auth::user()->profileImage))):
                    File::delete(public_path('uploads/profileImage/'.Auth::user()->profileImage));
                endif;
            }
            
            $file= $inputs['profileImage'];
            $filename= $file->getClientOriginalName();
            $file-> move(public_path('uploads/profileImage/'), $filename);
            $user->profileImage = $filename;
        endif;
        $user->save();
        return redirect()->back()->with('success', 'Update successfully.');
    }

    public function changePassword()
    {
        return view('admin.change-password');
    }

    public function UpdatePassword(Request $request)
    {
        $data =  Request::except(array('_token')) ;        
        $inputs = Request::all(); 
                   
        $rule=array(
            'password' => 'min:6|required_with:confirmPassword|same:confirmPassword',                		        	        
           );
        
        $validator = \Validator::make($data,$rule); 
        if ($validator->fails())
        {
            return redirect()->back()->withErrors($validator->messages());
        }

        $user = User::findOrFail(Auth::user()->id);
        $user->password = bcrypt($inputs['confirmPassword']);
        $user->save();
        return redirect()->back()->with('success', 'Password update successfully.');
    }

    public function usersList()
    {
        /********************* Start User Data import *********************************/
        // $wpAllUsers = json_decode(file_get_contents('https://nannyparentconnection.com/wp-json/wp/v2/getusers'), true);
        // foreach($wpAllUsers as $key => $ueserData):
        //     $image_url = "https://nannyparentconnection.com/wp-content/uploads/avatars/".$ueserData['data']['ID'].'/';
        //     $values = parse_url($ueserData['data']['UserProfilePics']['url']);
        //     $host = explode('.',$values['host']);
        //     $urls = $host[0].'.'.$host[1];         

        //     $checkUserExit = User::where('id',$ueserData['data']['ID'])->count();
        //         if($checkUserExit>0):
        //         else:
        //             $user = new User;
        //             $user->id = $ueserData['data']['ID'];
        //             $user->username =$ueserData['data']['user_login'];
        //             if(array_search('family_parent_member',$ueserData['roles'])):
        //                 $user->memberType = 'family_parent_member';
        //             endif;
        //             if(array_search('care_provider_member',$ueserData['roles'])):
        //                 $user->memberType = 'care_provider_member';
        //             endif;
        //             if(array_search('agency_member',$ueserData['roles'])):
        //                 $user->memberType = 'agency_member';
        //             endif;
        //             $user->name = $ueserData['data']['display_name'];
        //             $user->email = $ueserData['data']['user_email'];
        //             $user->password = $ueserData['data']['user_pass'];
        //             if(!empty($ueserData['data']['UserBasicDetail']['first_name'][0])):
        //                 $user->firstName = $ueserData['data']['UserBasicDetail']['first_name'][0];
        //             endif;
        //             if(!empty($ueserData['data']['UserBasicDetail']['last_name'][0])):
        //                 $user->lastName = $ueserData['data']['UserBasicDetail']['last_name'][0];
        //             endif;
        //             if(!empty($ueserData['data']['UserBasicDetail']['mepr-address-one'][0])):
        //                 $user->address1 = $ueserData['data']['UserBasicDetail']['mepr-address-one'][0];
        //             endif;
        //             if(!empty($ueserData['data']['UserBasicDetail']['mepr-address-two'][0])):
        //                 $user->address2 = $ueserData['data']['UserBasicDetail']['mepr-address-two'][0];
        //             endif;
        //             if(!empty($ueserData['data']['UserBasicDetail']['mepr-address-city'][0])):
        //                 $user->city = $ueserData['data']['UserBasicDetail']['mepr-address-city'][0];
        //             endif;
        //             if(!empty($ueserData['data']['UserBasicDetail']['mepr-address-state'][0])):
        //                 $user->state = $ueserData['data']['UserBasicDetail']['mepr-address-state'][0];
        //             endif;
        //             if(!empty($ueserData['data']['UserBasicDetail']['mepr-address-zip'][0])):
        //                 $user->postal_code = $ueserData['data']['UserBasicDetail']['mepr-address-zip'][0];
        //             endif;
        //             if($urls=='nannyparentconnection.com'):
        //                 $image_url2 = "https://nannyparentconnection.com/wp-content/uploads/avatars/".$ueserData['data']['ID'].'/';
        //                 $getUserFolder = Str::afterLast($ueserData['data']['UserProfilePics']['url'], '/');
        //                 $content = file_get_contents($image_url2.$getUserFolder);
        //                 $fp = fopen(public_path('uploads/profileImage/'.$getUserFolder), "w");
        //                 fwrite($fp, $content);
        //                 fclose($fp);
        //                 $user->profileImage = $getUserFolder;
        //             endif;
        //             $user->status = $ueserData['data']['user_status'];
        //             $user->created_at = $ueserData['data']['user_registered'];
        //             $user->save();                       
        //         endif;                 
        // endforeach;
        // $userBio = array();
        // foreach($wpAllUsers as $key => $ueserData):
        //     //echo"<pre>";print_r($ueserData['data']['ID']);
        //     $mergeAll = call_user_func_array('array_merge_recursive', $ueserData['data']['users_bios']);
        //     if(!empty($mergeAll)){
        //         if(is_array($mergeAll['field_id'])){
        //             $userBio[$ueserData['data']['ID']] = array_combine($mergeAll['field_id'],$mergeAll['value']);
        //         }else{
        //             $userBio[$ueserData['data']['ID']] = array($mergeAll['field_id']=>$mergeAll['value']);
        //         }
        //     }
        // endforeach;
        // foreach($userBio as $key => $userBios):
        //     $CheckUser = UserBio::where('userID',$key)->count();
        //     if($CheckUser>0):
        //     else:
        //         $UserRoles = User::where('id',$key)->first();
        //         $usersBiosSave = new UserBio;
        //         $usersBiosSave->userID = $key;
        //         $usersBiosSave->userType = $UserRoles->memberType;
        //         if(isset($userBios[41])):
        //             $usersBiosSave->live_in = $userBios[41];
        //         elseif(isset($userBios[40])):
        //             $usersBiosSave->live_in = $userBios[40];
        //         endif;
                
        //         if(isset($userBios[2])):
        //             $usersBiosSave->TypeOfCareLooking = $userBios[2];
        //         endif;
        //         if(isset($userBios[33])):
        //             $usersBiosSave->CareOpportunities = $userBios[33];
        //         endif;
        //         //commom fields
        //         if(isset($userBios[762])):
        //             $providerRate = unserialize($userBios[762]);
        //             if(isset($providerRate['from'])):
        //                  $res1 = str_replace( array( '\'', '"',
        //                  ',' , ';', '<', '>','$-','$' ), '', $providerRate['from']);
        //                  $usersBiosSave->minRange = $res1;
        //              endif;
        //              if(isset($providerRate['to'])):
        //                  $res2 = str_replace( array( '\'', '"',
        //                  ',' , ';', '<', '>','$-','$' ), '', $providerRate['from']);
        //                  $usersBiosSave->maxRange = $res2;
        //              endif;
        //         endif;
        //         if(isset($userBios[94])): //about family
        //             $usersBiosSave->aboutMyfamily = $userBios[94];
        //         elseif(isset($userBios[93])):
        //             $usersBiosSave->aboutMyfamily = $userBios[93];
        //         endif;

        //         if(isset($userBios[1130])): //Currently seeking new provider to work with?
        //             $usersBiosSave->currently_seeking_provider_work = $userBios[1130];
        //         elseif(isset($userBios[1133]))://Currently seeking new families to work with? 
        //             $usersBiosSave->currently_seeking_provider_work = $userBios[1133];
        //         endif;
        //         if(isset($userBios[169])): //providerSpeaksLanguages
        //             $usersBiosSave->providerSpeaksLanguages = $userBios[169];
        //         endif;
        //         if(isset($userBios[172])): //parentsNeedsLanguages
        //             $usersBiosSave->parentsNeedsLanguages = $userBios[172];
        //         endif;
        //         if(isset($userBios[294])): //providerDrives
        //             $usersBiosSave->providerDrives = $userBios[294];
        //         endif;
        //         if(isset($userBios[301])): //providerTransportSchoolActivities
        //             $usersBiosSave->providerTransportSchoolActivities = $userBios[301];
        //         endif;
        //         if(isset($userBios[312])): //CareProviderVehicleTransTest
        //             $usersBiosSave->providerTransportSchoolActivities = $userBios[312];
        //         endif;
        //         if(isset($userBios[154])): //providerNeedsLanguages
        //             $usersBiosSave->parentsNeedsLanguages = $userBios[154];
        //         endif;
        //         if(isset($userBios[151])): //providerSpeaksLanguages
        //             $usersBiosSave->providerSpeaksLanguages = $userBios[151];
        //         endif;
        //         if(isset($userBios[16])): //providerExperience
        //             $usersBiosSave->providerExperience = $userBios[16];
        //         endif;

        //         if(isset($userBios[145])): //providerChildExperience
        //             $usersBiosSave->providerChildExperience = $userBios[145];
        //         endif;
        //         if(isset($userBios[9])): //providerCareOneTime
        //             $usersBiosSave->providerCareOneTime = $userBios[9];
        //         endif;

        //         if(isset($userBios[595])): //ChildSpecialNeeds
        //             $usersBiosSave->ChildSpecialNeeds = $userBios[595];
        //         endif;

        //         if(isset($userBios[48])): //numnerOfchild
        //             $usersBiosSave->numnerOfchild = $userBios[48];
        //         endif;
        //         if(isset($userBios[196])): //childAge
        //             $usersBiosSave->childAge = $userBios[196];
        //         endif;
        //         if(isset($userBios[78])): //providerExperience
        //             $usersBiosSave->providerExperience = $userBios[78];
        //         endif;
        //         if(isset($userBios[85])): //ChildSpecialNeeds
        //             $usersBiosSave->ChildSpecialNeeds = $userBios[85];
        //         elseif(isset($userBios[86])):
        //             $usersBiosSave->ChildSpecialNeeds = $userBios[86];
        //         endif;
        //         if(isset($userBios[116])): //special needs that prospective families should be aware of
        //             $usersBiosSave->SpecialNeedsExtra = $userBios[116];
        //         elseif(isset($userBios[115])):
        //             $usersBiosSave->SpecialNeedsExtra = $userBios[115];
        //         endif;                
        //         if(isset($userBios[169])): //providerSpeaksLanguages
        //             $usersBiosSave->providerSpeaksLanguages = $userBios[169];
        //         endif;
        //         if(isset($userBios[172])): //parentsNeedsLanguages
        //             $usersBiosSave->parentsNeedsLanguages = $userBios[172];
        //         endif;
        //         if(isset($userBios[294])): //providerSpeaksLanguages
        //             $usersBiosSave->providerDrives = $userBios[294];
        //         endif;
        //         if(isset($userBios[938])): //providerSpeaksLanguages
        //             $usersBiosSave->availability = $userBios[938];
        //         endif;
        //         $usersBiosSave->save();
        //     endif;
        // endforeach;       

        // return response()->json([
        //     'dataimport' => 'Data import successfully.'
        // ]);        
        /********************* End User Data import *********************************/

        /********************* update member cover image colunm *********************************/       
            // $dir = public_path('/uploads/coverImages');
            // $ffs = scandir($dir);
            // $json = array();
            // $newjson = array();        
            // foreach ($ffs as $key => $ff) {
            //     if ($ff != '.' && $ff != '..')  {
            //         if (is_readable($dir . '/' . $ff))  {
            //             if (is_dir($dir . '/' . $ff))  {
            //                 $json[$key] = $dir . '/' . $ff;
            //                 $json[$key] = Str::afterLast($ff, '/');                        
            //             }
            //         }
            //     }
            // }       
                        
            // $files = array();
            // foreach($json as $key => $memberFolderID):
            //     $memberpins = public_path('/uploads/coverImages/'.$memberFolderID.'/cover-image/');            
            //     $files[$memberFolderID]= File::allFiles($memberpins);         
            // endforeach;
        
            // foreach($files as $key => $coverImageName):
            //     if($coverImageName):
            //         $userGetInfo = User::where('id',$key)->first();
            //         if(empty($userGetInfo->ProfileCover)):                
            //             User::where('id',$key)->update([
            //                 'ProfileCover'=>$coverImageName[0]->getfileName()
            //             ]);
            //         endif;           
            //     endif;
            // endforeach;
        /********************* update member cover image colunm *********************************/ 

          
        
        // $wpAllUsers = json_decode(file_get_contents('http://nannyparentconnection.com/wp-json/wp/v2/getusers'), true);
        // foreach($wpAllUsers->slice(0, 5) as $key => $ueserData):            
        //     $image_url = "http://nannyparentconnection.com/wp-content/uploads/avatars/".$ueserData['data']['ID'].'/';                     
        //     $values = parse_url($ueserData['data']['UserProfilePics']['url']);
        //     $host = explode('.',$values['host']);
        //     $urls = $host[0].'.'.$host[1];
        //     $checkUserExit = User::where('id',$ueserData['data']['ID'])->count();            
        //     //echo 'ID :'.$ueserData['data']['ID'].'--- Username : '.$ueserData['roles'].'<br/>';
        //     //if($ueserData['data']['ID'] >='1' && $ueserData['data']['ID'] =='1000') : 
        //         // echo 'ID :'.$ueserData['data']['ID'];
        //         //     //  echo'<pre>';
        //         //     //  print_r($ueserData['roles']);
        //         //     //  echo'</pre>'; 
        //         // echo'</br>';  
        //         // echo'<----------------------------->';            
        //         if($checkUserExit>0):
        //         else:
        //             $user = new User; 
        //             $user->id = $ueserData['data']['ID'];  
        //             $user->username =$ueserData['data']['user_login'];
        //             if(array_search('family_parent_member',$ueserData['roles'])):
        //                 $user->memberType = 'family_parent_member';
        //             endif;
        //             if(array_search('care_provider_member',$ueserData['roles'])):
        //                 $user->memberType = 'care_provider_member';
        //             endif;
        //             if(array_search('agency_member',$ueserData['roles'])):
        //                 $user->memberType = 'agency_member';
        //             endif;
        //             $user->name = $ueserData['data']['display_name'];
        //             $user->email = $ueserData['data']['user_email'];
        //             $user->password = $ueserData['data']['user_pass'];
        //             if(!empty($ueserData['data']['UserBasicDetail']['first_name'][0])):
        //                 $user->firstName = $ueserData['data']['UserBasicDetail']['first_name'][0];
        //             endif;
        //             if(!empty($ueserData['data']['UserBasicDetail']['last_name'][0])):
        //                 $user->lastName = $ueserData['data']['UserBasicDetail']['last_name'][0];
        //             endif;
        //             if(!empty($ueserData['data']['UserBasicDetail']['mepr-address-one'][0])):
        //                 $user->address1 = $ueserData['data']['UserBasicDetail']['mepr-address-one'][0];
        //             endif;
        //             if(!empty($ueserData['data']['UserBasicDetail']['mepr-address-two'][0])):
        //                 $user->address2 = $ueserData['data']['UserBasicDetail']['mepr-address-two'][0];
        //             endif;
        //             if(!empty($ueserData['data']['UserBasicDetail']['mepr-address-city'][0])):
        //                 $user->city = $ueserData['data']['UserBasicDetail']['mepr-address-city'][0];
        //             endif;
        //             if(!empty($ueserData['data']['UserBasicDetail']['mepr-address-state'][0])):
        //                 $user->state = $ueserData['data']['UserBasicDetail']['mepr-address-state'][0];
        //             endif;
        //             if(!empty($ueserData['data']['UserBasicDetail']['mepr-address-zip'][0])):
        //                 $user->postal_code = $ueserData['data']['UserBasicDetail']['mepr-address-zip'][0];
        //             endif;
        //             if($urls=='nannyparentconnection.com'):
        //                 $getUserFolder = Str::afterLast($ueserData['data']['UserProfilePics']['url'], '/');
        //                 // $content = file_get_contents($image_url.$getUserFolder);
        //                 // $fp = fopen(public_path('uploads/profileImage/'.$getUserFolder), "w");
        //                 // fwrite($fp, $content);
        //                 // fclose($fp);
        //                 $user->profileImage = $getUserFolder;                     
        //             endif;
        //             $user->status = $ueserData['data']['user_status'];          
        //             $user->created_at = $ueserData['data']['user_registered'];
        //             $user->save(); 
        //         endif;
        //     //endif;                              
        // endforeach;
        // die('data import');        
        $users = User::orderBy('id','DESC')->paginate(30);
        return view('admin.users-list',compact('users'));
    }

    public function uploadWpUsers()
    {
        return view('admin.upload-Wp-Users');
    }

    public function uploadUsers(Request $request)
    {         
        $this->validate($request,[
            'usersCSV'=>'required'
        ]);   
        
        $file = $request->file('usersCSV');       
        if(!empty($file)):
            $original_name = $file->getClientOriginalName();
            $file_path = $file->getPathName();
            $location = 'uploads';
            $file->move($location,$original_name);
            $filepath = public_path($location."/".$original_name);
            $file = fopen($filepath,"r");
            $importData_arr = array();
            $i = 0;
            while (($filedata = fgetcsv($file, 100000, ",")) !== FALSE) {
                $num = count($filedata );                
                for ($c=0; $c < $num; $c++) {
                   $importData_arr[$i][] = $filedata[$c];
                }
                $i++;
             }
             fclose($file);
             
            foreach($importData_arr as $importData){               
                $user = new User; 
                $user->id = $importData[0];
                $user->role = $importData[1];
                $user->name = $importData[3];
                $user->email = $importData[4];
                $user->password = $importData[2];
                if($importData[1]=='admin'):
                    $user->status = '1';
                else : 
                    $user->status = $importData[8];
                endif;
                $user->created_at = $importData[6];
                $user->save();                      
            }
            return redirect()->back()->with('success', 'User import successfully.');
        else:
            return redirect()->back()->with('errors', 'upload only CSV file.');
        endif;
    }

    public function userView($id)
    {
        $user = User::findOrFail($id);
        $userBio = UserBio::where('userID', $id)->first();
        if($user->memberType=='care_provider_member'):
            return view('admin.care-provider-detail',compact('user','userBio'));
        elseif($user->memberType=='family_parent_member'):
            return view('admin.family-parent-detail',compact('user','userBio'));
        elseif($user->memberType=='agency_member'):
            return view('admin.agency-member-detail',compact('user','userBio'));
        else:
            return view('admin.user-view',compact('user'));
        endif;
    }

    public function groups()
    {
        $groups = Group::orderBy('id','DESC')->paginate(30);        
        return view('admin.groups-list',compact('groups'));
    }

    public function AddGroup()
    {
        return view('admin.groups-add');
    }

    public function SaveGroup(Request $request)
    {
        $data =  Request::except(array('_token')) ;        
        $inputs = Request::all();                   
        $rule=array(
            'groupName' => 'required',
            'groupImage' => 'mimes:jpg,png,jpeg|max:2048',                  		        	        
        );
        
        $validator = \Validator::make($data,$rule); 
        if ($validator->fails())
        {
            return redirect()->back()->withErrors($validator->messages());
        }

        $checkGroupName = Group::where('groupName',$inputs['groupName'])->count();
        if($checkGroupName>0):
            return redirect()->back()->withErrors($inputs['groupName'].' already exit.');
        endif;
        $group = new Group;
        $group->groupName = $inputs['groupName'];
        $group->groupSlug = Str::slug($inputs['groupName']);
        $group->groupDescription = $inputs['groupDescription'];
        $group->groupStatus = 'Active';
        if(!empty($inputs['groupImage'])):            
            $file= $inputs['groupImage'];
            $filename= rand().'_'.$file->getClientOriginalName();
            $file-> move(public_path('uploads/groupsImages/'), $filename);
            $group->groupImage = $filename;
        endif;
        $group->save();
        return redirect()->back()->with('success', 'Save successfully.');
    }

    public function editGroup($slug)
    {
        $checkGroup = Group::where('groupSlug',$slug)->count();
        if($checkGroup>0):
            $groupDetail = Group::where('groupSlug',$slug)->first();           
            return view('admin.groups-edit',compact('groupDetail'));
        else: 
            return redirect('/superadmin/groups');
        endif;
    }

    public function updateGroup(Request $request)
    {
        $data =  Request::except(array('_token')) ;        
        $inputs = Request::all();                   
        
        if(empty($inputs['groupName'])):
            return redirect()->back()->withErrors('Group name field required.');
        endif;
        
        $group = Group::where('id',decrypt($inputs['id']))->first();        
        $count = Group::where('groupName',$inputs['groupName'])->where('id','!=',decrypt($inputs['id']))->count();
        if($count>0):
            return redirect()->back()->withErrors($inputs['groupName'].' already exit.');
        endif;
        
        $group->groupName = $inputs['groupName'];
        $group->groupSlug = Str::slug($inputs['groupName']);
        $group->groupDescription = $inputs['groupDescription'];
        
        if(!empty($inputs['groupImage'])): 
            if(!empty($group->groupImage)) {
                if(File::exists(public_path('uploads/groupsImages/'.$group->groupImage))):
                    File::delete(public_path('uploads/groupsImages/'.$group->groupImage));
                endif;
            }
            $file= $inputs['groupImage'];
            $filename= rand().'_'.$file->getClientOriginalName();
            $file-> move(public_path('uploads/groupsImages/'), $filename);
            $group->groupImage = $filename;
        endif;
        $group->save();
        return redirect()->back()->with('success', 'Update successfully.');
    }

    public function ForgotPassword()
    {
        $inputs = Request::all();
        $checkAdmin = User::where('username',$inputs['inputData'])->orWhere('email',$inputs['inputData'])->count();
        if($checkAdmin>0):
           $userDetails =  User::where('username',$inputs['inputData'])->orWhere('email',$inputs['inputData'])->first();
            if($userDetails->role=='admin'):
                return response()->json([
                    'detailMatch' => 'Please wait..',
                    'userName'=>$userDetails->username
                ]);
            else:
                return response()->json([
                    'detailnotMatch' => 'Your Detail Not Match'
                ]);
            endif;
        else:
            return response()->json([
                'detailnotMatch' => 'Your Detail Not Match'
            ]);
        endif;
    }

    public function ResetPassword()
    {
        $inputs = Request::all();
        $checkAdmin = User::where('username',$inputs['usernameID'])->count();
        if($checkAdmin>0):
            $userDetails =  User::where('username',$inputs['usernameID'])->first();
            $userDetails->password = bcrypt($inputs['userNewpassword']);
            $userDetails->save();
            return response()->json([
                'passwordReset' => 'Your password reset successfully.'
            ]);
        else:
        endif;
    }

    public function addUser()
    {
        $familiesPlans = Membership::where('post_status','publish')                           
                            ->whereIn('id', ['29748', '155721', '155718'])
                            ->get();

        $careProviderPlans = Membership::where('post_status','publish')
                            ->whereIn('id', ['29896','176612'])
                            ->get();

        $AgenciesPlans = Membership::where('post_status','publish') 
                            ->whereIn('id', ['30019','155715','155712'])
                            ->get();
                  
        return view('admin.add-user',compact('familiesPlans','careProviderPlans','AgenciesPlans'));
    }

    public function SaveNewUser(Request $request)
    {
        $inputs = Request::all();
        $validator = Validator::make($inputs, [                
            'firstName' => 'required',
            'lastName' => 'required',            
            'address1' => 'required|string|max:255',            
            'state' => 'required|string|max:255',
            'postalCode' => 'required|string|max:255',
            'phoneNumber' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|required_with:confirmPassword|same:confirmPassword|min:6'         
        ]);               

        if ($validator->fails())
        {
            return redirect()->back()->withInput()->withErrors($validator->messages());
        }

        $user = new User;
        $user->role = 'subscriber';
        $user->memberType = $inputs['memberType'];
        $user->firstName = $inputs['firstName'];
        $user->lastName = $inputs['lastName'];
        $user->name = $inputs['firstName'].' '.$inputs['lastName'];
        $user->address1 = $inputs['address1'];
        if(!empty($inputs['address2'])) :
            $user->address2 = $inputs['address2'];
        endif;
        $user->state = $inputs['state'];
        $user->postal_code = $inputs['postalCode'];
        $user->mobile = $inputs['phoneNumber'];
        $user->username = $inputs['username'];
        $user->email = $inputs['email'];
        $user->password = Hash::make($inputs['password']);
        $user->user_password = $inputs['password'];
        $user->wp_password_update = 1;
        $user->save();

        if(!empty($inputs['FamilyMemberShipType'])):
            $findMemberShipInfo = Membership::where('id',$inputs['FamilyMemberShipType'])->first();
            $findSubcription = new subscribersPlans;
            $findSubcription->user_id = $user->id;
            $findSubcription->product_id = $findMemberShipInfo->id;
            $findSubcription->subscr_id = 'mp-sub-'.rand();
            $findSubcription->coupon_id = '0';
            $findSubcription->tax_amount = '0.00';
            $findSubcription->tax_rate = '0.000';
            $findSubcription->tax_compound = '0';
            $findSubcription->tax_shipping = '1';
            $findSubcription->tax_class = 'standard';
            $findSubcription->price = $findMemberShipInfo->mepr_product_price;
            $findSubcription->total = $findMemberShipInfo->mepr_product_price;            
            $findSubcription->period_type = $findMemberShipInfo->mepr_product_period;        
            $findSubcription->status = 'active';            
            $findSubcription->save();

            $subscriptionTransaction = new SubscriptionsTransactions;
            $subscriptionTransaction->user_id = $findSubcription->user_id;
            $subscriptionTransaction->product_id = $findSubcription->product_id;
            $subscriptionTransaction->subscription_id = $findSubcription->id;
            $subscriptionTransaction->amount = $findMemberShipInfo->mepr_product_price;
            $subscriptionTransaction->total = $findMemberShipInfo->mepr_product_price;
            $subscriptionTransaction->tax_compound = $findSubcription->tax_compound;
            $subscriptionTransaction->tax_shipping = $findSubcription->tax_shipping;
            $subscriptionTransaction->tax_class = $findSubcription->tax_class;
            $subscriptionTransaction->coupon_id = $findSubcription->coupon_id;
            $subscriptionTransaction->status = 'complete';
            $subscriptionTransaction->txn_type = 'Testing';            
            $subscriptionTransaction->updated_at = date('Y-m-d H:i:s');
            $subscriptionTransaction->save();

        elseif(!empty($inputs['CareProviderMemberShipType'])):            
            $findMemberShipInfo = Membership::where('id',$inputs['CareProviderMemberShipType'])->first();
            $findSubcription = new subscribersPlans;
            $findSubcription->user_id = $user->id;
            $findSubcription->product_id = $findMemberShipInfo->id;
            $findSubcription->subscr_id = 'mp-sub-'.rand();
            $findSubcription->coupon_id = '0';
            $findSubcription->tax_amount = '0.00';
            $findSubcription->tax_rate = '0.000';
            $findSubcription->tax_compound = '0';
            $findSubcription->tax_shipping = '1';
            $findSubcription->tax_class = 'standard';
            $findSubcription->price = $findMemberShipInfo->mepr_product_price;
            $findSubcription->total = $findMemberShipInfo->mepr_product_price;            
            $findSubcription->period_type = $findMemberShipInfo->mepr_product_period;        
            $findSubcription->status = 'active';            
            $findSubcription->save();

            $subscriptionTransaction = new SubscriptionsTransactions;
            $subscriptionTransaction->user_id = $findSubcription->user_id;
            $subscriptionTransaction->product_id = $findSubcription->product_id;
            $subscriptionTransaction->subscription_id = $findSubcription->id;
            $subscriptionTransaction->amount = $findMemberShipInfo->mepr_product_price;
            $subscriptionTransaction->total = $findMemberShipInfo->mepr_product_price;
            $subscriptionTransaction->tax_compound = $findSubcription->tax_compound;
            $subscriptionTransaction->tax_shipping = $findSubcription->tax_shipping;
            $subscriptionTransaction->tax_class = $findSubcription->tax_class;
            $subscriptionTransaction->coupon_id = $findSubcription->coupon_id;
            $subscriptionTransaction->status = 'complete';
            $subscriptionTransaction->txn_type = 'Testing';            
            $subscriptionTransaction->updated_at = date('Y-m-d H:i:s');
            $subscriptionTransaction->save();
        elseif(!empty($inputs['AgencyMemberShipType'])):
            $findMemberShipInfo = Membership::where('id',$inputs['AgencyMemberShipType'])->first();
            $findSubcription = new subscribersPlans;
            $findSubcription->user_id = $user->id;
            $findSubcription->product_id = $findMemberShipInfo->id;
            $findSubcription->subscr_id = 'mp-sub-'.rand();
            $findSubcription->coupon_id = '0';
            $findSubcription->tax_amount = '0.00';
            $findSubcription->tax_rate = '0.000';
            $findSubcription->tax_compound = '0';
            $findSubcription->tax_shipping = '1';
            $findSubcription->tax_class = 'standard';
            $findSubcription->price = $findMemberShipInfo->mepr_product_price;
            $findSubcription->total = $findMemberShipInfo->mepr_product_price;            
            $findSubcription->period_type = $findMemberShipInfo->mepr_product_period;        
            $findSubcription->status = 'active';            
            $findSubcription->save();

            $subscriptionTransaction = new SubscriptionsTransactions;
            $subscriptionTransaction->user_id = $findSubcription->user_id;
            $subscriptionTransaction->product_id = $findSubcription->product_id;
            $subscriptionTransaction->subscription_id = $findSubcription->id;
            $subscriptionTransaction->amount = $findMemberShipInfo->mepr_product_price;
            $subscriptionTransaction->total = $findMemberShipInfo->mepr_product_price;
            $subscriptionTransaction->tax_compound = $findSubcription->tax_compound;
            $subscriptionTransaction->tax_shipping = $findSubcription->tax_shipping;
            $subscriptionTransaction->tax_class = $findSubcription->tax_class;
            $subscriptionTransaction->coupon_id = $findSubcription->coupon_id;
            $subscriptionTransaction->status = 'complete';
            $subscriptionTransaction->txn_type = 'Testing';            
            $subscriptionTransaction->updated_at = date('Y-m-d H:i:s');
            $subscriptionTransaction->save();
        endif;  
        
        return redirect()->back()->with('success', 'Member & Membership Created Succssfully.');
    }


}


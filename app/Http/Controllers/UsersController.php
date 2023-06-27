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
//use Intervention\Image\Facades\Image;
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
use App\Models\Group;
use App\Models\UserGroup;
use DB;
use App\Models\GroupPost;
use App\Models\UserPost;
use App\Models\UserPostLike;
use App\Models\UserPostComments;
use App\Models\GroupPostLike;
use App\Models\GroupPostComments;
use App\Events\ChatEvent;
use App\Events\PostEvent;
use App\Events\PostCommentEvent;
use App\Models\SubscriptionsTransactions;
use Illuminate\Support\Facades\Mail;
use App\Models\PrivateMessage;
use App\Models\PrivateMessageRecipients;
use App\Events\PrivateMessageEvent;
use App\Models\MemberReview;
use Http\Client\Exception\RequestException;
use Illuminate\Support\Facades\Http;
use App\Events\FriendRequestSend;
use App\Models\Notification;
use Image;
use App\Models\PaymentGateway;
use URL;
use NinjaForm;

class UsersController extends Controller
{
    private $apiToken;

    public function __construct(){
        if(stripeDetail('payment_mode')=='test_mode'):
            $StripeSecretkey = stripeDetail('StripeSecretkey');
            \Stripe\Stripe::setApiKey($StripeSecretkey);
            $this->apiToken = uniqid(base64_encode(Str::random(40)));
        else:
            $StripeSecretkey = stripeDetail('StripeSecretkey');
            \Stripe\Stripe::setApiKey($StripeSecretkey);
            $this->apiToken = uniqid(base64_encode(Str::random(40)));
        endif;
    }

    public function annualPackages()
    {
        if(stripeDetail('payment_mode')=='test_mode'):
            $familiesAnnualPlan = Membership::where('post_status','publish')                                                     
                            ->whereIn('id', ['184396', '184397', '184398'])
                            //->where('plan_category','family_parent')
                            ->get();
            return response()->json([
                'familiesAnnualPlan' => $familiesAnnualPlan,
                'paymentMode' => 'test_mode'
            ]);           
        else:
            $familiesAnnualPlan = Membership::where('post_status','publish')
                                ->whereIn('id', ['29748', '155721', '155718'])
                                //->where('id','29748')
                                ->get();
            return response()->json([
                'familiesAnnualPlan' => $familiesAnnualPlan,
                'paymentMode' => 'live_mode'
            ]);
        endif;        
    } 

    public function planDetails($slug)
    {
        $planDetail = Membership::where('post_title_slug',$slug)->first();
        return response()->json($planDetail);
    }

    public function careProviderAnnualPlans()
    {
        if(stripeDetail('payment_mode')=='test_mode'):
            $careProviderAnnualPlans = Membership::where('post_status','publish')
                    ->whereIn('id', ['184399','176612'])
                    ->orderBy('id','DESC')
                    ->get();
            return response()->json([
                'careProviderAnnualPlans' => $careProviderAnnualPlans
            ]);
        else:
            $careProviderAnnualPlans = Membership::where('post_status','publish')
                    ->whereIn('id', ['29896', '176612'])
                    ->get();
            return response()->json([
                'careProviderAnnualPlans' => $careProviderAnnualPlans
            ]);
        endif;        
    }

    public function AgenciesAnnualPackages()
    {
        if(stripeDetail('payment_mode')=='test_mode'):
            $AgenciesAnnualPackages = Membership::where('post_status','publish')
                                ->whereIn('id', ['184400','184401','184402'])
                                ->get()->toArray();
            
            return response()->json([
                'AgenciesAnnualPlan' => $AgenciesAnnualPackages,
                'paymentMode' => 'test_mode'
            ]);
        else:
            $AgenciesAnnualPackages = Membership::where('post_status','publish')
                                ->whereIn('id', ['30019','155715','155712'])                                
                                ->get()->toArray();                              
                                        
            return response()->json([
                'AgenciesAnnualPlan' => $AgenciesAnnualPackages,
                'paymentMode' => 'live_mode'
            ]);
        endif;
    }

    public function register(Request $request)
    {
        $inputs = Request::all();
        if((Auth::check())):
            $user = User::findOrFail(Auth::user()->id);
        else:
            $validator = Validator::make($inputs, [
                'firstName' => 'required',
                'lastName' => 'required',
                'address1' => 'required|string|max:255',
                'stateProvince' => 'required|string|max:255',
                'postalCode' => 'required|string|max:255',
                'phoneNumber' => 'required|string|max:255',
                'userName' => 'required|string|max:255|unique:users',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|required_with:ConfirmPassword|same:ConfirmPassword|min:6'
            ]);

            if($validator->fails()) {
                return response()->json(['error' => $validator->errors()], 401);
            }

            $planDetail = Membership::where('id',$inputs['planID'])->first();

            $user = new User;
            $user->role = 'subscriber';
            if($planDetail->plan_category=='family_parent'):
                $user->memberType = 'family_parent_member';
            elseif($planDetail->plan_category=='careprovider'):
                $user->memberType = 'care_provider_member';
            elseif($planDetail->plan_category=='agency'):
                $user->memberType = 'agency_member';
            endif;
            $user->firstName = $inputs['firstName'];
            $user->lastName = $inputs['lastName'];
            $user->name = $inputs['firstName'].' '.$inputs['lastName'];
            //$user->lastName = $inputs['lastName'];
            $user->address1 = $inputs['address1'];
            if(!empty($inputs['address22'])) :
                $user->address2 = $inputs['address22'];
            endif;
            $user->state = $inputs['stateProvince'];
            $user->postal_code = $inputs['postalCode'];
            $user->mobile = $inputs['phoneNumber'];
            $user->username = $inputs['userName'];
            $user->email = $inputs['email'];
            $user->password = Hash::make($inputs['password']);
            $user->user_password = $inputs['password'];
            $user->wp_password_update = 1;
            $user->save();
        endif;  

        $patmentGateway = PaymentGateway::where('id',1)->first();

        // if(stripeDetail('payment_mode')=='test_mode'):
        //     $stripe = new \Stripe\StripeClient(
        //         stripeDetail('StripeSecretkey')
        //     );
        // else:
        //     $stripe = new \Stripe\StripeClient(
        //         stripeDetail('live_StripeSecretkey')
        //     );
        // endif;

        // if($planDetail->id=='29748' || $planDetail->id=='184396'):
        //     $success_url = URL::to('/thank-you-family-annual');
        // elseif($planDetail->id=='155721' || $planDetail->id=='184397'):
        //     $success_url = URL::to('/thank-you-family-monthly');
        // elseif($planDetail->id=='155718' || $planDetail->id=='184398'):
        //     $success_url = URL::to('/thank-you-family-one-month-only');
        // elseif($planDetail->id=='29896' || $planDetail->id=='184399'):
        //     $success_url = URL::to('/thank-you-care-providers-annual');
        // elseif($planDetail->id=='30019' || $planDetail->id=='184400'):
        //     $success_url = URL::to('/thank-you-agency-annual');
        // elseif($planDetail->id=='155715' || $planDetail->id=='184401'):
        //     $success_url = URL::to('/thank-you-agency-monthly');
        //     elseif($planDetail->id=='155712' || $planDetail->id=='184402'):
        //     $success_url = URL::to('/thank-you-agency-one-month-only');
        // else:
        //     $success_url = URL::to('/success');
        // endif;

        // if($planDetail->mepr_product_period=='lifetime'): 
        //     $success_url2 = $success_url;
        //     $checkout = $stripe->checkout->sessions->create( [
        //         'success_url' => $success_url2,
        //         'cancel_url' => URL::to('/cancel'),
        //         'line_items' => [
        //         [
        //             'price' => $planDetail->stripe_prod_priceID,
        //             'quantity' => 1,
        //         ]   
        //         ],
        //         'invoice_creation' => [
        //         'enabled' => true,  
        //     ],
        //         'customer_email'=> $user->email,
        //         'mode' => 'payment',
        //     ]);
        //     $checkout_sessionID = $checkout->id;
        // else:
        //     $checkout_sessionID = '';
        //     $success_url2 = $success_url;
        // endif;

        $userGroups = new UserGroup;
        $userGroups->userID = $user->id;
        $userGroups->groupID = $inputs['UserGroup'];
        $userGroups->save(); 

        return response()->json([
            'userInfo' => $user,
            'planDetail' => $planDetail,
            'patmentGateway' => $patmentGateway,
            //'checkout_sessionID' => $checkout_sessionID,
            //'success_url' => $success_url2            
        ]);
    }


    public function registerFreeCareProvider(Request $request)
    {
        $inputs = Request::all();
        if((Auth::check())):
            $user = User::findOrFail(Auth::user()->id);
        else:
            $validator = Validator::make($inputs, [
                'firstName' => 'required',
                'lastName' => 'required',
                'address1' => 'required|string|max:255',
                'stateProvince' => 'required|string|max:255',
                'postalCode' => 'required|string|max:255',
                'phoneNumber' => 'required|string|max:255',
                'userName' => 'required|string|max:255|unique:users',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|required_with:ConfirmPassword|same:ConfirmPassword|min:6'
            ]);

            if($validator->fails()) {
                return response()->json(['error' => $validator->errors()], 401);
            }

            $user = new User;
            $user->role = 'subscriber';
            $user->memberType = 'care_provider_member';
            $user->firstName = $inputs['firstName'];
            $user->lastName = $inputs['lastName'];
            $user->name = $inputs['firstName'].' '.$inputs['lastName'];
            //$user->lastName = $inputs['lastName'];
            $user->address1 = $inputs['address1'];
            if(!empty($inputs['address22'])) :
                $user->address2 = $inputs['address22'];
            endif;
            $user->state = $inputs['stateProvince'];
            $user->postal_code = $inputs['postalCode'];
            $user->mobile = $inputs['phoneNumber'];
            $user->username = $inputs['userName'];
            $user->email = $inputs['email'];
            $user->password = Hash::make($inputs['password']);
            $user->user_password = $inputs['password'];
            $user->wp_password_update = 1;
            $user->save();

            $userGroups = new UserGroup;
            $userGroups->userID = $user->id;
            $userGroups->groupID = $inputs['UserGroup'];
            $userGroups->save();

            $userbio = New UserBio;
            $userbio->userID = $user->id;
            $userbio->currently_seeking_provider_work = $inputs['CurrentlySeekingFamiliesWork'];
            $userbio->userType = $user->memberType;
            $userbio->TypeOfCareLooking = serialize($inputs['TypeOfCareLooking']);
            $userbio->CareOpportunities = serialize($inputs['LookingForCareOpportunities']);
            $userbio->providerChildExperience = serialize($inputs['providerChildExperience']);
            $userbio->providerExperience = $inputs['providerTotalExperience'];
            $userbio->minRange = $inputs['minRange'];
            $userbio->maxRange = $inputs['maxRange'];
            $userbio->aboutMyfamily = $inputs['aboutMe'];
            $userbio->ChildSpecialNeeds = $inputs['providerSpecialNeeds'];
            $userbio->save();

            $findMemberShipInfo = Membership::where('id',$inputs['planID'])->first();
            $findSubcription = new subscribersPlans;
            $findSubcription->user_id = $user->id;
            $findSubcription->product_id = $findMemberShipInfo->id;
            $findSubcription->coupon_id = '0';
            $findSubcription->tax_amount = '0.00';
            $findSubcription->tax_rate = '0.000';
            $findSubcription->tax_compound = '0';
            $findSubcription->tax_shipping = '1';
            $findSubcription->tax_class = 'standard';
            $findSubcription->price = $findMemberShipInfo->mepr_product_price;
            $findSubcription->total = $findMemberShipInfo->mepr_product_price;
            $findSubcription->gateway = 'Free';
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
            $subscriptionTransaction->txn_type = 'Free';
            $subscriptionTransaction->gateway = 'Free';
            $subscriptionTransaction->save();

            $siteName = getcong('siteName');
            $siteEmail = getcong('siteEmail');
            $buy_date = date('F j,Y');
            $IP_address = request()->getClientIp();

            $data = array(
                'siteName'=>$siteName,
                'siteEmail'=>$siteEmail,
                'user_id'=>$user->id,
                'user_first_name'=>$user->name,
                'user_full_name'=>$user->name,
                'name'=>$user->name,
                'username'=>$user->username,
                'user_login'=>$user->username,
                'email'=>$user->email,
                'user_email'=>$user->email,
                'password'=>$inputs['password'],
                'user_remote_addr'=>$IP_address,
                'productName'=>$findMemberShipInfo->post_title
            );       
            
            /******************** Email To Member ******************************/
                Mail::send('emails.register', $data, function ($message) use ($data) {
                    $message->subject('Nanny Parent Connection Welcome!');
                    $message->from('admin@nannyparentconnection.com', $data['siteName']);
                    $message->bcc('sudhirkundal007@gmail.com');
                    $message->to($data['email']);
                });
            /******************** Email To Admin ******************************/
                Mail::send('emails.new_register', $data, function ($message) use ($data) {
                    $message->subject('Nanny Parent Connection Welcome!');
                    $message->from($data['email'], $data['name']);
                    $message->bcc('sudhirkundal007@gmail.com');
                    $message->to($data['siteEmail']);
                });
        endif;

        return response()->json([
            'updateMsg' => 'Thank you.'
        ]);
    }

    public function login(Request $request)
    {
        $inputs = Request::all();
        $checkUserInfo = User::where('email',$inputs['username'])->orWhere('username',$inputs['username'])->count();
        if($checkUserInfo>0)
        {
            $userInfo = User::where('email',$inputs['username'])->orWhere('username',$inputs['username'])->first();
            if($userInfo->wp_password_update==0 && empty($userInfo->user_password)):
                $userInfo->password = Hash::make($inputs['password']);
                $userInfo->wp_password_update = 1;
                $userInfo->user_password = $inputs['password'];
                $userInfo->save();
            endif;
            if(empty($userInfo->user_password)):
                $userInfo->user_password = $inputs['password'];
                $userInfo->save();
            endif;

            if(Auth::attempt(['email' => $inputs['username'], 'password' => $inputs['password']]))
            {
                $user = Auth::user();
                $success = true;
                $userDetail = $user;
                $message = 'User login successfully';
            } elseif(Auth::attempt(['username' => $inputs['username'], 'password' => $inputs['password']])) {
                $user = Auth::user();
                // $file = 'https://nannyparentconnection.com/wp-content/uploads/buddypress/members/'.$user->id;
                // try {
                //     $response = Http::get($file);
                //     if($response->successful()) {
                //         $cover_img = 'https://nannyparentconnection.com/wp-content/uploads/buddypress/members/'.$user->id.'/cover-image'.'/';
                //         $cover_img_name = file_get_contents($cover_img);
                //         $data = json_decode($cover_img_name, TRUE);
                //         echo "<pre>";
                //         print_r($data);
                //         echo "</pre>";
                //     }
                // } catch (\Exception $ex) {
                //     echo 'not found';
                // }
                // die();
                $success = true;
                $userDetail = $user;
                $message = 'User login successfully';
            }
            else {
                $success = false;
                $userDetail = '';
                $message = 'Unauthorized Access';
                // return response()->json([
                //   'status' => 'error',
                //   'data' => 'Unauthorized Access'
                // ]);
            }
        } else {
            $success = false;
            $userDetail = '';
            $message = 'Unauthorized Access';
        }

        $response = [
            'success' => $success,
            'message' => $message,
            'userDetails' => $userDetail
        ];
        return response()->json($response);
    }

    public function logout()
    {
        try {
            Session::flush();
            $success = true;
            $message = 'Successfully logged out';
        } catch (\Illuminate\Database\QueryException $ex) {
            $success = false;
            $message = $ex->getMessage();
        }

        // response
        $response = [
            'success' => $success,
            'message' => $message,
        ];
        return response()->json($response);
    }

    public function userPlan($userid)
    {
        $userPlans = subscribersPlans::where('user_id',$userid)->whereNotNull ('status')->get();
        //SubscriptionsTransactions
        $userSubcribePlans = array();
        foreach($userPlans as $key => $plansDetial):
            $userSubcribePlans[$key] = $plansDetial;
            $userSubcribePlans[$key]->membershipPlanInfo = Membership::where('id',$plansDetial->product_id)->first();
            $userSubcribePlans[$key]->subscriptionsTransactions = SubscriptionsTransactions::where('subscription_id',$plansDetial->id)->orderby('id','DESC')->first();
        endforeach;

        return response()->json([
            'userPlans' => $userSubcribePlans
        ]);
    }

    public function updateBasicInfo(Request $request)
    {
        $inputs = Request::all();
        $validator = Validator::make($inputs, [
            'firstName' => 'required',
            'lastName' => 'required',
            'address1' => 'required|string|max:255',
            'stateProvince' => 'required|string|max:255',
            'postalCode' => 'required|string|max:255',
            'phoneNumber' => 'required|string|max:255'
        ]);

        if($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }

        $user = User::findOrFail($inputs['userID']);
        $user->firstName = $inputs['firstName'];
        $user->lastName = $inputs['lastName'];
        $user->name = $inputs['firstName'].' '.$inputs['lastName'];
        $user->address1 = $inputs['address1'];
        $user->address2 = $inputs['address22'];
        $user->state = $inputs['stateProvince'];
        $user->postal_code = $inputs['postalCode'];
        $user->mobile = $inputs['phoneNumber'];
        $user->save();
        return response()->json([
            'userInfo' => $user,
            'updateMsg' => 'Update successfully'
        ]);
    }

    public function updatePassword(Request $request)
    {
        $inputs = Request::all();
        $validator = Validator::make($inputs, [
            'password' => 'required|required_with:ConfirmPassword|same:ConfirmPassword|min:6'
        ]);

        if($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }

        $user = User::findOrFail($inputs['userID']);
        $user->password = Hash::make($inputs['password']);
        $user->save();
        return response()->json([
            'updatePassMsg' => 'Password change successfully'
        ]);
    }

    public function updateSocailLinks(Request $request)
    {
        $inputs = Request::all();
        $user = User::findOrFail($inputs['userID']);
        $user->facebookURL = $inputs['facebookURL'];
        $user->twitterURL = $inputs['twitterURL'];
        $user->instagramURL = $inputs['instagramURL'];
        $user->linkedinURL = $inputs['linkedinURL'];
        $user->save();
        return response()->json([
            'updateSocailsLinkMsg' => 'Socials links update successfully'
        ]);
    }

    public function updateProfileImage(Request $request)
    {
        $inputs = Request::all();
        $file= $inputs['file'];
        if(!empty($inputs['file'])):
            $userData = User::findOrFail($inputs['userID']);
            if(!empty($userData->profileImage)) {
                if(File::exists(public_path('uploads/profileImage/'.$userData->profileImage))):
                    File::delete(public_path('uploads/profileImage/'.$userData->profileImage));
                endif;
            }

            $file= $inputs['file'];
            $filename= $file->getClientOriginalName().'.'.$file->extension();
            $img = Image::make($file);
            $img->resize(150, 150);
            $file->move(public_path('uploads/profileImage/'), $userData->username.'_'.$filename);
            $userData->profileImage = $userData->username.'_'.$filename;
            $userData->save();
            return response()->json([
                'success' => 'Profile Image Change Successfully.',
                'userData' => $userData
            ]);
        endif;
    }

    public function profileCoverImage(Request $request)
    {
        $inputs = Request::all();
        if(!empty($inputs['ProfileCover'])):
            $userData = User::findOrFail($inputs['User_id']);
            $memberFolder = public_path().'/uploads/coverImages/'.$inputs['User_id'].'/cover-image';
            if(empty($userData->ProfileCover)) :
                $makeFolder = File::makeDirectory($memberFolder, $mode = 0777, true, true);
                $file= $inputs['ProfileCover'];
                $filename= $file->getClientOriginalName().'.'.$file->extension();
                $file->move(public_path('uploads/coverImages/'.$inputs['User_id']), $filename);
                $userData->ProfileCover = $filename;
                $userData->save();
            else:
                if(File::exists(public_path('uploads/coverImages/'.$inputs['User_id'].'/cover-image'.$userData->ProfileCover))):
                    File::delete(public_path('uploads/coverImages/'.$inputs['User_id'].'/cover-image'.$userData->ProfileCover));
                endif;
                $file= $inputs['ProfileCover'];
                $filename= $file->getClientOriginalName().'.'.$file->extension();
                $file->move(public_path('uploads/coverImages/'.$inputs['User_id'].'/cover-image'), $filename);
                $userData->ProfileCover = $filename;
                $userData->save();
            endif;

            // if(!empty($userData->profileImage)) {
            //     if(File::exists(public_path('uploads/profileImage/'.$userData->ProfileCover))):
            //         File::delete(public_path('uploads/profileImage/'.$userData->ProfileCover));
            //     endif;
            //     $file= $inputs['ProfileCover'];
            //     $filename= $file->getClientOriginalName();
            //     $file-> move(public_path('uploads/profileImage/'), $userData->username.'_cover_'.$filename);
            //     $userData->ProfileCover = $userData->username.'_cover_'.$filename;
            //     $userData->save();
            // }
            // $file= $inputs['ProfileCover'];
            // $filename= $file->getClientOriginalName();
            // $file-> move(public_path('uploads/profileImage/'), $userData->username.'_cover_'.$filename);
            // $userData->ProfileCover = $userData->username.'_cover_'.$filename;
            // $userData->save();
            return response()->json([
                'CoverSuccess' => 'Profile Cover Change Successfully.',
                'userData' => $userData
            ]);
        endif;
    }

    public function careProvidersList(Request $request)
    {
        $inputs = Request::all();    
        if(!empty($inputs['SelectMemberType']) && empty($inputs['keywordSearch']) && empty($inputs['SelectTypeCare']) && empty($inputs['SelectLocation'])):
            if($inputs['SelectMemberType']=='care_provider_member'):
                $GetMembers = User::where('role','!=','admin')
                            ->whereNotNull('memberType')
                            ->where('memberType', 'care_provider_member')
                            ->orderBy('id','DESC')
                            ->pluck('id') 
                            ->toArray();

                if(count($GetMembers)>0):
                    $careProviders = UserBio::where('userID','!=',Auth::user()->id)
                            ->whereIn('userID', $GetMembers)
                            ->whereNotNull('TypeOfCareLooking')
                            ->orderBy('id','DESC')
                            ->paginate(20);
                    $careProvidersTotal = count($careProviders);
                    $careProvidersArray = array();
                    foreach($careProviders as $key => $plansDetial):
                        $careProvidersArray[$key] = $plansDetial;
                        if(!empty($plansDetial->TypeOfCareLooking)):
                            $TypeOfCareLooking[$key] = unserialize($plansDetial->TypeOfCareLooking);
                            $careLooking=$TypeOfCareLooking[$key];
                            $careProvidersArray[$key]->TypeOfCareLookingData = $careLooking;
                        else:
                            $careProvidersArray[$key]->TypeOfCareLookingData ='';
                        endif;

                        if(!empty($plansDetial->CareOpportunities)):
                            $CareOpportunities[$key] = unserialize($plansDetial->CareOpportunities);
                            $Locations=$CareOpportunities[$key];
                            $careProvidersArray[$key]->CareOpportunitiesData = $Locations;
                        else:
                            $careProvidersArray[$key]->CareOpportunitiesData ='';
                        endif;

                        if(!empty($plansDetial->providerChildExperience)):
                            $WillCareForData[$key] = unserialize($plansDetial->providerChildExperience);
                            $WillCareForData=$WillCareForData[$key];
                            $careProvidersArray[$key]->WillCareForData = $WillCareForData;
                        else:
                            $careProvidersArray[$key]->WillCareForData ='';
                        endif;

                        $careProvidersArray[$key]->providersInfo = User::where('id',$plansDetial->userID)->first();
                        $checkBothfriends = MemberFriends::where('requestSendTo',$plansDetial->userID)
                                                    ->where('senderUserID',Auth::user()->id)
                                                    ->count();
                        if($checkBothfriends>0):
                            $BothfriendsDetail = MemberFriends::where('requestSendTo',$plansDetial->userID)
                            ->where('senderUserID',Auth::user()->id)
                            ->first();
                            $careProvidersArray[$key]->Alreadyfriends = $BothfriendsDetail;
                        else:
                            $checkBothfriends2 = MemberFriends::where('senderUserID',$plansDetial->userID)
                                                        ->where('requestSendTo',Auth::user()->id)
                                                        ->count();
                            if($checkBothfriends2>0):
                                $BothfriendsDetail = MemberFriends::where('senderUserID',$plansDetial->userID)
                                ->where('requestSendTo',Auth::user()->id)
                                ->first();
                                $careProvidersArray[$key]->Alreadyfriends = $BothfriendsDetail;
                            else:
                                $careProvidersArray[$key]->Alreadyfriends = '';
                            endif;
                        endif;
                    endforeach;
                        return response()->json([
                        'getProviders' => 'Providers',
                        'providers' => $careProviders,
                        'careProvidersTotal' =>$careProvidersTotal
                    ]);
                else:
                    $totalMember = count($GetMembers);
                    return response()->json([
                        'error' => 'Not found!',
                        'BeforeMemberCheckCount' => $totalMember
                    ]);
                endif;
            elseif($inputs['SelectMemberType']=='family_parent_member'):
                $GetMembers = User::where('role','!=','admin')
                            ->whereNotNull('memberType')
                            ->where('memberType', 'family_parent_member')
                            ->orderBy('id','DESC')
                            ->pluck('id')
                            ->toArray();

                if(count($GetMembers)>0):
                    $careProviders = UserBio::where('userID','!=',Auth::user()->id)
                            ->whereIn('userID', $GetMembers)
                            ->whereNotNull('TypeOfCareLooking')
                            ->orderBy('id','DESC')
                            ->paginate(20);
                    $careProvidersTotal = count($careProviders);
                    $careProvidersArray = array();
                    foreach($careProviders as $key => $plansDetial):
                        $careProvidersArray[$key] = $plansDetial;
                        if(!empty(unserialize($plansDetial->TypeOfCareLooking))):
                            $TypeOfCareLooking[$key] = unserialize($plansDetial->TypeOfCareLooking);
                            $careLooking=$TypeOfCareLooking[$key];
                            $careProvidersArray[$key]->TypeOfCareLookingData = $careLooking;
                        else:
                            $careProvidersArray[$key]->TypeOfCareLookingData ='';
                        endif;
                        if(!empty(unserialize($plansDetial->CareOpportunities))):
                            $CareOpportunities[$key] = unserialize($plansDetial->CareOpportunities);
                            $Locations=$CareOpportunities[$key];
                            $careProvidersArray[$key]->CareOpportunitiesData = $Locations;
                        else:
                            $careProvidersArray[$key]->CareOpportunitiesData ='';
                        endif;
                        $careProvidersArray[$key]->providersInfo = User::where('id',$plansDetial->userID)->first();
                        $checkBothfriends = MemberFriends::where('requestSendTo',$plansDetial->userID)
                                                    ->where('senderUserID',Auth::user()->id)
                                                    ->count();
                        if($checkBothfriends>0):
                            $BothfriendsDetail = MemberFriends::where('requestSendTo',$plansDetial->userID)
                            ->where('senderUserID',Auth::user()->id)
                            ->first();
                            $careProvidersArray[$key]->Alreadyfriends = $BothfriendsDetail;
                        else:
                            $checkBothfriends2 = MemberFriends::where('senderUserID',$plansDetial->userID)
                                                        ->where('requestSendTo',Auth::user()->id)
                                                        ->count();
                            if($checkBothfriends2>0):
                                $BothfriendsDetail = MemberFriends::where('senderUserID',$plansDetial->userID)
                                ->where('requestSendTo',Auth::user()->id)
                                ->first();
                                $careProvidersArray[$key]->Alreadyfriends = $BothfriendsDetail;
                            else:
                                $careProvidersArray[$key]->Alreadyfriends = '';
                            endif;
                        endif;
                    endforeach;
                        return response()->json([
                        'getProviders' => 'Providers',
                        'providers' => $careProviders,
                        'careProvidersTotal' =>$careProvidersTotal
                    ]);
                else:
                    $totalMember = count($GetMembers);
                    return response()->json([
                        'error' => 'Not found!',
                        'BeforeMemberCheckCount' => $totalMember
                    ]);
                endif;
            elseif($inputs['SelectMemberType']=='agency_member'):
                $GetMembers = User::where('role','!=','admin')
                            ->whereNotNull('memberType')
                            ->where('memberType', 'agency_member')
                            ->orderBy('id','DESC')
                            ->pluck('id')
                            ->toArray();

                if(count($GetMembers)>0):
                    $careProviders = UserBio::where('userID','!=',Auth::user()->id)
                            ->whereIn('userID', $GetMembers)
                            ->whereNotNull('TypeOfCareLooking')
                            ->orderBy('id','DESC')
                            ->paginate(20);
                    $careProvidersTotal = count($careProviders);
                    $careProvidersArray = array();
                    foreach($careProviders as $key => $plansDetial):
                        $careProvidersArray[$key] = $plansDetial;
                        if(!empty(unserialize($plansDetial->TypeOfCareLooking))):
                            $TypeOfCareLooking[$key] = unserialize($plansDetial->TypeOfCareLooking);
                            $careLooking=$TypeOfCareLooking[$key];
                            $careProvidersArray[$key]->TypeOfCareLookingData = $careLooking;
                        else:
                            $careProvidersArray[$key]->TypeOfCareLookingData ='';
                        endif;
                        if(!empty(unserialize($plansDetial->CareOpportunities))):
                            $CareOpportunities[$key] = unserialize($plansDetial->CareOpportunities);
                            $Locations=$CareOpportunities[$key];
                            $careProvidersArray[$key]->CareOpportunitiesData = $Locations;
                        else:
                            $careProvidersArray[$key]->CareOpportunitiesData ='';
                        endif;
                        $careProvidersArray[$key]->providersInfo = User::where('id',$plansDetial->userID)->first();
                        $checkBothfriends = MemberFriends::where('requestSendTo',$plansDetial->userID)
                                                    ->where('senderUserID',Auth::user()->id)
                                                    ->count();
                        if($checkBothfriends>0):
                            $BothfriendsDetail = MemberFriends::where('requestSendTo',$plansDetial->userID)
                            ->where('senderUserID',Auth::user()->id)
                            ->first();
                            $careProvidersArray[$key]->Alreadyfriends = $BothfriendsDetail;
                        else:
                            $checkBothfriends2 = MemberFriends::where('senderUserID',$plansDetial->userID)
                                                        ->where('requestSendTo',Auth::user()->id)
                                                        ->count();
                            if($checkBothfriends2>0):
                                $BothfriendsDetail = MemberFriends::where('senderUserID',$plansDetial->userID)
                                ->where('requestSendTo',Auth::user()->id)
                                ->first();
                                $careProvidersArray[$key]->Alreadyfriends = $BothfriendsDetail;
                            else:
                                $careProvidersArray[$key]->Alreadyfriends = '';
                            endif;
                        endif;
                    endforeach;
                        return response()->json([
                        'getProviders' => 'Providers',
                        'providers' => $careProviders,
                        'careProvidersTotal' =>$careProvidersTotal
                    ]);
                else:
                    $totalMember = count($GetMembers);
                    return response()->json([
                        'error' => 'Not found!',
                        'BeforeMemberCheckCount' => $totalMember
                    ]);
                endif;
            else:
                return response()->json(['error' => 'Not found!']);
            endif;
        elseif(!empty($inputs['SelectMemberType']) && !empty($inputs['keywordSearch']) && empty($inputs['SelectTypeCare']) && empty($inputs['SelectLocation'])):
            if($inputs['SelectMemberType']=='care_provider_member'):
                $GetMembers = User::where('role','!=','admin')
                            ->whereNotNull('memberType')
                            ->where('memberType', 'care_provider_member')
                            ->where('name','LIKE','%'.$inputs['keywordSearch'].'%')
                            ->orderBy('id','DESC')
                            ->pluck('id')
                            ->toArray();

                if(count($GetMembers)>0):
                    $careProviders = UserBio::whereIn('userID', $GetMembers)
                        ->orderBy('id','DESC')
                        ->paginate(20);
                    $careProvidersTotal = count($careProviders);
                    $careProvidersArray = array();
                    foreach($careProviders as $key => $plansDetial):
                        $careProvidersArray[$key] = $plansDetial;
                        if(!empty(unserialize($plansDetial->TypeOfCareLooking))):
                            $TypeOfCareLooking[$key] = unserialize($plansDetial->TypeOfCareLooking);
                            $careLooking=$TypeOfCareLooking[$key];
                            $careProvidersArray[$key]->TypeOfCareLookingData = $careLooking;
                        else:
                            $careProvidersArray[$key]->TypeOfCareLookingData ='';
                        endif;
                        if(!empty(unserialize($plansDetial->CareOpportunities))):
                            $CareOpportunities[$key] = unserialize($plansDetial->CareOpportunities);
                            $Locations=$CareOpportunities[$key];
                            $careProvidersArray[$key]->CareOpportunitiesData = $Locations;
                        else:
                            $careProvidersArray[$key]->CareOpportunitiesData ='';
                        endif;
                        if(!empty(unserialize($plansDetial->providerChildExperience))):
                            $WillCareForData[$key] = unserialize($plansDetial->providerChildExperience);
                            $WillCareForData=$WillCareForData[$key];
                            $careProvidersArray[$key]->WillCareForData = $WillCareForData;
                        else:
                            $careProvidersArray[$key]->WillCareForData ='';
                        endif;
                        $careProvidersArray[$key]->providersInfo = User::where('id',$plansDetial->userID)->first();
                        $checkBothfriends = MemberFriends::where('requestSendTo',$plansDetial->userID)
                                                    ->where('senderUserID',Auth::user()->id)
                                                    ->count();
                        if($checkBothfriends>0):
                            $BothfriendsDetail = MemberFriends::where('requestSendTo',$plansDetial->userID)
                            ->where('senderUserID',Auth::user()->id)
                            ->first();
                            $careProvidersArray[$key]->Alreadyfriends = $BothfriendsDetail;
                        else:
                            $checkBothfriends2 = MemberFriends::where('senderUserID',$plansDetial->userID)
                                                        ->where('requestSendTo',Auth::user()->id)
                                                        ->count();
                            if($checkBothfriends2>0):
                                $BothfriendsDetail = MemberFriends::where('senderUserID',$plansDetial->userID)
                                ->where('requestSendTo',Auth::user()->id)
                                ->first();
                                $careProvidersArray[$key]->Alreadyfriends = $BothfriendsDetail;
                            else:
                                $careProvidersArray[$key]->Alreadyfriends = '';
                            endif;
                        endif;
                    endforeach;
                        return response()->json([
                        'getProviders' => 'Providers',
                        'providers' => $careProviders,
                        'careProvidersTotal' =>$careProvidersTotal
                    ]);
                else:
                    $totalMember = count($GetMembers);
                    return response()->json([
                        'error' => 'Not found!',
                        'BeforeMemberCheckCount' => $totalMember
                    ]);
                endif;
            elseif($inputs['SelectMemberType']=='family_parent_member'):
                $GetMembers = User::where('role','!=','admin')
                            ->whereNotNull('memberType')
                            ->where('memberType', 'family_parent_member')
                            ->where('name','LIKE','%'.$inputs['keywordSearch'].'%')
                            ->orderBy('id','DESC')
                            ->pluck('id')
                            ->toArray();

                if(count($GetMembers)>0):
                    $careProviders = UserBio::whereIn('userID', $GetMembers)
                        ->orderBy('id','DESC')
                        ->paginate(20);
                    $careProvidersTotal = count($careProviders);
                    $careProvidersArray = array();
                    foreach($careProviders as $key => $plansDetial):
                        $careProvidersArray[$key] = $plansDetial;
                        if(!empty(unserialize($plansDetial->TypeOfCareLooking))):
                            $TypeOfCareLooking[$key] = unserialize($plansDetial->TypeOfCareLooking);
                            $careLooking=$TypeOfCareLooking[$key];
                            $careProvidersArray[$key]->TypeOfCareLookingData = $careLooking;
                        else:
                            $careProvidersArray[$key]->TypeOfCareLookingData ='';
                        endif;
                        if(!empty(unserialize($plansDetial->CareOpportunities))):
                            $CareOpportunities[$key] = unserialize($plansDetial->CareOpportunities);
                            $Locations=$CareOpportunities[$key];
                            $careProvidersArray[$key]->CareOpportunitiesData = $Locations;
                        else:
                            $careProvidersArray[$key]->CareOpportunitiesData ='';
                        endif;
                        $careProvidersArray[$key]->providersInfo = User::where('id',$plansDetial->userID)->first();
                        $checkBothfriends = MemberFriends::where('requestSendTo',$plansDetial->userID)
                                                    ->where('senderUserID',Auth::user()->id)
                                                    ->count();
                        if($checkBothfriends>0):
                            $BothfriendsDetail = MemberFriends::where('requestSendTo',$plansDetial->userID)
                            ->where('senderUserID',Auth::user()->id)
                            ->first();
                            $careProvidersArray[$key]->Alreadyfriends = $BothfriendsDetail;
                        else:
                            $checkBothfriends2 = MemberFriends::where('senderUserID',$plansDetial->userID)
                                                        ->where('requestSendTo',Auth::user()->id)
                                                        ->count();
                            if($checkBothfriends2>0):
                                $BothfriendsDetail = MemberFriends::where('senderUserID',$plansDetial->userID)
                                ->where('requestSendTo',Auth::user()->id)
                                ->first();
                                $careProvidersArray[$key]->Alreadyfriends = $BothfriendsDetail;
                            else:
                                $careProvidersArray[$key]->Alreadyfriends = '';
                            endif;
                        endif;
                    endforeach;
                        return response()->json([
                        'getProviders' => 'Providers',
                        'providers' => $careProviders,
                        'careProvidersTotal' =>$careProvidersTotal
                    ]);
                else:
                    $totalMember = count($GetMembers);
                    return response()->json([
                        'error' => 'Not found!',
                        'BeforeMemberCheckCount' => $totalMember
                    ]);
                endif;
            elseif($inputs['SelectMemberType']=='agency_member'):
                $GetMembers = User::where('role','!=','admin')
                            ->whereNotNull('memberType')
                            ->where('memberType', 'agency_member')
                            ->where('name','LIKE','%'.$inputs['keywordSearch'].'%')
                            ->orderBy('id','DESC')
                            ->pluck('id')
                            ->toArray();

                if(count($GetMembers)>0):
                    $careProviders = UserBio::whereIn('userID', $GetMembers)
                        ->orderBy('id','DESC')
                        ->paginate(20);
                    $careProvidersTotal = count($careProviders);
                    $careProvidersArray = array();
                    foreach($careProviders as $key => $plansDetial):
                        $careProvidersArray[$key] = $plansDetial;
                        if(!empty(unserialize($plansDetial->TypeOfCareLooking))):
                            $TypeOfCareLooking[$key] = unserialize($plansDetial->TypeOfCareLooking);
                            $careLooking=$TypeOfCareLooking[$key];
                            $careProvidersArray[$key]->TypeOfCareLookingData = $careLooking;
                        else:
                            $careProvidersArray[$key]->TypeOfCareLookingData ='';
                        endif;
                        if(!empty(unserialize($plansDetial->CareOpportunities))):
                            $CareOpportunities[$key] = unserialize($plansDetial->CareOpportunities);
                            $Locations=$CareOpportunities[$key];
                            $careProvidersArray[$key]->CareOpportunitiesData = $Locations;
                        else:
                            $careProvidersArray[$key]->CareOpportunitiesData ='';
                        endif;
                        $careProvidersArray[$key]->providersInfo = User::where('id',$plansDetial->userID)->first();
                        $checkBothfriends = MemberFriends::where('requestSendTo',$plansDetial->userID)
                                                    ->where('senderUserID',Auth::user()->id)
                                                    ->count();
                        if($checkBothfriends>0):
                            $BothfriendsDetail = MemberFriends::where('requestSendTo',$plansDetial->userID)
                            ->where('senderUserID',Auth::user()->id)
                            ->first();
                            $careProvidersArray[$key]->Alreadyfriends = $BothfriendsDetail;
                        else:
                            $checkBothfriends2 = MemberFriends::where('senderUserID',$plansDetial->userID)
                                                        ->where('requestSendTo',Auth::user()->id)
                                                        ->count();
                            if($checkBothfriends2>0):
                                $BothfriendsDetail = MemberFriends::where('senderUserID',$plansDetial->userID)
                                ->where('requestSendTo',Auth::user()->id)
                                ->first();
                                $careProvidersArray[$key]->Alreadyfriends = $BothfriendsDetail;
                            else:
                                $careProvidersArray[$key]->Alreadyfriends = '';
                            endif;
                        endif;
                    endforeach;
                        return response()->json([
                        'getProviders' => 'Providers',
                        'providers' => $careProviders,
                        'careProvidersTotal' =>$careProvidersTotal
                    ]);
                else:
                    $totalMember = count($GetMembers);
                    return response()->json([
                        'error' => 'Not found!',
                        'BeforeMemberCheckCount' => $totalMember
                    ]);
                endif;
            endif;
        elseif(!empty($inputs['SelectMemberType']) && empty($inputs['keywordSearch']) && !empty($inputs['SelectTypeCare']) && empty($inputs['SelectLocation'])):
            if($inputs['SelectMemberType']=='care_provider_member'):
                $SelectTypeCare = $inputs['SelectTypeCare'];
                $careProviders = UserBio::where('userType', 'care_provider_member')
                            ->Where(function ($query) use($SelectTypeCare) {
                                for ($i = 0; $i < count($SelectTypeCare); $i++){
                                $query->orwhere('TypeOfCareLooking', 'like',  '%' . $SelectTypeCare[$i] .'%');
                                }
                            })
                            ->orderBy('id','DESC')
                            ->paginate(20);
                $careProvidersTotal = count($careProviders);
                if($careProvidersTotal>0):
                    $careProvidersArray = array();
                    foreach($careProviders as $key => $plansDetial):
                        $careProvidersArray[$key] = $plansDetial;
                        if(!empty(unserialize($plansDetial->TypeOfCareLooking))):
                            $TypeOfCareLooking[$key] = unserialize($plansDetial->TypeOfCareLooking);
                            $careLooking=$TypeOfCareLooking[$key];
                            $careProvidersArray[$key]->TypeOfCareLookingData = $careLooking;
                        else:
                            $careProvidersArray[$key]->TypeOfCareLookingData ='';
                        endif;
                        if(!empty(unserialize($plansDetial->CareOpportunities))):
                            $CareOpportunities[$key] = unserialize($plansDetial->CareOpportunities);
                            $Locations=$CareOpportunities[$key];
                            $careProvidersArray[$key]->CareOpportunitiesData = $Locations;
                        else:
                            $careProvidersArray[$key]->CareOpportunitiesData ='';
                        endif;
                        if(!empty(unserialize($plansDetial->providerChildExperience))):
                            $WillCareForData[$key] = unserialize($plansDetial->providerChildExperience);
                            $WillCareForData=$WillCareForData[$key];
                            $careProvidersArray[$key]->WillCareForData = $WillCareForData;
                        else:
                            $careProvidersArray[$key]->WillCareForData ='';
                        endif;
                        $careProvidersArray[$key]->providersInfo = User::where('id',$plansDetial->userID)->first();
                        $checkBothfriends = MemberFriends::where('requestSendTo',$plansDetial->userID)
                                                    ->where('senderUserID',Auth::user()->id)
                                                    ->count();
                        if($checkBothfriends>0):
                            $BothfriendsDetail = MemberFriends::where('requestSendTo',$plansDetial->userID)
                            ->where('senderUserID',Auth::user()->id)
                            ->first();
                            $careProvidersArray[$key]->Alreadyfriends = $BothfriendsDetail;
                        else:
                            $checkBothfriends2 = MemberFriends::where('senderUserID',$plansDetial->userID)
                                                        ->where('requestSendTo',Auth::user()->id)
                                                        ->count();
                            if($checkBothfriends2>0):
                                $BothfriendsDetail = MemberFriends::where('senderUserID',$plansDetial->userID)
                                ->where('requestSendTo',Auth::user()->id)
                                ->first();
                                $careProvidersArray[$key]->Alreadyfriends = $BothfriendsDetail;
                            else:
                                $careProvidersArray[$key]->Alreadyfriends = '';
                            endif;
                        endif;
                    endforeach;
                        return response()->json([
                        'getProviders' => 'Providers',
                        'providers' => $careProviders,
                        'careProvidersTotal' =>$careProvidersTotal
                    ]);
                else:
                    return response()->json(['error' => 'Not found!']);
                endif;
            elseif($inputs['SelectMemberType']=='family_parent_member'):
                $SelectTypeCare = $inputs['SelectTypeCare'];
                $careProviders = UserBio::where('userType', 'family_parent_member')
                            ->Where(function ($query) use($SelectTypeCare) {
                                for ($i = 0; $i < count($SelectTypeCare); $i++){
                                $query->orwhere('TypeOfCareLooking', 'like',  '%' . $SelectTypeCare[$i] .'%');
                                }
                        })
                        ->orderBy('id','DESC')
                        ->paginate(20);
                $careProvidersTotal = count($careProviders);
                if($careProvidersTotal>0):
                    $careProvidersArray = array();
                    foreach($careProviders as $key => $plansDetial):
                        $careProvidersArray[$key] = $plansDetial;
                        if(!empty(unserialize($plansDetial->TypeOfCareLooking))):
                            $TypeOfCareLooking[$key] = unserialize($plansDetial->TypeOfCareLooking);
                            $careLooking=$TypeOfCareLooking[$key];
                            $careProvidersArray[$key]->TypeOfCareLookingData = $careLooking;
                        else:
                            $careProvidersArray[$key]->TypeOfCareLookingData ='';
                        endif;
                        if(!empty(unserialize($plansDetial->CareOpportunities))):
                            $CareOpportunities[$key] = unserialize($plansDetial->CareOpportunities);
                            $Locations=$CareOpportunities[$key];
                            $careProvidersArray[$key]->CareOpportunitiesData = $Locations;
                        else:
                            $careProvidersArray[$key]->CareOpportunitiesData ='';
                        endif;
                        $careProvidersArray[$key]->providersInfo = User::where('id',$plansDetial->userID)->first();
                        $checkBothfriends = MemberFriends::where('requestSendTo',$plansDetial->userID)
                                                    ->where('senderUserID',Auth::user()->id)
                                                    ->count();
                        if($checkBothfriends>0):
                            $BothfriendsDetail = MemberFriends::where('requestSendTo',$plansDetial->userID)
                            ->where('senderUserID',Auth::user()->id)
                            ->first();
                            $careProvidersArray[$key]->Alreadyfriends = $BothfriendsDetail;
                        else:
                            $checkBothfriends2 = MemberFriends::where('senderUserID',$plansDetial->userID)
                                                        ->where('requestSendTo',Auth::user()->id)
                                                        ->count();
                            if($checkBothfriends2>0):
                                $BothfriendsDetail = MemberFriends::where('senderUserID',$plansDetial->userID)
                                ->where('requestSendTo',Auth::user()->id)
                                ->first();
                                $careProvidersArray[$key]->Alreadyfriends = $BothfriendsDetail;
                            else:
                                $careProvidersArray[$key]->Alreadyfriends = '';
                            endif;
                        endif;
                    endforeach;
                        return response()->json([
                        'getProviders' => 'Providers',
                        'providers' => $careProviders,
                        'careProvidersTotal' =>$careProvidersTotal
                    ]);
                else:
                    return response()->json(['error' => 'Not found!']);
                endif;
            elseif($inputs['SelectMemberType']=='agency_member'):
                $SelectTypeCare = $inputs['SelectTypeCare'];
                $careProviders = UserBio::where('userType', 'agency_member')
                            ->Where(function ($query) use($SelectTypeCare) {
                                for ($i = 0; $i < count($SelectTypeCare); $i++){
                                $query->orwhere('TypeOfCareLooking', 'like',  '%' . $SelectTypeCare[$i] .'%');
                                }
                            })
                            ->orderBy('id','DESC')
                            ->paginate(20);
                $careProvidersTotal = count($careProviders);
                if($careProvidersTotal>0):
                    $careProvidersArray = array();
                    foreach($careProviders as $key => $plansDetial):
                        $careProvidersArray[$key] = $plansDetial;
                        if(!empty(unserialize($plansDetial->TypeOfCareLooking))):
                            $TypeOfCareLooking[$key] = unserialize($plansDetial->TypeOfCareLooking);
                            $careLooking=$TypeOfCareLooking[$key];
                            $careProvidersArray[$key]->TypeOfCareLookingData = $careLooking;
                        else:
                            $careProvidersArray[$key]->TypeOfCareLookingData ='';
                        endif;
                        if(!empty(unserialize($plansDetial->CareOpportunities))):
                            $CareOpportunities[$key] = unserialize($plansDetial->CareOpportunities);
                            $Locations=$CareOpportunities[$key];
                            $careProvidersArray[$key]->CareOpportunitiesData = $Locations;
                        else:
                            $careProvidersArray[$key]->CareOpportunitiesData ='';
                        endif;
                        $careProvidersArray[$key]->providersInfo = User::where('id',$plansDetial->userID)->first();
                        $checkBothfriends = MemberFriends::where('requestSendTo',$plansDetial->userID)
                                                    ->where('senderUserID',Auth::user()->id)
                                                    ->count();
                        if($checkBothfriends>0):
                            $BothfriendsDetail = MemberFriends::where('requestSendTo',$plansDetial->userID)
                            ->where('senderUserID',Auth::user()->id)
                            ->first();
                            $careProvidersArray[$key]->Alreadyfriends = $BothfriendsDetail;
                        else:
                            $checkBothfriends2 = MemberFriends::where('senderUserID',$plansDetial->userID)
                                                        ->where('requestSendTo',Auth::user()->id)
                                                        ->count();
                            if($checkBothfriends2>0):
                                $BothfriendsDetail = MemberFriends::where('senderUserID',$plansDetial->userID)
                                ->where('requestSendTo',Auth::user()->id)
                                ->first();
                                $careProvidersArray[$key]->Alreadyfriends = $BothfriendsDetail;
                            else:
                                $careProvidersArray[$key]->Alreadyfriends = '';
                            endif;
                        endif;
                    endforeach;
                        return response()->json([
                        'getProviders' => 'Providers',
                        'providers' => $careProviders,
                        'careProvidersTotal' =>$careProvidersTotal
                    ]);
                else:
                    return response()->json(['error' => 'Not found!']);
                endif;
            endif;

        elseif(!empty($inputs['SelectMemberType']) && !empty($inputs['keywordSearch']) && !empty($inputs['SelectTypeCare']) && empty($inputs['SelectLocation'])):
            if($inputs['SelectMemberType']=='care_provider_member'):
                $SelectTypeCare = $inputs['SelectTypeCare'];
                $GetMembers = User::where('role','!=','admin')
                            ->whereNotNull('memberType')
                            ->where('memberType', 'care_provider_member')
                            ->where('name','LIKE','%'.$inputs['keywordSearch'].'%')
                            ->orderBy('id','DESC')
                            ->pluck('id')
                            ->toArray();

                if(count($GetMembers)>0):
                    $careProviders = UserBio::Where(function ($query) use($SelectTypeCare) {
                            for ($i = 0; $i < count($SelectTypeCare); $i++){
                            $query->orwhere('TypeOfCareLooking', 'like',  '%' . $SelectTypeCare[$i] .'%');
                            }
                        })
                        ->where('userID','!=',Auth::user()->id)
                        ->whereIn('userID', $GetMembers)
                        ->orderBy('id','DESC')
                        ->paginate(20);
                    $careProvidersTotal = count($careProviders);
                    $careProvidersArray = array();
                    foreach($careProviders as $key => $plansDetial):
                        $careProvidersArray[$key] = $plansDetial;
                        if(!empty(unserialize($plansDetial->TypeOfCareLooking))):
                            $TypeOfCareLooking[$key] = unserialize($plansDetial->TypeOfCareLooking);
                            $careLooking=$TypeOfCareLooking[$key];
                            $careProvidersArray[$key]->TypeOfCareLookingData = $careLooking;
                        else:
                            $careProvidersArray[$key]->TypeOfCareLookingData ='';
                        endif;
                        if(!empty(unserialize($plansDetial->CareOpportunities))):
                            $CareOpportunities[$key] = unserialize($plansDetial->CareOpportunities);
                            $Locations=$CareOpportunities[$key];
                            $careProvidersArray[$key]->CareOpportunitiesData = $Locations;
                        else:
                            $careProvidersArray[$key]->CareOpportunitiesData ='';
                        endif;
                        if(!empty(unserialize($plansDetial->providerChildExperience))):
                            $WillCareForData[$key] = unserialize($plansDetial->providerChildExperience);
                            $WillCareForData=$WillCareForData[$key];
                            $careProvidersArray[$key]->WillCareForData = $WillCareForData;
                        else:
                            $careProvidersArray[$key]->WillCareForData ='';
                        endif;
                        $careProvidersArray[$key]->providersInfo = User::where('id',$plansDetial->userID)->first();
                        $checkBothfriends = MemberFriends::where('requestSendTo',$plansDetial->userID)
                                                    ->where('senderUserID',Auth::user()->id)
                                                    ->count();
                        if($checkBothfriends>0):
                            $BothfriendsDetail = MemberFriends::where('requestSendTo',$plansDetial->userID)
                            ->where('senderUserID',Auth::user()->id)
                            ->first();
                            $careProvidersArray[$key]->Alreadyfriends = $BothfriendsDetail;
                        else:
                            $checkBothfriends2 = MemberFriends::where('senderUserID',$plansDetial->userID)
                                                        ->where('requestSendTo',Auth::user()->id)
                                                        ->count();
                            if($checkBothfriends2>0):
                                $BothfriendsDetail = MemberFriends::where('senderUserID',$plansDetial->userID)
                                ->where('requestSendTo',Auth::user()->id)
                                ->first();
                                $careProvidersArray[$key]->Alreadyfriends = $BothfriendsDetail;
                            else:
                                $careProvidersArray[$key]->Alreadyfriends = '';
                            endif;
                        endif;
                    endforeach;
                        return response()->json([
                        'getProviders' => 'Providers',
                        'providers' => $careProviders,
                        'careProvidersTotal' =>$careProvidersTotal
                    ]);
                else:
                    return response()->json(['error' => 'Not found!']);
                endif;

            elseif($inputs['SelectMemberType']=='family_parent_member'):
                $SelectTypeCare = $inputs['SelectTypeCare'];
                $GetMembers = User::where('role','!=','admin')
                            ->whereNotNull('memberType')
                            ->where('memberType', 'family_parent_member')
                            ->where('name','LIKE','%'.$inputs['keywordSearch'].'%')
                            ->orderBy('id','DESC')
                            ->pluck('id')
                            ->toArray();

                if(count($GetMembers)>0):
                    $careProviders = UserBio::Where(function ($query) use($SelectTypeCare) {
                            for ($i = 0; $i < count($SelectTypeCare); $i++){
                            $query->orwhere('TypeOfCareLooking', 'like',  '%' . $SelectTypeCare[$i] .'%');
                            }
                        })
                        ->whereIn('userID', $GetMembers)
                        ->orderBy('id','DESC')
                        ->paginate(20);
                    $careProvidersTotal = count($careProviders);
                    $careProvidersArray = array();
                    foreach($careProviders as $key => $plansDetial):
                        $careProvidersArray[$key] = $plansDetial;
                        if(!empty(unserialize($plansDetial->TypeOfCareLooking))):
                            $TypeOfCareLooking[$key] = unserialize($plansDetial->TypeOfCareLooking);
                            $careLooking=$TypeOfCareLooking[$key];
                            $careProvidersArray[$key]->TypeOfCareLookingData = $careLooking;
                        else:
                            $careProvidersArray[$key]->TypeOfCareLookingData ='';
                        endif;
                        if(!empty(unserialize($plansDetial->CareOpportunities))):
                            $CareOpportunities[$key] = unserialize($plansDetial->CareOpportunities);
                            $Locations=$CareOpportunities[$key];
                            $careProvidersArray[$key]->CareOpportunitiesData = $Locations;
                        else:
                            $careProvidersArray[$key]->CareOpportunitiesData ='';
                        endif;
                        $careProvidersArray[$key]->providersInfo = User::where('id',$plansDetial->userID)->first();
                        $checkBothfriends = MemberFriends::where('requestSendTo',$plansDetial->userID)
                                                    ->where('senderUserID',Auth::user()->id)
                                                    ->count();
                        if($checkBothfriends>0):
                            $BothfriendsDetail = MemberFriends::where('requestSendTo',$plansDetial->userID)
                            ->where('senderUserID',Auth::user()->id)
                            ->first();
                            $careProvidersArray[$key]->Alreadyfriends = $BothfriendsDetail;
                        else:
                            $checkBothfriends2 = MemberFriends::where('senderUserID',$plansDetial->userID)
                                                        ->where('requestSendTo',Auth::user()->id)
                                                        ->count();
                            if($checkBothfriends2>0):
                                $BothfriendsDetail = MemberFriends::where('senderUserID',$plansDetial->userID)
                                ->where('requestSendTo',Auth::user()->id)
                                ->first();
                                $careProvidersArray[$key]->Alreadyfriends = $BothfriendsDetail;
                            else:
                                $careProvidersArray[$key]->Alreadyfriends = '';
                            endif;
                        endif;
                    endforeach;
                        return response()->json([
                        'getProviders' => 'Providers',
                        'providers' => $careProviders,
                        'careProvidersTotal' =>$careProvidersTotal
                    ]);
                else:
                    return response()->json(['error' => 'Not found!']);
                endif;
            elseif($inputs['SelectMemberType']=='agency_member'):
                $SelectTypeCare = $inputs['SelectTypeCare'];
                $GetMembers = User::where('role','!=','admin')
                            ->whereNotNull('memberType')
                            ->where('memberType', 'agency_member')
                            ->where('name','LIKE','%'.$inputs['keywordSearch'].'%')
                            ->orderBy('id','DESC')
                            ->pluck('id')
                            ->toArray();

                if(count($GetMembers)>0):
                    $careProviders = UserBio::Where(function ($query) use($SelectTypeCare) {
                            for ($i = 0; $i < count($SelectTypeCare); $i++){
                            $query->orwhere('TypeOfCareLooking', 'like',  '%' . $SelectTypeCare[$i] .'%');
                            }
                        })
                        ->where('userID','!=',Auth::user()->id)
                        ->whereIn('userID', $GetMembers)
                        ->orderBy('id','DESC')
                        ->paginate(20);
                    $careProvidersTotal = count($careProviders);
                    $careProvidersArray = array();
                    foreach($careProviders as $key => $plansDetial):
                        $careProvidersArray[$key] = $plansDetial;
                        if(!empty(unserialize($plansDetial->TypeOfCareLooking))):
                            $TypeOfCareLooking[$key] = unserialize($plansDetial->TypeOfCareLooking);
                            $careLooking=$TypeOfCareLooking[$key];
                            $careProvidersArray[$key]->TypeOfCareLookingData = $careLooking;
                        else:
                            $careProvidersArray[$key]->TypeOfCareLookingData ='';
                        endif;
                        if(!empty(unserialize($plansDetial->CareOpportunities))):
                            $CareOpportunities[$key] = unserialize($plansDetial->CareOpportunities);
                            $Locations=$CareOpportunities[$key];
                            $careProvidersArray[$key]->CareOpportunitiesData = $Locations;
                        else:
                            $careProvidersArray[$key]->CareOpportunitiesData ='';
                        endif;
                        $careProvidersArray[$key]->providersInfo = User::where('id',$plansDetial->userID)->first();
                        $checkBothfriends = MemberFriends::where('requestSendTo',$plansDetial->userID)
                                                    ->where('senderUserID',Auth::user()->id)
                                                    ->count();
                        if($checkBothfriends>0):
                            $BothfriendsDetail = MemberFriends::where('requestSendTo',$plansDetial->userID)
                            ->where('senderUserID',Auth::user()->id)
                            ->first();
                            $careProvidersArray[$key]->Alreadyfriends = $BothfriendsDetail;
                        else:
                            $checkBothfriends2 = MemberFriends::where('senderUserID',$plansDetial->userID)
                                                        ->where('requestSendTo',Auth::user()->id)
                                                        ->count();
                            if($checkBothfriends2>0):
                                $BothfriendsDetail = MemberFriends::where('senderUserID',$plansDetial->userID)
                                ->where('requestSendTo',Auth::user()->id)
                                ->first();
                                $careProvidersArray[$key]->Alreadyfriends = $BothfriendsDetail;
                            else:
                                $careProvidersArray[$key]->Alreadyfriends = '';
                            endif;
                        endif;
                    endforeach;
                        return response()->json([
                        'getProviders' => 'Providers',
                        'providers' => $careProviders,
                        'careProvidersTotal' =>$careProvidersTotal
                    ]);
                else:
                    return response()->json(['error' => 'Not found!']);
                endif;
            endif;
        elseif(!empty($inputs['SelectMemberType']) && !empty($inputs['keywordSearch']) && !empty($inputs['SelectTypeCare']) && !empty($inputs['SelectLocation'])):
            if($inputs['SelectMemberType']=='care_provider_member'):
                $SelectTypeCare = $inputs['SelectTypeCare'];
                $SelectLocation = $inputs['SelectLocation'];
                $GetMembers = User::where('role','!=','admin')
                            ->whereNotNull('memberType')
                            ->where('memberType', 'care_provider_member')
                            ->where('name','LIKE','%'.$inputs['keywordSearch'].'%')
                            ->orderBy('id','DESC')
                            ->pluck('id')
                            ->toArray();

                if(count($GetMembers)>0):
                    $careProviders = UserBio::Where(function ($query) use($SelectTypeCare) {
                                for ($i = 0; $i < count($SelectTypeCare); $i++){
                                $query->orwhere('TypeOfCareLooking', 'like',  '%' . $SelectTypeCare[$i] .'%');
                                }
                            })
                            ->Where(function ($query) use($SelectLocation) {
                            for ($i = 0; $i < count($SelectLocation); $i++){
                            $query->orwhere('CareOpportunities', 'like',  '%' . $SelectLocation[$i] .'%');
                            }
                        })
                        ->whereIn('userID', $GetMembers)
                        ->orderBy('id','DESC')
                        ->paginate(20);
                    $careProvidersTotal = count($careProviders);
                    $careProvidersArray = array();
                    foreach($careProviders as $key => $plansDetial):
                        $careProvidersArray[$key] = $plansDetial;
                        if(!empty(unserialize($plansDetial->TypeOfCareLooking))):
                            $TypeOfCareLooking[$key] = unserialize($plansDetial->TypeOfCareLooking);
                            $careLooking=$TypeOfCareLooking[$key];
                            $careProvidersArray[$key]->TypeOfCareLookingData = $careLooking;
                        else:
                            $careProvidersArray[$key]->TypeOfCareLookingData ='';
                        endif;
                        if(!empty(unserialize($plansDetial->CareOpportunities))):
                            $CareOpportunities[$key] = unserialize($plansDetial->CareOpportunities);
                            $Locations=$CareOpportunities[$key];
                            $careProvidersArray[$key]->CareOpportunitiesData = $Locations;
                        else:
                            $careProvidersArray[$key]->CareOpportunitiesData ='';
                        endif;
                        if(!empty(unserialize($plansDetial->providerChildExperience))):
                            $WillCareForData[$key] = unserialize($plansDetial->providerChildExperience);
                            $WillCareForData=$WillCareForData[$key];
                            $careProvidersArray[$key]->WillCareForData = $WillCareForData;
                        else:
                            $careProvidersArray[$key]->WillCareForData ='';
                        endif;
                        $careProvidersArray[$key]->providersInfo = User::where('id',$plansDetial->userID)->first();
                        $checkBothfriends = MemberFriends::where('requestSendTo',$plansDetial->userID)
                                                    ->where('senderUserID',Auth::user()->id)
                                                    ->count();
                        if($checkBothfriends>0):
                            $BothfriendsDetail = MemberFriends::where('requestSendTo',$plansDetial->userID)
                            ->where('senderUserID',Auth::user()->id)
                            ->first();
                            $careProvidersArray[$key]->Alreadyfriends = $BothfriendsDetail;
                        else:
                            $checkBothfriends2 = MemberFriends::where('senderUserID',$plansDetial->userID)
                                                        ->where('requestSendTo',Auth::user()->id)
                                                        ->count();
                            if($checkBothfriends2>0):
                                $BothfriendsDetail = MemberFriends::where('senderUserID',$plansDetial->userID)
                                ->where('requestSendTo',Auth::user()->id)
                                ->first();
                                $careProvidersArray[$key]->Alreadyfriends = $BothfriendsDetail;
                            else:
                                $careProvidersArray[$key]->Alreadyfriends = '';
                            endif;
                        endif;
                    endforeach;
                        return response()->json([
                        'getProviders' => 'Providers',
                        'providers' => $careProviders,
                        'careProvidersTotal' =>$careProvidersTotal
                    ]);
                else:
                    return response()->json(['error' => 'Not found!']);
                endif;

            elseif($inputs['SelectMemberType']=='family_parent_member'):
                $SelectTypeCare = $inputs['SelectTypeCare'];
                $SelectLocation = $inputs['SelectLocation'];
                $GetMembers = User::where('role','!=','admin')
                            ->whereNotNull('memberType')
                            ->where('memberType', 'family_parent_member')
                            ->where('name','LIKE','%'.$inputs['keywordSearch'].'%')
                            ->orderBy('id','DESC')
                            ->pluck('id')
                            ->toArray();

                if(count($GetMembers)>0):
                    $careProviders = UserBio::Where(function ($query) use($SelectTypeCare) {
                                for ($i = 0; $i < count($SelectTypeCare); $i++){
                                $query->orwhere('TypeOfCareLooking', 'like',  '%' . $SelectTypeCare[$i] .'%');
                                }
                            })
                            ->Where(function ($query) use($SelectLocation) {
                            for ($i = 0; $i < count($SelectLocation); $i++){
                            $query->orwhere('CareOpportunities', 'like',  '%' . $SelectLocation[$i] .'%');
                            }
                        })
                        ->whereIn('userID', $GetMembers)
                        ->orderBy('id','DESC')
                        ->paginate(20);
                    $careProvidersTotal = count($careProviders);
                    $careProvidersArray = array();
                    foreach($careProviders as $key => $plansDetial):
                        $careProvidersArray[$key] = $plansDetial;
                        if(!empty(unserialize($plansDetial->TypeOfCareLooking))):
                            $TypeOfCareLooking[$key] = unserialize($plansDetial->TypeOfCareLooking);
                            $careLooking=$TypeOfCareLooking[$key];
                            $careProvidersArray[$key]->TypeOfCareLookingData = $careLooking;
                        else:
                            $careProvidersArray[$key]->TypeOfCareLookingData ='';
                        endif;
                        if(!empty(unserialize($plansDetial->CareOpportunities))):
                            $CareOpportunities[$key] = unserialize($plansDetial->CareOpportunities);
                            $Locations=$CareOpportunities[$key];
                            $careProvidersArray[$key]->CareOpportunitiesData = $Locations;
                        else:
                            $careProvidersArray[$key]->CareOpportunitiesData ='';
                        endif;
                        $careProvidersArray[$key]->providersInfo = User::where('id',$plansDetial->userID)->first();
                        $checkBothfriends = MemberFriends::where('requestSendTo',$plansDetial->userID)
                                                    ->where('senderUserID',Auth::user()->id)
                                                    ->count();
                        if($checkBothfriends>0):
                            $BothfriendsDetail = MemberFriends::where('requestSendTo',$plansDetial->userID)
                            ->where('senderUserID',Auth::user()->id)
                            ->first();
                            $careProvidersArray[$key]->Alreadyfriends = $BothfriendsDetail;
                        else:
                            $checkBothfriends2 = MemberFriends::where('senderUserID',$plansDetial->userID)
                                                        ->where('requestSendTo',Auth::user()->id)
                                                        ->count();
                            if($checkBothfriends2>0):
                                $BothfriendsDetail = MemberFriends::where('senderUserID',$plansDetial->userID)
                                ->where('requestSendTo',Auth::user()->id)
                                ->first();
                                $careProvidersArray[$key]->Alreadyfriends = $BothfriendsDetail;
                            else:
                                $careProvidersArray[$key]->Alreadyfriends = '';
                            endif;
                        endif;
                    endforeach;
                        return response()->json([
                        'getProviders' => 'Providers',
                        'providers' => $careProviders,
                        'careProvidersTotal' =>$careProvidersTotal
                    ]);
                else:
                    return response()->json(['error' => 'Not found!']);
                endif;
            elseif($inputs['SelectMemberType']=='agency_member'):
                $SelectTypeCare = $inputs['SelectTypeCare'];
                $SelectLocation = $inputs['SelectLocation'];
                $GetMembers = User::where('role','!=','admin')
                            ->whereNotNull('memberType')
                            ->where('memberType', 'agency_member')
                            ->where('name','LIKE','%'.$inputs['keywordSearch'].'%')
                            ->orderBy('id','DESC')
                            ->pluck('id')
                            ->toArray();

                if(count($GetMembers)>0):
                    $careProviders = UserBio::Where(function ($query) use($SelectTypeCare) {
                            for ($i = 0; $i < count($SelectTypeCare); $i++){
                            $query->orwhere('TypeOfCareLooking', 'like',  '%' . $SelectTypeCare[$i] .'%');
                            }
                        })
                        ->Where(function ($query) use($SelectLocation) {
                            for ($i = 0; $i < count($SelectLocation); $i++){
                            $query->orwhere('CareOpportunities', 'like',  '%' . $SelectLocation[$i] .'%');
                            }
                        })
                        ->whereIn('userID', $GetMembers)
                        ->orderBy('id','DESC')
                        ->paginate(20);
                    $careProvidersTotal = count($careProviders);
                    $careProvidersArray = array();
                    foreach($careProviders as $key => $plansDetial):
                        $careProvidersArray[$key] = $plansDetial;
                        if(!empty(unserialize($plansDetial->TypeOfCareLooking))):
                            $TypeOfCareLooking[$key] = unserialize($plansDetial->TypeOfCareLooking);
                            $careLooking=$TypeOfCareLooking[$key];
                            $careProvidersArray[$key]->TypeOfCareLookingData = $careLooking;
                        else:
                            $careProvidersArray[$key]->TypeOfCareLookingData ='';
                        endif;
                        if(!empty(unserialize($plansDetial->CareOpportunities))):
                            $CareOpportunities[$key] = unserialize($plansDetial->CareOpportunities);
                            $Locations=$CareOpportunities[$key];
                            $careProvidersArray[$key]->CareOpportunitiesData = $Locations;
                        else:
                            $careProvidersArray[$key]->CareOpportunitiesData ='';
                        endif;
                        $careProvidersArray[$key]->providersInfo = User::where('id',$plansDetial->userID)->first();
                        $checkBothfriends = MemberFriends::where('requestSendTo',$plansDetial->userID)
                                                    ->where('senderUserID',Auth::user()->id)
                                                    ->count();
                        if($checkBothfriends>0):
                            $BothfriendsDetail = MemberFriends::where('requestSendTo',$plansDetial->userID)
                            ->where('senderUserID',Auth::user()->id)
                            ->first();
                            $careProvidersArray[$key]->Alreadyfriends = $BothfriendsDetail;
                        else:
                            $checkBothfriends2 = MemberFriends::where('senderUserID',$plansDetial->userID)
                                                        ->where('requestSendTo',Auth::user()->id)
                                                        ->count();
                            if($checkBothfriends2>0):
                                $BothfriendsDetail = MemberFriends::where('senderUserID',$plansDetial->userID)
                                ->where('requestSendTo',Auth::user()->id)
                                ->first();
                                $careProvidersArray[$key]->Alreadyfriends = $BothfriendsDetail;
                            else:
                                $careProvidersArray[$key]->Alreadyfriends = '';
                            endif;
                        endif;
                    endforeach;
                        return response()->json([
                        'getProviders' => 'Providers',
                        'providers' => $careProviders,
                        'careProvidersTotal' =>$careProvidersTotal
                    ]);
                else:
                    return response()->json(['error' => 'Not found!']);
                endif;
            endif;
        elseif(!empty($inputs['SelectMemberType']) && empty($inputs['keywordSearch']) && !empty($inputs['SelectTypeCare']) && !empty($inputs['SelectLocation'])):
            if($inputs['SelectMemberType']=='care_provider_member'):
                $SelectTypeCare = $inputs['SelectTypeCare'];
                $SelectLocation = $inputs['SelectLocation'];
                $careProviders = UserBio::where('userType', 'care_provider_member')
                            ->Where(function ($query) use($SelectTypeCare) {
                                for ($i = 0; $i < count($SelectTypeCare); $i++){
                                $query->orwhere('TypeOfCareLooking', 'like',  '%' . $SelectTypeCare[$i] .'%');
                                }
                            })
                            ->Where(function ($query) use($SelectLocation) {
                                for ($i = 0; $i < count($SelectLocation); $i++){
                                $query->orwhere('CareOpportunities', 'like',  '%' . $SelectLocation[$i] .'%');
                                }
                            })
                            ->orderBy('id','DESC')
                            ->paginate(20);
                $careProvidersTotal = count($careProviders);
                if($careProvidersTotal>0):
                    $careProvidersArray = array();
                    foreach($careProviders as $key => $plansDetial):
                        $careProvidersArray[$key] = $plansDetial;
                        if(!empty(unserialize($plansDetial->TypeOfCareLooking))):
                            $TypeOfCareLooking[$key] = unserialize($plansDetial->TypeOfCareLooking);
                            $careLooking=$TypeOfCareLooking[$key];
                            $careProvidersArray[$key]->TypeOfCareLookingData = $careLooking;
                        else:
                            $careProvidersArray[$key]->TypeOfCareLookingData ='';
                        endif;
                        if(!empty(unserialize($plansDetial->CareOpportunities))):
                            $CareOpportunities[$key] = unserialize($plansDetial->CareOpportunities);
                            $Locations=$CareOpportunities[$key];
                            $careProvidersArray[$key]->CareOpportunitiesData = $Locations;
                        else:
                            $careProvidersArray[$key]->CareOpportunitiesData ='';
                        endif;
                        if(!empty(unserialize($plansDetial->providerChildExperience))):
                            $WillCareForData[$key] = unserialize($plansDetial->providerChildExperience);
                            $WillCareForData=$WillCareForData[$key];
                            $careProvidersArray[$key]->WillCareForData = $WillCareForData;
                        else:
                            $careProvidersArray[$key]->WillCareForData ='';
                        endif;
                        $careProvidersArray[$key]->providersInfo = User::where('id',$plansDetial->userID)->first();
                        $checkBothfriends = MemberFriends::where('requestSendTo',$plansDetial->userID)
                                                    ->where('senderUserID',Auth::user()->id)
                                                    ->count();
                        if($checkBothfriends>0):
                            $BothfriendsDetail = MemberFriends::where('requestSendTo',$plansDetial->userID)
                            ->where('senderUserID',Auth::user()->id)
                            ->first();
                            $careProvidersArray[$key]->Alreadyfriends = $BothfriendsDetail;
                        else:
                            $checkBothfriends2 = MemberFriends::where('senderUserID',$plansDetial->userID)
                                                        ->where('requestSendTo',Auth::user()->id)
                                                        ->count();
                            if($checkBothfriends2>0):
                                $BothfriendsDetail = MemberFriends::where('senderUserID',$plansDetial->userID)
                                ->where('requestSendTo',Auth::user()->id)
                                ->first();
                                $careProvidersArray[$key]->Alreadyfriends = $BothfriendsDetail;
                            else:
                                $careProvidersArray[$key]->Alreadyfriends = '';
                            endif;
                        endif;
                    endforeach;
                        return response()->json([
                        'getProviders' => 'Providers',
                        'providers' => $careProviders,
                        'careProvidersTotal' =>$careProvidersTotal
                    ]);
                else:
                    return response()->json(['error' => 'Not found!']);
                endif;
            elseif($inputs['SelectMemberType']=='family_parent_member'):
                $SelectTypeCare = $inputs['SelectTypeCare'];
                $SelectLocation = $inputs['SelectLocation'];
                $careProviders = UserBio::where('userType', 'family_parent_member')
                            ->Where(function ($query) use($SelectTypeCare) {
                                for ($i = 0; $i < count($SelectTypeCare); $i++){
                                $query->orwhere('TypeOfCareLooking', 'like',  '%' . $SelectTypeCare[$i] .'%');
                                }
                            })
                            ->Where(function ($query) use($SelectLocation) {
                                for ($i = 0; $i < count($SelectLocation); $i++){
                                $query->orwhere('CareOpportunities', 'like',  '%' . $SelectLocation[$i] .'%');
                                }
                            })
                            ->whereNotNull('TypeOfCareLooking')
                            ->orderBy('id','DESC')
                            ->paginate(20);
                $careProvidersTotal = count($careProviders);
                if($careProvidersTotal>0):
                    $careProvidersArray = array();
                    foreach($careProviders as $key => $plansDetial):
                        if(!empty(unserialize($plansDetial->TypeOfCareLooking))):
                            $careProvidersArray[$key] = $plansDetial;
                            $TypeOfCareLooking[$key] = unserialize($plansDetial->TypeOfCareLooking);
                            $careLooking=$TypeOfCareLooking[$key];
                            $careProvidersArray[$key]->TypeOfCareLookingData = $careLooking;
                        else:
                            $careProvidersArray[$key]->TypeOfCareLookingData ='';
                        endif;
                        if(!empty(unserialize($plansDetial->CareOpportunities))):
                            $CareOpportunities[$key] = unserialize($plansDetial->CareOpportunities);
                            $Locations=$CareOpportunities[$key];
                            $careProvidersArray[$key]->CareOpportunitiesData = $Locations;
                        else:
                            $careProvidersArray[$key]->CareOpportunitiesData ='';
                        endif;
                        $careProvidersArray[$key]->providersInfo = User::where('id',$plansDetial->userID)->first();
                        $checkBothfriends = MemberFriends::where('requestSendTo',$plansDetial->userID)
                                                    ->where('senderUserID',Auth::user()->id)
                                                    ->count();
                        if($checkBothfriends>0):
                            $BothfriendsDetail = MemberFriends::where('requestSendTo',$plansDetial->userID)
                            ->where('senderUserID',Auth::user()->id)
                            ->first();
                            $careProvidersArray[$key]->Alreadyfriends = $BothfriendsDetail;
                        else:
                            $checkBothfriends2 = MemberFriends::where('senderUserID',$plansDetial->userID)
                                                        ->where('requestSendTo',Auth::user()->id)
                                                        ->count();
                            if($checkBothfriends2>0):
                                $BothfriendsDetail = MemberFriends::where('senderUserID',$plansDetial->userID)
                                ->where('requestSendTo',Auth::user()->id)
                                ->first();
                                $careProvidersArray[$key]->Alreadyfriends = $BothfriendsDetail;
                            else:
                                $careProvidersArray[$key]->Alreadyfriends = '';
                            endif;
                        endif;
                    endforeach;
                        return response()->json([
                        'getProviders' => 'Providers',
                        'providers' => $careProviders,
                        'careProvidersTotal' =>$careProvidersTotal
                    ]);
                else:
                    return response()->json(['error' => 'Not found!']);
                endif;
            elseif($inputs['SelectMemberType']=='agency_member'):
                $SelectTypeCare = $inputs['SelectTypeCare'];
                $SelectLocation = $inputs['SelectLocation'];
                $careProviders = UserBio::where('userType', 'agency_member')
                            ->Where(function ($query) use($SelectTypeCare) {
                                for ($i = 0; $i < count($SelectTypeCare); $i++){
                                $query->orwhere('TypeOfCareLooking', 'like',  '%' . $SelectTypeCare[$i] .'%');
                                }
                            })
                            ->Where(function ($query) use($SelectLocation) {
                                for ($i = 0; $i < count($SelectLocation); $i++){
                                $query->orwhere('CareOpportunities', 'like',  '%' . $SelectLocation[$i] .'%');
                                }
                            })
                            ->orderBy('id','DESC')
                            ->paginate(20);
                $careProvidersTotal = count($careProviders);
                if($careProvidersTotal>0):
                    $careProvidersArray = array();
                    foreach($careProviders as $key => $plansDetial):
                        $careProvidersArray[$key] = $plansDetial;
                        if(!empty(unserialize($plansDetial->TypeOfCareLooking))):
                            $TypeOfCareLooking[$key] = unserialize($plansDetial->TypeOfCareLooking);
                            $careLooking=$TypeOfCareLooking[$key];
                            $careProvidersArray[$key]->TypeOfCareLookingData = $careLooking;
                        else:
                            $careProvidersArray[$key]->TypeOfCareLookingData ='';
                        endif;
                        if(!empty(unserialize($plansDetial->CareOpportunities))):
                            $CareOpportunities[$key] = unserialize($plansDetial->CareOpportunities);
                            $Locations=$CareOpportunities[$key];
                            $careProvidersArray[$key]->CareOpportunitiesData = $Locations;
                        else:
                            $careProvidersArray[$key]->CareOpportunitiesData ='';
                        endif;
                        $careProvidersArray[$key]->providersInfo = User::where('id',$plansDetial->userID)->first();
                        $checkBothfriends = MemberFriends::where('requestSendTo',$plansDetial->userID)
                                                    ->where('senderUserID',Auth::user()->id)
                                                    ->count();
                        if($checkBothfriends>0):
                            $BothfriendsDetail = MemberFriends::where('requestSendTo',$plansDetial->userID)
                            ->where('senderUserID',Auth::user()->id)
                            ->first();
                            $careProvidersArray[$key]->Alreadyfriends = $BothfriendsDetail;
                        else:
                            $checkBothfriends2 = MemberFriends::where('senderUserID',$plansDetial->userID)
                                                        ->where('requestSendTo',Auth::user()->id)
                                                        ->count();
                            if($checkBothfriends2>0):
                                $BothfriendsDetail = MemberFriends::where('senderUserID',$plansDetial->userID)
                                ->where('requestSendTo',Auth::user()->id)
                                ->first();
                                $careProvidersArray[$key]->Alreadyfriends = $BothfriendsDetail;
                            else:
                                $careProvidersArray[$key]->Alreadyfriends = '';
                            endif;
                        endif;
                    endforeach;
                        return response()->json([
                        'getProviders' => 'Providers',
                        'providers' => $careProviders,
                        'careProvidersTotal' =>$careProvidersTotal
                    ]);
                else:
                    return response()->json(['error' => 'Not found!']);
                endif;
            endif;
        elseif(!empty($inputs['SelectMemberType']) && empty($inputs['keywordSearch']) && empty($inputs['SelectTypeCare']) && !empty($inputs['SelectLocation'])):
            if($inputs['SelectMemberType']=='care_provider_member'):
                $SelectTypeCare = $inputs['SelectLocation'];
                $careProviders = UserBio::where('userType', 'care_provider_member')
                            ->Where(function ($query) use($SelectTypeCare) {
                                for ($i = 0; $i < count($SelectTypeCare); $i++){
                                $query->orwhere('CareOpportunities', 'like',  '%' . $SelectTypeCare[$i] .'%');
                                }
                            })
                            ->orderBy('id','DESC')
                            ->paginate(20);
                $careProvidersTotal = count($careProviders);
                if($careProvidersTotal>0):
                    $careProvidersArray = array();
                    foreach($careProviders as $key => $plansDetial):
                        $careProvidersArray[$key] = $plansDetial;
                        if(!empty(unserialize($plansDetial->TypeOfCareLooking))):
                            $TypeOfCareLooking[$key] = unserialize($plansDetial->TypeOfCareLooking);
                            $careLooking=$TypeOfCareLooking[$key];
                            $careProvidersArray[$key]->TypeOfCareLookingData = $careLooking;
                        else:
                            $careProvidersArray[$key]->TypeOfCareLookingData ='';
                        endif;
                        if(!empty(unserialize($plansDetial->CareOpportunities))):
                            $CareOpportunities[$key] = unserialize($plansDetial->CareOpportunities);
                            $Locations=$CareOpportunities[$key];
                            $careProvidersArray[$key]->CareOpportunitiesData = $Locations;
                        else:
                            $careProvidersArray[$key]->CareOpportunitiesData ='';
                        endif;
                        if(!empty(unserialize($plansDetial->providerChildExperience))):
                            $WillCareForData[$key] = unserialize($plansDetial->providerChildExperience);
                            $WillCareForData=$WillCareForData[$key];
                            $careProvidersArray[$key]->WillCareForData = $WillCareForData;
                        else:
                            $careProvidersArray[$key]->WillCareForData ='';
                        endif;
                        $careProvidersArray[$key]->providersInfo = User::where('id',$plansDetial->userID)->first();
                        $checkBothfriends = MemberFriends::where('requestSendTo',$plansDetial->userID)
                                                    ->where('senderUserID',Auth::user()->id)
                                                    ->count();
                        if($checkBothfriends>0):
                            $BothfriendsDetail = MemberFriends::where('requestSendTo',$plansDetial->userID)
                            ->where('senderUserID',Auth::user()->id)
                            ->first();
                            $careProvidersArray[$key]->Alreadyfriends = $BothfriendsDetail;
                        else:
                            $checkBothfriends2 = MemberFriends::where('senderUserID',$plansDetial->userID)
                                                        ->where('requestSendTo',Auth::user()->id)
                                                        ->count();
                            if($checkBothfriends2>0):
                                $BothfriendsDetail = MemberFriends::where('senderUserID',$plansDetial->userID)
                                ->where('requestSendTo',Auth::user()->id)
                                ->first();
                                $careProvidersArray[$key]->Alreadyfriends = $BothfriendsDetail;
                            else:
                                $careProvidersArray[$key]->Alreadyfriends = '';
                            endif;
                        endif;
                    endforeach;
                        return response()->json([
                        'getProviders' => 'Providers',
                        'providers' => $careProviders,
                        'careProvidersTotal' =>$careProvidersTotal
                    ]);
                else:
                    return response()->json(['error' => 'Not found!']);
                endif;
            elseif($inputs['SelectMemberType']=='family_parent_member'):
                $SelectTypeCare = $inputs['SelectLocation'];
                $careProviders = UserBio::where('userType', 'family_parent_member')
                            ->Where(function ($query) use($SelectTypeCare) {
                                for ($i = 0; $i < count($SelectTypeCare); $i++){
                                $query->orwhere('CareOpportunities', 'like',  '%' . $SelectTypeCare[$i] .'%');
                                }
                        })
                        ->orderBy('id','DESC')
                        ->paginate(20);
                $careProvidersTotal = count($careProviders);
                if($careProvidersTotal>0):
                    $careProvidersArray = array();
                    foreach($careProviders as $key => $plansDetial):
                        $careProvidersArray[$key] = $plansDetial;
                        if(!empty(unserialize($plansDetial->TypeOfCareLooking))):
                            $TypeOfCareLooking[$key] = unserialize($plansDetial->TypeOfCareLooking);
                            $careLooking=$TypeOfCareLooking[$key];
                            $careProvidersArray[$key]->TypeOfCareLookingData = $careLooking;
                        else:
                            $careProvidersArray[$key]->TypeOfCareLookingData ='';
                        endif;
                        if(!empty(unserialize($plansDetial->CareOpportunities))):
                            $CareOpportunities[$key] = unserialize($plansDetial->CareOpportunities);
                            $Locations=$CareOpportunities[$key];
                            $careProvidersArray[$key]->CareOpportunitiesData = $Locations;
                        else:
                            $careProvidersArray[$key]->CareOpportunitiesData ='';
                        endif;
                        $careProvidersArray[$key]->providersInfo = User::where('id',$plansDetial->userID)->first();
                        $checkBothfriends = MemberFriends::where('requestSendTo',$plansDetial->userID)
                                                    ->where('senderUserID',Auth::user()->id)
                                                    ->count();
                        if($checkBothfriends>0):
                            $BothfriendsDetail = MemberFriends::where('requestSendTo',$plansDetial->userID)
                            ->where('senderUserID',Auth::user()->id)
                            ->first();
                            $careProvidersArray[$key]->Alreadyfriends = $BothfriendsDetail;
                        else:
                            $checkBothfriends2 = MemberFriends::where('senderUserID',$plansDetial->userID)
                                                        ->where('requestSendTo',Auth::user()->id)
                                                        ->count();
                            if($checkBothfriends2>0):
                                $BothfriendsDetail = MemberFriends::where('senderUserID',$plansDetial->userID)
                                ->where('requestSendTo',Auth::user()->id)
                                ->first();
                                $careProvidersArray[$key]->Alreadyfriends = $BothfriendsDetail;
                            else:
                                $careProvidersArray[$key]->Alreadyfriends = '';
                            endif;
                        endif;
                    endforeach;
                        return response()->json([
                        'getProviders' => 'Providers',
                        'providers' => $careProviders,
                        'careProvidersTotal' =>$careProvidersTotal
                    ]);
                else:
                    return response()->json(['error' => 'Not found!']);
                endif;
            elseif($inputs['SelectMemberType']=='agency_member'):
                $SelectTypeCare = $inputs['SelectLocation'];
                $careProviders = UserBio::where('userType', 'agency_member')
                            ->Where(function ($query) use($SelectTypeCare) {
                                for ($i = 0; $i < count($SelectTypeCare); $i++){
                                $query->orwhere('CareOpportunities', 'like',  '%' . $SelectTypeCare[$i] .'%');
                                }
                        })
                        ->orderBy('id','DESC')
                        ->paginate(20);
                $careProvidersTotal = count($careProviders);
                if($careProvidersTotal>0):
                    $careProvidersArray = array();
                    foreach($careProviders as $key => $plansDetial):
                        $careProvidersArray[$key] = $plansDetial;
                        if(!empty(unserialize($plansDetial->TypeOfCareLooking))):
                            $TypeOfCareLooking[$key] = unserialize($plansDetial->TypeOfCareLooking);
                            $careLooking=$TypeOfCareLooking[$key];
                            $careProvidersArray[$key]->TypeOfCareLookingData = $careLooking;
                        else:
                            $careProvidersArray[$key]->TypeOfCareLookingData ='';
                        endif;
                        if(!empty(unserialize($plansDetial->CareOpportunities))):
                            $CareOpportunities[$key] = unserialize($plansDetial->CareOpportunities);
                            $Locations=$CareOpportunities[$key];
                            $careProvidersArray[$key]->CareOpportunitiesData = $Locations;
                        else:
                            $careProvidersArray[$key]->CareOpportunitiesData ='';
                        endif;
                        $careProvidersArray[$key]->providersInfo = User::where('id',$plansDetial->userID)->first();
                        $checkBothfriends = MemberFriends::where('requestSendTo',$plansDetial->userID)
                                                    ->where('senderUserID',Auth::user()->id)
                                                    ->count();
                        if($checkBothfriends>0):
                            $BothfriendsDetail = MemberFriends::where('requestSendTo',$plansDetial->userID)
                            ->where('senderUserID',Auth::user()->id)
                            ->first();
                            $careProvidersArray[$key]->Alreadyfriends = $BothfriendsDetail;
                        else:
                            $checkBothfriends2 = MemberFriends::where('senderUserID',$plansDetial->userID)
                                                        ->where('requestSendTo',Auth::user()->id)
                                                        ->count();
                            if($checkBothfriends2>0):
                                $BothfriendsDetail = MemberFriends::where('senderUserID',$plansDetial->userID)
                                ->where('requestSendTo',Auth::user()->id)
                                ->first();
                                $careProvidersArray[$key]->Alreadyfriends = $BothfriendsDetail;
                            else:
                                $careProvidersArray[$key]->Alreadyfriends = '';
                            endif;
                        endif;
                    endforeach;
                        return response()->json([
                        'getProviders' => 'Providers',
                        'providers' => $careProviders,
                        'careProvidersTotal' =>$careProvidersTotal
                    ]);
                else:
                    return response()->json(['error' => 'Not found!']);
                endif;
            endif;
        elseif(!empty($inputs['SelectMemberType']) && !empty($inputs['keywordSearch']) && empty($inputs['SelectTypeCare']) && !empty($inputs['SelectLocation'])):
            if($inputs['SelectMemberType']=='care_provider_member'):
                $SelectLocation = $inputs['SelectLocation'];
                $GetMembers = User::where('role','!=','admin')
                            ->whereNotNull('memberType')
                            ->where('memberType', 'care_provider_member')
                            ->where('name','LIKE','%'.$inputs['keywordSearch'].'%')
                            ->orderBy('id','DESC')
                            ->pluck('id')
                            ->toArray();

                if(count($GetMembers)>0):
                    $careProviders = UserBio::Where(function ($query) use($SelectLocation) {
                            for ($i = 0; $i < count($SelectLocation); $i++){
                            $query->orwhere('CareOpportunities', 'like',  '%' . $SelectLocation[$i] .'%');
                            }
                        })
                        ->whereIn('userID', $GetMembers)
                        ->orderBy('id','DESC')
                        ->paginate(20);
                    $careProvidersTotal = count($careProviders);
                    $careProvidersArray = array();
                    foreach($careProviders as $key => $plansDetial):
                        $careProvidersArray[$key] = $plansDetial;
                        if(!empty(unserialize($plansDetial->TypeOfCareLooking))):
                            $TypeOfCareLooking[$key] = unserialize($plansDetial->TypeOfCareLooking);
                            $careLooking=$TypeOfCareLooking[$key];
                            $careProvidersArray[$key]->TypeOfCareLookingData = $careLooking;
                        else:
                            $careProvidersArray[$key]->TypeOfCareLookingData ='';
                        endif;
                        if(!empty(unserialize($plansDetial->CareOpportunities))):
                            $CareOpportunities[$key] = unserialize($plansDetial->CareOpportunities);
                            $Locations=$CareOpportunities[$key];
                            $careProvidersArray[$key]->CareOpportunitiesData = $Locations;
                        else:
                            $careProvidersArray[$key]->CareOpportunitiesData ='';
                        endif;
                        if(!empty(unserialize($plansDetial->providerChildExperience))):
                            $WillCareForData[$key] = unserialize($plansDetial->providerChildExperience);
                            $WillCareForData=$WillCareForData[$key];
                            $careProvidersArray[$key]->WillCareForData = $WillCareForData;
                        else:
                            $careProvidersArray[$key]->WillCareForData ='';
                        endif;
                        $careProvidersArray[$key]->providersInfo = User::where('id',$plansDetial->userID)->first();
                        $checkBothfriends = MemberFriends::where('requestSendTo',$plansDetial->userID)
                                                    ->where('senderUserID',Auth::user()->id)
                                                    ->count();
                        if($checkBothfriends>0):
                            $BothfriendsDetail = MemberFriends::where('requestSendTo',$plansDetial->userID)
                            ->where('senderUserID',Auth::user()->id)
                            ->first();
                            $careProvidersArray[$key]->Alreadyfriends = $BothfriendsDetail;
                        else:
                            $checkBothfriends2 = MemberFriends::where('senderUserID',$plansDetial->userID)
                                                        ->where('requestSendTo',Auth::user()->id)
                                                        ->count();
                            if($checkBothfriends2>0):
                                $BothfriendsDetail = MemberFriends::where('senderUserID',$plansDetial->userID)
                                ->where('requestSendTo',Auth::user()->id)
                                ->first();
                                $careProvidersArray[$key]->Alreadyfriends = $BothfriendsDetail;
                            else:
                                $careProvidersArray[$key]->Alreadyfriends = '';
                            endif;
                        endif;
                    endforeach;
                        return response()->json([
                        'getProviders' => 'Providers',
                        'providers' => $careProviders,
                        'careProvidersTotal' =>$careProvidersTotal
                    ]);
                else:
                    return response()->json(['error' => 'Not found!']);
                endif;

            elseif($inputs['SelectMemberType']=='family_parent_member'):
                $SelectLocation = $inputs['SelectLocation'];
                $GetMembers = User::where('role','!=','admin')
                            ->whereNotNull('memberType')
                            ->where('memberType', 'family_parent_member')
                            ->where('name','LIKE','%'.$inputs['keywordSearch'].'%')
                            ->orderBy('id','DESC')
                            ->pluck('id')
                            ->toArray();

                if(count($GetMembers)>0):
                    $careProviders = UserBio::Where(function ($query) use($SelectLocation) {
                            for ($i = 0; $i < count($SelectLocation); $i++){
                            $query->orwhere('CareOpportunities', 'like',  '%' . $SelectLocation[$i] .'%');
                            }
                        })
                        ->whereIn('userID', $GetMembers)
                        ->orderBy('id','DESC')
                        ->paginate(20);
                    $careProvidersTotal = count($careProviders);
                    $careProvidersArray = array();
                    foreach($careProviders as $key => $plansDetial):
                        $careProvidersArray[$key] = $plansDetial;
                        if(!empty(unserialize($plansDetial->TypeOfCareLooking))):
                            $TypeOfCareLooking[$key] = unserialize($plansDetial->TypeOfCareLooking);
                            $careLooking=$TypeOfCareLooking[$key];
                            $careProvidersArray[$key]->TypeOfCareLookingData = $careLooking;
                        else:
                            $careProvidersArray[$key]->TypeOfCareLookingData ='';
                        endif;
                        if(!empty(unserialize($plansDetial->CareOpportunities))):
                            $CareOpportunities[$key] = unserialize($plansDetial->CareOpportunities);
                            $Locations=$CareOpportunities[$key];
                            $careProvidersArray[$key]->CareOpportunitiesData = $Locations;
                        else:
                            $careProvidersArray[$key]->CareOpportunitiesData ='';
                        endif;
                        $careProvidersArray[$key]->providersInfo = User::where('id',$plansDetial->userID)->first();
                        $checkBothfriends = MemberFriends::where('requestSendTo',$plansDetial->userID)
                                                    ->where('senderUserID',Auth::user()->id)
                                                    ->count();
                        if($checkBothfriends>0):
                            $BothfriendsDetail = MemberFriends::where('requestSendTo',$plansDetial->userID)
                            ->where('senderUserID',Auth::user()->id)
                            ->first();
                            $careProvidersArray[$key]->Alreadyfriends = $BothfriendsDetail;
                        else:
                            $checkBothfriends2 = MemberFriends::where('senderUserID',$plansDetial->userID)
                                                        ->where('requestSendTo',Auth::user()->id)
                                                        ->count();
                            if($checkBothfriends2>0):
                                $BothfriendsDetail = MemberFriends::where('senderUserID',$plansDetial->userID)
                                ->where('requestSendTo',Auth::user()->id)
                                ->first();
                                $careProvidersArray[$key]->Alreadyfriends = $BothfriendsDetail;
                            else:
                                $careProvidersArray[$key]->Alreadyfriends = '';
                            endif;
                        endif;
                    endforeach;
                        return response()->json([
                        'getProviders' => 'Providers',
                        'providers' => $careProviders,
                        'careProvidersTotal' =>$careProvidersTotal
                    ]);
                else:
                    return response()->json(['error' => 'Not found!']);
                endif;
            elseif($inputs['SelectMemberType']=='agency_member'):
                $SelectLocation = $inputs['SelectLocation'];
                $GetMembers = User::where('role','!=','admin')
                            ->whereNotNull('memberType')
                            ->where('memberType', 'agency_member')
                            ->where('name','LIKE','%'.$inputs['keywordSearch'].'%')
                            ->orderBy('id','DESC')
                            ->pluck('id')
                            ->toArray();

                if(count($GetMembers)>0):
                    $careProviders = UserBio::Where(function ($query) use($SelectLocation) {
                            for ($i = 0; $i < count($SelectLocation); $i++){
                            $query->orwhere('CareOpportunities', 'like',  '%' . $SelectLocation[$i] .'%');
                            }
                        })
                        ->whereIn('userID', $GetMembers)
                        ->orderBy('id','DESC')
                        ->paginate(20);
                    $careProvidersTotal = count($careProviders);
                    $careProvidersArray = array();
                    foreach($careProviders as $key => $plansDetial):
                        $careProvidersArray[$key] = $plansDetial;
                        if(!empty(unserialize($plansDetial->TypeOfCareLooking))):
                            $TypeOfCareLooking[$key] = unserialize($plansDetial->TypeOfCareLooking);
                            $careLooking=$TypeOfCareLooking[$key];
                            $careProvidersArray[$key]->TypeOfCareLookingData = $careLooking;
                        else:
                            $careProvidersArray[$key]->TypeOfCareLookingData ='';
                        endif;
                        if(!empty(unserialize($plansDetial->CareOpportunities))):
                            $CareOpportunities[$key] = unserialize($plansDetial->CareOpportunities);
                            $Locations=$CareOpportunities[$key];
                            $careProvidersArray[$key]->CareOpportunitiesData = $Locations;
                        else:
                            $careProvidersArray[$key]->CareOpportunitiesData ='';
                        endif;
                        $careProvidersArray[$key]->providersInfo = User::where('id',$plansDetial->userID)->first();
                        $checkBothfriends = MemberFriends::where('requestSendTo',$plansDetial->userID)
                                                    ->where('senderUserID',Auth::user()->id)
                                                    ->count();
                        if($checkBothfriends>0):
                            $BothfriendsDetail = MemberFriends::where('requestSendTo',$plansDetial->userID)
                            ->where('senderUserID',Auth::user()->id)
                            ->first();
                            $careProvidersArray[$key]->Alreadyfriends = $BothfriendsDetail;
                        else:
                            $checkBothfriends2 = MemberFriends::where('senderUserID',$plansDetial->userID)
                                                        ->where('requestSendTo',Auth::user()->id)
                                                        ->count();
                            if($checkBothfriends2>0):
                                $BothfriendsDetail = MemberFriends::where('senderUserID',$plansDetial->userID)
                                ->where('requestSendTo',Auth::user()->id)
                                ->first();
                                $careProvidersArray[$key]->Alreadyfriends = $BothfriendsDetail;
                            else:
                                $careProvidersArray[$key]->Alreadyfriends = '';
                            endif;
                        endif;
                    endforeach;
                        return response()->json([
                        'getProviders' => 'Providers',
                        'providers' => $careProviders,
                        'careProvidersTotal' =>$careProvidersTotal
                    ]);
                else:
                    return response()->json(['error' => 'Not found!']);
                endif;
            endif;
        else:
        endif;
    }

    private function myfunction($provider){
        return unserialize($provider['TypeOfCareLooking']);
    }

    public function friendRequestSend(Request $request)
    {
        $inputs = Request::all();
        //echo $inputs['RequestSendTo'].'---Sender:'.$inputs['SenderID'];
        $checkRequest = MemberFriends::where('senderUserID',$inputs['SenderID'])
                                    ->where('requestSendTo',$inputs['RequestSendTo'])
                                    ->where('requestStatus','pending')
                                    ->count();
        $checkConfirmRequest = MemberFriends::where('senderUserID',$inputs['SenderID'])
                                    ->where('requestSendTo',$inputs['RequestSendTo'])
                                    ->where('requestStatus','confirm')
                                    ->count();
        if($checkConfirmRequest>0) :
            return response()->json([
                'resquestSend' => 'Already Friend'
            ]);
        else :
            if($checkRequest>0) :
                return response()->json([
                    'resquestSend' => 'Request already Sent'
                ]);
            else:
                $friendRequest = new MemberFriends;
                $friendRequest->senderUserID = $inputs['SenderID'];
                $friendRequest->requestSendTo = $inputs['RequestSendTo'];
                $friendRequest->requestStatus = 'pending';
                $friendRequest->save();

                $senderInfos = User::where('id',$inputs['SenderID'])->first();
                $requestToInfos = User::where('id',$inputs['RequestSendTo'])->first();
                
                // $siteName = getcong('siteName');
                // $siteEmail = getcong('siteEmail');
                // $data = array(
                //     'siteName'=>$siteName,
                //     'siteEmail'=>$siteEmail,
                //     'senderName'=>$senderInfos->name,
                //     'SenderEmail'=>$senderInfos->email,
                //     'RequestToName'=>$requestToInfos->name,
                //     'RequestToEmail'=>$requestToInfos->email
                // );
                /******************* Notification *****************************/
                $saveNotification = new  Notification;
                $saveNotification->notification_from_memberid = $senderInfos->id;
                $saveNotification->notification_to_memberid = $requestToInfos->id;
                $saveNotification->notification_type = 'Friend request send';
                $saveNotification->notification_status = 'unread';
                $saveNotification->save();

                $pending_friends_requests = Notification::where('notification_to_memberid',Auth::user()->id)
                                            ->where('notification_type','Friend request send')
                                            ->where('notification_status','unread')
                                            ->count();

                event(new FriendRequestSend($pending_friends_requests));

                /******************* Notification *****************************/
                /******************** Email To Member ******************************/
                // Mail::send('emails.new_friend_request', $data, function ($message) use ($data) {
                //     $message->subject($data['siteName'].' New friend request from '.$data['senderName']);
                //     $message->from('gurmukhsingh997@gmail.com', $data['siteName']);
                //     $message->bcc('sudhirkundal007@gmail.com');          
                //     $message->to($data['RequestToEmail']);
                // });

                return response()->json([
                    'resquestSend' => 'Friend Request Sent',
                    'requestDetail' => $friendRequest
                ]);
            endif;
        endif;
    }

    public function checkFriendRequest()
    {
        $checkRequest = MemberFriends::where('senderUserID',Auth::user()->id)
                                    ->get();
        $total_req = count($checkRequest);
        return response()->json([
            'totalReq' => $total_req,
            'alreadysend' => $checkRequest
        ]);
    }

    public function friendsRequests()
    {
        $friendRequests = DB::select("SELECT f.id,f.senderUserID, f.requestSendTo, f.requestStatus, u.name, u.profileImage, u.id as userId, u.username FROM `member_friends` f INNER JOIN users u ON (u.id = f.senderUserID OR u.id = f.requestSendTo ) WHERE (f.senderUserID = '".Auth::user()->id."' OR f.requestSendTo = '".Auth::user()->id."') AND f.requestStatus = 'pending' AND u.id != '".Auth::user()->id."'  GROUP BY f.id ORDER BY f.id DESC");              
        // $friendRequests = MemberFriends::where('requestSendTo',Auth::user()->id)
        //                 ->orWhere('senderUserID',Auth::user()->id)
        //                 ->where('requestStatus','pending')
        //                 ->orderBy('id','DESC')
        //                 ->get();
        // $senderDetails = array();

        // foreach($friendRequests as $key => $sender):
        //     if($sender->requestStatus=='pending'):
        //         $senderDetails[$key] = $sender;
        //         $senderDetails[$key]->senderDetail = User::where('id','!=',Auth::user()->id)
        //                                             ->orwhere('id',$sender->senderUserID)
        //                                             ->orWhere('id',$sender->requestSendTo)
                                                    
        //                                             ->first();
        //     endif;
        // endforeach;
        $pending_friends_requests = Notification::where('notification_to_memberid',Auth::user()->id)
            ->where('notification_type','Friend request send')
            ->where('notification_status','unread')
            ->count();
        return response()->json([
            'resquestsList' => 'Requests list',
            'noRequest' => $pending_friends_requests,
            'senderList' => $friendRequests
        ]); 
    }

    public function friendRequestConfirm(Request $request)
    {
        $inputs = Request::all();
        $checkRequest = MemberFriends::where('id',$inputs['RequestSenderID'])
                        ->where('requestStatus','pending')
                        ->count();
        if($checkRequest>0):
            MemberFriends::where('id',$inputs['RequestSenderID'])->update(['requestStatus'=>'confirm']);

            Notification::where('notification_to_memberid',$inputs['AuthUserID'])
            ->where('notification_from_memberid',$inputs['Sender_id'])
            ->where('notification_type','Friend request send')
            ->delete();
            $friends_notification = Notification::where('notification_to_memberid',$inputs['AuthUserID'])
            ->where('notification_type','Friend request send')
            ->where('notification_status','unread')
            ->count(); 
            event(new FriendRequestSend($friends_notification));
            return response()->json([
                'pending_friends_notification' => $friends_notification,
                'resquestConfirm' => 'Friend request confirm'
            ]);
        else:
            return response()->json([
                'resquestConfirm' => 'Already Confirmed'
            ]);
        endif;
    }

    public function friendRequestCancel(Request $request)
    {
        $inputs = Request::all();
        MemberFriends::where('id',$inputs['RequestSenderID'])
                    ->where('requestStatus','pending')
                    ->delete();    
        
        Notification::where('notification_to_memberid',$inputs['AuthUserID'])
            ->where('notification_from_memberid',$inputs['RequestUserID'])
            ->where('notification_type','Friend request send')
            ->delete();
        $friends_notification = Notification::where('notification_to_memberid',$inputs['AuthUserID'])
            ->where('notification_type','Friend request send')
            ->where('notification_status','unread')
            ->count();
                                          
        $friendRequests = DB::select("SELECT f.id,f.senderUserID, f.requestSendTo, f.requestStatus, u.name, u.profileImage, u.id as userId, u.username FROM `member_friends` f INNER JOIN users u ON (u.id = f.senderUserID OR u.id = f.requestSendTo ) WHERE (f.senderUserID = '".Auth::user()->id."' OR f.requestSendTo = '".Auth::user()->id."') AND f.requestStatus = 'pending' AND u.id != '".Auth::user()->id."'  GROUP BY f.id ORDER BY f.id DESC");
        return response()->json([
            'pending_friends_notification' => $friends_notification,
            'friendsReq'=>$friendRequests,
            'resquestConfirm' => 'Friend request canceled'
        ]);
    }

    public function friendsList()
    {
        $friendList = DB::select("SELECT f.id,f.senderUserID, f.requestSendTo, f.requestStatus, u.name, u.profileImage, u.id as userId, u.username FROM `member_friends` f INNER JOIN users u ON (u.id = f.senderUserID OR u.id = f.requestSendTo ) WHERE (f.senderUserID = '".Auth::user()->id."' OR f.requestSendTo = '".Auth::user()->id."') AND f.requestStatus = 'confirm' AND u.id != '".Auth::user()->id."'  GROUP BY f.id ORDER BY f.id DESC"); 

        return response()->json([
            'myfriendList' => 'My friends list',
            'senderList' => $friendList,
            'totalFriends' =>count($friendList)
        ]);
    }

    public function userCancelSubscription(Request $request)
    {
        $inputs = Request::all();
        if(stripeDetail('payment_mode')=='test_mode'):
            $stripe = new \Stripe\StripeClient(
                //'sk_test_VTsUt7dFurCaJnC0Z1izh2Fo'
                stripeDetail('StripeSecretkey')
            );
        else:
            $stripe = new \Stripe\StripeClient(
                //'sk_test_VTsUt7dFurCaJnC0Z1izh2Fo'
                stripeDetail('StripeSecretkey')
            );
        endif;

        $subscription = subscribersPlans::where('subscr_id',$inputs['subscriptionId'])->first();
        if($subscription->status=='cancelled')
        {
            return response()->json([
                'subscriptionStatus' => 'Already Cancelled'
            ]);
        } else {
            $stripe->subscriptions->cancel(
                $inputs['subscriptionId'],
                []
            );
            subscribersPlans::where('subscr_id',$inputs['subscriptionId'])
                            ->update([
                                'status' =>'cancelled'
                            ]);

            $memberDetails = User::where('id',$subscription->user_id)->first();
            $findMemberShipInfo = Membership::where('id',$subscription->product_id)->first();
            
            $siteName = getcong('siteName');
            $siteEmail = getcong('siteEmail');
            $buy_date = $subscription->created_at->format('F j,Y');
            $data = array(                
                'subscr_num'=>$subscription->subscr_id,
                'user_full_name'=>$memberDetails->name,
                'user_login'=>$memberDetails->username,
                'user_email'=>$memberDetails->email,
                'subscr_terms'=>$findMemberShipInfo->mepr_product_price.'/'.$findMemberShipInfo->mepr_product_period, 
                'subscr_date'=>$buy_date,              
                'subscr_gateway'=>'Credit Card (Stripe)',                             
                'siteName'=>$siteName,
                'siteEmail'=>$siteEmail
            );
            
            /******************** Email To Member ******************************/
            Mail::send('emails.user_cancel_membership', $data, function ($message) use ($data) {
                $message->subject('Nanny Parent Connection Cancel Membership');
                $message->from('admin@nannyparentconnection.com', $data['siteName']);
                $message->bcc('sudhirkundal007@gmail.com');
                $message->to($data['user_email']);
            });

            /******************** Email To Admin ******************************/
            Mail::send('emails.Admin_Cancelled_Subscription_Notice', $data, function ($message) use ($data) {
                $message->subject('Subscription '.$data['subscr_num'].' Was Cancelled');
                $message->from('admin@nannyparentconnection.com', $data['siteName']);
                $message->bcc('sudhirkundal007@gmail.com');         
                $message->to($data['siteEmail']);
            });

            return response()->json([
                'subscriptionStatus' => 'cancel'
            ]);
        }
    }

    public function AllGroups()
    {
        //$allGroups = Group::orderBy('id','ASC')->get();
        $totalGroupMember =array();
        $GroupMembersDetail =array();
        $totalGroupPost = array();
        $userGroup= array();
        if(Auth::check()):
            $allGroups = Group::select('groups.*', 'user_groups.userID', 'user_groups.groupID')
                        ->leftJoin('user_groups', function($join) {
                            $join->on('groups.id', '=', 'user_groups.groupID');
                            $join->where('user_groups.userID', '=', Auth::user()->id);
                        })
                        //->leftJoin('users','user_groups.userID', '=', 'users.id')
                        ->groupBy('groups.id')
                        ->get();
            foreach($allGroups as $group)
            {
                $totalGroupMember[] = UserGroup::where('groupID',$group->id)->count();
                $totalGroupPost[] = GroupPost::where('group_id',$group->id)->count();
                $userGroup[] = UserGroup::where('groupID',$group->id)->where('userID',Auth::user()->id)->get();
            }
        else:
            $allGroups = Group::select('groups.*', 'user_groups.userID', 'user_groups.groupID')
                        ->leftJoin('user_groups', function($join) {
                            $join->on('groups.id', '=', 'user_groups.groupID');
                            //$join->where('user_groups.userID', '=', Auth::user()->id);
                        })
                        //->leftJoin('users','user_groups.userID', '=', 'users.id')
                        ->groupBy('groups.id')
                        ->get();
            foreach($allGroups as $group)
            {
                $totalGroupMember[] = UserGroup::where('groupID',$group->id)->count();
                $totalGroupPost[] = GroupPost::where('group_id',$group->id)->count();
                $userGroup[] = '';
            }
        endif;

        return response()->json([
            'groupsList' => 'Groups list',
            'allGroups' => $allGroups,
            'totalGroupMembers' => $totalGroupMember,
            'checkUserGroup' => $userGroup,
            'totalGroupPost'=> $totalGroupPost
        ]);
    }

    public function joinGroup(Request $request)
    {
        $inputs = Request::all();
        $checkUserGroup = UserGroup::where('userID',$inputs['user_id'])
                                ->where('groupID',$inputs['group_id'])
                                ->count();
        if($checkUserGroup>0):
            return response()->json([
                'resquestStatus' => 'Already joined'
            ]);
        else:
            $userGroups = new UserGroup;
            $userGroups->userID = $inputs['user_id'];
            $userGroups->groupID = $inputs['group_id'];
            $userGroups->save();
            $totalGroupMember = UserGroup::where('groupID',$userGroups->groupID)->count();
            return response()->json([
                'resquestStatus' => 'Joined',
                'groupDetail' => $userGroups,
                'totalGroupMembers' => $totalGroupMember
            ]);
        endif;
    }

    public function MemberGroupList()
    {
        $checkUserGroup = UserGroup::where('userID',Auth::user()->id)->count();
        $MemberAllGroups = UserGroup::where('userID',Auth::user()->id)->get()->toArray();
        $groupDetails = array_map(array($this, 'MemberGroupDetails'),  $MemberAllGroups);
        $groupInfos = Group::whereIn('id',$groupDetails)->get();

        return response()->json([
            'MemberGropusDetails' => $groupInfos,
            'MemberTotalJoinGroup' => $checkUserGroup
        ]);
    }

    private function MemberGroupDetails($groupsIDs){
        return $groupsIDs['groupID'];
    }

    public function GroupInfo($slug)
    {
        $groupInfo = Group::where('groupSlug',$slug)->first();
        $groupMembertotal = UserGroup::where('groupID',$groupInfo->id)->count();
        $joinedGroup = UserGroup::where('groupID',$groupInfo->id)->where('userID',Auth::user()->id)->count();
        $groupPosts = GroupPost::where('group_id',$groupInfo->id)->orderBy('id','DESC')->get();
        $GroupUsersList = GroupPost::where('group_id',$groupInfo->id)->get()->toArray();
        $groupUsersDetails = array_map(array($this, 'GroupPostedUsers'),  $GroupUsersList);
        $groupUsersInfos = User::whereIn('id',$groupUsersDetails)->get();
        $AllGroupPosts = array();
        foreach($groupPosts as $key => $groupPost):
            $AllGroupPosts[$key] = $groupPost;
            $AllGroupPosts[$key]->postDates = $groupPost->created_at->diffForHumans();
        endforeach;
        return response()->json([
            'groupDetails' => $groupInfo,
            'groupMemberSum' =>$groupMembertotal,
            'userJoinGroup' =>$joinedGroup,
            'groupPosts' =>$AllGroupPosts,
            'groupPostUsers' => $groupUsersInfos
        ]);
    }

    private function GroupPostedUsers($groupPostIDs){
        return $groupPostIDs['usersID'];
    }

    public function groupPostShare(Request $request)
    {
        $inputs = Request::all();
        $validator = Validator::make($inputs, [
            'postContent' => 'required'
        ]);

        if($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        $grouppost = new GroupPost;
        $grouppost->group_id = $inputs['groupsid'];
        $grouppost->usersID = Auth::user()->id;
        $grouppost->postContent = $inputs['postContent'];
        //$grouppost->postMedia = $inputs['postContent'];
        $grouppost->save();

        return response()->json([
            'postShareStatus' => 'Post share..',
            'GroupPostShare' => $grouppost
        ]);

    }

    public function MemberGroups()
    {
        $groupsList = UserGroup::where('userID',Auth::user()->id)->get();
        $groupsID = array();
        foreach($groupsList as $groups):
            $groupsID[] = $groups->groupID;
        endforeach;
        $Getgroups = Group::whereIn('id',$groupsID)->get();
        return response()->json([
            'groupsList' => 'Groups list',
            'allGroups' => $Getgroups
        ]);
    }

    public function PostShare(Request $request)
    {
        $inputs = Request::all();
        $validator = Validator::make($inputs, [
            'postContent' => 'required',
            'postAs' => 'required'
        ]);

        if($validator->fails()) {
            $errors = $validator->errors();
            return response()->json(['error' => $validator->errors()], 401);
        }

        $postAs =$inputs['postAs'];
        $GroupsPsot='';
        foreach($postAs as $postTypes):
             if($postTypes!='normal') :
                $grouppost = new GroupPost;
                $grouppost->group_id = $postTypes;
                $grouppost->usersID = Auth::user()->id;
                $grouppost->postContent = $inputs['postContent'];
                //$grouppost->postMedia = $inputs['postContent'];
                $grouppost->save();
                if(!empty($normalPsot)):
                    $GroupsPsot=$grouppost;
                else:
                    $GroupsPsot='';
                endif;
             endif;
        endforeach;

        $normalPsot='';
        if(in_array("normal", $postAs)){
            $userPost = new UserPost;
            $userPost->usersID = Auth::user()->id;
            $userPost->postContent = $inputs['postContent'];
            //$userPost->postMedia = $inputs['postContent'];
            $userPost->save();
            $allPstss = UserPost::where('usersID',Auth::user()->id)->orderBy('id','DESC')->get();
            if(!empty($normalPsot)):
                $normalPsot=$allPstss;
            else:
                $normalPsot='';
            endif;
        }

        return response()->json([
            'postShareStatus' => 'Post share..',
            'GroupPostShare' => $GroupsPsot,
            'userAllPosts' => $normalPsot
        ]);

    }

    public function GetUserPosts()
    {
        if(Auth::user()->memberType=='family_parent_member'){

            $check = MemberFriends::where('senderUserID',Auth::user()->id)->where('requestStatus','confirm')->count();
            if($check>0):
                $friendsList = MemberFriends::where('senderUserID',Auth::user()->id)->where('requestStatus','confirm')->get();
                $friendDetails = array();
                foreach($friendsList as $sender):
                    $friendDetails[] = $sender->requestSendTo;
                endforeach;
                $friendList= User::WhereIn('id',$friendDetails)->pluck('id')->toArray();
            else:
                $friendList= User::where('id',Auth::user()->id)->pluck('id')->toArray();
            endif;
        }else{
            $check = MemberFriends::where('requestSendTo',Auth::user()->id)->where('requestStatus','confirm')->count();
            if($check>0):
                $friendsList = MemberFriends::where('requestSendTo',Auth::user()->id)->where('requestStatus','confirm')->get();
                $friendDetails = array();
                foreach($friendsList as $sender):
                    $friendDetails[] = $sender->senderUserID;
                endforeach;
                $friendList= User::WhereIn('id',$friendDetails)->pluck('id')->toArray();
            else:
                $friendList= User::where('id',Auth::user()->id)->pluck('id')->toArray();
            endif;
        }

        $userAllPosts = UserPost::where('usersID',Auth::user()->id)
                        ->orWhereIn('usersID',$friendList)
                        ->orderBy('id','DESC')
                        ->get();

        $GetUserIDsByPost = UserPost::where('usersID',Auth::user()->id)
                        ->orWhereIn('usersID',$friendList)
                        ->pluck('usersID')
                        ->toArray();

        $PostedByUsersDetail= User::WhereIn('id',$GetUserIDsByPost)->get();
        $GetPostsID = UserPost::orderBy('id','DESC')->pluck('id')->toArray();
        $allComments = UserPostComments::whereIn('Post_ID',$GetPostsID)->get();
        $commentsByUsers = UserPostComments::whereIn('Post_ID',$GetPostsID)->pluck('User_ID')->toArray();
        $CommetnsByUsers = User::WhereIn('id',$commentsByUsers)->get();
        $allCommentss = DB::table('user_post_comments')
                        ->join('users', 'user_post_comments.User_ID', '=', 'users.id')
                        ->select('user_post_comments.*')
                        ->get();

        event(new PostEvent($userAllPosts));
        return response()->json([
            'userAllPosts' => $userAllPosts,
            //'AllPostsComments' => $allComments,
            'AllPostsComments' => $allCommentss,
            'PostByUsers' => $PostedByUsersDetail,
            'CommetedByUsers' =>$CommetnsByUsers
        ]);
    }

    public function UserPostLike(Request $request)
    {
        $inputs = Request::all();
        $userLike = UserPostLike::where('UserID',Auth::user()->id)->where('UserPostID',$inputs['postID'])->count();
        if($userLike>0):
            $postLike = UserPostLike::where('UserID',Auth::user()->id)
                        ->where('UserPostID',$inputs['postID'])
                        ->first();
            if($postLike->PostLikeCount=='liked'):
                $postLike->PostLikeCount = 'unliked';
                $postLike->save();
            else:
                $postLike->PostLikeCount = 'liked';
                $postLike->save();
            endif;
            $totalLike = UserPostLike::where('UserPostID',$postLike->UserPostID)->where('PostLikeCount','liked')->count();
        else:
            $postLike = new UserPostLike;
            $postLike->UserID = Auth::user()->id;
            $postLike->UserPostID = $inputs['postID'];
            $postLike->PostLikeCount = 'liked';
            $postLike->save();
            $totalLike = UserPostLike::where('UserPostID',$postLike->UserPostID)->where('PostLikeCount','liked')->count();
        endif;
        return response()->json([
            'TotalLike' => $totalLike
        ]);

    }

    public function postsLikes()
    {
        if(Auth::user()->memberType=='family_parent_member'){
            $check = MemberFriends::where('senderUserID',Auth::user()->id)->where('requestStatus','confirm')->count();
            if($check>0):
                $friendsList = MemberFriends::where('senderUserID',Auth::user()->id)->where('requestStatus','confirm')->get();
                $friendDetails = array();
                foreach($friendsList as $sender):
                    $friendDetails[] = $sender->requestSendTo;
                endforeach;
                $friendList= User::WhereIn('id',$friendDetails)->pluck('id')->toArray();
            else:
                $friendList= User::where('id',Auth::user()->id)->pluck('id')->toArray();
            endif;
        }else{
            $check = MemberFriends::where('requestSendTo',Auth::user()->id)->where('requestStatus','confirm')->count();
            if($check>0):
                $friendsList = MemberFriends::where('requestSendTo',Auth::user()->id)->where('requestStatus','confirm')->get();
                $friendDetails = array();
                foreach($friendsList as $sender):
                    $friendDetails[] = $sender->senderUserID;
                endforeach;
                $friendList= User::WhereIn('id',$friendDetails)->pluck('id')->toArray();
            else:
                $friendList= User::where('id',Auth::user()->id)->pluck('id')->toArray();
            endif;
        }

        $allUersPost = UserPost::where('usersID',Auth::user()->id)
                        ->orWhereIn('usersID',$friendList)
                        ->orderBy('id','DESC')
                        ->get();

        $GetUserIDsByPost = UserPost::where('usersID',Auth::user()->id)
                        ->orWhereIn('usersID',$friendList)
                        ->pluck('usersID')
                        ->toArray();

        $PostedByUsersDetail= User::WhereIn('id',$GetUserIDsByPost)->get();

        // $allUersPost = UserPost::select('user_posts.*', 'user_post_likes.UserPostID')
        //                 ->leftJoin('user_post_likes', function($join) {
        //                     $join->on('user_posts.id', '=', 'user_post_likes.UserPostID');
        //                     $join->where('user_posts.id', '=', 'user_post_likes.UserPostID');
        //                 })
        //                 ->groupBy('user_posts.id')
        //                 ->orderBy('id','DESC')
        //                 ->get();

        $totalLike =array();

        foreach($allUersPost as $userPost)
        {
            $totalLike[] = UserPostLike::where('UserPostID',$userPost->id)->where('PostLikeCount','liked')->count();
        }
        return response()->json([
            'userAllPosts' => $allUersPost,
            'TotalLike' => $totalLike,
            'PostByUsers' => $PostedByUsersDetail
        ]);
    }

    public function UserPostComment(Request $request)
    {
        $inputs = Request::all();
        $postComments = new UserPostComments;
        $postComments->User_ID = Auth::user()->id;
        $postComments->Post_ID = $inputs['CommentPostID'];
        $postComments->PostComment = $inputs['UserPostComment'];
        $postComments->save();

        $userAllPosts = UserPost::where('usersID',Auth::user()->id)->orderBy('id','DESC')->get();
        $totalComments = UserPostComments::where('Post_ID',$postComments->Post_ID)->count();
        event(new PostCommentEvent($postComments));
        return response()->json([
            'userAllPosts' => $userAllPosts,
            'PostCommentTotal' => $totalComments
        ]);
    }

    public function postsComments()
    {
        if(Auth::user()->memberType=='family_parent_member'){
            $check = MemberFriends::where('senderUserID',Auth::user()->id)->where('requestStatus','confirm')->count();
            if($check>0):
                $friendsList = MemberFriends::where('senderUserID',Auth::user()->id)->where('requestStatus','confirm')->get();
                $friendDetails = array();
                foreach($friendsList as $sender):
                    $friendDetails[] = $sender->requestSendTo;
                endforeach;
                $friendList= User::WhereIn('id',$friendDetails)->pluck('id')->toArray();
            else:
                $friendList= User::where('id',Auth::user()->id)->pluck('id')->toArray();
            endif;
        }else{
            $check = MemberFriends::where('requestSendTo',Auth::user()->id)->where('requestStatus','confirm')->count();
            if($check>0):
                $friendsList = MemberFriends::where('requestSendTo',Auth::user()->id)->where('requestStatus','confirm')->get();
                $friendDetails = array();
                foreach($friendsList as $sender):
                    $friendDetails[] = $sender->senderUserID;
                endforeach;
                $friendList= User::WhereIn('id',$friendDetails)->pluck('id')->toArray();
            else:
                $friendList= User::where('id',Auth::user()->id)->pluck('id')->toArray();
            endif;
        }
        $allUersPost = UserPost::where('usersID',Auth::user()->id)
                    ->orWhereIn('usersID',$friendList)
                    ->orderBy('id','DESC')
                    ->get();
        $GetUserIDsByPost = UserPost::where('usersID',Auth::user()->id)
                    ->orWhereIn('usersID',$friendList)
                    ->pluck('usersID')
                    ->toArray();

        $PostedByUsersDetail= User::WhereIn('id',$GetUserIDsByPost)->get();

        // $allUersPost = UserPost::select('user_posts.*', 'user_post_comments.Post_ID')
        //                 ->leftJoin('user_post_comments', function($join) {
        //                     $join->on('user_post_comments.id', '=', 'user_post_comments.Post_ID');
        //                     $join->where('user_post_comments.id', '=', 'user_post_comments.Post_ID');
        //                 })
        //                 ->groupBy('user_posts.id')
        //                 ->orderBy('id','DESC')
        //                 ->get();

        $totalComments =array();

        foreach($allUersPost as $userPost)
        {
            $totalComments[] = UserPostComments::where('Post_ID',$userPost->id)->count();
        }

        return response()->json([
            'userAllPosts' =>$allUersPost,
            'PostCommentTotal' => $totalComments,
            'PostByUsers' => $PostedByUsersDetail
        ]);
    }

    public function DeletePostComment(Request $request)
    {
        $inputs = Request::all();
        $postComments = UserPostComments::findOrFail($inputs['CommentID']);
        $postComments->delete();
        return response()->json([
            'deleteComment' =>'Deleted..'
        ]);
    }

    public function GroupPostLike(Request $request)
    {
        $inputs = Request::all();
        $userLike = GroupPostLike::where('UserID',Auth::user()->id)->where('UserPostID',$inputs['postID'])->count();
        if($userLike>0):
            $postLike = GroupPostLike::where('UserID',Auth::user()->id)
                        ->where('UserPostID',$inputs['postID'])
                        ->first();
            if($postLike->PostLikeCount=='liked'):
                $postLike->PostLikeCount = 'unliked';
                $postLike->save();
            else:
                $postLike->PostLikeCount = 'liked';
                $postLike->save();
            endif;
            $totalLike = GroupPostLike::where('UserPostID',$postLike->UserPostID)->where('PostLikeCount','liked')->count();
        else:
            $postLike = new GroupPostLike;
            $postLike->UserID = Auth::user()->id;
            $postLike->UserPostID = $inputs['postID'];
            $postLike->PostLikeCount = 'liked';
            $postLike->save();
            $totalLike = GroupPostLike::where('UserPostID',$postLike->UserPostID)->where('PostLikeCount','liked')->count();
        endif;
        return response()->json([
            'TotalLike' => $totalLike
        ]);
    }

    public function UserGroupPostComment()
    {
        $inputs = Request::all();
        $postComments = new GroupPostComments;
        $postComments->User_IDs = Auth::user()->id;
        $postComments->Post_IDs = $inputs['CommentGroupPostID'];
        $postComments->PostComments = $inputs['GroupPostComment'];
        $postComments->save();

        $totalComments = GroupPostComments::where('Post_IDs',$postComments->Post_IDs)->count();

        return response()->json([
            'PostCommentTotal' => $totalComments
        ]);
    }

   public function sendPrivateMessage(Request $request)
   {
        $inputs = Request::all();        
        // SELECT user_id, thread_id FROM  private_message_recipients WHERE thread_id IN (SELECT thread_id FROM `private_message_recipients` WHERE user_id = '7258') AND user_id = 14169;
        $checkThreads = DB::select("SELECT user_id, thread_id FROM  private_message_recipients WHERE thread_id IN (SELECT thread_id FROM `private_message_recipients` WHERE user_id = '".Auth::user()->id."') AND user_id = '".$inputs['SendToMember']."'");

        if(count($checkThreads)>0):            
            $saveMessage = new PrivateMessage;
            $saveMessage->thread_id = $checkThreads[0]->thread_id;
            $saveMessage->sender_id = Auth::user()->id;
            $saveMessage->message = $inputs['PrivateMessageText'];
            $saveMessage->save();
        else:
            $getLastTheadID = PrivateMessageRecipients::orderBy('id','DESC')->pluck('thread_id');
            $insertMessageRecipients = new PrivateMessageRecipients;
            $insertMessageRecipients->user_id = Auth::user()->id;
            $insertMessageRecipients->thread_id = $getLastTheadID[0]+1;
            $insertMessageRecipients->unread_count = '0';
            $insertMessageRecipients->sender_only = '0';
            $insertMessageRecipients->is_deleted = '0';
            $insertMessageRecipients->save();

            $SendToMember = new PrivateMessageRecipients;
            $SendToMember->user_id = $inputs['SendToMember'];
            $SendToMember->thread_id = $insertMessageRecipients->thread_id;
            $SendToMember->unread_count = '0';
            $SendToMember->sender_only = '0';
            $SendToMember->is_deleted = '0';
            $SendToMember->save();

            $saveMessage = new PrivateMessage;
            $saveMessage->thread_id = $insertMessageRecipients->thread_id;
            $saveMessage->sender_id = Auth::user()->id;
            $saveMessage->subject = $inputs['PrivateMessageSubject'];
            $saveMessage->message = $inputs['PrivateMessageText'];
            $saveMessage->save();
        endif;      
        
        /******************* Notification *****************************/
        $saveNotification = new  Notification;
        $saveNotification->notification_from_memberid = Auth::user()->id;
        $saveNotification->notification_to_memberid = $inputs['SendToMember'];
        $saveNotification->notification_type = 'Private message sent';
        $saveNotification->notification_status = 'unread';
        $saveNotification->save();

        $member_notifications = Notification::where('notification_to_memberid',$inputs['SendToMember'])
            ->where('notification_type','Private message sent')
            ->where('notification_status','unread')
            ->count();
        event(new FriendRequestSend($member_notifications));

        /******************* Notification *****************************/
        // $sendPrivateToUser = User::where('id',$inputs['SendToMember'])->first();        
        // $siteName = getcong('siteName');
        // $siteEmail = getcong('siteEmail');
        // $data = array(
        //     'siteName'=>$siteName,
        //     'siteEmail'=>$siteEmail,
        //     'senderName'=>Auth::user()->name,
        //     'senderEmail'=>Auth::user()->email,
        //     'RequestToName'=>$sendPrivateToUser->name,
        //     'RequestToEmail'=>$sendPrivateToUser->email,
        //     'privateMessageText'=>$inputs['PrivateMessageText'],
        // );
        // Mail::send('emails.new_private_message', $data, function ($message) use ($data) {
        //     $message->subject($data['siteName'].' New message from '.$data['senderName']);
        //     $message->from('gurmukhsingh997@gmail.com', $data['siteName']);
        //     $message->bcc('sudhirkundal007@gmail.com');          
        //     $message->to($data['RequestToEmail']);
        // });

        return response()->json([
            'savePrivateMessage' => 'PrivateMessageSave'
        ]);
   }

   public function PrivateMessageList()
   {
        $getMessageByAuth = PrivateMessageRecipients::where('user_id',Auth::user()->id)->get();

        $getThreadIDByAuth = array();
        foreach($getMessageByAuth as $authPrivateMessage):
            $getThreadIDByAuth[] = $authPrivateMessage->thread_id;
        endforeach;

        $PrivateMessageRecipients = PrivateMessageRecipients::whereIn('thread_id',$getThreadIDByAuth)
                                    ->orderBy('id','DESC')
                                    ->get();

        $OtherUsersDetails = array();
        foreach($PrivateMessageRecipients as $key => $otherUsers):
            $OtherUsersDetails[$key] = $otherUsers;
            //$OtherUsersDetails[] = $otherUsers->user_id;
            $OtherUsersDetails[$key]->MessagesDetails = PrivateMessage::where('thread_id',$otherUsers->thread_id)->groupBy('thread_id')->first();
            $OtherUsersDetails[$key]->usersDetails = User::where('id',$otherUsers->user_id)->groupBy('id')->where('id','!=',Auth::user()->id)->first();
        endforeach;

        return response()->json([
            'AuthPrivateMessage' => $getMessageByAuth,
            'PrivateMessageUsers' => $OtherUsersDetails
        ]);
   }

   public function GetMembersThreadsMessages(Request $request)
   {
        $inputs = Request::all();
        $AllPrivateMessage = PrivateMessage::where('thread_id',$inputs['threads_id'])
                            //->groupBy('thread_id')
                            ->where('sender_id','!=',0)
                            ->orderBy('id','ASC')
                            ->get();

        $AllThreadsMessage = array();
        $MessageWithUsers= array();
        foreach($AllPrivateMessage as $key => $threadsDetails):
            $AllThreadsMessage[$key] = $threadsDetails;
            if($threadsDetails->sender_id !=0):
                $AllThreadsMessage[$key]->MessageUsersDetails = User::where('id',$threadsDetails->sender_id)
                                                ->groupBy('id')
                                                ->first();
                $MessageWithUsers[] = $threadsDetails->thread_id;
                Notification::where('notification_to_memberid',Auth::user()->id)
                ->where('notification_from_memberid',$threadsDetails->sender_id)
                ->delete();
            endif;
        endforeach;

        $PrivateMessageRecipientsUser = PrivateMessageRecipients::whereIn('thread_id',$MessageWithUsers)
                                    ->orderBy('id','DESC')
                                    ->get();
        $PrivateMessageRecipientsUsers = array();
        $PrivateMessageRecipientsThreadID = array();
        foreach($PrivateMessageRecipientsUser as $key => $threadsRecipients):
            $PrivateMessageRecipientsThreadID[] = $threadsRecipients->thread_id;
            $PrivateMessageRecipientsUsers[] = $threadsRecipients->user_id;
        endforeach;
        $OtherMemberDetails = User::whereIn('id',$PrivateMessageRecipientsUsers)->where('id','!=',Auth::user()->id)->groupBy('id')->first();
        $pending_friends_requests = Notification::where('notification_to_memberid',Auth::user()->id)
                                    ->where('notification_status','unread')
                                    ->count();
        event(new FriendRequestSend($pending_friends_requests));
        return response()->json([
            'MessageTreadsID' =>$PrivateMessageRecipientsThreadID[0],
            'MessageWithUser' =>$OtherMemberDetails,
            'PrivateMessageList' => $AllThreadsMessage
        ]);
   }

   public function PrivateMessageSendToUser(Request $request)
   {
        $inputs = Request::all();
        $validator = Validator::make($inputs, [
            'message' => 'required'
        ]);

        if($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        $exitTreadInfo = PrivateMessage::where('thread_id',$inputs['sendMessageTreadsID'])->first();
        $saveMessage = new PrivateMessage;
        $saveMessage->thread_id = $inputs['sendMessageTreadsID'];
        $saveMessage->sender_id = Auth::user()->id;
        $saveMessage->subject = 'Re: '.$exitTreadInfo->subject;
        $saveMessage->message = $inputs['message'];
        $saveMessage->save();

        /******************* Notification *****************************/
            $saveNotification = new  Notification;
            $saveNotification->notification_from_memberid = Auth::user()->id;
            $saveNotification->notification_to_memberid = $inputs['sendMessageToUser'];
            $saveNotification->notification_type = 'Private message sent';
            $saveNotification->notification_status = 'unread';
            $saveNotification->save();

            $pending_friends_requests = Notification::where('notification_to_memberid',Auth::user()->id)
                                        ->where('notification_status','unread')
                                        ->count();

            event(new FriendRequestSend($pending_friends_requests));

        /******************* Notification *****************************/
        return response()->json([
            'savePrivateMessage' => 'PrivateMessageSave',
            'MessageStatus' => 'success',
            'SendMessageDetail' => $saveMessage
        ]);
   }

   public function forgotPassword(Request $request)
   {
        $inputs = Request::all();
        $validator = Validator::make($inputs, [
            'usernameOrEmail' => 'required'
        ]);

        if($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }

        $CheckUserExit = User::where('username',$inputs['usernameOrEmail'])->orWhere('email',$inputs['usernameOrEmail'])->count();
        if($CheckUserExit>0):
            $UserDetails = User::where('username',$inputs['usernameOrEmail'])->orWhere('email',$inputs['usernameOrEmail'])->first();
            return response()->json([
                'UserExit' => 'Username or email match',
                'UserDetail' => $UserDetails
            ]);
        else:
            return response()->json([
                'UserExit' => 'Username or email not match'
            ]);
        endif;
   }

    // public function Forgot_Password($username)
    // {
    //    $uname = decrypt($username);
    //    $userDetail = User::where('username',$uname)->first();
    //    return response()->json([
    //         'UserDetails' => $userDetail
    //     ]);
    // }

   public function ChangePassword(Request $request)
   {
        $inputs = Request::all();
        $validator = Validator::make($inputs, [
            'NewPassword' => 'required|required_with:ConfirmPassword|same:ConfirmPassword|min:6'
        ]);

        if($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }

        $CheckUserExit = User::where('id',$inputs['UserID'])->count();
        if($CheckUserExit>0):
            $UserDetails = User::where('id',$inputs['UserID'])->first();
            $UserDetails->password = Hash::make($inputs['ConfirmPassword']);
            $UserDetails->save();
            return response()->json([
                'passwordChaned' => 'password change successfully'
            ]);
        endif;
   }

    public function backgroundCheck()
    {

        // ini_set('display_errors', 1);
        // ini_set('display_startup_errors', 1);
        // error_reporting(E_ALL);
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //fetch RAW input
            $json = file_get_contents('php://input');
            $fp = file_put_contents(public_path('logs/response.log'), $json.'\r\n', FILE_APPEND);
            $obj = json_decode($json);

            //expecting valid json
            if (json_last_error() !== JSON_ERROR_NONE) {
                die(header('HTTP/1.0 415 Unsupported Media Type'));
            }

            if(isset($obj->thrivecart_secret) && ($obj->thrivecart_secret!="")){
                $id_ebi = $obj->customer_id.time();

                $firstname_ebi = $obj->customer->first_name;
                $lastname_ebi = $obj->customer->last_name;
                $email_ebi = $obj->customer->email;

                $candidate_firstname_ebi =  $obj->customer->custom_fields->candidatefirst;
                $candidate_lastname_ebi = $obj->customer->custom_fields->candidatelast;
                $candidate_email_ebi = $obj->customer->custom_fields->candidateemail;

                $package_ebi =  $obj->base_product_name;

                if($package_ebi=="Standard Background Check"){

                    if($obj->order->charges[0]->item_type == "product"){
                        $package_ebi = "Standard Package";

                    }elseif($obj->order->charges[0]->item_type == "upsell"){
                        $package_ebi = "Premium Plus Package";

                    }elseif($obj->order->charges[0]->item_type == "downsells"){
                        $package_ebi = "Premium Package";
                    }

                }


                if($package_ebi=="Premium Background Check"){

                    if($obj->order->charges[0]->item_type == "product"){
                        $package_ebi = "Premium Package";

                    }elseif($obj->order->charges[0]->item_type == "upsell"){
                        $package_ebi = "Premium Plus Package";

                    }

                }



                if($package_ebi=="Premium Plus Background Check"){

                    $package_ebi = "Premium Plus Package";
                }

                if($package_ebi=="Premium Plus Background Check with Member Discount"){

                    $package_ebi = "Premium Plus Package";
                }


                if($package_ebi=="Premium Background Check with Member Discount"){

                    if($obj->order->charges[0]->item_type == "product"){
                        $package_ebi = "Premium Package";

                    }elseif($obj->order->charges[0]->item_type == "upsell"){
                        $package_ebi = "Premium Plus Package";

                    }
                }


                if($package_ebi=="Standard Background Check with Member Discount"){


                    if($obj->order->charges[0]->item_type == "product"){
                        $package_ebi = "Standard Package";

                    }elseif($obj->order->charges[0]->item_type == "upsell"){
                        $package_ebi = "Premium Plus Package";

                    }elseif($obj->order->charges[0]->item_type == "downsells"){
                        $package_ebi = "Premium Package";
                    }
                }

                if($package_ebi=="NannyNow - Premium Plus Background Check"){

                    $package_ebi = "Premium Plus Package";
                    //$candidate_firstname_ebi =  $obj->customer->first_name;
                    //$candidate_lastname_ebi = $obj-> customer->last_name;
                    //$candidate_email_ebi = $obj->customer->email;
                }

                if($package_ebi=="EngineHire - Gold Background Check"){

                    $package_ebi = "Gold";

                }
                if($package_ebi=="EngineHire - Platinum Background Check"){

                    $package_ebi = "Platinum";

                }
                /* if($package_ebi=="Ravinder Test - Premium Plus Background Check"){

                    $package_ebi = "Standard Package";
                } */


                $placeNum_ebi = date("Ymdhis");


                $curl = curl_init();
                curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://api.us.sterlingcheck.app/v2/oauth',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => 'grant_type=client_credentials',
                CURLOPT_HTTPHEADER => array(
                    'Authorization: Basic QXBpVXNlck5hbm55UGFyZW50Q29ubmVjdGlvbjpMakU4cWFhNkAyblYzU2M=',
                    'Content-Type: application/x-www-form-urlencoded'
                ),
                ));

                $resOauth = curl_exec($curl);
                curl_close($curl);
                $Oauth = json_decode($resOauth);


                $curl = curl_init();
                curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://api.us.sterlingcheck.app/v2/packages',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
                CURLOPT_HTTPHEADER => array(
                    'Authorization: Bearer '.$Oauth->access_token
                ),
                ));

                $resPackages = curl_exec($curl);
                curl_close($curl);
                $Packages = json_decode($resPackages, true);
                $slotIndex = array_search($package_ebi, array_column($Packages, 'title'));


                $curl = curl_init();
                curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://api.us.sterlingcheck.app/v2/candidates',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS =>'{
                    "clientReferenceId": "'.$id_ebi.'",
                    "givenName": "'.$candidate_firstname_ebi.'",
                    "familyName": "'.$candidate_lastname_ebi.'",
                    "email": "'.$candidate_email_ebi.'"
                    }',
                CURLOPT_HTTPHEADER => array(
                    'Authorization: Bearer '.$Oauth->access_token,
                    'Content-Type: application/json'
                ),
                ));
                $resCandidate  = curl_exec($curl);
                curl_close($curl);
                $Candidate  = json_decode($resCandidate);
                $fp = file_put_contents(public_path('logs/candidates.log'), $resCandidate.'\r\n', FILE_APPEND);

                $curl = curl_init();
                curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://api.us.sterlingcheck.app/v2/screenings',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS =>'{
                    "packageId": "'.$Packages[$slotIndex]['id'].'",
                    "candidateId": "'.$Candidate->id.'",
                    "invite": {
                    "method": "email"
                    },
                    "jobPosition" : "Standard Employee"
                }',
                CURLOPT_HTTPHEADER => array(
                    'Authorization: Bearer '.$Oauth->access_token,
                    'Content-Type: application/json'
                ),
                ));
                $resScreening = curl_exec($curl);
                curl_close($curl);
                $fp = file_put_contents(public_path('logs/screening.log'), $resScreening.'\r\n', FILE_APPEND);
            }
        }
    }

    public function friendProfileView($username)
    {
        $userDetails = User::where('username',$username)->first();
        return response()->json([
            'userDetails' => $userDetails
        ]);
    }

    public function GetMemberAbout($username)
    {
        $userDetails = User::where('username',$username)->first();
        if($userDetails->memberType=='family_parent_member'):
            $CheckUserBiodetail = UserBio::where('userID',$userDetails->id)->where('userType','family_parent_member')->count();
            if($CheckUserBiodetail>0):
                $userBiodetail = UserBio::where('userID',$userDetails->id)->where('userType','family_parent_member')->first();
                $TypeOfCareLooking = unserialize($userBiodetail->TypeOfCareLooking);
                $CareOpportunities = unserialize($userBiodetail->CareOpportunities);
                if($userBiodetail->providerSpeaksLanguages=="Yes"):
                    $parentSelectLangu = unserialize($userBiodetail->parentsNeedsLanguages);
                    $parentSpeekLangu = implode(', ', $parentSelectLangu);
                else:
                    $parentSpeekLangu = '';
                endif;
                if(!empty($TypeOfCareLooking)):
                    $parentCareLooking = implode(', ' ,$TypeOfCareLooking);
                else:
                    $parentCareLooking = '';
                endif;
                if(!empty($CareOpportunities)):
                    $parentCareOpportunitie = implode(', ' ,$CareOpportunities);
                else:
                    $parentCareOpportunitie = '';
                endif;
            else:
                $userBiodetail = '';
                $parentSpeekLangu = '';
                $parentCareLooking = '';
                $parentCareOpportunitie = '';
            endif;
            return response()->json([
                'userInfos' => $userDetails,
                'userBio' => $userBiodetail,
                'parentTypeOfCareLooking' => $parentCareLooking,
                'parentCareOpportunities' => $parentCareOpportunitie,
                'parentSpeaksLanguages' => $parentSpeekLangu
            ]);
        elseif($userDetails->memberType=='care_provider_member'):
            $CheckBiodetail = UserBio::where('userID',$userDetails->id)->where('userType','care_provider_member')->count();
            if($CheckBiodetail>0) :
                $userBiodetail = UserBio::where('userID',$userDetails->id)->where('userType','care_provider_member')->first();

                $TypeOfCareLooking = unserialize($userBiodetail->TypeOfCareLooking);
                $CareOpportunities = unserialize($userBiodetail->CareOpportunities);
                $SchoolActivities = unserialize($userBiodetail->providerTransportSchoolActivities);
                $availabilities = unserialize($userBiodetail->availability);

                if($userBiodetail->providerSpeaksLanguages=="Yes"):
                    $parentSelectLangu = unserialize($userBiodetail->parentsNeedsLanguages);
                    $parentSpeekLangu = implode(', ', $parentSelectLangu);
                else:
                    $parentSpeekLangu = '';
                endif;
                if(!empty($TypeOfCareLooking)):
                    $parentCareLooking = implode(', ' ,$TypeOfCareLooking);
                else:
                    $parentCareLooking ='';
                endif;

                if(!empty($CareOpportunities)):
                    $parentCareOpportunitie = implode(', ' ,$CareOpportunities);
                else:
                    $parentCareOpportunitie = '';
                endif;
                if(!empty($SchoolActivities)):
                    $providerTransportSchoolActivities = implode(', ' ,$SchoolActivities);
                else:
                    $providerTransportSchoolActivities = '';
                endif;
                if(!empty($availabilities)):
                    $availability = implode(', ' ,$availabilities);
                else:
                    $availability ='';
                endif;
            else:
                $userBiodetail = '';
                $parentSpeekLangu = '';
                $parentCareLooking = '';
                $parentCareOpportunitie = '';
                $providerTransportSchoolActivities = '';
                $availability ='';
            endif;

            return response()->json([
                'userInfos' => $userDetails,
                'userBio' => $userBiodetail,
                'parentTypeOfCareLooking' => $parentCareLooking,
                'parentCareOpportunities' => $parentCareOpportunitie,
                'parentSpeaksLanguages' => $parentSpeekLangu,
                'providerTransportSchoolActivities' => $providerTransportSchoolActivities,
                'availability' => $availability
            ]);
        elseif($userDetails->memberType=='agency_member'):
            return response()->json([
                'userInfos' => $userDetails
            ]);
        else:
        endif;
    }

    public function memberfriendsList($username)
    {
        $userDetails = User::where('username',$username)->first();
        if($userDetails->memberType=='family_parent_member'){
            $check = MemberFriends::where('senderUserID',$userDetails->id)
                                    ->where('requestStatus','confirm')
                                    ->count();

            $check2 = MemberFriends::where('requestSendTo',$userDetails->id)
                    ->where('requestStatus','confirm')
                    ->count();

            if($check>0):
                $friendsList = MemberFriends::where('senderUserID',$userDetails->id)
                                    ->where('requestStatus','confirm')->get();
                $friendDetails = array();
                foreach($friendsList as $sender):
                    if($sender->requestStatus=='confirm'):
                        $friendDetails[] = $sender->requestSendTo;
                    endif;
                endforeach;
                $friendList= User::WhereIn('id',$friendDetails)->get();
                return response()->json([
                    'myfriendList' => 'My friends list',
                    'senderList' => $friendList,
                    'totalFriends' =>$check
                ]);
            elseif($check2):
                $friendsList = MemberFriends::where('requestSendTo',$userDetails->id)
                                    ->where('requestStatus','confirm')->get();
                $friendDetails = array();
                foreach($friendsList as $sender):
                    if($sender->requestStatus=='confirm'):
                        $friendDetails[] = $sender->senderUserID;
                    endif;
                endforeach;
                $friendList= User::WhereIn('id',$friendDetails)->get();
                return response()->json([
                    'myfriendList' => 'My friends list',
                    'senderList' => $friendList,
                    'totalFriends' =>$check
                ]);
            else:
                return response()->json([
                    'nofriends' => 'Friends not found!'
                ]);
            endif;
        } elseif($userDetails->memberType=='care_provider_member'){
            $check = MemberFriends::where('senderUserID',$userDetails->id)
                                    ->where('requestStatus','confirm')
                                    ->count();

            $check2 = MemberFriends::where('requestSendTo',$userDetails->id)
                    ->where('requestStatus','confirm')
                    ->count();

            if($check>0):
                $friendsList = MemberFriends::where('senderUserID',$userDetails->id)
                                    ->where('requestStatus','confirm')->get();
                $friendDetails = array();
                foreach($friendsList as $sender):
                    if($sender->requestStatus=='confirm'):
                        $friendDetails[] = $sender->requestSendTo;
                    endif;
                endforeach;
                $friendList= User::WhereIn('id',$friendDetails)->get();
                return response()->json([
                    'myfriendList' => 'My friends list',
                    'senderList' => $friendList,
                    'totalFriends' =>$check
                ]);
            elseif($check2):
                $friendsList = MemberFriends::where('requestSendTo',$userDetails->id)
                                    ->where('requestStatus','confirm')->get();
                $friendDetails = array();
                foreach($friendsList as $sender):
                    if($sender->requestStatus=='confirm'):
                        $friendDetails[] = $sender->senderUserID;
                    endif;
                endforeach;
                $friendList= User::WhereIn('id',$friendDetails)->get();
                return response()->json([
                    'myfriendList' => 'My friends list',
                    'senderList' => $friendList,
                    'totalFriends' =>$check
                ]);
            else:
                return response()->json([
                    'nofriends' => 'Friends not found!'
                ]);
            endif;
        }elseif($userDetails->memberType=='agency_member'){
            $check = MemberFriends::where('senderUserID',$userDetails->id)
                                    ->where('requestStatus','confirm')
                                    ->count();

            $check2 = MemberFriends::where('requestSendTo',$userDetails->id)
                    ->where('requestStatus','confirm')
                    ->count();

            if($check>0):
                $friendsList = MemberFriends::where('senderUserID',$userDetails->id)
                                    ->where('requestStatus','confirm')->get();
                $friendDetails = array();
                foreach($friendsList as $sender):
                    if($sender->requestStatus=='confirm'):
                        $friendDetails[] = $sender->requestSendTo;
                    endif;
                endforeach;
                $friendList= User::WhereIn('id',$friendDetails)->get();
                return response()->json([
                    'myfriendList' => 'My friends list',
                    'senderList' => $friendList,
                    'totalFriends' =>$check
                ]);
            elseif($check2):
                $friendsList = MemberFriends::where('requestSendTo',$userDetails->id)
                                    ->where('requestStatus','confirm')->get();
                $friendDetails = array();
                foreach($friendsList as $sender):
                    if($sender->requestStatus=='confirm'):
                        $friendDetails[] = $sender->senderUserID;
                    endif;
                endforeach;
                $friendList= User::WhereIn('id',$friendDetails)->get();
                return response()->json([
                    'myfriendList' => 'My friends list',
                    'senderList' => $friendList,
                    'totalFriends' =>$check
                ]);
            else:
                return response()->json([
                    'nofriends' => 'Friends not found!'
                ]);
            endif;
        }else{
            $check = MemberFriends::where('requestSendTo',$userDetails->id)
                                    ->where('requestStatus','confirm')
                                    ->count();
            if($check>0):
                $friendsList = MemberFriends::where('requestSendTo',$userDetails->id)
                                    ->orWhere('senderUserID',$userDetails->id)
                                    ->where('requestStatus','confirm')
                                    ->get();
                $friendDetails = array();
                foreach($friendsList as $sender):
                    if($sender->requestStatus=='confirm'):
                        $friendDetails[] = $sender->senderUserID;
                        $friendDetails[] = $sender->requestSendTo;
                    endif;
                endforeach;
                $friendList= User::WhereIn('id',$friendDetails)->where('id','!=',$userDetails->id)->get();
                return response()->json([
                    'myfriendList' => 'My friends list',
                    'senderList' => $friendList,
                    'totalFriends' =>$check
                ]);
            else:
                return response()->json([
                    'nofriends' => 'Friends not found!'
                ]);
            endif;
        }
    }

    public function SumbitReview(Request $request)
    {
        $inputs = Request::all();
        $validator = Validator::make($inputs, [
            'review' => 'required'
        ]);

        if($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }

        $saveReview = new MemberReview;
        $saveReview->reviewToUser = $inputs['reviewToUserID'];
        $saveReview->reviewFromuser = Auth::user()->id;
        $saveReview->review = $inputs['review'];
        $saveReview->rating = $inputs['rating'];
        $saveReview->reviewstatus = 'publish';
        $saveReview->save();
        return response()->json([
            'MessageStatus' => 'Your review has been submitted.'
        ]);
    }

    public function MemberReviewList($memberUsername)
    {
        $userDetails = User::where('username',$memberUsername)->first();
        $checkReview = MemberReview::where('reviewToUser',$userDetails->id)->count();
        if($checkReview>0):
            $ReviewList = MemberReview::where('reviewToUser',$userDetails->id)->where('reviewstatus','publish')->orderby('id','DESC')->get();
            $FromUserArray = array();
            foreach($ReviewList as $key => $fromUserID):
                $FromUserArray[$key]=$fromUserID;
                $FromUserArray[$key]->fromUserDetail = User::where('id',$fromUserID->reviewFromUser)->first();
            endforeach;
            return response()->json([
                'reviewList' => $FromUserArray
            ]);
        else:
            return response()->json([
                'no_review' => 'Review not found!'
            ]);
        endif;
    }

    public function GetMyReviewList()
    {
        $MyReviewListCount = MemberReview::where('reviewFromUser',Auth::user()->id)->count();
        if($MyReviewListCount>0):
            $MyReviewList = MemberReview::where('reviewFromUser',Auth::user()->id)
                                        ->groupBy('reviewToUser')
                                        ->where('reviewstatus','publish')
                                        ->orderby('id','DESC')
                                        ->get();
            $ReviwToUser= array();
            foreach($MyReviewList as $key => $ReviewToUserID):
                $ReviwToUser[$key]=$ReviewToUserID;
                $ReviwToUser[$key]->ReviewToUserDetail = User::where('id',$ReviewToUserID->reviewToUser)
                                                        ->first();
            endforeach;
            return response()->json([
                'reviewToUsersList' => $ReviwToUser
            ]);
        else:
            return response()->json([
                'no_review' => 'Review not found!'
            ]);
        endif;
    }

    public function GetReviewToUsername(Request $request)
    {
        $inputs = Request::all();
        $fetchUserInfo = User::where('username',$inputs['user_id'])->first();
        $MyReviewListToUser = MemberReview::where('reviewToUser',$fetchUserInfo->id)->get();
        $AllReviewWithUsers = array();
        foreach($MyReviewListToUser as $key => $Reviews):
            $AllReviewWithUsers[$key]=$Reviews;
            $AllReviewWithUsers[$key]->ReviewByUsers = User::where('id',$Reviews->reviewFromUser)->first();
        endforeach;
        return response()->json([
            'fetchUserInfo' => $fetchUserInfo,
            'ReviewList' => $AllReviewWithUsers,

        ]);
    }

    public function MemberTypeDetail()
    {
        $LoginInExit = UserBio::where('userID',Auth::user()->id)->count();
        if($LoginInExit>0):
            $LoginInDetail = UserBio::where('userID',Auth::user()->id)->first();
            if($LoginInDetail->userType=='family_parent_member'):
                $TypeOfCareLooking = unserialize($LoginInDetail->TypeOfCareLooking);
                $CareOpportunities = unserialize($LoginInDetail->CareOpportunities);
                $SuggestedMatches =UserBio::where('userType','care_provider_member')
                                ->Where(function ($query) use($TypeOfCareLooking) {
                                    for ($i = 0; $i < count($TypeOfCareLooking); $i++){
                                    $query->orwhere('TypeOfCareLooking', 'like',  '%' . $TypeOfCareLooking[$i] .'%');
                                    }
                                })
                                ->Where(function ($query) use($CareOpportunities) {
                                    for ($i = 0; $i < count($CareOpportunities); $i++){
                                    $query->orwhere('CareOpportunities', 'like',  '%' . $CareOpportunities[$i] .'%');
                                    }
                                })
                                ->paginate(50);
                $careProvidersTotal = count($SuggestedMatches);
                if($careProvidersTotal>0):
                    $careProvidersArray = array();
                    foreach($SuggestedMatches as $key => $providerBiosDetial):
                        $CareOpportunitiesData = unserialize($providerBiosDetial->CareOpportunities);
                        $CareOpportunitiesArray[$key] = implode(', ', $CareOpportunitiesData);
                        $careProvidersArray[$key] = $providerBiosDetial;
                        $careProvidersArray[$key]->MembersInfo = User::where('id',$providerBiosDetial->userID)->first();
                    endforeach;
                    return response()->json([
                        'CareOpportunitiesArray' => $CareOpportunitiesArray,
                        'SuggestedProviders' => $careProvidersArray,
                        'careProvidersTotal' =>$careProvidersTotal
                    ]);
                endif;
            elseif($LoginInDetail->userType=='care_provider_member'):
                $TypeOfCareLooking = unserialize($LoginInDetail->TypeOfCareLooking);
                $CareOpportunities = unserialize($LoginInDetail->CareOpportunities);
                $SuggestedMatches =UserBio::where('userType','family_parent_member')
                                ->Where(function ($query) use($TypeOfCareLooking) {
                                    for ($i = 0; $i < count($TypeOfCareLooking); $i++){
                                    $query->orwhere('TypeOfCareLooking', 'like',  '%' . $TypeOfCareLooking[$i] .'%');
                                    }
                                })
                                ->Where(function ($query) use($CareOpportunities) {
                                    for ($i = 0; $i < count($CareOpportunities); $i++){
                                    $query->orwhere('CareOpportunities', 'like',  '%' . $CareOpportunities[$i] .'%');
                                    }
                                })
                                ->paginate(50);
                $careProvidersTotal = count($SuggestedMatches);
                if($careProvidersTotal>0):
                    $careProvidersArray = array();
                    foreach($SuggestedMatches as $key => $providerBiosDetial):
                        $CareOpportunitiesData = unserialize($providerBiosDetial->CareOpportunities);
                        if(!empty($CareOpportunitiesData)):
                            $CareOpportunitiesArray[$key] = implode(', ',$CareOpportunitiesData);
                        else:
                            $CareOpportunitiesArray[$key] = '';
                        endif;
                        $careProvidersArray[$key] = $providerBiosDetial;
                        $careProvidersArray[$key]->MembersInfo = User::where('id',$providerBiosDetial->userID)->first();
                    endforeach;
                    return response()->json([
                        'CareOpportunitiesArray' => $CareOpportunitiesArray,
                        'SuggestedProviders' => $careProvidersArray,
                        'careProvidersTotal' =>$careProvidersTotal
                    ]);
                endif;
            endif;
        else:
        endif;
    }

    public function SendfriendRequest(Request $request)
    {
        $inputs = Request::all();
        $requestToInfos = User::where('username',$inputs['RequestSendTo'])->first();
        //echo $inputs['RequestSendTo'].'---Sender:'.$inputs['SenderID'];
        $checkRequest = MemberFriends::where('senderUserID',Auth::user()->id)
                                    ->where('requestSendTo',$requestToInfos->id)
                                    ->where('requestStatus','pending')
                                    ->count();
        $checkConfirmRequest = MemberFriends::where('senderUserID',Auth::user()->id)
                                    ->where('requestSendTo',$requestToInfos->id)
                                    ->where('requestStatus','confirm')
                                    ->count();
        if($checkConfirmRequest>0) :
            return response()->json([
                'resquestSend' => 'Already Friend'
            ]);
        else :
            if($checkRequest>0) :
                return response()->json([
                    'resquestSend' => 'Request already Send'
                ]);
            else:
                $friendRequest = new MemberFriends;
                $friendRequest->senderUserID = Auth::user()->id;
                $friendRequest->requestSendTo = $requestToInfos->id;
                $friendRequest->requestStatus = 'pending';
                $friendRequest->save();

                $senderInfos = User::where('id',Auth::user()->id)->first();
                // $data = array(
                //     'senderName'=>$senderInfos->name,
                //     'SenderEmail'=>$senderInfos->email,
                //     'RequestToName'=>$senderInfos->name,
                //     'RequestToEmail'=>$requestToInfos->email
                // );

                /******************* Notification *****************************/
                    $saveNotification = new  Notification;
                    $saveNotification->notification_from_memberid = Auth::user()->id;
                    $saveNotification->notification_to_memberid = $requestToInfos->id;
                    $saveNotification->notification_type = 'Friend request send';
                    $saveNotification->notification_status = 'unread';
                    $saveNotification->save();                                  

                    $pending_friends_requests = Notification::where('notification_to_memberid',$saveNotification->notification_to_memberid)
                                                ->where('notification_type','Friend request send')
                                                ->where('notification_status','unread')
                                                ->count();

                    event(new FriendRequestSend($pending_friends_requests));
                /******************* Notification *****************************/

                /******************** Email To Member ******************************/
                // Mail::send('emails.new_friend_request', $data, function ($message) use ($data) {
                //     $message->subject('Nanny Parent Connection New friend request from '.$data['senderName']);
                //     $message->from('gurmukhsingh997@gmail.com', 'Nanny Parent Connection');
                //     $message->to($data['RequestToEmail']);
                // });

                return response()->json([
                    'resquestSend' => 'Request Send',
                    'requestDetail' => $friendRequest
                ]);
            endif;
        endif;
    }

    public function UnFriend(Request $request)
    {
        $inputs = Request::all();
        $getMemberDD = $inputs['UnfriendUser'];     
        $friends_notification = Notification::where('notification_to_memberid',$inputs['RequestUsername'])
            ->where('notification_from_memberid',Auth::user()->id)
            ->where('notification_type','Friend request send')
            ->where('notification_status','unread')
            ->count();
        if($friends_notification>0):
            Notification::where('notification_to_memberid',$inputs['RequestUsername'])
                ->where('notification_from_memberid',Auth::user()->id)
                ->where('notification_type','Friend request send')
                ->delete();
        endif;
        MemberFriends::where('id', $inputs['UnfriendUser'])->delete();    
        $friendList = DB::select("SELECT f.id,f.senderUserID, f.requestSendTo, f.requestStatus, u.name, u.profileImage, u.id as userId, u.username FROM `member_friends` f INNER JOIN users u ON (u.id = f.senderUserID OR u.id = f.requestSendTo ) WHERE (f.senderUserID = '".Auth::user()->id."' OR f.requestSendTo = '".Auth::user()->id."') AND f.requestStatus = 'confirm' AND u.id != '".Auth::user()->id."'  GROUP BY f.id ORDER BY f.id DESC"); 
        
        return response()->json([
            'userUnfriend' => 'Un Friend succuss',
            'senderList' => $friendList,
            'totalFriends' =>count($friendList),
            'getMemberDD' =>$getMemberDD
        ]);
        // $requestToInfos = User::where('username',$inputs['UnfriendUser'])->first();
        // $checkRequest1 = MemberFriends::where('senderUserID',Auth::user()->id)
        //                 ->where('requestSendTo',$requestToInfos->id)
        //                 ->where('requestStatus','confirm')
        //                 ->count();
        // $checkRequest2 = MemberFriends::where('requestSendTo',Auth::user()->id)
        //                 ->where('senderUserID',$requestToInfos->id)
        //                 ->where('requestStatus','confirm')
        //                 ->count();

        // if($checkRequest1>0):
        //     $unFriend = MemberFriends::where('senderUserID',Auth::user()->id)
        //                 ->where('requestSendTo',$requestToInfos->id)
        //                 ->where('requestStatus','confirm')
        //                 ->first();
        //     MemberFriends::where('id', $unFriend->id)->delete();
        //     return response()->json([
        //         'userUnfriend' => 'Un Friend'
        //     ]);
        // elseif($checkRequest2>0):
        //     $unFriend = MemberFriends::where('requestSendTo',Auth::user()->id)
        //                 ->where('senderUserID',$requestToInfos->id)
        //                 ->where('requestStatus','confirm')
        //                 ->first();
        //     MemberFriends::where('id', $unFriend->id)->delete();
        //     return response()->json([
        //         'userUnfriend' => 'Un Friend'
        //     ]);
        // endif;

    }

    public function CheckMemberAlradyFriend(Request $request)
    {
        $inputs = Request::all();
        $getMemberDD = User::where('username',$inputs['RequestUsername'])->first();
        $checkRequest = MemberFriends::where('senderUserID',Auth::user()->id)
                        ->where('requestSendTo',$getMemberDD->id)
                        //->orWhere('senderUserID',$getMemberDD->id)
                        //->where('requestStatus','pending')
                        ->count();

        $checkRequest2 = MemberFriends::where('senderUserID',$getMemberDD->id)
                        ->where('requestSendTo',Auth::user()->id)
                        ->count();

        if($checkRequest>0):
            $RequestInfo = MemberFriends::where('senderUserID',Auth::user()->id)
                        ->where('requestSendTo',$getMemberDD->id)
                        ->first();
            $friendRequestCount = $checkRequest;
            $requestExit = $RequestInfo;
        elseif($checkRequest2>0):
            $RequestInfo = MemberFriends::where('senderUserID',$getMemberDD->id)
                        ->where('requestSendTo',Auth::user()->id)
                        ->first();
            $friendRequestCount = $checkRequest2;
            $requestExit = $RequestInfo;
        else:
            $friendRequestCount = 0;
            $requestExit = '';
        endif;

        return response()->json([
            'checkFriend' => $requestExit,
            'friendRequestStatus' => $friendRequestCount
        ]);
    }

    public function GetMemberPrivateMessages($memberUsername)
    {
        $GetMemberDetail = User::where('username',$memberUsername)->first();
        $CheckMemberThreads = PrivateMessageRecipients::where('user_id',$GetMemberDetail->id)->count();
        if($CheckMemberThreads>0):
            $MessageThreads = PrivateMessageRecipients::where('user_id',$GetMemberDetail->id)->get();
            foreach($MessageThreads as $key => $data):
                $testing[]=$data->thread_id;
            endforeach;
            $PrivateMessageList = PrivateMessage::whereIn('thread_id',$testing)
                                    ->where('sender_id',Auth::user()->id)
                                    ->orWhere('sender_id',$GetMemberDetail->id)
                                    ->orderBy('id','ASC')
                                    ->get();
            $messagesList = array();
            foreach($PrivateMessageList as $key=> $messages):
                $messagesList[$key] = $messages;
                $messagesList[$key]->MessageUsersDetails = User::where('id',$messages->sender_id)
                                                ->groupBy('id')
                                                ->first();
            endforeach;

            return response()->json([
                'PrivateMessageList' => $messagesList
            ]);
            else:
            endif;
    }

    public function SaveLastMinuteGroupTextForm(Request $request)
    {
        $inputs = Request::all();
        $validator = Validator::make($inputs, [
            'YouNeedChildCare' => 'required',
            'HowManyChildren' => 'required',
            'AgeChildNeedCare' => 'required',
            'NeedCareSick' => 'required',
            'NeighborHoodYouLive' => 'required',
            'DesiredStartTime' => 'required',
            'DesiredEndTime' => 'required',
            'PayRate' => 'required',
            'FirstName' => 'required',
            'LastName' => 'required',
            'emails' => 'required',
            'PhoneNumber' => 'required'
        ]);

        if($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        //Last Minute Care SMS Group --(Group id 1)
        //Verified Care Provider Service --(Group id 2)
        $replace_special = preg_replace('/[^A-Za-z0-9.-]/', '', $inputs['PhoneNumber']);
        $PhoneNumber = str_replace('-', '', $replace_special);
       
        $data = [
            'name' => $inputs['FirstName'].' '.$inputs['LastName'],
            'phone' => '+1'.$PhoneNumber,
            'group_id'=>1
        ];        
        $curl = curl_init();        
        curl_setopt_array($curl, array(
            CURLOPT_URL => "blog.nannyparentconnection.com/lastMinCareSMSGroupWebhook.php",// your preferred url
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30000,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_HTTPHEADER => array(
                // Set here requred headers
                "accept: */*",
                "accept-language: en-US,en;q=0.8",
                "content-type: application/json",
            ),
        ));        
        $response = curl_exec($curl);
        $err = curl_error($curl);        
        curl_close($curl);        
        if($err) {
            //echo "cURL Error #:" . $err;
        } else {
          //print_r(json_decode($response));
        }        
        
        $saveData = new NinjaForm;
        $saveData->ninja_form_name = 'Last Minute Care SMS Group';
        $saveData->userID = Auth::user()->id;
        $saveData->formGroupID ='1'; 
        $saveData->YouNeedChildCare = $inputs['YouNeedChildCare'];
        $saveData->HowManyChildren = $inputs['HowManyChildren'];
        $saveData->AgeChildNeedCare = $inputs['AgeChildNeedCare'];
        $saveData->NeedCareSick = $inputs['NeedCareSick'];
        $saveData->NeighborHoodYouLive = $inputs['NeighborHoodYouLive'];
        $saveData->DesiredStartTime = $inputs['DesiredStartTime'];
        $saveData->DesiredEndTime = $inputs['DesiredEndTime'];
        $saveData->PayRate = $inputs['PayRate'];
        $saveData->AdditionalInformation = $inputs['AdditionalInformation'];
        $saveData->FirstName = $inputs['FirstName'];
        $saveData->LastName = $inputs['LastName'];
        $saveData->emails = $inputs['emails'];
        $saveData->PhoneNumber = '+1'.$PhoneNumber;
        $saveData->save();
        $siteName = getcong('siteName');
        $siteEmail = getcong('siteEmail');
        $data = array(
            'YouNeedChildCare'=>$inputs['YouNeedChildCare'],
            'HowManyChildren'=>$inputs['HowManyChildren'],
            'AgeChildNeedCare'=>$inputs['AgeChildNeedCare'],
            'NeedCareSick'=>$inputs['NeedCareSick'],
            'NeighborHoodYouLive'=>$inputs['NeighborHoodYouLive'],
            'DesiredStartTime'=>$inputs['DesiredStartTime'],
            'DesiredEndTime'=>$inputs['DesiredEndTime'],
            'PayRate'=>$inputs['PayRate'],
            'AdditionalInformation'=>$inputs['AdditionalInformation'],     
            'First_Name'=>$inputs['FirstName'],
            'Last_Name'=>$inputs['LastName'],
            'emails'=> $inputs['emails'],
            'Phone'=>'+1'.$PhoneNumber,            
            'siteName'=>$siteName,
            'siteEmail'=>$siteEmail
        );
        
        // Mail::send('emails.Last_Minute_Care_Submission_Form', $data, function ($message) use ($data) {
        //     $message->subject('Your Last Minute Care Request');
        //     $message->from('admin@nannyparentconnection.com');
        //     $message->bcc('sudhirkundal007@gmail.com');         
        //     $message->to($data['emails']);
        // });

        // Mail::send('emails.Admin_Last_Minute_Care_Submission_Form', $data, function ($message) use ($data) {
        //     $message->subject('Last Minute Care Submission Form');
        //     $message->from('admin@nannyparentconnection.com');
        //     $message->bcc('sudhirkundal007@gmail.com');         
        //     $message->to($data['siteEmail']);
        // });

        return response()->json([
            'SaveForm' => 'Submited'
        ]);
    }

    public function CheckMemberPlan()
    {
        $userTotalPlans = subscribersPlans::where('user_id',Auth::user()->id)->get();
        return response()->json([
            'userTotalPlans' => $userTotalPlans
        ]);
    }

    public function NannyContractPlan()
    {
        if(stripeDetail('payment_mode')=='test_mode'):
            $NannyContractPlan = Membership::where('post_status','publish')
                                ->where('id','184403')
                                ->get();
            return response()->json([
                'NannyContractPlan' => $NannyContractPlan
            ]);          
        else:
            $NannyContractPlan = Membership::where('post_status','publish')
                                ->where('id','139545')
                                ->get();
            return response()->json([
                'NannyContractPlan' => $NannyContractPlan
            ]);
        endif;
    }

    public function NannyShareContractPlan()
    {
        if(stripeDetail('payment_mode')=='test_mode'):
            $NannyShareContractPlan = Membership::where('post_status','publish')
                                ->where('id','184404')
                                ->get();
            return response()->json([
                'NannyShareContractPlan' => $NannyShareContractPlan
            ]);          
        else:
            $NannyShareContractPlan = Membership::where('post_status','publish')
                                ->where('id','154368')
                                ->get();
            return response()->json([
                'NannyShareContractPlan' => $NannyShareContractPlan
            ]);
        endif;
    }

    public function registerSave(Request $request)
    {
        $inputs = Request::all();

        if((Auth::check())):
            $user = User::findOrFail(Auth::user()->id);
        else:
            $validator = Validator::make($inputs, [
                'firstName' => 'required',
                'lastName' => 'required',
                'address1' => 'required|string|max:255',
                'stateProvince' => 'required|string|max:255',
                'postalCode' => 'required|string|max:255',
                //'phoneNumber' => 'required|string|max:255',
                'userName' => 'required|string|max:255|unique:users',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|required_with:ConfirmPassword|same:ConfirmPassword|min:6'
            ]);

            if($validator->fails()) {
                return response()->json(['error' => $validator->errors()], 401);
            }

            $user = new User;
            $user->role = 'subscriber';
            $user->firstName = $inputs['firstName'];
            $user->lastName = $inputs['lastName'];
            $user->name = $inputs['firstName'].' '.$inputs['lastName'];
            $user->address1 = $inputs['address1'];
            if(!empty($inputs['address22'])) :
                $user->address2 = $inputs['address22'];
            endif;
            $user->state = $inputs['stateProvince'];
            $user->postal_code = $inputs['postalCode'];
            $user->mobile = $inputs['phoneNumber'];
            $user->username = $inputs['userName'];
            $user->email = $inputs['email'];
            $user->password = Hash::make($inputs['password']);
            $user->user_password = $inputs['password'];
            $user->wp_password_update = 1;
            $user->save();
        endif;

        $planDetail = Membership::where('id',$inputs['planID'])->first();
        $patmentGateway = PaymentGateway::where('id',1)->first();

        if(stripeDetail('payment_mode')=='test_mode'):
            $stripe = new \Stripe\StripeClient(
                stripeDetail('StripeSecretkey')
            );
        else:
            $stripe = new \Stripe\StripeClient(
                stripeDetail('live_StripeSecretkey')
            );
        endif;
          
        if($planDetail->mepr_product_period=='lifetime'): 
            $checkout = $stripe->checkout->sessions->create( [
                'success_url' => URL::to('/success'),
                'cancel_url' => URL::to('/cancel'),
                'line_items' => [
                [
                    'price' => $planDetail->stripe_prod_priceID,
                    'quantity' => 1,
                ]   
                ],
                'invoice_creation' => [
                'enabled' => true,  
            ],
                'customer_email'=> $user->email,
                'mode' => 'payment',
            ]);
            $checkout_sessionID = $checkout->id;
        else:
            $checkout_sessionID = '';
        endif;
        
        return response()->json([
            'userInfo' => $user,
            'planDetail' => $planDetail,
            'patmentGateway' => $patmentGateway,
            'checkout_sessionID' => $checkout_sessionID
        ]);
    }

    public function memberBasicDetail()
    {
        if(Auth::check()):
            $userInfo = User::where('id',Auth::user()->id)->first();
            return response()->json([
                'userInfo' => $userInfo
            ]);
        else:
            $userInfo = '';
            return response()->json([
                'userInfo' => $userInfo
            ]);
        endif;
    }
    
    public function newPrivateMessage()
    {
        $newPrivateMsg = Notification::where('notification_to_memberid',Auth::user()->id)
                    ->where('notification_type','Private message sent')
                    ->where('notification_status','unread')
                    ->count();
        event(new FriendRequestSend($newPrivateMsg));
        return response()->json([
            'newTotalPrivateMessage' => $newPrivateMsg
        ]);
    }

    public function MyFriendRequestNotification()
    {
        $myfriendRequest = Notification::where('notification_to_memberid',Auth::user()->id)
                    ->where('notification_type','Friend request send')
                    ->where('notification_status','unread')
                    ->count();
        event(new FriendRequestSend($myfriendRequest));
        return response()->json([
            'myfriendRequest' => $myfriendRequest
        ]);
    }

    public function MyNotificatios()
    {
        $private_messages = Notification::where('notification_to_memberid',Auth::user()->id)
            ->where('notification_type','Private message sent')
            ->where('notification_status','unread')
            ->count();
        $pending_friends_requests = Notification::where('notification_to_memberid',Auth::user()->id)
            ->where('notification_type','Friend request send')
            ->where('notification_status','unread')
            ->count();
        $member_notifications = $private_messages + $pending_friends_requests;
        event(new FriendRequestSend($member_notifications));
        return response()->json([
            'unread_private_messages' => $private_messages,
            'pending_friends_requests' => $pending_friends_requests,
            'totalNotification' => $member_notifications
        ]);
    }

    public function purchaseMembership()
    {
        $subscribersPlans = subscribersPlans::limit(20)->orderBy('id','DESC')->get();        
        $finalContent = array();
        foreach($subscribersPlans as $key => $value):
            $finalContent[$key] = $value;
            $finalContent[$key]->MembershipDetail = Membership::where('id',$value->product_id)->first();
            $finalContent[$key]->UsersDetails = User::where('id',$value->user_id)->first();
        endforeach;
        return response()->json([
            'subscribersPlans' => $finalContent
        ]);
    }

    public function VerifiedCareProviderSubmissionForm(Request $request)
    {
        $inputs = Request::all();
        $validator = Validator::make($inputs, [
            'YouNeedChildCare' => 'required',
            'HowManyChildren' => 'required',
            'AgeChildNeedCare' => 'required',
            'NeighborHoodYouLive' => 'required',
            'DesiredStartTime' => 'required',
            'DesiredEndTime' => 'required',
            'PayRate' => 'required',
            'FirstName' => 'required',
            'LastName' => 'required',
            'emails' => 'required',
            'PhoneNumber' => 'required'
        ]);

        if($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }

        $replace_special = preg_replace('/[^A-Za-z0-9.-]/', '', $inputs['PhoneNumber']);
        $PhoneNumber = str_replace('-', '', $replace_special);
       //Verified Care Provider Service --(Group id 2)
        $data = [
            'name' => $inputs['FirstName'].' '.$inputs['LastName'],
            'phone' => '+1'.$PhoneNumber,
            'group_id'=>2
        ];

        $curl = curl_init();        
        curl_setopt_array($curl, array(
            CURLOPT_URL => "blog.nannyparentconnection.com/lastMinCareSMSGroupWebhook.php",// your preferred url
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30000,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_HTTPHEADER => array(
                // Set here requred headers
                "accept: */*",
                "accept-language: en-US,en;q=0.8",
                "content-type: application/json",
            ),
        ));        
        $response = curl_exec($curl);
        $err = curl_error($curl);        
        curl_close($curl);        
        if($err) {
            //echo "cURL Error #:" . $err;
        } else {
          //print_r(json_decode($response));
        }

        $saveData = new NinjaForm;
        $saveData->ninja_form_name = 'Verified Care Provider Service';
        $saveData->userID = Auth::user()->id;
        $saveData->formGroupID ='2'; 
        $saveData->YouNeedChildCare = $inputs['YouNeedChildCare'];
        $saveData->HowManyChildren = $inputs['HowManyChildren'];
        $saveData->AgeChildNeedCare = $inputs['AgeChildNeedCare'];
        $saveData->NeedCareSick = $inputs['childCurrentlySick'];
        $saveData->NeighborHoodYouLive = $inputs['NeighborHoodYouLive'];
        $saveData->DesiredStartTime = $inputs['DesiredStartTime'];
        $saveData->DesiredEndTime = $inputs['DesiredEndTime'];
        $saveData->PayRate = $inputs['PayRate'];
        $saveData->AdditionalInformation = $inputs['AdditionalInformation'];
        $saveData->FirstName = $inputs['FirstName'];
        $saveData->LastName = $inputs['LastName'];
        $saveData->emails = $inputs['emails'];
        $saveData->PhoneNumber = '+1'.$PhoneNumber;
        $saveData->save();

        $siteName = getcong('siteName');
        $siteEmail = getcong('siteEmail');
        $data = array(
            'YouNeedChildCare'=>$inputs['YouNeedChildCare'],
            'HowManyChildren'=>$inputs['HowManyChildren'],
            'AgeChildNeedCare'=>$inputs['AgeChildNeedCare'],
            'childCurrentlySick'=>$inputs['childCurrentlySick'],
            'NeighborHoodYouLive'=>$inputs['NeighborHoodYouLive'],
            'DesiredStartTime'=>$inputs['DesiredStartTime'],
            'DesiredEndTime'=>$inputs['DesiredEndTime'],
            'PayRate'=>$inputs['PayRate'],
            'AdditionalInformation'=>$inputs['AdditionalInformation'],     
            'First_Name'=>$inputs['FirstName'],
            'Last_Name'=>$inputs['LastName'],
            'emails'=> $inputs['emails'],
            'Phone'=>'+1'.$PhoneNumber,            
            'siteName'=>$siteName,
            'siteEmail'=>$siteEmail
        );       
         
        // Mail::send('emails.Verified_Care_Provider_Submission_Form', $data, function ($message) use ($data) {
        //     $message->subject('Your Verified Care Provider Request');
        //     $message->from('admin@nannyparentconnection.com'); 
        //     $message->bcc('sudhirkundal007@gmail.com');        
        //     $message->to($data['emails']);
        // });

        // Mail::send('emails.Admin_Verified_Care_Provider_Submission_Form', $data, function ($message) use ($data) {
        //     $message->subject('VERIFIED Care Provider Submission Form');
        //     $message->from('admin@nannyparentconnection.com'); 
        //     $message->bcc('sudhirkundal007@gmail.com');        
        //     $message->to($data['siteEmail']);
        // });

        return response()->json([
            'SaveForm' => 'Submited'
        ]);
    }

    public function SaveFamiliesParentsConcierge(Request $request)
    {
        $inputs = Request::all();
        return response()->json([
            'success' => 'A form with this value has been submitted.'
        ]);
    } 
    
    public function notificationList()
    {    
        $pending_friends_requests = Notification::where('notification_to_memberid',Auth::user()->id)
            ->where('notification_status','unread')
            ->count();
        if($pending_friends_requests>0):
            $notificationList = Notification::where('notification_to_memberid',Auth::user()->id)
            ->where('notification_status','unread')
            ->orderBy('id','DESC')
            ->get();
            $finalNotificationList = array();
            foreach($notificationList as $key=>$notifications):
                $finalNotificationList[$key] = $notifications;
                $finalNotificationList[$key]->SenderDetails = User::where('id',$notifications->notification_from_memberid)->first();
            endforeach;
            event(new FriendRequestSend($pending_friends_requests));
            return response()->json([
                'notificationList' => $finalNotificationList,
                'total_notifaction' => $pending_friends_requests
            ]);
        else:
            event(new FriendRequestSend($pending_friends_requests));
            return response()->json([
                'notificationList' => '',
                'total_notifaction' => $pending_friends_requests
            ]);
        endif;    
    }

    public function stripeCheckout(Request $request)
    {
        $inputs = Request::all();
        if(stripeDetail('payment_mode')=='test_mode'):
            $stripe = new \Stripe\StripeClient(
                stripeDetail('StripeSecretkey')
            );
        else:
            $stripe = new \Stripe\StripeClient(
                stripeDetail('live_StripeSecretkey')
            );
        endif;
        $planDetail = Membership::where('stripe_prod_priceID',$inputs['stripe_prod_priceID'])->first();
        if($planDetail->id=='29748' || $planDetail->id=='184396'):
            $success_url = URL::to('/thank-you-family-annual');
        elseif($planDetail->id=='155721' || $planDetail->id=='184397'):
            $success_url = URL::to('/thank-you-family-monthly');
        elseif($planDetail->id=='155718' || $planDetail->id=='184398'):
            $success_url = URL::to('/thank-you-family-one-month-only');
        elseif($planDetail->id=='29896' || $planDetail->id=='184399'):
            $success_url = URL::to('/thank-you-care-providers-annual');
        elseif($planDetail->id=='30019' || $planDetail->id=='184400'):
            $success_url = URL::to('/thank-you-agency-annual');
        elseif($planDetail->id=='155715' || $planDetail->id=='184401'):
            $success_url = URL::to('/thank-you-agency-monthly');
            elseif($planDetail->id=='155712' || $planDetail->id=='184402'):
            $success_url = URL::to('/thank-you-agency-one-month-only');
        else:
            $success_url = URL::to('/success');
        endif;
        if($planDetail->mepr_product_period=='lifetime'):
            $paymode = 'payment';
        else: 
            $paymode = 'subscription';
        endif;
        $session=$stripe->checkout->sessions->create([                    
            'line_items' => [
            [
                'price' => $inputs['stripe_prod_priceID'],
                'quantity' => 1,
            ],
            ],
            'customer_email'=>$inputs['customer_email'],
            'mode' => $paymode,
            'success_url' => $success_url,
            'cancel_url' => URL::to('/cancel'),
        ]);
        return response()->json([
            'payment_url' => $session->url
        ]);
    }

}

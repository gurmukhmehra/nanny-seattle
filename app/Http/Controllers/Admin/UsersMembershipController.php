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
use DB;
use Illuminate\Support\Facades\Input;
use Intervention\Image\Facades\Image;
use App\Models\Membership;
use Illuminate\Support\Str;
use Exception;
use Laravel\Cashier\Cashier;
use \Stripe\Stripe;
use App\Models\subscribersPlans;
use App\Models\SubscriptionsTransactions;
use App\Models\MemberFriends;
use App\Models\PrivateMessage;
use App\Models\PrivateMessageRecipients;
use App\Models\MemberReview;
use Illuminate\Support\Facades\Artisan;
use App\Models\UserBio;
use Carbon\Carbon;

class UsersMembershipController extends Controller
{
    protected $guard = 'admin';

    public function membershipsList()
    {        
        $Memberships = Membership::orderBy('id','DESC')->paginate(30);
        return view('admin.memberships.memberships-list',compact('Memberships'));
    }

    public function AddMemberships()
    {
        return view('admin.memberships.add-memberships');
    }

    public function SaveMemberships(Request $request)
    {
        $data =  Request::except(array('_token'));
        $inputs = Request::all();
        $rule=array(
            'post_title' => 'required',
            'product_price' => 'required',
            'product_period' => 'required',
            'plan_category' => 'required'
           );

        $validator = \Validator::make($data,$rule);

        if ($validator->fails())
        {
            return redirect()->back()->withInput()->withErrors($validator->messages());
        }

        $count = Membership::where('post_title',$inputs['post_title'])->where('plan_category',decrypt($inputs['plan_category']))->count();
        if($count>0):
            return redirect()->back()->withErrors($inputs['post_title'].' already exit.');
        endif;

        $package = new Membership;
        $package->post_title = $inputs['post_title'];
        $package->post_title_slug = Str::slug(decrypt($inputs['plan_category']).'-'.$inputs['post_title'] , "-");
        $package->mepr_product_price = $inputs['product_price'];
        if($inputs['product_period'] =='quarter')
        {
            $package->mepr_product_period = $inputs['product_period'];
        } elseif($inputs['product_period'] =='semiannual'){
            $package->mepr_product_period = $inputs['product_period'];
        } elseif($inputs['product_period'] =='month') {
            $package->mepr_product_period = 'lifetime';
        }elseif($inputs['product_period'] =='monthly') {
            $package->mepr_product_period = 'months';
        } elseif($inputs['product_period'] =='year') {
            $package->mepr_product_period = 'years';
        } elseif($inputs['product_period'] =='day') {
            $package->mepr_product_period = $inputs['product_period'];
        } elseif($inputs['product_period'] =='week') {
            $package->mepr_product_period = $inputs['product_period'];
        } else {
            $package->mepr_product_period = $inputs['product_period'];
        }
        // if(!empty($inputs['product_limit_cycles'])):
        //     $package->mepr_product_limit_cycles = $inputs['product_limit_cycles'];
        // endif;
        //$package->mepr_product_limit_cycles_num = $inputs['product_limit_cycles_num'];
        //$package->mepr_product_limit_cycles_action = $inputs['product_limit_cycles_action'];
        // if(!empty($inputs['product_trial'])):
        //     $package->mepr_product_trial = $inputs['product_trial'];
        // endif;
        //$package->mepr_product_trial_days = $inputs['product_trial_days'];
        // if(!empty($inputs['product_trial_amount'])):
        //     $package->mepr_product_trial_amount = $inputs['product_trial_amount'];
        // else:
        //     $package->mepr_product_trial_amount = '00.00';
        // endif;
        //$package->mepr_product_trial_once = $inputs['product_limit_cycles'];
        $package->plan_category = decrypt($inputs['plan_category']);
        $package->post_status = $inputs['post_status'];

        if($inputs['post_status']=='publish'){
            $ststus = true;
        }else{
            $ststus = false;
        }

        if(stripeDetail('payment_mode')=='test_mode'):
            $stripe = new \Stripe\StripeClient(
                //'sk_test_VTsUt7dFurCaJnC0Z1izh2Fo'
                stripeDetail('StripeSecretkey')
            );
        else:
            $stripe = new \Stripe\StripeClient(
                //'sk_test_VTsUt7dFurCaJnC0Z1izh2Fo'
                stripeDetail('live_StripeSecretkey')
            );
        endif;

        $getProduct = $stripe->products->create([
            'name' => $inputs['post_title'],
            'metadata' => ['productFor' => decrypt($inputs['plan_category'])],
            'active' =>$ststus
        ]);

        if($inputs['product_period'] =='quarter')
        {
            $stripeDetail = $stripe->prices->create([
                'unit_amount' => $inputs['product_price']*100,
                'currency' => 'usd',
                'recurring' => ['interval' => 'month', 'interval_count' =>'3'],
                'product' => $getProduct['id'],
            ]);

        } elseif($inputs['product_period'] =='semiannual'){
            $stripeDetail = $stripe->prices->create([
                'unit_amount' => $inputs['product_price']*100,
                'currency' => 'usd',
                'recurring' => ['interval' => 'month', 'interval_count' =>'6'],
                'product' => $getProduct['id'],
            ]);
        } elseif($inputs['product_period'] =='month') {
            $stripeDetail = $stripe->prices->create([
                'unit_amount' => $inputs['product_price']*100,
                'currency' => 'usd',
                'product' => $getProduct['id'],
            ]);
        }elseif($inputs['product_period'] =='monthly') {
            $stripeDetail = $stripe->prices->create([
                'unit_amount' => $inputs['product_price']*100,
                'currency' => 'usd',
                'recurring' => ['interval' => 'month'],
                'product' => $getProduct['id'],
            ]);
        } elseif($inputs['product_period'] =='year') {
            $stripeDetail = $stripe->prices->create([
                'unit_amount' => $inputs['product_price']*100,
                'currency' => 'usd',
                'recurring' => ['interval' => 'year'],
                'product' => $getProduct['id'],
            ]);
        } elseif($inputs['product_period'] =='day') {
            $stripeDetail = $stripe->prices->create([
                'unit_amount' => $inputs['product_price']*100,
                'currency' => 'usd',
                'recurring' => ['interval' => 'day'],
                'product' => $getProduct['id'],
            ]);
        } elseif($inputs['product_period'] =='week') {
            $stripeDetail = $stripe->prices->create([
                'unit_amount' => $inputs['product_price']*100,
                'currency' => 'usd',
                'recurring' => ['interval' => $inputs['product_period']],
                'product' => $getProduct['id'],
            ]);
        } else {
            $interval_count = '';
            $product_period = '';
        }

        $package->stripe_prod_id = $getProduct['id'];
        $package->stripe_prod_priceID = $stripeDetail['id'];
        $package->save();
        return redirect()->back()->with('success', 'Save successfully.');        
    }   

    public function editmembership($slug)
    {
        $checkMembership = Membership::where('post_title_slug',$slug)->count();
        if($checkMembership>0):
            $membership = Membership::where('post_title_slug',$slug)->first();           
            return view('admin.memberships.memberships-edit',compact('membership'));
        else: 
            return redirect('/superadmin/memberships-list')->withErrors('Membership not found!');
        endif;
    }

    public function updateMembership(Request $request)
    {
        $data =  Request::except(array('_token')) ;        
        $inputs = Request::all();
        $rule=array(
            'post_title' => 'required', 
            //'product_price' => 'required',
            //'product_period' => 'required'                   		        	        
           );
        
        $validator = \Validator::make($data,$rule);
        
        if ($validator->fails())
        {
            return redirect()->back()->withInput()->withErrors($validator->messages());
        }

        $membership = Membership::where('post_title_slug',$inputs['slug'])->first(); 
               
        $count = Membership::where('post_title',$inputs['post_title'])
                            ->where('plan_category',$membership->plan_category)
                            ->count();
        
        if($count>0 && $membership->post_title!=$inputs['post_title']):
            return redirect()->back()->withErrors($inputs['post_title'].' already exit.');
        endif;

        $membership->post_title = $inputs['post_title'];
        $membership->post_title_slug = Str::slug(decrypt($inputs['plan_category']).'-'.$inputs['post_title'] , "-");
        //$membership->mepr_product_price = $inputs['product_price'];
        //$membership->mepr_product_period = $inputs['product_period'];
        $membership->post_status = $inputs['post_status'];
        $membership->save();

        if(stripeDetail('payment_mode')=='test_mode'):
            $stripe = new \Stripe\StripeClient(
                //'sk_test_VTsUt7dFurCaJnC0Z1izh2Fo'
                stripeDetail('StripeSecretkey')
            );
        else:
            $stripe = new \Stripe\StripeClient(
                //'sk_test_VTsUt7dFurCaJnC0Z1izh2Fo'
                stripeDetail('live_StripeSecretkey')
            );
        endif;

        if($membership->post_status=='publish'){
            $ststus = true;
        }else{
            $ststus = false;
        } 

        $stripe->products->update(
            $membership->stripe_prod_id,
            ['name' => $membership->post_title, 'active' =>$ststus]
        );

        // $testng = $stripe->prices->update(
        //     'price_1LPQNWHKo1eGIKrlDgFqSjlR',
        //     ['recurring' => ['interval' => 'month', 'interval_count' =>'6']]
        //   );
        return redirect('/superadmin/memberships/'.$membership->post_title_slug)->with('success', 'Update successfully.');       
    }     

    

    public function UsersSubscriptions()
    {
        // $subscriptions = subscribersPlans::where('payment_status','succeeded')
        //                 ->orderBy('id','DESC')->paginate(30);
        $subscriptions = subscribersPlans::orderBy('id','DESC')->whereNotNull('status')->paginate(30);
        return view('admin.subscriptions.subscriptions-list',compact('subscriptions'));
    }  
    
    public function subscriptionView($id)
    {
        $check= subscribersPlans::where('id',$id)->count();
        if($check>0):
            $subscription = subscribersPlans::findOrFail($id);
            $planDetail = Membership::where('stripe_prod_id',$subscription->plan_product_id)->first();
            $user = User::where('id',$subscription->user_id)->first();
            return view('admin.subscriptions.subscription-View',compact('subscription','planDetail','user'));
        else:
            return redirect('/superadmin/subscriptions');
        endif;
    }

    public function ImportWPMemberships()
    {       
        // get wordpress user memberships plans
            // $wpAllMemberships = json_decode(file_get_contents('http://nannyparentconnection.com/wp-json/wp/v2/get-membership-packages'), true);
            // foreach($wpAllMemberships as $key => $membershipData):                        
            //     //echo 'ID : '.$membershipData['ID'].' ----Title : '.$membershipData['post_title'].'----Price : '.$membershipData['productsDetails']['_mepr_product_price'][0].'<br/>';
            //     $arr = explode("- ", $membershipData['post_title'], 2);  
            //     $testCount = Membership::where('id',$membershipData['post_title'])->count();         
            //     $package = new Membership;
            //     $package->id = $membershipData['ID'];
            //     $package->post_title = $membershipData['post_title'];
            //     if(!empty($arr[0]) && !empty($arr[1])): 
            //         $removeSpace = str_replace("/", '_', $arr[0]);
            //         $removeSlash = str_replace(" ", '', $removeSpace);              
            //         $package->post_title_slug = Str::slug(strtolower($removeSlash.'-'.$arr[1])); 
            //         $package->plan_category = strtolower($removeSlash);               
            //     else:
            //         $removeSpace = str_replace("/", '_', $arr[0]);
            //         $removeSlash = str_replace(" ", '', $removeSpace);              
            //         $package->post_title_slug = Str::slug(strtolower($removeSlash.'-'.$arr[0]));
            //         $package->plan_category = strtolower($removeSlash);
            //     endif;          
            //     $package->mepr_product_price = $membershipData['productsDetails']['_mepr_product_price'][0];
            //     $package->mepr_product_period = $membershipData['productsDetails']['_mepr_product_period_type'][0];

            //     $package->mepr_product_limit_cycles = $membershipData['productsDetails']['_mepr_product_limit_cycles'][0];
            //     $package->mepr_product_limit_cycles_num = $membershipData['productsDetails']['_mepr_product_limit_cycles_num'][0];
            //     $package->mepr_product_limit_cycles_action = $membershipData['productsDetails']['_mepr_product_limit_cycles_action'][0];
            //     $package->mepr_product_trial = $membershipData['productsDetails']['_mepr_product_trial'][0];
            //     $package->mepr_product_trial_days = $membershipData['productsDetails']['_mepr_product_trial_days'][0];
            //     $package->mepr_product_trial_amount = $membershipData['productsDetails']['_mepr_product_trial_amount'][0];
            //     $package->mepr_product_trial_once = $membershipData['productsDetails']['_mepr_product_trial_once'][0];

            //     $package->post_status = $membershipData['post_status'];
            //     $package->created_at = $membershipData['post_date'];
            //     $package->updated_at = $membershipData['post_modified'];            
            //     $package->save();            
            // endforeach;
        // End get wordpress user memberships plans

        // get wordpress user subscribers_plans
            // $usersBuyMemberships = json_decode(file_get_contents('http://nannyparentconnection.com/wp-json/wp/v2/get-users-membership'), true);
            // foreach($usersBuyMemberships['usersMembershipPlans'] as $getdata):
            //     $checkUserExit = subscribersPlans::where('id',$getdata['id'])->count();
            //     if($checkUserExit>0):
            //     else:
            //         if($getdata['user_id']!=0):
            //             $userDetails = User::where('id',$getdata['user_id'])->first();
            //             $savedata = new subscribersPlans;
            //             $savedata->id = $getdata['id'];
            //             $savedata->user_id = $getdata['user_id'];
            //             $savedata->product_id = $getdata['product_id'];
            //             $savedata->coupon_id = $getdata['coupon_id'];
            //             $savedata->subscr_id = $getdata['subscr_id'];
            //             $savedata->price = $getdata['price'];
            //             $savedata->total = $getdata['total'];
            //             $savedata->tax_amount = $getdata['tax_amount'];
            //             $savedata->tax_rate = $getdata['tax_rate'];
            //             $savedata->tax_desc = $getdata['tax_desc'];
            //             $savedata->tax_compound = $getdata['tax_compound'];
            //             $savedata->tax_shipping = $getdata['tax_shipping'];
            //             $savedata->tax_class = $getdata['tax_class'];
            //             $savedata->gateway = $getdata['gateway'];
            //             $savedata->period = $getdata['period'];
            //             $savedata->period_type = $getdata['period_type'];
            //             $savedata->limit_cycles = $getdata['limit_cycles'];
            //             $savedata->limit_cycles_num = $getdata['limit_cycles_num'];
            //             $savedata->limit_cycles_action = $getdata['limit_cycles_action'];
            //             $savedata->prorated_trial = $getdata['prorated_trial'];
            //             $savedata->trial = $getdata['trial'];
            //             $savedata->trial_days = $getdata['trial_days'];
            //             $savedata->trial_amount = $getdata['trial_amount'];
            //             $savedata->status = $getdata['status'];
            //             $savedata->cc_last4 = $getdata['cc_last4'];
            //             $savedata->cc_exp_month = $getdata['cc_exp_month'];
            //             $savedata->cc_exp_year = $getdata['cc_exp_year'];
            //             $savedata->token = $getdata['token'];
            //             $savedata->response = $getdata['response'];
            //             $savedata->limit_cycles_expires_after = $getdata['limit_cycles_expires_after'];
            //             $savedata->limit_cycles_expires_type = $getdata['limit_cycles_expires_type'];
            //             $savedata->trial_tax_amount = $getdata['trial_tax_amount'];
            //             $savedata->trial_total = $getdata['trial_total'];                    
            //             $savedata->buy_data_time = strtotime($getdata['created_at']);
            //             $savedata->created_at = $getdata['created_at'];
            //             $savedata->save();
            //         endif;  
            //     endif;      
            // endforeach;
            // die('data import'); 
        // End get wordpress user subscribers_plans
        
        // Get wordpress user subscribers transactions
            // $subscribers_transactions = json_decode(file_get_contents('http://nannyparentconnection.com/wp-json/wp/v2/get-subscriptions-transactions'), true);
            // foreach($subscribers_transactions['subscriptions_transactions'] as $getdatas):
            //     $checkUserExits = SubscriptionsTransactions::where('id',$getdatas['id'])->count();
            //     if($checkUserExits>0):
            //     else:
            //         $TransactionsSaveData = new SubscriptionsTransactions;
            //         $TransactionsSaveData->id = $getdatas['id'];
            //         $TransactionsSaveData->user_id = $getdatas['user_id'];
            //         $TransactionsSaveData->product_id = $getdatas['product_id'];
            //         $TransactionsSaveData->subscription_id = $getdatas['subscription_id'];
            //         $TransactionsSaveData->amount = $getdatas['amount'];
            //         $TransactionsSaveData->total = $getdatas['total'];
            //         $TransactionsSaveData->tax_amount = $getdatas['tax_amount'];
            //         $TransactionsSaveData->tax_rate = $getdatas['tax_rate'];
            //         $TransactionsSaveData->tax_desc = $getdatas['tax_desc'];
            //         $TransactionsSaveData->tax_compound = $getdatas['tax_compound'];
            //         $TransactionsSaveData->tax_shipping = $getdatas['tax_shipping'];
            //         $TransactionsSaveData->tax_class = $getdatas['tax_class'];           
            //         $TransactionsSaveData->coupon_id = $getdatas['coupon_id'];
            //         $TransactionsSaveData->trans_num = $getdatas['trans_num'];
            //         $TransactionsSaveData->status = $getdatas['status'];
            //         $TransactionsSaveData->txn_type = $getdatas['txn_type'];
            //         $TransactionsSaveData->gateway = $getdatas['gateway'];            
            //         $TransactionsSaveData->prorated = $getdatas['prorated'];
            //         $TransactionsSaveData->created_at = $getdatas['created_at'];
            //         $TransactionsSaveData->updated_at = $getdatas['expires_at'];
            //         $TransactionsSaveData->corporate_account_id = $getdatas['corporate_account_id'];
            //         $TransactionsSaveData->parent_transaction_id = $getdatas['parent_transaction_id'];
            //         $TransactionsSaveData->response = $getdatas['response'];
            //         $TransactionsSaveData->save();
            //     endif;
            // endforeach;
            //die('data import');
        // End Get wordpress user subscribers transactions

        // Get Wordpress Membsers Friends List
            // $members_friendsList = json_decode(file_get_contents('http://nannyparentconnection.com/wp-json/wp/v2/get-membsers-friends-list'), true);    
            // foreach($members_friendsList['members_friendsList'] as $getfriendslist):
            //     $check_ids = MemberFriends::where('id',$getfriendslist['id'])->count();
            //     if($check_ids>0):
            //     else:
            //         $saveFriends = new MemberFriends;
            //         $saveFriends->id = $getfriendslist['id'];
            //         $saveFriends->senderUserID = $getfriendslist['initiator_user_id'];
            //         $saveFriends->requestSendTo = $getfriendslist['friend_user_id'];
            //         if($getfriendslist['is_confirmed']=='1'):
            //             $saveFriends->requestStatus = 'confirm';
            //         else:
            //             $saveFriends->requestStatus = 'pending';
            //         endif;
            //         $saveFriends->created_at = $getfriendslist['date_created'];
            //         $saveFriends->updated_at = $getfriendslist['date_created'];
            //         $saveFriends->save();
            //     endif;
            // endforeach;
            // die('data import');
        // Get Wordpress Membsers Friends List

        // get wordpress user Private Messages API
            // $members_private_messages = json_decode(file_get_contents('http://nannyparentconnection.com/wp-json/wp/v2/get-membsers-chats'), true); 
            // foreach($members_private_messages['members_chats'] as $privateMessages):
            //     $check_messages = PrivateMessage::where('id',$privateMessages['id'])->count();
            //     if($check_messages>0):
            //     else:
            //         $savePrivateMessage = new PrivateMessage;
            //         $savePrivateMessage->id = $privateMessages['id'];
            //         $savePrivateMessage->thread_id = $privateMessages['thread_id'];
            //         $savePrivateMessage->sender_id = $privateMessages['sender_id'];
            //         $savePrivateMessage->subject = $privateMessages['subject'];
            //         $savePrivateMessage->message = $privateMessages['message'];
            //         $savePrivateMessage->created_at = $privateMessages['date_sent'];
            //         $savePrivateMessage->updated_at = $privateMessages['date_sent'];
            //         $savePrivateMessage->save();
            //     endif;                
            // endforeach;
            // die('data import');
        // get wordpress user Private Messages API

        // get wordpress user Private Messages Recipients API
            // $members_private_messages_recipients = json_decode(file_get_contents('http://nannyparentconnection.com/wp-json/wp/v2/get-membsers-private-messages-recipients'), true); 
            // foreach($members_private_messages_recipients['members_private_messages_recipients'] as $privateMessagesRecipients):
            //     $check_messages_Recipients = PrivateMessageRecipients::where('id',$privateMessagesRecipients['id'])->count();
            //     if($check_messages_Recipients>0):
            //     else:
            //         $savePrivateMessageRecipients = new PrivateMessageRecipients;
            //         $savePrivateMessageRecipients->id = $privateMessagesRecipients['id'];
            //         $savePrivateMessageRecipients->user_id = $privateMessagesRecipients['user_id'];
            //         $savePrivateMessageRecipients->thread_id = $privateMessagesRecipients['thread_id'];                    
            //         $savePrivateMessageRecipients->unread_count = $privateMessagesRecipients['unread_count'];
            //         $savePrivateMessageRecipients->sender_only = $privateMessagesRecipients['sender_only'];
            //         $savePrivateMessageRecipients->is_deleted = $privateMessagesRecipients['is_deleted'];
            //         $savePrivateMessageRecipients->save();
            //     endif;                
            // endforeach;
            // die('data import');
        // get wordpress user Private Messages Recipients API

        // Get Wordpress User Reviews API
            // $wpAllMemberReview = json_decode(file_get_contents('http://nannyparentconnection.com/wp-json/wp/v2/get-member-reviews'), true);
            // foreach($wpAllMemberReview as $key => $memberReviewData):
            //     $checkReview = MemberReview::where('id',$memberReviewData['ID'])->count();
            //         $rating = unserialize($memberReviewData['reviewsMeta']['profile_star_rating'][0]);
            //         $rating['Please Rate Your Connection/Interaction With This Member:'];
            //         if($checkReview>0):
            //         else:
            //             $saveReviewData = new MemberReview;
            //             $saveReviewData->id = $memberReviewData['ID'];
            //             $saveReviewData->reviewFromuser = $memberReviewData['post_author'];
            //             $saveReviewData->reviewToUser = $memberReviewData['reviewsMeta']['linked_bp_member'][0];            
            //             $saveReviewData->review = $memberReviewData['post_content'];
            //             $saveReviewData->rating = $rating['Please Rate Your Connection/Interaction With This Member:'];
            //             $saveReviewData->reviewstatus = $memberReviewData['post_status'];
            //             $saveReviewData->created_at = $memberReviewData['post_date'];
            //             $saveReviewData->updated_at = $memberReviewData['post_date_gmt'];
            //             $saveReviewData->save();
            //         endif;
            // endforeach;
        // End Wordpress User Reviews API
       dd('we are working..');
        
    }

    public function ImportData()
    {
        // $userBio = array();
        // $wpAllUsersBios = json_decode(file_get_contents('http://nannyparentconnection.com/wp-json/wp/v2/getusers'), true);
        // foreach($wpAllUsersBios as $key => $ueserData):
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
                        //     $res1 = str_replace( array( '\'', '"',
                        //     ',' , ';', '<', '>','$-','$' ), '', $providerRate['from']);
                        //     $usersBiosSave->minRange = $res1;
                        // endif;
                        // if(isset($providerRate['to'])):
                        //     $res2 = str_replace( array( '\'', '"',
                        //     ',' , ';', '<', '>','$-','$' ), '', $providerRate['from']);
                        //     $usersBiosSave->maxRange = $res2;
                        // endif;
        //         endif;
        //         if(isset($userBios[94])): //about family
        //             $usersBiosSave->aboutMyfamily = $userBios[94];
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
        //         endif;
        //         // if(isset($userBios[115])): //not feild in our db
        //         //     $usersBiosSave->ChildSpecialNeeds = $userBios[115];
        //         // endif;
        //         if(isset($userBios[169])): //providerSpeaksLanguages
        //             $usersBiosSave->providerSpeaksLanguages = $userBios[169];
        //         endif;
        //         if(isset($userBios[172])): //parentsNeedsLanguages
        //             $usersBiosSave->parentsNeedsLanguages = $userBios[172];
        //         endif;
        //         if(isset($userBios[294])): //providerSpeaksLanguages
        //             $usersBiosSave->providerDrives = $userBios[294];
        //         endif;                
        //         $usersBiosSave->save();
        //     endif;                                       
        // endforeach;
        // die('User Bio Save..');
        return view('admin.import-data');
    }

    public function ImportedData()
    {        
        // usersData
        // usersSubscribersPlans
        // MembsersFriendsList
        // MembsersPrivateMessages
        $inputs = Request::all();
        $optionType = decrypt($inputs['inputData']);
        if($optionType=='usersData'):
            $wpAllUsers = json_decode(file_get_contents('https://nannyparentconnection.com/wp-json/wp/v2/getusers'), true);
            foreach($wpAllUsers as $key => $ueserData):
                $image_url = "https://nannyparentconnection.com/wp-content/uploads/avatars/".$ueserData['data']['ID'].'/';
                $values = parse_url($ueserData['data']['UserProfilePics']['url']);
                $host = explode('.',$values['host']);
                $urls = $host[0].'.'.$host[1];         

                $checkUserExit = User::where('id',$ueserData['data']['ID'])->count();
                    if($checkUserExit>0):
                    else:
                        $user = new User;
                        $user->id = $ueserData['data']['ID'];
                        $user->username =$ueserData['data']['user_login'];
                        if(array_search('family_parent_member',$ueserData['roles'])):
                            $user->memberType = 'family_parent_member';
                        endif;
                        if(array_search('care_provider_member',$ueserData['roles'])):
                            $user->memberType = 'care_provider_member';
                        endif;
                        if(array_search('agency_member',$ueserData['roles'])):
                            $user->memberType = 'agency_member';
                        endif;
                        $user->name = $ueserData['data']['display_name'];
                        $user->email = $ueserData['data']['user_email'];
                        $user->password = $ueserData['data']['user_pass'];
                        if(!empty($ueserData['data']['UserBasicDetail']['first_name'][0])):
                            $user->firstName = $ueserData['data']['UserBasicDetail']['first_name'][0];
                        endif;
                        if(!empty($ueserData['data']['UserBasicDetail']['last_name'][0])):
                            $user->lastName = $ueserData['data']['UserBasicDetail']['last_name'][0];
                        endif;
                        if(!empty($ueserData['data']['UserBasicDetail']['mepr-address-one'][0])):
                            $user->address1 = $ueserData['data']['UserBasicDetail']['mepr-address-one'][0];
                        endif;
                        if(!empty($ueserData['data']['UserBasicDetail']['mepr-address-two'][0])):
                            $user->address2 = $ueserData['data']['UserBasicDetail']['mepr-address-two'][0];
                        endif;
                        if(!empty($ueserData['data']['UserBasicDetail']['mepr-address-city'][0])):
                            $user->city = $ueserData['data']['UserBasicDetail']['mepr-address-city'][0];
                        endif;
                        if(!empty($ueserData['data']['UserBasicDetail']['mepr-address-state'][0])):
                            $user->state = $ueserData['data']['UserBasicDetail']['mepr-address-state'][0];
                        endif;
                        if(!empty($ueserData['data']['UserBasicDetail']['mepr-address-zip'][0])):
                            $user->postal_code = $ueserData['data']['UserBasicDetail']['mepr-address-zip'][0];
                        endif;
                        if($urls=='nannyparentconnection.com'):
                            $image_url2 = "https://nannyparentconnection.com/wp-content/uploads/avatars/".$ueserData['data']['ID'].'/';
                            $getUserFolder = Str::afterLast($ueserData['data']['UserProfilePics']['url'], '/');
                            $content = file_get_contents($image_url2.$getUserFolder);
                            $fp = fopen(public_path('uploads/profileImage/'.$getUserFolder), "w");
                            fwrite($fp, $content);
                            fclose($fp);
                            $user->profileImage = $getUserFolder;
                        endif;
                        $user->status = $ueserData['data']['user_status'];
                        $user->created_at = $ueserData['data']['user_registered'];
                        $user->save();                       
                    endif;                 
            endforeach;
            $userBio = array();
            foreach($wpAllUsers as $key => $ueserData):
                //echo"<pre>";print_r($ueserData['data']['ID']);
                $mergeAll = call_user_func_array('array_merge_recursive', $ueserData['data']['users_bios']);
                if(!empty($mergeAll)){
                    if(is_array($mergeAll['field_id'])){
                        $userBio[$ueserData['data']['ID']] = array_combine($mergeAll['field_id'],$mergeAll['value']);
                    }else{
                        $userBio[$ueserData['data']['ID']] = array($mergeAll['field_id']=>$mergeAll['value']);
                    }
                }
            endforeach;
            foreach($userBio as $key => $userBios):
                $CheckUser = UserBio::where('userID',$key)->count();
                if($CheckUser>0):
                else:
                    $UserRoles = User::where('id',$key)->first();
                    $usersBiosSave = new UserBio;
                    $usersBiosSave->userID = $key;
                    $usersBiosSave->userType = $UserRoles->memberType;
                    if(isset($userBios[41])):
                        $usersBiosSave->live_in = $userBios[41];
                    elseif(isset($userBios[40])):
                        $usersBiosSave->live_in = $userBios[40];
                    endif;
                    
                    if(isset($userBios[2])):
                        $usersBiosSave->TypeOfCareLooking = $userBios[2];
                    endif;
                    if(isset($userBios[33])):
                        $usersBiosSave->CareOpportunities = $userBios[33];
                    endif;
                    //commom fields
                    if(isset($userBios[762])):
                        $providerRate = unserialize($userBios[762]);
                        if(isset($providerRate['from'])):
                            $res1 = str_replace( array( '\'', '"',
                            ',' , ';', '<', '>','$-','$' ), '', $providerRate['from']);
                            $usersBiosSave->minRange = $res1;
                        endif;
                        if(isset($providerRate['to'])):
                            $res2 = str_replace( array( '\'', '"',
                            ',' , ';', '<', '>','$-','$' ), '', $providerRate['from']);
                            $usersBiosSave->maxRange = $res2;
                        endif;
                    endif;
                    if(isset($userBios[94])): //about family
                        $usersBiosSave->aboutMyfamily = $userBios[94];
                    elseif(isset($userBios[93])):
                        $usersBiosSave->aboutMyfamily = $userBios[93];
                    endif;

                    if(isset($userBios[1130])): //Currently seeking new provider to work with?
                        $usersBiosSave->currently_seeking_provider_work = $userBios[1130];
                    elseif(isset($userBios[1133]))://Currently seeking new families to work with? 
                        $usersBiosSave->currently_seeking_provider_work = $userBios[1133];
                    endif;
                    if(isset($userBios[169])): //providerSpeaksLanguages
                        $usersBiosSave->providerSpeaksLanguages = $userBios[169];
                    endif;
                    if(isset($userBios[172])): //parentsNeedsLanguages
                        $usersBiosSave->parentsNeedsLanguages = $userBios[172];
                    endif;
                    if(isset($userBios[294])): //providerDrives
                        $usersBiosSave->providerDrives = $userBios[294];
                    endif;
                    if(isset($userBios[301])): //providerTransportSchoolActivities
                        $usersBiosSave->providerTransportSchoolActivities = $userBios[301];
                    endif;
                    if(isset($userBios[312])): //CareProviderVehicleTransTest
                        $usersBiosSave->providerTransportSchoolActivities = $userBios[312];
                    endif;
                    if(isset($userBios[154])): //providerNeedsLanguages
                        $usersBiosSave->parentsNeedsLanguages = $userBios[154];
                    endif;
                    if(isset($userBios[151])): //providerSpeaksLanguages
                        $usersBiosSave->providerSpeaksLanguages = $userBios[151];
                    endif;
                    if(isset($userBios[16])): //providerExperience
                        $usersBiosSave->providerExperience = $userBios[16];
                    endif;

                    if(isset($userBios[145])): //providerChildExperience
                        $usersBiosSave->providerChildExperience = $userBios[145];
                    endif;
                    if(isset($userBios[9])): //providerCareOneTime
                        $usersBiosSave->providerCareOneTime = $userBios[9];
                    endif;

                    if(isset($userBios[595])): //ChildSpecialNeeds
                        $usersBiosSave->ChildSpecialNeeds = $userBios[595];
                    endif;

                    if(isset($userBios[48])): //numnerOfchild
                        $usersBiosSave->numnerOfchild = $userBios[48];
                    endif;
                    if(isset($userBios[196])): //childAge
                        $usersBiosSave->childAge = $userBios[196];
                    endif;
                    if(isset($userBios[78])): //providerExperience
                        $usersBiosSave->providerExperience = $userBios[78];
                    endif;
                    if(isset($userBios[85])): //ChildSpecialNeeds
                        $usersBiosSave->ChildSpecialNeeds = $userBios[85];
                    elseif(isset($userBios[86])):
                        $usersBiosSave->ChildSpecialNeeds = $userBios[86];
                    endif;
                    if(isset($userBios[116])): //special needs that prospective families should be aware of
                        $usersBiosSave->SpecialNeedsExtra = $userBios[116];
                    elseif(isset($userBios[115])):
                        $usersBiosSave->SpecialNeedsExtra = $userBios[115];
                    endif;                
                    if(isset($userBios[169])): //providerSpeaksLanguages
                        $usersBiosSave->providerSpeaksLanguages = $userBios[169];
                    endif;
                    if(isset($userBios[172])): //parentsNeedsLanguages
                        $usersBiosSave->parentsNeedsLanguages = $userBios[172];
                    endif;
                    if(isset($userBios[294])): //providerSpeaksLanguages
                        $usersBiosSave->providerDrives = $userBios[294];
                    endif;
                    if(isset($userBios[938])): //providerSpeaksLanguages
                        $usersBiosSave->availability = $userBios[938];
                    endif;
                    $usersBiosSave->save();
                endif;
            endforeach;
            return response()->json([
                'dataimport' => 'Data import successfully.'
            ]);           
        elseif($optionType=='usersSubscribersPlans'):
            // get wordpress user subscribers_plans
                $usersBuyMemberships = json_decode(file_get_contents('http://nannyparentconnection.com/wp-json/wp/v2/get-users-membership'), true);
                foreach($usersBuyMemberships['usersMembershipPlans'] as $getdata):
                    $checkUserExit = subscribersPlans::where('id',$getdata['id'])->count();
                    if($checkUserExit>0):
                    else:
                        if($getdata['user_id']!=0):
                            $userDetails = User::where('id',$getdata['user_id'])->first();
                            $savedata = new subscribersPlans;
                            $savedata->id = $getdata['id'];
                            $savedata->user_id = $getdata['user_id'];
                            $savedata->product_id = $getdata['product_id'];
                            $savedata->coupon_id = $getdata['coupon_id'];
                            $savedata->subscr_id = $getdata['subscr_id'];
                            $savedata->price = $getdata['price'];
                            $savedata->total = $getdata['total'];
                            $savedata->tax_amount = $getdata['tax_amount'];
                            $savedata->tax_rate = $getdata['tax_rate'];
                            $savedata->tax_desc = $getdata['tax_desc'];
                            $savedata->tax_compound = $getdata['tax_compound'];
                            $savedata->tax_shipping = $getdata['tax_shipping'];
                            $savedata->tax_class = $getdata['tax_class'];
                            $savedata->gateway = $getdata['gateway'];
                            $savedata->period = $getdata['period'];
                            $savedata->period_type = $getdata['period_type'];
                            $savedata->limit_cycles = $getdata['limit_cycles'];
                            $savedata->limit_cycles_num = $getdata['limit_cycles_num'];
                            $savedata->limit_cycles_action = $getdata['limit_cycles_action'];
                            $savedata->prorated_trial = $getdata['prorated_trial'];
                            $savedata->trial = $getdata['trial'];
                            $savedata->trial_days = $getdata['trial_days'];
                            $savedata->trial_amount = $getdata['trial_amount'];
                            $savedata->status = $getdata['status'];
                            $savedata->cc_last4 = $getdata['cc_last4'];
                            $savedata->cc_exp_month = $getdata['cc_exp_month'];
                            $savedata->cc_exp_year = $getdata['cc_exp_year'];
                            $savedata->token = $getdata['token'];
                            $savedata->response = $getdata['response'];
                            $savedata->limit_cycles_expires_after = $getdata['limit_cycles_expires_after'];
                            $savedata->limit_cycles_expires_type = $getdata['limit_cycles_expires_type'];
                            $savedata->trial_tax_amount = $getdata['trial_tax_amount'];
                            $savedata->trial_total = $getdata['trial_total'];                    
                            $savedata->buy_data_time = strtotime($getdata['created_at']);
                            $savedata->created_at = $getdata['created_at'];
                            $savedata->save();
                        endif;  
                    endif;      
                endforeach;
            // End get wordpress user subscribers_plans
            // Get wordpress user subscribers transactions
                $subscribers_transactions = json_decode(file_get_contents('http://nannyparentconnection.com/wp-json/wp/v2/get-subscriptions-transactions'), true);
                foreach($subscribers_transactions['subscriptions_transactions'] as $getdatas):
                    $checkUserExits = SubscriptionsTransactions::where('id',$getdatas['id'])->count();
                    if($checkUserExits>0):
                    else:
                        $TransactionsSaveData = new SubscriptionsTransactions;
                        $TransactionsSaveData->id = $getdatas['id'];
                        $TransactionsSaveData->user_id = $getdatas['user_id'];
                        $TransactionsSaveData->product_id = $getdatas['product_id'];
                        $TransactionsSaveData->subscription_id = $getdatas['subscription_id'];
                        $TransactionsSaveData->amount = $getdatas['amount'];
                        $TransactionsSaveData->total = $getdatas['total'];
                        $TransactionsSaveData->tax_amount = $getdatas['tax_amount'];
                        $TransactionsSaveData->tax_rate = $getdatas['tax_rate'];
                        $TransactionsSaveData->tax_desc = $getdatas['tax_desc'];
                        $TransactionsSaveData->tax_compound = $getdatas['tax_compound'];
                        $TransactionsSaveData->tax_shipping = $getdatas['tax_shipping'];
                        $TransactionsSaveData->tax_class = $getdatas['tax_class'];           
                        $TransactionsSaveData->coupon_id = $getdatas['coupon_id'];
                        $TransactionsSaveData->trans_num = $getdatas['trans_num'];
                        $TransactionsSaveData->status = $getdatas['status'];
                        $TransactionsSaveData->txn_type = $getdatas['txn_type'];
                        $TransactionsSaveData->gateway = $getdatas['gateway'];            
                        $TransactionsSaveData->prorated = $getdatas['prorated'];
                        $TransactionsSaveData->created_at = $getdatas['created_at'];
                        $TransactionsSaveData->updated_at = $getdatas['expires_at'];
                        $TransactionsSaveData->corporate_account_id = $getdatas['corporate_account_id'];
                        $TransactionsSaveData->parent_transaction_id = $getdatas['parent_transaction_id'];
                        $TransactionsSaveData->response = $getdatas['response'];
                        $TransactionsSaveData->save();
                    endif;
                endforeach;
            // End Get wordpress user subscribers transactions
            return response()->json([
                'dataimport' => 'Data import successfully.'
            ]);
        elseif($optionType=='MembsersFriendsList'):
            // Get Wordpress Membsers Friends List
                $members_friendsList = json_decode(file_get_contents('http://nannyparentconnection.com/wp-json/wp/v2/get-membsers-friends-list'), true);    
                foreach($members_friendsList['members_friendsList'] as $getfriendslist):
                    $check_ids = MemberFriends::where('id',$getfriendslist['id'])->count();
                    if($check_ids>0):
                    else:
                        $saveFriends = new MemberFriends;
                        $saveFriends->id = $getfriendslist['id'];
                        $saveFriends->senderUserID = $getfriendslist['initiator_user_id'];
                        $saveFriends->requestSendTo = $getfriendslist['friend_user_id'];
                        if($getfriendslist['is_confirmed']=='1'):
                            $saveFriends->requestStatus = 'confirm';
                        else:
                            $saveFriends->requestStatus = 'pending';
                        endif;
                        $saveFriends->created_at = $getfriendslist['date_created'];
                        $saveFriends->updated_at = $getfriendslist['date_created'];
                        $saveFriends->save();
                    endif;
                endforeach;
            // End Get Wordpress Membsers Friends List
            return response()->json([
                'dataimport' => 'Data import successfully.'
            ]);
        elseif($optionType=='MembsersPrivateMessages'):
            // get wordpress user Private Messages API
                $members_private_messages = json_decode(file_get_contents('http://nannyparentconnection.com/wp-json/wp/v2/get-membsers-chats'), true); 
                foreach($members_private_messages['members_chats'] as $privateMessages):
                    $check_messages = PrivateMessage::where('id',$privateMessages['id'])->count();
                    if($check_messages>0):
                    else:
                        $savePrivateMessage = new PrivateMessage;
                        $savePrivateMessage->id = $privateMessages['id'];
                        $savePrivateMessage->thread_id = $privateMessages['thread_id'];
                        $savePrivateMessage->sender_id = $privateMessages['sender_id'];
                        $savePrivateMessage->subject = $privateMessages['subject'];
                        $savePrivateMessage->message = $privateMessages['message'];
                        $savePrivateMessage->created_at = $privateMessages['date_sent'];
                        $savePrivateMessage->updated_at = $privateMessages['date_sent'];
                        $savePrivateMessage->save();
                    endif;                
                endforeach;
            // get wordpress user Private Messages API

            // get wordpress user Private Messages Recipients API
                $members_private_messages_recipients = json_decode(file_get_contents('http://nannyparentconnection.com/wp-json/wp/v2/get-membsers-private-messages-recipients'), true); 
                foreach($members_private_messages_recipients['members_private_messages_recipients'] as $privateMessagesRecipients):
                    $check_messages_Recipients = PrivateMessageRecipients::where('id',$privateMessagesRecipients['id'])->count();
                    if($check_messages_Recipients>0):
                    else:
                        $savePrivateMessageRecipients = new PrivateMessageRecipients;
                        $savePrivateMessageRecipients->id = $privateMessagesRecipients['id'];
                        $savePrivateMessageRecipients->user_id = $privateMessagesRecipients['user_id'];
                        $savePrivateMessageRecipients->thread_id = $privateMessagesRecipients['thread_id'];                    
                        $savePrivateMessageRecipients->unread_count = $privateMessagesRecipients['unread_count'];
                        $savePrivateMessageRecipients->sender_only = $privateMessagesRecipients['sender_only'];
                        $savePrivateMessageRecipients->is_deleted = $privateMessagesRecipients['is_deleted'];
                        $savePrivateMessageRecipients->save();
                    endif;                
                endforeach;
            // get wordpress user Private Messages Recipients API
            return response()->json([
                'dataimport' => 'Data import successfully.'
            ]);
        elseif($optionType=='memberReviews'):
            // Get Wordpress User Reviews API
                $wpAllMemberReview = json_decode(file_get_contents('http://nannyparentconnection.com/wp-json/wp/v2/get-member-reviews'), true);
                foreach($wpAllMemberReview as $key => $memberReviewData):
                    $checkReview = MemberReview::where('id',$memberReviewData['ID'])->count();
                        $rating = unserialize($memberReviewData['reviewsMeta']['profile_star_rating'][0]);
                        $rating['Please Rate Your Connection/Interaction With This Member:'];
                        if($checkReview>0):
                        else:
                            $saveReviewData = new MemberReview;
                            $saveReviewData->id = $memberReviewData['ID'];
                            $saveReviewData->reviewFromuser = $memberReviewData['post_author'];
                            $saveReviewData->reviewToUser = $memberReviewData['reviewsMeta']['linked_bp_member'][0];            
                            $saveReviewData->review = $memberReviewData['post_content'];
                            $saveReviewData->rating = $rating['Please Rate Your Connection/Interaction With This Member:'];
                            $saveReviewData->reviewstatus = $memberReviewData['post_status'];
                            $saveReviewData->created_at = $memberReviewData['post_date'];
                            $saveReviewData->updated_at = $memberReviewData['post_date_gmt'];
                            $saveReviewData->save();
                        endif;
                endforeach;
            // End Wordpress User Reviews API
            return response()->json([
                'dataimport' => 'Data import successfully.'
            ]);
        else:
        endif;
    }

    public function membershipsReports(Request $request)
    {
        $input = Request::all();
        if(empty($input)){
            $activeMembers = subscribersPlans::where('status','active')->count();
            $inActiveMembers = subscribersPlans::where('status','cancelled')->count();
            $totalMembers = User::where('role','user')->count();
            $freeMembers = subscribersPlans::join('memberships', 'subscribers_plans.product_id', '=', 'memberships.id')
                            ->where('memberships.mepr_product_price', '=', '0.00')
                            ->count();
            $paidMembers = subscribersPlans::join('memberships', 'subscribers_plans.product_id', '=', 'memberships.id')
                            ->where('memberships.mepr_product_price', '!=', '0.00')
                            ->count();

            $memberships = Membership::pluck('post_title', 'id');

            $userMembershipGraph = DB::table('subscribers_plans')
                            ->join('memberships', 'subscribers_plans.product_id', '=', 'memberships.id')
                            ->select('memberships.post_title', 'memberships.mepr_product_price',  DB::raw("count(subscribers_plans.id) as count"))
                            ->where(DB::raw('DATE_FORMAT(subscribers_plans.created_at, "%Y-%m")'), '=', date('Y-m'))
                            ->groupBy('memberships.post_title')
                            ->pluck('count', 'post_title');

            $transactionStatus = DB::select("SELECT SUM(amount) collect, SUM(CASE WHEN status != 'refunded' THEN total ELSE 0 END) net_amount, SUM(tax_amount) tax, COUNT(CASE WHEN status = 'pending' THEN 1 END) AS pending, COUNT(CASE WHEN status = 'failed' THEN status END) AS failed, COUNT(CASE WHEN status = 'complete' THEN 1 END) AS complete, COUNT(CASE WHEN status = 'refunded' THEN 1 END) AS refunded, SUM(CASE WHEN status = 'refunded' THEN amount ELSE 0 END) refund_amount FROM `subscriptions_transactions` WHERE DATE_FORMAT(created_at, '%Y-%m') = '".date('Y-m')."' AND status != 'confirmed' GROUP BY DATE_FORMAT(created_at, '%Y-%m')");

            $currentMonthRecord = DB::select("SELECT DATE_FORMAT(created_at, '%M %d, %Y') date, SUM(amount) collect, SUM(CASE WHEN status != 'refunded' THEN total ELSE 0 END) net_amount, SUM(tax_amount) tax, COUNT(CASE WHEN status = 'pending' THEN 1 END) AS pending, COUNT(CASE WHEN status = 'failed' THEN status END) AS failed, COUNT(CASE WHEN status = 'complete' THEN 1 END) AS complete, COUNT(CASE WHEN status = 'refunded' THEN 1 END) AS refunded, SUM(CASE WHEN status = 'refunded' THEN amount ELSE 0 END) refund_amount FROM `subscriptions_transactions` WHERE DATE_FORMAT(created_at, '%Y-%m') = '".date('Y-m')."' AND status != 'confirmed' GROUP BY DATE_FORMAT(created_at, '%Y-%m %d')");

            return view('admin.memberships.reports',compact('activeMembers', 'inActiveMembers', 'totalMembers', 'freeMembers', 'paidMembers', 'userMembershipGraph', 'currentMonthRecord', 'transactionStatus', 'memberships'));
        }else{
            if($input['id']== 'month-tab'){

                $userMembershipGraph = DB::table('subscribers_plans')
                            ->join('memberships', 'subscribers_plans.product_id', '=', 'memberships.id')
                            ->select('memberships.post_title', 'memberships.mepr_product_price',  DB::raw("count(subscribers_plans.id) as count"))
                            ->where(DB::raw('DATE_FORMAT(subscribers_plans.created_at, "%Y-%m")'), '=', date('Y-m'))
                            ->groupBy('memberships.post_title')
                            ->pluck('count', 'post_title');

                $transactionStatus = DB::select("SELECT SUM(amount) collect, SUM(CASE WHEN status != 'refunded' THEN total ELSE 0 END) net_amount, SUM(tax_amount) tax, COUNT(CASE WHEN status = 'pending' THEN 1 END) AS pending, COUNT(CASE WHEN status = 'failed' THEN status END) AS failed, COUNT(CASE WHEN status = 'complete' THEN 1 END) AS complete, COUNT(CASE WHEN status = 'refunded' THEN 1 END) AS refunded, SUM(CASE WHEN status = 'refunded' THEN amount ELSE 0 END) refund_amount FROM `subscriptions_transactions` WHERE DATE_FORMAT(created_at, '%Y-%m') = '".date('Y-m')."' AND status != 'confirmed' GROUP BY DATE_FORMAT(created_at, '%Y-%m')");

                $currentRecord = DB::select("SELECT DATE_FORMAT(created_at, '%M %d, %Y') date, SUM(amount) collect, SUM(CASE WHEN status != 'refunded' THEN total ELSE 0 END) net_amount, SUM(tax_amount) tax, COUNT(CASE WHEN status = 'pending' THEN 1 END) AS pending, COUNT(CASE WHEN status = 'failed' THEN status END) AS failed, COUNT(CASE WHEN status = 'complete' THEN 1 END) AS complete, COUNT(CASE WHEN status = 'refunded' THEN 1 END) AS refunded, SUM(CASE WHEN status = 'refunded' THEN amount ELSE 0 END) refund_amount FROM `subscriptions_transactions` WHERE DATE_FORMAT(created_at, '%Y-%m') = '".date('Y-m')."' AND status != 'confirmed' GROUP BY DATE_FORMAT(created_at, '%Y-%m %d')");

                return response()->json([
                    'data' => array('userMembershipGraph' => $userMembershipGraph, 'transactionStatus'=>$transactionStatus, 'currentRecord' =>$currentRecord)
                ]);
            }else if($input['id']== 'year-tab'){
                $userMembershipGraph = DB::table('subscribers_plans')
                            ->join('memberships', 'subscribers_plans.product_id', '=', 'memberships.id')
                            ->select('memberships.post_title', 'memberships.mepr_product_price',  DB::raw("count(subscribers_plans.id) as count"))
                            ->where(DB::raw('DATE_FORMAT(subscribers_plans.created_at, "%Y")'), '=', date('Y'))
                            ->groupBy('memberships.post_title')
                            ->pluck('count', 'post_title');

                $transactionStatus = DB::select("SELECT SUM(amount) collect, SUM(CASE WHEN status != 'refunded' THEN total ELSE 0 END) net_amount, SUM(tax_amount) tax, COUNT(CASE WHEN status = 'pending' THEN 1 END) AS pending, COUNT(CASE WHEN status = 'failed' THEN status END) AS failed, COUNT(CASE WHEN status = 'complete' THEN 1 END) AS complete, COUNT(CASE WHEN status = 'refunded' THEN 1 END) AS refunded, SUM(CASE WHEN status = 'refunded' THEN amount ELSE 0 END) refund_amount FROM `subscriptions_transactions` WHERE DATE_FORMAT(created_at, '%Y') = '".date('Y')."' AND status != 'confirmed' GROUP BY DATE_FORMAT(created_at, '%Y')");

                $currentRecord = DB::select("SELECT DATE_FORMAT(created_at, '%M 1, %Y') date, SUM(amount) collect, SUM(CASE WHEN status != 'refunded' THEN total ELSE 0 END) net_amount, SUM(tax_amount) tax, COUNT(CASE WHEN status = 'pending' THEN 1 END) AS pending, COUNT(CASE WHEN status = 'failed' THEN status END) AS failed, COUNT(CASE WHEN status = 'complete' THEN 1 END) AS complete, COUNT(CASE WHEN status = 'refunded' THEN 1 END) AS refunded, SUM(CASE WHEN status = 'refunded' THEN amount ELSE 0 END) refund_amount FROM `subscriptions_transactions` WHERE DATE_FORMAT(created_at, '%Y') = '".date('Y')."' AND status != 'confirmed' GROUP BY DATE_FORMAT(created_at, '%Y-%m')");

                return response()->json([
                    'data' => array('userMembershipGraph' => $userMembershipGraph, 'transactionStatus'=>$transactionStatus, 'currentRecord' =>$currentRecord)
                ]);
            }else if($input['id']== 'all-tab'){
                $userMembershipGraph = DB::table('subscribers_plans')
                ->join('memberships', 'subscribers_plans.product_id', '=', 'memberships.id')
                ->select('memberships.post_title', 'memberships.mepr_product_price',  DB::raw("count(subscribers_plans.id) as count"))
                ->groupBy('memberships.post_title')
                ->pluck('count', 'post_title');

                $transactionStatus = DB::select("SELECT SUM(amount) collect, SUM(CASE WHEN status != 'refunded' THEN total ELSE 0 END) net_amount, SUM(tax_amount) tax, COUNT(CASE WHEN status = 'pending' THEN 1 END) AS pending, COUNT(CASE WHEN status = 'failed' THEN status END) AS failed, COUNT(CASE WHEN status = 'complete' THEN 1 END) AS complete, COUNT(CASE WHEN status = 'refunded' THEN 1 END) AS refunded, SUM(CASE WHEN status = 'refunded' THEN amount ELSE 0 END) refund_amount FROM `subscriptions_transactions`");

                return response()->json([
                    'data' => array('userMembershipGraph' => $userMembershipGraph, 'transactionStatus'=>$transactionStatus)
                ]);
            }
        }
    }



    public function membershipsReportFilter(Request $request)
    {
        $input = Request::all();
        if($input['id'] == 'month-tab'){
            $date = $input['year'].'-0'.$input['month'];
            if($input['membershipId'] == ''){
                $whr = "";
                $userMembershipGraph = DB::table('subscribers_plans')
                ->join('memberships', 'subscribers_plans.product_id', '=', 'memberships.id')
                ->select('memberships.post_title', 'memberships.mepr_product_price',  DB::raw("count(subscribers_plans.id) as count"))
                ->where(DB::raw('DATE_FORMAT(subscribers_plans.created_at, "%Y-%m")'), '=', $date)
                ->groupBy('memberships.post_title')
                ->pluck('count', 'post_title');
            }else{
                $whr = " AND product_id = '".$input['membershipId']."'";
                $userMembershipGraph = array();
            }

            $transactionStatus = DB::select("SELECT SUM(amount) collect, SUM(CASE WHEN status != 'refunded' THEN total ELSE 0 END) net_amount, SUM(tax_amount) tax, COUNT(CASE WHEN status = 'pending' THEN 1 END) AS pending, COUNT(CASE WHEN status = 'failed' THEN status END) AS failed, COUNT(CASE WHEN status = 'complete' THEN 1 END) AS complete, COUNT(CASE WHEN status = 'refunded' THEN 1 END) AS refunded, SUM(CASE WHEN status = 'refunded' THEN amount ELSE 0 END) refund_amount FROM `subscriptions_transactions` WHERE DATE_FORMAT(created_at, '%Y-%m') = '".$date."' AND status != 'confirmed' ".$whr." GROUP BY DATE_FORMAT(created_at, '%Y-%m')");

            $currentRecord = DB::select("SELECT DATE_FORMAT(created_at, '%M %d, %Y') date, SUM(amount) collect, SUM(CASE WHEN status != 'refunded' THEN total ELSE 0 END) net_amount, SUM(tax_amount) tax, COUNT(CASE WHEN status = 'pending' THEN 1 END) AS pending, COUNT(CASE WHEN status = 'failed' THEN status END) AS failed, COUNT(CASE WHEN status = 'complete' THEN 1 END) AS complete, COUNT(CASE WHEN status = 'refunded' THEN 1 END) AS refunded, SUM(CASE WHEN status = 'refunded' THEN amount ELSE 0 END) refund_amount FROM `subscriptions_transactions` WHERE DATE_FORMAT(created_at, '%Y-%m') = '".$date."' AND status != 'confirmed' ".$whr." GROUP BY DATE_FORMAT(created_at, '%Y-%m %d')");

            return response()->json([
                'data' => array('userMembershipGraph' => $userMembershipGraph, 'transactionStatus'=>$transactionStatus, 'currentRecord' =>$currentRecord)
            ]);
        }else if($input['id']== 'year-tab'){
            $date = $input['year'];
            if($input['membershipId'] == ''){
                $whr = "";
                $userMembershipGraph = DB::table('subscribers_plans')
                        ->join('memberships', 'subscribers_plans.product_id', '=', 'memberships.id')
                        ->select('memberships.post_title', 'memberships.mepr_product_price',  DB::raw("count(subscribers_plans.id) as count"))
                        ->where(DB::raw('DATE_FORMAT(subscribers_plans.created_at, "%Y")'), '=', $date)
                        ->groupBy('memberships.post_title')
                        ->pluck('count', 'post_title');
            }else{
                $whr = " AND product_id = '".$input['membershipId']."'";
                $userMembershipGraph = array();
            }

            $transactionStatus = DB::select("SELECT SUM(amount) collect, SUM(CASE WHEN status != 'refunded' THEN total ELSE 0 END) net_amount, SUM(tax_amount) tax, COUNT(CASE WHEN status = 'pending' THEN 1 END) AS pending, COUNT(CASE WHEN status = 'failed' THEN status END) AS failed, COUNT(CASE WHEN status = 'complete' THEN 1 END) AS complete, COUNT(CASE WHEN status = 'refunded' THEN 1 END) AS refunded, SUM(CASE WHEN status = 'refunded' THEN amount ELSE 0 END) refund_amount FROM `subscriptions_transactions` WHERE DATE_FORMAT(created_at, '%Y') = '".$date."' AND status != 'confirmed' ".$whr." GROUP BY DATE_FORMAT(created_at, '%Y')");

            $currentRecord = DB::select("SELECT DATE_FORMAT(created_at, '%M 1, %Y') date, SUM(amount) collect, SUM(CASE WHEN status != 'refunded' THEN total ELSE 0 END) net_amount, SUM(tax_amount) tax, COUNT(CASE WHEN status = 'pending' THEN 1 END) AS pending, COUNT(CASE WHEN status = 'failed' THEN status END) AS failed, COUNT(CASE WHEN status = 'complete' THEN 1 END) AS complete, COUNT(CASE WHEN status = 'refunded' THEN 1 END) AS refunded, SUM(CASE WHEN status = 'refunded' THEN amount ELSE 0 END) refund_amount FROM `subscriptions_transactions` WHERE DATE_FORMAT(created_at, '%Y') = '".$date."' AND status != 'confirmed' ".$whr." GROUP BY DATE_FORMAT(created_at, '%Y-%m')");

            return response()->json([
                'data' => array('userMembershipGraph' => $userMembershipGraph, 'transactionStatus'=>$transactionStatus, 'currentRecord' =>$currentRecord)
            ]);
        }else if($input['id']== 'all-tab'){

            if($input['membershipId'] == ''){
                $whr = "";
                $userMembershipGraph = DB::table('subscribers_plans')
                    ->join('memberships', 'subscribers_plans.product_id', '=', 'memberships.id')
                    ->select('memberships.post_title', 'memberships.mepr_product_price',  DB::raw("count(subscribers_plans.id) as count"))
                    ->groupBy('memberships.post_title')
                    ->pluck('count', 'post_title');
            }else{
                $whr = " WHERE product_id = '".$input['membershipId']."'";
                $userMembershipGraph = array();
            }

            $transactionStatus = DB::select("SELECT SUM(amount) collect, SUM(CASE WHEN status != 'refunded' THEN total ELSE 0 END) net_amount, SUM(tax_amount) tax, COUNT(CASE WHEN status = 'pending' THEN 1 END) AS pending, COUNT(CASE WHEN status = 'failed' THEN status END) AS failed, COUNT(CASE WHEN status = 'complete' THEN 1 END) AS complete, COUNT(CASE WHEN status = 'refunded' THEN 1 END) AS refunded, SUM(CASE WHEN status = 'refunded' THEN amount ELSE 0 END) refund_amount FROM `subscriptions_transactions` ".$whr." ");

            return response()->json([
                'data' => array('userMembershipGraph' => $userMembershipGraph, 'transactionStatus'=>$transactionStatus)
            ]);
        }

    }

    public function transactions()
    {        
        $transactions = SubscriptionsTransactions::orderBy('id','DESC')->paginate(30);
        return view('admin.Transactions.transactions',compact('transactions'));
    }

    public function AddNewTransaction()
    {
        $time_date_now = Carbon::now();
        $default_time = Carbon::now()->addMonth(6);        
        $n =6;
        $trans_num = 'mp-txn-'.bin2hex(random_bytes($n));
        $memberships = Membership::orderBy('id','DESC')->get();
        return view('admin.Transactions.add-new-transaction',compact('trans_num','memberships','time_date_now','default_time'));
    }

    public function findUsername(Request $request)
    {
        $input = Request::all();
        $userdatas = User::where('username','LIKE','%'.$input['username'].'%')->get();          
        $output = '<ul class="list-group">';
        foreach($userdatas as $userdata):
            $output .= '<li class="list-group-item clickUsername">'.$userdata->username.'</li>';
        endforeach;
        $output .= '</ul>';
        return response()->json([
            'userData' => $output
        ]);
    }

    public function saveManualTransaction(Request $request)
    {
        $input = Request::all();
        $data =  Request::except(array('_token')) ;
        $rule=array(
            'trans_num' => 'required',
            'username' => 'required',
            'sub_total' => 'required',
            'tax_amount' => 'required',
            'status' => 'required',
            'gateway' => 'required'
           );
        $validator = \Validator::make($data,$rule);
        if ($validator->fails())
        {
            return redirect()->back()->withInput()->withErrors($validator->messages());
        }
        $user = User::where('username',$input['username'])->count(); 
        if($user>0):  
            $userData = User::where('username',$input['username'])->first();            
            $findMemberShipInfo = Membership::where('id',$input['product_id'])->first();
            $n =6;
            $trans_num = 'mp-sub-'.bin2hex(random_bytes($n));
            $findSubcription = new subscribersPlans;
            $findSubcription->user_id = $userData->id;
            $findSubcription->product_id = $findMemberShipInfo->id;
            $findSubcription->subscr_id = $trans_num;            
            $findSubcription->coupon_id = '0';
            $findSubcription->tax_amount = $input['tax_amount'];
            $findSubcription->tax_rate = $input['tax_rate'];
            $findSubcription->tax_compound = '0';
            $findSubcription->tax_shipping = '1';
            $findSubcription->tax_class = 'standard';
            $findSubcription->price = $input['sub_total'];
            $findSubcription->total = $input['sub_total'];
            $findSubcription->gateway = $input['gateway'];                        
            $findSubcription->period_type = $findMemberShipInfo->mepr_product_period;     
            $findSubcription->status = 'active';
            $findSubcription->created_at = $input['created_at'];
            $findSubcription->save();
            
            $saveTrans = new SubscriptionsTransactions;
            $saveTrans->user_id = $userData->id;
            $saveTrans->product_id = $input['product_id'];
            if(!empty($input['subscription_id'])):
                $saveTrans->subscription_id = $input['subscription_id'];
            else:
                $saveTrans->subscription_id = $findSubcription->id;
            endif;
            $saveTrans->amount = $input['sub_total'];
            $saveTrans->total = $input['sub_total'];
            $saveTrans->tax_amount = $input['tax_amount'];
            $saveTrans->tax_rate = $input['tax_rate'];
            $saveTrans->trans_num = $input['trans_num'];
            $saveTrans->status = $input['status'];
            $saveTrans->txn_type = 'payment';
            $saveTrans->gateway = $input['gateway'];
            $saveTrans->created_at = $input['created_at'];
            if(empty($input['updated_at'])):
                $saveTrans->updated_at = '0000-00-00 00:00:00';
            else: 
                $saveTrans->updated_at = $input['updated_at'];              
            endif;
            $saveTrans->save();            
            return redirect()->back()->with('success', 'Transaction save successfully.');
        else:
            return redirect()->back()->withInput()->withErrors($input['username']);
        endif;
    }

    public function EditTransaction($id)
    {
        $TransactionDetail = SubscriptionsTransactions::where('id',$id)->first();
        if($TransactionDetail):            
            $time_date_now = Carbon::now();
            $default_time = Carbon::now()->addMonth(6);
            $n =6;
            $trans_num = 'mp-txn-'.bin2hex(random_bytes($n));
            $userData = User::where('id',$TransactionDetail->user_id)->first();
            $memberships = Membership::orderBy('id','DESC')->get();
            return view('admin.Transactions.edit-transaction',compact('trans_num','TransactionDetail','userData','memberships','time_date_now','default_time'));
        else:
            return redirect('/superadmin/transactions');
        endif;
    }

    public function updateManualTransaction(Request $request)
    {
        $input = Request::all();
        $data =  Request::except(array('_token')) ;
        $rule=array(
            'username' => 'required',
            'sub_total' => 'required',
            'tax_amount' => 'required',
            'status' => 'required',
            'gateway' => 'required'
           );
        $validator = \Validator::make($data,$rule);
        if ($validator->fails())
        {
            return redirect()->back()->withInput()->withErrors($validator->messages());
        }

        $updateTransaction = SubscriptionsTransactions::where('id',$input['id'])->first();
        $userData = User::where('username',$input['username'])->first();
        
        $findMemberShipInfo = Membership::where('id',$input['product_id'])->first();
        $n =6;
        $trans_num = 'mp-sub-'.bin2hex(random_bytes($n));
        $findSubcription = subscribersPlans::where('id',$input['subscription_id'])->first();
        $findSubcription->user_id = $updateTransaction->user_id;
        $findSubcription->product_id = $findMemberShipInfo->id;
        if(empty($findSubcription->subscr_id)):
            $findSubcription->subscr_id = $trans_num; 
        endif;           
        $findSubcription->coupon_id = '0';
        $findSubcription->tax_amount = $input['tax_amount'];
        $findSubcription->tax_rate = $input['tax_rate'];
        $findSubcription->tax_compound = '0';
        $findSubcription->tax_shipping = '1';
        $findSubcription->tax_class = 'standard';
        $findSubcription->price = $input['sub_total'];
        $findSubcription->total = $input['sub_total'];
        $findSubcription->gateway = $input['gateway'];                        
        $findSubcription->period_type = $findMemberShipInfo->mepr_product_period;     
        $findSubcription->status = 'active';
        $findSubcription->created_at = $input['created_at'];
        $findSubcription->save();        

        $updateTransaction->user_id = $userData->id;
        $updateTransaction->product_id = $input['product_id'];
        if(!empty($input['subscription_id'])):
            $updateTransaction->subscription_id = $input['subscription_id'];
        else:
            $updateTransaction->subscription_id = $findSubcription->id;
        endif;
        $updateTransaction->amount = $input['sub_total'];
        $updateTransaction->total = $input['sub_total'];
        $updateTransaction->tax_amount = $input['tax_amount'];
        $updateTransaction->tax_rate = $input['tax_rate'];
        $updateTransaction->status = $input['status'];
        $updateTransaction->txn_type = 'payment';
        $updateTransaction->gateway = $input['gateway'];
        $updateTransaction->created_at = $input['created_at'];
        // if(empty($input['updated_at'])):
        //     $updateTransaction->updated_at = '0000-00-00 00:00:00';
        // else: 
        //     $updateTransaction->updated_at = $input['updated_at'];              
        // endif;
        $updateTransaction->save();            
        return redirect()->back()->with('success', 'Transaction update successfully.');
    }

    public function deleteTransaction($id)
    {
        $check_tran = SubscriptionsTransactions::where('id',$id)->count();
        if($check_tran>0):
            $trans_info = SubscriptionsTransactions::where('id',$id)->first();
            SubscriptionsTransactions::where('id',$id)->delete();
            if($trans_info->subscription_id):
                subscribersPlans::where('id',$trans_info->subscription_id)->delete();
            endif;
        endif; 
        return redirect()->back()->with('deleteTransaction', 'Transaction delete successfully.');       
    }
    
}

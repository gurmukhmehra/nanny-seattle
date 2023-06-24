<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use File;
use Session;
use Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Request;
use Redirect;
use Illuminate\Support\Str;
use DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;
use App\Models\Membership;
use App\Models\subscribersPlans;
use App\Models\SubscriptionsTransactions;

class TestEmailController extends Controller
{
    protected $guard = 'admin';

    public function membershipsEmails()
    {
        return view('admin.TestEmails.memberships-emails');
    }

    public function SendTestMembershipsEmails()
    {        
        $inputs = Request::all();
        $optionType = decrypt($inputs['inputData']);                  
        if($optionType=='welcomeEmail'):
            $siteName = getcong('siteName');
            $siteEmail = getcong('siteEmail'); 
            $data = array(
                'user_first_name'=>'Admin Test',
                'siteName'=>$siteName,
                'siteEmail'=>$siteEmail
            );
            Mail::send('emails.register', $data, function ($message) use ($data) {
                $message->subject($data['siteName'].' Welcome!');
                $message->from('testing@gmail.com', $data['siteName']);
                $message->bcc('sudhirkundal007@gmail.com');         
                $message->to($data['siteEmail']);
            });
            return response()->json([
                'dataimport' => 'Test Email Send successfully.'
            ]); 
        elseif($optionType=='welcomeFamilyParentAnnual'):
            $siteName = getcong('siteName');
            $siteEmail = getcong('siteEmail'); 
            $buy_date = date('F j,Y');
            $data = array(
                'user_first_name'=>'Admin Test',
                'payment_amount'=>'10.00',
                'trans_date'=>$buy_date,
                'invoice_num'=>'120',
                'trans_num'=>'9i8h7g6f5e',
                'siteName'=>$siteName,
                'siteEmail'=>$siteEmail
            );
            Mail::send('emails.Welcome_emails.Family-Parent-Annual', $data, function ($message) use ($data) {
                $message->subject('Welcome to the '.$data['siteName'].'!');
                $message->from('testing@gmail.com', $data['siteName']);
                $message->bcc('sudhirkundal007@gmail.com');         
                $message->to($data['siteEmail']);
            });
            return response()->json([
                'dataimport' => 'Test Email Send successfully.'
            ]); 
        elseif($optionType=='welcomeFamilyParentMonthly'):
            $siteName = getcong('siteName');
            $siteEmail = getcong('siteEmail'); 
            $buy_date = date('F j,Y');
            $data = array(
                'user_first_name'=>'Admin Test',
                'payment_amount'=>'10.00',
                'trans_date'=>$buy_date,
                'invoice_num'=>'120',
                'trans_num'=>'9i8h7g6f5e',
                'siteName'=>$siteName,
                'siteEmail'=>$siteEmail
            );
            Mail::send('emails.Welcome_emails.Family-Parent-Monthly', $data, function ($message) use ($data) {
                $message->subject('Welcome to the '.$data['siteName'].'!');
                $message->from('testing@gmail.com', $data['siteName']);
                $message->bcc('sudhirkundal007@gmail.com');         
                $message->to($data['siteEmail']);
            });
            return response()->json([
                'dataimport' => 'Test Email Send successfully.'
            ]);
        elseif($optionType=='welcomeFamilyParentOneMonthOnly'):
            $siteName = getcong('siteName');
            $siteEmail = getcong('siteEmail'); 
            $buy_date = date('F j,Y');
            $data = array(
                'user_first_name'=>'Admin Test',
                'payment_amount'=>'10.00',
                'trans_date'=>$buy_date,
                'invoice_num'=>'120',
                'trans_num'=>'9i8h7g6f5e',
                'siteName'=>$siteName,
                'siteEmail'=>$siteEmail
            );
            Mail::send('emails.Welcome_emails.Family-Parent-One-Month-Only', $data, function ($message) use ($data) {
                $message->subject('Welcome to the '.$data['siteName'].'!');
                $message->from('testing@gmail.com', $data['siteName']);
                $message->bcc('sudhirkundal007@gmail.com');         
                $message->to($data['siteEmail']);
            });
            return response()->json([
                'dataimport' => 'Test Email Send successfully.'
            ]);
        elseif($optionType=='welcomeCareProviderAnnual'):
            $siteName = getcong('siteName');
            $siteEmail = getcong('siteEmail'); 
            $buy_date = date('F j,Y');
            $data = array(
                'user_first_name'=>'Admin Test',                
                'siteName'=>$siteName,
                'siteEmail'=>$siteEmail
            );
            Mail::send('emails.Welcome_emails.Care-Provider-Annual', $data, function ($message) use ($data) {
                $message->subject('Welcome to the '.$data['siteName'].'!');
                $message->from('testing@gmail.com', $data['siteName']);
                $message->bcc('sudhirkundal007@gmail.com');         
                $message->to($data['siteEmail']);
            });
            return response()->json([
                'dataimport' => 'Test Email Send successfully.'
            ]);
        elseif($optionType=='welcomeCareProviderMonthly'):
            $siteName = getcong('siteName');
            $siteEmail = getcong('siteEmail'); 
            $buy_date = date('F j,Y');
            $data = array(
                'user_first_name'=>'Admin Test',                
                'siteName'=>$siteName,
                'siteEmail'=>$siteEmail
            );
            Mail::send('emails.Welcome_emails.Care-Provider-Monthly', $data, function ($message) use ($data) {
                $message->subject('Welcome to the '.$data['siteName'].'!');
                $message->from('testing@gmail.com', $data['siteName']);
                $message->bcc('sudhirkundal007@gmail.com');         
                $message->to($data['siteEmail']);
            });
            return response()->json([
                'dataimport' => 'Test Email Send successfully.'
            ]);
        elseif($optionType=='welcomeAgenciesAnnual'):
            $siteName = getcong('siteName');
            $siteEmail = getcong('siteEmail'); 
            $buy_date = date('F j,Y');
            $data = array(
                'user_first_name'=>'Admin Test',
                'username'=>'Username',
                'payment_amount'=>'10.00',
                'trans_date'=>$buy_date,
                'invoice_num'=>'120',
                'trans_num'=>'9i8h7g6f5e',                
                'siteName'=>$siteName,
                'siteEmail'=>$siteEmail
            );
            Mail::send('emails.Welcome_emails.Agencies-Annual', $data, function ($message) use ($data) {
                $message->subject('Welcome to the '.$data['siteName'].'!');
                $message->from('testing@gmail.com', $data['siteName']);
                $message->bcc('sudhirkundal007@gmail.com');         
                $message->to($data['siteEmail']);
            });
            return response()->json([
                'dataimport' => 'Test Email Send successfully.'
            ]);
        elseif($optionType=='welcomeAgenciesMonthly'):
            $siteName = getcong('siteName');
            $siteEmail = getcong('siteEmail'); 
            $buy_date = date('F j,Y');
            $data = array(
                'user_first_name'=>'Admin Test',
                'username'=>'Username',
                'payment_amount'=>'10.00',
                'trans_date'=>$buy_date,
                'invoice_num'=>'120',
                'trans_num'=>'9i8h7g6f5e',                
                'siteName'=>$siteName,
                'siteEmail'=>$siteEmail
            );
            Mail::send('emails.Welcome_emails.Agencies-Monthly', $data, function ($message) use ($data) {
                $message->subject('Welcome to the '.$data['siteName'].'!');
                $message->from('testing@gmail.com', $data['siteName']);
                $message->bcc('sudhirkundal007@gmail.com');         
                $message->to($data['siteEmail']);
            });
            return response()->json([
                'dataimport' => 'Test Email Send successfully.'
            ]);
        elseif($optionType=='welcomeAgenciesOneMonthOnly'):
            $siteName = getcong('siteName');
            $siteEmail = getcong('siteEmail'); 
            $buy_date = date('F j,Y');
            $data = array(
                'user_first_name'=>'Admin Test',
                'username'=>'Username',
                'payment_amount'=>'10.00',
                'trans_date'=>$buy_date,
                'invoice_num'=>'120',
                'trans_num'=>'9i8h7g6f5e',                
                'siteName'=>$siteName,
                'siteEmail'=>$siteEmail
            );
            Mail::send('emails.Welcome_emails.Agencies-One-Month-Only', $data, function ($message) use ($data) {
                $message->subject('Welcome to the '.$data['siteName'].'!');
                $message->from('testing@gmail.com', $data['siteName']);
                $message->bcc('sudhirkundal007@gmail.com');         
                $message->to($data['siteEmail']);
            });
            return response()->json([
                'dataimport' => 'Test Email Send successfully.'
            ]);
        elseif($optionType=='welcomeNannyShareContract'):
            $siteName = getcong('siteName');
            $siteEmail = getcong('siteEmail'); 
            $buy_date = date('F j,Y');
            $data = array(
                'user_first_name'=>'Admin Test',
                'username'=>'Username',
                'payment_amount'=>'10.00',
                'trans_date'=>$buy_date,
                'invoice_num'=>'120',
                'trans_num'=>'9i8h7g6f5e',                
                'siteName'=>$siteName,
                'siteEmail'=>$siteEmail
            );
            Mail::send('emails.Welcome_emails.nanny-share-contract', $data, function ($message) use ($data) {
                $message->subject('Your Contract Purchase is Complete!');
                $message->from('testing@gmail.com', $data['siteName']);
                $message->bcc('sudhirkundal007@gmail.com');         
                $message->to($data['siteEmail']);
            });
            return response()->json([
                'dataimport' => 'Test Email Send successfully.'
            ]);
        elseif($optionType=='newMembership'):
            $siteName = getcong('siteName');
            $siteEmail = getcong('siteEmail'); 
            $data = array(
                'siteName'=>$siteName,
                'siteEmail'=>$siteEmail,
                'name'=>'Test User',
                'email'=>'testUser@yourdomain.com',
                'membership'=>'Family/Parent - Monthly',
                'membership_price'=>'9.99',
                'membership_period'=>'Lifetime'
            );
            Mail::send('emails.user_new_membership', $data, function ($message) use ($data) {
                $message->subject('Buy Membership ' .$data['siteName']);
                $message->from('colby@nannyparentconnection.com', $data['siteName']);
                $message->bcc('sudhirkundal007@gmail.com');          
                $message->to($data['siteEmail']);
            });
            return response()->json([
                'dataimport' => 'Test Email Send successfully.'
            ]);
        elseif($optionType=='newPrivateMessage'):
            $siteName = getcong('siteName');
            $siteEmail = getcong('siteEmail');
            $data = array(
                'siteName'=>$siteName,
                'siteEmail'=>$siteEmail,
                'senderName'=>'Username',
                'RequestToName'=>'Test User',
                'RequestToEmail'=>'testUser2@yourdomain.com',
                'privateMessageText'=>'This is dummy text message, Testing by admin.',
            );
            Mail::send('emails.new_private_message', $data, function ($message) use ($data) {
                $message->subject($data['siteName'].' New message from '.$data['senderName']);
                $message->from('gurmukhsingh997@gmail.com', $data['siteName']);
                $message->bcc('sudhirkundal007@gmail.com');          
                $message->to($data['siteEmail']);
            });
            return response()->json([
                'dataimport' => 'Test Email Send successfully.'
            ]);
        elseif($optionType=='newFriendRequest'):
            $siteName = getcong('siteName');
            $siteEmail = getcong('siteEmail');
            $data = array(
                'siteName'=>$siteName,
                'siteEmail'=>$siteEmail,
                'senderName'=>'Test User',
                'SenderEmail'=>'testUser@yourdomain.com',
                'RequestToName'=>'Test User 2',
                'RequestToEmail'=>'testUser2@yourdomain.com'
            );
            Mail::send('emails.new_friend_request', $data, function ($message) use ($data) {
                $message->subject($data['siteName'].' New friend request from '.$data['senderName']);
                $message->from('gurmukhsingh997@gmail.com', $data['siteName']);
                $message->bcc('sudhirkundal007@gmail.com');          
                $message->to($data['siteEmail']);
            });
            return response()->json([
                'dataimport' => 'Test Email Send successfully.'
            ]);
        elseif($optionType=='AcceptedFriendRequest'):
            $siteName = getcong('siteName');
            $siteEmail = getcong('siteEmail');
            $data = array(
                'siteName'=>$siteName,
                'siteEmail'=>$siteEmail,
                'FriendAcceptedByName'=>'Test User',
                'FriendAcceptedByEmail'=>'testUser@yourdomain.com',
                'RequestFromName'=>'Test User 2',
                'RequestFromEmail'=>'testUser2@yourdomain.com'
            );
            Mail::send('emails.accepted_friend_request', $data, function ($message) use ($data) {
                $message->subject($data['siteName'].' '.$data['FriendAcceptedByName'].' accepted your friend request');
                $message->from('gurmukhsingh997@gmail.com', $data['siteName']);
                $message->bcc('sudhirkundal007@gmail.com');          
                $message->to($data['siteEmail']);
            });
            return response()->json([
                'dataimport' => 'Test Email Send successfully.'
            ]);
        elseif($optionType=='contactUs'):
            $siteName = getcong('siteName');
            $siteEmail = getcong('siteEmail');
            $data = array(
                'name'=>'Test User',
                'email'=>'testUser@yourdomain.com',
                'subject'=>'Testing',
                'Message'=>'This is testing by admin.',
                'siteName'=>$siteName,
                'siteEmail'=>$siteEmail
            );
    
            Mail::send('emails.contact_us', $data, function ($message) use ($data) {
                $message->subject($data['subject']);
                $message->from($data['email'], $data['name']);
                $message->bcc('sudhirkundal007@gmail.com');          
                $message->to($data['siteEmail']);
            });
            return response()->json([
                'dataimport' => 'Test Email Send successfully.'
            ]);
        elseif($optionType=='User_Last_Minute_Care_Services'):
            $siteName = getcong('siteName');
            $siteEmail = getcong('siteEmail');
            $data = array(
                'name'=>'Test User',
                'siteName'=>$siteName,
                'siteEmail'=>$siteEmail
            );
    
            Mail::send('emails.User_Last_Minute_Care_Services', $data, function ($message) use ($data) {
                $message->subject('Landing Page - Last Minute Care Text Service');
                $message->from('admin@nannyparentconnection.com');
                $message->bcc('sudhirkundal007@gmail.com');          
                $message->to($data['siteEmail']);
            });
            return response()->json([
                'dataimport' => 'Test Email Send successfully.'
            ]);
        elseif($optionType=='upgraded_Subscription_Notice'): 
            $siteName = getcong('siteName');
            $siteEmail = getcong('siteEmail');
            $buy_date = date('F j,Y');
            $data = array(
                'subscription_id'=>'1a2b3c4d5e',
                'Terms'=>'15.15 / month',
                'Started'=>$buy_date,
                'memberEmail'=>'johndoe@example.com',
                'memberUsername'=>'johndoe',
                'siteName'=>$siteName,
                'siteEmail'=>$siteEmail
            );
            
            Mail::send('emails.User_Upgraded_Subscription_Notice', $data, function ($message) use ($data) {
                $message->subject('You have upgraded your subscription!');
                $message->from('admin@nannyparentconnection.com'); 
                $message->bcc('sudhirkundal007@gmail.com');         
                $message->to($data['siteEmail']);
            });
            return response()->json([
                'dataimport' => 'Test Email Send successfully.'
            ]);
        elseif($optionType=='downgraded_Subscription_Notice'):
            $siteName = getcong('siteName');
            $siteEmail = getcong('siteEmail');
            $buy_date = date('F j,Y');
            $data = array(
                'subscription_id'=>'1a2b3c4d5e',
                'Terms'=>'15.15 / month',
                'Started'=>$buy_date,
                'memberEmail'=>'johndoe@example.com',
                'memberUsername'=>'johndoe',
                'siteName'=>$siteName,
                'siteEmail'=>$siteEmail
            );
            
            Mail::send('emails.downgraded_Subscription_Notice', $data, function ($message) use ($data) {
                $message->subject('You have downgraded your subscription!');
                $message->from('admin@nannyparentconnection.com');
                $message->bcc('sudhirkundal007@gmail.com');          
                $message->to($data['siteEmail']);
            });
            return response()->json([
                'dataimport' => 'Test Email Send successfully.'
            ]);
        elseif($optionType=='Stripe_Failed_Payment'):
            $siteName = getcong('siteName');
            $siteEmail = getcong('siteEmail');
            $buy_date = date('F j,Y');
            $data = array(
                'user_first_name'=>'Username',
                'payment_amount'=>'15.15',
                'trans_num'=>'9i8h7g6f5e',
                'trans_date'=>$buy_date,
                'trans_gateway'=>'Credit Card (Stripe)',
                'user_full_name'=>'John Doe',
                'user_email'=>'johndoe@example.com',
                'user_login'=>'johndoe',
                'siteName'=>$siteName,
                'siteEmail'=>$siteEmail
            );
            
            Mail::send('emails.Stripe_Failed_Payment_Notice', $data, function ($message) use ($data) {
                $message->subject('Your Transaction Failed');
                $message->from('admin@nannyparentconnection.com'); 
                $message->bcc('sudhirkundal007@gmail.com');         
                $message->to($data['siteEmail']);
            });
            return response()->json([
                'dataimport' => 'Test Email Send successfully.'
            ]);        
        
        elseif($optionType=='Admin_New_Signup_Notice'):
            $siteName = getcong('siteName');
            $siteEmail = getcong('siteEmail');
            $data = array(
                'user_full_name'=>'John Doe',
                'user_login'=>'johndoe',
                'user_id'=>'1000',
                'productName'=>'Bronze Edition',
                'user_email'=>'johndoe@example.com',
                'user_remote_addr'=>'223.178.211.182',                
                'siteName'=>$siteName,
                'siteEmail'=>$siteEmail
            );
            
            Mail::send('emails.new_register', $data, function ($message) use ($data) {
                $message->subject('New Signup: '.$data['user_login']);
                $message->from('admin@nannyparentconnection.com');
                $message->bcc('sudhirkundal007@gmail.com');          
                $message->to($data['siteEmail']);
            });
            return response()->json([
                'dataimport' => 'Test Email Send successfully.'
            ]);
        elseif($optionType=='Admin_New_One_Time_Subscription_Notice'):
            $siteName = getcong('siteName');
            $siteEmail = getcong('siteEmail');
            $data = array(
                'trans_num'=>'9i8h7g6f5e',
                'user_full_name'=>'John Doe',
                'user_login'=>'johndoe',
                'payment_amount'=>'15.15',
                'trans_gateway'=>'Credit Card (Stripe)',
                'user_email'=>'johndoe@example.com',                
                'siteName'=>$siteName,
                'siteEmail'=>$siteEmail
            );
            
            Mail::send('emails.Admin_New_One_Time_Subscription_Notice', $data, function ($message) use ($data) {
                $message->subject('** New One-Time Subscription: '.$data['trans_num']);
                $message->from('admin@nannyparentconnection.com');
                $message->bcc('sudhirkundal007@gmail.com');          
                $message->to($data['siteEmail']);
            });
            return response()->json([
                'dataimport' => 'Test Email Send successfully.'
            ]);
        elseif($optionType=='Admin_New_Recurring_Subscription_Notice'):
            $siteName = getcong('siteName');
            $siteEmail = getcong('siteEmail');
            $buy_date = date('F j,Y');
            $data = array(
                'product_name'=>'Bronze Edition',
                'subscr_num'=>'9i8h7g6f5e',
                'user_full_name'=>'John Doe',
                'user_login'=>'johndoe',
                'subscr_terms'=>'15.15',
                'subscr_date'=>$buy_date,
                'subscr_gateway'=>'Credit Card (Stripe)',
                'user_email'=>'johndoe@example.com',                
                'siteName'=>$siteName,
                'siteEmail'=>$siteEmail
            );
            
            Mail::send('emails.Admin_New_Recurring_Subscription_Notice', $data, function ($message) use ($data) {
                $message->subject('New Recurring Subscription:'. $data['user_full_name']);
                $message->from('admin@nannyparentconnection.com'); 
                $message->bcc('sudhirkundal007@gmail.com');        
                $message->to($data['siteEmail']);
            });
            return response()->json([
                'dataimport' => 'Test Email Send successfully.'
            ]);
        elseif($optionType=='Admin_Payment_Receipt_Notice'):
            $siteName = getcong('siteName');
            $siteEmail = getcong('siteEmail');
            $buy_date = date('F j,Y');
            $data = array(
                'product_name'=>'Bronze Edition',
                'trans_num'=>'9i8h7g6f5e',
                'payment_amount'=>'15.15',
                'invoice_num'=>'718',
                'trans_date'=>$buy_date,
                'trans_num'=>'9i8h7g6f5e',
                'user_full_name'=>'John Doe',
                'user_login'=>'johndoe',             
                'trans_gateway'=>'Credit Card (Stripe)',
                'user_email'=>'johndoe@example.com',
                'user_address'=>'111 Cool Avenue
                                New York, NY 10005
                                United States',                
                'siteName'=>$siteName,
                'siteEmail'=>$siteEmail
            );
            
            Mail::send('emails.Admin_Payment_Receipt_Notice', $data, function ($message) use ($data) {
                $message->subject('Payment of'. $data['payment_amount'].' from' .$data['user_full_name']);
                $message->from('admin@nannyparentconnection.com'); 
                $message->bcc('sudhirkundal007@gmail.com');         
                $message->to($data['siteEmail']);
            });
            return response()->json([
                'dataimport' => 'Test Email Send successfully.'
            ]);
        elseif($optionType=='Admin_Cancelled_Subscription_Notice'):
            $siteName = getcong('siteName');
            $siteEmail = getcong('siteEmail');
            $buy_date = date('F j,Y');
            $data = array(                
                'subscr_num'=>'9i8h7g6f5e',
                'user_full_name'=>'John Doe',
                'user_login'=>'johndoe',
                'user_email'=>'johndoe@example.com',
                'subscr_terms'=>'15.15 / month', 
                'subscr_date'=>$buy_date,              
                'subscr_gateway'=>'Credit Card (Stripe)',                             
                'siteName'=>$siteName,
                'siteEmail'=>$siteEmail
            );
            
            Mail::send('emails.Admin_Cancelled_Subscription_Notice', $data, function ($message) use ($data) {
                $message->subject('Subscription '.$data['subscr_num'].' Was Cancelled');
                $message->from('admin@nannyparentconnection.com'); 
                $message->bcc('sudhirkundal007@gmail.com');         
                $message->to($data['siteEmail']);
            });
            return response()->json([
                'dataimport' => 'Test Email Send successfully.'
            ]);
        elseif($optionType=='Admin_Upgraded_Subscription_Notice'):
            $siteName = getcong('siteName');
            $siteEmail = getcong('siteEmail');
            $buy_date = date('F j,Y');
            $data = array(                
                'subscr_num'=>'9i8h7g6f5e',
                'user_full_name'=>'John Doe',
                'user_login'=>'johndoe',
                'user_email'=>'johndoe@example.com',
                'subscr_terms'=>'15.15 / month', 
                'subscr_date'=>$buy_date,              
                'subscr_gateway'=>'Credit Card (Stripe)',                             
                'siteName'=>$siteName,
                'siteEmail'=>$siteEmail
            );
            
            Mail::send('emails.Admin_Upgraded_Subscription_Notice', $data, function ($message) use ($data) {
                $message->subject('Subscription '.$data['subscr_num'].' Upgraded');
                $message->from('admin@nannyparentconnection.com');
                $message->bcc('sudhirkundal007@gmail.com');          
                $message->to($data['siteEmail']);
            });
            return response()->json([
                'dataimport' => 'Test Email Send successfully.'
            ]);
        elseif($optionType=='Admin_Downgraded_Subscription_Notice'):
            $siteName = getcong('siteName');
            $siteEmail = getcong('siteEmail');
            $buy_date = date('F j,Y');
            $data = array(                
                'subscr_num'=>'9i8h7g6f5e',
                'user_full_name'=>'John Doe',
                'user_login'=>'johndoe',
                'user_email'=>'johndoe@example.com',
                'subscr_terms'=>'15.15 / month', 
                'subscr_date'=>$buy_date,              
                'subscr_gateway'=>'Credit Card (Stripe)',                             
                'siteName'=>$siteName,
                'siteEmail'=>$siteEmail
            );
            
            Mail::send('emails.Admin_Downgraded_Subscription_Notice', $data, function ($message) use ($data) {
                $message->subject('Subscription '.$data['subscr_num'].' Downgraded');
                $message->from('admin@nannyparentconnection.com');
                $message->bcc('sudhirkundal007@gmail.com');          
                $message->to($data['siteEmail']);
            });
            return response()->json([
                'dataimport' => 'Test Email Send successfully.'
            ]);
        elseif($optionType=='Admin_Paused_Subscription_Notice'):
            $siteName = getcong('siteName');
            $siteEmail = getcong('siteEmail');
            $buy_date = date('F j,Y');
            $data = array(                
                'subscr_num'=>'9i8h7g6f5e',
                'user_full_name'=>'John Doe',
                'user_login'=>'johndoe',
                'user_email'=>'johndoe@example.com',
                'subscr_terms'=>'15.15 / month', 
                'subscr_date'=>$buy_date,              
                'subscr_gateway'=>'Credit Card (Stripe)',                             
                'siteName'=>$siteName,
                'siteEmail'=>$siteEmail
            );
            
            Mail::send('emails.Admin_Paused_Subscription_Notice', $data, function ($message) use ($data) {
                $message->subject('Subscription '.$data['subscr_num'].' Paused');
                $message->from('admin@nannyparentconnection.com');
                $message->bcc('sudhirkundal007@gmail.com');          
                $message->to($data['siteEmail']);
            });
            return response()->json([
                'dataimport' => 'Test Email Send successfully.'
            ]);
        elseif($optionType=='Admin_Resumed_Subscription_Notice'):
            $siteName = getcong('siteName');
            $siteEmail = getcong('siteEmail');
            $buy_date = date('F j,Y');
            $data = array(                
                'subscr_num'=>'9i8h7g6f5e',
                'user_full_name'=>'John Doe',
                'user_login'=>'johndoe',
                'user_email'=>'johndoe@example.com',
                'subscr_terms'=>'15.15 / month', 
                'subscr_date'=>$buy_date,              
                'subscr_gateway'=>'Credit Card (Stripe)',                             
                'siteName'=>$siteName,
                'siteEmail'=>$siteEmail
            );
            
            Mail::send('emails.Admin_Resumed_Subscription_Notice', $data, function ($message) use ($data) {
                $message->subject('Subscription '.$data['subscr_num'].' Paused');
                $message->from('admin@nannyparentconnection.com');
                $message->bcc('sudhirkundal007@gmail.com');          
                $message->to($data['siteEmail']);
            });
            return response()->json([
                'dataimport' => 'Test Email Send successfully.'
            ]);
        elseif($optionType=='Admin_Refunded_Transaction_Notice'):
            $siteName = getcong('siteName');
            $siteEmail = getcong('siteEmail');
            $buy_date = date('F j,Y');
            $data = array(                
                'trans_num'=>'9i8h7g6f5e',
                'user_full_name'=>'John Doe',
                'user_login'=>'johndoe',
                'user_email'=>'johndoe@example.com',
                'payment_amount'=>'15.15', 
                'trans_date'=>$buy_date,              
                'trans_gateway'=>'Credit Card (Stripe)',                             
                'siteName'=>$siteName,
                'siteEmail'=>$siteEmail
            );
            
            Mail::send('emails.Admin_Refunded_Transaction_Notice', $data, function ($message) use ($data) {
                $message->subject('Subscription '.$data['trans_num'].' Was Refunded');
                $message->from('admin@nannyparentconnection.com');
                $message->bcc('sudhirkundal007@gmail.com');          
                $message->to($data['siteEmail']);
            });
            return response()->json([
                'dataimport' => 'Test Email Send successfully.'
            ]);
        elseif($optionType=='Admin_Failed_Transaction_Notice'):
            $siteName = getcong('siteName');
            $siteEmail = getcong('siteEmail');
            $buy_date = date('F j,Y');
            $data = array(                
                'trans_num'=>'9i8h7g6f5e',
                'user_full_name'=>'John Doe',
                'user_login'=>'johndoe',
                'user_email'=>'johndoe@example.com',
                'payment_amount'=>'15.15', 
                'trans_date'=>$buy_date,              
                'trans_gateway'=>'Credit Card (Stripe)',                             
                'siteName'=>$siteName,
                'siteEmail'=>$siteEmail
            );
            
            Mail::send('emails.Admin_Failed_Transaction_Notice', $data, function ($message) use ($data) {
                $message->subject('Transaction Failed');
                $message->from('admin@nannyparentconnection.com');
                $message->bcc('sudhirkundal007@gmail.com');          
                $message->to($data['siteEmail']);
            });
            return response()->json([
                'dataimport' => 'Test Email Send successfully.'
            ]);
        elseif($optionType=='Admin_Credit_Card_Expiring_Notice'):
            $siteName = getcong('siteName');
            $siteEmail = getcong('siteEmail');            
            $data = array(                
                'subscr_cc_month_exp'=>'03',                
                'subscr_cc_year_exp'=>'2025',
                'product_name'=>'Bronze Edition',
                'subscr_cc_num'=>'**** **** **** 6710', 
                'subscr_next_billing_at'=>'April 15, 2023',             
                'subscr_gateway'=>'Credit Card (Stripe)',
                'user_full_name'=>'John Doe',
                'user_login'=>'johndoe',
                'user_email'=>'johndoe@example.com',
                'user_address'=>'111 Cool Avenue
                                New York, NY 10005
                                United States',                             
                'siteName'=>$siteName,
                'siteEmail'=>$siteEmail
            );
            
            Mail::send('emails.Admin_Credit_Card_Expiring_Notice', $data, function ($message) use ($data) {
                $message->subject('Credit Card Expiring For '.$data['subscr_cc_month_exp'].'/'.$data['subscr_cc_year_exp']);
                $message->from('admin@nannyparentconnection.com');
                $message->bcc('sudhirkundal007@gmail.com');          
                $message->to($data['siteEmail']);
            });
            return response()->json([
                'dataimport' => 'Test Email Send successfully.'
            ]);
        endif;        
    }

    public function ninjaEmails()
    {
        return view('admin.TestEmails.ninja-emails'); 
    }

    public function SendTestNinjaEmails()
    {
        $inputs = Request::all();
        $optionType = decrypt($inputs['inputData']);
        $buy_date = date('F j,Y');
        if($optionType=='Concierge_Service_Initial_Intake_Form'):
            $siteName = getcong('siteName');
            $siteEmail = getcong('siteEmail');
            $data = array(
                'First_Name'=>'Test',
                'Last_Name'=>'User',
                'Phone'=>'8989589',
                'Email'=>'dummy@gmail.com',
                'Email_Confirmation'=>'dummy@gmail.com',
                'city_live_in'=>'Maxico',
                'Concierge_Service'=>'Testing',
                'Ideal_start_date'=>$buy_date,
                'date_flexible'=>$buy_date,
                'position_last'=>'Tesing',
                'Days_and_times'=>'Monday 4PM',
                'Number_of_children'=>'2',                
                'siteName'=>$siteName,
                'siteEmail'=>$siteEmail
            );
            
            Mail::send('emails.Concierge_Service_Initial_Intake_Form', $data, function ($message) use ($data) {
                $message->subject('Family Just Filled Out Concierge Service Initial Intake Form - Please Follow Up With!');
                $message->from('admin@nannyparentconnection.com');
                $message->bcc('sudhirkundal007@gmail.com');         
                $message->to($data['siteEmail']);
            });
            return response()->json([
                'dataimport' => 'Test Email Send successfully.'
            ]);
        elseif($optionType=='Current_Open_Positions_Application_for_Care_Providers'):
            $siteName = getcong('siteName');
            $siteEmail = getcong('siteEmail');
            $data = array(
                'First_Name'=>'Test',
                'Last_Name'=>'User',
                'Phone'=>'8989589',
                'Email'=>'dummy@gmail.com',
                'communicate_via_text_message'=>'Yes',
                'position_in_interested'=>'Compassionate, Experienced Nanny Needed for Laurelhurst Share',                                
                'siteName'=>$siteName,
                'siteEmail'=>$siteEmail
            );
            
            Mail::send('emails.Admin_Current_Open_Positions_Application_for_Care_Providers', $data, function ($message) use ($data) {
                $message->subject('Care Provider Candidate Just Applied for Position');
                $message->from('admin@nannyparentconnection.com');
                $message->bcc('sudhirkundal007@gmail.com');         
                $message->to($data['siteEmail']);
            });
            return response()->json([
                'dataimport' => 'Test Email Send successfully.'
            ]);
        elseif($optionType=='HomePay_Sign_Up_Form'):
            $siteName = getcong('siteName');
            $siteEmail = getcong('siteEmail');
            $data = array(
                'First_Name'=>'Test',
                'Last_Name'=>'User',
                'Phone'=>'8989589',
                'Email'=>'dummy@gmail.com',
                'tell_us'=>'This is dummy content.',
                'siteName'=>$siteName,
                'siteEmail'=>$siteEmail
            );
            
            Mail::send('emails.HomePay_Sign_Up_Form', $data, function ($message) use ($data) {
                $message->subject('Sales lead for HomePay from Nanny Parent Connection');
                $message->from('admin@nannyparentconnection.com'); 
                $message->bcc('sudhirkundal007@gmail.com');        
                $message->to($data['siteEmail']);
            });
            return response()->json([
                'dataimport' => 'Test Email Send successfully.'
            ]);
        elseif($optionType=='Information_Request_Form'):
            $siteName = getcong('siteName');
            $siteEmail = getcong('siteEmail');
            $data = array(
                'First_Name'=>'Test',
                'Last_Name'=>'User',
                'Phone'=>'8989589',
                'Email'=>'dummy@gmail.com',
                'siteName'=>$siteName,
                'siteEmail'=>$siteEmail
            );
            
            Mail::send('emails.Information_Request_Form', $data, function ($message) use ($data) {
                $message->subject('Form submission');
                $message->from('admin@nannyparentconnection.com');
                $message->bcc('sudhirkundal007@gmail.com');         
                $message->to($data['siteEmail']);
            });
            return response()->json([
                'dataimport' => 'Test Email Send successfully.'
            ]);
        elseif($optionType=='Last_Minute_Care_Submission_Form'):
            $siteName = getcong('siteName');
            $siteEmail = getcong('siteEmail');
            $data = array(
                'First_Name'=>'Test',
                'Last_Name'=>'User',
                'Phone'=>'8989589',
                'Email'=>'dummy@gmail.com',
                'siteName'=>$siteName,
                'siteEmail'=>$siteEmail
            );
            
            Mail::send('emails.Last_Minute_Care_Submission_Form', $data, function ($message) use ($data) {
                $message->subject('Your Last Minute Care Request');
                $message->from('admin@nannyparentconnection.com');
                $message->bcc('sudhirkundal007@gmail.com');         
                $message->to($data['siteEmail']);
            });
            return response()->json([
                'dataimport' => 'Test Email Send successfully.'
            ]);
        elseif($optionType=='Pay_Calculator'):
            $siteName = getcong('siteName');
            $siteEmail = getcong('siteEmail');
            $data = array(
                'Phone'=>'8989589',
                'Email'=>'dummy@gmail.com',
                'siteName'=>$siteName,
                'siteEmail'=>$siteEmail
            );
            
            Mail::send('emails.Pay_Calculator', $data, function ($message) use ($data) {
                $message->subject('Landing Page - Pay Calculator Form Submission');
                $message->from('admin@nannyparentconnection.com'); 
                $message->bcc('sudhirkundal007@gmail.com');        
                $message->to($data['siteEmail']);
            });
            return response()->json([
                'dataimport' => 'Test Email Send successfully.'
            ]);
        elseif($optionType=='Pay_Rate_Worksheet_for_Parents'):
            $siteName = getcong('siteName');
            $siteEmail = getcong('siteEmail');
            $data = array(
                'looking_for'=>'Full Time (more than 35 hours/week)',
                'expect_care_provider'=>'Long Term (more than a year)',
                'children_need_care'=>'Two',
                'provider_experience'=>'Yes',
                'child_care_duties'=>'No, I need help with additional duties',
                'temporary_last_minute_child_care'=>'No',
                'Will_the_child_care_occur'=>'Yes',
                'siteName'=>$siteName,
                'siteEmail'=>$siteEmail
            );
            
            Mail::send('emails.Pay_Rate_Worksheet_for_Parents', $data, function ($message) use ($data) {
                $message->subject('User Just Completed Pay Rate Worksheet for Parents');
                $message->from('admin@nannyparentconnection.com'); 
                $message->bcc('sudhirkundal007@gmail.com');        
                $message->to($data['siteEmail']);
            });
            return response()->json([
                'dataimport' => 'Test Email Send successfully.'
            ]);
        elseif($optionType=='Verified_Care_Provider_Submission_Form'):
            $siteName = getcong('siteName');
            $siteEmail = getcong('siteEmail');
            $data = array(
                'First_Name'=>'Test User',
                'emails'=>'dummy@domain.com',
                'siteName'=>$siteName,
                'siteEmail'=>$siteEmail
            );
            
            Mail::send('emails.Verified_Care_Provider_Submission_Form', $data, function ($message) use ($data) {
                $message->subject('Your Verified Care Provider Request');
                $message->from('admin@nannyparentconnection.com'); 
                $message->bcc('sudhirkundal007@gmail.com');        
                $message->to($data['siteEmail']);
            });
            return response()->json([
                'dataimport' => 'Test Email Send successfully.'
            ]);
        endif;
    } 
/************************ Reminder Emails ***************************************/   
    public function remindersEmails()
    {
        return view('admin.TestEmails.reminders-emails');
    }

    public function SendTestRemindersfirstForm()
    {
        $inputs = Request::all();        
        $siteName = getcong('siteName');
        $siteEmail = getcong('siteEmail');
        $date = new \DateTime();
        $date->modify('-4 hours');
        $formatted_date = $date->format('Y-m-d H:i:s');
        $care_providers_packages = subscribersPlans::whereIn('product_id', ['176612','29896','29814'])->where('created_at', '>',$formatted_date)->get();
        // foreach($care_providers_packages as $carePrvider):
        //     $usersInfo = User::where('id',$carePrvider->user_id)->first();
        //     $data = array(
        //         'name'=>$usersInfo->name,
        //         'emails'=>$usersInfo->email,
        //         'siteName'=>$siteName,
        //         'siteEmail'=>$siteEmail
        //     );             
        //     Mail::send('emails.reminders.Care-Provider-All-Member-Search-4-hoursafter-signup', $data, function ($message) use ($data) {
        //         $message->subject('Browse parent profiles with Member Search!');
        //         $message->from($data['siteEmail']); 
        //         $message->bcc('sudhirkundal007@gmail.com');        
        //         $message->to($data['emails']);
        //     });  
        // endforeach;          
        return response()->json([
            'mailSend' => 'Send mail'
        ]);      
    }

    public function SendTestRemindersfirstForm2()
    {
        $inputs = Request::all();        
        $siteName = getcong('siteName');
        $siteEmail = getcong('siteEmail');
        $date = new \DateTime();
        $date->modify('-4 hours');
        $formatted_date = $date->format('Y-m-d H:i:s');
        $family_parent_packages = subscribersPlans::whereIn('product_id', ['29748', '155721', '155718'])->where('created_at', '>',$formatted_date)->get();
        // foreach($family_parent_packages as $getUsers):
        //     $usersInfo = User::where('id',$getUsers->user_id)->first();
        //     $data = array(
        //         'user_first_name'=>$usersInfo->name,
        //         'emails'=>$usersInfo->email,
        //         'siteName'=>$siteName,
        //         'siteEmail'=>$siteEmail
        //     );          
        //     Mail::send('emails.reminders.Family-Parent-All-MemberSearch-4-hours-after-signup', $data, function ($message) use ($data) {
        //         $message->subject('Browse nanny/sitter profiles with Member Search!');
        //         $message->from($data['siteEmail']); 
        //         $message->bcc('sudhirkundal007@gmail.com');        
        //         $message->to($data['emails']);
        //     });            
        // endforeach;         
        return response()->json([
            'mailSend' => 'Send mail'
        ]);  
        
    }

    public function SendTestRemindersfirstForm3()
    {
        $inputs = Request::all();        
        $siteName = getcong('siteName');
        $siteEmail = getcong('siteEmail');        
        $family_parent_packages = subscribersPlans::whereIn('product_id', ['29748', '155721', '155718'])->where('created_at', '>=', Carbon::now()->subDays(14)->toDateTimeString())->get();
        // foreach($family_parent_packages as $getUsers):
        //     $usersInfo = User::where('id',$getUsers->user_id)->first();
        //     $data = array(
        //         'user_first_name'=>$usersInfo->name,
        //         'emails'=>$usersInfo->email,
        //         'siteName'=>$siteName,
        //         'siteEmail'=>$siteEmail
        //     );    
        //     Mail::send('emails.reminders.FamilyParent-All-NannyPayrollService-14-daysaftersignup', $data, function ($message) use ($data) {
        //         $message->subject('How do you plan on paying your nanny?');
        //         $message->from($data['siteEmail']); 
        //         $message->bcc('sudhirkundal007@gmail.com');        
        //         $message->to($data['emails']);
        //     });
        // endforeach; 
            return response()->json([
                'mailSend' => 'Send mail'
            ]);         
    }

    public function SendTestRemindersfirstForm4()
    {
        $inputs = Request::all();        
        $siteName = getcong('siteName');
        $siteEmail = getcong('siteEmail');
        $family_parent_packages = subscribersPlans::whereIn('product_id', ['29748'])->where('created_at', '>=', Carbon::now()->subDays(10)->toDateTimeString())->get();
        // foreach($family_parent_packages as $getUsers):
        //     $usersInfo = User::where('id',$getUsers->user_id)->first();
        //     $data = array(
        //         'user_first_name'=>$usersInfo->name,
        //         'emails'=>$usersInfo->email,
        //         'siteName'=>$siteName,
        //         'siteEmail'=>$siteEmail
        //     );          
        //     Mail::send('emails.reminders.Family-Parent-Annual-Only-Free-Nanny-Contract-10-days-after-sign-up', $data, function ($message) use ($data) {
        //         $message->subject('Your FREE nanny contract is ready for download!');
        //         $message->from($data['siteEmail']); 
        //         $message->bcc('sudhirkundal007@gmail.com');        
        //         $message->to($data['emails']);
        //     });
        // endforeach;
        return response()->json([
            'mailSend' => 'Send mail'
        ]);  
        
    }

    public function SendTestRemindersfirstForm5()
    {
        $inputs = Request::all();        
        $siteName = getcong('siteName');
        $siteEmail = getcong('siteEmail');
        $family_parent_packages = subscribersPlans::whereIn('product_id', ['155721', '155718'])->where('created_at', '>=', Carbon::now()->subDays(10)->toDateTimeString())->get();
        // foreach($family_parent_packages as $getUsers):
        //     $usersInfo = User::where('id',$getUsers->user_id)->first();
        //     $data = array(
        //         'user_first_name'=>$usersInfo->name,
        //         'emails'=>$usersInfo->email,
        //         'siteName'=>$siteName,
        //         'siteEmail'=>$siteEmail
        //     );            
        //     Mail::send('emails.reminders.Family-Parent-All-except-Annual-Nanny-Contract-10-days-after-sign-up', $data, function ($message) use ($data) {
        //         $message->subject('Need a nanny contract? We have got you covered!');
        //         $message->from($data['siteEmail']); 
        //         $message->bcc('sudhirkundal007@gmail.com');        
        //         $message->to($data['emails']);
        //     });
        // endforeach;  
        return response()->json([
            'mailSend' => 'Send mail'
        ]);         
    }

    public function SendTestRemindersfirstForm6()
    {
        $inputs = Request::all();        
        $siteName = getcong('siteName');
        $siteEmail = getcong('siteEmail');
        $date = new \DateTime();
        $date->modify('-1 hours');
        $formatted_date = $date->format('Y-m-d H:i:s');
        $care_providers_packages = subscribersPlans::whereIn('product_id', ['176612','29896','29814'])->where('created_at', '>',$formatted_date)->get();
        // foreach($care_providers_packages as $carePrvider):
        //     $usersInfo = User::where('id',$carePrvider->user_id)->first();
        //     $data = array(
        //         'user_first_name'=>$usersInfo->name,
        //         'emails'=>$usersInfo->email,
        //         'siteName'=>$siteName,
        //         'siteEmail'=>$siteEmail
        //     );          
        //     Mail::send('emails.reminders.Care-Provider-All-Jobs-Board-1-hour-after-sign-up', $data, function ($message) use ($data) {
        //         $message->subject('Browse our Jobs Board!');
        //         $message->from('admin@nannyparentconnection.com'); 
        //         $message->bcc('sudhirkundal007@gmail.com');        
        //         $message->to($data['emails']);
        //     });
        // endforeach;
        return response()->json([
            'mailSend' => 'Send mail'
        ]);  
        
    }

    public function SendTestRemindersfirstForm7()
    {
        $inputs = Request::all();        
        $siteName = getcong('siteName');
        $siteEmail = getcong('siteEmail');
        $care_providers_packages = subscribersPlans::whereIn('product_id', ['176612'])->where('created_at', '>=', Carbon::now()->subDays(2)->toDateTimeString())->get();
        // foreach($care_providers_packages as $carePrvider):
        //     $usersInfo = User::where('id',$carePrvider->user_id)->first();
        //     $data = array(
        //         'user_first_name'=>$usersInfo->name,
        //         'emails'=>$usersInfo->email,
        //         'siteName'=>$siteName,
        //         'siteEmail'=>$siteEmail
        //     );        
        //     Mail::send('emails.reminders.Care-Provider-Free-I-hope-you-dont-leave-plus-review-referral-2-days-after-expiration', $data, function ($message) use ($data) {
        //         $message->subject('I hope you do not leave!');
        //         $message->from('admin@nannyparentconnection.com'); 
        //         $message->bcc('sudhirkundal007@gmail.com');        
        //         $message->to($data['emails']);
        //     });
        // endforeach;
        return response()->json([
            'mailSend' => 'Send mail'
        ]);        
    }

    public function SendTestRemindersfirstForm8()
    {
        $inputs = Request::all();        
        $siteName = getcong('siteName');
        $siteEmail = getcong('siteEmail');
        $family_parent_packages = subscribersPlans::whereIn('product_id', ['29748', '155721', '155718'])->where('created_at', '>=', Carbon::now()->subDays(8)->toDateTimeString())->get();
        // foreach($family_parent_packages as $familyParent):
        //     $usersInfo = User::where('id',$familyParent->user_id)->first();
        //     $data = array(
        //         'user_first_name'=>$usersInfo->name,
        //         'emails'=>$usersInfo->email,
        //         'siteName'=>$siteName,
        //         'siteEmail'=>$siteEmail
        //     );           
        //     Mail::send('emails.reminders.Family-Parent-All-Dont-forget-the-Background-Check!-8-days-after-purchase', $data, function ($message) use ($data) {
        //         $message->subject('Do not forget the Background Check!');
        //         $message->from('admin@nannyparentconnection.com'); 
        //         $message->bcc('sudhirkundal007@gmail.com');        
        //         $message->to($data['emails']);
        //     });
        // endforeach;
        return response()->json([
            'mailSend' => 'Send mail'
        ]);        
    }

    public function SendTestRemindersfirstForm9()
    {
        $inputs = Request::all();        
        $siteName = getcong('siteName');
            $siteEmail = getcong('siteEmail');
            $data = array(
                'user_first_name'=>'Test User',
                'emails'=>'dummy@domain.com',
                'siteName'=>$siteName,
                'siteEmail'=>$siteEmail
            );
        if($inputs['Family_Parent_Learning_Guide_30_days_before_Subscription_Renews']=='9'):    
            Mail::send('emails.reminders.Family-Parent-Learning-Guide-30-days-before-Subscription-Renews', $data, function ($message) use ($data) {
                $message->subject('Membership Renewal Reminder');
                $message->from('admin@nannyparentconnection.com'); 
                $message->bcc('sudhirkundal007@gmail.com');        
                $message->to($data['siteEmail']);
            });
            return response()->json([
                'mailSend' => 'Send mail'
            ]);  
        endif;
    }

    public function SendTestRemindersfirstForm10()
    {
        $inputs = Request::all();        
        $siteName = getcong('siteName');
        $siteEmail = getcong('siteEmail');
        $care_providers_packages = subscribersPlans::whereIn('product_id', ['176612','29896','29814'])->where('created_at', '>=', Carbon::now()->subDays(5)->toDateTimeString())->get();
        // foreach($care_providers_packages as $carePrvider):
        //     $usersInfo = User::where('id',$carePrvider->user_id)->first();
        //     $data = array(
        //         'user_first_name'=>$usersInfo->name,
        //         'emails'=>$usersInfo->email,
        //         'siteName'=>$siteName,
        //         'siteEmail'=>$siteEmail
        //     );          
        //     Mail::send('emails.reminders.Care-Provider-All–100-Free-for-Life–5-days-after-Sign-Up-Abandoned', $data, function ($message) use ($data) {
        //         $message->subject('100% Free for Life!');
        //         $message->from('admin@nannyparentconnection.com'); 
        //         $message->bcc('sudhirkundal007@gmail.com');        
        //         $message->to($data['emails']);
        //     });
        // endforeach;
        return response()->json([
            'mailSend' => 'Send mail'
        ]);         
    }

    public function SendTestRemindersfirstForm11()
    {
        $inputs = Request::all();        
        $siteName = getcong('siteName');
        $siteEmail = getcong('siteEmail');
        $agency_packages = subscribersPlans::whereIn('product_id', ['30019','155715','155712'])->where('created_at', '>=', Carbon::now()->subDays(2)->toDateTimeString())->get();
        // foreach($agency_packages as $packageInfo):
        //     if($packageInfo->product_id=='30019'):
        //         $current_date= date('Y-m-d');
        //         $subscr_expires_date= date('Y-m-d', strtotime('+1 year +2 day', strtotime($packageInfo->created_at->format('Y-m-d')))); ;                
        //         if($current_date==$subscr_expires_date):                                        
        //             $subscr_expires_at= date('F j,Y', strtotime('+1 year', strtotime($packageInfo->created_at->format('Y-m-d'))));
        //             $usersInfo = User::where('id',$packageInfo->user_id)->first();
        //             $data = array(
        //                 'user_first_name'=>$usersInfo->name,
        //                 'subscr_expires_at'=>$subscr_expires_at,
        //                 'emails'=>$usersInfo->email,
        //                 'siteName'=>$siteName,
        //                 'siteEmail'=>$siteEmail
        //             );        
        //             Mail::send('emails.reminders.Agency–All–I-hope-you-dont-leave!-plus-review-referral–2-days-after-Subscription-Expires', $data, function ($message) use ($data) {
        //                 $message->subject('I hope you do not leave!');
        //                 $message->from('admin@nannyparentconnection.com'); 
        //                 $message->bcc('sudhirkundal007@gmail.com');        
        //                 $message->to($data['emails']);
        //             }); 
        //        endif;
        //     elseif($packageInfo->product_id=='155715'):                             
        //         $current_date= date('Y-m-d');
        //         $subscr_expires_date= date('Y-m-d', strtotime('+1 month +2 day', strtotime($packageInfo->created_at->format('Y-m-d')))); ;                
        //         if($current_date==$subscr_expires_date):                                        
        //             $subscr_expires_at= date('F j,Y', strtotime('+1 month', strtotime($packageInfo->created_at->format('Y-m-d'))));
        //             $usersInfo = User::where('id',$packageInfo->user_id)->first();
        //             $data = array(
        //                 'user_first_name'=>$usersInfo->name,
        //                 'subscr_expires_at'=>$subscr_expires_at,
        //                 'emails'=>$usersInfo->email,
        //                 'siteName'=>$siteName,
        //                 'siteEmail'=>$siteEmail
        //             );        
        //             Mail::send('emails.reminders.Agency–All–I-hope-you-dont-leave!-plus-review-referral–2-days-after-Subscription-Expires', $data, function ($message) use ($data) {
        //                 $message->subject('I hope you do not leave!');
        //                 $message->from('admin@nannyparentconnection.com'); 
        //                 $message->bcc('sudhirkundal007@gmail.com');        
        //                 $message->to($data['emails']);
        //             }); 
        //        endif;
        //     elseif($packageInfo->product_id=='155712'):
        //         $current_date= date('Y-m-d');
        //         $subscr_expires_date= date('Y-m-d', strtotime('+1 month +2 day', strtotime($packageInfo->created_at->format('Y-m-d'))));                
        //         if($current_date==$subscr_expires_date):                                        
        //             $subscr_expires_at= date('F j,Y', strtotime('+1 month', strtotime($packageInfo->created_at->format('Y-m-d'))));
        //             $usersInfo = User::where('id',$packageInfo->user_id)->first();
        //             $data = array(
        //                 'user_first_name'=>$usersInfo->name,
        //                 'subscr_expires_at'=>$subscr_expires_at,
        //                 'emails'=>$usersInfo->email,
        //                 'siteName'=>$siteName,
        //                 'siteEmail'=>$siteEmail
        //             );        
        //             Mail::send('emails.reminders.Agency–All–I-hope-you-dont-leave!-plus-review-referral–2-days-after-Subscription-Expires', $data, function ($message) use ($data) {
        //                 $message->subject('I hope you do not leave!');
        //                 $message->from('admin@nannyparentconnection.com'); 
        //                 $message->bcc('sudhirkundal007@gmail.com');        
        //                 $message->to($data['emails']);
        //             }); 
        //        endif;
        //     else:
        //     endif;        
        // endforeach;        
        return response()->json([
            'mailSend' => 'Send mail'
        ]);         
    }

    public function SendTestRemindersfirstForm12()
    {
        $inputs = Request::all();        
        $siteName = getcong('siteName');
        $siteEmail = getcong('siteEmail');
        $buy_date = date('F j,Y');
        $data = array(
            'user_first_name'=>'Test User',
            'subscr_expires_at'=>$buy_date,
            'emails'=>'dummy@domain.com',
            'siteName'=>$siteName,
            'siteEmail'=>$siteEmail
        );
        if($inputs['Background_Check_All_Vetted_Candidate_Guarantee_5%_Coupon_Offer_2_days_after_Sign_Up_Abandoned']=='12'):    
            Mail::send('emails.reminders.Background-Check–All–Vetted-Candidate-Guarantee-5%-Coupon-Offer–2-days-after-Sign-Up-Abandoned', $data, function ($message) use ($data) {
                $message->subject('I have a special coupon for YOU!');
                $message->from('admin@nannyparentconnection.com'); 
                $message->bcc('sudhirkundal007@gmail.com');        
                $message->to($data['siteEmail']);
            });
            return response()->json([
                'mailSend' => 'Send mail'
            ]);  
        endif;
    }

    public function SendTestRemindersfirstForm13()
    {
        $inputs = Request::all();        
        $siteName = getcong('siteName');
        $siteEmail = getcong('siteEmail');
        $current_date= date('Y-m-d');
        $care_provider_annual = subscribersPlans::whereIn('product_id', ['29896'])->get();
        // foreach($care_provider_annual as $annualPlan):
        //     $subscr_expires_at= date('Y-m-d', strtotime('+1 year -30 day', strtotime($annualPlan->created_at->format('Y-m-d')))); 
        //     $buy_date = date('F j,Y', strtotime('+1 year', strtotime($annualPlan->created_at->format('Y-m-d')))); 
        //     $usersInfo = User::where('id',$annualPlan->user_id)->first();
        //     if($subscr_expires_at==$current_date):
        //         $data = array(
        //             'user_first_name'=>$usersInfo->name,
        //             'subscr_expires_at'=>$buy_date,
        //             'emails'=>$usersInfo->email,
        //             'siteName'=>$siteName,
        //             'siteEmail'=>$siteEmail
        //         );
        //         Mail::send('emails.reminders.Care-Provider–Annual–Membership-Renewal-Reminder–30-days-before-Subscription-Renews', $data, function ($message) use ($data) {
        //             $message->subject('I have a special coupon for YOU!');
        //             $message->from($data['siteEmail']); 
        //             $message->bcc('sudhirkundal007@gmail.com');        
        //             $message->to($data['emails']);
        //         });
        //     endif;
        // endforeach;
        
        return response()->json([
            'mailSend' => 'Send mail'
        ]);         
    }

    public function SendTestRemindersfirstForm14()
    {
        $inputs = Request::all();        
        $siteName = getcong('siteName');
        $siteEmail = getcong('siteEmail');
        $current_date= date('Y-m-d');
        $familyParent_Agency_annual = subscribersPlans::whereIn('product_id', ['29748','30019'])->get();        
        // foreach($familyParent_Agency_annual as $annualPlan):
        //     $subscr_expires_at= date('Y-m-d', strtotime('+1 year -30 day', strtotime($annualPlan->created_at->format('Y-m-d')))); 
        //     $buy_date = date('F j,Y', strtotime('+1 year', strtotime($annualPlan->created_at->format('Y-m-d'))));
        //     $usersInfo = User::where('id',$annualPlan->user_id)->first();
        //     if($subscr_expires_at==$current_date): 
        //         $data = array(
        //             'user_first_name'=>$usersInfo->name,
        //             'emails'=>$usersInfo->email,
        //             'siteName'=>$siteName,
        //             'siteEmail'=>$siteEmail
        //         );
        //         Mail::send('emails.reminders.Family_Parent_and_Agency_Annual_Membership_Renewal_Reminder_30_days_before_Subscription_Renews', $data, function ($message) use ($data) {
        //             $message->subject('Membership Renewal Reminder');
        //             $message->from($data['siteEmail']); 
        //             $message->bcc('sudhirkundal007@gmail.com');        
        //             $message->to($data['emails']);
        //         });
        //     endif;
        // endforeach;              
        return response()->json([
            'mailSend' => 'Send mail'
        ]);       
    }

    public function SendTestRemindersfirstForm15()
    {
        $inputs = Request::all();        
        $siteName = getcong('siteName');
        $siteEmail = getcong('siteEmail');
        $date = new \DateTime();
        $date->modify('-8 hours');
        $formatted_date = $date->format('Y-m-d H:i:s');
        $care_providers_packages = subscribersPlans::whereIn('product_id', ['29896','176612'])->where('created_at', '>',$formatted_date)->get();
        // foreach($care_providers_packages as $planUser):
        //     $usersInfo = User::where('id',$planUser->user_id)->first();      
        //     $data = array(
        //         'user_first_name'=>$usersInfo->name,
        //         'emails'=>$usersInfo->email,
        //         'siteName'=>$siteName,
        //         'siteEmail'=>$siteEmail
        //     );            
        //     Mail::send('emails.reminders.Care-Provider-All-CareCalendar-8-hours-after-Member-Signs-Up', $data, function ($message) use ($data) {
        //         $message->subject('Membership Renewal Reminder');
        //         $message->from($data['siteEmail']); 
        //         $message->bcc('sudhirkundal007@gmail.com');        
        //         $message->to($data['emails']);
        //     });
        // endforeach;
        return response()->json([
            'mailSend' => 'Send mail'
        ]);       
    }

    public function SendTestRemindersfirstForm16()
    {
        $inputs = Request::all();        
        $siteName = getcong('siteName');
        $siteEmail = getcong('siteEmail');
        $date = new \DateTime();
        $date->modify('-6 hours');
        $formatted_date = $date->format('Y-m-d H:i:s');
        $family_parent_packages = subscribersPlans::whereIn('product_id', ['29748', '155721', '155718'])->where('created_at', '>',$formatted_date)->get();
        // foreach($family_parent_packages as $family_parent):
        //     $usersInfo = User::where('id',$family_parent->user_id)->first();
        //     $data = array(
        //         'user_first_name'=>$usersInfo->name,
        //         'emails'=>$usersInfo->email,
        //         'siteName'=>$siteName,
        //         'siteEmail'=>$siteEmail
        //     );
        //     Mail::send('emails.reminders.Family-Parent-All–CareCalendar–6-hours-after-Member-Signs-Up', $data, function ($message) use ($data) {
        //         $message->subject('Family Parent- All - CareCalendar');
        //         $message->from($data['siteEmail']); 
        //         $message->bcc('sudhirkundal007@gmail.com');        
        //         $message->to($data['emails']);
        //     });
        // endforeach;
        return response()->json([
            'mailSend' => 'Send mail'
        ]);       
    }

    public function SendTestRemindersfirstForm17()
    {
        $inputs = Request::all();        
        $siteName = getcong('siteName');
        $siteEmail = getcong('siteEmail');
        $buy_date = date('F j,Y');
        $data = array(
            'user_first_name'=>'Test User',
            'emails'=>'dummy@domain.com',
            'siteName'=>$siteName,
            'siteEmail'=>$siteEmail
        );
        if($inputs['Care_Provider_All_Earn_more_by_becoming_a_Verified_Care_Provider!_2_days_after_Member_Signs_Up']=='17'):    
            Mail::send('emails.reminders.Care-Provider–All–Earn-more-by-becoming-a-Verified-Care-Provider!–2-days-after-Member-Signs-Up', $data, function ($message) use ($data) {
                $message->subject('Earn more by becoming a Verified Care Provider!');
                $message->from('admin@nannyparentconnection.com'); 
                $message->bcc('sudhirkundal007@gmail.com');        
                $message->to($data['siteEmail']);
            });
            return response()->json([
                'mailSend' => 'Send mail'
            ]);  
        endif;
    }

    public function SendTestRemindersfirstForm18()
    {
        $inputs = Request::all();        
        $siteName = getcong('siteName');
        $siteEmail = getcong('siteEmail');
        $buy_date = date('F j,Y');
        $data = array(
            'user_first_name'=>'Test User',
            'emails'=>'dummy@domain.com',
            'siteName'=>$siteName,
            'siteEmail'=>$siteEmail
        );
        if($inputs['Background_Checks_Checking_in_re_background_check_and_a_quick_favor_review_referral_14_days_after_purchase']=='18'):    
            Mail::send('emails.reminders.Background-Checks–Checking-in-re-background-check-and-a-quick-favor-review-referral–14-days-after-purchase', $data, function ($message) use ($data) {
                $message->subject('Checking in re: your background check and a quick favor');
                $message->from('admin@nannyparentconnection.com'); 
                $message->bcc('sudhirkundal007@gmail.com');        
                $message->to($data['siteEmail']);
            });
            return response()->json([
                'mailSend' => 'Send mail'
            ]);  
        endif;
    }

    public function SendTestRemindersfirstForm19()
    {
        $inputs = Request::all();        
        $siteName = getcong('siteName');
        $siteEmail = getcong('siteEmail');        
        $date = new \DateTime();
        $date->modify('-12 hours');
        $formatted_date = $date->format('Y-m-d H:i:s');
        $Nanny_Share_Contract = subscribersPlans::whereIn('product_id', ['139545', '154368'])->where('created_at', '>',$formatted_date)->get();
        // foreach($Nanny_Share_Contract as $plansss):
        //     $usersInfo = User::where('id',$plansss->user_id)->first();
        //     $data = array(
        //         'user_first_name'=>$usersInfo->name,
        //         'emails'=>$usersInfo->email,
        //         'siteName'=>$siteName,
        //         'siteEmail'=>$siteEmail
        //     );
        //     Mail::send('emails.reminders.Nanny-Nanny-Share-Contract–Did-something-go-wrong–12-hours-after-Sign-Up-Abandoned', $data, function ($message) use ($data) {
        //         $message->subject('Did something go wrong?');
        //         $message->from($data['siteEmail']); 
        //         $message->bcc('sudhirkundal007@gmail.com');        
        //         $message->to($data['emails']);
        //     });
        // endforeach;
        return response()->json([
            'mailSend' => 'Send mail'
        ]);        
    }

    public function SendTestRemindersfirstForm20()
    {
        $inputs = Request::all();        
        $siteName = getcong('siteName');
        $siteEmail = getcong('siteEmail');
        $buy_date = date('F j,Y');
        $data = array(
            'user_first_name'=>'Test User',
            'emails'=>'dummy@domain.com',
            'siteName'=>$siteName,
            'siteEmail'=>$siteEmail
        );
        if($inputs['Background_Checks_All_Did_something_go_wrong_12_hours_after_Sign_Up_Abandoned']=='20'):    
            Mail::send('emails.reminders.Background-Checks–All–Did-something-go-wrong–12-hours-after-Sign-Up-Abandoned', $data, function ($message) use ($data) {
                $message->subject('Did something go wrong?');
                $message->from('admin@nannyparentconnection.com'); 
                $message->bcc('sudhirkundal007@gmail.com');        
                $message->to($data['siteEmail']);
            });
            return response()->json([
                'mailSend' => 'Send mail'
            ]);  
        endif;
    }

    public function SendTestRemindersfirstForm21()
    {
        $inputs = Request::all();        
        $siteName = getcong('siteName');
        $siteEmail = getcong('siteEmail');
        $Nanny_Share_Contract_Checking = subscribersPlans::whereIn('product_id', ['139545', '154368'])->where('created_at', '>=', Carbon::now()->subDays(10)->toDateTimeString())->get();
        // foreach($Nanny_Share_Contract_Checking as $plansss):
        //     $usersInfo = User::where('id',$plansss->user_id)->first();
        //     $data = array(
        //         'user_first_name'=>$usersInfo->name,
        //         'emails'=>$usersInfo->email,
        //         'siteName'=>$siteName,
        //         'siteEmail'=>$siteEmail
        //     );
        //     Mail::send('emails.reminders.Nanny-Nanny-Share-Contract–Checking-in-re-nanny-contract-and-a-quick-favor-review-referral–10-days-after-Member-Signs', $data, function ($message) use ($data) {
        //         $message->subject('Checking in re: nanny contract and a quick favor');
        //         $message->from($data['siteEmail']); 
        //         $message->bcc('sudhirkundal007@gmail.com');        
        //         $message->to($data['emails']);
        //     });
        // endforeach;
        return response()->json([
            'mailSend' => 'Send mail'
        ]);         
    }

    public function SendTestRemindersfirstForm22()
    {
        $inputs = Request::all();        
        $siteName = getcong('siteName');
        $siteEmail = getcong('siteEmail');
        $Family_Parent_All_Last_Minute_Care = subscribersPlans::whereIn('product_id', ['29748', '155721', '155718'])->where('created_at', '>=', Carbon::now()->subDays(6)->toDateTimeString())->get();
        // foreach($Family_Parent_All_Last_Minute_Care as $plansss):
        //     $usersInfo = User::where('id',$plansss->user_id)->first();
        //     $data = array(
        //         'user_first_name'=>$usersInfo->name,
        //         'emails'=>$usersInfo->email,
        //         'siteName'=>$siteName,
        //         'siteEmail'=>$siteEmail
        //     );            
        //     Mail::send('emails.reminders.Family-Parent–All–Last-Minute-Care–6-days-after-Member-Signs-Up', $data, function ($message) use ($data) {
        //         $message->subject('We are here if you need last minute child care!');
        //         $message->from($data['siteEmail']); 
        //         $message->bcc('sudhirkundal007@gmail.com');        
        //         $message->to($data['emails']);
        //     });
        // endforeach;
        return response()->json([
            'mailSend' => 'Send mail'
        ]);        
    }

    public function SendTestRemindersfirstForm23()
    {
        $inputs = Request::all();        
        $siteName = getcong('siteName');
        $siteEmail = getcong('siteEmail');
        $Care_Provider_All_Last_Minute_Care = subscribersPlans::whereIn('product_id', ['29748', '155721', '155718'])->where('created_at', '>=', Carbon::now()->subDays(1)->toDateTimeString())->get();
        // foreach($Care_Provider_All_Last_Minute_Care as $plansss):
        //     $usersInfo = User::where('id',$plansss->user_id)->first();    
        //     $data = array(
        //         'user_first_name'=>$usersInfo->name,
        //         'emails'=>$usersInfo->email,
        //         'siteName'=>$siteName,
        //         'siteEmail'=>$siteEmail
        //     );        
        //     Mail::send('emails.reminders.Care-Provider–All–Have-you-signed-up-for-our-Last-Minute-Care-Text-Service–1-day-after-Member-Signs-Up', $data, function ($message) use ($data) {
        //         $message->subject('Have you signed up for our Last Minute Care Text Service?');
        //         $message->from($data['siteEmail']); 
        //         $message->bcc('sudhirkundal007@gmail.com');        
        //         $message->to($data['emails']);
        //     });
        // endforeach;
        return response()->json([
            'mailSend' => 'Send mail'
        ]);        
    }

    public function SendTestRemindersfirstForm24()
    {
        $inputs = Request::all();        
        $siteName = getcong('siteName');
        $siteEmail = getcong('siteEmail');
        $Family_Parent_All_I_am_here_to_help = subscribersPlans::whereIn('product_id', ['29748', '155721', '155718'])->where('created_at', '>=', Carbon::now()->subDays(6)->toDateTimeString())->get();
        // foreach($Family_Parent_All_I_am_here_to_help as $plansss):
        //     $usersInfo = User::where('id',$plansss->user_id)->first();
        //     $data = array(
        //         'user_first_name'=>$usersInfo->name,
        //         'emails'=>$usersInfo->email,
        //         'siteName'=>$siteName,
        //         'siteEmail'=>$siteEmail
        //     );            
        //     Mail::send('emails.reminders.Family-Parent–All–I-am-here-to-help–4-days-after-Member-Signs-Up', $data, function ($message) use ($data) {
        //         $message->subject('Do not forget...I am here if you need help!');
        //         $message->from($data['siteEmail']); 
        //         $message->bcc('sudhirkundal007@gmail.com');        
        //         $message->to($data['emails']);
        //     });
        // endforeach;
        return response()->json([
            'mailSend' => 'Send mail'
        ]);        
    }

    public function SendTestRemindersfirstForm25()
    {
        $inputs = Request::all();        
        $siteName = getcong('siteName');
        $siteEmail = getcong('siteEmail');
        $date = new \DateTime();
        $date->modify('-36 hours');
        $formatted_date = $date->format('Y-m-d H:i:s');
        $care_providers_packages = subscribersPlans::whereIn('product_id', ['29896','176612'])->where('created_at', '>',$formatted_date)->get();
        // foreach($care_providers_packages as $plans):
        //     $usersInfo = User::where('id',$plansss->user_id)->first();
        //     $data = array(
        //         'user_first_name'=>$usersInfo->name,
        //         'emails'=>$usersInfo->email,
        //         'siteName'=>$siteName,
        //         'siteEmail'=>$siteEmail
        //     );           
        //     Mail::send('emails.reminders.Care-Provider-All–I-am-here-to-help–36-hours-after-Member-Signs-Up', $data, function ($message) use ($data) {
        //         $message->subject('Do not forget...I am here if you need help!');
        //         $message->from($data['siteEmail']); 
        //         $message->bcc('sudhirkundal007@gmail.com');        
        //         $message->to($data['emails']);
        //     });
        // endforeach;
        return response()->json([
            'mailSend' => 'Send mail'
        ]);         
    }

    public function SendTestRemindersfirstForm26()
    {
        $inputs = Request::all();        
        $siteName = getcong('siteName');
        $siteEmail = getcong('siteEmail');
        $Family_Care_Provider_Agency_One_Month_Only = subscribersPlans::whereIn('product_id', ['155718', '155712'])->where('created_at', '>=', Carbon::now()->subDays(26)->toDateTimeString())->get();
        // foreach($Family_Care_Provider_Agency_One_Month_Only as $plansss):
        //     $usersInfo = User::where('id',$plansss->user_id)->first();
        //     $data = array(
        //         'user_first_name'=>$usersInfo->name,
        //         'emails'=>$usersInfo->email,
        //         'siteName'=>$siteName,
        //         'siteEmail'=>$siteEmail
        //     );        
        //     Mail::send('emails.reminders.Family-Care-Provider-Agency–One-Month-Only–Your-access-end-soon–26-days-after-Member-Signs-Up', $data, function ($message) use ($data) {
        //         $message->subject('Your Access Ends Soon!');
        //         $message->from($data['siteEmail']); 
        //         $message->bcc('sudhirkundal007@gmail.com');        
        //         $message->to($data['emails']);
        //     });
        // endforeach;
        return response()->json([
            'mailSend' => 'Send mail'
        ]);        
    }

    public function SendTestRemindersfirstForm27()
    {
        $inputs = Request::all();        
        $siteName = getcong('siteName');
        $siteEmail = getcong('siteEmail');
        $date = new \DateTime();
        $date->modify('-2 hours');
        $formatted_date = $date->format('Y-m-d H:i:s');    
        $All_Family_Care_Provider_Agency_Memberships = subscribersPlans::whereIn('product_id', ['29748', '155721', '155718','29896','176612','30019','155715','155712'])->where('created_at', '<',$formatted_date)->get();
        // foreach($All_Family_Care_Provider_Agency_Memberships as $plansss):
        //     $usersInfo = User::where('id',$plansss->user_id)->first();
        //     $data = array(
        //         'user_first_name'=>$usersInfo->name,
        //         'emails'=>$usersInfo->email,
        //         'siteName'=>$siteName,
        //         'siteEmail'=>$siteEmail
        //     );        
        //     Mail::send('emails.reminders.All-Family-Care-Provider-Agency-Memberships–Dont-miss-out-your-membership-expires-in-minutes–2-hours-before-Subscription-Expires', $data, function ($message) use ($data) {
        //         $message->subject('Do not miss out...your membership expires in minutes!');
        //         $message->from($data['siteEmail']); 
        //         $message->bcc('sudhirkundal007@gmail.com');        
        //         $message->to($data['emails']);
        //     });
        // endforeach;
        return response()->json([
            'mailSend' => 'Send mail'
        ]);        
    }

    public function SendTestRemindersfirstForm28()
    {
        $inputs = Request::all();        
        $siteName = getcong('siteName');
        $siteEmail = getcong('siteEmail');
        $care_providers_packages = subscribersPlans::whereIn('product_id', ['29896'])->get();
        // foreach( $care_providers_packages as $packageInfo):
        //     if($packageInfo->product_id=='29896'):
        //         $current_date= date('Y-m-d');
        //         $subscr_expires_date= date('Y-m-d', strtotime('+1 year +2 day', strtotime($packageInfo->created_at->format('Y-m-d'))));
        //         if($current_date==$subscr_expires_date):
        //             $subscr_expires_at= date('F j,Y', strtotime('+1 year', strtotime($packageInfo->created_at->format('Y-m-d'))));
        //             $usersInfo = User::where('id',$packageInfo->user_id)->first();   
        //             $data = array(
        //                 'user_first_name'=>$usersInfo->name,
        //                 'subscr_expires_at'=>$subscr_expires_at,
        //                 'emails'=>$usersInfo->email,
        //                 'siteName'=>$siteName,
        //                 'siteEmail'=>$siteEmail
        //             );            
        //             Mail::send('emails.reminders.Care-Provider–All–2-days-after-Subscription-Expires', $data, function ($message) use ($data) {
        //                 $message->subject('I hope you do not leave!');
        //                 $message->from($data['siteEmail']); 
        //                 $message->bcc('sudhirkundal007@gmail.com');        
        //                 $message->to($data['emails']);
        //             });
        //         endif;            
        //     endif;
        // endforeach;
        return response()->json([
            'mailSend' => 'Send mail'
        ]);        
    }

    public function SendTestRemindersfirstForm29()
    {
        $inputs = Request::all();        
        $siteName = getcong('siteName');
        $siteEmail = getcong('siteEmail');
        $Family_Parent_All_2_days_after = subscribersPlans::whereIn('product_id', ['29748', '155721', '155718'])->get();
        // foreach($Family_Parent_All_2_days_after as $packageInfo):
        //     if($packageInfo->product_id=='29748'):
        //         $current_date= date('Y-m-d');
        //         $subscr_expires_date= date('Y-m-d', strtotime('+1 year +2 day', strtotime($packageInfo->created_at->format('Y-m-d'))));
        //         if($current_date==$subscr_expires_date):
        //             $subscr_expires_at= date('F j,Y', strtotime('+1 year', strtotime($packageInfo->created_at->format('Y-m-d'))));
        //             $usersInfo = User::where('id',$packageInfo->user_id)->first(); 
        //             $data = array(
        //                 'user_first_name'=>$usersInfo->name,
        //                 'subscr_expires_at'=>$subscr_expires_at,
        //                 'emails'=>$usersInfo->email,
        //                 'siteName'=>$siteName,
        //                 'siteEmail'=>$siteEmail
        //             );           
        //             Mail::send('emails.reminders.Family-Parent–All–2-days-after-Subscription-Expires', $data, function ($message) use ($data) {
        //                 $message->subject('I hope you do not leave!');
        //                 $message->from($data['siteEmail']); 
        //                 $message->bcc('sudhirkundal007@gmail.com');        
        //                 $message->to($data['emails']);
        //             });
        //         endif;
        //     elseif($packageInfo->product_id=='155721'):
        //         $current_date= date('Y-m-d');
        //         $subscr_expires_date= date('Y-m-d', strtotime('+1 month +2 day', strtotime($packageInfo->created_at->format('Y-m-d'))));
        //         if($current_date==$subscr_expires_date):
        //             $subscr_expires_at= date('F j,Y', strtotime('+1 month', strtotime($packageInfo->created_at->format('Y-m-d'))));
        //             $usersInfo = User::where('id',$packageInfo->user_id)->first(); 
        //             $data = array(
        //                 'user_first_name'=>$usersInfo->name,
        //                 'subscr_expires_at'=>$subscr_expires_at,
        //                 'emails'=>$usersInfo->email,
        //                 'siteName'=>$siteName,
        //                 'siteEmail'=>$siteEmail
        //             );           
        //             Mail::send('emails.reminders.Family-Parent–All–2-days-after-Subscription-Expires', $data, function ($message) use ($data) {
        //                 $message->subject('I hope you do not leave!');
        //                 $message->from($data['siteEmail']); 
        //                 $message->bcc('sudhirkundal007@gmail.com');        
        //                 $message->to($data['emails']);
        //             });
        //         endif;
        //     elseif($packageInfo->product_id=='155718'):
        //         $current_date= date('Y-m-d');
        //         $subscr_expires_date= date('Y-m-d', strtotime('+1 month +2 day', strtotime($packageInfo->created_at->format('Y-m-d'))));
        //         if($current_date==$subscr_expires_date):
        //             $subscr_expires_at= date('F j,Y', strtotime('+1 month', strtotime($packageInfo->created_at->format('Y-m-d'))));
        //             $usersInfo = User::where('id',$packageInfo->user_id)->first(); 
        //             $data = array(
        //                 'user_first_name'=>$usersInfo->name,
        //                 'subscr_expires_at'=>$subscr_expires_at,
        //                 'emails'=>$usersInfo->email,
        //                 'siteName'=>$siteName,
        //                 'siteEmail'=>$siteEmail
        //             );           
        //             Mail::send('emails.reminders.Family-Parent–All–2-days-after-Subscription-Expires', $data, function ($message) use ($data) {
        //                 $message->subject('I hope you do not leave!');
        //                 $message->from($data['siteEmail']); 
        //                 $message->bcc('sudhirkundal007@gmail.com');        
        //                 $message->to($data['emails']);
        //             });
        //         endif;
        //     endif;
        // endforeach;
        return response()->json([
            'mailSend' => 'Send mail'
        ]);         
    }

    public function SendTestRemindersfirstForm30()
    {
        $inputs = Request::all();        
        $siteName = getcong('siteName');
        $siteEmail = getcong('siteEmail');
        $Family_Care_Provider_Agency_One_Month_Only = subscribersPlans::whereIn('product_id', ['29748', '155721', '155718','29896','30019','155715','155712'])->get();
        // foreach($Family_Care_Provider_Agency_One_Month_Only as $packageInfo):
        //     if($packageInfo->product_id=='29748'):
        //         $subscr_expires_date= date('Y-m-d', strtotime('+1 year +2 day', strtotime($packageInfo->created_at->format('Y-m-d'))));
        //         $current_date= date('Y-m-d');
        //         if($current_date==$subscr_expires_date):
        //             $subscr_expires_at= date('F j,Y', strtotime('+1 year', strtotime($packageInfo->created_at->format('Y-m-d'))));
        //             $usersInfo = User::where('id',$packageInfo->user_id)->first();
        //             $data = array(
        //                 'user_first_name'=>$usersInfo->name,
        //                 'subscr_expires_at'=>$subscr_expires_at,
        //                 'emails'=>$usersInfo->email,
        //                 'siteName'=>$siteName,
        //                 'siteEmail'=>$siteEmail
        //             );            
        //             Mail::send('emails.reminders.Family-Parent-Agency-Care-Provider–All–2-days-after-Sign-Up-Abandoned', $data, function ($message) use ($data) {
        //                 $message->subject('Telephone call?');
        //                 $message->from($data['siteEmail']); 
        //                 $message->bcc('sudhirkundal007@gmail.com');        
        //                 $message->to($data['emails']);
        //             });
        //         endif;
        //     elseif($packageInfo->product_id=='155721'):
        //         $subscr_expires_date= date('Y-m-d', strtotime('+1 month +2 day', strtotime($packageInfo->created_at->format('Y-m-d'))));
        //         $current_date= date('Y-m-d');
        //         if($current_date==$subscr_expires_date):
        //             $subscr_expires_at= date('F j,Y', strtotime('+1 month', strtotime($packageInfo->created_at->format('Y-m-d'))));
        //             $usersInfo = User::where('id',$packageInfo->user_id)->first();
        //             $data = array(
        //                 'user_first_name'=>$usersInfo->name,
        //                 'subscr_expires_at'=>$subscr_expires_at,
        //                 'emails'=>$usersInfo->email,
        //                 'siteName'=>$siteName,
        //                 'siteEmail'=>$siteEmail
        //             );            
        //             Mail::send('emails.reminders.Family-Parent-Agency-Care-Provider–All–2-days-after-Sign-Up-Abandoned', $data, function ($message) use ($data) {
        //                 $message->subject('Telephone call?');
        //                 $message->from($data['siteEmail']); 
        //                 $message->bcc('sudhirkundal007@gmail.com');        
        //                 $message->to($data['emails']);
        //             });
        //         endif;
        //     elseif($packageInfo->product_id=='155718'):
        //         $subscr_expires_date= date('Y-m-d', strtotime('+1 month +2 day', strtotime($packageInfo->created_at->format('Y-m-d'))));
        //         $current_date= date('Y-m-d');
        //         if($current_date==$subscr_expires_date):
        //             $subscr_expires_at= date('F j,Y', strtotime('+1 month', strtotime($packageInfo->created_at->format('Y-m-d'))));
        //             $usersInfo = User::where('id',$packageInfo->user_id)->first();
        //             $data = array(
        //                 'user_first_name'=>$usersInfo->name,
        //                 'subscr_expires_at'=>$subscr_expires_at,
        //                 'emails'=>$usersInfo->email,
        //                 'siteName'=>$siteName,
        //                 'siteEmail'=>$siteEmail
        //             );            
        //             Mail::send('emails.reminders.Family-Parent-Agency-Care-Provider–All–2-days-after-Sign-Up-Abandoned', $data, function ($message) use ($data) {
        //                 $message->subject('Telephone call?');
        //                 $message->from($data['siteEmail']); 
        //                 $message->bcc('sudhirkundal007@gmail.com');        
        //                 $message->to($data['emails']);
        //             });
        //         endif;
        //     elseif($packageInfo->product_id=='29896'): 
        //         $subscr_expires_date= date('Y-m-d', strtotime('+1 year +2 day', strtotime($packageInfo->created_at->format('Y-m-d'))));
        //         $current_date= date('Y-m-d');
        //         if($current_date==$subscr_expires_date):
        //             $subscr_expires_at= date('F j,Y', strtotime('+1 year', strtotime($packageInfo->created_at->format('Y-m-d'))));
        //             $usersInfo = User::where('id',$packageInfo->user_id)->first();
        //             $data = array(
        //                 'user_first_name'=>$usersInfo->name,
        //                 'subscr_expires_at'=>$subscr_expires_at,
        //                 'emails'=>$usersInfo->email,
        //                 'siteName'=>$siteName,
        //                 'siteEmail'=>$siteEmail
        //             );            
        //             Mail::send('emails.reminders.Family-Parent-Agency-Care-Provider–All–2-days-after-Sign-Up-Abandoned', $data, function ($message) use ($data) {
        //                 $message->subject('Telephone call?');
        //                 $message->from($data['siteEmail']); 
        //                 $message->bcc('sudhirkundal007@gmail.com');        
        //                 $message->to($data['emails']);
        //             });
        //         endif;
        //     elseif($packageInfo->product_id=='30019'):
        //         $subscr_expires_date= date('Y-m-d', strtotime('+1 year +2 day', strtotime($packageInfo->created_at->format('Y-m-d'))));
        //         $current_date= date('Y-m-d');
        //         if($current_date==$subscr_expires_date):
        //             $subscr_expires_at= date('F j,Y', strtotime('+1 year', strtotime($packageInfo->created_at->format('Y-m-d'))));
        //             $usersInfo = User::where('id',$packageInfo->user_id)->first();
        //             $data = array(
        //                 'user_first_name'=>$usersInfo->name,
        //                 'subscr_expires_at'=>$subscr_expires_at,
        //                 'emails'=>$usersInfo->email,
        //                 'siteName'=>$siteName,
        //                 'siteEmail'=>$siteEmail
        //             );            
        //             Mail::send('emails.reminders.Family-Parent-Agency-Care-Provider–All–2-days-after-Sign-Up-Abandoned', $data, function ($message) use ($data) {
        //                 $message->subject('Telephone call?');
        //                 $message->from($data['siteEmail']); 
        //                 $message->bcc('sudhirkundal007@gmail.com');        
        //                 $message->to($data['emails']);
        //             });
        //         endif; 
        //     elseif($packageInfo->product_id=='155715'):
        //         $subscr_expires_date= date('Y-m-d', strtotime('+1 month +2 day', strtotime($packageInfo->created_at->format('Y-m-d'))));
        //         $current_date= date('Y-m-d');
        //         if($current_date==$subscr_expires_date):
        //             $subscr_expires_at= date('F j,Y', strtotime('+1 month', strtotime($packageInfo->created_at->format('Y-m-d'))));
        //             $usersInfo = User::where('id',$packageInfo->user_id)->first();
        //             $data = array(
        //                 'user_first_name'=>$usersInfo->name,
        //                 'subscr_expires_at'=>$subscr_expires_at,
        //                 'emails'=>$usersInfo->email,
        //                 'siteName'=>$siteName,
        //                 'siteEmail'=>$siteEmail
        //             );            
        //             Mail::send('emails.reminders.Family-Parent-Agency-Care-Provider–All–2-days-after-Sign-Up-Abandoned', $data, function ($message) use ($data) {
        //                 $message->subject('Telephone call?');
        //                 $message->from($data['siteEmail']); 
        //                 $message->bcc('sudhirkundal007@gmail.com');        
        //                 $message->to($data['emails']);
        //             });
        //         endif; 
        //     elseif($packageInfo->product_id=='155712'): 
        //         $subscr_expires_date= date('Y-m-d', strtotime('+1 month +2 day', strtotime($packageInfo->created_at->format('Y-m-d'))));
        //         $current_date= date('Y-m-d');
        //         if($current_date==$subscr_expires_date):
        //             $subscr_expires_at= date('F j,Y', strtotime('+1 month', strtotime($packageInfo->created_at->format('Y-m-d'))));
        //             $usersInfo = User::where('id',$packageInfo->user_id)->first();
        //             $data = array(
        //                 'user_first_name'=>$usersInfo->name,
        //                 'subscr_expires_at'=>$subscr_expires_at,
        //                 'emails'=>$usersInfo->email,
        //                 'siteName'=>$siteName,
        //                 'siteEmail'=>$siteEmail
        //             );            
        //             Mail::send('emails.reminders.Family-Parent-Agency-Care-Provider–All–2-days-after-Sign-Up-Abandoned', $data, function ($message) use ($data) {
        //                 $message->subject('Telephone call?');
        //                 $message->from($data['siteEmail']); 
        //                 $message->bcc('sudhirkundal007@gmail.com');        
        //                 $message->to($data['emails']);
        //             });
        //         endif;
        //     endif;
        // endforeach;
        return response()->json([
            'mailSend' => 'Send mail'
        ]);        
    }

    public function SendTestRemindersfirstForm31()
    {
        $inputs = Request::all();        
        $siteName = getcong('siteName');
        $siteEmail = getcong('siteEmail');
        $Family_Care_Provider_Agency_One_Month_Only = subscribersPlans::whereIn('product_id', ['155721', '176612','155715'])->get();
        // foreach($Family_Care_Provider_Agency_One_Month_Only as $packageInfo):
        //     $subscr_expires_date= date('Y-m-d', strtotime('+1 month -3 day', strtotime($packageInfo->created_at->format('Y-m-d'))));
        //     $current_date= date('Y-m-d');
        //     if($current_date==$subscr_expires_date):
        //         $subscr_expires_at= date('F j,Y', strtotime('+1 month', strtotime($packageInfo->created_at->format('Y-m-d'))));
        //         $usersInfo = User::where('id',$packageInfo->user_id)->first();
        //         $data = array(
        //             'user_first_name'=>$usersInfo->name,
        //             'subscr_expires_at'=>$subscr_expires_at,
        //             'emails'=>$usersInfo->email,
        //             'siteName'=>$siteName,
        //             'siteEmail'=>$siteEmail
        //         );           
        //         Mail::send('emails.reminders.Family-Parent-Care-Provider-Agency–Monthly–3-days-before-Subscription-Expires', $data, function ($message) use ($data) {
        //             $message->subject('Your Membership Is Expiring Soon!');
        //             $message->from($data['siteEmail']); 
        //             $message->bcc('sudhirkundal007@gmail.com');        
        //             $message->to($data['emails']);
        //         });
        //     endif;
        // endforeach;
        return response()->json([
            'mailSend' => 'Send mail'
        ]);        
    }

    public function SendTestRemindersfirstForm32()
    {
        $inputs = Request::all();        
        $siteName = getcong('siteName');
        $siteEmail = getcong('siteEmail');
        $buy_date = date('F j,Y');
        $data = array(
            'user_first_name'=>'Test User',
            'subscr_expires_at'=>$buy_date,
            'emails'=>'dummy@domain.com',
            'siteName'=>$siteName,
            'siteEmail'=>$siteEmail
        );
        if($inputs['Agency_Family_Parent_Care_Provider_All_12_hours_after_Sign_Up_Abandoned']=='32'):    
            Mail::send('emails.reminders.Agency-Family-Parent-Care-Provider–All–12-hours-after-Sign-Up-Abandoned', $data, function ($message) use ($data) {
                $message->subject('Your Membership Is Expiring Soon!');
                $message->from('admin@nannyparentconnection.com'); 
                $message->bcc('sudhirkundal007@gmail.com');        
                $message->to($data['siteEmail']);
            });
            return response()->json([
                'mailSend' => 'Send mail'
            ]);  
        endif;
    }

}

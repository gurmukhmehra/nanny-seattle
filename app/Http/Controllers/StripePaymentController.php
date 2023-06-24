<?php

namespace App\Http\Controllers;

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
use App\Models\subscribersPlans;
use App\Models\SubscriptionsTransactions;
use Illuminate\Support\Facades\Mail;
use App\Models\PaymentGateway;

class StripePaymentController extends Controller
{
    public function paymentGateway()
    {
        $patmentGateway = PaymentGateway::where('id',1)->first();
        return response()->json([
            'patmentGateway' => $patmentGateway
        ]);
    }

    public function webhooks()
    { 
        /****************** Live Webhook *************************/
        $patmentGateway = PaymentGateway::where('id',1)->first();
        if($patmentGateway->payment_mode=='test_mode'){
            $endpoint_secret = 'whsec_ljF0bfEKxjUQwpNNx9BynEPFIybFl2In';
        }else{
            $endpoint_secret = 'whsec_uAkNBNuxx1v5H7KLLIZQqmpj1DzBEC0U';
        }                                  
           
        /********************* Live Webhook **********************/
        //$endpoint_secret = 'whsec_621c4d8197045f5daa7bb0fe27d8b8ba47e67a01d1893b9cfbf6f7bb733996c8';
        $payload = @file_get_contents('php://input');           
            $sig_header = $_SERVER['HTTP_STRIPE_SIGNATURE'];
        $event = null;
        try {
            $event = \Stripe\Webhook::constructEvent(
                $payload, $sig_header, $endpoint_secret                
            );
        } catch(\UnexpectedValueException $e) { 
            // Invalid payload          
            http_response_code(400);
            exit();
        } catch(\Stripe\Exception\SignatureVerificationException $e) {
            // Invalid signature
            http_response_code(400);
            exit();
        }
        // Handle the event
        switch ($event->type) {
            
        case 'invoice.payment_succeeded':
            $patmentGateway2 = PaymentGateway::where('id',1)->first();
            $invoice = $event->data->object;           
            if($patmentGateway2->payment_mode=='test_mode'){
                $stripe = new \Stripe\StripeClient(
                    'sk_test_VTsUt7dFurCaJnC0Z1izh2Fo'
                );
            }else{
                $stripe = new \Stripe\StripeClient(
                    'sk_live_ys6irpPxtYnH1h1JLcdXkkxT'
                );
            }          

            // $subscriptions= $stripe->charges->retrieve(
            //     $invoice->charges
            //     //['expand' => ['customer', 'invoice.subscription']]
            // );            
            
            $findUserInfo = User::where('email',$invoice->customer_email)->first();
            $findMemberShipInfo = Membership::where('stripe_prod_priceID',$invoice->lines->data[0]->price->id)->first();
           
            $findSubcription = new subscribersPlans;
            $findSubcription->user_id = $findUserInfo->id;
            $findSubcription->product_id = $findMemberShipInfo->id;
            if(!empty($invoice->subscription)):
                $findSubcription->subscr_id = $invoice->subscription;
            endif;
            $findSubcription->coupon_id = '0';
            $findSubcription->tax_amount = '0.00';
            $findSubcription->tax_rate = '0.000';
            $findSubcription->tax_compound = '0';
            $findSubcription->tax_shipping = '1';
            $findSubcription->tax_class = 'standard';
            $findSubcription->price = $findMemberShipInfo->mepr_product_price;
            $findSubcription->total = $findMemberShipInfo->mepr_product_price;
            $findSubcription->gateway = 'stripe';
            if(!empty($paymentIntent->lines->data[0]->price->recurring)):
                $findSubcription->period = $paymentIntent->lines->data[0]->price->recurring->interval_count;
                $findSubcription->period_type = $paymentIntent->lines->data[0]->price->recurring->interval;        
            endif;
            $findSubcription->status = 'active';
            // $findSubcription->cc_last4 = $subscriptions->payment_method_details->card->last4;
            // $findSubcription->cc_exp_month = $subscriptions->payment_method_details->card->exp_month;
            // $findSubcription->cc_exp_year = $subscriptions->payment_method_details->card->exp_year;
            $findSubcription->buy_data_time = $invoice->created;
            $findSubcription->save();

            $subscriptionTransaction = new SubscriptionsTransactions;
            $subscriptionTransaction->user_id = $findSubcription->user_id;
            $subscriptionTransaction->product_id = $findSubcription->product_id;
            $subscriptionTransaction->subscription_id = $findSubcription->id;
            $subscriptionTransaction->amount = $findMemberShipInfo->mepr_product_price;
            $subscriptionTransaction->total = $findMemberShipInfo->mepr_product_price;
            $subscriptionTransaction->trans_num = $invoice->charges;
            $subscriptionTransaction->tax_compound = $findSubcription->tax_compound;
            $subscriptionTransaction->tax_shipping = $findSubcription->tax_shipping;
            $subscriptionTransaction->tax_class = $findSubcription->tax_class;
            $subscriptionTransaction->coupon_id = $findSubcription->coupon_id;
            $subscriptionTransaction->status = 'complete';
            $subscriptionTransaction->txn_type = 'payment';
            $subscriptionTransaction->gateway = 'stripe';
            $subscriptionTransaction->updated_at = date('Y-m-d H:i:s',$invoice->lines->data[0]->period->end);
            $subscriptionTransaction->save();           

            $siteName = getcong('siteName');
            $siteEmail = getcong('siteEmail');
            $IP_address = request()->getClientIp(); 
            $buy_date = date('F j,Y');

            $data = array(
                'siteName'=>$siteName,
                'siteEmail'=>$siteEmail,
                'name'=>$findUserInfo->name,
                'user_first_name'=>$findUserInfo->name,
                'email'=>$findUserInfo->email,
                'membership'=>$findMemberShipInfo->post_title,
                'membership_price'=>$findMemberShipInfo->mepr_product_price,
                'membership_period'=>$findMemberShipInfo->mepr_product_period,
                'user_full_name'=>$findUserInfo->name,
                'user_login'=>$findUserInfo->username,
                'username'=>$findUserInfo->username,
                'user_id'=>$findUserInfo->id,
                'productName'=>$findMemberShipInfo->post_title,
                'user_email'=>$findUserInfo->email,
                'user_remote_addr'=>$IP_address,
                'trans_num'=>$invoice->charges,
                'payment_amount'=>$findMemberShipInfo->mepr_product_price,
                'trans_gateway'=>'Credit Card (Stripe)',
                'product_name'=>$findMemberShipInfo->post_title,
                'subscr_num'=>$invoice->charges,
                'subscr_terms'=>$findMemberShipInfo->mepr_product_price,
                'subscr_date'=>$buy_date,
                'subscr_gateway'=>'Credit Card (Stripe)',
                'invoice_num'=>$invoice->id,
                'trans_date'=>$buy_date,
                'trans_num'=>$invoice->id,
                'user_address'=>$findUserInfo->address1,                 
            );

            /******************** Email To Member ******************************/
            if($findMemberShipInfo->id=='29748' || $findMemberShipInfo->id=='184396'): //test product 184396, live product 29748
                Mail::send('emails.Welcome_emails.Family-Parent-Annual', $data, function ($message) use ($data) {
                    $message->subject('Welcome to the '.$data['siteName'].'!');
                    $message->from('admin@nannyparentconnection.com', $data['siteName']);
                    $message->bcc('sudhirkundal007@gmail.com');         
                    $message->to($data['email']);
                });
            elseif($findMemberShipInfo->id=='155721' || $findMemberShipInfo->id=='184397'): //test product 184397, live product 155721
                Mail::send('emails.Welcome_emails.Family-Parent-Monthly', $data, function ($message) use ($data) {
                    $message->subject('Welcome to the '.$data['siteName'].'!');
                    $message->from('admin@nannyparentconnection.com', $data['siteName']);
                    $message->bcc('sudhirkundal007@gmail.com');         
                    $message->to($data['email']);
                });
            elseif($findMemberShipInfo->id=='155718' || $findMemberShipInfo->id=='184398'): //test product 184398, live product 155718
                Mail::send('emails.Welcome_emails.Family-Parent-One-Month-Only', $data, function ($message) use ($data) {
                    $message->subject('Welcome to the '.$data['siteName'].'!');
                    $message->from('admin@nannyparentconnection.com', $data['siteName']);
                    $message->bcc('sudhirkundal007@gmail.com');        
                    $message->to($data['email']);
                });
            elseif($findMemberShipInfo->id=='29896' || $findMemberShipInfo->id=='184399'): //test product 184399, live product 29896
                Mail::send('emails.Welcome_emails.Care-Provider-Annual', $data, function ($message) use ($data) {
                    $message->subject('Welcome to the '.$data['siteName'].'!');
                    $message->from('admin@nannyparentconnection.com', $data['siteName']);
                    $message->bcc('sudhirkundal007@gmail.com');         
                    $message->to($data['email']);
                });
            elseif($findMemberShipInfo->id=='176612'):
                Mail::send('emails.Welcome_emails.Care-Provider-Monthly', $data, function ($message) use ($data) {
                    $message->subject('Welcome to the '.$data['siteName'].'!');
                    $message->from('admin@nannyparentconnection.com', $data['siteName']);
                    $message->bcc('sudhirkundal007@gmail.com');         
                    $message->to($data['email']);
                });
            elseif($findMemberShipInfo->id=='30019' || $findMemberShipInfo->id=='184400'): //test product 184400, live product 30019
                Mail::send('emails.Welcome_emails.Agencies-Annual', $data, function ($message) use ($data) {
                        $message->subject('Welcome to the '.$data['siteName'].'!');
                        $message->from('admin@nannyparentconnection.com', $data['siteName']);
                        $message->bcc('sudhirkundal007@gmail.com');         
                        $message->to($data['email']);
                });
            elseif($findMemberShipInfo->id=='155715' || $findMemberShipInfo->id=='184401'): //test product 184401, live product 155715
                Mail::send('emails.Welcome_emails.Agencies-Monthly', $data, function ($message) use ($data) {
                    $message->subject('Welcome to the '.$data['siteName'].'!');
                    $message->from('admin@nannyparentconnection.com', $data['siteName']);
                    $message->bcc('sudhirkundal007@gmail.com');         
                    $message->to($data['email']);
                });
            elseif($findMemberShipInfo->id=='155712' || $findMemberShipInfo->id=='184402'): //test product 184401, live product 155712
                Mail::send('emails.Welcome_emails.Agencies-One-Month-Only', $data, function ($message) use ($data) {
                    $message->subject('Welcome to the '.$data['siteName'].'!');
                    $message->from('admin@nannyparentconnection.com', $data['siteName']);
                    $message->bcc('sudhirkundal007@gmail.com');         
                    $message->to($data['email']);
                });
            elseif($findMemberShipInfo->id=='154368'|| $findMemberShipInfo->id=='184404'): //test product 184404, live product 154368
                Mail::send('emails.Welcome_emails.nanny-share-contract', $data, function ($message) use ($data) {
                    $message->subject('Your Contract Purchase is Complete!');
                    $message->from('admin@nannyparentconnection.com', $data['siteName']);
                    $message->bcc('sudhirkundal007@gmail.com');         
                    $message->to($data['email']);
                });
            else:
                Mail::send('emails.register', $data, function ($message) use ($data) {
                    $message->subject('Welcome to the '.$data['siteName'].'!');
                    $message->from('admin@nannyparentconnection.com', $data['siteName']);         
                    $message->to($data['email']);
                    $message->bcc('sudhirkundal007@gmail.com');
                });
            endif;

            // Mail::send('emails.user_new_membership', $data, function ($message) use ($data) {
            //     $message->subject('Buy Membership ' .$data['siteName']);
            //     $message->from('admin@nannyparentconnection.com', $data['siteName']);         
            //     $message->to($data['email']);
            //     $message->bcc('sudhirkundal007@gmail.com');
            // });                
            /******************** Email To Admin ******************************/
                if($findMemberShipInfo->mepr_product_period='lifetime'):
                    Mail::send('emails.Admin_New_One_Time_Subscription_Notice', $data, function ($message) use ($data) {
                        $message->subject('** New One-Time Subscription: '.$data['trans_num']);
                        $message->from('admin@nannyparentconnection.com');
                        $message->bcc('sudhirkundal007@gmail.com');          
                        $message->to($data['siteEmail']);
                    });
                else:
                    Mail::send('emails.Admin_New_Recurring_Subscription_Notice', $data, function ($message) use ($data) {
                        $message->subject('New Recurring Subscription:'. $data['user_full_name']);
                        $message->from('admin@nannyparentconnection.com'); 
                        $message->bcc('sudhirkundal007@gmail.com');        
                        $message->to($data['siteEmail']);
                    });
                endif;

                Mail::send('emails.Admin_Payment_Receipt_Notice', $data, function ($message) use ($data) {
                    $message->subject('Payment of'. $data['payment_amount'].' from' .$data['user_full_name']);
                    $message->from('admin@nannyparentconnection.com'); 
                    $message->bcc('sudhirkundal007@gmail.com');         
                    $message->to($data['siteEmail']);
                });

                Mail::send('emails.new_register', $data, function ($message) use ($data) {
                    $message->subject('New Signup: '.$data['user_login']);
                    $message->from('admin@nannyparentconnection.com');
                    $message->bcc('sudhirkundal007@gmail.com');          
                    $message->to($data['siteEmail']);                    
                });
            /******************** Email To Admin ******************************/
            break;
        case 'payment_intent.payment_failed':
            $patmentGateway3 = PaymentGateway::where('id',1)->first();
            $paymentIntent = $event->data->object;           
            if($patmentGateway3->payment_mode=='test_mode'){
                $stripe = new \Stripe\StripeClient(
                    'sk_test_VTsUt7dFurCaJnC0Z1izh2Fo'
                );
            }else{
                $stripe = new \Stripe\StripeClient(
                    'sk_live_ys6irpPxtYnH1h1JLcdXkkxT'
                );
            } 

            $findUserInfo = User::where('email',$subscriptions->customer->email)->first();
            $findMemberShipInfo = Membership::where('stripe_prod_id',$subscriptions->invoice->lines->data[0]->plan->product)->first();

            $findSubcription = new subscribersPlans;
            $findSubcription->user_id = $findUserInfo->id;
            $findSubcription->product_id = $findMemberShipInfo->id;
            $findSubcription->subscr_id = $subscriptions->invoice->lines->data[0]->subscription;
            $findSubcription->coupon_id = '0';
            $findSubcription->tax_amount = '0.00';
            $findSubcription->tax_rate = '0.000';
            $findSubcription->tax_compound = '0';
            $findSubcription->tax_shipping = '1';
            $findSubcription->tax_class = 'standard';
            $findSubcription->price = $findMemberShipInfo->mepr_product_price;
            $findSubcription->total = $findMemberShipInfo->mepr_product_price;
            $findSubcription->gateway = 'stripe';
            $findSubcription->period = $subscriptions->invoice->lines->data[0]->price->recurring->interval_count;
            $findSubcription->period_type = $subscriptions->invoice->lines->data[0]->price->recurring->interval;        
            $findSubcription->status = 'cancelled';
            $findSubcription->cc_last4 = $paymentIntent->charges->data[0]->payment_method_details->card->last4;
            $findSubcription->cc_exp_month = $paymentIntent->charges->data[0]->payment_method_details->card->exp_month;
            $findSubcription->cc_exp_year = $paymentIntent->charges->data[0]->payment_method_details->card->exp_year;
            $findSubcription->buy_data_time = $paymentIntent->created;
            $findSubcription->save();

            $subscriptionTransaction = new SubscriptionsTransactions;
            $subscriptionTransaction->user_id = $findSubcription->user_id;
            $subscriptionTransaction->product_id = $findSubcription->product_id;
            $subscriptionTransaction->subscription_id = $findSubcription->id;
            $subscriptionTransaction->amount = $findMemberShipInfo->mepr_product_price;
            $subscriptionTransaction->total = $findMemberShipInfo->mepr_product_price;
            $subscriptionTransaction->trans_num = $paymentIntent->charges->data[0]->id;
            $subscriptionTransaction->tax_compound = $findSubcription->tax_compound;
            $subscriptionTransaction->tax_shipping = $findSubcription->tax_shipping;
            $subscriptionTransaction->tax_class = $findSubcription->tax_class;
            $subscriptionTransaction->coupon_id = $findSubcription->coupon_id;
            $subscriptionTransaction->status = 'failed';
            $subscriptionTransaction->txn_type = 'payment';
            $subscriptionTransaction->gateway = 'stripe';
            $subscriptionTransaction->updated_at = date('Y-m-d H:i:s',$subscriptions->invoice->lines->data[0]->period->end);
            $subscriptionTransaction->save();

            $siteName = getcong('siteName');
            $siteEmail = getcong('siteEmail');
            $buy_date = date('F j,Y');
            $data = array(
                'siteName'=>$siteName,
                'siteEmail'=>$siteEmail,
                'user_first_name'=>$findUserInfo->firstName,
                'payment_amount'=>$findMemberShipInfo->mepr_product_price,
                'trans_num'=>$paymentIntent->charges->data[0]->id,
                'trans_gateway'=>'Credit Card (Stripe)',
                'user_full_name'=>$findUserInfo->name,
                'user_email'=>$findUserInfo->email,
                'user_login'=>$findUserInfo->username,
                'trans_date'=>$buy_date 
            );
            
            /******************** Email To Member ******************************/
                Mail::send('emails.Stripe_Failed_Payment_Notice', $data, function ($message) use ($data) {
                    $message->subject('Your Transaction Failed');
                    $message->from('gurmukhsingh997@gmail.com', $data['siteName']);     
                    $message->bcc('sudhirkundal007@gmail.com');
                    $message->to($data['user_email']);                    
                });
            /******************** Email To Admin ******************************/
                Mail::send('emails.Admin_Failed_Transaction_Notice', $data, function ($message) use ($data) {
                    $message->subject('Transaction Failed');
                    $message->from('admin@nannyparentconnection.com', $data['siteName']);
                    $message->bcc('sudhirkundal007@gmail.com');          
                    $message->to($data['siteEmail']);
                });

            break;
        // ... handle other event types
        default:
            echo 'Received unknown event type ' . $event->type;
        }
        http_response_code(200);
    }

    public function successURL()
    { 
        return response()->json([
            'paymentSuccss' => 'Thank for buy plan.'
        ]);  
    }
}

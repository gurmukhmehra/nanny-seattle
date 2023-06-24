@extends('admin.layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row page-titles mx-0">        
        <div class="col-sm-6 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{URL::to('superadmin/dashboard')}}">Dashboard</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Test Emails Format</a></li>
            </ol>
        </div>		
	</div> 
    <div class="row">
        <div class="col-lg-12">
            <div class="card" style="background-color:#B3ABAB47;">                
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h4>Test Email Template Format</h4>
                            <div class="form-check mt-2">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input importsData" checked value="{{encrypt('welcomeEmail')}}" name="testEmailFormat">Welcome Email
                                </label>
                            </div>
                            <!-- <div class="form-check mt-2">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input importsData" value="{{encrypt('newMembership')}}" name="testEmailFormat">New Membership
                                </label>
                            </div>                    
                            <div class="form-check mt-2">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input importsData" value="{{encrypt('newPrivateMessage')}}" name="testEmailFormat">New Private Message
                                </label>
                            </div>
                            <div class="form-check mt-2">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input importsData" value="{{encrypt('newFriendRequest')}}" name="testEmailFormat">New Friend Request
                                </label>
                            </div>
                            <div class="form-check mt-2">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input importsData" value="{{encrypt('AcceptedFriendRequest')}}" name="testEmailFormat">Accepted Friend Request
                                </label>
                            </div> -->
                            <div class="form-check mt-2">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input importsData" value="{{encrypt('upgraded_Subscription_Notice')}}" name="testEmailFormat"> Upgraded Subscription Notice
                                </label>
                            </div>
                            <div class="form-check mt-2">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input importsData" value="{{encrypt('downgraded_Subscription_Notice')}}" name="testEmailFormat"> Downgraded Subscription Notice
                                </label>
                            </div>                            
                            <div class="form-check mt-2">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input importsData" value="{{encrypt('Stripe_Failed_Payment')}}" name="testEmailFormat"> Stripe Failed Payment
                                </label>
                            </div>
                            <div class="form-check mt-2">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input importsData" value="{{encrypt('contactUs')}}" name="testEmailFormat"> Contact Us
                                </label>
                            </div>
                            <div class="form-check mt-2">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input importsData" value="{{encrypt('Concierge_Service_Initial_Intake_Form')}}" name="testEmailFormat"> Concierge Service - Initial Intake Form
                                </label>
                            </div>
                            <div class="form-check mt-2">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input importsData" value="{{encrypt('Current_Open_Positions_Application_for_Care_Providers')}}" name="testEmailFormat"> Current Open Positions Application for Care Providers
                                </label>
                            </div>
                            <div class="form-check mt-2">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input importsData" value="{{encrypt('HomePay_Sign_Up_Form')}}" name="testEmailFormat"> HomePay Sign Up Form
                                </label>
                            </div>
                            <div class="form-check mt-2">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input importsData" value="{{encrypt('Information_Request_Form')}}" name="testEmailFormat"> Information Request Form
                                </label>
                            </div>
                            <div class="form-check mt-2">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input importsData" value="{{encrypt('User_Last_Minute_Care_Services')}}" name="testEmailFormat"> Last Minute Care Services
                                </label>
                            </div>
                            <div class="form-check mt-2">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input importsData" value="{{encrypt('Last_Minute_Care_Submission_Form')}}" name="testEmailFormat"> Last Minute Care Text Message Submission Form
                                </label>
                            </div>
                            <div class="form-check mt-2">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input importsData" value="{{encrypt('Pay_Calculator')}}" name="testEmailFormat"> Pay Calculator
                                </label>
                            </div>
                            <div class="form-check mt-2">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input importsData" value="{{encrypt('Pay_Rate_Worksheet_for_Parents')}}" name="testEmailFormat"> Pay Rate Worksheet for Parents
                                </label>
                            </div>
                            <div class="form-check mt-2">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input importsData" value="{{encrypt('Verified_Care_Provider_Submission_Form')}}" name="testEmailFormat"> Verified Care Provider Submission Form
                                </label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h5>Admin Emails & Notices</h5> 
                            <div class="form-check mt-2">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input importsData" value="{{encrypt('Admin_New_Signup_Notice')}}" name="testEmailFormat"> New Signup Notice
                                </label>
                            </div>
                            <div class="form-check mt-2">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input importsData" value="{{encrypt('Admin_New_One_Time_Subscription_Notice')}}" name="testEmailFormat"> New One-Time Subscription Notice
                                </label>
                            </div>
                            <div class="form-check mt-2">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input importsData" value="{{encrypt('Admin_New_Recurring_Subscription_Notice')}}" name="testEmailFormat"> New Recurring Subscription Notice
                                </label>
                            </div>
                            <div class="form-check mt-2">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input importsData" value="{{encrypt('Admin_Payment_Receipt_Notice')}}" name="testEmailFormat"> Payment Receipt Notice
                                </label>
                            </div>
                            <div class="form-check mt-2">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input importsData" value="{{encrypt('Admin_Cancelled_Subscription_Notice')}}" name="testEmailFormat"> Cancelled Subscription Notice
                                </label>
                            </div>
                            <div class="form-check mt-2">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input importsData" value="{{encrypt('Admin_Upgraded_Subscription_Notice')}}" name="testEmailFormat"> Upgraded Subscription Notice
                                </label>
                            </div>
                            <div class="form-check mt-2">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input importsData" value="{{encrypt('Admin_Downgraded_Subscription_Notice')}}" name="testEmailFormat"> Downgraded Subscription Notice
                                </label>
                            </div>
                            <div class="form-check mt-2">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input importsData" value="{{encrypt('Admin_Paused_Subscription_Notice')}}" name="testEmailFormat"> Paused Subscription Notice
                                </label>
                            </div>
                            <div class="form-check mt-2">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input importsData" value="{{encrypt('Admin_Resumed_Subscription_Notice')}}" name="testEmailFormat"> Resumed Subscription Notice
                                </label>
                            </div>
                            <div class="form-check mt-2">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input importsData" value="{{encrypt('Admin_Refunded_Transaction_Notice')}}" name="testEmailFormat"> Refunded Transaction Notice
                                </label>
                            </div>
                            <div class="form-check mt-2">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input importsData" value="{{encrypt('Admin_Failed_Transaction_Notice')}}" name="testEmailFormat"> Failed Transaction Notice
                                </label>
                            </div>
                            <div class="form-check mt-2">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input importsData" value="{{encrypt('Admin_Credit_Card_Expiring_Notice')}}" name="testEmailFormat"> Credit Card Expiring Notice
                                </label>
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-info sendTestEmail mt-3">Send Test Email</button>
                    <p class="mt-3 text-success importStatus" style="display:none;"></p>
                    <p class="mt-3 text-success loader_text" style="display:none;"><span class="spinner-border"></span> wait..</p>
                    <p class="mt-3 text-danger errorSelect" style="display:none;"> Please Choose option.</p>
                </div>
            </div>
        </div>
    </div>   
</div>
@endsection

@push('scripts')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
    <script>
        $(document).ready(function (e) {
            $(".sendTestEmail").click(function(){
                var inputVal = $('input[name="testEmailFormat"]:checked').val();
                if(inputVal){
                    $(".loader_text").css('display','block');
                    $(".sendTestEmail").css('display','none');
                    $.ajax({
                        url : "{{ url('superadmin/send-test-email') }}",
                        data : 'inputData='+inputVal,
                        success : function(data){
                            if(data.dataimport){
                                $(".loader_text").css('display','none');
                                $(".importStatus").css('display','block');
                                $(".importStatus").text(data.dataimport);
                                setTimeout(function() {
                                    $(".importStatus").text('');
                                    $(".importStatus").css('display','none');
                                    $(".sendTestEmail").css('display','block');
                                }, 3000);
                            }
                        }
                    });
                } else {
                    $(".errorSelect").css('display','block');
                    setTimeout(function() {
                        $(".errorSelect").css('display','none')
                    }, 3000);
                }
            });
        });
    </script>
@end('scripts')
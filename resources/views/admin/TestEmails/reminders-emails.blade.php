@extends('admin.layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row page-titles mx-0">        
        <div class="col-sm-6 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{URL::to('superadmin/dashboard')}}">Dashboard</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Reminders Emails Format</a></li>
            </ol>
        </div>		
	</div> 
    <div class="row">
        <div class="col-lg-12">
            <div class="card" style="background-color:#B3ABAB47;">                
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12" style="background-color: #fff;padding-top: 20px;padding-bottom: 20px;border-radius: 10px;">
                            <h4>Reminders Email Template Format</h4> 
                            <table class="table table-striped mt-2">
                                <thead>
                                    <tr>
                                        <th>Sr no</th>
                                        <th>Template Name</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td class="text-left">Care Provider - All - Member Search - 4 hours after signup</td>
                                        <td class="text-center">
                                            <p class="wating1_text"></p>
                                            <button class="btn btn-info testReminderEmail_btn1" data-ids="1">Send Email</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td class="text-left">Family/Parent - All - Member Search - 4 hours after signup</td>
                                        <td class="text-center">
                                            <p class="wating2_text"></p>
                                            <button class="btn btn-info testReminderEmail_btn2" data-ids="2">Send Email</button>
                                        </td>
                                    </tr>
                                    <tr>
                                    <td>3</td>
                                        <td class="text-left">Family/Parent - All - Nanny Payroll Service - 14 days after signup</td>
                                        <td class="text-center">
                                            <p class="wating3_text"></p>
                                            <button class="btn btn-info testReminderEmail_btn3" data-ids="3">Send Email</button>
                                        </td>
                                    </tr>
                                    <tr>
                                    <td>4</td>
                                        <td class="text-left">Family/Parent - Annual Only - Free Nanny Contract - 10 days after sign up</td>
                                        <td class="text-center">
                                            <p class="wating4_text"></p>
                                            <button class="btn btn-info testReminderEmail_btn4" data-ids="4">Send Email</button>
                                        </td>
                                    </tr>
                                    <tr>
                                    <td>5</td>
                                        <td class="text-left">Family/Parent - All except Annual- Nanny Contract - 10 days after sign up</td>
                                        <td class="text-center">
                                            <p class="wating5_text"></p>
                                            <button class="btn btn-info testReminderEmail_btn5" data-ids="5">Send Email</button>
                                        </td>
                                    </tr>
                                    <tr>
                                    <td>6</td>
                                        <td class="text-left">Care Provider - All - Jobs Board - 1 hour after sign up</td>
                                        <td class="text-center">
                                            <p class="wating6_text"></p>
                                            <button class="btn btn-info testReminderEmail_btn6" data-ids="6">Send Email</button>
                                        </td>
                                    </tr>
                                    <tr>
                                    <td>7</td>
                                        <td class="text-left">Care Provider - Free - I hope you don't leave! plus review + referral - 2 days after expiration</td>
                                        <td class="text-center">
                                            <p class="wating7_text"></p>
                                            <button class="btn btn-info testReminderEmail_btn7" data-ids="7">Send Email</button>
                                        </td>
                                    </tr>
                                    <tr>
                                    <td>8</td>
                                        <td class="text-left">Family/Parent - All - Don’t forget the Background Check! - 8 days after purchase</td>
                                        <td class="text-center">
                                            <p class="wating8_text"></p>
                                            <button class="btn btn-info testReminderEmail_btn8" data-ids="8">Send Email</button>
                                        </td>
                                    </tr>
                                    <tr>
                                    <td>9</td>
                                        <td class="text-left">Family/Parent - Learning Guide - 30 days before Subscription Renews</td>
                                        <td class="text-center">
                                            <p class="wating9_text"></p>
                                            <button class="btn btn-info testReminderEmail_btn9" data-ids="9">Send Email</button>
                                        </td>
                                    </tr>   
                                    <tr>
                                    <td>10</td>
                                        <td class="text-left">Care Provider- All - 100% Free for Life - 5 days after Sign Up Abandoned</td>
                                        <td class="text-center">
                                            <p class="wating10_text"></p>
                                            <button class="btn btn-info testReminderEmail_btn10" data-ids="10">Send Email</button>
                                        </td>
                                    </tr>
                                    <tr>
                                    <td>11</td>
                                        <td class="text-left">Agency - All - I hope you don't leave! plus review + referral - 2 days after Subscription Expires</td>
                                        <td class="text-center">
                                            <p class="wating11_text"></p>
                                            <button class="btn btn-info testReminderEmail_btn11" data-ids="11">Send Email</button>
                                        </td>
                                    </tr>
                                    <tr>
                                    <td>12</td>
                                        <td class="text-left">Background Check - All - Vetted Candidate Guarantee/5% Coupon Offer - 2 days after Sign Up Abandoned</td>
                                        <td class="text-center">
                                            <p class="wating12_text"></p>
                                            <button class="btn btn-info testReminderEmail_btn12" data-ids="12">Send Email</button>
                                        </td>
                                    </tr>
                                    <tr>
                                    <td>13</td>
                                        <td class="text-left">Care Provider - Annual - Membership Renewal Reminder - 30 days before Subscription Renews</td>
                                        <td class="text-center">
                                            <p class="wating13_text"></p>
                                            <button class="btn btn-info testReminderEmail_btn13" data-ids="13">Send Email</button>
                                        </td>
                                    </tr>
                                    <tr>
                                    <td>14</td>
                                        <td class="text-left">Family/Parent and Agency - Annual - Membership Renewal Reminder - 30 days before Subscription Renews</td>
                                        <td class="text-center">
                                            <p class="wating14_text"></p>
                                            <button class="btn btn-info testReminderEmail_btn14" data-ids="14">Send Email</button>
                                        </td>
                                    </tr>
                                    <tr>
                                    <td>15</td>
                                        <td class="text-left">Care Provider - All - CareCalendar - 8 hours after Member Signs Up</td>
                                        <td class="text-center">
                                            <p class="wating15_text"></p>
                                            <button class="btn btn-info testReminderEmail_btn15" data-ids="15">Send Email</button>
                                        </td>
                                    </tr>
                                    <tr>
                                    <td>16</td>
                                        <td class="text-left">Family Parent- All - CareCalendar - 6 hours after Member Signs Up</td>
                                        <td class="text-center">
                                            <p class="wating16_text"></p>
                                            <button class="btn btn-info testReminderEmail_btn16" data-ids="16">Send Email</button>
                                        </td>
                                    </tr>
                                    <tr>
                                    <td>17</td>
                                        <td class="text-left">Care Provider - All - Earn more by becoming a Verified Care Provider! - 2 days after Member Signs Up</td>
                                        <td class="text-center">
                                            <p class="wating17_text"></p>
                                            <button class="btn btn-info testReminderEmail_btn17" data-ids="17">Send Email</button>
                                        </td>
                                    </tr>
                                    <tr>
                                    <td>18</td>
                                        <td class="text-left">Background Checks - Checking in re: background check and a quick favor (review + referral) - 14 days after purchase</td>
                                        <td class="text-center">
                                            <p class="wating18_text"></p>
                                            <button class="btn btn-info testReminderEmail_btn18" data-ids="18">Send Email</button>
                                        </td>
                                    </tr>
                                    <tr>
                                    <td>19</td>
                                        <td class="text-left">Nanny/Nanny Share Contract - Did something go wrong? - 12 hours after Sign Up Abandoned</td>
                                        <td class="text-center">
                                            <p class="wating19_text"></p>
                                            <button class="btn btn-info testReminderEmail_btn19" data-ids="19">Send Email</button>
                                        </td>
                                    </tr>
                                    <tr>
                                    <td>20</td>
                                        <td class="text-left">Background Checks - All - Did something go wrong? - 12 hours after Sign Up Abandoned</td>
                                        <td class="text-center">
                                            <p class="wating20_text"></p>
                                            <button class="btn btn-info testReminderEmail_btn20" data-ids="20">Send Email</button>
                                        </td>
                                    </tr>
                                    <tr>
                                    <td>21</td>
                                        <td class="text-left">Nanny/Nanny Share Contract - Checking in re: nanny contract and a quick favor (review + referral) - 10 days after Member Signs Up</td>
                                        <td class="text-center">
                                            <p class="wating21_text"></p>
                                            <button class="btn btn-info testReminderEmail_btn21" data-ids="21">Send Email</button>
                                        </td>
                                    </tr>
                                    <tr>
                                    <td>22</td>
                                        <td class="text-left">Family/Parent - All - Last Minute Care - 6 days after Member Signs Up</td>
                                        <td class="text-center">
                                            <p class="wating22_text"></p>
                                            <button class="btn btn-info testReminderEmail_btn22" data-ids="22">Send Email</button>
                                        </td>
                                    </tr>
                                    <tr>
                                    <td>23</td>
                                        <td class="text-left">Care Provider - All - Have you signed up for our Last Minute Care Text Service? - 1 day after Member Signs Up</td>
                                        <td class="text-center">
                                            <p class="wating23_text"></p>
                                            <button class="btn btn-info testReminderEmail_btn23" data-ids="23">Send Email</button>
                                        </td>
                                    </tr>
                                    <tr>
                                    <td>24</td>
                                        <td class="text-left">Family/Parent - All - I am here to help! - 4 days after Member Signs Up</td>
                                        <td class="text-center">
                                            <p class="wating24_text"></p>
                                            <button class="btn btn-info testReminderEmail_btn24" data-ids="24">Send Email</button>
                                        </td>
                                    </tr>
                                    <tr>
                                    <td>25</td>
                                        <td class="text-left">Care Provider - All - I am here to help! - 36 hours after Member Signs Up</td>
                                        <td class="text-center">
                                            <p class="wating25_text"></p>
                                            <button class="btn btn-info testReminderEmail_btn25" data-ids="25">Send Email</button>
                                        </td>
                                    </tr>
                                    <tr>
                                    <td>26</td>
                                        <td class="text-left">Family/Care Provider/Agency - One Month Only - Your access end soon! - 26 days after Member Signs Up</td>
                                        <td class="text-center">
                                            <p class="wating26_text"></p>
                                            <button class="btn btn-info testReminderEmail_btn26" data-ids="26">Send Email</button>
                                        </td>
                                    </tr>
                                    <tr>
                                    <td>27</td>
                                        <td class="text-left">All Family/Care Provider/Agency Memberships - Don't miss out...your membership expires in minutes! - 2 hours before Subscription Expires</td>
                                        <td class="text-center">
                                            <p class="wating27_text"></p>
                                            <button class="btn btn-info testReminderEmail_btn27" data-ids="27">Send Email</button>
                                        </td>
                                    </tr>
                                    <tr>
                                    <td>28</td>
                                        <td class="text-left">Care Provider - All - 2 days after Subscription Expires</td>
                                        <td class="text-center">
                                            <p class="wating28_text"></p>
                                            <button class="btn btn-info testReminderEmail_btn28" data-ids="28">Send Email</button>
                                        </td>
                                    </tr>
                                    <tr>
                                    <td>29</td>
                                        <td class="text-left">Family/Parent - All - 2 days after Subscription Expires</td>
                                        <td class="text-center">
                                            <p class="wating29_text"></p>
                                            <button class="btn btn-info testReminderEmail_btn29" data-ids="29">Send Email</button>
                                        </td>
                                    </tr>
                                    <tr>
                                    <td>30</td>
                                        <td class="text-left">Family/Parent, Agency & Care Provider - All - 2 days after Sign Up Abandoned</td>
                                        <td class="text-center">
                                            <p class="wating30_text"></p>
                                            <button class="btn btn-info testReminderEmail_btn30" data-ids="30">Send Email</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>31</td>
                                        <td class="text-left">Family/Parent, Care Provider & Agency - Monthly - 3 days before Subscription Expires</td>
                                        <td class="text-center">
                                            <p class="wating31_text"></p>
                                            <button class="btn btn-info testReminderEmail_btn31" data-ids="31">Send Email</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>32</td>
                                        <td class="text-left">Agency, Family Parent & Care Provider - All - 12 hours after Sign Up Abandoned</td>
                                        <td class="text-center">
                                            <p class="wating32_text"></p>
                                            <button class="btn btn-info testReminderEmail_btn32" data-ids="32">Send Email</button>
                                        </td>
                                    </tr>                                 
                                </tbody>
                            </table>                           
                            
                        </div>                        
                    </div>                    
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
            $(".testReminderEmail_btn1").click(function(){ 
                var getDataID = $(this).data('ids');               
                $.ajax({
                    url : "{{ url('superadmin/test-reminders-firstForm') }}",
                    data : 'Care_Provider_4_hours_after_signup='+getDataID,
                    beforeSend: function(data){
                        $('.wating1_text').text('waiting..').css('color','red');
                        $('.testReminderEmail_btn1').css('display','none');
                    },
                    success : function(data){
                        if(data.mailSend){
                            $('.wating1_text').text(data.mailSend).css('color','green');
                            setTimeout(function() {
                                $('.wating1_text').text('');
                                $('.testReminderEmail_btn1').css('display','block');
                            }, 3000);
                        }
                    }
                });
            });

            $(".testReminderEmail_btn2").click(function(){ 
                var getDataID = $(this).data('ids');               
                $.ajax({
                    url : "{{ url('superadmin/test-reminders-firstForm2') }}",
                    data : 'Family_Parent_4_hours_after_signup='+getDataID,
                    beforeSend: function(data){
                        $('.wating2_text').text('waiting..').css('color','red');
                        $('.testReminderEmail_btn2').css('display','none');
                    },
                    success : function(data){
                        if(data.mailSend){
                            $('.wating2_text').text(data.mailSend).css('color','green');
                            setTimeout(function() {
                                $('.wating2_text').text('');
                                $('.testReminderEmail_btn2').css('display','block');
                            }, 3000);
                        }
                    }
                });
            });

            $(".testReminderEmail_btn3").click(function(){
                var getDataID = $(this).data('ids');
                $.ajax({
                    url : "{{ url('superadmin/test-reminders-firstForm3') }}",
                    data : 'FamilyParent_All_NannyPayrollService_14_daysaftersignup='+getDataID,
                    beforeSend: function(data){
                        $('.wating3_text').text('waiting..').css('color','red');
                        $('.testReminderEmail_btn3').css('display','none');
                    },
                    success : function(data){
                        if(data.mailSend){
                            $('.wating3_text').text(data.mailSend).css('color','green');
                            setTimeout(function() {
                                $('.wating3_text').text('');
                                $('.testReminderEmail_btn3').css('display','block');
                            }, 3000);
                        }
                    }
                });
            });

            $(".testReminderEmail_btn4").click(function(){
                var getDataID = $(this).data('ids');
                $.ajax({
                    url : "{{ url('superadmin/test-reminders-firstForm4') }}",
                    data : 'Family_Parent_Annual_Only_Free_Nanny_Contract_10_days_after_sign_up='+getDataID,
                    beforeSend: function(data){
                        $('.wating4_text').text('waiting..').css('color','red');
                        $('.testReminderEmail_btn4').css('display','none');
                    },
                    success : function(data){
                        if(data.mailSend){
                            $('.wating4_text').text(data.mailSend).css('color','green');
                            setTimeout(function() {
                                $('.wating4_text').text('');
                                $('.testReminderEmail_btn4').css('display','block');
                            }, 3000);
                        }
                    }
                });
            });

            $(".testReminderEmail_btn5").click(function(){
                var getDataID = $(this).data('ids');
                $.ajax({
                    url : "{{ url('superadmin/test-reminders-firstForm5') }}",
                    data : 'Family_Parent_All_except_Annual_Nanny_Contract_10_days_after_sign_up='+getDataID,
                    beforeSend: function(data){
                        $('.wating5_text').text('waiting..').css('color','red');
                        $('.testReminderEmail_btn5').css('display','none');
                    },
                    success : function(data){
                        if(data.mailSend){
                            $('.wating5_text').text(data.mailSend).css('color','green');
                            setTimeout(function() {
                                $('.wating5_text').text('');
                                $('.testReminderEmail_btn5').css('display','block');
                            }, 3000);
                        }
                    }
                });
            });

            $(".testReminderEmail_btn6").click(function(){
                var getDataID = $(this).data('ids');
                $.ajax({
                    url : "{{ url('superadmin/test-reminders-firstForm6') }}",
                    data : 'Care_Provider_All_Jobs_Board_1_hour_after_sign_up='+getDataID,
                    beforeSend: function(data){
                        $('.wating6_text').text('waiting..').css('color','red');
                        $('.testReminderEmail_btn6').css('display','none');
                    },
                    success : function(data){
                        if(data.mailSend){
                            $('.wating6_text').text(data.mailSend).css('color','green');
                            setTimeout(function() {
                                $('.wating6_text').text('');
                                $('.testReminderEmail_btn6').css('display','block');
                            }, 3000);
                        }
                    }
                });
            });

            $(".testReminderEmail_btn7").click(function(){
                var getDataID = $(this).data('ids');
                $.ajax({
                    url : "{{ url('superadmin/test-reminders-firstForm7') }}",
                    data : 'Care_Provider_Free_I_hope_you_dont_leave_plus_review_referral_2_days_after_expiration='+getDataID,
                    beforeSend: function(data){
                        $('.wating7_text').text('waiting..').css('color','red');
                        $('.testReminderEmail_btn7').css('display','none');
                    },
                    success : function(data){
                        if(data.mailSend){
                            $('.wating7_text').text(data.mailSend).css('color','green');
                            setTimeout(function() {
                                $('.wating7_text').text('');
                                $('.testReminderEmail_btn7').css('display','block');
                            }, 3000);
                        }
                    }
                });
            });

            $(".testReminderEmail_btn8").click(function(){
                var getDataID = $(this).data('ids');
                $.ajax({
                    url : "{{ url('superadmin/test-reminders-firstForm8') }}",
                    data : 'Family_Parent_All_Dont_forget_the_Background_Check_8_days_after_purchase='+getDataID,
                    beforeSend: function(data){
                        $('.wating8_text').text('waiting..').css('color','red');
                        $('.testReminderEmail_btn8').css('display','none');
                    },
                    success : function(data){
                        if(data.mailSend){
                            $('.wating8_text').text(data.mailSend).css('color','green');
                            setTimeout(function() {
                                $('.wating8_text').text('');
                                $('.testReminderEmail_btn8').css('display','block');
                            }, 3000);
                        }
                    }
                });
            });

            $(".testReminderEmail_btn9").click(function(){
                var getDataID = $(this).data('ids');
                $.ajax({
                    url : "{{ url('superadmin/test-reminders-firstForm9') }}",
                    data : 'Family_Parent_Learning_Guide_30_days_before_Subscription_Renews='+getDataID,
                    beforeSend: function(data){
                        $('.wating9_text').text('waiting..').css('color','red');
                        $('.testReminderEmail_btn9').css('display','none');
                    },
                    success : function(data){
                        if(data.mailSend){
                            $('.wating9_text').text(data.mailSend).css('color','green');
                            setTimeout(function() {
                                $('.wating9_text').text('');
                                $('.testReminderEmail_btn9').css('display','block');
                            }, 3000);
                        }
                    }
                });
            });

            $(".testReminderEmail_btn10").click(function(){
                var getDataID = $(this).data('ids');
                $.ajax({
                    url : "{{ url('superadmin/test-reminders-firstForm10') }}",
                    data : 'Care_Provider_All_100_Free_for_Life_5_days_after_Sign_Up_Abandoned='+getDataID,
                    beforeSend: function(data){
                        $('.wating10_text').text('waiting..').css('color','red');
                        $('.testReminderEmail_btn10').css('display','none');
                    },
                    success : function(data){
                        if(data.mailSend){
                            $('.wating10_text').text(data.mailSend).css('color','green');
                            setTimeout(function() {
                                $('.wating10_text').text('');
                                $('.testReminderEmail_btn10').css('display','block');
                            }, 3000);
                        }
                    }
                });
            });

            $(".testReminderEmail_btn11").click(function(){
                var getDataID = $(this).data('ids');
                $.ajax({
                    url : "{{ url('superadmin/test-reminders-firstForm11') }}",
                    data : 'Agency_All_I_hope_you_dont_leave!_plus_review_referral_2_days_after_Subscription_Expires='+getDataID,
                    beforeSend: function(data){
                        $('.wating11_text').text('waiting..').css('color','red');
                        $('.testReminderEmail_btn11').css('display','none');
                    },
                    success : function(data){
                        if(data.mailSend){
                            $('.wating11_text').text(data.mailSend).css('color','green');
                            setTimeout(function() {
                                $('.wating11_text').text('');
                                $('.testReminderEmail_btn11').css('display','block');
                            }, 3000);
                        }
                    }
                });
            });

            $(".testReminderEmail_btn12").click(function(){
                var getDataID = $(this).data('ids');
                $.ajax({
                    url : "{{ url('superadmin/test-reminders-firstForm12') }}",
                    data : 'Background_Check_All_Vetted_Candidate_Guarantee_5%_Coupon_Offer_2_days_after_Sign_Up_Abandoned='+getDataID,
                    beforeSend: function(data){
                        $('.wating12_text').text('waiting..').css('color','red');
                        $('.testReminderEmail_btn12').css('display','none');
                    },
                    success : function(data){
                        if(data.mailSend){
                            $('.wating12_text').text(data.mailSend).css('color','green');
                            setTimeout(function() {
                                $('.wating12_text').text('');
                                $('.testReminderEmail_btn12').css('display','block');
                            }, 3000);
                        }
                    }
                });
            });

            $(".testReminderEmail_btn13").click(function(){
                var getDataID = $(this).data('ids');
                $.ajax({
                    url : "{{ url('superadmin/test-reminders-firstForm13') }}",
                    data : 'Care_Provider_Annual_Membership_Renewal_Reminder_30_days_before_Subscription_Renews='+getDataID,
                    beforeSend: function(data){
                        $('.wating13_text').text('waiting..').css('color','red');
                        $('.testReminderEmail_btn13').css('display','none');
                    },
                    success : function(data){
                        if(data.mailSend){
                            $('.wating13_text').text(data.mailSend).css('color','green');
                            setTimeout(function() {
                                $('.wating13_text').text('');
                                $('.testReminderEmail_btn13').css('display','block');
                            }, 3000);
                        }
                    }
                });
            });

            $(".testReminderEmail_btn14").click(function(){
                var getDataID = $(this).data('ids');
                $.ajax({
                    url : "{{ url('superadmin/test-reminders-firstForm14') }}",
                    data : 'Family_Parent_and_Agency_Annual_Membership_Renewal_Reminder_30_days_before_Subscription_Renews='+getDataID,
                    beforeSend: function(data){
                        $('.wating14_text').text('waiting..').css('color','red');
                        $('.testReminderEmail_btn14').css('display','none');
                    },
                    success : function(data){
                        if(data.mailSend){
                            $('.wating14_text').text(data.mailSend).css('color','green');
                            setTimeout(function() {
                                $('.wating14_text').text('');
                                $('.testReminderEmail_btn14').css('display','block');
                            }, 3000);
                        }
                    }
                });
            });

            $(".testReminderEmail_btn15").click(function(){
                var getDataID = $(this).data('ids');
                $.ajax({
                    url : "{{ url('superadmin/test-reminders-firstForm15') }}",
                    data : 'Care_Provider_All_CareCalendar_8_hours_after_Member_Signs_Up='+getDataID,
                    beforeSend: function(data){
                        $('.wating15_text').text('waiting..').css('color','red');
                        $('.testReminderEmail_btn15').css('display','none');
                    },
                    success : function(data){
                        if(data.mailSend){
                            $('.wating15_text').text(data.mailSend).css('color','green');
                            setTimeout(function() {
                                $('.wating15_text').text('');
                                $('.testReminderEmail_btn15').css('display','block');
                            }, 3000);
                        }
                    }
                });
            });

            $(".testReminderEmail_btn16").click(function(){
                var getDataID = $(this).data('ids');
                $.ajax({
                    url : "{{ url('superadmin/test-reminders-firstForm16') }}",
                    data : 'Family_Parent_All_CareCalendar_6_hours_after_Member_Signs_Up='+getDataID,
                    beforeSend: function(data){
                        $('.wating16_text').text('waiting..').css('color','red');
                        $('.testReminderEmail_btn16').css('display','none');
                    },
                    success : function(data){
                        if(data.mailSend){
                            $('.wating16_text').text(data.mailSend).css('color','green');
                            setTimeout(function() {
                                $('.wating16_text').text('');
                                $('.testReminderEmail_btn16').css('display','block');
                            }, 3000);
                        }
                    }
                });
            });

            $(".testReminderEmail_btn17").click(function(){
                var getDataID = $(this).data('ids');
                $.ajax({
                    url : "{{ url('superadmin/test-reminders-firstForm17') }}",
                    data : 'Care_Provider_All_Earn_more_by_becoming_a_Verified_Care_Provider!_2_days_after_Member_Signs_Up='+getDataID,
                    beforeSend: function(data){
                        $('.wating17_text').text('waiting..').css('color','red');
                        $('.testReminderEmail_btn17').css('display','none');
                    },
                    success : function(data){
                        if(data.mailSend){
                            $('.wating17_text').text(data.mailSend).css('color','green');
                            setTimeout(function() {
                                $('.wating17_text').text('');
                                $('.testReminderEmail_btn17').css('display','block');
                            }, 3000);
                        }
                    }
                });
            });

            $(".testReminderEmail_btn18").click(function(){
                var getDataID = $(this).data('ids');
                $.ajax({
                    url : "{{ url('superadmin/test-reminders-firstForm18') }}",
                    data : 'Background_Checks_Checking_in_re_background_check_and_a_quick_favor_review_referral_14_days_after_purchase='+getDataID,
                    beforeSend: function(data){
                        $('.wating18_text').text('waiting..').css('color','red');
                        $('.testReminderEmail_btn18').css('display','none');
                    },
                    success : function(data){
                        if(data.mailSend){
                            $('.wating18_text').text(data.mailSend).css('color','green');
                            setTimeout(function() {
                                $('.wating18_text').text('');
                                $('.testReminderEmail_btn18').css('display','block');
                            }, 3000);
                        }
                    }
                });
            });

            $(".testReminderEmail_btn19").click(function(){
                var getDataID = $(this).data('ids');
                $.ajax({
                    url : "{{ url('superadmin/test-reminders-firstForm19') }}",
                    data : 'Nanny_Nanny_Share_Contract_Did_something_go_wrong_12_hours_after_Sign_Up_Abandoned='+getDataID,
                    beforeSend: function(data){
                        $('.wating19_text').text('waiting..').css('color','red');
                        $('.testReminderEmail_btn19').css('display','none');
                    },
                    success : function(data){
                        if(data.mailSend){
                            $('.wating19_text').text(data.mailSend).css('color','green');
                            setTimeout(function() {
                                $('.wating19_text').text('');
                                $('.testReminderEmail_btn19').css('display','block');
                            }, 3000);
                        }
                    }
                });
            });

            $(".testReminderEmail_btn20").click(function(){
                var getDataID = $(this).data('ids');
                $.ajax({
                    url : "{{ url('superadmin/test-reminders-firstForm20') }}",
                    data : 'Background_Checks_All_Did_something_go_wrong_12_hours_after_Sign_Up_Abandoned='+getDataID,
                    beforeSend: function(data){
                        $('.wating20_text').text('waiting..').css('color','red');
                        $('.testReminderEmail_btn20').css('display','none');
                    },
                    success : function(data){
                        if(data.mailSend){
                            $('.wating20_text').text(data.mailSend).css('color','green');
                            setTimeout(function() {
                                $('.wating20_text').text('');
                                $('.testReminderEmail_btn20').css('display','block');
                            }, 3000);
                        }
                    }
                });
            });

            $(".testReminderEmail_btn21").click(function(){
                var getDataID = $(this).data('ids');
                $.ajax({
                    url : "{{ url('superadmin/test-reminders-firstForm21') }}",
                    data : 'Nanny_Nanny_Share_Contract_Checking_in_re_nanny_contract_and_a_quick_favor_review_referral_10_days_after_Member_Signs='+getDataID,
                    beforeSend: function(data){
                        $('.wating21_text').text('waiting..').css('color','red');
                        $('.testReminderEmail_btn21').css('display','none');
                    },
                    success : function(data){
                        if(data.mailSend){
                            $('.wating21_text').text(data.mailSend).css('color','green');
                            setTimeout(function() {
                                $('.wating21_text').text('');
                                $('.testReminderEmail_btn21').css('display','block');
                            }, 3000);
                        }
                    }
                });
            });

            $(".testReminderEmail_btn22").click(function(){
                var getDataID = $(this).data('ids');
                $.ajax({
                    url : "{{ url('superadmin/test-reminders-firstForm22') }}",
                    data : 'Family_Parent_All_Last_Minute_Care_6_days_after_Member_Signs_Up='+getDataID,
                    beforeSend: function(data){
                        $('.wating22_text').text('waiting..').css('color','red');
                        $('.testReminderEmail_btn22').css('display','none');
                    },
                    success : function(data){
                        if(data.mailSend){
                            $('.wating22_text').text(data.mailSend).css('color','green');
                            setTimeout(function() {
                                $('.wating22_text').text('');
                                $('.testReminderEmail_btn22').css('display','block');
                            }, 3000);
                        }
                    }
                });
            });

            $(".testReminderEmail_btn23").click(function(){
                var getDataID = $(this).data('ids');
                $.ajax({
                    url : "{{ url('superadmin/test-reminders-firstForm23') }}",
                    data : 'Care_Provider_All_Have_you_signed_up_for_our_Last_Minute_Care_Text_Service_1_day_after_Member_Signs_Up='+getDataID,
                    beforeSend: function(data){
                        $('.wating23_text').text('waiting..').css('color','red');
                        $('.testReminderEmail_btn23').css('display','none');
                    },
                    success : function(data){
                        if(data.mailSend){
                            $('.wating23_text').text(data.mailSend).css('color','green');
                            setTimeout(function() {
                                $('.wating23_text').text('');
                                $('.testReminderEmail_btn23').css('display','block');
                            }, 3000);
                        }
                    }
                });
            });

            $(".testReminderEmail_btn24").click(function(){
                var getDataID = $(this).data('ids');
                $.ajax({
                    url : "{{ url('superadmin/test-reminders-firstForm24') }}",
                    data : 'Family_Parent_All_I_am_here_to_help_4_days_after_Member_Signs='+getDataID,
                    beforeSend: function(data){
                        $('.wating24_text').text('waiting..').css('color','red');
                        $('.testReminderEmail_btn24').css('display','none');
                    },
                    success : function(data){
                        if(data.mailSend){
                            $('.wating24_text').text(data.mailSend).css('color','green');
                            setTimeout(function() {
                                $('.wating24_text').text('');
                                $('.testReminderEmail_btn24').css('display','block');
                            }, 3000);
                        }
                    }
                });
            });

            $(".testReminderEmail_btn25").click(function(){
                var getDataID = $(this).data('ids');
                $.ajax({
                    url : "{{ url('superadmin/test-reminders-firstForm25') }}",
                    data : 'Care_Provider_All_I_am_here_to_help_36_hours_after_Member_Signs_Up='+getDataID,
                    beforeSend: function(data){
                        $('.wating25_text').text('waiting..').css('color','red');
                        $('.testReminderEmail_btn25').css('display','none');
                    },
                    success : function(data){
                        if(data.mailSend){
                            $('.wating25_text').text(data.mailSend).css('color','green');
                            setTimeout(function() {
                                $('.wating25_text').text('');
                                $('.testReminderEmail_btn25').css('display','block');
                            }, 3000);
                        }
                    }
                });
            });

            $(".testReminderEmail_btn26").click(function(){
                var getDataID = $(this).data('ids');
                $.ajax({
                    url : "{{ url('superadmin/test-reminders-firstForm26') }}",
                    data : 'Family_Care_Provider_Agency_One_Month_Only_Your_access_end_soon_26_days_after_Member_Signs_Up='+getDataID,
                    beforeSend: function(data){
                        $('.wating26_text').text('waiting..').css('color','red');
                        $('.testReminderEmail_btn26').css('display','none');
                    },
                    success : function(data){
                        if(data.mailSend){
                            $('.wating26_text').text(data.mailSend).css('color','green');
                            setTimeout(function() {
                                $('.wating26_text').text('');
                                $('.testReminderEmail_btn26').css('display','block');
                            }, 3000);
                        }
                    }
                });
            });

            $(".testReminderEmail_btn27").click(function(){
                var getDataID = $(this).data('ids');
                $.ajax({
                    url : "{{ url('superadmin/test-reminders-firstForm27') }}",
                    data : 'All_Family_Care_Provider_Agency_Memberships_Dont_miss_out_your_membership_expires_in_minutes_2_hours_before_Subscription_Expires='+getDataID,
                    beforeSend: function(data){
                        $('.wating27_text').text('waiting..').css('color','red');
                        $('.testReminderEmail_btn27').css('display','none');
                    },
                    success : function(data){
                        if(data.mailSend){
                            $('.wating27_text').text(data.mailSend).css('color','green');
                            setTimeout(function() {
                                $('.wating27_text').text('');
                                $('.testReminderEmail_btn27').css('display','block');
                            }, 3000);
                        }
                    }
                });
            });

            $(".testReminderEmail_btn28").click(function(){
                var getDataID = $(this).data('ids');
                $.ajax({
                    url : "{{ url('superadmin/test-reminders-firstForm28') }}",
                    data : 'Care_Provider_All_2_days_after_Subscription_Expires='+getDataID,
                    beforeSend: function(data){
                        $('.wating28_text').text('waiting..').css('color','red');
                        $('.testReminderEmail_btn28').css('display','none');
                    },
                    success : function(data){
                        if(data.mailSend){
                            $('.wating28_text').text(data.mailSend).css('color','green');
                            setTimeout(function() {
                                $('.wating28_text').text('');
                                $('.testReminderEmail_btn28').css('display','block');
                            }, 3000);
                        }
                    }
                });
            });

            $(".testReminderEmail_btn29").click(function(){
                var getDataID = $(this).data('ids');
                $.ajax({
                    url : "{{ url('superadmin/test-reminders-firstForm29') }}",
                    data : 'Family_Parent_All_2_days_after_Subscription_Expires='+getDataID,
                    beforeSend: function(data){
                        $('.wating29_text').text('waiting..').css('color','red');
                        $('.testReminderEmail_btn29').css('display','none');
                    },
                    success : function(data){
                        if(data.mailSend){
                            $('.wating29_text').text(data.mailSend).css('color','green');
                            setTimeout(function() {
                                $('.wating29_text').text('');
                                $('.testReminderEmail_btn29').css('display','block');
                            }, 3000);
                        }
                    }
                });
            });

            $(".testReminderEmail_btn30").click(function(){
                var getDataID = $(this).data('ids');
                $.ajax({
                    url : "{{ url('superadmin/test-reminders-firstForm30') }}",
                    data : 'Family_Parent_Agency_Care_Provider_All_2_days_after_Sign_Up_Abandoned='+getDataID,
                    beforeSend: function(data){
                        $('.wating30_text').text('waiting..').css('color','red');
                        $('.testReminderEmail_btn30').css('display','none');
                    },
                    success : function(data){
                        if(data.mailSend){
                            $('.wating30_text').text(data.mailSend).css('color','green');
                            setTimeout(function() {
                                $('.wating30_text').text('');
                                $('.testReminderEmail_btn30').css('display','block');
                            }, 3000);
                        }
                    }
                });
            });

            $(".testReminderEmail_btn31").click(function(){
                var getDataID = $(this).data('ids');
                $.ajax({
                    url : "{{ url('superadmin/test-reminders-firstForm31') }}",
                    data : 'Family_Parent_Care_Provider_Agency_Monthly_3_days_before_Subscription_Expires='+getDataID,
                    beforeSend: function(data){
                        $('.wating31_text').text('waiting..').css('color','red');
                        $('.testReminderEmail_btn31').css('display','none');
                    },
                    success : function(data){
                        if(data.mailSend){
                            $('.wating31_text').text(data.mailSend).css('color','green');
                            setTimeout(function() {
                                $('.wating31_text').text('');
                                $('.testReminderEmail_btn31').css('display','block');
                            }, 3000);
                        }
                    }
                });
            });

            $(".testReminderEmail_btn32").click(function(){
                var getDataID = $(this).data('ids');
                $.ajax({
                    url : "{{ url('superadmin/test-reminders-firstForm32') }}",
                    data : 'Agency_Family_Parent_Care_Provider_All_12_hours_after_Sign_Up_Abandoned='+getDataID,
                    beforeSend: function(data){
                        $('.wating32_text').text('waiting..').css('color','red');
                        $('.testReminderEmail_btn32').css('display','none');
                    },
                    success : function(data){
                        if(data.mailSend){
                            $('.wating32_text').text(data.mailSend).css('color','green');
                            setTimeout(function() {
                                $('.wating32_text').text('');
                                $('.testReminderEmail_btn32').css('display','block');
                            }, 3000);
                        }
                    }
                });
            });

        });
    </script>
@end('scripts')
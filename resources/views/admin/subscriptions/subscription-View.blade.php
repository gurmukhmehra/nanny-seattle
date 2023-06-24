@extends('admin.layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row page-titles mx-0">        
        <div class="col-sm-6 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{URL::to('superadmin/dashboard')}}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{URL::to('superadmin/subscriptions')}}">Subscriptions</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">View Subscription</a></li>
            </ol>
        </div>  
        
	</div> 
    <div class="row">
        <div class="col-lg-12">
            <div class="card" style="background-color:#B3ABAB47;">                
                <div class="card-body"> 
                    <div class="card-header pt-0 pl-0">
                        <h5 class="card-title">View Subscription</h5>
                        <a href="{{URL::to('superadmin/subscriptions')}}" class="btn btn-primary pull-right">
                            <i class="fa fa-list"></i> Subscriptions
                        </a> 
                    </div>                                 
                    
                    <div class="row mt-4">
                        <div class="col-md-6">
                            <label style="color:#333;">Subscription ID</label>
                            <input type="text" name="" disabled value="{{$subscription->id}}" class="form-control">                          
                        </div>
                        <div class="col-md-6">
                            <label style="color:#333;">Subscription Number</label>
                            <input type="text" name="" disabled value="{{$subscription->subscription_id}}" class="form-control"> 
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-md-6">
                            <label style="color:#333;">User</label>
                            <input type="text" name="" disabled value="{{$user->username}}" class="form-control">                          
                        </div>
                        <div class="col-md-6">
                            <label style="color:#333;">Membership</label>
                            @if($planDetail->plan_category=='families_parents')
                                <input type="text" name="" disabled value="Family Parents - {{$planDetail->post_title}}" class="form-control">
                            @elseif($planDetail->plan_category=='care_provider') 
                                <input type="text" name="" disabled value="Care Provider - {{$planDetail->post_title}}" class="form-control">
                            @elseif($planDetail->plan_category=='agencies')
                                <input type="text" name="" disabled value="Agencies - {{$planDetail->post_title}}" class="form-control">
                            @else 
                                Null
                            @endif
                        </div>
                    </div>
                    
                    <div class="row mt-2">
                        <div class="col-md-6">
                            <label style="color:#333;">Sub-Total</label>
                            <input type="text" name="" disabled value="${{$planDetail->mepr_product_price}}" class="form-control">                          
                        </div>  
                        <div class="col-md-6">
                            <label style="color:#333;">Status</label>
                            <input type="text" name="" disabled value="Active" class="form-control">                          
                        </div>                      
                    </div>
                    
                    <div class="row mt-2">
                        <div class="col-md-6">
                            <label style="color:#333;">Gateway</label>
                            <input type="text" name="" disabled  value="Stripe" class="form-control">                          
                        </div>  
                        <div class="col-md-6">
                            <label style="color:#333;">Created</label>
                            <input type="text" name="" disabled value='{{strftime("%Y-%m-%d %H:%M:%S", $subscription->subscriptions_end_date)}}' class="form-control">                          
                        </div>                      
                    </div>                 
                </div>
            </div>
        </div>
    </div>   
</div>

@endsection



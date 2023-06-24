@extends('admin.layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row page-titles mx-0">        
        <div class="col-sm-6 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{URL::to('superadmin/dashboard')}}">Dashboard</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Subscriptions</a></li>
            </ol>
        </div>  
        		
	</div> 
    <div class="row">
        <div class="col-lg-12">
            <div class="card" style="background-color:#B3ABAB47;">                
                <div class="card-body">                     
                    <div class="card-header pt-0 pl-0">
                        <h4 class="card-title">Subscriptions List</h4>                         
                    </div> 
                                  
                    <div class="table-responsive">
                        <table class="table table-responsive-md">
                            <thead>
                                <tr>
                                    <th style="color:#000;font-size: 12px;text-transform: capitalize;">ID</th>
                                    <th style="color:#000;font-size: 12px;text-transform: capitalize;">Subscription</th>
                                    <!-- <th style="color:#000;">Payment ID</th> -->
                                    <th style="color:#000;font-size: 12px;text-transform: capitalize;">Active</th>
                                    <th style="color:#000;font-size: 12px;text-transform: capitalize;">Membership</th>                                    
                                    <th style="color:#000;font-size: 12px;text-transform: capitalize;">Terms</th>
                                    <th style="color:#000;font-size: 12px;text-transform: capitalize;">Name</th>
                                    <th style="color:#000;font-size: 12px;text-transform: capitalize;">User</th>
                                    <th style="color:#000;font-size: 12px;text-transform: capitalize;">Gateway</th>
                                    <th style="color:#000;font-size: 12px;text-transform: capitalize;">Created On</th>
                                    <th style="color:#000;font-size: 12px;text-transform: capitalize;">Expires On</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($subscriptions as $subscription) 
                                @php 
                                    $userDetail = DB::table('users')->where('id',$subscription->user_id)->first();
                                    $plans = DB::table('memberships')->where('id',$subscription->product_id)->first();
                                    $subscriptions_transactions = DB::table('subscriptions_transactions')
                                                                ->where('subscription_id',$subscription->id)
                                                                //->where('status','!=','confirmed')
                                                                ->orderBy('id','DESC')
                                                                ->first();
                                @endphp  
                                <tr>
                                    <td style="font-size:14px;">{{$subscription->id}}</td>
                                    <td style="font-size:14px;">{{$subscription->subscr_id}}</td>
                                    <!-- <td style="font-size:14px;">
                                        {{$subscription->product_id}}
                                        <p style="margin-bottom: 0px !important;margin-top: 5px;">
                                            <a href="{{ URL::to('superadmin/subscriptions/view/'.$subscription->id) }}" class="btn-xs sharp mr-1" style="color:#2f4cdd;">Edit</a>
                                        </p>
                                    </td> -->
                                    <td style="font-size:14px;">                                        
                                        @if($subscription->status=='active')                                            
                                            <span class="text-success">Active</span>
                                        @else
                                            <span class="text-danger">No</span>
                                        @endif                                
                                    </td>
                                    <td>
                                        <a href="{{ URL::to('superadmin/memberships/'.$plans->post_title_slug) }}">
                                            <strong style="color:#000;font-size:12px;">
                                                <!-- @if($plans->plan_category=='family_parent')
                                                    Family Parents
                                                @elseif($plans->plan_category=='careprovider') 
                                                    Care Provider
                                                @elseif($plans->plan_category=='agency')
                                                    Agency
                                                @else 
                                                    Null
                                                @endif -->
                                            {{$plans->post_title}}
                                            </strong>
                                        </a>
                                    </td>
                                    <td style="font-size:14px;">${{$plans->mepr_product_price}}/{{ucfirst($plans->mepr_product_period)}}</td>
                                    <td style="font-size:14px;">{{$userDetail->name}}</td>
                                    <td style="font-size:14px;"><a href="{{ URL::to('superadmin/user/view/'.$subscription->user_id) }}" style="color:#2f4cdd;">{{$userDetail->username}}</a></td>
                                    <td style="font-size:14px;">Stripe</td>
                                    <td style="font-size:14px;">{{ $subscription->created_at->format('j F, Y') }}</td>
                                    <td style="font-size:14px;">{{ date('j F, Y', strtotime($subscriptions_transactions->updated_at)) }}</td>
                                </tr>
                            @endforeach    
                            </tbody>
                            <thead>
                                <tr>
                                    <th style="color:#000;font-size: 12px;text-transform: capitalize;">ID</th>
                                    <th style="color:#000;font-size: 12px;text-transform: capitalize;">Subscription</th>
                                    <!-- <th style="color:#000;font-size: 12px;text-transform: capitalize;">Payment ID</th> -->
                                    <th style="color:#000;font-size: 12px;text-transform: capitalize;">Active</th>
                                    <th style="color:#000;font-size: 12px;text-transform: capitalize;">Membership</th>                                    
                                    <th style="color:#000;font-size: 12px;text-transform: capitalize;">Terms</th>
                                    <th style="color:#000;font-size: 12px;text-transform: capitalize;">Name</th>
                                    <th style="color:#000;font-size: 12px;text-transform: capitalize;">User</th>
                                    <th style="color:#000;font-size: 12px;text-transform: capitalize;">Gateway</th>
                                    <th style="color:#000;font-size: 12px;text-transform: capitalize;">Created On</th>
                                    <th style="color:#000;font-size: 12px;text-transform: capitalize;">Expires On</th>
                                </tr>
                            </thead>
                        </table>                        
                    </div>
                {!! $subscriptions->withQueryString()->links('pagination::bootstrap-5') !!}    
                </div>
            </div>
        </div>
    </div>   
</div>
@endsection
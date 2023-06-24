@extends('admin.layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row page-titles mx-0">        
        <div class="col-sm-6 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{URL::to('superadmin/dashboard')}}">Dashboard</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Memberships</a></li>
            </ol>
        </div>  
        		
	</div> 
    <div class="row">
        <div class="col-lg-12">
            <div class="card" style="background-color:#B3ABAB47;">                
                <div class="card-body">                     
                    <div class="card-header pt-0 pl-0">
                        <h4 class="card-title">Membership List</h4>
                        <a href="{{URL::to('superadmin/memberships/add')}}" class="btn btn-primary pull-right">
                            <i class="fa fa-plus"></i> Add New Membership
                        </a> 
                    </div> 
                    <div class="message">
                        @if (count($errors) > 0)
                            <div class = "alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>              
                    <div class="table-responsive">
                        <table class="table table-responsive-md">
                            <thead>
                                <tr>
                                    <th style="color:#000;">id</th>
                                    <th style="color:#000;">Name</th>
                                    <th style="color:#000;">Price</th>
                                    <th style="color:#000;">Membership Type</th>
                                    <th style="color:#000;">Status</th>                                    
                                    <th style="color:#000;">Created Date</th>
                                    <th style="color:#000;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($Memberships as $membership)
                                    <tr>
                                        <td style="font-size:14px;">{{$membership->id}}</td>
                                        <td style="font-size:14px;">{{$membership->post_title}}</td>
                                        <td style="font-size:14px;">
                                            <span class="text-primary">${{$membership->mepr_product_price}}/</span>
                                            <span class="text-default">{{ucfirst($membership->mepr_product_period)}}</span>
                                        </td>
                                        <td style="font-size:14px;">
                                            @if($membership->plan_category=='family_parent')
                                                Family Parents
                                            @elseif($membership->plan_category=='careprovider') 
                                                Care Provider
                                            @elseif($membership->plan_category=='agency')
                                                Agencies
                                            @else 
                                                Null
                                            @endif
                                        </td>
                                        <td style="font-size:14px;">
                                            @if(!empty($membership->post_status=='publish'))
                                                <span class="text-success">{{ucfirst($membership->post_status)}}</span>
                                            @else 
                                                <span class="text-danger">{{ucfirst($membership->post_status)}}</span>
                                            @endif
                                        </td>
                                        <td style="font-size:14px;">{{ $membership->created_at->format('d-m-Y') }}</td>
                                        <td style="font-size:14px;">
                                            <div class="d-flex">
                                                <a href="{{ URL::to('superadmin/memberships/'.$membership->post_title_slug) }}" class="btn btn-primary shadow btn-xs sharp mr-1"><i class="fa fa-eye"></i></a>
                                                <!--a href="" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></a-->
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <thead>
                                <tr>
                                    <th style="color:#000;">id</th>
                                    <th style="color:#000;">Name</th>
                                    <th style="color:#000;">Price</th>
                                    <th style="color:#000;">Membership Type</th>
                                    <th style="color:#000;">Status</th>                                    
                                    <th style="color:#000;">Created Date</th>
                                    <th style="color:#000;">Action</th>
                                </tr>
                            </thead>
                        </table>                        
                    </div>
                    {!! $Memberships->withQueryString()->links('pagination::bootstrap-5') !!}
                </div>
            </div>
        </div>
    </div>   
</div>
@endsection
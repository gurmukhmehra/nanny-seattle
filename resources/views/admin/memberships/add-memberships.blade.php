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
                        <h5 class="card-title">Add New Membership</h5>
                        <a href="{{URL::to('superadmin/memberships-list')}}" class="btn btn-primary pull-right">
                            <i class="fa fa-list"></i> Membership List
                        </a> 
                    </div>                                  
                    <div class="message">
                        @if(session()->has('success'))
                            <div class="alert alert-success">
                                {{ session()->get('success') }}
                            </div>
                        @endif

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

                    {{ Form::open(array('url' => 'superadmin/memberships/add' , 'autocomplete'=>'off', 'enctype' =>'multipart/form-data')) }}
                        
                        <div class="row mt-4">
                            <div class="col-md-6">
                                <label style="color:#333;">Membership Type<sup class="text-danger">*</sup></label>
                                <select class="form-control" required name="plan_category">
                                    <option value="">Select Type</option>
                                    <option value="{{encrypt('family_parent')}}">Families Parents</option>
                                    <option value="{{encrypt('careprovider')}}">Care Provider </option>
                                    <option value="{{encrypt('agency')}}">Agencies</option>                                  
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label style="color:#333;">Title<sup class="text-danger">*</sup></label>
                                <input type="text" name="post_title" required value="" class="form-control">
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-md-6">
                                <label style="color:#333;">Price<sup class="text-danger">*</sup></label>
                                <input type="text" id="" name="product_price" required value="" class="form-control allow_numeric">
                            </div>
                            <div class="col-md-6">
                                <label style="color:#333;">Product Type<sup class="text-danger">*</sup></label>
                                <select class="form-control" required name="product_period">
                                    <option value="">Select</option>                 
                                    <option value="month">Month</option>
                                    <option value="monthly">Monthly</option>
                                    <option value="quarter">Every 3 months</option>
                                    <option value="semiannual">Every 6 months</option>
                                    <option value="year">Yearly</option>
                                    <option value="day">Daily</option>
                                    <option value="week">Weekly</option>
                                    <!--option value="custom">Custom</option-->
                                </select>
                            </div>
                        </div>

                        <!--div class="row ml-3 mt-4">
                            <div class="form-group">
                                <div class="form-check form-check-inline">
                                    <label class="form-check-label" style="color:#333;">
                                        <input type="checkbox" name="product_trial" class="form-check-input" value="1" >Trial Period
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <label style="color:#333;">Trial Duration (Days):</label>
                                <input type="number" id="" name="product_trial_days" min='0' value="" class="form-control">
                            </div>
                            <div class="col-md-5">
                                <label style="color:#333;">Trial Amount ($):</label>
                                <input type="text" id="" name="product_trial_amount" value="" class="form-control">
                            </div>
                        </div>

                        <div class="row ml-3 mt-4">
                            <div class="form-group">
                                <div class="form-check form-check-inline">
                                    <label class="form-check-label" style="color:#333;">
                                        <input type="checkbox" name="product_limit_cycles" class="form-check-input" value="1" > Limit Payment Cycles
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label style="color:#333;">Max # of Payments</label>
                                <input type="number" id="" name="product_limit_cycles_num" min='0' value="" class="form-control">
                            </div>
                            <div class="col-md-4">
                                <label style="color:#333;">Access After Last Cycle</label>
                                <select class="form-control" name="product_limit_cycles_action">
                                    <option value="expire" selected="selected">Expire Access</option>
                                    <option value="lifetime">Lifetime Access</option>
                                    <option value="expires_after">Expire Access After</option>                                  
                                </select>
                            </div>
                        </div-->

                        <div class="row mt-4">                            
                            <div class="form-group col-md-6">
                                <label class="col-md-3 col-form-label" style="color:#333;">Status</label>
                                <select class="form-control" name="post_status">
                                    <option value="publish">Publish</option>
                                    <option value="draft">Draft </option>                                  
                                </select>
                            </div>                            
                        </div>
                        
                        <hr>                     
                        <div class="form-group row">
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-info">Save</button>
                            </div>
                        </div>
                    {{ Form::close() }}

                </div>
            </div>
        </div>
    </div>   
</div>
@endsection

@push('scripts')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
    <script>
        $(document).ready(function(){  
            $('.allow_numeric').keypress(function (e) {    
                var charCode = (e.which) ? e.which : event.keyCode;
                if (String.fromCharCode(charCode).match(/[^0-9\.]/g))
                return false;
            });

            $(".billing_type").on("change",function (event) {
                if($(this).val()==='recurring') {
                    $('.recurring_option').css('display','block');
                    $('.one_time_option').css('display','none');                   
                } else {
                    $('.recurring_option').css('display','none');
                    $('.one_time_option').css('display','block');
                }
            });
        });     
    </script>
@endpush


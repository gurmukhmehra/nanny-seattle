@extends('admin.layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row page-titles mx-0">        
        <div class="col-sm-6 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{URL::to('superadmin/dashboard')}}">Dashboard</a></li>
                <li class="breadcrumb-item active"><a href="{{URL::to('superadmin/memberships-list')}}">Memberships List</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">{{$membership->post_title}}</a></li>
            </ol>
        </div>  
        		
	</div> 
    <div class="row">
        <div class="col-lg-12">
            <div class="card" style="background-color:#B3ABAB47;">                
                <div class="card-body"> 
                    <div class="card-header pt-0 pl-0">
                        <h5 class="card-title">Membership : {{$membership->post_title}}</h5>
                        <a href="{{URL::to('superadmin/memberships/add')}}" class="btn btn-primary pull-right">
                            <i class="fa fa-plus"></i> Add New Membership
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

                    {{ Form::open(array('url' => 'superadmin/memberships/'.$membership->post_title_slug , 'autocomplete'=>'off', 'enctype' =>'multipart/form-data')) }}
                        
                        <input type="hidden" name="slug" value="{{$membership->post_title_slug}}" class="form-control">
                        <div class="row mt-4">
                            <div class="col-md-6">
                                <label style="color:#333;">Membership Type<sup class="text-danger">*</sup></label>
                                <select class="form-control" readonly name="plan_category">
                                    <option value="">Select Type</option>
                                    <option value="{{encrypt('family_parent')}}" @if($membership->plan_category=='family_parent') selected @endif>Families Parents</option>
                                    <option value="{{encrypt('careprovider')}}" @if($membership->plan_category=='careprovider') selected @endif>Care Provider </option>
                                    <option value="{{encrypt('agency')}}" @if($membership->plan_category=='agency') selected @endif>Agencies</option>                                  
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label style="color:#333;">Title<sup class="text-danger">*</sup></label>
                                <input type="text" name="post_title" required value="{{$membership->post_title}}" class="form-control">
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-md-6">
                                <label style="color:#333;">Price</label>
                                <input type="text" id="" name="product_price" disabled required value="{{$membership->mepr_product_price}}" class="form-control allow_numeric">
                            </div>
                            <div class="col-md-6">
                                <label style="color:#333;">Product Type<sup class="text-danger">*</sup></label>
                                <select class="form-control" required name="product_period" disabled>
                                    <option value="">Select</option>                 
                                    <option value="month" @if($membership->mepr_product_period=='month') selected @endif>Monthly</option>
                                    <option value="quarter" @if($membership->mepr_product_period=='quarter') selected @endif>Every 3 months</option>
                                    <option value="semiannual" @if($membership->mepr_product_period=='semiannual') selected @endif>Every 6 months</option>
                                    <option value="year" @if($membership->mepr_product_period=='year') selected @endif>Yearly</option>
                                    <option value="day" @if($membership->mepr_product_period=='day') selected @endif>Daily</option>
                                    <option value="week" @if($membership->mepr_product_period=='week') selected @endif>Weekly</option>
                                </select>
                            </div>
                        </div>                        

                        <div class="row mt-4">                              
                            <div class="form-group col-md-6">
                                <label class="col-md-3 col-form-label" style="color:#333;">Status</label>
                                <select class="form-control" name="post_status">
                                    <option value="publish" @if($membership->post_status=='publish') selected @endif>Publish</option>
                                    <option value="draft" @if($membership->post_status=='draft') selected @endif>Draft </option>                                  
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
        });        
    </script>
@endpush


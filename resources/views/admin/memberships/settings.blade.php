@extends('admin.layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row page-titles mx-0">        
        <div class="col-sm-6 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{URL::to('superadmin/dashboard')}}">Dashboard</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Settings</a></li>
            </ol>
        </div>  
        		
	</div> 
    <div class="row">
        <div class="col-lg-12">
            <div class="card" style="background-color:#B3ABAB47;">                
                <div class="card-body">                     
                    
                    <div class="row">
                        <div class="col-md-12">
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

                            <ul id="tabs" class="nav nav-tabs mb-3">
                                <li class="nav-item">
                                    <a href="" data-target="#profile1" data-toggle="tab" class="nav-link small text-uppercase active">Payments</a>
                                </li>                            
                            </ul>
                            <div id="profile1" class="tab-pane fade active show">
                                <div class="col-md-12">
                                    <div class="pb-2">
                                        <h6 class="w-100 text-left">Stripe Settings</h6>
                                        <hr>
                                        {{ Form::open(array('url' => 'superadmin/payment-gateway/stripe' , 'enctype' =>'multipart/form-data')) }}
                                            
                                            <div class="form-group row">
                                                <label class="col-md-2 col-form-label text-right">Payment Mode</label>
                                                <div class="col-md-10">
                                                    <select class="form-control" name="payment_mode">
                                                        <option value="test_mode" @if($setting->payment_mode=='test_mode') selected @endif>Test Mode</option>
                                                        <option value="live_mode" @if($setting->payment_mode=='live_mode') selected @endif>Live Mode</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-5 col-sm-6 col-lg-6">
                                                    <div class="form-group row">
                                                        <label class="col-md-4 col-form-label">Test Secret key<sup class="text-danger">*</sup></label>
                                                        <div class="col-md-8">
                                                            <input type="text" name="StripeSecretkey" value="{{ $setting->StripeSecretkey ? : '' }}" required class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-md-4 col-form-label">Test Publishable key<sup class="text-danger">*</sup></label>
                                                        <div class="col-md-8">
                                                            <input type="text" name="StripePublishablekey" required value="{{ $setting->StripePublishablekey ? : '' }}" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-md-4 col-form-label">Test Endpoint Secret<sup class="text-danger">*</sup></label>
                                                        <div class="col-md-8">
                                                            <input type="text" name="test_endpoint_secret" required value="{{ $setting->test_endpoint_secret ? : '' }}" class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-5 col-sm-6 col-lg-6">
                                                    <div class="form-group row">
                                                        <label class="col-md-4 col-form-label">Live Secret key<sup class="text-danger">*</sup></label>
                                                        <div class="col-md-8">
                                                            <input type="text" name="live_StripeSecretkey" value="{{ $setting->live_StripeSecretkey ? : '' }}" required class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-md-4 col-form-label">Live Publishable key<sup class="text-danger">*</sup></label>
                                                        <div class="col-md-8">
                                                            <input type="text" name="live_StripePublishablekey" required value="{{ $setting->live_StripePublishablekey ? : '' }}" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-md-4 col-form-labe">Live Endpoint Secret<sup class="text-danger">*</sup></label>
                                                        <div class="col-md-8">
                                                            <input type="text" name="live_endpoint_secret" required value="{{ $setting->live_endpoint_secret ? : '' }}" class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>                                     
                                          
                                            <div class="form-group row">                                                
                                                <div class="col-md-4">
                                                    <button type="submit" class="btn btn-info">Save</button>
                                                </div>
                                            </div>
                                        {{ Form::close() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>   
</div>
@endsection
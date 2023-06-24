@extends('admin.layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row page-titles mx-0">        
        <div class="col-sm-6 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{URL::to('superadmin/dashboard')}}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{URL::to('superadmin/seo')}}">SEO list</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Add SEO</a></li>
            </ol>
        </div>		
	</div> 
    <div class="row">
        <div class="col-lg-12">
            <div class="card">                
                <div class="card-body">
                    <div class="card-header pt-0 pl-0 pr-0">
                        <h4 class="card-title">Add SEO</h4>
                        <a href="{{URL::to('superadmin/seo')}}" class="btn btn-primary pull-right">
                            <i class="fa fa-list"></i> SEO List
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
                    {{ Form::open(array('url' => 'superadmin/add-seo' , 'autocomplete'=>'off', 'enctype' =>'multipart/form-data')) }}
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <label style="color:#333;">Select Page<sup class="text-danger">*</sup></label>
                                <select class="form-control SelectMemberType" required name="select_page">
                                    <option value="">Select Type</option>                                   
                                    <option value="home">Home</option>
                                    <option value="offer">What We Offer</option>
                                    <option value="SignUpFamiliesParents">Sign Up Families Parents</option>
                                    <option value="OfferFamiliesParents">Offer Families Parents</option>
                                    <option value="BackgroundChecks">Background Checks</option>
                                    <option value="LastMinuteGroupText">Last Minute Group Text</option>
                                    <option value="FaqGuides">Faq Guides</option>
                                    <option value="help">Help</option>
                                    <option value="MemberSearch">Member Search</option>
                                    <option value="NannyContract">Nanny Contract</option>
                                    <option value="NannyShareContract">Nanny Share Contract</option>
                                    <option value="PayrollService">Payroll Service</option>
                                    <option value="PayCalculator">Pay Calculator</option>
                                    <option value="VerifiedCareProviders">Verified Care Providers</option>
                                    <option value="SignCareProvider">Sign Care Provider</option>
                                    <option value="OfferCareProviders">Offer Care Providers</option>
                                    <option value="CareProvidersJobs">Care Providers Jobs</option>
                                    <option value="SignUpAgencies">Sign Up Agencies</option>
                                    <option value="SignUpChooser">Sign Up Chooser</option>
                                    <option value="aboutUs">About Us</option>
                                    <option value="contactUs">Contact Us</option>
                                    <option value="LearningGuidesParents">Learning Guides Parents</option>
                                    <option value="SignUpFamiliesParentsConcierge">Sign Up Families Parents Concierge</option>                               
                                </select>
                            </div>                            
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12">
                            <label style="color:#333;">SEO Title<sup class="text-danger">*</sup></label>
                                <input type="text" name="seo_Title" required value="{{ old('seo_Title') }}" class="form-control">
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <label style="color:#333;">Meta Description</label>
                                <textarea class="form-control" rows="5" name="meta_description"></textarea>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <label style="color:#333;width:100%;">Meta Tags</label> 
                                <input type="text" name="tags" placeholder="Enter meta tags" class="tm-input form-control tm-input-info"/>
                                <small class="text-dark font-weight-bold">Press enter after add tag for new.</small>
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
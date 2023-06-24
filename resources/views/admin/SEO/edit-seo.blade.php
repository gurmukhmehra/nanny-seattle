@extends('admin.layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row page-titles mx-0">        
        <div class="col-sm-6 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{URL::to('superadmin/dashboard')}}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{URL::to('superadmin/seo')}}">SEO list</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Edit : {{$seoDetail->seo_Title}} </a></li>
            </ol>
        </div>		
	</div> 
    <div class="row">
        <div class="col-lg-12">
            <div class="card">                
                <div class="card-body">
                    <div class="card-header pt-0 pl-0 pr-0">
                        <h4 class="card-title" style="font-size:15px;">Edit SEO : {{$seoDetail->seo_Title}}</h4>
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
                    {{ Form::open(array('url' => 'superadmin/seo/update-seo' , 'autocomplete'=>'off', 'enctype' =>'multipart/form-data')) }}
                        <input type="hidden" value="{{encrypt($seoDetail->id)}}" name="seo_id">
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <label style="color:#333;">Select Page</label>
                                <select class="form-control SelectMemberType" disabled name="select_page">
                                    <option value="">Select Type</option>                                   
                                    <option value="home" @if($seoDetail->page_Name=='home') selected @endif>Home</option>
                                    <option value="offer" @if($seoDetail->page_Name=='offer') selected @endif>What We Offer</option>
                                    <option value="sign-up-families-parents" @if($seoDetail->page_Name=='sign-up-families-parents') selected @endif>Sign Up Families Parents</option>
                                    <option value="offer-families-parents" @if($seoDetail->page_Name=='offer-families-parents') selected @endif>Offer Families Parents</option>
                                    <option value="background-checks" @if($seoDetail->page_Name=='background-checks') selected @endif>Background Checks</option>
                                    <option value="last-minute-group-text" @if($seoDetail->page_Name=='last-minute-group-text') selected @endif>Last Minute Group Text</option>
                                    <option value="faq-guides" @if($seoDetail->page_Name=='faq-guides') selected @endif>Faq Guides</option>
                                    <option value="help" @if($seoDetail->page_Name=='help') selected @endif>Help</option>
                                    <option value="member-search" @if($seoDetail->page_Name=='member-search') selected @endif>Member Search</option>
                                    <option value="nanny-contract" @if($seoDetail->page_Name=='nanny-contract') selected @endif>Nanny Contract</option>
                                    <option value="nanny-share-contract" @if($seoDetail->page_Name=='nanny-share-contract') selected @endif>Nanny Share Contract</option>
                                    <option value="payroll-service" @if($seoDetail->page_Name=='payroll-service') selected @endif>Payroll Service</option>
                                    <option value="pay-calculator" @if($seoDetail->page_Name=='pay-calculator') selected @endif>Pay Calculator</option>
                                    <option value="verified-care-providers" @if($seoDetail->page_Name=='verified-care-providers') selected @endif>Verified Care Providers</option>
                                    <option value="sign-care-provider" @if($seoDetail->page_Name=='sign-care-provider') selected @endif>Sign Care Provider</option>
                                    <option value="sign-care-provider" @if($seoDetail->page_Name=='sign-care-provider') selected @endif>Sign Care Provider</option>
                                    <option value="offer-care-providers" @if($seoDetail->page_Name=='offer-care-providers') selected @endif>Offer Care Providers</option>
                                    <option value="care-providers-jobs" @if($seoDetail->page_Name=='care-providers-jobs') selected @endif>Care Providers Jobs</option>
                                    <option value="sign-up-agencies" @if($seoDetail->page_Name=='sign-up-agencies') selected @endif>Sign Up Agencies</option>
                                    <option value="sign-up-chooser" @if($seoDetail->page_Name=='sign-up-chooser') selected @endif>Sign Up Chooser</option>
                                    <option value="about-us" @if($seoDetail->page_Name=='about-us') selected @endif>About Us</option>
                                    <option value="contact-us" @if($seoDetail->page_Name=='contact-us') selected @endif>Contact Us</option>
                                    <option value="learning-guides-parents" @if($seoDetail->page_Name=='learning-guides-parents') selected @endif>Learning Guides Parents</option>
                                    <option value="sign-up-families-parents-concierge" @if($seoDetail->page_Name=='sign-up-families-parents-concierge') selected @endif>Sign Up Families Parents Concierge</option>                               
                                </select>
                            </div>                            
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <label style="color:#333;">SEO Title<sup class="text-danger">*</sup></label>
                                <input type="text" name="seo_Title" required value="{{$seoDetail->seo_Title}}" class="form-control">
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <label style="color:#333;">Meta Description</label>
                                <textarea class="form-control" rows="6" name="meta_description">{{$seoDetail->meta_description}}</textarea>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <label style="color:#333;width:100%;">Meta Tags</label>
                                @if(!empty($seoDetail->meta_tags))
                                    @php
                                        $tags = explode(',', $seoDetail->meta_tags);                                        
                                    @endphp
                                    @foreach($tags as $key=> $tag)
                                        <span class="tm-tag tm-tag-info" id="QNoPk_{{$key}}">
                                            <span>{{$tag}}</span>
                                            <!-- <a href="#" class="tm-tag-remove" id="QNoPk_Remover_{{$key}}" tagidtoremove="{{$key}}">x</a> -->
                                        </span>                                        
                                    @endforeach
                                @endif                            
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
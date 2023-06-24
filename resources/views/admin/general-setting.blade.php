@extends('admin.layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row page-titles mx-0">        
        <div class="col-sm-6 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{URL::to('superadmin/dashboard')}}">Dashboard</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">General Setting</a></li>
            </ol>
        </div>		
	</div> 
    <div class="row">
        <div class="col-lg-12">
            <div class="card" style="background-color:#B3ABAB47;">                
                <div class="card-body">
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
                    {{ Form::open(array('url' => 'superadmin/general-setting' , 'enctype' =>'multipart/form-data')) }}
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label text-right">Logo</label>
                            <div class="col-md-3">
                                <input type="file" name="siteLogo" class="form-control-sm">
                            </div>
                            <div class="col-md-6 text-left">
                                @if(!empty($setting->siteLogo))
                                    <img style="max-width:100%;" class="img-responsive" src="{{ URL::asset('/uploads/'.$setting->siteLogo) }}" alt="">
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label text-right">Fav icon</label>
                            <div class="col-md-3">
                                <input type="file" name="siteFavicon" class="form-control-sm">
                            </div>
                            <div class="col-md-6 text-left">
                                @if(!empty($setting->siteFavicon))
                                    <img style="max-width:7%;" class="img-responsive" src="{{ URL::asset('/uploads/'.$setting->siteFavicon) }}" alt="">
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label text-right">Site Name<sup class="text-danger">*</sup></label>
                            <div class="col-md-8">
                                <input type="text" name="siteName" value="{{ $setting->siteName ? : '' }}" required class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label text-right">Site Email<sup class="text-danger">*</sup></label>
                            <div class="col-md-8">
                                <input type="email" name="siteEmail" required value="{{ $setting->siteEmail ? : '' }}" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label text-right">Contact number</label>
                            <div class="col-md-8">
                                <input type="text" name="siteNumber" value="{{ $setting->siteNumber ? : '' }}" class="form-control">
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label text-right">Copy right</label>
                            <div class="col-md-8">
                                <input type="text" name="siteCopyright" value="{{ $setting->siteCopyright ? : '' }}" class="form-control">
                            </div>
                        </div>
                        <hr>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label text-right">Facebook Link</label>
                            <div class="col-md-8">
                                <input type="text" name="facebookLink" value="{{ $setting->facebookLink ? : '' }}" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label text-right">Twitter Link</label>
                            <div class="col-md-8">
                                <input type="text" name="twitterLink" value="{{ $setting->twitterLink ? : '' }}" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label text-right">Youtube Link</label>
                            <div class="col-md-8">
                                <input type="text" name="youtubeLink" value="{{ $setting->youtubeLink ? : '' }}" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label text-right">Instagram</label>
                            <div class="col-md-8">
                                <input type="text" name="instagramLink" value="{{ $setting->instagramLink ? : '' }}" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label text-right"></label>
                            <div class="col-md-8">
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
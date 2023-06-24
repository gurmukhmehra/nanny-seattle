@extends('admin.layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row page-titles mx-0">        
        <div class="col-sm-6 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{URL::to('superadmin/dashboard')}}">Dashboard</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Change Password</a></li>
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
                    {{ Form::open(array('url' => 'superadmin/change-password' , 'enctype' =>'multipart/form-data')) }}                      
                        
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label text-right">New Password<sup class="text-danger">*</sup></label>
                            <div class="col-md-8">
                                <input type="password" name="password" required value="" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label text-right">confirm New Password<sup class="text-danger">*</sup></label>
                            <div class="col-md-8">
                                <input type="password" name="confirmPassword" value="" required class="form-control">
                            </div>
                        </div>                    
                        <hr>                     
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
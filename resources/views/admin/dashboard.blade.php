@extends('admin.layouts.app')
@section('content')
<div class="container-fluid" style="background-color:#B3ABAB47;">
    <div class="form-head d-flex mb-3 align-items-start">
        <div class="mr-auto d-none d-lg-block">
            <h2 class="text-black font-w600 mb-0">Dashboard</h2>
            <p class="mb-0 text-success">Welcome to <b>Nanny Parent Connection Admin!</b></p>
        </div>		
	</div>
    <div class="row">
        <div class="col-xl-3 col-xxl-3 col-lg-6 col-md-6 col-sm-6">
            <div class="widget-stat card">
                <div class="card-body p-4">
                    <a href="{{URL::to('superadmin/users-list')}}">
                        <div class="media ai-icon">
                            <span class="mr-3 bgl-primary text-primary">
                                <i class="flaticon-381-user"></i>
                            </span>
                            <div class="media-body">
                                <h3 class="mb-0 text-black"><span class="counter ml-0">{{$users}}</span></h3>
                                <p class="mb-0 text-primary">Users</p>                            
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-xxl-3 col-lg-6 col-md-6 col-sm-6">
            <div class="widget-stat card">
                <div class="card-body p-4">
                    <a href="{{URL::to('superadmin/memberships-list')}}">
                        <div class="media ai-icon">
                            <span class="mr-3 bgl-primary text-info">
                            <i class="flaticon-381-list"></i>
                            </span>
                            <div class="media-body">
                                <h3 class="mb-0 text-black"><span class="counter ml-0">{{$memberShips}}</span></h3>
                                <p class="mb-0 text-primary">Membership</p>
                                <!-- <small>4% (30 days)</small> -->
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-xxl-3 col-lg-6 col-md-6 col-sm-6">
            <div class="widget-stat card">
                <div class="card-body p-4">
                    <div class="media ai-icon">
                        <span class="mr-3 bgl-primary text-success">
                            <i class="fa fa-briefcase"></i>
                        </span>
                        <div class="media-body">
                            <h3 class="mb-0 text-black">
                                <span class="counter ml-0">{{$activeJobs}}</span></h3>
                            <p class="mb-0 text-success">Active Jobs</p>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-xxl-3 col-lg-6 col-md-6 col-sm-6">
            <div class="widget-stat card">
                <div class="card-body p-4">
                    <div class="media ai-icon">
                        <span class="mr-3 bgl-primary text-danger">
                            <i class="fa fa-briefcase"></i>
                        </span>
                        <div class="media-body">
                            <h3 class="mb-0 text-black">
                            <span class="counter ml-0">{{$draftJobs}}</span></h3>
                            <p class="mb-0 text-danger">Draft Jobs</p>                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
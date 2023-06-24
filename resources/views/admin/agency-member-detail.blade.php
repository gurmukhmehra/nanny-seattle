@extends('admin.layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row page-titles mx-0">        
        <div class="col-sm-6 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{URL::to('superadmin/dashboard')}}">Dashboard</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Member Detail</a></li>
            </ol>
        </div>  
        		
	</div> 
    <div class="row">
        <div class="col-lg-12">
            <div class="card" style="background-color:#B3ABAB47;">                
                <div class="card-body"> 
                    <div class="card-header pt-0">
                        <h5 class="card-title">User : {{$user->name}}</h5>                        
                    </div>                                  
                    <!----------------- Tabs ---------------------->
                    <ul class="nav nav-pills mb-3 bg-white" id="pills-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="true">Profile</a>
                        </li>
                        <!-- <li class="nav-item">
                            <a class="nav-link" id="pills-bioDetail-tab" data-toggle="pill" href="#pills-bioDetail" role="tab" aria-controls="pills-bioDetail" aria-selected="false">Extended Profile</a>
                        </li> -->
                    </ul>
                    <div class="tab-content bg-white p-3" id="pills-tabContent">
                        <div class="tab-pane fade active show" id="pills-profile" role="tabpanel" aria-labelledby="pills-home-tab">
                            <div class="row mt-4">
                                <div class="col-md-6">
                                    <label style="color:#333;">Username</label>
                                    <input type="text" name="" disabled value="{{$user->username}}" class="form-control">                          
                                </div>
                                <div class="col-md-6">
                                    <label style="color:#333;">Member Type</label>
                                    @if($user->memberType=='agency_member')
                                        <input type="text" name="" disabled value="Agency" class="form-control">
                                    @elseif($user->memberType=='care_provider_member')
                                        <input type="text" name="" disabled value="Care Provider" class="form-control">
                                    @elseif($user->memberType=='family_parent_member')
                                        <input type="text" name="" disabled value="Pamily Parent" class="form-control">
                                    @elseif($user->role=='subscriber')
                                        <input type="text" name="" disabled value="Subscriber" class="form-control">
                                    @else
                                        <input type="text" name="" disabled value="User" class="form-control">
                                    @endif 
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-md-6">
                                    <label style="color:#333;">First Name</label>
                                    <input type="text" name=""  value="{{$user->firstName}}" class="form-control">                          
                                </div>
                                <div class="col-md-6">
                                    <label style="color:#333;">Last Name</label>
                                    <input type="text" name=""  value="{{$user->lastName}}" class="form-control"> 
                                </div>
                            </div>
                            <hr>
                            <h4 class="mt-3">Contact Info</h4>
                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <label style="color:#333;">Email</label>
                                    <input type="text" name=""  value="{{$user->email}}" class="form-control">                          
                                </div>  
                                <div class="col-md-6">
                                    <label style="color:#333;">Phone</label>
                                    <input type="text" name=""  value="{{$user->mobile}}" class="form-control">                          
                                </div>                      
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-6">
                                    <label style="color:#333;">Address 1</label>
                                    <input type="text" name=""  value="{{$user->address1}}" class="form-control">                          
                                </div>  
                                <div class="col-md-6">
                                    <label style="color:#333;">Address 2</label>
                                    <input type="text" name=""  value="{{$user->address2}}" class="form-control">                          
                                </div>                      
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-6">
                                    <label style="color:#333;">State</label>
                                    <input type="text" name=""  value="{{$user->state}}" class="form-control">                          
                                </div>  
                                <div class="col-md-6">
                                    <label style="color:#333;">Postal Code</label>
                                    <input type="text" name=""  value="{{$user->postal_code}}" class="form-control">                          
                                </div>                      
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-6">
                                    <label style="color:#333;">Facebook</label>
                                    <input type="text" name="facebookURL"  value="{{$user->facebookURL}}" class="form-control">                          
                                </div>  
                                <div class="col-md-6">
                                    <label style="color:#333;">Instagram</label>
                                    <input type="text" name="instagramURL"  value="{{$user->instagramURL}}" class="form-control">                          
                                </div>                      
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-6">
                                    <label style="color:#333;">LinkedIn</label>
                                    <input type="text" name="linkedinURL"  value="{{$user->linkedinURL}}" class="form-control">                          
                                </div>  
                                <div class="col-md-6">
                                    <label style="color:#333;">Twitter</label>
                                    <input type="text" name="twitterURL"  value="{{$user->twitterURL}}" class="form-control">                          
                                </div>                      
                            </div>
                        </div>
                    
                        <!-- <div class="tab-pane fade" id="pills-bioDetail" role="tabpanel" aria-labelledby="pills-bioDetail-tab">
                            <p class="mb-0">
                                {{$user->name}} , {{$user->memberType}}
                            </p>
                        </div>                         -->
                    </div>
                    <!----------------- End Tabs ---------------------->               
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


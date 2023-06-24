@extends('admin.layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row page-titles mx-0">        
        <div class="col-sm-6 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{URL::to('superadmin/dashboard')}}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{URL::to('superadmin/users-list')}}">Users List</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Add User</a></li>
            </ol>
        </div>  
        		
	</div> 
    <div class="row">
        <div class="col-lg-12">
            <div class="card" style="background-color:#B3ABAB47;">                
                <div class="card-body"> 
                    <div class="card-header pt-0">
                        <h5 class="card-title">Add User</h5>
                        <a href="{{URL::to('superadmin/users-list')}}" class="btn btn-primary pull-right">
                            <i class="fa fa-list"></i> Users List
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

                    {{ Form::open(array('url' => 'superadmin/add-user' , 'autocomplete'=>'off', 'enctype' =>'multipart/form-data')) }}
                        
                        <div class="row mt-4">
                            <div class="col-md-6">
                                <label style="color:#333;">Member Type<sup class="text-danger">*</sup></label>
                                <select class="form-control SelectMemberType" required name="memberType">
                                    <option value="">Select Type</option>
                                    <option value="family_parent_member">Family Parents</option>
                                    <option value="care_provider_member">Care Provider </option> 
                                    <option value="agency_member">Agency </option>                                
                                </select>
                            </div>
                            <div class="col-md-6 selectOption" style="display:none;">
                                <label style="color:#333;">Select Membership<sup class="text-danger">*</sup></label>
                                <select class="form-control FamilyParentsMembership" name="FamilyMemberShipType" style="display:none;">
                                    <option value="">Select </option>
                                    @if($familiesPlans[0]->id=='29748')
                                        <option value="{{$familiesPlans[0]->id}}">Annual</option>
                                    @endif 
                                    @if($familiesPlans[2]->id=='155721')
                                        <option value="{{$familiesPlans[2]->id}}">Monthly</option>
                                    @endif 
                                    @if($familiesPlans[1]->id=='155718')
                                        <option value="{{$familiesPlans[1]->id}}">One Month Only</option>
                                    @endif                              
                                </select>
                                <select class="form-control CareProviderMembership" name="CareProviderMemberShipType" style="display:none;">
                                    <option value="">Select </option>
                                    @if($careProviderPlans[0]->id=='29896')
                                        <option value="{{$careProviderPlans[0]->id}}">Annual</option>
                                    @endif 
                                    @if($careProviderPlans[1]->id=='176612')
                                        <option value="{{$careProviderPlans[1]->id}}">Free</option>
                                    @endif                                
                                </select>
                                <select class="form-control agencyMembership " name="AgencyMemberShipType" style="display:none;">
                                    <option value="">Select </option>
                                    @if($AgenciesPlans[0]->id=='30019')
                                        <option value="{{$AgenciesPlans[0]->id}}">Annual</option>
                                    @endif 
                                    @if($AgenciesPlans[2]->id=='155715')
                                        <option value="{{$AgenciesPlans[2]->id}}">Monthly</option>
                                    @endif 
                                    @if($AgenciesPlans[1]->id=='155712')
                                        <option value="{{$AgenciesPlans[1]->id}}">One Month Only</option>
                                    @endif                               
                                </select>
                            </div>
                        </div> 
                        
                        <div class="row mt-4">
                            <div class="col-md-6">
                                <label style="color:#333;">First Name<sup class="text-danger">*</sup></label>
                                <input type="text" name="firstName" required value="{{ old('firstName') }}" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label style="color:#333;">Last Name<sup class="text-danger">*</sup></label>
                                <input type="text" name="lastName" required value="{{ old('lastName') }}" class="form-control">
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-md-6">
                                <label style="color:#333;">Address Line 1<sup class="text-danger">*</sup></label>
                                <input type="text" name="address1" required value="{{ old('address1') }}" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label style="color:#333;">Address Line 2</label>
                                <input type="text" name="address2" value="{{ old('address2') }}" class="form-control">
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-md-6">
                                <label style="color:#333;">State/Province<sup class="text-danger">*</sup></label>
                                <input type="text" name="state" required value="{{ old('state') }}" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label style="color:#333;">Zip/Postal Code<sup class="text-danger">*</sup></label>
                                <input type="text" name="postalCode" value="{{ old('postalCode') }}" class="form-control">
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-md-12">
                                <label style="color:#333;">Phone number to receive SMS (text message) notification when a member wants to connect with you:</label>
                                <input type="tel" name="phoneNumber" value="{{ old('phoneNumber') }}" class="form-control">
                            <div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-md-6">
                                <label style="color:#333;">Username<sup class="text-danger">*</sup></label>
                                <input type="text" name="username" required value="{{ old('username') }}" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label style="color:#333;">Email</label>
                                <input type="text" name="email" value="{{ old('email') }}" class="form-control">
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-md-6">
                                <label style="color:#333;">Password<sup class="text-danger">*</sup></label>
                                <input type="password" name="password" required value="{{ old('password') }}" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label style="color:#333;">Confirm Password<sup class="text-danger">*</sup></label>
                                <input type="password" name="confirmPassword" required value="{{ old('confirmPassword') }}" class="form-control">
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
            $('.SelectMemberType').change(function (e) {    
                var memberType = $(this).val();
                if(memberType=='family_parent_member'){                    
                    $('.FamilyParentsMembership').css('display','block');
                    $('.FamilyParentsMembership').attr('required',true);
                    $('.CareProviderMembership').css('display','none');
                    $('.CareProviderMembership').attr('required',false);
                    $('.agencyMembership').css('display','none');
                    $('.agencyMembership').attr('required',false);
                    $('.selectOption').css('display','block');
                } else if(memberType=='care_provider_member') {                   
                    $('.FamilyParentsMembership').css('display','none');
                    $('.FamilyParentsMembership').attr('required',false);
                    $('.CareProviderMembership').css('display','block');
                    $('.CareProviderMembership').attr('required',true);
                    $('.agencyMembership').css('display','none');
                    $('.agencyMembership').attr('required',false);
                    $('.selectOption').css('display','block');
                } else if(memberType=='agency_member') {                    
                    $('.FamilyParentsMembership').css('display','none');
                    $('.FamilyParentsMembership').attr('required',false);
                    $('.CareProviderMembership').css('display','none');
                    $('.CareProviderMembership').attr('required',false);
                    $('.agencyMembership').css('display','block');
                    $('.agencyMembership').attr('required',true);
                    $('.selectOption').css('display','block');
                } else {
                    $('.FamilyParentsMembership').css('display','none');
                    $('.FamilyParentsMembership').attr('required',false);
                    $('.CareProviderMembership').css('display','none');
                    $('.CareProviderMembership').attr('required',false);
                    $('.agencyMembership').css('display','none');
                    $('.agencyMembership').attr('required',false);
                    $('.selectOption').css('display','none');
                }
            });

        });
        
    </script>
@endpush


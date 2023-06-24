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
                        <li class="nav-item">
                            <a class="nav-link" id="pills-bioDetail-tab" data-toggle="pill" href="#pills-bioDetail" role="tab" aria-controls="pills-bioDetail" aria-selected="false">Extended Profile</a>
                        </li>
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
                    
                        <div class="tab-pane fade" id="pills-bioDetail" role="tabpanel" aria-labelledby="pills-bioDetail-tab">
                            <div class="row mt-2 mb-3">
                                <div class="col-md-12">
                                    <label style="color:#333;">Currently seeking new families to work with?</label>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-check-inline">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" @if($userBio->currently_seeking_provider_work=='Yes') checked @endif value="Yes" name="currently_seeking_provider_work">Yes
                                        </label>
                                    </div>
                                    <div class="form-check-inline">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" @if($userBio->currently_seeking_provider_work=='No') checked @endif value="No" name="currently_seeking_provider_work">No
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3 mb-4">
                                <div class="col-md-12">
                                    <label style="color:#333;">What city do you live in?</label>
                                    <input type="text" name="live_in"  value="{{$userBio->live_in}}" class="form-control">                          
                                </div>
                            </div>
                            <div class="row mt-2 mb-4">
                                @php 
                                    $TypeOfCareLooking = unserialize($userBio->TypeOfCareLooking);
                                    $careOpportunities = unserialize($userBio->CareOpportunities);
                                    $parentsNeedsLanguages =  unserialize($userBio->parentsNeedsLanguages);                           
                                @endphp
                                <div class="col-md-6">
                                    <label style="color:#333;">Type(s) of care you are looking for</label>
                                    <div class="form-check">
                                        <label for="FullTimeNanny" class="form-check-label">
                                            <input type="checkbox" id="FullTimeNanny" class="form-check-input" @if(in_array('Full Time Nanny', $TypeOfCareLooking)) checked @endif value="Full Time Nanny"> Full Time Nanny
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <label for="PartTimeNanny" class="form-check-label">
                                            <input type="checkbox" id="PartTimeNanny" class="form-check-input" @if(in_array('Part Time Nanny', $TypeOfCareLooking)) checked @endif value="Part Time Nanny"> Part Time Nanny
                                        </label>
                                    </div> 
                                    <div class="form-check">
                                        <label for="NannyShareNanny" class="form-check-label">
                                            <input type="checkbox" id="NannyShareNanny" class="form-check-input" @if(in_array('Nanny Share Nanny', $TypeOfCareLooking)) checked @endif value="Nanny Share Nanny"> Nanny Share Nanny
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <label for="Babysitting" class="form-check-label">
                                            <input type="checkbox" id="Babysitting" class="form-check-input" @if(in_array('Babysitting', $TypeOfCareLooking)) checked @endif value="Babysitting"> Babysitting
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <label for="AuPair" class="form-check-label">
                                            <input type="checkbox" id="AuPair" class="form-check-input" @if(in_array('Au Pair', $TypeOfCareLooking)) checked @endif value="Au Pair"> Au Pair
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <label for="LastMinuteCare" class="form-check-label">
                                            <input type="checkbox" id="LastMinuteCare" class="form-check-input" @if(in_array('Last Minute Care', $TypeOfCareLooking)) checked @endif value="Last Minute Care"> Last Minute Care
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <label for="DateNightTempCare" class="form-check-label">
                                            <input type="checkbox" id="DateNightTempCare" class="form-check-input" @if(in_array('Date Night/Temporary Care', $TypeOfCareLooking)) checked @endif value="Date Night/Temporary Care"> Date Night/Temporary Care
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <label for="BeforeAfterSchoolCare" class="form-check-label">
                                            <input type="checkbox" id="BeforeAfterSchoolCare" class="form-check-input" @if(in_array('Before/After School Care', $TypeOfCareLooking)) checked @endif value="Before/After School Care"> Before/After School Care
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <label for="LearningGuide" class="form-check-label">
                                            <input type="checkbox" id="LearningGuide" class="form-check-input" @if(in_array('Learning Guide (Academic Support)', $TypeOfCareLooking)) checked @endif value="Learning Guide (Academic Support)"> Learning Guide (Academic Support)
                                        </label>
                                    </div>                          
                                </div>
                                <div class="col-md-6">
                                    <label style="color:#333;">Where are you looking for care opportunities?</label>
                                    <div class="form-check">
                                        <label for="Seattle" class="form-check-label">
                                            <input type="checkbox" id="Seattle" class="form-check-input" value="Seattle" @if(in_array('Seattle', $careOpportunities)) checked @endif> Seattle
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <label for="EastKingCounty" class="form-check-label">
                                            <input type="checkbox" id="EastKingCounty" class="form-check-input" value="East King County" @if(in_array('East King County', $careOpportunities)) checked @endif> East King County
                                        </label>
                                    </div> 
                                    <div class="form-check">
                                        <label for="NorthKingCounty" class="form-check-label">
                                            <input type="checkbox" id="NorthKingCounty" class="form-check-input" value="North King County" @if(in_array('North King County', $careOpportunities)) checked @endif> North King County
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <label for="SouthKingCounty" class="form-check-label">
                                            <input type="checkbox" id="SouthKingCounty" class="form-check-input" value="South King County" @if(in_array('South King County', $careOpportunities)) checked @endif> South King County
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <label for="SnohomishCounty" class="form-check-label">
                                            <input type="checkbox" id="SnohomishCounty" class="form-check-input" value="Snohomish County" @if(in_array('Snohomish County', $careOpportunities)) checked @endif> Snohomish County
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <label for="PierceCounty" class="form-check-label">
                                            <input type="checkbox" id="PierceCounty" class="form-check-input" value="Pierce County" @if(in_array('Pierce County', $careOpportunities)) checked @endif> Pierce County
                                        </label>
                                    </div>                          
                                </div>
                            </div>
                            <div class="row mt-2 mb-4">                                                                  
                                <div class="col-md-6">
                                    <label for="" style="font-weight: 600;">Desired hourly pay rate range?</label>
                                    <div class="form-group">
                                        <input type="text" placeholder="Minimum Range" value="{{$userBio->minRange}}" class="form-control" style="border:1px solid #333;">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" placeholder="Maximum Range" value="{{$userBio->maxRange}}" class="form-control" style="border:1px solid #333;margin-top:30px;">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <small>Example: $20 - $25. If you are unsure of current pay rates in your area, please click here review our pay rate surveys.</small>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-md-12">                                
                                    <div class="form-group">
                                        <label for="" style="font-weight: 600;">About Me</label>
                                        <textarea name="" class="form-control" id="" rows="5" style="border:1px solid #333;">{{$userBio->aboutMyfamily}}</textarea>                                                                                                                                          
                                    </div>
                                </div>                                                               
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label style="font-weight: 600;">Number of children that you need child care for?</label>
                                        <select class="form-control" style="border:1px solid #333;">
                                            <option value="">---</option>
                                            <option value="1" @if(!empty($userBio->numnerOfchild) && $userBio->numnerOfchild=='1') selected @endif>1</option>
                                            <option value="2" @if(!empty($userBio->numnerOfchild) && $userBio->numnerOfchild=='2') selected @endif>2</option>
                                            <option value="3" @if(!empty($userBio->numnerOfchild) && $userBio->numnerOfchild=='3') selected @endif>3</option>
                                            <option value="4" @if(!empty($userBio->numnerOfchild) && $userBio->numnerOfchild=='4') selected @endif>4</option>
                                            <option value="5" @if(!empty($userBio->numnerOfchild) && $userBio->numnerOfchild=='5') selected @endif>5</option>
                                            <option value="6" @if(!empty($userBio->numnerOfchild) && $userBio->numnerOfchild=='6') selected @endif>6 or more</option>
                                            <option value="it complicated" @if(!empty($userBio->numnerOfchild) && $userBio->numnerOfchild=='it complicated') selected @endif>It's complicated</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label style="font-weight: 600;">Ages of child(ren) that need child care?</label>
                                    <input type="text" class="form-control" value="{{$userBio->childAge}}" style="border:1px solid #333;">
                                    <small>Example: 11 months old and 4 years old</small>                
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label style="font-weight: 600;">Preference on care provider experience level? : <sup class="text-danger" style="font-size:18px;">*</sup></label>
                                        <select class="form-control" style="border:1px solid #333;">
                                            <option value="">---</option>
                                            <option value="Any experience level" @if($userBio->providerExperience=='Any experience level') selected @endif>Any experience level</option>
                                            <option value="At least 1 year of experience" @if($userBio->providerExperience=='At least 1 year of experience') selected @endif>At least 1 year of experience</option>
                                            <option value="At least 1 to 3 years" @if($userBio->providerExperience=='At least 1 to 3 years') selected @endif>At least 1 to 3 years</option>
                                            <option value="At least 4 to 6 years" @if($userBio->providerExperience=='At least 4 to 6 years') selected @endif>At least 4 to 6 years</option>
                                            <option value="At least 7 to 9 years" @if($userBio->providerExperience=='At least 7 to 9 years') selected @endif>At least 7 to 9 years</option>
                                            <option value="10 or more years of experience" @if($userBio->providerExperience=='10 or more years of experience') selected @endif>10 or more years of experience</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label style="font-weight: 600;">Does your family/children have any allergies or special needs that care providers should be aware of? : <sup class="text-danger" style="font-size:18px;">*</sup></label>
                                        <select class="form-control" style="border:1px solid #333;">
                                            <option value="">---</option>
                                            <option value="Yes" @if($userBio->ChildSpecialNeeds=='Yes') selected @endif>Yes</option>
                                            <option value="No" @if($userBio->ChildSpecialNeeds=='No') selected @endif>No</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="" style="font-weight: 600;">Please share any details regarding allergies or special needs that prospective families should be aware of:</label>
                                        <textarea rows="6" class="form-control" style="border:1px solid #333;">{{$userBio->SpecialNeedsExtra}}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label style="font-weight: 600;">Are you seeking a care provider that speaks languages other than English? : <sup class="text-danger" style="font-size:18px;">*</sup></label>
                                        <select class="form-control" style="border:1px solid #333;">
                                            <option value="">---</option>
                                            <option value="Yes" @if($userBio->providerSpeaksLanguages=='Yes') selected @endif>Yes</option>
                                            <option value="No" @if($userBio->providerSpeaksLanguages=='No') selected @endif>No</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label style="font-weight: 600;">Select all languages that you would like the care provider to be able to use conversationally:</label>
                                        <select class="form-control" multiple="multiple" style="border:1px solid #333;">
                                            <option value="">---</option>
                                            <option value="American Sign Language" @if(!empty($parentsNeedsLanguages)) @if(in_array('American Sign Language', $parentsNeedsLanguages)) selected @endif @endif>American Sign Language</option>
                                            <option value="Arabic" @if(!empty($parentsNeedsLanguages)) @if(in_array('Arabic', $parentsNeedsLanguages)) selected @endif @endif>Arabic</option>
                                            <option value="Bengali" @if(!empty($parentsNeedsLanguages)) @if(in_array('Bengali', $parentsNeedsLanguages)) selected @endif @endif>Bengali</option>
                                            <option value="German" @if(!empty($parentsNeedsLanguages)) @if(in_array('German', $parentsNeedsLanguages)) selected @endif @endif>German</option>
                                            <option value="French" @if(!empty($parentsNeedsLanguages)) @if(in_array('French', $parentsNeedsLanguages)) selected @endif @endif>French</option>
                                            <option value="Hindi" @if(!empty($parentsNeedsLanguages)) @if(in_array('Hindi', $parentsNeedsLanguages)) selected @endif @endif>Hindi</option>
                                            <option value="Indonesian" @if(!empty($parentsNeedsLanguages)) @if(in_array('Indonesian', $parentsNeedsLanguages)) selected @endif @endif>Indonesian</option>
                                            <option value="Japanese" @if(!empty($parentsNeedsLanguages)) @if(in_array('Japanese', $parentsNeedsLanguages)) selected @endif @endif>Japanese</option>
                                            <option value="Mandarin" @if(!empty($parentsNeedsLanguages)) @if(in_array('Mandarin', $parentsNeedsLanguages)) selected @endif @endif>Mandarin</option>
                                            <option value="Portugese" @if(!empty($parentsNeedsLanguages)) @if(in_array('Portugese', $parentsNeedsLanguages)) selected @endif @endif>Portugese</option>
                                            <option value="Punjabi/Lahnda" @if(!empty($parentsNeedsLanguages)) @if(in_array('Punjabi/Lahnda', $parentsNeedsLanguages)) selected @endif @endif>Punjabi/Lahnda</option>
                                            <option value="Russian" @if(!empty($parentsNeedsLanguages)) @if(in_array('Russian', $parentsNeedsLanguages)) selected @endif @endif>Russian</option>
                                            <option value="Spanish" @if(!empty($parentsNeedsLanguages)) @if(in_array('Spanish', $parentsNeedsLanguages)) selected @endif @endif>Spanish</option>
                                            <option value="Other" @if(!empty($parentsNeedsLanguages)) @if(in_array('Other', $parentsNeedsLanguages)) selected @endif @endif>Other</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label style="font-weight: 600;">Do you prefer a care provider who drives?</label>
                                        <select class="form-control" style="border:1px solid #333;">
                                            <option value="">---</option>
                                            <option value="Yes" @if($userBio->providerDrives=='Yes') selected @endif>Yes</option>
                                            <option value="No" @if($userBio->providerDrives=='No') selected @endif>No</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label style="font-weight: 600;">Do you prefer to have the care provider drive their own vehicle or one of your vehicles?</label>
                                        <select class="form-control" style="border:1px solid #333;">
                                            <option value="">---</option>
                                            <option value="Prefer drives own vehicle" @if($userBio->parentsVehicle=='Prefer drives own vehicle') selected @endif>Prefer drives own vehicle</option>
                                            <option value="Prefer drives one of our vehicles" @if($userBio->parentsVehicle=='Prefer drives one of our vehicles') selected @endif>Prefer drives one of our vehicles</option>
                                            <option value="No preference" @if($userBio->parentsVehicle=='No preference') selected @endif>No preference</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>                        
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


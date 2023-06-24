<template>   
    <main>
        <div class="iq-card-body">
            <div class="friend-list-tab mt-2">
                <ul class="nav nav-pills d-flex align-items-center justify-content-left friend-list-items p-0 mb-2">
                    <li>
                        <a class="nav-link active" data-toggle="pill" href="#careProviderBio">Bio</a>
                    </li>
                    <li>
                        <a class="nav-link" data-toggle="pill" href="#careProviderAvailability">Availability</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade active show" id="careProviderBio" role="tabpanel">
                        <hr> 
                        <div class="iq-card-body p-0">
                            <div class="row">                                
                                <div class="form-group">
                                    <label style="font-weight: 600;">What city do you live in? : <sup class="text-danger" style="font-size:18px;">*</sup></label>
                                    <input type="text" class="form-control"  placeholder="" v-model="live_in" style="border:1px solid #333;">
                                    <p class="mb-0"><small class="text-danger">{{ error_live_in}} </small></p>
                                    <small>Please enter the city that you live in. This is important as many care providers are looking for  style="border:1px solid #333;"child care opportunities located close to them.</small>                                        
                                </div> 
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label style="font-weight: 600;">Type(s) of care you are looking for :<sup class="text-danger" style="font-size:18px;">*</sup></label>
                                            <div class="form-check">
                                                <label for="FullTimeNanny" class="form-check-label">
                                                    <input type="checkbox" id="FullTimeNanny" class="form-check-input" value="Full Time Nanny" v-model="TestParentsTypeOfCareLooking"> Full Time Nanny
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <label for="PartTimeNanny" class="form-check-label">
                                                    <input type="checkbox" id="PartTimeNanny" class="form-check-input" value="Part Time Nanny" v-model="TestParentsTypeOfCareLooking"> Part Time Nanny
                                                </label>
                                            </div> 
                                            <div class="form-check">
                                                <label for="NannyShareNanny" class="form-check-label">
                                                    <input type="checkbox" id="NannyShareNanny" class="form-check-input" value="Nanny Share Nanny" v-model="TestParentsTypeOfCareLooking"> Nanny Share Nanny
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <label for="Babysitting" class="form-check-label">
                                                    <input type="checkbox" id="Babysitting" class="form-check-input" value="Babysitting" v-model="TestParentsTypeOfCareLooking"> Babysitting
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <label for="AuPair" class="form-check-label">
                                                    <input type="checkbox" id="AuPair" class="form-check-input" value="Au Pair" v-model="TestParentsTypeOfCareLooking"> Au Pair
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <label for="LastMinuteCare" class="form-check-label">
                                                    <input type="checkbox" id="LastMinuteCare" class="form-check-input" value="Last Minute Care" v-model="TestParentsTypeOfCareLooking"> Last Minute Care
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <label for="DateNightTempCare" class="form-check-label">
                                                    <input type="checkbox" id="DateNightTempCare" class="form-check-input" value="Date Night/Temporary Care" v-model="TestParentsTypeOfCareLooking"> Date Night/Temporary Care
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <label for="BeforeAfterSchoolCare" class="form-check-label">
                                                    <input type="checkbox" id="BeforeAfterSchoolCare" class="form-check-input" value="Before/After School Care" v-model="TestParentsTypeOfCareLooking"> Before/After School Care
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <label for="LearningGuide" class="form-check-label">
                                                    <input type="checkbox" id="LearningGuide" class="form-check-input" value="Learning Guide (Academic Support)" v-model="TestParentsTypeOfCareLooking"> Learning Guide (Academic Support)
                                                </label>
                                            </div>  
                                            <small class="text-danger">{{ error_CareLooking}}</small>                                                   
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label style="font-weight: 600;">Where are you looking for care opportunities? :<sup class="text-danger" style="font-size:18px;">*</sup></label>
                                            <div class="form-check">
                                                <label for="Seattle" class="form-check-label">
                                                    <input type="checkbox" id="Seattle" class="form-check-input" value="Seattle" v-model="TestLookingForCareOpportunities"> Seattle
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <label for="EastKingCounty" class="form-check-label">
                                                    <input type="checkbox" id="EastKingCounty" class="form-check-input" value="East King County" v-model="TestLookingForCareOpportunities"> East King County
                                                </label>
                                            </div> 
                                            <div class="form-check">
                                                <label for="NorthKingCounty" class="form-check-label">
                                                    <input type="checkbox" id="NorthKingCounty" class="form-check-input" value="North King County" v-model="TestLookingForCareOpportunities"> North King County
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <label for="SouthKingCounty" class="form-check-label">
                                                    <input type="checkbox" id="SouthKingCounty" class="form-check-input" value="South King County" v-model="TestLookingForCareOpportunities"> South King County
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <label for="SnohomishCounty" class="form-check-label">
                                                    <input type="checkbox" id="SnohomishCounty" class="form-check-input" value="Snohomish County" v-model="TestLookingForCareOpportunities"> Snohomish County
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <label for="PierceCounty" class="form-check-label">
                                                    <input type="checkbox" id="PierceCounty" class="form-check-input" value="Pierce County" v-model="TestLookingForCareOpportunities"> Pierce County
                                                </label>
                                            </div> 
                                            <small class="text-danger">{{ error_CareOpportunities}}</small>                                                                       
                                        </div>
                                    </div>
                                </div> 
                                <div class="row">
                                    <label style="font-weight: 600;">Desired hourly pay rate range? (required) :<sup class="text-danger" style="font-size:18px;">*</sup></label>
                                    <div class="col-md-6">
                                        <input type="text" v-model="minRange" class="form-control" style="border:1px solid #333;">
                                        <small class="text-danger">{{ error_minRange}}</small>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" v-model="maxRange" class="form-control" style="border:1px solid #333;">
                                        <small class="text-danger">{{ error_maxRange}}</small>
                                    </div>
                                    <small>Example: $20 - $25. If you are unsure of current pay rates in your area, please click here review our pay rate surveys.</small>
                                </div>
                                <div class="row mt-3">                                
                                    <div class="form-group">
                                        <label style="font-weight: 600;">About My Family : <sup class="text-danger" style="font-size:18px;">*</sup></label>
                                        <textarea name="" class="form-control" v-model="aboutMyfamily" id="" rows="5" style="border:1px solid #333;"></textarea>
                                        <p class="mb-0"><small class="text-danger">{{ error_aboutMyfamily}}</small></p>
                                        <small>Please introduce yourself and family to care providers, explain what you are looking for in a provider, hobbies and interests of your child/children, etc.</small>                                                           
                                    </div>                                                              
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label style="font-weight: 600;">Number of children that you need child care for? : <sup class="text-danger" style="font-size:18px;">*</sup></label>
                                            <select class="form-control" v-model="numnerOfchild" style="border:1px solid #333;">
                                                <option value="">---</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                                <option value="6">6 or more</option>
                                                <option value="it complicated">It's complicated</option>
                                            </select>
                                            <small class="text-danger">{{ error_numnerOfchild}}</small>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label style="font-weight: 600;">Ages of child(ren) that need child care? : <sup class="text-danger" style="font-size:18px;">*</sup></label>
                                        <input type="text" v-model="childAge" class="form-control" style="border:1px solid #333;">
                                        <p class="mb-0"><small class="text-danger">{{ error_childAge}}</small></p>
                                        <small>Example: 11 months old and 4 years old</small>                
                                    </div>
                                </div>

                                <div class="row mt-3">                                
                                    <div class="form-group">
                                        <label style="font-weight: 600;">Preference on care provider experience level? : <sup class="text-danger" style="font-size:18px;">*</sup></label>
                                        <select class="form-control" v-model="providerExperience" style="border:1px solid #333;">
                                            <option value="">---</option>
                                            <option value="Any experience level">Any experience level</option>
                                            <option value="At least 1 year of experience">At least 1 year of experience</option>
                                            <option value="At least 1 to 3 years">At least 1 to 3 years</option>
                                            <option value="At least 4 to 6 years">At least 4 to 6 years</option>
                                            <option value="At least 7 to 9 years">At least 7 to 9 years</option>
                                            <option value="10 or more years of experience">10 or more years of experience</option>
                                        </select>
                                        <small class="text-danger">{{ error_providerExperience}}</small>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="form-group">
                                        <label style="font-weight: 600;">Does your family/children have any allergies or special needs that care providers should be aware of? : <sup class="text-danger" style="font-size:18px;">*</sup></label>
                                        <select class="form-control" @change="onChangeSpecialNeeds($event)" v-model="ChildSpecialNeeds" style="border:1px solid #333;">
                                            <option value="">---</option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                        </select>
                                        <small class="text-danger">{{ error_providerExperience}}</small>
                                    </div>
                                </div> 
                                <div class="row mt-2" v-if="SpecialNeeds_yes">
                                    <div class="form-group">
                                        <label for="" style="font-weight: 600;">Please share any details regarding allergies or special needs that prospective families should be aware of:</label>
                                        <textarea v-model="SpecialNeedsExtra" rows="6" class="form-control" style="border:1px solid #333;"></textarea>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="form-group">
                                        <label style="font-weight: 600;">Are you seeking a care provider that speaks languages other than English? : <sup class="text-danger" style="font-size:18px;">*</sup></label>
                                        <select class="form-control" @change="onChangeSpeaksLanguage($event)" v-model="providerSpeaksLanguages" style="border:1px solid #333;">
                                            <option value="">---</option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                        </select>
                                        <small class="text-danger">{{ error_providerSpeaksLanguages}}</small>
                                    </div>
                                </div>
                                <div v-if="parentSpeaksLanguages" class="row mt-3">
                                    <div class="form-group">
                                        <label style="font-weight: 600;">Select all languages that you would like the care provider to be able to use conversationally:</label>
                                        <select class="form-control" multiple="multiple" v-model="parentsNeedsLanguages" style="border:1px solid #333;">
                                            <option value="">---</option>
                                            <option value="American Sign Language">American Sign Language</option>
                                            <option value="Arabic">Arabic</option>
                                            <option value="Bengali">Bengali</option>
                                            <option value="German">German</option>
                                            <option value="French">French</option>
                                            <option value="Hindi">Hindi</option>
                                            <option value="Indonesian">Indonesian</option>
                                            <option value="Japanese">Japanese</option>
                                            <option value="Mandarin">Mandarin</option>
                                            <option value="Portugese">Portugese</option>
                                            <option value="Punjabi/Lahnda">Punjabi/Lahnda</option>
                                            <option value="Russian">Russian</option>
                                            <option value="Spanish">Spanish</option>
                                            <option value="Other">Other</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="form-group">
                                        <label style="font-weight: 600;">Do you prefer a care provider who drives? : <sup class="text-danger" style="font-size:18px;">*</sup></label>
                                        <select class="form-control" @change="onChangeDrives($event)" v-model="providerDrives" style="border:1px solid #333;">
                                            <option value="">---</option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                        </select>
                                        <small class="text-danger">{{ error_providerDrives}}</small>
                                    </div>
                                </div>
                                <div v-if="parentDriveVehicle" class="row mt-3">
                                    <div class="form-group">
                                        <label style="font-weight: 600;">Do you prefer to have the care provider drive their own vehicle or one of your vehicles?</label>
                                        <select class="form-control" v-model="parentsVehicle" style="border:1px solid #333;">
                                            <option value="">---</option>
                                            <option value="Prefer drives own vehicle">Prefer drives own vehicle</option>
                                            <option value="Prefer drives one of our vehicles">Prefer drives one of our vehicles</option>
                                            <option value="No preference">No preference</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">           
                                    <button v-on:click="parentBioSave" class="btn btn-info">
                                        <span v-if="loader" class="spinner-border spinner-border-sm" role="status"><span class="sr-only">Loading...</span></span>
                                        Save Changes
                                    </button>
                                    <p v-show="statusVisible" class="text-success">{{bioStatus}}</p> 
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane" id="careProviderAvailability" role="tabpanel">
                        <hr> 
                        <div class="iq-card-body p-0">
                            <div class="row mt-4">
                                <div class="form-group">
                                    <label for="" style="font-weight: 600;">What days of the week do you need or are offering care? :<sup class="text-danger" style="font-size:18px;">*</sup></label>
                                    <div class="form-check">
                                        <label for="Monday" class="form-check-label">
                                            <input type="checkbox" id="Monday" class="form-check-input" value="Monday" v-model="availability"> Monday
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <label for="Tuesday" class="form-check-label">
                                            <input type="checkbox" id="Tuesday" class="form-check-input" value="Tuesday" v-model="availability"> Tuesday
                                        </label>
                                    </div> 
                                    <div class="form-check">
                                        <label for="Wednesday" class="form-check-label">
                                            <input type="checkbox" id="Wednesday" class="form-check-input" value="Wednesday" v-model="availability"> Wednesday
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <label for="Thursday" class="form-check-label">
                                            <input type="checkbox" id="Thursday" class="form-check-input" value="Thursday" v-model="availability"> Thursday
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <label for="Friday" class="form-check-label">
                                            <input type="checkbox" id="Friday" class="form-check-input" value="Friday" v-model="availability"> Friday
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <label for="Saturday" class="form-check-label">
                                            <input type="checkbox" id="Saturday" class="form-check-input" value="Saturday" v-model="availability"> Saturday
                                        </label>
                                    </div> 
                                    <div class="form-check">
                                        <label for="Sunday" class="form-check-label">
                                            <input type="checkbox" id="Sunday" class="form-check-input" value="Sunday" v-model="availability"> Sunday
                                        </label>
                                    </div>
                                    <small class="text-danger">{{ error_availability}}</small>                                                                       
                                </div>
                                <div class="form-group">           
                                    <button v-on:click="parentAvailability" class="custom_yellow_btn">
                                        <span v-if="loader" class="spinner-border spinner-border-sm" role="status"><span class="sr-only">Loading...</span></span>
                                        Save Changes
                                    </button>  
                                    <p v-show="statusVisible" class="text-success">{{AvailabilityStatus}}</p> 
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>      
    </main>
</template>
<script>
const axios = require('axios');
export default {
    name: "UserBio",
    data() {
        return {
            loader:false,
            isLoggedIn: false,
            statusVisible: true,
            SpecialNeeds_yes:false,         
            bioStatus:'',           
            live_in: "",
            TestParentsTypeOfCareLooking: [],
            TestLookingForCareOpportunities:[],
            minRange: "",
            maxRange: "",
            aboutMyfamily: "",
            numnerOfchild: "",
            childAge: "",
            providerExperience: "",
            ChildSpecialNeeds: "",
            SpecialNeedsExtra:"",
            providerSpeaksLanguages: "",
            parentsNeedsLanguages: [],
            providerDrives: "",
            parentsVehicle:"",
            parentDriveVehicle:false,
            parentSpeaksLanguages:false,

            availability:[],
            AvailabilityStatus:"",

            error_live_in : "",
            error_CareLooking :"",
            error_CareOpportunities :"",
            error_minRange : "",
            error_maxRange : "",
            error_aboutMyfamily : "",
            error_numnerOfchild : "",
            error_childAge : "",
            error_providerExperience : "",
            error_ChildSpecialNeeds : "",
            error_providerSpeaksLanguages : "",
            error_providerDrives : "",
            error_availability: "",
        }
    },
    methods: {
        onChangeSpeaksLanguage(event){
            let parentSpeaksLanguage = event.target.value;
            if(parentSpeaksLanguage=='No'){
                this.parentSpeaksLanguages=false;                
            } else if(parentSpeaksLanguage=='Yes'){
                this.parentSpeaksLanguages=true;                
            } else{}
        },
        onChangeDrives(event) {
            let parentDrive = event.target.value;
            if(parentDrive=='No'){
                this.parentDriveVehicle=false;                
            } else if(parentDrive=='Yes'){
                this.parentDriveVehicle=true;                
            } else{}
        }, 
        onChangeSpecialNeeds(event){
            let SpecialNeedsValue  = event.target.value;
            if(SpecialNeedsValue=='No'){                
                this.SpecialNeeds_yes=false;                                
            } else if(SpecialNeedsValue=='Yes'){
                this.SpecialNeeds_yes=true;                
            } else{
                this.SpecialNeeds_yes=false; 
            }
        },        
        parentBioSave(){
            this.loader = true;
            axios.post(`/api/parentBioSave`, {                
                live_in: this.live_in,
                CareLooking:this.TestParentsTypeOfCareLooking,
                CareOpportunities:this.TestLookingForCareOpportunities,
                minRange: this.minRange,
                maxRange: this.maxRange,
                aboutMyfamily: this.aboutMyfamily,
                numnerOfchild: this.numnerOfchild,
                childAge: this.childAge,
                providerExperience: this.providerExperience,
                ChildSpecialNeeds: this.ChildSpecialNeeds,
                SpecialNeedsExtra:this.SpecialNeedsExtra,
                providerSpeaksLanguages: this.providerSpeaksLanguages,
                parentsNeedsLanguages: this.parentsNeedsLanguages,
                providerDrives: this.providerDrives,
                parentsVehicle:this.parentsVehicle
            }).then((response) => {
                //console.log(response);
                this.bioStatus = response.data.bioSave;
                this.statusVisible = true,
                this.loader=false,
                setTimeout(() => {
                    this.statusVisible = false;   
                }, 2000);                             
                this.ParentsTypeOfCareLooking = response.data.checkboxTypeOfCareLooking; 
                this.LookingForCareOpportunities = response.data.checkboxCareOpportunities;
                this.live_in = response.data.userBio.live_in;
                this.minRange = response.data.userBio.minRange;
                this.maxRange = response.data.userBio.maxRange;
                this.aboutMyfamily = response.data.userBio.aboutMyfamily;
                this.numnerOfchild = response.data.userBio.numnerOfchild;
                this.childAge = response.data.userBio.childAge;
                this.providerExperience = response.data.userBio.providerExperience;
                this.ChildSpecialNeeds = response.data.userBio.ChildSpecialNeeds;
                this.SpecialNeedsExtra = response.data.userBio.SpecialNeedsExtra;
                this.providerSpeaksLanguages = response.data.userBio.providerSpeaksLanguages;
                this.parentsNeedsLanguages = response.data.parentSelectLanguages;
                this.providerDrives = response.data.userBio.providerDrives;
                this.parentsVehicle = response.data.userBio.parentsVehicle;
            }).catch(error => {  
                this.loader=false,              
                this.error_CareLooking  = error.response.data.error.CareLooking,
                this.error_CareOpportunities = error.response.data.error.CareOpportunities,
                this.error_live_in  = error.response.data.error.live_in,
                this.error_minRange  = error.response.data.error.minRange,
                this.error_maxRange  = error.response.data.error.maxRange,
                this.error_aboutMyfamily  = error.response.data.error.aboutMyfamily,
                this.error_numnerOfchild  = error.response.data.error.numnerOfchild,
                this.error_childAge  = error.response.data.error.childAge,
                this.error_providerExperience  = error.response.data.error.providerExperience,
                this.error_ChildSpecialNeeds  = error.response.data.error.ChildSpecialNeeds,
                this.error_providerSpeaksLanguages  = error.response.data.error.providerSpeaksLanguages,
                this.error_providerDrives   = error.response.data.error.providerDrives               
            });            
        },
        parentAvailability(){
            this.loader = true;
            axios.post(`/api/parentAvailability`, {
                availability:this.availability,
            }).then((response) => { 
                this.loader=false,
                setTimeout(() => {
                    this.statusVisible = false;   
                }, 2000);
                this.AvailabilityStatus = response.data.AvailabilitySave,
                this.availability = response.data.checkboxAvailability
            }).catch(error => {
                this.error_availability = error.response.data.error.availability
            });
        }, 
        GetparentAvailability(){
            axios.get(`/api/getfamilyparentAvailability`).then((response) => { 
                //console.log('testhh ',response.data);               
                const AvailabilitCount = response.data.careAvailability.length;                        
                if(AvailabilitCount!=0){                    
                    this.availability = response.data.checkboxAvailability;                                        
                }else{}                  
            }).catch((err) => console.error(err));
        }      
    },
    created() {        
        if (window.Laravel.isLoggedin) {
            this.isLoggedIn = true
        }
        if (window.Laravel.user) {
            this.GetparentAvailability();
            this.id = window.Laravel.user.id,
            this.role = window.Laravel.user.role,
            this.memberType = window.Laravel.user.memberType,            
            this.name = window.Laravel.user.name,
            this.email = window.Laravel.user.email,
            this.username = window.Laravel.user.username,
            this.firstName = window.Laravel.user.firstName,
            this.lastName = window.Laravel.user.lastName,
            this.address1 = window.Laravel.user.address1,
            this.address22 = window.Laravel.user.address2,
            this.address2 = window.Laravel.user.address2,
            this.stateProvince = window.Laravel.user.state,
            this.postalCode = window.Laravel.user.postal_code,
            this.phoneNumber = window.Laravel.user.mobile,
            this.profileImage = window.Laravel.user.profileImage,
            this.facebookURL = window.Laravel.user.facebookURL,
            this.twitterURL = window.Laravel.user.twitterURL,
            this.instagramURL = window.Laravel.user.instagramURL,
            this.linkedinURL = window.Laravel.user.linkedinURL 
            axios.get(`/api/parentBioDetail`).then((response) => {
                const looksCheck = response.data.checkboxTypeOfCareLooking.length;
                const OpportunitiesCheck = response.data.checkboxCareOpportunities.length;
                if(looksCheck!=0){
                    this.TestParentsTypeOfCareLooking = response.data.checkboxTypeOfCareLooking;                                        
                }else{}

                if(OpportunitiesCheck!=0){
                    this.TestLookingForCareOpportunities = response.data.checkboxCareOpportunities;                  
                }else{ }

                this.live_in = response.data.userBio.live_in;
                this.minRange = response.data.userBio.minRange;
                this.maxRange = response.data.userBio.maxRange;
                this.aboutMyfamily = response.data.userBio.aboutMyfamily;
                this.numnerOfchild = response.data.userBio.numnerOfchild;
                this.childAge = response.data.userBio.childAge;
                this.providerExperience = response.data.userBio.providerExperience;
                this.ChildSpecialNeeds = response.data.userBio.ChildSpecialNeeds;
                this.SpecialNeedsExtra = response.data.userBio.SpecialNeedsExtra;
                this.providerSpeaksLanguages = response.data.userBio.providerSpeaksLanguages;
                this.parentsNeedsLanguages =  response.data.parentSelectLanguages;
                this.providerDrives = response.data.userBio.providerDrives; 
                this.parentsVehicle = response.data.userBio.parentsVehicle;

                const SpeaksLanguagesOption = response.data.userBio.providerSpeaksLanguages;
                const parentDriveOption = response.data.userBio.providerDrives;

                if(response.data.userBio.ChildSpecialNeeds=='Yes'){
                    this.SpecialNeeds_yes=true;                                       
                } else {
                    this.SpecialNeeds_yes=false;
                }

                if(SpeaksLanguagesOption=='Yes'){
                    this.parentSpeaksLanguages=true;
                } else {
                    this.parentSpeaksLanguages=false;
                }
                                
                if(parentDriveOption=='Yes'){
                    this.parentDriveVehicle=true;
                } else {
                    this.parentDriveVehicle=false;
                }
            }).catch((err) => console.error(err));             
  
        }	
    },
    updated() {
        // window.scrollTo({
        //     top: 280,
        //     behavior: 'smooth',
        // })
    },
    beforeRouteEnter(to, from, next) {
        if (!window.Laravel.isLoggedin) {
            window.location.href = "/";
        }
     next();
    }
}
</script>
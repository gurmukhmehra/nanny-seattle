<template>   
    <main>
        <div class="iq-card-body">
            <div class="friend-list-tab mt-2">
                <ul class="nav nav-pills d-flex align-items-center justify-content-left friend-list-items p-0 mb-2">
                    <li>
                        <a v-on:click="careProviderBioDetail()" class="nav-link active" data-toggle="pill" href="#careProviderBio">Bio</a>
                    </li>
                    <li>
                        <a v-on:click="GetCareProviderAvailability()" class="nav-link" data-toggle="pill" href="#careProviderAvailability">Availability</a>
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
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label style="font-weight: 600;">Type(s) of care you are looking for :<sup class="text-danger" style="font-size:18px;">*</sup></label>
                                        <div class="form-check">
                                            <label for="FullTimeNanny" class="form-check-label">
                                                <input type="checkbox" id="FullTimeNanny" class="form-check-input" value="Full Time Nanny" v-model="TypeOfCareLooking"> Full Time Nanny
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <label for="PartTimeNanny" class="form-check-label">
                                                <input type="checkbox" id="PartTimeNanny" class="form-check-input" value="Part Time Nanny" v-model="TypeOfCareLooking"> Part Time Nanny
                                            </label>
                                        </div> 
                                        <div class="form-check">
                                            <label for="NannyShareNanny" class="form-check-label">
                                                <input type="checkbox" id="NannyShareNanny" class="form-check-input" value="Nanny Share Nanny" v-model="TypeOfCareLooking"> Nanny Share Nanny
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <label for="Babysitting" class="form-check-label">
                                                <input type="checkbox" id="Babysitting" class="form-check-input" value="Babysitting" v-model="TypeOfCareLooking"> Babysitting
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <label for="AuPair" class="form-check-label">
                                                <input type="checkbox" id="AuPair" class="form-check-input" value="Au Pair" v-model="TypeOfCareLooking"> Au Pair
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <label for="LastMinuteCare" class="form-check-label">
                                                <input type="checkbox" id="LastMinuteCare" class="form-check-input" value="Last Minute Care" v-model="TypeOfCareLooking"> Last Minute Care
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <label for="DateNightTempCare" class="form-check-label">
                                                <input type="checkbox" id="DateNightTempCare" class="form-check-input" value="Date Night/Temporary Care" v-model="TypeOfCareLooking"> Date Night/Temporary Care
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <label for="BeforeAfterSchoolCare" class="form-check-label">
                                                <input type="checkbox" id="BeforeAfterSchoolCare" class="form-check-input" value="Before/After School Care" v-model="TypeOfCareLooking"> Before/After School Care
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <label for="LearningGuide" class="form-check-label">
                                                <input type="checkbox" id="LearningGuide" class="form-check-input" value="Learning Guide (Academic Support)" v-model="TypeOfCareLooking"> Learning Guide (Academic Support)
                                            </label>
                                        </div>  
                                        <small class="text-danger">{{ error_CareLooking}}</small>                                                   
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="Seattle" style="font-weight: 600;">Where are you looking for care opportunities? :<sup class="text-danger" style="font-size:18px;">*</sup></label>
                                        <div class="form-check">
                                            <label for="Seattle" class="form-check-label">
                                                <input type="checkbox" id="Seattle" class="form-check-input" value="Seattle" v-model="LookingForCareOpportunities"> Seattle
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <label for="EastKingCounty" class="form-check-label">
                                                <input type="checkbox" id="EastKingCounty" class="form-check-input" value="East King County" v-model="LookingForCareOpportunities"> East King County
                                            </label>
                                        </div> 
                                        <div class="form-check">
                                            <label for="NorthKingCounty" class="form-check-label">
                                                <input type="checkbox" id="NorthKingCounty" class="form-check-input" value="North King County" v-model="LookingForCareOpportunities"> North King County
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <label for="SouthKingCounty" class="form-check-label">
                                                <input type="checkbox" id="SouthKingCounty" class="form-check-input" value="South King County" v-model="LookingForCareOpportunities"> South King County
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <label for="SnohomishCounty" class="form-check-label">
                                                <input type="checkbox" id="SnohomishCounty" class="form-check-input" value="Snohomish County" v-model="LookingForCareOpportunities"> Snohomish County
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <label for="PierceCounty" class="form-check-label">
                                                <input type="checkbox" id="PierceCounty" class="form-check-input" value="Pierce County" v-model="LookingForCareOpportunities"> Pierce County
                                            </label>
                                        </div> 
                                        <small class="text-danger">{{ error_CareOpportunities}}</small>                                                                       
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="" style="font-weight: 600;">What age groups do you have experience providing child care for? :<sup class="text-danger" style="font-size:18px;">*</sup></label>
                                        <select class="form-control" v-model="providerChildExperience" multiple="multiple" style="border:1px solid #333;">
                                            <option value="">----</option>
                                            <option value="Newborn">Newborn</option>
                                            <option value="Infant">Infant</option>
                                            <option value="Toddler">Toddler</option>
                                            <option value="Grade School">Grade School</option>
                                            <option value="Teenagers">Teenagers</option>
                                        </select>
                                        <small class="text-danger">{{ error_ChildExperience}}</small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="" style="font-weight: 600;">How many years of child care experience do you have? :<sup class="text-danger" style="font-size:18px;">*</sup></label>
                                        <select class="form-control" v-model="providerTotalExperience" style="border:1px solid #333;">
                                            <option value="">----</option>
                                            <option value="Less than 1 year">Less than 1 year</option>
                                            <option value="1 year">1 year</option>
                                            <option value="2 years">2 years</option>
                                            <option value="3 years">3 years</option>
                                            <option value="4 years">4 years</option>
                                            <option value="5 years">5 years</option>
                                            <option value="6 years">6 years</option>
                                            <option value="7 years">7 years</option>
                                            <option value="8 years">8 years</option>
                                            <option value="9 years">9 years</option>
                                            <option value="10+ years">10+ years</option>
                                            <option value="20+ years">20+ years</option>
                                        </select> 
                                        <small class="text-danger">{{ error_TotalExperience}}</small>                                       
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <label for="" style="font-weight: 600;">Desired hourly pay rate range? :<sup class="text-danger" style="font-size:18px;">*</sup></label>
                                <div class="col-md-6">
                                    <input type="text" placeholder="Minimum Range" v-model="minRange" class="form-control" style="border:1px solid #333;">
                                    <small class="text-danger">{{ error_minRange}}</small>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" placeholder="Maximum Range" v-model="maxRange" class="form-control" style="border:1px solid #333;">
                                    <small class="text-danger">{{ error_maxRange}}</small>
                                </div>
                                <small>Example: $20 - $25. If you are unsure of current pay rates in your area, please click here review our pay rate surveys.</small>
                            </div>
                            <div class="row mt-3">                      
                                <div class="form-group">
                                    <label for="" style="font-weight: 600;">Number of children you will care for at one time? :<sup class="text-danger" style="font-size:18px;">*</sup></label>
                                    <select class="form-control" v-model="providerCareOneTime" style="border:1px solid #333;">
                                        <option value="">----</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6 or more">6 or more</option>
                                    </select>
                                    <small class="text-danger">{{ error_CareOneTime}}</small>                                        
                                </div>                                                                
                            </div>
                            <div class="row mt-2">                                
                                <div class="form-group">
                                    <label for="" style="font-weight: 600;">About Me : <sup class="text-danger" style="font-size:18px;">*</sup></label>
                                    <textarea name="" class="form-control" v-model="aboutMe" id="" rows="5" style="border:1px solid #333;"></textarea>
                                    <p class="mb-0"><small class="text-danger">{{ error_aboutMe}}</small></p>
                                    <small>Please introduce yourself and family to care providers, explain what you are looking for in a provider, hobbies and interests of your child/children, etc.</small>                                                           
                                </div>                                                               
                            </div>
                            <div class="row mt-2">
                                <div class="form-group">
                                    <label for="" style="font-weight: 600;">Do you have experience caring for children with special needs?</label>
                                    <select v-model="providerSpecialNeeds" @change="onChangeSpecialNeeds($event)" class="form-control" style="border:1px solid #333;">
                                        <option value="">----</option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row mt-2" v-if="SpecialNeeds_yes">
                                <div class="form-group">
                                    <label for="" style="font-weight: 600;">Please share any details regarding allergies or special needs that prospective families should be aware of:</label>
                                    <textarea v-model="SpecialNeedsExtra" rows="6" class="form-control" style="border:1px solid #333;"></textarea>
                                </div>
                            </div>

                            <div class="row mt-2">                               
                                <div class="form-group">
                                    <label for="" style="font-weight: 600;">Do you speak any other language(s) besides English :</label>
                                    <select v-model="providerKonwLanguage" @change="onChangeSpeaksLanguage($event)" class="form-control" style="border:1px solid #333;">
                                        <option value="">----</option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </div>                               
                            </div>
                            <div v-if="providerSpeaksLanguages" class="row mt-2">
                                <div class="form-group">
                                    <label for="" style="font-weight: 600;">Select all languages that you can use conversationally:</label>
                                    <select class="form-control" multiple="multiple" v-model="providerNeedsLanguages" style="border:1px solid #333;">
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
                            <div class="row mt-2">
                                <div class="form-group">
                                    <label for="" style="font-weight: 600;">Are you willing to transport children to school, activities, etc.? : <sup class="text-danger" style="font-size:18px;">*</sup></label>
                                    <select @change="onChangeDrives($event)" v-model="providerTransportSchoolActivities" class="form-control" style="border:1px solid #333;">
                                        <option value="">----</option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                    <p class="mb-0"><small class="text-danger">{{ error_TransportSchoolActivities}}</small></p>
                                </div>
                            </div>
                            <div v-if="providerDriveVehicle" class="row mt-3">
                                <div class="form-group">                                  
                                    <label for="" style="font-weight: 600;">How do you transport children you are caring for?</label>
                                    <div class="form-check">
                                        <label for="ownMy" class="form-check-label">
                                            <input type="checkbox" id="ownMy" class="form-check-input" value="My own vehicle" v-model="CareProviderVehicleTransTest"> My own vehicle
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <label for="thefamilyvehicle" class="form-check-label">
                                            <input type="checkbox" id="thefamilyvehicle" class="form-check-input" value="The family vehicle" v-model="CareProviderVehicleTransTest"> The family's vehicle
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <label for="publictranspor" class="form-check-label">
                                            <input type="checkbox" id="publictranspor" class="form-check-input" value="Public transportation" v-model="CareProviderVehicleTransTest"> Public transportation
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <label for="Biking" class="form-check-label">
                                            <input type="checkbox" id="Biking" class="form-check-input" value="Biking" v-model="CareProviderVehicleTransTest"> Biking
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <label for="Walking" class="form-check-label">
                                            <input type="checkbox" id="Biking" class="form-check-input" value="Walking" v-model="CareProviderVehicleTransTest"> Walking
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <label for="Rideshare" class="form-check-label">
                                            <input type="checkbox" id="Biking" class="form-check-input" value="Rideshare" v-model="CareProviderVehicleTransTest"> Rideshare
                                        </label>
                                    </div>                                                                                                           
                                </div>
                            </div>
                            <div class="form-group">           
                                <button v-on:click="CareProviderBioSave" class="custom_yellow_btn">
                                    <span v-if="loader" class="spinner-border spinner-border-sm" role="status"><span class="sr-only">Loading...</span></span>
                                    Save Changes
                                </button>  
                                <p class="text-success">{{bioStatus}}</p> 
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
                                    <button v-on:click="CareProviderAvailability" class="custom_yellow_btn">
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
    name: "CareProviderBio",
    data() {
        return {
            loader:false,
            isLoggedIn: false,
            providerSpeaksLanguages:false,
            providerDriveVehicle:false,
            SpecialNeeds_yes:false,
            live_in: "",
            bioStatus:'',
            statusVisible: true,  
            TypeOfCareLooking: [],
            LookingForCareOpportunities:[],
            providerChildExperience: [],
            providerTotalExperience: "",
            minRange: "",
            maxRange: "",                                     
            providerCareOneTime: "",
            aboutMe: "",
            providerSpecialNeeds: "",
            SpecialNeedsExtra:"",
            providerKonwLanguage: "",
            providerNeedsLanguages: [],            
            providerTransportSchoolActivities: "",
            CareProviderVehicleTransTest:[],
            availability:[],
            AvailabilityStatus:"",

            error_live_in : "",
            error_CareLooking: "",
            error_CareOpportunities: "",
            error_ChildExperience: "",
            error_TotalExperience: "",
            error_minRange: "",
            error_maxRange: "",
            error_CareOneTime: "",
            error_aboutMe: "",
            error_TransportSchoolActivities: "",
            error_availability: "",
        }
    },
    methods: {
        onChangeSpeaksLanguage(event){
            let providerSpeaksLanguage = event.target.value;
            if(providerSpeaksLanguage=='No'){                
                this.providerSpeaksLanguages=false;                
            } else if(providerSpeaksLanguage=='Yes'){
                this.providerSpeaksLanguages=true;                
            } else{}
        }, 
        onChangeDrives(event) {
            let providerTransportes  = event.target.value;
            if(providerTransportes=='No'){                
                this.providerDriveVehicle=false;                                
            } else if(providerTransportes=='Yes'){
                this.providerDriveVehicle=true;                
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
        CareProviderBioSave(){
            this.loader = true;
            axios.post(`/api/careProviderBioSave`, { 
                live_in: this.live_in,               
                TypeOfCareLooking:this.TypeOfCareLooking,
                LookingForCareOpportunities:this.LookingForCareOpportunities,
                providerChildExperience:this.providerChildExperience,
                providerTotalExperience:this.providerTotalExperience,
                minRange:this.minRange,
                maxRange:this.maxRange,
                providerCareOneTime:this.providerCareOneTime,
                aboutMe:this.aboutMe,
                providerSpecialNeeds:this.providerSpecialNeeds,
                SpecialNeedsExtra:this.SpecialNeedsExtra,
                providerKonwLanguage:this.providerKonwLanguage,
                providerNeedsLanguages: this.providerNeedsLanguages,
                providerTransportSchoolActivities:this.providerTransportSchoolActivities,
                CareProviderVehicleTransport: this.CareProviderVehicleTransTest               
            }).then((response) => {
                //console.log(response);
                this.statusVisible = true,
                this.bioStatus = response.data.bioSave,
                this.loader=false,
                setTimeout(() => {
                    this.statusVisible = false;   
                }, 2000);
                this.live_in = response.data.userBio.live_in;
                this.TypeOfCareLooking = response.data.checkboxTypeOfCareLooking;
                this.LookingForCareOpportunities = response.data.checkboxCareOpportunities;
                this.providerChildExperience = response.data.checkboxProviderChildExp;
                this.providerTotalExperience = response.data.userBio.providerExperience;
                this.minRange = response.data.userBio.minRange;
                this.maxRange = response.data.userBio.maxRange;
                this.providerCareOneTime = response.data.userBio.providerCareOneTime;
                this.aboutMe = response.data.userBio.aboutMyfamily;
                this.providerSpecialNeeds = response.data.userBio.providerSpecialNeeds;
                this.SpecialNeedsExtra = response.data.userBio.SpecialNeedsExtra;
                this.providerKonwLanguage = response.data.userBio.providerSpeaksLanguages;
                this.providerNeedsLanguages = response.data.parentsNeedsLanguages;
                this.providerTransportSchoolActivities = response.data.userBio.providerTransportSchoolActivities;
                this.CareProviderVehicleTransTest = response.data.providerVehcle;
            }).catch(error => {
                this.loader=false,
                this.error_live_in  = error.response.data.error.live_in,
                this.error_CareLooking = error.response.data.error.TypeOfCareLooking,
                this.error_CareOpportunities = error.response.data.error.LookingForCareOpportunities,
                this.error_ChildExperience = error.response.data.error.providerChildExperience,
                this.error_TotalExperience = error.response.data.error.providerTotalExperience,
                this.error_minRange = error.response.data.error.minRange,
                this.error_maxRange = error.response.data.error.maxRange,
                this.error_aboutMe = error.response.data.error.aboutMe,
                this.error_CareOneTime = error.response.data.error.providerCareOneTime,
                this.error_TransportSchoolActivities = error.response.data.error.providerTransportSchoolActivities
            });
        },
        CareProviderAvailability(){
            this.loader = true;
            axios.post(`/api/careProviderAvailability`, {
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
        careProviderBioDetail(){
            axios.get(`/api/careProivderBioDetail`).then((response) => {                                               
                const proTypeLooks= response.data.checkboxTypeOfCareLooking.length;
                const proOppor = response.data.checkboxCareOpportunities.length;
                const TransportSchoolActivities= response.data.userBio.providerTransportSchoolActivities;                
                const availabilityLenght= response.data.AvailabilityChecks.length;
                const KonwLanguage = response.data.userBio.providerSpeaksLanguages; 
                
                const providerTransportVehcleCheck = response.data.providerTransportVehcle.length;                

                if(proTypeLooks!=0) {
                    this.TypeOfCareLooking = response.data.checkboxTypeOfCareLooking;
                } else{}
                if(proOppor!=0) {
                    this.LookingForCareOpportunities = response.data.checkboxCareOpportunities;
                } else{}                

                if(KonwLanguage=='Yes'){
                    this.providerSpeaksLanguages=true;
                } else {
                    this.providerSpeaksLanguages=false;
                }  
                      
                if(TransportSchoolActivities=='No'){
                    this.providerDriveVehicle=false;                
                } else if(TransportSchoolActivities=='Yes'){
                    this.providerDriveVehicle=true;                
                } else{}

                if(providerTransportVehcleCheck!=0) {
                    this.CareProviderVehicleTransTest = response.data.providerTransportVehcle;
                } else{}

                if(availabilityLenght!=0) {                    
                    this.availability = response.data.checkboxAvailability;
                } else{}    
                
                if(response.data.userBio.providerSpecialNeeds=='Yes'){
                    this.SpecialNeeds_yes=true;                                       
                } else {
                    this.SpecialNeeds_yes=false;
                }

                this.live_in = response.data.userBio.live_in,
                this.providerChildExperience = response.data.checkboxProviderChildExp,
                this.providerTotalExperience = response.data.userBio.providerTotalExperience,
                this.minRange = response.data.userBio.minRange,
                this.maxRange = response.data.userBio.maxRange,
                this.providerCareOneTime = response.data.userBio.providerCareOneTime,
                this.aboutMe = response.data.userBio.aboutMyfamily,
                this.providerSpecialNeeds = response.data.userBio.providerSpecialNeeds,                
                this.SpecialNeedsExtra = response.data.userBio.SpecialNeedsExtra;
                this.providerKonwLanguage = response.data.userBio.parentsNeedsLanguages,
                this.providerNeedsLanguages = response.data.providerSelectLanguages,
                this.providerTransportSchoolActivities = response.data.userBio.providerTransportSchoolActivities,
                this.CareProviderVehicleTransTest = response.data.providerVehcle
                
            }).catch((err) => console.error(err));
        },
        GetCareProviderAvailability(){
            axios.get(`/api/careProivderAvailability`).then((response) => { 
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
            
            axios.get(`/api/careProivderAvailability`).then((response) => { 
                //console.log('avita ', response.data);
                const AvailabilitCount = response.data.careAvailability.length;               
                if(AvailabilitCount!=0){                    
                    this.availability = response.data.checkboxAvailability;                                        
                }else{}
            }).catch((err) => console.error(err));

            axios.get(`/api/careProivderBioDetail`).then((response) => { 
                //console.log('test',response.data.checkboxProviderChildExp.length);                               
                this.live_in = response.data.userBio.live_in;                
                if(response.data.checkboxTypeOfCareLooking.length!=0) {
                    this.TypeOfCareLooking = response.data.checkboxTypeOfCareLooking;
                } else{}
                if(response.data.checkboxCareOpportunities.length!=0) {
                    this.LookingForCareOpportunities = response.data.checkboxCareOpportunities;
                } else{}
                if(response.data.checkboxProviderChildExp.length!=0) {
                    this.providerChildExperience = response.data.checkboxProviderChildExp;
                } else{}
                this.providerTotalExperience = response.data.userBio.providerExperience;
                this.minRange = response.data.userBio.minRange;
                this.maxRange = response.data.userBio.maxRange;
                this.providerCareOneTime = response.data.userBio.providerCareOneTime;
                this.aboutMe = response.data.userBio.aboutMyfamily;
                this.providerSpecialNeeds = response.data.userBio.ChildSpecialNeeds;

                if(response.data.userBio.ChildSpecialNeeds=='Yes'){
                    this.SpecialNeeds_yes=true;                  
                } else {
                    this.SpecialNeeds_yes=false;
                }

                this.SpecialNeedsExtra = response.data.userBio.SpecialNeedsExtra;
                this.providerKonwLanguage = response.data.userBio.providerSpeaksLanguages;
                if(response.data.userBio.providerSpeaksLanguages=='Yes'){
                    this.providerSpeaksLanguages=true;
                    this.providerNeedsLanguages = response.data.providerSelectLanguages;                   
                } else {
                    this.providerSpeaksLanguages=false;
                }
                this.providerTransportSchoolActivities = response.data.userBio.providerTransportSchoolActivities;
                if(response.data.userBio.providerTransportSchoolActivities=='Yes'){
                    this.providerDriveVehicle=true;
                    this.CareProviderVehicleTransTest = response.data.providerVehcle;                   
                } else {
                    this.providerDriveVehicle=false;
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
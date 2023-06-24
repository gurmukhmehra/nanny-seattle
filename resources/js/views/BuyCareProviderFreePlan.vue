<template>
    <main>    
        <div class="container">            
            <div class="row mt-4">
                <h4 class="text-center">We are excited to have you join us!</h4>
                <p class="text-center" style="margin-bottom: 12px;">
                    In order to ensure our community is the right fit for you, please complete the following 
                    questions and then click Next to complete the sign up process.                    
                </p>
                <p class="text-center"><i>Fields marked with an * are required</i></p>
            </div> 
            <!------------------------- Start Step First ---------------------------------------------> 
            <div class="step step1 activeStep">
                <div class="row">                
                    <div class="form-group">
                        <label for="jobLocations" style="font-weight: bold;">Currently seeking new families to work with?  <sup class="text-danger">*</sup></label>
                        <select class="form-control" v-model="CurrentlySeekingFamiliesWork" required>
                            <option value="">----</option> 
                            <option value="Yes">Yes</option> 
                            <option value="No">No</option>            
                        </select> 
                        <div class="text-danger error-message"></div>                   
                    </div>
                </div>
                <div class="row">
                    <input type="hidden" class="form-control" v-model="planDetail.id">
                    <div class="form-group">
                        <label for="jobLocations" style="font-weight: bold;">Type(s) of care you are looking for: <sup class="text-danger">*</sup></label>
                        <p>Select all that apply</p>
                        <select class="form-control" v-model="lookingFor" multiple required>
                            <option value="">----</option> 
                            <option value="Learning Guide (Academic Support)">Learning Guide (Academic Support)</option> 
                            <option value="Before/After School Care">Before/After School Care</option> 
                            <option value="Date Night/Temporary Care">Date Night/Temporary Care</option> 
                            <option value="Last Minute Care">Last Minute Care</option> 
                            <option value="Au Pair">Au Pair</option> 
                            <option value="Babysitting">Babysitting</option> 
                            <option value="Nanny Share">Nanny Share</option> 
                            <option value="Part Time Nanny">Part Time Nanny</option> 
                            <option value="Full Time Nanny">Full Time Nanny</option>               
                        </select>
                        <div class="text-danger error-message"></div>
                    </div>
                </div> 
                <div class="row">                
                    <div class="form-group">
                        <label for="jobLocations" style="font-weight: bold;">Where are you looking for care opportunities?: <sup class="text-danger">*</sup></label>
                        <p>Select all that apply</p>
                        <select class="form-control" v-model="careOpportunities" multiple required> 
                            <option value="">----</option>
                            <option value="Seattle">Seattle</option> 
                            <option value="East King County">East King County</option> 
                            <option value="North King County">North King County</option> 
                            <option value="South King County">South King County</option>
                            <option value="Snohomish County">Snohomish County</option> 
                            <option value="Pierce County">Pierce County</option>               
                        </select>
                        <div class="text-danger error-message"></div>                    
                    </div>
                </div>

                <div class="row">                
                    <div class="form-group">
                        <label for="jobLocations" style="font-weight: bold;">What age groups do you have experience providing child care for?  <sup class="text-danger">*</sup></label>
                        <p>Select all that apply</p>
                        <select class="form-control" v-model="childCareFor" multiple required>
                            <option value="">------------</option> 
                            <option value="Newborn">Newborn</option> 
                            <option value="Infant">Infant</option> 
                            <option value="Toddler">Toddler</option> 
                            <option value="Grade School">Grade School</option> 
                            <option value="Teenagers">Teenagers</option>               
                        </select> 
                        <div class="text-danger error-message"></div>                   
                    </div>
                </div>

                <div class="row">                
                    <div class="form-group">
                        <label for="jobLocations" style="font-weight: bold;">How many years of child care experience do you have? <sup class="text-danger">*</sup></label>
                        <select class="form-control" v-model="childCareExperience" required> 
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
                        <div class="text-danger error-message"></div>                   
                    </div>
                </div>

                <div class="row">
                    <label style="font-weight: 600;">Desired hourly pay rate range? (required) :<sup class="text-danger" style="font-size:18px;">*</sup></label>
                    <div class="col-md-6 form-group" style="margin-bottom: 5px;">
                        <input type="text" v-model="minRange" required class="form-control" style="border:1px solid #333;">                    
                        <div class="text-danger error-message"></div>
                    </div>
                    <div class="col-md-6 form-group" style="margin-bottom: 5px;">
                        <input type="text" v-model="maxRange" required class="form-control" style="border:1px solid #333;">                    
                        <div class="text-danger error-message"></div>
                    </div>
                    <p><i>Example: $23 - $27. If you are unsure of current pay rates in your area, please <a href="https://blog.nannyparentconnection.com/category/payrates/">click here</a> to review our pay rate surveys.</i></p>
                </div>

                <div class="row">                
                    <div class="form-group">
                        <label for="jobLocations" style="font-weight: bold;">Number of children you will care for at one time?  <sup class="text-danger">*</sup></label>
                        <select class="form-control" v-model="NumberOfCareOneTime" required> 
                            <option value="">----</option> 
                            <option value="1">1</option> 
                            <option value="2">2</option> 
                            <option value="3">3</option> 
                            <option value="4">4</option> 
                            <option value="5">5</option> 
                            <option value="6 or more">6 or more</option>            
                        </select> 
                        <div class="text-danger error-message"></div>                   
                    </div>
                </div>

                <div class="row">                
                    <div class="form-group">
                        <label for="jobLocations" style="font-weight: bold;">About Me <sup class="text-danger">*</sup></label>
                        <textarea class="form-control" rows="6" v-model="AboutMe" required></textarea>
                        <div class="text-danger error-message"></div> 
                        <p>Please introduce yourself to families/parents, explain your experience and child care style, hobbies, interests, etc. This is the first profile question that parents will read so make an impression!</p>
                    </div>
                </div>

                <div class="row">                
                    <div class="form-group">
                        <label for="jobLocations" style="font-weight: bold;">Do you have experience caring for children with special needs? <sup class="text-danger">*</sup></label>
                        <select class="form-control" @change="onChangeSpecialNeeds($event)" v-model="specialNeeds" required> 
                            <option value="">----</option> 
                            <option value="Yes">Yes</option> 
                            <option value="No">No</option>              
                        </select>  
                        <div class="text-danger error-message"></div>                  
                    </div>
                </div>
                <div class="row" v-if="specialNeedsExperience">                
                    <div class="form-group">
                        <label for="jobLocations" style="font-weight: bold;">Please select the special needs that you have experience working with:  <sup class="text-danger">*</sup></label>
                        <p>Select all that apply</p>
                        <div class="form-check">
                            <label for="HearingImpairments" class="form-check-label">
                                <input type="checkbox" id="HearingImpairments" class="form-check-input" value="Hearing Impairments" v-model="specialNeedsOption"> Hearing Impairments
                            </label>
                        </div>
                        <div class="form-check">
                            <label for="VisualImpairments" class="form-check-label">
                                <input type="checkbox" id="VisualImpairments" class="form-check-input" value="Visual Impairments" v-model="specialNeedsOption"> Visual Impairments
                            </label>
                        </div>
                        <div class="form-check">
                            <label for="LearningDisabilities" class="form-check-label">
                                <input type="checkbox" id="LearningDisabilities" class="form-check-input" value="Learning Disabilities" v-model="specialNeedsOption"> Learning Disabilities
                            </label>
                        </div>
                        <div class="form-check">
                            <label for="PhysicalDisabilities" class="form-check-label">
                                <input type="checkbox" id="PhysicalDisabilities" class="form-check-input" value="Physical Disabilities" v-model="specialNeedsOption"> Physical Disabilities
                            </label>
                        </div>
                        <div class="form-check">
                            <label for="SocialandEmotionalDisabilities" class="form-check-label">
                                <input type="checkbox" id="SocialandEmotionalDisabilities" class="form-check-input" value="Social and Emotional Disabilities" v-model="specialNeedsOption"> Social and Emotional Disabilities
                            </label>
                        </div>
                        <div class="form-check">
                            <label for="SpecialDietaryNeeds" class="form-check-label">
                                <input type="checkbox" id="SpecialDietaryNeeds" class="form-check-input" value="Special Dietary Needs" v-model="specialNeedsOption"> Special Dietary Needs
                            </label>
                        </div>
                        <div class="text-danger error-message"></div>                   
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">                     
                        <div id="recaptcha-main" class="g-recaptcha" data-sitekey="6Ld49hsmAAAAACseKXPr2AjYHmQXm-Jne7XncTeo"></div>
                    </div>
                </div>
                <div class="row">                                      
                    <div class="form-group">                        
                        <button class="custom_yellow_btn mr-3 next action-button" data-step-index="2" v-on:click="buttonHandle">Next</button>   
                    </div>
                    <p class="text-danger" v-if="requiredFieldsTextErr">Please fill required fields.</p>
                </div>
            </div>
            <!------------------------- End Step First --------------------------------------------->
            <!----------- Start Step Two   --------------------------------------------------------->  
            <div class="step step2">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="firstName">First Name:<sup class="text-danger">*</sup></label>
                            <input type="text" class="form-control" required id="firstName" placeholder="" v-model="firstName">
                            
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="lastName">Last Name:<sup class="text-danger">*</sup></label>
                            <input type="text" class="form-control" id="lastName" required placeholder="" v-model="lastName">
                            
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group  mt-3">
                            <label for="address1">Address Line 1:<sup class="text-danger">*</sup></label>
                            <input type="text" @keyup="addressValue" ref="Autocomplete_address1" class="form-control" required id="address1" placeholder="" v-model="address1">
                            
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group  mt-3">
                            <label for="address2">Address Line 2:</label>
                            <input type="text" class="form-control" id="address2" placeholder="" v-model="address22">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group  mt-3">
                            <label for="stateProvince">State/Province:<sup class="text-danger">*</sup></label>
                            <input type="text" class="form-control" id="stateProvince" required placeholder="" v-model="stateProvince">
                            
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group  mt-3">
                            <label for="postalCode">Zip/Postal Code:<sup class="text-danger">*</sup></label>
                            <input type="text" class="form-control" id="postalCode" required placeholder="" v-model="postalCode">
                            
                        </div>
                    </div>
                </div>

                <div class="form-group  mt-3">
                    <label for="phoneNumber">Phone number to receive SMS (text message) notification when a member wants to connect with you:<sup class="text-danger">*</sup></label>
                    <input type="text" class="form-control" id="phoneNumber" required v-model="phoneNumber" @input="formatPhoneNumber" placeholder="(000) 000-0000">
                    
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group  mt-3">
                            <label for="userName">Username:<sup class="text-danger">*</sup></label>
                            <input type="text" class="form-control" id="userName" required placeholder="" v-model="userName">
                            
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group  mt-3">
                            <label for="email">Email:<sup class="text-danger">*</sup></label>
                            <input type="email" class="form-control" id="email" required placeholder="" v-model="email">
                            
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group  mt-3">
                            <label for="password">Password:<sup class="text-danger">*</sup></label>
                            <input type="password" class="form-control" id="password" required placeholder="" v-model="password">
                            
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group  mt-3">
                            <label for="ConfirmPassword">Confirm Password:<sup class="text-danger">*</sup></label>
                            <input type="password" class="form-control" id="ConfirmPassword" required placeholder="" v-model="ConfirmPassword">
                            
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <ul>
                        <div v-for="(errorArray, idx) in error_inputs" :key="idx">
                            <div v-for="(allErrors, idx) in errorArray" :key="idx">
                                <li><span class="text-danger">{{ allErrors}} </span></li>
                            </div>
                        </div>
                    </ul>                    
                </div>
                <div class="form-group" v-show="showFreeMsgText">
                    <p class="text-success">{{ responseStatus }}</p>
                </div>
                <div class="row">
                   
                    <div class="form-group"> 
                        <button class="custom_yellow_btn mr-3 prew action-button" data-step-index="1" v-on:click="buttonHandle">Prev</button>
                        <button class="custom_yellow_btn" v-on:click="register">
                            <span v-if="loading" class="spinner-border spinner-border-sm" role="status"></span> Submit
                        </button>  
                        
                    </div>
                </div>
            </div>
            <!----------- End Step Two-----------------------------------------------------------> 
        </div>    
    </main>
    </template>
    <script>           
        const axios = require('axios');
        import router from '../router';
        export default {   
        props: { 
            planID: String         
        },         
        data() {
            return { 
                loading: false,
                isLoggedIn: false,
                CurrentlySeekingFamiliesWork:'',
                lookingFor:[],
                careOpportunities:[],
                childCareFor:[],
                childCareExperience:'',
                minRange:'',
                maxRange:'',
                NumberOfCareOneTime:'',
                AboutMe:'',
                specialNeeds:'',

                planDetail: {},
                UserGroup:'',
                firstName: "",
                lastName: "",
                address1: "",
                stateProvince: "",
                postalCode: "",
                phoneNumber: "",
                userName: "",
                email: "",
                password: "",
                ConfirmPassword: "",                
                error_inputs: "",
                
                responseStatus:"",
                specialNeedsExperience:false,
                specialNeedsOption:[],
                requiredFieldsTextErr:false,
                showFreeMsgText:false,

                pageTitle : 'Care Providers - Join Today for FREE!',
                pageMetaDescription : 'Nannies/Sitters - join our community totally FREE for life! Receive access to over 10,000 families in the Puget Sound area looking for...',
                pageMetaKeywords : ''
            };
        },
        methods: {            
            onChangeSpecialNeeds(event){
                let parentDrive = event.target.value;
                if(parentDrive=='No'){
                    this.specialNeedsExperience=false;                
                } else if(parentDrive=='Yes'){
                    this.specialNeedsExperience=true;                
                } else{
                    this.specialNeedsExperience=false; 
                }
            },           
            async buttonHandle(e) {
                const el = e.target;
                let stepIsValid = true
                const requiredFields = el.closest('.step').querySelectorAll('[required]')
                await requiredFields.forEach(field => {
                    const errorMessage = field.closest('.form-group').querySelector(`.error-message`)
                    if(field.validationMessage != "") stepIsValid = false
                    if(errorMessage) errorMessage.innerText = field.validationMessage
                    this.requiredFieldsTextErr = true
                });

                if(stepIsValid) {
                    this.requiredFieldsTextErr = false
                    document.querySelector('.activeStep').classList.remove('activeStep')
                    document.querySelector('.step' + el.dataset.stepIndex).classList.add('activeStep')
                }
            },
            GetFreePlanDetail(){
                axios.get(`/api/buy-care-provider-plan/${this.planID}`).then(({ data }) => {
                    this.planDetail = data;
                }).catch((err) => console.error(err));
            }, 
            formatPhoneNumber(event) {
                this.PhoneNumberTsst = event.target.value;
                this.phoneNumber = this.formatAsPhoneNumber(this.PhoneNumberTsst);
            },
            formatAsPhoneNumber(value) {
                value = value.replace(/\D/g, '');
                if (value.length > 10) {
                    value = value.slice(0, 10);
                }
                value = '('+ value.slice(0, 3)+')' + ' ' + value.slice(3, 6) + '-' + value.slice(6);
                return value;
            },
            register() {                
                this.loading = true;
                axios.post(`/api/registerFreeCareProvider`, {
                    CurrentlySeekingFamiliesWork:this.CurrentlySeekingFamiliesWork,
                    TypeOfCareLooking:this.lookingFor,
                    LookingForCareOpportunities:this.careOpportunities,
                    providerChildExperience:this.childCareFor,
                    providerTotalExperience:this.childCareExperience,
                    minRange:this.minRange,
                    maxRange:this.maxRange,
                    aboutMe:this.AboutMe,
                    NumberOfCareOneTime:this.NumberOfCareOneTime,
                    providerSpecialNeeds:this.specialNeeds,

                    planID: this.planDetail.id,
                    memberType: 'care_provider_member',
                    UserGroup:this.UserGroup,
                    firstName: this.firstName,
                    lastName: this.lastName,
                    email: this.email,
                    address1: this.address1,
                    address22: this.address22,
                    stateProvince: this.stateProvince,
                    postalCode: this.postalCode,
                    phoneNumber: this.phoneNumber,
                    userName: this.userName,
                    password: this.password,
                    ConfirmPassword: this.ConfirmPassword,
                }).then((response) => {
                    this.loading = false; 
                    this.showFreeMsgText = true;                  
                    this.responseStatus = response.data.updateMsg;
                    setTimeout(() => this.showFreeMsgText = false , 3000);
                    setTimeout(() => router.push({ name: 'thank-you-care-providers-free'}), 3000);                    
                    //router.push({ name: 'thank-you-care-providers-free'});                   
                                        
                }).catch(error => {
                    this.error_inputs = error.response.data.error
                });
            },
            addressValue(){
                if(this.address1.length>0){
                    this.initAutocomplete();
                }else{
                    this.address1 = ''; 
                    this.postalCode = ''; 
                    this.stateProvince = '';
                }
            },
            initAutocomplete() {                             
                const autocomplete = new google.maps.places.Autocomplete(this.$refs['Autocomplete_address1'],
                    { country: "us" }
                );                
                autocomplete.addListener("place_changed", () => {
                    const place = autocomplete.getPlace();                     
                    this.address1 = place.formatted_address; 
                    this.postalCode = ''; 
                    this.stateProvince = '';                                                         
                    for (const component of place.address_components) {
                        const componentType = component.types[0];                        
                        switch (componentType) {                                            
                            case "postal_code": {
                                this.postalCode = component.long_name;
                                break;
                            }
                            case "administrative_area_level_1":
                                this.stateProvince = component.long_name;
                            break;                                                                                        
                        }                           
                    }                      
                });                 
            }      
        },
        mounted() { 
            document.title = this.pageTitle;
            document.getElementsByTagName('meta')["description"].content = ""+this.pageMetaDescription+"";
            document.getElementsByTagName('meta')["keywords"].content = ""+this.pageMetaKeywords+"";                      
            this.initAutocomplete();
            this.loading = false;
            if (window.Laravel.isLoggedin) {
                this.isLoggedIn = true
            }
            if (window.Laravel.user) {
                this.firstName = window.Laravel.user.firstName,
                this.lastName = window.Laravel.user.lastName,
                this.address1 = window.Laravel.user.address1,
                this.address22 = window.Laravel.user.address2,
                this.stateProvince = window.Laravel.user.state,
                this.postalCode = window.Laravel.user.postal_code,
                this.phoneNumber = window.Laravel.user.mobile,
                this.email = window.Laravel.user.email,
                this.userName = window.Laravel.user.username
            }                   
        },
        updated() {
            
        },
        created(){ 
            this.$nextTick(function () {
                grecaptcha.render('recaptcha-main');
            })                    
            this.GetFreePlanDetail();
            axios.get(`/api/groups`).then((response) => {            
                this.UserGroup = response.data.allGroups[1].id;
            }).catch((err) => console.error(err));
        }
        
    }
</script>
<style>
    .step {
        display: none;
    }
    .activeStep {
        display: block;
    }
</style>
    
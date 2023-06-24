<template>
    <main>       
        <section class="sec-padding">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12">
                        <h3 style="margin-bottom: 0;">Current Open Positions Application for Care Providers</h3>
                        <p>Fields marked with an <sup class="text-danger">*</sup> are required</p>                        
                    </div>
                </div> 
                
                    <!----------- Step 1 ------------>
                    <div class="step step1 activeStep">
                        <!-------------------------------Step 1----->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mt-3">
                                    <label for="firstName" style="font-weight: bold;">First Name:<sup class="text-danger">*</sup></label>
                                    <input type="text" class="form-control" id="firstName" placeholder="" v-model="firstName" required>
                                    <div class="text-danger error-message"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group  mt-3">
                                    <label for="lastName" style="font-weight: bold;">Last Name:<sup class="text-danger">*</sup></label>
                                    <input type="text" class="form-control" id="lastName" placeholder="" v-model="lastName" required>
                                    <div class="text-danger error-message"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mt-3">
                                    <label for="email" style="font-weight: bold;">Email:<sup class="text-danger">*</sup></label>
                                    <input type="text" class="form-control" id="email" placeholder="" v-model="email" required>
                                    <div class="text-danger error-message"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group  mt-3">
                                    <label for="phone" style="font-weight: bold;">Phone:<sup class="text-danger">*</sup></label>
                                    <input type="text" class="form-control" id="phone" placeholder="" v-model="phoneNumber" required>
                                    <div class="text-danger error-message"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mt-3">
                                    <label for="CommunicateWithMessage" style="font-weight: bold;">May we communicate with you via text message?:<sup class="text-danger">*</sup></label>
                                    <select class="form-control" v-model="CommunicateWithMessage" required>
                                        <option value=""></option>                                
                                        <option value="no">No</option> 
                                        <option value="yes">Yes</option>                   
                                    </select> 
                                    <div class="text-danger error-message"></div>
                                </div>
                            </div> 
                            <div class="col-md-6">
                                <div class="form-group  mt-3">
                                    <label for="ApplyForPosition" style="font-weight: bold;">Which open position are you most interested in?:</label>
                                    <input type="text" class="form-control"  id="ApplyForPosition" placeholder=""  v-model="ApplyForPosition">
                                </div>
                            </div>
                        </div>
                        <div class="form-group  mt-3"> 
                            <button class="btn btn-danger mr-3 next action-button" data-step-index="2" v-on:click="buttonHandle">Next</button>   
                        </div>  
                    </div>
                    <!----------- Step 2 ------------>  
                    <div class="step step2">                        
                        <div class="row">                    
                            <div class="form-group mt-3">
                                <label for="nannyExperience" style="font-weight: bold;">Years of nannying experience:<sup class="text-danger">*</sup></label>
                                <select class="form-control" v-model="nannyExperience" required>                                
                                    <option value="" selected="selected"></option>	
                                    <option value="lessthanone">Less than one year</option>	
                                    <option value="1to3">1 to 3 years</option>	
                                    <option value="4to6">4 to 6 years</option>	
                                    <option value="7to9">7 to 9 years</option>	
                                    <option value="10to12">10 to 12 years</option>	
                                    <option value="morethan12">More than 12 years</option>                   
                                </select> 
                                <div class="text-danger error-message"></div>
                            </div>                                        
                        </div>
                        <div class="row">
                            <div class="form-group  mt-3">
                                <label for="childcareRelatededExprience" style="font-weight: bold;">Years of non-nannying, childcare-related experience (if any):<sup class="text-danger">*</sup></label>
                                <select class="form-control" v-model="childcareRelatededExprience" required>                                
                                    <option value="" selected="selected"></option>	
                                    <option value="lessthanone">Less than one year</option>	
                                    <option value="1to3">1 to 3 years</option>	
                                    <option value="4to6">4 to 6 years</option>	
                                    <option value="7to9">7 to 9 years</option>	
                                    <option value="10to12">10 to 12 years</option>	
                                    <option value="morethan12">More than 12 years</option>
                                    <option value="na">Not applicable</option>                
                                </select>
                                <div class="text-danger error-message"></div>
                            </div>
                        </div>
                        <div class="row">                    
                            <div class="form-group  mt-3">
                                <label for="AgeRangeExperience" style="font-weight: bold;">Age ranges you have experience caring for (select all that apply):<sup class="text-danger">*</sup></label>
                                <div class="form-check">
                                    <label for="newborn-to-3-months" class="form-check-label">
                                        <input type="checkbox" id="newborn-to-3-months" v-model="AgeRangeExperience" class="form-check-input" value="newborn-to-3-months" > Newborn to 3 months
                                    </label>
                                </div>
                                <div class="form-check">
                                    <label for="3-to-6-months" class="form-check-label">
                                        <input type="checkbox" id="3-to-6-months" class="form-check-input" v-model="AgeRangeExperience" value="3-to-6-months" > 3 to 6 months
                                    </label>
                                </div>  
                                <div class="form-check">
                                    <label for="6-to-12-months" class="form-check-label">
                                        <input type="checkbox" id="6-to-12-months" class="form-check-input" v-model="AgeRangeExperience" value="6-to-12-months" > 6 to 12 months
                                    </label>
                                </div>
                                <div class="form-check">
                                    <label for="12-to-24-months" class="form-check-label">
                                        <input type="checkbox" id="12-to-24-months" class="form-check-input" v-model="AgeRangeExperience" value="12-to-24-months" > 12 to 24 months
                                    </label>
                                </div>
                                <div class="form-check">
                                    <label for="3-to-4-years" class="form-check-label">
                                        <input type="checkbox" id="3-to-4-years" class="form-check-input" v-model="AgeRangeExperience" value="3-to-4-years" > 3 to 4 years
                                    </label>
                                </div>
                                <div class="form-check">
                                    <label for="5-to-9-years" class="form-check-label">
                                        <input type="checkbox" id="5-to-9-years" class="form-check-input" v-model="AgeRangeExperience" value="5-to-9-years" > 5 to 9 years
                                    </label>
                                </div>
                                <div class="form-check">
                                    <label for="10-to-13-years" class="form-check-label">
                                        <input type="checkbox" id="10-to-13-years" class="form-check-input" v-model="AgeRangeExperience" value="10-to-13-years" > 10 to 13 years
                                    </label>
                                </div>
                                <div class="form-check">
                                    <label for="13-years-or-older" class="form-check-label">
                                        <input type="checkbox" id="13-years-or-older" class="form-check-input" v-model="AgeRangeExperience" value="13-years-or-older" > 13 years or older
                                    </label>
                                </div> 
                                                    
                            </div>                                     
                        </div>
                        <div class="form-group  mt-3"> 
                            <button class="btn btn-danger mr-3 prew action-button" data-step-index="1" v-on:click="buttonHandle">Prew</button>
                            <button class="btn btn-info next action-button" data-step-index="3" v-on:click="buttonHandle">Next</button>   
                        </div>  
                    </div>                 
                    <div class="step step3">
                        <!--------------Step 3---------------->
                        <div class="row">
                            <div class="form-group  mt-3">
                                <label for="jobLocations" style="font-weight: bold;">Ideal job locations (select all that apply):<sup class="text-danger">*</sup></label>
                                <select class="form-control" v-model="jobLocations" multiple required> 
                                    <option value=""></option>                               
                                    <option value="seattle">Seattle</option>	
                                    <option value="northkingcounty">North King County (Shoreline, Kenmore, etc.)</option>	
                                    <option value="eastkingcounty">East King County (Bellevue, Redmond, etc.)</option>	
                                    <option value="southkingcounty">South King County (Tukwila, Renton, etc.)</option>	
                                    <option value="snohomishcounty">Snohomish County</option>	
                                    <option value="piercecounty">Pierce County</option>               
                                </select>
                                <div class="text-danger error-message"></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group  mt-3">                                
                                <label for="" style="font-weight: bold;">Ideal schedule:<sup class="text-danger">*</sup></label>
                                <p>Times, days of the week, or minimum/maximum amount of hours desired per week</p>
                                <input type="text" class="form-control" id="" v-model="MinMaxHoursWeek" placeholder="" required >
                                <div class="text-danger error-message"></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group  mt-3">                                
                                <label for="" style="font-weight: bold;">Available start date:<sup class="text-danger">*</sup></label>
                                <input type="text" class="form-control" id="" v-model="AvailableStartDate" placeholder="" required >
                                <div class="text-danger error-message"></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group  mt-3">
                                <label for="" style="font-weight: bold;">How long are you able to or interested in committing to your next position for:<sup class="text-danger">*</sup></label>
                                <select class="form-control" v-model="nextPosition" required>
                                    <option value=""></option>                                
                                    <option value="lessthan3months">Less than 3 months</option>	
                                    <option value="3to6months">3 to 6 months</option>	
                                    <option value="6to12months">6 to 12 months</option>	
                                    <option value="1to2years">1 to 2 years</option>	
                                    <option value="2yearsormore">2 years or more</option>              
                                </select>
                                <div class="text-danger error-message"></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group  mt-3">
                                <label for="childcareRelatedexPerience" style="font-weight: bold;">What are your compensation requirements?:<sup class="text-danger">*</sup></label>
                                <textarea class="form-control" v-model="compensationRequirements" rows="6" required></textarea>
                                <div class="text-danger error-message"></div>
                            </div>
                        </div>
                        
                        <div class="form-group  mt-3"> 
                            <button class="btn btn-danger mr-3 prew action-button" data-step-index="2" v-on:click="buttonHandle">Prew</button>
                            <button class="btn btn-info next action-button" data-step-index="4" v-on:click="buttonHandle">Next</button>   
                        </div>  
                    </div>                 
                    <div class="step step4">
                        <!--------------Step 4---------------->
                        <div class="row">
                            <div class="form-group  mt-3">
                                <label for="" style="font-weight: bold;">Is your CPR/First Aid Certification current?<sup class="text-danger">*</sup></label>
                                <select class="form-control" v-model="AidCertification" required>
                                    <option value=""></option>                                
                                    <option value="yes">Yes</option>	
                                    <option value="no">No</option>            
                                </select>
                                <div class="text-danger error-message"></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group  mt-3">
                                <label for="" style="font-weight: bold;">Do you have any unique or special needs experience, or special skills, certifications, training, or licensure?<sup class="text-danger">*</sup></label>
                                <textarea class="form-control" v-model="SpecialNeedsExperience" rows="6" required></textarea>
                                <div class="text-danger error-message"></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group  mt-3">
                                <label for="" style="font-weight: bold;">Do you speak any foreign languages? If so, please describe fluency level<sup class="text-danger">*</sup></label>
                                <textarea class="form-control" v-model="SpeakAnyForeignLanguages" rows="6" required></textarea>
                                <div class="text-danger error-message"></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group  mt-3">
                                <label for="" style="font-weight: bold;">What are your greatest strengths as a nanny?<sup class="text-danger">*</sup></label>
                                <textarea class="form-control" v-model="greatestStrengths" rows="6" required></textarea>
                                <div class="text-danger error-message"></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group  mt-3">
                                <label for="" style="font-weight: bold;">What is your approach to care, or what are your guiding beliefs or principles when it comes to nannying?<sup class="text-danger">*</sup></label>
                                <textarea class="form-control" v-model="BeliefsOrPrinciples" rows="6" required></textarea>
                                <div class="text-danger error-message"></div>
                            </div>
                        </div>
                        <div class="form-group  mt-3"> 
                            <button class="btn btn-danger mr-3 prew action-button" data-step-index="3" v-on:click="buttonHandle">Prew</button>
                            <button class="btn btn-info next action-button" data-step-index="5" v-on:click="buttonHandle">Next</button>   
                        </div>
                    </div>
                    <div class="step step5">
                        <!--------------Step 5---------------->
                        <div class="row">
                            <div class="form-group  mt-3">
                                <label for="" style="font-weight: bold;">Do you have a current and valid driver’s license?<sup class="text-danger">*</sup></label>
                                <select class="form-control" v-model="nannyDriverLicense" required> 
                                    <option value=""></option>                               
                                    <option value="yes">Yes</option>	
                                    <option value="no">No</option>            
                                </select>
                                <div class="text-danger error-message"></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group  mt-3">
                                <label for="" style="font-weight: bold;">Have you been fully vaccinated against Covid-19?<sup class="text-danger">*</sup></label>
                                <select class="form-control" v-model="vaccinatedCovid19" required>
                                    <option value=""></option>                                
                                    <option value="yes">Yes</option>	
                                    <option value="no">No</option>            
                                </select>
                                <div class="text-danger error-message"></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group  mt-3">
                                <label for="" style="font-weight: bold;">Do you have any pet allergies or special requirements when nannying?<sup class="text-danger">*</sup></label>
                                <textarea class="form-control" rows="6" v-model="allergiesRequiredRequirements" ></textarea>
                                <div class="text-danger error-message"></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group  mt-3">
                                <label for="" style="font-weight: bold;">Anything else we should know about what makes you a fantastic nanny?<sup class="text-danger">*</sup></label>
                                <textarea class="form-control" rows="6" v-model="fantasticNanny" required></textarea>
                                <div class="text-danger error-message"></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group  mt-3">
                                <label for="" style="font-weight: bold;">Would you like to upload a copy of your resume?<sup class="text-danger">*</sup></label>
                                <select class="form-control" v-model="Resume" required> 
                                    <option value=""></option>                               
                                    <option value="yes">Yes</option>	
                                    <option value="no">No</option>            
                                </select>
                                <div class="text-danger error-message"></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group  mt-3">
                                <label for="" style="font-weight: bold;">Would you like to upload other documents?<sup class="text-danger">*</sup></label>
                                <p class="text-danger">Select "yes" if you would like to upload other documents (i.e. letters of recommendation, references, etc.)</p>
                                <select class="form-control" v-model="uploadOtherDocuments" required>
                                    <option value=""></option>                                
                                    <option value="yes">Yes</option>	
                                    <option value="no">No</option>            
                                </select> 
                                <div class="text-danger error-message"></div>                               
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group  mt-3">
                                <label for="" style="font-weight: bold;">Would you like a FREE membership to our community?<sup class="text-danger">*</sup></label>
                                <p>100% Free. No credit card required. Membership includes access to all tools available on our website (Last Minute Care Service, CareCalendar, Member Search, Pay Calculator, etc.) plus personal support from our Search Team. </p>
                                <select class="form-control" v-model="FreeMembership" required> 
                                    <option value=""></option>                               
                                    <option value="yes">Yes</option>	
                                    <option value="no">No</option>            
                                </select>
                                <div class="text-danger error-message"></div>                                
                            </div>
                        </div>
                        <div class="form-group  mt-3"> 
                            <button class="btn btn-danger mr-3 prew action-button" data-step-index="4" v-on:click="buttonHandle">Prew</button>
                            <button class="btn btn-info " v-if="SubmitBtn" v-on:click="ApplyJob">
                                <span v-if="loader" class="spinner-border spinner-border-sm ml-3 text-white" role="status"><span class="sr-only">Loading...</span></span> Submit 
                            </button> 
                            <p v-if="responseStatus" class="mt-3 text-success">{{ responseStatus }}</p>  
                        </div>
                    </div>                
            </div>
        </section>
    </main>
</template>

<script>
    export default {
        name:'apply-job',
        props: { 
            job_id: String         
        },
        data() {
            return {
                loader:false,
                responseStatus:"",
                SubmitBtn:true,
                firstName : "",
                lastName : "",
                email : "",
                phoneNumber : "",
                CommunicateWithMessage : "",
                ApplyForPosition : "",
                nannyExperience : "",
                childcareRelatededExprience : "",
                AgeRangeExperience : [],
                jobLocations : [],
                MinMaxHoursWeek : "",
                AvailableStartDate : "",
                nextPosition : "",
                compensationRequirements : "",
                AidCertification : "",
                SpecialNeedsExperience : "",
                SpeakAnyForeignLanguages : "",
                greatestStrengths : "",
                BeliefsOrPrinciples : "",
                nannyDriverLicense : "",
                vaccinatedCovid19 : "",
                allergiesRequiredRequirements : "",
                fantasticNanny : "",
                Resume : "",
                uploadOtherDocuments : "",
                FreeMembership : "",
            }           
        },
        methods: {
            async buttonHandle(e) {
                const el = e.target;
                let stepIsValid = true
                const requiredFields = el.closest('.step').querySelectorAll('[required]')
                await requiredFields.forEach(field => {
                    const errorMessage = field.closest('.form-group').querySelector(`.error-message`)
                    if(field.validationMessage != "") stepIsValid = false
                    if(errorMessage) errorMessage.innerText = field.validationMessage
                });

                if(stepIsValid) {
                    document.querySelector('.activeStep').classList.remove('activeStep')
                    document.querySelector('.step' + el.dataset.stepIndex).classList.add('activeStep')
                }
            },
            ApplyJob() { 
                this.loader = true;
                axios.post(`/api/SaveApplyJob`, {
                    firstName:this.firstName,
                    lastName:this.lastName,
                    email:this.email,
                    phoneNumber:this.phoneNumber,
                    CommunicateWithMessage:this.CommunicateWithMessage,
                    ApplyForPosition:this.ApplyForPosition
                }).then((response) => {
                    this.responseStatus = response.data.success;
                    setTimeout(() => {
                        this.$router.go(this.$router.currentRoute);                  
                        this.loader = false;   
                    }, 3000);
                }).catch(error => {
                });               
                
            }
        },
        created() {
            window.scrollTo(0,0);
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
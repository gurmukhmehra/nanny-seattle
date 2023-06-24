<template>   
    <main>
        <section class="sec-padding" style="padding-top:0px;padding-bottom:0px;">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="iq-card">
                            <MemberHeader/>                                                       
                        </div> 
                        <div class="iq-card">
                            <MemberMenus/> 
                        </div>                                               
                    </div>
                    <div class="col-sm-12">
                        <div class="iq-card">
                            <div class="iq-card-body">
                                <div class="row">
                                    <div class="col-md-3">
                                        <ul class="nav nav-pills basic-info-items list-inline d-block p-0 m-0">
                                            <li>
                                                <a v-if="memberType === 'family_parent_member'" v-on:click="parentsBioDetail()" class="nav-link pull-left active" data-toggle="pill" href="#details">About You</a>
                                                    <span v-if="memberType === 'family_parent_member'" class="mt-2 editBtn"><router-link to="/profile-settings">Edit</router-link></span>
                                                <a v-else-if="memberType === 'care_provider_member'" v-on:click="careProviderBioDetail()" class="nav-link pull-left active" data-toggle="pill" href="#details">About You</a>
                                                    <span v-if="memberType === 'care_provider_member'" class="mt-2 editBtn"><router-link to="/profile-settings">Edit</router-link></span>
                                                <a v-else-if="memberType === 'agency_member'" class="nav-link pull-left active" data-toggle="pill" href="#details">About You</a>
                                                    <span v-if="memberType === 'agency_member'" class="mt-2 editBtn"><router-link to="/profile-settings">Edit</router-link></span>                                                
                                            </li>
                                            <li>
                                                <a class="nav-link" data-toggle="pill" href="#basicinfo">Contact and Basic Info</a>
                                            </li>                      
                                        </ul>
                                    </div>
                                    <div class="col-md-9 pl-4">
                                        <div class="tab-content">
                                            <div class="tab-pane fade active show" id="details" role="tabpanel">
                                                <h6 class="mb-3">About You</h6>
                                                <hr>
                                                <div v-if="memberType === 'family_parent_member'" class="row">
                                                    <div class="col-6 pb-2"><h6 class="aboutHeadings">Currently seeking new provider to work with?</h6></div>
                                                    <div class="col-6 pb-2">
                                                        <p class="mb-0">
                                                            <span v-if="parentBioDetails.currently_seeking_provider_work === 'Yes'" style="background-color: #a5dc86;padding: 5px 20px;border: 1px solid rgba(0, 0, 0, 0.2);border-radius: 20px;color: #fff;">
                                                                {{parentBioDetails.currently_seeking_provider_work}}
                                                            </span>
                                                            <span v-else-if="parentBioDetails.currently_seeking_provider_work === 'No'" style="background-color: red;padding: 5px 20px;border: 1px solid rgba(0, 0, 0, 0.2);border-radius: 20px;color: #fff;">
                                                                {{parentBioDetails.currently_seeking_provider_work}}
                                                            </span>
                                                            <span v-else>Null</span>
                                                        </p>
                                                    </div>
                                                    <div class="col-6 pb-2"><h6 class="aboutHeadings">Name</h6></div>
                                                    <div class="col-6 pb-2"><p class="mb-0">{{name}}</p></div>
                                                    <div class="col-6 pb-2"><h6 class="aboutHeadings">What city do you live in?</h6></div>
                                                    <div class="col-6 pb-2">
                                                        <p class="mb-0" v-if="!!parentLives">{{parentLives}}</p>
                                                        <p class="mb-0" v-else>Null</p>
                                                    </div>
                                                    <div class="col-6 pb-2"><h6 class="aboutHeadings">Type(s) of care you are looking for</h6></div>
                                                    <div class="col-6 pb-2">
                                                        <p class="mb-0" v-if="!!parentLookingFor">{{parentLookingFor}}</p>
                                                        <p class="mb-0" v-else>Null</p>
                                                    </div>
                                                    <div class="col-6 pb-2"><h6 class="aboutHeadings">Where are you looking for care opportunities?</h6></div>
                                                    <div class="col-6 pb-2">
                                                        <p class="mb-0" v-if="!!parentOpportunities">{{parentOpportunities}}</p>
                                                        <p class="mb-0" v-else>Null</p>
                                                    </div>
                                                    <div class="col-6 pb-2"><h6 class="aboutHeadings">Desired hourly pay rate range?</h6></div>
                                                    <div class="col-6 pb-2"><p class="mb-0">${{parentMinRateRange}} - ${{parentMaxRateRange}}</p></div>
                                                    <div class="col-6 pb-2"><h6 class="aboutHeadings">About My Family</h6></div>
                                                    <div class="col-6 pb-2">
                                                        <p class="mb-0" v-if="!!parentAboutfamily">{{parentAboutfamily}}</p>
                                                        <p class="mb-0" v-else>Null</p>
                                                    </div>
                                                    <div class="col-6 pb-2"><h6 class="aboutHeadings">Number of children that you need child care for?</h6></div>
                                                    <div class="col-6 pb-2">
                                                        <p class="mb-0" v-if="!!parentChildrenCare">{{parentChildrenCare}}</p>
                                                        <p class="mb-0" v-else>Null</p>
                                                    </div>
                                                    <div class="col-6 pb-2"><h6 class="aboutHeadings">Ages of child(ren) that need child care?</h6></div>
                                                    <div class="col-6 pb-2">
                                                        <p class="mb-0" v-if="!!parentChildrenAge">{{parentChildrenAge}}</p>
                                                        <p class="mb-0" v-else>Null</p>
                                                    </div>
                                                    <div class="col-6 pb-2"><h6 class="aboutHeadings">Preference on care provider experience level?</h6></div>
                                                    <div class="col-6 pb-2">
                                                        <p class="mb-0" v-if="!!parentExperienceProvider">{{parentExperienceProvider}}</p>
                                                        <p class="mb-0" v-else>Null</p>
                                                    </div>
                                                    <div class="col-6 pb-2"><h6 class="aboutHeadings">Does your family/children have any allergies or special needs that care providers should be aware of?</h6></div>
                                                    <div class="col-6 pb-2">
                                                        <p class="mb-0" v-if="!!parentSpecialNeed">{{parentSpecialNeed}}</p>
                                                        <p class="mb-0" v-else>Null</p>
                                                    </div>
                                                    <div class="row" v-if="parentSpecialNeed=='Yes'">
                                                        <div class="col-6 pb-2"><h6 class="aboutHeadings">Please share any details regarding allergies or special needs that prospective families should be aware of</h6></div>
                                                        <div class="col-6 pb-2 pl-4">
                                                            <p class="mb-0" v-if="!!SpecialNeedsExtra">{{SpecialNeedsExtra}}</p>
                                                            <p class="mb-0" v-else>Null</p>
                                                        </div>
                                                    </div>

                                                    <div class="col-6 pb-2"><h6 class="aboutHeadings">Are you seeking a care provider that speaks languages other than English?</h6></div>
                                                    <div class="col-6 pb-2">
                                                        <p class="mb-0" v-if="!!parentLanguages">{{parentLanguages}}</p>
                                                        <p class="mb-0" v-else>Null</p>
                                                    </div>
                                                    <div class="row" v-if="parentLanguages=='Yes'">
                                                        <div class="col-6 pb-2"><h6 class="aboutHeadings">Select all languages that you would like the care provider to be able to use conversationally</h6></div>
                                                        <div class="col-6 pb-2 pl-4">
                                                            <p class="mb-0" v-if="!!ParentSpeekLanguage">{{ParentSpeekLanguage}}</p>
                                                            <p class="mb-0" v-else>Null</p>
                                                        </div>
                                                    </div>

                                                    <div class="col-6 pb-2"><h6 class="aboutHeadings">Do you prefer a care provider who drives?</h6></div>
                                                    <div class="col-6 pb-2">
                                                        <p class="mb-0" v-if="!!parentDrive">{{parentDrive}}</p>
                                                        <p class="mb-0" v-else>Null</p>
                                                    </div>
                                                    <div class="row" v-if="parentDrive=='Yes'">
                                                        <div class="col-6 pb-2"><h6 class="aboutHeadings">Do you prefer to have the care provider drive their own vehicle or one of your vehicles?</h6></div>
                                                        <div class="col-6 pb-2 pl-4">
                                                            <p class="mb-0" v-if="!!parentDriveProvide">{{parentDriveProvide}}</p>
                                                            <p class="mb-0" v-else>Null</p>
                                                        </div>
                                                    </div>
                                                    <h6>Availability</h6>
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-6 pb-2"><h6 class="aboutHeadings">What days of the week do you need or are offering care?</h6></div>
                                                        <div class="col-6 pb-2 pl-4">
                                                            <p class="mb-0" v-if="!!parentAvailability">{{parentAvailability}}</p>
                                                            <p class="mb-0" v-else>Null</p>
                                                        </div>
                                                    </div>
                                                    <div v-show="loader" class="row text-center" >
                                                        <span style="color:rgb(229, 142, 178);">
                                                            <span class="spinner-grow spinner-grow-md"></span>
                                                            <span class="spinner-grow spinner-grow-md"></span>
                                                            <span class="spinner-grow spinner-grow-md"></span>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div v-if="memberType === 'care_provider_member'" class="row">
                                                    <div class="col-6 pb-2"><h6 class="aboutHeadings">Currently seeking new families to work with?</h6></div>
                                                    <div class="col-6 pb-2">
                                                        <p class="mb-0">
                                                            <span v-if="careProviderBioDetails.currently_seeking_provider_work === 'Yes'" style="background-color: #a5dc86;padding: 5px 20px;border: 1px solid rgba(0, 0, 0, 0.2);border-radius: 20px;color: #fff;">
                                                                {{careProviderBioDetails.currently_seeking_provider_work}}
                                                            </span>
                                                            <span v-else-if="careProviderBioDetails.currently_seeking_provider_work === 'No'" style="background-color: red;padding: 5px 20px;border: 1px solid rgba(0, 0, 0, 0.2);border-radius: 20px;color: #fff;">
                                                                {{careProviderBioDetails.currently_seeking_provider_work}}
                                                            </span>
                                                            <span v-else>Null</span>
                                                        </p>
                                                    </div>

                                                    <div class="col-6 pb-2"><h6 class="aboutHeadings">Name</h6></div>
                                                    <div class="col-6 pb-2"><p class="mb-0">{{name}}</p></div>
                                                    <div class="col-6 pb-2"><h6 class="aboutHeadings">What city do you live in?</h6></div>
                                                    <div class="col-6 pb-2">
                                                        <p class="mb-0" v-if="!!careProviderBioDetails.live_in">{{careProviderBioDetails.live_in}}</p>
                                                        <p class="mb-0" v-else>Null</p>
                                                    </div>
                                                    <div class="col-6 pb-2"><h6 class="aboutHeadings">Type(s) of care you are looking for</h6></div>
                                                    <div class="col-6 pb-2">
                                                        <p class="mb-0" v-if="!!TypeOfCareLooking">{{TypeOfCareLooking}}</p>
                                                        <p class="mb-0" v-else>Null</p>
                                                    </div>                                                    
                                                    <div class="col-6 pb-2"><h6 class="aboutHeadings">Where are you looking for care opportunities?</h6></div>
                                                    <div class="col-6 pb-2">
                                                        <p class="mb-0" v-if="!!LookingForCareOpportunities">{{LookingForCareOpportunities}}</p>
                                                        <p class="mb-0" v-else>Null</p>
                                                    </div>
                                                    <div class="col-6 pb-2"><h6 class="aboutHeadings">Desired hourly pay rate range?</h6></div>
                                                    <div class="col-6 pb-2"><p class="mb-0" v-if="rateMinRange != ''">${{rateMinRange}} - ${{rateMaxRange}} </p></div>
                                                    <div class="col-6 pb-2"><h6 class="aboutHeadings">What age groups do you have experience providing child care for?</h6></div>
                                                    <div class="col-6 pb-2">
                                                        <p class="mb-0" v-if="!!providerChildExperience">{{providerChildExperience}}</p>
                                                        <p class="mb-0" v-else>Null</p>
                                                    </div>
                                                    <div class="col-6 pb-2"><h6 class="aboutHeadings">How many years of child care experience do you have?</h6></div>
                                                    <div class="col-6 pb-2">
                                                        <p class="mb-0" v-if="!!providerTotalExperience">{{providerTotalExperience}}</p>
                                                        <p class="mb-0" v-else>Null</p>
                                                    </div>
                                                    <div class="col-6 pb-2"><h6 class="aboutHeadings">Number of children you will care for at one time?</h6></div>
                                                    <div class="col-6 pb-2">
                                                        <p class="mb-0" v-if="!!providerCareOneTime">{{providerCareOneTime}}</p>
                                                        <p class="mb-0" v-else>Null</p>
                                                    </div>
                                                    <div class="col-6 pb-2"><h6 class="aboutHeadings">About Me</h6></div>
                                                    <div class="col-6 pb-2">
                                                        <p class="mb-0" v-if="!!careProviderBioDetails.aboutMyfamily">{{careProviderBioDetails.aboutMyfamily}}</p>
                                                        <p class="mb-0" v-else>Null</p>
                                                    </div>

                                                    <div class="col-6 pb-2"><h6 class="aboutHeadings">Do you have experience caring for children with special needs?</h6></div>
                                                    <div class="col-6 pb-2">
                                                        <p class="mb-0" v-if="!!providerParentSpecialNeed">{{providerParentSpecialNeed}}</p>
                                                        <p class="mb-0" v-else>Null</p>
                                                    </div>
                                                    <div class="row" v-if="providerParentSpecialNeed=='Yes'">
                                                        <div class="col-6 pb-2"><h6 class="aboutHeadings">Please share any details regarding allergies or special needs that prospective families should be aware of</h6></div>
                                                        <div class="col-6 pb-2 pl-4">
                                                            <p class="mb-0" v-if="!!providerPpecialNeedsExtra">{{providerPpecialNeedsExtra}}</p>
                                                            <p class="mb-0" v-else>Null</p>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="col-6 pb-2"><h6 class="aboutHeadings">Do you speak any other language(s) besides English?</h6></div>
                                                    <div class="col-6 pb-2">
                                                        <p class="mb-0" v-if="!!providerKonwLanguage">{{providerKonwLanguage}}</p>
                                                        <p class="mb-0" v-else>Null</p>
                                                    </div>
                                                    <div class="row" v-if="providerKonwLanguage=='Yes'">
                                                        <div class="col-6 pb-2"><h6 class="aboutHeadings">Select all languages that you can use conversationally?</h6></div>
                                                        <div class="col-6 pb-2 pl-4">
                                                            <p class="mb-0" v-if="!!SpeekLanguage">{{SpeekLanguage}}</p>
                                                            <p class="mb-0" v-else>Null</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-6 pb-2"><h6 class="aboutHeadings">Are you willing to transport children to school, activities, etc.?</h6></div>
                                                    <div class="col-6 pb-2">
                                                        <p class="mb-0" v-if="!!careProviderBioDetails.providerDrives">{{careProviderBioDetails.providerDrives}}</p>
                                                        <p class="mb-0" v-else>Null</p>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-6 pb-2"><h6 class="aboutHeadings">How do you transport children you are caring for?</h6></div>
                                                        <div class="col-6 pb-2 pl-4">
                                                            <p class="mb-0" v-if="!!providerTransPort">{{providerTransPort}}</p>
                                                            <p class="mb-0" v-else>Null</p>
                                                        </div>
                                                    </div>                                
                                                    <div class="col-6 pb-2"><h6 class="aboutHeadings">What days of the week do you need or are offering care?</h6></div>
                                                    <div class="col-6 pb-2">
                                                        <p class="mb-0" v-if="!!availability">{{availability}}</p>
                                                        <p class="mb-0" v-else>Null</p>
                                                    </div>
                                                    <div v-show="loader" class="row text-center" >
                                                        <span style="color:rgb(229, 142, 178);">
                                                            <span class="spinner-grow spinner-grow-md"></span>
                                                            <span class="spinner-grow spinner-grow-md"></span>
                                                            <span class="spinner-grow spinner-grow-md"></span>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div v-if="memberType === 'agency_member'" class="row">
                                                    <div class="col-6 pb-2"><h6 class="aboutHeadings">Name</h6></div>
                                                    <div class="col-6 pb-2"><p class="mb-0">{{name}}</p></div>                                
                                                </div>
                                                <div v-else></div>
                                            </div> 
                                            <div class="tab-pane fade" id="basicinfo" role="tabpanel">
                                                <h6>Contact Information</h6>
                                                <hr>
                                                <div class="row">
                                                    <div class="col-3">
                                                        <h6 style="font-size: 14px;font-weight: 400;">Username</h6>
                                                    </div>
                                                    <div class="col-9">
                                                        <p class="mb-0">{{username}}</p>
                                                    </div>
                                                    <div class="col-3">
                                                        <h6 style="font-size: 14px;font-weight: 400;">Email</h6>
                                                    </div>
                                                    <div class="col-9">
                                                        <p class="mb-0">{{email}}</p>
                                                    </div>
                                                    <div class="col-3">
                                                        <h6 style="font-size: 14px;font-weight: 400;">Mobile</h6>
                                                    </div>
                                                    <div class="col-9">
                                                        <p class="mb-0" v-if="!!phoneNumber">{{phoneNumber}}</p>
                                                        <p class="mb-0" v-else>Null</p>
                                                    </div>
                                                    <div class="col-3">
                                                        <h6 style="font-size: 14px;font-weight: 400;">Address 1</h6>
                                                    </div>
                                                    <div class="col-9">
                                                        <p class="mb-0" v-if="!!address1">{{address1}}, {{stateProvince}}, {{postalCode}}</p>
                                                        <p class="mb-0" v-else>Null</p>
                                                    </div>
                                                    <div class="col-3">
                                                        <h6 style="font-size: 14px;font-weight: 400;">Address 2</h6>
                                                    </div>
                                                    <div class="col-9">
                                                        <p class="mb-0" v-if="!!address2">{{address2}}, {{stateProvince}}, {{postalCode}}</p>
                                                        <p class="mb-0" v-else>Null</p>
                                                    </div>
                                                </div>
                                            </div>                  
                                        </div>
                                    </div>
                                </div>           
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</template>
<script>
const axios = require('axios');
import MemberHeader from "../Users/MemberHeader";
import MemberMenus from "../Users/MemberMenus";
export default {
    name: "UserAbout",
    components: {
        MemberHeader,
        MemberMenus
    },
    data() {
        return {
            loader:true,
            isLoggedIn: false,
            TypeOfCareLooking: '',
            LookingForCareOpportunities:'',
            rateMinRange:"",
            rateMaxRange:"",
            providerChildExperience: '',
            providerTotalExperience: "",
            providerCareOneTime: "",
            aboutMe: "",
            providerParentSpecialNeed:"",
            providerPpecialNeedsExtra:"",
            providerKonwLanguage: "",
            providerTransportSchoolActivities: "",
            availability:"",
            SpeekLanguage:"",
            providerTransPort:"",
            careProviderBioDetails:"",

            parentBioDetails:"",
            parentLives:"",
            parentLookingFor:"",
            parentOpportunities:"",
            parentMinRateRange:"",
            parentMaxRateRange:"",
            parentAboutfamily:"",
            parentChildrenCare:"",
            parentChildrenAge:"",
            parentExperienceProvider:"",
            parentSpecialNeed:"",
            SpecialNeedsExtra:"",
            parentLanguages:"",
            ParentSpeekLanguage:"",
            parentDrive:"",
            parentDriveProvide:"",
            parentAvailability:"",

            name:'',
            email:'',
            username:'',
            address1:'',
            address2:'',
            phoneNumber:'',
            profileImage:'',
            ProfileCover:'',

        }
    },
    methods: {
        MyNotificatios(){
            axios.get(`/api/MyNotificatios`).then((response) => {
                this.total_notification = response.data.totalNotification;
            }).catch((err) => console.error(err));
        },
        careProviderBioDetail(){
            axios.get(`/api/careProivderBioDetail`).then((response) => { 
                this.loader = false;   
                this.careProviderBioDetails = response.data.userBio,          
                this.TypeOfCareLooking = response.data.careLooking,
                this.LookingForCareOpportunities = response.data.careOpportunitie,
                this.providerChildExperience = response.data.careChildExp,
                this.rateMinRange = response.data.userBio.minRange,
                this.rateMaxRange = response.data.userBio.maxRange,
                this.providerTotalExperience = response.data.userBio.providerExperience,
                this.providerCareOneTime = response.data.userBio.providerCareOneTime,
                this.aboutMe = response.data.userBio.aboutMyfamily,
                this.providerParentSpecialNeed = response.data.userBio.ChildSpecialNeeds,
                this.providerPpecialNeedsExtra = response.data.userBio.SpecialNeedsExtra,
                this.providerKonwLanguage = response.data.userBio.providerSpeaksLanguages,
                this.SpeekLanguage = response.data.SpeekLanguage,
                this.providerTransportSchoolActivities = response.data.userBio.providerTransportSchoolActivities,
                this.providerTransPort = response.data.providerTransPorts,
                this.availability = response.data.careAvailability                   
            }).catch((err) => console.error(err));
        },
        parentsBioDetail(){
            axios.get(`/api/parentBioDetail`).then((response) => {
                this.loader = false; 
                this.parentBioDetails = response.data.userBio;
                this.SpecialNeedsExtra =  response.data.userBio.SpecialNeedsExtra;              
                this.parentLives = response.data.userBio.live_in;
                this.parentLookingFor = response.data.parentTypeOfCareLooking; 
                this.parentOpportunities = response.data.parentCareOpportunities; 
                this.parentMinRateRange = response.data.userBio.minRange
                this.parentMaxRateRange = response.data.userBio.maxRange;
                this.parentAboutfamily = response.data.userBio.aboutMyfamily;
                this.parentChildrenCare = response.data.userBio.numnerOfchild;
                this.parentChildrenAge = response.data.userBio.childAge;
                this.parentExperienceProvider = response.data.userBio.providerExperience;
                this.parentSpecialNeed = response.data.userBio.ChildSpecialNeeds;
                this.parentLanguages = response.data.userBio.providerSpeaksLanguages;
                this.ParentSpeekLanguage  = response.data.parentSpeaksLanguages;
                this.parentDrive = response.data.userBio.providerDrives;
                this.parentDriveProvide = response.data.userBio.parentsVehicle;
                this.parentAvailability = response.data.parentAvailability;
            }).catch((err) => console.error(err));
        },
        memberBasicInfo(){
            axios.get(`/api/memberBasicDetail`).then((response) => {
                this.name = response.data.userInfo.name,
                this.email =response.data.userInfo.email,
                this.address1 = response.data.userInfo.address1,
                this.address2 = response.data.userInfo.address2,
                this.username = response.data.userInfo.username,
                this.phoneNumber = response.data.userInfo.mobile,
                this.profileImage = response.data.userInfo.profileImage,
                this.ProfileCover = response.data.userInfo.ProfileCover
            }).catch((err) => console.error(err));
        }
    },
    mounted() {
        Echo.private('sendfriendReq-channel').listen('FriendRequestSend',(e) => {
            //console.log('Friend request new  : ', e.notification);
            //this.total_notification += e.notification;
            this.MyNotificatios();        
        });
    },
    created() {
        this.memberBasicInfo();
        if (window.Laravel.isLoggedin) {
            this.isLoggedIn = true
        }
        if (window.Laravel.user) {
            this.id = window.Laravel.user.id,
            this.memberType = window.Laravel.user.memberType,
            this.role = window.Laravel.user.role,
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
        }
        if(this.memberType==='care_provider_member'){           
            this.careProviderBioDetail()
        } else if(this.memberType==='family_parent_member'){
            this.parentsBioDetail()
        } else {
            //console.log('test');
        }
    },
    updated() {
        window.scrollTo({
            top: 280,
            behavior: 'smooth',
        })
    },    
    beforeRouteEnter(to, from, next) {
        if (!window.Laravel.isLoggedin) {
            window.location.href = "/";
        }
     next();
    }
}
</script>
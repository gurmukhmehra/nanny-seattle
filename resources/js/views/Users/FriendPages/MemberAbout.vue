<template>   
    <main>
        <section class="sec-padding" style="padding-top:0px;padding-bottom:0px;">
            <div class="container">
                <div class="row">                    
                    <!----------------- Member Header--------------------->
                    <div class="col-sm-12">
                        <div class="iq-card">
                            <div class="iq-card-body profile-page p-0 mt-3">
                                <div class="profile-header">
                                    <div v-if="!!membersDetais.ProfileCover" class="cover-container-header" :style="{'background-image': 'url(' + '/public/uploads/coverImages/'+membersDetais.id +'/cover-image/' + membersDetais.ProfileCover + ')'}">
                                    </div>
                                    <div v-else class="cover-container-header" style="background-image: url('https://templates.iqonic.design/socialv/bs5/html/dist/assets/images/page-img/profile-bg1.jpg');">
                                    </div>
                                    <!-- <div class="cover-container">
                                        <img v-if="!!membersDetais.ProfileCover" :src="'../uploads/coverImages/'+membersDetais.id +'/cover-image/' + membersDetais.ProfileCover" alt="profile-bg" class="rounded img-fluid" style="width:100%;">
                                        <img v-else src="https://templates.iqonic.design/socialv/bs5/html/dist/assets/images/page-img/profile-bg1.jpg" alt="profile-bg" class="rounded img-fluid">
                                    </div> -->
                                    <div class="user-detail text-center mb-3">
                                        <div class="profile-img">
                                            <img v-if="!!membersDetais.profileImage" :src="'/public/uploads/profileImage/' + membersDetais.profileImage" alt="profile-img" class="avatar-130 img-fluid" />
                                            <img v-else src="https://cdn.pixabay.com/photo/2015/03/04/22/35/avatar-659652__340.png" alt="profile-img" class="avatar-130 img-fluid" />                                      
                                        </div>
                                        <div class="profile-detail">
                                            <h3 class="">{{membersDetais.name}}</h3>
                                        </div>
                                    </div>
                                    <div class="profile-info p-4 d-flex align-items-center justify-content-between position-relative">
                                        <div class="social-links">
                                            <ul class="social-data-block d-flex align-items-center justify-content-between list-inline p-0 m-0">
                                                <li class="text-center pr-3">                                                    
                                                    <a v-if="!!membersDetais.facebookURL" :href="membersDetais.facebookURL" Target="_blank">
                                                        <img src="https://templates.iqonic.design/socialv/bs5/html/dist/assets/images/icon/08.png" class="img-fluid rounded" alt="facebook">
                                                    </a>
                                                    <a v-else>
                                                        <img src="https://templates.iqonic.design/socialv/bs5/html/dist/assets/images/icon/08.png" class="img-fluid rounded" alt="facebook">
                                                    </a>
                                                </li>
                                                <li class="text-center pr-3">
                                                    <a v-if="!!membersDetais.twitterURL" :href="membersDetais.twitterURL" Target="_blank">
                                                        <img src="https://templates.iqonic.design/socialv/bs5/html/dist/assets/images/icon/09.png" class="img-fluid rounded" alt="Twitter">
                                                    </a>
                                                    <a v-else>
                                                        <img src="https://templates.iqonic.design/socialv/bs5/html/dist/assets/images/icon/09.png" class="img-fluid rounded" alt="Twitter">
                                                    </a>
                                                </li>
                                                <li class="text-center pr-3">
                                                    <a v-if="!!membersDetais.instagramURL" :href="membersDetais.instagramURL" Target="_blank">
                                                        <img src="https://templates.iqonic.design/socialv/bs5/html/dist/assets/images/icon/10.png" class="img-fluid rounded" alt="Instagram">
                                                    </a>
                                                    <a v-else>
                                                        <img src="https://templates.iqonic.design/socialv/bs5/html/dist/assets/images/icon/10.png" class="img-fluid rounded" alt="Instagram">
                                                    </a>
                                                </li>                                                
                                                <li class="text-center pr-3">
                                                    <a v-if="!!membersDetais.linkedinURL" :href="membersDetais.linkedinURL" Target="_blank">
                                                        <img src="https://templates.iqonic.design/socialv/bs5/html/dist/assets/images/icon/13.png" class="img-fluid rounded" alt="linkedin">
                                                    </a>
                                                    <a v-else>
                                                        <img src="https://templates.iqonic.design/socialv/bs5/html/dist/assets/images/icon/13.png" class="img-fluid rounded" alt="linkedin">
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="social-info" v-if="friendRequestStatus>0">
                                            <h6 v-if="friendRequestBtn.requestStatus=='pending'" style="margin-left: 50%;">Friend Request</h6>
                                            <ul class="social-data-block d-flex align-items-center list-inline" style="list-style-type: none;">
                                                
                                                <li v-if="membersDetais.memberType === 'family_parent_member'">
                                                    <img :src="'/public/uploads/Family_Parent-Icon.png'" title="Family/Parent Member" class="member_icons"/>
                                                </li>
                                                <li v-if="membersDetais.memberType === 'family_parent_member'">
                                                    <span class="fmaily_count_child" title="Number of children needs care for">{{Bios.numnerOfchild}}</span>
                                                </li>

                                                <li v-if="membersDetais.memberType === 'care_provider_member'">
                                                    <img :src="'/public/uploads/Care-Provider-Icon.png'" title="Care Provider Member" class="member_icons"/>
                                                </li>
                                                <li v-if="membersDetais.memberType === 'care_provider_member'">
                                                    <span class="fmaily_count_child" title="Number of children will provide care for at one time">{{Bios.providerCareOneTime}}</span>
                                                </li>
                                                <li v-if="membersDetais.memberType === 'agency_member'">
                                                    <img :src="'/public/uploads/Agency-Icon.png'" title="Family/Parent Member" class="member_icons"/>
                                                </li>                                                

                                                <li class="text-center pl-3 mb-2" v-if="friendRequestBtn.senderUserID!=Auth_id && friendRequestBtn.requestStatus=='pending'">
                                                    <a v-on:click="friendRequestConfirm(friendRequestBtn.id)" class="custom_yellow_btn" style="padding-top: 5px;padding-bottom: 5px;">
                                                        <span v-show="ConfirmRequestLoader" class="spinner-border spinner-border-sm text-white" role="status"></span>
                                                        Accpet
                                                    </a>
                                                </li>
                                                <li class="text-center pl-3 mb-2" v-else-if="friendRequestBtn.requestSendTo!=Auth_id && friendRequestBtn.requestStatus=='pending'"></li>
                                                <li class="text-center pl-3 mb-2" v-else-if="friendRequestBtn.requestStatus=='pending' && friendRequestBtn.requestSendTo!=Auth_id">
                                                    <a v-on:click="friendRequestConfirm(friendRequestBtn.id)" class="custom_yellow_btn" style="padding-top: 5px;padding-bottom: 5px;">
                                                        <span v-show="ConfirmRequestLoader" class="spinner-border spinner-border-sm text-white" role="status"></span>
                                                        Accpet
                                                    </a>
                                                </li>
                                                <li class="text-center pl-3 mb-2" v-else></li>
                                                <li class="text-center pl-3 mb-2">                                                    
                                                    <a class="btn btn-danger text-white" v-if="friendRequestBtn.requestStatus=='pending'" v-on:click="UnFirend(friendRequestBtn.id, friendRequestBtn.requestSendTo)">
                                                        <span v-show="LoaderIcon" class="spinner-border spinner-border-sm text-white" role="status"></span>
                                                        Cancel
                                                    </a>
                                                </li>
                                                
                                                <li class="text-center pl-3 mb-2" v-if="friendRequestBtn.requestStatus=='confirm'" v-on:click="UnFirend(friendRequestBtn.id, friendRequestBtn.requestSendTo)">
                                                    <a class="btn btn-danger text-white">
                                                        <span v-show="LoaderIcon" class="spinner-border spinner-border-sm text-white" role="status"></span>
                                                        Un-Friend 
                                                    </a>
                                                </li>                                                                                         
                                            </ul>
                                            <span v-show="statusVisibleConfim" class="text-success text-center" style="float:left;">Confirm</span>                                             
                                        </div>
                                        <div class="social-info" v-else>
                                            <ul class="social-data-block d-flex align-items-center list-inline" style="list-style-type: none;">
                                                <li v-if="membersDetais.memberType === 'family_parent_member'">
                                                    <img :src="'/public/uploads/Family_Parent-Icon.png'" title="Family/Parent Member" class="member_icons"/>                            
                                                </li>
                                                <li v-if="membersDetais.memberType === 'family_parent_member'">
                                                    <span class="fmaily_count_child" title="Number of children needs care for">{{Bios.numnerOfchild}}</span>
                                                </li>
                                                <li v-if="membersDetais.memberType === 'care_provider_member'">
                                                    <img :src="'/public/uploads/Care-Provider-Icon.png'" title="Care Provider Member" class="member_icons"/>
                                                </li>
                                                <li v-if="membersDetais.memberType === 'care_provider_member'">
                                                    <span class="provider_count_child" title="Number of children will provide care for at one time">{{Bios.providerCareOneTime}}</span>
                                                </li>
                                                <li v-if="membersDetais.memberType === 'agency_member'">
                                                    <img :src="'/public/uploads/Agency-Icon.png'" title="Family/Parent Member" class="member_icons"/>
                                                </li>
                                                
                                                <li class="text-center pl-3" v-on:click="sendFirendRequest(username)">
                                                    <a class="custom_yellow_btn">
                                                        <span v-show="LoaderIcon" class="spinner-border spinner-border-sm text-white" role="status"></span>
                                                        Send Friend Request 
                                                    </a>
                                                </li> 
                                            </ul>
                                            <span v-if="resquestSend=='Request Send'" v-show="statusVisible" class="text-success text-center" style="float:left;">{{resquestSend}}</span> 
                                            <span v-else v-show="statusVisible" class="text-danger text-center" style="float:left;">{{resquestSend}}</span> 
                                        </div>
                                    </div>
                                    <div class="iq-card-body p-0">
                                        <div class="user-tabing">
                                            <ul class="nav nav-pills d-flex align-items-center profile-feed-items p-0 m-0">
                                                <li class="p-2">
                                                    <router-link :to="{name: 'members-about',params: {username: username}}" class="nav-link custom-active" rel="memberAbout" ><i class="fa fa-user"></i> About</router-link>                                            
                                                </li>
                                                <li class="p-2">
                                                    <router-link :to="{name: 'members-frineds-list',params: {username: username}}" class="nav-link custom-active" rel="memberfriendslist" ><i class="fa fa-users"></i> Friends</router-link>                                            
                                                </li>
                                                
                                                <li class="p-2">
                                                    <router-link :to="{name: 'members-reviews',params: {username: username}}" class="nav-link custom-active" rel="memberReviews" ><i class="fa fa fa-comments-o"></i> Reviews</router-link>                                            
                                                </li>
                                                
                                                <li class="p-2">
                                                    <router-link :to="{name: 'members-messages',params: {username: username}}" class="nav-link custom-active" rel="memberMessages" ><i class="fa fa fa-comments-o"></i> Messages</router-link>                                            
                                                </li>                                                
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!----------------- End Member Header--------------------->
                </div>
                <div class="col-sm-12">
                    <div class="iq-card">
                        <div class="iq-card-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <ul class="nav nav-pills basic-info-items list-inline d-block p-0 m-0">
                                        <li>
                                            <a v-if="membersDetais.memberType === 'family_parent_member'"  v-on:click="GetMemberAbout()" class="nav-link active" data-toggle="pill" href="#details">About</a>
                                            <a v-if="membersDetais.memberType === 'care_provider_member'" v-on:click="GetMemberAbout()" class="nav-link active" data-toggle="pill" href="#details">About</a>
                                            <a v-if="membersDetais.memberType === 'agency_member'" class="nav-link active" data-toggle="pill" href="#details">About</a>
                                            <a v-else ></a>
                                        </li>
                                        
                                    </ul>
                                </div>
                                <div class="col-md-9 pl-4">
                                    <div class="tab-content">
                                        <div class="tab-pane fade active show" id="details" role="tabpanel">
                                            <h6 class="mb-3">About</h6>
                                            <hr>
                                            <div v-if="membersDetais.memberType === 'family_parent_member'" class="row">
                                                <div v-show="loader" class="row text-center" >
                                                    <span style="color:rgb(229, 142, 178);">
                                                        <span class="spinner-grow spinner-grow-md"></span>
                                                        <span class="spinner-grow spinner-grow-md"></span>
                                                        <span class="spinner-grow spinner-grow-md"></span>
                                                    </span>
                                                </div>
                                                <div class="col-6 pb-2"><h6 class="aboutHeadings">Currently seeking new provider to work with?</h6></div>
                                                <div class="col-6 pb-2">
                                                    <p class="mb-0">
                                                        <span v-if="Bios.currently_seeking_provider_work === 'Yes'" style="background-color: #a5dc86;padding: 5px 20px;border: 1px solid rgba(0, 0, 0, 0.2);border-radius: 20px;color: #fff;">
                                                            {{Bios.currently_seeking_provider_work}}
                                                        </span>
                                                        <span v-else-if="Bios.currently_seeking_provider_work === 'No'" style="background-color: red;padding: 5px 20px;border: 1px solid rgba(0, 0, 0, 0.2);border-radius: 20px;color: #fff;">
                                                            {{Bios.currently_seeking_provider_work}}
                                                        </span>
                                                        <span v-else>Null</span>
                                                    </p>
                                                </div>
                                                <div class="col-6 pb-2"><h6 class="aboutHeadings">Name</h6></div>
                                                <div class="col-6 pb-2"><p class="mb-0">{{userInfoss.name}}</p></div>
                                                <div class="col-6 pb-2"><h6 class="aboutHeadings">What city do you live in?</h6></div>
                                                <div class="col-6 pb-2"><p class="mb-0">{{parentLives}}</p></div>
                                                <div class="col-6 pb-2"><h6 class="aboutHeadings">Type(s) of care you are looking for</h6></div>
                                                <div class="col-6 pb-2"><p class="mb-0">{{parentLookingFor}}</p></div>
                                                <div class="col-6 pb-2"><h6 class="aboutHeadings">Where are you looking for care opportunities?</h6></div>
                                                <div class="col-6 pb-2"><p class="mb-0">{{parentOpportunities}}</p></div>
                                                <div class="col-6 pb-2"><h6 class="aboutHeadings">Desired hourly pay rate range?</h6></div>
                                                <div class="col-6 pb-2"><p class="mb-0">${{parentMinRateRange}} - ${{parentMaxRateRange}}</p></div>
                                                <div class="col-6 pb-2"><h6 class="aboutHeadings">About My Family</h6></div>
                                                <div class="col-6 pb-2"><p class="mb-0">{{parentAboutfamily}}</p></div>
                                                <div class="col-6 pb-2"><h6 class="aboutHeadings">Number of children that you need child care for?</h6></div>
                                                <div class="col-6 pb-2"><p class="mb-0">{{parentChildrenCare}}</p></div>
                                                <div class="col-6 pb-2"><h6 class="aboutHeadings">Ages of child(ren) that need child care?</h6></div>
                                                <div class="col-6 pb-2"><p class="mb-0">{{parentChildrenAge}}</p></div>
                                                <div class="col-6 pb-2"><h6 class="aboutHeadings">Preference on care provider experience level?</h6></div>
                                                <div class="col-6 pb-2"><p class="mb-0">{{parentExperienceProvider}}</p></div>
                                                <div class="col-6 pb-2"><h6 class="aboutHeadings">Does your family/children have any allergies or special needs that care providers should be aware of?</h6></div>
                                                <div class="col-6 pb-2"><p class="mb-0">{{parentSpecialNeed}}</p></div>

                                                <div class="row" v-if="parentSpecialNeed=='Yes'">
                                                    <div class="col-6 pb-2"><h6 class="aboutHeadings">Please share any details regarding allergies or special needs that prospective families should be aware of</h6></div>
                                                    <div class="col-6 pb-2 pl-4"><p class="mb-0">{{SpecialNeedsExtra}}</p></div>
                                                </div>

                                                <div class="col-6 pb-2"><h6 class="aboutHeadings">Are you seeking a care provider that speaks languages other than English?</h6></div>
                                                <div class="col-6 pb-2"><p class="mb-0">{{parentLanguages}}</p></div>
                                                <div class="row" v-if="parentLanguages=='Yes'">
                                                    <div class="col-6 pb-2"><h6 class="aboutHeadings">Select all languages that you would like the care provider to be able to use conversationally</h6></div>
                                                    <div class="col-6 pb-2 pl-4"><p class="mb-0">{{ParentSpeekLanguage}}</p></div>
                                                </div>
                                                <div class="col-6 pb-2"><h6 class="aboutHeadings">Do you prefer a care provider who drives?</h6></div>
                                                <div class="col-6 pb-2"><p class="mb-0">{{parentDrive}}</p></div>
                                                <div class="row" v-if="parentDrive=='Yes'">
                                                    <div class="col-6 pb-2"><h6 class="aboutHeadings">Do you prefer to have the care provider drive their own vehicle or one of your vehicles?</h6></div>
                                                    <div class="col-6 pb-2 pl-4"><p class="mb-0">{{parentDriveProvide}}</p></div>
                                                </div>
                                            </div>
                                            <div v-if="membersDetais.memberType === 'care_provider_member'" class="row">
                                                <div v-show="loader" class="row text-center" >
                                                    <span style="color:rgb(229, 142, 178);">
                                                        <span class="spinner-grow spinner-grow-md"></span>
                                                        <span class="spinner-grow spinner-grow-md"></span>
                                                        <span class="spinner-grow spinner-grow-md"></span>
                                                    </span>
                                                </div>
                                                <div class="col-6 pb-2"><h6 class="aboutHeadings">Currently seeking new families to work with?</h6></div>
                                                <div class="col-6 pb-2">
                                                    <p class="mb-0">
                                                        <span v-if="Bios.currently_seeking_provider_work === 'Yes'" style="background-color: #a5dc86;padding: 5px 20px;border: 1px solid rgba(0, 0, 0, 0.2);border-radius: 20px;color: #fff;">
                                                            {{Bios.currently_seeking_provider_work}}
                                                        </span>
                                                        <span v-else-if="Bios.currently_seeking_provider_work === 'No'" style="background-color: red;padding: 5px 20px;border: 1px solid rgba(0, 0, 0, 0.2);border-radius: 20px;color: #fff;">
                                                            {{Bios.currently_seeking_provider_work}}
                                                        </span>
                                                        <span v-else>Null</span>
                                                    </p>
                                                </div>
                                                <div class="col-6 pb-2"><h6 class="aboutHeadings">Name</h6></div>
                                                <div class="col-6 pb-2"><p class="mb-0">{{userInfoss.name}}</p></div>
                                                <div class="col-6 pb-2"><h6 class="aboutHeadings">Type(s) of care you are looking for</h6></div>
                                                <div class="col-6 pb-2"><p class="mb-0">{{parentLookingFor}}</p></div>
                                                <div class="col-6 pb-2"><h6 class="aboutHeadings">Where are you looking for care opportunities?</h6></div>
                                                <div class="col-6 pb-2"><p class="mb-0">{{parentOpportunities}}</p></div>
                                                <div class="col-6 pb-2"><h6 class="aboutHeadings">Desired hourly pay rate range?</h6></div>
                                                <div class="col-6 pb-2"><p class="mb-0" v-if="parentMinRateRange != ''">${{parentMinRateRange}} - ${{parentMaxRateRange}}</p></div>
                                                <div class="col-6 pb-2"><h6 class="aboutHeadings">What age groups do you have experience providing child care for?</h6></div>
                                                <div class="col-6 pb-2"><p class="mb-0">{{providerChildExperience}}</p></div>
                                                <div class="col-6 pb-2"><h6 class="aboutHeadings">How many years of child care experience do you have?</h6></div>
                                                <div class="col-6 pb-2"><p class="mb-0">{{Bios.providerExperience}}</p></div>
                                                <div class="col-6 pb-2"><h6 class="aboutHeadings">Number of children you will care for at one time?</h6></div>
                                                <div class="col-6 pb-2"><p class="mb-0">{{Bios.providerCareOneTime}}</p></div>
                                                <div class="col-6 pb-2"><h6 class="aboutHeadings">About Me</h6></div>
                                                <div class="col-6 pb-2"><p class="mb-0" v-if="!!Bios.aboutMyfamily">{{Bios.aboutMyfamily}}</p><p class="mb-0" v-else>Null</p></div>

                                                <div class="col-6 pb-2"><h6 class="aboutHeadings">Do you have experience caring for children with special needs?</h6></div>
                                                <div class="col-6 pb-2"><p class="mb-0">{{Bios.ChildSpecialNeeds}}</p></div>

                                                <div class="row" v-if="Bios.ChildSpecialNeeds=='Yes'">
                                                    <div class="col-6 pb-2"><h6 class="aboutHeadings">Please share any details regarding allergies or special needs that prospective families should be aware of</h6></div>
                                                    <div class="col-6 pb-2 pl-4"><p class="mb-0">{{Bios.SpecialNeedsExtra}}</p></div>
                                                </div>

                                                <div class="col-6 pb-2"><h6 class="aboutHeadings">Do you speak any other language(s) besides English?</h6></div>
                                                <div class="col-6 pb-2"><p class="mb-0">{{Bios.providerSpeaksLanguages}}</p></div>
                                                <div class="row" v-if="Bios.providerSpeaksLanguages=='Yes'">
                                                    <div class="col-6 pb-2"><h6 class="aboutHeadings">Select all languages that you can use conversationally?</h6></div>
                                                    <div class="col-6 pb-2 pl-4"><p class="mb-0">{{ParentSpeekLanguage}}</p></div>
                                                </div>
                                                <div class="col-6 pb-2"><h6 class="aboutHeadings">Are you willing to transport children to school, activities, etc.?</h6></div>
                                                <div class="col-6 pb-2"><p class="mb-0">{{Bios.providerDrives}}</p></div>
                                                <div class="row">
                                                    <div class="col-6 pb-2"><h6 class="aboutHeadings">How do you transport children you are caring for?</h6></div>
                                                    <div class="col-6 pb-2 pl-4"><p class="mb-0">{{providerTransportSchoolActivities}}</p></div>
                                                </div>                                
                                                <div class="col-6 pb-2"><h6 class="aboutHeadings">What days of the week do you need or are offering care?</h6></div>
                                                <div class="col-6 pb-2"><p class="mb-0">{{availability}}</p></div>
                                            </div>
                                            <div v-if="membersDetais.memberType === 'agency_member'" class="row">
                                                <div v-show="loader" class="row text-center" > 
                                                    <span style="color:rgb(229, 142, 178);">
                                                        <span class="spinner-grow spinner-grow-md"></span>
                                                        <span class="spinner-grow spinner-grow-md"></span>
                                                        <span class="spinner-grow spinner-grow-md"></span>
                                                    </span>
                                                </div>
                                                <div class="col-6 pb-2"><h6 class="aboutHeadings">Name</h6></div>
                                                <div class="col-6 pb-2"><p class="mb-0">{{userInfoss.name}}</p></div>
                                            </div>
                                            <div v-else class="row"></div>
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
export default {
    name: "MemberAbout",
    props: { 
        username: String         
    },   
    data() {
        return {  
            isLoggedIn: false,
            loader:true,
            userInfoss :[],
            membersDetais:[],
            TypeOfCareLooking: '',
            LookingForCareOpportunities:'',
            rateMinRange:"",
            rateMaxRange:"",
            providerChildExperience: '',
            providerTotalExperience: "",
            providerCareOneTime: "",
            aboutMe: "",
            providerKonwLanguage: "",
            providerTransportSchoolActivities: "",
            availability:"",
            SpeekLanguage:"",
            providerTransPort:"",           

            Bios:[],
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
            
            usersIcon:true,
            LoaderIcon:false,
            statusVisible:false,
            friendRequestBtn:'',
            friendRequestStatus:'',
            ConfirmRequestLoader:false,
            statusVisibleConfim:false
        }
    },
    methods: {
        GetMemberAbout(){
            axios.get(`/api/GetMemberAbout/${this.username}`).then((response) => {                
                this.loader = false;
                if(response.data.userInfos.memberType=='family_parent_member')
                {                    
                    this.Bios = response.data.userBio;
                    this.membersDetais = response.data.userInfos;
                    this.userInfoss = response.data.userInfos;
                    this.parentLives = response.data.userBio.live_in;
                    this.parentLookingFor = response.data.parentTypeOfCareLooking; 
                    this.parentOpportunities = response.data.parentCareOpportunities; 
                    this.parentMinRateRange = response.data.userBio.minRange;
                    this.parentMaxRateRange = response.data.userBio.maxRange;
                    this.parentAboutfamily = response.data.userBio.aboutMyfamily;
                    this.parentChildrenCare = response.data.userBio.numnerOfchild;
                    this.parentChildrenAge = response.data.userBio.childAge;
                    this.parentExperienceProvider = response.data.userBio.providerExperience;
                    this.parentSpecialNeed = response.data.userBio.ChildSpecialNeeds;
                    this.SpecialNeedsExtra = response.data.userBio.SpecialNeedsExtra,
                    this.parentLanguages = response.data.userBio.providerSpeaksLanguages;
                    this.ParentSpeekLanguage  = response.data.parentSpeaksLanguages;
                    this.parentDrive = response.data.userBio.providerDrives;
                    this.parentDriveProvide = response.data.userBio.parentsVehicle;
                } else if(response.data.userInfos.memberType=='care_provider_member'){                    
                    this.Bios = response.data.userBio;
                    this.membersDetais = response.data.userInfos;
                    this.userInfoss = response.data.userInfos;
                    this.parentLives = response.data.userBio.live_in;
                    this.parentLookingFor = response.data.parentTypeOfCareLooking; 
                    this.parentOpportunities = response.data.parentCareOpportunities; 
                    this.parentMinRateRange = response.data.userBio.minRange;
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
                    this.providerTransportSchoolActivities = response.data.providerTransportSchoolActivities;
                    this.availability = response.data.availability;
                } else {
                }
            }).catch((err) => console.error(err));
        },
        sendFirendRequest(username){
            this.usersIcon = false;
            this.LoaderIcon = true;
            axios.post(`/api/SendfriendRequest`, {
                RequestSendTo: username
            }).then((response) => {
                this.resquestSend = response.data.resquestSend;
                this.usersIcon = true;
                this.LoaderIcon = false;
                this.statusVisible = true,                
                setTimeout(() => this.statusVisible = false, 3000);
                this.CheckMemberFriend(this.username);                
            }).catch(error => {})
        },
        CheckMemberFriend(username){            
            axios.post(`/api/CheckMemberAlradyFriend`, {
                RequestUsername: username
            }).then((response) => {
                this.friendRequestBtn = response.data.checkFriend;
                this.friendRequestStatus = response.data.friendRequestStatus;                
            }).catch(error => {
            })            
        },
        friendRequestConfirm(senderID){
            this.ConfirmRequestLoader= true;
            axios.post(`/api/friendRequestConfirm`, {
                RequestSenderID: senderID
            }).then((response) => {
                //console.log(response.data.resquestCancel);
                this.resquestStatus = response.data.resquestConfirm;
                this.statusVisibleConfim= true,
                this.ConfirmRequestLoader= false; 
                setTimeout(() => this.statusVisibleConfim = false, 3000); 
                setTimeout(() => this.resquestStatus = '', 3000);              
                this.CheckMemberFriend(this.username);                              
            }).catch(error => {
            })
        },
        UnFirend(requestIDs, requestSendTo){
            this.LoaderIcon = true;            
            axios.post(`/api/UnFriend`, {
                UnfriendUser: requestIDs,
                RequestUsername: requestSendTo
            }).then((response) => {                
                this.LoaderIcon = false;
                this.CheckMemberFriend(response.data.getMemberDD);  
            }).catch(error => {})   
        }
     },
    created() {        
        if (window.Laravel.isLoggedin) {
            this.isLoggedIn = true
        } 
        if(window.Laravel.user) { 
            this.Auth_id = window.Laravel.user.id,
            this.memberType = window.Laravel.user.memberType                
        }  
        // axios.get(`/api/memberProfile/${this.username}`).then((response) => {
        //     this.membersDetais = response.data.userDetails                     
        // }).catch((err) => console.error(err));  
        this.GetMemberAbout();    
        this.CheckMemberFriend(this.username);      
    },
    updated(){                       
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
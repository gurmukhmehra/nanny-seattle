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
                                                    <span class="provider_count_child" title="Number of children will provide care for at one time">{{Bios.providerCareOneTime}}</span>
                                                </li>
                                                <li v-if="membersDetais.memberType === 'agency_member'">
                                                    <img :src="'/public/uploads/Agency-Icon.png'" title="Family/Parent Member" class="member_icons"/>
                                                </li>
                                                <li class="text-center pl-3 mb-2" v-if="friendRequestBtn.senderUserID!=Auth_id && friendRequestBtn.requestStatus=='pending'">
                                                    <a v-on:click="friendRequestConfirm(friendRequestBtn.id)" class="custom_yellow_btn">
                                                        <span  v-show="ConfirmRequestLoader" class="spinner-border spinner-border-sm text-white" role="status"></span>
                                                        Accpet
                                                    </a>
                                                </li>
                                                <li class="text-center pl-3 mb-2" v-else-if="friendRequestBtn.requestSendTo!=Auth_id && friendRequestBtn.requestStatus=='pending'"></li>
                                                <li class="text-center pl-3 mb-2" v-else-if="friendRequestBtn.requestStatus=='pending' && friendRequestBtn.requestSendTo!=Auth_id">
                                                    <a v-on:click="friendRequestConfirm(friendRequestBtn.id)" class="custom_yellow_btn">
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
                        <div class="iq-card-body pt-0">
                            <div class="friend-list-tab mt-2">
                                <ul class="nav nav-pills d-flex align-items-center justify-content-left friend-list-items p-0 mb-2">
                                    <li>
                                        <a v-on:click="MyReviewsList(username)" class="nav-link active" data-toggle="pill" href="#all-reviews-list">Reviews </a>
                                    </li>
                                    <li>
                                        <a class="nav-link" data-toggle="pill" href="#add-review">Add Review </a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane fade active show" id="all-reviews-list" role="tabpanel">
                                        <div class="iq-card-body p-0">
                                            <div class="row mt-4">
                                                <hr>
                                                <div class="row" v-for="myfrindList in MemberReviewsList" :key="MemberReviewsList.id">
                                                    <div class="col-md-2 text-center">
                                                        <img v-if="!!myfrindList.fromUserDetail.profileImage" :src="'/public/uploads/profileImage/' + myfrindList.fromUserDetail.profileImage" alt="profile-img" class="rounded-circle" style="height: 100px;width: 80%;"/>
                                                        <img v-else src="https://cdn.pixabay.com/photo/2015/03/04/22/35/avatar-659652__340.png" alt="profile-img" class="rounded-circle" style="height: 100px;width: 80%;"/>
                                                    </div>
                                                    <div class="col-md-6 mt-4">
                                                        <h5 style="color:#e58eb2;">{{myfrindList.fromUserDetail.name}}</h5>
                                                        <span class="score" style="float: left;margin-right: 10px;">
                                                            <div class="score-wrap">
                                                                <span class="stars-active" v-if="myfrindList.rating=='1'">                                                                        
                                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                                    <i class="fa fa-star-o" aria-hidden="true"></i>
                                                                    <i class="fa fa-star-o" aria-hidden="true"></i>
                                                                    <i class="fa fa-star-o" aria-hidden="true"></i>
                                                                    <i class="fa fa-star-o" aria-hidden="true"></i>
                                                                </span>
                                                                <span class="stars-active" v-else-if="myfrindList.rating=='2'">                                                                        
                                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                                    <i class="fa fa-star-o" aria-hidden="true"></i>
                                                                    <i class="fa fa-star-o" aria-hidden="true"></i>
                                                                    <i class="fa fa-star-o" aria-hidden="true"></i>
                                                                </span>
                                                                <span class="stars-active" v-else-if="myfrindList.rating=='3'">                                                                        
                                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                                    <i class="fa fa-star-o" aria-hidden="true"></i>
                                                                    <i class="fa fa-star-o" aria-hidden="true"></i>
                                                                </span>
                                                                <span class="stars-active" v-else-if="myfrindList.rating=='4'">                                                                        
                                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                                    <i class="fa fa-star-o" aria-hidden="true"></i>
                                                                </span>
                                                                <span class="stars-active" v-else-if="myfrindList.rating=='5'">                                                                        
                                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                                </span>
                                                                <span class="stars-active" v-else>                                                                        
                                                                    <i class="fa fa-star-o" aria-hidden="true"></i>
                                                                    <i class="fa fa-star-o" aria-hidden="true"></i>
                                                                    <i class="fa fa-star-o" aria-hidden="true"></i>
                                                                    <i class="fa fa-star-o" aria-hidden="true"></i>
                                                                    <i class="fa fa-star-o" aria-hidden="true"></i>
                                                                </span>
                                                            </div>
                                                        </span>
                                                        <p>{{ moment(myfrindList.created_at).format("MMM YYYY") }}</p>
                                                    </div>
                                                    <p v-html="myfrindList.review" class="mt-3"></p>
                                                </div>                                                
                                                <div v-if="reviewsNotfound != ''" class="text-danger text-center">{{reviewsNotfound}}</div>
                                                <div v-show="loader" class="row mt-4 text-center" >
                                                    <span style="color:rgb(229, 142, 178);">
                                                        <span class="spinner-grow spinner-grow-md"></span>
                                                        <span class="spinner-grow spinner-grow-md"></span>
                                                        <span class="spinner-grow spinner-grow-md"></span>
                                                    </span>
                                                </div>                                
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="add-review" role="tabpanel">
                                        <div class="iq-card-body p-0">
                                            <div class="row mt-4">
                                                <hr>
                                                <div class="nf-form-layout nf-form-ct-layout">
                                                    <div class="nf-form-fields">
                                                        <div class="nf-mp-body">
                                                            <div class="row">	
                                                                <label class="mt-3 mb-3" style="font-size: 16px;">Fill in details to submit Review <span class="req-symbol text-danger">*</span> </label>
                                                                <textarea class="forms-field" v-model="review"></textarea>
                                                                <input type="hidden" :value="membersDetais.id">
                                                            </div>
                                                            <div class="row">
                                                                <label class="mt-3 mb-0" style="font-size: 16px;">Please Rate Your Connection/Interaction With This Member <span class="req-symbol text-danger">*</span></label>
                                                                <div class="rating mb-3" style="width:15%;">
                                                                    <input type="radio" name="rating" v-model="rating" :value="5" id="5"><label for="5">☆</label>
                                                                    <input type="radio" name="rating" v-model="rating" :value="4" id="4"><label for="4">☆</label>
                                                                    <input type="radio" name="rating" v-model="rating" :value="3" id="3"><label for="3">☆</label>
                                                                    <input type="radio" name="rating" v-model="rating" :value="2" id="2"><label for="2">☆</label>
                                                                    <input type="radio" name="rating" v-model="rating" :value="1" id="1"><label for="1">☆</label>
                                                                </div>
                                                            </div>                                                
                                                            <div class="row">
                                                                <div class="col-md-2">
                                                                    <button class="custom_yellow_btn" v-on:click="submitReview()">
                                                                        <span v-if="Messageloader" class="spinner-border spinner-border-sm" role="status"></span>
                                                                            Submit
                                                                    </button>
                                                                </div>	
                                                                <div class="col-md-10">
                                                                    <p class="text-danger" style="font-size: 18px;margin-top: 5px;">{{ error_message }}</p>
                                                                    <p class="text-success" style="font-size: 18px;margin-top: 5px;">{{ messageStatu }}</p>
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
                    </div>
                </div>
            </div>
        </section>
    </main>
</template>

<script>
const axios = require('axios');
import moment from "moment"; 
export default {
    name: "MemberReviews",
    props: { 
        username: String          
    },    
    data() {
        return {
            moment: moment,  
            isLoggedIn: false,
            membersDetais:[],
            Messageloader:false,
            review:'',
            rating:'',
            error_message:"",
            messageStatu:"",
            loader:true,
            reviewsNotfound:"",
            MemberReviewsList:[],
            Bios:[],
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
        MyReviewsList(memberUsername){            
            this.review ='',
            this.rating =''
            axios.get(`/api/MemberReviewList/${memberUsername}`).then((response) => {
                this.loader = false;  
                if(response.data.no_review){
                    this.reviewsNotfound = response.data.no_review;
                }else{
                    this.MemberReviewsList = response.data.reviewList;
                }                     
            }).catch((err) => console.error(err)); 
        },
        submitReview(){
            this.Messageloader = true; 
            axios.post(`/api/SumbitReview`, {
                reviewToUserID :this.membersDetais.id,
                review :this.review,
                rating :this.rating
            }).then((response) => {
                this.Messageloader = false;
                this.review ='';
                this.rating ='';
                this.messageStatu = response.data.MessageStatus;
                setTimeout(() => this.messageStatu = '', 2000);
            }).catch(error => {
                this.Messageloader = false;
                this.error_message = error.response.data.error.review[0]
                setTimeout(() => this.error_message = '', 3000); 
            }); 
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
                setTimeout(() => this.CheckMemberFriend(this.username), 3000);                              
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
        GetMemberAbout(){
            axios.get(`/api/GetMemberAbout/${this.username}`).then((response) => {                
                this.loader = false;
                if(response.data.userInfos.memberType=='family_parent_member')
                {                    
                    this.Bios = response.data.userBio;                    
                } else if(response.data.userInfos.memberType=='care_provider_member'){                    
                    this.Bios = response.data.userBio;                    
                } else {
                }
            }).catch((err) => console.error(err));
        }
     },
    created() {        
        if (window.Laravel.isLoggedin) {
        } 
        if(window.Laravel.user) { 
            this.Auth_id = window.Laravel.user.id        
        }  
        axios.get(`/api/memberProfile/${this.username}`).then((response) => {
            this.membersDetais = response.data.userDetails                     
        }).catch((err) => console.error(err));

        axios.get(`/api/MemberReviewList/${this.username}`).then((response) => {
            this.loader = false;  
            if(response.data.no_review){
                this.reviewsNotfound = response.data.no_review;
            }else{
                this.MemberReviewsList = response.data.reviewList;
            }                      
        }).catch((err) => console.error(err));        
        this.CheckMemberFriend(this.username); 
        this.GetMemberAbout();         
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
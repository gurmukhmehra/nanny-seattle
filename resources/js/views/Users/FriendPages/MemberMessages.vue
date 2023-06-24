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
                            <div class="chat-head">
                                <header class="d-flex justify-content-between align-items-center bg-white pt-3 pl-3 pr-3 pb-3">
                                    <div class="d-flex align-items-center">
                                        <div class="sidebar-toggle">
                                            <i class="ri-menu-3-line"></i>
                                        </div>
                                        <div class="avatar chat-user-profile m-0 mr-3">
                                            <img v-if="!!membersDetais.profileImage" :src="'/public/uploads/profileImage/' + membersDetais.profileImage" alt="profile-img" class="avatar-50" />
                                            <img v-else src="https://cdn.pixabay.com/photo/2015/03/04/22/35/avatar-659652__340.png" alt="profile-img" class="avatar-50" />                                                 
                                        </div>
                                        <h5 class="mb-0">{{ membersDetais.name }}</h5>
                                    </div>
                                </header>    
                            </div>  
                            <div v-for="(FriendsChatMsg,index) in MembersThreadsMessages" :key="FriendsChatMsg.id" :index="index" class="chat-content scroller" style="background-color:rgba(215, 213, 212, 0.8);padding-top: 0px;padding-bottom: 0px;">
                                <div class="chat">
                                    <p v-if="FriendsChatMsg.sender_id == id">
                                        <div class="chat-user">
                                            <a class="avatar m-0">                                                                    
                                                <img v-if="!!profileImage" :src="'/public/uploads/profileImage/' + profileImage" alt="avatar" class="avatar-35" style="width:90px;float: left;">
                                                <img v-else src="https://cdn.pixabay.com/photo/2015/03/04/22/35/avatar-659652__340.png" alt="avatar" class="avatar-35" style="width:90px;float: left;">
                                                <span class="chat-time mt-0" style="font-weight: bold;">You</span>
                                                <span class="chat-time mt-0">{{ moment(FriendsChatMsg.created_at).fromNow() }}</span>
                                            </a>                                                                
                                        </div>
                                        <div class="chat-detail pt-3" v-if="FriendsChatMsg.MessageUsersDetails.id == id && FriendsChatMsg.sender_id != 0">
                                            <div class="chat-message" style="background-color: #fff; color: #333;box-shadow:none;text-align: left;width:100%;">
                                                <p v-if="FriendsChatMsg.sender_id == id" v-html="FriendsChatMsg.message" style="padding-left:20px;"></p>
                                            </div>
                                        </div>
                                    </p>                                    
                                    <p v-if="FriendsChatMsg.MessageUsersDetails.id != id" style="clear: both;padding-top: 20px;">
                                        <div class="chat chat-left">
                                            <div class="chat-user">
                                                <a class="avatar m-0">
                                                    <img v-if="!!FriendsChatMsg.MessageUsersDetails.profileImage" :src="'/public/uploads/profileImage/' + FriendsChatMsg.MessageUsersDetails.profileImage" alt="avatar" class="avatar-35" style="width:90px;float: left;">
                                                    <img v-else src="https://cdn.pixabay.com/photo/2015/03/04/22/35/avatar-659652__340.png" alt="avatar" class="avatar-35" style="width:90px;float: left;">
                                                    <span class="chat-time mt-0" style="font-weight: bold;">{{FriendsChatMsg.MessageUsersDetails.name}}</span>
                                                    <span class="chat-time mt-0">{{ moment(FriendsChatMsg.created_at).fromNow() }}</span>
                                                </a>                                                
                                            </div>
                                            <div class="chat-detail pt-3">
                                                <div class="chat-message" style="background-color: #ccc; color: #333;width:100%;">                                                    
                                                    <p v-html="FriendsChatMsg.message"></p>
                                                </div>
                                            </div>
                                        </div>
                                    </p>                                                            
                                </div>
                            </div>
                            <div class="chat-footer p-3 bg-white">
                                <span class="d-flex align-items-center">
                                    <input type="text" class="form-control mr-3" v-model="newMessage" @keyup.enter="sendPrivateMessage(membersDetais.id,MembersThreadsMessages[0].thread_id)" placeholder="Type your message" style="border: 1px solid rgb(51, 51, 51);">                                        
                                    <button class="custom_yellow_btn d-flex align-items-center p-2" v-on:click="sendPrivateMessage(membersDetais.id,MembersThreadsMessages[0].thread_id)">
                                        <i v-if="buttonIcon" class="fa fa-paper-plane-o" aria-hidden="true"></i>
                                        <span v-if="Messageloader" class="spinner-border spinner-border-sm" role="status"></span>
                                        <span class="d-none d-lg-block ml-1">Send</span>                                                               
                                    </button>                                                            
                                </span> 
                                <small class="text-danger">{{ error_message }} </small>
                                <small class="text-success">{{ messageStatu }} </small>                                                       
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
            MembersThreadsMessages:[],
            Bios:[],
            usersIcon:true,
            LoaderIcon:false,
            statusVisible:false,
            friendRequestBtn:'',
            friendRequestStatus:'',
            ConfirmRequestLoader:false,
            statusVisibleConfim:false,
            newMessage: '',
            buttonIcon:true,
            Messageloader: false, 
            error_message: "",
            messageStatu: "",
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
        MessageThreada(){
            axios.get(`/api/GetMemberPrivateMessages/${this.username}`).then((response) => {            
                //this.friendRequestBtn = response.data.checkFriend;
                this.MembersThreadsMessages = response.data.PrivateMessageList;              
            }).catch((err) => console.error(err)); 
        }
        ,
        sendPrivateMessage(MessageToUser,MessageTreadID) {
            this.buttonIcon = true;
            this.Messageloader = true;            
            if(window.Laravel.user) {
                axios.post(`/api/PrivateMessageSendToUser`, {
                    sendMessageToUser : MessageToUser,
                    sendMessageTreadsID : MessageTreadID,
                    message : this.newMessage,
                }).then((response) => {
                    //console.log('res', response.data);
                    this.newMessage = '';                               
                    this.Messageloader = false;
                    this.buttonIcon = true;
                    this.newMessage ='';
                    this.messageStatu = response.data.MessageStatus;
                    setTimeout(() => this.messageStatu = '', 2000);
                    this.MessageThreada();
                }).catch(error => {
                    this.Messageloader = false;
                    this.buttonIcon = true;
                    this.error_message = error.response.data.error.message,
                    setTimeout(() => this.error_message = '', 3000);
                });
            }
        }
     },
     async created() {        
        if (window.Laravel.isLoggedin) {
            this.id = window.Laravel.user.id,
            this.Auth_id = window.Laravel.user.id,
            this.name = window.Laravel.user.name,
            this.profileImage = window.Laravel.user.profileImage
        } 
        this.GetMemberAbout();
        this.CheckMemberFriend(this.username);        
        this.MessageThreada();
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
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
                                <h5>Friends List</h5>
                                <hr>
                                <div v-show="loader" class="row text-center">
                                    <span style="color:rgb(229, 142, 178);">
                                        <span class="spinner-grow spinner-grow-md"></span>
                                        <span class="spinner-grow spinner-grow-md"></span>
                                        <span class="spinner-grow spinner-grow-md"></span>
                                    </span>
                                </div>                                
                                <div class="row text-center"> 
                                    <div class="col-md-4" v-for="myfrindList in myFriendsLists" :key="myFriendsLists.id" >                                   
                                        <span v-if="myfrindList.username!=username">
                                            <div class="iq-card">
                                                <div class="iq-card-body profile-page p-0">
                                                    <div class="profile-header-image">
                                                        <div v-if="myfrindList.username!=Auth_userName" class="cover-container">
                                                            <router-link :to="{name: 'members-about',params: {username: myfrindList.username}}">
                                                                <img v-if="!!myfrindList.ProfileCover" :src="'/public/uploads/coverImages/'+myfrindList.id +'/cover-image/' + myfrindList.ProfileCover" alt="profile-bg" class="rounded img-fluid w-100">
                                                                <img v-else src="https://templates.iqonic.design/socialv/bs5/html/dist/assets/images/page-img/profile-bg2.jpg" alt="profile-bg" class="rounded img-fluid w-100">
                                                            </router-link>
                                                        </div>
                                                        <div v-else class="cover-container">
                                                            <router-link to="/UserDashboard">
                                                                <img v-if="!!myfrindList.ProfileCover" :src="'/public/uploads/coverImages/'+myfrindList.id +'/cover-image/' + myfrindList.ProfileCover" alt="profile-bg" class="rounded img-fluid w-100">
                                                                <img v-else src="https://templates.iqonic.design/socialv/bs5/html/dist/assets/images/page-img/profile-bg2.jpg" alt="profile-bg" class="rounded img-fluid w-100">
                                                            </router-link>
                                                        </div>
                                                        <div class="profile-info p-2">
                                                            <div class="user-detail">
                                                                <div class="d-flex flex-wrap justify-content-between align-items-start">
                                                                    <div class="profile-detail d-flex w-100">
                                                                        <div v-if="myfrindList.username!=Auth_userName" class="profile-img pr-4">
                                                                            <router-link :to="{name: 'members-about',params: {username: myfrindList.username}}">                                                                  
                                                                                <img v-if="!!myfrindList.profileImage" :src="'/public/uploads/profileImage/' + myfrindList.profileImage" alt="profile-img" class="avatar-130 img-fluid" />
                                                                                <img v-else src="https://cdn.pixabay.com/photo/2015/03/04/22/35/avatar-659652__340.png" alt="profile-img" class="avatar-130 img-fluid" />
                                                                            </router-link>
                                                                        </div> 
                                                                        <div v-else class="profile-img pr-4">
                                                                            <router-link to="/UserDashboard">                                                                  
                                                                                <img v-if="!!myfrindList.profileImage" :src="'/public/uploads/profileImage/' + myfrindList.profileImage" alt="profile-img" class="avatar-130 img-fluid" />
                                                                                <img v-else src="https://cdn.pixabay.com/photo/2015/03/04/22/35/avatar-659652__340.png" alt="profile-img" class="avatar-130 img-fluid"/>
                                                                            </router-link>
                                                                        </div> 
                                                                        <div class="user-data-block user-data-block text-left">
                                                                            <h6 v-if="myfrindList.username!=Auth_userName" class="mb-0">
                                                                                <router-link :to="{name: 'members-about',params: {username: myfrindList.username}}" style="font-size:15px;">
                                                                                    {{myfrindList.name}}
                                                                                </router-link>
                                                                            </h6>
                                                                            <h6 v-else class="mb-0">
                                                                                <router-link to="/UserDashboard" style="font-size:15px;">
                                                                                    {{myfrindList.name}}
                                                                                </router-link>
                                                                            </h6>
                                                                            <p class="mb-0">@{{myfrindList.username}} <span v-if="myfrindList.username==Auth_userName" class="text-success">(You)</span></p>
                                                                        </div>                                                                       
                                                                    </div>
                                                                </div>
                                                            </div>                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </span>
                                    </div>
                                    <div v-if="no_friends != ''" class="text-danger text-center">{{no_friends}}</div>
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
    name: "MemberfriendsList",
    props: { 
        username: String          
    },   
    data() {
        return {  
            isLoggedIn: false, 
            membersDetais:[],
            loader:true,
            myFriendsLists:[],
            Bios:[],
            no_friends:'',            
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
        MyAllFriend(){                     
            axios.get(`/api/memberfriendsList/${this.username}`).then((response) => {
                this.loader = false;
                this.myFriendsLists = response.data.senderList;
                this.no_friends= response.data.nofriends;                     
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
            this.isLoggedIn = true
        } 
        if(window.Laravel.user) {
            this.Auth_id = window.Laravel.user.id,
            this.Auth_userName = window.Laravel.user.username                  
        } 
        axios.get(`/api/memberProfile/${this.username}`).then((response) => {
            this.membersDetais = response.data.userDetails                     
        }).catch((err) => console.error(err)); 
        this.MyAllFriend();
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
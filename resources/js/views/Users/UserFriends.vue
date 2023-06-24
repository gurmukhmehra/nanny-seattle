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
                                <div class="friend-list-tab mt-2">
                                    <ul class="nav nav-pills d-flex align-items-center justify-content-left friend-list-items p-0 mb-2">
                                        <li>
                                            <a v-on:click="MyAllFriend()" class="nav-link active" data-toggle="pill" href="#all-friends">All Friends <!--span v-if="total_friends != ''" class="text-dark">({{total_friends}})</span><span v-else class="text-dark">(0)</span--></a>
                                        </li>
                                        <li>
                                            <a v-on:click="MyFriendRequest()" class="nav-link" data-toggle="pill" href="#friends-request">Friend Requests<!--span v-if="reQuestCount != ''" class="text-dark">({{reQuestCount}})</span><span v-else class="text-dark">(0)</span--></a>
                                        </li>
                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane fade active show" id="all-friends" role="tabpanel">
                                            <div class="iq-card-body p-0">
                                                <hr>
                                                <div class="row mt-4">
                                                    <div v-if="myFriendsLists.length>0" v-for="(myfrindList, index) in myFriendsLists" :key="myFriendsLists.id" class="col-md-4">
                                                        <div class="iq-card">
                                                            <div class="iq-card-body profile-page p-0">
                                                                <div class="profile-header-image">
                                                                    <div class="cover-container">
                                                                        <router-link :to="{name: 'members-about',params: {username: myfrindList.username}}" style="text-decoration:none;">
                                                                            <img v-if="!!myfrindList.ProfileCover" :src="'/public/uploads/coverImages/'+myfrindList.id +'/cover-image/' + myfrindList.ProfileCover" alt="profile-bg" class="rounded img-fluid w-100" />
                                                                            <img v-else src="https://templates.iqonic.design/socialv/bs5/html/dist/assets/images/page-img/profile-bg2.jpg" alt="profile-bg" class="rounded img-fluid w-100"/>
                                                                        </router-link>
                                                                    </div>
                                                                    <div class="profile-info p-2">
                                                                        <div class="user-detail">
                                                                            <div class="d-flex flex-wrap justify-content-between align-items-start">
                                                                                <div class="profile-detail d-flex w-100">
                                                                                    <div class="profile-img pr-4">
                                                                                        <router-link :to="{name: 'members-about',params: {username: myfrindList.username}}" style="text-decoration:none;">
                                                                                            <img v-if="!!myfrindList.profileImage" :src="'/public/uploads/profileImage/' + myfrindList.profileImage" alt="profile-img" class="avatar-130 img-fluid"/>
                                                                                            <img v-else src="https://cdn.pixabay.com/photo/2015/03/04/22/35/avatar-659652__340.png" alt="profile-img" class="avatar-130 img-fluid"/>
                                                                                        </router-link>
                                                                                    </div>
                                                                                    <div class="user-data-block user-data-block text-left">
                                                                                        <h6 class="mb-0"><router-link :to="{name: 'members-about',params: {username: myfrindList.username}}" style="font-size:15px;text-decoration:none;">{{myfrindList.name}}</router-link> </h6>
                                                                                        <p class="mb-0">@{{myfrindList.username}}</p>
                                                                                        <a v-on:click="UnFirend(myfrindList.id, index)" class="mr-3 btn btn-danger rounded text-white mt-2 mb-2">
                                                                                            <span v-show="UnfriendLoader[index]" class="spinner-border spinner-border-sm"></span> Un Friend
                                                                                        </a>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div v-show="statusVisible" v-if="no_friends == '0'" class="text-danger text-center">
                                                       No Friends Requests...
                                                    </div>
                                                </div>
                                                <div v-show="loader" class="row mt-4 text-center" >
                                                    <span style="color:rgb(229, 142, 178);">
                                                        <span class="spinner-grow spinner-grow-md"></span>
                                                        <span class="spinner-grow spinner-grow-md"></span>
                                                        <span class="spinner-grow spinner-grow-md"></span>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="tab-pane fade" id="friends-request" role="tabpanel">
                                            <div class="iq-card-body p-0">
                                                <hr>
                                                <div class="row mt-4">                                                    
                                                    <ul v-if="senderLists.length>0" class="request-list list-inline m-0 p-0">
                                                        <li v-for="(senderList, index) in senderLists" :key="senderLists.id" class="d-flex align-items-center">
                                                            <div class="user-img img-fluid">
                                                                <router-link :to="{name: 'members-about',params: {username: senderList.username}}" style="text-decoration:none;">
                                                                    <img v-if="!!senderList.profileImage" :src="'/public/uploads/profileImage/' + senderList.profileImage" alt="story-img" class="rounded-circle avatar-40">
                                                                    <img v-else src="https://cdn.pixabay.com/photo/2015/03/04/22/35/avatar-659652__340.png" alt="story-img" class="rounded-circle avatar-40">
                                                                </router-link>
                                                            </div>
                                                            <div class="media-support-info ml-3">
                                                                <router-link :to="{name: 'members-about',params: {username: senderList.username}}" style="text-decoration:none;">
                                                                    <h6>{{senderList.name}}</h6>
                                                                    <p class="mb-0 text-dark">@{{senderList.username}}</p>
                                                                </router-link>
                                                            </div>
                                                            <div class="d-flex align-items-center">
                                                                <a v-if="senderList.senderUserID != id" v-on:click="friendRequestConfirm(senderList.id, index, senderList.userId)" class="mr-3 custom_yellow_btn rounded text-white" style="padding-top: 5px; padding-bottom: 5px; cursor: pointer;">
                                                                    <span v-show="ConfirmRequestLoader[index]" class="spinner-border spinner-border-sm"></span> Confirm
                                                                </a>
                                                                <a v-on:click="friendRequestCancel(senderList.id, index, senderList.userId)" class="mr-3 btn btn-dark rounded text-white">
                                                                    <span v-show="friendRequestLoader[index]" class="spinner-border spinner-border-sm"></span> Cancel
                                                                </a>
                                                                <span v-show="statusVisible[index]" v-if="resquestStatus != ''" class="text-success text-center">{{resquestStatus}}</span>
                                                            </div>
                                                        </li>
                                                    </ul> 
                                                    <p v-show="pending_request_text" class="text-center text-danger">No Friends Requests...</p>                                                   
                                                </div>
                                                <div v-show="loader_pending_request" class="row mt-4 text-center" >
                                                    <span style="color:rgb(229, 142, 178);">
                                                        <span class="spinner-grow spinner-grow-md"></span>
                                                        <span class="spinner-grow spinner-grow-md"></span>
                                                        <span class="spinner-grow spinner-grow-md"></span>
                                                    </span>
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
    name: "UserFriends",
    components: {
        MemberHeader,
        MemberMenus
    },
    data() {
        return {
            loader:true,
            loader_pending_request:false,
            pending_request_text:false,
            isLoggedIn: false,
            statusVisible: [],
            resquestStatus:'',
            friendsRequests: [],
            senderLists:[],
            myFriendsLists:[],
            error:'',
            reQuestCount:0,
            total_friends:'',
            ConfirmRequestLoader:[],
            friendRequestLoader:[],
            UnfriendLoader:[]
        }
    },
    methods: {        
        MyAllFriend(){
            this.loader2 = true;
            if (window.Laravel.user) {
                axios.get(`/api/friendsList`).then((response) => {                                       
                    this.loader = false;
                    this.loader2 = false;
                    this.myFriendsLists = response.data.senderList;
                    this.no_friends= response.data.nofriends;
                    this.total_friends= response.data.totalFriends;                    
                }).catch((err) => console.error(err));
            }
        },
        MyFriendRequest(){  
            this.loader_pending_request = true; 
            this.pending_request_text = false;         
            axios.get(`/api/friendsRequests`).then((response) => {               
                this.loader_pending_request = false;
                this.friendsRequests= response.data.friendRequestList;
                this.senderLists = response.data.senderList;
                if(response.data.senderList.length==0){
                    this.pending_request_text = true;
                } else {
                    this.pending_request_text = false;
                }         
            }).catch((err) => console.error(err));
        },
        friendRequestConfirm(senderID, index, SenderUserID){            
            this.ConfirmRequestLoader[index] = true;
            axios.post(`/api/friendRequestConfirm`, {
                RequestSenderID: senderID,
                Sender_id:SenderUserID,
                AuthUserID: this.id
            }).then((response) => {
                //console.log(response.data.resquestCancel);
                this.senderLists.splice(index, 1);
                this.resquestStatus = response.data.resquestConfirm;
                this.statusVisible[index] = true,
                this.ConfirmRequestLoader[index] = false;
                setTimeout(() => this.statusVisible[index] = false, 3000);
                                               
            }).catch(error => {
            })
        },
        friendRequestCancel(senderID, index, userId){
            this.friendRequestLoader[index] = true;
            axios.post(`/api/friendRequestCancel`, {
                RequestSenderID: senderID,
                RequestUserID: userId,
                AuthUserID: this.id
            }).then((response) => { 
                this.senderLists.splice(index, 1);                
                //this.myFriendReqTotal = response.data.pending_friends_notification;
                this.resquestStatus = response.data.resquestConfirm;
                this.statusVisible[index] = true;
                this.friendRequestLoader[index] = false;
                setTimeout(() => this.statusVisible[index] = false, 3000);
                setTimeout(() => this.statusVisible[index] = false, 3000);
                this.senderLists = response.data.friendsReq;                              
            }).catch(error => {
            })
        },
        UnFirend(userId, index){ 
            this.UnfriendLoader[index] = true;          
            this.usersIcon = false;
            this.LoaderIcon = true;
            axios.post(`/api/UnFriend`, {
                UnfriendUser: userId
            }).then((response) => {
                this.UnfriendLoader[index] = false;
                this.usersIcon = true;
                this.LoaderIcon = false;
                this.myFriendsLists = response.data.senderList;
                this.MyAllFriend();
            }).catch(error => {})
        }
    },
    created() {
        window.scrollTo({
            top: 280,
            behavior: 'smooth',
        });
        if (window.Laravel.isLoggedin) {
            this.isLoggedIn = true
        }
        if(window.Laravel.user) {
            this.id = window.Laravel.user.id,     
            this.MyAllFriend();
        }
    },
    beforeRouteEnter(to, from, next) {
        if (!window.Laravel.isLoggedin) {
            window.location.href = "/";
        }
     next();
    }
}
</script>

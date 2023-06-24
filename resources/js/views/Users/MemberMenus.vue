<template>

    <div class="iq-card-body p-0">
        <div class="user-tabing">
            <ul class="nav nav-pills d-flex align-items-center profile-feed-items p-0 m-0">
                <li class="p-2" style="padding:0.2rem !important;">
                    <router-link to="/member-about" class="nav-link custom-active" rel="member-about" ><i class="fa fa-user"></i> About</router-link>
                </li>
                <li class="p-2" style="padding:0.2rem !important;">
                    <router-link to="/membership" class="nav-link custom-active" rel="membership"><i class="fa fa-list"></i> Membership</router-link>
                </li>
                <li class="p-2" style="padding:0.2rem !important;">
                    <router-link to="/member-friends" class="nav-link custom-active" rel="member-friends" >
                        <i class="fa fa-users"></i> Friends ({{ newFriendTotal }})
                    </router-link>
                </li>
                <li class="p-2" style="padding:0.2rem !important;">
                    <router-link to="/groups" rel="groups" class="nav-link custom-active">
                        <i class="fa fa-users"></i> Groups
                    </router-link>
                </li>
                <li class="p-2" style="padding:0.2rem !important;">
                    <router-link to="/private-messages" rel="chats" class="nav-link custom-active">
                        <i class="fa fa fa-comments-o"></i> Messages ({{ newTotalPrivateMessage }})
                    </router-link>
                </li>
                <li class="p-2" style="padding:0.2rem !important;">
                    <router-link to="/reviews" rel="reviews" class="nav-link custom-active"><i class="fa fa-pencil-square-o "></i> Reviews</router-link>
                </li>
                <li class="p-2" style="padding:0.2rem !important;">
                    <router-link to="/chats" rel="chats" class="nav-link custom-active"><i class="fa fa fa-comments-o"></i> Chat</router-link>
                </li>
                <li class="p-2" style="padding:0.2rem !important;">
                    <router-link to="/timeline" rel="timeline" class="nav-link custom-active"><i class="fa fa-pencil-square-o "></i> Timeline</router-link>
                </li>
                <li class="p-2" style="padding:0.2rem !important;">
                    <router-link to="/profile-settings" rel="profile-settings" class="nav-link custom-active"><i class="fa fa-gear"></i> Settings</router-link>
                </li>
            </ul>
        </div>
    </div>

</template>
<script>
const axios = require('axios');
export default {
    name: "MemberMenus",
    data() {
        return {
        name: null,
            isLoggedIn: false,
            newFriendTotal : 0,
            newTotalPrivateMessage : 0
        }
    },
    methods: {
        MyNotificatios(){
            axios.get(`/api/MyNotificatios`).then((response) => {
                this.newFriendTotal = response.data.pending_friends_requests;
                this.newTotalPrivateMessage = response.data.unread_private_messages;
            }).catch((err) => console.error(err));
        }
        // MyPendingRequest(){
        //     axios.get(`/api/myfriendsRequests`).then((response) => {
        //         this.newFriendTotal = response.data.myfriendRequest;
        //     }).catch((err) => console.error(err));
        // },       
        // MyFriendRequestNotification(){
        //     axios.get(`/api/MyFriendRequestNotification`).then((response) => {
        //         this.newFriendTotal = response.data.myfriendRequest;
        //     }).catch((err) => console.error(err));
        // },
        // newPrivateMessage(){
        //     axios.get(`/api/newPrivateMessage`).then((response) => {
        //         this.newTotalPrivateMessage = response.data.newTotalPrivateMessage;
        //     }).catch((err) => console.error(err));
        // }
    },
    created() {            
        if (window.Laravel.user)
        {
            this.MyNotificatios();  
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
            this.ProfileCover = window.Laravel.user.ProfileCover,
            this.facebookURL = window.Laravel.user.facebookURL,
            this.twitterURL = window.Laravel.user.twitterURL,
            this.instagramURL = window.Laravel.user.instagramURL,
            this.linkedinURL = window.Laravel.user.linkedinURL
            //this.MyFriendRequestNotification();
            // this.newPrivateMessage();
        }
        if (window.Laravel.isLoggedin) {
            this.isLoggedIn = true
        }
    },
    mounted() {
        Echo.private('sendfriendReq-channel').listen('FriendRequestSend',(e) => {            
            this.MyNotificatios();
        });
    },
    beforeRouteEnter(to, from, next)
    {
        if (!window.Laravel.isLoggedin) {
            window.location.href = "/";
        }
        next();
    }
}

</script>

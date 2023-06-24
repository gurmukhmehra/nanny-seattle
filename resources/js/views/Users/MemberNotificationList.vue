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
                                <h5>Notifications List </h5>
                                <hr>
                                <p v-show="loader" class="text-center">
                                    <span style="color:rgb(229, 142, 178);">
                                        <span class="spinner-grow spinner-grow-md"></span>
                                        <span class="spinner-grow spinner-grow-md"></span>
                                        <span class="spinner-grow spinner-grow-md"></span>
                                    </span>
                                </p>                                
                                <ul v-if="notificationLists.length>0" class="request-list list-inline p-2">
                                    <li v-for="(notifications, index) in notificationLists" :key="notificationLists.id" class="d-flex align-items-center">
                                        <div class="user-img img-fluid">
                                            <a href="#" style="text-decoration:none;">
                                                <img v-if="!!notifications.SenderDetails.profileImage" :src="'/public/uploads/profileImage/' + notifications.SenderDetails.profileImage" alt="story-img" class="rounded-circle avatar-40">
                                                <img v-else src="https://cdn.pixabay.com/photo/2015/03/04/22/35/avatar-659652__340.png" alt="story-img" class="rounded-circle avatar-40">
                                            </a>
                                        </div>
                                        <div class="media-support-info ml-3">
                                            <a href="" style="text-decoration:none;">
                                                <p class="mb-0 text-dark"><strong style="color: rgb(229, 142, 178);">{{ notifications.SenderDetails.name }}</strong> sent you a <span v-if="notifications.notification_type == 'Friend request send'">friend request</span><span v-else-if="notifications.notification_type == 'Private message sent'">private message</span><span v-else></span></p>
                                                <p class="text-dark">@{{ notifications.SenderDetails.username }}</p>
                                            </a>                                            
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <router-link to="/member-friends" v-if="notifications.notification_type == 'Friend request send'" class="mr-3 custom_yellow_btn rounded text-white" style="padding-top: 5px; padding-bottom: 5px; cursor: pointer;">
                                                View
                                            </router-link>
                                            <router-link to="/private-messages" v-else class="mr-3 custom_yellow_btn rounded text-white" style="padding-top: 5px; padding-bottom: 5px; cursor: pointer;">
                                                View
                                            </router-link>
                                        </div>
                                    </li>                                    
                                </ul> 
                                <ul v-else v-show="notFound" class="request-list list-inline p-2">
                                    <li class="d-flex align-items-center text-danger">Not found!</li>
                                </ul>                              
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
    name: "notification",
    components: {
        MemberHeader,
        MemberMenus
    },
    data() {
        return {
            loader:false,
            isLoggedIn: false,
            notFound:false,
            total_notification:0,
            notificationLists: []
        }
    },
    methods: { 
        MyNotificatios(){
            axios.get(`/api/MyNotificatios`).then((response) => {
                this.total_notification = response.data.total_notifaction;
            }).catch((err) => console.error(err));
        },
        notificationList(){
            this.loader = true; 
            this.notFound = false;           
            axios.get(`/api/notification-list`).then((response) => {                                       
                this.loader = false;
                this.notFound = true;
                this.notificationLists = response.data.notificationList;                   
            }).catch((err) => console.error(err));            
        }
    },
    created() {
        this.loader = true; 
        this.notFound = false;
        this.notificationList();        
        if (window.Laravel.isLoggedin) {
            this.isLoggedIn = true
        }
        if (window.Laravel.user) {                     
            this.id = window.Laravel.user.id,
            this.role = window.Laravel.user.role,
            this.memberType = window.Laravel.user.memberType,            
            this.name = window.Laravel.user.name,
            this.email = window.Laravel.user.email,
            this.username = window.Laravel.user.username            
        }
        	
    },
    mounted() {
        Echo.private('sendfriendReq-channel').listen('FriendRequestSend',(e) => {
            this.MyNotificatios();        
        });
    },
    updated() {       
    },
    beforeRouteEnter(to, from, next) {
        if (!window.Laravel.isLoggedin) {
            window.location.href = "/";
        }
     next();
    }
}
</script>
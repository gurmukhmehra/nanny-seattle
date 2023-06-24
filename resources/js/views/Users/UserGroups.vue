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
                                <div class="row" style="margin-top:60px;">
                                    <div class="col-md-6 col-lg-4" v-for="(groups,index) in groupsList" :key="groups.id" :index="index">
                                        <div class="iq-card">
                                            <div class="iq-card-body text-center">
                                                <div class="group-icon">
                                                    <img v-if="!!groups.groupImage" :src="'/public/uploads/groupsImages/' + groups.groupImage" :alt="groups.groupSlug" class="rounded-circle img-fluid avatar-120">
                                                    <img v-else src="https://templates.iqonic.design/socialv/bs5/html/dist/assets/images/page-img/gi-1.jpg" alt="profile-img" class="rounded-circle img-fluid avatar-120">
                                                </div>
                                                <div class="group-info pt-3 pb-3">
                                                    <h4>
                                                        <router-link :to="{name: 'group', 
                                                                params: { 
                                                                    groupslug: groups.groupSlug
                                                                }
                                                            }" style="font-size:18px;">{{groups.groupName}}</router-link>
                                                    </h4>
                                                    <span class="customClass" v-html="groups.groupDescription.substr(0, 30) + '..'"></span>
                                                </div>
                                                <div class="group-details d-inline-block pb-3">
                                                    <ul class="d-flex align-items-center justify-content-between list-inline m-0 p-0">
                                                        <li class="pl-3 pr-3">
                                                            <p class="mb-1">Post</p>
                                                            <h6 style="font-size: 14px;font-weight: normal;">{{ totalGroupPosts[index] }}</h6>
                                                        </li>
                                                        <li class="pl-3 pr-3">
                                                            <p class="mb-1">Member</p>
                                                            <h6 style="font-size: 14px;font-weight: normal;">{{totalGroupMember[index]}}</h6>
                                                        </li>
                                                    </ul>
                                                </div>                                                 
                                                <!-- ({{groups.userID}},{{groups.groupID}}) -->
                                                <button v-if="groups.userID == userid" class="custom_yellow_btn d-block w-100">Joined</button>
                                                <button v-else v-on:click="jonGroup(groups.id, index)" class="custom_yellow_btn d-block w-100">
                                                    <span v-if="loader[index]" class="spinner-border spinner-border-sm" role="status"><span class="sr-only">Loading...</span></span> 
                                                    Join
                                                </button> 
                                                <p v-show="statusVisible[index]" class="text-success text-center w-100" style="float:left;">{{resquestStatus}}</p>
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
    name: "UserGroups",
    components: {
        MemberHeader,
        MemberMenus
    },
    data() {
        return { 
            name: null,
            userid:null,           
            loader:[],
            isLoggedIn: false,
            groupsList:[],
            statusVisible: [],
            userGroups:[],
            totalGroupMember:[],
            totalGroupPosts:[]
        }
    },
    methods: {
        MyNotificatios(){
            axios.get(`/api/MyNotificatios`).then((response) => {
                this.total_notification = response.data.totalNotification;
            }).catch((err) => console.error(err));
        },
        jonGroup(GroupID, index){
            this.loader[index]=true;           
            axios.post(`/api/joinGroup`, {
                group_id: GroupID,
                user_id :this.userid,
            }).then((response) => {                
                this.resquestStatus = response.data.resquestStatus;
                if(response.data.resquestStatus=='Joined'){
                    this.totalGroupMember[index] = response.data.totalGroupMembers;                    
                }                
                this.statusVisible[index] = true,
                this.loader[index] = false,
                setTimeout(() => this.statusVisible[index] = false, 3000);
            }).catch(error => {
            });
        }
    },
    created() {       
        if (window.Laravel.isLoggedin) {
            this.isLoggedIn = true
        }
        if(window.Laravel.user) {
            this.userid = window.Laravel.user.id;
            this.name = window.Laravel.user.name;                     
        }
        axios.get(`/api/groups`).then((response) => {                    
            this.groupsList = response.data.allGroups;
            this.totalGroupMember = response.data.totalGroupMembers;
            this.totalGroupPosts = response.data.totalGroupPost;
        }).catch((err) => console.error(err)); 
        	
    },
    mounted() {
        Echo.private('sendfriendReq-channel').listen('FriendRequestSend',(e) => {
            //console.log('Friend request new  : ', e.notification);
            //this.total_notification += e.notification;
            this.MyNotificatios();        
        });
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
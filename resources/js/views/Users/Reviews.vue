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
                            <div class="iq-card-body chat-page p-0">
                                <hr>                               
                                <div class="chat-data-block">                                    
                                    <div class="row">                    
                                        <div class="col-lg-3 chat-data-left scroller">
                                            <div class="chat-search">                            
                                                <div class="chat-sidebar-channel scroller">                                                             
                                                    <h6 class="" style="font-size: 16px;font-weight: normal;">Users List</h6>                                                    
                                                    <hr class="mb-0">                                                    
                                                    <ul class="iq-chat-ui nav flex-column nav-pills">
                                                        <li v-for="ReviewfrindList in reviewToUsersList" :key="reviewToUsersList.id">
                                                            <a data-toggle="pill" v-on:click="ReviewWithUser(ReviewfrindList.ReviewToUserDetail.username, index)" style="cursor: pointer;">
                                                                <div class="d-flex align-items-center">
                                                                    <div class="avatar mr-2">
                                                                        <img v-if="!!ReviewfrindList.ReviewToUserDetail.profileImage" :src="'/public/uploads/profileImage/' + ReviewfrindList.ReviewToUserDetail.profileImage" alt="profile-bg" class="avatar-50"/>
                                                                        <img v-else src="https://cdn.pixabay.com/photo/2015/03/04/22/35/avatar-659652__340.png" alt="chatuserimage" class="avatar-50"/>
                                                                    </div>
                                                                    <div class="chat-sidebar-name">
                                                                        <h6 class="mb-0" style="font-size: 14px;font-weight: normal;">{{ReviewfrindList.ReviewToUserDetail.name}}</h6>
                                                                        <span>@{{ReviewfrindList.ReviewToUserDetail.username}}</span>
                                                                    </div>
                                                                </div>
                                                            </a>
                                                        </li>                                    
                                                    </ul>
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

                                        <div class="col-lg-9 chat-data p-0 chat-data-right">
                                            <div class="tab-content">
                                                <div  class="tab-pane fade active show" id="default-block" role="tabpanel">
                                                    <div v-if="beforeChat" class="chat-start" style="background-color:#cccccc7a;">
                                                        <span class="iq-start-icon text-primary"><i class="fa fa-pencil-square-o"></i></span>
                                                        <button id="chat-start" class="btn bg-white mt-3">Reviews!</button>                                    
                                                    </div>
                                                    <div v-if="startChat" class="tab-pane tab-pane active show fade" :id="'chatbox-' + ChatToUser" role="tabpanel">
                                                        <div v-show="loader2" class="row mt-4 text-center" >
                                                            <span style="color:rgb(229, 142, 178);">
                                                                <span class="spinner-grow spinner-grow-md"></span>
                                                                <span class="spinner-grow spinner-grow-md"></span>
                                                                <span class="spinner-grow spinner-grow-md"></span>
                                                            </span>
                                                        </div>
                                                        <div class="chat-head">
                                                            <header class="d-flex justify-content-between align-items-center bg-white pt-3 pl-3 pr-3 pb-3">
                                                                <div class="d-flex align-items-center">
                                                                    <div class="sidebar-toggle">
                                                                        <i class="ri-menu-3-line"></i>
                                                                    </div>
                                                                    <div class="avatar chat-user-profile m-0 mr-3">
                                                                        <img v-if="!!ChatWithUser.profileImage" :src="'/public/uploads/profileImage/' + ChatWithUser.profileImage" alt="avatar" class="avatar-50 ">
                                                                        <img v-else src="https://cdn.pixabay.com/photo/2015/03/04/22/35/avatar-659652__340.png" alt="avatar" class="avatar-50 ">                                                
                                                                    </div>
                                                                    <h5 class="mb-0">{{ChatWithUser.name}}</h5>
                                                                </div>
                                                            </header>    
                                                        </div>
                                                        <div class="chat-content scroller" style="background-color:rgba(215, 213, 212, 0.8);height: 350px;">
                                                            <div class="row" v-for="myfrindList in UsersReviewList" :key="UsersReviewList.id">
                                                                <div class="col-md-2 text-center" v-if="myfrindList.ReviewByUsers.id == id">
                                                                    <img v-if="!!profileImage" :src="'/public/uploads/profileImage/' + profileImage" alt="profile-img" class="rounded-circle" style="height: 100px;width: 80%;"/>
                                                                    <img v-else src="https://cdn.pixabay.com/photo/2015/03/04/22/35/avatar-659652__340.png" alt="profile-img" class="rounded-circle" style="height: 100px;width: 80%;"/>
                                                                </div>
                                                                <div class="col-md-2 text-center" v-else>
                                                                    <img v-if="!!myfrindList.ReviewByUsers.profileImage" :src="'/public/uploads/profileImage/' + myfrindList.ReviewByUsers.profileImage" alt="profile-img" class="rounded-circle" style="height: 100px;width: 80%;"/>
                                                                    <img v-else src="https://cdn.pixabay.com/photo/2015/03/04/22/35/avatar-659652__340.png" alt="profile-img" class="rounded-circle" style="height: 100px;width: 80%;"/>
                                                                </div>
                                                                <div class="col-md-10 mt-3">
                                                                    <h5 v-if="myfrindList.ReviewByUsers.id == id" style="color:#e58eb2;text-align: left;">You</h5>
                                                                    <h5 v-else style="color:#e58eb2;text-align: left;">{{myfrindList.ReviewByUsers.name}}</h5>
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
                                                                    <p class="text-left">{{ moment(myfrindList.created_at).format("MMM YYYY") }}</p>
                                                                    <p class="text-left" v-html="myfrindList.review"></p>
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
    import MemberHeader from "../Users/MemberHeader";
    import MemberMenus from "../Users/MemberMenus";  
export default {
    name: "Chats",
    components: {
        MemberHeader,
        MemberMenus
    },    
    data() {
        return {
            moment: moment,
            loader:true,
            loader2:false,
            isLoggedIn: false,
            no_review:"",
            reviewToUsersList:[],
            beforeChat:true,
            startChat:false, 
            ChatToUser: "",
            ChatWithUser: "",
            MyReviewListToUser:[],
            UsersReviewList:[]                
        }
    },
    methods: {
        ReviewWithUser(ReviewToUsername, index){
            this.loader2 = true;
            this.startChat = true;
            this.ChatToUser = ReviewToUsername;
            if (window.Laravel.user) {
                axios.post(`/api/GetReviewToUsername`, {
                user_id :ReviewToUsername,
                }).then((response) => {
                    this.beforeChat = false;
                    this.startChat = true;
                    this.loader2 = false;                
                    this.ChatWithUser = response.data.fetchUserInfo;
                    this.UsersReviewList = response.data.ReviewList;
                }).catch(error => {});               
            }
        }
    },
    mounted(){},    
    created() {        
        if (window.Laravel.isLoggedin) {
            this.isLoggedIn = true
        }
        if (window.Laravel.user) {
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
            axios.get(`/api/GetMyReviewList`).then((response) => {
                this.loader = false;
                this.reviewToUsersList= response.data.reviewToUsersList;
                this.UsersReviewList= response.data.ReviewList;                 
                this.no_review= response.data.no_review;                 
            }).catch((err) => console.error(err));                 
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
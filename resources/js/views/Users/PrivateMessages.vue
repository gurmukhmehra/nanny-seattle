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
                                                    <h6 class="" style="font-size: 16px;font-weight: normal;">Members List</h6>
                                                    <span v-if="BeforeLoadingUsers" class="spinner-border text-danger spinner-border-sm" role="status"><span class="sr-only">Loading...</span></span>
                                                    <ul class="iq-chat-ui nav flex-column nav-pills">
                                                        <li v-for="(myfrindList, index) in myPrivtateFriendsLists" :key="myPrivtateFriendsLists.id" :index="index">
                                                            <a data-toggle="pill" v-on:click="MessageThreada(myfrindList.thread_id, index)" style="cursor: pointer;" v-if="myfrindList.usersDetails !== null && myfrindList.MessagesDetails !== null">
                                                                <div class="d-flex align-items-center">
                                                                    <div class="avatar mr-2 ml-2">
                                                                        <img v-if="!!myfrindList.usersDetails.profileImage" :src="'/public/uploads/profileImage/' + myfrindList.usersDetails.profileImage" alt="chatuserimage" class="avatar-50 ">
                                                                        <img v-else src="https://cdn.pixabay.com/photo/2015/03/04/22/35/avatar-659652__340.png" alt="chatuserimage" class="avatar-50 ">
                                                                    </div>
                                                                    <div class="chat-sidebar-name">
                                                                        <h6 class="mb-0" style="font-size: 14px;font-weight: normal;">{{ myfrindList.usersDetails.name }}</h6>
                                                                        <span>@{{ myfrindList.usersDetails.username }}</span>
                                                                    </div>
                                                                </div>
                                                            </a>
                                                        </li>                                    
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-9 chat-data p-0 chat-data-right">
                                            <div class="tab-content">
                                                <div v-if="beforeChat" class="tab-pane fade active show" id="default-block" role="tabpanel">
                                                    <div class="chat-start">
                                                        <span class="iq-start-icon text-primary"><i class="fa fa fa-comments-o"></i></span>
                                                        <button id="chat-start" class="btn bg-white mt-3">Start
                                                        Conversation!</button>                                    
                                                    </div>
                                                </div> 
                                                <span v-if="loader" class="spinner-border spinner-border-sm" role="status"><span class="sr-only">Loading...</span></span>                                              
                                                <div v-if="startChat" class="tab-pane tab-pane active show fade" role="tabpanel">
                                                    <div class="chat-head" v-if="ChatWithUser.id != id">
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
                                                        <div v-for="(FriendsChatMsg,index) in MembersThreadsMessages" :key="FriendsChatMsg.id" :index="index" class="chat">
                                                            <p v-if="FriendsChatMsg.sender_id == id">
                                                                <div class="chat-user">
                                                                    <a class="avatar m-0">                                                                    
                                                                        <img v-if="!!profileImage" :src="'/public/uploads/profileImage/' + profileImage" alt="avatar" class="avatar-35" style="width:40px;">
                                                                        <img v-else src="https://cdn.pixabay.com/photo/2015/03/04/22/35/avatar-659652__340.png" alt="avatar" class="avatar-35" style="width:40px;">
                                                                        <span class="chat-time mt-0" style="font-weight: bold;">You</span>
                                                                        <span class="chat-time mt-0">{{ moment(FriendsChatMsg.created_at).fromNow() }}</span>
                                                                    </a>                                                                
                                                                </div>
                                                                <div class="chat-detail pt-0" v-if="FriendsChatMsg.MessageUsersDetails.id == id && FriendsChatMsg.sender_id != 0">
                                                                    <div class="chat-message" style="background-color: #fff; color: #333;box-shadow:none;text-align: left;">
                                                                        <p v-if="FriendsChatMsg.sender_id == id" v-html="FriendsChatMsg.message"></p>
                                                                    </div>
                                                                </div>
                                                            </p>
                                                            
                                                            <p v-if="FriendsChatMsg.MessageUsersDetails.id != id" style="clear: both;padding-top: 20px;">
                                                                <div class="chat chat-left">
                                                                    <div class="chat-user">
                                                                        <a class="avatar m-0">
                                                                            <img v-if="!!FriendsChatMsg.MessageUsersDetails.profileImage" :src="'/public/uploads/profileImage/' + FriendsChatMsg.MessageUsersDetails.profileImage" alt="avatar" class="avatar-35" style="width:40px;">
                                                                            <img v-else src="https://cdn.pixabay.com/photo/2015/03/04/22/35/avatar-659652__340.png" alt="avatar" class="avatar-35" style="width:40px;">
                                                                            <span class="chat-time mt-0" style="font-weight: bold;">{{FriendsChatMsg.MessageUsersDetails.name}}</span>
                                                                            <span class="chat-time mt-0">{{ moment(FriendsChatMsg.created_at).fromNow() }}</span>
                                                                        </a>                                                
                                                                    </div>
                                                                    <div class="chat-detail pt-0">
                                                                        <div class="chat-message" style="background-color: #ccc; color: #333;">                                                    
                                                                            <p v-html="FriendsChatMsg.message"></p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </p>                                                            
                                                        </div>
                                                    </div>
                                                    <div class="chat-footer p-3 bg-white">
                                                        <span class="d-flex align-items-center">
                                                            <input type="text" class="form-control mr-3" v-model="newMessage" @keyup.enter="sendPrivateMessage(ChatWithUser.id,MessageTreadID)" placeholder="Type your message" style="border: 1px solid rgb(51, 51, 51);">                                        
                                                            <button class="custom_yellow_btn d-flex align-items-center p-2" v-on:click="sendPrivateMessage(ChatWithUser.id,MessageTreadID)">
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
            loader:false,
            isLoggedIn: false,
            BeforeLoadingUsers : true,
            myPrivtateFriendsLists:[],
            beforeChat:true,
            startChat:false,
            MessagesThreadsIDs: '',
            MessageTreadID:[],
            MembersThreadsMessages:[],
            ChatWithUser:[],
            newMessage: '',
            buttonIcon:true,
            Messageloader: false, 
            error_message: "",
            messageStatu: "",          
        }
    },
    methods: {
        MyNotificatios(){
            axios.get(`/api/MyNotificatios`).then((response) => {
                this.total_notification = response.data.total_notifaction;
            }).catch((err) => console.error(err));
        },
        MessageThreada(thread_id, index){
            this.loader = true;
            this.beforeChat = false;            
            //console.log('thread_id : ',thread_id ,'Index : ',index);
            if (window.Laravel.user) {
                axios.post(`/api/GetMembersThreadsMessages`, {
                threads_id :thread_id,
                }).then((response) => {
                    this.loader = false;
                    this.startChat = true;                    
                    this.MessageTreadID = response.data.MessageTreadsID;               
                    this.MembersThreadsMessages = response.data.PrivateMessageList;
                    this.ChatWithUser = response.data.MessageWithUser;
                }).catch(error => {});
            }
        },
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
                    this.MessageThreada(MessageTreadID);                                                         
                    this.Messageloader = false;
                    this.buttonIcon = true;
                    this.newMessage ='';
                    this.messageStatu = response.data.MessageStatus;
                    setTimeout(() => this.messageStatu = '', 2000);
                }).catch(error => {
                    this.Messageloader = false;
                    this.buttonIcon = true;
                    this.error_message = error.response.data.error.message,
                    setTimeout(() => this.error_message = '', 3000);
                });
            }
        }
     },
     mounted() {         
        Echo.private('sendfriendReq-channel').listen('FriendRequestSend',(e) => {
            this.MyNotificatios();                                         
        });
    },    
    created() { 
        window.scrollTo({
            top: 280,
            behavior: 'smooth',
        })       
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
            this.linkedinURL = window.Laravel.user.linkedinURL,
            axios.get(`/api/get-private-messages`).then((response) => {
                //console.log('privateMessagesList : ',response.data.PrivateMessageUsers);
                // this.loader = false;
                this.BeforeLoadingUsers = false;
                this.myPrivtateFriendsLists = response.data.PrivateMessageUsers;                   
            }).catch((err) => console.error(err));        
        }	
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
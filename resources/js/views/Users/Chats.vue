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
                                                    <h6 class="" style="font-size: 16px;font-weight: normal;">Groups <span v-if="joinedGroups != ''" class="text-dark" style="font-size: 16px;font-weight: normal;">({{joinedGroups}})</span><span v-else class="text-dark">(0)</span></h6>
                                                    <span v-if="BeforeLoadingUsers" class="spinner-border text-danger spinner-border-sm" role="status"><span class="sr-only">Loading...</span></span>
                                                    <ul class="iq-chat-ui nav flex-column nav-pills">
                                                        <li v-for="(groupsDetail,index) in groupsDetails" :key="groupsDetail.id" :index="index">
                                                            <a data-toggle="pill" v-on:click="GropupChat(groupsDetail.groupSlug, index)" style="cursor: pointer;">
                                                                <div class="d-flex align-items-center">
                                                                    <div class="avatar mr-2">
                                                                        <img v-if="!!groupsDetail.groupImage" :src="'/public/uploads/groupsImages/' + groupsDetail.groupImage" :alt="groupsDetail.groupSlug" class="avatar-50 ">
                                                                        <img v-else src="https://templates.iqonic.design/socialv/bs5/html/dist/assets/images/page-img/gi-1.jpg" alt="profile-img" class="avatar-50">
                                                                    </div>
                                                                    <div class="chat-sidebar-name">
                                                                        <h6 class="mb-0" style="font-size: 14px;font-weight: normal;">{{groupsDetail.groupName}}</h6>
                                                                        <span class="customClass" v-html="groupsDetail.groupDescription.substr(0, 30) + '..'"></span>
                                                                    </div>
                                                                </div>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                    <hr>
                                                    <h6 class="mt-3" style="font-size: 16px;font-weight: normal;">Friend List <span v-if="total_friends != ''" class="text-dark" style="font-size: 16px;font-weight: normal;">({{total_friends}})</span><span v-else class="text-dark">(0)</span></h6>
                                                    <span v-if="BeforeLoadingUsers" class="spinner-border text-danger spinner-border-sm" role="status"><span class="sr-only">Loading...</span></span>
                                                    <ul class="iq-chat-ui nav flex-column nav-pills">
                                                        <li v-for="(myfrindList,index) in myFriendsLists" :key="myFriendsLists.id" :index="index">
                                                            <a data-toggle="pill" v-on:click="ChatWithFriend(myfrindList.username, index)" style="cursor: pointer;">
                                                                <div class="d-flex align-items-center">
                                                                    <div class="avatar mr-2">
                                                                        <img v-if="!!myfrindList.profileImage" :src="'/public/uploads/profileImage/' + myfrindList.profileImage" alt="chatuserimage" class="avatar-50 ">
                                                                        <img v-else src="https://cdn.pixabay.com/photo/2015/03/04/22/35/avatar-659652__340.png" alt="chatuserimage" class="avatar-50 ">
                                                                    </div>
                                                                    <div class="chat-sidebar-name">
                                                                        <h6 class="mb-0" style="font-size: 14px;font-weight: normal;">{{myfrindList.name}}</h6>
                                                                        <span>@{{myfrindList.username}}</span>
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
                                                <!------------------- Group chat box ------------------------------>
                                                <div v-if="startGroupChat" class="tab-pane tab-pane active show fade" :id="'chatbox-' + ChatGroup" role="tabpanel">
                                                    <div class="chat-head">
                                                        <header class="d-flex justify-content-between align-items-center bg-white pt-3 pl-3 pr-3 pb-3">
                                                            <div class="d-flex align-items-center">
                                                                <div class="sidebar-toggle">
                                                                    <i class="ri-menu-3-line"></i>
                                                                </div>
                                                                <div class="avatar chat-user-profile m-0 mr-3">
                                                                    <img v-if="!!chatGroupDetails.groupImage" :src="'/public/uploads/groupsImages/' + chatGroupDetails.groupImage" :alt="chatGroupDetails.groupSlug" class="avatar-50 ">
                                                                    <img v-else src="https://templates.iqonic.design/socialv/bs5/html/dist/assets/images/page-img/gi-1.jpg" :alt="chatGroupDetails.groupSlug" class="avatar-50 ">                                                
                                                                </div>
                                                                <h5 class="mb-0">{{chatGroupDetails.groupName}}</h5>                                            
                                                            </div>                                        
                                                        </header> 
                                                    </div>
                                                    <span v-html="chatGroupDetails.groupDescription.substr(0, 100) + '..'"></span> 
                                                    <div class="chat-content scroller" style="background-color:rgba(215, 213, 212, 0.8);height: 350px;">
                                                        <div class="chat" v-for="(groupMsg,index) in ChatGroupMsg" :key="groupMsg.id" :index="index">
                                                            <div class="chat-user" v-if="groupMsg.auth_user_id == id">
                                                                <a class="avatar m-0">
                                                                    <img v-if="!!profileImage" :src="'/public/uploads/profileImage/' + profileImage" alt="avatar" class="avatar-35" style="width:30px;float: left;">
                                                                    <img v-else src="https://cdn.pixabay.com/photo/2015/03/04/22/35/avatar-659652__340.png" alt="avatar" class="avatar-35" style="width:30px;float: left;">
                                                                    <span class="chat-time mt-0">{{ moment(groupMsg.created_at).format("D MMM YYYY hh:mm A") }}</span>
                                                                </a>                                         
                                                            </div>
                                                            <div class="chat-detail" v-if="groupMsg.auth_user_id == id">
                                                                <div class="chat-message" style="background-color: #fff; color: #333;box-shadow:none;">
                                                                    <p>{{groupMsg.groupMessage}}</p>
                                                                </div>
                                                            </div>
                                                            <div class="chat chat-left" v-if="groupMsg.auth_user_id != id">
                                                                <div class="chat-user">
                                                                    <a class="avatar m-0" v-for="(groupUsrDetail,index) in GroupMembers" :key="groupUsrDetail.id" :index="index">
                                                                        <span v-if="groupUsrDetail.id == id"></span>
                                                                        <span v-else-if="groupUsrDetail.id == groupMsg.auth_user_id">
                                                                            <img v-if="!!groupUsrDetail.profileImage" :src="'/public/uploads/profileImage/' + groupUsrDetail.profileImage" alt="avatar" class="avatar-35" style="width:30px;float: left;">
                                                                            <img v-else src="https://cdn.pixabay.com/photo/2015/03/04/22/35/avatar-659652__340.png" alt="avatar" class="avatar-35" style="width:30px;float: left;">
                                                                            <span>@{{groupUsrDetail.username}}</span>
                                                                            <span class="chat-time mt-0">{{ moment(groupMsg.created_at).format("D MMM YYYY hh:mm A") }}</span>
                                                                        </span>
                                                                        <span v-else></span>                                                                                                        
                                                                    </a>
                                                                    
                                                                </div>
                                                                <div class="chat-detail">
                                                                    <div class="chat-message" style="background-color: #ccc; color: #333;">                                                    
                                                                        <p>{{groupMsg.groupMessage}}</p>
                                                                    </div>                                                
                                                                </div>
                                                            </div>
                                                        </div>                                    
                                                    </div>
                                                    <div class="chat-footer p-3 bg-white">
                                                        <span class="d-flex align-items-center">
                                                            <input type="text" class="form-control mr-3" v-model="GroupMessage" @keyup.enter="sendGroupMessage(chatGroupDetails.id)" placeholder="Type your message" style="border: 1px solid rgb(51, 51, 51);">                                        
                                                            <button class="custom_yellow_btn d-flex align-items-center p-2" v-on:click="sendGroupMessage(chatGroupDetails.id)">
                                                                <i v-if="GroupButtonIcon" class="fa fa-paper-plane-o" aria-hidden="true"></i>
                                                                <span v-if="GropupMessageloader" class="spinner-border spinner-border-sm" role="status"></span>                                           
                                                                <span class="d-none d-lg-block ml-1">Send</span>
                                                            </button>
                                                        </span> 
                                                        <small class="text-danger">{{ error_GroupMessage }} </small>
                                                        <small class="text-success">{{ GroupMessageStatu }} </small>                                   
                                                    </div>
                                                </div> 
                                                <!-------------------- End  Group chat box ---------------------------->
                                                <div v-if="startChat" class="tab-pane tab-pane active show fade" :id="'chatbox-' + ChatToUser" role="tabpanel">                            
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
                                                        <div v-for="(FriendsChatMsg,index) in FriendsChatMessage" :key="FriendsChatMsg.id" :index="index" class="chat">
                                                            <div class="chat-user" v-if="FriendsChatMsg.sender_user_id == id">
                                                                <a class="avatar m-0">
                                                                    <img v-if="!!profileImage" :src="'/public/uploads/profileImage/' + profileImage" alt="avatar" class="avatar-35" style="width:30px;float: left;">
                                                                    <img v-else src="https://cdn.pixabay.com/photo/2015/03/04/22/35/avatar-659652__340.png" alt="avatar" class="avatar-35" style="width:30px;float: left;">
                                                                    <span class="chat-time mt-0">{{ moment(FriendsChatMsg.created_at).format("D MMM YYYY hh:mm A") }}</span>
                                                                </a>
                                                                
                                                            </div>
                                                            <div class="chat-detail" v-if="FriendsChatMsg.sender_user_id == id">
                                                                <div class="chat-message" style="background-color: #fff; color: #333;box-shadow:none;">
                                                                    <p v-if="FriendsChatMsg.sender_user_id == id">{{FriendsChatMsg.message}}</p>
                                                                </div>
                                                            </div>                                       
                                                            
                                                            <div class="chat chat-left" v-if="FriendsChatMsg.sender_user_id==ChatWithUser.id">
                                                                <div class="chat-user">
                                                                    <a class="avatar m-0">
                                                                    <img v-if="!!ChatWithUser.profileImage" :src="'/public/uploads/profileImage/' + ChatWithUser.profileImage" alt="avatar" class="avatar-35" style="width:30px;float: left;">
                                                                    <img v-else src="https://cdn.pixabay.com/photo/2015/03/04/22/35/avatar-659652__340.png" alt="avatar" class="avatar-35" style="width:30px;float: left;">
                                                                    <span class="chat-time mt-0">{{ moment(FriendsChatMsg.created_at).format("D MMM YYYY hh:mm A") }}</span>
                                                                    </a>                                                
                                                                </div>
                                                                <div class="chat-detail">
                                                                    <div class="chat-message" style="background-color: #ccc; color: #333;">                                                    
                                                                        <p v-if="ChatWithUser.id == FriendsChatMsg.sender_user_id">{{FriendsChatMsg.message}}</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                        </div>                                                                        
                                                    </div>
                                                    <div class="chat-footer p-3 bg-white">
                                                        <span class="d-flex align-items-center">
                                                            <input type="text" class="form-control mr-3" v-model="newMessage" @keyup.enter="sendMessage(ChatWithUser.id)" placeholder="Type your message" style="border: 1px solid rgb(51, 51, 51);">                                        
                                                            <button class="custom_yellow_btn d-flex align-items-center p-2" v-on:click="sendMessage(ChatWithUser.id)">
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
            myFriendsLists:[],
            total_friends:'',
            groupsDetails:[],
            joinedGroups :'',
            beforeChat:true,
            startChat:false,
            ChatToUser: '',
            ChatWithUser :'',
            chatGroupDetails:'',
            startGroupChat:false,
            ChatGroup:'',
            newMessage: '',
            buttonIcon:true,
            Messageloader: false, 
            error_message: "", 
            messageStatu: "",
            FriendsChatMessage:[],
            ChatGroupMsg:[],
            GroupMembers:[],
            GroupMessage: '',
            GroupButtonIcon : true,
            GropupMessageloader : false,
            error_GroupMessage:'',
            GroupMessageStatu:'' ,  
        }
    },
    methods: {
        MyAllFriend(){
            if (window.Laravel.user) {
                axios.get(`/api/friendsList`).then((response) => {
                    this.BeforeLoadingUsers = false; 
                    this.myFriendsLists = response.data.senderList;
                    this.total_friends= response.data.totalFriends;                    
                }).catch((err) => console.error(err));

                axios.get(`/api/MemberGroupList`).then((response) => {
                    this.BeforeLoadingUsers = false;                  
                    this.joinedGroups = response.data.MemberTotalJoinGroup;
                    this.groupsDetails = response.data.MemberGropusDetails;                      
                }).catch((err) => console.error(err));
            } 
        },
        ChatWithFriend(ChatToUsername, index){            
            this.loader = true; 
            this.startChat = false;     
            this.ChatToUser = ChatToUsername;
            this.startGroupChat = false;
            this.Messageloader = false;
            this.newMessage ='';
            this.error_message ='';
            if (window.Laravel.user) {
                axios.post(`/api/chats`, {
                user_id :ChatToUsername,
                }).then((response) => {
                    this.beforeChat = false;
                    this.startChat = true;
                    this.loader = false;                
                    this.ChatWithUser = response.data.chatUserDetail;
                }).catch(error => {});

                axios.post(`/api/getChatMessageWithFriend`, {
                    loginUserID : this.id,
                    FriendUsername : ChatToUsername,
                }).then((response) => {
                    this.FriendsChatMessage = response.data.FriendsChatMessages;               
                }).catch(error => {});
            }
        },
        GropupChat(groupSlug, index){            
            this.loader = true;  
            this.ChatGroup = groupSlug;
            this.startChat = false;
            this.Messageloader = false;                  
            if(window.Laravel.user) {
                axios.post(`/api/GroupChats`, {
                group_slug :groupSlug,
                }).then((response) => {
                    this.beforeChat = false;
                    this.loader = false;
                    this.startGroupChat = true;                
                    this.chatGroupDetails = response.data.chatGroupDetail;
                }).catch(error => {});

                axios.post(`/api/getGroupChatMessage`, {
                    group_slug :groupSlug,
                }).then((response) => {
                    this.ChatGroupMsg = response.data.MessagesGroups;
                    this.GroupMembers = response.data.groupUsers;               
                }).catch(error => {});
            }
        },
        sendMessage(chatUserId) {
            this.buttonIcon = false;
            this.Messageloader = true;
            //const loginUserID = this.id;
            //const chatMessage = this.newMessage;
            //console.log('chatwith : ',chatUserId, 'login user id : ',loginUserID, 'chatMessage : ',chatMessage);
            if(window.Laravel.user) {
                axios.post(`/api/ChatMessages`, {
                    sendMessageFrom : this.id,
                    sendMessageTo : chatUserId,
                    message : this.newMessage,
                }).then((response) => { 
                    this.FriendsChatMessage.push(response.data.SendMessageDetail);                                                         
                    this.Messageloader = false;
                    this.buttonIcon = true;
                    this.newMessage ='';
                    this.messageStatu = response.data.MessageStatus; 
                    // Echo.private('chat')
                    // .listen('ChatEvent',(e) => {
                    //     console.log('push : ', e); 
                    //     this.chat.FriendsChatMessage.push(e.message);                                               
                    // });  
                                                       
                    setTimeout(() => this.messageStatu = '', 2000);                    
                }).catch(error => {
                    this.Messageloader = false;
                    this.buttonIcon = true;
                    this.error_message = error.response.data.error.message,
                    setTimeout(() => this.error_message = '', 3000); 
                });
            }
        },
        sendGroupMessage(ChatGroupID){
            this.GroupButtonIcon = false;
            this.GropupMessageloader = true;
            if(window.Laravel.user) {
                axios.post(`/api/GroupChatMessages`, {
                    sendMessageFrom : this.id,
                    group_id : ChatGroupID,
                    groupChatsMessage : this.GroupMessage,
                }).then((response) => {
                    this.ChatGroupMsg.push(response.data.GroupsChatMessages);
                    this.GropupMessageloader = false;
                    this.GroupButtonIcon = true;
                    this.GroupMessage= "";
                    this.GroupMessageStatu = response.data.MessageStatus;
                    setTimeout(() => this.GroupMessageStatu = '', 2000);
                }).catch(error => {
                    this.GropupMessageloader = false;
                    this.GroupButtonIcon = true;
                    this.error_GroupMessage = error.response.data.error.groupChatsMessage,
                    setTimeout(() => this.error_GroupMessage = '', 3000); 
                });
            }
        }        
    },
    mounted(){
        Echo.private('chat')
        .listen('ChatEvent',(e) => {
            //console.log('push chat : ', e.message); 
            this.FriendsChatMessage.push(e.message);
            this.ChatGroupMsg.push(e.message);                                 
        });
    },    
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
            this.linkedinURL = window.Laravel.user.linkedinURL,
            axios.get(`/api/friendsList`).then((response) => {
                this.loader = false;
                this.BeforeLoadingUsers = false; 
                this.myFriendsLists = response.data.senderList;
                this.total_friends= response.data.totalFriends;                    
            }).catch((err) => console.error(err));

            axios.get(`/api/MemberGroupList`).then((response) => {    
                this.BeforeLoadingUsers = false;                             
                this.joinedGroups = response.data.MemberTotalJoinGroup;
                this.groupsDetails = response.data.MemberGropusDetails;                    
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
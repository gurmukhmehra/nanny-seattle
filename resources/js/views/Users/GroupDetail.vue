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
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-lg-10 d-flex align-items-center justify-content-between mb-3">
                                <div class="group-info d-flex align-items-center">
                                    <div class="mr-3">
                                        <img class="rounded-circle img-fluid avatar-100" v-if="!!GroupDetail.groupImage" :src="'/public/uploads/groupsImages/' + GroupDetail.groupImage" :alt="GroupDetail.groupSlug">
                                        <img class="rounded-circle img-fluid avatar-100"  v-else src="https://templates.iqonic.design/socialv/bs5/html/dist/assets/images/page-img/gi-1.jpg" :alt="GroupDetail.groupSlug">
                                    </div>
                                    <div class="info" style="width:80%;">
                                    <h6>{{GroupDetail.groupName}}</h6>
                                    <span class="customClass" v-html="GroupDetail.groupDescription"></span>
                                    <p class="mb-2 mt-2"><i class="fa fa-users pr-2"></i>{{totalGroupMember}} Members</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-2 align-items-center justify-content-between mb-3">
                                <div class="group-member d-flex align-items-center mt-4">
                                    <button v-if="CheckGroupJoin > 0" class="btn btn-primary d-block w-100">Joined</button>
                                    <button v-else v-on:click="jonGroup(GroupDetail.id)" class="btn btn-primary mb-2">
                                        <span v-if="loader" class="spinner-border spinner-border-sm" role="status"><span class="sr-only">Loading...</span></span> 
                                        Join
                                    </button>                                                                   
                                </div>
                                <p v-show="statusVisible" class="text-success text-left w-100">{{resquestStatus}}</p>
                            </div>                     
                        </div>                        
                    </div>

                    <div class="col-lg-12">
                        <div id="post-modal-data" class="iq-card">
                            <div class="iq-card-header d-flex justify-content-between">
                                <div class="iq-header-title">
                                    <h6 class="card-title">Create Post</h6>
                                </div>
                            </div>
                            <div class="iq-card-body" data-toggle="modal" data-target="#post-modal">
                                <div class="d-flex align-items-center">
                                    <div class="user-img">
                                        <img v-if="!!profileImage" :src="'/public/uploads/profileImage/' + profileImage" class="avatar-60 rounded-circle img-fluid">
                                        <img v-else src="https://templates.iqonic.design/socialv/bs5/html/dist/assets/images/page-img/profile-bg1.jpg" class="avatar-60 rounded-circle img-fluid">
                                    </div>
                                    <form class="post-text ml-3 w-100">
                                        <input type="hidden" v-model="GroupDetail.id">
                                        <input type="text" class="form-control rounded" v-model="postContent" placeholder="Write something here..." style="border:none;">
                                        <small class="text-danger">{{ error_postContent}}</small>
                                    </form>
                                </div>
                                <hr style="height:0px;">
                                <div class="row">
                                    <div class="col-md-9">
                                        <!-- <ul class="post-opt-block d-flex align-items-center list-inline m-0 p-0">
                                            <li class="iq-bg-primary rounded p-2 pointer mr-3">
                                                <img :src="'../assets/images/07.png'" alt="icon" class="img-fluid"> Photo
                                            </li>
                                        </ul> -->
                                    </div>
                                    <div class="col-md-3 text-right">
                                        <button class="btn btn-info" v-on:click="postShare">
                                            <span v-if="Postloader" class="spinner-border spinner-border-sm" role="status"><span class="sr-only">Loading...</span></span> 
                                            Post
                                        </button>
                                        <p v-show="postVisible">{{PostStatus}}</p>
                                    </div>
                                </div>                              
                                
                            </div>
                        </div>
                        
                        <div class="iq-card">
                            <div class="iq-card-body">
                                <div v-for="(GroupPost,index) in GroupPostsList" :key="GroupPost.id" :index="index" class="post-item">
                                    <span v-for="(groupUsrDetail,index2) in GroupPostByMembers" :key="groupUsrDetail.id" :index2="index2">
                                        <div class="user-post-data pt-3 pr-3 pb-3 pl-0 mt-4" v-if="groupUsrDetail.id == GroupPost.usersID">
                                            <div class="d-flex flex-wrap">
                                                <div class="media-support-user-img mr-3">
                                                    <img class="rounded-circle img-fluid" v-if="!!groupUsrDetail.profileImage" :src="'/public/uploads/profileImage/' + groupUsrDetail.profileImage" alt="avatar">
                                                    <img class="rounded-circle img-fluid" v-else src="https://cdn.pixabay.com/photo/2015/03/04/22/35/avatar-659652__340.png" alt="avatar">
                                                </div>
                                                <div class="media-support-info mt-2">
                                                    <h5 class="mb-0 d-inline-block"><a href="" class="">{{groupUsrDetail.name}}</a></h5>
                                                    <p class="mb-0"><i class="fa fa-clock"></i> {{GroupPost.postDates}}</p>
                                                </div>
                                            </div>                                                                              
                                        </div>
                                    </span>
                                    <div class="user-post">
                                        <p class="pt-0 pr-3 pb-3 pl-0">{{GroupPost.postContent}}</p>
                                        <a v-if="!!GroupPost.postMedia" href="javascript:void();">
                                            <img :src="'/public/assets/images/52.jpg'" alt="post-image" class="img-fluid w-100" />
                                        </a>
                                    </div>
                                    <div class="comment-area mt-3">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="like-block position-relative d-flex align-items-center">
                                                <div class="d-flex align-items-center">
                                                    <div class="like-data" v-on:click="GroupPostLike(GroupPost.id, index)">
                                                        <span>
                                                            <i class="fa-solid fa-thumbs-up" style="color:#407fff;"></i>                                                                                                                                                                        
                                                        </span>
                                                    </div>
                                                    <div class="total-like-block ml-2 mr-3" v-on:click="GroupPostLike(GroupPost.id, index)">
                                                        {{PostLikeCount[index]}}
                                                    </div>
                                                </div>
                                                <div class="total-comment-block">
                                                    <span>
                                                        <i class="fa fa-comment"></i> {{PostCommentCount[index]}} Comment
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <!--------------------- comments list----------------------------->
                                        <hr style="height: 0px;margin-top: 5px;margin-bottom: 5px;">
                                        <span>
                                            <p class="mb-2" style="font-weight: 600;font-size: 13px;">Comments</p>
                                        </span>
                                        <!--------------------- end comments list----------------------------->
                                        <hr style="height: 0px; margin-top: 5px; margin-bottom: 5px;">
                                        <div class="d-flex align-items-center mt-0">                                        
                                            <div class="user-img mr-2">
                                                <img v-if="!!profileImage" :src="'/public/uploads/profileImage/' + profileImage" class="avatar-60 rounded-circle img-fluid" style="width:20px;height:20px;">
                                                <img v-else src="https://templates.iqonic.design/socialv/bs5/html/dist/assets/images/page-img/profile-bg1.jpg" class="avatar-60 rounded-circle img-fluid" style="width:20px;height:20px;">
                                            </div>                                   
                                            <div class="row w-100">
                                                <div class="col-md-12">
                                                    <input type="text" v-on:keydown.enter.prevent='GroupPostComment(GroupPost.id, index)' class="form-control rounded" v-model="postComment" placeholder="Write a comment…" style="border:none;">
                                                </div>                                                
                                            </div>
                                        </div>
                                        <hr style="height: 0px; margin-top: 5px; margin-bottom: 5px;">
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
    name: "GroupDetail",
    components: {
        MemberHeader,
        MemberMenus
    },
    props: { 
        groupID: String         
    },   
    data() {
        return {
            isLoggedIn: false,
            loader:false,
            moment: moment,
            Postloader:false,
            postVisible:false,
            PostStatus:'', 
            GroupDetail: {},
            totalGroupMember:String,
            groupsList:[],
            CheckGroupJoin:String,
            statusVisible: false, 
            postContent:'',
            GroupPostsList:[],
            GroupPostByMembers:[],
            error_postContent : "",
            PostLikeCount : [],
            PostCommentCount : [],
        }
    },
    methods: {
        jonGroup(GroupID){
            this.loader=true;           
            axios.post(`/api/joinGroup`, {
                group_id: GroupID,
                user_id :this.userid,
            }).then((response) => { 
                this.resquestStatus = response.data.resquestStatus;     
                if(response.data.resquestStatus=='Joined'){
                    this.totalGroupMember = response.data.totalGroupMembers;                    
                }
                this.statusVisible = true;              
                this.loader = false;
                setTimeout(() => this.statusVisible = false, 3000);               
            }).catch(error => {
            });
        },
        GetpostShare(){
            axios.get(`/api/groupInfo/${this.groupID}`).then((response) => {           
                this.GroupDetail = response.data.groupDetails;
                this.totalGroupMember = response.data.groupMemberSum;
                this.CheckGroupJoin = response.data.userJoinGroup;
                this.GroupPostsList = response.data.groupPosts;
                this.GroupPostByMembers = response.data.groupPostUsers;
            }).catch((err) => console.error(err));
        },
        postShare(){
            this.Postloader = true;
            axios.post(`/api/groupPostShare`, {
                groupsid:this.GroupDetail.id,
                postContent: this.postContent
            }).then((response) => {                
                this.Postloader = false;
                this.postVisible = true;
                this.postContent = '';
                this.PostStatus = response.data.postShareStatus;
                //this.GroupPostsList.push(response.data.GroupPostShare);
                this.GetpostShare();
                setTimeout(() => this.postVisible = false, 3000);
            }).catch(error => { 
                this.error_postContent = error.response.data.error.postContent[0];
                setTimeout(() => this.error_postContent = '', 3000);               
                this.Postloader=false;                
            });
        },
        GroupPostLike(postIDs,index){
            axios.post(`/api/GroupPostLike`, {
                postID : postIDs,
            }).then((response) => {                    
                this.PostLikeCount[index] = response.data.TotalLike;
            }).catch(error => {
            });
        },
        GroupPostComment(GroupPostCommentIDs,index){
            //console.log('postID : ',CommentPostIDs ,'Index no : ',index, 'comment : ',this.postComment);                                            
            axios.post(`/api/UserGroupPostComment`, {
                CommentGroupPostID : GroupPostCommentIDs,
                GroupPostComment : this.postComment,
            }).then((response) => { 
                this.postComment = ''; 
                this.GetpostShare();                                 
                this.PostCommentCount[index] = response.data.PostCommentTotal;
            }).catch(error => {
            });           
        },
        GetGroupPostCommentsList(){
            axios.get(`/api/GetUserPosts`).then((response) => {                    
                this.Userposts = response.data.userAllPosts;
                this.postAllcomments = response.data.AllPostsComments;
                this.CommetOnPostByUsers = response.data.CommetedByUsers;
            }).catch((err) => console.error(err));
        },
        getAllGroupPosts(){
            axios.get(`/api/groupInfo/${this.groupID}`).then((response) => {           
            this.GroupDetail = response.data.groupDetails;
            this.totalGroupMember = response.data.groupMemberSum;
            this.CheckGroupJoin = response.data.userJoinGroup;
            this.GroupPostsList = response.data.groupPosts;
            this.GroupPostByMembers = response.data.groupPostUsers;
        }).catch((err) => console.error(err));
        }
    },
    created() { 
        this.getAllGroupPosts();
        window.scrollTo({
            top: 280,
            behavior: 'smooth',
        })
        this.getAllGroupPosts();      
        axios.get(`/api/groups`).then((response) => {                    
            this.groupsList = response.data.allGroups;
        }).catch((err) => console.error(err));

        if (window.Laravel.isLoggedin) {
            this.isLoggedIn = true
        }
        if(window.Laravel.user) {
            this.userid = window.Laravel.user.id;
            this.id = window.Laravel.user.id,
            this.name = window.Laravel.user.name,
            this.profileImage = window.Laravel.user.profileImage                              
        }      
    },
    mounted(){
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
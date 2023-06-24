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
                            <div class="iq-card-body pt-0">
                                <div class="row">
                                    <div class="col-lg-3">                
                                        <div class="iq-card">                        
                                            <div class="iq-card-header d-flex justify-content-between mt-3" style="min-height:0px;">
                                                <div class="iq-header-title">
                                                    <h6 class="card-title" style="font-weight: normal;font-size: 18px;">Group List</h6>
                                                </div>
                                            </div> 
                                            <div class="iq-card-body pb-0">
                                                    <ul class="profile-img-gallary d-flex flex-wrap p-0 m-0">
                                                        <li class="col-md-6 col-6 pl-2 pr-0 pb-0" v-for="(groups,index) in groupsList" :key="groups.id" :index="index">
                                                            <router-link :to="{name: 'group', 
                                                                params: { 
                                                                    groupslug: groups.groupSlug
                                                                }
                                                            }" style="color: #333;text-decoration: none;">
                                                                <img v-if="!!groups.groupImage" :src="'/public/uploads/groupsImages/' + groups.groupImage" :alt="groups.groupSlug" class="img-fluid rounded" style="height: 80px;width: 100%;">
                                                                <img v-else src="https://templates.iqonic.design/socialv/bs5/html/dist/assets/images/page-img/gi-1.jpg" :alt="groups.groupSlug" class="img-fluid rounded" style="height: 80px;width: 100%;">
                                                                <h6 class="mt-2" style="font-size: 14px;font-weight: normal;">{{groups.groupName}}</h6> 
                                                            </router-link>                                                                           
                                                        </li>                                    
                                                    </ul>
                                                </div>
                                            <hr style="height:0px;">                      
                                            <div class="iq-card-header d-flex justify-content-between mt-3" style="min-height:0px;">
                                                <div class="iq-header-title">
                                                    <h6 class="card-title" style="font-weight: normal;font-size: 18px;">Friends List</h6>
                                                </div>
                                            </div>
                                            <div class="iq-card-body">
                                                <ul class="profile-img-gallary d-flex flex-wrap p-0 m-0">
                                                    <li v-for="myfrindList in myFriendsLists" :key="myFriendsLists.id" class="col-md-6 col-6 pl-2 pr-0 pb-3">
                                                        <a href="javascript:void();">
                                                            <img v-if="!!myfrindList.profileImage" :src="'/public/uploads/profileImage/' + myfrindList.profileImage" alt="profile-bg" class="img-fluid rounded" style="height: 80px;width: 100%;">
                                                            <img v-else src="https://cdn.pixabay.com/photo/2015/03/04/22/35/avatar-659652__340.png" alt="profile-bg" class="img-fluid rounded" style="height: 80px;width: 100%;">
                                                        </a>
                                                        <h6 class="mt-2" style="font-size: 14px;font-weight: normal;">{{myfrindList.name}}</h6>
                                                    </li>                              
                                                </ul>
                                            </div>
                                        </div>
                                </div>
                                <div class="col-lg-9">
                                        <div id="post-modal-data" class="iq-card">
                                            <div class="iq-card-header d-flex justify-content-between">
                                                <div class="iq-header-title">
                                                    <h6 class="card-title" style="font-weight: normal;font-size: 18px;">Create Post</h6>
                                                </div>
                                            </div>
                                            <div class="iq-card-body" data-toggle="modal" data-target="#post-modal">
                                                <div class="d-flex align-items-center">
                                                    <div class="user-img">
                                                        <img v-if="!!profileImage" :src="'/public/uploads/profileImage/' + profileImage" class="avatar-60 rounded-circle img-fluid">
                                                        <img v-else src="https://cdn.pixabay.com/photo/2015/03/04/22/35/avatar-659652__340.png" class="avatar-60 rounded-circle img-fluid">
                                                    </div>
                                                    <form class="post-text ml-3 w-100">                                        
                                                        <input type="text" class="form-control rounded" v-model="postContent" placeholder="Write something here..." style="border:none;">
                                                        <small class="text-danger">{{ error_postContent}}</small>
                                                    </form>
                                                </div>
                                                <hr style="height:0px;">
                                                <div class="row">
                                                    <div class="col-md-11">
                                                        <!--ul class="post-opt-block d-flex align-items-center list-inline m-0 p-0">
                                                            <li class="iq-bg-primary rounded p-2 pointer mr-3"><img :src="'../assets/images/07.png'" alt="icon" class="img-fluid"> Photo</li>
                                                        </ul--> 
                                                        <div class="custom-control pull-left custom-checkbox custom-checkbox-color custom-control-inline pl-0">                                            
                                                            <label class="" for="">Post As :  </label>
                                                        </div>

                                                        <article class="feature1">
                                                            <input type="checkbox" :value="'normal'" v-on:click="checkboxClick('normal')" v-model="ShareAsPost" id="normalPost"/>
                                                            <div><span>Normal</span></div>
                                                        </article>
                                                        
                                                        <article v-for="(groups,index) in groupsList" :key="groups.id" :index="index" class="feature1">
                                                            <input type="checkbox" :value="groups.id" v-on:click="checkboxClick(groups.id)" v-model="ShareAsPost" :id="index"/>
                                                            <div><span>{{groups.groupName}}</span></div>
                                                        </article>                                 
                                                        <p style="clear: both;"><small class="text-danger">{{ error_postShare}}</small> </p>                                                                       
                                                    </div>
                                                    <div class="col-md-1">
                                                        <p v-show="postVisible" class="text-success pull-left">{{PostStatus}}</p> 
                                                        <button class="custom_yellow_btn pull-right" v-on:click="postShare">
                                                            <span v-if="Postloader" class="spinner-border spinner-border-sm" role="status"><span class="sr-only">Loading...</span></span>
                                                            Post
                                                        </button> 
                                                    </div>
                                                </div>
                                                <!-------------------- User post area --------------------------------->
                                                <div class="post-item" v-for="(Userpost,index) in Userposts" :key="Userpost.id" :index="index">
                                                    <div class="user-post-data user-post-data pt-3 pr-3 pb-3 pl-0 mt-4">
                                                        <div v-for="(PostedByUserDetail,index3) in PostedByUsersDetail" :key="PostedByUserDetail.id" :index3="index3" class="d-flex flex-wrap"> 
                                                            <div class="media-support-user-img mr-2" v-if="PostedByUserDetail.id == Userpost.usersID" style="width:8%;">
                                                                <img class="rounded-circle img-fluid" v-if="!!PostedByUserDetail.profileImage" :src="'/public/uploads/profileImage/' + PostedByUserDetail.profileImage" alt="avatar">
                                                                <img class="rounded-circle img-fluid w-100" v-else :src="'https://cdn.pixabay.com/photo/2015/03/04/22/35/avatar-659652__340.png'" alt="avatar">
                                                            </div>                                        
                                                            <div class="media-support-info mt-2" v-if="PostedByUserDetail.id == Userpost.usersID">
                                                                <h5 class="mb-0 d-inline-block"><a href="" class="">{{PostedByUserDetail.name}}</a></h5>
                                                                <p class="mb-0"><i class="fa fa-clock"></i> {{moment(Userpost.created_at).fromNow()}}</p>
                                                            </div>                                        
                                                        </div>                                    
                                                    </div>
                                                    <div class="user-post">
                                                        <p class="pt-0 pr-3 pb-0 pl-0">{{Userpost.postContent}}</p>
                                                        <a v-if="!!Userpost.postMedia" href="javascript:void();">
                                                            <img :src="'/public/assets/images/52.jpg'" alt="post-image" class="img-fluid w-100" />
                                                        </a>
                                                    </div>
                                                    <div class="comment-area mt-0">
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <div class="like-block position-relative d-flex align-items-center">
                                                                <div class="d-flex align-items-center">
                                                                    <div class="like-data" v-on:click="UserPostLike(Userpost.id, index)">                                                    
                                                                        <span>
                                                                            <i class="fa-solid fa-thumbs-up" style="color:#407fff;"></i>                                                                                                              
                                                                        </span>                                                    
                                                                    </div>
                                                                    <div class="total-like-block ml-2 mr-3" v-on:click="UserPostLike(Userpost.id, index)">                                                                                                            
                                                                        <span>
                                                                            {{PostLikeCount[index]}}
                                                                        </span>                                                   
                                                                    </div>
                                                                </div>
                                                                <div class="total-comment-block">                                                
                                                                    <span>
                                                                        <i class="fa fa-comment"></i> {{PostCommentCount[index]}} Comment
                                                                    </span>                                                                                               
                                                                </div>                                            
                                                            </div>                                        
                                                        </div>
                                                        <!---------------------comments list----------------------------->
                                                        <hr style="height: 0px;margin-top: 5px;margin-bottom: 5px;">                                    
                                                        <span  v-if="PostCommentCount[index]!=0">
                                                            <p class="mb-2" style="font-weight: 600;font-size: 13px;">Comments</p>
                                                            <span v-for="(postCommentss,index2) in postAllcomments" :key="postCommentss.id" :index2="index2">
                                                                <!-- <p>{{postCommentss.Post_ID}},{{Userpost.id}}</p> -->
                                                                <div v-if="postCommentss.Post_ID == Userpost.id" class="user-post-data user-post-data pt-0 pr-3 pb-1 pl-0 mt-0">
                                                                    <div class="d-flex flex-wrap ml-2">
                                                                        <div class="media-support-user-img mr-2 mt-2">
                                                                            <img class="rounded-circle img-fluid" v-if="!!postCommentss.profileImage" :src="'/public/uploads/profileImage/' + postCommentss.profileImage" alt="avatar" style="height: 30px;width:30px;">
                                                                            <img class="rounded-circle img-fluid" v-else :src="'https://cdn.pixabay.com/photo/2015/03/04/22/35/avatar-659652__340.png'" alt="avatar" style="height: 30px;width:30px;">
                                                                        </div>                                                   
                                                                        <div class="media-support-info mt-0">
                                                                            <div class="row">
                                                                                <div class="col-md-6">
                                                                                    <p class="mb-0 d-inline-block" style="font-weight: 700;font-size: 13px;">{{postCommentss.name}} </p>
                                                                                    <p style="margin-bottom: 0;font-size: 13px;"><i class="fa fa-clock"></i> {{moment(postCommentss.created_at).fromNow()}}</p>
                                                                                </div>
                                                                                <div class="col-md-6 text-right">
                                                                                    <!--p v-if="postCommentss.User_ID == userid" class="mb-0 d-inline-block text-info mr-2" style="cursor: pointer;" v-on:click="EditPostComment(postCommentss.id)"><i class="fa fa-pencil"></i></p-->
                                                                                    <p v-if="postCommentss.User_ID == userid" class="mb-0 d-inline-block text-danger" style="cursor: pointer;" v-on:click="DeletePostComment(postCommentss.id)"><i class="fa fa-trash"></i></p>
                                                                                </div>
                                                                            </div>                                                      
                                                                        </div>
                                                                    </div> 
                                                                    <p class="ml-5">{{postCommentss.PostComment}}</p>                                                                                  
                                                                </div>                                            
                                                            </span>
                                                            <hr style="height: 0px;margin-top: 5px;margin-bottom: 5px;">
                                                        </span>                                    
                                                        <!-----------------------end comment list--------------------------->
                                                        <div class="d-flex align-items-center mt-0">                                        
                                                            <div class="user-img">
                                                                <img v-if="!!profileImage" :src="'/public/uploads/profileImage/' + profileImage" class="avatar-60 rounded-circle img-fluid" style="width:20px;height:20px;">
                                                                <img v-else src="https://cdn.pixabay.com/photo/2015/03/04/22/35/avatar-659652__340.png" class="avatar-60 rounded-circle img-fluid" style="width:20px;height:20px;">
                                                            </div>                                        
                                                            
                                                            <div class="row w-100">
                                                                <div class="col-md-12">
                                                                    <input type="text" v-on:keydown.enter.prevent='UserPostComment(Userpost.id, index)' class="form-control rounded" v-model="postComment" placeholder="Write a comment…" style="border:none;">
                                                                </div>
                                                                <!--div class="col-md-2 text-right">
                                                                    <button class="btn btn-info" style="margin-top:5px;" v-on:click="UserPostComment(Userpost.id, index)">Submit</button>
                                                                </div-->
                                                            </div>
                                                        </div>
                                                        <hr style="height: 0px; margin-top: 5px; margin-bottom: 5px;">
                                                    </div>
                                                </div> 
                                                <!-------------------- End User post area --------------------------------->                           
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
    name: "Timeline",
    components: {
        MemberHeader,
        MemberMenus
    },    
    data() {
        return { 
            isLoggedIn: false,
            loader:true,
            moment: moment, 
            myFriendsLists:[],
            no_friends:'',
            groupsList:[],
            ShareAsPost:[],
            Postloader:false,
            postVisible:false,
            PostStatus:'',
            error_postContent : "", 
            error_postShare : "",
            Userposts :[],
            PostLikeCount : [],
            PostCommentCount : [],
            postAllcomments :[], 
            PostedByUsersDetail :[],
            CommetOnPostByUsers :[],               
        }
    },
    methods: {
        GetUserPostShare(){
            axios.get(`/api/GetUserPosts`).then((response) => {                    
                this.Userposts = response.data.userAllPosts;
                this.postAllcomments = response.data.AllPostsComments;
                this.PostedByUsersDetail = response.data.PostByUsers;
                this.CommetOnPostByUsers = response.data.CommetedByUsers;
                this.PostsTotalCommentCound();
            }).catch((err) => console.error(err));
        },        
        postShare(){
            this.Postloader = true;
            axios.post(`/api/PostShare`, {
                postContent: this.postContent,
                postAs: this.ShareAsPost
            }).then((response) => {                 
                this.Postloader = false;
                this.postVisible = true;
                this.postContent = '';
                this.PostStatus = response.data.postShareStatus;
                setTimeout(() => this.PostStatus = '', 3000);
                this.GetUserPostShare();
            }).catch(error => {                                
                this.Postloader=false;
                this.error_postContent = error.response.data.error.postContent;
                this.error_postShare = error.response.data.error.postAs;                
                setTimeout(() => this.error_postContent = '', 3000);
                setTimeout(() => this.error_postShare = '', 3000);
            });
        },
        UserPostLike(postIDs,index){                       
            axios.post(`/api/UserPostLike`, {
                postID : postIDs,
            }).then((response) => {                    
                this.PostLikeCount[index] = response.data.TotalLike;
            }).catch(error => {
            });           
        },
        UserPostComment(CommentPostIDs,index){
            //console.log('postID : ',CommentPostIDs ,'Index no : ',index);                                            
            axios.post(`/api/UserPostComment`, {
                CommentPostID : CommentPostIDs,
                UserPostComment : this.postComment,
            }).then((response) => { 
                this.postComment = ''; 
                this.GetPostCommentsList();                                 
                this.PostCommentCount[index] = response.data.PostCommentTotal;
            }).catch(error => {
            });           
        },
        GetPostCommentsList(){
            axios.get(`/api/GetUserPosts`).then((response) => {                    
                this.Userposts = response.data.userAllPosts;
                this.postAllcomments = response.data.AllPostsComments;
                this.CommetOnPostByUsers = response.data.CommetedByUsers;
            }).catch((err) => console.error(err));
        },
        PostsTotalCommentCound(){
            axios.get(`/api/postsComments`).then((response) => {                                   
                this.Userposts = response.data.userAllPosts;
                this.PostCommentCount = response.data.PostCommentTotal;
            }).catch((err) => console.error(err));
        },
        DeletePostComment(PostCommentID){
            //console.log('Comment ID : ',PostCommentID);
            axios.post(`/api/DeletePostComment`, {
                CommentID : PostCommentID,
            }).then((response) => {                    
                this.GetPostCommentsList();
                this.PostsTotalCommentCound();
            }).catch(error => {
            });
        },
        EditPostComment(PostCommentIDs){           
            console.log('comment ID :',PostCommentIDs);
        }
    },
    mounted(){
        Echo.private('chat')
        .listen('PostEvent',(e) => {
            console.log('push posts : ', e.posts); 
            this.Userposts.push(e.posts);                                
        });

        // Echo.private('chat')
        // .listen('PostCommentEvent',(e) => {
        //     //console.log('push posts comments : ', e.comment); 
        //     this.postAllcomments.push(e.comment);                                
        // });     
        
    },
    created() { 
        window.scrollTo({
            top: 280,
            behavior: 'smooth',
        })
              
        if (window.Laravel.isLoggedin) {
            this.isLoggedIn = true
        }
        if(window.Laravel.user) {
            this.userid = window.Laravel.user.id;
            this.id = window.Laravel.user.id,
            this.name = window.Laravel.user.name,
            this.profileImage = window.Laravel.user.profileImage
            axios.get(`/api/friendsList`).then((response) => {
                this.loader = false;
                this.myFriendsLists = response.data.senderList;
                this.no_friends= response.data.nofriends;                    
            }).catch((err) => console.error(err));

            axios.get(`/api/MemberGroups`).then((response) => {                    
                this.groupsList = response.data.allGroups;
            }).catch((err) => console.error(err));

            axios.get(`/api/GetUserPosts`).then((response) => {                    
                this.Userposts = response.data.userAllPosts;
                this.postAllcomments = response.data.AllPostsComments;
                this.PostedByUsersDetail = response.data.PostByUsers;
                this.CommetOnPostByUsers = response.data.CommetedByUsers;
            }).catch((err) => console.error(err));

            axios.get(`/api/postsLikes`).then((response) => {                    
                this.Userposts = response.data.userAllPosts;
                this.PostLikeCount = response.data.TotalLike;
            }).catch((err) => console.error(err));
            
            axios.get(`/api/postsComments`).then((response) => {                                   
                this.Userposts = response.data.userAllPosts;
                this.PostCommentCount = response.data.PostCommentTotal;
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
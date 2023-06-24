<template>   
    <main>
        <section class="sec-padding" style="padding-top:0px;padding-bottom:0px;">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="iq-card">
                            <MemberHeader/>
                            <MemberMenus/>                            
                        </div>                                                
                    </div>
                    <div class="col-sm-12">
                        <div class="iq-card">
                            <div class="iq-card-body">            
                                <div class="row">
                                    <div class="col-md-3">
                                        <UserSettingMenus/>
                                    </div>
                                    <div class="col-md-9 pl-4">
                                        <input type="hidden" v-model="id"> 
                                        <h6>Password</h6>
                                        <hr>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="facebookURL">Facebook URL:</label>
                                                    <input type="text" class="form-control" id="facebookURL" placeholder="" v-model="facebookURL" style="border:1px solid #333;">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group ">
                                                    <label for="twitterURL">Twitter URL:</label>
                                                    <input type="text" class="form-control" id="twitterURL" placeholder="" v-model="twitterURL" style="border:1px solid #333;">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group ">
                                                    <label for="instagramURL">Instagram URL:</label>
                                                    <input type="text" class="form-control" id="instagramURL" placeholder="" v-model="instagramURL" style="border:1px solid #333;">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="linkedinURL">Linkedin URL:</label>
                                                    <input type="text" class="form-control" id="twitterURL" placeholder="" v-model="linkedinURL" style="border:1px solid #333;">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">           
                                            <button v-on:click="updateSocailLinks" class="custom_yellow_btn">
                                                <span v-if="loaderSocial" class="spinner-border spinner-border-sm" role="status"><span class="sr-only">Loading...</span></span>
                                                Save
                                            </button>                                                       
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
import MemberHeader from "../MemberHeader.vue";
import MemberMenus from "../MemberMenus.vue";
import UserSettingMenus from "../Settings/UserSettingMenus.vue";
export default {
    name: "profile-socail-link",
    components: {
        MemberHeader,
        MemberMenus,
        UserSettingMenus
    },
    data() {
        return {
            loader:false,
            isLoggedIn: false, 
            statusVisible: false,
            loaderSocial:false,
            facebookURL :'',
            twitterURL :'',
            instagramURL :'',
            linkedinURL :'',
            profileImage: '',
            ProfileCover: '',
        }
    },
    methods: { 
        updateSocailLinks(){
            this.loaderSocial=true;
            if(window.Laravel.user) {
                axios.post(`/api/user/updateSocailLinks`, {
                    userID: this.id,
                    facebookURL : this.facebookURL,
                    twitterURL : this.twitterURL,
                    instagramURL : this.instagramURL,
                    linkedinURL : this.linkedinURL,                   
                }).then((response) => {
                    this.loaderSocial=false;
                    this.facebookURL = response.data.userInfo.facebookURL;
                    this.twitterURL = response.data.userInfo.twitterURL;
                    this.instagramURL = response.data.userInfo.facebookURL;
                    this.linkedinURL = response.data.userInfo.linkedinURL;  
                    this.updateSocailMsgs = response.data.updateSocailsLinkMsg;
                    this.statusVisible = true,                    
                    setTimeout(() => {
                        this.statusVisible = false;   
                    }, 2000); 
                }).catch(error =>{                    
                })
            }
        },
        memberBasicInfo(){
            axios.get(`/api/memberBasicDetail`).then((response) => {
                this.facebookURL = response.data.userInfo.facebookURL,
                this.instagramURL = response.data.userInfo.instagramURL,
                this.linkedinURL = response.data.userInfo.linkedinURL,
                this.twitterURL = response.data.userInfo.twitterURL, 
                this.profileImage = response.data.userInfo.profileImage,
                this.ProfileCover = response.data.userInfo.ProfileCover
            }).catch((err) => console.error(err));
        }
    },
    created() {
        this.memberBasicInfo();                
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
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
                                                    <label for="password">Password:<sup class="text-danger">*</sup></label>
                                                    <input type="password" class="form-control" id="password" placeholder="" v-model="password" style="border:1px solid #333;">
                                                    <small class="text-danger">{{ error_password }} </small>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="ConfirmPassword">Confirm Password:<sup class="text-danger">*</sup></label>
                                                    <input type="password" class="form-control" id="ConfirmPassword" placeholder="" v-model="ConfirmPassword" style="border:1px solid #333;">
                                                    <small class="text-danger">{{ error_ConfirmPassword }} </small>
                                                </div>
                                            </div>
                                            <div class="form-group">           
                                                <button v-on:click="updatePassword" class="custom_yellow_btn">
                                                    <span v-if="loader" class="spinner-border spinner-border-sm" role="status"><span class="sr-only">Loading...</span></span>
                                                    Save
                                                </button>
                                                <span v-show="statusVisible" class="text-success ml-3">{{ updatePasswordMsgs }}</span>    
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
import MemberHeader from "../MemberHeader.vue";
import MemberMenus from "../MemberMenus.vue";
import UserSettingMenus from "../Settings/UserSettingMenus.vue";
export default {
    name: "profile-password",
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
            updateMsgs: '',
            password: "",            
            ConfirmPassword: "",

            error_password: "",
            error_ConfirmPassword: "", 

            name: "",
            profileImage: "",
            ProfileCover: "",
            facebookURL: '',
            twitterURL: '',
            instagramURL: '',
            linkedinURL : '',
        }
    },
    methods: { 
        updatePassword(){
            this.loader=true;
            if(window.Laravel.user) {
                axios.post(`/api/user/updatePassword`, {
                    userID: this.id,
                    password: this.password,
                    ConfirmPassword: this.ConfirmPassword,                    
                }).then((response) => {
                    this.password = "";
                    this.ConfirmPassword = ""; 
                    this.updatePasswordMsgs = response.data.updatePassMsg;
                    this.statusVisible = true;
                    this.loader=false,
                    setTimeout(() => {
                        this.statusVisible = false;   
                    }, 2000);
                }).catch(error =>{
                    this.loader=false;
                    this.error_password = error.response.data.error.password,
                    this.error_ConfirmPassword = error.response.data.error.ConfirmPassword
                })
            }
        },
        memberBasicInfo(){
            axios.get(`/api/memberBasicDetail`).then((response) => {
                this.name = response.data.userInfo.name,
                this.firstName = response.data.userInfo.firstName,
                this.lastName =response.data.userInfo.lastName,
                this.address1 = response.data.userInfo.address1,
                this.address22 = response.data.userInfo.address2,
                this.stateProvince = response.data.userInfo.state,
                this.postalCode = response.data.userInfo.postal_code,
                this.phoneNumber = window.Laravel.user.mobile,
                this.profileImage = response.data.userInfo.profileImage,
                this.ProfileCover = response.data.userInfo.ProfileCover,
                this.facebookURL = response.data.userInfo.facebookURL,
                this.twitterURL = response.data.userInfo.twitterURL,
                this.instagramURL = response.data.userInfo.instagramURL,
                this.linkedinURL = response.data.userInfo.linkedinURL
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
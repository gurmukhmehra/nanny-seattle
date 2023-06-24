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
                                        <h6>Info</h6>
                                        <hr>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="firstName">First Name:<sup class="text-danger">*</sup></label>
                                                    <input type="text" class="form-control" id="firstName" placeholder="" v-model="firstName" style="border:1px solid #333;">
                                                    <small class="text-danger">{{ error_firstName }} </small>                                                                   
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="lastName">Last Name:<sup class="text-danger">*</sup></label>
                                                    <input type="text" class="form-control" id="lastName" placeholder="" v-model="lastName" style="border:1px solid #333;">
                                                    <small class="text-danger">{{ error_lastName }} </small>                                                                    
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="address1">Address Line 1:<sup class="text-danger">*</sup></label>
                                                    <input type="text" class="form-control" id="address1" placeholder="" v-model="address1" style="border:1px solid #333;">
                                                    <small class="text-danger">{{ error_address1 }} </small>                                                                   
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="address2">Address Line 2:</label>
                                                    <input type="text" class="form-control" id="address22" placeholder="" v-model="address22" style="border:1px solid #333;">                                                                    
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group  mt-3">
                                                    <label for="stateProvince">State/Province:<sup class="text-danger">*</sup></label>
                                                    <input type="text" class="form-control" id="stateProvince" placeholder="" v-model="stateProvince" style="border:1px solid #333;">
                                                    <small class="text-danger">{{ error_stateProvince }} </small>                                                                    
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group  mt-3">
                                                    <label for="postalCode">Zip/Postal Code:<sup class="text-danger">*</sup></label>
                                                    <input type="text" class="form-control" id="postalCode" placeholder="" v-model="postalCode" style="border:1px solid #333;">
                                                    <small class="text-danger">{{ error_postalCode }} </small>                                                                    
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group  mt-3">
                                            <label for="phoneNumber">Phone number:<sup class="text-danger">*</sup></label>
                                            <input type="text" class="form-control" id="phoneNumber" placeholder="" v-model="phoneNumber" style="border:1px solid #333;">
                                            <small class="text-danger">{{ error_phoneNumber }} </small>                                                                                                                      
                                        </div> 
                                        <div class="form-group  mt-3">           
                                            <button v-on:click="updateBasicInfo" class="custom_yellow_btn">
                                                <span v-if="loader" class="spinner-border spinner-border-sm" role="status"><span class="sr-only">Loading...</span></span>
                                                Save                                    
                                            </button>                                                              
                                            <spna v-show="statusVisible" class="text-success ml-3">{{ updateMsgs }}</spna>    
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
    name: "UserSettings",
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
            firstName: "",
            lastName: "",
            address1: "",
            address22: "",
            stateProvince: "",
            postalCode: "",
            phoneNumber: "",
            updateMsgs: '',
            password: "",
            profileImage:"",
            ProfileCover:"",

            facebookURL: '',
            twitterURL: '',
            instagramURL: '',
            linkedinURL : '',
            
            ConfirmPassword: "",
            error_firstName: "",
            error_lastName: "",
            error_address1: "",
            error_stateProvince: "",
            error_postalCode: "",
            error_phoneNumber: "",
            error_password: "",
            error_ConfirmPassword: "", 
        }
    },
    methods: { 
        updateBasicInfo() {
            this.loader=true;
            if(window.Laravel.user) {
                axios.post(`/api/user/updateBasicInfo`, {
                    userID: this.id,
                    firstName: this.firstName,
                    lastName: this.lastName,
                    address1: this.address1,
                    address22: this.address22,
                    stateProvince: this.stateProvince,
                    postalCode: this.postalCode,
                    phoneNumber: this.phoneNumber,
                }).then((response) => {                                   
                    this.firstName = response.data.userInfo.firstName;
                    this.lastName = response.data.userInfo.lastName;
                    this.address1 = response.data.userInfo.address1;
                    this.address22 = response.data.userInfo.address2;
                    this.stateProvince = response.data.userInfo.state;
                    this.postalCode = response.data.userInfo.postal_code;
                    this.phoneNumber = response.data.userInfo.mobile;
                    this.updateMsgs = response.data.updateMsg;
                    this.statusVisible = true;
                    this.loader=false,
                    setTimeout(() => {
                        this.statusVisible = false;   
                    }, 2000);                   
                }).catch(error =>{
                    this.error_firstName = error.response.data.error.firstName,
                    this.error_lastName = error.response.data.error.lastName,
                    this.error_address1 = error.response.data.error.address1,
                    this.error_stateProvince = error.response.data.error.stateProvince,
                    this.error_postalCode = error.response.data.error.postalCode,
                    this.error_phoneNumber = error.response.data.error.phoneNumber
                })
            }
        },
        memberBasicInfo(){
            axios.get(`/api/memberBasicDetail`).then((response) => {
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
<template>
    <main>    
        <div class="container">
            <h4 class="text-center mt-2">Login</h4>
            <hr>
            <form v-on:submit.prevent="login" class="was-validated">
                <div class="form-group mb-3">
                    <label for="uname">Username/E-mail<sup class="text-danger">*</sup>:</label>
                    <input type="text" class="form-control" id="uname" autocomplete="nope" placeholder="Enter username" v-model="username" required/>
                </div>
                <div class="form-group mb-3">
                    <label for="password">Password<sup class="text-danger">*</sup>:</label>
                    <input type="password" class="form-control" id="password" autocomplete="nope" placeholder="Enter password" v-model="password" required/>
                </div>
                <button class="custom_yellow_btn mb-3">Login </button>
                <a href="" v-on:click="openForgotPasswordModel" style="margin-left:15px;" data-backdrop="static" data-keyboard="false" data-toggle="modal" data-target="#ModalLoginForm">Forgot Password?</a>
                <span v-if="loader" class="spinner-border spinner-border-sm ml-3 text-primary" role="status"><span class="sr-only">Loading...</span></span>
                <small v-show="loginSuccess" class="text-success ml-3" style="font-size:25px;"> wait..</small>             
                <small v-show="loginRes" class="text-danger errorMsg" style="margin-left: 15px;font-size: 18px;">{{ error }} </small>
            </form>
            <!-- Modal HTML Markup -->
            <div id="ModalLoginForm" class="modal fade">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 v-if="forgotPasswordForm" class="modal-title">Password Reset</h5>
                            <h5 v-if="ChangePasswordForm" class="modal-title">Change Password </h5>
                            <button type="button" class="close text-danger" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form v-if="forgotPasswordForm" v-on:submit.prevent="forgotPassword" class="was-validated">
                                <div class="form-group mb-3">
                                    <label for="">Enter Your Username or Email Address<sup class="text-danger">*</sup>:</label>
                                    <input type="text" class="form-control" id="" autocomplete="nope" placeholder="Enter Username or Email Address" v-model="usernameOrEmail"/>
                                </div>
                                <div class="form-group row mb-3">
                                    <div class="col-md-3">
                                        <button v-on:click="register" class="custom_yellow_btn mb-3">Submit</button>                                        
                                    </div>
                                    <div class="col-md-9">
                                        <p style="font-size:20px;">
                                            <small class="text-danger">{{ error_UsernameOrEmail }} </small>
                                            <small class="text-success">{{ UsernameOrEmailMatch }} </small>
                                            <span v-if="loader2" class="spinner-border spinner-border-sm ml-3 text-primary" role="status"><span class="sr-only">Loading...</span></span>
                                        </p>
                                    </div>
                                </div>                                
                            </form>
                            <!-------------------- Change Password Form ------------------------->
                            <form v-if="ChangePasswordForm" class="was-validated">
                                <div class="form-group mb-3">
                                    <label for="">New Password<sup class="text-danger">*</sup>:</label>
                                    <input type="hidden" class="form-control" v-model="userInfoID">
                                    <input type="password" class="form-control" id="" autocomplete="nope" placeholder="Enter new password.." v-model="newPassword"/>
                                    
                                </div>
                                <div class="form-group mb-3">
                                    <label for="">Confirm New Password<sup class="text-danger">*</sup>:</label>
                                    <input type="password" class="form-control" id="" autocomplete="nope" placeholder="Enter confirm new password.." v-model="ConfirmNewPassword"/>
                                    
                                </div>
                                <div class="form-group row mb-3">
                                    <div class="col-md-3">
                                        <button v-on:click="ChangePassword" class="custom_yellow_btn mb-3">Submit</button>                                        
                                    </div>
                                    <div class="col-md-9">
                                        <p style="font-size:20px;">                                            
                                            <span v-if="loader2" class="spinner-border spinner-border-sm ml-3 text-primary" role="status"><span class="sr-only">Loading...</span></span>
                                            <small class="text-success">{{ passwordChanedStatus }} </small>
                                            <small class="text-danger">{{ error_password }} </small>
                                            <small v-if="watingRes" class="text-success">wait...</small>                                            
                                        </p>
                                    </div>
                                </div>                                
                            </form>
                            <!-------------------- Change Password Form ------------------------->
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Modal HTML Markup -->
        </div>
    </main>
</template>

<script>  
    const axios = require('axios');  
    export default {
        data()
        {
            return { 
                loader:false,
                loginRes:false,
                loginSuccess:false,             
                username: "",
                password: "",
                error: null,
                forgotPasswordForm: true,
                ChangePasswordForm: false,
                usernameOrEmail:"",
                loader2:false,
                error_UsernameOrEmail:"",
                UsernameOrEmailMatch:"",

                userInfoID :"",
                newPassword:"",
                ConfirmNewPassword:"",
                error_password:"",
                passwordChanedStatus:"",
                watingRes:false              
            }
        },
        methods:{
            login(e)
            { 
                e.preventDefault()
                this.loader=true;                
                if (this.password.length > 0) {
                    this.$axios.get('/sanctum/csrf-cookie').then(response => {
                            this.$axios.post('api/login', {
                            username: this.username,
                            password: this.password
                        }).then(response => {                            
                            if (response.data.success) {
                                this.loader=false;
                                this.loginSuccess = true;
                                if(response.data.userDetails.memberType ==='care_provider_member'){
                                    setTimeout(() => {  
                                        this.loginSuccess = false;
                                        this.$router.go('/logged-in-provider')   
                                    }, 3000);
                                } else if(response.data.userDetails.memberType ==='family_parent_member'){
                                    setTimeout(() => {  
                                        this.loginSuccess = false;
                                        this.$router.go('/logged-in-family')   
                                    }, 3000);
                                } else if(response.data.userDetails.memberType ==='agency_member'){
                                    setTimeout(() => {  
                                        this.loginSuccess = false;
                                        this.$router.go('/logged-in-agency')   
                                    }, 3000);
                                } else {
                                    setTimeout(() => {  
                                        this.loginSuccess = false;
                                        this.$router.go('/UserDashboard')   
                                    }, 3000);
                                }
                                                                
                            } else {                               
                                this.loginRes = true;
                                this.loader=false;                                                               
                                this.error = response.data.message;
                                setTimeout(() => {  
                                    this.loginRes = false;   
                                }, 3000);                                                                                           
                            }
                        })
                        .catch(function (error) {
                            //console.error(error);
                        });
                    })
                }
                //this.emitMethod()
            },
            openForgotPasswordModel(){
                this.forgotPasswordForm = true;
                this.ChangePasswordForm = false;
            },
            forgotPassword() { 
                this.loader2 = true;           
                axios.post(`/api/forgotPassword`, {
                    usernameOrEmail : this.usernameOrEmail
                }).then((response) => {
                    this.loader2 = false;
                    if(response.data.UserExit=='Username or email match') {                                             
                        this.UsernameOrEmailMatch = response.data.UserExit,
                        this.userInfoID = response.data.UserDetail.id
                        setTimeout(() => {  
                            this.usernameOrEmail=""; 
                            this.UsernameOrEmailMatch = "";
                            this.forgotPasswordForm = false;
                            this.ChangePasswordForm = true;                              
                        }, 3000);
                    } else {
                        this.error_UsernameOrEmail = response.data.UserExit
                        setTimeout(() => {
                            this.usernameOrEmail="";   
                            this.error_UsernameOrEmail = "";  
                        }, 3000);
                    }
                }).catch(error => {
                    this.loader2 = false,
                    this.error_UsernameOrEmail = error.response.data.error.usernameOrEmail[0]
                    setTimeout(() => {  
                        this.error_UsernameOrEmail = "";   
                    }, 3000); 
                });
            },
            ChangePassword(e)
            {
                e.preventDefault();
                this.loader2 = true;
                axios.post(`/api/ChangePassword`, {
                   UserID : this.userInfoID,
                   NewPassword : this.newPassword,
                   ConfirmPassword : this.ConfirmNewPassword
                }).then((response) => {
                    this.loader2 = false,
                    this.passwordChanedStatus = response.data.passwordChaned
                    setTimeout(() => {  
                        this.newPassword = ""; 
                        this.ConfirmNewPassword = ""; 
                        this.error_password = ""; 
                        this.error_ConfirmPassword = "";  
                        this.passwordChanedStatus = "";
                        this.userInfoID = "";
                        this.watingRes = true;
                    }, 3000);
                    setTimeout(() => {  
                        this.$router.go(this.$router.currentRoute);
                    }, 5000);
                     
                }).catch(error => {
                    this.loader2 = false,
                    this.error_password = error.response.data.error.NewPassword[0]
                    setTimeout(() => {  
                        this.newPassword = ""; 
                        this.ConfirmNewPassword = ""; 
                        this.error_password = ""; 
                        this.error_ConfirmPassword = "";                         
                    }, 3000);
                });
            }            
        },
        created() {
            window.scrollTo(0,0); 
        },
        beforeRouteEnter(to, from, next) {
            if (window.Laravel.isLoggedin) {
                if(window.Laravel.user.memberType ==='care_provider_member'){
                    return next('logged-in-provider');
                } else if(window.Laravel.user.memberType ==='family_parent_member'){
                    return next('logged-in-family');
                } else if(window.Laravel.user.memberType ==='agency_member'){
                    return next('logged-in-agency');
                } else {
                    return next('UserDashboard');
                }              
            }
            next();
        }
    }
</script>
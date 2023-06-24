<template>   
    <main>
        <section class="sec-padding">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-xs-12 col-sm-12 col-lg-12">
                        <h3 class="text-center">You are now logged in. What would you like to do?</h3>
                        <div class="row mt-5">
                            <div class="col-md-4 col-sm-12 col-xs-12 text-center col-lg-4">
                                <p>
                                    <i class="color1-color fa fa-search" style="font-size: 45px;color:#e58eb2;" aria-hidden="true">
                                    <span style="display: none;">&nbsp;</span></i>
                                </p>
                                <p class="h4" style="text-transform: uppercase; padding-bottom: 0.9em; padding-top: 0.5em;">
                                    Find a provider
                                </p>
                                <p style="padding-right: 0em;">
                                    <router-link to="/member-search" class="custom_yellow_btn w-100" style="padding-right: 3em; padding-left: 3em;">
                                        Browse nanny/sitter profiles 
                                    </router-link>
                                </p>
                                <p style="padding-right: 0em;margin-top: 40px;">
                                    <a class="custom_yellow_btn w-100" style="padding-right: 3em; padding-left: 3em;" target="_blank" href="https://www.facebook.com/groups/SeattleNannyParentConnection/">
                                        Post or browse Facebook jobs 
                                    </a>
                                </p>
                            </div>

                            <div class="col-md-4 col-sm-12 col-xs-12 text-center col-lg-4">
                                <p>
                                    <i class="color1-color fa fa-user-circle-o" style="font-size: 45px;color:#e58eb2;" aria-hidden="true">
                                    <span style="display: none;">&nbsp;</span></i>
                                </p>
                                <p class="h4" style="text-transform: uppercase; padding-bottom: 0.9em; padding-top: 0.5em;">
                                    Profile
                                </p>
                                <p style="padding-right: 0em;">
                                    <router-link to="/private-messages" class="custom_yellow_btn w-100" style="padding-right: 3em; padding-left: 3em;">
                                        View your messages
                                    </router-link>
                                </p>
                                <p style="padding-right: 0em;margin-top: 40px;">
                                    <router-link to="/UserDashboard" class="custom_yellow_btn w-100" style="padding-right: 3em; padding-left: 3em;">
                                        View your profile  
                                    </router-link>
                                </p>
                                <p style="padding-right: 0em;margin-top: 40px;">
                                    <router-link to="/member-about" class="custom_yellow_btn w-100" style="padding-right: 3em; padding-left: 3em;">
                                        Edit your profile  
                                    </router-link>
                                </p>
                            </div>
                            <div class="col-md-4 col-sm-12 col-xs-12 text-center col-lg-4">
                                <p>
                                    <i class="color1-color fa fa-vcard" style="font-size: 45px;color:#e58eb2;" aria-hidden="true">
                                    <span style="display: none;">&nbsp;</span></i>
                                </p>
                                <p class="h4" style="text-transform: uppercase; padding-bottom: 0.9em; padding-top: 0.5em;">
                                    Background checks
                                </p>
                                <p style="padding-right: 0em;">
                                    <router-link to="/background-checks" class="custom_yellow_btn w-100" style="padding-right: 2em; padding-left: 2em;">
                                        Order a background check  
                                    </router-link>
                                </p>
                                <p style="padding-right: 0em; margin-top: 40px;">
                                    <a href="mailto:info@nannyparentconnection.com?subject=Background Check Order Status&body=***Please note: Due to the sensitive nature of the information contained within the background check order and report plus our security and privacy protocols, we do not publish any information about background check reports on our website. We are happy to provide you with a status update via email. Simply include your name and your candidate’s name below and we will respond with the status of your order shortly:" class="custom_yellow_btn w-100" style="padding-right: 2em; padding-left: 2em;">
                                        Check on status of background check  
                                    </a>
                                </p>                                
                            </div>
                            

                            <div class="row mt-5">
                                <div class="col-md-4 col-sm-12 col-xs-12 text-center col-lg-4">
                                    <p>
                                        <i class="color1-color fa fa-star" style="font-size: 45px;color:#e58eb2;" aria-hidden="true">
                                        <span style="display: none;">&nbsp;</span></i>
                                    </p>
                                    <p class="h4" style="text-transform: uppercase; padding-bottom: 0.9em; padding-top: 0.5em;">
                                        Member feedback
                                    </p>
                                    <p style="padding-right: 0em;">
                                        <a href="help#scroll180194" class="custom_yellow_btn w-100" style="padding-right: 3em; padding-left: 3em;">
                                            Browse Member Feedback 
                                        </a>
                                    </p>
                                    <p style="padding-right: 0em;margin-top: 40px;">
                                        <a href="help#scroll180194" class="custom_yellow_btn w-100" style="padding-right: 3em; padding-left: 3em;">
                                            Leave feedback about a member 
                                        </a>
                                    </p>                                    
                                </div> 
                                <div class="col-md-4 col-sm-12 col-xs-12 text-center col-lg-4">
                                    <p>
                                        <i class="color1-color fa fa-calculator" style="font-size: 45px;color:#e58eb2;" aria-hidden="true">
                                        <span style="display: none;">&nbsp;</span></i>
                                    </p>
                                    <p class="h4" style="text-transform: uppercase; padding-bottom: 0.9em; padding-top: 0.5em;">
                                        Paying your provider
                                    </p>                                    
                                    <p style="padding-right: 0em;">
                                        <router-link to="/pay-calculator" class="custom_yellow_btn w-100" style="padding-right: 3em; padding-left: 3em;">
                                            Use the Pay Calculator 
                                        </router-link>
                                    </p>
                                    <p style="padding-right: 0em;margin-top: 40px;">
                                        <router-link to="/payroll-service" class="custom_yellow_btn w-100" style="padding-right: 3em; padding-left: 3em;">
                                            Sign up for our Payroll Service 
                                        </router-link>
                                    </p>                                    
                                </div>                           
                                
                                <div class="col-md-4 col-sm-12 col-xs-12 text-center col-lg-4">
                                    <p>
                                        <i class="color1-color fa fa-check-square-o" style="font-size: 45px;color:#e58eb2;" aria-hidden="true">
                                        <span style="display: none;">&nbsp;</span></i>
                                    </p>
                                    <p class="h4" style="text-transform: uppercase; padding-bottom: 0.9em; padding-top: 0.5em;">
                                        Verified care providers
                                    </p>                                    
                                    <p style="padding-right: 0em;">
                                        <router-link to="/last-minute-group-text" class="custom_yellow_btn w-100" style="padding-right: 3em; padding-left: 3em;">
                                            Become a Verified Provider
                                        </router-link>
                                    </p>                                    
                                </div>                                
                            </div>

                            <div class="row mt-5">
                                <div class="col-md-4 col-sm-12 col-xs-12 text-center col-lg-4">
                                    <p>
                                        <i class="color1-color fa fa-commenting-o" style="font-size: 45px;color:#e58eb2;" aria-hidden="true">
                                        <span style="display: none;">&nbsp;</span></i>
                                    </p>
                                    <p class="h4" style="text-transform: uppercase; padding-bottom: 0.9em; padding-top: 0.5em;">
                                        Last Minute Care Service
                                    </p>
                                    <p style="padding-right: 0em;">
                                        <router-link to="/last-minute-group-text" class="custom_yellow_btn w-100">
                                            Request a Last Minute Care provider
                                        </router-link>
                                    </p>                                
                                </div>

                                <div class="col-md-4 col-sm-12 col-xs-12 text-center col-lg-4">
                                    <p>
                                        <i class="color1-color fa fa-gavel" style="font-size: 45px;color:#e58eb2;" aria-hidden="true">
                                        <span style="display: none;">&nbsp;</span></i>
                                    </p>
                                    <p class="h4" style="text-transform: uppercase; padding-bottom: 0.9em; padding-top: 0.5em;">
                                        Nanny contracts
                                    </p>
                                    <p style="padding-right: 0em;">
                                        <router-link to="/nanny-contract" class="custom_yellow_btn w-100" style="padding-right: 3em; padding-left: 3em;">
                                            Download the nanny contract 
                                        </router-link>
                                    </p>
                                    <p style="padding-right: 0em;margin-top: 40px;">
                                        <router-link to="/nanny-share-contract" class="custom_yellow_btn w-100" style="padding-right: 2em; padding-left: 2em;">
                                            Download the nanny share contract 
                                        </router-link>
                                    </p>                                
                                </div>

                                <div class="col-md-4 col-sm-12 col-xs-12 text-center col-lg-4">
                                    <p>
                                        <i class="color1-color fa fa-vcard" style="font-size: 45px;color:#e58eb2;" aria-hidden="true">
                                        <span style="display: none;">&nbsp;</span></i>
                                    </p>
                                    <p class="h4" style="text-transform: uppercase; padding-bottom: 0.9em; padding-top: 0.5em;">
                                        Information Library
                                    </p>
                                    <p style="padding-right: 0em;">
                                        <router-link to="/faq-guides" class="custom_yellow_btn w-100" style="padding-right: 3em; padding-left: 3em;">
                                            Visit the Library  
                                        </router-link>
                                    </p>                                
                                </div>                               
                               
                            </div>

                            <div class="row mt-5">
                                <div class="col-md-4 col-sm-12 col-xs-12 text-center col-lg-4">
                                    <p>
                                        <i class="color1-color fa fa-check-square-o" style="font-size: 45px;color:#e58eb2;" aria-hidden="true">
                                        <span style="display: none;">&nbsp;</span></i>
                                    </p>
                                    <p class="h4" style="text-transform: uppercase; padding-bottom: 0.9em; padding-top: 0.5em;">
                                        Verified care providers
                                    </p>                                    
                                    <p style="padding-right: 0em;">
                                        <router-link to="/verified-care-providers" class="custom_yellow_btn w-100" style="padding-right: 3em; padding-left: 3em;">
                                            Request a Verified Care Provider 
                                        </router-link>
                                    </p>                                    
                                </div>

                                <div class="col-md-4 col-sm-12 col-xs-12 text-center col-lg-4">
                                    <p>
                                        <i class="color1-color fa fa-cogs" style="font-size: 45px;color:#e58eb2;" aria-hidden="true">
                                        <span style="display: none;">&nbsp;</span></i>
                                    </p>
                                    <p class="h4" style="text-transform: uppercase; padding-bottom: 0.9em; padding-top: 0.5em;">
                                        Membership
                                    </p>
                                    <p style="padding-right: 0em;">
                                        <router-link to="/membership" class="custom_yellow_btn w-100" style="padding-right: 2em; padding-left: 2em;">
                                            Change your membership  
                                        </router-link>
                                    </p>                                
                                </div>

                                <div class="col-md-4 col-sm-12 col-xs-12 text-center col-lg-4">
                                    <p>
                                        <i class="color1-color fa fa-phone" style="font-size: 45px;color:#e58eb2;" aria-hidden="true">
                                        <span style="display: none;">&nbsp;</span></i>
                                    </p>
                                    <p class="h4" style="text-transform: uppercase; padding-bottom: 0.9em; padding-top: 0.5em;">
                                        Help
                                    </p>
                                    <p style="padding-right: 0em;">
                                        <router-link to="/help" class="custom_yellow_btn w-100" style="padding-right: 3em; padding-left: 3em;">
                                            Visit the help page  
                                        </router-link>
                                    </p>                                
                                </div>
                            </div>
                        </div>
                        <h6 class="text-center mt-4">Questions or need additional help? Call or text us at (425) 243-7032 or <a href="mailto:info@nannyparentconnection.com">email us</a>!</h6>
                    </div>
                </div>
            </div>
        </section>
    </main>
</template>
<script>
export default {
    name: "logged-in-family",
    components: {
    },
    data() {
        return {
            loader:true,
            isLoggedIn: false  
                
        }
    },
    methods: {       
        
    },
    created() {     
        
        if (window.Laravel.user) {
            this.id = window.Laravel.user.id,
            this.memberType = window.Laravel.user.memberType,
            this.role = window.Laravel.user.role,
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
            this.facebookURL = window.Laravel.user.facebookURL,
            this.twitterURL = window.Laravel.user.twitterURL,
            this.instagramURL = window.Laravel.user.instagramURL,
            this.linkedinURL = window.Laravel.user.linkedinURL            
        } 
        if (window.Laravel.isLoggedin) {
            this.isLoggedIn = true
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
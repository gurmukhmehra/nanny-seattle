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
                            <div class="iq-card-body">            
                                <div class="row">
                                    <div class="col-md-3">
                                        <UserSettingMenus/>
                                    </div>
                                    <div class="col-md-9 pl-4">                                                                                                             
                                        <MembersBio/>        
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
import MemberHeader from "../Users/MemberHeader.vue";
import MemberMenus from "../Users/MemberMenus.vue";
import ParentBio from "../Users/ParentBio.vue";
import CareProviderBio from "../Users/CareProviderBio.vue";

import UserSettingMenus from "../Users/Settings/UserSettingMenus.vue";
import MembersBio from "../Users/Settings/MembersBio.vue";
export default {
    name: "UserSettings",
    components: {
        MemberHeader,
        MemberMenus,
        ParentBio,
        CareProviderBio,
        UserSettingMenus,
        MembersBio
    },
    data() {
        return {
            loader:false,
            isLoggedIn: false,             
        }
    },
    methods: { },
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
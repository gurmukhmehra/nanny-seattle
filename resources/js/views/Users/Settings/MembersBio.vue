<template>   
    <main>
        <div v-if="memberType === 'family_parent_member'">                                             
            <ParentBio/>                             
        </div>        
        <div v-else-if="memberType === 'care_provider_member'">
            <CareProviderBio/>
        </div>       
        <div v-else-if="memberType === 'agency_member'">
            <AgenciesBio/>
        </div>       
        <div v-else></div>            
    </main>
</template>
<script>
import MemberHeader from "../MemberHeader.vue";
import MemberMenus from "../MemberMenus.vue";
import ParentBio from "../ParentBio.vue";
import CareProviderBio from "../CareProviderBio.vue";
import AgenciesBio from "../AgenciesBio.vue";
export default {
    name: "member-bio",
    components: {
        MemberHeader,
        MemberMenus,
        ParentBio,
        CareProviderBio,
        AgenciesBio
    },
    data() {
        return {
            loader:false,            
        }
    },
    methods: {       
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
<template>   
    <main>
        <ul class="nav nav-pills basic-info-items d-block p-0 m-0">
            <li>
                <router-link to="/profile-settings" rel="profile-settings" class="nav-link actives">
                    <i class="fa fa-info-circle"></i> Bio
                </router-link>                                                
            </li>
            
            <li>
                <router-link to="/basic-info" rel="basic-info" class="nav-link actives">
                    <i class="fa fa-info-circle"></i> Basic Info
                </router-link>                
            </li>
            <li>
                <router-link to="/profile-password" rel="profile-Password" class="nav-link actives">
                    <i class="fa fa-key"></i> Password
                </router-link>                
            </li>
            <li>
                <router-link to="/profile-cover-image" rel="profile-cover-image" class="nav-link actives">
                    <i class="fa fa-picture-o"></i> Profile & Cover Image
                </router-link>                
            </li>
            <li>
                <router-link to="/profile-socail-link" rel="profile-socail-link" class="nav-link actives">
                    <i class="fa fa-globe"></i> Socail Link
                </router-link>                
            </li>            
        </ul>       
    </main>
</template>
<script>
export default {
    name: "UserSettingMenus",
    data() {
        return {
            loader:false,
            isLoggedIn: false,          
        }
    },
    methods: {},
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
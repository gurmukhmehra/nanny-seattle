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
                        <div class="tab-content">
                            <div class="tab-pane fade active show" id="about" role="tabpanel">
                                <div class="iq-card">

                                </div>
                            </div>
                            <div class="tab-pane fade" id="membership" role="tabpanel">
                                <div class="iq-card">

                                </div>
                            </div>
                            <div class="tab-pane fade" id="friends" role="tabpanel">
                                <div class="iq-card">
                                    <UserFriends/>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="groups" role="tabpanel">
                                <div class="iq-card">
                                    <UserGroups/>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="chat" role="tabpanel">
                                <div class="iq-card">
                                    <Chats/>
                                </div>
                            </div>
                            <!--div class="tab-pane fade" id="photos" role="tabpanel">
                                <div class="iq-card">
                                    <UserPhotos/>
                                </div>
                            </div-->
                            <div class="tab-pane fade" id="timeline" role="tabpanel">
                                <div class="iq-card">
                                    <hr class="mt-0">
                                    <Timeline/>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="settings" role="tabpanel">
                                <div class="iq-card">
                                    <UserSettings/>
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
    const axios = require('axios')
    import MemberHeader from "../Users/MemberHeader";
    import MemberMenus from "../Users/MemberMenus";
    import UsersMenus from "../Users/UsersMenus";
    //import UserAbout from "../Users/UserAbout";
    //import UserMembership from "../Users/UserMembership";
    import UserFriends from "../Users/UserFriends";
    import UserGroups from "../Users/UserGroups";
    import UserSettings from "../Users/UserSettings";
    import Chats from "../Users/Chats";
    import Timeline from "../Users/Timeline";
    export default {
    name: "UserDashboard",
    components: {
        MemberHeader,
        MemberMenus,
        UsersMenus,
        //UserAbout,
        //UserMembership,
        UserFriends,
        UserGroups,
        Chats,
        UserSettings,
        Timeline
    },
    data() {
        return {
            isLoggedIn: false,            
        }
    },
    methods: {   
        MyNotificatios(){
            axios.get(`/api/MyNotificatios`).then((response) => {
                this.total_notification = response.data.totalNotification;
            }).catch((err) => console.error(err));
        }      
    },
    created() {
        this.MyNotificatios();
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
        if (window.Laravel.isLoggedin) {
            this.isLoggedIn = true
        }
    },
    updated() {
        window.scrollTo({
            top: 280,
            behavior: 'smooth',
        })
        console.log('yes');
    },
    beforeRouteEnter(to, from, next) {
        if (!window.Laravel.isLoggedin) {
            window.location.href = "/";
        }
     next();
    }

}
</script>

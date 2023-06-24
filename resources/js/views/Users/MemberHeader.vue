<template>
    <div class="iq-card-body profile-page p-0 mt-3">
        <div class="profile-header">
            <div v-if="!!ProfileCover" class="cover-container-header" :style="{'background-image': 'url(' + '/public/uploads/coverImages/'+id +'/cover-image/' + ProfileCover + ')'}">
            </div>
            <div v-else class="cover-container-header" style="background-image: url('https://templates.iqonic.design/socialv/bs5/html/dist/assets/images/page-img/profile-bg1.jpg');">
            </div>
            <div class="user-detail text-center mb-3">
                <div class="profile-img">
                    <img v-if="!!profileImage" :src="'/public/uploads/profileImage/' + profileImage" alt="profile-img" class="avatar-130 img-fluid" />
                    <img v-else src="https://cdn.pixabay.com/photo/2015/03/04/22/35/avatar-659652__340.png" alt="profile-img" class="avatar-130 img-fluid" />
                </div>
                <div class="profile-detail">
                    <h3 class="">{{name}}</h3>
                </div>
            </div>
            <div class="profile-info p-4 d-flex align-items-center justify-content-between position-relative">
                <div class="social-links">
                    <ul class="custum_cc social-data-block d-flex align-items-center justify-content-between list-inline p-0 m-0">
                        <li class="text-center pr-3">
                            <a v-if="!!facebookURL" :href="facebookURL" Target="_blank">
                                <img src="https://templates.iqonic.design/socialv/bs5/html/dist/assets/images/icon/08.png" class="img-fluid rounded" alt="facebook">
                            </a>
                            <a v-else>
                                <img src="https://templates.iqonic.design/socialv/bs5/html/dist/assets/images/icon/08.png" class="img-fluid rounded" alt="facebook">
                            </a>
                        </li>
                        <li class="text-center pr-3">
                            <a v-if="!!twitterURL" :href="twitterURL" Target="_blank">
                                <img src="https://templates.iqonic.design/socialv/bs5/html/dist/assets/images/icon/09.png" class="img-fluid rounded" alt="Twitter">
                            </a>
                            <a v-else>
                                <img src="https://templates.iqonic.design/socialv/bs5/html/dist/assets/images/icon/09.png" class="img-fluid rounded" alt="Twitter">
                            </a>
                        </li>
                        <li class="text-center pr-3">
                            <a v-if="!!instagramURL" :href="instagramURL" Target="_blank">
                                <img src="https://templates.iqonic.design/socialv/bs5/html/dist/assets/images/icon/10.png" class="img-fluid rounded" alt="Instagram">
                            </a>
                            <a v-else>
                                <img src="https://templates.iqonic.design/socialv/bs5/html/dist/assets/images/icon/10.png" class="img-fluid rounded" alt="Instagram">
                            </a>
                        </li>
                        <li class="text-center pr-3">
                            <a v-if="!!linkedinURL" :href="linkedinURL" Target="_blank">
                                <img src="https://templates.iqonic.design/socialv/bs5/html/dist/assets/images/icon/13.png" class="img-fluid rounded" alt="linkedin">
                            </a>
                            <a v-else>
                                <img src="https://templates.iqonic.design/socialv/bs5/html/dist/assets/images/icon/13.png" class="img-fluid rounded" alt="linkedin">
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="social-info">
                    <ul class="social-data-block d-flex align-items-center list-inline" style="list-style-type: none;">
                        <li v-if="memberType === 'family_parent_member'">
                            <img :src="'/public/uploads/Family_Parent-Icon.png'" title="Family/Parent Member" class="member_icons"/>                            
                        </li>
                        <li v-if="memberType === 'family_parent_member'">
                            <span class="fmaily_count_child" title="Number of children needs care for">{{UserBioDetail.numnerOfchild}}</span>
                        </li>
                        <li v-if="memberType === 'care_provider_member'">
                            <img :src="'/public/uploads/Care-Provider-Icon.png'" title="Care Provider Member" class="member_icons"/>
                        </li>
                        <li v-if="memberType === 'care_provider_member'">
                            <span class="provider_count_child" title="Number of children will provide care for at one time">{{UserBioDetail.providerCareOneTime}}</span>
                        </li>
                        <li v-if="memberType === 'agency_member'">
                            <img :src="'/public/uploads/Agency-Icon.png'" title="Family/Parent Member" class="member_icons"/>
                        </li>                        
                        <li>
                            <sup class="text-danger usernotiCount"><Notifications></Notifications></sup>
                            <router-link to="/notification" class="text-dark" style="font-size: 25px;position: absolute;right: 40px;top: 23px;">
                                <i class="fa fa-bell" aria-hidden="true"></i>
                            </router-link>
                        </li> 
                    </ul>
                </div>

            </div>
        </div>
    </div>

</template>
<script>
    import Notifications from './Notifications.vue';
    export default {
        name: "MemberHeader",
        components: {
            Notifications
        },
        data() {
            return {
                name: null,
                isLoggedIn: false,
                name : '',
                profileImage : '',
                ProfileCover : '',
                facebookURL: '',
                twitterURL: '',
                instagramURL: '',
                linkedinURL : '',
                UserBioDetail:''
            }
        },
        methods: {
            memberBasicInfo(){
            axios.get(`/api/memberBasicDetail`).then((response) => {
                this.name = response.data.userInfo.name,
                this.email =response.data.userInfo.email,
                this.address1 = response.data.userInfo.address1,
                this.address2 = response.data.userInfo.address2,
                this.username = response.data.userInfo.username,
                this.phoneNumber = response.data.userInfo.mobile,
                this.profileImage = response.data.userInfo.profileImage,
                this.ProfileCover = response.data.userInfo.ProfileCover,
                this.facebookURL = response.data.userInfo.facebookURL,
                this.twitterURL = response.data.userInfo.twitterURL,
                this.instagramURL = response.data.userInfo.instagramURL,
                this.linkedinURL = response.data.userInfo.linkedinURL
                }).catch((err) => console.error(err));
            },
            memberBasicInfo(){
                axios.get(`/api/parentBioDetail`).then((response) => {
                    this.UserBioDetail = response.data.userBio;
                }).catch((err) => console.error(err));
            }
        },
        created() {            
            if (window.Laravel.user)
            {
                this.memberBasicInfo();
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
        beforeRouteEnter(to, from, next)
        {
            if (!window.Laravel.isLoggedin) {
                window.location.href = "/";
            }
            next();
        }
    }

</script>

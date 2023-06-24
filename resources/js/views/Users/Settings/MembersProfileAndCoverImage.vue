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
                                        <h6>Profile & Cover Image</h6>
                                        <hr>
                                        <div class="row">
                                            <div v-show="profleImageStatus" class="alert alert-success">
                                                {{profile_imgs_tesxt}}
                                            </div>                                                                       
                                            <input type="hidden" name="userID" v-model="id">
                                            <div class="col-md-10">                                                    
                                                <div class="form-group  mt-3">
                                                    <label for="profilePic" style="font-weight:600;width:100%;">Profile Image : </label>
                                                    <input type="file" id="profilePic" class="w-100" accept="image/*" @change="setImage">
                                                </div>                                                    
                                            </div>
                                            <!-- <div class="col-md-2">
                                                <div class="form-group mt-5">
                                                    <button class="btn btn-info">
                                                        <span v-if="loader" class="spinner-border spinner-border-sm" role="status"><span class="sr-only">Loading...</span></span>
                                                        Save
                                                    </button>                                                                                                          
                                                </div>
                                            </div> -->
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6" v-if="this.ProfileImageSrc">                                                            
                                                <vue-cropper
                                                    class="w-100"
                                                    ref="cropper"
                                                    :aspectRatio="1/1"
                                                    :initialAspectRatio="1/1"
                                                    :guides="true"
                                                    :src="ProfileImageSrc"
                                                ></vue-cropper>
                                            </div>
                                            <div class="col-md-3">
                                                <!-- Cropped image previewer -->
                                                <img class="w-100 bg-light" :src="croppedProfileImageSrc" />
                                            </div> 
                                            <div class="col-md-2" v-if="this.ProfileImageSrc">
                                                <div class="col-md-1">
                                                    <button class="btn btn-dark" v-if="this.ProfileImageSrc" @click="cropImage">Crop</button>
                                                </div>
                                                <div class="col-md-1 mt-2">
                                                    <button class="custom_yellow_btn" v-if="this.ProfileImageSrc" @click="uploadProfileImage" >Upload</button> 
                                                </div>                                                    
                                            </div>                                                    
                                        </div>
                                        <hr> 
                                        <!-- <form @submit="ProfileCoverImage" enctype="multipart/form-data"> -->
                                        <div class="row"> 
                                            <div v-show="coverImageStatus" class="alert alert-success">
                                                {{cover_imgs_tesxt}}
                                            </div>                                                                             
                                            <input type="hidden" name="User_id" v-model="id"> 
                                            <div class="col-md-10">                                                    
                                                <div class="form-group  mt-3">
                                                    <label for="profileCoverPic" style="font-weight:600;width:100%;">Profile Cover Image : </label>
                                                    <input type="file" id="profileCoverPic" class="w-100" accept="image/*" @change="changeCoverImage">
                                                </div>                                                    
                                            </div>                        
                                            <div class="row"> 
                                                <div class="col-md-6" v-if="this.CoverImageSrc">                                                            
                                                    <vue-cropper
                                                        class="w-100"
                                                        ref="cropper"
                                                        :aspectRatio="1300 / 340"
                                                        :initialAspectRatio="1300 / 340"
                                                        :guides="true"
                                                        :src="CoverImageSrc"
                                                    ></vue-cropper>
                                                </div>
                                                <div class="col-md-3">
                                                    <img class="w-100 bg-light" :src="croppedCoverImageSrc" />
                                                </div>
                                                <div class="col-md-2" v-if="this.CoverImageSrc">
                                                    <div class="col-md-1">
                                                        <button class="btn btn-danger" v-if="this.CoverImageSrc" @click="cropCoverImage">Crop</button>
                                                    </div>
                                                    <div class="col-md-1 mt-2">
                                                        <button class="btn btn-info" v-if="this.CoverImageSrc" @click="ProfileCoverImage" >Upload</button>
                                                    </div>                                                    
                                                </div>
                                            </div>
                                        </div>
                                        <!-- </form>       -->
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
import VueCropper from 'vue-cropperjs';
import 'cropperjs/dist/cropper.css';
export default {
    name: "profile-cover-image",
    components: {
        MemberHeader,
        MemberMenus,
        UserSettingMenus,
        VueCropper
    },
    data() {
        return {
            loader:false,
            isLoggedIn: false,
            profleImageStatus: false,            
            ProfileImageSrc: '',
            croppedProfileImageSrc: '',
            profile_imgs_tesxt:'uploading...',

            coverImageStatus: false,
            CoverImageSrc:'',
            croppedCoverImageSrc: '',
            cover_imgs_tesxt:'uploading...',

            file: '',
            success: '',
            ProfileCover: '',
            CoverSuccess: '',
            facebookURL: '',
            twitterURL: '',
            instagramURL: '',
            linkedinURL : '',
        }
    },
    methods: {
        setImage: function (e) {
            const file = e.target.files[0]
            if (!file.type.includes("image/")) {
                alert("Please select an image file")
            return
            }
            if (typeof FileReader === "function") {
                const reader = new FileReader()
                reader.onload = event => {
                this.ProfileImageSrc = event.target.result
                // Rebuild cropperjs with the updated source
                this.$refs.cropper.replace(event.target.result)
            }
                reader.readAsDataURL(file)
            } else {
                alert("Sorry, FileReader API not supported")
            }
        },
        cropImage() {
            // Get image data for post processing, e.g. upload or setting image src
            this.croppedProfileImageSrc = this.$refs.cropper.getCroppedCanvas().toDataURL()
        },
        uploadProfileImage() {
            this.profleImageStatus = true;                     
            this.$refs.cropper.getCroppedCanvas().toBlob(function (blob) {
                let formData = new FormData();
                formData.append("name", "image-name-" + new Date().getTime())
                // Append image file
                formData.append("file", blob)
                formData.append('userID', window.Laravel.user.id);                              
                axios.post("api/user/upload/profileImage", formData)
                .then(response => {                                   
                    setTimeout(() => { 
                        location.reload();
                    }, 3000);
                })
                .catch(function (error) {
                    console.log(error)
                })                
            })           
            // e.preventDefault();
            // let existingObj = this;
            // let profileIMG = this;
            // const config = {
            //     headers: {
            //         'content-type': 'multipart/form-data'
            //     }
            // }
            // let formdata = new FormData();
            // formdata.append('file', this.file);
            // formdata.append('userID', this.id);
            // if(window.Laravel.user) { 
            //     axios.post(`api/user/upload/profileImage`, formdata, config)
            //     .then(function (res) { 
            //         this.memberBasicInfo();                                                        
            //         existingObj.success = res.data.success;
            //         this.profleImageStatus = true,
            //         this.loader=false;
            //         this.file = ''
            //         setTimeout(() => {
            //             this.profleImageStatus = false;   
            //         }, 2000); 
            //         this.profileImage = profileIMG.res.data.userData.profileImage;                    
            //         //this.profileImage = res.data.userData.profileImage;
            //     })
            //     .catch(function (err) {
            //         this.loader=false;
            //         existingObj.output = err;
            //     });
            // }
        },
        // onImageChange(e){
        //     //console.log(e.target.files[0]);            
        //     this.ProfileCover = e.target.files[0];
        // },        
        changeCoverImage: function (e) {
            const file = e.target.files[0]
            if (!file.type.includes("image/")) {
                alert("Please select an image file")
            return
            }
            if (typeof FileReader === "function") {
                const reader = new FileReader()
                reader.onload = event => {
                this.CoverImageSrc = event.target.result
                // Rebuild cropperjs with the updated source
                this.$refs.cropper.replace(event.target.result)
            }
                reader.readAsDataURL(file)
            } else {
                alert("Sorry, FileReader API not supported")
            }
        },
        cropCoverImage() {
            // Get image data for post processing, e.g. upload or setting image src
            this.croppedCoverImageSrc = this.$refs.cropper.getCroppedCanvas().toDataURL()
        },
        ProfileCoverImage(){
            this.coverImageStatus = true;                     
            this.$refs.cropper.getCroppedCanvas().toBlob(function (blob) {
                let formData = new FormData();
                formData.append("name", "image-name-" + new Date().getTime())
                // Append image file
                formData.append("ProfileCover", blob)
                formData.append('User_id', window.Laravel.user.id);                              
                axios.post("api/user/upload/profileCoverImage", formData)
                .then(response => {                                   
                    setTimeout(() => { 
                        location.reload();
                    }, 3000);
                })
                .catch(function (error) {
                    console.log(error)
                })                
            }) 
        },
        // ProfileCoverImage(e){            
        //     e.preventDefault();
        //     let currentObj = this;
        //     const config = {
        //         headers: { 'content-type': 'multipart/form-data' }
        //     }
        //     let CoverformData = new FormData();
        //     CoverformData.append('ProfileCover', this.ProfileCover);
        //     CoverformData.append('User_id', this.id);
        //     if(window.Laravel.user) { 
        //         axios.post(`/api/user/upload/profileCoverImage`, CoverformData, config)
        //         .then(function (response) {
        //             //console.log(response);                    
        //             this.ProfileCover = '';
        //             currentObj.CoverSuccess = response.data.CoverSuccess;; 
        //             this.memberBasicInfo();
        //             window.location.reload();
        //         }).catch(function (error) {                    
        //         });
        //     }
        // },
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
        }
    },
    created() {
        window.scrollTo({
            top: 280,
            behavior: 'smooth',
        }); 
        //this.memberBasicInfo();                
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
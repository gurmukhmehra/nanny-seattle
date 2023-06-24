<template>   
    <main>
        <div class="row">
            <span class="text-center">
                <img v-if="!!profileImage" class="" :src="'/public/uploads/profileImage/' + profileImage" style="border-radius: 80px; width:130px;">
                <img v-else class="" src="https://cdn.pixabay.com/photo/2015/03/04/22/35/avatar-659652__340.png" style="border-radius: 80px; width:130px;">
            </span>                
            <h6 class="mt-3 mb-2 text-center">{{name}}</h6>
            <a href="" class="text-center">{{username}}</a>
            <p class="text-center">Multidisciplinary photographer focused on travel and nature content</p>
            <p style="font-weight:500;">Profile Intro</p>
            <p>
                <span style="font-weight:500;">About Me : </span>
                Hi, I’m {{name}}, I’m 36 and I work as a Digital Designer for the “Daydreams” Agency in Pier 56. 
            </p>
            <p style="font-weight:500;">Other Social Networks : </p>
            <a href="" class="btn btn-primary text-white"><i class="fab fa-facebook-f"></i> Facebook</a>
            <a href="" class="btn btn-danger mt-2 text-white"><i class="fab fa-twitter"></i> Twitter</a>
            <a href="" class="btn btn-info mt-2 text-white"><i class="fab fa-instagram"></i> Instagram</a>
        </div>    
    </main>
</template>

<script>
export default {
    name: "UsersMenus",
    created() {
        if (window.Laravel.user) {
            this.id = window.Laravel.user.id,
            this.role = window.Laravel.user.role,
            this.name = window.Laravel.user.name,
            this.email = window.Laravel.user.email,
            this.username = window.Laravel.user.username,
            this.firstName = window.Laravel.user.firstName,
            this.lastName = window.Laravel.user.lastName,
            this.address1 = window.Laravel.user.address1,
            this.address2 = window.Laravel.user.address2,
            this.stateProvince = window.Laravel.user.state,
            this.postalCode = window.Laravel.user.postal_code,
            this.phoneNumber = window.Laravel.user.mobile,
            this.profileImage = window.Laravel.user.profileImage
        }
    },
    beforeRouteEnter(to, from, next) {
        if (!window.Laravel.isLoggedin) {
            window.location.href = "/";
        }
        next(); 
    }  
}
</script>
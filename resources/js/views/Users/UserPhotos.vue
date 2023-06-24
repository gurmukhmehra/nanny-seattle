<template>   
    <main>
        <div class="iq-card-body">
            
        </div>
    </main>
</template>

<script>
export default {
    name: "UserPhotos",
    data() {
        return {
            isLoggedIn: false,
        }
    },
    methods: {},
    created() {
        if (window.Laravel.isLoggedin) {
            this.isLoggedIn = true
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
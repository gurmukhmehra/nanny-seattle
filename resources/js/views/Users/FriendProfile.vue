<template>   
    <main>
        <section class="sec-padding" style="padding-top:0px;padding-bottom:0px;">
            <div class="container">                
                <div class="row">                    
                    <div class="col-sm-12">
                        <div class="iq-card">
                            <div class="iq-card-body">
                                <div class="row">
                                    <MemberAbout :username="this.username"/>
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
const axios = require('axios');
import MemberAbout from "./FriendPages/MemberAbout";
export default {
    name: "FriendProfile",
    components: {
        MemberAbout
    },
    props: { 
        username: String         
    },
    data() {
        return {  
            isLoggedIn: false,         
        }
    },
    methods: {
        
     },
    created() {        
        if (window.Laravel.isLoggedin) {
            this.isLoggedIn = true
        } 
        if(window.Laravel.user) {                  
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
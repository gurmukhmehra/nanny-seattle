<template>
    <main>
        <div class="container">
            <h4 class="text-center mt-2">Change Password Form</h4>
            <hr>
            <p>{{this.username}}</p>
        </div>
    </main>
</template>

<script> 
    const axios = require('axios');
    export default {
            props: { 
            username: String         
        },
        data(){
            return { 
                
            }
        },
        methods:{},
        created() {
            axios.get(`/web/forgot-password/${username}`).then((response) => {
              console.log('testing : ', response.data);                      
            }).catch((err) => console.error(err));
        }
    }
</script> 
<template>
<main>    
    <div class="container">
        <div class="row mt-3">
            <p style="font-size: 26px; text-align: left;">Welcome to our community!</p>
        </div>
        <div class="row">
            <div class="col-md-12 col-xs-12 col-sm-12 col-lg-12">
                <p>Your purchase is complete. Please be on the lookout for an email with important instructions about our community which should arrive in your inbox shortly.</p>
                <p><strong>If you are using a Gmail™️ email address, please note that our friends at Google™️ sometimes like to mark our emails as Spam. If you don’t receive the confirmation email in the next few minutes, kindly check your Spam folder and mark the message as “Not Spam”. </strong></p>
                <p>If you have any questions or need anything, <a href="mailto:laura@nannyparentconnection.com" title="please feel free to email me">please feel free to email me!</a>&nbsp;</p>
                <p>Thank you for supporting local businesses and again, welcome!</p>
                <p>
                    <img src="/public/assets/images/Laura-Head-Shot-242x300.jpg" alt="Chief Mommy" title="Chief Mommy" sizes="(max-width: 180px) 100vw, 180px" width="180" height="223"/>
                </p>
                <p><img src="/public/assets/images/Laura-Signature-1-300x84.png" alt="Chief Mommy" title="Chief Mommy" width="300" height="84"></p>
                <p>Founder and “Chief Mommy”</p>
            </div>
        </div>
    </div>
</main>
</template>
<script>
    const axios = require('axios');
    export default {         
        data(){
            return {
                messages: null,
            };
        },
        methods: {
            read() {
            axios.get(`https://seattle.nannyparentconnection.com/successURL`).then(({ data }) => {
                //console.log(data.paymentSuccss);
                this.messages = data.paymentSuccss;
            })
            .catch((err) => console.error(err));
        }, 
        }, 
        mounted() {           
            this.read();
        },
        created() { 
            window.scrollTo(0,0);
        }
    }
</script>

    

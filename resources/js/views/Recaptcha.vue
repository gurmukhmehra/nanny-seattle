<template>
    <main>    
        <div id="g-recaptcha" class="g-recaptcha" :data-sitekey="sitekey"></div> 
    </main>
    </template>    
    <script>
        export default {                    
        data() {
            return {  
                sitekey: '6Ld49hsmAAAAACseKXPr2AjYHmQXm-Jne7XncTeo',                            
            };
        },
        methods: { },
        mounted(){},
        created(){ 
            this.$nextTick(function () {
                grecaptcha.render('g-recaptcha');
            }); 
        }              
    }
</script>
    
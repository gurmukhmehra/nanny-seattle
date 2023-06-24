<template>
    <main>
    <section class="sec-padding of-head">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-lg-6">
                    <h1 class="sec-heading text-center">Pay Calculator</h1>
                    <p>Parents – tired of figuring out withholding taxes for your nanny, babysitter or tutor by hand? Use our Pay Calculator to determine how much to pay your care provider, how much to withhold, and what you owe in employer taxes.</p>
                    <p>Care Providers – want to confirm or estimate your paycheck? Simply fill out the below fields below and then check out the summary.</p>
                    <p>The calculator also works great for paying nanny share and “learning pod” providers as you can input hourly pay and hours worked for up to five children.</p>
                    <p>Need help using the Pay Calculator? contact us <router-link to="/contact-us" title="contact-us">click here</router-link></p>
                </div>
                <div class="col-md-6 col-lg-6"><img src="/public/assets/images/Mom-using-Pay-Calculator-scaled.jpg" class="img-style"></div>
            </div>
        </div> 
    </section>   
        
     </main>
    </template>
    
<script>
    export default {
        name:'ofpaycheck-calculatorfer',
        created() { 
            window.scrollTo(0,0);
        }            
    }
</script>
    
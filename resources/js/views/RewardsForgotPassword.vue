<template>
    <main>       
        <section class="sec-padding color1-background-color" style="padding: 20px 0;">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-xs-12 col-sm-12 col-lg-12">
                        <h3 style="text-align:center;color:white;margin: 0;">Login to your Rewards Dashboard</h3>
                    </div>
                </div>
            </div>
        </section>
        <section class="sec-padding" style="padding: 20px 0;">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-xs-12 col-sm-12 col-lg-12">
                        <p style="text-align:center;">Want to sign up? Click Register below to get started or<a href="/rewards-signup" title="click here"> click here</a> to learn more about our Rewards Program.</p>
                    </div>
                </div>
                    
                <div class="row">
                    <div class="col-md-12 col-lg-12">
                        <div class="nf-form-layout">
                            <form>
                                <div class="nf-mp-body">
                                    <h3>Request a Password Reset</h3>
                                    <div class="field-wrap">
                                        <label>Enter Your Username or Email Address </label>
                                        <input type="text" value="" class="forms-field" required="">
                                    </div>
                                    <div class="field-submit" style="text-align: left;">	
                                        <input class="ninja-forms-field nf-element" type="submit" value="Request Password Reset" disabled="">
                                    </div>
                                    <p class="wafp-login-actions"> <a href="/rewards-signup">Rewards Register</a>&nbsp;| <a href="rewards-login">Rewards Login</a></p>
                                </div>
                            </form>
                        </div>
                    </div>                        
                </div>
            </div>
        </section>
    </main>
</template>

<script>
    export default {
        name:'rewards-forgot-password'		
    }
</script>

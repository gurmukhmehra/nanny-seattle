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
                                <div class="nf-form-fields">Fields marked with an <span class="ninja-forms-req-symbol">*</span> are required</div>
                                    <div class="nf-mp-body">
                                        <div class="field-wrap">	
                                            <label>Username </label>
                                            <input type="text" value="" class="forms-field" required="">
                                        </div>
                                        <div class="field-wrap">	
                                            <label>Password </label>
                                            <input type="text" value="" class="forms-field" required="">
                                        </div>
                                        <div class="field-wrap">	
                                            <label><input name="rememberme" type="checkbox" id="rememberme" value="forever" tabindex="520"> Remember Me</label>
                                        </div>                                     
                                        <div class="field-submit" style="text-align: left;">	
                                            <input class="ninja-forms-field nf-element" type="submit" value="Log in" disabled="">
                                        </div>
                                        <p class="wafp-login-actions"> <a href="/rewards-signup">Register</a>&nbsp;| <router-link to="/rewards-forgot-password">Lost Password?</router-link></p>
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
        name:'rewards-login'		
    }
</script>

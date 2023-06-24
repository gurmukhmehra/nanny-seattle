<template>
    <main>
        <MemberBuyMembershipPoup/>
        <section class="sec-padding">
            <div class="container">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12">
                            <h3 style="margin-bottom: 0;">Ready to get started?</h3>
                            <p>Step #1: Choose from the below:</p>
                        </div>
                    </div>
                <div class="row">
                        <div class="col-md-4 col-lg-4">
                            <div class="item-box">
                                <router-link to="/offer-families-parents">
                                    <img src="/public/assets/images/family.jpg">
                                    <h3 class="custom_yellow_btn">I’M A PARENT SEEKING CARE</h3>
                                </router-link>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4">
                            <div class="item-box">
                                <router-link to="/sign-care-provider">
                                    <img src="/public/assets/images/happy-family.jpg">
                                    <h3 class="custom_yellow_btn">I’M A PROVIDER OFFERING CARE</h3>
                                </router-link>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4">
                            <div class="item-box">
                                <router-link to="/sign-up-agencies">
                                    <img src="/public/assets/images/meeting.jpg">
                                    <h3 class="custom_yellow_btn">I’M AN AGENCY REP</h3>
                                </router-link>
                            </div>
                        </div>
                    </div>
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12">
                        <p style="font-size: 18px;">You will receive premium access to our online community plus the following (click any of the resources below for more info):</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2 col-sm-12 col-xs-12 text-center col-lg-2 icon-box">
                        <p><i class="fa fa-handshake"></i></p>
                        <p class="h4">
                            <a title="PERSONAL SUPPORT 365 DAYS/YEAR" href="mailto:info@nannyparentconnection.com?subject=I Need Help With My Search!">PERSONAL SUPPORT 365 DAYS/YEAR</a>
                        </p>
                    </div>                   
                    
                    <div class="col-md-2 col-sm-12 col-xs-12 text-center col-lg-2 icon-box" style="text-align:center;">
                        <p><i class="fa fa-comment"></i></p>
                        <p class="h4">
                            <router-link to="/last-minute-group-text" title="Last minute care text service">
                                Last minute care text service
                            </router-link>
                        </p>
                    </div>
                    
                    <div class="col-md-2 col-sm-12 col-xs-12 text-center col-lg-2 icon-box" style="text-align:center;">
                        <p><i class="fa fa-file"></i></p>
                        <p class="h4">
                            <router-link to="/background-checks" title="Last minute care text service">
                                DISCOUNTED BACKGROUND CHECKS
                            </router-link>
                        </p>
                    </div>
                    
                    <div class="col-md-2 col-sm-12 col-xs-12 text-center col-lg-2 icon-box" style="text-align:center;">
                        <p><i class="fa fa-search"></i></p>
                        <p class="h4">
                            <router-link to="/member-search" title="Member Search">Member Search</router-link>
                        </p>
                    </div>
                    
                    <div class="col-md-2 col-sm-12 col-xs-12 text-center col-lg-2 icon-box" style="text-align:center;">
                        <p><i class="fa fa-file"></i></p>
                        <p class="h4">
                            <router-link to="/nanny-contract" title="nanny contracts">nanny contracts</router-link>
                        </p>
                    </div>                    
                </div>
                
                <div class="row">
                    <div class="col-md-2 col-sm-12 col-xs-12 col-lg-2"></div>
                    <div class="col-md-2 col-sm-12 col-xs-12 text-center col-lg-2 icon-box" style="text-align:center;">
                        <p><i class="fa fa-money"></i></p>
                        <p class="h4">
                            <router-link to="/payroll-service" title="Payroll services">Payroll services</router-link>
                        </p>
                    </div>
                    <div class="col-md-2 col-sm-12 col-xs-12 text-center col-lg-2 icon-box" style="text-align:center;">
                        <p><i class="fa fa-calculator"></i></p> 
                        <p class="h4"><router-link to="/pay-calculator" title="PAY CALCULATOR">PAY CALCULATOR</router-link></p>
                    </div>
                    <div class="col-md-2 col-sm-12 col-xs-12 text-center col-lg-2 icon-box" style="text-align:center;">
                        <p><i class="fa fa-star"></i></p>
                        <p class="h4"><router-link :to="{name:'help', hash:'#'+'scroll180194'}" title="MEMBER GENERATED FEEDBACK &amp; TESTIMONIALS">MEMBER GENERATED FEEDBACK & TESTIMONIALS</router-link></p>
                    </div>
                    <div class="col-md-2 col-sm-12 col-xs-12 text-center col-lg-2 icon-box" style="text-align:center;">
                        <p><i class="fa fa-address-card"></i></p>
                        <p class="h4"><router-link to="/faq-guides" title="Extensive LIBRARY">Extensive LIBRARY</router-link></p>
                    </div>
                    <div class="col-md-2 col-sm-12 col-xs-12 col-lg-2"></div>
                </div>
                
                <div class="row" style="padding-top:12px;padding-bottom:0px;margin-left:0px;margin-right:0px;">
                    <div class="col-md-12 col-sm-8 col-xs-12 col-lg-12">
                        <p>Step #2:&nbsp; Review the guide that we email you to ensure your child care “advertisement” receives maximum visibility and to learn more about how our community works.</p>
                        <p>Step #3:&nbsp; Post your child care need or opportunity to our 20,000 member community and begin receiving replies in minutes!</p>
                        <p>Need some additional help finding or offering care? No problem….just <a title="email us" href="mailto:laura@nannyparentconnection.com">email us</a> or call <a title="Call us On" href="tel:(425) 243-7032">(425) 243-7032</a> and we will jump in to help you with your search!</p>
                    </div>
                </div>
                <div class="row" style="text-align: center; margin-top: 20px;">
                    <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12">
                        <p style="text-align:center;font-size:12px;margin-bottom: 0;">By signing up, you agree to our <router-link to="/privacy-policy">Privacy Policy </router-link>and <router-link to="/terms-of-use" rel="Terms of Use">Terms of Use</router-link></p>
                        
                        <p style="text-align:center;font-size:12px;"><a title="Interested in advertising with us?" href="mailto:advertising@nannyparentconnection.com?subject=Advertising with Nanny Parent Connection">Interested in advertising with us?</a></p>
                    </div>
            </div>
            
            <div class="boldgrid-section hidden-xs nitro-offscreen" style="text-align:center;padding:18px;background-image:linear-gradient(to left,#457fca,#5691c8);">
            
                <div style="text-align:center;">
                    <h5 class="mod-reset" style="line-height:1.4em;">
                    <span style="color:#fff;font-size:19px;text-align:left;">“This group gives local parents hope in making a wonderful match with Seattle nannies at a time when the supply of traditional care options does not seem to quite meet the demands of this growing city. We had two great nanny share options within an hour of posting! Fantastic!”&nbsp;</span>
                    </h5>
                </div>
            </div>
            </div>
        </section>
    </main>
</template>

<script>
import MemberBuyMembershipPoup from '../views/AllModels/MemberBuyMembershipPoup.vue';
    export default {
        name:'sign-up-chooser',
        data() {
            return {
                pageName : 'SignUpChooser'
                // pageTitle : 'Agency Memberships and Integrations | Nanny Parent Connection',
                // pageMetaDescription : 'Are you a representative of a nanny agency or elder care agency interested in using the amazing tools that we offer? Sign up today!',
                // pageMetaKeywords : ''
            }
        },
        components: {        
			MemberBuyMembershipPoup
		},
        mounted() {
            axios.get(`/api/get-seo-page`).then((response) => {
				var getData = response.data.page_seo_data.find((employee) => employee.page_Name == this.pageName);					
				document.title = getData.seo_Title;
				document.getElementsByTagName('meta')["description"].content = ""+getData.meta_description+"";
				document.getElementsByTagName('meta')["keywords"].content = ""+getData.meta_tags+"";					
			}).catch((err) => console.error(err));
        },
        created() {
            window.scrollTo(0,0); 
        }        		
    }
</script>

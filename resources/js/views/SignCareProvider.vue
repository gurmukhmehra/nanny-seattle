<template>
    <main>
        <MemberBuyMembershipPoup/>
        <section class="sec-padding scp-head">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-lg-5">&nbsp;</div>
                    <div class="col-md-6 col-lg-7 text-center">
                        <h4 style="font-size: 34px; text-align: center;font-family: Open Sans;margin-bottom: 30px;">Nanny/Sitter Memberships</h4>
                        <span v-if="isLoggedIn">
                            <span v-for="userplans in userplan" :key="userplans.id">
                                <button v-if="userplans.product_id == plans[1].id" class="custom_yellow_btn" style="margin-top: 0px;padding: 10px 25px;">
                                    Already purchased
                                </button>                               		
                                <span v-else class="w-100">
                                    <router-link :to="{name: 'buy-care-provider-free-plan-questions', 
                                        params: { 
                                            slug: plans[1].post_title_slug
                                        }
                                    }" 
                                    class="custom_yellow_btn" title="Yes, I’d like a recommendation">
                                    Click here to join for FREE!
                                </router-link>
                                </span>
                            </span>
                        </span>
                        <span v-else>                                    
                                <router-link :to="{name: 'buy-care-provider-free-plan-questions', 
                                        params: { 
                                            slug: plans[1].post_title_slug
                                        }
                                    }" 
                                    class="custom_yellow_btn" title="Yes, I’d like a recommendation">
                                    Click here to join for FREE!
                                </router-link>                                    
                        </span>
                        <p class="mod-reset mt-4" style="text-align:center;">Not sure which membership to go with? <a href="https://chatting.page/9euod6h4zejuvmox4m83ojdvyxqzfq88" target="_blank">Click here</a> and our team will make a recommendation for you.</p>
                    </div>
                    
                </div>
            </div>
        </section>
        <section style="background-image: linear-gradient(#2980b9, #2c3e50);margin-top: 30px;margin-bottom: 30px;">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-lg-12" style="padding-top: 50px;padding-bottom: 32px;">
                        <h3 class="text-center text-white" style="margin-bottom: 5px;">Interested in becoming one of our amazing Learning Guides©?</h3>
                        <p style="text-align:center;margin-bottom: 5px;font-size: 18px;"><span style="color:#fff;">Learning Guides are verified, experienced educators who provide in-home academic support and childcare services.</span></p>
                        <p class="text-center">
                            <router-link to="/learning-guides-provider-how-it-works" class="text_pink" title="GET STARTED">Click here to learn more</router-link>
                        </p>
                    </div>
                </div>
            </div>
        </section>
        <section class="video-sec sec-padding">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-lg-12">
                        <h3 class="text-center" style="margin-bottom: 30px;font-size: 27px;">Curious about what membership benefits we offer? Check out the video below:</h3>
                    </div>
                    <div class="row">
                        <div class="col-md-4 col-sm-12 col-xs-12 col-lg-4"></div>
                        <div class="col-md-4 col-sm-12 col-xs-12 col-lg-4">
                            <iframe width="100%" height="200" src="https://www.youtube.com/embed/SC6mAF8by_U" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>	
                        </div>
                        <div class="col-md-4 col-sm-12 col-xs-12 col-lg-4"></div>
                    </div>
                </div>
            </div>
        </section>
        <section id="pricing" class="our_pricing section-padding sec-padding" style="padding-top: 0;">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-lg-12">
                        <h1 class="text-center">Your #1 Source for Nanny Jobs in Seattle</h1>
                        <h2 class="sec-heading text-center" style="margin-bottom: 20px;margin-top: 20px;font-size: 18px;font-weight: 600;">Don’t forget! If you would like priority personal help from our expert team, make sure to sign up for our Annual membership below.</h2>
                        <p style="line-height:1.5em;text-align:center;font-size: 17px;">Questions? Email us at <a title="Email us On" href="mailto:info@nannyparentconnection.com">info@nannyparentconnection.com</a> or call/text <a title="Call Us On" href="tel:(425) 243-7032">(425) 243-7032</a></p>		
                    </div>
                </div>
                <div class="row">
                    <div class="first-grid col-xs-12 col-sm-4 col-lg-4" style="padding-left: 0; padding-right: 0;padding-top: 8px;">
                        <div class="pricingTable pricingTable-2">
                            <div class="pricingTable-header">
                            <h3 class="title mob-title">&nbsp;</h3>
                                <div class="ptsColDesc ptsToggle" style="background-color: transparent;"> 
                                    <div class="ptsEl"><span class="price" style="color: rgb(98, 98, 98); font-weight: 500;">Price</span>
                                    <span style="font-size:10pt;" data-mce-style="font-size: 10pt;">COMPARE MEMBERSHIP FEATURES</span></div> 
                                </div>
                                
                            </div>
                            <ul class="pricing-content">
                                <li><router-link to="/verified-care-providers">Verified Care Provider Service</router-link></li>
                                <li>FREE 48 Hour Trial Period?</li>
                                <li><router-link to="/background-checks">Discounted Background Checks</router-link></li>
                                <li>Personal Support?</li>
                                <li><router-link to="/last-minute-group-text">Last Minute Care Service</router-link></li>
                                <li><router-link to="/care-providers-jobs">Browse Current Job Openings</router-link></li>
                                <li><a href="https://www.facebook.com/groups/SeattleNannyParentConnection/" target="_blank">Access our Facebook Community</a></li>
                                <li><router-link to="/member-search">Member Search</router-link></li>
                                <li><router-link to="/pay-calculator" title="PAY CALCULATOR">Pay Calculator</router-link></li>
                                <li><router-link to="/faq-guides">Information Library</router-link></li>
                                <li style="height: 72px;">Terms</li>
                                <li>Reviews</li>
                                <li class="mob-title">&nbsp;</li>
                            </ul>
                            <!--a href="#" class="btn btn-lg btn-price-bg">Start 7-day free trial</a-->
                        </div>
                    </div><!-- END COL  -->		
                    <div id="comparison" class="second-grid col-xs-12 col-sm-4 col-lg-4" style="padding-left: 0; padding-right: 0;padding-top: 4px;">
                        <div class="pricingTable pricingTable-First pricingTable-2">
                            <div class="pricingTable-header">
                                <h3 class="title">Annual</h3>
                                <div class="ptsColDesc ptsToggle" style="padding-left: 0; padding-right: 0;"> 
                                    <div class="ptsEl">
                                        <span class="price">$2.99/month</span>                                        
                                        <span class="cut_price">$6.99/month</span>
                                    </div> 
                                </div>
                                <div class="ptsColBadgeContent" style="background-color:#ff000d;color:#fff;width:169px;display:block;font-size:15px;line-height:normal;position:absolute;top:25.052px;right:-26.8205px;">BEST DEAL!</div>
                            </div>
                            <ul class="pricing-content">
                                <li><i class="fa fa-check"></i></li>
                                <li><i class="fa fa-check"></i></li>
                                <li>One FREE Premium Plus Background Check every year!*</li>
                                <li>Priority Access</li>
                                <li>Priority Access</li>
                                <li><i class="fa fa-check"></i></li>
                                <li><i class="fa fa-check"></i></li>
                                <li><i class="fa fa-check"></i></li>
                                <li><i class="fa fa-check"></i></li>
                                <li><i class="fa fa-check"></i></li>
                                <li style="height: 72px;">Recurring annual payment of<br> $35.88</li>                              
                                <li>381 Reviews
                                    <div class="star-rev">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                    </div>
                                </li>                                
                                <span v-if="isLoggedIn">
                                    <li v-if="userplan.length>0" v-for="userplans in userplan" :key="userplans.id">
                                        <span v-if="userplans.subscriptionsTransactions.product_id == plans[0].id">
                                            <button class="custom_yellow_btn" style="margin-top: 0px;padding: 10px 25px;">
                                                Already purchased
                                            </button>	
                                        </span>		
                                        <span v-else class="w-100">
                                            <router-link :to="{name: 'register', 
												params: { 
													slug: plans[0].post_title_slug
												}
											}" 
                                            class="custom_yellow_btn">
                                            SIGN UP
                                        </router-link>
                                        </span>
                                    </li>
                                    <li v-else>
                                        <router-link :to="{name: 'register', 
												params: { 
													slug: plans[0].post_title_slug
												}
											}" 
                                            class="custom_yellow_btn">
                                            SIGN UP
                                        </router-link>
                                    </li>
                                </span>
                                <span v-else>
                                    <li>
                                        <router-link :to="{name: 'register', 
												params: { 
													slug: plans[0].post_title_slug
												}
											}" 
                                            class="custom_yellow_btn">
                                            SIGN UP
                                        </router-link>
                                    </li>
                                </span>
                            </ul>                            
                        </div>
                    </div><!-- END COL  -->
                    <div class="third-grid col-xs-12 col-sm-4 col-lg-4" style="padding-left: 0; padding-right: 0;padding-top: 4px;">
                        <div class="pricingTable pricingTable-Third pricingTable-3">
                            <div class="pricingTable-header">
                                <h3 class="title">Monthly </h3>
                                <div class="ptsColDesc ptsToggle" style="background-color: rgba(129,160,161,1);"> 
                                    <div class="ptsEl">
                                        <span class="price">FREE</span>
                                        <span class="cut_price">$9.99/month</span>
                                    </div> 
                                </div>		
                            </div>
                            <ul class="pricing-content">
                                <li><i class="fa-regular fa-square"></i></li>
                                <li><i class="fa-regular fa-square"></i></li>
                                <li><i class="fa-regular fa-square"></i></li>
                                <li><i class="fa fa-check"></i></li>
                                <li><i class="fa fa-check"></i></li>
                                <li><i class="fa fa-check"></i></li>
                                <li><i class="fa fa-check"></i></li>
                                <li><i class="fa fa-check"></i></li>
                                <li><i class="fa fa-check"></i></li>
                                <li><i class="fa fa-check"></i></li>                                
                                <li style="height: 72px;">100% FREE! No credit card required</li>
                                <li>503 Reviews
                                <div class="star-rev">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                </div></li>
                                <span v-if="isLoggedIn">
                                    <li v-if="userplan.length>0" v-for="userplans in userplan" :key="userplans.id">
                                        <span v-if="userplans.product_id == plans[1].id">
                                            <button class="custom_yellow_btn" style="margin-top: 0px;padding: 10px 25px;">
                                                Already purchased
                                            </button>	
                                        </span>		
                                        <span v-else class="w-100">
                                            <router-link :to="{name: 'buy-care-provider-free-plan-questions', 
												params: { 
													slug: plans[1].post_title_slug
												}
											}" 
                                            class="custom_yellow_btn">
                                            SIGN UP
                                        </router-link>
                                        </span>
                                    </li>
                                    <li v-else>
                                        <router-link :to="{name: 'buy-care-provider-free-plan-questions', 
												params: { 
													slug: plans[1].post_title_slug
												}
											}" 
                                            class="custom_yellow_btn">
                                            SIGN UP
                                        </router-link>
                                    </li>
                                </span>
                                <span v-else>
                                    <li>
                                        <router-link :to="{name: 'buy-care-provider-free-plan-questions', 
												params: { 
													slug: plans[1].post_title_slug
												}
											}" 
                                            class="custom_yellow_btn">
                                            SIGN UP
                                        </router-link>
                                    </li>
                                </span>
                            </ul>
                        </div>
                    </div>
                    <!-- END COL  -->		
                </div><!--END  ROW  -->
                <br>
                <p style="text-align:center;">Note: Free Premium Plus Background Check requires an active Annual membership and participation in our <router-link to="/verified-care-providers">Verified Care Provider Service</router-link>.</p>		
            </div><!-- END CONTAINER  -->
        </section>
        <section class="sec-padding bio-sec" style="background-color: #dee9fb;background-color:#dee9fb;padding-top: 35px;">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-lg-12">
                        <h4 class="text_pink text-center" style="text-transform:uppercase;font-size:26px;font-family:Open Sans;">WHAT CARE PROVIDERS ARE SAYING</h4>
                    </div>
                </div>                    
                <div class="row" style="margin-top: 20px;">
                    <div class="col-md-4 col-lg-4 text-center">
                        <div class="bio-des">
                            <img src="/public/assets/images/nanny-3.JPG">
                            <div class="text-dark" style="font-family:Open Sans;font-size:18px;margin-top:20px;margin-bottom:18px;line-height: 25px;">
                                “I had seven job offers in two days! I choose a new family Monday. Thanks for all your help — honestly loving the website. The resources are fantastic!”
                                <h5 style="text-align:center;margin-top:20px;padding-bottom:.8em;"><span style="color:#e58eb2;"><strong>SARA N.</strong></span></h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-lg-4 text-center">
                        <div class="bio-des">
                            <img src="/public/assets/images/nanny1.JPG">
                            <div class="text-dark" style="font-family:Open Sans;font-size:18px;margin-top:20px;margin-bottom:18px;line-height: 25px;">
                                “Working as a nanny leaves me feeling isolated at times. I don’t have co-workers that I see everyday. Being a member of the Nanny Parent Connection has created an instant community of “co-workers” that I can rely on!”
                                <h5 style="text-align:center;margin-top:20px;padding-bottom:.8em;"><span style="color:#e58eb2;"><strong>EMILY J.</strong></span></h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-lg-4 text-center">
                        <div class="bio-des">
                            <img src="/public/assets/images/nanny2.JPG">
                            <div class="text-dark" style="font-family:Open Sans;font-size:18px;margin-top:20px;margin-bottom:18px;line-height: 25px;">
                                “I have been blessed to find the last three families that I have worked for through the Nanny Parent Connection community. Thank you!”
                                <h5 style="text-align:center;margin-top:20px;padding-bottom:.8em;"><span style="color:#e58eb2;"><strong>CAITLIN M.</strong></span></h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="sec-padding">
            <div class="container">
				 <div class="row">
					<div class="col-md-12 col-lg-12">
						<h4 class="text-center" style="font-size: 33px;font-family: Open Sans;">We provide everything you need to find a wonderful family to work with!</h4>
					</div>
				 </div>				 
				 <div class="row">
					<div class="col-md-12 col-xs-12 col-sm-12 col-lg-12">
						<p style="text-align:center;">Find Seattle area nanny jobs and sitter positions in MINUTES! We have <span style="text-decoration:underline;">hundreds of families</span> searching for long term, short term, date night, and last minute care in the Puget Sound region. Need help offering your services? Just ask our team!</p>
						<p style="text-align:center;">Not sure we are the right fit for you? Check out our FREE Care Provider membership above – it’s 100% free and no credit card is required!</p>
						<p style="text-align:center;">Want to fill your schedule and earn more money? All memberships include access to our <router-link to="/last-minute-group-text" title="Last Minute Care ">Last Minute Care Text Service</router-link> or sign up for an Annual membership and become a <router-link to="/verified-care-providers" title="Verified Care Provider">Verified Care Provider!</router-link></p>
						<p style="font-size:15px;text-align:center;">Want to learn more about what we offer? Email us at <a title="Mail us on" href="mailto:info@nannyparentconnection.com">info@nannyparentconnection.com</a> or call/text <a title="Call us On" href="tel:(425) 243-7032">(425) 243-7032.</a></p>
					</div>					
				</div>				
				<div class="row">
					<div class="col-md-12 col-xs-12 col-sm-12 col-lg-12" style="margin: 0 auto;">
						<p class="mt-5" style="text-align: center; font-size: 20px; letter-spacing: 1px; line-height: 1.1em;">Nanny Parent Connection is a Seattle based business run by me, a Seattle mother of four. Thank you for supporting women owned, local businesses!</p>
                        <p class="text-center"><img src="/public/assets/images/Laura-Signature.png"></p>
                    </div>
				</div>
		    </div>
        </section>
    </main>
</template>

<script>
    const axios = require('axios');
    import MemberBuyMembershipPoup from '../views/AllModels/MemberBuyMembershipPoup.vue';
    export default {
        name:'sign-care-provider',
        data() {
            return {
                isLoggedIn: false,
                plans: [],
                userplan: [],
                pageName : 'SignCareProvider'
                // pageTitle : 'Nanny Jobs in Seattle - Sign Up Now | We Have Babysitting Jobs Too!',
                // pageMetaDescription : 'Nanny Jobs in Seattle! Access the most families looking for long term, short term, date night & last minute babysitters and childcare providers in Seattle.',
                // pageMetaKeywords : ''
            }
        },
        components: {        
			MemberBuyMembershipPoup
		},	
        methods: {
            CareProviderAnnualPlan() {
                axios.get(`/api/care-provider/annual/plan`, {
                }).then((response) => { 
                    this.plans = response.data.careProviderAnnualPlans;
                }).catch(error => {
                });  
            }          
        },        
        mounted() {
            axios.get(`/api/get-seo-page`).then((response) => {
				var getData = response.data.page_seo_data.find((employee) => employee.page_Name == this.pageName);					
				document.title = getData.seo_Title;
				document.getElementsByTagName('meta')["description"].content = ""+getData.meta_description+"";
				document.getElementsByTagName('meta')["keywords"].content = ""+getData.meta_tags+"";					
			}).catch((err) => console.error(err));
            if (window.Laravel.isLoggedin) {
				this.isLoggedIn = true
			}	
			if (window.Laravel.user) {	
					axios.get(`/api/userPlan/${window.Laravel.user.id}`).then((response) => {
					//console.log(response.data[0].user_id);
					this.userplan= response.data.userPlans;
				}).catch((err) => console.error(err));
			}            
        },
        created(){
            window.scrollTo(0,0); 
            this.CareProviderAnnualPlan();
        },
        beforeRouteEnter(to, from, next) 
        { 					
            next(); 
        }	
    }
</script>
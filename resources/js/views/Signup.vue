<template>
	<main>
		<MemberBuyMembershipPoup/>
	<section class="sec-padding of-head" style="background-image: url('/public/assets/images/nanny-hugging-child-scaled.jpg');background-size: cover;
		background-position: 50% 0%;
		width: auto;
		padding:14% 0% 14% 0%">
		<div class="container">
			<div class="row"> 
				<div class="col-md-6 col-xs-12 col-sm-12 col-lg-6">
					<h2 class="sec-heading text-left">Family/Parent Memberships</h2>
					<p>Would you like our team to recommend a membership and resource for you to use to quickly find the right care provider?</p>
					<p class="mt-4 mb-4"><a class="pinkBtn2 btn-rounded text-white" title="Yes, I’d like a recommendation" href="https://chatting.page/9euod6h4zejuvmox4m83ojdvyxqzfq88" Target="_blank">Yes, I’d like a recommendation</a></p>
					<p>Or scroll down to view the different membership packages</p>
				</div>
				<!-- <div class="col-md-6 col-lg-5"><img src="/public/assets/images/sign-bg.jpg"></div> -->
			</div>
		</div>
	</section>
	<section class="sec-padding get-started" style="background-image: linear-gradient(#b24592, #f15f79); margin-top: 30px; margin-bottom: 30px;" data-bg-color-1="#B24592" data-bg-color-2="#F15F79">
		<div class="container">
			<div class="row">
				<div class="col-md-12 col-lg-12">
					<h3 style="text-align: center;"><span style="color: #ffffff;">Prefer that our expert team handle the search for you?</span></h3>
					<h6 style="text-align: center;"><span style="color: #ffffff;">Check out our Signature Concierge Service. We take care of searching, vetting, and presenting candidates to you. We handle everything.<br></span></h6>
					<h6 style="text-align: center; padding-top: 0.5em; font-size: 19px;">
						<span style="text-decoration: underline; color: #ffffff;">
							<strong>
								<router-link to="/sign-up-families-parents-concierge" style="color: #ffffff; text-decoration: underline;" title="Click here to learn more">Click here to learn more</router-link>
							</strong>
						</span>
					</h6>
				</div>
			</div>
		 </div>
	</section>
	<section id="pricing" class="our_pricing section-padding sec-padding">
		<div class="container">
		<div class="row">
				<div class="col-md-12 col-lg-12">
					<h2 class="sec-heading text-center" style="margin-bottom: 20px;">Don’t forget! No matter which membership you go with, our team is just a message or phone call away if you need help!</h2>
					<h6 style="line-height:1.5em;text-align:center;">Questions? Email us at <a title="Email us On" href="mailto:info@nannyparentconnection.com">info@nannyparentconnection.com</a> or call/text <a title="Call Us On" href="tel:(425) 243-7032">(425) 243-7032</a></h6>		
				</div>
			</div>
			<div class="row">
				<div class="first-grid col-xs-12 col-sm-3 col-lg-3" style="padding-left:0px; padding-right:0px;padding-top: 4px;">
					<div class="pricingTable pricingTable-2">
						<div class="pricingTable-header">
						<h3 class="title mob-title">&nbsp;</h3>
							<div class="ptsColDesc ptsToggle" style="background-color: transparent;"> 
								<div class="ptsEl"><span class="price" style="color: rgb(98, 98, 98); font-weight: 500;">Price</span>
								<span style="font-size:10pt;" data-mce-style="font-size: 10pt;">COMPARE MEMBERSHIP FEATURES</span></div> 
							</div>
							
						</div>
						<ul class="pricing-content">
							<li><router-link to="/nanny-contract">Nanny/Nanny Share Contracts Included?</router-link></li>
							<li>Personal Support Response Time</li>
							<li><a href="https://www.facebook.com/groups/SeattleNannyParentConnection/" target="_blank">Access our Facebook Community</a></li>
							<li><router-link to="/background-checks">Discounted Background Checks</router-link></li>
							<li><router-link to="/last-minute-group-text">Last Minute Care Service</router-link></li>
							<li><router-link to="/verified-care-providers">Verified Care Provider Service</router-link></li>						
							<li><router-link :to="{name:'help', hash:'#'+'scroll180194'}">Member Feedback</router-link></li>
							<li><router-link to="/pay-calculator" title="PAY CALCULATOR">Pay Calculator</router-link></li>
							<li><router-link to="/faq-guides">Information Library</router-link></li>
							<li style="height: 72px;">Terms</li>
							<li>Reviews</li>
						</ul>
						<!--a href="#" class="btn btn-lg btn-price-bg">Start 7-day free trial</a-->
					</div>
				</div><!-- END COL  -->	
	
				<!--------------------- Annul Plan ---------------------------------->
				<div class="second-grid col-xs-12 col-sm-3 col-lg-3" style="padding-left: 0; padding-right: 0;">
					<div class="pricingTable pricingTable-First pricingTable-2">
						<div class="pricingTable-header">
							<h3 class="title" v-if="plans[0].mepr_product_period === 'years'">Annual</h3>
							<div class="ptsColDesc ptsToggle" style="padding-left: 0; padding-right: 0;"> 
								<div class="ptsEl">
									<!-- <span class="price">${{plans.mepr_product_price/12*100}}/month</span> -->
									<span class="price">$8.99/month</span>
									<span class="cut_price">$15.99/month</span>									
								</div> 
							</div>
							<div class="ptsColBadgeContent" style="background-color:#ff000d;color:#fff;width:169px;display:block;font-size:15px;line-height:normal;position:absolute;top:25.052px;right:-26.8205px;">BEST DEAL!</div>
						</div>
						<ul class="pricing-content">
							<li>All Contracts FREE!</li>
							<li>Within 1 hour</li>
							<li><i class="fa fa-check"></i></li>
							<li><i class="fa fa-check"></i></li>
							<li>Priority Access</li>
							<li>Priority Access</li>
							<li><i class="fa fa-check"></i></li>
							<li><i class="fa fa-check"></i></li>
							<li><i class="fa fa-check"></i></li>
							<li style="height: 72px;">Recurring annual payment of<br> $107.88</li>
							<li>1,041 Reviews
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
									<span v-if="userplans.product_id == plans[0].id">
										<button class="custom_yellow_btn" style="margin-top: 0px;padding: 10px 25px;">
											Already Buy
										</button>	
									</span>
									<span v-else class="w-100">
										<router-link :to="{name: 'register', 
												params: { 
													slug: plans[0].post_title_slug
												}
											}" 
										class="custom_yellow_btn">SIGN UP
										</router-link>
									</span>
								</li>
								<li v-else>
									<router-link :to="{name: 'register', 
											params: { 
												slug: plans[0].post_title_slug
											}
										}" 
									class="custom_yellow_btn">SIGN UP
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
										class="custom_yellow_btn">SIGN UP
									</router-link>
								</li>
							</span>					
						</ul>					
					</div>
				</div>
			<!--------------------- End Annul Plan ---------------------------------->
			<!------------------------ Month Plan ----------------------------------->
				<div class="third-grid col-xs-12 col-sm-3 col-lg-3" style="padding-left: 0; padding-right: 0;">
					<div class="pricingTable pricingTable-Third pricingTable-3">
						<div class="pricingTable-header">
							<h3 class="title">Monthly </h3>
							<div class="ptsColDesc ptsToggle" style="background-color: rgba(129,160,161,1);"> 
								<div class="ptsEl">
									<span class="price" v-if="paymentMode=='test_mode'">
										${{plans[1].mepr_product_price}}/month
									</span>
									<span class="price" v-else>
										${{plans[2].mepr_product_price}}/month
									</span>
									<span class="cut_price">$24.99/month</span>
								</div> 
							</div>		
						</div>
						<ul class="pricing-content">
							<li>10% off all nanny contracts</li>
							<li>Within 8 hours</li>
							<li><i class="fa fa-check"></i></li>
							<li><i class="fa fa-check"></i></li>
							<li><i class="fa fa-check"></i></li>
							<li><i class="fa fa-check"></i></li>
							<li><i class="fa fa-check"></i></li>
							<li><i class="fa fa-check"></i></li>
							<li><i class="fa fa-check"></i></li>
							<li style="height: 72px;">Cancel anytime</li>
							<li>983 Reviews
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
											Already Buy
										</button>	
									</span>
									<span v-else class="w-100">
										<span v-if="paymentMode=='test_mode'">
											<router-link :to="{name: 'register', 
													params: { 
														slug: plans[1].post_title_slug
													}
												}" 
												class="custom_yellow_btn">SIGN UP
											</router-link>
										</span>
										<span v-else>
											<router-link :to="{name: 'register', 
													params: { 
														slug: plans[2].post_title_slug
													}
												}" 
												class="custom_yellow_btn">SIGN UP
											</router-link>
										</span>
									</span>
								</li>
								<li v-else>
									<span v-if="paymentMode=='test_mode'">
										<router-link :to="{name: 'register', 
												params: { 
													slug: plans[1].post_title_slug
												}
											}" 
											class="custom_yellow_btn">SIGN UP
										</router-link>
									</span>
									<span v-else>
										<router-link :to="{name: 'register', 
												params: { 
													slug: plans[2].post_title_slug
												}
											}" 
											class="custom_yellow_btn">SIGN UP
										</router-link>
									</span>
								</li>
							</span>
							<span v-else>
								<li>
									<span v-if="paymentMode=='test_mode'">
										<router-link :to="{name: 'register', 
												params: { 
													slug: plans[1].post_title_slug
												}
											}" 
											class="custom_yellow_btn">SIGN UP
										</router-link>
									</span>
									<span v-else>
										<router-link :to="{name: 'register', 
												params: { 
													slug: plans[2].post_title_slug
												}
											}" 
											class="custom_yellow_btn">SIGN UP
										</router-link>
									</span>
								</li>
							</span>
						</ul>
					</div>
				</div>
			<!------------------------ End Month Plan --------------------------------------->
	
			<!------------------------ One Month Plan --------------------------------------->
			<div class="fourth-grid col-xs-12 col-sm-3 col-lg-3" style="padding-left: 0; padding-right: 0;">
				<div class="pricingTable pricingTable-Fourth pricingTable-2">
					<div class="pricingTable-header">
						<h3 class="title">One Month Only</h3>
						<div class="ptsColDesc ptsToggle" style="background-color: rgba(110,159,126,1);"> 
							<div class="ptsEl">
								<span class="price" v-if="paymentMode=='test_mode'">
									${{plans[2].mepr_product_price}}/month
								</span>
								<span class="price" v-else>
									${{plans[1].mepr_product_price}}/month
								</span>
								<span class="cut_price">$49.99</span>
							</div> 
						</div>		
					</div>
					<ul class="pricing-content">
						<li>Available for purchase</li>
						<li>Within 24 hours</li>
						<li><i class="fa fa-check"></i></li>
						<li><i class="fa fa-check"></i></li>
						<li><i class="fa fa-check"></i></li>
						<li><i class="fa fa-check"></i></li>
						<li><i class="fa fa-check"></i></li>
						<li><i class="fa fa-check"></i></li>
						<li><i class="fa fa-check"></i></li>
						<li style="height: 72px;">Try us out first!</li>
						<li>1,321 Reviews
						<div class="star-rev">
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
						</div></li>
						<span v-if="isLoggedIn">
							<li v-if="userplan.length>0" v-for="userplans in userplan" :key="userplans.id">
								<span v-if="userplans.product_id == plans[2].id">
									<button class="custom_yellow_btn" style="margin-top: 0px;padding: 10px 25px;">
										Already Buy
									</button>	
								</span>
								<span v-else class="w-100">
									<span v-if="paymentMode=='test_mode'">
										<router-link :to="{name: 'register', 
													params: { 
														slug: plans[2].post_title_slug
													}
												}" 
											class="custom_yellow_btn">SIGN UP
										</router-link>
									</span>
									<span v-else>
										<router-link :to="{name: 'register', 
													params: { 
														slug: plans[1].post_title_slug
													}
												}" 
											class="custom_yellow_btn">SIGN UP
										</router-link>
									</span> 
								</span>
							</li>
							<li v-else>
								<span v-if="paymentMode=='test_mode'">
									<router-link :to="{name: 'register', 
												params: { 
													slug: plans[2].post_title_slug
												}
											}" 
										class="custom_yellow_btn">SIGN UP
									</router-link>
								</span>
								<span v-else>
									<router-link :to="{name: 'register', 
												params: { 
													slug: plans[1].post_title_slug
												}
											}" 
										class="custom_yellow_btn">SIGN UP
									</router-link>
								</span> 
							</li>
						</span>
						<span v-else>
							<li>
								<span v-if="paymentMode=='test_mode'">
									<router-link :to="{name: 'register', 
												params: { 
													slug: plans[2].post_title_slug
												}
											}" 
										class="custom_yellow_btn">SIGN UP
									</router-link>
								</span>
								<span v-else>
									<router-link :to="{name: 'register', 
												params: { 
													slug: plans[1].post_title_slug
												}
											}" 
										class="custom_yellow_btn">SIGN UP
									</router-link>
								</span> 
							</li>
						</span>
					</ul>
				</div>
			</div>
			<!------------------------ End One Month Plan --------------------------------------->
			<!-- END COL  -->
				
			</div><!--END  ROW  -->			
			
			</div><!-- END CONTAINER  -->
		</section>
		<section style="background-image: linear-gradient(to left, #1e3c72, #2a5298);margin-top: 30px;margin-bottom: 30px;">
			<div class="container">
				<div class="row">
					<div class="col-md-12 col-lg-12" style="padding-top: 50px;padding-bottom: 32px;">
						<h3 class="text-center text-white" style="margin-bottom: 5px;">Interested in hiring one of our amazing Learning Guides©?</h3>
						<p style="text-align:center;margin-bottom: 5px;font-size: 18px;"><span style="color:#fff;">Learning Guides are verified, experienced educators who provide in-home academic support and childcare services.</span></p>
						<h6 class="text-center">
							<router-link to="/learning-guides-parents" class="text_pink" title="Click here to learn more">Click here to learn more</router-link>
						</h6>
					</div>
				</div>
			</div>
		</section>
		
		<section class="sec-padding bio-sec">
			<div class="container">
				<div class="row">
					<div class="col-md-12 col-lg-12">
						<h2 class="sec-heading text-center">WHAT FAMILIES ARE SAYING</h2>
					</div>
				</div>
						
				<div class="row" style="margin-top: 20px;">
					<div class="col-md-4 col-lg-4">
						<div class="bio-des">
							<img src="/public/assets/images/bio1.jpg">
							<div class="bio-text">
								“I work as a nurse and was recently called in unexpectedly. It was a holiday and my son’s school was closed. I frantically needed care so I signed up to use the Last Minute Text Care Service. From signing up to having a nanny contact me to help took less than 15 minutes. Thank you!”
							</div>
						</div>
					</div>
					<div class="col-md-4 col-lg-4">
						<div class="bio-des">
							<img src="/public/assets/images/bio3.jpg">
							<div class="bio-text">
								“Nanny Parent Connection gives local parents hope in making a wonderful match with nannies and sitters at a time when the supply of traditional care options does not seem to quite meet the demands of this growing city. We had two nanny share options within an hour of posting! Fantastic!” 
							</div>
						</div>
					</div>
					<div class="col-md-4 col-lg-4">
						<div class="bio-des">
							<img src="/public/assets/images/bio4.jpg">
							<div class="bio-text">
								“My husband and I had been using one of the big name sites for our background checks. We just ordered the Premium Plus check on one of our  babysitters through Nanny Parent Connection. The report came back in less than 24 hours, was easy to understand, and was $40.00 CHEAPER!”
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
					<h2 class="sec-heading text-center">We offer everything you need to find, hire, and employ a part time, full time, temporary, or last minute care provider.</h2>
				</div>
				</div>				 
				<div class="row">
					<div class="col-md-6 col-lg-6">
						<p>
							<span style="color: #e58eb2; font-size: 18px;"><i class="fa bg-inserted-icon fa-check-circle" aria-hidden="true"><span style="display: none;">&nbsp;</span></i></span> Tap into the largest community of experienced Seattle area nannies and sitters with our 
							<router-link to="/member-search">Member Search</router-link> tool and 
							<a href="https://www.facebook.com/groups/SeattleNannyParentConnection/">Facebook communities</a>.
							Over 20,000 members and growing!
						</p>
						<p><span style="color: #e58eb2; font-size: 18px;"><i class="fa bg-inserted-icon fa-check-circle" aria-hidden="true"><span style="display: none;">&nbsp;</span></i></span> Child home sick? Called into work unexpectedly? Find a care provider fast using our 
							<router-link to="/last-minute-group-text" title="Last Minute Care Text Service">
								Last Minute Care Text Service
							</router-link>
						</p>
						<p><span style="color: #e58eb2; font-size: 18px;"><i class="fa bg-inserted-icon fa-check-circle" aria-hidden="true"><span style="display: none;">&nbsp;</span></i></span> We all need a night off. Date night childcare!</p>
						<p><span style="color: #e58eb2; font-size: 18px;"><i class="fa bg-inserted-icon fa-check-circle" aria-hidden="true"><span style="display: none;">&nbsp;</span></i></span> Need to find child care fast? Prefer that our expert team handle the search and vetting process? Check out our 
							<router-link to="/sign-up-families-parents-concierge">
								Signature Concierge Service
							</router-link>
						</p>
						<p><span style="color: #e58eb2; font-size: 18px;"><i class="fa bg-inserted-icon fa-check-circle" aria-hidden="true"><span style="display: none;">&nbsp;</span></i></span> Access hundreds of Puget Sound nanny shares with your membership</p>
						<p><span style="color: #e58eb2; font-size: 18px;"><i class="fa bg-inserted-icon fa-check-circle" aria-hidden="true"><span style="display: none;">&nbsp;</span></i></span> All Family memberships qualify for discounted pricing on our 
							<router-link to="/background-checks" title="Background Checks">Background Checks!</router-link>
						</p>
					</div>
					<div class="col-md-6 col-lg-6">
						<p><span style="color: #e58eb2; font-size: 18px;"><i class="fa bg-inserted-icon fa-check-circle" aria-hidden="true"><span style="display: none;">&nbsp;</span></i></span> Spend more time with your family. Let us handle the paperwork. <router-link to="/payroll-service" title="Affordable Payroll Services">Affordable Payroll Services!</router-link></p>
						<p><span style="color: #e58eb2; font-size: 18px;"><i class="fa bg-inserted-icon fa-check-circle" aria-hidden="true"><span style="display: none;">&nbsp;</span></i></span> Need a <router-link to="/nanny-contract" title="Nanny Share Contract">Nanny Contract</router-link> or <router-link to="/nanny-share-contract" title="Nanny Share Contract">Nanny Share Contract</router-link> specific to Washington state? We have you covered!</p>

						<p><span style="color: #e58eb2; font-size: 18px;"><i class="fa bg-inserted-icon fa-check-circle" aria-hidden="true"><span style="display: none;">&nbsp;</span></i></span> Browse our extensive <router-link to="/faq-guides" title="Library">Library</router-link> of answers to your childcare questions</p>

						<p><span style="color: #e58eb2; font-size: 18px;"><i class="fa bg-inserted-icon fa-check-circle" aria-hidden="true"><span style="display: none;">&nbsp;</span></i></span> What have other families said about the care provider you are about to hire? Check out our <a title="Member Feedback" href="help#scroll180251">Member Feedback </a> and <a title="Testimonials" href="help#scroll180251">Testimonials</a></p>

						<p><span style="color: #e58eb2; font-size: 18px;"><i class="fa bg-inserted-icon fa-check-circle" aria-hidden="true"><span style="display: none;">&nbsp;</span></i></span> Need some help figuring out taxes and withholding for your nanny or sitter? Give our <router-link to="/pay-calculator" title="PAY CALCULATOR">Pay Calculator</router-link> a whirl! Process payroll in less than five minutes.</p>

						<p><span style="color: #e58eb2; font-size: 18px;"><i class="fa bg-inserted-icon fa-check-circle" aria-hidden="true"><span style="display: none;">&nbsp;</span></i></span> By utilizing the power of our network, members can find child care in just MINUTES!</p>
					</div>
				</div>
						
				<div class="row">
					<div class="col-md-9 col-xs-12 col-sm-12 col-lg-9" style="margin: 0 auto;">
						<p class="mt-5" style="text-align: center; font-size: 20px; letter-spacing: 1px; line-height: 1.1em;">Nanny Parent Connection is a Seattle based business run by me, a Seattle mother of four. Thank you for supporting women owned, local businesses! </p>
						<p class="text-center"><img src="/public/assets/images/Laura-Signature-1-300x84.png"></p>
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
        name:'signup',
		data() {
            return {
				isLoggedIn: false,
                plans: [],
				userplan: [],
				paymentMode:'',
				pageName : 'SignUpFamiliesParents'
				// pageTitle : 'Experienced Seattle Nannies and Babysitters | Nanny Near Me!',
                // pageMetaDescription : 'Looking for a nanny in Seattle? Thousands of experienced Seattle nannies and babysitters offering childcare plus nanny shares. Join for only $8.99/month.',
                // pageMetaKeywords : ''
            }
        },
		components: {        
			MemberBuyMembershipPoup
		},
		methods: {            
			familiesAnnualPlan() {
                axios.get(`/api/families-parents/annual/plan`, {
                }).then((response) => { 
					this.plans = response.data.familiesAnnualPlan;
					this.paymentMode = response.data.paymentMode;
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
			// document.title = this.pageTitle;
			// document.getElementsByTagName('meta')["description"].content = ""+this.pageMetaDescription+"";
			// document.getElementsByTagName('meta')["keywords"].content = ""+this.pageMetaKeywords+"";

			if (window.Laravel.isLoggedin) {
				this.isLoggedIn = true
			}	
			if(window.Laravel.user) {	
				axios.get(`/api/userPlan/${window.Laravel.user.id}`).then((response) => {
					//console.log(response.data[0].user_id);
					this.userplan= response.data.userPlans;
				}).catch((err) => console.error(err));
			}		
           
        },
		created(){
			window.scrollTo(0,0); 
			this.familiesAnnualPlan();
		},
		beforeRouteEnter(to, from, next) 
		{ 					
			next(); 
		},
    }
</script>
	
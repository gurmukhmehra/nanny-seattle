<template>
	<main>
	<section class="sec-padding full-banner2">
		<div class="container">
		<div class="row">&nbsp;</div>
		<div class="row">&nbsp;</div>
		<div class="row">&nbsp;</div>
		<div class="row">&nbsp;</div>
		<div class="row">&nbsp;</div>
		<div class="row">&nbsp;</div>
		<div class="row">&nbsp;</div>
		  <div class="row" style="padding-top:20px;padding-bottom:19px;">
			<div class="col-md-5 col-xs-12 col-sm-12 align-column-center color-1-text-contrast color1-background-color col-lg-5" style="padding:.4em 1.6em;">
				<div>
					<h4 style="color:#fff;">Most parents and care providers are not attorneys.</h4>
						<p style="color:rgba(255,255,255,.89);font-size:17px;"><span class="s1">That’s why we have worked with our attorney to create an <span style="text-decoration:underline;">easy to understand</span> household employee agreement specific to Washington.</span></p></div></div><div class="col-md-7 col-xs-12 col-sm-12 col-lg-7"></div></div>
		</div>
	</section>
	<section class="sec-padding of-head">
	<div class="container">
		<div class="row" style="margin:0;">
			<div class="col-md-4 col-lg-4 text-center">				
					<i class="fa fa-heart custom_icon" aria-hidden="true"></i>
					<h4>Simple</h4>
					<p>A written agreement fosters open communications and clear expectations which are key to ensuring the relationship with your care provider goes smoothly. Unfortunately, most nanny contracts are filled with confusing legal jargon which many of us don’t understand. </p>
			</div>
			<div class="col-md-4 col-lg-4 text-center">
				<i class="fa fa-pen custom_icon" aria-hidden="true"></i>
					<h4>Up to Date</h4>
					<p>These days, it seems that federal, state and local laws are constantly changing. Our team is constantly monitoring changes to the law and updating our nanny contract accordingly.</p>
			</div>
			<div class="col-md-4 col-lg-4 text-center">				
					<i class="fa fa-briefcase custom_icon" aria-hidden="true"></i>
					<h4>Complete</h4>
					<p>While there are many free “nanny contracts” available online, most <span style="text-decoration:underline;">do not</span> include important laws and regulations such as Paid Sick Leave, Paid Family and Medical Leave, and COVID-19 safety that are required in Washington. Will your household employee be employed in Seattle? This agreement has you covered. </p>
			</div>
		</div>
		<div class="row mt-5">
			<div class="col-md-4 col-lg-4 text-center">	
				<div class="" style="padding: 65px 10%;">		
					<h2 class="" style="font-size:44px;">$59.99</h2>
					<p class="mt-4 mb-4">
						<span v-if="isLoggedIn">
							<span v-for="userplans in userplan" :key="userplans.id">
								<span v-if="userplans.product_id == plans[0].id">
									<button class="custom_yellow_btn" style="margin: 20px auto;" title="CLICK HERE FOR PACKAGES AND PRICING">Already Buy</button>
								</span>
								<span v-else class="w-100">
									<router-link :to="{name: 'register', 
											params: { 
												slug: plans[0].post_title_slug
											}
										}" 
										class="custom_yellow_btn" style="margin: 20px auto;" title="CLICK HERE FOR PACKAGES AND PRICING">
										PURCHASE
									</router-link>
								</span>
							</span>
						</span>
						<span v-else>
							<router-link :to="{name: 'register', 
									params: { 
										slug: plans[0].post_title_slug
									}
								}" 
								class="custom_yellow_btn" style="margin: 20px auto;" title="CLICK HERE FOR PACKAGES AND PRICING">
								PURCHASE
							</router-link>
						</span>
					</p>
					<h6><a style="color:#e58eb2;" title="Click here to see a sample" href="#sample">Click here to see a sample</a></h6>
					<p>The agreement is FREE for families who have purchased an <router-link to="/offer-families-parents" style="color:#e58eb2;" title="Annual membership">Annual membership</router-link>. Log in and click the link at the bottom of the page to download.</p>
				</div>	
			</div>
			<div class="col-md-4 col-lg-4 text-center" style="background-color: rgb(229, 142, 178); color: rgb(255, 255, 255); padding: 20px;">				
					<h4>Instructions</h4>
					<p><strong>Step #1:</strong> Complete your purchase and download the document below. We have provided this to you in Microsoft® Word format so that you can edit any section of the agreement.</p>
					<p><strong>Step #2:</strong> We have included placeholder text in red to show you what specific information you may want to include and instructional text in green.</p>
					<p><strong>Step #3:</strong> When completed, print or email a copy to your care provider.</p>
					<p>You will have access to our nanny contract for six months in case you need to download another copy in the future.</p>
					<p>Questions? Email us at <a title="Mail Us On" href="mailto:info@nannyparentconnection.com" class="text-white">info@nannyparentconnection.com</a> or call/text (425) 243-7032.</p>
			</div>
			<div class="col-md-4 col-lg-4 text-center">				
				<img src="public/assets/images/covid-19.JPG">
				<p class="nitro-offscreen">While you are free to make any changes to this document that you like, we recommend that you <router-link to="/faq-guides" title="review the information in our library">review the information in our library</router-link>&nbsp; to ensure that you are not removing important clauses which may lead to problems in the future.&nbsp;</p>
				<p>Consult professional legal advice if you have any questions about this agreement or what information to include. We cannot provide legal advice or representation. Use of this document is subject to our <router-link to="/terms-of-use" title="Terms of Use">Terms of Use</router-link> and <router-link to="/privacy-policy" rel="Privacy Policy">Privacy Policy</router-link></p>
			</div>
		</div>


		<div class="row mt-5 mb-4">
			<div class="col-md-12 col-xs-12 col-sm-12 col-lg-12">
				<p class="text-center">
					<iframe title="YouTube video player" src="https://www.youtube.com/embed/FN4gYYlIfVU" allowfullscreen="allowfullscreen" data-mce-fragment="1" width="640" height="360" frameborder="0"></iframe>
				</p>
			</div>
		</div>
		<div class="row"><p style="text-align:center;">Below is a low resolution sample of the first three pages of the Nanny/Babysitter Contract:</p></div>
		
		<div class="row text-center">
			<div class="col-md-12 col-lg-12 text-center" id="sample">
				<img src="public/assets/images/instruction.jpg" style="width: auto;" class="text-center"><br>
				<img src="public/assets/images/instruction2.jpg" style="width: auto;" class="text-center"><br>
				<img src="public/assets/images/instruction3.jpg" style="width: auto;" class="text-center">
			</div>
		</div>
	</div>
</section>
	
	</main>
	</template>
	
	<script>
		const axios = require('axios');
		export default {
			name:'nanny-contract',
			data() {
				return {
					isLoggedIn: false,
					plans: [],
					userplan: [],
					pageName : 'NannyContract'
					// pageTitle : '"Easy to Understand" Nanny Contracts | Nanny Parent Connection',
					// pageMetaDescription : 'While there are many free "nanny contracts" available online, most do not include important laws and regulations such as Paid Sick...',
					// pageMetaKeywords : ''
				}
			},
			methods: {
				nannyContractPlan() {
					axios.get(`/api/NannyContract/plan`, {
					}).then((response) => { 
						this.plans = response.data.NannyContractPlan;
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
				this.nannyContractPlan();
			}
		}
	</script>
	
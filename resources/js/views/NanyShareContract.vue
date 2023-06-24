<template>
	<main>
		<section class="sec-padding full-banner full-banner-nanny">
			<div class="container">
				<div class="row" style="padding-top: 35px; padding-bottom: 0px;">
					<div class="col-md-7 col-xs-12 col-sm-9 col-lg-7">&nbsp;</div>					
					<div class="col-md-5 col-xs-12 col-sm-3 col-lg-5 ">
						<div style="padding:.4em 1.6em;" class="color1-background-color">
							<h4 style="color:#fff;">Most parents and care providers are not attorneys.</h4>
							<p style="color:#fff;">That’s why we have worked with our attorney to create an <span style="text-decoration:underline;">easy to understand</span> household employee agreement specific to Washington.</p>
						</div>						
					</div>
				</div>
				<div class="row" style="padding-top: 0px; padding-bottom: 23px;">
					<div class="col-md-7 col-xs-12 col-sm-12 col-lg-7" style="padding: 0.4em 1.6em; background-color: rgba(255, 255, 255, 0);"><p>&nbsp;</p></div>
					<div class="col-md-5 col-xs-12 col-sm-12 col-lg-5">
						<span style="text-align: center; width: 100%; display: inline-block;">
							<img src="/public/assets/images/covid-19.png" style="width: auto;" class="text-center">
						</span>
					</div>
				</div>
				<div class="row" style="padding-top: 130px; padding-bottom: 130px;"></div>
			</div>
		</section>
		<section class="sec-padding of-head">
			<div class="container">
				<div class="row" style="margin:0;">
					<div class="col-md-4 col-lg-4 text-center">
						
							<i class="fa fa-heart custom_icon" aria-hidden="true"></i>
							<h4>Simple</h4>
							<p>A written contract fosters open communications and clear expectations which are key to ensuring the relationship with your share family and nanny goes smoothly. Unfortunately, most nanny contracts are filled with confusing legal jargon which many of us don’t understand.</p>
						
					</div>
					<div class="col-md-4 col-lg-4 text-center">
						
							<i class="fa fa-pen custom_icon" aria-hidden="true"></i>
							<h4>Up to Date</h4>
							<p>These days, it seems that federal, state and local laws are constantly changing. Our team is constantly monitoring changes to the law and updating our nanny share contract accordingly.</p>
						
					</div>
					<div class="col-md-4 col-lg-4 text-center">
						
							<i class="fa fa-briefcase custom_icon" aria-hidden="true"></i>
							<h4>Complete</h4>
							<p>While there are many free “nanny share contracts” available online, most <span style="text-decoration:underline;">do not</span> include important laws and regulations such as Paid Sick Leave, Paid Family and Medical Leave, and COVID-19 safety that are required in Washington. Will your household employee be employed in Seattle? This agreement has you covered. </p>
						
					</div>
				</div>
				<div class="row mt-5">
					<div class="col-md-4 col-lg-4 text-center">
						<div class="" style="padding: 65px 10%;">
							<h2 class="h2" style="font-size:44px;">$99.99</h2>
								<p class="mt-3 mb-4">
									<span v-if="isLoggedIn">
										<span v-for="userplans in userplan" :key="plans.id">
											<span v-if="userplans.product_id == plans.id">
												<button class="custom_yellow_btn" style="margin: 20px auto;" title="CLICK HERE FOR PACKAGES AND PRICING">Already Buy</button>
											</span>
											<span v-else class="w-100">
												<router-link :to="{name: 'register', 
														params: { 
															slug: plans.post_title_slug
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
													slug: plans.post_title_slug
												}
											}" 
											class="custom_yellow_btn" style="margin: 20px auto;" title="CLICK HERE FOR PACKAGES AND PRICING">
											PURCHASE
										</router-link>					
										<!-- <router-link to="/sign-up-chooser" class="button-primary button-black btn-signup" 
											style="margin: 20px auto;" title="CLICK HERE FOR PACKAGES AND PRICING">
											PURCHASE
										</router-link> -->
									</span>
								</p>
							<h6>
								<a style="color:#e58eb2;" title="Click here to see a sample" href="#sample">
									Click here to see a sample
								</a>
							</h6>
							<p>The agreement is FREE for families who have purchased an <router-link to="/sign-up-families-parents" style="color:#e58eb2;" title="Annual membership">Annual membership</router-link>. Log in and click the link at the bottom of the page to download.</p>
						</div>
					</div>
					<div class="col-md-4 col-lg-4 text-center" style="background-color: #e58eb2;color: #fff;padding: 20px;">
						
							<h4>Instructions</h4>
							<p>Step #1: Complete your purchase and download the document below. We have provided this to you in Microsoft® Word format so that you can edit any section of the agreement.</p>

							<p>Step #2: We have included placeholder text in red to show you what specific information you may want to include and instructional text in green.</p>

							<p>Step #3: When completed, print or email a copy to your care provider.</p>

							<p>You will have access to our nanny contract for six months in case you need to download another copy in the future.</p>

							<p>Questions? Email us at <a title="Mail Us On" href="mailto:info@nannyparentconnection.com" class="text-white">info@nannyparentconnection.com</a> or call/text (425) 243-7032.</p>
						
					</div>
					<div class="col-md-4 col-lg-4 text-center">						
							<p class="nitro-offscreen">While you are free to make any changes to this document that you like, we recommend that you <router-link to="/faq-guides" title="review the information in our library">review the information in our library</router-link>&nbsp; to ensure that you are not removing important clauses which may lead to problems in the future.&nbsp;</p>
							
							<p>Consult professional legal advice if you have any questions about this agreement or what information to include. We cannot provide legal advice or representation. Use of this document is subject to our <router-link to="/terms-of-use" title="Terms of Use">Terms of Use</router-link> and <router-link to="/privacy-policy" title="Privacy Policy">Privacy Policy</router-link></p>
						
					</div>
				</div>
				<div class="container-fluid">
					<div class="row mt-4 mb-5 text-center">
						<div class="col-md-12 col-xs-12 col-sm-12 col-lg-12">
							<iframe title="YouTube video player" src="https://www.youtube.com/embed/FN4gYYlIfVU" allowfullscreen="allowfullscreen" data-mce-fragment="1" width="640" height="360" frameborder="0"></iframe>
						</div>
					</div>
				</div>				
				<div class="row">
					<p style="text-align:center;">Below is a low resolution sample of the first three pages of the Nanny/Babysitter Contract:</p>
				</div>
				
				<div class="row text-center">
					<div class="col-md-12 col-lg-12 text-center" id="sample">
						<img src="/public/assets/images/instruction4.jpg" style="width: auto;" class="text-center"><br>
						<img src="/public/assets/images/instruction5.jpg" style="width: auto;" class="text-center"><br>
						<img src="/public/assets/images/instruction6.jpg" style="width: auto;" class="text-center">
					</div>
				</div>
			</div>
		</section>
		<!----------------- Popup-------------------->
        <div class="container">          
			<nannayShareContractModel></nannayShareContractModel>
        </div>
        <!--------------------------------->
	</main>
</template>

<script>
	import nannayShareContractModel from './AllModels/nannayShareContractModel.vue';
    export default {
        name:'nanny-share-contract',
		data() {
            return {
				isLoggedIn: false,
                plans: [],
				userplan: [],
				pageName : 'NannyShareContract'
				// pageTitle : 'Seattle Nanny Share Contract | Nanny Parent Connection',
                // pageMetaDescription : 'Legal contracts can be hard to understand. That’s why Nanny Parent Connection has created a simple nanny share contract to hire a nanny in Washington',
                // pageMetaKeywords : ''
            }
        },
		components: {        
			nannayShareContractModel
		},
		methods: {
			nannyShareContractPlan() {
                axios.get(`/api/NannyShareContract/plan`, {
                }).then((response) => { 
					this.plans = response.data.NannyShareContractPlan[0];
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
			this.nannyShareContractPlan();
		}
    }
</script>

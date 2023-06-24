<template>
<main>    
    <div class="container">
        <h1>Our Memberships Plans</h1>
        
        <div class="row"> 
            <div class="first-grid col-xs-12 col-sm-3 col-lg-3" style="padding-left: 0; padding-right: 0;">
				<div class="pricingTable pricingTable-2">
					<div class="pricingTable-header">
					<h3 class="title mob-title">&nbsp;</h3>
						<div class="ptsColDesc ptsToggle" style="background-color: transparent;"> 
							<div class="ptsEl"><span class="price" style="color: rgb(98, 98, 98); font-weight: 500;">Price</span>
							<span style="font-size:10pt;" data-mce-style="font-size: 10pt;">COMPARE MEMBERSHIP FEATURES</span></div> 
						</div>
			 			 
					</div>
					<ul class="pricing-content">
						<li><a href="#">Nanny/Nanny Share Contracts Included?</a></li>
						<li><a href="#" style="color: #000;">Personal Support Response Time</a></li>
						<li><a href="#">Access our Facebook Community</a></li>
						<li><a href="#">Discounted Background Checks</a></li>
						<li><a href="#">Last Minute Care Service</a></li>
						<li><a href="#">Verified Care Provider Service</a></li>
						<li><a href="#">CareCalendar</a></li>
						<li><a href="#">Member Feedback</a></li>
						<li><a href="#">Pay Calculator</a></li>
						<li><a href="#">Information Library</a></li>
						<li style="height: 72px;">Terms</li>
						<li>Reviews</li>
						<li class="mob-title">&nbsp;</li>
					</ul>
					<a href="#" class="btn btn-lg btn-price-bg">Start 7-day free trial</a>
				</div>
			</div><!-- END COL  -->	

			<div v-for="plan in plans" :key="plan.id" class="second-grid col-xs-12 col-sm-3 col-lg-3" style="padding-left: 0; padding-right: 0;">
				
				<div class="pricingTable pricingTable-First pricingTable-2">			
					<div class="pricingTable-header">
						<h3 class="title">{{plan.post_title}}</h3>
						<div class="ptsColDesc ptsToggle" style="padding-left: 0; padding-right: 0;"> 
							<div class="ptsEl">
								<span class="price" v-if="plan.mepr_product_period === 'day'">
									${{plan.mepr_product_price}}/daily
								</span>
								<span class="price" v-if="plan.mepr_product_period === 'week'">
									${{plan.mepr_product_price}}/Weekly
								</span>
								<span class="price" v-if="plan.mepr_product_period === 'month'">
									${{plan.mepr_product_price}}
								</span>								
								<span class="price" v-if="plan.mepr_product_period === 'monthly'">
									${{plan.mepr_product_price}}/month
								</span>
								<span class="price" v-if="plan.mepr_product_period === 'quarter'">
									${{plan.mepr_product_price}}/month
								</span>
								<span class="price" v-if="plan.mepr_product_period === 'semiannual'">
									${{plan.mepr_product_price}}/month
								</span>								
								<span class="price" v-if="plan.mepr_product_period === 'year'">
									${{plan.mepr_product_price/12}}/month
								</span>
							</div> 
						</div>
						<div class="ptsColBadgeContent" v-if="plan.mepr_product_period === 'year'" style="background-color:#ff000d;color:#fff;width:169px;display:block;font-size:15px;line-height:normal;position:absolute;top:25.052px;right:-26.8205px;">BEST DEAL!</div>
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
						<li> 
                            <router-link :to="{name: 'buy-plan', params: { slug: plan.post_title_slug }}" class="button-primary button-black btn-signup">SIGN UP</router-link>
                        </li> 
					</ul>					
				</div>
			</div><!-- END COL  -->
			 
			
		</div><!--END  ROW  -->
    </div>    
</main>
</template>

<script>    
    const axios = require('axios');
       export default {
        data() {
            return {
                plans: [],
            }
        },
        methods: {
            read() {
                axios.get('/api/plans').then(({ data }) => {
                    this.plans= data;
                })
                .catch((err) => console.error(err));
            }, 
        },
        mounted() {
            this.read();
        }
    } 
</script>

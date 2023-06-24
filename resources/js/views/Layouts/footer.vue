<template>
  <footer>
	<div class="container">
		<div class="row">
			<div class="col-md-12 col-lg-12">
				<aside class="widget_block widget well" id="block-11">
					<div class="textwidget footerArea">
						<p>
							<router-link to="/terms-of-use" rel="Terms of Use">Terms of Use</router-link>&nbsp;&nbsp;&nbsp;
							<router-link to="/privacy-policy" rel="Privacy Policy"> Privacy Policy</router-link>
						</p>
						<p>© 2017-2023 Nanny Parent Connection LLC</p><p>4730 University Way NE, Suite #104 | Seattle, WA 98105 | <span class="phone-number">(425) 243-7032&nbsp;</span> | <a href="mailto:info@nannyparentconnection.com">info@nannyparentconnection.com</a></p>
						<p style="font-size:12px;line-height: 20px;">Nanny Parent Connection LLC is an online platform for care providers, parents, and agencies to connect for child care related reasons. We do not employ care providers nor are we responsible or liable for the actions of any care provider, parent, or agency member in our community.</p>
					</div>
				</aside>
			</div>
		</div>		
	</div>	
	<a @click="scrollToTop()" class="backToTop animated bounce infinite"><i class="fa fa-arrow-up"></i></a>
</footer>
	
</template>
<style>
	.backToTop, .backToTop:hover{
		position: absolute;
		left: 95%;
		background: #e58eb2;
		padding: 10px;
		border-radius: 5px; 
		cursor: pointer;
		color:#fff;
	}
</style>
<script>
    export default {
        name:'FooterLayout',
		methods: { 
           scrollToTop() {
                 window.scrollTo({ top: 0, behavior: "smooth" });
           }
        }
    }
</script>
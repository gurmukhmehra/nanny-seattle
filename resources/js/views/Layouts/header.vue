<template>
	<header id="header" class="header">
	<div class="top-head">
			  <div class="container">
				 <div class="row pt-3">
					<div class="col-md-6 col-lg-6">
						<div class="site-branding"> 
							<p class="site-title mb-0">								
								<router-link to="/" rel="home"><span style="color:#f78da7;">N</span>anny Parent Connection</router-link>
							</p>
						</div> 
					</div>
					<div class="col-md-6 col-lg-6">
						<div id="menu-social" class="social-menu menu-social">
							<ul id="menu-social-items" class="menu-items list-inline">
								<li>
									<a title="Facebook" target="_blank" rel="noopener" href="https://www.facebook.com/nannyparentconnection"><i class="fab fa-facebook-f"></i><span class="sr-only">Facebook</span></a>
								</li>
								<li>
									<a title="Twitter" target="_blank" rel="noopener" href="https://twitter.com/nanny_parent">
									<i class="fab fa-twitter"></i><span class="sr-only">Twitter</span></a>
								</li>
								<li>
									<a title="Instagram" target="_blank" rel="noopener" href="https://www.instagram.com/nannyparentconnection/"><i class="fab fa-instagram"></i><span class="sr-only">Instagram</span></a>
								</li>
								<li>
									<a title="Youtube" target="_blank" rel="noopener" href="https://www.youtube.com/channel/UC-zbgG8btaYn9wnXn2OIs9Q"><i class="fab fa-youtube "></i><span class="sr-only">Youtube</span></a>
								</li>
								<span v-if="isLoggedIn" style="float: right;display: inline-flex;margin-left:10px;">
									<li>
										<router-link to="/UserDashboard" rel="login">Account</router-link>									
									</li>
									<li>
										<a style="cursor: pointer;margin-left: 10px;color:#fff;" @click="logout">Logout</a>										
									</li>
									<li>
										<router-link to="/nanny-pay-survey-2023-results" rel="nanny-pay-survey-2023-results" style="margin-left: 10px;background-color: #ff0000;padding: 2px 8px 2px 8px;border-radius: 6px;font-weight: bold;">2023 Pay Survey Results</router-link>									
									</li>
								</span>								
								<span v-else style="float: right;display: inline-flex;margin-left:10px;">
									<li>
										<router-link to="/offer" rel="login">Sign Up</router-link>
									</li>
									<li>
										<router-link to="/login" rel="login" style="margin-left: 10px;">Login</router-link>									
									</li>
									<li>
										<router-link to="/nanny-pay-survey-2023-results" rel="nanny-pay-survey-2023-results" style="margin-left: 10px;background-color: #ff0000;padding: 2px 8px 2px 8px;border-radius: 6px;font-weight: bold;">2023 Pay Survey Results</router-link>									
									</li>
								</span>
								
							</ul>
						</div>
					</div>
				 </div>
				 
				 <div class="row headerTopMob">
					<div class="col-md-12 col-lg-12">
						<nav class="navbar navbar-expand-lg">
							  <div class="container-fluid">							   
								<button class="navbar-toggler mobile_menus_icon" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
									<i class="fa-solid fa-bars"></i>
								</button>
								<div class="collapse navbar-collapse" id="navbarNavDropdown">
								  <ul class="navbar-nav">
									<li class="nav-item">
									  <!-- <a class="nav-link" aria-current="page" href="#"></a> -->
									    <router-link to="/offer" class="nav-link" aria-current="page">WHAT WE OFFER</router-link>
									</li>
									<li class="nav-item dropdown" id="myDropdown">
									  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
									   For Parents
									  </a>
									  <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink" style="background-color: #000;">
										<li><router-link to="/sign-up-families-parents" rel="home">Parents – Sign Up Here!</router-link></li>
										<li><router-link to="/offer-families-parents" class="dropdown-item">How To Find A Care Provider</router-link></li>
										<li><a class="dropdown-item" href="#">———</a></li>
										<li><router-link to="/background-checks" class="dropdown-item">Background Checks</router-link></li>
										<!-- <li><a class="dropdown-item" href="#">CareCalendar</a></li> -->
										<li><router-link to="/last-minute-group-text" class="dropdown-item">Last Minute Care</router-link></li>
										<li><router-link to="/faq-guides" class="dropdown-item">Library</router-link></li>
										<li><a href="help#scroll180194" class="dropdown-item">Member Feedback</a></li>
										<li><router-link to="/member-search" v-on:click="providerList()" class="dropdown-item">Member Search</router-link></li>
										<li><a class="dropdown-item" href="#">NANNY CONTRACTS &nbsp; &nbsp; &nbsp; &nbsp;<i class="fa fa-caret-right"></i></a>
											<ul class="submenu dropdown-menu" style="background-color: #000;">
												<li><router-link to="/nanny-contract" class="dropdown-item">Nanny/Babysitter Contract</router-link></li>
												<li><router-link to="/nanny-share-contract" class="dropdown-item">Nanny Share Contract</router-link></li>
											</ul>
										</li>
										<li><a class="dropdown-item" href="#">PAYING YOUR NANNY &nbsp; &nbsp; &nbsp;<i class="fa fa-caret-right"></i></a>
											<ul class="submenu dropdown-menu" style="background-color: #000;">
												<li><router-link to="/pay-rate-worksheet" class="dropdown-item">How Much To Pay?</router-link></li>												
												<li><router-link to="/payroll-service" class="dropdown-item">Payroll Service</router-link></li>
												<li><router-link to="/pay-calculator" class="dropdown-item">Paycheck Calculator</router-link></li>
											</ul>
										</li>
										<li><router-link to="/verified-care-providers" class="dropdown-item">Verified Care Providers</router-link></li>
									  </ul>
									</li>
									
									<li class="nav-item dropdown" id="myDropdown">
									  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
									   FOR CARE PROVIDERS
									  </a>
									  <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink" style="background-color: #000;">
										<li><router-link to="/sign-care-provider" class="dropdown-item">Providers – Sign Up Here!</router-link></li>
										<li><router-link to="/offer-care-providers" class="dropdown-item">How To Find A Family</router-link></li>
										<li><router-link to="/care-providers-jobs" class="dropdown-item">Browse Current Jobs – NEW!</router-link></li>
										<li><a class="dropdown-item" href="#">----</a></li>
										<li><router-link to="/background-checks" class="dropdown-item">Background Checks</router-link></li>
										<!-- <li><a class="dropdown-item" href="#">CareCalendar</a></li> -->
										<li><router-link to="/verified-care-providers" class="dropdown-item">Get Verified!</router-link></li>
										<li><router-link to="/last-minute-group-text" class="dropdown-item">Last MInute Care Service</router-link></li>
										<li><router-link to="/faq-guides" class="dropdown-item">Library</router-link></li>
										<li><a href="help#scroll180194" class="dropdown-item">Member Feedback</a></li>										
										<li><router-link to="/member-search" class="dropdown-item">Member Search</router-link></li>
										<li><a class="dropdown-item" href="#">Nanny Contracts  &nbsp; &nbsp; <i class="fa fa-caret-right"></i></a>
											<ul class="submenu dropdown-menu" style="background-color: #000;">
												<li><router-link to="/nanny-contract" class="dropdown-item">Nanny/Babysitter Contract</router-link></li>
												<li><router-link to="/nanny-share-contract" class="dropdown-item">Nanny Share Contract</router-link></li>
											</ul>
										</li>
										<li><router-link to="/pay-calculator" class="dropdown-item">Paycheck Calculator</router-link></li>
									  </ul>
									 </li>
									 <li class="nav-item dropdown" id="myDropdown">
									  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
									 For Agencies 
									  </a>
									  <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink" style="background-color: #000;">
										<li><router-link to="/sign-up-agencies" class="dropdown-item">Agencies – Sign Up Here!</router-link></li>
										<li><router-link to="/sign-up-agencies" class="dropdown-item">What We Offer Agencies</router-link></li>
										<li><a class="dropdown-item" href="#">———</a></li>
										<li><router-link to="/background-checks" class="dropdown-item">Background Checks</router-link></li>
										<!-- <li><a class="dropdown-item" href="#">CareCalendar</a></li> -->
										<li><router-link to="/last-minute-group-text" class="dropdown-item">Last Minute Care</router-link></li>
										<li><router-link to="/faq-guides" class="dropdown-item">Library</router-link></li>
										<li><a href="help#scroll180194" class="dropdown-item">Member Feedback</a></li>
										<li><router-link to="/member-search" v-on:click="providerList()" class="dropdown-item">Member Search</router-link></li>
										<li><router-link to="/pay-calculator" class="dropdown-item">Pay Calculator</router-link></li>
										<li><router-link to="/verified-care-providers" class="dropdown-item">Verified Care Providers</router-link></li>
									  </ul>
									 </li>
									 <li class="nav-item">
									  <router-link to="/sign-up-chooser" class="nav-link" aria-current="page">Pricing</router-link>
									</li>
									<li class="nav-item dropdown">
									  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
										Blog
									  </a>
									  <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink" style="background-color: #000;">
										<li><a class="dropdown-item" href="https://blog.nannyparentconnection.com/blog/">All Posts</a></li>
										<li><a class="dropdown-item" href="https://blog.nannyparentconnection.com/category/memberdiscounts/">Member Discounts</a></li>
										<li><a class="dropdown-item" href="https://blog.nannyparentconnection.com/category/payrates/">Pay Rates</a></li>
									  </ul>
									</li>
									<li class="nav-item dropdown" id="myDropdown">
									  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
									 More...
									  </a>
									  <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink" style="background-color: #000;">
										<!-- <li><a class="dropdown-item" href="#">About</a>
											<ul class="submenu dropdown-menu" style="background-color: #000;">
												<li><router-link to="/about-us" class="dropdown-item">About us</router-link></li>
												<li><router-link to="/contact-us" class="dropdown-item">Contact</router-link></li>
											</ul>
										</li> -->
										<!-- <li><a class="dropdown-item" href="#">REWARDS</a>
											<ul class="submenu dropdown-menu" style="background-color: #000;">
												<li><router-link to="/rewards-overview" class="dropdown-item">Rewards Overview</router-link></li>
												<li><router-link to="/rewards-signup" class="dropdown-item" target="_blank">Rewards Signup</router-link></li>
												<li><router-link to="/rewards-login" class="dropdown-item" target="_blank">Rewards Login</router-link></li>
												<li><a class="dropdown-item" href="https://rewards.nannyparentconnection.com/rewards-dashboard/" target="_blank">Rewards Dashboard</a></li>
												<li><a href="https://rewards.nannyparentconnection.com/rewards-signup/" class="dropdown-item" target="_blank">Rewards Signup</a></li>
												<li><a href="https://rewards.nannyparentconnection.com/rewards-login/" class="dropdown-item" target="_blank">Rewards Login</a></li>
											</ul>
										</li> -->
										<li><router-link to="/about-us" class="dropdown-item">About us</router-link></li>
										<li><router-link to="/contact-us" class="dropdown-item">Contact</router-link></li>
										<li><router-link to="/help" class="dropdown-item">Help</router-link></li>
									  </ul>
									 </li>
								  </ul>
								</div>
							  </div>
						</nav>
					</div>
				 </div>
			</div>
	</div>
</header><!-- #header -->
</template>
<script>
    export default {
       name:'HeaderLayout',
	   data() {
			return {
				isLoggedIn: false,
			}
		},
		created() {
			if (window.Laravel.isLoggedin) {
				this.isLoggedIn = true
			}
		},
		methods: {
        logout(e) {
            //console.log('ss')
            e.preventDefault()
            this.$axios.get('/sanctum/csrf-cookie').then(response => {
                this.$axios.post('/api/logout')
                    .then(response => {
                        if (response.data.success) {
                            window.location.href = "/"
                        } else {
                        //console.log(response)
                        }
                    })
                    .catch(function (error) {
                        console.error(error);
                    });
            })
        },
		providerList(){
			axios.get('/api/careProviders/list/').then((response) => {
                //console.log(response.data.providers);
                this.getProviders = response.data.getProviders;
                this.careProviders= response.data.providers;
				this.ProvidersBiosDetals=response.data.ProvidersBios;
                this.error= response.data.error;                    
            }).catch((err) => console.error(err));
		}
    },
    }
</script>
<style>
.site-title {
	font-family: "Julius Sans One",Helvetica,Arial,sans-serif !important;
	font-size: 35px !important;
	text-transform: uppercase;
	line-height: 150%;
	letter-spacing: 3px;
}
.site-title a:hover {
  color: #fff;
}
</style>

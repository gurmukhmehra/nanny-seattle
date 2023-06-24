<template>
	<main>
		<MemberBuyMembershipPoup/>
		<section class="of-head">
			<div class="container">
				<div class="row pt-3">
					<div class="col-md-12 col-xs-12 col-sm-12 col-lg-12">
						<h5 class="text-center">Questions? We are here to help!</h5>
						<h3 style="text-align: center;"><a title="Call Us On" href="tel:(425) 243-7032">(425) 243-7032</a></h3>
						<p class="text-center">Speak with a real person. Call or text our expert team today!</p>			
					</div>			
				</div>
			</div>
		</section>
		<section class="sec-padding" style="background-color: #e58eb2;padding-top: 20px;">
			<div class="container">
				<div class="row">
					<div class="col-md-12 col-lg-12">
						<p style="text-align:center;margin-bottom: 0px;"><em>America’s most complete household employee background checks…</em></p>
						<h5 class="text-center" style="color: #ffffff;font-size: 24px; margin-top: 7px; margin-bottom: 0px; padding-bottom: 0em; line-height: 1.3em; padding-top: 0.4em;">Keep Your Family Safe With An Affordable Background Check For Your Nanny, Babysitter, Household Employee or Community Volunteer</h5>
						<h5 class="text-center" style="color: #ffffff;font-size: 24px; margin-top: 7px; margin-bottom: 0px; padding-bottom: 0.4em; line-height: 1.3em; padding-top: 0.4em;">Most Background Check Reports Delivered In <span style="text-decoration: underline;">Two Days Or</span> Less!</h5>
						<p class="text-center">With access to over ONE BILLION individual records covering almost every offense in the USA, our background check system will scan all available records and alert you to any potential hits. Contact our team and we can help you choose the right background check and even understand the results! <span style="font-weight: 600;">Plus, with our Vetted Candidate Guarantee*, you’re sure to get an employee who has a clean criminal background check.</span></p>
					</div>
				</div>
				<div class="row mt-4">
					<div class="col-md-8 col-lg-8" style="margin: 0 auto 20px;">
						<img data-toggle="modal" v-on:click="playYoutubeVideo" data-target="#myModal" style="cursor: pointer;" src="public/assets/images/video-tag.png">
					</div>
					<!-- The Modal -->
					<div class="modal zoomIn" id="myModal" data-backdrop="static" data-keyboard="false">
						<div class="modal-dialog modal-dialog-centered">
							<div class="modal-content">
								<div class="modal-body">
									<button type="button" v-on:click="stopYoutubeVideo" class="close custom_close_btn" data-dismiss="modal">&times;</button>
									<iframe class="youtube-video" width="560" height="315" src="https://www.youtube.com/embed/j5uswDU9BwE?enablejsapi=1&version=3&playerapiid=ytplayer&controls=0" frameborder="0" allowfullscreen></iframe>
									<div class="d-flex youtube_control_bar">
										<a class="play-video" v-on:click="playYoutubeVideo" title="play" v-if="showPlayBtn"><i class="fa fa-play"></i></a>
										<a class="pause-video" v-on:click="pauseYoutubeVideo" title="stop" v-if="showStopBtn"><i class="fa fa-pause"></i></a>
									</div>
								</div>     
							</div>
						</div>
					</div>
					<!-- The Modal -->
					<div class="col-md-8 col-lg-4" style="margin: 0 auto;">
						<div class="bg-box-white">
							<h2 class="sec-heading text-center" style="color: #333; font-size: 25px; line-height: 32px;">Order a Fast, Easy, and Affordable Background Check Today!</h2>
							<span style="text-align: center;width: 100%;display: inline-block;"><img src="public/assets/images/icon-download.JPG"></span>
							<span style="text-align: center;width: 100%;display: inline-block;">
							<p class="mt-5">
								<a href="/background-checks#pricing" class="custom_yellow_btn" title="GET MY BACKGROUND CHECK NOW" style="padding: 10px 8px 10px 8px;">GET MY BACKGROUND CHECK NOW</a>
							</p>
							</span>
						</div>
					</div>
				</div>
			</div>
		</section>
	<section class="sec-padding" style="padding-bottom: 30px;">
		<div class="container">
			<div class="row">
				<div class="col-md-12 col-lg-12">
					<h3 class="text-center text-dark">What Our Customers Say</h3>
				</div>
			</div>				
			<div class="row" style="margin-top: 20px;">
				<div class="col-md-4 col-lg-4 text-center">
					<div class="bio-des-back">
						<img src="public/assets/images/MADDY-b.JPG">
						<div class="bio-text text-dark">
							“My husband and I had been using one of the big name sites for our nanny background checks. We just ordered the Premium Plus check on one of our babysitters through Nanny Parent Connection. The report came back in less than 24 hours, was easy to understand, and was $40.00 cheaper!”
								<h5 style="text-align:center; padding-top: 0.8em;margin: 0;"><span class="text-dark"><strong>MADDY B.</strong></span></h5>
						</div>
						
					</div>
				</div>
				<div class="col-md-4 col-lg-4 text-center">
					<div class="bio-des-back">
						<img src="public/assets/images/MIKAEL-r.JPG">
						<div class="bio-text text-dark">
							“Don’t waste your time spending hours researching background check companies on the Internet like I did. Nanny Parent Connection has the most AFFORDABLE and COMPLETE nanny background checks. Plus they will walk you through the results and answer any questions you might have!”
							<h5 style="text-align:center; padding-top: 0.8em;margin: 0;"><span class="text-dark"><strong>MIKAEL R.</strong></span></h5>
						</div>
					</div>
				</div>
				<div class="col-md-4 col-lg-4 text-center">
					<div class="bio-des-back">
						<img src="public/assets/images/CHRISTINA.JPG">
						<div class="bio-text text-dark">
							“If there is any way I can express my gratitude to your company, please let me know. I honestly don’t think you understand how beneficial your services are in ensuring that families are safe in who they invite into their home. You have been so helpful, and really gone above and beyond to support us. I can’t thank you enough.”
							<h5 style="text-align:center; padding-top: 0.8em;margin: 0;"><span class="text-dark"><strong>CHRISTINA R.</strong></span></h5>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<div class="container">
		<div class="row text-center" style="margin-bottom: 30px;">
			<p>
				<a href="/background-checks#pricing" class="custom_yellow_btn" title="">SEE PRICING</a>
			</p>
		</div>
	</div>	
	<section class="sec-padding" style="padding-top: 0px;">
		<div class="container">
		<div class="guarantee-paper" id="guarantee">
			<div class="row">
						<div class="col-md-12 col-lg-12">
							<h2 class="sec-heading text-center">Vetted Candidate Guarantee</h2>
							<p class="text-center">If the background check report comes back and your candidate has been<br> convicted of a felony*, we will run your next background check for FREE!</p>
						</div>
			</div>
			<div class="row">
					<div class="col-md-6 col-lg-5 text-center">
						<img src="/public/assets/images/vetted.JPG">
					</div>
					<div class="col-md-6 col-lg-7 text-center">
						<p>Let’s face it. One of the most frustrating experiences is to spend hours interviewing a candidate, checking their references, verifying their credentials and discussing your goals only to find out that they don’t have a clear background check (we’ve been there!)</p>
						<p>While we can’t make any promises that your candidate will have a clear background check report, we can make the hiring process a bit less expensive for you. Order a background check from us today and if the report comes back and your candidate has been convicted of a felony*, we will pay for your next background check! That’s right…your next background check is on us!</p>
						<p class="mt-4">
							<a href="/background-checks#pricing" class="custom_yellow_btn" title="GET MY BACKGROUND CHECK NOW" style="margin: 20px 0 0;border-radius: 200px;">GET MY BACKGROUND CHECK NOW</a>
						</p>
					<p class="mt-4" style="font-size: 11px;font-style: italic;">Terms and conditions apply. For more information, <router-link to="/terms-of-use" rel="Privacy Policy"> please click here</router-link>.</p>
					</div>
				</div>
			</div>
		</div>
	</section>
	<section class="sec-padding bio-sec" style="background-color: #1f2a30;">
			<div class="container">
					 <div class="row">
						<div class="col-md-12 col-lg-12">
							<h2 class="sec-heading text-center">The Difference</h2>
							<p style="text-align:center; color: #ffffff;">There are many background check options available to you. This is what separates us from the rest.</p>
						</div>
					 </div>
					 
					 <div class="row" style="margin-top: 20px;">
						<div class="col-md-4 col-lg-4">
							<div class="diff-text">
								<span class="text-center"><i class="fa fa-user-secret" style="font-size:80px;color:#fff;" aria-hidden="true"></i></span>
								<div class="bio-text">
									<h3>No Hidden Fees</h3>
									Look closely at some of our competitors’ packages. They charge you a package fee (just like we do) but then hit you with court access and DMV fees. We don’t do that. Unless your background check includes New York courts, the price you see is the price you pay.
								</div>
								
							</div>
						</div>
						<div class="col-md-4 col-lg-4">
							<div class="diff-text">
								<i class="fa color3-color fa-folder-open" style="font-size:80px;color:#fff;" aria-hidden="true"></i>
								<div class="bio-text">
									<h3>More Records</h3>
									While others make a big deal that they search 100, 200, or even 300 million records, through our partnership with Sterling, we can search nearly ONE BILLION records for you. This allows for a more complete search and peace of mind for you and your family.
								</div>
							</div>
						</div>
						<div class="col-md-4 col-lg-4">
							<div class="diff-text">
								<i class="fa fa-users" style="font-size:80px;color:#fff;" aria-hidden="true"></i>
								<div class="bio-text">
									<h3>Dedicated Support</h3>
									Does your candidate have questions or needs help authorizing the background check to run? Our Candidate Care Team is standing by to support your candidate. Once your background check completes, our Customer Care Team is available 365/7 to answer any questions you have about the results.
								</div>
							</div>
						</div>
						
					 </div>
			 </div>
		</section>
	<section id="pricing" class="our_pricing section-padding sec-padding" style="padding-bottom: 0px;">
		<div class="container">
			<div class="row">
				<div class="col-md-12 col-lg-12">
					<p class="text-center">
						<iframe loading="lazy" title="YouTube video player" src="https://www.youtube.com/embed/Y8c9zVA1O-M" allowfullscreen="allowfullscreen" data-mce-fragment="1" width="640" height="360" frameborder="0"></iframe>
					</p>
					<p id="packages" style="text-align: center; margin-top: 30px;margin-bottom: 5px;">
						Choose your background check package below and click PURCHASE.
					</p>
					<p style="text-align: center; margin-bottom: 5px;">
						No membership required to purchase a background check. Members receive 
						<router-link to="/sign-up-chooser" title="Click here to get started">
						discounted pricing on all background check orders</router-link>.
					</p>				
					<p style="line-height:1.5em;text-align:center;margin-bottom: 5px;">For more information and to view our FAQ, scroll further down the page.</p>		
				</div>
			</div>
			<div class="row">
				<div class="first-grid col-xs-12 col-sm-3 col-lg-3" style="padding-left: 0; padding-right: 0;">
					<div class="pricingTable pricingTable-2">
						<div class="pricingTable-header">
						<h3 class="title mob-title">&nbsp;</h3>
							<div class="ptsColDesc ptsToggle" style="background-color: transparent;padding: 30px 10px;"> 
								<div class="ptsEl"><span class="price" style="color: rgb(98, 98, 98); font-weight: 500;">Packages</span>
								<p style="font-size:15px;" data-mce-style="font-size:15px;">Click any feature below for more information</p></div> 
							</div>
							
						</div>
						<ul class="pricing-content">
							<li><a href="/background-checks#guarantee" style="color: #000;">Vetted Candidate Guarantee*</a></li>
							<li><a href="/background-checks#sstrace" style="color: #000;">Social Security # Trace</a></li>
							<li><a href="/background-checks#criminal" style="color: #000;">Enhanced Nationwide Criminal Database Search</a></li>
							<li><a href="/background-checks#sexoffendersearch" style="color: #000;">Department of Justice (DOJ) National Sex Offender Search</a></li>
							<li><a href="/background-checks#misdemeanorsandfelonies" style="color: #000;">Extended Global Sanctions Search</a></li>
							<li><a href="/background-checks#drivingreport" style="color: #000;">Motor Vehicles Record (MVR) Search</a></li>
							<li><a href="/background-checks#countrycriminalrecordscurrent" style="color: #000;">County Criminal Records - CURRENT County of Residence (7 Year Historical Search)</a></li>
							<li><a href="/background-checks#allcounties" style="color: #000;">County Criminal Records - ALL Counties of Residence (7 Year Historical Search)</a></li>
							<li style="color: #000;">Customer Reviews</li>
						</ul>
						<!--a href="#" class="btn btn-lg btn-price-bg">Start 7-day free trial</a-->
					</div>
				</div><!-- END COL  -->		
				<div class="second-grid col-xs-12 col-sm-3 col-lg-3" style="padding-left: 0; padding-right: 0;">
					<div class="pricingTable pricingTable-First pricingTable-2">
						<div class="pricingTable-header">
							<h3 class="title">Premium Plus</h3>
							<div class="ptsColDesc ptsToggle" style="padding: 30px 10px;"> 
								<div class="ptsEl"><span class="price">$79.99</span>
									<span class="cut_price" style="color:#fff;text-decoration:none;font-size: 14px;">MEMBER PRICE:$69.99 (13% off)</span>
								</div> 
							</div>
						</div>
						<ul class="pricing-content">
							<li><i class="fa fa-check"></i></li>
							<li><i class="fa fa-check"></i></li>
							<li><i class="fa fa-check"></i></li>
							<li><i class="fa fa-check"></i></li>
							<li><i class="fa fa-check"></i></li>
							<li><i class="fa fa-check"></i></li>
							<li><i class="fa fa-check"></i></li>
							<li><i class="fa fa-check"></i></li>
							<li>923 Reviews
							   <div class="star-rev">
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
							   </div>
							</li>
							<li v-if="isLoggedIn">
								<a v-if="userplan.length>0" class="custom_yellow_btn" target="_blank" href="https://orderbackgroundcheck.nannyparentconnection.com/premium-plus-member-background-check/">PURCHASE </a>
								<a v-else class="custom_yellow_btn" target="_blank" href="https://orderbackgroundcheck.nannyparentconnection.com/premium-plus-background-check/">PURCHASE </a>
							</li>
							<li v-else>
								<a class="custom_yellow_btn" target="_blank" href="https://orderbackgroundcheck.nannyparentconnection.com/premium-plus-background-check/">PURCHASE</a>
							</li>
						</ul>
						
					</div>
				</div><!-- END COL  -->
				<div class="third-grid col-xs-12 col-sm-3 col-lg-3" style="padding-left: 0; padding-right: 0;">
					<div class="pricingTable pricingTable-Third pricingTable-3">
						<div class="pricingTable-header">
							<h3 class="title">Premium </h3>
							<div class="ptsColDesc ptsToggle" style="background-color: rgba(110,159,126,1);padding: 30px 10px;"> 
								<div class="ptsEl"><span class="price">$49.99</span><span class="cut_price" style="color:#fff;text-decoration:none;font-size: 14px;">MEMBER PRICE:$44.99 (10% off)</span></div> 
							</div>		
						</div>
						<ul class="pricing-content">
							<li><i class="fa fa-check"></i></li>
							<li><i class="fa fa-check"></i></li>
							<li><i class="fa fa-check"></i></li>
							<li><i class="fa fa-check"></i></li>
							<li><i class="fa fa-check"></i></li>
							<li><i class="fa fa-check"></i></li>
							<li><i class="fa fa-square-o"></i></li>
							<li><i class="fa fa-square-o"></i></li>
							<li>1,021 Reviews
							   <div class="star-rev">
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
							   </div>
							</li>
							<li v-if="isLoggedIn">
								<a v-if="userplan.length>0" class="custom_yellow_btn" target="_blank" href="https://orderbackgroundcheck.nannyparentconnection.com/premium-member-background-check/">PURCHASE </a>
								<a v-else class="custom_yellow_btn" target="_blank" href="https://orderbackgroundcheck.nannyparentconnection.com/premium-background-check/">PURCHASE </a>
							</li>
							<li v-else>
								<a class="custom_yellow_btn" target="_blank" href="https://orderbackgroundcheck.nannyparentconnection.com/premium-background-check/">PURCHASE</a>
							</li>
						</ul>
					</div>
				</div><!-- END COL  -->
				<div class="fourth-grid col-xs-12 col-sm-3 col-lg-3" style="padding-left: 0; padding-right: 0;">
					<div class="pricingTable pricingTable-Fourth pricingTable-2">
						<div class="pricingTable-header">
							<h3 class="title">Standard</h3>
							<div class="ptsColDesc ptsToggle" style="background-color: rgba(129,160,161,1);padding: 30px 10px;"> 
								<div class="ptsEl"><span class="price">$22.99</span><span class="cut_price" style="color:#fff;text-decoration:none;font-size: 14px;">MEMBER PRICE:$18.99 (17% off)</span></div> 
							</div>		
						</div>
						<ul class="pricing-content">
							<li><i class="fa fa-check"></i></li>
							<li><i class="fa fa-check"></i></li>
							<li><i class="fa fa-check"></i></li>
							<li><i class="fa fa-check"></i></li>
							<li><i class="fa fa-square-o"></i></li>
							<li><i class="fa fa-square-o"></i></li>
							<li><i class="fa fa-square-o"></i></li>
							<li><i class="fa fa-square-o"></i></li>
							<li>758 Reviews
							   <div class="star-rev">
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
							   </div>
							</li>
							<li v-if="isLoggedIn">
								<a v-if="userplan.length>0" class="custom_yellow_btn" target="_blank" href="https://orderbackgroundcheck.nannyparentconnection.com/standard-member-background-check">PURCHASE </a>
								<a v-else class="custom_yellow_btn" target="_blank" href="https://orderbackgroundcheck.nannyparentconnection.com/standard-background-check/">PURCHASE </a>
							</li>
							<li v-else>
								<a class="custom_yellow_btn" target="_blank" href="https://orderbackgroundcheck.nannyparentconnection.com/standard-background-check/">PURCHASE</a>
							</li>
						</ul>
					</div>
				</div><!-- END COL  -->
			</div><!--END  ROW  -->
			
			<div class="row" style="padding-top:15px;padding-bottom:16px;">
				<div class="col-md-12 col-xs-12 col-sm-12 col-lg-12">
					<p style="text-align:center;padding-top:1em;"><em>Note: New York OCA searches are an additional $100.00. Terms and conditions apply for our Vetted Candidate Guarantee. <router-link to="/terms-of-use" rel="Terms of Use">Click here</router-link> for more information.<br></em></p>
				</div>
			</div>
			
		</div><!-- END CONTAINER  -->
	</section>
	<section class="sec-padding bio-sec" style="padding: 10px 0px;">
			<div class="container"> 
					 <div class="row">
						<div class="col-md-4 col-lg-4">
							<div class="diff-text">
								<img src="/public/assets/images/iso.png">
								<div class="bio-text" style="font-size: 20px;">
									We invested over 100 hours researching and evaluating the numerous background check processors that operate in the United States before deciding who to work with. At the end of the day, the choice was clear.
								</div>
								
							</div>
						</div>
						<div class="col-md-4 col-lg-4">
							<div class="diff-text">
								<img src="/public/assets/images/napbs.png">
								<div class="bio-text" style="font-size: 20px;">
									Sterling is an industry leader with over 20 years of employment screening experience, a strong focus on information security, and a top notch customer care team. Every year, they process nearly 100 million background checks! 
								</div>
							</div>
						</div>
						<div class="col-md-4 col-lg-4">
							<div class="diff-text">
								<img src="/public/assets/images/iso2015.png">
								<div class="bio-text" style="font-size: 20px;">
									We’ve worked with Sterling to create three packages specifically for families and agencies hiring child care providers, tutors, and other household employees. To learn more about Sterling, <a title="visit their website" href="https://www.sterlingcheck.com/" target="_blank" rel="noopener noreferrer nofollow">visit their website</a> or scroll up to learn more about our background check packages and pricing.
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
							<h3 id="backgroundcheckfaq" style="padding-bottom: 0.9em; text-align: center;">Frequently Asked Questions</h3>	
						</div>
					</div>
					<div class="row">
					<div class="col-md-12 col-lg-12">
						<div class="row">
							<h6><strong>’ve never ran a background check before and am feeling totally lost. Help!</strong></h6>
							<p>We’ve all been there! Take a moment to check out <a href="https://blog.nannyparentconnection.com/dont-skip-background-check/">this excellent article</a> on how background checks work and why you should ALWAYS run a background check on potential nannies, sitters, and au pairs.</p>
						</div>
						<div class="row">
							<h6><strong>How does the background check system work?</strong></h6>
							<p>We specifically designed this system so that you can order a background check in less than five minutes. All we need from you is the candidate’s name and email address. Once the background check order is placed, Sterling (our background check processor) emails your candidate to begin the authorization process. Most candidates complete the authorization in a few minutes. The background check process then begins and results will be emailed to you usually within <span style="text-decoration: underline;">one to three days if no hits are found</span>. No additional work needed from you and the system is available 24 hours/day, 365 days/year.</p>
						</div>
						<div class="row">
							<h6><strong>Do I need to purchase a membership in order to use the background check system?</strong></h6>
							<p>No. You don’t need to purchase a membership although we do offer discounted pricing on all of our background checks if you have an active <router-link to="/sign-up-families-parents" rel="">Family/Parent</router-link>, Care Provider, or <router-link to="/sign-up-agencies" rel="">Agency</router-link> membership.</p>
						</div>
						<div class="row">
							<h6><strong>What specific information about my candidate do I need to have ready before ordering the background check?</strong></h6>
							<p>The only information that we need from you is your candidate’s first name, last name and email address. Our system takes care of collecting the rest of the required information (address, Social Security number or tax id number, etc.) from the candidate during the authorization process. Our goal is for the nanny background check ordering process to take five minutes or less!</p>
						</div>
						<div class="row">
							<h6><strong>My candidate doesn’t have a Social Security number. Can I still use your background check system?</strong></h6>
							<p>Yes! As long as your candidate has a tax id number or <a href="https://www.irs.gov/individuals/individual-taxpayer-identification-number" target="_blank">ITIN</a>, our system can process the order.</p>
						</div>
						<div class="row">
							<h6><strong>I see two different prices for the package I am interested in. Can you explain the difference?</strong></h6>
							<p>Sure. We offer our registered members a discount on background checks. If you are not a registered member, the price for each package is the top number. If you are a member, you will pay the discounted price at the bottom for that specific nanny background check. Interested in becoming a member? We would love to have you! <router-link to="/sign-up-chooser">Learn more and sign up here.</router-link></p>
						</div>
						<div class="row">
							<h6><strong>Besides the price for the background check package I select, are there any other fees that I need to be aware of?</strong></h6>
							<p>For most customers, no. The price you see is the price you pay. If your candidate currently lives in New York or has lived there in the past seven years, a New York Statewide Criminal History (or OCA Search) may be triggered. There is an additional fee for New York OCA searches of $100.00. This is a fee charged by the New York OCA, not Nanny Parent Connection.</p>
						</div>
						<div class="row">
							<h6><strong>I would like to purchase a background check on someone who is not going to work as my nanny, babysitter or tutor. Is that okay?</strong></h6>
							<p>No problem! Our system works for all candidates no matter their occupation or location. We have customers that use our system to run background checks on coaches, church volunteers/employees, elder care workers, school volunteers, etc. Make sure you understand the Fair Credit Reporting Act (FCRA) laws and regulations regarding employment background checks conducted by a third party. <a title="You can find that information here" href="https://www.sterlingcheck.com/resources/compliance-updates/" rel="noopener noreferrer nofollow" target="_blank">You can find that information here</a>.</p>
						</div>
						<div class="row">
							<h6><strong>Can you explain in more detail what the various package features are?</strong></h6>
							<p id="sstrace" style="text-decoration:underline;">Social Security # Trace</p>
							<p>The crucial first step for identifying residential history, aliases, and other key data points in order to complete the most extensive and thorough certified background check. Not all SSN traces are the same. Using Sterling’s cutting edge resources, we are able to identify the most complex data points while eliminating erroneous and costly information found in other’s trace products. The trace identifies residential history, aliases, and other key data points in order to complete our background checks. <strong><a title="Click here to order your background check" href="background-checks#pricing">Click here to order your background check.</a></strong></p>
							<p id="criminal" style="text-decoration:underline;">Enhanced Nationwide Criminal Database Search</p>
							<p>The National Criminal Record Database Search (NCRD) searches nearly&nbsp;<span style="text-decoration:underline;"><strong>one billion&nbsp;offense records</strong></span> in this instant, 50-state, multi-jurisdictional search. The database is a compilation of criminal records, information from municipal, circuit, district and superior court repositories, as well as the Department of Corrections, the FBI, U.S. Marshal, U.S. Customs, the DEA, Secret Service and the Department of Justice. Also included in this search are healthcare and financial sanctions, terrorist watch lists, and OFAC (Office of Foreign Asset Control). <strong>The NCRD search <span style="text-decoration:underline;">does not</span> include county criminal records.<a title="Click here to order your background check" href="background-checks#pricing"> Click here to order your household employee background check.</a></strong></p>
							
							<p id="sexoffendersearch" style="text-decoration:underline;">Department of Justice (DOJ) National Sex Offender Search</p>
							<p>There are currently hundreds of thousands of registered sex offenders nationwide. Under the legislation of Megan’s Law, sexual offenders are required to register when they change their residence. Sterling’s multi-state database is a collection of stored data from multiple state registries. All potential records found from this search are automatically confirmed from the actual source to ensure accuracy and completeness to meet FCRA reporting compliance. <strong><a title="Click here to order your background check" href="background-checks#pricing">Click here to order your nanny background check.</a></strong></p>
							<p><span style="text-decoration:underline;">National Sex Offender Search (included with NCRD)<br></span></p>
							<p>There are currently hundreds of thousands of registered sex offenders nationwide. Under the legislation of Megan’s Law, sexual offenders are required to register when they change their residence.&nbsp;Sterling multi-state database is a collection of stored data from multiple state registries. All potential records found from this search are automatically confirmed from the actual source to ensure accuracy and completeness to ensure FCRA reporting compliance. <strong><a title="Click here to order your background check" href="background-checks#pricing">Click here to order your nanny background check.</a></strong></p>
							<p id="countrycriminalrecordscurrent" style="text-decoration:underline;">Criminal Records – Current County (7 Year Historical Search)</p>
							<p>County Criminal Records Searches are the gold standard for any complete nanny background check. Sterling’s County Criminal Record Searches check records at both the misdemeanor and felony levels for the county that your care provider candidate currently resides in. This search is the most in-depth way to get accurate and timely results. Sterling has a vast team of records professionals who conduct in-person searches at courthouses in all US jurisdictions, including territories. This search helps look beyond a candidate’s residential history. With just a name and date of birth, investigators are able to locate offenses across the country. The Sterling team makes sure the information you receive is confirmed and reported in full compliance of FCRA. <strong><a title="Click here to order your background check" href="background-checks#pricing">Click here to order your background check.</a></strong></p>
							<p id="allcounties" style="text-decoration:underline;">Criminal Records – All Counties of Residence (7 Year Historical Search)</p>
							<p>Virtually identical to the Criminal Records – Current County (7 Year Historical Search) feature but checks records at both the misdemeanor and felony levels for ALL counties that your care provider candidate resided in over the past seven years. <strong><a title="Click here to order your background check" href="background-checks#pricing">Click here to order your background check.</a></strong></p>
							<p id="drivingreport" style="text-decoration:underline;">Motor Vehicles Record (MVR) Search</p>
							<p>Before you hire your care provider and hand over the keys, this one-time check will search your candidate’s Motor Vehicle Records. Driving records are available in all 50 states, the District of Columbia, Canada and internationally. Instant MVRs are available in the majority of states. Results are returned to you in an easy-to-read report that includes license type, standing, and any violations, suspensions, or convictions incurred. <strong><a title="Click here to order your background check" href="background-checks#pricing">Click here to order your nanny background check.</a></strong></p>
							<p id="misdemeanorsandfelonies" style="text-decoration:underline;">Extended Global Sanctions Search</p>
							<p>The Extended Global Sanctions Search examines millions of records worldwide sourced from foreign governments, courts, regulatory enforcement, law enforcement agencies, and other public and proprietary data sources around the globe. Data sources are subject to availability and applicable reporting restrictions. This search reviews restriction, sanction, and exclusion records maintained by US and international legal and regulatory enforcement organizations and public sources, and includes sources containing information from 1,700+ watchlists and sanctions with 4+ million records, as well as Politically Exposed Persons (PEP). <strong><a title="Click here to order your background check" href="background-checks#pricing">Click here to order your tutor background check.</a></strong></p>
						</div>

						<div class="row">
							<h6><strong>My care provider candidate recently moved from a different state. Will the background check search records from where she previously lived?</strong></h6>
							<p>Definitely! Make sure you order the Premium Plus package which will complete a search of all U.S. counties that the candidate resided over the past seven years. </p>
						</div>
						<div class="row">
							<h6><strong>I don’t live in Washington state. Can I still purchase a background check?</strong></h6>
							<p>Not a problem. Through our partnership with Sterling, we can process nanny background checks no matter where you live in the United States (including the District of Columbia). For the Premium and Premium Plus packages which include county court record searches, all courthouse access fees are included in the package price except for any New York court record searches. There is an additional fee for New York OCA searches of $100.00. This is a fee charged by the New York OCA, not Nanny Parent Connection.</p>
						</div>
						<div class="row">
							<h6><strong>I’ve heard I should only use FCRA compliant background checks. What is FCRA?</strong></h6>
							<p>The FCRA (Fair Credit Reporting Act) is the federal law regulating employment background checks. Even though the term “credit” is used, the FCRA law applies to all employment background checks conducted by a third party whether the check includes a credit report or not. All of Sterling’s background checks are FCRA compliant and in addition, Sterling is one of only a small percentage of background screening firms in the world to have earned the distinguished Seal of Accreditation through the National Association of Professional Background Screeners (<a title="NAPBS" href="http://www.napbs.com/" target="_blank" rel="noopener noreferrer nofollow">NAPBS</a>).To become accredited, Sterling passed a rigorous on-site audit of their policies, procedures and best practices.</p>
						</div>
						<div class="row">
							<h6><strong>I would like to purchase a Premium or Premium Plus background check but my candidate doesn’t have a driver’s license. What should I do?</strong></h6>
							<p>No problem! Go ahead and place your background check order and then send us an email by <a title="clicking here" href="mailto:info@nannyparentconnection.com">clicking here</a>. We will then modify your order to remove the Motor Vehicles Record Search.</p>
						</div>
						<div class="row">
							<h6><strong>I am a child care agency representative and would like to purchase a nanny background check for a care provider candidate. Is that okay?</strong></h6>
							<p>Yes! If you plan on running multiple background checks, we suggest that you <router-link to="/sign-up-agencies" title="purchase a membership">purchase a membership</router-link> so that you receive the discounted pricing.</p>
						</div>
						<div class="row">
							<h6><strong>I would like to check on the status of my background check order. How do I do that?</strong></h6>
							<p>We’re happy to check on the status of your nanny background check order. For security and data privacy reasons, we do not publish any specific information about background check orders on our website. Please <a title="email us here" href="mailto:laura@nannyparentconnection.com">email us here </a>or call/text us at <a title="Call Us On" href="tel:(425) 243-7032">(425) 243-7032. </a></p>
						</div>
						<div class="row">
							<h6><strong>Have a question we haven’t answered? <a title="Email us here" href="mailto:laura@nannyparentconnection.com">Email us here </a>or call/text us at <a title="Call Us On" href="tel:(425) 243-7032">(425) 243-7032</a></strong></h6>
							
						</div>
					</div>					
				</div>
			 </div>
	</section>
	</main>
	</template>
	
	<script>
	import MemberBuyMembershipPoup from '../views/AllModels/MemberBuyMembershipPoup.vue';
		export default {
			name:'background-checks',
			data() {
				return {
					isLoggedIn: false,
					userplan:[],
					showPlayBtn:true,
					showStopBtn: false,
					pageName : 'BackgroundChecks'
					// pageTitle : 'Nanny Background Check | 98% Customer Rating! | Starting at $18.99',
					// pageMetaDescription : 'Keep your family safe. No hidden fees. Live customer support. Fast results. Order your nanny background check in less than 5 minutes!',
					// pageMetaKeywords : ''
				}
			},
			components: {        
				MemberBuyMembershipPoup
			},
			methods:{
				CheckMemberPlan(){
					axios.get(`/api/CheckMemberPlan`).then((response) => {
						//console.log('Testing ',response.data.userTotalPlans);
						this.userplan= response.data.userTotalPlans;
					}).catch((err) => console.error(err));
				},
				stopYoutubeVideo(){	
					$('.youtube-video')[0].contentWindow.postMessage('{"event":"command","func":"' + 'stopVideo' + '","args":""}', '*');
				},
				pauseYoutubeVideo(){	
					this.showPlayBtn = true;
					this.showStopBtn = false;			
					$('.youtube-video')[0].contentWindow.postMessage('{"event":"command","func":"' + 'pauseVideo' + '","args":""}', '*');
				},
				playYoutubeVideo(){	
					this.showPlayBtn = false;
					this.showStopBtn = true;			
					$('.youtube-video')[0].contentWindow.postMessage('{"event":"command","func":"' + 'playVideo' + '","args":""}', '*');
				}
			},
			mounted(){	
				axios.get(`/api/get-seo-page`).then((response) => {
					var getData = response.data.page_seo_data.find((employee) => employee.page_Name == this.pageName);					
					document.title = getData.seo_Title;
					document.getElementsByTagName('meta')["description"].content = ""+getData.meta_description+"";
					document.getElementsByTagName('meta')["keywords"].content = ""+getData.meta_tags+"";					
				}).catch((err) => console.error(err));					
			},
			created() {
				window.scrollTo(0,0);
				if (window.Laravel.user) {
					this.id = window.Laravel.user.id,
					this.memberType = window.Laravel.user.memberType,
					this.CheckMemberPlan();
				}
				if (window.Laravel.isLoggedin) {
					this.isLoggedIn = true
				}
			}
		}
	</script>
	
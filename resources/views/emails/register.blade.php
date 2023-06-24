<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="UTF-8">
        <title>Nanny Parent Connection</title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
        <link href="{{ ('public/assets/css/style.css') }}" rel="stylesheet"/>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.1/css/all.css"/>
        <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.1.1/css/all.css"/>
        <link rel="stylesheet" href="{{ ('public/assets/userDashboard/css/bootstrap.min.css') }}"/>
        <script src="{{ ('public/assets/js/jquery-1.11.1.min.js') }}"></script>
    </head>
<body style="font:13px 'Lucida Grande','Lucida Sans Unicode',Tahoma,Verdana,sans-serif;color:#545454;"> 
    <table style="border-collapse:collapse;text-align:center;" class="email_bg" width="100%" height="100%" cellspacing="0" cellpadding="0" border="0">
        <tbody>
            <tr>
                <td valign="top">
                    <div style="width: 100%;">                        			
                            <table role="presentation" style="text-align:center;" class="header_bg" width="100%" cellspacing="0" cellpadding="0" border="0" align="center">
                                <tbody>
									<tr>
										<a href="{{URL::to('/')}}">
											<img src="{{ URL::asset('public/assets/images/Nanny-Parent-Connection-Logo.png') }}" style=margin-top:50px;>
										</a>    
									</tr>
                                </tbody>
                            </table>                       
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
	<div class="boldgrid-section">
		<div class="container">
			<div class="row" style="padding-top: 15px;">
				<div class="col-md-12 col-xs-12 col-sm-12">
					<h2 class="" style="font-size: 30px; margin-top: 0px; margin-bottom: 15px; text-align: center;">Welcome to the community {{$user_first_name}}!</h2>
					<p class="">First, my email address is <a href="mailto:laura@nannyparentconnection.com" style="color:#e58eb2;text-decoration: none;">laura@nannyparentconnection.com</a>. Please save and feel free to email me at any time if you have a question.</p>
					<p class="">Next, you will find some housekeeping information about your membership and accessing our community. <span style="text-decoration: underline;">Please read that information carefully.</span> After that, you will find a short guide on how to begin the search for your next family.</p>

					<h3 style="padding-top: 0.4em; padding-bottom: 0.4em;">Housekeeping Information:</h3>
					<p class="">IMPORTANT: If you plan to use one of our Facebook communities, select either the <a class="waffle-rich-text-link" href="https://www.facebook.com/groups/SeattleNannyParentConnection" style="color:#e58eb2;text-decoration: none;">Seattle Facebook community</a> or <a class="waffle-rich-text-link" href="https://www.facebook.com/groups/1379572139038460" style="color:#e58eb2;text-decoration: none;">405/Eastside Facebook community</a> and then click the "Join Group" button. If you do not receive access within two hours, please reply to this email and let us know.</p>
					<p class="">If you would like to become one of our <a title="Verified Care Providers" href="{{URL::to('verified-care-providers')}}" style="color:#e58eb2;text-decoration: none;">Verified Care Providers </a>(which we highly recommend), please <a href="{{URL::to('sign-care-provider')}}" style="color:#e58eb2;text-decoration: none;">upgrade to our Care Provider - Annual</a> membership and then <a href="mailto:laura@nannyparentconnection.com" style="color:#e58eb2;text-decoration: none;">send me an email</a>. We will get the verification process started right away! <strong>Remember, Verified Care Providers in our community can earn $1-$2/hour more than care providers that aren't verified.</strong></p>
					<p class="">Also, please take a moment to <a title="check current pay rates" href="{{URL::to('pay-calculator')}}" style="color:#e58eb2;text-decoration: none;">check current pay rates</a> in our area to ensure you negotiate a competitive rate.</p>

					<h3 style="padding-top: 0.4em; padding-bottom: 0.0em;">Okay, now on to the important stuff! How do you begin your child care search? Please see the guide below:</h3>
				</div>
			</div>
		</div>
	</div>
	
	<div class="boldgrid-section">
		<div class="container">
			<div class="row" style="padding-top: 0px; padding-bottom: 0px; margin-bottom: 0px;">
				<div class="col-md-12 col-xs-12 col-sm-12">
					<h4 style="text-align: center; text-transform: uppercase; padding: 1.1em; background-color: #53a3e8; margin-bottom: 26px;">
						<span style="color: #ffffff;">Step #1: Fill out your profile and check out the member search tool</span>
					</h4>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12 col-xs-12 col-sm-12">
					<p class="">Our <a href="{{URL::to('member-search')}}" style="color:#e58eb2;text-decoration: none;">Member Search</a> tool is quickly becoming the best resource for finding families actively looking for a new care provider. This is also where families can find YOU! But in order to do so, you need to spend a few minutes to fill out your profile.</p>
					<p class="">It's super simple. Here's how:</p>
					<p class="" style="margin: 30px 0px; font-size: 17px; text-align: left;"><span style="color: #000000;">Step #1: Click on <a href="{{URL::to('UserDashboard')}}" style="color:#e58eb2;text-decoration: none;"><strong>Account</strong></a> at the top of our website page. If you don't see the Account button, make sure you are logged in.</span></p>
					<p class="" style="margin: 30px 0px; font-size: 17px; text-align: left;"><span style="color: #000000;">Step #2: Then click on <strong>Profile</strong> and <strong>Edit</strong>. From here, you can edit your profile, change your profile picture, and add a cover image.</span></p>
					<p class="" style="margin: 30px 0px; font-size: 17px; text-align: left;"><span style="color: #000000;">Step #3: Last, spend a few minutes and complete the questions on your <strong>Bio</strong>, <strong>Availability</strong>, <strong>CareCalendar Notifications</strong>, <strong>Resume</strong>, <strong>Background Check</strong>, and <strong>First Aid/CPR</strong> <strong>Certification</strong> pages.</span></p>
					<p class="" style="text-align: left;"><strong>That's it! You're all set! </strong>Now, families can find you through our Member Search resource and you can browse available families in your area using the search box at the top of the Member Search page. For more information on how to use your Profile and the Member Search tool, <a href="{{URL::to('help')}}" style="color:#e58eb2;text-decoration: none;">click here</a>.</p>
				</div>
			</div>
			<div class="row" style="padding-top: 10px; padding-bottom: 0px; margin-bottom: 0px;">
				<div class="col-md-12 col-xs-12 col-sm-12">
					<h4 style="text-align: center; text-transform: uppercase; padding: 1.1em; background-color: #53a3e8; margin-bottom: 26px;">
						<span style="color: #ffffff;">Step #2: do you use facebook? check out our facebook community</span>
					</h4>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12 col-xs-12 col-sm-12">
					<p class="">Many families that are urgently looking for care also post their childcare need to our Facebook communities. Hundreds of families and care providers connect here each month for good reason, almost 6,000 members use our Facebook groups everyday!</p>
					<p class="">Select either the <a class="waffle-rich-text-link" href="https://www.facebook.com/groups/SeattleNannyParentConnection" style="color:#e58eb2;text-decoration: none;">Seattle Facebook community</a> or <a class="waffle-rich-text-link" href="https://www.facebook.com/groups/1379572139038460" style="color:#e58eb2;text-decoration: none;">405/Eastside Facebook community</a> to browse the most recent posts.</p>
					<p class="">We also recommend publishing your own post about what type of family you are looking for as our Search Team is constantly on the lookout for new care providers that might be a good fit for a family they are currently working with.</p>
					<p class="">If you decide to post to our Facebook communities, I would urge you to <a title="read this article" href="https://blog.nannyparentconnection.com/5tipsusecommunity/" style="color:#e58eb2;text-decoration: none;">read this article</a> to ensure that your post receives maximum visibility. If you would like to be instantly notified when a member responds to your post (which I recommend), <a title="read this article" href="https://www.facebook.com/groups/SeattleNannyParentConnection/permalink/1027752257373926/" style="color:#e58eb2;text-decoration: none;">follow these instructions</a> once you are in the Facebook community.</p>
					<p class="">Don't use Facebook but would still like to "advertise" yourself? No problem! <strong><a href="{{URL::to('sign-care-provider')}}" style="color:#e58eb2;text-decoration: none;">Simply upgrade to the Care Provider - Annual membership</a> and our team will work with you to publish a top notch post for families to review.</strong></p>

				</div>
			</div>
			<div class="row" style="padding-top: 10px; padding-bottom: 0px; margin-bottom: 0px;">
				<div class="col-md-12 col-xs-12 col-sm-12">
					<h4 style="text-align: center; text-transform: uppercase; padding: 1.1em; background-color: #53a3e8; margin-bottom: 26px;">
						<span style="color: #ffffff;">Step #3: check out the other tools we offer based on the type of childcare you offer
						</span>
					</h4>
					<p class="">Some care providers are looking for long term, full time work while others are just looking for temporary opportunities. We offer several other tools for you to use based on what type of childcare you are offering:</p>
					<h4><span style="color: #3366ff;">I'M LOOKING FOR A LONG TERM, FULL OR PART TIME FAMILY TO WORK WITH...</span></h4>
					<strong>BROWSE OUR JOBS BOARD</strong>
					<p class="">
						<span style="color: #000000;">Browse dozens of detailed child care opportunities on our 
							<a href="{{URL::to('care-providers-jobs')}}" style="color:#e58eb2;text-decoration: none;">Jobs Board</a>. Posts include compensation, schedule, job duties details about the family and much more. See a position that interests you? Apply directly from the Jobs Board!
						</span>
					</p>
					<strong>ASK OUR TEAM</strong>
					<p class="">Our experienced team spends almost every waking moment working within our community to connect families and care providers. 
						<a href="{{URL::to('sign-care-provider')}}" style="color:#e58eb2;text-decoration: none;">Upgrade to the Care Provider - Annual</a> membership then <a href="mailto:laura@nannyparentconnection.com" style="color:#e58eb2;text-decoration: none;">shoot us an email</a>. We would be happy to help connect you with families in your area!</p>
					&nbsp;
					<h4 class="h4" style="text-transform: uppercase;">
						<span style="color: #3366ff;">I'M LOOKING FOR A SHORT TERM OR TEMPORARY POSITION WITH A FAMILY...</span>
					</h4>
					<strong>SEARCH OR PUBLISH A CARECALENDAR EVENT</strong>
					<p class="">
						<span style="color: #000000;">Browse families needing care on specific days/times. Find families looking for care on days that you are available - fill your schedule! With our 
						<a title="CareCalendar" href="{{URL::to('/')}}" style="color:#e58eb2;text-decoration: none;">CareCalendar</a>, you can search child care opportunities posted by other members or publish your own.</span>
					</p>
					<strong>SIGN UP FOR OUR LAST MINUTE CARE SYSTEM</strong>
					<p class="">
						<span style="color: #000000;">Many of our Family/Parent members use the<a title="Last Minute Care Service" href="{{URL::to('last-minute-group-text')}}" style="color:#e58eb2;text-decoration: none;"> Last Minute Care Service </a>when they need last minute or temporary care. Receive child care opportunities text messaged directly to your phone!</span>
					</p>
					<strong>BECOME A VERIFIED CARE PROVIDER</strong>
					<p class=""><span style="color: #000000;">Our <a href="{{URL::to('verified-care-providers')}}" style="color:#e58eb2;text-decoration: none;">Verified Care Providers</a> are the most in demand group of providers in our community. Why? Because instead of the parent taking care of the screening process (i.e. background check, verifying references, etc.), we handle it! Many of the Verified Providers in our community charge a premium for their services - earn more!</span></p>
					<strong>ASK OUR TEAM</strong>
					<p class="">
						<span style="color: #000000;">One of the biggest differences between us and other child care companies is we provide you with a team of experts who will help you with your child care search. All at no additional cost! Just <a title="send us an email" href="mailto:laura@nannyparentconnection.com" style="color:#e58eb2;text-decoration: none;">send us an email</a> if you need help! <em>* Personal support from our team requires an active <a href="{{URL::to('sign-care-provider')}}" style="color:#e58eb2;text-decoration: none;">Care Provider - Annual membership</a></em>.
						</span>
					</p>
					<p class="">Again, welcome to the community. We look forward to supporting and working with you!</p>
					<img class="size-full wp-image-36729 alignleft" src="{{ URL::asset('public/assets/images/sign.png') }}" alt="" width="314" height="88" />
					<p class="">Founder and "Chief Mommy"</p>
					<p class="c">P.S. Don't forget, my team and I are available 9am to 9pm PST every day of the week to help you. Just send me an email and let us know what we can do!</p>
				</div>
			</div>
		</div>
	</div>
	<table style="border-collapse:collapse;" class="email_bg" width="100%" height="100%" cellspacing="0" cellpadding="0" border="0">
        <tbody>
            <tr>
                <td valign="top">                    
					<div style="max-width: 1100px; margin: 20px auto;border-top: 1px solid #eee;" class="email-container">			
						<table role="presentation" style="border-radius: 5px;margin-top:10px;" class="body_bg" width="100%" cellspacing="0" cellpadding="0" border="0" align="center">
							<tbody>
								<tr>
									<p style="width: 100%; text-align: center; margin-top:10px;font-size: 13px;">Nanny Parent Connection | 4739 University Way NE, Suite 180 Seattle, WA 98105 | © 2017-2023 Nanny Parent Connection LLC </p>
								</tr>
							</tbody>
						</table>	
					</div>                    
                </td>
            </tr>
        </tbody>
    </table>
</body>
</html>
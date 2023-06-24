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
	
	<div class="container">
		<div class="row" style="padding-top: 15px;">
			<div class="col-md-12 col-xs-12 col-sm-12">
				<h2 class="" style="font-size: 30px; margin-top: 15px; margin-bottom: 20px; text-align: center;">Welcome to the community {{$user_first_name}}!</h2>
				<p class="">We look forward to working with you on your childcare search!</p>
				<p class="">First, my email address is <a href="mailto:laura@nannyparentconnection.com" style="color:#e58eb2;">laura@nannyparentconnection.com</a>. Please save and feel free to email me at any time if you have a question or need help.</p>
				<p>Next, you will find some housekeeping information about your membership and accessing our community. Please read that carefully. After that, you will find a short guide on how to search for care providers in our community.</p>
				<h3 style="padding-top: 0.4em; padding-bottom: 0.4em;font-size:20px;">Housekeeping Information:</h3>
				<p class="">IMPORTANT: If you plan to use one of our Facebook communities, select either the <a style="color:#e58eb2;" href="https://www.facebook.com/groups/SeattleNannyParentConnection">Seattle Facebook community</a> or <a style="color:#e58eb2;" href="https://www.facebook.com/groups/1379572139038460">405/Eastside Facebook community</a> and then click the "Join Group" button. If you do not receive access within two hours, please reply to this email and let us know.</p>
				<p class="">Also, please take a moment to <a title="check current pay rates" href="{{URL::to('pay-calculator')}}" style="color:#e58eb2;">check current pay rates</a> in our area to ensure you negotiate a competitive rate.</p>
				<h3 style="padding-top: 0.4em; padding-bottom: 0.0em;font-size:18px;">Okay, now on to the important stuff! How do you begin your child care search? Please see the guide below:</h3>
				<h2 style="text-align: center; text-transform: uppercase; padding: 1.1em; background-color: #53a3e8; margin-bottom: 26px;font-size:15px;margin-top:20px;"><span style="color: #ffffff;">Step #1: Fill out your profile and check out the member search tool</span></h2>
				<p>Our <a href="{{URL::to('member-search')}}" style="color:#e58eb2;">Member Search</a> tool is quickly becoming the best resource for finding families actively looking for a new care provider. This is also where families can find YOU! But in order to do so, you need to spend a few minutes to fill out your profile.</p>
				<p>It's super simple. Here's how:</p>
				<p class="" style="margin: 30px 0px;font-size: 17px;text-align: left"><span style="color: #000000">- Click on <a href="{{URL::to('UserDashboard')}}" style="color:#e58eb2;"><strong>Account</strong></a> at the top of our site page. If you don't see the Account button, make sure you are logged in.</span></p>
				<p class="" style="margin: 30px 0px;font-size: 17px;text-align: left"><span style="color: #000000">- Then click on <strong>Profile</strong> and <strong>Edit</strong>. From here, you can edit your profile, change your profile picture, and add a cover image.</span></p>
				<p class="" style="margin: 30px 0px;font-size: 17px;text-align: left"><span style="color: #000000">- Last, spend a few minutes and complete the questions on your <strong>Bio</strong>, <strong>Availability</strong>, <strong>CareCalendar Notifications</strong>, <strong>Resume</strong>, <strong>Background Check</strong>, and <strong>First Aid/CPR</strong> <strong>Certification</strong> pages.</span></p>
				<p><strong>That's it! You're all set! </strong>Now, families can find you through our Member Search resource and you can browse available families in your area using the search box at the top of the Member Search page. For more information on how to use your Profile and the Member Search tool, <a href="{{URL::to('help')}}" style="color:#e58eb2;">click here</a>.</p>
				<h2 style="text-align: center; text-transform: uppercase; padding: 1.1em; background-color: #53a3e8; margin-bottom: 26px;font-size:15px;margin-top:20px;"><span style="color: #ffffff;">Step #2: do you use facebook? check out our facebook community</span></h2>
				<p>Many families that are urgently looking for care also post their childcare need to our Facebook communities. Hundreds of families and care providers connect here each month for good reason, almost 6,000 members use our Facebook groups everyday!</p>
				<p>Select either the <a class="waffle-rich-text-link" href="https://www.facebook.com/groups/SeattleNannyParentConnection" style="color:#e58eb2;">Seattle Facebook community</a> or <a class="waffle-rich-text-link" href="https://www.facebook.com/groups/1379572139038460" style="color:#e58eb2;">405/Eastside Facebook community</a> to browse the most recent posts.</p>
				<p>We also recommend publishing your own post about what type of family you are looking for as our Search Team is constantly on the lookout for new care providers that might be a good fit for a family they are currently working with.</p>
				<p><strong>If you decide to post to our Facebook communities,</strong> I would urge you to <a title="read this article" href="https://blog.nannyparentconnection.com/5tipsusecommunity/" style="color:#e58eb2;">read this article</a> to ensure that your post receives maximum visibility. If you would like to be instantly notified when a member responds to your post (which I recommend), <a title="read this article" href="https://www.facebook.com/groups/SeattleNannyParentConnection/permalink/1027752257373926/" style="color:#e58eb2;">follow these instructions</a> once you are in the Facebook community.</p>
				<p class="">Don't use Facebook but would still like to "advertise" yourself? No problem! <a href="mailto:laura@nannyparentconnection.com" style="color:#e58eb2;">Contact our team</a> and we can work with you to publish a top notch post for families to review.</p>
				<h2 style="text-align: center; text-transform: uppercase; padding: 1.1em; background-color: #53a3e8; margin-bottom: 26px;font-size:15px;margin-top:20px;"><span style="color: #ffffff;">Step #3: check out the other tools we offer based on the type of childcare you offer</span></h2>
				<p>Some care providers are looking for long term, full time work while others are just looking for temporary opportunities. We offer several other tools for you to use based on what type of childcare you are offering:</p>
				<h4><span style="color: #3366ff;font-size: 14px;font-weight: bold;">I'M LOOKING FOR A LONG TERM, FULL OR PART TIME FAMILY TO WORK WITH...</span></h4>
				<p style="margin-top:15px;"><strong>BROWSE OUR JOBS BOARD</strong></p>
				<p>Browse dozens of detailed child care opportunities on our <a href="{{URL::to('care-providers-jobs')}}" style="color:#e58eb2;">Jobs Board</a>. Posts include compensation, schedule, job duties details about the family and much more. See a position that interests you? Apply directly from the Jobs Board!</p>
				<p style="margin-top:15px;text-transform: uppercase;"><strong>ask our team</strong></p>
				<p>Our experienced team spends almost every waking moment working within our community to connect families and care providers. Just <a title="shoot us an email" href="mailto:laura@nannyparentconnection.com" style="color:#e58eb2;">shoot us an email</a> and we would be happy to help you search for families!</p>
				<h4><span style="color: #3366ff;font-size: 14px;font-weight: bold;">I'M LOOKING FOR A SHORT TERM OR TEMPORARY POSITION WITH A FAMILY...</span></h4>
				<p style="margin-top:15px;text-transform: uppercase;"><strong>SEARCH OR PUBLISH A CARECALENDAR EVENT</strong></p>
				<p><span style="color: #000000">Browse families needing care on specific days/times. Find families looking for care on days that you are available - fill your schedule! With our CareCalendar, you can search child care opportunities posted by other members or publish your own.</span></p>
				<p style="margin-top:15px;text-transform: uppercase;"><strong>SIGN UP FOR OUR LAST MINUTE CARE SYSTEM</strong></p>
				<p class=""><span style="color: #000000">Many of our Family/Parent members use the<a title="Last Minute Care Service" href="{{URL::to('last-minute-group-text')}}" style="color:#e58eb2;"> Last Minute Care Service </a>when they need last minute or temporary care. Receive child care opportunities text messaged directly to your phone!</span></p>
				<p><strong>BECOME A VERIFIED CARE PROVIDER</strong></p>
				<p class=""><span style="color: #000000">Our <a href="{{URL::to('verified-care-providers')}}" style="color:#e58eb2;">Verified Care Providers</a> are the most in demand group of providers in our community. Why? Because instead of the parent taking care of the screening process (i.e. background check, verifying references, etc.), we handle it! Many of the Verified Providers in our community charge a premium for their services - earn more!</span></p>

				<h4 style="text-transform: uppercase; text-align: left;font-size: 14px;font-weight: bold;margin-top:20px;">ask our team</h4>
				<p><span style="color: #000000">One of the biggest differences between us and other child care companies is we provide you with a team of experts who will help you with your child care search. All at no additional cost! Just <a title="send us an email" href="mailto:laura@nannyparentconnection.com" style="color:#e58eb2;">send us an email</a> if you need help!</span></p>
				<p>Again, welcome to the community. We look forward to supporting and working with you!</p>
				<img class="size-full wp-image-36729 alignleft" src="{{ URL::asset('public/assets/images/sign.png') }}" alt="" width="314" height="88" />
				<p style="margin-top:20px;margin-bottom:20px;">Founder and "Chief Mommy"</p>
				<p style="margin-bottom:20px;">P.S. Don't forget, my team and I are available 9am to 9pm PST every day of the week to help you. Just reply to this email and let us know what we can do!</p>
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
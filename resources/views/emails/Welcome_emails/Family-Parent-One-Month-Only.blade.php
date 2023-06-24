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
				<p class="">We look forward to working with you on your child care search!</p>
				<p class="">First, my email address is <a href="mailto:laura@nannyparentconnection.com" style="color:#e58eb2;">laura@nannyparentconnection.com</a>. Please save and feel free to email me at any time if you have a question or need help.</p>
				<p>Next, you will find some housekeeping information about your membership and accessing our community. Please read that carefully. After that, you will find a short guide on how to search for care providers in our community.</p>
				<h3 style="padding-top: 0.4em; padding-bottom: 0.4em;font-size:20px;">Housekeeping Information:</h3>
				<p class="">IMPORTANT: If you plan to use one of our Facebook communities, select either the <a style="color:#e58eb2;" href="https://www.facebook.com/groups/SeattleNannyParentConnection">Seattle Facebook community</a> or <a style="color:#e58eb2;" href="https://www.facebook.com/groups/1379572139038460">405/Eastside Facebook community</a> and then click the "Join Group" button. If you do not receive access within two hours, please reply to this email and let us know.</p>
				<p class="">Before you post to the community, I would urge you to <a href="https://blog.nannyparentconnection.com/5-tips-find-nanny/" style="color:#e58eb2;">read this article</a> to ensure that your post receives maximum visibility. If you would like to be instantly notified when a member responds to your post (which I recommend), <a href="https://www.facebook.com/groups/SeattleNannyParentConnection/permalink/1027752257373926/" style="color:#e58eb2;">follow these instructions</a> once you are in the Facebook community.</p>
				<p>If you have never written a "nanny advertisement" before and need some help, <a href="https://youtu.be/Hqg_5GGLDGo" style="color:#e58eb2;">click here to check out a tutorial. </a></p>
				<p>If you plan on using the CareCalendar or <a href="{{URL::to('member-search')}}" style="color:#e58eb2;">Member Search</a> tools, please take a <a href="{{URL::to('help')}}" style="color:#e58eb2;">few moments to fill out your online profile</a> before you start using those tools.</p>
				<p class="">Don't forget to check out our <a href="{{URL::to('last-minute-group-text')}}" style="color:#e58eb2;">Last Minute Care Text Service</a>. It's an incredibly helpful tool if you are in a bind and need child care ASAP.</p>
				<p class="">Also, please take a moment to <a href="{{URL::to('pay-calculator')}}" style="color:#e58eb2;">check current pay rates</a> in our area or use our <a href="{{URL::to('pay-rate-worksheet')}}" style="color:#e58eb2;">Pay Rate Worksheet</a> to ensure you offer a competitive rate!</p>
				<h3 style="padding-top: 0.4em; padding-bottom: 0.0em;font-size:18px;">Okay, now on to the important stuff! How do you begin your child care search? Please see the guide below:</h3>
				<h2 style="text-align: center; text-transform: uppercase; padding: 1.1em; background-color: #53a3e8; margin-bottom: 26px;font-size:18px;margin-top:20px;"><span style="color: #ffffff;">I'M LOOKING FOR A LONG TERM, FULL OR PART TIME NANNY to work with...</span></h2>
				<h4 style="text-transform: uppercase; text-align: left;font-size: 14px;font-weight: bold;margin-top:20px;">post to our facebook communitIES</h4>
				<p class="" style="margin: 0px; font-size: 17px; text-align: left;"><span style="color: #000000;">Posting to our Facebook communities is fast and simple. Hundreds of parents and providers connect here every month. Over 5,000 members are active daily in our group which means no more waiting hours or days to hear back!</span></p>
				<h4 style="text-transform: uppercase; text-align: left;font-size: 14px;font-weight: bold;margin-top:20px;">search member profiles</h4>
				<p class="" style="margin: 0px 0px; font-size: 17px;">
					<span style="color: #000000;">
						Looking for a care provider with a special skill or ability? Maybe you are looking for a nanny that lives close by? Check out our <a href="{{URL::to('member-search')}}" style="color:#e58eb2;">Member Search</a> tool! This tool allows you to search all member profiles for specific information such as languages spoken, preferred transportation method, location, etc.
					</span>
				</p>
				<h4 style="text-transform: uppercase; text-align: left;font-size: 14px;font-weight: bold;margin-top:20px;">ask our team</h4>
				<p class="" style="margin: 0px 0px; font-size: 17px;"><span style="color: #000000;">Our team spends almost every waking moment working within our community to connect parents and care providers. Just <a href="mailto:laura@nannyparentconnection.com" style="color:#e58eb2;">shoot us an email</a> and we would be happy to help you!</span></p>
				<h2 style="text-align: center; text-transform: uppercase; padding: 1.1em; background-color: #53a3e8; margin-bottom: 26px;font-size:18px;margin-top:20px;"><span style="color: #ffffff;">I'M LOOKING FOR A LAST MINUTE, SHORT TERM or temporary Nanny or sitter...</span></h2>
				<h4 style="text-transform: uppercase; text-align: left;font-size: 14px;font-weight: bold;margin-top:20px;">search or publish a CARECALENDAR event</h4>
				<p class="" style="margin: 0px 0px; font-size: 17px;"><span style="color: #000000;">Schedule nannies and sitters offering child care on specific dates and times. Need a date night or time to get some shopping done? Post your need to the CareCalendar! With our CareCalendar, you can search child care opportunities posted by other members or publish your own.
				</span></p>
				<h4 style="text-transform: uppercase; text-align: left;font-size: 14px;font-weight: bold;margin-top:20px;">post to our facebook communities</h4>
				<p class="" style="margin: 0px 0px; font-size: 17px;"><span style="color: #000000;">Many parents looking for last minute, date night or temporary care as well as providers looking to fill their schedules post to our Facebook communities. Receive instant notifications when another member wants to connect with you!
				</span></p>
				<h4 style="text-transform: uppercase; text-align: left;font-size: 14px;font-weight: bold;margin-top:20px;">search member profiles</h4>
				<p class="" style="margin: 0px 0px; font-size: 17px;"><span style="color: #000000;">Looking for a nanny or sitter that speaks Spanish? Check out our <a href="{{URL::to('member-search')}}" style="color:#e58eb2;">Member Search</a> tool! This tool allows you to search all member profiles for specific information such as languages spoken, preferred transportation method, location, etc.</span></p>
				<h4 style="text-transform: uppercase; text-align: left;font-size: 14px;font-weight: bold;margin-top:20px;">CHECK OUT OUR Last Minute Care SERVICE</h4>
				<p class="" style="margin: 0px 0px; font-size: 17px;"><span style="color: #000000;">If you urgently need child care in the next couple of hours or days, check out our <a href="{{URL::to('last-minute-group-text')}}" style="color:#e58eb2;">Last Minute Care Service</a>. Hundreds of nannies and sitters are signed up to receive text message alerts when parents need last minute child care.
				</span></p>
				<h4 style="text-transform: uppercase; text-align: left;font-size: 14px;font-weight: bold;margin-top:20px;">SEND A VERIFIED CARE PROVIDER REQUEST</h4>
				<p class="" style="margin: 0px 0px; font-size: 17px;"><span style="color: #000000;">Need a care provider in the coming days or weeks but don’t have time to run a background check, confirm references, etc.? We’ve got you covered! Our <a href="{{URL::to('verified-care-providers')}}" style="color:#e58eb2;">Verified Care Providers</a> are screened in advance by our team and have a clean background check, verified references, and current First Aid/CPR certification.
				</span></p>
				<h4 style="text-transform: uppercase; text-align: left;font-size: 14px;font-weight: bold;margin-top:20px;">ask our team</h4>
				<p class="" style="margin: 0px 0px; font-size: 17px;"><span style="color: #000000;">One of the biggest differences between us and other child care companies is we provide you with a team of people who will help you with your child care search. All at no additional cost! Just <a href="mailto:laura@nannyparentconnection.com" style="color:#e58eb2;">send us an email</a> if you need help!
				</span></p>
				<p style="margin-bottom:20px;margin-top:20px;">Below, you will find your payment receipt. Again, welcome to the community!</p>
				<p><strong>Payment Receipt:</strong></p>
				<p style="margin-bottom:0px;">Amount: {{$payment_amount}}</p>
				<p style="margin-bottom:0px;">Date: {{$trans_date}}</p>
				<p style="margin-bottom:0px;">Invoice: {{$invoice_num}}</p>
				<p style="margin-bottom:0px;">Transaction: {{$trans_num}}</p>
				<p style="margin-top:20px;margin-bottom:20px;">Cheers!</p>
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
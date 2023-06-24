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
    <table style="border-collapse:collapse; text-align:center;" class="email_bg" width="100%" height="100%" cellspacing="0" cellpadding="0" border="0">
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
				<h2 class="" style="font-size: 30px; margin-top: 15px; margin-bottom: 20px; text-align: center;">You are all set {{$user_first_name}}!</h2>
				<p class="">You may now download the nanny share contract. Make sure you are logged into the website now (you should see Account in the upper right hand corner). If you don't see Account, then click Login and access the site with the username and password you just set up.</p>
				<p class="">Return to the Nanny Share Contract page by <a href="{{URL::to('nanny-share-contract')}}" style="color:#e58eb2;">clicking here</a>. Scroll to the bottom and click the link to begin your download. You will have access to the nanny contract for six months (in case you need to download another copy in the future).</p>
				<p class="">Since you are in need of a nanny share contract, I assume that you already have a care provider lined up. If you don't and aren't already a member, <a href="{{URL::to('sign-up-chooser')}}" style="color:#e58eb2;">please join our community!</a> We have almost 9,000 nannies, babysitters, au pairs, and mother's helpers looking to connect with families like yours. In addition, all of our members receive access to:</p>
				<p><span style="color:#e58eb2;">CareCalendar:</span> Schedule nannies and sitters offering child care on specific dates and times. Need a date night or time to get some shopping done? Post your need to the CareCalendar! You can search child care opportunities posted by other members or publish your own.</p>
				<p><a href="{{URL::to('background-checks')}}" style="color:#e58eb2;">Background Checks</a>: We offer the most affordable and comprehensive child care background checks in America! Purchasing a membership qualifies you for reduced pricing on all of our background checks.</p>
				<p><a href="{{URL::to('last-minute-group-text')}}" style="color:#e58eb2;">Last Minute Care Text Service</a>: Nanny called in sick? Emergency at work? Find last minute child care instantly. Simply fill out a form and we will blast it via text message to all subscribed care providers. The providers can then fill your need by texting or calling your directly.</p>
				<p class=""><a href="{{URL::to('payroll-service')}}" style="color:#e58eb2;">Payroll Service</a>: Want the professionals to handle payroll and taxes for your care provider? No problem! We offer affordable payroll services so you can spend more time with your family.</p>
				<p class=""><a href="{{URL::to('help')}}" style="color:#e58eb2;">Member Feedback</a>: You will find our member-generated feedback system here. Check out the current feedback of care providers or post your own feedback.</p>
				<p class=""><a href="{{URL::to('pay-calculator')}}" style="color:#e58eb2;">Pay Calculator</a>: One of our most popular features! You can use this calculator to ensure that you are paying your care provider correctly each and every time.</p>
				<p class=""><a href="{{URL::to('faq-guides')}}" style="color:#e58eb2;">Library</a>: Have a question? We probably have the answer! Click here to visit our extensive library focused on child care laws, "how to" guides, and recommendations.</p>
				<p class=""><a href="https://blog.nannyparentconnection.com/" style="color:#e58eb2;">Blog</a>: In depth discussions, fun children events, freebies and random musings.</p>
				
				<p style="margin-bottom:0px;">Username: {{$username}}</p>
				<p>Password:*** Password you set during signup ***</p>
				<p style="margin-bottom:0px;"><strong>Payment Receipt:</strong></p>
				<div>Amount: {{$payment_amount}}</div>
				<div>Date: {{$trans_date}}</div>
				<div>Invoice: {{$invoice_num}}</div>
				<div>Transaction: {{$trans_num}}</div>
				<img class="size-full wp-image-36729 alignleft" src="{{ URL::asset('public/assets/images/sign.png') }}" alt="" width="314" height="88" />
				<p style="margin-bottom:20px;">P.S. If I can answer any questions or help with anything, just reply to this email and let me know!</p>
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
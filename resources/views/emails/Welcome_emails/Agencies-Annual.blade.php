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
				<h2 class="" style="font-size: 30px; margin-top: 15px; margin-bottom: 20px; text-align: center;">Welcome {{$user_first_name}}!</h2>
				<p class="">You can login to the website here:<a href="{{URL::to('login')}}" style="color:#e58eb2;">{{URL::to('login')}}</a></p>
				<p>Using this username and password:</p>
				<p style="margin-bottom:0px;">Username: {{$username}}</p>
				<p>Password:*** Password you set during signup ***</p>
				<p>IMPORTANT: If you plan to use one of our Facebook communities, select either the <a class="waffle-rich-text-link" href="http://url9776.nannyparentconnection.com/ls/click?upn=9oCYBEjg-2Fq4dtZ1jAKt-2B5gg5ZWnjdznzVKhQED4gm6JKLXkLYxaSa7tYWxo95HAsVB-2BTMiWBI-2BkV7ZTHTg5w-2Bd9TEi2jL5d-2Ftd2rggXBVuo-3DYM2U_JzWZdsUOweSReDoemff-2BqNAnHVH8bjrDJUBcN70LQfjyMMy-2F-2B1XO7WxzycB2R5ffvhvp010w6N7pI8s0votNY3MIkQ1v-2BAJwhuf4BvDFFN-2FMgoc7VinqpT-2FWkUFkZHTwwJB7cYflbKHbz8nweMOFlKu-2BGcnR57jW8YFQeS7YYdQXQD0bmUOjFFrIN3Y0ASygKqkx8bPhDDaWlWu2p7o1EQ-3D-3D" style="color:#e58eb2;">Seattle Facebook community</a> or <a class="waffle-rich-text-link" href="http://url9776.nannyparentconnection.com/ls/click?upn=9oCYBEjg-2Fq4dtZ1jAKt-2B5gg5ZWnjdznzVKhQED4gm6KOqUeDEUDJQb31q610qpwoLJ9asvjwhhiw5mmTWr1FBg-3D-3D3mR3_JzWZdsUOweSReDoemff-2BqNAnHVH8bjrDJUBcN70LQfjyMMy-2F-2B1XO7WxzycB2R5ff5dr-2B2NCPf5cxQ7qT5oEDUZfvd7FH07f-2BfdP4D2-2BfHeF-2FtjliODFXtkZIDsYvmb4P3-2FZ1eA7Rfnila6GCajnHHR-2BAq6U0Fs21hPuxm958sY0FznTt5EDZD8fjEN76jPTcIqlygnZDVaEmpzOnUTOGGA-3D-3D" style="color:#e58eb2;">405/Eastside Facebook community</a> and then click the "Join Group" button.. If you do not receive access within two hours, please reply to this email and let us know.</p>
				<p><strong>Before you post to the community,</strong> I would urge you to <a href="https://blog.nannyparentconnection.com/5-tips-find-nanny/" target="_blank" rel="noopener" style="color:#e58eb2;">read this article</a> to ensure that your post receives maximum visibility. If you would like to be instantly notified when a member responds to your post (which I recommend), <a href="https://www.facebook.com/groups/SeattleNannyParentConnection/permalink/1027752257373926/" style="color:#e58eb2;">follow these instructions</a> once you are in the Facebook community.</p>
				<p>If you plan on using the CareCalendar or <a href="{{URL::to('member-search')}}" style="color:#e58eb2;">Member Search</a> tools, please take a <a href="{{URL::to('help')}}" style="color:#e58eb2;">few moments to fill out your online profile</a> before you start using those tools.</p>
				<p>Agency Advertising Rules:</p>
				<ul>
					<li>Advertisements for a care provider to fill a specific position (i.e. family with two children seeks full time nanny in West Seattle) are ALLOWED. <strong>We ask that you limit these to one advertisement per week.</strong></li>
					<li>Advertisements for new parent/family clients are NOT ALLOWED.</li>
					<li>General advertisements about your agency are NOT ALLOWED.</li>
				</ul>
				<p>Don't forget your membership includes discounts on all of our <a href="{{URL::to('background-checks')}}" style="color:#e58eb2;">background checks</a> and access to the <a href="{{URL::to('last-minute-group-text')}}" style="color:#e58eb2;">Last Minute Care Text Service</a> as well as our CareCalendar.</p>
				<p style="margin-bottom:0px;"><strong>Payment Receipt:</strong></p>
				<div>Amount: ${{$payment_amount}}</div>
				<div>Date: {{$trans_date}}</div>
				<div>Invoice: {{$invoice_num}}</div>
				<div>Transaction: {{$trans_num}}</div>
				<p style="margin-top:15px;">Cheers!</p>
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
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
    {{-- Dynamic content start here --}}

    <div id="body" style="width: 800px; background: white; padding: 0px; margin: 0 auto; text-align: left;">
        <div class="section" style="display: block; margin-bottom: 10px;margin-top:15px;">Hi {{$user_first_name}},</div>
       <p>Just a friendly reminder that your access to our website and Facebook communities expired on {$subscr_expires_at}.</p>
        <p>I hope that you found that special family to work with. If so, GREAT! I am glad that the Nanny Parent Connection was able to help you with your child care opportunity.</p>
        <p>If you are leaving for another reason, please take a minute to tell me why by replying to this email. I always welcome honest feedback!</p>
        <p>If you found our services useful and think your friends might as well, don't forget to check out our  <a href="https://sandbox.nannyparentconnection.com/rewards-program/" style="color: #e58eb2;">Rewards Program</a>. You can earn cash or credits when someone in your network signs up!</p>
        <p>Thanks for being part of our community!</p>
        <p>Laura Scoccolo</p>
        <p>Founder and "Chief Mommy"</p>
        <p>P.S. My team and I would very much appreciate it if you could leave us a positive review. As a small company, we rely on word of mouth (and reviews from care providers like you) to promote Nanny Parent Connection in our community. <a href="https://www.yelp.com/biz/nanny-parent-connection-seattle" style="color: #e58eb2;">Click here to leave a Yelp review</a> or <a href="https://g.page/nanny_parent_connection/review?rc" style="color: #e58eb2;">here to leave a Google review</a>!!</p>
    </div>

    {{-- Dynamic content end  here --}}
	<table style="border-collapse:collapse;" class="email_bg" width="100%" height="100%" cellspacing="0" cellpadding="0" border="0">
        <tbody>
            <tr>
                <td valign="top">
					<div style="max-width: 900px; margin: 20px auto;border-top: 1px solid #eee;" class="email-container">
						<table role="presentation" style="border-radius: 5px;margin-top:10px;" class="body_bg" width="100%" cellspacing="0" cellpadding="0" border="0" align="center">
							<tbody>
								<tr>
									<p style="width: 100%; text-align: center; margin-top:10px;font-size: 13px;">Nanny Parent Connection | 4739 University Way NE, Suite 180 Seattle, WA 98105 | © 2017-2022 Nanny Parent Connection LLC </p>
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

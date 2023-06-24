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
       <p>Now that you have (hopefully) filled out your <a href="{{URL::to('member-search')}}" style="color: #e58eb2;">Profile</a> so that parents can find you, have you checked out our <a href="{{URL::to('care-providers-jobs')}}" style="color: #e58eb2;">Jobs Board</a>?</p>
        <p>Our Jobs Board is a "bulletin board" of current positions that our Search Team is working to fill and you might be a great fit for one of these families!</p>
        <p><strong><a href="{{URL::to('care-providers-jobs')}}" style="color: #e58eb2;">Click here to visit the Jobs Board</a></strong></p>
        <p>If you see a position that you like, click the Apply button, fill out the application and it will be reviewed by our Search Team. If you are a good fit, we will contact you to set up an interview.</p>
        <p>If you have any questions, please don't hesitate to reply to this email and let me know. I hope you have a chance to check out the Jobs Board!</p>
        <p>Best wishes!</p>
        <p>Laura Scoccolo</p>
        <p>Founder and "Chief Mommy"</p>
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

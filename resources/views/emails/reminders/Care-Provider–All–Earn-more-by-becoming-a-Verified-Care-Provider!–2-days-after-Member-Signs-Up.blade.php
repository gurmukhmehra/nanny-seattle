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
        <div class="section" style="display: block; margin-bottom: 10px;">Hi {{$user_first_name}},</div>
        <P>I wanted to drop you a quick note inviting you to become one of our <a href="{{URL::to('verified-care-providers')}}" style="color: #e58eb2;">Verified Care Providers</a>.</p>
        <P>Whether you are a full time nanny looking to pick up some additional hours or just want to have total control of your schedule, our <a href="{{URL::to('verified-care-providers')}}" style="color: #e58eb2;">Verified Care Provider Service</a> is an excellent way to connect with families in need of temporary child care.</p>
        <P>Since we take care of running a background check on you, verifying your references, and confirming your First Aid/CPR Certification, the hiring process for parents is much simpler and more importantly, FAST!</p>
        <P>On top of this, many of our Verified Care Providers charge a slightly higher hourly rate ($1 to $2/hour) once they become verified.</p>
        <P>Once you are verified and subscribed to our system, you will be notified via text message the instant a parent submits a request for a Verified Care Provider. The message will contain specific details including location, pay range, number of children, and any special instructions. If you are interested, simply text or call the parent back and confirm when you will arrive. Simple and fast!</p>
        <P>You will also receive a Verified Nanny Badge that you are free to share within our community or anywhere else you like!</p>
        <p class="mod-reset"><a href="{{URL::to('last-minute-group-text')}}"><img class="aligncenter wp-image-159245 size-full" src="https://nannyparentconnection.com/wp-content/uploads/2019/04/Verified-Nanny-Badge-Example-768x429.jpg" alt="" width="768" height="429" /> </a></p>
        <P>If you would like to learn more, <a href="{{URL::to('verified-care-providers')}}" style="color: #e58eb2;">please click here</a>. If you would like to become a Verified Care Provider, simply reply to this email and I will be happy to get the process started for you.</p>
        <P><em>P.S. Spaces are limited so please let me know right away if you would like to begin the verification process.</em></p>
        <P>Best wishes!</p>
        <P>Laura Scoccolo</p>
        <P>Founder and "Chief Mommy"</p>
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

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
        <p>I hope that you have had some time to get settled into our community. I wanted to send you a note and make sure you knew about our <a href="{{URL::to('last-minute-group-text')}}" style="color: #e58eb2;">Last Minute Care Text Service</a>.</p>
        <P>This service is a super quick way for parents to find last minute care if they are called into work unexpectedly, their daycare is closed, or they just need a break to do some shopping (and a great way for you to make some extra money)!</P>
        <p style="text-align: center;"><a href="{{URL::to('last-minute-group-text')}}"><img class="aligncenter wp-image-154942" src="https://nannyparentconnection.com/wp-content/uploads/2018/05/Last-Minute-Care-Text-1024x536.png" alt="" width="600" height="314" /></a></p>
        <P>With an active care provider membership, you can sign up to receive these text messages and fill your schedule! Just <a href="https://nannyparentconnection.us16.list-manage.com/track/click?u=b0a9a26e03a9eca3242797dbe&amp;id=a6f3feca36&amp;e=f37bcd4bdc" target="_blank" rel="noopener" style="color: #e58eb2;">log into the website</a>, and then click Last Minute Care Text Service near the top of the page.<p>
        <p>Look for the below form, enter your Facebook profile name and phone number, and you are all set! The best part is that access to this service is included with your membership!</p>
        <p style="text-align: center;"><a href="{{URL::to('last-minute-group-text')}}"><img class="aligncenter wp-image-154971 size-large" src="https://nannyparentconnection.com/wp-content/uploads/2018/05/Image-1-576x1024.jpg" alt="" width="576" height="1024" /></a></p>
        <p>When a parent needs last minute child care, you will receive a text message delivered straight to your mobile phone that looks like the below.</p>
        <p>If you are interested in offering child care, simply call or text the parent and set it up!</p>
        <p style="text-align: center;"><a href="{{URL::to('last-minute-group-text')}}"><img class="aligncenter wp-image-154975 size-large" src="https://nannyparentconnection.com/wp-content/uploads/2018/05/Last-Minute-Text-Sample-576x1024.jpg" alt="" width="576" height="1024" /></a></p>
        <p>I hope you have a chance to use this system! It's been a real game-changer for many members. Don't hesitate to contact me (you can just reply to this email) if I can help you with anything!</p>
        <p>Best wishes</p>
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

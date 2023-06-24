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
        <p class="">Just a friendly reminder that your membership to Nanny Parent Connection renews in 30 days.</p>
        <p class="">If you would like to continue having premium access to...</p>
        <ul>
            <li class="section">Our online community of over 10,000 nannies, babysitters, and au pairs in the Puget Sound region</li>
            <li><a href="{{URL::to('last-minute-group-text')}}" style="color: #e58eb2;">Last Minute Care Text Service</a> - our most used resource for finding last minute care when life throws you a curveball</li>
            <li><a href="{{URL::to('verified-care-providers')}}" style="color: #e58eb2;">Verified Care Provider Service</a> - specifically built for when you need a care provider but don't have time to run a background check, confirm references, etc.</li>
            <li><a href="{{URL::to('background-checks')}}" style="color: #e58eb2;">Discounted background checks</a></li>
            <li>all of the other tools available on our <a href="{{URL::to('/')}}" style="color: #e58eb2;">website</a></li>
            <li>and most importantly, <a href="mailto:laura@nannyparentconnection.com" style="color: #e58eb2;">personal support from our team</a></li>
        </ul>
        <p class="">... there is nothing that you need to do at this time. Your membership will automatically renew in 30 days.</p>
        <p class="">If you would like to cancel your membership, <a href="{{URL::to('help')}}" style="color: #e58eb2;">click this link</a> and follow the instructions. If you have any questions, just reply to this email or shoot me a call or text at <a href="tel:(425) 243-7032" style="color: #e58eb2;">(425) 243-7032</a>!</p>
        <p class="">Thanks for being an important part of our community!</p>
        <p class="">Laura Scoccolo</p>
        <p class="">Founder and "Chief Mommy"</p>
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

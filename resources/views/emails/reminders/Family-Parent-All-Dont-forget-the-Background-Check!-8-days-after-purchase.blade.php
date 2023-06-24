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
       <p>Now that it has been a little over a week since you signed up, I hope that you have had a chance to meet some of the AMAZING care providers in our community (If not, please don't hesitate to respond to this email so that our Search Team can jump in to help you!)</p>
        <p>Once you have found that special care provider that you would like to hire, <strong><span style="text-decoration: underline;"><a href="{{URL::to('background-checks')}}" style="color: #e58eb2;">don't forget to run a background check!</a></span></strong></p>
        <p>Nanny Parent Connection offers the most comprehensive yet affordable child care background checks in the United States. Not sure if you need to order a background check on your prospective care provider? (hint: you do!).</p>
        <p>Click on the video below to learn why background checks are SO important these days:</p>
        <p align="center"><a href="https://youtu.be/Y8c9zVA1O-M" target="_blank" rel="noopener"><img class="aligncenter wp-image-179891 size-medium" src="https://nannyparentconnection.com/wp-content/uploads/2021/09/Child-Abuse-Why-You-Should-Never-Skip-the-Background-Check-YouTube-Thumbnail-300x169.png" alt="" width="300" height="169" /></a></p>
        <p>Our background check customers have rewarded us with a <span style="text-decoration: underline;">98.9% customer satisfaction rating</span> because...</p>

        <ul>
            <li>Our background checks are the MOST affordable child care background checks in the United States today</li>
            <li>Takes just five minutes to order a background check from us (we only need your candidate's name and email address to get started)</li>
            <li>Our system searches almost ONE BILLION records across all 50 states</li>
            <li>Our expert team is available from 9 am to 9 pm PST every day of the week to help you understand the results once your background check completes...at no additional cost!</li>
        </ul>
        <p>And I almost forgot, with your active Family/Parent membership, you will receive a special "member" discount on all of our background check packages!</p>
        <p class=""><a href="{{URL::to('background-checks')}}" style="color: #e58eb2;"><strong>ORDER YOUR BACKGROUND CHECK TODAY!</strong></a></p>
        <p>Thanks for being part of our community!</p>
        <p>Laura Scoccolo</p>
        <p>Founder and "Chief Mommy"</p>
        <p>P.S. Feel free to reply to this email if you have any questions that we can help you answer!</p>
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

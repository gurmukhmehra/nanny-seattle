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
        <P>I wanted to send you a quick note to make sure that you knew about our CareCalendar.</p>
        <P>The CareCalendar is one of our most helpful tools as it provides families the ability to find short term, temporary or last minute child care opportunities in an easy to use, calendar format.</p>
        <p style="text-align: center;"><img class="aligncenter wp-image-162579 size-large" src="https://nannyparentconnection.com/wp-content/uploads/2019/11/CareCalendar-Weekly-View-Example-1024x909.png" alt="" width="1024" height="909" /></p>
        <P>We understand that many families are short on time and need to find child care as soon as possible. With that in mind, we built the CareCalendar so that families can visually see if there is currently a care provider available for a specific date/time period, make sure they are a good fit by viewing their Profile, and then book that provider all in just a few minutes.</p>
        <P>Since you already have an active membership, the CareCalendar is ready for you to use!</p>
        <P>Using the CareCalendar is very easy:</p>
        <p><span style="color: #3366ff;"><strong>Step #1: Fill Out Your Profile</strong></span></p>

        <p><a href="{{URL::to('help')}}" style="color: #e58eb2;">Click here to learn how to access and fill out your profile.</a></p>

        <p><span style="color: #3366ff;"><strong>Step #2: Search Events or Post Your Own</strong></span></p>
        <P>There are two ways to use the CareCalendar; <a href="{{URL::to('help')}}" style="color: #e58eb2;">adding a child care event</a> for Care Provider members to see or <a href="{{URL::to('help')}}" style="color: #e58eb2;">searching events</a> already posted by Care Provider members.</p>
        <p><span style="color: #3366ff;"><strong>Step #3: Book that Child Care!</strong></span></p>

        <p>If you find a provider offering care on a day/time that works for you, book that provider online. If you decided to post your own child care need, grab a cup of coffee and sit back - care providers will be seeing your event momentarily!</p>
        <P>For a complete tutorial on how to use the CareCalendar, <a href="{{URL::to('help')}}" style="color: #e58eb2;">please click here.</a></p>
        <P>If you have any questions, please don't hesitate to reply to this email and let me know. I hope you have a chance to take a look at the CareCalendar today!</p>
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

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
        <p class="">I wanted to send you a quick note to make sure that you knew about our CareCalendar.</p>
        <p class="">The CareCalendar is one of our most helpful tools as it provides care providers like YOU the ability to find and/or offer short term, temporary or last minute child care opportunities in an easy to use, calendar format.</p>
        <p><img class="aligncenter wp-image-162579 size-large" src="{{ URL::asset('public/assets/images/CareCalendar-Weekly-View-Example-1024x909.png') }}" alt="" width="100%" height="100%" /></p>
        <p class="">We understand that many providers have long term, full or part time positions but would like to augment their monthly income. With that in mind, we built the CareCalendar so that providers can find or offer child care for when they would like to work.</p>
        <p><strong>Since you already have an active membership, the CareCalendar is ready for you to use!
        </strong></p>
        <p>Using the CareCalendar is very easy:</p>
        <p><span style="color: #3366ff;"><strong>Step #1: Fill Out Your Profile</strong></span></p>

        <p><a href="{{URL::to('help')}}" style="color: #e58eb2;">Click here to learn how to access and fill out your profile.</a></p>

        <p><span style="color: #3366ff;"><strong>Step #2: Search Events or Post Your Own</strong></span></p>
        <p>There are two ways to use the CareCalendar; <a href="{{URL::to('help')}}">adding a child care event</a> for Family/Parent members to see or <a href="{{URL::to('help')}}" style="color: #e58eb2;">searching for events</a> already posted by Family/Parent members.</p>
        <p><span style="color: #3366ff;"><strong>Step #3: Book that Child Care!</strong></span></p>

        <p> If you find a family needing care on a day/time that works for you, book that family online. If you decided to post your own child care opportunity, grab a cup of coffee and sit back - parents will be seeing your event momentarily!</p>
        <p>For a complete tutorial on how to use the CareCalendar, <a href="{{URL::to('help')}}" style="color: #e58eb2;">please click here.</a></p>
        <p class="">If you have any questions, please don't hesitate to reply to this email and let me know. I hope you have a chance to take a look at the CareCalendar today!</p>
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

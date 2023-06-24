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
        <div class="section" style="display: block; margin-bottom: 10px;margin-top:15px;">Hi {{$name}},</div>
        <p>I hope that you have had a chance to look around our site in the last couple of hours. We offer many tools and resources (I know...it's a bit overwhelming!) but I wanted to ensure you checked out what is undoubtedly the most effective tool for meeting families and parents in our community.</p>
        <p class="">Our <a href="{{URL::to('member-search')}}" style="color: #e58eb2;">Member Search</a> tool allows you to browse profiles and directly message parents.</p>
        <P>Think of it as an online directory of all active parents seeking care in our community. You can quickly see desired experience level, childcare type needed, ages of children, pay rate range, location, etc.</P>
        <P>See a parent's profile that you are interested in? Great! Click the "Private Message" button to send them a note and get the conversation started. As soon as your message is sent, the parent is notified via email that you want to connect with them.</P>
        <P>The Member Search tool also allows you to search and filter by childcare type, location, and weekly availability. You can also use the Keyword Search to find parents needing a nanny or sitter with specific skills such as foreign language, special needs experience, etc.</P>
        <P>We recently added another feature to our Member Search tool called Suggested Matches.</P>
        <P>This new feature is a game-changer. Using an algorithm we've been building over the last couple of months, our system will show you parent "matches" that might be a good fit for the childcare you are offering. You will find your "matches" at the top of the Member Search page. In order to see the Suggested Matches our system has built for you, make sure to complete your online <a href="{{URL::to('UserDashboard')}}" style="color: #e58eb2;">Profile</a>.</P>
        <P>Let me know if you have any questions about the Member Search or Suggested Matches tools. I'm here to help!</P>
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

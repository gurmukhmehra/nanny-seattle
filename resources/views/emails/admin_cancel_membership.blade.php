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
	<table style="border-collapse:collapse;" class="email_bg" width="100%" height="100%" cellspacing="0" cellpadding="0" border="0">
        <tbody>
            <tr>
                <td valign="top">
                    <div style="width: 100%; text-align: left;">
                        <div style="max-width: 900px; margin: auto;" class="email-container">			
                            <table role="presentation" style="border-radius: 5px;margin-top:10px;" class="body_bg" width="100%" cellspacing="0" cellpadding="0" border="0" align="center">
                                <tbody>
                                    <tr>
                                        <td>
                                            <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0">
                                                <tbody>
                                                    <tr>
                                                        <td style="padding: 20px; font-family: sans-serif; mso-height-rule: exactly; line-height: 24px; color: #555555; font-size: 15px" class="body_text_color body_text_size">
                                                            <span style="font-weight: bold; font-size: 20px" class="welcome">Hi <b>Admin</b>, your membership successfully cancel.</span>
                                                            <hr color="#F7F3F0">
                                                            <p><b>{{$name}}</b>, Member cancel our membership.</p>
                                                            <p>Member detail : </p>
                                                            <p>Name : {{$name}} </p>
                                                            <p>Email : ${{$email}} </p>
                                                            <p>Membership details : </p>
                                                            <p>Membership Name : {{$membership}} </p>
                                                            <p>Period : ${{$membership_period}} </p>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>	
                        </div>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
	<table style="border-collapse:collapse;" class="email_bg" width="100%" height="100%" cellspacing="0" cellpadding="0" border="0">
        <tbody>
            <tr>
                <td valign="top">                    
					<div style="max-width: 900px; margin: 20px auto;border-top: 1px solid #eee;" class="email-container">			
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
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
                        <div style="max-width: 1100px; margin: auto;" class="email-container">			
                            <table role="presentation" style="border-radius: 5px;margin-top:10px;" class="body_bg" width="100%" cellspacing="0" cellpadding="0" border="0" align="center">
                                <tbody>
                                    <tr>
                                        <td>
                                            <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0">
                                                <tbody>
                                                <tr>
                                                        <td style="padding: 20px; font-family: Arial; mso-height-rule: exactly; line-height: 24px; color: #545454; font-size: 18px" class="body_text_color body_text_size">
                                                            <div id="receipt">
																<div class="section" style="display: block; margin-bottom: 10px; margin-left: 8px;">{{$name}}</div>
																<div class="section" style="display: block; margin-bottom: 10px; margin-left: 8px;">
																	Your request for last minute care has been received and will be text messaged to all subscribed care providers in the next couple of minutes. Depending on variables such as time of day, day of week, # of children that need care, and your location, you may hear from many care providers that are interested or just one or two.
																</div>
																<div class="section" style="display: block; margin-bottom: 10px; margin-left: 8px;">
																	<strong>If you do not find a care provider to fulfill your last minute need, please contact me at <a href="mailto:laura@nannyparentconnection.com" style="color:#e58eb2;">laura@nannyparentconnection.com</a> as soon as possible and let me know.</strong> I am happy to contact a few care providers in your neighborhood and see if I can help make a connection for you.
																</div>
																<div class="section" style="display: block; margin-bottom: 10px; margin-left: 8px;">
																	Your feedback is so important to ensuring our community runs smoothly. After your last minute care need has been taken care of (and you have had a chance to catch your breath), please take a moment to complete the following survey. It will only take a minute or two and if you'd like, we will keep your responses confidential.
																</div>
																<div class="section" style="display: block; margin-bottom: 10px; margin-left: 8px;">
																	<a href="https://www.surveymonkey.com/r/RGFV5BW" style="color:#e58eb2;">CLICK HERE TO COMPLETE THE SURVEY</a>
																</div>
															</div>
															<div><span style="margin-left: 8px;">Thank you!</span></div>
															<div class="section" style="display: block; margin-bottom: 10px; margin-left: 8px;">Laura Scoccolo</div>
															<div class="section" style="display: block; margin-bottom: 10px; margin-left: 8px;">Founder and "Chief Mommy"</div>
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
					<div style="max-width: 1100px; margin: 20px auto;border-top: 1px solid #eee;" class="email-container">			
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
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
	<div id="body" style="width: 800px; background: white; padding: 0px; margin: 0 auto; text-align: left;">
	<h1 style="font-size: 30px; margin-top: 15px; margin-bottom: 10px; text-align: center;">Your subscription has been Upgraded</h1>
	<div class="section" style="font-size:18px;display: block; text-align: center; margin-bottom: 20px;">Subscriber #:{{$subscription_id}}</div>
	<div class="section" style="display: block; text-align: center; margin-bottom: 20px;">Your subscription with Nanny Parent Connection was upgraded:</div>	
		<table class="transaction" style="clear: both;margin:auto;">
			<tbody>
			<tr>
				<th style="text-align: left;font-size: 14px;color: #4f5255;">Website :</th>
				<td> Nanny Parent Connection (<a href="www.nannyparentconnection.com" target="_blank" style="color:#e58eb2;">www.nannyparentconnection.com</a>)</td>
			</tr>
			<tr>
				<th style="text-align: left;font-size: 14px;color: #4f5255;">Terms :</th>
				<td> ${{$Terms}}</td>
			</tr>
			<tr>
				<th style="text-align: left;font-size: 14px;color: #4f5255;">Subscription :</th>
				<td> {{$subscription_id}}</td>
			</tr>
			<tr>
				<th style="text-align: left;font-size: 14px;color: #4f5255;">Started :</th>
				<td> {{$Started}}</td>
			</tr>
			<tr>
				<th style="text-align: left;font-size: 14px;color: #4f5255;">Status :</th>
				<td> Active</td>
			</tr>
			<tr>
				<th style="text-align: left;font-size: 14px;color: #4f5255;">Email :</th>
				<td> <a href="mailto:{{$memberEmail}}" target="_blank" style="color:#e58eb2;">{{$memberEmail}}</a></td>
			</tr>
			<tr>
				<th style="text-align: left;font-size: 14px;color: #4f5255;">Login :</th>
				<td> {{$memberUsername}}</td>
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
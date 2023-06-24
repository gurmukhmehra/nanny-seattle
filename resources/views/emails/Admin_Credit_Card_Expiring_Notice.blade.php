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
	<div id="body" style="width: 900px; background: white; padding: 0px; margin: 0 auto; text-align: left;">
		<h1 style="font-size: 25px; margin-top: 15px; margin-bottom: 15px; text-align: left;">A Credit Card is Expiring on {{$subscr_cc_month_exp}}/{{$subscr_cc_year_exp}}</h1>
		<div class="section" style="display: block; margin-bottom: 10px;">{{$user_full_name}}</div>
		<div class="section" style="display: block; margin-bottom: 10px;">A member's Credit Card will expire before their next billing on Nanny Parent Connection:</div>
			<table class="transaction" style="clear: both;">
				<tbody>
					<tr>
						<th style="text-align: left;font-size: 14px;color: #4f5255;">Website : </th>
						<td>Nanny Parent Connection</td>
					</tr>
					<tr>
						<th style="text-align: left;font-size: 14px;color: #4f5255;">Subscription :</th>
						<td>{{$product_name}}</td>
					</tr>
					<tr>
						<th style="text-align: left;font-size: 14px;color: #4f5255;">Credit Card Num :</th>
						<td>{{$subscr_cc_num}}</td>
					</tr>
					<tr>
						<th style="text-align: left;font-size: 14px;color: #4f5255;">Credit Card Exp :</th>
						<td>{{$subscr_cc_month_exp}}/{{$subscr_cc_year_exp}}</td>
					</tr>
					<tr>
						<th style="text-align: left;font-size: 14px;color: #4f5255;">Next Billing :</th>
						<td>{{$subscr_next_billing_at}}</td>
					</tr>
					<tr>
						<th style="text-align: left;font-size: 14px;color: #4f5255;">Payment System :</th>
						<td>{{$subscr_gateway}}</td>
					</tr>					
				</tbody>
			</table>
			<hr>
			<h6 style="font-size: 25px; margin-top: 15px; margin-bottom: 5px; text-align: left;">Billed to</h6>
			<table class="transaction" style="clear: both;">
				<tbody>
					<tr>
						<th style="text-align: left;font-size: 14px;color: #4f5255;">{{$user_full_name}}</th>							
					</tr>
					<tr>
						<th style="text-align: left;font-size: 14px;color: #4f5255;">{{$user_email}} ({{$user_login}})</th>
					</tr>
					<tr>
						<th style="text-align: left;font-size: 14px;color: #4f5255;">{{$user_address}}</th>
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
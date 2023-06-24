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
		<h1 style="font-size: 30px; margin-top: 15px; margin-bottom: 15px; text-align: left;">Payment from John Doe</h1>
		<div class="section" style="display: block; margin-bottom: 10px;">{{$product_name}} – {{$trans_num}}</div>
			<table class="transaction" style="clear: both;">
				<tbody>
					<tr>
						<th style="text-align: left;font-size: 14px;color: #4f5255;">Payment Amount : </th>
						<td>{{$payment_amount}}</td>
					</tr>
					<tr>
						<th style="text-align: left;font-size: 14px;color: #4f5255;">Invoice Number :</th>
						<td>{{$invoice_num}}</td>
					</tr>
					<tr>
						<th style="text-align: left;font-size: 14px;color: #4f5255;">Invoice Date :</th>
						<td>{{$trans_date}}</td>
					</tr>
					<tr>
						<th style="text-align: left;font-size: 14px;color: #4f5255;">Transaction :</th>
						<td>{{$trans_num}}</td>
					</tr>
					<tr>
						<th style="text-align: left;font-size: 14px;color: #4f5255;">Payment System :</th>
						<td>{{$trans_gateway}}</td>
					</tr>								
				</tbody>
			</table>
			<hr>
				<h6 style="font-size: 25px; margin-top: 15px; margin-bottom: 15px; text-align: left;">Billed to</h6>
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
			<hr>
			<table style="border-collapse:collapse;margin-top:20px;" class="email_bg" width="100%" height="100%" cellspacing="0" cellpadding="0" border="0">
				<tbody>
					<tr>
						<th style="text-align: left;font-size: 14px;color: #4f5255;">Would you like access to our Facebook community? : </th>
						<td>https://www.facebook.com/groups/SeattleNannyParentConnection</td>
					</tr>
					<tr>
						<th style="text-align: left;font-size: 14px;color: #4f5255;">Which Facebook community would you like access to : </th>
						<td>https://www.facebook.com/groups/1379572139038460</td>
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
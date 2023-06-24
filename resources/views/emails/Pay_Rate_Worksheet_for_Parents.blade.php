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
	<div id="body" style="width: 700px; background: white; padding: 0px; margin: 0 auto; text-align: left;">
    <h4 style="font-size: 18px; margin-top: 15px; margin-bottom: 15px; text-align: center;">User Just Completed Pay Rate Worksheet for Parents</h4>
	<div></div>
		<table class="transaction" style="clear: both;">
			<tbody>				
                <tr>
					<th style="text-align: left;font-size: 13px;color: #4f5255;">What type of child care you are looking for? : </th>
					<td>{{$looking_for}}</td>
				</tr>
				<tr>
					<th style="text-align: left;font-size: 13px;color: #4f5255;">How long do you expect this care provider to work with your family? : </th>
					<td>{{$expect_care_provider}}</td>
				</tr>
                <tr>
					<th style="text-align: left;font-size: 13px;color: #4f5255;">How many children need care? : </th>
					<td>{{$children_need_care}}</td>
				</tr>
                <tr>
					<th style="text-align: left;font-size: 13px;color: #4f5255;">Do you require a provider with five years or more of experience? : </th>
					<td>{{$provider_experience}}</td>
				</tr>
                <tr>
					<th style="text-align: left;font-size: 13px;color: #4f5255;">Do you expect your provider to complete normal child care duties such as washing bottles, daily tidying, children's meal prep and children's laundry? : </th>
					<td>{{$child_care_duties}}</td>
				</tr>
                <tr>
					<th style="text-align: left;font-size: 13px;color: #4f5255;">Is the child (or children) that need temporary/last minute child care currently sick? : </th>
					<td>{{$temporary_last_minute_child_care}}</td>
				</tr>
                <tr>
					<th style="text-align: left;font-size: 13px;color: #4f5255;">Will the child care occur in a major metropolitan area such as Seattle, Bellevue, Kirkland, or Redmond? : </th>
					<td>{{$Will_the_child_care_occur}}</td>
				</tr>											
			</tbody>
		</table>
	</div>
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
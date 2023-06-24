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
        <div class="section" style="display: block; margin-bottom: 10px;">Hi {{$user_first_name}},</div>
        <div class="section" style="display: block; margin-bottom: 10px;">I hope this finds you well!</div>
        <p>Are you planning on paying your nanny over the table as a W-2 employee or under the table in cash? (Hint: You definitely want to take the "over the table" route. <a href="https://youtu.be/DWWZ_eqt6EU" style="color: #e58eb2;">Watch this video here</a> to learn why!)</p>
        <p>Once you have found a nanny and they accepted your job offer, it may seem that the hard work is behind you. But there is one more important decision for you and your family to make: do you hire a nanny payroll company to take care of paying your nanny or do you handle payroll yourself?</p>
        <p>There are many pro's and con's for handling payroll yourself. I wrote an in-depth article recently about this which you can find here. For myself (and many other busy parents), I just don't have the time nor the patience to process payroll every month.</p>
        <p>If like me, you would prefer having a professional handle all of these tasks, then I would encourage you to check out our nanny payroll service operated by our partner, <a href="{{URL::to('payroll-service')}}" style="color: #e58eb2;">HomePay</a>. We've been working with HomePay for well over a year now to offer payroll services to our members and they are FANTASTIC! It's so easy to just pick up the phone and give them a call if you have a question or need some advice.</p>
        <P><strong><a href="{{URL::to('payroll-service')}}" style="color: #e58eb2;">To learn more about what HomePay offers, click here.</a> </strong></P>
        <p>What I like the most about HomePay is that they literally take care of everything: <strong>
        </strong></p>
        <p>#1: They set up your account, notify all appropriate government agencies, and request an Employer Identification Number for you.</p>
        <p>#2: You send HomePay the number of hours that your care provider worked for the pay period.</p>
        <P>#3: They handle all payroll tasks on the date of your choice including mileage reimbursement, healthcare stipends, etc.</P>
        <p>#4: They pay your care provider using direct deposit or if you like, you can pay your provider directly via check, electronic transfer, etc.</p>
        <p>#5: They file timely quarterly payroll tax reports and remit taxes on your behalf. They issue a W-2 for your nanny and file your W-3 with the government at the end of the year.</p>
        <p>#6: If your state has special laws or regulations (i.e. Paid Family Leave Tax), HomePay's expert team will handle all tax reporting and filings for you at no additional cost!</p>
        <P>On top of this, they offer a Happiness Guarantee where during your first six months of working with them, they will issue you a refund if your expectations aren't met (wow!) PLUS a Service Guarantee where they guarantee that your tax returns are filed accurately and on time.</P>
        <p>All of this for only $59/month! But if you get started today, your first month is FREE! To begin using our payroll service, please <a href="{{URL::to('payroll-service')}}" style="color: #e58eb2;">click here</a>.</p>
        <p class="">Let me know if you have any questions about handling payroll yourself versus hiring a payroll company. Happy to help!</p>
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

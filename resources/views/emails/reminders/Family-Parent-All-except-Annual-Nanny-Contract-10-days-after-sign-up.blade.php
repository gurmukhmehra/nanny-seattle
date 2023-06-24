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
        <p class="">Are you searching for a nanny? Do you plan to use a contract once you have found that perfect nanny? (hint: you definitely should!)</p>
        <p class=""><span style="color: #0000ff;"><strong>If so, we've got you covered!</strong></span></p>
        <p class="">Let's face it. Contracts can be a pain to deal with. They can be complicated and you may find yourself feeling that you left something important out. That’s why we have worked with our attorney to create "easy to understand" <a href="{{URL::to('nanny-contract')}}" target="_blank" rel="noopener" style="color: #e58eb2;">nanny</a> and <a href="{{URL::to('nanny-share-contract')}}" target="_blank" rel="noopener" style="color: #e58eb2;">nanny share</a> contracts specific to Washington.</p>

        <h3><strong>Everyone says their contract is the "best". Here's six reasons to check out ours:</strong></h3>
        <p>#1: Our nanny contracts were developed by our attorney specifically with Washington state laws in mind. Do you live in the city of Seattle? Our contracts also include language specifically for parents hiring a nanny in Seattle.</p>
        <p>#2: A written agreement fosters open communications and clear expectations which are key to ensuring the relationship with your nanny goes smoothly. Unfortunately, most nanny contracts are filled with confusing legal jargon which many of us don't understand. All of our contracts are written in an "easy to understand" format which allows for a better understanding of the terms.</p>
        <p>#3: These days, it seems that federal, state and local laws are constantly changing. Our team is constantly monitoring changes to the law and updating our nanny contracts accordingly.</p>
        <p>#4: While there are many free "nanny contracts" available online, most do not include important laws and regulations such as Paid Sick Leave, Paid Family and Medical Leave, etc. that are required in Washington.</p>
        <p>#5: Our contracts include color coded instructions to make customizing the language a breeze.</p>
        <p>#6: After purchasing a contract, you will have access to any updates that our team makes to the contract for six months.</p>
        <p>BONUS: We've added a special COVID-19 safety section to all contracts to ensure that your family and nanny are safe!</p>
        <p>To access and download our nanny or nanny share contract, simply click one of the links below and follow the instructions:</p>
        <p><a href="{{URL::to('nanny-contract')}}" target="_blank" rel="noopener" style="color: #e58eb2;"><strong>CLICK HERE TO DOWNLOAD THE NANNY CONTRACT</strong></a></p>
        <p><a href="{{URL::to('nanny-share-contract')}}" target="_blank" rel="noopener" style="color: #e58eb2;"><strong>CLICK HERE TO DOWNLOAD THE NANNY SHARE CONTRACT</strong></a></p>
        <p>Thanks for being part of our community!</p>
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

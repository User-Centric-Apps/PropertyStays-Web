<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
    <link href='https://fonts.googleapis.com/css?family=Cairo:300,400,600,700&display=swap&subset=arabic' rel='stylesheet' type='text/css'>
<style type="text/css">

/* Reset */
* { margin-top: 0px; margin-bottom: 0px; padding: 0px; border: none; line-height: normal; outline: none; list-style: none; -webkit-text-size-adjust: none; -ms-text-size-adjust: none; }

table { border-collapse: collapse !important; padding: 0px !important; border: none !important; border-bottom-width: 0px !important; mso-table-lspace: 0pt; mso-table-rspace: 0pt; }
table td { border-collapse: collapse; }
body { margin: 0px; padding: 0px; background-color: #F3F3F5; font-family: arial;}
.ExternalClass * { line-height: 100%; }

/* Responsive */
@media only screen and (max-width:600px) {

	/* Tables
	parameters: width, alignment, padding */
	table[class=scale] { width: 100%!important; }
	table[class=scale-bottom] { width: 100%!important; }
	table[class=borderwidth] { width: 150px!important; }
	table[class=center] { text-align: center!important; }

	table[class=scale-round] { width: 100%!important; border-top-right-radius: 0px!important; border-top-left-radius: 0px!important }
	
	/* Td */
	td[class=scale-left] { width: 100%!important; text-align: left!important;}
	td[class=scale-left-bottom] { width: 100%!important; text-align: left!important; padding-bottom: 25px!important; }
	td[class=scale-left-top] { width: 100%!important; text-align: left!important; padding-top: 25px!important; }
	td[class=scale-left-all] { width: 100%!important; text-align: left!important; padding-top: 25px!important; padding-bottom: 25px!important; }
	td[class=scale-center] { width: 100%!important; text-align: center!important;}
	td[class=scale-center-bottom] { width: 100%!important; text-align: center!important; padding-bottom: 25px!important; }
	td[class=scale-center-top] { width: 100%!important; text-align: center!important; padding-top: 25px!important; }
	td[class=scale-center-all] { width: 100%!important; text-align: center!important; padding-top: 25px!important; padding-bottom: 25px!important; }
	td[class=scale-right] { width: 100%!important; text-align: right!important;}
	td[class=scale-right-bottom] { width: 100%!important; text-align: right!important; padding-bottom: 25px!important; }
	td[class=scale-right-top] { width: 100%!important; text-align: right!important; padding-top: 25px!important; }
	td[class=scale-right-all] { width: 100%!important; text-align: right!important; padding-top: 25px!important; padding-bottom: 25px!important; }

	td[class=scale-center-both] { width: 100%!important; text-align: center!important; padding-left: 20px!important; padding-right: 20px!important; }
	td[class=scale-center-both-top] { width: 100%!important; text-align: center!important; padding-left: 20px!important; padding-right: 20px!important; padding-top: 24px!important; }
	td[class=scale-width] { width: 200px!important; }
	td[class=noshow] { display: none!important; }
	td[class=borderwidth] { width: 150px!important; }

	span[class=nein] { display: none!important; }

	img[class=reset] { display: inline!important; }
	img[class=blockset] { display: block!important; text-align: center!important; padding-bottom: 20px!important; }

	p[class=lhreset] { line-height: 30px!important; }
	
}

</style>
</head>

<body marginwidth="0" marginheight="0"  style="margin-top: 0; margin-bottom: 0; padding-top: 20px; padding-bottom: 0; width: 100%; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%;" offset="0" topmargin="0" leftmargin="0">

	<!-- Main Wrapper -->
	<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
		<tr>
			<td valign="top" align="center" bgcolor="#F3F3F5">
				
					<table style="direction: ltr;" width="100%" border="0" cellspacing="0" cellpadding="0" data-module="2Col txt_left" >
					<tr>
						<td bgcolor="#F3F3F5">
							<table width="800" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF" align="center" class="scale">
								<tr>
									<td>
										<table width="720" border="0" cellspacing="0" cellpadding="0" align="center" class="scale" style="margin-top: 30px;">
											<tr>
												<td height="24" align="center">
													<img src="{{ URL::asset('resources/assets/front-end/img/Propertystays-logo.svg') }}" border="0" width="300"  class="reset" data-crop="false">
												</td>
										</table>

									</td>
								</tr>
							</table>

						</td>
					</tr>
				</table>

				<!-- Header Text -->
				<table width="100%" border="0" cellspacing="0" cellpadding="0" data-module="2Col txt_left">
					<tr>
						<td bgcolor="#F3F3F5">
							<table width="800" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF" align="center" class="scale">
								<tr>
									<td>
										<table width="600" border="0" cellspacing="0" cellpadding="0" align="center" class="scale">
											<tr>
												<td align="center">
													<div style="margin-top: 30px; margin-bottom: 10px;">
														<img src="{{ URL::asset('resources/assets/emails/password-reset.png') }}" border="0" style="display: block;" width="172" class="reset" data-crop="false">
													</div>
												</td>
											</tr>
											<tr>
												<td align="center">
													<div style="margin-top: 10px;">
														<h1>Hello {{ $name }}</h1>
													</div>
												</td>
											</tr>
											<tr>
												<td align="center">
													<div style="margin-top: 30px; text-align: center; font-weight: bold; font-size: 18px;">
														<u>Login Details</u>
													</div>
												</td>
											</tr>

											<tr>
                                                <td align="center">
                                                	<div style="text-align: center; margin-top: 30px; ">
                                                    	<strong>Email: </strong> {{ $email }}
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td align="center">
                                                	<div style="text-align: center; margin-top: 10px; ">
                                                   		<strong>Password: </strong> {{ $password }}
                                                   	</div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td align="center">
                                                	<div style="margin-top: 30px;">
                                                   		<a href="{{ URL::to('/login') }}" style="text-decoration: none; color: #ffffff; padding: 10px 60px; border-radius: 0px; background-color: #00bdbc;" >Login</a>
                                                   	</div>
                                                </td>
                                            </tr>
                                            <tr>
												<td align="center">
													<div style="text-align: center; margin-top: 30px;">
														<p style="    color: #707070;">If you did not initiate this request, <br />please contact us at info@propertystays.com</p>
													</div>
												</td>
											</tr>
											<tr>
												<td align="center">
													<div style="margin-top: 24px; margin-bottom: 24px; text-align: center;">
														<p style="color: #707070;">Thank you, <br /><strong>PropertyStays.com</strong></p>
													</div>
												</td>
											</tr>

										</table>

									</td>
								</tr>
							</table>

						</td>
					</tr>
				</table>

				
				<!-- 2 Columns -->
				<table style="direction: ltr;" width="100%" border="0" cellspacing="0" cellpadding="0" data-module="2Col txt_left">
					<tr>
						<td bgcolor="#F3F3F5">
							<table width="800" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF" align="center" class="scale">
								<tr>
									<td>
										
													<table width="720" border="0" cellspacing="0" cellpadding="0" align="center" class="reset" bgcolor="#EFEFF1">
														<tr>
															<td align="center" class="scale-center-bottom">
																<img src="{{ URL::asset('resources/assets/emails/globe-icon.png') }}" border="0" class="reset" width="32" data-crop="false" style="padding-top: 14px; padding-bottom: 14px;">
															</td>
															<td>
																For more information please visit our website<br />
																<span style="color:#00bdbc">
																	www.propertystays.com
																</span>
																</td>
														</tr>
													</table>
												
									</td>
								</tr>
							</table>

						</td>
					</tr>
				</table>
			
				<!-- Footer -->
				<table width="100%" border="0" cellspacing="0" cellpadding="0" data-module="Footer">
					<tr>
						<td bgcolor="#F3F3F5">

							<table  width="800" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF" align="center" class="scale">
								<tr> 
									<td>

										<table width="720" border="0" cellspacing="0" cellpadding="0" align="center" class="scale" style="border-top: 1px solid #D8D8D8!important; margin-top: 28px; margin-bottom: 30px;">
											<tr>
												<td height="36">
													<p style="padding-top:20px; font-size: 10px; color:#707070;">Booking, reviews and advices on hotels, resorts, flights, vacation rentals, travel packages, and lots more!</p>
												</td>
											</tr>
										</table>

									</td>
								</tr>
							</table>

						</td>
					</tr>
				</table>
			
				
			

			</td>
		</tr>
	</table>
	
</body>
</html>
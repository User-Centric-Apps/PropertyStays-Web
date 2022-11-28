<!DOCTYPE html>
<html lang="en">
    <!-- Body-->
    <body style="color: #7D8082;">
        <table width="70%" border="0" align="center" style="padding: 1em 0;">
                <tr>
                    <td align="center" colspan="2">
                         <a class="navbar-brand d-none d-sm-block flex-shrink-0" href="https://propertystays.com">
                            <img src="https://propertystays.com/resources/assets/front-end/img/Propertystays-logo.svg" width="250" alt="propertystays">
                        </a>
                    </td>
                    
                </tr>
                @if($type == 1)
                <tr>
                    <td colspan="2"><h1 style="text-align:center;">Forget Password</h1></td>
                </tr>
                @else
                <tr>
                    <td colspan="2"><h1 style="text-align:center;">Registration</h1></td>
                </tr>
                @endif
                 <tr>
                    <td colspan="2">&nbsp;</td>
                </tr>
                <tr>
                    <td colspan="2" align="center">
                        <h4>Hello, <strong style=" color: #00bdbc;">{{ $name }}</strong></h4>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" align="center">
                        <h4>Username/Email: <strong style=" color: #00bdbc;">{{ $email }}</strong></h4>
                    </td>
                </tr>
                 <tr>
                    <td colspan="2">&nbsp;</td>
                </tr>
                <tr>
                    <td colspan="2" align="center">
                        <h4>Password: <strong style=" color: #00bdbc;">{{ $password }}</strong></h4>
                    </td>
                </tr>
                 <tr>
                    <td colspan="2">&nbsp;</td>
                </tr>
                <tr>
                    <td colspan="2"><strong>Cancellation policy:</strong> </br>Strict
Cancel within 48 hours of booking and 14 days before check-in to get a full refund. Cancel up to 7 days before check in and get a 50% refund (minus service fees). Cancel within 7 days of your trip and the reservation is non-refundable.</td>
                </tr>
                  <tr>
                    <td colspan="2">&nbsp;</td>
                </tr>
                </table>
        <table width="100%" cellpadding="2" cellspacing="2" style="padding: 1em 0;">
                            <tr>
                                <td>
                                    <ul style="list-style-type: none; color: #fff; margin: 0; padding: 0;">
                                        <li style=" padding-bottom: 10px;">
                                            <a style=" color: #00bdbc; text-decoration: none;" href="https://propertystays.com/about-us">About Us</a>
                                        </li>
                                        <li style=" padding-bottom: 10px;">
                                            <a style=" color: #00bdbc; text-decoration: none;" href="https://propertystays.com/all-destinations">All Destinations</a>
                                        </li>
                                        <li style=" padding-bottom: 10px;">
                                            <a style=" color: #00bdbc; text-decoration: none;" href="https://propertystays.com/contact-us">Contact us</a>
                                        </li>

                                    </ul>
                                </td>
                                <td align="right">
                                    <ul style="list-style-type: none; color: #fff; margin: 0; padding: 0;">
                                       
                                       <li style=" padding-bottom: 10px;">
                                            <a style=" color: #00bdbc; text-decoration: none;" href="https://propertystays.com/hosting-help">Hosting Help</a>
                                        </li>
                                       <li style=" padding-bottom: 10px;">
                                            <a style=" color: #00bdbc; text-decoration: none;" href="https://propertystays.com/privacy-policy">Privacy Policy</a>
                                        </li>
                                       <li style=" padding-bottom: 10px;">
                                            <a style=" color: #00bdbc; text-decoration: none;" href="https://propertystays.com/terms-and-conditions">Terms and Conditions</a>
                                        </li>

                                    </ul>
                                </td>
                            </tr>
                             <tr>
                                <td colspan="2">&nbsp;</td>
                            </tr>
                            <tr>
                                <td colspan="2" align="center"> © All rights reserved.</td>
                            </tr>
                        </table>
    </body>
</html>
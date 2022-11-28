@extends('layouts.master')

@section('title')

Confirmation

@endsection


@section('script')

<style type="text/css">
  .hide{
    display: none;
  }
</style>

@endsection



@section('content')

      <div class="container mb-5 pb-3">

<table width="70%" border="0" align="center" style="padding: 1em 0;">
                <tr>
                    <td colspan="2"><h1 style="text-align:center; margin-top:70px; margin-bottom: 70px;">Your booking is confirmed</h1></td>
                </tr>
                <tr>
                    <td width="50%"><h4>Dear <strong style=" color: #00bdbc;">{{ Auth::user()->name }}</strong>,</h4></td>
                    <td align="right"><h4>Order code: <strong style=" color: #00bdbc;"># {{ $order_id }}</strong></h4></td>
                </tr>
                        <tr>
                            <td colspan="2">&nbsp;</td>
                        </tr>
                        <?php $sfd = 0;?>
                @if(count($orderList) > 0)
                    @foreach($orderList as $item)
                        <tr>
                            <td colspan="2">
                                <a href="{{ url('rental/'.$item->slug) }}" class="gallery-item">
                                    <img src="{{ URL::to('/') }}/storage/app/public/uploads/properties/{{ $item->image }}" width="100%" alt="{{ $item->title }}" style="border-radius: 10px;">
                                </a></td>
                            
                        </tr>
                        <tr>
                            <td colspan="2">&nbsp;</td>
                        </tr>
                        <tr>
                            <td colspan="2">{{ $item->title }}</td>
                        </tr>
                        <tr>
                            <td colspan="2">Hosted by: {{ $item->hostname }}</td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <table width="100%">
                                    <tr>
                                        <td align="left"><h2>{{ $item->check_in }}</h2></td>
                                        <td align="right"><h2>{{ $item->check_out }}</h2></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td>
                              <strong style="margin: 0; color: #7C7F81;">Address</strong>
                            </td>
                            <td>
                                {{ $item->area }}
                            </td>
                        </tr>
                         <tr>
                            <td>
                                <strong style="margin: 0; color: #7C7F81;">Guests</strong>
                            </td>
                            <td>
                                {{ $item->adults }} Adluts, {{ $item->children }} Children (Under 16), {{ $item->infant }} Infant (Under 3)
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">&nbsp;</td>
                        </tr>
                         <tr>
                            <td colspan="2">&nbsp;</td>
                        </tr>
                        <tr>
                            <td colspan="2"><h2 style="margin: 0; color: #00bdbc;">Price breakdown</h2></td>
                        </tr>
                        <tr>
                            <td colspan="2" align="right">
                                
                                <table width="100%">
                                    <tr>
                                        <td>£{{ $item->original_price }} x {{ $item->total_nights }} night</td>
                                        <td align="right">£{{ number_format($item->price,2) }} <?php $sfd = $sfd+$item->price; ?></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"><hr/></td>
                                    </tr>
                                    <!--<tr>
                                        <td><h3 style="margin: 0;">Total (GBP)</h3></td>
                                        <td style="margin: 0;" align="right"><h3 style="margin: 0;">£1,151.00</h3></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"><hr/></td>
                                    </tr>-->
                                </table>
                            </td>
                        </tr>
                         <tr>
                            <td colspan="2">&nbsp;</td>
                        </tr>
                    @endforeach    
                @endif
                <tr>
                    <td colspan="2"><h2 style="margin: 0; color: #00bdbc;">Payment</h2></td>
                </tr>
                <tr>
                    <td colspan="2" align="right">
                        
                        <table width="100%" cellpadding="0" cellspacing="0" border-collapse="collapse">
                            
                             
                            <tr>
                                <td><h3 style="margin: 0;">Amount Paid (GBP)</h3></td>
                                <td align="right"><h3 style="margin: 0;">£ {{ $sfd }}</h3></td>
                            </tr>

                            <tr>
                                <td>Service fee</td>
                                <td align="right">£ <?php echo ($settingApp->comission*$sfd)/100; ?></td>
                            </tr>
                             <tr>
                                <td colspan="2"><hr/></td>
                            </tr>
                        </table>
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
                 <tr>
                    <td colspan="2" style="background: #373f50; color: #fff; padding: 2em;">
                        <table width="100%" cellpadding="2" cellspacing="2">
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
                       
                    </td>
                </tr>

            </table>

          </div>

@endsection

@section('script_last')

<script src="{{ URL::asset('resources/assets/global/plugins/jquery.min.js') }}" type="text/javascript"></script>

  <script type="text/javascript">
    jQuery(document).ready(function()
    {  
  
    });
  </script>

@endsection
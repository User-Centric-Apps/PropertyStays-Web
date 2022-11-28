@extends('layouts.master')

@section('title')

Your Checkout

@endsection


@section('script')

<style type="text/css">
  .hide{
    display: none;
  }
</style>

@endsection



@section('content')

<!-- Page Title-->
      <div class="page-title-overlap bg-primary pt-4">
        <div class="container d-lg-flex justify-content-between py-2 py-lg-3">
          <div class="order-lg-2 mb-3 mb-lg-0 pt-lg-2">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb breadcrumb-light flex-lg-nowrap justify-content-center justify-content-lg-start">
                <li class="breadcrumb-item">
                  <a class="text-nowrap" href="{{ url('/') }}">
                    <i class="ci-home"></i>Home
                  </a>
                </li>
                <li class="breadcrumb-item text-nowrap active" aria-current="page">
                  <a class="text-nowrap" href="{{ url('cart') }}">
                    Cart
                  </a>
                </li>
                <li class="breadcrumb-item text-nowrap active" aria-current="page">Checkout</li>
              </ol>
            </nav>
          </div>
          <div class="order-lg-1 pe-lg-4 text-center text-lg-start">
            <h1 class="h3 text-light mb-0">Checkout</h1>
          </div>
        </div>
      </div>
      <div class="container mb-5 pb-3">
        <div class="bg-light shadow-lg rounded-3 overflow-hidden">
          <div class="row">
            <!-- Content-->
            <section class="col-lg-8 pt-2 pt-lg-4 pb-4 mb-3">

              

              <div class="pt-2 px-4 pe-lg-0 ps-xl-5">

                @if ($errors->any())
                  <div class="alert alert-danger">
                      <ul>
                          @foreach ($errors->all() as $error)
                              <li>{{ $error }}</li>
                          @endforeach
                      </ul>
                  </div>
              @endif
              @if(session('danger'))
              <div class="alert alert-danger">
                  {{ session('danger') }}
              </div>
              @endif

                <form role="form" action="{{ url('place-order') }}" method="post" class="validation" data-cc-on-file="false" data-stripe-publishable-key="{{ env('STRIPE_KEY') }}" id="payment-form">
                        @csrf
                <!-- Title-->
                <h2 class="h6 border-bottom pb-3 mb-3">Billing details</h2>
                <!-- Billing detail-->
                <div class="row pb-4 gx-4 gy-3">
                  <div class="col-sm-6">
                    <label class="form-label" for="name">
                      Name <span class='text-danger'>*</span>
                    </label>
                    <input class="form-control" type="text" value="{{ Auth::user()->name }}" name="billing_name" id="billing_name">
                  </div>
                  <div class="col-sm-6">
                    <label class="form-label" for="mobile">
                      Mobile <span class='text-danger'>*</span>
                    </label>
                    <input class="form-control" type="tel" value="{{ Auth::user()->mobile }}" name="billing_phone" id="billing_phone">
                  </div>
                  <div class="col-12">
                    <label class="form-label" for="email">
                      Email address <span class='text-danger'>*</span>
                    </label>
                    <input class="form-control" type="email" value="{{ Auth::user()->email }}" id="billing_email" name="billing_email">
                  </div>
                </div>
                <!-- Order preview on mobile (screens small than 991px)-->
                <div class="widget mb-3 d-lg-none">
                  <h2 class="widget-title">Order summary</h2>
                  @if(Cart::count() > 0)
                    @foreach(Cart::content() as $cartItem)
                      <div class="d-flex align-items-center pb-2 border-bottom">
                        <a class="d-block flex-shrink-0 me-2" href="#">
                          @if($cartItem->options->type == 1)
                            <img class="rounded-1" src="{{ URL::asset('storage/app/public/uploads/properties/'.$cartItem->options->image) }}" width="64" alt="Product">
                          @else
                            <img class="rounded-1" src="{{ URL::asset('storage/app/public/uploads/tours/'.$cartItem->options->image) }}" width="64" alt="Tour">
                          @endif
                          
                        </a>
                        <div class="ps-1">
                          <h6 class="widget-product-title">
                            <a href="#">
                              {{ $cartItem->name }}
                            </a>
                          </h6>
                          @if($cartItem->options->type == 1)
                            <div class="widget-product-meta">
                              <span class="text-accent border-end pe-2 me-2">
                                {{ ($cartItem->options->has('adultsprice') ? $cartItem->options->adultsprice : '') }} x {{ ($cartItem->options->has('adults') ? $cartItem->options->adults : '') }}
                              </span>
                              <span class="fs-xs text-muted">
                                {{ ($cartItem->options->has('total_nights') ? $cartItem->options->total_nights : '') }} Nights
                              </span>
                            </div>
                          @else
                            <div class="widget-product-meta">
                              <span class="text-accent border-end pe-2 me-2">
                                {{ ($cartItem->options->has('check_in') ? $cartItem->options->check_in : '') }}
                              </span>
                              <span class="fs-xs text-muted">
                                {{ ($cartItem->options->has('adults') ? $cartItem->options->adults : '') }} Adults and more...
                              </span>
                            </div>
                          @endif  
                        </div>
                      </div>
                    @endforeach
                  @endif
                  <?php 
                      $subtotal = floatval(implode(explode(',',Cart::subtotal())));
                      $tax = $settingApp->comission*$subtotal/100;
                      $total = $subtotal+$tax;

                  ?>
                  <ul class="list-unstyled fs-sm py-3">
                    <li class="d-flex justify-content-between align-items-center">
                      <span class="me-2">Subtotal:</span>
                      <span class="text-end">
                        {{ Session::get('currency') === 'gbp' ? '£' : '€' }} {{ $tax }} - {{ $subtotal }}
                      </span>
                    </li>
                    <li class="d-flex justify-content-between align-items-center coupon_discount_div" style="display: none;">
                      <span class="me-2">(-) Coupon Discount:</span>
                      <span class="text-end">
                        <span class="amount" id="coupon_discount"></span>
                        <input type="hidden" name="total_bill_before_coupon" id="total_bill_before_coupon" value="">
                      </span>
                    </li>
                    <li class="d-flex justify-content-between align-items-center">
                      <span class="me-2">PS fee:</span>
                      {{ Session::get('currency') === 'gbp' ? '£' : '€' }} <span class="text-end" id="tax">{{ $tax }}</span>
                      <input type="hidden" name="tax_input" id="tax_input" value="{{ $tax }}">
                    </li>
                    <li class="d-flex justify-content-between align-items-center fs-base">
                      <span class="me-2">Total:</span>
                      {{ Session::get('currency') === 'gbp' ? '£' : '€' }} <span class="text-end" id="total">
                          {{ $total }}
                        </span>
                      <input type="hidden" name="payment_method" id="payment_method" value="cash">
                      <input type="hidden" name="paid_bill" id="paid_bill" value="{{ $total }}">

                    </li>
                  </ul>
                </div>
                <input type="hidden" name="coupon_field_id" id="coupon_field_id" value="">
                <!-- Payment methods accordion-->
                <div class="accordion mb-2" id="payment-method" role="tablist">
                  <div class="accordion-item">
                    <h3 class="accordion-header"><a class="accordion-button" href="#card" data-bs-toggle="collapse"><i class="ci-card fs-lg me-2 mt-n1 align-middle"></i>Pay with Credit Card</a></h3>
                    <div class="accordion-collapse collapse show" id="card" data-bs-parent="#payment-method" role="tabpanel">
                      <div class="accordion-body">
                        <p class="fs-sm">We accept following credit cards:&nbsp;&nbsp;<img class="d-inline-block align-middle" src="{{ URL::asset('resources/assets/front-end/img/cards.png') }}" style="width: 187px;" alt="Cerdit Cards"></p>
                        <div class="credit-card-wrapper"></div>
                        <div class="credit-card-form row g-3">
                          <div class="col-sm-6">
                            <input class="form-control card-num" autocomplete='off' type="text" name="number" placeholder="Card Number" required size='20'>
                          </div>
                          <div class="col-sm-6">
                            <input class="form-control" type="text" name="name" placeholder="Full Name" required>
                          </div>
                          <div class="col-sm-3">
                            <input class="form-control card-expiry" autocomplete='off' type="text" name="expiry" placeholder='ex. MM/YYYY' size='7' limit="7" required>
                          </div>
                          <div class="col-sm-3">
                            <input class="form-control card-cvc" type="text" name="cvc" autocomplete='off' placeholder='ex. 311' size='3' required>
                          </div>
                          <div class="col-sm-6">
                                <div class="g-recaptcha" data-sitekey="{{ env('GOOGLE_RECAPTCHA_KEY') }}"></div>
                                @if ($errors->has('g-recaptcha-response'))
                                    <span class="text-danger">{{ $errors->first('g-recaptcha-response') }}</span>
                                @endif
                        </div>
                          <div class="col-sm-6">
                            <button class="btn btn-primary d-block w-100" type="submit">Place order</button>
                          </div>
                          <div class='col-sm-12 hide error form-group'>
                                <div class='alert-danger alert'>Fix the errors before you begin.</div>
                            </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
          </form>
              </div>
            </section>
            <!-- Sidebar-->
            <!-- Order preview on desktop (screens larger than 991px)-->
            <aside class="col-lg-4 d-none d-lg-block ps-xl-5">
              <hr class="d-lg-none">
              <div class="p-4 h-100 ms-auto border-start">
                <div class="widget px-lg-2 py-2 mb-3">
                  <h2 class="widget-title text-center">Order summary</h2>
                  @if(Cart::count() > 0)
                    @foreach(Cart::content() as $cartItem)
                      <div class="d-flex align-items-center pb-2 border-bottom">
                        <a class="d-block flex-shrink-0 me-2" href="#">
                          @if($cartItem->options->type == 1)
                            <img class="rounded-1" src="{{ URL::asset('storage/app/public/uploads/properties/'.$cartItem->options->image) }}" width="64" alt="Product">
                          @else
                            <img class="rounded-1" src="{{ URL::asset('storage/app/public/uploads/tours/'.$cartItem->options->image) }}" width="64" alt="Tour">
                          @endif
                        </a>
                        <div class="ps-1">
                          <h6 class="widget-product-title">
                            <a href="#">
                              {{ Str::limit($cartItem->name, 20) }}
                            </a>
                          </h6>
                          @if($cartItem->options->type == 1)
                            <div class="widget-product-meta">
                              <span class="text-accent border-end pe-2 me-2">
                                {{ ($cartItem->options->has('adultsprice') ? $cartItem->options->adultsprice : '') }} x {{ ($cartItem->options->has('adults') ? $cartItem->options->adults : '') }}
                              </span>
                              <span class="fs-xs text-muted">
                                {{ ($cartItem->options->has('total_nights') ? $cartItem->options->total_nights : '') }} Nights
                              </span>
                            </div>
                          @else
                            <div class="widget-product-meta">
                              <span class="text-accent border-end pe-2 me-2">
                                {{ ($cartItem->options->has('check_in') ? $cartItem->options->check_in : '') }}
                              </span>
                              <span class="fs-xs text-muted">
                                {{ ($cartItem->options->has('adults') ? $cartItem->options->adults : '') }} Adults and more...
                              </span>
                            </div>
                          @endif  
                        </div>
                      </div>
                    @endforeach
                  @endif
                  <?php 

                      $subtotal = floatval(implode(explode(',',Cart::subtotal())));
                      $tax = ($settingApp->comission*$subtotal)/100;
                      $total = $subtotal+$tax;

                  ?>
                  <!--<div class="text-center mt-4 mb-4 pb-3 border-bottom">
                    <h2 class="h6 mb-3 pb-1">Promo code</h2>
                      <div id="coupon_status"></div>
                    <form class="needs-validation pb-2" method="post" novalidate>
                      <div class="mb-3">
                        <input class="form-control" type="text" placeholder="Promo code" id="coupon_code" name="coupon_code" required>
                        <div class="invalid-feedback">Please provide promo code.</div>
                      </div>
                      <button class="btn btn-secondary d-block w-100" type="button" id="coupon_btn">Apply promo code</button>
                    </form>
                  </div>-->
                  <ul class="list-unstyled fs-sm py-3">
                    <li class="d-flex justify-content-between align-items-center">
                      <span class="me-2">Subtotal:</span>
                      <span class="text-end">
                        {{ Session::get('currency') === 'gbp' ? '£' : '€' }} {{ $subtotal }}
                      </span>
                    </li>
                    <li class="d-flex justify-content-between align-items-center">
                      <span class="me-2">PS fee:</span>
                      <span class="text-end">£ <span  id="tax">{{ $tax }}</span></span>
                      <input type="hidden" name="tax_input" id="tax_input" value="{{ $tax }}">
                    </li>
                    <li class="justify-content-between align-items-center coupon_discount_div" style="display: none;">
                      <span class="me-2">(-) Coupon Discount:</span>
                      <span class="text-end">
                        <span class="amount" id="coupon_discount"></span>
                        <input type="hidden" name="total_bill_before_coupon" id="total_bill_before_coupon" value="">
                      </span>
                    </li>
                  </ul>
                  <h3 class="fw-normal text-center my-4">
                    {{ Session::get('currency') === 'gbp' ? '£' : '€' }} <span id="total">{{ $total }}</span>
                  </h3>
                  <input type="hidden" name="paid_bill" id="paid_bill" value="{{ $total }}">
                      <input type="hidden" name="payment_method" id="payment_method" value="cash">
                </div>
              </div>
            </aside>
          </div>
        </div>
      </div>

@endsection

@section('script_last')
<script src='https://www.google.com/recaptcha/api.js'></script>

<script src="{{ URL::asset('resources/assets/global/plugins/jquery.min.js') }}" type="text/javascript"></script>

  <script src="{{ URL::asset('resources/assets/front-end/vendor/card/dist/card.js') }}"></script> 

  <script type="text/javascript">
    jQuery(document).ready(function()
    {        
        jQuery('#coupon_btn').click(function(){
            var coupon_id = jQuery('#coupon_code').val();
            var subtotal = "{{ $subtotal }}";
            var total = "{{ $total }}";
            var tax = "{{ $tax }}";
            jQuery.ajax({
                url:'{{url('/checkCoupon')}}',
                dataType: "json",
                data: {code: coupon_id},
                success:function(res){
                    if(res.error)
                    {
                        jQuery('#coupon_status').html(res.error);
                        jQuery('.coupon_discount_div').hide();
                        jQuery('#total').html(total);
                    } 
                    else 
                    {
                        //Calculation
                        let subTotal = parseFloat(subtotal - res.discount_price);
                        let paid_bill = parseFloat(total - res.discount_price + tax);
                        let vatTotal = parseFloat(subTotal/100*5);
                        jQuery('#total').html(paid_bill);
                        jQuery('#tax').html(vatTotal);

                        jQuery('#total_bill_before_coupon').html(total);
                        jQuery('#paid_bill').val(paid_bill);
                        jQuery('#tax_input').val(taxTotal);
                        jQuery('#coupon_field_id').val(res.coupon_id);

                        //Calculation
                        jQuery('#coupon_status').html(res.msg);
                        jQuery('#coupon_discount').html(res.discount_price);
                        jQuery('.coupon_discount_div').show();

                        //Disable the buttons
                        jQuery( "#coupon_code" ).prop( "disabled", true );
                        jQuery( "#coupon_btn" ).prop( "disabled", true );
                    }

                }
            })
        });
    });
  </script> 
 <script type="text/javascript" src="https://js.stripe.com/v2/"></script>
   <script type="text/javascript">
      $(function() {
    var $form         = $(".validation");
  $('form.validation').bind('submit', function(e) {
    var $form         = $(".validation"),
        inputVal = ['input[type=email]', 'input[type=password]',
                         'input[type=text]', 'input[type=file]',
                         'textarea'].join(', '),
        $inputs       = $form.find('.required').find(inputVal),
        $errorStatus = $form.find('div.error'),
        valid         = true;
        $errorStatus.addClass('hide');
 
        $('.has-error').removeClass('has-error');
    $inputs.each(function(i, el) {
      var $input = $(el);
      if ($input.val() === '') {
        $input.parent().addClass('has-error');
        $errorStatus.removeClass('hide');
        e.preventDefault();
      }
    });
  
    if (!$form.data('cc-on-file')) {
      e.preventDefault();
      Stripe.setPublishableKey($form.data('stripe-publishable-key'));
      
      var expirys = $('.card-expiry').val();
      var exp_months = expirys.slice(0, 2);
      var exp_years = expirys.slice(5, 9);

      Stripe.createToken({
        number: $('.card-num').val(),
        cvc: $('.card-cvc').val(),
        exp_month: exp_months,
        exp_year: exp_years
      }, stripeHandleResponse);
    }
  
  });
  
  function stripeHandleResponse(status, response) {
        if (response.error) {
            $('.error')
                .removeClass('hide')
                .find('.alert')
                .text(response.error.message);
        } else {
            var token = response['id'];
            $form.find('input[type=text]').empty();
            $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
            $form.get(0).submit();
        }
    }
  
});
   </script>

@endsection
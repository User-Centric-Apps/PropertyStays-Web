<!-- Footer-->
<footer class="footer bg-dark pt-5">
  <div class="container">
    <div class="row pb-2">
      <div class="col-md-4 col-sm-6">
        <div class="widget widget-links widget-light pb-2 mb-4">
          <h3 class="widget-title text-light">PropertyStays</h3>
          <ul class="widget-list">
            <?php $otherMenu = getOtherMenu(); ?>
            @foreach($otherMenu as $item)
            <li class="menu-item ">
              <a href="{{ url('/'.$item->slug) }}">{{ $item->title }}</a>
            </li>
            @endforeach
          </ul>

        </div>
      </div>
      <div class="col-md-4 col-sm-6">
        <div class="widget widget-links widget-light pb-2 mb-4">
          <h3 class="widget-title text-light">Traveller</h3>
          <ul class="widget-list">
            <?php $getTra = getTravellerCat(); ?>
            @foreach($getTra as $item)
            <li class="menu-item ">
              <a href="{{ url('traveling-help/sub-category/'.$item->slug) }}">{{ $item->name }}</a>
            </li>
            @endforeach
          </ul>
        </div>
        <div class="widget widget-links widget-light pb-2 mb-4">
          <h3 class="widget-title text-light">Host</h3>
          <ul class="widget-list">
            <?php $getHost = getHostCat(); ?>
            @foreach($getHost as $item)
            <li class="menu-item ">
              <a href="{{ url('hosting-help/sub-category/'.$item->slug) }}">{{ $item->name }}</a>
            </li>
            @endforeach
        </ul>
        </div>
      </div>
      <div class="col-md-4">
        <div class="widget pb-2 mb-4">
          <h3 class="widget-title text-light pb-1">Stay informed</h3>
          <form class="subscription-form validate" action="https://propertystays.us20.list-manage.com/subscribe/post?u=9542aa21cb7797632edc19e1e&amp;id=731c895c7f" method="post" name="mc-embedded-subscribe-form" target="_blank" novalidate>
            <div class="subscription-status"></div>
            <div class="input-group flex-nowrap"><i class="ci-mail position-absolute top-50 translate-middle-y text-muted fs-base ms-3"></i>
              <input class="form-control rounded-start" type="email" name="EMAIL" placeholder="Your email" required>
              <button class="btn btn-primary" type="submit" name="subscribe">Subscribe*</button>
            </div>
            <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
            <div style="position: absolute; left: -5000px;" aria-hidden="true">
              <input class="subscription-form-antispam" type="text" name="b_c7103e2c981361a6639545bd5_29ca296126" tabindex="-1">
            </div>
            <div class="form-text text-light opacity-50">*Subscribe to our newsletter to receive early discount offers, updates and new products info.</div>
          </form>
        </div>
        <div class="widget pb-2 mb-4">
          <h3 class="widget-title text-light pb-1">Download our app</h3>
          <div class="d-flex flex-wrap">
            <div class="me-2 mb-2"><a class="btn-market btn-apple" href="https://www.apple.com/itunes/?cid=OAS-US-DOMAINS-itunes.com" target="_blank" role="button"><span class="btn-market-subtitle">Download on the</span><span class="btn-market-title">App Store</span></a></div>
            <div class="mb-2"><a class="btn-market btn-google" href="https://play.google.com/" target="_blank" role="button"><span class="btn-market-subtitle">Download on the</span><span class="btn-market-title">Google Play</span></a></div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="pt-5 bg-darker">
    <div class="container">
      <div class="row pb-3">
        <div class="col-md-3 col-sm-6 mb-4">
          <div class="d-flex"><i class="ci-rocket text-primary" style="font-size: 2.25rem;"></i>
            <div class="ps-3">
              <h6 class="fs-base text-light mb-1">Fast & secure</h6>
              <p class="mb-0 fs-ms text-light opacity-50">Our hosts are decated to provding you the best service available</p>
            </div>
          </div>
        </div>
        <div class="col-md-3 col-sm-6 mb-4">
          <div class="d-flex"><i class="ci-currency-exchange text-primary" style="font-size: 2.25rem;"></i>
            <div class="ps-3">
              <h6 class="fs-base text-light mb-1">Satisfaction guarantee</h6>
              <p class="mb-0 fs-ms text-light opacity-50">We return money within 30 days</p>
            </div>
          </div>
        </div>
        <div class="col-md-3 col-sm-6 mb-4">
          <div class="d-flex"><i class="ci-support text-primary" style="font-size: 2.25rem;"></i>
            <div class="ps-3">
              <h6 class="fs-base text-light mb-1">24/7 customer support</h6>
              <p class="mb-0 fs-ms text-light opacity-50">Friendly 24/7 customer support</p>
            </div>
          </div>
        </div>
        <div class="col-md-3 col-sm-6 mb-4">
          <div class="d-flex"><i class="ci-card text-primary" style="font-size: 2.25rem;"></i>
            <div class="ps-3">
              <h6 class="fs-base text-light mb-1">Secure online payment</h6>
              <p class="mb-0 fs-ms text-light opacity-50">We possess SSL / Secure сertificate</p>
            </div>
          </div>
        </div>
      </div>
      <hr class="hr-light mb-5">
      <div class="row pb-2">
        <div class="col-md-6 text-center text-md-start mb-4">
          <div class="text-nowrap mb-4"><a class="d-inline-block align-middle mt-n1 me-3" href="#"><img class="d-block" src="{{ URL::asset('resources/assets/front-end/img/Propertystays-logo.svg') }}" width="250" alt="propertystays"></a>
            
          </div>
         
        </div>
        <div class="col-md-6 text-center text-md-end mb-4">
          <div class="mb-3">
            <a class="btn-social bs-light bs-twitter ms-2 mb-2" href="https://twitter.com/propertystays" target="_blank">
              <i class="ci-twitter"></i>
            </a>
            <a class="btn-social bs-light bs-facebook ms-2 mb-2" href="https://www.facebook.com/propertystayscom/" target="_blank">
              <i class="ci-facebook"></i>
            </a>
            <a class="btn-social bs-light bs-instagram ms-2 mb-2" href="https://instagram.com/propertystays.com7" target="_blank">
              <i class="ci-instagram"></i>
            </a>
            <a class="btn-social bs-light bs-pinterest ms-2 mb-2" href="https://www.pinterest.com/propertystays/" target="_blank">
              <i class="ci-pinterest"></i>
            </a></div><img class="d-inline-block" src="{{ URL::asset('resources/assets/front-end/img/cards-alt.png') }}" width="187" alt="Payment methods">
        </div>
      </div>
      <div class="pb-4 fs-xs text-light opacity-50 text-center text-md-start">© All rights reserved. Made by <a class="text-light" href="https://www.propertystays.com" target="_blank" rel="noopener">PropertyStays</a></div>
    </div>
  </div>
</footer>
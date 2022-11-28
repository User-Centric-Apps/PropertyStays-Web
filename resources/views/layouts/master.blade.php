<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>@yield('title') | PropertyStays &#8211; Lets plan your trip</title>
    <!-- SEO Meta Tags-->
    <meta name="description" content="PropertyStays - Lets plan your trip">
    <meta name="keywords" content="Booking,reviews, advice, resorts, flights, vacation rentals, travel packages, and lots more!"/>
    <meta name="author" content="Syed - Digital Hub Dubai">
    <!-- Viewport-->
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1, maximum-scale=2, minimum-scale=1" />
    <!-- Favicon and Touch Icons-->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ URL::asset('resources/assets/front-end/img/proertystays-favico.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ URL::asset('resources/assets/front-end/img/proertystays-favico.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ URL::asset('resources/assets/front-end/img/proertystays-favico.png') }}">
    <link rel="mask-icon" color="#fe6a6a" href="safari-pinned-tab.svg">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="theme-color" content="#ffffff">
    <!-- Vendor Styles including: Font Icons, Plugins, etc.-->
    <link rel="stylesheet" media="screen" href="{{ URL::asset('resources/assets/front-end/vendor/simplebar/dist/simplebar.min.css') }}"/>
    <link rel="stylesheet" media="screen" href="{{ URL::asset('resources/assets/front-end/vendor/tiny-slider/dist/tiny-slider.css') }}"/>
    <!-- Main Theme Styles + Bootstrap-->
    <link rel="stylesheet" media="screen" href="{{ URL::asset('resources/assets/front-end/css/theme.css?sw=1') }}">


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" />

    <script type="text/javascript"> var base_url = "{{ URL::to('/') }}"; </script>
    <style type="text/css">
      .subscription-form .status-error
      {
        
      }
      .subscription-form .status-success
      {
        background-color: #00bdbc;
        color: #fff;
        MARGIN-BOTTOM: 2PX;
      }

      #cookiePopup {
    background: white;
    width: 25%;
    position: fixed;
    right: 10px;
    bottom: 20px;
    box-shadow: 0px 0px 15px #cccccc;
    padding: 5px 10px;
    display: none;
    border-radius: 5px;
    padding-top: 14px;
    padding-bottom: 14px;
  }
    #cookiePopup p{
    text-align: left;
    font-size: 15px;
    color: #4e4e4e;
  }

    </style>
    @yield('script')
  </head>
  <!-- Body-->
  <body class="handheld-toolbar-enabled">
    <!-- Sign in / sign up modal-->
    <div class="modal fade" id="signin-modal" tabindex="-1" role="dialog">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header bg-secondary">
            <ul class="nav nav-tabs card-header-tabs" role="tablist">
              <li class="nav-item"><a class="nav-link fw-medium active" href="#signin-tab" data-bs-toggle="tab" role="tab" aria-selected="true"><i class="ci-unlocked me-2 mt-n1"></i>Sign in</a></li>
              <li class="nav-item"><a class="nav-link fw-medium" href="#signup-tab" data-bs-toggle="tab" role="tab" aria-selected="false"><i class="ci-user-circle me-2 mt-n1"></i>Sign up</a></li>
            </ul>
            <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body tab-content py-4">
            <form class="needs-validation tab-pane fade show active" autocomplete="off" novalidate id="signin-tab">
              <div class="mb-3">
                <label class="form-label" for="si-email">Email address</label>
                <input class="form-control" type="email" id="si-email" placeholder="johndoe@example.com" required>
                <div class="invalid-feedback">Please provide a valid email address.</div>
              </div>
              <div class="mb-3">
                <label class="form-label" for="si-password">Password</label>
                <div class="password-toggle">
                  <input class="form-control" type="password" id="si-password" required>
                  <label class="password-toggle-btn" aria-label="Show/hide password">
                    <input class="password-toggle-check" type="checkbox"><span class="password-toggle-indicator"></span>
                  </label>
                </div>
              </div>
              <div class="mb-3 d-flex flex-wrap justify-content-between">
                <div class="form-check mb-2">
                  <input class="form-check-input" type="checkbox" id="si-remember">
                  <label class="form-check-label" for="si-remember">Remember me</label>
                </div><a class="fs-sm" href="#">Forgot password?</a>
              </div>
              <button class="btn btn-primary btn-shadow d-block w-100" type="submit">Sign in</button>
            </form>
            <form class="needs-validation tab-pane fade" autocomplete="off" novalidate id="signup-tab">
              <div class="mb-3">
                <label class="form-label" for="su-name">Full name</label>
                <input class="form-control" type="text" id="su-name" placeholder="John Doe" required>
                <div class="invalid-feedback">Please fill in your name.</div>
              </div>
              <div class="mb-3">
                <label for="su-email">Email address</label>
                <input class="form-control" type="email" id="su-email" placeholder="johndoe@example.com" required>
                <div class="invalid-feedback">Please provide a valid email address.</div>
              </div>
              <div class="mb-3">
                <label class="form-label" for="su-password">Password</label>
                <div class="password-toggle">
                  <input class="form-control" type="password" id="su-password" required>
                  <label class="password-toggle-btn" aria-label="Show/hide password">
                    <input class="password-toggle-check" type="checkbox"><span class="password-toggle-indicator"></span>
                  </label>
                </div>
              </div>
              <div class="mb-3">
                <label class="form-label" for="su-password-confirm">Confirm password</label>
                <div class="password-toggle">
                  <input class="form-control" type="password" id="su-password-confirm" required>
                  <label class="password-toggle-btn" aria-label="Show/hide password">
                    <input class="password-toggle-check" type="checkbox"><span class="password-toggle-indicator"></span>
                  </label>
                </div>
              </div>
              <button class="btn btn-primary btn-shadow d-block w-100" type="submit">Sign up</button>
            </form>
          </div>
        </div>
      </div>
    </div>

    <main class="page-wrapper">

        <header class="shadow-sm">

            @include('layouts.header')

        </header>


        @yield('content')


        @include('layouts.footer')

        <!-- Toolbar for handheld devices (Default)-->
        <div class="handheld-toolbar">
            <div class="d-table table-layout-fixed w-100">
                <a class="d-table-cell handheld-toolbar-item {{ (Request::is('/'))? 'active' : ''}}" href="{{ url('/') }}">
                    <span class="handheld-toolbar-icon">
                        <i class="ci-search"></i>
                    </span>
                    <span class="handheld-toolbar-label">Expore</span>
                </a>
                <!--a class="d-table-cell handheld-toolbar-item" href="javascript:void(0)" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" onclick="window.scrollTo(0, 0)">
                    <span class="handheld-toolbar-icon">
                        <i class="ci-menu"></i>
                    </span>
                    <span class="handheld-toolbar-label">Menu</span>
                </a-->
                <a class="d-table-cell handheld-toolbar-item {{ (Request::is('my-wishlist'))? 'active' : ''}}" href="{{ url('my-wishlist') }}">
                    <span class="handheld-toolbar-icon">
                        <i class="ci-heart"></i>
                    </span>
                    <span class="handheld-toolbar-label">Wishlist</span>
                </a>
                <a class="d-table-cell handheld-toolbar-item {{ (Request::is('search'))? 'active' : ''}}" href="{{ url('search') }}">
                    <span class="handheld-toolbar-icon">
                        <i class="ci-briefcase"></i>
                    </span>
                    <span class="handheld-toolbar-label">Trips</span>
                </a>
                <a class="d-table-cell handheld-toolbar-item {{ (Request::is('host/inbox'))? 'active' : ''}}" href="{{ url('host/inbox') }}">
                    <span class="handheld-toolbar-icon">
                        <i class="ci-message"></i>
                    </span><span class="handheld-toolbar-label">Inbox</span>
                </a>
                <a class="d-table-cell handheld-toolbar-item {{ (Request::is('login'))? 'active' : ''}}" href="{{ url('login') }}">
                    <span class="handheld-toolbar-icon">
                        <i class="ci-user-circle"></i>
                    </span>
                    <span class="handheld-toolbar-label">Login</span>
                </a>
            </div>
        </div>
        <a class="btn-scroll-top" href="#top" data-scroll>
            <span class="btn-scroll-top-tooltip text-muted fs-sm me-2">Top</span>
            <i class="btn-scroll-top-icon ci-arrow-up"></i>
        </a>

        <div id="cookiePopup">
  <h6>PropertyStays.com uses cookies </h6>
  <p>Our website uses cookies to provide your browsing experience and relavent informations.Before continuing to use our website, you agree & accept of our  <a href="{{ url('privacy-policy') }}">Privacy Policy</a></p>
 <button class="btn btn-primary" style="width:100%" id="acceptCookie">Accept</button> 
</div>

    </main>

    <!-- Vendor scrits: js libraries and plugins-->
    <script src="{{ URL::asset('resources/assets/front-end/vendor/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ URL::asset('resources/assets/front-end/vendor/simplebar/dist/simplebar.min.js') }}"></script>
    <script src="{{ URL::asset('resources/assets/front-end/vendor/tiny-slider/dist/min/tiny-slider.js') }}"></script>
    <script src="{{ URL::asset('resources/assets/front-end/vendor/smooth-scroll/dist/smooth-scroll.polyfills.min.js') }}"></script>
    <script src="{{ URL::asset('resources/assets/front-end/vendor/lightgallery.js/dist/js/lightgallery.min.js') }}"></script>
    <script src="{{ URL::asset('resources/assets/front-end/vendor/lg-fullscreen.js/dist/lg-fullscreen.min.js') }}"></script>
    <script src="{{ URL::asset('resources/assets/front-end/vendor/lg-zoom.js/dist/lg-zoom.min.js') }}"></script>

    @yield('script_last')
    <!-- Main theme script-->
    <script src="{{ URL::asset('resources/assets/front-end/js/theme.min.js') }}"></script>

    <script type="text/javascript">
// set cookie according to you
var cookieName= "CodingStatus";
var cookieValue="Coding Tutorials";
var cookieExpireDays= 30;
// when users click accept button
let acceptCookie= document.getElementById("acceptCookie");
acceptCookie.onclick= function(){
    createCookie(cookieName, cookieValue, cookieExpireDays);
}
// function to set cookie in web browser
 let createCookie= function(cookieName, cookieValue, cookieExpireDays){
  let currentDate = new Date();
  currentDate.setTime(currentDate.getTime() + (cookieExpireDays*24*60*60*1000));
  let expires = "expires=" + currentDate.toGMTString();
  document.cookie = cookieName + "=" + cookieValue + ";" + expires + ";path=/";
  if(document.cookie){
    document.getElementById("cookiePopup").style.display = "none";
  }else{
    alert("Unable to set cookie. Please allow all cookies site from cookie setting of your browser");
  }
 }
// get cookie from the web browser
let getCookie= function(cookieName){
  let name = cookieName + "=";
  let decodedCookie = decodeURIComponent(document.cookie);
  let ca = decodedCookie.split(';');
  for(let i = 0; i < ca.length; i++) {
    let c = ca[i];
    while (c.charAt(0) == ' ') {
      c = c.substring(1);
    }
    if (c.indexOf(name) == 0) {
      return c.substring(name.length, c.length);
    }
  }
  return "";
}
// check cookie is set or not
let checkCookie= function(){
    let check=getCookie(cookieName);
    if(check==""){
        document.getElementById("cookiePopup").style.display = "block";
    }else{
        
        document.getElementById("cookiePopup").style.display = "none";
    }
}
checkCookie();
</script>

    </body>

</html>
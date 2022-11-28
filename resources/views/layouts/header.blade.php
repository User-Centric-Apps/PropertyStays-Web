<!-- Navbar 3 Level (Light)-->
      <header class="shadow-sm">
        <!-- Topbar-->
        <div class="topbar topbar-dark bg-primary">
            <div class="container">
                <div class="topbar-text dropdown d-md-none">
                    
                    <a class="dropdown-item" href="tel:00441283427889">
                        <i class="ci-support text-muted me-2"></i>(+44) (0)1283 427 889
                    </a>
                    
                </div>
                <div class="topbar-text text-nowrap d-none d-md-inline-block">
                    <i class="ci-support"></i>
                    <span class="text-muted me-1">Support</span>
                    <a class="topbar-link" href="tel:00441283427889">(+44) (0)1283 427 889</a>
                </div>
                <div class="tns-controls-static d-none d-md-block">
                    <a href="https://www.gov.uk/coronavirus" class="text-light" target="_blank">Get the latest on our COVID-19 response</a>                                
                </div>
                <div class="ms-3 text-nowrap">
                    <div class="topbar-text dropdown disable-autohide">
                        <a class="topbar-link dropdown-toggle" href="#" data-bs-toggle="dropdown">  {{ Session::get('currency') === 'gbp' ? '£' : '€' }} 
                          <span style="text-transform: uppercase;">
                            {{ Session::get('currency') }}
                          </span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <a class="dropdown-item pb-1" href="{{ url('currency/gbp') }}">
                                  £ GBP
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item pb-1" href="{{ url('currency/eur') }}">
                                  € EUR
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- Remove "navbar-sticky" class to make navigation bar scrollable with the page.-->
        <div class="navbar-sticky bg-light">
          <div class="navbar navbar-expand-lg navbar-light">
            <div class="container">
              <a class="navbar-brand d-none d-sm-block flex-shrink-0" href="{{ url('/') }}">
                  <img src="{{ URL::asset('resources/assets/front-end/img/Propertystays-logo.svg') }}" width="250" alt="propertystays">
              </a>
              <a class="navbar-brand d-sm-none flex-shrink-0 me-2" href="{{ url('/') }}">
                  
                  <img src="{{ URL::asset('resources/assets/front-end/img/proertystays-favico.png') }}" width="46" alt="propertystays">
              </a>
              <div class="navbar-toolbar d-flex flex-shrink-0 align-items-center">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <a class="navbar-tool navbar-stuck-toggler" href="#">
                    <span class="navbar-tool-tooltip">Expand menu</span>
                    <div class="navbar-tool-icon-box">
                        <i class="navbar-tool-icon ci-menu"></i>
                    </div>
                </a>
                <a class="navbar-tool d-none d-lg-flex" href="{{ url('my-wishlist') }}">
                    <span class="navbar-tool-tooltip">Wishlist</span>
                    <div class="navbar-tool-icon-box"><i class="navbar-tool-icon ci-heart"></i></div>
                </a>
                @if(Auth::check())
                  <div class="navbar-tool dropdown ms-2">
                    <a class="navbar-tool-icon-box border dropdown-toggle" href="{{ url('home') }}">
                      @if(Auth::user()->profile_pic)
                        <img src="{{ URL::to('/') }}/storage/app/public/uploads/customers/{{ isset(Auth::user()->profile_pic)?Auth::user()->profile_pic:'no-image.png' }}" width="32" alt="{{ Auth::user()->name }}">
                      @else
                        <img src="{{ URL::asset('resources/assets/front-end/img/home/PropertyStays-icon.png') }}" width="32" alt="{{ Auth::user()->name }}">
                      @endif
                    </a>
                    <a class="navbar-tool-text ms-n1" href="{{ url('home') }}">
                      <small>{{ Auth::user()->name }}</small>
                      @if(Session::get('user_type') == 1)
                        <span>Host</span>
                      @else
                        <span>Traveller</span>
                      @endif
                    </a>
                  <div class="dropdown-menu dropdown-menu-end">
                    <div style="min-width: 14rem;">
                      @if(Session::get('user_type') == 1)<!-- Host User -->
                        <h6 class="dropdown-header">Host Dashboard</h6>
                        <a class="dropdown-item d-flex align-items-center" href="{{ url('home') }}">
                          <i class="ci-settings opacity-60 me-2"></i>Dashboard
                        </a>
                        <a class="dropdown-item d-flex align-items-center" href="{{ url('host/your-earnings') }}">
                          <i class="ci-dollar opacity-60 me-2"></i>Your Earnings
                        </a>
                        <a class="dropdown-item d-flex align-items-center" href="{{ url('host/inbox') }}">
                          <i class="ci-message opacity-60 me-2"></i>My Inbox
                        </a>
                        <a class="dropdown-item d-flex align-items-center" href="{{ url('host/properties') }}">
                          <i class="ci-package opacity-60 me-2"></i>My Properties
                        </a>
                        <a class="dropdown-item d-flex align-items-center" href="{{ url('host/manage-property') }}">
                          <i class="ci-cloud-upload opacity-60 me-2"></i>Add New Property
                        </a>
                        <a class="dropdown-item d-flex align-items-center" href="{{ url('host/tours') }}">
                          <i class="ci-view-list opacity-60 me-2"></i>My Tours
                        </a>
                        <a class="dropdown-item d-flex align-items-center" href="{{ url('host/manage-tour') }}">
                          <i class="ci-add opacity-60 me-2"></i>Add New Tour
                        </a>
                        <div class="dropdown-divider"></div>

                        <a class="dropdown-item d-flex align-items-center" href="{{ url('host/traveller-account') }}">
                          <i class="ci-rocket opacity-60 me-2"></i>Change to Traveller Account
                        </a>

                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item d-flex align-items-center" href="{{ url('logout') }}">
                          <i class="ci-sign-out opacity-60 me-2"></i>Sign Out
                        </a>
                      @else
                        <h6 class="dropdown-header">Traveller Dashboard</h6>
                        <a class="dropdown-item d-flex align-items-center" href="{{ url('home') }}">
                          <i class="ci-settings opacity-60 me-2"></i>Dashboard
                        </a>
                        <a class="dropdown-item d-flex align-items-center" href="{{ url('my-tours') }}">
                          <i class="ci-bag opacity-60 me-2"></i>My Tours
                        </a>
                        <a class="dropdown-item d-flex align-items-center" href="{{ url('my-trips') }}">
                          <i class="ci-basket opacity-60 me-2"></i>My Trips
                        </a>
                        <a class="dropdown-item d-flex align-items-center" href="{{ url('my-wishlist') }}">
                          <i class="ci-heart opacity-60 me-2"></i>My Wishlist
                        </a>
                        <div class="dropdown-divider"></div>
                          <a class="dropdown-item d-flex align-items-center" href="{{ url('host/host-account') }}">
                            <i class="ci-rocket opacity-60 me-2"></i>Change to Host Account
                          </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item d-flex align-items-center" href="{{ url('logout') }}">
                          <i class="ci-sign-out opacity-60 me-2"></i>Sign Out
                        </a>
                      @endif  
                    </div>
                  </div>
                </div>
                @else
                  <a class="navbar-tool ms-1 ms-lg-0 me-n1 me-lg-2" href="{{ url('login') }}" >
                      <div class="navbar-tool-icon-box">
                          <i class="navbar-tool-icon ci-user"></i>
                      </div>
                      <div class="navbar-tool-text ms-n3">
                          <small>Hello, Sign in</small>My Account
                      </div>
                  </a>
                @endif

                <div class="navbar-tool dropdown ms-3">
                  <a class="navbar-tool-icon-box bg-secondary dropdown-toggle" href="{{ url('cart') }}">
                    <span class="navbar-tool-label">{{ Cart::count() }}</span>
                    <i class="navbar-tool-icon ci-cart"></i>
                  </a>
                  <a class="navbar-tool-text" href="{{ url('cart') }}"><small>Upcoming Rentals </small>
                  {{ Session::get('currency') === 'gbp' ? '£' : '€' }} {{ Cart::subtotal() }}</a>

                  <!-- Cart dropdown-->
                  <div class="dropdown-menu dropdown-menu-end">

                    @if(Cart::count() > 0)

                    <div class="widget widget-cart px-3 pt-2 pb-3" style="width: 20rem;">
                      <div style="height: 15rem;" data-simplebar data-simplebar-auto-hide="false">

                        @foreach(Cart::content() as $cartItem)
                          <div class="widget-cart-item pb-2 border-bottom">
                            <a class="btn-close text-danger" href="{{ url('remove', [ $cartItem->rowId ]) }}" aria-label="Remove">
                              <span aria-hidden="true">&times;</span>
                            </a>
                            <div class="d-flex align-items-center">
                              <a class="flex-shrink-0" href="#">
                                @if($cartItem->options->type == 1)
                                  <img src="{{ URL::asset('storage/app/public/uploads/properties/'.$cartItem->options->image) }}" width="64" alt="">
                                @else
                                  <img src="{{ URL::asset('storage/app/public/uploads/tours/'.$cartItem->options->image) }}" width="64" alt="">
                                @endif
                              </a>
                              <div class="ps-2">
                                <h6 class="widget-product-title">
                                  <a href="#">
                                    {{ $cartItem->name }}
                                  </a>
                                </h6>
                                @if($cartItem->options->type == 1)
                                  <div class="widget-product-meta">
                                    <span class="text-accent me-2">{{ ($cartItem->options->has('adultsprice') ? $cartItem->options->adultsprice : '') }}</span>
                                    <span class="text-muted">x {{ ($cartItem->options->has('adults') ? $cartItem->options->adults : '') }}</span>
                                  </div>
                                @else
                                  <div class="widget-product-meta">
                                    <span class="text-muted">{{ ($cartItem->options->has('adults') ? $cartItem->options->adults : '') }} adults and more...</span>
                                    
                                  </div>
                                @endif
                              </div>
                            </div>
                          </div>
                        @endforeach
                        
                      </div>
                        <div class="d-flex flex-wrap justify-content-between align-items-center py-3">
                          <div class="fs-sm me-2 py-2">
                            <span class="text-muted">Subtotal:</span>
                            <span class="text-accent fs-base ms-1">
                              {{ Session::get('currency') === 'gbp' ? '£' : '€' }}
                              {{ Cart::subtotal() }}</span>
                          </div>
                          <a class="btn btn-outline-secondary btn-sm" href="{{ url('cart') }}">
                            Expand cart<i class="ci-arrow-right ms-1 me-n1"></i>
                          </a>
                        </div>
                        <a class="btn btn-primary btn-sm d-block w-100" href="{{ url('checkout') }}">
                          <i class="ci-card me-2 fs-base align-middle"></i>
                          Checkout
                        </a>
                    </div>

                    @else

                        <div class="widget widget-cart px-3 pt-2 pb-3" style="width: 20rem;">
                          <div class="widget-cart-item pb-2 border-bottom">
                            <div class="d-flex align-items-center">
                              <div class="ps-2">
                                <h6 class="widget-product-title">
                                  <a href="#">
                                    Your Cart is empty!
                                  </a>
                                </h6>
                              </div>
                            </div>
                          </div>
                        </div>

                    @endif

                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="navbar navbar-expand-lg navbar-light navbar-stuck-menu mt-n2 pt-0 pb-2">
              <div class="container">
                  <div class="collapse navbar-collapse" id="navbarCollapse">
                      
                    <?php $hostMenu = getHostMenu(); ?>
                      
                      <!-- Primary menu-->
                      <ul class="navbar-nav">
                          <li class="nav-item {{ (Request::is('/'))? 'active' : ''}}">
                              <a class="nav-link" href="{{ url('/') }}">Home</a>
                          </li>
                           <li class="nav-item {{ (Request::is('all-destinations') || Request::is('all-destinations/more') || Request::is('location/*'))? 'active' : ''}}">
                              <a class="nav-link" href="{{ url('all-destinations') }}">All Destinations</a>
                          </li>
                          <li class="nav-item dropdown {{ (Request::is('host-setup') || Request::is('host-insurance') || Request::is('host-safety') || Request::is('listing-properties'))? 'active' : ''}}">
                              <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Try being a host?</a>
                              <ul class="dropdown-menu">
                                  @foreach($hostMenu as $menu)
                                    <li>
                                        <a class="dropdown-item" href="{{ url('/'.$menu->slug) }}">
                                            <div class="d-flex">
                                                <div class="ms-2">
                                                    <span class="d-block text-heading">
                                                      {{ $menu->title }}
                                                    </span>
                                                    <small class="d-block text-muted">
                                                      {{ $menu->sub_title }}
                                                    </small>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li class="dropdown-divider"></li>
                                  @endforeach
                              </ul>
                          </li>
                          <li class="nav-item dropdown {{ (Request::is('traveling-help') || Request::is('hosting-help') || Request::is('contact-us'))? 'active' : ''}}">
                              <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Help</a>
                              <ul class="dropdown-menu">
                                  <!--<li>
                                      <a class="dropdown-item" href="{{ url('helps') }}">
                                          <div class="d-flex">
                                              <div class="lead text-muted pt-1"><i class="ci-help"></i></div>
                                              <div class="ms-2">
                                                  <span class="d-block text-heading">Full list of help topics</span>
                                                  <small class="d-block text-muted">View all the help topics</small>
                                              </div>
                                          </div>
                                      </a>
                                  </li>
                                  <li class="dropdown-divider"></li>-->
                                  <li>
                                      <a class="dropdown-item" href="{{ url('traveling-help') }}">
                                          <div class="d-flex">
                                              <div class="lead text-muted pt-1"><i class="ci-user"></i></div>
                                              <div class="ms-2">
                                                  <span class="d-block text-heading">Traveller</span>
                                                  <small class="d-block text-muted">All travel related F.A.Q's</small>
                                              </div>
                                          </div>
                                      </a>
                                  </li>
                                  <li class="dropdown-divider"></li>
                                  <li>
                                      <a class="dropdown-item" href="{{ url('hosting-help') }}">
                                          <div class="d-flex">
                                              <div class="lead text-muted pt-1"><i class="ci-corn"></i></div>
                                              <div class="ms-2">
                                                  <span class="d-block text-heading">Host
                                                      <!--span class="badge bg-info ms-2">40+</span-->
                                                  </span>
                                                  <small class="d-block text-muted">All hosts related F.A.Q's</small>
                                              </div>
                                          </div>
                                      </a>
                                  </li>
                                  <li class="dropdown-divider"></li>
                                  <!--<li>
                                      <a class="dropdown-item" href="{{ url('host-setup') }}">
                                          <div class="d-flex">
                                              <div class="lead text-muted pt-1"><i class="ci-edit"></i></div>
                                              <div class="ms-2">
                                                  <span class="d-block text-heading">PropertyStays
                                                  </span>
                                                  <small class="d-block text-muted">Regular updates</small>
                                              </div>
                                          </div>
                                      </a>
                                  </li>
                                  <li class="dropdown-divider"></li>-->
                                  <li>
                                      <a class="dropdown-item" href="{{ url('contact-us') }}">
                                      <div class="d-flex">
                                          <div class="lead text-muted pt-1"><i class="ci-support"></i></div>
                                              <div class="ms-2">
                                                  <span class="d-block text-heading">Contact Support</span>
                                                  <small class="d-block text-muted">info@proertystays.com</small>
                                              </div>
                                          </div>
                                      </a>
                                  </li>
                              </ul>
                          </li>
                      </ul>
                  </div>
              </div>
          </div>
        </div>
      </header>
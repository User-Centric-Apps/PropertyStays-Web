<div class="d-block d-lg-none p-4">
                <a class="btn btn-outline-accent d-block" href="#account-menu" data-bs-toggle="collapse">
                  <i class="ci-menu me-2"></i>Account menu
                </a>
              </div>
              <!-- Actual menu-->
              <div class="h-100 border-end mb-2">
                <div class="d-lg-block collapse" id="account-menu">
                  <div class="bg-secondary p-4">
                    <h3 class="fs-sm mb-0 text-muted">Account</h3>
                  </div>
                  <ul class="list-unstyled mb-0">
                    <li class="border-bottom mb-0">
                      <a class="nav-link-style d-flex align-items-center px-4 py-3 {{ (Request::is('home'))? 'active' : ''}}" href="{{ url('home') }}">
                        <i class="ci-settings opacity-60 me-2"></i>Dashboard
                      </a>
                    </li>
                  @if(Session::get('user_type') == 1)<!-- Host User -->
                      <li class="border-bottom mb-0">
                        <a class="nav-link-style d-flex align-items-center px-4 py-3 " href="{{ url('host/traveller-account') }}">
                          <i class="ci-rocket opacity-60 me-2"></i>Change to Traveller Account
                        </a>
                      </li>
                      <li class="border-bottom mb-0">
                        <a class="nav-link-style d-flex align-items-center px-4 py-3 {{ (Request::is('host/your-earnings'))? 'active' : ''}}" href="{{ url('host/your-earnings') }}">
                          <i class="ci-dollar opacity-60 me-2"></i>Your Earnings/Manage Bank
                        </a>
                      </li>
                      <li class="border-bottom mb-0">
                        <a class="nav-link-style d-flex align-items-center px-4 py-3 {{ (Request::is('host/inbox'))? 'active' : ''}}" href="{{ url('host/inbox') }}">
                          <i class="ci-message opacity-60 me-2"></i>My Inbox
                        </a>
                      </li>
                      <li class="border-bottom mb-0">
                        <a class="nav-link-style d-flex align-items-center px-4 py-3 {{ (Request::is('host/properties'))? 'active' : ''}}" href="{{ url('host/properties') }}">
                          <i class="ci-package opacity-60 me-2"></i>My Properties
                        </a>
                      </li>
                      <li class="border-bottom mb-0">
                        <a class="nav-link-style d-flex align-items-center px-4 py-3 {{ (Request::is('host/tours'))? 'active' : ''}}" href="{{ url('host/tours') }}">
                          <i class="ci-view-list opacity-60 me-2"></i>My Tours
                        </a>
                      </li>
                  @else<!-- Traveller User -->
                      <li class="border-bottom mb-0">
                        <a class="nav-link-style d-flex align-items-center px-4 py-3 " href="{{ url('host/host-account') }}">
                          <i class="ci-rocket opacity-60 me-2"></i>Change to Host Account
                        </a>
                      </li>
                      <!--<li class="border-bottom mb-0">
                        <a class="nav-link-style d-flex align-items-center px-4 py-3 {{ (Request::is('my-orders'))? 'active' : ''}}" href="{{ url('my-orders') }}">
                          <i class="ci-bag opacity-60 me-2"></i>My Trips
                        </a>
                      </li>-->
                      <li class="border-bottom mb-0">
                        <a class="nav-link-style d-flex align-items-center px-4 py-3 {{ (Request::is('my-trips'))? 'active' : ''}}" href="{{ url('my-trips') }}">
                          <i class="ci-home opacity-60 me-2"></i>My Trips
                        </a>
                      </li>
                      <li class="border-bottom mb-0">
                        <a class="nav-link-style d-flex align-items-center px-4 py-3 {{ (Request::is('my-tours'))? 'active' : ''}}" href="{{ url('my-tours') }}">
                          <i class="ci-home opacity-60 me-2"></i>My Tours
                        </a>
                      </li>
                      <li class="border-bottom mb-0">
                        <a class="nav-link-style d-flex align-items-center px-4 py-3 {{ (Request::is('my-wishlist'))? 'active' : ''}}" href="{{ url('my-wishlist') }}">
                          <i class="ci-heart opacity-60 me-2"></i>My Wishlist
                        </a>
                      </li>

                  @endif

                      <li class="mb-0">
                        <a class="nav-link-style d-flex align-items-center px-4 py-3" href="{{ url('logout') }}">
                          <i class="ci-sign-out opacity-60 me-2"></i>Sign out
                        </a>
                      </li>
                    </ul>
                  <hr>
                </div>
              </div>
<!-- BEGIN SIDEBAR -->

                <div class="page-sidebar-wrapper">

                    <div class="page-sidebar navbar-collapse collapse">

                        <ul class="page-sidebar-menu  page-header-fixed " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px">

                            <li class="sidebar-toggler-wrapper hide">

                                <div class="sidebar-toggler">

                                    <span></span>

                                </div>

                            </li>

                            <li class="nav-item {{ (Request::is('admin/dashboard'))? 'active' : ''}}">

                                <a href="{{ url('admin/dashboard') }}" class="nav-link nav-toggle">

                                    <i class="icon-home"></i>

                                    <span class="title">Dashboard</span>

                                </a>

                            </li>

                            <li class="nav-item {{ (Request::is('admin/order/properties') || Request::is('admin/order/tours'))? 'active' : ''}}">

                                <a href="javascript:;" class="nav-link nav-toggle">

                                    <i class="fa fa-opencart"></i>

                                    <span class="title">Bookings</span>

                                    <span class="arrow open"></span>

                                </a>

                                <ul class="sub-menu">

                                    <li class="nav-item {{ (Request::is('admin/order/properties'))? 'active' : ''}}">

                                        <a href="{{ url('admin/order/properties') }}" class="nav-link ">

                                            <span class="title">Properties</span>

                                        </a>

                                    </li>

                                    <li class="nav-item {{ (Request::is('admin/order/tours'))? 'active' : ''}}">

                                        <a href="{{ url('admin/order/tours') }}" class="nav-link ">

                                            <span class="title">Tours</span>

                                        </a>

                                    </li>

                                </ul>

                            </li>

                            <li class="nav-item {{ (Request::is('admin/enquiry/properties') || Request::is('admin/enquiry/tours'))? 'active' : ''}}">

                                <a href="javascript:;" class="nav-link nav-toggle">

                                    <i class="fa fa-envelope"></i>

                                    <span class="title">Enquiry</span>

                                    <span class="arrow open"></span>

                                </a>

                                <ul class="sub-menu">

                                    <li class="nav-item {{ (Request::is('admin/enquiry/properties'))? 'active' : ''}}">

                                        <a href="{{ url('admin/enquiry/properties') }}" class="nav-link ">

                                            <span class="title">Properties</span>

                                        </a>

                                    </li>

                                    <li class="nav-item {{ (Request::is('admin/enquiry/tours'))? 'active' : ''}}">

                                        <a href="{{ url('admin/enquiry/tours') }}" class="nav-link ">

                                            <span class="title">Tours</span>

                                        </a>

                                    </li>

                                </ul>

                            </li>

                            <li class="nav-item {{ (Request::is('admin/properties/manage') || Request::is('admin/properties') || Request::is('admin/feedback/properties'))? 'active' : ''}}">

                                <a href="javascript:;" class="nav-link nav-toggle">

                                    <i class="fa fa-building-o"></i>

                                    <span class="title">Rental</span>

                                    <span class="arrow open"></span>

                                </a>

                                <ul class="sub-menu">

                                    <li class="nav-item {{ (Request::is('admin/properties/manage'))? 'active' : ''}}">

                                        <a href="{{ url('admin/properties/manage') }}" class="nav-link ">

                                            <span class="title">Add Rental</span>

                                        </a>

                                    </li>

                                    <li class="nav-item {{ (Request::is('admin/properties'))? 'active' : ''}}">

                                        <a href="{{ url('admin/properties') }}" class="nav-link ">

                                            <span class="title">All Rental</span>

                                        </a>

                                    </li>

                                    <li class="nav-item {{ (Request::is('admin/feedback/properties'))? 'active' : ''}}">

                                        <a href="{{ url('admin/feedback/properties') }}" class="nav-link ">

                                            <span class="title">Rental Feedback</span>

                                        </a>

                                    </li>

                                </ul>

                            </li>

                            <li class="nav-item {{ (Request::is('admin/tours/manage') || Request::is('admin/tours') || Request::is('admin/tours/manage/*') || Request::is('admin/feedback/tours'))? 'active' : ''}}">

                                <a href="javascript:;" class="nav-link nav-toggle">

                                    <i class="fa fa-university"></i>

                                    <span class="title">Tours</span>

                                    <span class="arrow open"></span>

                                </a>

                                <ul class="sub-menu">

                                    <li class="nav-item {{ (Request::is('admin/tours/manage'))? 'active' : ''}}">

                                        <a href="{{ url('admin/tours/manage') }}" class="nav-link ">

                                            <span class="title">Add Tour</span>

                                        </a>

                                    </li>

                                    <li class="nav-item {{ (Request::is('admin/tours'))? 'active' : ''}}">

                                        <a href="{{ url('admin/tours') }}" class="nav-link ">

                                            <span class="title">All Tours</span>

                                        </a>

                                    </li>

                                    <li class="nav-item {{ (Request::is('admin/feedback/tours'))? 'active' : ''}}">

                                        <a href="{{ url('admin/feedback/tours') }}" class="nav-link ">

                                            <span class="title">Tour Feedback</span>

                                        </a>

                                    </li>

                                </ul>

                            </li>

                            <li class="nav-item {{ (Request::is('admin/hosts/manage') ||  Request::is('admin/hosts/manage/*') ||  Request::is('admin/hosts') ||  Request::is('admin/host-payments') ||  Request::is('admin/host-payments/manage/*'))? 'active' : ''}}">

                                <a href="javascript:;" class="nav-link nav-toggle">

                                    <i class="icon-users"></i>

                                    <span class="title">Hosts</span>

                                    <span class="arrow open"></span>

                                </a>

                                <ul class="sub-menu">

                                    <li class="nav-item {{ (Request::is('admin/hosts/manage'))? 'active' : ''}}">

                                        <a href="{{ url('admin/hosts/manage') }}" class="nav-link ">

                                            <span class="title">Add Host</span>

                                        </a>

                                    </li>

                                    <li class="nav-item {{ (Request::is('admin/hosts'))? 'active' : ''}}">

                                        <a href="{{ url('admin/hosts') }}" class="nav-link ">

                                            <span class="title">All Hosts</span>

                                        </a>

                                    </li>

                                    <li class="nav-item {{ (Request::is('admin/host-payments'))? 'active' : ''}}">

                                        <a href="{{ url('admin/host-payments') }}" class="nav-link ">

                                            <span class="title">Host Payment</span>

                                        </a>

                                    </li>

                                </ul>

                            </li>

                            <li class="nav-item {{ (Request::is('admin/customers/manage') || Request::is('admin/customers/manage/*') || Request::is('admin/customers'))? 'active' : ''}}">

                                <a href="javascript:;" class="nav-link nav-toggle">

                                    <i class="fa fa-users"></i>

                                    <span class="title">Travellers</span>

                                    <span class="arrow open"></span>

                                </a>

                                <ul class="sub-menu">

                                    <li class="nav-item {{ (Request::is('admin/customers/manage'))? 'active' : ''}}">

                                        <a href="{{ url('admin/customers/manage') }}" class="nav-link ">

                                            <span class="title">Add Traveller</span>

                                        </a>

                                    </li>

                                    <li class="nav-item {{(Request::is('admin/customers'))? 'active' : ''}}">

                                        <a href="{{ url('admin/customers') }}" class="nav-link ">

                                            <span class="title">All Travellers</span>

                                        </a>

                                    </li>

                                </ul>

                            </li>

                            <!--<li class="nav-item {{ (Request::is('admin/service-provider/manage') || Request::is('admin/service-provider/manage/*') || Request::is('admin/service-provider'))? 'active' : ''}}">

                                <a href="javascript:;" class="nav-link nav-toggle">

                                    <i class="fa fa-user"></i>

                                    <span class="title">Service Provider</span>

                                    <span class="arrow open"></span>

                                </a>

                                <ul class="sub-menu">

                                    <li class="nav-item {{ (Request::is('admin/service-provider/manage'))? 'active' : ''}}">

                                        <a href="{{ url('admin/service-provider/manage') }}" class="nav-link ">

                                            <span class="title">Add Service Provider</span>

                                        </a>

                                    </li>

                                    <li class="nav-item {{(Request::is('admin/service-provider'))? 'active' : ''}}">

                                        <a href="{{ url('admin/service-provider') }}" class="nav-link ">

                                            <span class="title">All Service Provider</span>

                                        </a>

                                    </li>

                                </ul>

                            </li>-->

                            <li class="heading">

                                <h3 class="uppercase">Settings</h3>

                            </li>

                            <li class="nav-item {{ (Request::is('admin/amenities/manage') || Request::is('admin/amenities/manage/*') || Request::is('admin/amenities'))? 'active' : ''}}">

                                <a href="{{ url('admin/amenities') }}" class="nav-link">

                                    <i class="fa fa-institution"></i>

                                    <span class="title">Amenities</span>

                                </a>

                            </li>
                            <li class="nav-item {{ (Request::is('admin/blog/manage') || Request::is('admin/blog') || Request::is('admin/blog/manage/*') || Request::is('admin/blog/users-list/*'))? 'active' : ''}}">

                                <a href="javascript:;" class="nav-link nav-toggle">

                                    <i class="fa-tasks fa"></i>

                                    <span class="title">Blog</span>

                                    <span class="arrow open"></span>

                                </a>

                                <ul class="sub-menu">

                                    <li class="nav-item {{ (Request::is('admin/blog/manage'))? 'active' : ''}}">

                                        <a href="{{ url('admin/blog/manage') }}" class="nav-link ">

                                            <span class="title">Add New Blog</span>

                                        </a>

                                    </li>

                                    <li class="nav-item {{ (Request::is('admin/blog') || Request::is('admin/blog/manage/*'))? 'active' : ''}}">

                                        <a href="{{ url('admin/blog') }}" class="nav-link ">

                                            <span class="title">All Blog</span>

                                        </a>

                                    </li>

                                </ul>

                            </li>
                            <li class="nav-item {{ (Request::is('admin/page/manage') || Request::is('admin/pages') || Request::is('admin/page/manage/*'))? 'active' : ''}}">

                                <a href="javascript:;" class="nav-link nav-toggle">

                                    <i class="fa-file fa"></i>

                                    <span class="title">Pages</span>

                                    <span class="arrow open"></span>

                                </a>

                                <ul class="sub-menu">

                                    <li class="nav-item {{ (Request::is('admin/page/manage'))? 'active' : ''}}">

                                        <a href="{{ url('admin/page/manage') }}" class="nav-link ">

                                            <span class="title">Add New Page</span>

                                        </a>

                                    </li>

                                    <li class="nav-item {{ (Request::is('admin/pages') || Request::is('admin/page/manage/*'))? 'active' : ''}}">

                                        <a href="{{ url('admin/pages') }}" class="nav-link ">

                                            <span class="title">All Pages</span>

                                        </a>

                                    </li>

                                </ul>

                            </li>

                            <!--<li class="nav-item {{ (Request::is('admin/coupons/manage') || Request::is('admin/coupons') || Request::is('admin/coupons/manage/*') || Request::is('admin/coupons/users-list/*'))? 'active' : ''}}">

                                <a href="javascript:;" class="nav-link nav-toggle">

                                    <i class="fa fa-cube"></i>

                                    <span class="title">Coupons</span>

                                    <span class="arrow open"></span>

                                </a>

                                <ul class="sub-menu">

                                    <li class="nav-item {{ (Request::is('admin/coupons/manage'))? 'active' : ''}}">

                                        <a href="{{ url('admin/coupons/manage') }}" class="nav-link ">

                                            <span class="title">Add New Coupon</span>

                                        </a>

                                    </li>

                                    <li class="nav-item {{ (Request::is('admin/coupons') || Request::is('admin/coupons/manage/*'))? 'active' : ''}}">

                                        <a href="{{ url('admin/coupons') }}" class="nav-link ">

                                            <span class="title">All Coupons</span>

                                        </a>

                                    </li>

                                </ul>

                            </li>-->

                            <li class="nav-item {{ (Request::is('admin/help/manage') || Request::is('admin/help/manage/*') || Request::is('admin/help') || Request::is('admin/help-categories/manage') || Request::is('admin/help-categories/*') || Request::is('admin/help-categories') || Request::is('admin/help-sub-categories/manage') || Request::is('admin/help-sub-categories/manage/*') || Request::is('admin/help-sub-categories'))? 'active' : ''}}">

                                <a href="javascript:;" class="nav-link nav-toggle">

                                    <i class="fa fa-question"></i>

                                    <span class="title">Helps</span>

                                    <span class="arrow open"></span>

                                </a>

                                <ul class="sub-menu">

                                    <li class="nav-item {{ (Request::is('admin/help') || Request::is('admin/help/manage'))? 'active' : ''}}">

                                        <a href="{{ url('admin/help') }}" class="nav-link ">

                                            <span class="title">Help</span>

                                        </a>

                                    </li>

                                    <li class="nav-item {{(Request::is('admin/help-sub-categories') || Request::is('admin/help-sub-categories/manage'))? 'active' : ''}}">

                                        <a href="{{ url('admin/help-sub-categories') }}" class="nav-link ">

                                            <span class="title">Help Sub Categories</span>

                                        </a>

                                    </li>

                                    <li class="nav-item {{(Request::is('admin/help-categories') || Request::is('admin/help-categories/manage'))? 'active' : ''}}">

                                        <a href="{{ url('admin/help-categories') }}" class="nav-link ">

                                            <span class="title">Help Categories</span>

                                        </a>

                                    </li>

                                </ul>

                            </li>
                            <li class="nav-item  {{ (Request::is('admin/cities/manage') || Request::is('admin/cities/manage/*') || Request::is('admin/cities'))? 'active' : ''}}">

                                <a href="{{ url('admin/cities') }}" class="nav-link">

                                    <i class="fa fa-map-marker"></i>

                                    <span class="title">Cities</span>

                                </a>

                            </li>

                            <li class="nav-item {{ (Request::is('admin/countries/manage') || Request::is('admin/countries/manage/*') || Request::is('admin/countries'))? 'active' : ''}}">

                                <a href="{{ url('admin/countries') }}" class="nav-link">

                                    <i class="fa fa-globe"></i>

                                    <span class="title">Countries</span>

                                </a>

                            </li>

                            <li class="nav-item {{ (Request::is('admin/rental-type/manage') || Request::is('admin/rental-type/manage/*') || Request::is('admin/rental-type'))? 'active' : ''}}">

                                <a href="{{ url('admin/rental-type') }}" class="nav-link">

                                    <i class="icon-list"></i>

                                    <span class="title">Rental Types</span>

                                </a>

                            </li>
                            <li class="nav-item {{ (Request::is('admin/suitable/manage') || Request::is('admin/suitable/manage/*') || Request::is('admin/suitables'))? 'active' : ''}}">

                                <a href="{{ url('admin/suitables') }}" class="nav-link">

                                    <i class="fa fa-institution"></i>

                                    <span class="title">Suitables</span>

                                </a>

                            </li>

                            <li class="nav-item {{ (Request::is('admin/staff/manage') || Request::is('admin/staff/manage/*') || Request::is('admin/staff'))? 'active' : ''}}">

                                <a href="{{ url('admin/staff') }}" class="nav-link">

                                    <i class="icon-user"></i>

                                    <span class="title">Staff</span>

                                </a>

                            </li>

                            <li class="nav-item {{ (Request::is('admin/app-settings'))? 'active' : ''}}">

                                <a href="{{ url('admin/app-settings') }}" class="nav-link">

                                    <i class="icon-settings"></i>

                                    <span class="title">App Settings</span>

                                </a>

                            </li>

                            <li class="nav-item end {{ (Request::is('admin/logout'))? 'active' : ''}}">

                                <a href="{{ url('admin/logout') }}" class="nav-link">

                                    <i class="icon-key"></i>

                                    <span class="title">Logout</span>

                                </a>

                            </li>  

                        </ul>

                        <!-- END SIDEBAR MENU -->

                    </div>

                    <!-- END SIDEBAR -->

                </div>

                <!-- END SIDEBAR -->
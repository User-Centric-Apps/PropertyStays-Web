@extends('admin.layouts.master')

@section('title')

Dashboard

@endsection



@section('script')

<!-- BEGIN PAGE LEVEL PLUGINS -->

    <link href="{{ URL::asset('resources/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ URL::asset('resources/assets/global/plugins/morris/morris.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ URL::asset('resources/assets/global/plugins/fullcalendar/fullcalendar.min.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ URL::asset('resources/assets/global/plugins/jqvmap/jqvmap/jqvmap.css') }}" rel="stylesheet" type="text/css" />

<!-- END PAGE LEVEL PLUGINS -->

@endsection



@section('content')


    <div class="page-content">

        <div class="page-bar">

            <ul class="page-breadcrumb">

                <li>

                    <a href="#">Dashboard</a>

                    <i class="fa fa-circle"></i>

                </li>

            </ul>

        </div>

        <h1 class="page-title"> Admin Dashboard

        </h1>

                        <div class="row">

                            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">

                                <a class="dashboard-stat dashboard-stat-v2 red" href="{{ url('admin/needs-approval')}}">

                                    <div class="visual">

                                        <i class="icon-home"></i>

                                    </div>

                                    <div class="details">

                                        <div class="number">

                                            <span data-counter="counterup" data-value="{{ $totals['inactive_prop'] }}">0</span>

                                        </div>

                                        <div class="desc">Needs approval </div>

                                    </div>

                                </a>

                            </div>

                            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">

                                <a class="dashboard-stat dashboard-stat-v2 green" href="{{ url('admin/properties')}}">

                                    <div class="visual">

                                        <i class="icon-home"></i>

                                    </div>

                                    <div class="details">

                                        <div class="number">

                                            <span data-counter="counterup" data-value="{{ $totals['properties'] }}">0</span>

                                        </div>

                                        <div class="desc"> Properties </div>

                                    </div>

                                </a>

                            </div>

                            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">

                                <a class="dashboard-stat dashboard-stat-v2 green" href="{{ url('admin/order/properties')}}">

                                    <div class="visual">

                                        <i class="icon-home"></i>

                                    </div>

                                    <div class="details">

                                        <div class="number">

                                            <span data-counter="counterup" data-value="{{ $totals['properties_booking'] }}">0</span>

                                        </div>

                                        <div class="desc"> Rented Properties </div>

                                    </div>

                                </a>

                            </div>

                            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">

                                <a class="dashboard-stat dashboard-stat-v2 green" href="{{ url('admin/feedback/properties')}}">

                                    <div class="visual">

                                        <i class="icon-home"></i>

                                    </div>

                                    <div class="details">

                                        <div class="number">

                                            <span data-counter="counterup" data-value="{{ $totals['properties_feedback'] }}">0</span>

                                        </div>

                                        <div class="desc">Properties Feedback</div>

                                    </div>

                                </a>

                            </div>

                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">

                                <a class="dashboard-stat dashboard-stat-v2 blue-ebonyclay" href="{{ url('admin/tours')}}">

                                    <div class="visual">

                                        <i class="fa fa-building"></i>

                                    </div>

                                    <div class="details">

                                        <div class="number">

                                            <span data-counter="counterup" data-value="{{ $totals['tours'] }}">0</span>

                                        </div>

                                        <div class="desc"> Tours </div>

                                    </div>

                                </a>

                            </div>

                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">

                                <a class="dashboard-stat dashboard-stat-v2 blue-ebonyclay" href="{{ url('admin/order/tours')}}">

                                    <div class="visual">

                                        <i class="fa fa-building"></i>

                                    </div>

                                    <div class="details">

                                        <div class="number">

                                            <span data-counter="counterup" data-value="{{ $totals['tours_booking'] }}">0</span>

                                        </div>

                                        <div class="desc"> Tours Bought </div>

                                    </div>

                                </a>

                            </div>

                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">

                                <a class="dashboard-stat dashboard-stat-v2 blue-ebonyclay" href="{{ url('admin/feedback/tours')}}">

                                    <div class="visual">

                                        <i class="fa fa-building"></i>

                                    </div>

                                    <div class="details">

                                        <div class="number">

                                            <span data-counter="counterup" data-value="{{ $totals['tours_feedback'] }}">0</span>

                                        </div>

                                        <div class="desc"> Tours Feedback </div>

                                    </div>

                                </a>

                            </div>

                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">

                                <a class="dashboard-stat dashboard-stat-v2 blue" href="{{ url('admin/hosts')}}">

                                    <div class="visual">

                                        <i class="icon-users"></i>

                                    </div>

                                    <div class="details">

                                        <div class="number">

                                            <span data-counter="counterup" data-value="{{ $totals['hosts'] }}">0</span>

                                        </div>

                                        <div class="desc"> Hosts </div>

                                    </div>

                                </a>

                            </div>

                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">

                                <a class="dashboard-stat dashboard-stat-v2 red" href="{{ url('admin/customers')}}">

                                    <div class="visual">

                                        <i class="fa fa-users"></i>

                                    </div>

                                    <div class="details">

                                        <div class="number">

                                            <span data-counter="counterup" data-value="{{ $totals['customers'] }}">0</span>

                                        </div>

                                        <div class="desc">Customers </div>

                                    </div>

                                </a>

                            </div>

                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">

                                <a class="dashboard-stat dashboard-stat-v2 grey-gallery" href="{{ url('admin/amenities')}}">

                                    <div class="visual">

                                        <i class="fa fa-institution"></i>

                                    </div>

                                    <div class="details">

                                        <div class="number">

                                            <span data-counter="counterup" data-value="{{ $totals['amenities'] }}">0</span>

                                        </div>

                                        <div class="desc">Amenities </div>

                                    </div>

                                </a>

                            </div>

                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">

                                <a class="dashboard-stat dashboard-stat-v2 yellow-lemon" href="{{ url('admin/rental-type')}}">

                                    <div class="visual">

                                        <i class="icon-list"></i>

                                    </div>

                                    <div class="details">

                                        <div class="number">

                                            <span data-counter="counterup" data-value="{{ $totals['renttypes'] }}">0</span>

                                        </div>

                                        <div class="desc">Rent Types </div>

                                    </div>

                                </a>

                            </div>

                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">

                                <a class="dashboard-stat dashboard-stat-v2 purple" href="{{ url('admin/countries')}}">

                                    <div class="visual">

                                        <i class="fa fa-globe"></i>

                                    </div>

                                    <div class="details">

                                        <div class="number">

                                            <span data-counter="counterup" data-value="{{ $totals['countries'] }}">0</span>

                                        </div>

                                        <div class="desc">Countries </div>

                                    </div>

                                </a>

                            </div>

                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">

                                <a class="dashboard-stat dashboard-stat-v2 yellow-gold" href="{{ url('admin/cities')}}">

                                    <div class="visual">

                                        <i class="fa fa-map-marker"></i>

                                    </div>

                                    <div class="details">

                                        <div class="number">

                                            <span data-counter="counterup" data-value="{{ $totals['cities'] }}">0</span>

                                        </div>

                                        <div class="desc">Cities </div>

                                    </div>

                                </a>

                            </div>

                        </div>

                        <div class="clearfix"></div>

                        



</div>

<!-- End CONTENT BODY -->



@endsection



@section('script_last')

    <!-- BEGIN PAGE LEVEL PLUGINS -->

    <script src="{{ URL::asset('resources/assets/global/plugins/moment.min.js') }}" type="text/javascript"></script>

    <script src="{{ URL::asset('resources/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js') }}" type="text/javascript"></script>

    <script src="{{ URL::asset('resources/assets/global/plugins/morris/morris.min.js') }}" type="text/javascript"></script>

    <script src="{{ URL::asset('resources/assets/global/plugins/morris/raphael-min.js') }}" type="text/javascript"></script>

    <script src="{{ URL::asset('resources/assets/global/plugins/counterup/jquery.waypoints.min.js') }}" type="text/javascript"></script>

    <script src="{{ URL::asset('resources/assets/global/plugins/counterup/jquery.counterup.min.js') }}" type="text/javascript"></script>

    <script src="{{ URL::asset('resources/assets/global/plugins/amcharts/amcharts/amcharts.js') }}" type="text/javascript"></script>

    <script src="{{ URL::asset('resources/assets/global/plugins/amcharts/amcharts/serial.js') }}" type="text/javascript"></script>

    <script src="{{ URL::asset('resources/assets/global/plugins/amcharts/amcharts/pie.js') }}" type="text/javascript"></script>

    <script src="{{ URL::asset('resources/assets/global/plugins/amcharts/amcharts/radar.js') }}" type="text/javascript"></script>

    <script src="{{ URL::asset('resources/assets/global/plugins/amcharts/amcharts/themes/light.js') }}" type="text/javascript"></script>

    <script src="{{ URL::asset('resources/assets/global/plugins/amcharts/amcharts/themes/patterns.js') }}" type="text/javascript"></script>

    <script src="{{ URL::asset('resources/assets/global/plugins/amcharts/amcharts/themes/chalk.js') }}" type="text/javascript"></script>

    <script src="{{ URL::asset('resources/assets/global/plugins/amcharts/ammap/ammap.js') }}" type="text/javascript"></script>

    <script src="{{ URL::asset('resources/assets/global/plugins/amcharts/ammap/maps/js/worldLow.js') }}" type="text/javascript"></script>

    <script src="{{ URL::asset('resources/assets/global/plugins/amcharts/amstockcharts/amstock.js') }}" type="text/javascript"></script>

    <script src="{{ URL::asset('resources/assets/global/plugins/fullcalendar/fullcalendar.min.js') }}" type="text/javascript"></script>

    <script src="{{ URL::asset('resources/assets/global/plugins/horizontal-timeline/horizontal-timeline.js') }}" type="text/javascript"></script>

    <script src="{{ URL::asset('resources/assets/global/plugins/flot/jquery.flot.min.js') }}" type="text/javascript"></script>

    <script src="{{ URL::asset('resources/assets/global/plugins/flot/jquery.flot.resize.min.js') }}" type="text/javascript"></script>

    <script src="{{ URL::asset('resources/assets/global/plugins/flot/jquery.flot.categories.min.js') }}" type="text/javascript"></script>

    <script src="{{ URL::asset('resources/assets/global/plugins/jquery-easypiechart/jquery.easypiechart.min.js') }}" type="text/javascript"></script>

    <script src="{{ URL::asset('resources/assets/global/plugins/jquery.sparkline.min.js') }}" type="text/javascript"></script>

    <script src="{{ URL::asset('resources/assets/global/plugins/jqvmap/jqvmap/jquery.vmap.js') }}" type="text/javascript"></script>

    <script src="{{ URL::asset('resources/assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.russia.js') }}" type="text/javascript"></script>

    <script src="{{ URL::asset('resources/assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.world.js') }}" type="text/javascript"></script>

    <script src="{{ URL::asset('resources/assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.europe.js') }}" type="text/javascript"></script>

    <script src="{{ URL::asset('resources/assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.germany.js') }}" type="text/javascript"></script>

    <script src="{{ URL::asset('resources/assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.usa.js') }}" type="text/javascript"></script>

    <script src="{{ URL::asset('resources/assets/global/plugins/jqvmap/jqvmap/data/jquery.vmap.sampledata.js') }}" type="text/javascript"></script>

<!-- END PAGE LEVEL PLUGINS -->

@endsection
@extends('admin.layouts.master')

@section('title')

{{ __('messages.Coupons') }}

@endsection



@section('script')

<!-- BEGIN PAGE LEVEL PLUGINS -->

<link href="{{ URL::asset('resources/assets/global/plugins/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />

<link href="{{ URL::asset('resources/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css') }}" rel="stylesheet" type="text/css" />

<!-- END PAGE LEVEL PLUGINS -->

@endsection



@section('content')



<!-- BEGIN CONTENT BODY -->

                    <div class="page-content">

                        <!-- BEGIN PAGE HEADER-->

                        

                        <!-- BEGIN PAGE BAR -->

                        <div class="page-bar">

                            <ul class="page-breadcrumb">

                                <li>

                                    <a href="{{ url('admin')}}">Home</a>

                                    <i class="fa fa-circle"></i>

                                </li>

                                <li>

                                    <a href="{{ url('admin/coupons')}}">Coupons</a>

                                    <i class="fa fa-circle"></i>

                                </li>

                                <li>

                                    <span>Users List</span>

                                </li>

                            </ul>

                            <div class="page-toolbar">

                                <div class="btn-group pull-right">

                                    <a href="{{ url('admin/coupons/manage')}}" class="btn yellow-gold btn-sm btn-outline " > <i class="fa fa-plus"></i> Add Coupon

                                    </a>

                                </div>

                               

                            </div>

                        </div>

                        <!-- END PAGE BAR -->

                        

                        <!-- END PAGE HEADER-->

                        <h1 class="page-title"> 

                            

                        </h1>

                        @if (session('success'))
                            <div class="alert alert-success">
                                <button class="close" data-close="alert"></button>
                                {{ session('success') }}
                            </div>
                        @elseif(session('danger'))
                            <div class="alert alert-danger">
                                <button class="close" data-close="alert"></button>
                                {{ session('danger') }}
                            </div>
                        @endif

                        <div class="row">

                            <div class="col-md-12 col-sm-12">
                    
                    <!-- BEGIN TABLE -->
                    <div class="portlet box blue">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa-star-o fa"></i> Coupon Used by Users
                            </div>
                            
                        </div>
                        <div class="portlet-body">
                            @if(count($data)>0)
                            <table class="table table-striped table-bordered table-hover" id="all_customers">
                            <thead>
                            <tr>
                                <th>
                                    Name
                                </th>
                                <th>
                                    Email
                                </th>
                                <th>
                                    Mobile
                                </th>
                                <th>
                                    Date
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($data as $val)
                            <tr>
                                <th>
                                    {{ $val->firstname }}
                                </th>
                                <th>
                                    {{ $val->email }}
                                </th>
                                <th>
                                    {{ $val->mobile }}
                                </th>
                                <th>
                                    {{ $val->date }}
                                </th>
                            </tr>
                            @endforeach
                            
                            </tbody>
                            </table>
                            @else


                            <div class="alert alert-danger">
                                <button class="close" data-close="alert"></button>
                                No Data found !
                            </div>

                            @endif
                        </div>
                    </div>
                    <!-- END TABLE -->
                    
                </div>

                            

                        </div>

                           

                    <!-- END CONTENT BODY -->

                </div>

                <!-- END CONTENT --> 



@endsection



@section('script_last')

<!-- BEGIN PAGE LEVEL PLUGINS -->

<script src="{{ URL::asset('resources/assets/global/plugins/datatables/datatables.min.js') }}" type="text/javascript"></script>

<script src="{{ URL::asset('resources/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') }}" type="text/javascript"></script>

<!-- END PAGE LEVEL PLUGINS -->

<!-- BEGIN PAGE LEVEL SCRIPTS -->

<script src="{{ URL::asset('resources/assets/pages/scripts/table-datatables-responsive.min.js') }}" type="text/javascript"></script>

<script type="text/javascript">


</script>

<!-- END PAGE LEVEL SCRIPTS -->

@endsection
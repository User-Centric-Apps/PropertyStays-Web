@extends('admin.layouts.master')

@section('title')

Needs approval

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

                                    <a href="#">Needs approval</a>

                                </li>

                            </ul>

                        </div>

                        <!-- END PAGE BAR -->

                        

                        <!-- END PAGE HEADER-->

                        <h1 class="page-title"> 

                            

                        </h1>

                            @if(session('danger'))

                                <div class="alert alert-danger">
                                    <button class="close" data-close="alert"></button>
                                    {{ session('danger') }}
                                </div>

                            @endif
                            @if(session('success'))

                                <div class="alert alert-success">
                                    <button class="close" data-close="alert"></button>
                                    {{ session('success') }}
                                </div>

                            @endif

                        

                        <div class="row">

                            <div class="col-md-12">


                                <!-- BEGIN PORTLET-->

                    <div class="portlet light portlet-fit bordered">

                        <div class="portlet-title line">

                            <div class="caption">

                                Needs approval (<?php echo date("Y-m-d"); ?>)

                            </div>

                        </div>

                        <div class="portlet-body">

                            <!--BEGIN TABS-->

                            <div class="tabbable tabbable-custom">

                                <ul class="nav nav-tabs">

                                    <li class="active">

                                        <a href="#tab_1_1" data-toggle="tab">

                                        Properties (<?php echo count($properties) ?>) </a>

                                    </li>

                                    <li>

                                        <a href="#tab_1_2" data-toggle="tab">

                                        Tours (<?php echo count($tours) ?>) </a>

                                    </li>

                                    <li>

                                        <a href="#tab_1_3" data-toggle="tab">

                                        Users (<?php echo count($users) ?>) </a>

                                    </li>

                                    <li>

                                        <a href="#tab_1_4" data-toggle="tab">

                                        Hosts (<?php echo count($hosts) ?>)</a>

                                    </li>

                                </ul>

        <div class="tab-content">

            <div class="tab-pane active" id="tab_1_1">

                <table class="table table-striped table-bordered table-hover dt-responsive" width="100%" id="all_Table">

                    <thead>

                        <tr>

                            <th class="all">Property Name</th>
                            <th class="all">Agent Name</th>
                            <th class="all">Price</th>
                            <th class="all">Image</th>
                            <th class="all">Posted On</th>
                            <th class="all">Actions</th>

                        </tr>

                    </thead>

                    <tbody>
                        @if(count($properties) > 0)

                            @foreach($properties as $prop)

                            <tr>

                                <td class="all">{{ $prop->title }}</td>

                                <td class="all">{{ $prop->name }}</td>

                                <td class="all">{{ $prop->original_price }}</td>

                                <td class="all">
                                    @if($prop->image)
                                    <img src="{{ URL::to('/') }}/storage/app/public/uploads/properties/{{ $prop->image }}" width='70' class='img-thumbnail' />
                                    @endif
                                </td>

                                <td class="all">{{ $prop->created_at }}</td>

                                <td class="all">

                                    <a href="{{ url('admin/properties/manage/'.$prop->id) }}" class="btn green btn-xs" title="Edit"><i class="fa fa-edit"></i> </a>
                                </td>

                            </tr>

                            @endforeach

                        @else
                            <tr>
                                <td colspan="6">No Record Found!</td>
                            </tr>    

                        @endif 
                    </tbody>

                </table>   

            </div>

            <div class="tab-pane " id="tab_1_2">

                <table class="table table-striped table-bordered table-hover dt-responsive" width="100%" id="tour_Table">

                    <thead>

                        <tr>

                            <th class="all">Tour Name</th>
                            <th class="all">Agent Name</th>
                            <th class="all">Adult Price</th>
                            <th class="all">Image</th>
                            <th class="all">Posted On</th>
                            <th class="all">Actions</th>

                        </tr>

                    </thead>

                    <tbody>
                        @if(count($tours) > 0)

                            @foreach($tours as $tour)

                            <tr>

                                <td class="all">{{ $tour->title }}</td>

                                <td class="all">{{ $tour->name }}</td>

                                <td class="all">{{ $tour->adults }}</td>

                                <td class="all">
                                    @if($tour->image)
                                    <img src="{{ URL::to('/') }}/storage/app/public/uploads/properties/{{ $tour->image }}" width='70' class='img-thumbnail' />
                                    @endif
                                </td>

                                <td class="all">{{ $tour->created_at }}</td>

                                <td class="all">
                                    <a href="{{ url('admin/tours/manage/'.$tour->id) }}" class="btn green btn-xs" title="Edit"><i class="fa fa-edit"></i> </a>
                                </td>

                            </tr>

                            @endforeach

                        @else
                            <tr>
                                <td colspan="6">No Record Found!</td>
                            </tr>    

                        @endif 
                    </tbody>

                </table>   

            </div>

            <div class="tab-pane" id="tab_1_3">

                <table class="table table-striped table-bordered table-hover dt-responsive" width="100%" id="user_Table">

                    <thead>

                        <tr>

                            <th class="all">Full name</th>

                            <th class="all">Email</th>

                            <th class="all">Mobile</th>

                            <th class="all">Created</th>

                            <th class="all">Action</th>

                        </tr>

                    </thead>

                    <tbody>
                        @if(count($users) > 0)

                            @foreach($users as $user)

                            <tr>

                                <td class="all">{{ $user->name }}</td>

                                <td class="all">{{ $user->email }}</td>

                                <td class="all">{{ $user->mobile }}</td>

                                <td class="all">{{ $user->created_at }}</td>

                                <td class="all">
                                    <a href="{{ url('admin/customers/manage/'.$user->id) }}" class="btn green btn-xs" title="Edit"><i class="fa fa-edit"></i> </a>
                                </td>

                            </tr>

                            @endforeach

                        @else
                            <tr>
                                <td colspan="5">No Record Found!</td>
                            </tr>    

                        @endif
                    </tbody>

                </table>

            </div>

            <div class="tab-pane" id="tab_1_4">

                <table class="table table-striped table-bordered table-hover dt-responsive" width="100%" id="host_Tableuser_Table">

                    <thead>

                        <tr>

                            <th class="all">Full name</th>

                            <th class="all">Email</th>

                            <th class="all">Mobile</th>

                            <th class="all">Created</th>

                            <th class="all">Action</th>

                        </tr>

                    </thead>

                    <tbody>
                        @if(count($hosts) > 0)

                            @foreach($hosts as $host)

                            <tr>

                                <td class="all">{{ $host->name }}</td>

                                <td class="all">{{ $host->email }}</td>

                                <td class="all">{{ $host->mobile }}</td>

                                <td class="all">{{ $host->created_at }}</td>

                                <td class="all">
                                    <a href="{{ url('admin/hosts/manage/'.$host->id) }}" class="btn green btn-xs" title="Edit"><i class="fa fa-edit"></i> </a>
                                </td>

                            </tr>

                            @endforeach

                       @else
                            <tr>
                                <td colspan="5">No Record Found!</td>
                            </tr>    

                        @endif
                    </tbody>

                </table>

            </div>

                                </div>

                            </div>

                            <!--END TABS-->

                        </div>

                    </div>

                    <!-- END PORTLET-->


                            </div>

                            

                        </div>

                           

                    <!-- END CONTENT BODY -->

                </div>

                <!-- END CONTENT --> 


@endsection



@section('script_last')

<!-- BEGIN PAGE LEVEL PLUGINS -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>

<script src="{{ URL::asset('resources/assets/global/plugins/datatables/datatables.min.js') }}" type="text/javascript"></script>

<script src="{{ URL::asset('resources/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') }}" type="text/javascript"></script>

<!-- END PAGE LEVEL PLUGINS -->

<!-- BEGIN PAGE LEVEL SCRIPTS -->

<script src="{{ URL::asset('resources/assets/pages/scripts/table-datatables-responsive.min.js') }}" type="text/javascript"></script>

<script type="text/javascript">



jQuery(document).ready(function() {

        var oTable = jQuery('#all_Table').DataTable({

            language: {

                "aria": {

                    "sortAscending": ": activate to sort column ascending",

                    "sortDescending": ": activate to sort column descending"

                },

                "lengthMenu": "_MENU_"

            },

            buttons: [

                { extend: 'print', title: "Properties", className: 'btn dark btn-outline', text:"Print", exportOptions: { columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16 ] }, customize: function ( win ) { $(win.document.body).css( 'background', '#fff' ); $(win.document.body).find('h1').css('text-align', 'center')}},

                { extend: 'excelHtml5', exportOptions: { columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16 ] }, charset: 'utf-8', className: 'btn dark btn-outline', text:"Excel" },

            ],

            processing: true,

            "order": [

                [15, 'desc']

            ],

            "lengthMenu": [

                [50, 100, 500, -1],

                [50, 100, 500, "All"] // change per page values here

            ],

            "pageLength": 50,

            "dom": "<'row' <'col-md-12'B>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",


        });

        var tableWrapper = $('#all_Table_wrapper');
        tableWrapper.find('.dataTables_length select').select2();

        //Tours

        var oTable = jQuery('#tour_Table').DataTable({

            language: {

                "aria": {

                    "sortAscending": ": activate to sort column ascending",

                    "sortDescending": ": activate to sort column descending"

                },

                "lengthMenu": "_MENU_"

            },

            buttons: [

                { extend: 'print', title: "Properties", className: 'btn dark btn-outline', text:"Print", exportOptions: { columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16 ] }, customize: function ( win ) { $(win.document.body).css( 'background', '#fff' ); $(win.document.body).find('h1').css('text-align', 'center')}},

                { extend: 'excelHtml5', exportOptions: { columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16 ] }, charset: 'utf-8', className: 'btn dark btn-outline', text:"Excel" },

            ],

            processing: true,

            "order": [

                [15, 'desc']

            ],

            "lengthMenu": [

                [50, 100, 500, -1],

                [50, 100, 500, "All"] // change per page values here

            ],

            "pageLength": 50,

            "dom": "<'row' <'col-md-12'B>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",


        });

        var tableTWrapper = $('#tour_Table_wrapper');
        tableTWrapper.find('.dataTables_length select').select2();

        //Users
        var oTable = jQuery('#user_Table').DataTable({

            language: {

                "aria": {

                    "sortAscending": ": activate to sort column ascending",

                    "sortDescending": ": activate to sort column descending"

                },

                "lengthMenu": "_MENU_"

            },

            buttons: [

                { extend: 'print', title: "Properties", className: 'btn dark btn-outline', text:"Print", exportOptions: { columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16 ] }, customize: function ( win ) { $(win.document.body).css( 'background', '#fff' ); $(win.document.body).find('h1').css('text-align', 'center')}},

                { extend: 'excelHtml5', exportOptions: { columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16 ] }, charset: 'utf-8', className: 'btn dark btn-outline', text:"Excel" },

            ],

            processing: true,

            "order": [

                [15, 'desc']

            ],

            "lengthMenu": [

                [50, 100, 500, -1],

                [50, 100, 500, "All"] // change per page values here

            ],

            "pageLength": 50,

            "dom": "<'row' <'col-md-12'B>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",


        });

        var tableUserWrapper = $('#user_Table_wrapper');
        tableUserWrapper.find('.dataTables_length select').select2();

        //Users
        var oTable = jQuery('#host_Table').DataTable({

            language: {

                "aria": {

                    "sortAscending": ": activate to sort column ascending",

                    "sortDescending": ": activate to sort column descending"

                },

                "lengthMenu": "_MENU_"

            },

            buttons: [

                { extend: 'print', title: "Properties", className: 'btn dark btn-outline', text:"Print", exportOptions: { columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16 ] }, customize: function ( win ) { $(win.document.body).css( 'background', '#fff' ); $(win.document.body).find('h1').css('text-align', 'center')}},

                { extend: 'excelHtml5', exportOptions: { columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16 ] }, charset: 'utf-8', className: 'btn dark btn-outline', text:"Excel" },

            ],

            processing: true,

            "order": [

                [15, 'desc']

            ],

            "lengthMenu": [

                [50, 100, 500, -1],

                [50, 100, 500, "All"] // change per page values here

            ],

            "pageLength": 50,

            "dom": "<'row' <'col-md-12'B>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",


        });

        var tableHostWrapper = $('#host_Table_wrapper');
        tableHostWrapper.find('.dataTables_length select').select2();

});

</script>

<!-- END PAGE LEVEL SCRIPTS -->

@endsection
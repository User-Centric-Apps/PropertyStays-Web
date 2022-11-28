@extends('admin.layouts.master')

@section('title')

Host Payment

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

                        <div class="page-bar">

                            <ul class="page-breadcrumb">

                                <li>

                                    <a href="{{ url('admin')}}">Home</a>

                                    <i class="fa fa-circle"></i>

                                </li>

                                <li>

                                    <a href="#">Host Payment</a>

                                </li>

                            </ul>

                        </div>

                        <h1 class="page-title"> </h1>

                        <div class="row">

                            <div class="col-md-12">

                                <div class="portlet light bordered">

                                    <div class="portlet-title">

                                        <div class="caption font-dark">

                                            <i class="icon-users font-dark"></i>

                                            <span class="caption-subject bold uppercase">
                                                Host Payment

                                            </span>

                                        </div>

                                        <div class="page-toolbar">

                                

                            </div>

                                        <div class="tools"> </div>

                                    </div>

                                    <div class="portlet-body">

                                        <table class="table table-striped table-bordered table-hover dt-responsive" width="100%" id="all_Table">

                                            <thead>

                                                <tr>

                                                    <th class="all">Host Name</th>

                                                    <th class="all">Property Title</th>

                                                    <th class="all">Order ID</th>

                                                    <th class="all">Order Payment</th>

                                                    <th class="all">Payment Status</th>

                                                    <th class="all">Created</th>

                                                    <th class="all">Actions</th>

                                                </tr>

                                            </thead>

                                            <tbody>

                                            </tbody>

                                        </table>

                                    </div>

                                </div>

                                <!-- END EXAMPLE TABLE PORTLET-->

                            </div>

                            

                        </div>

                           

                    <!-- END CONTENT BODY -->

                </div>


@endsection



@section('script_last')

<!-- BEGIN PAGE LEVEL PLUGINS -->

<script src="{{ URL::asset('resources/assets/global/plugins/datatables/datatables.min.js') }}" type="text/javascript"></script>

<script src="{{ URL::asset('resources/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') }}" type="text/javascript"></script>

<!-- END PAGE LEVEL PLUGINS -->

<!-- BEGIN PAGE LEVEL SCRIPTS -->

<script src="{{ URL::asset('resources/assets/pages/scripts/table-datatables-responsive.min.js') }}" type="text/javascript"></script>

<script type="text/javascript">



jQuery(document).ready(function() {  

    $.fn.dataTable.ext.errMode = 'throw'; 

        var oTable = jQuery('#all_Table').DataTable({


            language: {

                "emptyTable":     "No data available in table",
                "info":           "Total records: _TOTAL_",
                "infoEmpty":      "Total records: 0",
                "infoFiltered":   "(filtered from _MAX_)",

                "aria": {

                    "sortAscending": ": activate to sort column ascending",
                    "sortDescending": ": activate to sort column descending",

                },

                "lengthMenu": "_MENU_"

            },



            buttons: [

                { extend: 'print', title: "List", className: 'btn dark btn-outline', text:"Print", exportOptions: { columns: [ 0, 1,2,3,4,5,6,7 ] }, customize: function ( win ) { $(win.document.body).css( 'background', '#fff' ); $(win.document.body).find('h1').css('text-align', 'center')}},

                { extend: 'excelHtml5', exportOptions: { columns: [ 0, 1,2,3,4,5,6,7 ] }, charset: 'utf-8', className: 'btn dark btn-outline', text:"Excel" },

            ],

            processing: true,

            serverSide: true,

            ajax: "{!! url('admin/host-payments') !!}",
            

            columns: [

                { data: 'name', name: 'users.name' },

                { data: 'title', name: 'properties.title' },

                { data: 'order_id', name: 'orders_item.order_id' },

                { data: 'price', name: 'orders_item.price' },

                { data: 'paid', name: 'paid' },

                { data: 'created_at', name: 'created_at', type: 'num',
               
                    render: {
                      _: 'display',
                      
                      sort: 'timestamp'
                    }
                },

                { data: 'action', name: 'action', orderable: false, searchable: false},

            ],



            "order": [

                [0, 'desc']

            ],



            "lengthMenu": [

                [50, 100, 500, -1],

                [50, 100, 500, "All"]

            ],

            "pageLength": 50,

            "dom": "<'row' <'col-md-12'B>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",

        });

        var tableWrapper = $('#all_Table_wrapper');

        tableWrapper.find('.dataTables_length select').select2(); // initialize select2 dropdown

        

});


</script>

<!-- END PAGE LEVEL SCRIPTS -->

@endsection
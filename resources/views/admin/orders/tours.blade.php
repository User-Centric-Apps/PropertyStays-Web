@extends('admin.layouts.master')

@section('title')

Tours Booking

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

                                    <a href="#">Tours Booking</a>

                                </li>

                            </ul>

                        </div>

                        <!-- END PAGE BAR -->

                        

                        <!-- END PAGE HEADER-->

                        <h1 class="page-title"> 

                            

                        </h1>

                        

                        <div class="row">

                            <div class="col-md-12">

                                <!-- BEGIN EXAMPLE TABLE PORTLET-->

                                <div class="portlet light bordered">

                                    <div class="portlet-title">

                                        <div class="caption font-dark">

                                            <i class="fa fa-opencart"></i>

                                            <span class="caption-subject bold uppercase"> 
                                                Tours
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

                                                <th class="all">ID</th>

                                                <th class="all">Tour Name</th>

                                                <th class="none">Adults :</th>

                                                <th class="none">Childrens :</th>

                                                <th class="none">Infants :</th>

                                                <th class="all">Traveller Name</th>

                                                <th class="none">Traveller Email :</th>

                                                <th class="none">Traveller Mobile :</th>

                                                <th class="all">Booked Date</th>

                                                <th class="none">Price :</th>

                                                <th class="all">Paid</th>

                                                <th class="all">Transaction ID</th>

                                                <th class="all">Paid On</th>

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

                { extend: 'print', title: "Tours", className: 'btn dark btn-outline', text:"Print", exportOptions: { columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11 ] }, customize: function ( win ) { $(win.document.body).css( 'background', '#fff' ); $(win.document.body).find('h1').css('text-align', 'center')}},

                { extend: 'excelHtml5', exportOptions: { columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11 ] }, charset: 'utf-8', className: 'btn dark btn-outline', text:"Excel" },

            ],

            processing: true,

            serverSide: true,

            ajax: "{!! url('admin/order/tours') !!}",

            columns: [

                { data: 'id', name: 'orders_item.id' },

                { data: 'title', name: 'properties.title' },

                { data: 'adults', name: 'orders_item.adults' },

                { data: 'childrens', name: 'orders_item.childrens' },

                { data: 'infants', name: 'orders_item.infants' },

                { data: 'name', name: 'users.name' },

                { data: 'email', name: 'users.email' },

                { data: 'mobile', name: 'users.mobile' },

                { data: 'date', name: 'orders.date' },

                { data: 'price', name: 'orders_item.price' },

                { data: 'status', name: 'orders.status' },

                { data: 'order_transaction', name: 'orders.order_transaction' },

                { data: 'created_at', name: 'created_at', orderable: false, searchable: false , type: 'num',
               
                    render: {
                      _: 'display',
                      
                      sort: 'timestamp'
                    }
                },

            ],

            "order": [

                [0, 'asc']

            ],

            "lengthMenu": [

                [50, 100, 500, -1],

                [50, 100, 500, "All"] // change per page values here

            ],

            "pageLength": 50,

            "dom": "<'row' <'col-md-12'B>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>", // horizobtal scrollable datatable


        });


        var tableWrapper = $('#all_Table_wrapper');

        tableWrapper.find('.dataTables_length select').select2();

});

</script>

<!-- END PAGE LEVEL SCRIPTS -->

@endsection
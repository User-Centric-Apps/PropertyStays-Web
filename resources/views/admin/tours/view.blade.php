@extends('admin.layouts.master')

@section('title')

Tours

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

                                    <a href="#">Tours</a>

                                </li>

                            </ul>

                            <div class="page-toolbar">

                                <div class="btn-group pull-right">

                                    <a href="{{ url('admin/tours/manage')}}" class="btn green btn-sm btn-outline " > <i class="fa fa-plus"></i> Add Tour

                                    </a>

                                </div>

                               

                            </div>

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

                                            <i class="fa fa-building-o"></i>

                                            <span class="caption-subject bold uppercase"> Tours

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

                                                <th class="all">Tour Name</th>

                                                <th class="all">Agent Name</th>

                                                <th class="all">Duration</th>

                                                <th class="all">Group Size</th>

                                                <th class="none">Tour Image :</th>

                                                <th class="all">Adult Price</th>

                                                <th class="none">Child Price :</th>

                                                <th class="none">Infant Price :</th>

                                                <th class="all">Featured</th>

                                                <th class="none">Area :</th>

                                                <th class="none">City :</th>

                                                <th class="none">Country :</th>

                                                <th class="none">Status :</th>

                                                <th class="all">Posted On</th>

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

                <!-- END CONTENT --> 

<div id="confirmModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h2 class="modal-title">Need to confirm!</h2>
            </div>
            <div class="modal-body">
                <h4 align="center" style="margin:0;">Are you sure you want to delete this ? </h4>
            </div>
            <div class="modal-footer">
             <button type="button" name="ok_button" id="ok_button" class="btn btn-danger">Yes Delete Please!</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>

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

                { extend: 'print', title: "Tours", className: 'btn dark btn-outline', text:"Print", exportOptions: { columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16 ] }, customize: function ( win ) { $(win.document.body).css( 'background', '#fff' ); $(win.document.body).find('h1').css('text-align', 'center')}},

                { extend: 'excelHtml5', exportOptions: { columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16 ] }, charset: 'utf-8', className: 'btn dark btn-outline', text:"Excel" },

            ],

            processing: true,

            serverSide: true,

            ajax: "{!! url('admin/tours') !!}",

            columns: [

                { data: 'title', name: 'title' },

                { data: 'name', name: 'users.name' },

                { data: 'tour_duration', name: 'tour_duration' },

                { data: 'sqft', name: 'sqft' },

                {
                    data: 'image',

                    name: 'image',

                    render: function(data, type, full, meta)
                    {
                        if(data)
                        {
                            return "<img src={{ URL::to('/') }}/storage/app/public/uploads/tours/" + data + " width='70' class='img-thumbnail' />";
                        }
                        else
                        {
                            return "No Image ";
                        }
                    },

                    orderable: false, 

                    searchable: false
                },

                { data: 'adults', name: 'adults' },

                { data: 'children', name: 'children' },

                { data: 'infant', name: 'infant' },

                { data: 'featured', name: 'featured', orderable: false, searchable: false },

                { data: 'area', name: 'area' },

                { data: 'cityname', name: 'cities.cityname' },

                { data: 'cname', name: 'countries.cname' },

                { data: 'status', name: 'status' },

                { data: 'created_at', name: 'created_at', orderable: false, searchable: false, type: 'num',
               
                    render: {
                      _: 'display',
                      
                      sort: 'timestamp'
                    }
                },

                { data: 'action', name: 'action', orderable: false, searchable: false},

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

        tableWrapper.find('.dataTables_length select').select2(); // initialize select2 dropdown

        var c_id;

        $(document).on('click', '.delete', function()
        {

            c_id = $(this).attr('id');

            $('#confirmModal').modal('show');

        });

        $('#ok_button').click(function()
        {

            $.ajax({

                url: base_url+"/admin/tours/destroy/"+c_id,

                beforeSend:function(){

                    $('#ok_button').text('Deleting, Please Wait!');

                },
                success:function(data)
                {

                    setTimeout(function(){

                     $('#confirmModal').modal('hide');

                     $('#all_Table').DataTable().ajax.reload();

                    }, 2000);

                }

            })

        });

});

</script>

<!-- END PAGE LEVEL SCRIPTS -->

@endsection
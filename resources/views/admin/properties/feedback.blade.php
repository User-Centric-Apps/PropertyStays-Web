@extends('admin.layouts.master')

@section('title')

Rentals Feedback

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

                                    <a href="#">Rentals Feedback</a>

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

                                            <i class="fa fa-comments-o"></i>

                                            <span class="caption-subject bold uppercase"> 
                                                Rentals Feedback
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

                                                <th class="all">Rental Name</th>

                                                <th class="all">Traveller Name</th>

                                                <th class="all">Rating</th>

                                                <th class="none">Comment :</th>

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

                { extend: 'print', title: "Properties", className: 'btn dark btn-outline', text:"Print", exportOptions: { columns: [ 0, 1, 2, 3, 4, 5, 6 ] }, customize: function ( win ) { $(win.document.body).css( 'background', '#fff' ); $(win.document.body).find('h1').css('text-align', 'center')}},

                { extend: 'excelHtml5', exportOptions: { columns: [ 0, 1, 2, 3, 4, 5, 6 ] }, charset: 'utf-8', className: 'btn dark btn-outline', text:"Excel" },

            ],

            processing: true,

            serverSide: true,

            ajax: "{!! url('admin/feedback/properties') !!}",

            columns: [

                { data: 'id', name: 'feedback.id' },

                { data: 'title', name: 'properties.title' },

                { data: 'name', name: 'users.name' },

                { data: 'rating', name: 'feedback.rating' },

                { data: 'comment', name: 'feedback.comment' },

                { data: 'created_at', name: 'feedback.created_at', type: 'num',
               
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

        tableWrapper.find('.dataTables_length select').select2();

        var c_id;

        $(document).on('click', '.delete', function()
        {

            c_id = $(this).attr('id');

            $('#confirmModal').modal('show');

        });

        $('#ok_button').click(function()
        {

            $.ajax({

                url: base_url+"/admin/feedback/property/destroy/"+c_id,

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
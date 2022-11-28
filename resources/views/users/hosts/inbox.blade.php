@extends('layouts.master')

@section('title')

My Inbox

@endsection


@section('script')
<!-- BEGIN PAGE LEVEL PLUGINS -->

<link href="{{ URL::asset('resources/assets/global/plugins/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />

<link href="{{ URL::asset('resources/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css') }}" rel="stylesheet" type="text/css" />

<style type="text/css">
  #all_Table_length, #all_Table_filter
  {
    margin-top: 20px;
  }
</style>

<!-- END PAGE LEVEL PLUGINS -->
@endsection



@section('content')

      <div class="page-title-overlap bg-primary pt-4">
        
        @include('layouts.user-breadcrums')

      </div>
      <div class="container mb-5 pb-3">
        <div class="bg-light shadow-lg rounded-3 overflow-hidden">
          <div class="row">
            <!-- Sidebar-->
            <aside class="col-lg-4 pe-xl-5">

              @include('layouts.user-sidebar')

            </aside>
            <!-- Content-->
            <section class="col-lg-8 pt-lg-4 pb-4 mb-3">

              <div class="pt-2 px-4 ps-lg-0 pe-xl-5">
                <!-- Title-->
                <div class="d-sm-flex flex-wrap justify-content-between align-items-center border-bottom">
                  <h2 class="h3 py-2 me-2 text-center text-sm-start">
                    My Inbox
                  </h2>
                </div>
                <!-- Product-->
                <table class="table table-striped table-bordered table-hover dt-responsive" width="100%" id="all_Table">

                                        <thead>

                                            <tr>

                                                <th class="all">Title</th>

                                                <th class="all">Type</th>

                                                <th class="all">Traveller Name</th>

                                                <th class="all">Email</th>

                                                <th class="none">Mobile</th>

                                                <th class="none">Description:</th>

                                                <th class="all">Posted On</th>

                                                <th class="all">Action</th>

                                            </tr>

                                        </thead>

                                        <tbody>

                                        </tbody>

                                    </table> 
                <!-- Product-->
              </div>
                 
            </section>
          </div>
        </div>
      </div>

@endsection

@section('script_last')

<script src="{{ URL::asset('resources/assets/global/plugins/jquery.min.js') }}" type="text/javascript"></script>
  
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

            ],

            processing: true,

            serverSide: true,

            ajax: "{!! url('host/inbox') !!}",

            columns: [

                { data: 'title', name: 'properties.title' },

                { data: 'enquiry_type', name: 'properties_booking_enquiry.enquiry_type' },

                { data: 'name', name: 'properties_booking_enquiry.name' },

                { data: 'email', name: 'properties_booking_enquiry.email' },

                { data: 'mobile', name: 'properties_booking_enquiry.mobile' },

                { data: 'description', name: 'properties_booking_enquiry.description' },

                { data: 'created_at', name: 'created_at', type: 'num',
               
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

                url: base_url+"/host/inbox/destroy/"+c_id,

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
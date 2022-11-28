<!DOCTYPE html>
<html lang="en" dir="ltr">

    <head>
        <meta charset="utf-8" />

        <title>@yield('title') | PropertyStay</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="Syed Danish Ali" name="author" />
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="{{ URL::asset('resources/assets/global/plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ URL::asset('resources/assets/global/plugins/simple-line-icons/simple-line-icons.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ URL::asset('resources/assets/global/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ URL::asset('resources/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ URL::asset('resources/assets/global/plugins/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ URL::asset('resources/assets/global/plugins/select2/css/select2-bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
        <!-- END GLOBAL MANDATORY STYLES -->
        <!-- BEGIN THEME GLOBAL STYLES -->
        <link href="{{ URL::asset('resources/assets/global/css/components.min.css') }}" rel="stylesheet" id="style_components" type="text/css" />
        <link href="{{ URL::asset('resources/assets/global/css/plugins.min.css') }}" rel="stylesheet" type="text/css" />
        <!-- END THEME GLOBAL STYLES -->

        <!-- BEGIN THEME LAYOUT STYLES -->
        <link href="{{ URL::asset('resources/assets/layouts/layout/css/layout.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ URL::asset('resources/assets/layouts/layout/css/themes/darkblue.min.css') }}" rel="stylesheet" type="text/css" id="style_color" />
        <link href="{{ URL::asset('resources/assets/layouts/layout/css/custom.min.css') }}" rel="stylesheet" type="text/css" />
        <!-- END THEME LAYOUT STYLES -->

        <link rel="shortcut icon" href="{{ URL::asset('favico.png') }}" /> 
        <script type="text/javascript"> var base_url = "{{ URL::to('/') }}"; </script>
        <style type="text/css">
            .page-header.navbar .top-menu .navbar-nav > li.dropdown .dropdown-toggle:hover {
    background-color: transparent;
}
.page-header .top-menu .dropdown-user .dropdown-toggle .dropdown-user-inner>.username {
    display: inline-block;
    margin-right: 5px;
    font-size: 13px;
    font-weight: 600;
    vertical-align: middle;
}
        </style>


    </head>



    <!-- END HEAD -->



    @yield('script')



    <body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white">

        <div class="page-wrapper">

            @include('admin.layouts.header')

        <div class="page-container">

            @include('admin.layouts.sidebar')

            <div class="page-content-wrapper">

                    @yield('content')

            </div>

        </div> 

        <div class="page-footer">

            <div class="page-footer-inner">2021 &copy; PropertyStay

                <div class="scroll-to-top">

                    <i class="icon-arrow-up"></i>

                </div>

            </div>

        </div>

    </div>    



    <div id="profile" class="modal fade" tabindex="-1" aria-hidden="true" > <div class="modal-dialog"> <div class="modal-content"> <div class="modal-header"> <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button> <h4 class="modal-title">Change Password</h4> </div><form role="form" id="form-account-password" method="post" action="{{URL::to('admin/password/update')}}" >{!! csrf_field() !!}<div class="modal-body"> <div data-always-visible="1" data-rail-visible1="1"> <div id="profile_row" class="row" style="padding:10px" ></div><div class="row"> <div class="col-md-4 text-right"> <label class="control-label">Email :</label> </div><div class="col-md-7"> <input type="text" class="form-control" value="{{Auth::user()->email}}" disabled> </div></div><br><div class="row"> <div class="col-md-4 text-right"> <label class="control-label">Current Password :</label> </div><div class="col-md-7"> <input type="password" class="form-control" name="current_password" required> </div></div><br><div class="row"> <div class="col-md-4 text-right"> <label class="control-label">New Password :</label> </div><div class="col-md-7"> <input type="password" class="form-control" name="password" required> </div></div><br><div class="row"> <div class="col-md-4 text-right"> <label class="control-label">Confirm New Password :</label> </div><div class="col-md-7"> <input type="password" class="form-control" name="password_confirmation" required> </div></div></div></div><div class="modal-footer"> <span id="profile_model_spiner" style="display:none"> <img src="{{url('resources/assets/layouts/layout/img/loading.gif')}}"/> </span> <button type="button" class="btn blue" onClick="return updatePassword()">Change Password</button> </div></form> </div></div></div>



            <!-- END FOOTER -->



            <!--[if lt IE 9]>



<script src="{{ URL::asset('resources/assets/global/plugins/respond.min.js') }}"></script>



<script src="{{ URL::asset('resources/assets/global/plugins/excanvas.min.js') }}"></script> 



<script src="{{ URL::asset('resources/assets/global/plugins/ie8.fix.min.js') }}"></script> 



<![endif]-->



            <!-- BEGIN CORE PLUGINS -->



            <script src="{{ URL::asset('resources/assets/global/plugins/jquery.min.js') }}" type="text/javascript"></script>



            <script src="{{ URL::asset('resources/assets/global/plugins/bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>



            <script src="{{ URL::asset('resources/assets/global/plugins/js.cookie.min.js') }}" type="text/javascript"></script>



            <script src="{{ URL::asset('resources/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js') }}" type="text/javascript"></script>



            <script src="{{ URL::asset('resources/assets/global/plugins/jquery.blockui.min.js') }}" type="text/javascript"></script>



            <script src="{{ URL::asset('resources/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}" type="text/javascript"></script>



            <!-- END CORE PLUGINS -->



            



            <!-- BEGIN THEME GLOBAL SCRIPTS -->



            <script src="{{ URL::asset('resources/assets/global/scripts/app.min.js') }}" type="text/javascript"></script>



            <!-- END THEME GLOBAL SCRIPTS -->



            <!-- BEGIN PAGE LEVEL SCRIPTS -->



            



            <!-- END PAGE LEVEL SCRIPTS -->



            <!-- BEGIN THEME LAYOUT SCRIPTS -->



            <script src="{{ URL::asset('resources/assets/layouts/layout2/scripts/layout.min.js') }}" type="text/javascript"></script>



            <script src="{{ URL::asset('resources/assets/global/plugins/select2/js/select2.full.min.js') }}" type="text/javascript"></script>



            <!-- END THEME LAYOUT SCRIPTS -->



            @yield('script_last')



            <script>



                $(document).ready(function()



                {



                    $(".select").select2({width: 'auto'});



                });



                function updatePassword(){

                    $('#profile_model_spiner').show();

                    var postForm = {

                        'current_password' : $('input[name="current_password"]').val(),

                        'password' : $('input[name="password"]').val(),

                        'password_confirmation' : $('input[name="password_confirmation"]').val(),

                        '_token' : $('input[name="_token"]').val(),

                    };



                    $.ajax({

                        type        : 'POST',

                        url         : base_url+"/admin/password/update",

                        data        : postForm,

                        success     : function(data) {

                            $('#profile_model_spiner').hide();

                            if(data == "ok"){

                                $('#form-account-password').trigger("reset");

                                $('#profile_row').show().html('<div class="alert alert-success">Password Changed Successfully!</div>').fadeOut(5000);

                            } else

                                $('#profile_row').show().html(data);

                        }

                    });

                    return false;

                }



            </script>



    </body>







</html>




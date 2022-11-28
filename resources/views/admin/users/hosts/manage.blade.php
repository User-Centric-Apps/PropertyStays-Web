@extends('admin.layouts.master')

@section('title')

Manage Host

@endsection

@section('script')

<!-- BEGIN PAGE LEVEL PLUGINS -->

<link href="{{ URL::asset('resources/assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}" rel="stylesheet" type="text/css" />

<link href="{{ URL::asset('resources/assets/global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.css') }}" rel="stylesheet" type="text/css" />

<link href="{{ URL::asset('resources/assets/global/plugins/bootstrap-markdown/css/bootstrap-markdown.min.css') }}" rel="stylesheet" type="text/css" />

<link href="{{ URL::asset('resources/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css') }}" rel="stylesheet" type="text/css" />

<!-- END PAGE LEVEL PLUGINS -->

<style type="text/css">

    .mt-radio

    {

        margin-bottom: 0;

    }

</style>

@endsection



@section('content')



<!-- BEGIN CONTENT BODY -->

    <div class="page-content">

        <!-- BEGIN PAGE BAR -->

        <div class="page-bar">

            <ul class="page-breadcrumb">

                <li>

                    <a href="{{ url('admin')}}">Home</a>

                    <i class="fa fa-circle"></i>

                </li>

                <li>

                    <a href="{{ url('admin/hosts')}}">Hosts</a>

                    <i class="fa fa-circle"></i>

                </li>

                <li>

                    <span>Manage Host</span>

                </li>

            </ul>

        </div>

        <!-- END PAGE BAR -->

        <!-- BEGIN PAGE TITLE-->

        <h1 class="page-title">

        </h1>

        <!-- END PAGE TITLE-->



                                <?php

                                    $active = "";
                                    $inactive = "";

                                    if(isset($user->status))
                                    {
                                        if($user->status==1)
                                        {
                                            $active = "checked";
                                        }
                                        else
                                        {
                                            $inactive = "checked";
                                        }
                                    }
                                    else
                                    {
                                        $active = "checked";
                                    }

                                ?>

        <div class="row">

            <div class="col-md-12">

                <!-- BEGIN VALIDATION STATES-->

                <div class="portlet light portlet-fit portlet-form bordered">

                    <div class="portlet-title">

                        <div class="caption">

                            <i class="icon-users font-dark"></i>

                            <span class="caption-subject font-dark sbold uppercase">Manage Host</span>

                        </div>

                    </div>

                    <div class="portlet-body">

                        <!-- BEGIN FORM-->

                        <form action="{{ url('admin/hosts/save') }}" id="form_sample_3" class="form-horizontal" enctype="multipart/form-data" method="post">

                            {!! csrf_field() !!}

                            <input type="hidden" name="id" value="{{ isset($user->id) ? $user->id : ''}}">

                            <input type="hidden" name="type" value="1">

                    

                            <div class="form-body">

                                @if ($errors->any())

                                    <div class="alert alert-danger">

                                        <ul>

                                            @foreach ($errors->all() as $error)

                                                <li>{{ $error }}</li>

                                            @endforeach

                                        </ul>

                                    </div>

                                @endif

                                @if(session('danger'))

                                    <div class="alert alert-danger">

                                        <button class="close" data-close="alert"></button>

                                        {{ session('danger') }}

                                    </div>

                                @endif

                                <div class="alert alert-danger display-hide">

                                    <button class="close" data-close="alert"></button> You have some form errors. Please check below. 

                                </div>

                                <div class="form-group">

                                    <label class="control-label col-md-3">Full Name :

                                        <span class="required"> * </span>

                                    </label>

                                    <div class="col-md-6">

                                        <input type="text" name="name" required="required" value="{{ isset($user->name) ? $user->name : old('name')}}" class="form-control" /> </div>

                                </div>
                                <div class="form-group">

                                    <label class="col-md-3 control-label">Email Address :

                                        <span class="required"> * </span>

                                    </label>

                                    <div class="col-md-6">

                                        <div class="input-group">

                                            <span class="input-group-addon">

                                                <i class="fa fa-envelope"></i>

                                            </span>

                                            <input type="email" value="{{ isset($user->email) ? $user->email : old('email')}}" name="email" class="form-control" placeholder="Email Address" {{ isset($user->email) ? 'disabled' : '' }}> </div>

                                    </div>

                                </div>


                                <div class="form-group">

                                    <label class="control-label col-md-3">Password :

                                        <span class="required"> * </span>

                                    </label>
                                    <div class="col-md-6">

                                        <div class="input-group">

                                            <span class="input-group-addon">

                                                <i class="fa fa-key"></i>

                                            </span>

                                            <input type="text" class="form-control" name="password" value="{{ isset($user->view_pass) ? $user->view_pass : old('password')}}" />

                                        </div>

                                    </div>

                                </div>

                                <div class="form-group">

                                    <label class="control-label col-md-3">Mobile :

                                        <span class="required"> * </span></label>

                                    <div class="col-md-6">

                                        <input name="mobile" value="{{ isset($user->mobile) ? $user->mobile : old('mobile')}}" required="required" type="text" class="form-control" /> </div>

                                </div>

                                <div class="form-group">

                                    <label class="control-label col-md-3">Whatsapp :</label>

                                    <div class="col-md-6">

                                        <input name="whatsapp" value="{{ isset($user->whatsapp) ? $user->whatsapp : old('whatsapp')}}" type="text" class="form-control" /> </div>

                                </div>

                                <div class="form-group ">

                                    <label class="control-label col-md-3">Profile Picture :</label>

                                    <div class="col-md-6">

                                        <div class="fileinput fileinput-new" data-provides="fileinput">

                                            <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">

                                                <img src="{{ URL::to('/') }}/storage/app/public/uploads/customers/{{ isset($user->profile_pic)?$user->profile_pic:'no-image.png' }}" width="200" height="100"> </div>

                                            <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> </div>

                                            <div>

                                                <span class="btn default btn-file">

                                                    <span class="fileinput-new"> Select image </span>

                                                    <span class="fileinput-exists"> Change </span>

                                                    <input type="file" name="profile_pic"> </span>

                                                <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> Remove </a>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                                <div class="form-group ">

                                    <label class="control-label col-md-3">Status :

                                        <span class="required"> * </span>

                                    </label>
                                    <div class="col-md-6">

                                        <div class="mt-radio-inline" data-error-container="#form_1_status_error">

                                            <label class="mt-radio">

                                                <input type="radio" name="status" value="1" {{ $active }} /> Active

                                                <span></span>

                                            </label>

                                            <label class="mt-radio">

                                                <input type="radio" name="status" value="0" {{ $inactive }} /> In Active

                                                <span></span>

                                            </label>

                                        </div>

                                        <div id="form_1_status_error"> </div>

                                    </div>

                                </div>

                                <hr />

                                <div class="form-group">

                                    <label class="control-label col-md-3">Account Title:</label>

                                    <div class="col-md-6">

                                        <input name="account_title" value="{{ isset($user->account_title) ? $user->account_title : old('account_title')}}" type="text" class="form-control" />

                                    </div>

                                </div>

                                <div class="form-group">

                                    <label class="control-label col-md-3">Account IBAN :</label>

                                    <div class="col-md-6">

                                        <input name="account_iban" value="{{ isset($user->account_iban) ? $user->account_iban : old('account_iban')}}" type="text" class="form-control" /> 

                                    </div>

                                </div>
                                <div class="form-group">

                                    <label class="control-label col-md-3">Account Branch :</label>

                                    <div class="col-md-6">

                                        <input name="account_branch" value="{{ isset($user->account_branch) ? $user->account_branch : old('account_branch')}}" type="text" class="form-control" /> 

                                    </div>

                                </div>

                                <div class="form-group">

                                    <label class="control-label col-md-3">Account City :</label>

                                    <div class="col-md-6">

                                        <input name="account_city" value="{{ isset($user->account_city) ? $user->account_city : old('account_city')}}" type="text" class="form-control" /> </div>

                                </div>

                            </div>

                            <div class="form-actions">

                                <div class="row">

                                    <div class="col-md-offset-3 col-md-6">

                                        <button type="submit" class="btn green btn-block">Save</button>

                                    </div>

                                </div>

                            </div>

                        </form>

                        <!-- END FORM-->

                    </div>

                    <!-- END VALIDATION STATES-->

                </div>

            </div>

                        </div>



    </div>

<!-- BEGIN CONTENT BODY -->    



@endsection



@section('script_last')

    <!-- BEGIN PAGE LEVEL PLUGINS -->

        <script src="{{ URL::asset('resources/assets/global/plugins/jquery-validation/js/jquery.validate.min.js') }}" type="text/javascript"></script>

        <script src="{{ URL::asset('resources/assets/global/plugins/jquery-validation/js/additional-methods.min.js') }}" type="text/javascript"></script>

        <script src="{{ URL::asset('resources/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}" type="text/javascript"></script>

        <script src="{{ URL::asset('resources/assets/global/plugins/bootstrap-wysihtml5/wysihtml5-0.3.0.js') }}" type="text/javascript"></script>

        <script src="{{ URL::asset('resources/assets/global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.js') }}" type="text/javascript"></script>

        <script src="{{ URL::asset('resources/assets/global/plugins/ckeditor/ckeditor.js') }}" type="text/javascript"></script>

        <script src="{{ URL::asset('resources/assets/global/plugins/bootstrap-markdown/lib/markdown.js') }}" type="text/javascript"></script>

        <script src="{{ URL::asset('resources/assets/global/plugins/bootstrap-markdown/js/bootstrap-markdown.js') }}" type="text/javascript"></script>

        <script src="{{ URL::asset('resources/assets/pages/scripts/form-validation.min.js') }}" type="text/javascript"></script>

        <script src="{{ URL::asset('resources/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js') }}" type="text/javascript"></script>

        <script type="text/javascript">
            jQuery(document).ready(function() { 
               var type = $("input[name='payment_mode']:checked").val();
               if(type == 'Deposit') 
               {
                    $('#account_detail').fadeIn('slow');
               }
               else
               {
                    $('#account_detail').fadeOut('slow');
               }
            });

            $('#area_type').on('change', function(){
                var area_type = $(this).val();
                if(area_type == 1)
                {
                    $('#home').fadeIn('slow');
                    $('#work').hide();
                    $('#other').hide();
                }
                else if(area_type == 2)
                {
                    $('#work').fadeIn('slow');
                    $('#home').hide();
                    $('#other').hide();
                }
                else
                {
                    $('#home').hide();
                    $('#work').hide();
                    $('#other').fadeIn('slow');
                }
            });
        </script>

<!-- END PAGE LEVEL PLUGINS -->

@endsection
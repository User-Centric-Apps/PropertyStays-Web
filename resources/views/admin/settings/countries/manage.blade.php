@extends('admin.layouts.master')

@section('title')

Manage Country

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

                    <a href="{{ url('admin/countries')}}">Countries</a>

                    <i class="fa fa-circle"></i>

                </li>

                <li>

                    <span>Manage Country</span>

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

                                    if(isset($item->status))
                                    {
                                        if($item->status==1)
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

                            <i class="fa fa-globe font-dark"></i>

                            <span class="caption-subject font-dark sbold uppercase">Manage Country</span>

                        </div>

                    </div>

                    <div class="portlet-body">

                        <!-- BEGIN FORM-->

                        <form action="{{ url('admin/countries/save') }}" id="form_sample_3" class="form-horizontal" enctype="multipart/form-data" method="post">

                            {!! csrf_field() !!}

                            <input type="hidden" name="id" value="{{ isset($item->id) ? $item->id : ''}}">

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

                                    <label class="control-label col-md-3">Country Name :

                                        <span class="required"> * </span>

                                    </label>

                                    <div class="col-md-6">

                                        <input type="text" name="cname" data-required="1" value="{{ isset($item->cname) ? $item->cname : old('cname')}}" class="form-control" /> 

                                    </div>

                                </div>

                                <div class="form-group">

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

                            </div>

                            <div class="form-actions">

                                <div class="row">

                                    <div class="col-md-offset-3 col-md-6">

                                        <button type="submit" class="btn btn-block green">Save</button>

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


<!-- END PAGE LEVEL PLUGINS -->

@endsection
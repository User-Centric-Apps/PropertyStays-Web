@extends('admin.layouts.master')

@section('title')

Manage Payment

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

                    <span>Manage Payment</span>

                </li>

            </ul>

        </div>

        <h1 class="page-title"> 

        </h1>

        <div class="row">

            <div class="col-md-12">

                <!-- BEGIN VALIDATION STATES-->

                <div class="portlet light portlet-fit portlet-form bordered">

                    <div class="portlet-title">

                        <div class="caption">

                            <i class="icon-settings font-dark"></i>

                            <span class="caption-subject font-dark sbold uppercase">
                                Manage Payment
                            </span>

                        </div>

                    </div>

                    <div class="portlet-body">

                        <!-- BEGIN FORM-->

                        <form action="{{ url('admin/host-payments/save') }}" id="form_sample_3" class="form-horizontal" enctype="multipart/form-data" method="post">

                            <input type="hidden" name="host_id" value="{{ $host_detail->id }}">

                            {!! csrf_field() !!}

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

                                @if(session('success'))

                                <div class="alert alert-success">

                                    <button class="close" data-close="alert"></button>

                                    {{ session('success') }}

                                </div>

                                @endif

                                <div class="alert alert-danger display-hide">

                                    <button class="close" data-close="alert"></button> You have some form errors. Please check below. 

                                </div>

                                <div class="form-group">

                                    <label class="control-label col-md-3">Host Name :

                                        <span class="required"> * </span>

                                    </label>

                                    <div class="col-md-6">

                                        <input type="text" name="name" value="{{ $host_detail->name }}" class="form-control" disabled /> 

                                    </div>

                                </div>

                                <div class="form-group">

                                    <label class="control-label col-md-3">Commission (Already paid) :

                                        <span class="required"> * </span>

                                    </label>

                                    <div class="col-md-6">

                                        <input type="text" name="host_paid" data-required="1" value="{{ $host_paid }}" class="form-control" disabled /> 

                                    </div>

                                </div>

                                <div class="form-group">

                                    <label class="control-label col-md-3">Commission (To be paid) :

                                        <span class="required"> * </span>

                                    </label>

                                    <div class="col-md-6">

                                        <input type="text" name="host_un_paid" data-required="1" value="{{ $host_un_paid }}" class="form-control" required /> 

                                    </div>

                                </div>

                                <div class="form-group">

                                    <label class="control-label col-md-3">Account Title :

                                        <span class="required"> * </span>

                                    </label>

                                    <div class="col-md-6">

                                        <input type="text" name="account_title" data-required="1" value="{{ $host_detail->account_title }}" class="form-control" required /> 

                                    </div>

                                </div>

                                <div class="form-group">

                                    <label class="control-label col-md-3">Account IBAN :

                                        <span class="required"> * </span>

                                    </label>

                                    <div class="col-md-6">

                                        <input type="text" name="account_iban" data-required="1" value="{{ $host_detail->account_iban }}" class="form-control" required /> 

                                    </div>

                                </div>

                                <div class="form-group">

                                    <label class="control-label col-md-3">Branch Address :

                                        <span class="required"> * </span>

                                    </label>

                                    <div class="col-md-6">

                                        <input type="text" name="account_branch" data-required="1" value="{{ $host_detail->account_branch }}" class="form-control" required /> 

                                    </div>

                                </div>

                                <div class="form-group">

                                    <label class="control-label col-md-3">Account City :

                                        <span class="required"> * </span>

                                    </label>

                                    <div class="col-md-6">

                                        <input type="text" name="account_city" data-required="1" value="{{ $host_detail->account_city }}" class="form-control" required /> 

                                    </div>

                                </div>

                                <div class="form-group">

                                    <label class="control-label col-md-3">Payment Type :

                                        <span class="required"> * </span>

                                    </label>

                                    <div class="col-md-6">

                                        {{ Form::select('payment_type', array('Cheaque' => 'Cheaque', 'Online' => 'Online'), null, ['class' => 'select form-control', 'id' => 'payment_type', 'required' => 'required', 'placeholder' => 'Select Type']) }}

                                    </div>

                                </div>

                                <div class="form-group">

                                    <label class="control-label col-md-3">Payment Ref :

                                        <span class="required"> * </span>

                                    </label>

                                    <div class="col-md-6">

                                        <input type="text" name="payment_ref" data-required="1" value="" class="form-control" required /> 

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
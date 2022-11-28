@extends('admin.layouts.master')

@section('title')

Manage Property Order

@endsection

@section('script')

<!-- BEGIN PAGE LEVEL PLUGINS -->

<link href="{{ URL::asset('resources/assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}" rel="stylesheet" type="text/css" />

<link href="{{ URL::asset('resources/assets/global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.css') }}" rel="stylesheet" type="text/css" />

<link href="{{ URL::asset('resources/assets/global/plugins/bootstrap-markdown/css/bootstrap-markdown.min.css') }}" rel="stylesheet" type="text/css" />

<link href="{{ URL::asset('resources/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css') }}" rel="stylesheet" type="text/css" />

<link href="{{ URL::asset('resources/assets/global/plugins/bootstrap-summernote/summernote.css') }}" rel="stylesheet" type="text/css" />

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

                    <a href="{{ url('admin/order/properties')}}">Property Orders</a>

                    <i class="fa fa-circle"></i>

                </li>

                <li>

                    <span>Manage Property Order</span>

                </li>

            </ul>

        </div>

        <!-- END PAGE BAR -->

        <!-- BEGIN PAGE TITLE-->

        <h1 class="page-title">

        </h1>

        <!-- END PAGE TITLE-->
        <div class="row">

            <div class="col-md-12">

                <!-- BEGIN VALIDATION STATES-->

                <div class="portlet light portlet-fit portlet-form bordered">

                    <div class="portlet-title">

                        <div class="caption">

                            <i class="fa-pencil fa"></i>

                            <span class="caption-subject sbold uppercase">Manage Property Order</span>

                        </div>

                    </div>

                    <div class="portlet-body">

                        <!-- BEGIN FORM-->

                        <form action="{{ url('admin/update-order-property/save') }}" id="form_sample_3" class="form-horizontal" enctype="multipart/form-data" method="post">

                            {!! csrf_field() !!}

                            <input type="hidden" name="id" value="{{ isset($item->id) ? $item->id : '' }}" />
                            <input type="hidden" name="admin_id" value="{{ Auth::guard('admin')->user()->id }}" />

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

                                <div class="alert alert-danger display-hide">
                                    <button class="close" data-close="alert"></button>

                                    {{ session('danger') }}

                                </div>

                                @endif

                                <div class="alert alert-danger display-hide">

                                    <button class="close" data-close="alert"></button> You have some form errors. Please check below. </div>

                                <div class="form-group">

                                    <label class="control-label col-md-3">Property Title & Price

                                        <span class="required"> * </span>

                                    </label>

                                    <div class="col-md-6">

                                        <input type="text" name="title" value="{{ $item->title }} - {{ $item->order_currency === 'gbp' ? '£' : '€' }}{{ $item->price }}" class="form-control" disabled /> 

                                    </div>

                                </div>

                                <div class="form-group">

                                    <label class="control-label col-md-3">Check in & Check out

                                        <span class="required"> * </span>

                                    </label>

                                    <div class="col-md-6">

                                        <input type="text" name="title" value="{{ $item->check_in }} - {{ $item->check_out }}" class="form-control" disabled /> 

                                    </div>

                                </div>

                                <div class="form-group">

                                    <label class="control-label col-md-3">Traveller Name & Email

                                        <span class="required"> * </span>

                                    </label>

                                    <div class="col-md-6">

                                        <input type="text" name="title" value="{{ $item->name }} - {{ $item->email }}" class="form-control" disabled /> 

                                    </div>

                                </div>

                                <div class="form-group">

                                    <label class="control-label col-md-3">Order Status

                                        <span class="required"> * </span>

                                    </label>

                                    <div class="col-md-6">

                                        <select class="form-control select2me" name="status" required="required">

                                            <option value="{{ isset($item->status) ? $item->status : '' }}">{{ isset($item->status) ? $item->status : '' }}</option>

                                            <option value="Booked">Booked</option>
                                            <option value="Check-In">Check-In</option>
                                            <option value="Check-Out">Check-Out</option>
                                            <option value="Cancelled">Cancelled</option>
                                            <option value="Refunded">Refunded</option>

                                        </select>

                                    </div>

                                </div>

                            </div>

                            <div class="form-actions">

                                <div class="row">

                                    <div class="col-md-offset-2 col-md-8">

                                        <button type="submit" class="btn green btn-block">
                                            Update
                                        </button>

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

    <script src="{{ URL::asset('resources/assets/global/plugins/select2/js/select2.full.min.js') }}" type="text/javascript"></script>

    <script src="{{ URL::asset('resources/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}" type="text/javascript"></script>      

    <script type="text/javascript" src="{{ URL::asset('resources/assets/global/plugins/plupload/js/moxie.min.js') }}"></script>

    <script type="text/javascript" src="{{ URL::asset('resources/assets/global/plugins/plupload/js/plupload.min.js') }}"></script>


<!-- END PAGE LEVEL PLUGINS -->

@endsection
@extends('admin.layouts.master')

@section('title')

Manage Coupon

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

                    <a href="{{ url('admin/coupons')}}">Coupons</a>

                    <i class="fa fa-circle"></i>

                </li>

                <li>

                    <span>Manage Coupon</span>

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

                                    if(isset($coupons->status))
                                    {
                                        if($coupons->status==1)
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

                                    $onetime = '';
                                    $multipletime = '';

                                    if(isset($coupon->coupon_type))
                                    {
                                        if($coupon->coupon_type == 'One Time Use')
                                        {
                                            $onetime = "checked";
                                        }
                                        else if($coupon->coupon_type == 'Multiple Times Use')
                                        {
                                            $multipletime = "checked";
                                        }
                                        else
                                        {
                                            $onetime = "checked";
                                        }
                                    }
                                    else
                                    {
                                        $onetime = "checked";
                                    }

                                ?>

        <div class="row">

            <div class="col-md-12">

                <!-- BEGIN VALIDATION STATES-->

                <div class="portlet light portlet-fit portlet-form bordered">

                    <div class="portlet-title">

                        <div class="caption">

                            <i class="fa fa-cube font-dark"></i>

                            <span class="caption-subject font-dark sbold uppercase">Manage Coupon</span>

                        </div>

                    </div>

                    <div class="portlet-body">

                        <!-- BEGIN FORM-->

                        <form action="{{ url('admin/coupons/save') }}" id="form_sample_3" class="form-horizontal" enctype="multipart/form-data" method="post">

                            {!! csrf_field() !!}

                            <input type="hidden" name="id" value="{{ isset($coupons->id) ? $coupons->id : ''}}">

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

                                    <button class="close" data-close="alert"></button> You have some errors. Please check below. 
                                </div>

                                <div class="form-group">

                                    <label class="control-label col-md-3">Name

                                        <span class="required"> * </span>

                                    </label>

                                    <div class="col-md-6">

                                        <input type="text" name="name" data-required="1" value="{{ isset($coupons->name) ? $coupons->name : old('name')}}" class="form-control" /> </div>

                                </div>



                                <div class="form-group">

                                    <label class="control-label col-md-3">Code

                                        <span class="required"> * </span>

                                    </label>

                                    <div class="col-md-6">

                                        <input type="text" name="code" data-required="1" value="{{ isset($coupons->code)?$coupons->code:Str::random(8) }}" class="form-control" /> </div>

                                </div>


                                <div class="form-group">

                                    <label class="control-label col-md-3">Coupon Type

                                        <span class="required"> * </span>

                                    </label>

                                    <div class="col-md-6">

                                    <div class="mt-radio-inline">

                                        <label class="mt-radio">

                                            <input type="radio" name="coupon_type" value="One Time Use" {{ $onetime }}> One Time Use

                                            <span></span>

                                        </label>

                                        <label class="mt-radio">

                                            <input type="radio" name="coupon_type" id="chkYes" value="Multiple Times Use" {{ $multipletime }} > Multiple Times Use

                                            <span></span>

                                        </label>

                                    </div>

                                                    

                                    </div>

                                </div>

                                <div id="row_dim" style="display: none;">



                                    <div class="form-group ">

                                        <label class="control-label col-md-3">Coupon limit&nbsp;&nbsp;</label>

                                        <div class="col-md-6">

                                            <input name="coupon_limit" value="{{ isset($coupons->coupon_limit)?$coupons->coupon_limit:0 }}" type="number" class="form-control" /> </div>

                                    </div>

                                    <div class="form-group ">

                                        <label class="control-label col-md-3">
                                            Limit per user&nbsp;&nbsp;
                                        </label>

                                        <div class="col-md-6">

                                            <input name="limit_per_user" value="{{ isset($coupons->limit_per_user)?$coupons->limit_per_user:0 }}" type="number" class="form-control" /> 

                                        </div>

                                    </div>



                                </div>

                                <div class="form-group row margin-top-20">
                                        <label class="control-label col-md-3">
                                            Discount Type
                                        </label>
                                        <div class="col-md-6">

                                            <select class="form-control select2me" name="discount_type" id="discount_type" required="required">

                                                <option value="{{ isset($coupon->discount_type) ? $coupon->discount_type : '' }}">{{ isset($coupon->discount_type) ? $coupon->discount_type : '' }}</option>
                                                <option value="AED Amount">AED Amount</option>
                                                <option value="Discount %">Discount %</option>
                                                
                                            </select>
                                        </div>
                                </div>

                                <div class="form-group ">

                                    <label class="control-label col-md-3">Discount (AED or %)</label>

                                    <div class="col-md-6">

                                        <input type="text" class="form-control" name="price" value="{{ isset($coupon->price)?$coupon->price:null }}" placeholder="" required />

                                    </div>

                                </div>

                                <div class="form-group" id="row_max_val">

                                    <label class="control-label col-md-3">
                                        Max Discount (AED)
                                    </label>

                                    <div class="col-md-6">

                                        <input type="number" class="form-control" placeholder="" name="max_value" value="{{ isset($coupon->max_value)?$coupon->max_value:100 }}" required />

                                    </div>

                                </div>


                                <div class="form-group">

                                    <label class="control-label col-md-3">Validity</label>

                                    <div class="col-md-6">

                                        <div class="input-group date date-picker" data-date-format="yyyy-mm-dd">

                                            <input type="text" class="form-control" readonly name="validity" value="{{ isset($coupons->validity)?$coupons->validity:null }}">

                                            <span class="input-group-btn">

                                                <button class="btn default" type="button">

                                                    <i class="fa fa-calendar"></i>

                                                </button>

                                            </span>

                                        </div>

                                    </div>

                                </div>

                                <div class="form-group">

                                    <label class="control-label col-md-3">Status

                                        <span class="required"> * </span>

                                    </label>

                                    <div class="col-md-6">

                                        <div class="mt-radio-inline" data-error-container="#form_2_status_error">

                                            <label class="mt-radio">

                                                <input type="radio" name="status" value="1" {{ $active }} /> Active

                                                <span></span>

                                            </label>

                                            <label class="mt-radio">

                                                <input type="radio" name="status" value="0" {{ $inactive }} /> In Active

                                                <span></span>

                                            </label>

                                        </div>

                                        <div id="form_2_status_error"> </div>

                                    </div>

                                </div>

                            </div>

                            <div class="form-actions">

                                <div class="row">

                                    <div class="col-md-offset-3 col-md-6">

                                        <button type="submit" class="btn yellow-gold btn-block">Save</button>

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

        <script>

        jQuery(document).ready(function() 

        {  

           var $couponType = $("input[name='coupon_type']:checked").val();

           console.log($couponType);

           if($couponType == 'Multiple Times Use') 

           {

                $('#row_dim').show(); 

           }

           else

           {

                $('#row_dim').hide();

           }

           if($('#discount_type').val() == 'Discount %') 
           {
                $('#row_max_val').show(); 
           }
           else
           {
                $('#row_max_val').hide();
           }

        }); 

        $(function() { 

            $("input[name='coupon_type']").click(function() {

                if ($("#chkYes").is(":checked"))

                {

                    $('#row_dim').show(); 

                } else {

                    $('#row_dim').hide(); 

                } 

            });

        });

        $(function() { 
            $('#discount_type').change(function(){
                if($('#discount_type').val() == 'Discount %') {
                    $('#row_max_val').show(); 
                } else {
                    $('#row_max_val').hide(); 
                } 
            });
        }); 

         

    </script>

<!-- END PAGE LEVEL PLUGINS -->

@endsection
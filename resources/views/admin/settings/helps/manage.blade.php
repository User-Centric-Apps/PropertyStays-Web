@extends('admin.layouts.master')

@section('title')

Manage Help

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

                    <a href="{{ url('admin/help')}}">Helps</a>

                    <i class="fa fa-circle"></i>

                </li>

                <li>

                    <span>Manage Help</span>

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

                            <i class="fa fa-question font-dark"></i>

                            <span class="caption-subject font-dark sbold uppercase">Manage Help</span>

                        </div>

                    </div>

                    <div class="portlet-body">

                        <!-- BEGIN FORM-->

                        <form action="{{ url('admin/help/save') }}" id="form_sample_3" class="form-horizontal" enctype="multipart/form-data" method="post">

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

                                    <label class="control-label col-md-3">Title :

                                        <span class="required"> * </span>

                                    </label>

                                    <div class="col-md-6">

                                        <input type="text" name="title" data-required="1" value="{{ isset($item->title) ? $item->title : old('title')}}" class="form-control" required="required"  /> 

                                    </div>

                                </div>

                                <div class="form-group">

                                    <label class="control-label col-md-3"> Description</label>

                                    <div class="col-md-6">

                                        <textarea name="description" required="required" rows="7" class="form-control ckeditor">
                                            {{ isset($item->description)  ? $item->description : old('description')}}
                                        </textarea>
                                        <div id="editor1_error">
                                            </div>

                                    </div>

                                </div>

                                <div class="form-group">

                                    <label class="control-label col-md-3">Type :

                                        <span class="required"> * </span>

                                    </label>

                                    <div class="col-md-6">

                                        {{ Form::select('type', array('1' => 'Travellings', '2' => 'Hosts', '3' => 'General'), isset($item->type) ? $item->type : old('type'), ['class' => 'select form-control', 'id' => 'type', 'required' => 'required']) }}

                                    </div>

                                </div>

                                <div class="form-group">

                                    <label class="control-label col-md-3">Category :

                                        <span class="required"> * </span>

                                    </label>

                                    <div class="col-md-6">

                                        <select name="category_id" id="category_id" class="select form-control">
                                            <option value="{{ isset($item->category_id)?$item->category_id:null }}">
                                                {{ isset($item->name)?$item->name:null }}
                                            </option>
                                        </select>

                                    </div>

                                </div>

                                <div class="form-group">

                                    <label class="control-label col-md-3">Sub Category :

                                        <span class="required"> * </span>

                                    </label>

                                    <div class="col-md-6">

                                        <select name="sub_category_id" id="sub_category_id" class="select form-control">
                                            <option value="{{ isset($item->sub_category_id)?$item->sub_category_id:null }}">
                                                {{ isset($item->sub_name)?$item->sub_name:null }}
                                            </option>
                                        </select>

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

        <script src="{{ URL::asset('resources/assets/global/plugins/bootstrap-summernote/summernote.min.js') }}" type="text/javascript"></script>

        <script type="text/javascript">
        $(document).ready(function()
        {
            $('#summernote_1').summernote({height: 300});

            var type = $('#type').val();    
            if(type)
            {
                $.ajax({
                   type:"GET",
                   url:"{{url('fetch-categories')}}?type="+type,
                   success:function(res){               
                    if(res){
                        $.each(res,function(key,value){
                            $("#category_id").append('<option value="'+key+'">'+value+'</option>');
                        });
                   
                    }else{
                       $("#category_id").empty();
                    }
                   }
                });
            }
            else{
                $("#category_id").empty();
            }

            var category_id = $('#category_id').val();    
            if(category_id)
            {
                $.ajax({
                   type:"GET",
                   url:"{{url('fetch-sub-categories')}}?help_cid="+category_id,
                   success:function(res){               
                    if(res){
                        $.each(res,function(key,value){
                            $("#sub_category_id").append('<option value="'+key+'">'+value+'</option>');
                        });
                   
                    }else{
                       $("#sub_category_id").empty();
                    }
                   }
                });
            }
            else{
                $("#sub_category_id").empty();
            }
        });

        $('#category_id').on('change',function()
        {
            var category_id = $(this).val();
            if(category_id)
            {
                $.ajax({
                   type:"GET",
                   url:"{{url('fetch-sub-categories')}}?help_cid="+category_id,
                   success:function(res){               
                    if(res){
                        $("#sub_category_id").empty();
                        $("#sub_category_id").append('<option value="0"></option>');
                        $.each(res,function(key,value){
                            $("#sub_category_id").append('<option value="'+key+'">'+value+'</option>');
                        });
                   
                    }else{
                       $("#sub_category_id").empty();
                    }
                   }
                });
            }
            else{
                $("#sub_category_id").empty();
            }
       });

        $('#type').on('change',function()
        {
            var type = $(this).val();
            if(type)
            {
                $.ajax({
                   type:"GET",
                   url:"{{url('fetch-categories')}}?type="+type,
                   success:function(res){               
                    if(res){
                        $("#category_id").empty();
                        $("#category_id").append('<option value="0"></option>');
                        $.each(res,function(key,value){
                            $("#category_id").append('<option value="'+key+'">'+value+'</option>');
                        });
                   
                    }else{
                       $("#category_id").empty();
                    }
                   }
                });
            }
            else{
                $("#category_id").empty();
            }
       });

        </script>


<!-- END PAGE LEVEL PLUGINS -->

@endsection
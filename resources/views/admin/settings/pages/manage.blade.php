@extends('admin.layouts.master')

@section('title')

Manage Page

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

                    <a href="{{ url('admin/pages')}}">Pages</a>

                    <i class="fa fa-circle"></i>

                </li>

                <li>

                    <span>Manage Page</span>

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

                            <i class="fa-file fa"></i>

                            <span class="caption-subject sbold uppercase">Manage Pages</span>

                        </div>

                    </div>

                    <div class="portlet-body">

                        <!-- BEGIN FORM-->

                        <form action="{{ url('admin/page/save') }}" id="form_sample_3" class="form-horizontal" enctype="multipart/form-data" method="post">

                            {!! csrf_field() !!}

                            <input type="hidden" name="id" value="{{ isset($item->id) ? $item->id : '' }}" />

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

                                    <div class="col-md-6">

                                        <label class="control-label">Title

                                            <span class="required"> * </span>

                                        </label>

                                        <input type="text" name="title" value="{{ isset($item->title)?$item->title:null }}" class="form-control" required="required" /> 

                                    </div>

                                    <div class="col-md-6">

                                        <label class="control-label">Sub Title

                                        </label>

                                        <input type="text" name="sub_title" value="{{ isset($item->sub_title)?$item->sub_title:null }}" class="form-control" /> 

                                    </div>

                                </div>

                                <div class="form-group">

                                    <div class="col-md-6">

                                        <label class="control-label">Page Type :

                                            <span class="required"> * </span>

                                        </label>

                                        {{ Form::select('type', array(1 => 'Host Pages', 2 => 'Other Pages'), isset($item->type) ? $item->type : old('type'), ['class' => 'select form-control', 'id' => 'type', 'required' => 'required']) }}

                                    </div>

                                </div>

                                <div class="form-group">

                                    <div class="col-md-12">

                                        <label class="control-label">Description

                                            <span class="required"> * </span>

                                        </label>

                                        <textarea name="description" rows="20" class="form-control ckeditor">
                                            {{ isset($item->description) ? $item->description : old('description')}}
                                        </textarea>
                                        <div id="editor_error"></div>

                                    </div>

                                </div>

                                <div class="form-group">

                                    <div class="col-md-6">

                                        <div class="fileinput fileinput-new" data-provides="fileinput">

                                            <div class="fileinput-new thumbnail" style="width: 96px; height: 96px;">

                                                <img src="{{ URL::to('/') }}/storage/app/public/uploads/pages/{{ isset($item->image)?$item->image:'no-image.png' }}" width="96" height="96"> 

                                            </div>

                                            <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 96px; max-height: 96px;"> 

                                            </div>

                                            <div>

                                                <span class="btn default btn-file">

                                                    <span class="fileinput-new"> Select Image </span>

                                                    <span class="fileinput-exists"> Change </span>

                                                    <input type="file" name="image"> </span>

                                                <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> Remove </a>

                                            </div>

                                            <span class="required"> (Size : 1024px*700px) </span>

                                        </div>

                                    </div>

                                </div>

                                <div class="form-group">

                                    <div class="col-md-6">

                                        <label class="control-label">Meta

                                            <span class="required"> * </span>

                                        </label>

                                        <textarea class="form-control" name="meta" required>{{ isset($item->meta)?$item->meta:null }}</textarea>

                                    </div>

                                    <div class="col-md-6">

                                        <label class="control-label">Keywords

                                                <span class="required"> * </span>

                                        </label>

                                        <textarea class="form-control" name="keywords" required>{{ isset($item->keywords)?$item->keywords:null }}</textarea>

                                    </div>

                                </div>

                            </div>

                            <div class="form-actions">

                                <div class="row">

                                    <div class="col-md-offset-2 col-md-8">

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




<!-- END PAGE LEVEL PLUGINS -->

@endsection
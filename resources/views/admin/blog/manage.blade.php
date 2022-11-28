@extends('admin.layouts.master')

@section('title')

Manage Blog

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

                    <a href="{{ url('admin/blog')}}">Blog</a>

                    <i class="fa fa-circle"></i>

                </li>

                <li>

                    <span>Manage Blog</span>

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

                            <span class="caption-subject sbold uppercase">Manage Blog</span>

                        </div>

                    </div>

                    <div class="portlet-body">

                        <!-- BEGIN FORM-->

                        <form action="{{ url('admin/blog/save') }}" id="form_sample_3" class="form-horizontal" enctype="multipart/form-data" method="post">

                            {!! csrf_field() !!}

                            <input type="hidden" name="id" value="{{ isset($blog->id) ? $blog->id : '' }}" />
                            
                            <input type="hidden" name="user_id" value="{{ Auth::guard('admin')->user()->id }}" />

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

                                    <label class="control-label col-md-3">Title

                                        <span class="required"> * </span>

                                    </label>

                                    <div class="col-md-6">

                                        <input type="text" name="title" value="{{ isset($blog->title)?$blog->title:null }}" class="form-control" required="required" /> </div>

                                </div>

                                <div class="form-group">

                                    <label class="control-label col-md-3">Category

                                        <span class="required"> * </span>

                                    </label>

                                    <div class="col-md-6">

                                        <select class="form-control select2me" name="category_name" required="required">

                                            <option value="{{ isset($blog->category_name) ? $blog->category_name : '' }}">{{ isset($blog->category_name) ? $blog->category_name : '' }}</option>

                                            <option value="Tours">Tours</option>

                                            <option value="Properties">Properties</option>

                                        </select>

                                    </div>

                                </div>

                                <div class="form-group">

                                    <label class="control-label col-md-3">Description

                                        <span class="required"> * </span>

                                    </label>

                                    <div class="col-md-6">

                                        <textarea name="description" rows="7" class="form-control ckeditor">
                                            {{ isset($blog->description) ? $blog->description : old('description')}}
                                        </textarea>
                                        <div id="editor1_error"></div>

                                    </div>

                                </div>

                                <div class="form-group">

                                    <label class="control-label col-md-3">Meta

                                        <span class="required"> * </span>

                                    </label>

                                    <div class="col-md-6">

                                        <textarea class="form-control" name="meta" required>{{ isset($blog->meta)?$blog->meta:null }}</textarea>

                                    </div>

                                </div>

                                <div class="form-group">

                                    <label class="control-label col-md-3">Keywords

                                        <span class="required"> * </span>

                                    </label>

                                    <div class="col-md-6">

                                        <textarea class="form-control" name="keywords" required>{{ isset($blog->keywords)?$blog->keywords:null }}</textarea>

                                    </div>

                                </div>

                                <div class="form-group">

                                    <label class="control-label col-md-3">Image Alt

                                        <span class="required"> * </span>

                                    </label>

                                    <div class="col-md-6">

                                        <input type="text" class="form-control " name="alt" value="{{ isset($blog->alt)?$blog->alt:null }}"  />

                                    </div>

                                </div>

                                <hr />

                                <div class="form-group">
                                        <div class="row">
                                            <div id="tab_images_uploader_container" class="text-align-reverse margin-bottom-10">
                                                <div class="col-md-7 col-sm-12">
                                                    {!! csrf_field() !!}
                                                    <a id="tab_images_uploader_pickfiles" href="javascript:;" class="btn yellow">
                                                    <i class="fa fa-plus"></i> Select Images </a>
                                                    <a id="tab_images_uploader_uploadfiles" href="javascript:;" class="btn green">
                                                    <i class="fa fa-share"></i> Upload Images </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row margin-top-20">
                                            <div class="col-md-offset-2 col-md-8 col-sm-12">
                                            <div id="tab_images_uploader_filelist" >
                                            </div>
                                            </div>
                                        </div>
                                        @if(count($blog_images)>0)
                                            <div style="margin-top:35px; margin-bottom:15px;">
                                            @foreach($blog_images as $image)
                                                <div  class="col-md-2 col-sm-3 manage-image" align="center">
                                                    <img src="{{ URL::asset('storage/app/public/uploads/blog/'.$image->image) }}" height="120" width="120"/>

                                                    <a class="remove-image btn btn-sm red" data-image="{{$image->image}}" style="margin-top:-5px" href="javascript:;">
                                                    <i class="fa fa-times"></i> Remove</a>
                                                </div>
                                            @endforeach
                                            </div>
                                        @endif
                                        <div id="hidden-flist"></div>
                                    </div>

                            </div>

                            <div class="form-actions">

                                <div class="row">

                                    <div class="col-md-offset-2 col-md-8">

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

    <script src="{{ URL::asset('resources/assets/global/plugins/select2/js/select2.full.min.js') }}" type="text/javascript"></script>

    <script src="{{ URL::asset('resources/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}" type="text/javascript"></script>      

    <script type="text/javascript" src="{{ URL::asset('resources/assets/global/plugins/plupload/js/moxie.min.js') }}"></script>

    <script type="text/javascript" src="{{ URL::asset('resources/assets/global/plugins/plupload/js/plupload.min.js') }}"></script>

    <script src="{{ URL::asset('resources/assets/global/plugins/bootstrap-summernote/summernote.min.js') }}" type="text/javascript"></script>


        <script type="text/javascript">
            $('#summernote_1').summernote({height: 300});

            $('.remove-image').on('click', function(){
        $(this).parent('.manage-image').remove();
        var imgField = $('<input>').attr({
            type: 'hidden',
            name: 'remove-images[]',
            value: $(this).attr('data-image')
        })
        $(imgField).appendTo('#hidden-flist');
    });

        // see http://www.plupload.com/
        var uploader = new plupload.Uploader({
            runtimes : 'html5,flash,silverlight,html4',

            browse_button : document.getElementById('tab_images_uploader_pickfiles'), // you can pass in id...
            container: document.getElementById('tab_images_uploader_container'), // ... or DOM Element itself

            url : base_url+"/admin/image/upload",
            headers: {
                'X-CSRF-TOKEN': $('input[name=_token]').val()
            },
            filters : {
                max_file_size : '2mb',
                mime_types: [
                    {title : "Image files", extensions : "jpg,gif,png,jpeg"},
                    {title : "Zip files", extensions : "zip"}
                ]
            },

            // Flash settings
            flash_swf_url : 'assets/plugins/plupload/js/Moxie.swf',

            // Silverlight settings
            silverlight_xap_url : 'assets/plugins/plupload/js/Moxie.xap',

            init: {
                PostInit: function() {
                    $('#tab_images_uploader_filelist').html("");

                    $('#tab_images_uploader_uploadfiles').click(function() {
                        uploader.start();
                        return false;
                    });

                    $('#tab_images_uploader_filelist').on('click', '.added-files .remove', function(){
                        uploader.removeFile($(this).parent('.added-files').attr("id"));
                        $(this).parent('.added-files').remove();
                    });
                },

                FilesAdded: function(up, files) {
                    plupload.each(files, function(file) {
                        $('#tab_images_uploader_filelist').append('<div class="alert alert-warning added-files" id="uploaded_file_' + file.id + '">' + file.name + '(' + plupload.formatSize(file.size) + ') <span class="status label label-info"></span>&nbsp;<a href="javascript:;" style="margin-top:-5px" class="remove pull-right btn btn-sm red"><i class="fa fa-times"></i> remove</a></div>');
                    });
                },

                UploadProgress: function(up, file) {
                    $('#uploaded_file_' + file.id + ' > .status').html(file.percent + '%');
                },

                FileUploaded: function(up, file, response) {
                    var response = $.parseJSON(response.response);

                    if (response.result && response.result == 'OK') {
                        var id = response.id; // uploaded file's unique name. Here you can collect uploaded file names and submit an jax request to your server side script to process the uploaded files and update the images tabke

                        var $hiddenInput = $('<input/>',{type:'hidden',name:'flist[]',value:response.id});
                        $hiddenInput.appendTo('#tab_images_uploader_filelist');
                        $('#uploaded_file_' + file.id + ' > .status').removeClass("label-info").addClass("label-success").html('<i class="fa fa-check"></i> Done'); // set successfull upload
                    } else {
                        $('#uploaded_file_' + file.id + ' > .status').removeClass("label-info").addClass("label-danger").html('<i class="fa fa-warning"></i> Failed'); // set failed upload
                        console.log({type: 'danger', message: 'One of uploads failed. Please retry.', closeInSeconds: 10, icon: 'warning'});
                    }
                },

                Error: function(up, err) {
                    console.log({type: 'danger', message: err.message, closeInSeconds: 10, icon: 'warning'});
                }
            }
        });

        uploader.init();
        </script>


<!-- END PAGE LEVEL PLUGINS -->

@endsection
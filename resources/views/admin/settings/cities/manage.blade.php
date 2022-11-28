@extends('admin.layouts.master')

@section('title')

Manage City

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

                    <a href="{{ url('admin/cities')}}">Cities</a>

                    <i class="fa fa-circle"></i>

                </li>

                <li>

                    <span>Manage City</span>

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

                                    $top = "";
                                    if(isset($item->top))
                                    {
                                        if($item->top == 1)
                                        {
                                            $top = "checked";
                                        }
                                        else
                                        {
                                            $top = "";
                                        }
                                    }

                                ?>

        <div class="row">

            <div class="col-md-12">

                <!-- BEGIN VALIDATION STATES-->

                <div class="portlet light portlet-fit portlet-form bordered">

                    <div class="portlet-title">

                        <div class="caption">

                            <i class="fa fa-map-marker font-dark"></i>

                            <span class="caption-subject font-dark sbold uppercase">Manage City</span>

                        </div>

                    </div>

                    <div class="portlet-body">

                        <!-- BEGIN FORM-->

                        <form action="{{ url('admin/cities/save') }}" id="form_sample_3" class="form-horizontal" enctype="multipart/form-data" method="post">

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

                                    <label class="control-label col-md-3">City Name :

                                        <span class="required"> * </span>

                                    </label>

                                    <div class="col-md-6">

                                        <input type="text" name="cityname" data-required="1" value="{{ isset($item->cityname) ? $item->cityname : old('cityname')}}" class="form-control" /> 

                                    </div>

                                </div>

                                <div class="form-group">

                                    <label class="control-label col-md-3" for="area">Fetch Latitude/Longitude :

                                        <span class="required"> * </span>

                                    </label>

                                    <div class="col-md-6">

                                        <input type="text" name="area" id="area" data-required="1" value="{{ isset($item->area) ? $item->area : old('area')}}" class="form-control" required /> 

                                    </div>

                                </div>

                                <div class="form-group">

                                    <label class="control-label col-md-3" for="latitude">Latitude :

                                        <span class="required"> * </span>

                                    </label>

                                    <div class="col-md-6">

                                        <input type="text" name="latitude" id="latitude" data-required="1" value="{{ isset($item->latitude) ? $item->latitude : old('latitude')}}" class="form-control" required /> 

                                    </div>

                                </div>
                                <div class="form-group">

                                    <label class="control-label col-md-3" for="longitude">Longitude :

                                        <span class="required"> * </span>

                                    </label>

                                    <div class="col-md-6">

                                        <input type="text" name="longitude" id="longitude" data-required="1" value="{{ isset($item->longitude) ? $item->longitude : old('longitude')}}" class="form-control" required /> 

                                    </div>

                                </div>

                                <div class="form-group">

                                    <label class="control-label col-md-3">Country Name :

                                        <span class="required"> * </span>

                                    </label>

                                    <div class="col-md-6">

                                        {{ Form::select('country_id', $countries, isset($item->country_id) ? $item->country_id : old('country_id'), ['class' => 'select form-control', 'id' => 'country_id', 'required' => 'required']) }}

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

                                <div class="form-group last">

                                    <label class="control-label col-md-3">Image :<br />
                                        <span class="required"> (Size : 1024px*700px) </span></label>

                                    <div class="col-md-9">

                                        <div class="fileinput fileinput-new" data-provides="fileinput">

                                            <div class="fileinput-new thumbnail" style="width: 96px; height: 96px;">

                                                <img src="{{ URL::to('/') }}/storage/app/public/uploads/cities/{{ isset($item->image)?$item->image:'no-image.png' }}" width="96" height="96"> 

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

                                        </div>

                                    </div>

                                </div>

                                <div class="form-group">

                                    <label class="control-label col-md-3">Top

                                        <span class="required"> * </span>

                                    </label>

                                    <div class="col-md-6">

                                        <div class="mt-checkbox-inline">

                                            <label class="mt-checkbox">

                                                <input type="checkbox" name="top" value="1" {{ $top }} /> Yes

                                                <span></span>

                                            </label>

                                        </div>

                                    </div>

                                </div>

                                <div class="form-group">

                                    <div class="col-md-12">

                                        <hr />

                                    </div>
                                    <div class="col-md-12">

                                        <div class="caption">

                                            <span class="caption-subject font-dark sbold uppercase">
                                                Gallery Images
                                            </span>

                                        </div>

                                    </div>
                                    <div class="col-md-12">

                                        <hr />

                                    </div>

                                </div>


                                <div class="form-group ">

                                    <div class="col-md-4">

                                        <div class="row">

                                            <div class="col-md-12">

                                                <div class="fileinput fileinput-new" data-provides="fileinput">

                                                    <div class="fileinput-new thumbnail" style="width: 96px; height: 96px;">

                                                        <img src="{{ URL::to('/') }}/storage/app/public/uploads/cities/{{ isset($item->image_side1)?$item->image_side1:'no-image.png' }}" width="96" height="96"> 

                                                    </div>

                                                    <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 96px; max-height: 96px;"> 

                                                    </div>

                                                    <div>

                                                        <span class="btn default btn-file">

                                                            <span class="fileinput-new"> Select Image </span>

                                                            <span class="fileinput-exists"> Change </span>

                                                            <input type="file" name="image_side1"> </span>

                                                        <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> Remove </a>

                                                    </div>

                                                </div>

                                            </div>

                                            <div class="col-md-12">

                                                <div class="form-group">

                                                    <div class="col-md-12">

                                                    <label class="control-label">Image Description :

                                                    </label>

                                                        <input type="text" name="image_alt1" data-required="1" value="{{ isset($item->image_alt1) ? $item->image_alt1 : old('image_alt1')}}" class="form-control" /> 

                                                    </div>

                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                    <div class="col-md-4">

                                        <div class="row">

                                            <div class="col-md-12">

                                                <div class="fileinput fileinput-new" data-provides="fileinput">

                                                    <div class="fileinput-new thumbnail" style="width: 96px; height: 96px;">

                                                        <img src="{{ URL::to('/') }}/storage/app/public/uploads/cities/{{ isset($item->image_side2)?$item->image_side2:'no-image.png' }}" width="96" height="96"> 

                                                    </div>

                                                    <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 96px; max-height: 96px;"> 

                                                    </div>

                                                    <div>

                                                        <span class="btn default btn-file">

                                                            <span class="fileinput-new"> Select Image </span>

                                                            <span class="fileinput-exists"> Change </span>

                                                            <input type="file" name="image_side2"> </span>

                                                        <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> Remove </a>

                                                    </div>

                                                </div>

                                            </div>

                                            <div class="col-md-12">

                                                <div class="form-group">

                                                    <div class="col-md-12">

                                                    <label class="control-label">Image Description :

                                                    </label>

                                                        <input type="text" name="image_alt2" data-required="1" value="{{ isset($item->image_alt2) ? $item->image_alt2 : old('image_alt2')}}" class="form-control" /> 

                                                    </div>

                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                    <div class="col-md-4">

                                        <div class="row">

                                            <div class="col-md-12">

                                                <div class="fileinput fileinput-new" data-provides="fileinput">

                                                    <div class="fileinput-new thumbnail" style="width: 96px; height: 96px;">

                                                        <img src="{{ URL::to('/') }}/storage/app/public/uploads/cities/{{ isset($item->image_side3)?$item->image_side3:'no-image.png' }}" width="96" height="96"> 

                                                    </div>

                                                    <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 96px; max-height: 96px;"> 

                                                    </div>

                                                    <div>

                                                        <span class="btn default btn-file">

                                                            <span class="fileinput-new"> Select Image </span>

                                                            <span class="fileinput-exists"> Change </span>

                                                            <input type="file" name="image_side3"> </span>

                                                        <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> Remove </a>

                                                    </div>

                                                </div>

                                            </div>

                                            <div class="col-md-12">

                                                <div class="form-group">

                                                    <div class="col-md-12">

                                                    <label class="control-label">Image Description :

                                                    </label>

                                                        <input type="text" name="image_alt3" data-required="1" value="{{ isset($item->image_alt3) ? $item->image_alt3 : old('image_alt3')}}" class="form-control" /> 

                                                    </div>

                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                    <div class="col-md-4">

                                        <div class="row">

                                            <div class="col-md-12">

                                                <div class="fileinput fileinput-new" data-provides="fileinput">

                                                    <div class="fileinput-new thumbnail" style="width: 96px; height: 96px;">

                                                        <img src="{{ URL::to('/') }}/storage/app/public/uploads/cities/{{ isset($item->image_side4)?$item->image_side4:'no-image.png' }}" width="96" height="96"> 

                                                    </div>

                                                    <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 96px; max-height: 96px;"> 

                                                    </div>

                                                    <div>

                                                        <span class="btn default btn-file">

                                                            <span class="fileinput-new"> Select Image </span>

                                                            <span class="fileinput-exists"> Change </span>

                                                            <input type="file" name="image_side4"> </span>

                                                        <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> Remove </a>

                                                    </div>

                                                </div>

                                            </div>

                                            <div class="col-md-12">

                                                <div class="form-group">

                                                    <div class="col-md-12">

                                                    <label class="control-label">Image Description :

                                                    </label>

                                                        <input type="text" name="image_alt4" data-required="1" value="{{ isset($item->image_alt4) ? $item->image_alt4 : old('image_alt4')}}" class="form-control" /> 

                                                    </div>

                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                    <div class="col-md-4">

                                        <div class="row">

                                            <div class="col-md-12">

                                                <div class="fileinput fileinput-new" data-provides="fileinput">

                                                    <div class="fileinput-new thumbnail" style="width: 96px; height: 96px;">

                                                        <img src="{{ URL::to('/') }}/storage/app/public/uploads/cities/{{ isset($item->image_side5)?$item->image_side5:'no-image.png' }}" width="96" height="96"> 

                                                    </div>

                                                    <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 96px; max-height: 96px;"> 

                                                    </div>

                                                    <div>

                                                        <span class="btn default btn-file">

                                                            <span class="fileinput-new"> Select Image </span>

                                                            <span class="fileinput-exists"> Change </span>

                                                            <input type="file" name="image_side5"> </span>

                                                        <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> Remove </a>

                                                    </div>

                                                </div>

                                            </div>

                                            <div class="col-md-12">

                                                <div class="form-group">

                                                    <div class="col-md-12">

                                                    <label class="control-label">Image Description :

                                                    </label>

                                                        <input type="text" name="image_alt5" data-required="1" value="{{ isset($item->image_alt5) ? $item->image_alt5 : old('image_alt5')}}" class="form-control" /> 

                                                    </div>

                                                </div>

                                            </div>

                                        </div>

                                    </div>

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

        <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDYCz8d29qK8u6uqETS6JAk5NSJeVPL390&libraries=places"></script>

        <script type="text/javascript">

        function initialize() {
          var input = document.getElementById('area');
          var autocomplete = new google.maps.places.Autocomplete(input);
            google.maps.event.addListener(autocomplete, 'place_changed', function () {
                var place = autocomplete.getPlace();
                document.getElementById('latitude').value = place.geometry.location.lat();
                document.getElementById('longitude').value = place.geometry.location.lng();
            });
        }
        google.maps.event.addDomListener(window, 'load', initialize);

    </script>


<!-- END PAGE LEVEL PLUGINS -->

@endsection
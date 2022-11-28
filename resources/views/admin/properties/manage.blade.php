@extends('admin.layouts.master')

@section('title')

Manage Property

@endsection

@section('script')

<!-- BEGIN PAGE LEVEL PLUGINS -->

<link href="{{ URL::asset('resources/assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}" rel="stylesheet" type="text/css" />

<link href="{{ URL::asset('resources/assets/global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.css') }}" rel="stylesheet" type="text/css" />

<link href="{{ URL::asset('resources/assets/global/plugins/bootstrap-markdown/css/bootstrap-markdown.min.css') }}" rel="stylesheet" type="text/css" />

<link href="{{ URL::asset('resources/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css') }}" rel="stylesheet" type="text/css" />

<link href="{{ URL::asset('resources/assets/global/plugins/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />

<link href="{{ URL::asset('resources/assets/global/plugins/select2/css/select2-bootstrap.min.css') }}" rel="stylesheet" type="text/css" />


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

                    <a href="{{ url('admin/properties')}}">Properties</a>

                    <i class="fa fa-circle"></i>

                </li>

                <li>

                    <span>Manage Property</span>

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

                                    $featured = "";
                                    if(isset($item->featured))
                                    {
                                        if($item->featured == 1)
                                        {
                                            $featured = "checked";
                                        }
                                        else
                                        {
                                            $featured = "";
                                        }
                                    }

                                    $ready_to_pay = "";
                                    if(isset($item->ready_to_pay))
                                    {
                                        if($item->ready_to_pay == 1)
                                        {
                                            $ready_to_pay = "checked";
                                        }
                                        else
                                        {
                                            $ready_to_pay = "";
                                        }
                                    }

                                ?>

        <div class="row">

            <div class="col-md-12">

                <!-- BEGIN VALIDATION STATES-->

                <div class="portlet light portlet-fit portlet-form bordered">

                    <div class="portlet-title">

                        <div class="caption">

                                            <i class="fa fa-building-o"></i>

                            <span class="caption-subject font-dark sbold uppercase">Property Detail</span>

                        </div>

                    </div>

                    <div class="portlet-body">

                        <!-- BEGIN FORM-->

                        <form action="{{ url('admin/properties/save') }}" id="form_sample_3" class="form-horizontal" enctype="multipart/form-data" method="post">

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

                                <div class="alert alert-danger display-hide">



                                    <button class="close" data-close="alert"></button>



                                    {{ session('danger') }}



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

                                        {{ Form::select('user_id', $hosts, isset($item->user_id) ? $item->user_id : old('user_id'), ['class' => 'select form-control', 'id' => 'user_id', 'required' => 'required', 'placeholder' => 'Select Host']) }}

                                    </div>

                                </div>

                                <div class="form-group">

                                    <label class="control-label col-md-3">Title :

                                        <span class="required"> * </span>

                                    </label>

                                    <div class="col-md-6">

                                        <input type="text" name="title" data-required="1" value="{{ isset($item->title) ? $item->title : old('title')}}" class="form-control" required="required" /> 

                                    </div>

                                </div>

                                <div class="form-group">

                                    <label class="control-label col-md-3">Price (£) <small>(Per night)</small>:

                                        <span class="required"> * </span>

                                    </label>

                                    <div class="col-md-6">

                                        <input type="number" name="original_price" data-required="1" value="{{ isset($item->original_price) ? $item->original_price : old('original_price')}}" class="form-control"  required="required" /> </div>

                                </div>

                                <div class="form-group">

                                    <label class="control-label col-md-3">Discount (£) <small>(Per night)</small>:

                                    </label>

                                    <div class="col-md-6">

                                        <input type="number" name="discount_price" data-required="1" value="{{ isset($item->discount_price) ? $item->discount_price : old('discount_price')}}" class="form-control" /> </div>

                                </div>

                                <div class="form-group">

                                    <label class="control-label col-md-3">Adults <small>(age 12 +)</small>:

                                        <span class="required"> * </span>

                                    </label>

                                    <div class="col-md-6">

                                        <input type="number" name="adults" data-required="1" value="{{ isset($item->adults) ? $item->adults : old('adults')}}" class="form-control"  required="required" /> </div>

                                </div>

                                <div class="form-group">

                                    <label class="control-label col-md-3">Children <small>(age 2 to 12)</small>:

                                        <span class="required"> * </span> 

                                    </label>

                                    <div class="col-md-6">

                                        <input type="number" name="children" data-required="1" value="{{ isset($item->children) ? $item->children : old('children')}}" class="form-control"  required="required" /> </div>

                                </div>

                                <div class="form-group">

                                    <label class="control-label col-md-3">infant <small>(age 0 to 2)</small>:

                                    </label>

                                    <div class="col-md-6">

                                        <input type="number" name="infant" data-required="1" value="{{ isset($item->infant) ? $item->infant : old('infant')}}" class="form-control" /> </div>

                                </div>

                                <div class="form-group">

                                    <label class="control-label col-md-3">SQFt :

                                    </label>

                                    <div class="col-md-6">

                                        <input type="text" name="sqft" data-required="1" value="{{ isset($item->sqft) ? $item->sqft : old('sqft')}}" class="form-control" /> 

                                    </div>

                                </div>

                                <div class="form-group">

                                    <label class="control-label col-md-3">Beds :

                                    </label>

                                    <div class="col-md-6">

                                        <input type="number" name="bed" data-required="1" value="{{ isset($item->bed) ? $item->bed : old('bed')}}" class="form-control" /> 

                                    </div>

                                </div>

                                <div class="form-group">

                                    <label class="control-label col-md-3">Bathrooms :

                                    </label>

                                    <div class="col-md-6">

                                        <input type="number" name="bath" data-required="1" value="{{ isset($item->bath) ? $item->bath : old('bath')}}" class="form-control" /> 

                                    </div>

                                </div>

                                <div class="form-group">

                                    <label class="control-label col-md-3">Video URL :

                                    </label>

                                    <div class="col-md-6">

                                        <input type="text" name="video" value="{{ isset($item->video) ? $item->video : old('video')}}" class="form-control" /> 

                                    </div>

                                </div>

                                <div class="form-group">

                                    <label class="control-label col-md-3">Maximum Days :

                                    </label>

                                    <div class="col-md-6">

                                        <input type="number" name="maximum_days" value="{{ isset($item->maximum_days) ? $item->maximum_days : 60 }}" class="form-control" /> 

                                    </div>

                                </div>

                                <div class="form-group last">

                                    <label class="control-label col-md-3">Cover Picture <br />
                                        <span class="required"> (Size : 800px*800px) </span>
                                    </label>

                                    <div class="col-md-9">

                                        <div class="fileinput fileinput-new" data-provides="fileinput">

                                            <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">

                                                <img src="{{ URL::to('/') }}/storage/app/public/uploads/properties/{{ isset($item->image)?$item->image:'no-image.jpg' }}" width="200" height="100"> </div>

                                            <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> </div>

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

                                    <label class="control-label col-md-3">Description</label>

                                    <div class="col-md-6">

                                        <textarea name="description" required="required" rows="7" class="form-control ckeditor">
                                            {{ isset($item->description)  ? $item->description : old('description')}}
                                        </textarea>
                                        <div id="editor1_error">
                                            </div>

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

                                <div class="form-group" style="margin-bottom: 0;">

                                    <label class="control-label col-md-3">Featured

                                        <span class="required"> * </span>

                                    </label>

                                    <div class="col-md-6">

                                        <div class="mt-checkbox-inline">

                                            <label class="mt-checkbox">

                                                <input type="checkbox" name="featured" value="1" {{ $featured }} /> Yes

                                                <span></span>

                                            </label>

                                        </div>

                                    </div>

                                </div>

                                <div class="form-group">

                                    <label class="control-label col-md-3">Online Payment

                                        <span class="required"> * </span>

                                    </label>

                                    <div class="col-md-6">

                                        <div class="mt-checkbox-inline">

                                            <label class="mt-checkbox">

                                                <input type="checkbox" name="ready_to_pay" value="1" {{ $ready_to_pay }} /> Yes

                                                <span></span>

                                            </label>

                                        </div>

                                    </div>

                                </div>

                                <hr />

                                <div class="portlet-title">

                                    <div class="caption">

                                        <span class="caption-subject font-dark sbold uppercase">
                                            Property Location
                                        </span>

                                    </div>

                                </div>

                                <hr />

                                <div class="form-group">

                                    <label class="control-label col-md-3">Country Name :

                                        <span class="required"> * </span>

                                    </label>

                                    <div class="col-md-6">

                                        {{ Form::select('country_id', $countries, isset($item->country_id) ? $item->country_id : old('country_id'), ['class' => 'select form-control', 'id' => 'country_id', 'required' => 'required', 'placeholder' => 'Select Country']) }}

                                    </div>

                                </div>

                                <div class="form-group">

                                    <label class="control-label col-md-3">City Name :

                                        <span class="required"> * </span>

                                    </label>

                                    <div class="col-md-6">

                                        <select name="city_id" id="city_id" class="select form-control">
                                            <option value="{{ isset($item->city_id)?$item->city_id:null }}">
                                                {{ isset($item->cityname)?$item->cityname:null }}
                                            </option>
                                        </select>

                                    </div>

                                </div>

                                <div class="form-group">

                                    <label class="control-label col-md-3">Area :

                                        <span class="required"> * </span>

                                    </label>

                                    <div class="col-md-6">

                                        <input type="text" name="area" id="area" data-required="1" value="{{ isset($item->area) ? $item->area : old('area')}}" class="form-control" required /> 

                                    </div>

                                </div>

                                <div class="form-group">

                                    <label class="control-label col-md-3">Latitude :

                                        <span class="required"> * </span>

                                    </label>

                                    <div class="col-md-6">

                                        <input type="text" name="latitude" id="latitude" data-required="1" value="{{ isset($item->latitude) ? $item->latitude : old('latitude')}}" class="form-control" required /> 

                                    </div>

                                </div>

                                <div class="form-group">

                                    <label class="control-label col-md-3">Longitude :

                                        <span class="required"> * </span>

                                    </label>

                                    <div class="col-md-6">

                                        <input type="text" name="longitude" id="longitude" data-required="1" value="{{ isset($item->longitude) ? $item->longitude : old('longitude')}}" class="form-control" required /> 

                                    </div>

                                </div>

                                <hr />

                                <div class="caption">

                                    <span class="caption-subject font-dark sbold uppercase">
                                        Property Amenities
                                    </span>

                                </div>

                                <hr />

                                <div class="form-group">

                                    <div class="mt-checkbox-list">
                                      @if(count($amenities)>0)
                                          @foreach($amenities as $amenity)
                                            <?php
                                                if(isset($property_amenities) && in_array($amenity->id,$property_amenities))
                                                    $checked = 'checked="checked"';
                      else if(old('property_amenities') && in_array($amenity->id,old('property_amenities')))
                                                    $checked = 'checked="checked"';
                                                else
                                                    $checked = '';
                                            ?>
                                                <div class="col-md-3">
                                                    <label class="mt-checkbox">
                                                        <input type="checkbox" name="property_amenities[]" value="{{ $amenity->id }}" {{$checked }} required>
                                                        <img src="{{ URL::to('/') }}/storage/app/public/uploads/amenities/{{ isset($amenity->image)?$amenity->image:'no-image.png' }}" width="24" height="24">
                                                        {{ $amenity->name }}
                                                        <span></span>
                                                    </label>
                                                </div>   
                                            @endforeach
                                        @endif
                                    </div>

                                </div>
                            
                            @if(count($renttypes)>0)

                                <hr />

                                <div class="caption">

                                    <span class="caption-subject font-dark sbold uppercase">
                                        Property Rental Type
                                    </span>

                                </div>

                                <hr />

                                <div class="form-group">

                                    <div class="mt-checkbox-list">
                                          @foreach($renttypes as $rents)
                                            <?php
                                                if(isset($property_renttypes) && in_array($rents->id,$property_renttypes))
                                                    $checked = 'checked="checked"';
                      else if(old('property_renttypes') && in_array($rents->id,old('property_renttypes')))
                                                    $checked = 'checked="checked"';
                                                else
                                                    $checked = '';
                                            ?>
                                                <div class="col-md-3">
                                                    <label class="mt-checkbox">
                                                        <input type="checkbox" name="property_renttypes[]" value="{{ $rents->id }}" {{$checked }} >
                                                        <img src="{{ URL::to('/') }}/storage/app/public/uploads/renttypes/{{ isset($rents->image)?$rents->image:'no-image.png' }}" width="24" height="24"> {{ $rents->name }}
                                                        <span></span>
                                                    </label>
                                                </div>   
                                            @endforeach
                                    </div>

                                </div>
                        
                        @endif

                        @if(count($suitables)>0)

                                <hr />

                                <div class="caption">

                                    <span class="caption-subject font-dark sbold uppercase">
                                        Property Suitables for
                                    </span>

                                </div>

                                <hr />

                                <div class="form-group">

                                    <div class="mt-checkbox-list">
                                          @foreach($suitables as $suits)
                                            <?php
                                                if(isset($property_suitables) && in_array($suits->id,$property_suitables))
                                                    $checked = 'checked="checked"';
                      else if(old('property_suitables') && in_array($suits->id,old('property_suitables')))
                                                    $checked = 'checked="checked"';
                                                else
                                                    $checked = '';
                                            ?>
                                                <div class="col-md-3">
                                                    <label class="mt-checkbox">
                                                        <input type="checkbox" name="property_suitables[]" value="{{ $suits->id }}" {{$checked }} >
                                                        <img src="{{ URL::to('/') }}/storage/app/public/uploads/suitables/{{ isset($suits->image)?$suits->image:'no-image.png' }}" width="24" height="24"> {{ $suits->suitable_name }}
                                                        <span></span>
                                                    </label>
                                                </div>   
                                            @endforeach
                                    </div>

                                </div>
                        
                        @endif

                                <hr />

                                <div class="caption">

                                    <span class="caption-subject font-dark sbold uppercase">
                                        Property Gallery
                                    </span>

                                </div>

                                <hr />

                                <div class="form-group" id="image_source_image">
                                    <label class="col-md-3 control-label"> Gallery</label>
                                    <div class="col-md-9">
                                        <div class="mt-repeater">
                                            <div data-repeater-list="group-a">
                                                @if(count($recordImage) > 0)
                                                    @foreach($recordImage as $key => $image)

                                                    <div data-repeater-item class="row">
                                                        <div class="col-md-6">
                                                            <input type="hidden" name="group-a[{{ $key }}][img_id]" value="{{ $image['id'] }}">

                                                            <div class="fileinput fileinput-new" data-provides="fileinput">

                                                                <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">

                                                                    <img src="{{ URL::to('/') }}/storage/app/public/uploads/properties/{{ isset($image->image)?$image->image:'no-image.jpg' }}" width="200" height="100"> 

                                                                </div>

                                                                <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> 

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
                                                        <div class="col-md-1">
                                                            <label class="control-label">&nbsp;</label>
                                                            <a href="javascript:;" data-repeater-delete class="btn btn-danger">
                                                                <i class="fa fa-close"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                    @endforeach

                                                @else
                                                <div data-repeater-item class="row">
                                                    <div class="col-md-6">
                                                        <input type="hidden" name="img_id" value="">
                                                        <div class="fileinput fileinput-new" data-provides="fileinput">

                                                                <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">

                                                                    <img src="{{ URL::to('/') }}/storage/app/public/uploads/properties/{{ isset($image->image)?$item->image:'' }}" width="200" height="100"> 

                                                                </div>

                                                                <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> 

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
                                                    <div class="col-md-1">
                                                        <label class="control-label">&nbsp;</label>
                                                        <a href="javascript:;" data-repeater-delete class="btn btn-danger">
                                                            <i class="fa fa-close"></i>
                                                        </a>
                                                    </div>
                                                </div>    
                                                @endif    
                                            </div>
                                            <hr>
                                            <a href="javascript:;" data-repeater-create class="btn btn-info mt-repeater-add">
                                                <i class="fa fa-plus"></i> Add Image</a>
                                            <br>
                                            <br> </div>
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

        <script src="{{ URL::asset('resources/assets/global/plugins/select2/js/select2.full.min.js') }}" type="text/javascript"></script>

        <script src="{{ URL::asset('resources/assets/global/plugins/jquery-repeater/jquery.repeater.js') }}" type="text/javascript"></script>
        <script src="{{ URL::asset('resources/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}" type="text/javascript"></script>

        <script src="{{ URL::asset('resources/assets/pages/scripts/form-repeater.min.js') }}" type="text/javascript"></script>

        <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDYCz8d29qK8u6uqETS6JAk5NSJeVPL390&libraries=places"></script>

        <script src="{{ URL::asset('resources/assets/global/plugins/bootstrap-summernote/summernote.min.js') }}" type="text/javascript"></script>

        <script type="text/javascript">
        $(document).ready(function()
        {
            $('#summernote_1').summernote({height: 300});
            $.ajax({
               type:"GET",
               url:"{!! url('fetch-country') !!}",
               data:'country_id=1',
               success:function(res){               
                if(res){
                    $("#city_id").append('<option value="">Select City</option>');
                    $.each(res,function(key,value){
                        $("#city_id").append('<option data-id="'+key+'" value="'+key+'">'+value+'</option>');
                    });
               
                }else{
                   $("#city_id").empty();
                }
               }
            });
        });

        $('#country_id').on('change',function()
            {
                var country_id = $(this).val();
                if(country_id)
                {
                    $.ajax({
                       type:"GET",
                       url:"{!! url('fetch-country') !!}",
                       data:'country_id='+country_id,
                       success:function(res){               
                        if(res){
                            $("#city_id").empty();
                            $("#city_id").append('<option value="">Select City</option>');
                            $.each(res,function(key,value){
                                $("#city_id").append('<option data-id="'+key+'" value="'+key+'">'+value+'</option>');
                            });
                       
                        }else{
                           $("#city_id").empty();
                        }
                       }
                    });
                }
                else{
                    $("#city_id").empty();
                }
           });

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
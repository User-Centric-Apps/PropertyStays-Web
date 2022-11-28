@extends('layouts.master')

@section('title')

Add Tour

@endsection


@section('script')

<link href="{{ URL::asset('resources/assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}" rel="stylesheet" type="text/css" />

<link href="{{ URL::asset('resources/assets/global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.css') }}" rel="stylesheet" type="text/css" />

<link href="{{ URL::asset('resources/assets/global/plugins/bootstrap-markdown/css/bootstrap-markdown.min.css') }}" rel="stylesheet" type="text/css" />

<link href="{{ URL::asset('resources/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css') }}" rel="stylesheet" type="text/css" />

<link href="{{ URL::asset('resources/assets/global/plugins/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />

<link href="{{ URL::asset('resources/assets/global/plugins/select2/css/select2-bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
@endsection



@section('content')

      <div class="page-title-overlap bg-primary pt-4">
        
        @include('layouts.user-breadcrums')

      </div>
      <div class="container mb-5 pb-3">
        <div class="bg-light shadow-lg rounded-3 overflow-hidden">
          <div class="row">
            <!-- Sidebar-->
            <aside class="col-lg-4 pe-xl-5">

              @include('layouts.user-sidebar')

            </aside>
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
            <!-- Content-->
            <section class="col-lg-8 pt-lg-4 pb-4 mb-3">

              <div class="pt-2 px-4 ps-lg-0 pe-xl-5">
                <!-- Title-->
                <div class="d-sm-flex flex-wrap justify-content-between align-items-center pb-2">
                  <h2 class="h3 py-2 me-2 text-center text-sm-start">Manage Your Tour</h2>
                  
                </div>
                  <form action="{{ url('host/tour/save') }}"  enctype="multipart/form-data" method="post">

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

                                <div class="row mt-2">

                                    <div class="col-md-12">

                                        <label class="form-label" for="code">
                                          Title :<span class="required"> * </span>
                                        </label>
                                        <input type="text" name="title" data-required="1" value="{{ isset($item->title) ? $item->title : old('title')}}" class="form-control" required="required" /> 

                                    </div>

                                </div>

                                <div class="row mt-2">

                                  <div class="col-6">

                                    <label class="form-label" for="original_price">
                                      Starting Price :<span class="required"> * </span>
                                    </label>
                                    <div class="input-group">
                                      <span class="input-group-text">
                                        (£)
                                      </span>
                                      <input type="number" name="original_price" data-required="1" value="{{ isset($item->original_price) ? $item->original_price : old('original_price')}}" class="form-control"  required="required" />
                                    </div>

                                  </div>

                                  <div class="col-6">

                                    <label class="form-label" for="adults">
                                      Adult Price :<span class="required"> * </span>
                                    </label>
                                    <div class="input-group">
                                      <span class="input-group-text">
                                        (£)
                                      </span>
                                      <input type="number" name="adults" data-required="1" value="{{ isset($item->adults) ? $item->adults : old('adults')}}" class="form-control"  required="required" />
                                    </div>

                                  </div>
                                
                                </div>

                                <div class="row mt-2">

                                  <div class="col-6">

                                    <label class="form-label" for="children">
                                      Child Price <small>(age 2 to 12)</small> :
                                    </label>
                                    <input type="number" name="children" data-required="1" value="{{ isset($item->children) ? $item->children : old('children')}}" class="form-control"/>

                                  </div>

                                  <div class="col-6">

                                    <label class="form-label" for="infant">
                                      Infant Price <small>(age 0 to 2)</small> :
                                    </label>
                                    <input type="number" name="infant" data-required="1" value="{{ isset($item->infant) ? $item->infant : old('infant')}}" class="form-control"/>

                                  </div>
                                
                                </div>



                                <div class="row mt-2">

                                  <div class="col-4">

                                    <label class="form-label" for="video">
                                      Video URL :
                                    </label>
                                    <input type="url" name="video" data-required="1" value="{{ isset($item->video) ? $item->video : old('video')}}" class="form-control"/>

                                  </div>

                                  <div class="col-4">

                                    <label class="form-label" for="duration">
                                      Group Size <small>(People)</small> :
                                    </label>
                                    <input type="text" name="sqft" data-required="1" value="{{ isset($item->sqft) ? $item->sqft : old('sqft')}}" class="form-control"/>

                                  </div>

                                  <div class="col-4">

                                    <label class="form-label" for="duration">
                                      Duration <small>(Hours)</small> :
                                    </label>
                                    <input type="text" name="duration" data-required="1" value="{{ isset($item->duration) ? $item->duration : old('duration')}}" class="form-control"/>

                                  </div>
                                
                                </div>

                                <div class="row mt-4">

                                  <div class="col-6">
                                    
                                    <div class="fileinput fileinput-new" data-provides="fileinput">

                                            <div class="fileinput-new thumbnail" style="width: 200px; max-height: 150px;">

                                                <img src="{{ URL::to('/') }}/storage/app/public/uploads/tours/{{ isset($item->image)?$item->image:'no-image.png' }}" width="200" height="100"> 

                                              </div>

                                              <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> 

                                              </div>

                                            <div>

                                                <span class="btn default btn-file" style="padding-left:0;">

                                                    <span class="fileinput-new btn btn-secondary"> Select Cover Picture </span>

                                                    <span class="fileinput-exists btn btn-primary"> Change </span>

                                                    <input type="file" name="image"> </span>

                                                <a href="javascript:;" class="btn red fileinput-exists btn btn-danger btn-sm btn-icon" data-dismiss="fileinput"> 
                                                  <i class="ci-trash"></i> 
                                                </a>

                                            </div>

                                        </div>

                                  </div>
                                
                                </div>

                                <div class="row mt-2">

                                  <div class="col-12">

                                    <label class="form-label" for="Description">
                                      Description  :
                                    </label>
                                    <textarea name="description" required="required" rows="7" class="form-control ckeditor">
                                            {{ isset($item->description)  ? $item->description : old('description')}}
                                        </textarea>

                                  </div>
                                
                                </div>

                                <div class="row mt-2">

                                  <div class="col-12">

                                    <label class="form-label" for="tour_included">
                                      Tour Included  :
                                    </label>
                                    <textarea name="tour_included" rows="7" class="form-control ckeditor">{{ isset($item->tour_included) ? $item->tour_included : old('tour_included')}}</textarea>

                                  </div>
                                
                                </div>

                                <div class="row mt-2">

                                  <div class="col-12">

                                    <label class="form-label" for="tour_included">
                                      Tour Excluded  :
                                    </label>
                                    <textarea name="tour_excluded" rows="7" class="form-control ckeditor">{{ isset($item->tour_excluded) ? $item->tour_excluded : old('tour_excluded')}}</textarea>

                                  </div>
                                
                                </div>

                                <div class="row mt-2">

                                  <div class="col-12">

                                    <label class="form-label" for="tour_included">
                                      Tour Highlight  :
                                    </label>
                                    <textarea name="tour_highlight" id="tour_highlight" rows="5" class="form-control">{{ isset($item->tour_highlight) ? $item->tour_highlight : old('tour_highlight')}}</textarea>

                                  </div>
                                
                                </div>

                                <div class="row mt-2 mb-3">

                                  <div class="col-6">

                                    <label class="form-label" for="Status">
                                      Status  :
                                    </label>
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
                                <div class="row mt-2">

                                  <div class="col-6">

                                    <label class="form-label" for="Bathrooms">
                                      Online Payment :<span class="required"> * </span>
                                    </label>
                                    <div class="mt-checkbox-inline">

                                            <label class="mt-checkbox">

                                                <input type="checkbox" name="ready_to_pay" value="1" {{ $ready_to_pay }} /> Yes

                                                <span></span>

                                            </label>

                                        </div>

                                  </div>
                                
                                </div>

                                <hr class="mt-2 mb-4">

                                <div class="bg-secondary rounded-3 p-4 mb-4">
                                  <h3 class="fs-sm mb-0">Tour Location</h3>
                                </div>

                                <div class="row mt-2">

                                  <div class="col-6">

                                    <label class="form-label" for="country_id">
                                      Country Name : <span class="required"> * </span>
                                    </label>
                                    {{ Form::select('country_id', $countries, isset($item->country_id) ? $item->country_id : old('country_id'), ['class' => 'form-select', 'id' => 'country_id', 'required' => 'required', 'placeholder' => 'Select Country']) }}

                                  </div>

                                  <div class="col-6">

                                    <label class="form-label" for="city_id">
                                      City Name : <span class="required"> * </span>
                                    </label>
                                    <select name="city_id" id="city_id" class="form-select">
                                            <option value="{{ isset($item->city_id)?$item->city_id:null }}">
                                                {{ isset($item->cityname)?$item->cityname:null }}
                                            </option>
                                        </select>

                                  </div>
                                
                                </div>

                                <div class="row mt-2">

                                  <div class="col-6">

                                    <label class="form-label" for="area">
                                      Area : <span class="required"> * </span>
                                    </label>
                                    <input type="text" name="area" id="area" data-required="1" value="{{ isset($item->area) ? $item->area : old('area')}}" class="form-control" required /> 

                                  </div>

                                  <div class="col-3">

                                    <label class="form-label" for="latitude">
                                      Latitude : <span class="required"> * </span>
                                    </label>
                                    <input type="text" name="latitude" id="latitude" data-required="1" value="{{ isset($item->latitude) ? $item->latitude : old('latitude')}}" class="form-control" required /> 

                                  </div>

                                  <div class="col-3">

                                    <label class="form-label" for="longitude">
                                      Longitude : <span class="required"> * </span>
                                    </label>
                                    <input type="text" name="longitude" id="longitude" data-required="1" value="{{ isset($item->longitude) ? $item->longitude : old('longitude')}}" class="form-control" required /> 

                                  </div>
                                
                                </div>

                                <div class="bg-secondary rounded-3 p-4 mb-4 mt-4">
                                  <h3 class="fs-sm mb-0">Tour Gallery</h3>
                                </div>
                            <div class="mb-3 py-2">

                                <div class="form-group mt-1" id="image_source_image">
                                    <div class="col-md-12">
                                        <div class="mt-repeater">
                                            <div data-repeater-list="group-a">
                                                @if(count($recordImage) > 0)
                                                    @foreach($recordImage as $key => $image)

                                                    <div data-repeater-item class="row">
                                                        <div class="col-md-6">
                                                            <input type="hidden" name="group-a[{{ $key }}][img_id]" value="{{ $image['id'] }}">

                                                            <div class="fileinput fileinput-new" data-provides="fileinput">

                                                                <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">

                                                                    <img src="{{ URL::to('/') }}/storage/app/public/uploads/tours/{{ isset($image->image)?$image->image:'no-image.png' }}" width="200" height="100"> 

                                                                </div>

                                                                <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> 

                                                                </div>

                                                                <div>

                    <span class="btn default btn-file" style="padding-left: 0;">

                      <span class="fileinput-new btn btn-secondary" > Select Image </span>

                      <span class="fileinput-exists btn btn-primary"> Change </span>

                      <input type="file" name="image"> 

                    </span>

                    <a href="javascript:;" class="btn red fileinput-exists btn btn-danger btn-sm btn-icon" data-dismiss="fileinput"> 
                      <i class="ci-trash"></i> 
                    </a>

              </div>

                                                            </div>
                                                        </div>
                                                        <div class="col-md-1">
                                                            <label class="control-label">&nbsp;</label>
                                                            <a href="javascript:;" data-repeater-delete class="btn btn-danger btn-sm">
                <i class="ci-delete-document"></i>
            </a>
                                                        </div>
                                                    </div>
                                                    @endforeach

                                                @else
    <div data-repeater-item class="row">

      <div class="col-md-6">

          <input type="hidden" name="img_id" value="">

            <div class="fileinput fileinput-new" data-provides="fileinput">

              <div class="fileinput-new thumbnail" style="width: 200px; max-height: 150px;">

                  <img src="{{ URL::to('/') }}/storage/app/public/uploads/tours/{{ isset($image->image)?$item->image:'no-image.png' }}" width="200" height="100"> 

              </div>

              <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> 

              </div>

              <div>

                    <span class="btn default btn-file" style="padding-left: 0;">

                      <span class="fileinput-new btn btn-secondary" > Select Image </span>

                      <span class="fileinput-exists btn btn-primary"> Change </span>

                      <input type="file" name="image"> 

                    </span>

                    <a href="javascript:;" class="btn red fileinput-exists btn btn-danger btn-sm btn-icon" data-dismiss="fileinput"> 
                      <i class="ci-trash"></i> 
                    </a>

              </div>

            </div>

        </div>
        <div class="col-md-2">
            <label class="control-label">&nbsp;</label>
            <a href="javascript:;" data-repeater-delete class="btn btn-danger btn-sm">
                <i class="ci-delete-document"></i>
            </a>
        </div>
      </div>    
      @endif    
    </div>
    <hr>
          <a href="javascript:;" data-repeater-create class="btn btn-sm btn-primary mt-repeater-add mt-3">
              <i class="ci-add"></i> 
          </a>
          <br>
          <br> 
        </div>
  </div>
</div>
                  </div>
                  <button class="btn btn-primary d-block w-100 mt-5" type="submit"><i class="ci-cloud-upload fs-lg me-2"></i>Upload Tour</button>
                </form>
              </div>
                 
            </section>
          </div>
        </div>
      </div>

@endsection

@section('script_last')
<script src="{{ URL::asset('resources/assets/global/plugins/jquery.min.js') }}" type="text/javascript"></script>

<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDYCz8d29qK8u6uqETS6JAk5NSJeVPL390&libraries=places"></script>

        <script src="{{ URL::asset('resources/assets/global/plugins/bootstrap-wysihtml5/wysihtml5-0.3.0.js') }}" type="text/javascript"></script>

        <script src="{{ URL::asset('resources/assets/global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.js') }}" type="text/javascript"></script>

        <script src="{{ URL::asset('resources/assets/global/plugins/ckeditor/ckeditor.js') }}" type="text/javascript"></script>

        <script src="{{ URL::asset('resources/assets/global/plugins/bootstrap-markdown/lib/markdown.js') }}" type="text/javascript"></script>

        <script src="{{ URL::asset('resources/assets/global/plugins/bootstrap-markdown/js/bootstrap-markdown.js') }}" type="text/javascript"></script>

        <script src="{{ URL::asset('resources/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js') }}" type="text/javascript"></script>

        <script src="{{ URL::asset('resources/assets/global/plugins/select2/js/select2.full.min.js') }}" type="text/javascript"></script>

        <script src="{{ URL::asset('resources/assets/global/plugins/jquery-repeater/jquery.repeater.js') }}" type="text/javascript"></script>
        <script src="{{ URL::asset('resources/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}" type="text/javascript"></script>


        <script src="{{ URL::asset('resources/assets/global/plugins/bootstrap-summernote/summernote.min.js') }}" type="text/javascript"></script>

        <script type="text/javascript">
          var FormRepeater = function () {

    return {
        //main function to initiate the module
        init: function () {
          $('.mt-repeater').each(function(){
                $(this).repeater({
              show: function () {
                    $(this).slideDown();
                        $('.date-picker').datepicker({
                            orientation: "left",
                            autoclose: true
                        });
                },

                hide: function (deleteElement) {
                    if(confirm('Are you sure you want to delete this element?')) {
                        $(this).slideUp(deleteElement);
                    }
                },

                ready: function (setIndexes) {

                }

            });
          });
        }

    };

}();
        $(document).ready(function()
        {
          FormRepeater.init();
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

@endsection
@extends('layouts.master')

@section('title')

Manage Bank

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
            <!-- Content-->
            <section class="col-lg-8 pt-lg-4 pb-4 mb-3">

              <div class="pt-2 px-4 ps-lg-0 pe-xl-5">
                <!-- Title-->
                <div class="d-sm-flex flex-wrap justify-content-between align-items-center pb-2">
                  <h2 class="h3 py-2 me-2 text-center text-sm-start">Manage Bank</h2>
                  
                </div>
                  <form action="{{ url('host/bank-detail/save') }}"  enctype="multipart/form-data" method="post">

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

                                        <label class="form-label" for="account_title">
                                          Account Title :<span class="required"> * </span>
                                        </label>
                                        <input type="text" name="account_title" value="{{ Auth::user()->account_title }}" class="form-control" required="required" /> 

                                    </div>

                                </div>
                                <div class="row mt-2">

                                    <div class="col-md-12">

                                        <label class="form-label" for="account_iban">
                                          Account IBAN :<span class="required"> * </span>
                                        </label>
                                        <input type="text" name="account_iban" value="{{ Auth::user()->account_iban }}" class="form-control" required="required" /> 

                                    </div>

                                </div>
                                <div class="row mt-2">

                                    <div class="col-md-12">

                                        <label class="form-label" for="account_branch">
                                          Account Branch :<span class="required"> * </span>
                                        </label>
                                        <input type="text" name="account_branch" value="{{ Auth::user()->account_branch }}" class="form-control" required="required" /> 

                                    </div>

                                </div>
                                <div class="row mt-2">

                                    <div class="col-md-12">

                                        <label class="form-label" for="account_city">
                                          Account City :<span class="required"> * </span>
                                        </label>
                                        <input type="text" name="account_city" value="{{ Auth::user()->account_city }}" class="form-control" required="required" /> 

                                    </div>

                                </div>

                              </div>

                  <button class="btn btn-primary d-block w-100 mt-5" type="submit">
                    <i class="ci-cloud-upload fs-lg me-2"></i>Update Detail
                  </button>
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
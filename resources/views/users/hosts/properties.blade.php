@extends('layouts.master')

@section('title')

My Properties

@endsection


@section('script')

<link rel="stylesheet" media="screen" href="{{ URL::asset('resources/assets/front-end/vendor/simplebar/dist/simplebar.min.css') }}"/>
<link rel="stylesheet" media="screen" href="{{ URL::asset('resources/assets/front-end/vendor/tiny-slider/dist/tiny-slider.css') }}"/>
<link rel="stylesheet" media="screen" href="{{ URL::asset('resources/assets/front-end/vendor/chartist/dist/chartist.min.css') }}"/>
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
                <div class="d-sm-flex flex-wrap justify-content-between align-items-center border-bottom">
                  <h2 class="h3 py-2 me-2 text-center text-sm-start">
                    Your Properties
                    <span class="badge bg-faded-accent fs-sm text-body align-middle ms-2">
                      {{ count($items) }}
                    </span>
                  </h2>
                  <div class="py-2">
                    <div class="d-flex flex-nowrap align-items-center pb-3">
                      <a class="btn btn-primary btn-shadow d-block w-100" href="{{ url('host/manage-property') }}"><i class="ci-add fs-lg me-2"></i> Add Property</a>
                    </div>
                  </div>
                </div>
                <!-- Product-->
                @if(count($items) > 0)
                @foreach($items as $item)
                  <div class="d-block d-sm-flex align-items-center py-4 border-bottom">
                    <a class="d-block mb-3 mb-sm-0 me-sm-4 ms-sm-0 mx-auto" href="{{ url('rental/'.$item->slug) }}" style="width: 12.5rem;">
                      <img class="rounded-3" src="{{ URL::asset('storage/app/public/uploads/properties/'.$item->image) }}" alt="Awaiting Photo">
                    </a>
                    <div class="text-center text-sm-start">
                      <h3 class="h6 product-title mb-2">
                        <a href="{{ url('rental/'.$item->slug) }}">
                          {{ $item->title }}
                        </a>
                      </h3>
                      <div class="d-inline-block text-accent">
                        £ {{ $item->original_price }}
                      </div>
                      <div class="d-inline-block text-muted fs-ms border-start ms-2 ps-2">
                        City: <span class="fw-medium">{{ $item->cityname }}</span>
                      </div>
                      <div class="d-flex justify-content-center justify-content-sm-start pt-3">
                        <a href="{{ url('host/view-property/'.$item->id) }}" class="btn bg-faded-success btn-icon me-2" title="View">
                          <i class="ci-eye text-info"></i>
                        </a>
                        <a href="{{ url('host/manage-property/'.$item->id) }}" class="btn bg-faded-info btn-icon me-2" title="Edit">
                          <i class="ci-edit text-info"></i>
                        </a>
                        <a href="{{ url('host/property/destroy/'.$item->id) }}" class="btn bg-faded-danger btn-icon" title="Delete">
                          <i class="ci-trash text-danger"></i>
                        </a>
                      </div>
                    </div>
                  </div>
                  @endforeach
                  <nav class="woocommerce-pagination">
                      {!! $items->render() !!}
                  </nav>
                @else 
                <div class="bg-secondary rounded-3 p-4 mb-4">
                  <p class="fs-sm text-muted mb-0">No record found!</p>
                </div>
                @endif  
                <!-- Product-->
              </div>
                 
            </section>
          </div>
        </div>
      </div>

@endsection

@section('script_last')
    <script src="{{ URL::asset('resources/assets/front-end/vendor/smooth-scroll/dist/smooth-scroll.polyfills.min.js') }}"></script>
    <script src="{{ URL::asset('resources/assets/front-end/vendor/chartist/dist/chartist.min.js') }}"></script>

@endsection
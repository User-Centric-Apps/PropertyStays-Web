@extends('layouts.master')

@section('title')

My Tours

@endsection


@section('script')

@endsection



@section('content')

	<div class="page-title-overlap bg-primary pt-4">
        @include('layouts.user-breadcrums')
      </div>
      <div class="container mb-5 pb-3">
        <div class="bg-light shadow-lg rounded-3 overflow-hidden">
          <div class="row">
            <!-- Sidebar-->
            <aside class="col-4 ">

              @include('layouts.user-sidebar')

            </aside>
            <!-- Content-->
            <section class="col-8 pt-4 pb-4 mb-3">
              <h2 class="h3 pt-2 pb-4 mb-0 text-center text-sm-start border-bottom">
                My Booking(Tours)
              </h2>
              
            <!-- Item-->
            @if(count($tours) > 0)
                  @foreach($tours as $item)
            <div class="d-sm-flex justify-content-between my-4 pb-3 pb-sm-2 border-bottom">
                <div class="d-block d-sm-flex align-items-start text-center text-sm-start">
                    <a class="d-block flex-shrink-0 mx-auto me-sm-4" href="#" style="width: 10rem;">
                      <img src="{{ URL::asset('storage/app/public/uploads/properties/'.$item->image) }}" alt="{{ $item->title }}">
                    </a>
                  <div class="pt-2">
                    <h3 class="product-title fs-base mb-2">
                      <a href="#">
                        {{ $item->title }}
                      </a>
                    </h3>
                    <div class="fs-sm">
                      <span class="text-muted me-2">Adult :</span>{{ $item->adult }}
                    </div>
                    <div class="fs-sm">
                      <span class="text-muted me-2">Childrens :</span>{{ $item->childrens }}
                    </div>
                    <div class="fs-sm">
                      <span class="text-muted me-2">Infants :</span>{{ $item->infants }}
                    </div>
                    <div class="fs-sm">
                      <span class="text-muted me-2">Date :</span>{{ $item->check_in }}
                    </div>
                  </div>
                </div>
                @if($item->status == 'Pending')
                <div class="pt-2 ps-sm-3 mx-auto mx-sm-0 text-center">
                  <a class="btn btn-outline-danger btn-sm" href="{{ url('tour/cancel/'.$item->id) }}">
                    <i class="ci-trash me-2"></i>Cancel
                  </a>
                </div>
                @endif
            </div>
            @endforeach
            <!-- Item-->
              <nav class="d-flex justify-content-between pt-2" aria-label="Page navigation">
                
                {!! $tours->render() !!}

              </nav>
            @else 
                <div class="bg-secondary rounded-3 p-4 mb-4">
                  <p class="fs-sm text-muted mb-0">No record found!</p>
                </div>
            @endif  
              
            </section>
          </div>
        </div>
      </div>

@endsection

@section('script_last')

@endsection
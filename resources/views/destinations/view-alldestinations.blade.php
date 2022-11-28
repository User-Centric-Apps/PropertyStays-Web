@extends('layouts.master')

@section('title')

All Destination

@endsection


@section('script')

<style type="text/css">
  svg
  {
    width: 20px;
  }
</style>

@endsection



@section('content')


    <section class="bg-primary bg-position-top-center bg-repeat-0 py-5 syed-bg" style="background-image: url({{ URL::to('/') }}/storage/app/public/uploads/pages/{{ $item->image }});">
        <div class="pb-lg-5 mb-lg-3">
          <div class="container py-lg-5 my-lg-5">
            <div class="row mb-4 mb-sm-5">
              <div class="col-lg-7 col-md-9 text-center text-sm-start">
                <h1 class="lh-base" style="color: #00bdbc !important; text-shadow: 2px 2px 2px rgb(0 0 0);">
                  <span >Over</span> 1,500 <span >curated</span> Rentals <span >&amp;</span> Tours <span >at your finger tips!</span></h1>
                <h2 class="h5 text-green fw-dark"  style="color: #00bdbc !important; text-shadow: 2px 2px 2px rgb(0 0 0);">High quality rental created by our global team</h2>
              </div>
            </div>
            
          </div>
        </div>
      </section>
      <!-- Toolbar-->
      <section class="container position-relative pt-3 pt-lg-0 pb-5 mt-lg-n10" style="z-index: 10;">
        <div class="card px-lg-2 border-0 shadow-lg">
          <div class="card-body px-4 pt-5 pb-4">
            <!-- Products grid-->
            <div class="row pt-3 mx-n2">
              @foreach($items as $item)
                      <div class="col-4 px-0 px-sm-2 mb-sm-4">
                          <div class="card product-card card-static city-destinations">
                            <div class="img-holder" style="background: url({{ URL::asset('storage/app/public/uploads/cities/'.$item->image) }});">
                                <a class="card-img-top d-block overflow-hidden" href="{{ url('location/'.$item->slug) }}">
                                    <div class="cityname">
                                    <span class="text-light">{{ $item->cityname }}</span>
                                    <small class="text-light">{{ $item->properties->count() }} properties</small>
                                </div>
                                </a>
                            </div>
                          </div>
                      </div>
                    @endforeach  
            </div>
          </div>
        </div>
        <hr class="my-3">
        <!-- Pagination-->
        <div class="row">
          <div class="col-12">
            <div class="d-flex justify-content-center"> 
              {!! $items->links('vendor.pagination.custom') !!}
            </div>
          </div>
        </div>
      </section>




@endsection

@section('script_last')

@endsection
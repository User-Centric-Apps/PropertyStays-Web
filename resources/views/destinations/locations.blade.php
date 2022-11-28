@extends('layouts.master')

@section('title')

All Destination

@endsection


@section('script')

<style type="text/css">
#mapCanvas {
    width: 100%;
    height: 650px;
}
</style>

@endsection



@section('content')

    <main class="container-fluid px-0">
      <section class="bg-primary bg-position-top-center bg-repeat-0 py-5 syed-bg" style="background-image: url({{ URL::to('/') }}/storage/app/public/uploads/cities/{{ $cityitem->image }});">
        <div class="pb-lg-5 mb-lg-3">
          <div class="container py-lg-5 my-lg-5">
            <div class="row mb-4 mb-sm-5">
              <div class="col-lg-7 col-md-9 text-center text-sm-start">
                <h1 class="lh-base" style="color: #00bdbc !important; text-shadow: 2px 2px 2px rgb(0 0 0);">
                  {{ $cityitem->cityname }}</h1>
              </div>
            </div>
            
          </div>
        </div>
      </section>
      <section class="container position-relative pt-3 pt-lg-0 pb-5 mt-lg-n10" style="z-index: 10;">

        <div class="card px-lg-2 border-0 shadow-lg">

          <div class="card-body px-4 pt-5 pb-4">

            <div class="row pt-2 mx-n2">

              <div class="col-7"> 
                {!! $cityitem->description !!}
              </div>
              <div class="col-5">

                @if($cityitem->image_side1)
                  <div class="row">

                    <div class="col-12">
                      <img src="{{ URL::to('/') }}/storage/app/public/uploads/cities/{{ $cityitem->image_side1 }}" alt="{{ $cityitem->cityname }}">
                    </div>
                    <div class="col-12 mt-1">
                      {{ $cityitem->image_alt1 }}
                    </div>

                  </div>
                @endif

                @if($cityitem->image_side2)
                  <div class="row">

                    <div class="col-12">
                      <img src="{{ URL::to('/') }}/storage/app/public/uploads/cities/{{ $cityitem->image_side2 }}" alt="{{ $cityitem->cityname }}">
                    </div>
                    <div class="col-12 mt-1">
                      {{ $cityitem->image_alt2 }}
                    </div>

                  </div>
                @endif

                @if($cityitem->image_side3)
                  <div class="row">

                    <div class="col-12">
                      <img src="{{ URL::to('/') }}/storage/app/public/uploads/cities/{{ $cityitem->image_side3 }}" alt="{{ $cityitem->cityname }}">
                    </div>
                    <div class="col-12 mt-1">
                      {{ $cityitem->image_alt3 }}
                    </div>

                  </div>
                @endif

                @if($cityitem->image_side4)
                  <div class="row">

                    <div class="col-12">
                      <img src="{{ URL::to('/') }}/storage/app/public/uploads/cities/{{ $cityitem->image_side4 }}" alt="{{ $cityitem->cityname }}">
                    </div>
                    <div class="col-12 mt-1">
                      {{ $cityitem->image_alt4 }}
                    </div>

                  </div>
                @endif

                @if($cityitem->image_side5)
                  <div class="row">

                    <div class="col-12">
                      <img src="{{ URL::to('/') }}/storage/app/public/uploads/cities/{{ $cityitem->image_side5 }}" alt="{{ $cityitem->cityname }}">
                    </div>
                    <div class="col-12 mt-1">
                      {{ $cityitem->image_alt5 }}
                    </div>

                  </div>
                @endif

              </div>

            </div>

          </div>

        </div>

      </section>
      
      @if(count($properties) > 0)
      <section class="container py-3">
        <h2 class="h3 text-center">Select a property</h2>
        <div class="row pt-4">
              @foreach($properties as $item)
                @if($item->image)
                <div class="col-lg-4 col-sm-6 mb-grid-gutter">
                  
                  <div class="card product-card card-static">
                    @if($item->featured == 1)
                      <div class="featured">Featured</div>
                    @endif  
                  <button class="btn-wishlist btn-sm" type="button" data-bs-toggle="tooltip" data-bs-placement="left" title="Add to wishlist">
                    <i class="ci-heart"></i>
                  </button>
                  <div class="img-holder">
                      
                      <a class="card-img-top d-block overflow-hidden" href="{{ url('rental/'.$item->slug) }}">
                        <img src="{{ URL::to('/') }}/storage/app/public/uploads/properties/{{ $item->image }}" alt="{{ $item->featured }}">
                      </a>
                      <div class="host-pic">
                          <a href="https://propertystays.com/author/ashleybailey/" target="_blank" title="Ashley Bailey" class="service-avatar">
                            <img alt="Lets plan your trip" src="{{ URL::asset('resources/assets/front-end/img/home/PropertyStays-icon.png') }}" height="35" width="35" loading="lazy">
                          </a>
                      </div>
                      <div class="product-price">
                          <span class="text-light">
                              {{ Session::get('currency') === 'gbp' ? '£' : '€' }}
                              {{ number_format($item->original_price*Session::get('value'),2) }}
                              <small>/ per night</small>
                          </span>
                      </div>

                  </div>
                  <div class="card-body py-2 px-2">
                      <a class="product-meta d-block fs-xs pb-1" href="#">Rental</a>
                      <h3 class="product-title fs-sm">
                          <a href="{{ url('rental/'.$item->slug) }}">
                            {{ $item->title }}
                          </a>
                      </h3>
                        <div class="d-flex justify-content-between">
                          
                          <div class="star-rating">
                              <i class="star-rating-icon"></i>
                              <i class="star-rating-icon"></i>
                              <i class="star-rating-icon"></i>
                              <i class="star-rating-icon"></i>
                              <i class="star-rating-icon"></i>
                          </div>

                        </div>
                          <div class="amenities">
                              @if($item->adults)
                                <div class="ppl" data-toggle="tooltip" title="" data-original-title="No. People">
                                    <i>&nbsp</i>
                                    <span>{{ $item->adults }}</span>
                                </div>
                              @endif
                              @if($item->bed)
                                <div class="bed" data-toggle="tooltip" title="" data-original-title="No. Beds">
                                    <i>&nbsp</i>
                                    <span>{{ $item->bed }}</span>
                                </div>
                              @endif
                              @if($item->bath)
                                <div class="bath" data-toggle="tooltip" title="" data-original-title="No. Bathrooms">
                                    <i>&nbsp</i>
                                    <span>{{ $item->bath }}</span>
                                </div>
                              @endif
                              @if($item->sqft)
                                <div class="plotsize" data-toggle="tooltip" title="" data-original-title="Plot size">
                                    <i>&nbsp</i>
                                    <span>0{{ $item->sqft }}</span> <sup>2</sup>
                                </div>
                              @endif
                          </div>
                  </div>
                </div>

                </div>
                @endif
                
              @endforeach
        </div>
      </section>
      @endif  
      @if(count($tours) > 0)
      <section class="container py-3">
        <h2 class="h3 text-center">Select a tour</h2>
        <div class="row pt-4">
            
              @foreach($tours as $item)
                <div class="col-lg-4 col-sm-6 mb-grid-gutter">
                  
                  <div class="card product-card card-static pb-0">
                      @if($item->featured == 1)
                        <div class="featured">Featured</div>
                      @endif  
                      
                    <div class="img-holder">
                        
                        <a class="card-img-top d-block overflow-hidden" href="{{ url('tour/'.$item->slug)}}">
                          <img src="{{ URL::to('/') }}/storage/app/public/uploads/tours/{{ $item->image }}" alt="{{ $item->featured }}">
                        </a>
                        <div class="host-pic">
                            <a href="#" target="_blank" title="Ashley Bailey" class="service-avatar">
                              <img alt="Lets plan your trip" src="{{ URL::asset('resources/assets/front-end/img/home/PropertyStays-icon.png') }}" height="35" width="35" loading="lazy">
                            </a>
                        </div>
                        <div class="product-price">
                          <span class="text-light">
                              <small>Starting from </small>
                              <?php $pri = $item->adults; ?>
                              @if($item->children)
                                <?php $pri = $item->children; ?>
                              @endif
                              {{ Session::get('currency') === 'gbp' ? '£' : '€' }} {{ number_format($pri*Session::get('value'), 2) }}
                          </span>
                        </div>

                    </div>
                    <div class="card-body py-2 px-2">
                        <h3 class="product-title fs-sm">
                            <a href="{{ url('rental/'.$item->slug) }}">
                              {{ $item->title }}
                            </a>
                        </h3>
                          <div class="d-flex justify-content-between">
                            
                            <div class="star-rating">
                                <i class="star-rating-icon ci-star"></i>
                                <i class="star-rating-icon ci-star"></i>
                                <i class="star-rating-icon ci-star"></i>
                                <i class="star-rating-icon ci-star"></i>
                                <i class="star-rating-icon ci-star"></i>
                            </div>

                          </div>
                            <div class="amenities">
                                @if($item->tour_duration)
                                  <div style="width:50%">
                                      <i class="text-body ci-time"></i>
                                      <span>{{ $item->tour_duration }}</span>
                                  </div>
                                @endif
                                @if($item->sqft)
                                  <div style="width:50%">
                                      <i class="text-body ci-user"></i>
                                      <span>{{ $item->sqft }}</span>
                                  </div>
                                @endif
                            </div>
                    </div>
                  </div>

                </div>
                
              @endforeach
        </div>
      </section>
            @endif

            <div id="mapCanvas"></div>

      </main>

@endsection

@section('script_last')

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDYCz8d29qK8u6uqETS6JAk5NSJeVPL390">
  
</script>

<script>
function initMap() {
    var map;
    var bounds = new google.maps.LatLngBounds();
    var mapOptions = {
        mapTypeId: 'roadmap'
    };
                    
    /* Display a map on the web page */
    map = new google.maps.Map(document.getElementById("mapCanvas"), mapOptions);
    map.setTilt(100);
        
    /* Multiple markers location, latitude, and longitude */
    var markers = [
        <?php if(count($properties) > 0)
        {
            foreach($properties as $item)
            {
              if($item->latitude){
                echo '["'.$item->title.'", '.$item->latitude.', '.$item->longitude.'],'; 
              }
            } 
        } 
        ?>
    ];
                        
    /* Info window content */
    var infoWindowContent = [
        <?php 
          if(count($properties) > 0)
          { 
            foreach($properties as $item)
            {
              if($item->latitude)
              {
                { ?>
                  ['<div class="card product-card product-list">' +
                  '<div class="d-sm-flex align-items-center">'+
                  '<a href="{{ url('rental/'.$item->slug) }}" style="margin-left: 10px"><img src="{{ URL::to('/') }}/storage/app/public/uploads/properties/{{ $item->image }}" width="96" alt="{{ $item->featured }}"></a>'+
                  '<div class="card-body py-2">'+
                  '<h3 class="product-title fs-base"><?php echo $item->title; ?></h3>'+
                  '<div class="d-flex justify-content-between"><div class="product-price"> <strong class="text-accent">{{ Session::get("currency") === "gbp" ? "£" : "€" }} <?php echo number_format($item->original_price*Session::get('value'),2); ?> / <small>Per night</small></strong></div></div>' + '</div></div>'],
          <?php 
                }
              }
            }
          }
        ?>
    ];
        
     /* Add multiple markers to map */
    var infoWindow = new google.maps.InfoWindow(), marker, i;
    
     /* Place each marker on the map  */
    for( i = 0; i < markers.length; i++ ) {
        var position = new google.maps.LatLng(markers[i][1], markers[i][2]);
        bounds.extend(position);
        marker = new google.maps.Marker({
            position: position,
            map: map,
      icon: markers[i][3],
            title: markers[i][0]
        });
        
         /* Add info window to marker   */
        google.maps.event.addListener(marker, 'click', (function(marker, i) {
            return function() {
                infoWindow.setContent(infoWindowContent[i][0]);
                infoWindow.open(map, marker);
            }
        })(marker, i));

       /* Center the map to fit all markers on the screen */
        map.fitBounds(bounds);
    }

   /* Set zoom level */
    var boundsListener = google.maps.event.addListener((map), 'bounds_changed', function(event) {
        this.setZoom(14);
        google.maps.event.removeListener(boundsListener);
    });
}

/* Load initialize function */
google.maps.event.addDomListener(window, 'load', initMap);
</script>

@endsection
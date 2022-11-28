<div class="container d-flex flex-wrap flex-sm-nowrap justify-content-center justify-content-sm-between align-items-center pt-2">
          <div class="d-flex align-items-center pb-3">
            <div class="img-thumbnail rounded-circle position-relative flex-shrink-0" style="width: 6.375rem;">
                  @if(Auth::user()->profile_pic)
                        <img src="{{ URL::to('/') }}/storage/app/public/uploads/customers/{{ isset(Auth::user()->profile_pic)?Auth::user()->profile_pic:'no-image.png' }}" class="rounded-circle" alt="{{ Auth::user()->name }}">
                  @else
                    <img src="{{ URL::asset('resources/assets/front-end/img/home/PropertyStays-icon.png') }}" class="rounded-circle" alt="{{ Auth::user()->name }}">
                  @endif
            </div>
            <div class="ps-3">
              <h3 class="text-light fs-lg mb-0">
                @if(Session::get('user_type') == 1) Host @endif Dashboard
              </h3>
              <span class="d-block text-light fs-ms opacity-60 py-1">
                Member since {{ date('jS-F-Y', strtotime(Auth::user()->created_at)) }}
              </span>
            </div>
          </div>
          @if(Auth::user()->type == 1)
          <!--<div class="d-flex">
            <div class="text-sm-end me-5">
              <div class="text-light fs-base">Total sales</div>
              <h3 class="text-light">426</h3>
            </div>
            <div class="text-sm-end">
              <div class="text-light fs-base">Seller rating</div>
              <div class="star-rating"><i class="star-rating-icon ci-star-filled active"></i><i class="star-rating-icon ci-star-filled active"></i><i class="star-rating-icon ci-star-filled active"></i><i class="star-rating-icon ci-star-filled active"></i><i class="star-rating-icon ci-star"></i>
              </div>
              <div class="text-light opacity-60 fs-xs">Based on 98 reviews</div>
            </div>
          </div>-->
          @endif
        </div>
@extends('layouts.master')

@section('title')

{{ $cat->name }}

@endsection


@section('script')

@endsection



@section('content')


<!-- Hero section with search-->
      <section class="bg-primary bg-position-top-center bg-repeat-0 py-5 syed-bg" style="background-image: url({{ URL::to('/') }}/storage/app/public/uploads/pages/{{ $page->image }});">
        <div class="pb-lg-5 mb-lg-3">
          <div class="container py-lg-5 my-lg-5">
            <div class="row mb-4 mb-sm-5">
              <div class="col-lg-7 col-md-9 text-center text-sm-start">
                <h1 class="lh-base" style="color: #00bdbc !important; text-shadow: 2px 2px 2px rgb(0 0 0);">
                  {{ $cat->name }}
                </h1>
                <h2 class="h5 text-green fw-dark"  style="color: #00bdbc !important; text-shadow: 2px 2px 2px rgb(0 0 0);">
                  Hosting Help
                </h2>
              </div>
            </div>
            
          </div>
        </div>
      </section>

      <section class="container position-relative pt-3 pt-lg-0 pb-5 mt-lg-n10 help-pages" style="z-index: 10;">
        <div class="card px-lg-2 border-0 shadow-lg">
          <div class="row">
            <div class="col-12">
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb justify-content-start py-2">
                  <li class="breadcrumb-item">
                    <a class="text-nowrap" href="{{ url('/') }}">
                      <i class="ci-home"></i>Home</a>
                  </li>
                  <li class="breadcrumb-item">
                    <a class="text-nowrap" href="{{ url('hosting-help')}}">
                      <i class="lead text-muted pt-1"></i> Hosting Help
                    </a>
                  </li>
                  <li class="breadcrumb-item text-nowrap active" aria-current="page">
                    {{ $cat->name }}
                  </li>
                </ol>
              </nav>
            </div>
          </div>
          <div class="card-body px-4 pt-3 pb-4">
            <div class="row pt-4">
            @if(count($sub_cat) > 0)
                @foreach($sub_cat as $item)
                  <div class="col-lg-6 col-sm-6 mb-grid-gutter">
                    <div class="card border-0 shadow">
                      <div class="card-body text-center">
                        <i class="{{ $item->icon }} h2 mt-2 mb-4 text-primary"></i>
                        <h6>{{ $item->sub_name }}</h6>
                        <p class="fs-sm text-muted pb-2">
                          {{ $item->description }}
                        </p>
                        <a class="btn btn-outline-primary btn-sm stretched-link mb-2" href="{{ url('hosting-help/sub-category-list/'.$item->slug)}}">
                          Learn more
                        </a>
                      </div>
                    </div>
                  </div>
                @endforeach
            @endif  
        </div>
          </div>
        </div>
      </section>

@endsection

@section('script_last')

@endsection
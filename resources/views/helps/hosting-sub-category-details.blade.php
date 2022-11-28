@extends('layouts.master')

@section('title')

{{ $sub_cat->sub_name }}

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
                  {{ $sub_cat->sub_name }}
                </h1>
                <h2 class="h5 text-green fw-dark"  style="color: #00bdbc !important; text-shadow: 2px 2px 2px rgb(0 0 0);">
                  {{ $sub_cat->name }}
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
                  <li class="breadcrumb-item">
                    <a class="text-nowrap" href="{{ url('hosting-help/sub-category/'.$sub_cat->slug)}}">
                      <i class="lead text-muted pt-1"></i> {{ $sub_cat->name }}
                    </a>
                  </li>
                  <li class="breadcrumb-item text-nowrap active" aria-current="page">
                    {{ $sub_cat->sub_name }}
                  </li>
                </ol>
              </nav>
            </div>
          </div>
          <div class="card-body px-4 pt-3 pb-4">
            <div class="row pt-4">
            @if(count($faqs) > 0)
                <ul class="list-unstyled fs-sm pt-2">
                  @foreach($faqs as $item)
                    <li class="d-flex align-items-center mb-2">
                      <a class="widget-list-link" href="{{ url('hosting-help/detail/'.$item->slug)}}">
                        <i class="ci-arrow-right me-2"></i>
                        <span>{{ $item->title }}</span>
                      </a>
                    </li>
                  @endforeach
                </ul>
            @endif  
        </div>
          </div>
        </div>
      </section>

@endsection

@section('script_last')

@endsection
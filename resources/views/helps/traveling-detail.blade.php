@extends('layouts.master')

@section('title')

{{ $helpdetail->title }} - {{ $sub_cat->sub_name }}

@endsection


@section('script')

<style type="text/css">
  h1, h2, h3, h4, h5, h6, p, .help-pages
  {
    font-family: 'Rubik';

  }
  .help-pages h1 
  {
      font-size: 22px;
      margin-bottom: 0;
  }
  .help-pages h2 
  {
      font-size: 20px;
  }
  .help-pages h3
  {
      font-size: 18px;
  }
  .help-pages h4
  {
      font-size: 16px;
  }
  p, .help-pages, ol, ul, dl
  {
    color: #4b566b;
  }
</style>

@endsection



@section('content')

<!-- Page Title (Light)-->
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
                    <a class="text-nowrap" href="{{ url('traveling-help')}}">
                      <i class="lead text-muted pt-1"></i> Hosting Help
                    </a>
                  </li>
                  <li class="breadcrumb-item">
                    <a class="text-nowrap" href="{{ url('traveling-help/sub-category/'.$sub_cat->slug)}}">
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
          @if(count($relatedlist) > 0)
          <div class="col-lg-3">
            <!-- Related articles sidebar-->
            <div class="offcanvas offcanvas-collapse border-end" id="help-sidebar">
              <div class="offcanvas-header align-items-center shadow-sm">
                <h2 class="h5 mb-0">Related articles</h2>
                <button class="btn-close ms-auto" type="button" data-bs-dismiss="offcanvas" aria-label="Close"></button>
              </div>
              <div class="offcanvas-body py-grid-gutter py-lg-1" data-simplebar data-simplebar-auto-hide="true">
                <!-- Links-->
                <div class="widget widget-links">
                  <h3 class="widget-title d-none d-lg-block">Related Topics</h3>
                  <ul class="widget-list">
                    @foreach($relatedlist as $item)
                    <li class="widget-list-item">
                      <a class="widget-list-link" href="{{ url('traveling-help/detail/'.$item->slug)}}">
                        {{ $item->title }}
                      </a>
                    </li>
                    @endforeach
                  </ul>
                </div>
              </div>
            </div>
          </div>
          @endif
          <div class="col-lg-9">
            {!! $helpdetail->description !!}
          </div>
        </div>
      </div>
    </div>
  </section>

@endsection

@section('script_last')

@endsection
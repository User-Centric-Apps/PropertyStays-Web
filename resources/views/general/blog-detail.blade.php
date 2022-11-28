@extends('layouts.master')

@section('title')

{{ $blog->title }}

@endsection


@section('script')

    <link rel="stylesheet" media="screen" href="{{ URL::asset('resources/assets/front-end/vendor/tiny-slider/dist/tiny-slider.css') }}"/>
<link rel="stylesheet" media="screen" href="{{ URL::asset('resources/assets/front-end/vendor/lightgallery.js/dist/css/lightgallery.min.css') }}"/>
@endsection



@section('content')

	<main class="container-fluid px-0">

		<div class="bg-secondary py-4">
        <div class="container d-lg-flex justify-content-between py-2 py-lg-3">
          <div class="order-lg-2 mb-3 mb-lg-0 pt-lg-2">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb flex-lg-nowrap justify-content-center justify-content-lg-start">
                <li class="breadcrumb-item"><a class="text-nowrap" href="index.html"><i class="ci-home"></i>Home</a></li>
                <li class="breadcrumb-item text-nowrap"><a href="{{ url('/blog') }}">Blog</a>
                </li>
                <li class="breadcrumb-item text-nowrap active" aria-current="page">{{ $blog->title }}</li>
              </ol>
            </nav>
          </div>
          <div class="order-lg-1 pe-lg-4 text-center text-lg-start">
            <h1 class="h3 mb-0">{{ $blog->title }}</h1>
          </div>
        </div>
      </div>
      <div class="container pb-5">
        <div class="row justify-content-center pt-5 mt-md-2">
          <div class="col-lg-9">
            <!-- Post meta-->
            <div class="d-flex flex-wrap justify-content-between align-items-center pb-4 mt-n1">
              <div class="d-flex align-items-center fs-sm mb-2">
                <a class="blog-entry-meta-link" href="#">
                    By Admin
                </a>
                <span class="blog-entry-meta-divider"></span>
                <a class="blog-entry-meta-link" href="#">{{ $blog->date }}</a>
              </div>
            </div>
            <!-- Gallery-->
            <div class="gallery row pb-4">
              <div class="col-sm-12">
                <div class="tns-carousel tns-nav-enabled">
                  <div class="tns-carousel-inner" data-carousel-options='{"axis": "vertical", "nav": true}'>
                    <img src="{{ URL::to('storage/app/public/uploads/blog/'.$featured_image->image)}}" alt="{{ $blog->title }}" class="img-responsive">
                    <img src="{{ URL::to('storage/app/public/uploads/blog/'.$featured_image->image)}}" alt="{{ $blog->title }}" class="img-responsive">
                    <img src="{{ URL::to('storage/app/public/uploads/blog/'.$featured_image->image)}}" alt="{{ $blog->title }}" class="img-responsive">
                  </div>
                </div>
              </div>
            </div>
            <!-- Post content-->
            {!! $blog->description !!}
            <!-- Post tags + sharing-->
            <div class="d-flex flex-wrap justify-content-between pt-2 pb-4 mb-1">
              <div class="mt-3 me-3">
                <a class="btn-tag me-2 mb-2" href="#">{{ $blog->category_name }}</a>
              </div>
              <div class="mt-3"><span class="d-inline-block align-middle text-muted fs-sm me-3 mt-1 mb-2">Share post:</span><a class="btn-social bs-facebook me-2 mb-2" href="#"><i class="ci-facebook"></i></a><a class="btn-social bs-twitter me-2 mb-2" href="#"><i class="ci-twitter"></i></a><a class="btn-social bs-pinterest me-2 mb-2" href="#"><i class="ci-pinterest"></i></a></div>
            </div>
            <!-- Post navigation-->
            <nav class="entry-navigation" aria-label="Post navigation">
              <a class="entry-navigation-link" href="#" data-bs-toggle="popover" data-bs-placement="top" data-bs-trigger="hover">
                <i class="ci-arrow-left me-2"></i>
                <span class="d-none d-sm-inline">Prev post</span>
              </a>
              <a class="entry-navigation-link" href="{{ url('/blog') }}">
                <i class="ci-view-list me-2"></i>
                <span class="d-none d-sm-inline">
                All posts
              </span>
              </a>
              <a class="entry-navigation-link" href="#" data-bs-toggle="popover" data-bs-placement="top" data-bs-trigger="hover" >
                <span class="d-none d-sm-inline">Next post</span>
                <i class="ci-arrow-right ms-2"></i>
              </a>
            </nav>
            
          </div>
        </div>
      </div>
		
        
    </main>

@endsection

@section('script_last')
    
@endsection
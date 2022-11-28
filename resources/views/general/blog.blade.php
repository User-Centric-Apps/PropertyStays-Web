@extends('layouts.master')

@section('title')

All Destination

@endsection


@section('script')

@endsection



@section('content')

	<main class="container-fluid px-0">

		<div class="bg-secondary py-4">
        <div class="container d-lg-flex justify-content-between py-2 py-lg-3">
          <div class="order-lg-2 mb-3 mb-lg-0 pt-lg-2">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb flex-lg-nowrap justify-content-center justify-content-lg-start">
                <li class="breadcrumb-item"><a class="text-nowrap" href="index.html"><i class="ci-home"></i>Home</a></li>
                <li class="breadcrumb-item text-nowrap"><a href="#">Blog</a>
                </li>
              </ol>
            </nav>
          </div>
          <div class="order-lg-1 pe-lg-4 text-center text-lg-start">
            <h1 class="h3 mb-0">Blog</h1>
          </div>
        </div>
      </div>
      <div class="container pb-5 mb-2 mb-md-4">
        <!-- Featured posts carousel-->
        <div class="pt-5 mt-md-2">
          @if(count($blogs)>0)
          <!-- Entries grid-->
          <div class="masonry-grid" data-columns="3">
            <!-- Entry-->
            @foreach($blogs as $blog)
              <article class="masonry-grid-item">
                <div class="card">
                  <a class="blog-entry-thumb" href="{{ URL::to('blog/detail/'.$blog->slug)}}">
                    <img class="card-img-top" alt="{{ $blog->title }}" src="{{ URL::to('storage/app/public/uploads/blog/'.$blog->image)}}">
                  </a>
                  <div class="card-body">
                    <h2 class="h6 blog-entry-title">
                      <a href="{{ URL::to('blog/detail/'.$blog->slug)}}">
                        {{ $blog->title }}
                      </a>
                    </h2>
                    <p class="fs-sm">
                      {{ Str::limit(strip_tags($blog->description),200) }}
                    </p>
                    <a class="btn-tag me-2 mb-2" href="#">
                      {{ $blog->category_name }}
                    </a>
                  </div>
                  <div class="card-footer d-flex align-items-center fs-xs">
                    <a class="blog-entry-meta-link" href="#">
                      By Emma Gallaher
                    </a>
                    <div class="ms-auto text-nowrap">
                      <a class="blog-entry-meta-link text-nowrap" href="#">
                        {{ $blog->date }}
                      </a>
                    </div>
                  </div>
                </div>
              </article>
            @endforeach  
          </div>
          <hr class="mb-4">
          <!-- Pagination-->
          <nav class="d-flex justify-content-between pt-2" aria-label="Page navigation">
            <ul class="pagination">
              <li class="page-item"><a class="page-link" href="#"><i class="ci-arrow-left me-2"></i>Prev</a></li>
            </ul>
            <ul class="pagination">
              <li class="page-item d-sm-none"><span class="page-link page-link-static">1 / 5</span></li>
              <li class="page-item active d-none d-sm-block" aria-current="page"><span class="page-link">1<span class="visually-hidden">(current)</span></span></li>
              <li class="page-item d-none d-sm-block"><a class="page-link" href="#">2</a></li>
              <li class="page-item d-none d-sm-block"><a class="page-link" href="#">3</a></li>
              <li class="page-item d-none d-sm-block"><a class="page-link" href="#">4</a></li>
              <li class="page-item d-none d-sm-block"><a class="page-link" href="#">5</a></li>
            </ul>
            <ul class="pagination">
              <li class="page-item"><a class="page-link" href="#" aria-label="Next">Next<i class="ci-arrow-right ms-2"></i></a></li>
            </ul>
          </nav>
          @endif
        </div>
      </div>
        
    </main>

@endsection

@section('script_last')

@endsection
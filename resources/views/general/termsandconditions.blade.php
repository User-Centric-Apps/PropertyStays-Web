@extends('layouts.master')

@section('title')

{{ $item->title }}

@endsection


@section('script')

@endsection



@section('content')

    <main class="container-fluid px-0">
      <section class="position-relative bg-dark bg-size-cover bg-position-center-x position-relative py-5" style="background-image: url({{ URL::to('/') }}/storage/app/public/uploads/pages/{{ $item->image }});"><span class="position-absolute top-0 start-0 w-100 h-100 bg-darker" style="opacity: .65;"></span>
          <div class="container position-relative zindex-5 py-4 my-3">
            <div class="row justify-content-center">
              <div class="col-lg-8">
                <h1 class="text-light text-center">{{ $item->title }}</h1>
                
              </div>
            </div>
          </div>
      </section>
      <div class="container py-2 py-lg-3">
        <div class="row">
          <div class="col-12">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb flex-lg-nowrap justify-content-center justify-content-lg-start">
                <li class="breadcrumb-item">
                  <a class="text-nowrap" href="{{ url('/') }}">
                    <i class="ci-home"></i>Home</a>
                </li>
                <li class="breadcrumb-item text-nowrap active" aria-current="page">
                  {{ $item->title }}
                </li>
              </ol>
            </nav>
          </div>
        </div>
      </div>
      <section class="container py-3">
        <div class="row pt-4">
          {!! $item->description !!}
        </div>
      </section>
    </main>

@endsection

@section('script_last')

@endsection
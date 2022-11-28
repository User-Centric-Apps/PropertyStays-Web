@extends('layouts.master')

@section('title')

{{ $item->title }}

@endsection


@section('script')

@endsection



@section('content')

    <main class="container-fluid px-0">
      <section class="bg-primary bg-position-top-center bg-repeat-0 py-5 syed-bg" style="background-image: url({{ URL::to('/') }}/storage/app/public/uploads/pages/{{ $item->image }});">
        <div class="pb-lg-5 mb-lg-3">
          <div class="container py-lg-5 my-lg-5">
            <div class="row mb-4 mb-sm-5">
              <div class="col-lg-7 col-md-9 text-center text-sm-start">
                <h1 class="lh-base" style="color: #00bdbc !important; text-shadow: 2px 2px 2px rgb(0 0 0);">
                  {{ $item->title }}
                </h1>
                <h2 class="h5 text-green fw-dark"  style="color: #00bdbc !important; text-shadow: 2px 2px 2px rgb(0 0 0);">
                  {{ $item->sub_title }}
                </h2>
              </div>
            </div>
            
          </div>
        </div>
      </section>

      <section class="container position-relative pt-3 pt-lg-0 pb-5 mt-lg-n10" style="z-index: 10;">
        <div class="card px-lg-2 border-0 shadow-lg">
          <div class="row">
            <div class="col-12">
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb justify-content-end py-2">
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
          <div class="card-body px-4 pt-3 pb-4">
            {!! $item->description !!}
          </div>
        </div>
      </section>

     
    </main>

@endsection

@section('script_last')

@endsection
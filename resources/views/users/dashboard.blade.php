@extends('layouts.master')

@section('title')

Dashboard

@endsection


@section('script')

@endsection



@section('content')

<div class="page-title-overlap bg-primary pt-4">
        @include('layouts.user-breadcrums')
      </div>
      <div class="container mb-5 pb-3">
        <div class="bg-light shadow-lg rounded-3 overflow-hidden">
          <div class="row">
            <!-- Sidebar-->
            <aside class="col-lg-4 pe-xl-5">

              @include('layouts.user-sidebar')

            </aside>
            <!-- Content-->
            <section class="col-lg-8 pt-lg-4 pb-4 mb-3">
              <div class="pt-2 px-4 ps-lg-0 pe-xl-5">
                <h2 class="h3 py-2 text-center text-sm-start">Dashboard</h2>

                @if (session('success'))
                  <div class="bg-success rounded-3 p-4 mb-4">
                    <p class="fs-sm text-white mb-0">
                      {{ session('success') }}
                    </p>
                  </div>
                @elseif(session('danger'))
                  <div class="bg-danger rounded-3 p-4 mb-4">
                    <p class="fs-sm text-white mb-0">
                      {{ session('danger') }}
                    </p>
                </div>
                @endif
                <!-- Tabs-->
                <ul class="nav nav-tabs nav-justified" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link px-0 active" href="#profile" data-bs-toggle="tab" role="tab">
                      <div class="d-none d-lg-block">
                        <i class="ci-user opacity-60 me-2"></i>
                        Profile
                      </div>
                      <div class="d-lg-none text-center">
                        <i class="ci-user opacity-60 d-block fs-xl mb-2"></i>
                        <span class="fs-ms">Profile</span>
                      </div>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link px-0" href="#picture" data-bs-toggle="tab" role="tab">
                      <div class="d-none d-lg-block">
                        <i class="ci-image opacity-60 me-2"></i>
                        Change Picture
                      </div>
                      <div class="d-lg-none text-center">
                        <i class="ci-image opacity-60 d-block fs-xl mb-2"></i>
                        <span class="fs-ms">Change Picture</span>
                      </div>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link px-0" href="#password" data-bs-toggle="tab" role="tab">
                      <div class="d-none d-lg-block">
                        <i class="ci-key opacity-60 me-2"></i>
                        Change Password
                      </div>
                      <div class="d-lg-none text-center">
                        <i class="ci-key opacity-60 d-block fs-xl mb-2"></i>
                        <span class="fs-ms">Change Password</span>
                      </div>
                    </a>
                  </li>
                </ul>
                <!-- Tab content-->
                <div class="tab-content">
                  <!-- Profile-->
                  <div class="tab-pane fade show active" id="profile" role="tabpanel">

                    <form action="{{ url('my-account/save') }}" id="form_sample_3" class="form-horizontal" enctype="multipart/form-data" method="post">

                      {!! csrf_field() !!}
                    
                    <div class="row gx-4 gy-3 py-2">
                      <div class="col-sm-6">
                        <label class="form-label" for="name">Name</label>
                        <input class="form-control" type="text" id="name" name="name" value="{{ Auth::user()->name }}" required>
                      </div>
                      <div class="col-sm-6">
                        <label class="form-label" for="email">Email address</label>
                        <input class="form-control" type="text" id="email" value="{{ Auth::user()->email }}" disabled="disabled">
                      </div>
                      <div class="col-sm-6">
                        <label class="form-label" for="mobile">Mobile</label>
                        <input class="form-control" type="tel" name="mobile" id="mobile" value="{{ Auth::user()->mobile }}" required>
                      </div>
                      <div class="col-sm-6">
                        <label class="form-label" for="whatsapp">Whatsapp</label>
                        <input class="form-control" type="tel" name="whatsapp" id="whatsapp" value="{{ Auth::user()->whatsapp }}">
                      </div>
                      <?php
                        $notification = "";
                            if(Auth::user()->notification == 1)
                            {
                                $notification = "checked";
                            }
                            else
                            {
                                $notification = "";
                            }
                      ?>
                      <div class="col-12">

                        <div class="border-bottom">
                          <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" value="1" id="notification" name="notification" {{ $notification }}>
                            <label class="form-check-label" for="notification">Notifications</label>
                          </div>
                          <div class="form-text">Send notifications on mobile</div>
                        </div>

                      </div>
                      <div class="col-12">
                        <div class="text-sm-end mt-2">
                          <button class="btn btn-primary" type="submit">Update</button>
                        </div>
                      </div>
                    </div>

                  </form>

                  </div>
                  <!-- Notifications-->
                  <div class="tab-pane fade" id="password" role="tabpanel">
                    <form action="{{ url('my-password/save') }}" novalidate class="needs-validation" method="post">

                      {!! csrf_field() !!}
                    
                    <div class="row gx-4 gy-3 py-2">
                      <div class="col-sm-12">
                        <label class="form-label" for="current_password">Current Password</label>
                        <input class="form-control" type="password" id="current_password" name="current_password" required="required" autocomplete="off">
                      </div>
                      <div class="col-sm-6">
                        <label class="form-label" for="chpassword">Password</label>
                        <input class="form-control" type="password" id="chpassword" name="password" required="required"  autocomplete="off">
                      </div>
                      <div class="col-sm-6">
                        <label class="form-label" for="mobile">Confirm Password</label>
                        <input class="form-control" type="password" id="password_confirmation" name="password_confirmation" required="required" autocomplete="off">
                      </div>
                      <div class="col-12">
                        <div class="text-sm-end mt-2">
                          <button class="btn btn-primary" type="submit">Update</button>
                        </div>
                      </div>
                    </div>

                  </form>
                    
                  </div>
                  <!-- Picture-->
                  <div class="tab-pane fade" id="picture" role="tabpanel">

                    <div class="table-responsive fs-md mb-4">
                      <form action="{{ url('my-picture/save') }}" id="form_sample_3" class="form-horizontal" enctype="multipart/form-data" method="post">

                      {!! csrf_field() !!}

                      @if(Auth::user()->profile_pic)
                      <div class="text-center mb-2">
                          <img src="{{ URL::to('/') }}/storage/app/public/uploads/customers/{{ isset(Auth::user()->profile_pic)?Auth::user()->profile_pic:'no-image.png' }}" alt="{{ Auth::user()->name }}" class="img-thumbnail position-relative flex-shrink-0">
                        </div>
                      @endif

                        <!-- Drag and drop file upload -->
                        <div class="file-drop-area">
                          <div class="file-drop-icon ci-cloud-upload"></div>
                          <span class="file-drop-message">Drag and drop here to upload</span>
                          <input type="file" class="file-drop-input" name="image" required>
                          <button type="submit" class="btn btn-primary btn-sm">
                            Upload
                          </button>
                          <span class="file-drop-btn"></span>
                        </div>
                        <!-- Drag and drop file upload -->

                    </form>

                    </div>
                    
                  </div>
                </div>
              </div>
            </section>
          </div>
        </div>
      </div>

@endsection

@section('script_last')

@endsection
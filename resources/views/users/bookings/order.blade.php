@extends('layouts.master')

@section('title')

Orders

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
              <h2 class="h3 pt-2 pb-4 mb-0 text-center text-sm-start border-bottom">
                My Orders
              </h2>
              
            <!-- Orders list-->
              @if(count($orders) > 0)
            <div class="table-responsive fs-md mb-4">
              <table class="table table-hover mb-0">
                <thead>
                  <tr>
                    <th>Order #</th>
                    <th>Status</th>
                    <th>Date Purchased</th>
                    <th>Total</th>
                    <th>Method</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($orders as $item)
                  <tr>
                    <td class="py-3">
                      <a class="nav-link-style fw-medium fs-sm" href="#order-details" data-bs-toggle="modal">
                        {{ $item->id }}
                      </a>
                    </td>
                    <td class="py-3">{{ $item->order_transaction }}</td>
                    <td class="py-3">{{ $item->date }}</td>
                    <td class="py-3">{{ $item->total_bill }}</td>
                    <td class="py-3">
                      <span class="badge bg-info m-0">{{ $item->order_transaction }}</span>
                    </td>
                    <td class="py-3">{{ $item->payment_method }}</td>
                  </tr>
                  @endforeach
                  
                </tbody>
              </table>
               
            </div>
            <!-- Pagination-->
            <nav class="d-flex justify-content-between pt-2" aria-label="Page navigation">
              
              {!! $orders->render() !!}
              
            </nav>
            @else 
                <div class="bg-secondary rounded-3 p-4 mb-4">
                  <p class="fs-sm text-muted mb-0">No record found!</p>
                </div>
              @endif 
            </section>
          </div>
        </div>
      </div>

@endsection

@section('script_last')

@endsection
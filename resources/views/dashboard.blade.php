
@extends('layouts/contentLayoutMaster')

@section('title', 'Dashboard Analytics')

@section('vendor-style')
  <!-- vendor css files -->
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/charts/apexcharts.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/extensions/toastr.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/datatables.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/responsive.bootstrap.min.css')) }}">
@endsection
@section('page-style')
  <!-- Page css files -->
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/charts/chart-apex.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/extensions/ext-component-toastr.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('css/base/pages/app-invoice-list.css')) }}">
  @endsection

@section('content')
<!-- Dashboard Analytics Start -->
<section id="dashboard-analytics">
  <div class="row match-height">
    <!-- Greetings Card starts -->
    <div class="col-12">
      <div class="card card-congratulations">
        <div class="card-body text-center">
          <img
            src="{{asset('images/elements/decore-left.png')}}"
            class="congratulations-img-left"
            alt="card-img-left"
          />
          <img
            src="{{asset('images/elements/decore-right.png')}}"
            class="congratulations-img-right"
            alt="card-img-right"
          />
          {{-- <div class="avatar avatar-xl bg-primary shadow">
            <div class="avatar-content">
              <i data-feather="book" class="font-large-1"></i>
            </div>
          </div> --}}
          <div class="text-center">
            <h1 class="mb-1 text-white"> Welcome!</h1>
            <h1 class="mb-1 text-white">Khawateen Magazine Shop Dashboard</h1>
            {{-- <p class="card-text m-auto w-75">
              You have done <strong>57.6%</strong> more sales today. Check your new badge in your profile.
            </p> --}}
          </div>
        </div>
      </div>
    </div>
    <!-- Greetings Card ends -->
  </div>
</section>
<div class="row">
  <div class="col-xl-2 col-md-4 col-sm-6">
      <div class="card text-center">
          <div class="card-body">
              <div class="avatar bg-light-info p-50 mb-1">
                  <div class="avatar-content">
                      <i data-feather="book" class="font-medium-5"></i>
                  </div>
              </div>
              <h2 class="font-weight-bolder">{{$books}}</h2>
              <p class="card-text">Books</p>
          </div>
      </div>
  </div>
  <div class="col-xl-2 col-md-4 col-sm-6">
      <div class="card text-center">
          <div class="card-body">
              <div class="avatar bg-light-info p-50 mb-1">
                  <div class="avatar-content">
                      <i data-feather="printer" class="font-medium-5"></i>
                  </div>
              </div>
              <h2 class="font-weight-bolder">{{$publications}}</h2>
              <p class="card-text">Publications</p>
          </div>
      </div>
  </div>
  <div class="col-xl-2 col-md-4 col-sm-6">
    <div class="card text-center">
        <div class="card-body">
            <div class="avatar bg-light-info p-50 mb-1">
                <div class="avatar-content">
                    <i data-feather="user" class="font-medium-5"></i>
                </div>
            </div>
            <h2 class="font-weight-bolder">{{$authors}}</h2>
            <p class="card-text">Authors</p>
        </div>
    </div>
</div>
</div>
<!-- Dashboard Analytics end -->
@endsection

@section('vendor-script')
  <!-- vendor files -->
  <script src="{{ asset(mix('vendors/js/charts/apexcharts.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/extensions/toastr.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/extensions/moment.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/datatables.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/datatables.buttons.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/datatables.bootstrap4.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.responsive.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/responsive.bootstrap.min.js')) }}"></script>
@endsection
@section('page-script')
  <!-- Page js files -->
  <script src="{{ asset(mix('js/scripts/pages/dashboard-analytics.js')) }}"></script>
  <script src="{{ asset(mix('js/scripts/pages/app-invoice-list.js')) }}"></script>
  <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
@endsection

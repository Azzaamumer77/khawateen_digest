@extends('layouts/contentLayoutMaster')

@section('vendor-style')
    {{-- Vendor Css files --}}
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/extensions/sweetalert2.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/dataTables.bootstrap4.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/responsive.bootstrap4.min.css')) }}">
@endsection

@section('page-style')
    {{-- Page Css files --}}
    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-validation.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/extensions/ext-component-sweet-alerts.css')) }}">
@endsection
@section('content')
    @include('panels.response')
    <div class="card">
        <div class="card-body">
            <table class="table table-striped table-hover table-responsive-lg" id="publicationsTable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Publication Name</th>
                            <th>Total Debit</th>
                            <th>Total Credit</th>
                            <th>Generate PDF</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($publications as $publication)
                            <tr>
                                <td scope="row">{{ $loop->iteration }}</td>
                                <td>{{ $publication->name }}</td>
                                <td>{{ $publication->debit_total }}</td>
                                <td>{{ $publication->credit_total }}</td>
                                <td>
                                    <a class="btn btn-primary" href="">
                                        Download
                                        <i class="fas fa-plus-circle"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
            </table>
        </div>
    </div>
@endsection


@section('vendor-script')
    <!-- vendor files -->
    <script src="{{ asset(mix('vendors/js/extensions/sweetalert2.all.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/forms/validation/jquery.validate.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/forms/select/select2.full.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/jquery.dataTables.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/datatables.bootstrap4.min.js')) }}"></script>
@endsection


@section('page-script')
    <script>
        $('#publicationsTable').DataTable({
            "drawCallback": function(settings) {
                feather.replace({
                    width: 14,
                    height: 14
                });
            }
        });
    </script>
@endsection

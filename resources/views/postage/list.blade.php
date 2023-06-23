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
            <div class="row mb-2">
                <div class="col-md-12">
                    <div class="text-right">
                        <a class="btn btn-primary" href="{{ route('postage.create') }}">
                            Add New postage
                            <i class="fas fa-plus-circle"></i>
                        </a>
                    </div>

                </div>

            </div>
            <hr>
            <table class="table table-striped table-hover table-responsive-lg" id="postagesTable">
                @if ($postages->count())
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>City</th>
                            <th>Registeration No</th>
                            <th>Invoice No</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($postages as $postage)
                            <tr>
                                <td scope="row">{{ $loop->iteration }}</td>
                                <td>{{ $postage->name }}</td>
                                <td>{{ $postage->city }}</td>
                                <td>{{ $postage->registration_no }}</td>
                                <td>{{ $postage->invoice_no ? intval($postage->invoice_no) : ' '}}</td>
                                <td>{{ date(Config::get('date.date_format'), strtotime($postage->date))}}</td>
                                {{-- <td>{{ $postage->status }}</td>
                                 --}}
                                 <td>
                                    @if($postage->status == 'Received')
                                        <span class="badge badge-success">{{ $postage->status }}</span>
                                    @elseif($postage->status == 'Returned')
                                        <span class="badge badge-danger">{{ $postage->status }}</span>
                                    @else
                                    <span class="badge badge-light-primary">{{ $postage->status }}</span>
                                    @endif
                                </td>
                                
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn btn-sm dropdown-toggle hide-arrow"
                                            data-toggle="dropdown">
                                            <i data-feather="more-vertical"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="{{ route('postage.edit', $postage->id) }}">
                                                <i data-feather="edit-2" class="mr-50"></i>
                                                <span>Edit</span>
                                            </a>
                                            <a class="dropdown-item" href="javascript:void(0);" id="deletepostage"
                                                data-id="{{ $postage->id }}">
                                                <i data-feather="trash" class="mr-50"></i>
                                                <span>Delete</span>
                                            </a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                @else
                    <div class="font-weight-bold text-danger h3 text-center mt-5"><i class="fa fa-info-circle"></i>No postages
                        Found.
                    </div>
                @endif
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
        $(document).ready(function() {
            $("body").on("click", "#deletepostage", function(e) {
                var id = $(this).data("id");
                Swal.fire({
                    title: 'Are you sure?',
                    text: "All of the data related to this postage will also be deleted. You cannot revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete it!',
                    customClass: {
                        confirmButton: 'btn btn-primary',
                        cancelButton: 'btn btn-outline-danger ml-1'
                    },
                    buttonsStyling: false
                }).then(function(result) {

                    if (result.value) {
                        $.ajaxSetup({
                            headers: {
                                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                                    "content"),
                            },
                        });
                        $.ajax({
                            url: '/postage/' + id,
                            type: "DELETE",
                            success: function(response) {
                                location.reload();

                            },
                            error: function(xhr) {
                                location.reload();
                            }
                        });
                    }
                });
            });
        });
        $('#postagesTable').DataTable({
            "drawCallback": function(settings) {
                feather.replace({
                    width: 14,
                    height: 14
                });
            }
        });
    </script>
@endsection

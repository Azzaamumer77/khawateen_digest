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
                    <div class="text-left">
                        <a class="btn btn-primary" href="{{ route('book.records') }}">
                            Generate Publication Record
                            <i class="fas fa-plus-circle"></i>
                        </a>
                    </div>
                    <div class="text-right">
                        <a class="btn btn-primary" href="{{ route('publications.create') }}">
                            Add New Record
                            <i class="fas fa-plus-circle"></i>
                        </a>
                    </div>

                </div>

            </div>
            <hr>
            <table class="table table-striped table-hover table-responsive-lg" id="publicationsTable">
                @if ($publication_record->count())
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Publication Name</th>
                            <th>Invoice Number</th>
                            <th>Debit</th>
                            <th>Credit</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($publication_record as $record)
                            <tr>
                                <td scope="row">{{ $loop->iteration }}</td>
                                <td>{{ $record->name }}</td>
                                <td>{{ $record->invoice_no }}</td>
                                <td>{{ $record->debit }}</td>
                                <td>{{ $record->credit }}</td>
                                <td>{{ $record->date }}</td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn btn-sm dropdown-toggle hide-arrow"
                                            data-toggle="dropdown">
                                            <i data-feather="more-vertical"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="{{ route('publications.edit', $record->id) }}">
                                                <i data-feather="edit-2" class="mr-50"></i>
                                                <span>Edit</span>
                                            </a>
                                            <a class="dropdown-item" href="javascript:void(0);" id="deleteRecord"
                                                data-id="{{ $record->id }}">
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
                    <div class="font-weight-bold text-danger h3 text-center mt-5"><i class="fa fa-info-circle"></i>No Records
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
            $("body").on("click", "#deleteRecord", function(e) {
                var id = $(this).data("id");
                Swal.fire({
                    title: 'Are you sure?',
                    text: "All of the data related to this book will also be deleted. You cannot revert this!",
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
                            url: '/publications/' + id,
                            type: "DELETE",
                            success: function(response) {
                                alert(1);
                                location.reload();

                            },
                            error: function(xhr) {
                                alert(2);
                                location.reload();
                            }
                        });
                    }
                });
            });
        });
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

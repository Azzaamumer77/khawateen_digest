@extends('layouts/contentLayoutMaster')


@section('vendor-style')
    {{-- Vendor Css files --}}
    {{-- <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('vendors/css/animate/animate.min.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('vendors/css/extensions/sweetalert2.min.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('css/base/pages/product_form.css')) }}"> --}}
@endsection

@section('page-style')
    {{-- Page Css files --}}
    {{-- <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-validation.css')) }}">
<link rel="stylesheet" href="{{asset(mix('css/base/plugins/extensions/ext-component-sweet-alerts.css'))}}"> --}}

@endsection
@section('content')
    @include('panels.response')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    @if(isset($record))
                    <h2>Edit Record</h2>
                    @else
                    <h2>Add record</h2>
                    @endif
                    <!-- Form -->
                    <form id="jquery-val-form" class="form form-horizontal mt-2" enctype="multipart/form-data" method="POST"
                        @if (isset($record)) action="{{ route('publications.update', $record->id) }}" @else
                    action="{{ route('publications.store') }}" @endif>
                        @csrf
                        @if (isset($record))
                            @method('PUT')
                        @endif
                        <div class="row">
                            <div class="col-md-6 col-12">
                                <div class="form-group mb-2">
                                    <label for="blog-edit-title">Publication Name</label>
                                    <input type="text" name="name" id="publication_id" class="form-control"
                                        @if (isset($record)) value="{{ old('name', $record->name) }}" @else
                                    value="{{ old('name') }}" @endif
                                        required />
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group mb-2">
                                    <label for="blog-edit-title">Invoice Number</label>
                                    <input type="number" name="invoice_no" id="invoice_no" class="form-control"
                                        @if (isset($record)) value="{{ old('invoice_no', $record->invoice_no) }}" @else
                                    value="{{ old('invoice_no') }}" @endif
                                        required />
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group mb-2">
                                    <label for="debit">Debit</label>
                                    <input type="number" name="debit" id="debit" class="form-control"
                                        @if (isset($record)) value="{{ old('debit', $record->debit) }}" @else
                                    value="{{ old('debit') }}" @endif
                                         />
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group mb-2">
                                    <label for="credit">Credit</label>
                                    <input type="number" name="credit" id="credit"
                                        class="form-control"
                                        @if (isset($record)) value="{{ old('credit', $record->credit) }}" @else
                                    value="{{ old('credit') }}" @endif
                                         />
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group mb-2">
                                    <label for="quantity">Date</label>
                                    <input type="date" name="date" id="date" class="form-control"
                                        @if (isset($record)) value="{{ old('date', $record->date) }}" @else
                                    value="{{ old('date') }}" @endif
                                        required />
                                </div>
                            </div>
                            <div class="col-md-12 mt-50 mb-2">
                                <button type="submit" class="btn btn-primary mr-1">
                                    @if (isset($record))
                                        Save Changes
                                    @else
                                        Add Record
                                    @endif
                                </button>
                                <a href="{{ route('publications.index') }} " type="reset"
                                    class="btn btn-outline-secondary">Cancel</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('vendor-script')
@endsection

@section('page-script')
@endsection
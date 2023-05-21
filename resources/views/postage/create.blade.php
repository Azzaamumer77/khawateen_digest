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
                    @if(isset($postage))
                    <h2>Edit Postage</h2>
                    @else
                    <h2>Add Postage</h2>
                    @endif
                    <!-- Form -->
                    <form id="jquery-val-form" class="form form-horizontal mt-2" enctype="multipart/form-data" method="POST"
                        @if (isset($postage)) action="{{ route('postage.update', $postage->id) }}" @else
                    action="{{ route('postage.store') }}" @endif>
                        @csrf
                        @if (isset($postage))
                            @method('PUT')
                        @endif
                        <div class="row">
                            <div class="col-md-6 col-12">
                                <div class="form-group mb-2">
                                    <label for="blog-edit-title">Name</label>
                                    <input type="text" name="name" id="blog-edit-title" class="form-control" placeholder="Enter Name"
                                        @if (isset($postage)) value="{{ old('title', $postage->name) }}" @else
                                    value="{{ old('name') }}" @endif
                                        required />
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group mb-2">
                                    <label for="blog-edit-title">City</label>
                                    <input type="text" name="city" id="blog-edit-title" class="form-control" placeholder="Enter City"
                                        @if (isset($postage)) value="{{ old('title', $postage->city) }}" @else
                                    value="{{ old('city') }}" @endif
                                        required />
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group mb-2">
                                    <label for="date">Date</label>
                                    <input type="date" name="date" id="date" class="form-control" 
                                        @if (isset($postage)) value="{{ old('author', $postage->date) }}" @else
                                    value="{{ old('city') }}" @endif
                                        required />
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group mb-2">
                                    <label for="registration_no">Registration No</label>
                                    <input type="text" name="registration_no" id="blog-edit-title" class="form-control" placeholder="Enter Registration No"
                                        @if (isset($postage)) value="{{ old('title', $postage->registration_no) }}" @else
                                    value="{{ old('registration_no') }}" @endif
                                        required />
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group mb-2">
                                    <label for="quantity">Invoice No</label>
                                    <select class="form-control hide-search" id="invoice" name="invoice_no" >
                                        <option value="" selected>Select Invoice</option>
                                        @foreach ($invoices as $invoice)
                                        <option @if ((isset($postage)) && $invoice  == old('invoice_no',
                                            $postage->invoice_no))
                                            selected
                                            @elseif (old('invoice_no') == $invoice)
                                            selected
                                            @endif value="{{ $invoice }}">{{ $invoice }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group mb-2">
                                    <label for="detail">Detail</label>
                                    <input type="text" name="detail" id="detail" class="form-control" placeholder="Enter Details"
                                        @if (isset($postage)) value="{{ old('detail', $postage->details) }}" @else
                                    value="{{ old('detail') }}" @endif
                                        required />
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group mb-2">
                                    <label for="status">Status</label>
                                    <select class="form-control" id="status" name="status" required>
                                        <option value="" selected disabled>Select Status</option>
                                        <option  @if ((isset($postage)) && $postage->status  == old('status',
                                        "Pending"))
                                        selected
                                        @elseif (old('status'))
                                        selected
                                        @endif value="Pending">Pending</option>
                                        <option  @if ((isset($postage)) && $postage->status  == old('status',
                                        "Received"))
                                        selected
                                        @elseif (old('status'))
                                        selected
                                        @endif value="Received">Received</option>
                                        <option  @if ((isset($postage)) && $postage->status  == old('status',
                                        "Returned"))
                                        selected
                                        @elseif (old('status'))
                                        selected
                                        @endif value="Returned">Returned</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12 mt-50 mb-2">
                                <button type="submit" class="btn btn-primary mr-1">
                                    @if (isset($postage))
                                        Save Changes
                                    @else
                                        Save
                                    @endif
                                </button>
                                <a href="{{ route('postage.index') }} " type="reset"
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
<script>
    $(document).ready(function() {
        $('#invoiceSearch').on('input', function() {
            var searchText = $(this).val().trim().toLowerCase();
            $('#invoice option').each(function() {
                var optionText = $(this).text().toLowerCase();
                if (optionText.indexOf(searchText) === -1) {
                    $(this).hide();
                } else {
                    $(this).show();
                }
            });
        });
    });
</script>
@endsection

@section('page-script')
@endsection
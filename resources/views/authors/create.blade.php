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
                    @if(isset($author))
                    <h2>Edit author</h2>
                    @else
                    <h2>Add author</h2>
                    @endif
                    <!-- Form -->
                    <form id="jquery-val-form" class="form form-horizontal mt-2" enctype="multipart/form-data" method="POST"
                        @if (isset($author)) action="{{ route('authors.update', $author->id) }}" @else
                    action="{{ route('authors.store') }}" @endif>
                        @csrf
                        @if (isset($author))
                            @method('PUT')
                        @endif
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group mb-2">
                                    <input type="checkbox" id="popular" name="popular" value="{{old('popular',1)}}" @if (isset($author) && ($author->is_popular == 1)) checked @endif >
                                    <label for="popular" class="font-weight-bolder"> Mark as Popular</label>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group mb-2">
                                    <label for="blog-edit-title">Full Name</label>
                                    <input type="text" name="name" id="blog-edit-title" class="form-control"
                                        @if (isset($author)) value="{{ old('title', $author->name) }}" @else
                                    value="{{ old('name') }}" @endif
                                        required />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-12">
                                <div class="form-group mb-2">
                                    <label for="services">Services</label>
                                    <textarea name="services" id="services" class="form-control">@if(isset($author)){{$author->services}}@endif</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 mb-2">
                                <label for="discounted_price">Add Image</label>
                                <div class="col-md-6 form-group">
                                        <input type="file" name="file" class="custom-file-input form-control"
                                                    @if (isset($author)) data-id="{{ $author->image }}" @endif
                                                    name="file" accept=".png, .jpg, .jpeg">
                                    <label id="file_id" class="custom-file-label" for="file">Choose File</label>
                                </div>
                                <div>
                                    <p>
                                        <span class="text-danger font-weight-bold">* Required</span>
                                        <span class=".text-light ml-1">Upload Image in JPG, JPEG, PNG format only</span>
                                    </p>
                                </div>
                                @if (isset($author) && $author->image)
                                <div class="row mt-1">
                                    <div class="col-sm-3">
                                        <div class="card">
                                            <img src="{{ asset('storage/authors/' . $author->image) }}"
                                                alt="post Image" />
                                            {{-- <a onclick="deleteImage(this)" data-id="{{ $author->image }}"
                                                class="btn btn-outline-danger text-danger"
                                                style="border-radius:0;">Remove</a> --}}
                                        </div>
                                    </div>
                                </div>
                            @endif
                            </div>
                            <div class="col-md-12 mt-50 mb-2">
                                <button type="submit" class="btn btn-primary mr-1">
                                    @if (isset($author))
                                        Save Changes
                                    @else
                                        Save
                                    @endif
                                </button>
                                <a href="{{ route('authors.index') }} " type="reset"
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
<script src="{{ asset(mix('vendors/js/extensions/sweetalert2.all.min.js')) }}"></script>
@endsection

@section('page-script')
@if((!isset($author)) || ((isset($author)) && $author->is_popular !=1))
<script>
$("#popular").change(function()
  {
    if(((this.checked) && ({{$popular_authors}} >=10)))  {
        Swal.fire({
            title: '',
            text: "You have already marked 10 authors as popular",
            icon: 'warning',
            showCancelButton: false,
            confirmButtonText: 'Ok',
            customClass: {
                confirmButton: 'btn btn-primary',
            },
            buttonsStyling: false
        })
        this.checked = false ;
    }
  });
</script>
@endif
@endsection
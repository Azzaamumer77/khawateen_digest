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
                    @if(isset($book))
                    <h2>Edit Book</h2>
                    @else
                    <h2>Add Book</h2>
                    @endif
                    <!-- Form -->
                    <form id="jquery-val-form" class="form form-horizontal mt-2" enctype="multipart/form-data" method="POST"
                        @if (isset($book)) action="{{ route('books.update', $book->id) }}" @else
                    action="{{ route('books.store') }}" @endif>
                        @csrf
                        @if (isset($book))
                            @method('PUT')
                        @endif
                        <div class="row">
                            <div class="col-md-6 col-12">
                                <div class="form-group mb-2">
                                    <label for="blog-edit-title">Urdu Name</label>
                                    <input type="text" name="urdu_name" id="blog-edit-title" class="form-control"
                                        @if (isset($book)) value="{{ old('title', $book->urdu_name) }}" @else
                                    value="{{ old('urdu_name') }}" @endif
                                        required />
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group mb-2">
                                    <label for="blog-edit-title">English Name</label>
                                    <input type="text" name="english_name" id="blog-edit-title" class="form-control"
                                        @if (isset($book)) value="{{ old('title', $book->english_name) }}" @else
                                    value="{{ old('english_name') }}" @endif
                                        required />
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group mb-2">
                                    <label for="author">Author</label>
                                    <input type="text" name="author" id="author" class="form-control"
                                        @if (isset($book)) value="{{ old('author', $book->author) }}" @else
                                    value="{{ old('author') }}" @endif
                                        required />
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group mb-2">
                                    <label for="publications_name">Publications Name</label>
                                    <input type="text" name="publications_name" id="publications_name"
                                        class="form-control"
                                        @if (isset($book)) value="{{ old('publications_name', $book->publications_name) }}" @else
                                    value="{{ old('publications_name') }}" @endif
                                        required />
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group mb-2">
                                    <label for="quantity">Quantity</label>
                                    <input type="text" name="quantity" id="quantity" class="form-control"
                                        @if (isset($book)) value="{{ old('quantity', $book->publications_name) }}" @else
                                    value="{{ old('quantity') }}" @endif
                                        required />
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group mb-2">
                                    <label for="price">Price</label>
                                    <input type="text" name="price" id="price" class="form-control"
                                        @if (isset($book)) value="{{ old('price', $book->price) }}" @else
                                    value="{{ old('price') }}" @endif
                                        required />
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group mb-2">
                                    <label for="discounted_price">Discounted Price</label>
                                    <input type="text" name="discounted_price" id="discounted_price" class="form-control"
                                        @if (isset($book)) value="{{ old('discounted_price', $book->discounted_price) }}" @else
                                    value="{{ old('discounted_price') }}" @endif
                                        required />
                                </div>
                            </div>
                            <div class="col-md-12 mb-2">
                                <div class="form-group mb-2">
                                    <div class="border rounded p-2">
                                        <h5 class="mb-0">Image:</h5>
                                        <small class="text-muted">Required image resolution 800x400,max image size
                                        10mb.</small>
                                        <div class="image">
                                            <div class=" col-md-6 input">
                                                <label>
                                                    <h4>Add image</h4>
                                                </label>
                                                <input type="file" name="file" class="form-control"
                                                    @if (isset($book)) data-id="{{ $book->image }}" @endif
                                                    name="file" accept=".png, .jpg, .jpeg">
                                            </div>
                                            @if (isset($book) && $book->image)
                                                <div class="row mt-1">
                                                    <div class="col-sm-3">
                                                        <div class="card">
                                                            <img src="{{ asset('storage/books/' . $book->image) }}"
                                                                alt="post Image" />
                                                            <a onclick="deleteImage(this)" data-id="{{ $book->image }}"
                                                                class="btn btn-outline-danger text-danger"
                                                                style="border-radius:0;">Remove</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 mt-50 mb-2">
                                <button type="submit" class="btn btn-primary mr-1">
                                    @if (isset($book))
                                        Save Changes
                                    @else
                                        Save
                                    @endif
                                </button>
                                <a href="{{ route('books.index') }} " type="reset"
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
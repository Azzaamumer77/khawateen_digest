@extends('layouts/contentLayoutMaster')


@section('vendor-style')
    {{-- Vendor Css files --}}
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/animate/animate.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/extensions/sweetalert2.min.css')) }}">

@endsection

@section('page-style')
    {{-- Page Css files --}}
    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-validation.css')) }}">
<link rel="stylesheet" href="{{asset(mix('css/base/plugins/extensions/ext-component-sweet-alerts.css'))}}">

@endsection
@section('content')
    @include('panels.response')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h2>Add record</h2>
                    <!-- Form -->
                    <form id="jquery-val-form" class="form form-horizontal mt-2" enctype="multipart/form-data" method="POST"
                        @if (isset($record)) action="{{ route('bills.update', $record->id) }}" @else
                    action="{{ route('bills.store') }}" @endif>
                        @csrf
                            <div class="row">
                                <div class="col-md-6 col-12">
                                    <div class="form-group mb-2">
                                        <label for="blog-edit-title">Customer Name</label>
                                        <input type="text" name="name" id="name" class="form-control"
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
                            </div>
                            <h4 class="font-weight-bolder"> Items</h4>
                            <div id="books-container" class="mt-2">
                                <div class="book">
                                    <div class="row">
                                        <div class="col-4">
                                            <select class="form-control hide-search"  name="books[0][name]" required onchange="getSelectedValues(this)" >
                                                <option value=""> Select Book</option>
                                                @foreach ($books as $book)
                                                <option @if ((isset($record)) && $book->id == old('books[0][name]',
                                                    $record->book_id))
                                                    selected
                                                    @elseif (old('books[0][name]') == $book->id)
                                                    selected
                                                    @endif
                                                    value="{{ $book->id }}" data-quantity="{{ $book->quantity}}"
                                                    >
                                                    {{ $book->urdu_name }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-4">
                                        <input min="1" type="number" name="books[0][quantity]" placeholder="Quantity" class="form-control" required onchange="checkQuantity(this)">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                        
                            <button type="button"  class="btn btn-primary mr-1" onclick="addBook()">Add Item</button>
                            <div class="col-md-12 mt-50 mb-2 text-right">
                                <button type="submit" class="btn btn-primary mr-1">
                                    @if (isset($record))
                                        Save Changes
                                    @else
                                        Generate Bill
                                    @endif
                                </button>
                                <a href="{{ route('publications.index') }} " type="reset"
                                    class="btn btn-outline-secondary">Cancel</a>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('vendor-script')
    <script src="{{ asset(mix('vendors/js/extensions/sweetalert2.all.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/forms/validation/jquery.validate.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/forms/select/select2.full.min.js')) }}"></script>
@endsection

@section('page-script')
<script>
    let bookCount = 1;

    function addBook() {
        const booksContainer = document.getElementById('books-container');
        const bookDiv = document.createElement('div');
        bookDiv.classList.add('book');
        bookDiv.innerHTML = `
        <div class="row mt-2">
            <div class="col-4">
                <select class="form-control hide-search" name="books[${bookCount}][name]" required onchange="getSelectedValues(this)">
                        <option value="">Select Book</option>
                        @foreach ($books as $book)
                        <option @if ((isset($record)) && $book->id == old('books[${bookCount}][name]', $record->book_id))
                                selected
                            @elseif (old('books[${bookCount}][name]') == $book->id)
                                selected
                            @endif
                            value="{{ $book->id }}" data-quantity="{{$book->quantity}}"
                            >
                            {{ $book->urdu_name }}
                        </option>
                        @endforeach
                </select>
            </div>
            <div class="col-4">
            <input min="1" type="number" class="form-control" name="books[${bookCount}][quantity]" placeholder="Quantity" required onchange="checkQuantity(this)">
            </div>
            <button type="button" class="btn btn-primary mr-1" onclick="removeBook(this)">Remove</button>  
        </div>
        `;
        booksContainer.appendChild(bookDiv);
        bookCount++;
    }
    function removeBook(button) {
        const bookDiv = button.parentNode;
        bookDiv.remove();
    }
    function getSelectedValues(selectElement) {
        const selectElements = document.getElementsByClassName('hide-search');

        const selectedValues = [];
        const Option = selectElement.options[selectElement.selectedIndex];
        const bookDiv = selectElement.closest('.book');
        const quantityInput = bookDiv.querySelector('input[name$="[quantity]"]');
        
       for (var i = 0; i < selectElements.length; i++) {
            var selectedOption = selectElements[i].options[selectElements[i].selectedIndex];
            var selectedValue = selectedOption.value;

            if (selectElements[i] !== event.target) {
            selectedValues.push(selectedValue);
            }
        }
        if(selectedValues.includes(Option.value))
        {
            Swal.fire({
                    title: 'Already Selected',
                    text: "You have already selected this item",
                    icon: 'warning',
                    showCancelButton: false,
                    confirmButtonText: 'Ok',
                    customClass: {
                        confirmButton: 'btn btn-primary',
                    },
                    buttonsStyling: false
            })
            selectElement.value = "";
        }
        if(selectedOption.getAttribute('data-quantity') < quantityInput )
        {
            quantityInput.value = 0;
        }
    }
    function checkQuantity(quantity) {
        const bookDiv = quantity.closest('.book');
        const book_data = bookDiv.querySelector('.hide-search');
        const selectedOption = book_data.options[book_data.selectedIndex];
        const dataAttribute = selectedOption.dataset.quantity;
        console.log(quantity.value);
        console.log(dataAttribute);

        if(parseInt(dataAttribute) < parseInt(quantity.value))
        {
            Swal.fire({
                    title: 'Quantity Exceeded',
                    text: "You have only " +  dataAttribute + " Books In stock",
                    icon: 'warning',
                    showCancelButton: false,
                    confirmButtonText: 'Ok',
                    customClass: {
                        confirmButton: 'btn btn-primary',
                    },
                    buttonsStyling: false
            })
            quantity.value=0;
        }
    }

</script>
@endsection
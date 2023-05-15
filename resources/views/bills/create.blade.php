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
                                <div class="headings font-weight-bolder mb-3 text-center ">
                                    <div class="row">
                                        <div class="col-3">
                                            Book
                                        </div>
                                        <div class="col-2">
                                           Quantity
                                        </div>
                                        <div class="col-2">
                                            Discount(%)
                                        </div>
                                        <div class="col-2">
                                            Amount
                                        </div>
                                    </div>
                                </div>
                                <div class="items ">
                                    <div class="book">
                                        <div class="row">
                                            <div class="col-3">
                                                <select class="form-control hide-search"  name="books[0][name]" required onchange="getSelectedValues(this)" >
                                                    <option value=""> Select Book</option>
                                                    @foreach ($books as $book)
                                                    <option @if ((isset($record)) && $book->id == old('books[0][name]',
                                                        $record->book_id))
                                                        selected
                                                        @elseif (old('books[0][name]') == $book->id)
                                                        selected
                                                        @endif
                                                        value="{{ $book->id }}" data-quantity="{{ $book->quantity}}" data-amount="{{$book}}"
                                                        >
                                                        {{ $book->urdu_name }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-2">
                                            <input min="1" type="number" name="books[0][quantity]" value="1" placeholder="Quantity" class="form-control" required onkeyup="checkQuantity(this)">
                                            </div>
                                            <div class="col-2">
                                                <input  type="number" name="books[0][discount]" placeholder="Discount(%)" class="form-control" onkeyup="amount_with_discount(this)" >
                                            </div>
                                            <div class="col-2">
                                                <input  type="number" name="books[0][amount]" placeholder="Amount" class="form-control amount" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                        
                            <button type="button"  class="btn btn-primary mr-1" onclick="addBook()">Add Item</button>
                            <div class="row mt-3">
                                <div class="col-3">
                                </div>
                                <div class="col-2">
                                </div>
                                <div class="col-2">
                                   Overall Discount(%): 
                                </div>
                                <div class="col-2">
                                    Total Bill:
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-3">
                                </div>
                                <div class="col-2">
                                </div>
                                <div class="col-2">
                                    <input  type="number" name="total_discount" placeholder="Discount(%)" class="form-control"  id ="total_discount" onkeyup="totalBill()" >
                                </div>
                                <div class="col-2">
                                    <input  type="number" id="totalbill" name="total_bill" placeholder="Amount" class="form-control" readonly>
                                </div>
                            </div>
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
            <div class="col-3">
                <select class="form-control hide-search" name="books[${bookCount}][name]" required onchange="getSelectedValues(this)">
                        <option value="">Select Book</option>
                        @foreach ($books as $book)
                        <option @if ((isset($record)) && $book->id == old('books[${bookCount}][name]', $record->book_id))
                                selected
                            @elseif (old('books[${bookCount}][name]') == $book->id)
                                selected
                            @endif
                            value="{{ $book->id }}" data-quantity="{{$book->quantity}}" data-amount="{{$book}}"
                            >
                            {{ $book->urdu_name }}
                        </option>
                        @endforeach
                </select>
            </div>
            <div class="col-2">
            <input min="1" type="number" value="1" class="form-control" name="books[${bookCount}][quantity]" placeholder="Quantity" required onkeyup="checkQuantity(this)">
            </div>
            <div class="col-2">
                <input  type="number" name="books[${bookCount}][discount]"  placeholder="Discount(%)" class="form-control" onkeyup="amount_with_discount(this)">
            </div>
            <div class="col-2">
                <input type="number" name="books[${bookCount}][amount]" placeholder="Amount" class="form-control amount" readonly>
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
        const selectedOption = selectElement.options[selectElement.selectedIndex];
        const bookDiv = selectElement.closest('.book');
        const quantityInput = bookDiv.querySelector('input[name$="[quantity]"]');
        const amount = bookDiv.querySelector('input[name$="[amount]"]');
        const discount = bookDiv.querySelector('input[name$="[discount]"]');
        const book_data = JSON.parse(selectedOption.dataset.amount);
        let book_amount = parseInt(book_data.price);

        Array.from(selectElements).forEach((element) => {
            if (element !== selectElement) {
                selectedValues.push(element.value);
            }
        });

        if (selectedValues.includes(selectedOption.value)) {
            const swalOptions = {
                title: 'Already Selected',
                text: "You have already selected this item",
                icon: 'warning',
                showCancelButton: false,
                confirmButtonText: 'Ok',
                customClass: {
                    confirmButton: 'btn btn-primary',
                },
                buttonsStyling: false
            };

            Swal.fire(swalOptions);
            selectElement.value = "";
        }

        if (parseInt(book_data.quantity) < parseInt(quantityInput.value)) {
            quantityInput.value = "1";
        }
        amount_with_discount(selectElement)

        // if (quantityInput.value > 1) {
        //     book_amount *= parseInt(quantityInput.value);
        // }

        // if (discount.value && discount.value !== "0") {
        //     book_amount = book_amount  - ((book_amount * parseInt(discount.value)) / 100);
        // }

        // amount.value = book_amount; 
    }

    function checkQuantity(quantity) {
        const bookDiv = quantity.closest('.book');
        const book_option_data = bookDiv.querySelector('.hide-search');
        const amount = bookDiv.querySelector('input[name$="[amount]"]');
        const discount = bookDiv.querySelector('input[name$="[discount]"]');
        const selectedOption = book_option_data.options[book_option_data.selectedIndex];
        const dataAttribute = selectedOption.dataset.quantity;
        const book_data = JSON.parse(selectedOption.dataset.amount);
        let book_amount = parseInt(book_data.price);
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
            quantity.value=1;
        }
        amount_with_discount(quantity)
        // if(selectedOption != '')
        // {
        //     if (quantity.value > 1) {
        //         book_amount *= parseInt(quantity.value);
        //     }

        //     if (discount.value && discount.value !== "0") {
        //         book_amount = book_amount  - ((book_amount * parseInt(discount.value)) / 100);
        //     }
        //     amount.value = book_amount; 
        // }
        const quantityInput = bookDiv.querySelector('input[name$="[quantity]"]');
        
    }
    function amount_with_discount(element)
    {
        const bookDiv = element.closest('.book');
        const book_option_data = bookDiv.querySelector('.hide-search');
        const selectedOption = book_option_data.options[book_option_data.selectedIndex];
        const amount = bookDiv.querySelector('input[name$="[amount]"]');
        const discount = bookDiv.querySelector('input[name$="[discount]"]');
        const quantity = bookDiv.querySelector('input[name$="[quantity]"]');
        const book_data = JSON.parse(selectedOption.dataset.amount);;
        let book_amount = parseInt(book_data.price);
        if(selectedOption != '')
        {
            if (quantity.value > 1) {
                book_amount *= parseInt(quantity.value);
            }

            if (discount.value && discount.value !== "0") {
                book_amount = book_amount  - ((book_amount * parseInt(discount.value)) / 100);
            }
            amount.value = book_amount; 
            totalBill();
        }
    }
    function totalBill()
    {
        const amounts = document.getElementsByClassName('amount');
        const overallDiscount = document.getElementById('total_discount')
        var totalAmount = 0;
        for (let i = 0; i < amounts.length; i++) {
            const amountValue = parseFloat(amounts[i].value);
            
            if (!isNaN(amountValue)) {
                totalAmount += amountValue;
            }
        }
        if(overallDiscount.value != '' && overallDiscount.value != 0)
        {
            totalAmount = totalAmount - ((totalAmount * overallDiscount.value) /100)
        }
        $('#totalbill').val(totalAmount);
    }


</script>
@endsection
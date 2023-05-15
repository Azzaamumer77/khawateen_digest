<html>
<style>
    body {
        font-family: Arial, sans-serif;
    }
    h1 {
        text-align: center;
    }
    .invoice-details {
        margin-bottom: 20px;
    }
    .table {
        width: 100%;
        border-collapse: collapse;
    }
    .table th,
    .table td {
        border: 1px solid #000;
        padding: 5px;
    }
    .total-amount {
        text-align: right;
        font-weight: bold;
        margin-top: 20px;
    }
</style>

<body>
    <div class="card">
        <div class="card-body">
            <h2>Invoice</h2>
            <!-- Form -->
            <div class="invoice-details">
                <p><strong>Invoice Number:</strong> {{ $bill->invoice_no }}</p>
                <p><strong>Customer Name:</strong> {{ $bill->customer_name }}</p>
                <p><strong>Generation Date:</strong> {{ $bill->created_at }}</p>
            </div>
            <table class="table">
                <thead>
                    <tr>
                        <th>Book</th>
                        <th>Quantity</th>
                        <th>Price per Unit</th>
                        <th>Discount</th>
                        <th>Total Price</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($bill->books as $book)
                    <tr>
                        <td>{{ $book->urdu_name }}</td>
                        <td>{{$book->pivot->quantity }}</td>
                        <td>{{ $book->price }}</td>
                        <td>{{$book->pivot->discount}}%</td>
                        <td>{{($book->pivot->quantity * $book->price) - ((($book->pivot->quantity * $book->price) * $book->pivot->discount) /100) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="total-amount">
                <p><strong>Discount:</strong> {{ $bill->discount }}%</p>
                <p><strong>Total Amount:</strong> {{ $bill->total_amount }}</p>
            </div>                </div>
        </div>
    </div>
</body>
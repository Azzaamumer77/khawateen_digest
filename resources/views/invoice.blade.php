<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Publications Record</title>
</head>
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
            <h2>Publications Record</h2>
            <!-- Form -->
            <div class="invoice-details">
                <p><strong>Publication Name:</strong>{{$publication->name}}</p>
                
            </div>
            <table class="table">
                <thead>
                    <tr>
                        <th>Sr.No #</th>
                        <th>Debit</th>
                        <th>Credit</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($publication->publication_invoices as $invoice)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{  intval($invoice->debit) }}</td>
                            <td>{{ intval($invoice->credit) }}</td>
                            <td>{{ date(Config::get('date.date_format'), strtotime($invoice->date))}}</td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th></th>
                        <th>{{ $publication->publication_invoices->sum('debit') }}</th>
                        <th>{{ $publication->publication_invoices->sum('credit') }}</th>
                        <th></th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</body>
</html>

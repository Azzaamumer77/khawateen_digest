<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invoice</title>
</head>

<body>
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h1>
                    <h3>
                        {{$publications[0]->name}}
                    </h3>
                </h1>
                <div class="table-responsive-lg">
                    <table class="table table-striped table-hover table-responsive-lg">
                        <thead>
                            <tr>
                                <th>Sr.No #</th>
                                <th>Debit</th>
                                <th>Credit</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($publications as $publication)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{  intval($publication->debit) }}</td>
                                    <td>{{ intval($publication->credit) }}</td>
                                    <td>{{ date(Config::get('date.date_format'), strtotime($publication->date))}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th></th>
                                <th>{{ $totalDebit }}</th>
                                <th>{{ $totalCredit }}</th>
                                <th></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>

</body>
</html>

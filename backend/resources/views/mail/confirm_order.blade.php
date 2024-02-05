<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <table className='table table-bordered'>
        <thead>
            <tr>
                <th>Invoice Number</th>
                <th>Amount</th>
                <th>Name</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{$data['invoice_no']}}</td>
                <td>{{$data['amount']}}</td>
                <td>{{$data['name']}}</td>
                <td>{{$data['email']}}</td>
            </tr>
        </tbody>
    </table>
</body>
</html>

<!DOCTYPE html>
<html>
<head>
    <title>Client Report</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 0 auto;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
            box-sizing: border-box;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Client Report</h1>
    <table>
        <thead>
            <tr>
                <th>Client Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Address</th>
                <th>Total Spent</th>
                <th>Number of Orders</th>
                <th>Number of Reservations</th>
            </tr>
        </thead>
        <tbody>
            @foreach($clients as $client)
            <tr>
                <td>{{ $client['name'] }}</td>
                <td>{{ $client['email'] }}</td>
                <td>{{ $client['phone'] }}</td>
                <td>{{ $client['address'] }}</td>
                <td>${{ number_format($client['total_spent'], 2) }}</td>
                <td>{{ $client['num_orders'] }}</td>
                <td>{{ $client['num_reservations'] }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>

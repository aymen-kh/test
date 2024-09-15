<!DOCTYPE html>
<html>
<head>
    <title>Invoice</title>
    <style>
        /* Basic styling for the invoice */
        body {
            font-family: Arial, sans-serif;
            margin: 10px; /* Reduce margin for a more compact look */
            font-size: 12px; /* Reduce font size */
        }

        h1 {
            color: #333;
            font-size: 18px; /* Smaller header */
        }

        h2 {
            font-size: 16px; /* Smaller sub-header */
            margin-bottom: 5px; /* Reduce margin */
        }

        h3 {
            font-size: 14px; /* Smaller order number */
            margin-bottom: 5px; /* Reduce margin */
        }

        h5 {
            font-size: 12px; /* Smaller details */
            margin: 2px 0; /* Reduce margin */
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px; /* Reduce top margin */
        }

        table, th, td {
            border: 0px solid #ddd;
            padding: 5px; /* Reduce padding */
        }

        th {
            background-color: #f2f2f2;
        }

        td {
            text-align: left;
        }

        td:last-child {
            text-align: right;
        }

        .total {
            font-weight: bold;
        }
    </style>
</head>

<body>
    <h2><i>welcome to Roxi</i></h2>
    <h3>#{{ $order->id }}_{{$order->user_id}}</h3>
    <h5>Date: {{ $order->order_date }}</h5>
   
    @if ($order->delivery_address)
        <h5>Delivery Address: {{ $order->delivery_address }}</h5>
    @endif

    <h5>Payment Method: {{ $order->payment_method }}</h5>

    @if ($order->table_id)
        <h5>{{ $order->order_type }}</h5>
        <h5>Table: {{ $order->table_id }}</h5>
    @endif
    <hr>

    <!-- Order items table -->
    <table>
        <thead>
            <tr>
                <th>Quantity</th>
                <th>Item</th>
                <th>Price</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->items as $item)
            <tr>
                <td>{{ $item->pivot->quantity }}</td>
                <td>
                    {{ $item->name }}
                    @if($item->pivot->custom_description)
                        &nbsp;&nbsp;&nbsp;&nbsp;
                        <i><u>{{ $item->pivot->custom_description }}</u></i>
                    @endif
                </td>
                <td>${{ number_format($item->price, 2) }}</td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="2" class="total">Total</td>
                <td class="total">${{ number_format($order->total_amount, 2) }}</td>
            </tr>
        </tfoot>
    </table>
</body>
</html>

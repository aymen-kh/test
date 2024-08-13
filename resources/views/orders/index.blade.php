<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Document</title>
    <style>
        /* Container */
        .container {
            max-width: 1200px; /* Limit container width */
        }

        /* Table Styles */
        .table {
            width: 100%;
            margin: 0;
            border-collapse: collapse;
        }

        .table th, .table td {
            padding: 0.75rem;
            text-align: left;
            border-bottom: 1px solid #dee2e6;
        }

        .table thead th {
            background-color: #343a40;
            color: #ffffff;
        }

        .table tbody tr:hover {
            background-color: #f1f1f1;
        }

        .table-striped tbody tr:nth-of-type(odd) {
            background-color: #f9f9f9;
        }

        .table-bordered {
            border: 1px solid #dee2e6;
        }

        .table-bordered th, .table-bordered td {
            border: 1px solid #dee2e6;
        }

        /* Status Styles */
        .status-paid {
            color: #28a745; /* Green color */
            font-weight: bold;
        }
        .status-unpaid {
            color: #dc3545; /* Red color */
            font-weight: bold;
        }

        /* Heading Styles */
        h1 {
            font-size: 2rem;
            font-weight: 700;
            color: #333;
        }

        /* Responsive Table */
        .table-responsive {
            overflow-x: auto;
        }

        /* Empty State */
        p {
            font-size: 1.2rem;
            color: #666;
        }

        /* Button Styles */
        .btn-pay {
            background-color: #007bff;
            color: #fff;
            border: none;
            font-size: 0.875rem;
        }
        .btn-pay:hover {
            background-color: #0056b3;
        }
    </style>
    <style>
        /* Status Styles */
        .status-preparing {
            color: #ff9800; /* Orange color */
            font-weight: bold;
        }
        .status-in_delivery {
            color: #03a9f4; /* Blue color */
            font-weight: bold;
        }
        .status-completed {
            color: #4caf50; /* Green color */
            font-weight: bold;
        }
        .status-cancelled {
            color: #f44336; /* Red color */
            font-weight: bold;
        }
    </style>
    
</head>
<body>
    @include('layouts.nav')
    <div class="container mt-5">
        <h1 class="mb-4">My Orders</h1>

        @if($orders->isEmpty())
            <p>You have no orders yet.</p>
        @else
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th>Order ID</th>
                            <th>Order Date</th>
                            <th>Status</th>
                            <th>Total Amount</th>
                            <th>Order Type</th>
                            <th>Delivery Address</th>
                            <th>Payment Method</th>
                            <th>Details</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)
                            <tr>
                                <td>{{ $order->id }}</td>
                                <td>{{ $order->order_date }}</td>
                                <td>
                                    @if($order->status == 'unpaid')
                                        <button class="btn btn-pay btn-sm">Pay Now</button>
                                    @elseif($order->status == 'paid')
                                        <a href="{{ route('orders.index', $order->id) }}" class="btn btn-warning btn-sm">Mark as Preparing</a>
                                        <a href="{{ route('orders.index', $order->id) }}" class="btn btn-danger btn-sm">Cancel Order</a>
                                    @elseif($order->status == 'preparing')
                                        <a href="{{ route('orders.index', $order->id) }}" class="btn btn-primary btn-sm">Mark as In Delivery</a>
                                    @elseif($order->status == 'in_delivery')
                                        <span class="status-in_delivery">In Delivery</span>
                                    @elseif($order->status == 'completed')
                                        <span class="status-completed">Completed</span>
                                    @elseif($order->status == 'cancelled')
                                        <span class="status-cancelled">Cancelled</span>
                                    @endif
                                </td>
                                
                                <td>${{ number_format($order->total_amount, 2) }}</td>
                                <td>{{ $order->order_type }}</td>
                                <td>{{ $order->delivery_address }}</td>
                                <td>
                                    @if($order->status == 'unpaid')
                                       <button class="btn btn-pay btn-sm grey">
                                        Pay Now
                                    </button>
                                     
                                    @else
                                        {{ $order->payment_method }}
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('orders.show', $order->id) }}" class="btn btn-info btn-sm">View Details</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
    
    @include('layouts.reserve')

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

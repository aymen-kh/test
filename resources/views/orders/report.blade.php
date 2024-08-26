@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <h1>Orders Report</h1>

        <!-- Add your report content here -->
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Orders List</h5>
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Order ID</th>
                            <th>Customer</th>
                            <th>Status</th>
                            <th>Total</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $order->id }}</td>
                                <td>{{ $order->user_id }}</td>
                                <td>{{ $order->status }}</td>
                                <td>${{ $order->total }}</td>
                                <td>{{ $order->order_date}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

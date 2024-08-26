
@extends('layouts.form')
@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>Client Report</h2>
                <div>
                    <a href="{{ route('users.report') }}?export=pdf" class="btn btn-primary">Export to PDF</a>
                    <a href="{{ route('users.report') }}?export=excel" class="btn btn-success">Export to Excel</a>
               </div>
            </div>
            
            </div>
            <div class="table-responsive">
                <table class="table table-hover table-striped table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">Client Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Phone</th>
                            <th scope="col">Adress</th>
                            <th scope="col">Total Spent</th>
                            <th scope="col">Number of Orders</th>
                            <th scope="col">Number of Reservations</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($clients as $client)
                        <tr>
                            <td>{{ $client->name }}</td>
                            <td>{{ $client->email }}</td>
                            
                            <td>{{ $client->phone }}</td>
                            <td>{{ $client->address }}</td>
                            <td>${{ number_format($client->total_spent, 2) }}</td>
                            <td>{{ $client->num_orders }}</td>
                            <td>{{ $client->num_reservations }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection

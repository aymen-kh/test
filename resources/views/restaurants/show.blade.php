@extends('layouts.form')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center mb-4">
            <h1 class="h2">Restaurant Details</h1>
            <a href="{{ route('restaurants.edit', $restaurant->id) }}" class="btn btn-warning">Edit Restaurant</a>
        </div>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{ $restaurant->name }}</h5>
                <p class="card-text"><strong>Address:</strong> {{ $restaurant->address }}</p>
                <p class="card-text"><strong>Open Days:</strong> {{ $restaurant->open_days }}</p>
                <p class="card-text"><strong>Open Time:</strong> {{ $restaurant->open_time }}</p>
                <p class="card-text"><strong>Close Time:</strong> {{ $restaurant->close_time }}</p>
                <p class="card-text"><strong>Lunch Break:</strong> {{ $restaurant->lunch_break }}</p>
                <p class="card-text"><strong>Special Closing:</strong> {{ $restaurant->special_closing }}</p>
                <p class="card-text"><strong>Closing Date:</strong> {{ $restaurant->closing_date }}</p>
                <p class="card-text"><strong>Closing Message:</strong> {{ $restaurant->closing_message }}</p>
                <p class="card-text"><strong>Last Order Time:</strong> {{ $restaurant->last_order_time }}</p>
                <p class="card-text"><strong>Capacity:</strong> {{ $restaurant->capacity }}</p>
                <p class="card-text"><strong>Email:</strong> {{ $restaurant->email }}</p>
                <p class="card-text"><strong>Phone:</strong> {{ $restaurant->phone }}</p>
                <p class="card-text"><strong>Description:</strong> {{ $restaurant->description }}</p>
            </div>
        </div>

        <a href="{{ route('restaurants.index') }}" class="btn btn-secondary mt-3">Back to List</a>
    </div>
@endsection

@extends('layouts.form')

@section('content')
    <div class="container mx-auto mt-8">
        <div class="bg-white shadow-md rounded-lg p-6">
            <h2 class="text-2xl font-semibold mb-6">Reservation Details</h2>

            <div class="mb-4">
                <h3 class="text-lg font-semibold text-gray-700">Client</h3>
                <p class="text-gray-900">{{ $reservation->user->name }}</p>
            </div>

            <div class="mb-4">
                <h3 class="text-lg font-semibold text-gray-700">Table</h3>
                <p class="text-gray-900">Table {{ $reservation->table->number }}</p>
            </div>

    
            <div class="mb-4">
                <h3 class="text-lg font-semibold text-gray-700">End Time</h3>
                <p class="text-gray-900">{{ $reservation->end_time }}</p>
            </div>

            <div class="mb-4">
                <h3 class="text-lg font-semibold text-gray-700">Event Date</h3>
                <p class="text-gray-900">{{ $reservation->event_date }}</p>
            </div>

            <div class="mb-4">
                <h3 class="text-lg font-semibold text-gray-700">Number of Guests</h3>
                <p class="text-gray-900">{{ $reservation->number_of_guests }}</p>
            </div>

            <div class="mb-4">
                <h3 class="text-lg font-semibold text-gray-700">Event Type</h3>
                <p class="text-gray-900">{{ $reservation->event_type }}</p>
            </div>

            <div class="mb-4">
                <h3 class="text-lg font-semibold text-gray-700">Reservation Type</h3>
                <p class="text-gray-900">{{ $reservation->reservation_type }}</p>
            </div>

            <div class="mb-4">
                <h3 class="text-lg font-semibold text-gray-700">Hourly Rate</h3>
                <p class="text-gray-900">${{ $reservation->hourly_rate }}</p>
            </div>

            <div class="mb-4">
                <h3 class="text-lg font-semibold text-gray-700">Status</h3>
                <p class="text-gray-900">{{ $reservation->status ?? 'Pending' }}</p>
            </div>

            <div class="mt-6">
                <a href="{{ route('reservations.edit', $reservation->id) }}" class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">Edit</a>
                <form action="{{ route('reservations.destroy', $reservation->id) }}" method="POST" class="inline-block">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Are you sure you want to delete this reservation?');">Delete</button>
                </form>
                <button><a href="{{ route('reservations.index') }}" >Back to List</a></button>
            </div>
        </div>
    </div>
@endsection

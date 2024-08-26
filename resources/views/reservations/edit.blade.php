@extends('layouts.form')

@section('content')
    <div class="container mx-auto mt-8">
        <div class="bg-white shadow-md rounded-lg p-6">
            <h2 class="text-2xl font-semibold mb-6">Edit Reservation</h2>

            <!-- Check if there are any validation errors -->
            @if ($errors->any())
                <div class="alert alert-danger mb-4">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Form to edit the reservation -->
            <form action="{{ route('reservations.update', $reservation->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="user_id" class="block text-sm font-medium text-gray-700">Client</label>
                    <select id="user_id" name="user_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                  
                            <option value="{{ $reservation->user_id }}" {{ $reservation->user_id}}>
                                {{ $reservation->user->name }}

                 
                    </select>
                </div>
                <div class="mb-4">
                    <label for="table_id" class="block text-sm font-medium text-gray-700">Table</label>
                    <select id="table_id" name="table_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        @foreach($tables as $table)
                            <option value="{{ $table->id }}" {{ $reservation->table_id == $table->id ? 'selected' : '' }}>
                                Table {{ $table->number }}
                            </option>
                        @endforeach
                    </select>
                </div>

             
                <div class="mb-4">
                    <label for="end_time" class="block text-sm font-medium text-gray-700">End Time</label>
                    <input type="datetime-local" id="end_time" name="end_time" value="{{ old('end_time', $reservation->end_time) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
                </div>

                <div class="mb-4">
                    <label for="event_date" class="block text-sm font-medium text-gray-700">Event Date</label>
                    <input type="date" id="event_date" name="event_date" value="{{ old('event_date', $reservation->event_date) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
                </div>

                <div class="mb-4">
                    <label for="number_of_guests" class="block text-sm font-medium text-gray-700">Number of Guests</label>
                    <input type="number" id="number_of_guests" name="number_of_guests" value="{{ old('number_of_guests', $reservation->number_of_guests) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
                </div>

                <div class="mb-4">
                    <label for="event_type" class="block text-sm font-medium text-gray-700">Event Type</label>
                    <input type="text" id="event_type" name="event_type" value="{{ old('event_type', $reservation->event_type) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
                </div>

          
                <div class="mb-4">
                    <label for="hourly_rate" class="block text-sm font-medium text-gray-700">Hourly Rate</label>
                    <input type="number" id="hourly_rate" name="hourly_rate" value="{{ old('hourly_rate', $reservation->hourly_rate) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
                </div>

                <div class="mb-4">
                    <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                    <select id="status" name="status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        <option value="Pending" {{ $reservation->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                        <option value="Confirmed" {{ $reservation->status == 'Confirmed' ? 'selected' : '' }}>Confirmed</option>
                        <option value="Cancelled" {{ $reservation->status == 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                </div>

                <div class="flex items-center justify-end mt-4">
                    <button type="submit" class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">
                        Update Reservation
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

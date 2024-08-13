<!-- resources/views/reservations/index.blade.php -->

<div class="container">
    <h1>Reservations</h1>
    @if(session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    <a href="{{ route('reservations.create') }}" class="btn btn-primary mb-3">Create New Reservation</a>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Client</th>
                <th>Table</th>
                <th>Start Time</th>
                <th>End Time</th>
                <th>Event Date</th>
                <th>Guests</th>
                <th>Event Type</th>
                <th>Reservation Type</th>
                <th>Hourly Rate</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($reservations as $reservation)
                <tr>
                    <td>{{ $reservation->id }}</td>
                    <td>{{ $reservation->user->name }}</td>
                    <td>{{ $reservation->table->number }}</td>
                    <td>{{ $reservation->start_time }}</td>
                    <td>{{ $reservation->end_time }}</td>
                    <td>{{ $reservation->event_date }}</td>
                    <td>{{ $reservation->number_of_guests }}</td>
                    <td>{{ $reservation->event_type }}</td>
                    <td>{{ $reservation->reservation_type }}</td>
                    <td>${{ $reservation->hourly_rate }}</td>
                    <td>{{ $reservation->status ?? 'Pending' }}</td>
                    <td>
                        <a href="{{ route('reservations.show', $reservation->id) }}" class="btn btn-info btn-sm">Details</a>
                        <a href="{{ route('reservations.edit', $reservation->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <a href="{{ route('reservations.confirm', $reservation->id) }}" class="btn btn-success btn-sm">Confirm</a>
                        <a href="{{ route('reservations.cancel', $reservation->id) }}" class="btn btn-danger btn-sm">Cancel</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

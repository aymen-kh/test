
<div class="container">
    <h1 class="my-4">Create a Reservation</h1>

    <form action="{{ route('reservations.store') }}" method="POST" class="bg-light p-4 rounded shadow-sm">
        @csrf

        <!-- Event Date Picker -->
        <div class="form-group mb-3">
            <label for="event_date" class="form-label">Event Date</label>
            <input type="date" name="event_date" id="event_date" class="form-control @error('event_date') is-invalid @enderror" required>
            @error('event_date')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Number of Guests -->
        <div class="form-group mb-3">
            <label for="number_of_guests" class="form-label">Number of Guests</label>
            <input type="number" name="number_of_guests" id="number_of_guests" class="form-control @error('number_of_guests') is-invalid @enderror" required>
            @error('number_of_guests')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Event Type -->
        <div class="form-group mb-3">
            <label for="event_type" class="form-label">Event Type</label>
            <select name="event_type" id="event_type" class="form-select @error('event_type') is-invalid @enderror" required>
                <option value="" disabled selected>Select an event type</option>
                <option value="Birthday">Birthday</option>
                <option value="Corporate">Corporate</option>
                <option value="Wedding">Wedding</option>
                <option value="Anniversary">Anniversary</option>
                <option value="Other">Other</option>
            </select>
            @error('event_type')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Additional Information -->
        <div class="form-group mb-3">
            <label for="additional_information" class="form-label">Additional Information</label>
            <textarea name="additional_information" id="additional_information" class="form-control @error('additional_information') is-invalid @enderror" rows="4"></textarea>
            @error('additional_information')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Table Selection -->
        <div class="form-group mb-3">
            <label for="table_id" class="form-label">Available Tables</label>
            <select name="table_id" id="table_id" class="form-select @error('table_id') is-invalid @enderror" required>
                <option value="" disabled selected>Select a table</option>
                <!-- Options will be populated dynamically via JavaScript based on availability -->
            </select>
            @error('table_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Hidden Input for End Time -->
        <input type="hidden" name="end_time" id="end_time">

        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary btn-lg">Create Reservation</button>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const eventDateInput = document.getElementById('event_date');
        const endTimeInput = document.getElementById('end_time');
        const tableSelect = document.getElementById('table_id');

        // Function to calculate end time
        function calculateEndTime() {
            if (eventDateInput.value) {
                const eventDate = new Date(eventDateInput.value);
                const endTime = new Date(eventDate.getTime() + 2 * 60 * 60 * 1000); // 2 hours later
                endTimeInput.value = endTime.toISOString().slice(0, 16); // Format as YYYY-MM-DDTHH:MM
            }
        }

        // Update end time when event date changes
        eventDateInput.addEventListener('change', calculateEndTime);

        // Fetch available tables based on selected date
        async function fetchAvailableTables() {
            const eventDate = eventDateInput.value;
            if (eventDate) {
                const response = await fetch(`/api/available-tables?event_date=${eventDate}`);
                const tables = await response.json();
                tableSelect.innerHTML = '<option value="" disabled selected>Select a table</option>';
                tables.forEach(table => {
                    const option = document.createElement('option');
                    option.value = table.id;
                    option.textContent = `${table.number} (${table.capacity} seats)`;
                    tableSelect.appendChild(option);
                });
            }
        }

        eventDateInput.addEventListener('change', fetchAvailableTables);
    });
</script>


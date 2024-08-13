<div id="reservationModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Reservation Form</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="reservationForm" method="GET" action="{{route('reservations.create2')}}">
                    @csrf
                    <div class="form-group">
                        <label for="numPeople">Number of People</label>
                        <select id="numPeople" name="numPeople" class="form-control" required>
                            <option value="1">1 person</option>
                            <option value="2">2 people</option>
                            <option value="3">3 people</option>
                            <option value="4">4 people</option>
                            <option value="5">5 people</option>
                            <option value="6">6 people</option>
                            <option value="7">7 people</option>
                            <option value="8">8 people</option>
                            <option value="8+">8+ people</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="date">Date</label>
                        <input type="date" id="date" name="date" class="form-control" min="" required>
                    </div>
                    <div class="form-group">
                        <label for="time">Time (optional)</label>
                        <select id="time" name="time" class="form-control">
                            <option value="11:00:00">11:00 AM</option>
                            <option value="11:30:00">11:30 AM</option>
                            <option value="12:00:00">12:00 PM</option>
                            <option value="12:30:00">12:30 PM</option>
                            <option value="13:00:00">1:00 PM</option>
                            <option value="13:30:00">1:30 PM</option>
                            <option value="14:00:00">2:00 PM</option>
                            <option value="14:30:00">2:30 PM</option>
                            <option value="15:00:00">3:00 PM</option>
                            <option value="15:30:00">3:30 PM</option>
                            <option value="16:00:00">4:00 PM</option>
                            <option value="16:30:00">4:30 PM</option>
                            <option value="17:00:00">5:00 PM</option>
                            <option value="17:30:00">5:30 PM</option>
                            <option value="18:00:00">6:00 PM</option>
                            <option value="18:30:00">6:30 PM</option>
                            <option value="19:00:00">7:00 PM</option>
                            <option value="19:30:00">7:30 PM</option>
                            <option value="20:00:00">8:00 PM</option>
                            <option value="20:30:00">8:30 PM</option>
                            <option value="21:00:00">9:00 PM</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="eventType">Event Type (optional)</label>
                        <select id="eventType" name="eventType" class="form-control">
                            <option value="Standard">Select event type</option>
                            <option value="Meeting">Meeting</option>
                            <option value="Birthday">Birthday</option>
                            <option value="Conference">Conference</option>
                            <option value="Workshop">Workshop</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" form="reservationForm">Find a Table</button>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const today = new Date().toISOString().split('T')[0];
        document.getElementById('date').setAttribute('min', today);
    });
</script>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reservation</title>
    <style>
        .hidden {
            display: none;
        }

        /* Additional styles for the confirmation form */
        #confirmationForm {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #dee2e6;
            border-radius: 8px;
            background-color: #f8f9fa;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        #confirmationForm h2 {
            margin-bottom: 20px;
        }

        #confirmationForm .form-group {
            margin-bottom: 15px;
        }

        #confirmationForm label {
            font-weight: bold;
        }

        #confirmationForm .form-control {
            border-radius: 4px;
        }

        #confirmationForm .btn {
            margin-top: 20px;
            padding: 10px 20px;
        }

        /* Fee notice paragraph */
        .fee-notice {
            max-width: 600px;
            margin: 20px auto;
            padding: 15px;
            background-color: #ffeeba;
            border: 1px solid #ffc107;
            border-radius: 8px;
            color: #856404;
        }

        .fee-notice p {
            margin-bottom: 0;
        }
    </style>
</head>

<body>
    @include('layouts.nav')
   
    <header class="bg-primary text-white text-center py-5">
        <div class="container">
            <h1 class="display-4">Reservation</h1>
        </div>
    </header>

    <section class="py-5">
        <div class="container">
            <input type="hidden" id="isLoggedIn" value="{{ Auth::check() ? 'true' : 'false' }}">

            <div id="step1">
                <h2 class="text-center">Available Tables</h2>
                <!-- Display available tables -->
                @if($tables->isEmpty())
                    <p class="text-center">No tables are available for the selected date and time.</p>
                @else
                    <form id="selectTableForm">
                        @csrf
                        <input type="hidden" name="date" value="{{ $date }}">
                        <input type="hidden" name="time" value="{{ $time }}">
                        <input type="hidden" name="number_of_guests" value="{{ $number_of_guests }}">

                        <div class="text-center">
                            @foreach ($tables as $table)
                                <button type="button" class="btn btn-primary mx-2 my-2" onclick="selectTable({{ $table->id }}, '{{ $table->number }}', {{ $table->capacity }})">
                                     {{ $table->area->name }}   --Table {{ $table->number }} (Capacity: {{ $table->capacity }})
                                </button>
                            @endforeach
                        </div>
                    </form>
                @endif
            </div>

            <div id="step2" class="hidden">
                <div class="row">
                    <div class="col-md-8">
                        <h2 class="text-center">Confirm Your Reservation</h2>
                        <form id="confirmationForm" method="POST" action="{{ route('reservations.store') }}">
                            @csrf
                            <a class="nav-link signin-link" id="signinLink" href="{{ route('login') }}">Sign In</a>
                            <div class="form-group">
                                <label for="confirmationDate">Date:</label>
                                <input type="date" name="event_date" id="confirmationDate" readonly class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="confirmationTime">Time:</label>
                                <input type="text" name="time" id="confirmationTime" readonly class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="event">Event Type:</label>
                                <input type="text" name="event_type" value="{{ $event }}" id="event" readonly class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="confirmationGuests">Number of Guests:</label>
                                <input type="number" name="number_of_guests" readonly id="confirmationGuests" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="additional_information">Additional Information:</label>
                                <textarea name="additional_information" id="additional_information" class="form-control"></textarea>
                            </div>
                            <input type="hidden" name="table_id" id="confirmationTableId">
                            @auth
                            <div class="form-group">
                                <label for="name">Name:</label>
                                <input type="text" name="name" id="name" value="{{ $user->name }}" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="phone">Phone Number:</label>
                                <input type="tel" name="phone" id="phone" value="{{ $user->phone }}" class="form-control">
                            </div>
                            @endauth
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Confirm Reservation</button>
                                <button type="button" class="btn btn-secondary" onclick="goBack()">Back</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-4">
                        <div class="fee-notice">
                            <p><strong>Important:</strong>  A cancellation charge may apply if you fail to attend your reservation without providing prior notice. To avoid any charges, please ensure that you arrive on time or cancel your reservation in advance.

                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    @include('layouts.reserve')

    <footer class="bg-light text-center py-4">
        <div class="container">
            <p class="mb-0">&copy; 2024 Restaurant. All rights reserved.</p>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        function selectTable(tableId, tableNumber, tableCapacity) {
            var isLoggedIn = document.getElementById('isLoggedIn').value === 'true';
            
            if (!isLoggedIn) {
                window.location.href = '{{ route('login') }}'; // Redirect to login page
                return;
            }
            
            document.getElementById('confirmationDate').value = document.querySelector('input[name="date"]').value;
            document.getElementById('confirmationTime').value = document.querySelector('input[name="time"]').value;
            document.getElementById('confirmationGuests').value = tableCapacity; // Use tableCapacity here
            document.getElementById('confirmationTableId').value = tableId;

            // Hide step 1 and show step 2
            document.getElementById('step1').classList.add('hidden');
            document.getElementById('step2').classList.remove('hidden');
        }

        function goBack() {
            // Show step 1 and hide step 2
            document.getElementById('step1').classList.remove('hidden');
            document.getElementById('step2').classList.add('hidden');
        }
    </script>
</body>
</html>

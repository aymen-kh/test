<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Surname -->
        <div>
            <x-input-label for="surname" :value="__('Surname')" />
            <x-text-input id="surname" class="block mt-1 w-full" type="text" name="surname" :value="old('surname')" required autofocus autocomplete="surname" />
            <x-input-error :messages="$errors->get('surname')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Phone Number -->
        <div class="mt-4">
            <x-input-label for="phone" :value="__('Phone Number')" />
            <x-text-input 
                id="phone" 
                class="block mt-1 w-full" 
                type="tel" 
                name="phone" 
                :value="old('phone')" 
                required 
                autocomplete="tel" 
                pattern="[0-9]{8}" 
                inputmode="numeric" 
                title="Please enter exactly 8 digits" 
                maxlength="8"
                oninput="this.value = this.value.replace(/[^0-9]/g, '')"
            />
            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
        </div>

        <!-- Location Picker -->
        <div class="mt-4">
            <x-input-label for="location" :value="__('Select Location')" />
            <div id="map" style="height: 300px;" class="mt-2 mb-2"></div>

            <!-- Hidden fields to store the selected coordinates -->
            <x-text-input id="latitude" class="block mt-1 w-full" type="hidden" name="latitude" :value="old('latitude')" required />
            <x-text-input id="longitude" class="block mt-1 w-full" type="hidden" name="longitude" :value="old('longitude')" required />
            <x-text-input id="address" class="block mt-1 w-full" type="hidden" name="address" :value="old('address')" required />

            <x-input-error :messages="$errors->get('latitude')" class="mt-2" />
            <x-input-error :messages="$errors->get('longitude')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" oninput="sanitizePassword(this)" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" oninput="sanitizePassword(this)" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>
            
            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>

    <!-- Leaflet.js and Map Integration -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Initialize the map with a default location
            const defaultLat = parseFloat(document.getElementById('latitude').value) || 33.505;
            const defaultLng = parseFloat(document.getElementById('longitude').value) || 9.09;

            var map = L.map('map').setView([defaultLat, defaultLng], 10);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);

            var marker = L.marker([defaultLat, defaultLng], {
                draggable: true
            }).addTo(map);

            function updateLatLngFields(lat, lng) {
                document.getElementById('latitude').value = lat;
                document.getElementById('longitude').value = lng;
                fetchAddress(lat, lng);
            }

            function fetchAddress(lat, lng) {
                const url = `https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat=${lat}&lon=${lng}`;
                fetch(url)
                    .then(response => response.json())
                    .then(data => {
                        document.getElementById('address').value = data.display_name;
                    })
                    .catch(error => console.error('Error fetching address:', error));
            }

            updateLatLngFields(defaultLat, defaultLng);

            marker.on('dragend', function (e) {
                var position = marker.getLatLng();
                updateLatLngFields(position.lat, position.lng);
            });

            map.on('click', function (e) {
                marker.setLatLng(e.latlng);
                updateLatLngFields(e.latlng.lat, e.latlng.lng);
            });
            
        });
        function sanitizePassword(input) {
            // Regular expression to disallow <, >, &, ", '
            const forbiddenChars = /[<>\&"\'\/]/;
            if (forbiddenChars.test(input.value)) {
                alert('The password contains invalid characters.');
                input.value = input.value.replace(forbiddenChars, '');
            }
        }
    </script>
</x-guest-layout>

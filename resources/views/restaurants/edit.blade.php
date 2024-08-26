@extends('layouts.form')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center mb-4">
            <h1 class="h2">Edit Restaurant</h1>
        </div>

        <form action="{{ route('restaurants.update', $restaurant->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $restaurant->name) }}" required>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="address" class="form-label">Address</label>
                <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address" value="{{ old('address', $restaurant->address) }}" required>
                @error('address')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="is_open" class="form-label">Is Open</label>
                <select class="form-select @error('is_open') is-invalid @enderror" id="is_open" name="is_open" required>
                    <option value="1" {{ old('is_open', $restaurant->is_open) ? 'selected' : '' }}>Yes</option>
                    <option value="0" {{ !old('is_open', $restaurant->is_open) ? 'selected' : '' }}>No</option>
                </select>
                @error('is_open')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="open_days" class="form-label">Open Days</label>
                <input type="text" class="form-control @error('open_days') is-invalid @enderror" id="open_days" name="open_days" value="{{ old('open_days', $restaurant->open_days) }}" required>
                @error('open_days')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="open_time" class="form-label">Open Time</label>
                <input type="time" class="form-control @error('open_time') is-invalid @enderror" id="open_time" name="open_time" value="{{ old('open_time', $restaurant->open_time) }}" required>
                @error('open_time')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="close_time" class="form-label">Close Time</label>
                <input type="time" class="form-control @error('close_time') is-invalid @enderror" id="close_time" name="close_time" value="{{ old('close_time', $restaurant->close_time) }}" required>
                @error('close_time')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="lunch_break" class="form-label">Lunch Break</label>
                <input type="time" class="form-control @error('lunch_break') is-invalid @enderror" id="lunch_break" name="lunch_break" value="{{ old('lunch_break', $restaurant->lunch_break) }}">
                @error('lunch_break')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="special_closing" class="form-label">Special Closing</label>
                <input type="text" class="form-control @error('special_closing') is-invalid @enderror" id="special_closing" name="special_closing" value="{{ old('special_closing', $restaurant->special_closing) }}">
                @error('special_closing')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="closing_date" class="form-label">Closing Date</label>
                <input type="date" class="form-control @error('closing_date') is-invalid @enderror" id="closing_date" name="closing_date" value="{{ old('closing_date', $restaurant->closing_date) }}">
                @error('closing_date')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="closing_message" class="form-label">Closing Message</label>
                <input type="text" class="form-control @error('closing_message') is-invalid @enderror" id="closing_message" name="closing_message" value="{{ old('closing_message', $restaurant->closing_message) }}">
                @error('closing_message')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="last_order_time" class="form-label">Last Order Time</label>
                <input type="time" class="form-control @error('last_order_time') is-invalid @enderror" id="last_order_time" name="last_order_time" value="{{ old('last_order_time', $restaurant->last_order_time) }}">
                @error('last_order_time')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="capacity" class="form-label">Capacity</label>
                <input type="number" class="form-control @error('capacity') is-invalid @enderror" id="capacity" name="capacity" value="{{ old('capacity', $restaurant->capacity) }}" required>
                @error('capacity')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $restaurant->email) }}">
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="phone" class="form-label">Phone</label>
                <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone', $restaurant->phone) }}">
                @error('phone')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description">{{ old('description', $restaurant->description) }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Update Restaurant</button>
        </form>
    </div>
@endsection

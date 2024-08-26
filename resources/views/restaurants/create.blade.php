@extends('layouts.form')
@section('title', 'Add New Restaurant')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center mb-4">
            <h1 class="h2">Add New Restaurant</h1>
        </div>

        <form action="{{ route('restaurants.store') }}" method="POST">
            @csrf

            <!-- Name -->
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Address -->
            <div class="mb-3">
                <label for="address" class="form-label">Address</label>
                <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address" value="{{ old('address') }}" required>
                @error('address')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Is Open -->
            <div class="mb-3">
                <label for="is_open" class="form-label">Is Open</label>
                <select class="form-select @error('is_open') is-invalid @enderror" id="is_open" name="is_open" required>
                    <option value="1" {{ old('is_open') == '1' ? 'selected' : '' }}>Yes</option>
                    <option value="0" {{ old('is_open') == '0' ? 'selected' : '' }}>No</option>
                </select>
                @error('is_open')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Open Days -->
            <div class="mb-3">
                <label for="open_days" class="form-label">Open Days</label>
                <input type="text" class="form-control @error('open_days') is-invalid @enderror" id="open_days" name="open_days" value="{{ old('open_days') }}" required>
                @error('open_days')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Open Time -->
            <div class="mb-3">
                <label for="open_time" class="form-label">Open Time</label>
                <input type="time" class="form-control @error('open_time') is-invalid @enderror" id="open_time" name="open_time" value="{{ old('open_time') }}" required>
                @error('open_time')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Close Time -->
            <div class="mb-3">
                <label for="close_time" class="form-label">Close Time</label>
                <input type="time" class="form-control @error('close_time') is-invalid @enderror" id="close_time" name="close_time" value="{{ old('close_time') }}" required>
                @error('close_time')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Lunch Break -->
            <div class="mb-3">
                <label for="lunch_break" class="form-label">Lunch Break</label>
                <select class="form-select @error('lunch_break') is-invalid @enderror" id="lunch_break" name="lunch_break">
                    <option value="1" {{ old('lunch_break') == '1' ? 'selected' : '' }}>Yes</option>
                    <option value="0" {{ old('lunch_break') == '0' ? 'selected' : '' }}>No</option>
                </select>
                @error('lunch_break')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Special Closing -->
            <div class="mb-3">
                <label for="special_closing" class="form-label">Special Closing</label>
                <select class="form-select @error('special_closing') is-invalid @enderror" id="special_closing" name="special_closing">
                    <option value="1" {{ old('special_closing') == '1' ? 'selected' : '' }}>Yes</option>
                    <option value="0" {{ old('special_closing') == '0' ? 'selected' : '' }}>No</option>
                </select>
                @error('special_closing')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Closing Date -->
            <div class="mb-3">
                <label for="closing_date" class="form-label">Closing Date</label>
                <input type="date" class="form-control @error('closing_date') is-invalid @enderror" id="closing_date" name="closing_date" value="{{ old('closing_date') }}">
                @error('closing_date')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Closing Message -->
            <div class="mb-3">
                <label for="closing_message" class="form-label">Closing Message</label>
                <input type="text" class="form-control @error('closing_message') is-invalid @enderror" id="closing_message" name="closing_message" value="{{ old('closing_message') }}">
                @error('closing_message')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Last Order Time -->
            <div class="mb-3">
                <label for="last_order_time" class="form-label">Last Order Time</label>
                <input type="time" class="form-control @error('last_order_time') is-invalid @enderror" id="last_order_time" name="last_order_time" value="{{ old('last_order_time') }}">
                @error('last_order_time')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Capacity -->
            <div class="mb-3">
                <label for="capacity" class="form-label">Capacity</label>
                <input type="number" class="form-control @error('capacity') is-invalid @enderror" id="capacity" name="capacity" value="{{ old('capacity') }}" required>
                @error('capacity')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Email -->
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}">
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Phone -->
            <div class="mb-3">
                <label for="phone" class="form-label">Phone</label>
                <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone') }}">
                @error('phone')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Description -->
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description">{{ old('description') }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Create Restaurant</button>
        </form>

        <a href="{{ route('restaurants.index') }}" class="btn btn-secondary mt-3">Back to List</a>
    </div>
@endsection

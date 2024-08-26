@extends('layouts.form')
@section('content')
<div class="container">
    <form method="POST" action="{{ route('menus.store') }}" enctype="multipart/form-data">
        @csrf

        <!-- Name Field -->
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
        </div>

        <!-- Price Field -->
        <div class="form-group">
            <label for="price">Price</label>
            <input type="number" name="price" id="price" class="form-control" value="{{ old('price') }}" required>
        </div>

        <!-- Availability Field -->
        <div class="form-group">
            <label for="availability">Availability</label>
            <select name="availability" id="availability" class="form-control">
                <option value="1" {{ old('availability') == 1 ? 'selected' : '' }}>Available</option>
                <option value="0" {{ old('availability') == 0 ? 'selected' : '' }}>Not Available</option>
            </select>
        </div>

        <!-- Description Field -->
        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" class="form-control">{{ old('description') }}</textarea>
        </div>

        <!-- Image Field -->
        <div class="form-group">
            <label for="image">Image</label>
            <input type="file" name="image" id="image" class="form-control">
        </div>

        <!-- Items Field -->
        <div class="form-group">
            <label for="items">Items</label>
            <select name="items[]" id="items" class="form-control" multiple>
                @foreach($items as $item)
                    <option value="{{ $item->id }}" 
                        {{ in_array($item->id, old('items', [])) ? 'selected' : '' }}>
                        {{ $item->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Create</button>
    </form>
</div>
@endsection

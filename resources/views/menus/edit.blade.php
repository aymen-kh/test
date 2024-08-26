@extends('layouts.form')
@section('content')
<div class="container">
    <form method="POST" action="{{ route('menus.update', $menu->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Name Field -->
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $menu->name) }}" required>
        </div>

        <!-- Price Field -->
        <div class="form-group">
            <label for="price">Price</label>
            <input type="number" name="price" id="price" class="form-control" value="{{ old('price', $menu->price) }}" required>
        </div>

        <!-- Availability Field -->
        <div class="form-group">
            <label for="availability">Availability</label>
            <select name="availability" id="availability" class="form-control">
                <option value="1" {{ $menu->availability ? 'selected' : '' }}>Available</option>
                <option value="0" {{ !$menu->availability ? 'selected' : '' }}>Not Available</option>
            </select>
        </div>

        <!-- Description Field -->
        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" class="form-control">{{ old('description', $menu->description) }}</textarea>
        </div>

        <!-- Image Field -->
        <div class="form-group">
            <label for="image">Image</label>
            <input type="file" name="image" id="image" class="form-control">
            @if ($menu->image)
                <img src="{{ asset('storage/' . $menu->image) }}" alt="Menu Image" style="width: 100px; height: auto;">
            @endif
        </div>

        <!-- Rating Field 
        <div class="form-group">
            <label for="rating">Rating</label>
            <input type="number" name="rating" id="rating" class="form-control" value="{{ old('rating', $menu->rating) }}" min="0" max="10" step="0.1">
        </div>
-->
        <!-- Items Field -->
        <div class="form-group">
            <label for="items">Items</label>
            <select name="items[]" id="items" class="form-control" multiple>
                @foreach($items as $item)
                    <option value="{{ $item->id }}" 
                        {{ in_array($item->id, $menu->items->pluck('id')->toArray()) ? 'selected' : '' }}>
                        {{ $item->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
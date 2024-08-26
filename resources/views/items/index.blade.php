@extends('layouts.form')
@include('layouts.nav')
@section('content')
<div class="container mx-auto mt-8">
    <div class="bg-white shadow-md rounded-lg p-6">
        <h2 class="text-2xl font-semibold mb-6">Items List</h2>

        <!-- Display a success message if the item was successfully created/updated/deleted -->
        @if(session('success'))
            <div class="alert alert-success mb-4">
                {{ session('success') }}
            </div>
        @endif

        <!-- Button to create a new item -->
       @can('item_delete') <a href="{{ route('items.create') }}">Create New Item</a>@endcan

        <!-- Table to display items grouped by category -->
        <table class="table-auto w-full bg-white">
            <thead>
                <tr class="text-left">
                    <th class="px-4 py-2 border">Item Name</th>
                    <th class="px-4 py-2 border">Item Image</th>
                    <th class="px-4 py-2 border">Cooking Time</th>
                    <th class="px-4 py-2 border">Availability</th>
                    <th class="px-4 py-2 border">Price</th>
                    <th class="px-4 py-2 border">Description</th>
                    <th class="px-4 py-2 border">Category</th>
                    <th class="px-4 py-2 border">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categories as $category)
                    <tr class="bg-gray-100">
                        <td colspan="6" class="px-4 py-2 font-bold">{{ $category->name }}</td>
                    </tr>
                    @foreach($category->items as $item)
                        <tr>
                            <td class="px-4 py-2 border">{{ $item->name }}</td>
                            <td>
                                <img class="px-4 py-2 border" src="{{ asset('images/' . $item->image) }}" style=" width:190px;height:auto" alt="Item Image">
                            </td>
                                                        <td class="px-4 py-2 border">{{ $item->cookingTime }} mins</td>
                            <td class="px-4 py-2 border">{{ $item->availability }}</td>
                            <td class="px-4 py-2 border">${{ $item->price }}</td>
                            <td class="px-4 py-2 border">{{ $item->description }}</td>
                            
                            <td class="px-4 py-2 border">{{ $category->name }}</td>
                            
                            <td class="px-4 py-2 border">
                                <a href="{{ route('items.show', $item->id) }}" >View</a>
                             
                                <a href="{{ route('items.edit', $item->id) }}">Edit</a>
                                @can('item_delete')   <form action="{{ route('items.destroy', $item->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this item?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="">Delete</button>
                                </form>
                                @endcan
                            </td>
                        </tr>
                    @endforeach
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

@endsection

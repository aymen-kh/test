@extends('layouts.form')

@section('content')
    <div class="container mx-auto mt-8">
        <div class="bg-white shadow-md rounded-lg p-6">
            <h2 class="text-2xl font-semibold mb-6">Edit Category</h2>

            <!-- Check if there are any validation errors -->
            @if ($errors->any())
                <div class="alert alert-danger mb-4">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Form to edit the category -->
            <form action="{{ route('categories.update', $category->id) }}" method="POST" id="category-form">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700">Category Name</label>
                    <input type="text" id="name" name="name" value="{{ old('name', $category->name) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
                </div>

                <!-- Display the related items -->
                @if($category->items->isNotEmpty())
                    <div class="mb-4">
                        <h3 class="text-xl font-semibold mb-4">Items</h3>
                        <ul class="list-disc pl-5">
                            @foreach($category->items as $item)
                                <li>{{ $item->name }}</li>
                            @endforeach
                        </ul>
                    </div>
                @else
                    <div class="mb-4">
                        <p>No items found for this category.</p>
                    </div>
                @endif

                <div class="flex items-center justify-end mt-4">
                    <button type="submit" class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">
                        Update Category
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@extends('layouts.form')
@section('content')
    <div class="container mx-auto mt-8">
        <div class="bg-white shadow-md rounded-lg p-6">
            <h2 class="text-2xl font-semibold mb-6">Create New Category</h2>

            <!-- Check if there are any validation errors -->
            <div id="errors" class="alert alert-danger mb-4" style="display: none;">
                <ul id="errors-list">
                    <!-- Errors will be displayed here -->
                </ul>
            </div>

            <!-- Form to create a new category -->
            <form action="{{route('categories.store')}}" method="POST" id="category-form">
                <!-- Add CSRF token if necessary -->
                @csrf
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700">Category Name</label>
                    <input type="text" id="name" name="name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
                </div>

                <div class="flex items-center justify-end mt-4">
                    <button type="submit" class=" px-4 rounded">
                        Create Category
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Add your JavaScript links here -->
  @endsection
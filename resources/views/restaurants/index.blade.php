@extends(('layouts.form'))
@section('restau')
@section('content')
    <div class="container">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center mb-4">
            <h1 class="h2">Restaurants</h1>
            <a href="{{ route('restaurants.create') }}" class="btn btn-primary">Add New Restaurant</a>
        </div>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Description</th>
                    <th>Open Days</th>
                    <th>Capacity</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($restaurants as $restaurant)
                    <tr>
                        <td>{{ $restaurant->name }}</td>
                        <td>{{ $restaurant->address }}</td>
                        <td>{{ $restaurant->description }}</td>
                        <td>{{ $restaurant->open_days }}</td>
                        <td>{{ $restaurant->capacity }}</td>
                        <td>
                            <a href="{{ route('restaurants.show', $restaurant->id) }}" class="btn btn-info btn-sm">View</a>
                            <a href="{{ route('restaurants.edit', $restaurant->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('restaurants.destroy', $restaurant->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this restaurant?');">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

@endsection
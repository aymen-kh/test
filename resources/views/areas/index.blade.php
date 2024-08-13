<!DOCTYPE html>
<html>
<head>
    <title>Areas</title>
</head>
<body>
    <h1>Areas</h1>
    <a href="{{ route('areas.create') }}">Create New Area</a>
    <table border="1">
        <thead>
            <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Image</th>
                <th>Tables</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($areas as $area)
                <tr>
                    <td>{{ $area->name }}</td>
                    <td>{{ $area->description }}</td>
                    <td>
                        @if ($area->image)
                            <img src="{{ asset('storage/' . $area->image) }}" alt="Image" width="100">
                        @endif
                    </td>
                    <td>
                        <ul>
                            @foreach ($area->tables as $table)
                                <li>{{ $table->number }} - {{ $table->status }}</li>
                            @endforeach
                        </ul>
                    </td>
                    <td>
                        <a href="{{ route('areas.show', $area->id) }}">View</a>
                        <a href="{{ route('areas.edit', $area->id) }}">Edit</a>
                        <form action="{{ route('areas.destroy', $area->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>

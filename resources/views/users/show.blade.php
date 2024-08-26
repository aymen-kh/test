<!DOCTYPE html>
<html>
<head>
    <title>Area Details</title>
</head>
<body>
    <h1>Area Details</h1>

    <h2>{{ $area->name }}</h2>
    <p>{{ $area->description }}</p>

    @if ($area->image)
        <img src="{{ asset('storage/' . $area->image) }}" alt="{{ $area->name }}" style="width: 200px;">
    @endif

    <h3>Tables in this Area</h3>
    @if ($area->tables->isEmpty())
        <p>No tables available in this area.</p>
    @else
        <table border="1">
            <thead>
                <tr>
                    <th>Table Number</th>
                    <th>Status</th>
                    <th>Capacity</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($area->tables as $table)
                    <tr>
                        <td>{{ $table->number }}</td>
                        <td>{{ $table->status }}</td>
                        <td>{{ $table->capacity }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <a href="{{ route('areas.index') }}">Back to List</a>
</body>
</html>

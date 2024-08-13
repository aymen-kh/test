<!DOCTYPE html>
<html>
<head>
    <title>Table Details</title>
</head>
<body>
    <h1>Table Details</h1>
    <p><strong>Number:</strong> {{ $table->number }}</p>
    <p><strong>Status:</strong> {{ $table->status }}</p>
    <p><strong>Capacity:</strong> {{ $table->capacity }}</p>
    <p><strong>Area ID:</strong> {{ $table->area_id }}</p>
    <a href="{{ route('tables.index') }}">Back to List</a>
</body>
</html>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Table</title>
</head>
<body>
    <h1>Edit Table</h1>
    <form action="{{ route('tables.update', $table->id) }}" method="POST">
        @csrf
        @method('PUT')
        <label for="number">Number:</label>
        <input type="number" name="number" id="number" value="{{ $table->number }}" required>
        <br>
        <label for="status">Status:</label>
        <input type="text" name="status" id="status" value="{{ $table->status }}" required>
        <br>
        <label for="capacity">Capacity:</label>
        <input type="number" name="capacity" id="capacity" value="{{ $table->capacity }}" required>
        <br>
        <label for="area_id">Area ID:</label>
        <input type="number" name="area_id" id="area_id" value="{{ $table->area_id }}" required>
        <br>
        <button type="submit">Update Table</button>
    </form>
    <a href="{{ route('tables.index') }}">Back to List</a>
</body>
</html>

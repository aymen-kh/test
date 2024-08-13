<!DOCTYPE html>
<html>
<head>
    <title>Create Table</title>
</head>
<body>
    <h1>Create New Table</h1>
    <form action="{{ route('tables.store') }}" method="POST">
        @csrf
        <label for="number">Number:</label>
        <input type="number" name="number" id="number" required>
        <br>
        
        <label for="status">Status:</label>
        <select name="status" id="status">
            <option value="available" selected>Available</option>
            <option value="pending">Pending</option>
            <option value="occupied">Occupied</option>
        </select>
        <br>
        
        <label for="capacity">Capacity:</label>
        <input type="number" name="capacity" id="capacity" required>
        <br>
        
        <label for="area_id">Area ID:</label>
        <input type="number" name="area_id" id="area_id" required>
        <br>
        
        <button type="submit">Create Table</button>
    </form>
    <a href="{{ route('tables.index') }}">Back to List</a>
</body>
</html>

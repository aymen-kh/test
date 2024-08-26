<!DOCTYPE html>
<html>
<head>
    <title>Create Area</title>
</head>
<body>
    <h1>Create New Area</h1>
    <form action="{{ route('areas.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" required>
        <br>
        <label for="description">Description:</label>
        <textarea name="description" id="description"></textarea>
        <br>
        <label for="image">Image:</label>
        <input type="file" name="image" id="image">
        <br>
        <button type="submit">Create Area</button>
    </form>
    <a href="{{ route('areas.index') }}">Back to List</a>
</body>
</html>

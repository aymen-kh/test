<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Area</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            padding-top: 56px; /* Space for the fixed navbar */
        }
        .container {
            margin-top: 20px;
        }
        .table-container {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
   

    <div class="container">
        <h1>Edit Area</h1>
        <form action="{{ route('areas.update', $area->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="mb-3">
                <label for="name" class="form-label">Name:</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ $area->name }}" required>
            </div>
            
            <div class="mb-3">
                <label for="description" class="form-label">Description:</label>
                <textarea name="description" id="description" class="form-control" rows="3" required>{{ $area->description }}</textarea>
            </div>
            
            <div class="mb-3">
                <label for="image" class="form-label">Image:</label>
                <input type="file" name="image" id="image" class="form-control">
                @if ($area->image)
                    <img src="{{ asset('storage/' . $area->image) }}" alt="Current Image" width="100" class="mt-2">
                @endif
            </div>
            
            <button type="submit" class="btn btn-primary">Update Area</button>
        </form>
        <a href="{{ route('areas.index') }}" class="btn btn-secondary mt-3">Back to List</a>

        <!-- Manage Tables -->
        <div class="table-container">
            <h2>Manage Tables</h2>
            
            <!-- Add Table Form -->
            <form action="{{ route('tables.store') }}" method="POST">
                @csrf
                <input type="hidden" name="area_id" value="{{ $area->id }}">
                
                <div class="mb-3">
                    <label for="number" class="form-label">Table Number:</label>
                    <input type="number" name="number" id="number" class="form-control" required>
                </div>
                
                <div class="mb-3">
                    <label for="status" class="form-label">Status:</label>
                    <input type="text" name="status" id="status" class="form-control" required>
                </div>
                
                <div class="mb-3">
                    <label for="capacity" class="form-label">Capacity:</label>
                    <input type="number" name="capacity" id="capacity" class="form-control" required>
                </div>
                
                <button type="submit" class="btn btn-success">Add Table</button>
            </form>
            
            <!-- List of Tables -->
            <div class="mt-4">
                <h3>Existing Tables</h3>
                <ul class="list-group">
                    @foreach ($area->tables as $table)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Table {{ $table->number }} - Status: {{ $table->status }} (Capacity: {{ $table->capacity }})
                            <form action="{{ route('tables.destroy', $table->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
</body>
</html>

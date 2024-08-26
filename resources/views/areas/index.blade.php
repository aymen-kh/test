<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Areas</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            padding-top: 56px; /* Space for the fixed navbar */
            background-color: #f8f9fa;
        }
        .navbar {
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            margin: 20px 0;
        }
        table th, table td {
            text-align: center;
            vertical-align: middle;
        }
        table img {
            max-width: 100px;
            height: auto;
        }
        .actions a, .actions button {
            margin-right: 10px;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1 class="my-2">Areas</h1>
        <a href="{{ route('areas.create') }}" class="btn btn-primary mb-3">Create New Area</a>
        <table class="table table-bordered table-striped">
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
                                <img src="{{ asset('storage/' . $area->image) }}" alt="Image">
                            @endif
                        </td>
                        <td>
                            <ul>
                                @foreach ($area->tables as $table)
                                    <li>{{ $table->number }} - {{ $table->status }}</li>
                                @endforeach
                            </ul>
                        </td>
                        <td class="actions">
                            <a href="{{ route('areas.show', $area->id) }}" class="btn btn-info btn-sm">View</a>
                            <a href="{{ route('areas.edit', $area->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('areas.destroy', $area->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
</body>
</html>

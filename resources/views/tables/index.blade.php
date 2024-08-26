@extends('layouts.form')
@section("title")tables @endsection
@section('content')
    <h1>Tables</h1>
    <a href="{{ route('tables.create') }}">Create New Table</a>
    <table border="1">
        <thead>
            <tr>
                <th>Number</th>
                <th>Status</th>
                <th>Capacity</th>
                <th>Area ID</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tables as $table)
                <tr>
                    <td>{{ $table->number }}</td>
                    <td>{{ $table->status }}</td>
                    <td>{{ $table->capacity }}</td>
                    <td>{{ $table->area_id }}</td>
                    <td>
                        <a href="{{ route('tables.show', $table->id) }}">View</a>
                        <a href="{{ route('tables.edit', $table->id) }}">Edit</a>
                        <form action="{{ route('tables.destroy', $table->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @endsection
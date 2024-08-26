@extends('layouts.form')

@section('content')
    <div class="container mx-auto mt-8">
        <div class="bg-white shadow-md rounded-lg p-6">
            <h2 class="text-2xl font-semibold mb-6">Users</h2>
            
            <table class="table-auto w-full">
                <thead>
                    <tr>
                        <th class="px-4 py-2">Name</th>
                        <th class="px-4 py-2">Email</th>
                        <th class="px-4 py-2">Roles</th>
                        <th class="px-4 py-2">Permissions</th>
                        <th class="px-4 py-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td class="border px-4 py-2">{{ $user->name }}</td>
                            <td class="border px-4 py-2">{{ $user->email }}</td>
                            <td class="border px-4 py-2">
                                @foreach($user->roles as $role)
                                    <span class="bg-gray-200 rounded-full px-2 py-1 text-xs">{{ $role->name }}</span>
                                @endforeach
                            </td>
                            <td class="border px-4 py-2">
                                @foreach($user->getAllPermissions() as $permission)
                                    <span class="bg-gray-200 rounded-full px-2 py-1 text-xs">{{ $permission->name }}</span>
                                @endforeach
                            </td>
                            <td class="border px-4 py-2 flex items-center">
                                <a href="{{ route('users.edit', $user->id) }}" class="text-indigo-600 hover:text-indigo-900 mr-4">Edit</a>
                                
                                <!-- Delete Form -->
                                <form action="{{ route('users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this user?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

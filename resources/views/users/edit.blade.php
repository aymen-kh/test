@extends('layouts.form')

@section('content')
    <div class="container mx-auto mt-8">
        <div class="bg-white shadow-md rounded-lg p-6">
            <h2 class="text-2xl font-semibold mb-6">Edit User</h2>

            @if ($errors->any())
                <div class="alert alert-danger mb-4">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('users.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                    <input type="text" id="name" name="name" value="{{ $user->name }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" disabled>
                </div>

                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" id="email" name="email" value="{{ $user->email }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" disabled>
                </div>

                <div class="mb-4">
                    <label for="roles" class="block text-sm font-medium text-gray-700">Roles</label>
                    @foreach($roles as $role)
                        <div class="flex items-center mb-2">
                            <input type="checkbox" id="role_{{ $role->id }}" name="roles[]" value="{{ $role->name }}" 
                                @if($user->roles->contains($role)) checked @endif 
                                class="mr-2">
                            <label for="role_{{ $role->id }}" class="text-sm">{{ $role->name }}</label>
                        </div>
                    @endforeach
                </div>

                <div class="mb-4">
                    <label for="permissions" class="block text-sm font-medium text-gray-700">Permissions</label>
                    @foreach($permissions as $permission)
                        <div class="flex items-center mb-2">
                            <input type="checkbox" id="permission_{{ $permission->id }}" name="permissions[]" value="{{ $permission->name }}" 
                                @if($user->permissions->contains($permission)) checked @endif 
                                class="mr-2">
                            <label for="permission_{{ $permission->id }}" class="text-sm">{{ $permission->name }}</label>
                        </div>
                    @endforeach
                </div>

                <div class="flex items-center justify-end mt-4">
                    <button type="submit" class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">
                        Update User
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@extends('layouts.admin')

@section('content')
<h1 class="text-3xl font-bold text-gray-800 mb-6">Manage Users</h1>

<div class="bg-white shadow-md rounded-lg overflow-hidden">
    <table class="min-w-full bg-white">
        <thead class="bg-gray-800 text-white">
            <tr>
                <th class="py-3 px-4 text-left">Name</th>
                <th class="py-3 px-4 text-left">Email</th>
                <th class="py-3 px-4 text-left">Role</th>
                <th class="py-3 px-4 text-left">Status</th>
                <th class="py-3 px-4 text-left">Action</th>
            </tr>
        </thead>
        <tbody class="text-gray-700">
            @foreach($users as $user)
            <tr class="border-b hover:bg-gray-50">
                <td class="py-3 px-4 font-bold">{{ $user->name }}</td>
                <td class="py-3 px-4">{{ $user->email }}</td>
                <td class="py-3 px-4">
                    @if($user->is_admin)
                        <span class="bg-purple-100 text-purple-800 text-xs font-bold px-2 py-1 rounded">Admin</span>
                    @else
                        <span class="bg-gray-100 text-gray-800 text-xs font-bold px-2 py-1 rounded">Customer</span>
                    @endif
                </td>
                <td class="py-3 px-4">
                    @if($user->status === 'active')
                        <span class="bg-green-100 text-green-800 text-xs font-bold px-2 py-1 rounded">Active</span>
                    @else
                        <span class="bg-red-100 text-red-800 text-xs font-bold px-2 py-1 rounded">Disabled</span>
                    @endif
                </td>
                <td class="py-3 px-4">
                    <a href="{{ route('admin.users.show', $user->id) }}" class="bg-blue-600 hover:bg-blue-700 text-white text-xs font-bold py-1 px-3 rounded shadow transition">
                          View
                            </a>

                        
                    <br><form action="{{ route('admin.users.toggle', $user->id) }}" method="POST">
                        @csrf
                        @method('PATCH')

                        @if($user->status === 'active')
                            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white text-xs font-bold py-1 px-3 rounded shadow transition">
                                Disable Account
                            </button>
                        @else
                            <button type="submit" class="bg-green-500 hover:bg-green-600 text-white text-xs font-bold py-1 px-3 rounded shadow transition">
                                Enable Account
                            </button>
                        @endif
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="p-4">
        {{ $users->links() }}
    </div>
</div>
@endsection
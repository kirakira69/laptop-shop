@extends('layouts.admin')

@section('content')
<h1 class="text-3xl font-bold text-gray-800 mb-6">User Messages</h1>

<div class="bg-white shadow-md rounded-lg overflow-hidden">
    <table class="min-w-full bg-white">
        <thead class="bg-gray-800 text-white">
            <tr>
                <th class="py-3 px-4 text-left">Date</th>
                <th class="py-3 px-4 text-left">Name</th>
                <th class="py-3 px-4 text-left">Email</th>
                <th class="py-3 px-4 text-left w-1/3">Message</th>
                <th class="py-3 px-4 text-left">Action</th>
            </tr>
        </thead>
        <tbody class="text-gray-700">
            @foreach($messages as $msg)
            <tr class="border-b hover:bg-gray-50">
                <td class="py-3 px-4 text-sm text-gray-500">
                    {{ $msg->created_at->format('M d, Y') }}
                </td>
                <td class="py-3 px-4 font-bold">{{ $msg->name }}</td>
                <td class="py-3 px-4 text-blue-600">{{ $msg->email }}</td>
                <td class="py-3 px-4">{{ Str::limit($msg->message, 50) }}</td>
                <td class="py-3 px-4">
                    <form action="{{ route('admin.messages.destroy', $msg->id) }}" method="POST" 
                          onsubmit="return confirm('Delete this message?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:text-red-900 font-medium">
                            Delete
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="p-4">
        {{ $messages->links() }}
    </div>
</div>
@endsection
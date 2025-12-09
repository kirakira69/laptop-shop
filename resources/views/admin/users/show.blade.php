@extends('layouts.admin')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-3xl font-bold text-gray-800">User Details</h1>
    <a href="{{ route('admin.users.index') }}" class="text-gray-600 hover:text-gray-900 font-medium">&larr; Back to Users</a>
</div>

<div class="bg-white shadow-lg rounded-xl overflow-hidden">
    <div class="bg-gradient-to-r from-indigo-600 to-blue-500 px-6 py-4">
        <div class="flex justify-between items-center">
            <h2 class="text-white text-xl font-bold">{{ $user->name }}</h2>
            <span class="px-3 py-1 rounded-full text-xs font-bold bg-white 
                {{ $user->status === 'active' ? 'text-green-600' : 'text-red-600' }}">
                {{ ucfirst($user->status) }}
            </span>
        </div>
        <p class="text-indigo-100 text-sm mt-1">{{ $user->email }}</p>
    </div>

    <div class="p-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            
            <div>
                <h3 class="text-gray-500 text-xs font-bold uppercase tracking-wider mb-4 border-b pb-2">Personal Information</h3>
                
                <div class="space-y-4">
                    <div>
                        <label class="text-sm text-gray-500">Role</label>
                        <p class="font-medium text-gray-900">{{ $user->is_admin ? 'Administrator' : 'Customer' }}</p>
                    </div>
                    <div>
                        <label class="text-sm text-gray-500">Phone Number</label>
                        <p class="font-medium text-gray-900">{{ $user->phone ?? 'N/A' }}</p>
                    </div>
                    <div>
                        <label class="text-sm text-gray-500">Birthday</label>
                        <p class="font-medium text-gray-900">{{ $user->birthdate ? \Carbon\Carbon::parse($user->birthdate)->format('F d, Y') : 'N/A' }}</p>
                    </div>
                    <div>
                        <label class="text-sm text-gray-500">Joined Date</label>
                        <p class="font-medium text-gray-900">{{ $user->created_at->format('M d, Y') }}</p>
                    </div>
                </div>
            </div>

            <div>
                <h3 class="text-gray-500 text-xs font-bold uppercase tracking-wider mb-4 border-b pb-2">Address / Shipping</h3>
                
                <div class="space-y-4">
                    <div>
                        <label class="text-sm text-gray-500">Street / Zone</label>
                        <p class="font-medium text-gray-900">
                            {{ $user->street ?? '' }} {{ $user->zone ? '(Zone: '.$user->zone.')' : '' }}
                            {{ !$user->street && !$user->zone ? 'N/A' : '' }}
                        </p>
                    </div>
                    <div>
                        <label class="text-sm text-gray-500">Barangay</label>
                        <p class="font-medium text-gray-900">{{ $user->barangay ?? 'N/A' }}</p>
                    </div>
                    <div>
                        <label class="text-sm text-gray-500">Municipality / City</label>
                        <p class="font-medium text-gray-900">{{ $user->municipal ?? 'N/A' }}</p>
                    </div>
                    <div>
                        <label class="text-sm text-gray-500">Province & Zip</label>
                        <p class="font-medium text-gray-900">
                            {{ $user->province ?? '' }} {{ $user->zip_code ?? '' }}
                            {{ !$user->province && !$user->zip_code ? 'N/A' : '' }}
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
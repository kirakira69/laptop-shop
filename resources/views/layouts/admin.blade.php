<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Laptop Shop</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans leading-normal tracking-normal flex">

    <div class="w-64 bg-gray-900 min-h-screen text-white">
        <div class="p-4 text-2xl font-bold text-indigo-500">AdminPanel</div>
        
        <ul class="mt-6">
    
            <li class="{{ request()->is('admin/dashboard') ? 'border-l-4 border-indigo-500 bg-gray-800' : 'hover:bg-gray-800 border-l-4 border-transparent' }}">
                <a href="{{ route('admin.dashboard') }}" 
                   class="block px-4 py-2 {{ request()->is('admin/dashboard') ? 'text-white font-bold' : 'text-gray-400 hover:text-white' }}">
                    Dashboard Overview
                </a>
            </li>

            <li class="{{ request()->is('admin/products*') ? 'border-l-4 border-indigo-500 bg-gray-800' : 'hover:bg-gray-800 border-l-4 border-transparent' }}">
                <a href="{{ route('admin.products.index') }}" 
                   class="block px-4 py-2 {{ request()->is('admin/products*') ? 'text-white font-bold' : 'text-gray-400 hover:text-white' }}">
                    Manage Products
                </a>
            </li>
            
            <li class="{{ request()->is('admin/orders*') ? 'border-l-4 border-indigo-500 bg-gray-800' : 'hover:bg-gray-800 border-l-4 border-transparent' }}">
                <a href="{{ route('admin.orders.index') }}" 
                   class="block px-4 py-2 {{ request()->is('admin/orders*') ? 'text-white font-bold' : 'text-gray-400 hover:text-white' }}">
                    Manage Orders
                </a>
            </li>

            <li class="{{ request()->is('admin/users*') ? 'border-l-4 border-indigo-500 bg-gray-800' : 'hover:bg-gray-800 border-l-4 border-transparent' }}">
                <a href="{{ route('admin.users.index') }}" 
                   class="block px-4 py-2 {{ request()->is('admin/users*') ? 'text-white font-bold' : 'text-gray-400 hover:text-white' }}">
                    Manage Users
                </a>
            </li>

            <li class="{{ request()->is('admin/messages*') ? 'border-l-4 border-indigo-500 bg-gray-800' : 'hover:bg-gray-800 border-l-4 border-transparent' }}">
                <a href="{{ route('admin.messages.index') }}" 
                   class="block px-4 py-2 {{ request()->is('admin/messages*') ? 'text-white font-bold' : 'text-gray-400 hover:text-white' }}">
                    Messages
                </a>
            </li>

            <li class="mt-8 border-l-4 border-transparent hover:bg-gray-800">
                <a href="/" class="block px-4 py-2 text-gray-400 hover:text-white">
                    Back to Shop
                </a>
            </li>

        </ul>
    </div>

    <div class="flex-1 p-10">
        @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6">
                {{ session('success') }}
            </div>
        @endif
        
        @yield('content')
    </div>

</body>

</html>
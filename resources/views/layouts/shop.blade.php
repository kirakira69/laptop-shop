
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laptop Shop</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style> body { font-family: 'Inter', sans-serif; } </style>
</head>

<body class="bg-gray-50 text-gray-800 flex flex-col min-h-screen">

    <nav class="bg-white shadow-sm sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">

            <!-- Logo -->
            <a href="/" class="text-2xl font-bold text-indigo-600">
                TechNode
            </a>

            <!-- Search (hidden on mobile) -->
            <div class="hidden md:flex flex-1 justify-center px-8">
                <form action="{{ route('shop.index') }}" method="GET" class="w-full max-w-lg relative">
                    <input type="text" name="search" placeholder="Search laptops..."
                        value="{{ request('search') }}"
                        class="w-full border border-gray-300 rounded-full pl-4 pr-10 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    <button type="submit" class="absolute right-3 top-2.5 text-gray-400 hover:text-indigo-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </button>
                </form>
            </div>

            <!-- Desktop Menu -->
            <div class="hidden md:flex items-center space-x-6">
                <a href="{{ route('shop.index') }}" class="text-gray-600 hover:text-indigo-600">Home</a>
                <a href="{{ route('shop.about') }}" class="text-gray-600 hover:text-indigo-600">About</a>
                <a href="{{ route('shop.contact') }}" class="text-gray-600 hover:text-indigo-600">Contact</a>
               

                <a href="{{ route('cart.index') }}" class="relative text-gray-600 hover:text-indigo-600">
                    Cart
                    @if(session('cart') && count(session('cart')) > 0)
                        <span class="absolute -top-2 -right-3 bg-indigo-600 text-white text-xs font-bold rounded-full px-1.5 py-0.5">
                            {{ count(session('cart')) }}
                        </span>
                    @endif
                </a>

                @auth
                    <a href="{{ route('dashboard') }}" class="text-gray-600 hover:text-indigo-600">Profile</a>
                @else
                    <a href="{{ route('login') }}" class="text-gray-600 hover:text-indigo-600">Login</a>
                    <a href="{{ route('register') }}"
                        class="ml-2 text-white bg-indigo-600 hover:bg-indigo-700 px-4 py-2 rounded-lg text-sm">
                        Register
                    </a>
                @endauth
            </div>

            <!-- Hamburger Button (mobile only) -->
            <button id="mobile-menu-btn" class="md:hidden text-gray-700 focus:outline-none">
                <svg id="hamburger-icon" class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </div>
    </div>

    <!-- Mobile Dropdown Menu -->
    <div id="mobile-menu" class="md:hidden hidden bg-white shadow-md px-4 pb-4 space-y-3">

        <!-- Mobile Search -->
        <form action="{{ route('shop.index') }}" method="GET" class="w-full relative pt-3">
            <input type="text" name="search" placeholder="Search laptops..."
                class="w-full border border-gray-300 rounded-full pl-4 pr-10 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
            <button class="absolute right-3 top-4 text-gray-400">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </button>
        </form>

        <!-- Menu Links -->
        <a href="{{ route('shop.index') }}" class="block text-gray-700">Home</a>
        <a href="{{ route('shop.about') }}" class="block text-gray-700">About</a>
        <a href="{{ route('shop.contact') }}" class="block text-gray-700">Contact</a>
        <a href="{{ route('shop.system') }}" class="block text-gray-700">System</a>
        <a href="{{ route('cart.index') }}" class="block text-gray-700">Cart</a>

        @auth
            <a href="{{ route('dashboard') }}" class="block text-gray-700">Profile</a>
        @else
            <a href="{{ route('login') }}" class="block text-gray-700">Login</a>
            <a href="{{ route('register') }}" class="block text-indigo-600 font-semibold">Register</a>
        @endauth
    </div>
</nav>


    <main class="py-8 flex-grow">
        @yield('content')
    </main>

    <footer class="bg-gray-900 text-white mt-12 py-8">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <p>&copy; 2024 TechNode Laptop Shop. All rights reserved.</p>
        </div>
    </footer>
    <script>
    const btn = document.getElementById('mobile-menu-btn');
    const menu = document.getElementById('mobile-menu');

    btn.addEventListener('click', () => {
        menu.classList.toggle('hidden');
    });
</script>

</body>
</html>
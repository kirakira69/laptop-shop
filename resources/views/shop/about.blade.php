@extends('layouts.shop')

@section('content')
<div class="bg-white">
    <div class="relative bg-indigo-900 py-16">
        <div class="absolute inset-0 overflow-hidden">
            <img src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?ixlib=rb-1.2.1&auto=format&fit=crop&w=2850&q=80" alt="" class="w-full h-full object-cover opacity-20">
        </div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl font-extrabold tracking-tight text-white sm:text-5xl lg:text-6xl">About TechNode</h1>
            <p class="mt-6 text-xl text-indigo-200 max-w-3xl mx-auto">Empowering your digital life with the latest technology and premium laptops.</p>
        </div>
    </div>

    <div class="bg-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="flex flex-col md:flex-row items-center gap-12">
            
            <div class="w-full md:w-1/2">
                <img src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" 
                     alt="About Us Team" 
                     class="rounded-2xl shadow-xl w-full h-auto object-cover transition-transform duration-300 hover:scale-105">
            </div>

            <div class="w-full md:w-1/2 space-y-6">
                <h2 class="text-3xl font-extrabold text-gray-900 sm:text-4xl">
                    Driving Innovation Through Technology
                </h2>
                <p class="text-lg text-gray-600 leading-relaxed">
                    Welcome to <span class="text-indigo-600 font-bold">TechNode</span>. We are passionate about providing top-tier computing solutions to professionals, gamers, and students alike.
                </p>
                <p class="text-lg text-gray-600 leading-relaxed">
                    Our journey began with a simple mission: to make powerful technology accessible and understandable. Today, we are proud to be a trusted source for the latest laptops and accessories, backed by expert knowledge and exceptional customer support.
                </p>
                <div class="pt-4">
                    <a href="{{ route('shop.contact') }}" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 transition-colors">
                        Get in Touch
                    </a>
                </div>
            </div>

        </div>
    </div>
</div>

    <div class="bg-gray-50 py-16 border-t border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-extrabold text-gray-900">Meet the Developers</h2>
                <p class="mt-4 text-lg text-gray-500">The mind behind the code.</p>
            </div>

            <div class="bg-white rounded-3xl shadow-xl overflow-hidden max-w-4xl mx-auto flex flex-col md:flex-row">
                
                <div class="md:w-2/5 relative">
                    <img src="{{ asset('images/romeo.jpg') }}" 
                         alt="Developer" 
                        class="w-full h-full object-cover">
    
    <div class="absolute inset-0 bg-indigo-900/10"></div>
</div>

                <div class="p-8 md:p-12 md:w-3/5 flex flex-col justify-center">
                    <div class="uppercase tracking-wide text-sm text-indigo-600 font-bold">Developer</div>
                    <h3 class="mt-2 text-3xl leading-8 font-extrabold tracking-tight text-gray-900 sm:text-4xl">
                        Romer Fredrick Morales
                    </h3>
                    <p class="mt-4 text-lg text-gray-500">
                        Hi! We built TechNode to demonstrate the power of modern web development. We are passionate about creating clean, efficient, and user-friendly applications using the latest technologies.
                    </p>
                    
                    <div class="mt-6">
                        <p class="text-sm font-semibold text-gray-900 mb-3">Technologies Used:</p>
                        <div class="flex flex-wrap gap-2">
                            <span class="px-3 py-1 bg-red-100 text-red-800 rounded-full text-xs font-bold">Laravel 11</span>
                            <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-xs font-bold">Tailwind CSS</span>
                            <span class="px-3 py-1 bg-yellow-100 text-yellow-800 rounded-full text-xs font-bold">MySQL</span>
                            
                            
                        </div>
                    </div>

                   
                </div>
            </div>
        </div>
    </div>

    <div class="bg-gray-50 py-16 border-t border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <br>

            <div class="bg-white rounded-3xl shadow-xl overflow-hidden max-w-4xl mx-auto flex flex-col md:flex-row">
                
                <div class="md:w-2/5 relative">
                    <img src="{{ asset('images/kurt.jpg') }}" 
                         alt="Developer" 
                        class="w-full h-full object-cover">
    
    <div class="absolute inset-0 bg-indigo-900/10"></div>
</div>

                <div class="p-8 md:p-12 md:w-3/5 flex flex-col justify-center">
                    <div class="uppercase tracking-wide text-sm text-indigo-600 font-bold">Developer</div>
                    <h3 class="mt-2 text-3xl leading-8 font-extrabold tracking-tight text-gray-900 sm:text-4xl">
                        John Kurt Lomasang
                    </h3>
                    <p class="mt-4 text-lg text-gray-500">
                        Hi! We built TechNode to demonstrate the power of modern web development.We are passionate about creating clean, efficient, and user-friendly applications using the latest technologies.
                    </p>
                    
                    <div class="mt-6">
                        <p class="text-sm font-semibold text-gray-900 mb-3">Technologies Used:</p>
                        <div class="flex flex-wrap gap-2">
                            <span class="px-3 py-1 bg-red-100 text-red-800 rounded-full text-xs font-bold">Laravel 11</span>
                            <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-xs font-bold">Tailwind CSS</span>
                            <span class="px-3 py-1 bg-yellow-100 text-yellow-800 rounded-full text-xs font-bold">MySQL</span>
                            
                            
                        </div>
                    </div>

                   
                </div>
            </div>
        </div>
    </div>

    <div class="bg-gray-50 py-16 border-t border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <br>

            <div class="bg-white rounded-3xl shadow-xl overflow-hidden max-w-4xl mx-auto flex flex-col md:flex-row">
                
                <div class="md:w-2/5 relative">
                    <img src="{{ asset('images/me1.jpg') }}" 
                         alt="Developer" 
                        class="w-full h-full object-cover">
    
    <div class="absolute inset-0 bg-indigo-900/10"></div>
</div>

                <div class="p-8 md:p-12 md:w-3/5 flex flex-col justify-center">
                    <div class="uppercase tracking-wide text-sm text-indigo-600 font-bold">Developer</div>
                    <h3 class="mt-2 text-3xl leading-8 font-extrabold tracking-tight text-gray-900 sm:text-4xl">
                        Ramel Gino Quezon
                    </h3>
                    <p class="mt-4 text-lg text-gray-500">
                        Hi! We built TechNode to demonstrate the power of modern web development.We are passionate about creating clean, efficient, and user-friendly applications using the latest technologies.
                    </p>
                    
                    <div class="mt-6">
                        <p class="text-sm font-semibold text-gray-900 mb-3">Technologies Used:</p>
                        <div class="flex flex-wrap gap-2">
                            <span class="px-3 py-1 bg-red-100 text-red-800 rounded-full text-xs font-bold">Laravel 11</span>
                            <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-xs font-bold">Tailwind CSS</span>
                            <span class="px-3 py-1 bg-yellow-100 text-yellow-800 rounded-full text-xs font-bold">MySQL</span>
                            
                            
                        </div>
                    </div>

                   
                </div>
            </div>
        </div>
    </div>

    
</div>
@endsection
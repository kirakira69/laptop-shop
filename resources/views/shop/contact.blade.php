@extends('layouts.shop')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="text-center mb-12">
        <h1 class="text-3xl font-extrabold text-gray-900 sm:text-4xl">Get in Touch</h1>
        <p class="mt-4 text-lg text-gray-500">Have questions? We'd love to hear from you.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <div class="bg-gray-50 rounded-2xl p-8">
            <h3 class="text-xl font-bold text-gray-900 mb-6">Contact Information</h3>
            
            <div class="flex items-start mb-6">
                <svg class="w-6 h-6 text-indigo-600 mt-1 mr-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                <div>
                    <p class="font-bold text-gray-900">Our Office</p>
                    <p class="text-gray-600">69 Tatabi Lang,<br>Pozorrubio, Pangasinan</p>
                </div>
            </div>

            <div class="flex items-start mb-6">
                <svg class="w-6 h-6 text-indigo-600 mt-1 mr-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                <div>
                    <p class="font-bold text-gray-900">Email Us</p>
                    <p class="text-gray-600">support@technode.com</p>
                </div>
            </div>

            <div class="flex items-start">
                <svg class="w-6 h-6 text-indigo-600 mt-1 mr-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                <div>
                    <p class="font-bold text-gray-900">Call Us</p>
                    <p class="text-gray-600">+63 963 404 1616</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-lg p-8">
            
            @if(session('success'))
                <div class="mb-4 bg-green-100 text-green-700 p-3 rounded-lg border border-green-200">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('shop.contact.store') }}" method="POST">
                @csrf <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Name</label>
                    <input type="text" name="name" required class="w-full border rounded-lg px-4 py-2 focus:ring-indigo-500 focus:border-indigo-500" placeholder="Your Name">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Email</label>
                    <input type="email" name="email" required class="w-full border rounded-lg px-4 py-2 focus:ring-indigo-500 focus:border-indigo-500" placeholder="your@email.com">
                </div>
                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Message</label>
                    <textarea name="message" rows="4" required class="w-full border rounded-lg px-4 py-2 focus:ring-indigo-500 focus:border-indigo-500" placeholder="How can we help?"></textarea>
                </div>
                
                <button type="submit" class="w-full bg-indigo-600 text-white font-bold py-3 rounded-lg hover:bg-indigo-700 transition">
                    Send Message
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
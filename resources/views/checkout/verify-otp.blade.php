    @extends('layouts.shop')

    @section('content')
    <div class="min-h-screen flex flex-col justify-center items-center py-12 px-4 sm:px-6 lg:px-8 bg-gray-50">
        <div class="max-w-md w-full space-y-8 bg-white p-10 rounded-2xl shadow-xl">
            
            <div class="text-center">
                <h2 class="mt-6 text-3xl font-extrabold text-gray-900">
                    Verify Payment
                </h2>
                <p class="mt-2 text-sm text-gray-600">
                    For security, we sent a code to <strong>{{ Auth::user()->email }}</strong>
                </p>
            </div>

            <form class="mt-8 space-y-6" action="{{ route('checkout.verify') }}" method="POST">
                @csrf
                
                <div>
                    <label for="otp" class="sr-only">OTP Code</label>
                    <input id="otp" name="otp" type="text" required 
                        class="appearance-none rounded-lg relative block w-full px-3 py-4 border border-gray-300 placeholder-gray-500 text-gray-900 text-center text-2xl tracking-widest font-bold focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" 
                        placeholder="Enter 6-digit Code">
                    
                    @error('otp')
                    <p class="text-red-500 text-sm mt-2 text-center font-bold">{{ $message }}</p>
                @enderror
                </div>

                <div>
                    <button type="submit" 
                        class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 shadow-lg transition transform hover:-translate-y-0.5">
                        Verify & Proceed to Payment
                    </button>
                </div>
            </form>
            
            <div class="text-center mt-4">
                <a href="{{ route('cart.index') }}" class="text-sm text-gray-500 hover:text-gray-900 underline">Cancel Payment</a>
            </div>
        </div>
    </div>
    @endsection
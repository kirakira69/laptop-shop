<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        {{ __('We have sent a 6-digit verification code to your email. Please enter it below.') }}
    </div>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('otp.check') }}">
        @csrf

        <div>
            <x-input-label for="otp" :value="__('Enter OTP Code')" />
            <x-text-input id="otp" class="block mt-1 w-full text-center text-2xl tracking-widest font-bold" type="text" name="otp" required autofocus />
            <x-input-error :messages="$errors->get('otp')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Verify & Login') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
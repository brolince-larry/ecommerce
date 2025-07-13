<x-guest-layout>
    <!-- Correct Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <div class="min-h-screen flex items-center justify-center bg-gradient-to-r from-green-400 via-green-500 to-green-600 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full bg-white p-8 rounded-2xl shadow-xl">
            <div class="mb-6 text-center">
                <h2 class="text-3xl font-bold text-gray-800">Create Your Account</h2>
                <p class="text-sm text-gray-500 mt-2">Start your journey with us</p>
            </div>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Full Name -->
                <div class="mb-4">
                    <x-input-label for="name" :value="__('Full Name')" />
                    <x-text-input id="name" name="name" type="text" :value="old('name')" required autofocus autocomplete="name"
                        class="block w-full mt-1 rounded-lg shadow-sm border-gray-300 focus:border-green-500 focus:ring-green-500" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2 text-sm text-red-600" />
                </div>

                <!-- Email Address -->
                <div class="mb-4">
                    <x-input-label for="email" :value="__('Email Address')" />
                    <x-text-input id="email" name="email" type="email" :value="old('email')" required autocomplete="username"
                        class="block w-full mt-1 rounded-lg shadow-sm border-gray-300 focus:border-green-500 focus:ring-green-500" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-sm text-red-600" />
                </div>

                <!-- Password -->
                <div class="mb-4">
                    <x-input-label for="password" :value="__('Password')" />
                    <x-text-input id="password" name="password" type="password" required autocomplete="new-password"
                        class="block w-full mt-1 rounded-lg shadow-sm border-gray-300 focus:border-green-500 focus:ring-green-500" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-sm text-red-600" />
                </div>

                <!-- Confirm Password -->
                <div class="mb-6">
                    <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                    <x-text-input id="password_confirmation" name="password_confirmation" type="password" required autocomplete="new-password"
                        class="block w-full mt-1 rounded-lg shadow-sm border-gray-300 focus:border-green-500 focus:ring-green-500" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-sm text-red-600" />
                </div>

                <!-- Register Button -->
                <div class="flex items-center justify-between">
                    <a href="{{ route('login') }}" class="text-sm text-green-700 hover:text-green-900">Already have an account?</a>
                    <x-primary-button class="bg-green-600 hover:bg-green-700 focus:ring-green-500">
                        {{ __('Register') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>

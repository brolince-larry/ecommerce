<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login | ShopSmart</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

    <div class="min-h-screen flex flex-col lg:flex-row">
        <!-- Left Side (Image & Text) -->
        <div class="hidden lg:flex lg:w-1/2 bg-indigo-700 items-center justify-center p-10 text-white">
            <div class="max-w-md text-center">
                <h1 class="text-4xl font-bold mb-4">Welcome Back!</h1>
                <p class="text-lg mb-6">Login to manage your account and continue shopping.</p>
                <img src="{{ asset('storage/login-illustration.png') }}" alt="Login" class="w-64 mx-auto">
            </div>
        </div>

        <!-- Right Side (Login Form) -->
        <div class="w-full lg:w-1/2 bg-white flex items-center justify-center p-6 sm:p-10">
            <div class="w-full max-w-md">
                <h2 class="text-3xl font-bold text-center text-indigo-700 mb-6">Login</h2>

                @if(session('status'))
                    <div class="mb-4 text-green-600 text-sm text-center">
                        {{ session('status') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="mb-4 text-red-600 text-sm">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>- {{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}" class="space-y-5">
                    @csrf

                    <!-- Email Field -->
                    <div>
                        <label for="email" class="block text-gray-700 font-medium">Email</label>
                        <input type="email" name="email" id="email" required
                            class="w-full border border-gray-300 px-4 py-2 rounded focus:ring-2 focus:ring-indigo-500"
                            value="{{ old('email') }}">
                    </div>

                    <!-- Password Field -->
                    <div>
                        <label for="password" class="block text-gray-700 font-medium">Password</label>
                        <input type="password" name="password" id="password" required
                            class="w-full border border-gray-300 px-4 py-2 rounded focus:ring-2 focus:ring-indigo-500">
                    </div>

                    <!-- Remember Me and Forgot -->
                    <div class="flex justify-between items-center text-sm">
                        <label class="flex items-center">
                            <input type="checkbox" name="remember" class="mr-2">
                            Remember me
                        </label>
                        <a href="{{ route('password.request') }}" class="text-indigo-600 hover:underline">
                            Forgot Password?
                        </a>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit"
                        class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-4 rounded shadow">
                        Log In
                    </button>
                </form>

                <p class="text-center text-sm text-gray-600 mt-6">
                    Don't have an account?
                    <a href="{{ route('register') }}" class="text-indigo-600 hover:underline">Sign up</a>
                </p>
            </div>
        </div>
    </div>

</body>
</html>

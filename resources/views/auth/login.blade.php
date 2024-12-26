<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

<div class="flex justify-center items-center h-screen p-10 bg-yellow-300">
    <div class="grid md:grid-cols-2 grid-cols-1 border rounded-3xl shadow-lg bg-indigo-100">
        <!-- Form Section -->
        <div class="flex justify-center items-center p-5 bg-white rounded-3xl">
            <form method="POST" action="{{ route('login') }}" class="w-full max-w-sm">
                @csrf
                <header class="mb-8 text-center">
                    <img class="w-40 mx-auto mb-5" src="{{ asset('img/kkk.jpg') }}" alt="Logo" />

                    <h1 class="text-2xl font-bold text-indigo-700">Login</h1>
                </header>

                <!-- Email Address -->
                <div class="relative mb-5">
                    <label for="email" class="text-sm font-semibold text-gray-600">Email</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username" class="w-full bg-gray-100 border border-indigo-500 rounded-md p-3 mt-1 outline-none focus:ring-2 focus:ring-indigo-400">
                    @if($errors->has('email'))
                    <span class="text-sm text-red-500">{{ $errors->first('email') }}</span>
                    @endif
                </div>

                <!-- Password -->
                <div class="relative mb-5">
                    <label for="password" class="text-sm font-semibold text-gray-600">Password</label>
                    <input id="password" type="password" name="password" required autocomplete="current-password" class="w-full bg-gray-100 border border-indigo-500 rounded-md p-3 mt-1 outline-none focus:ring-2 focus:ring-indigo-400">
                    @if($errors->has('password'))
                    <span class="text-sm text-red-500">{{ $errors->first('password') }}</span>
                    @endif
                </div>

                <!-- Remember Me -->
                <div class="flex items-center mb-6">
                    <input id="remember_me" type="checkbox" name="remember" class="mr-2 rounded border-gray-300 focus:ring-indigo-500">
                    <label for="remember_me" class="text-sm text-gray-600">Remember me</label>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-4 rounded-md transition duration-300">
                    Log in
                </button>

                <!-- Forgot Password -->
                <div class="mt-4 text-center">
                    @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-sm text-indigo-600 hover:underline">Forgot your password?</a>
                    @endif
                </div>
            </form>
        </div>

        <!-- Image Section -->
        <div class="hidden md:block">
            <img src="https://img.freepik.com/premium-vector/vector-abstract-seamless-pattern-with-stars-blue-background_117177-1008.jpg" class="rounded-3xl object-cover h-full w-full" alt="Background Image">
        </div>
    </div>
</div>


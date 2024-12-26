<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

<div class="flex justify-center items-center h-screen p-10 bg-yellow-300">
    <div class="grid md:grid-cols-2 grid-cols-1 border rounded-3xl shadow-lg bg-indigo-100">
        <!-- Form Section -->
        <div class="flex justify-center items-center p-5 bg-white rounded-3xl">
            <form method="POST" action="{{ route('register') }}" class="w-full max-w-sm">
                @csrf
                <header class="mb-8 text-center">
                    <img class="w-40 mx-auto mb-5" src="{{ asset('img/kkk.jpg') }}" alt="Logo" />
                    <h1 class="text-2xl font-bold text-indigo-700">Register</h1>
                </header>

                <!-- Name -->
                <div class="relative mb-5">
                    <label for="name" class="text-sm font-semibold text-gray-600">Name</label>
                    <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" class="w-full bg-gray-100 border border-indigo-500 rounded-md p-3 mt-1 outline-none focus:ring-2 focus:ring-indigo-400">
                    @if($errors->has('name'))
                    <span class="text-sm text-red-500">{{ $errors->first('name') }}</span>
                    @endif
                </div>

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
                    <input id="password" type="password" name="password" required autocomplete="new-password" class="w-full bg-gray-100 border border-indigo-500 rounded-md p-3 mt-1 outline-none focus:ring-2 focus:ring-indigo-400">
                    @if($errors->has('password'))
                    <span class="text-sm text-red-500">{{ $errors->first('password') }}</span>
                    @endif
                </div>

                <!-- Confirm Password -->
                <div class="relative mb-5">
                    <label for="password_confirmation" class="text-sm font-semibold text-gray-600">Confirm Password</label>
                    <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" class="w-full bg-gray-100 border border-indigo-500 rounded-md p-3 mt-1 outline-none focus:ring-2 focus:ring-indigo-400">
                    @if($errors->has('password_confirmation'))
                    <span class="text-sm text-red-500">{{ $errors->first('password_confirmation') }}</span>
                    @endif
                </div>

                <!-- Submit Button -->
                <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-4 rounded-md transition duration-300">
                    Register
                </button>

                <!-- Already Registered Link -->
                <div class="mt-4 text-center">
                    <a href="{{ route('login') }}" class="text-sm text-indigo-600 hover:underline">Already registered?</a>
                </div>
            </form>
        </div>

        <!-- Image Section -->
        <div class="hidden md:block">
            <img src="https://img.freepik.com/premium-vector/vector-abstract-seamless-pattern-with-stars-blue-background_117177-1008.jpg" class="rounded-3xl object-cover h-full w-full" alt="Background Image">
        </div>
    </div>
</div>


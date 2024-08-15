<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.css" rel="stylesheet" />
</head>

<body>
    {{-- <div class="container">
    <div class="row justify-content-center mt-4">
        <div class="col-md-6">
            <div class="card p-4 shadow">
                <div class="text-center mb-4">
                    <img src="{{ asset('uploads/login.jpeg') }}" alt="Your Logo" class="img-fluid" style="max-width: 100px;">
                </div>
                @if (Session::get('failed'))
                    <div class="alert alert-danger">{{ Session::get('failed') }}</div>
                @endif
                <form action="{{ route('login.auth') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="username" class="form-label">username:</label>
                        <input type="username" class="form-control" id="username" name="username" value="{{ old('username') }}" required>
                        @error('username')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password:</label>
                        <input type="password" class="form-control" id="password" name="password" value="{{ old('password') }}" required>
                        @error('password')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Login</button>
                </form>
            </div>
        </div>
    </div>
</div> --}}

    <!-- Container utama -->
    <div class="relative min-h-screen">
        <!-- Div untuk gambar dengan efek blur -->
        <div class="absolute inset-0 bg-no-repeat bg-cover bg-center filter"
            style="background-image: url({{ asset('assets/svg/image-1.svg') }}); z-index: -1;">
        </div>

        <!-- Overlay gradasi warna -->
        <div class="absolute inset-0 bg-gradient-to-b from-green-400 to-green-300 opacity-50 z-0"></div>

        <!-- Konten utama -->
        <div class="relative z-10 flex sm:flex-row justify-center items-center min-h-screen">
            <div class="flex-col flex self-center p-10 sm:max-w-5xl xl:max-w-2xl">
                <div class="self-start hidden lg:flex flex-col text-white">
                    <img src="" class="mb-3">
                    <h1 class="mb-3 font-bold text-5xl">Hi ? Welcome Back </h1>
                    <p class="pr-3">Lorem ipsum is placeholder text commonly used in the graphic, print,
                        and publishing industries for previewing layouts and visual mockups.</p>
                </div>
            </div>
            <div class="flex justify-center self-center">
                <div class="p-12 bg-white mx-auto rounded-2xl w-100">
                    <div class="mb-4">
                        <h3 class="font-semibold text-2xl text-gray-800">Sign In</h3>
                        <p class="text-gray-500">Please sign in to your account.</p>
                    </div>
                    <form action="{{ route('login.auth') }}" method="post">
                        @csrf
                        <div class="space-y-5">
                            <div class="space-y-2">
                                <label class="text-sm font-medium text-gray-700 tracking-wide"
                                    for="email">Email</label>
                                <input
                                    class="w-full text-base px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-green-400"
                                    id="email" type="email" name="email" value="{{ old('email') }}" required
                                    placeholder="mail@gmail.com">
                            </div>
                            <div class="space-y-2">
                                <label class="mb-5 text-sm font-medium text-gray-700 tracking-wide" for="password">
                                    Password
                                </label>
                                <input
                                    class="w-full content-center text-base px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-green-400"
                                    type="password" id="password" name="password" value="{{ old('password') }}"
                                    required placeholder="Enter your password">
                            </div>
                            <div>
                                <button type="submit"
                                    class="w-full flex justify-center bg-green-400 hover:bg-green-500 text-gray-100 p-3 rounded-full tracking-wide font-semibold shadow-lg cursor-pointer transition ease-in duration-500">
                                    Sign in
                                </button>
                            </div>
                        </div>
                    </form>
                    <div class="pt-5 text-center text-gray-400 text-xs">
                        <span>
                            Copyright © 2021-2022
                            <a href="https://codepen.io/uidesignhub" rel="" target="_blank" title="Ajimon"
                                class="text-green hover:text-green-500"></a></span>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>

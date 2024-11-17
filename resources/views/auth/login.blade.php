@extends('front.layouts.app')
@section('content')
    @guest
        <div class="w-full max-w-[500px] p-8 mx-auto">
            <div class="flex items-center justify-between mb-8 mt-[-10px]">
                <a href="/">
                    <div
                        class="flex items-center justify-center w-10 h-10 rounded-full bg-[#E0DC00] transition-all duration-300 hover:shadow-[0_10px_20px_0_#e0dc00cc]">
                        <img src="{{ asset('assets/images/icons/arrow-left.svg') }}" class="w-5 h-5 object-contain" alt="icon">
                    </div>
                </a>
                <a href="/">
                    <div
                        class="flex items-center justify-center w-8 h-8 rounded-full bg-[#E0DC00] transition-all duration-300 hover:shadow-[0_10px_20px_0_#e0dc00cc]">
                        <img src="{{ asset('assets/images/icons/question.png') }}" class="w-4 h-4 object-contain" alt="icon">
                    </div>
                </a>
            </div>

            <h2 class="text-lg font-bold text-gray-900">Selamat Datang Kembali di Takoyaki Babon!</h2>
            <p class="text-gray-700 mb-6">
                Masuk untuk melanjutkan dan nikmati kelezatan takoyaki kami.
            </p>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email Address -->
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input id="email"
                        class="w-full p-2 px-4 mt-1 bg-[#EDEDED] rounded-[30px]"
                        type="email" name="email" :value="old('email')" required autofocus autocomplete="username">
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-gray-700">Kata Sandi</label>
                    <input id="password"
                        class="w-full p-2 px-4 mt-1 bg-[#EDEDED] rounded-[30px]"
                        type="password" name="password" required autocomplete="current-password">
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Remember Me -->
                <div class="flex items-center mb-6">
                    <label for="remember_me" class="inline-flex items-center text-sm text-gray-600">
                        <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-[#E0DC00] shadow-sm focus:ring-[#E0DC00]" name="remember">
                        <span class="ml-2">Ingat saya</span>
                    </label>
                </div>

                <!-- Submit Button -->
                <div class="mt-6">
                    <button type="submit"
                        class="w-full p-3 text-sm font-medium text-black bg-[#E0DC00] rounded-[30px] hover:bg-[#e0dc00cc]">
                        Masuk
                    </button>
                </div>

                <!-- Forgot Password Link -->
                <div class="flex items-center justify-center mt-4">
                    @if (Route::has('password.request'))
                        <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500"
                            href="{{ route('password.request') }}">
                            {{ __('Lupa kata sandi?') }}
                        </a>
                    @endif
                </div>
                <div class="flex items-center justify-center mt-4">
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500"
                            href="{{ route('register') }}">
                            {{ __('Belum punya akun?') }}
                        </a>
                </div>
            </form>
        </div>
    @endguest
@endsection

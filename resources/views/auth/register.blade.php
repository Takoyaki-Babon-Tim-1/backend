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

            <h2 class="text-lg font-bold text-gray-900">Baru di Takoyaki Babon?</h2>
            <p class="text-gray-700 mb-6">
                Daftar sekarang dan jadilah bagian dari kami untuk menikmati kelezatan takoyaki yang lebih dari sekadar gigitan!
            </p>

            <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                @csrf

                <!-- Name -->
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700">
                        Nama <span class="text-red-500">*</span>
                    </label>
                    <input id="name" class="w-full p-2 px-4 mt-1 bg-[#EDEDED] rounded-[30px]" type="text" name="name"
                        :value="old('name')" required autofocus autocomplete="name">
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <!-- Email Address -->
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700">
                        Email <span class="text-red-500">*</span>
                    </label>
                    <input id="email" class="w-full p-2 px-4 mt-1 bg-[#EDEDED] rounded-[30px]" type="email" name="email"
                        :value="old('email')" required autocomplete="username">
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Avatar Upload -->
                {{-- <div class="mb-4">
                    <label for="avatar" class="block text-sm font-medium text-gray-700">
                        Unggah Foto <span class="text-red-500">*</span>
                    </label>
                    <input id="avatar" class="w-full p-2 px-4 mt-1 bg-[#EDEDED] rounded-[30px]" type="file" name="avatar"
                        accept="image/*">
                    <x-input-error :messages="$errors->get('avatar')" class="mt-2" />
                </div> --}}

                <!-- Password -->
                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-gray-700">
                        Kata Sandi <span class="text-red-500">*</span>
                    </label>
                    <input id="password" class="w-full p-2 px-4 mt-1 bg-[#EDEDED] rounded-[30px]" type="password"
                        name="password" required autocomplete="new-password">
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Confirm Password -->
                <div class="mb-4">
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700">
                        Konfirmasi Kata Sandi <span class="text-red-500">*</span>
                    </label>
                    <input id="password_confirmation" class="w-full p-2 px-4 mt-1 bg-[#EDEDED] rounded-[30px]" type="password"
                        name="password_confirmation" required autocomplete="new-password">
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>


                <div class="mt-6">
                    <button type="submit"
                        class="w-full p-3 text-sm font-medium text-black bg-[#E0DC00] rounded-[30px] hover:bg-[#e0dc00cc]">
                        Lanjutkan
                    </button>
                </div>
            </form>

            <div class="flex items-center justify-center mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500"
                    href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>
            </div>
        </div>
    @endguest
@endsection
